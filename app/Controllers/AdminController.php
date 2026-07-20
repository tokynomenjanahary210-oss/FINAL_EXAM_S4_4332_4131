<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\OperatorModel;
use App\Models\TransactionModel;
use App\Models\OperationTypeModel;
use App\Models\FeeBracketModel;
use App\Models\OtherOperatorModel;

class AdminController extends BaseController
{
    public function index()
    {
        $clientModel = new ClientModel();
        $transactionModel = new TransactionModel();
        $operationTypeModel = new OperationTypeModel();
        $operatorModel = new OperatorModel();

        $operator = $operatorModel->first();
        $airtel_prefixes = array_map('trim', explode(',', $operator['prefixes']));

        $all_clients = $clientModel->findAll();
        $clients = [];
        foreach ($all_clients as $client) {
            foreach ($airtel_prefixes as $prefix) {
                if (str_starts_with($client['phone_number'], $prefix)) {
                    $clients[] = $client;
                    break;
                }
            }
        }

        $total_balance = array_sum(array_column($clients, 'balance'));

        $deposit_type = $operationTypeModel->where('code', 'depot')->first();
        $withdrawal_type = $operationTypeModel->where('code', 'retrait')->first();
        $transfer_type = $operationTypeModel->where('code', 'transfert')->first();

        $total_fees = $transactionModel
            ->select('SUM(fee) as total_fee')
            ->where('operation_type_id', $transfer_type['id'])
            ->first();

        $deposit_count = $transactionModel
            ->where('operation_type_id', $deposit_type['id'])
            ->countAllResults();

        $withdrawal_count = $transactionModel
            ->where('operation_type_id', $withdrawal_type['id'])
            ->countAllResults();

        $transfer_count = $transactionModel
            ->where('operation_type_id', $transfer_type['id'])
            ->countAllResults();

        $data['clients'] = $clients;
        $data['total_balance'] = $total_balance;
        $data['clients_count'] = count($clients);
        $data['total_fees'] = $total_fees['total_fee'] ?? 0;
        $data['deposit_count'] = $deposit_count;
        $data['withdrawal_count'] = $withdrawal_count;
        $data['transfer_count'] = $transfer_count;

        return view('admin/index', $data);
    }

    public function prefixes()
    {
        $model = new OperatorModel();
        $operator = $model->first();

        if ($this->request->getPost()) {
            $prefixes = $this->request->getPost('prefixes');
            $operator['prefixes'] = $prefixes;
            $model->update($operator['id'], $operator);
            return redirect()->to('/admin/prefixes')->with('success', 'Préfixes mis à jour.');
        }

        $data['operator'] = $operator;
        return view('admin/prefixes', $data);
    }

    public function operation_types()
    {
        $model = new OperationTypeModel();

        if ($this->request->getPost('name')) {
            $model->insert([
                'code' => strtolower($this->request->getPost('code')),
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
            ]);
            return redirect()->to('/admin/operation_types')->with('success', 'Type d\'opération ajouté.');
        }

        $data['operation_types'] = $model->findAll();
        return view('admin/operation_types', $data);
    }

    public function delete_operation_type($id)
    {
        $model = new OperationTypeModel();
        $model->delete($id);
        return redirect()->to('/admin/operation_types')->with('success', 'Type d\'opération supprimé.');
    }

    public function fee_brackets()
    {
        $operationTypeModel = new OperationTypeModel();
        $feeBracketModel = new FeeBracketModel();

        $operation_types = $operationTypeModel->findAll();

        if ($this->request->getPost('operation_type_id')) {
            $feeBracketModel->insert([
                'operation_type_id' => $this->request->getPost('operation_type_id'),
                'min_amount' => $this->request->getPost('min_amount'),
                'max_amount' => $this->request->getPost('max_amount'),
                'fee' => $this->request->getPost('fee'),
            ]);
            return redirect()->to('/admin/fee_brackets')->with('success', 'Barème de frais ajouté.');
        }

        $data['operation_types'] = $operation_types;
        $data['fee_brackets'] = $feeBracketModel
            ->select('fee_brackets.*, operation_types.name as operation_name')
            ->join('operation_types', 'operation_types.id = fee_brackets.operation_type_id')
            ->findAll();

        return view('admin/fee_brackets', $data);
    }

    public function delete_fee_bracket($id)
    {
        $model = new FeeBracketModel();
        $model->delete($id);
        return redirect()->to('/admin/fee_brackets')->with('success', 'Barème supprimé.');
    }

    public function edit_fee_bracket($id)
    {
        $model = new FeeBracketModel();
        $data['bracket'] = $model->find($id);
        $operationTypeModel = new OperationTypeModel();
        $data['operation_types'] = $operationTypeModel->findAll();
        return view('admin/edit_fee_bracket', $data);
    }

    public function update_fee_bracket($id)
    {
        $model = new FeeBracketModel();
        $model->update($id, [
            'operation_type_id' => $this->request->getPost('operation_type_id'),
            'min_amount' => $this->request->getPost('min_amount'),
            'max_amount' => $this->request->getPost('max_amount'),
            'fee' => $this->request->getPost('fee'),
        ]);
        return redirect()->to('/admin/fee_brackets')->with('success', 'Barème modifié.');
    }

    // Version 2: Gestion des autres opérateurs
    public function other_operators()
    {
        $model = new OtherOperatorModel();

        if ($this->request->getPost('name')) {
            $prefixes = $this->request->getPost('prefixes');
            $model->insert([
                'name' => $this->request->getPost('name'),
                'prefixes' => $prefixes,
            ]);
            return redirect()->to('/admin/other_operators')->with('success', 'Opérateur ajouté.');
        }

        $data['other_operators'] = $model->findAll();
        return view('admin/other_operators', $data);
    }

    public function edit_other_operator($id)
    {
        $model = new OtherOperatorModel();
        $data['operator'] = $model->find($id);
        return view('admin/edit_other_operator', $data);
    }

    public function update_other_operator($id)
    {
        $model = new OtherOperatorModel();
        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'prefixes' => $this->request->getPost('prefixes'),
        ]);
        return redirect()->to('/admin/other_operators')->with('success', 'Opérateur modifié.');
    }

    public function delete_other_operator($id)
    {
        $model = new OtherOperatorModel();
        $model->delete($id);
        return redirect()->to('/admin/other_operators')->with('success', 'Opérateur supprimé.');
    }

    // Version 2: Configuration commission globale
    public function commission()
    {
        $model = new OperatorModel();
        $operator = $model->first();

        if ($this->request->getPost()) {
            $operator['external_commission_percentage'] = $this->request->getPost('external_commission_percentage');
            $model->update($operator['id'], $operator);
            return redirect()->to('/admin/commission')->with('success', 'Commission mise à jour.');
        }

        $data['operator'] = $operator;
        return view('admin/commission', $data);
    }

    // Version 2: Gains Airtel uniquement
    public function gains()
    {
        $transactionModel = new TransactionModel();
        $operationTypeModel = new OperationTypeModel();

        $transfer_type = $operationTypeModel->where('code', 'transfert')->first();

        $total_fees = $transactionModel
            ->select('SUM(fee) as total_fee')
            ->where('operation_type_id', $transfer_type['id'])
            ->first();

        $total_commissions = $transactionModel
            ->select('SUM(commission_amount) as total_commission')
            ->where('is_external', 1)
            ->first();

        $data['total_fees'] = $total_fees['total_fee'] ?? 0;
        $data['total_commissions'] = $total_commissions['total_commission'] ?? 0;

        return view('admin/gains', $data);
    }

    // Version 2: Montants à reverser aux opérateurs
    public function amounts_to_send()
    {
        $transactionModel = new TransactionModel();
        $otherOperatorModel = new OtherOperatorModel();

        $other_operators = $otherOperatorModel->findAll();
        $amounts = [];

        foreach ($other_operators as $operator) {
            $result = $transactionModel
                ->select('COUNT(*) as transfer_count, SUM(commission_amount) as total_commission')
                ->where('is_external', 1)
                ->where('external_operator_id', $operator['id'])
                ->first();

            $amounts[] = [
                'name' => $operator['name'],
                'transfer_count' => $result['transfer_count'] ?? 0,
                'total_commission' => $result['total_commission'] ?? 0,
            ];
        }

        $data['amounts'] = $amounts;
        return view('admin/amounts_to_send', $data);
    }

    public function clients()
    {
        $clientModel = new ClientModel();
        $transactionModel = new TransactionModel();
        $operatorModel = new OperatorModel();

        $operator = $operatorModel->first();
        $airtel_prefixes = array_map('trim', explode(',', $operator['prefixes']));

        $all_clients = $clientModel->findAll();
        $clients = [];
        foreach ($all_clients as $client) {
            foreach ($airtel_prefixes as $prefix) {
                if (str_starts_with($client['phone_number'], $prefix)) {
                    $clients[] = $client;
                    break;
                }
            }
        }

        foreach ($clients as $key => $client) {
            $clients[$key]['transactions_count'] = $transactionModel
                ->where('client_id', $client['id'])
                ->countAllResults();
        }

        $data['clients'] = $clients;
        return view('admin/clients', $data);
    }
}
