<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\OperatorModel;
use App\Models\TransactionModel;
use App\Models\OperationTypeModel;
use App\Models\FeeBracketModel;

class AdminController extends BaseController
{
    public function index()
    {
        $clientModel = new ClientModel();
        $transactionModel = new TransactionModel();

        $data['clients'] = $clientModel->findAll();
        $data['total_balance'] = array_sum(array_column($data['clients'], 'balance'));
        $data['clients_count'] = count($data['clients']);

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

    public function gains()
    {
        $transactionModel = new TransactionModel();
        $operationTypeModel = new OperationTypeModel();

        $operation_types = $operationTypeModel->findAll();
        $gains = [];

        foreach ($operation_types as $type) {
            $total = $transactionModel
                ->select('SUM(fee) as total_fee')
                ->where('operation_type_id', $type['id'])
                ->first();

            $gains[] = [
                'name' => $type['name'],
                'total' => $total['total_fee'] ?? 0,
            ];
        }

        $data['gains'] = $gains;
        $data['total_gains'] = array_sum(array_column($gains, 'total'));

        return view('admin/gains', $data);
    }

    public function clients()
    {
        $clientModel = new ClientModel();
        $transactionModel = new TransactionModel();

        $clients = $clientModel->findAll();

        foreach ($clients as $key => $client) {
            $clients[$key]['transactions_count'] = $transactionModel
                ->where('client_id', $client['id'])
                ->countAllResults();
        }

        $data['clients'] = $clients;
        return view('admin/clients', $data);
    }
}
