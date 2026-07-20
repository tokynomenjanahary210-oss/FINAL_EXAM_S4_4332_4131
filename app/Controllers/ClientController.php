<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\TransactionModel;
use App\Models\OperationTypeModel;
use App\Models\FeeBracketModel;

class ClientController extends BaseController
{
    public function login()
    {
        $session = session();

        if ($this->request->getPost('phone_number')) {
            $phone = $this->request->getPost('phone_number');
            $clientModel = new ClientModel();
            $operatorModel = new \App\Models\OperatorModel();

            $operator = $operatorModel->first();
            $prefixes = array_map('trim', explode(',', $operator['prefixes']));
            $valid = false;
            foreach ($prefixes as $prefix) {
                if (str_starts_with($phone, $prefix)) {
                    $valid = true;
                    break;
                }
            }

            if (! $valid) {
                return view('client/login', ['error' => 'Numéro invalide. Utilisez un préfixe valide: ' . $operator['prefixes']]);
            }

            $client = $clientModel->where('phone_number', $phone)->first();

            if (! $client) {
                $clientId = $clientModel->insert([
                    'phone_number' => $phone,
                    'balance' => 0,
                    'full_name' => '',
                ]);
                $client = $clientModel->find($clientId);
            }

            $session->set('client_id', $client['id']);
            $session->set('client_phone', $client['phone_number']);

            return redirect()->to('/client/dashboard');
        }

        if ($session->get('client_id')) {
            return redirect()->to('/client/dashboard');
        }

        return view('client/login');
    }

    public function dashboard()
    {
        $session = session();
        if (! $session->get('client_id')) {
            return redirect()->to('/client/login');
        }

        $clientModel = new ClientModel();
        $client = $clientModel->find($session->get('client_id'));

        $data['client'] = $client;
        return view('client/dashboard', $data);
    }

    public function depot()
    {
        $session = session();
        if (! $session->get('client_id')) {
            return redirect()->to('/client/login');
        }

        if ($this->request->getPost('amount')) {
            $amount = (int) $this->request->getPost('amount');
            $clientModel = new ClientModel();
            $transactionModel = new TransactionModel();
            $operationTypeModel = new OperationTypeModel();

            $client = $clientModel->find($session->get('client_id'));
            $operationType = $operationTypeModel->where('code', 'depot')->first();

            $balance_before = $client['balance'];
            $balance_after = $balance_before + $amount;

            $clientModel->update($client['id'], ['balance' => $balance_after]);

            $transactionModel->insert([
                'client_id' => $client['id'],
                'operation_type_id' => $operationType['id'],
                'amount' => $amount,
                'fee' => 0,
                'balance_before' => $balance_before,
                'balance_after' => $balance_after,
                'description' => 'Dépôt automatique',
            ]);

            return redirect()->to('/client/dashboard')->with('success', 'Dépôt effectué avec succès.');
        }

        return view('client/depot');
    }

    public function retrait()
    {
        $session = session();
        if (! $session->get('client_id')) {
            return redirect()->to('/client/login');
        }

        if ($this->request->getPost('amount')) {
            $amount = (int) $this->request->getPost('amount');
            $clientModel = new ClientModel();
            $transactionModel = new TransactionModel();
            $operationTypeModel = new OperationTypeModel();
            $feeBracketModel = new FeeBracketModel();

            $client = $clientModel->find($session->get('client_id'));
            $operationType = $operationTypeModel->where('code', 'retrait')->first();

            $fee = $feeBracketModel
                ->where('operation_type_id', $operationType['id'])
                ->where('min_amount <=', $amount)
                ->where('max_amount >=', $amount)
                ->first();

            $fee_amount = $fee ? $fee['fee'] : 0;
            $total = $amount + $fee_amount;

            if ($client['balance'] < $total) {
                return redirect()->to('/client/dashboard')->with('error', 'Solde insuffisant.');
            }

            $balance_before = $client['balance'];
            $balance_after = $balance_before - $total;

            $clientModel->update($client['id'], ['balance' => $balance_after]);

            $transactionModel->insert([
                'client_id' => $client['id'],
                'operation_type_id' => $operationType['id'],
                'amount' => $amount,
                'fee' => $fee_amount,
                'balance_before' => $balance_before,
                'balance_after' => $balance_after,
                'description' => 'Retrait automatique',
            ]);

            return redirect()->to('/client/dashboard')->with('success', 'Retrait effectué avec succès.');
        }

        return view('client/retrait');
    }

    public function transfert()
    {
        $session = session();
        if (! $session->get('client_id')) {
            return redirect()->to('/client/login');
        }

        if ($this->request->getPost('phone_number') && $this->request->getPost('amount')) {
            $phone = $this->request->getPost('phone_number');
            $amount = (int) $this->request->getPost('amount');
            $clientModel = new ClientModel();
            $transactionModel = new TransactionModel();
            $operationTypeModel = new OperationTypeModel();
            $feeBracketModel = new FeeBracketModel();

            $sender = $clientModel->find($session->get('client_id'));

            if ($sender['phone_number'] === $phone) {
                return redirect()->to('/client/dashboard')->with('error', 'Impossible de transférer vers votre propre compte.');
            }

            $receiver = $clientModel->where('phone_number', $phone)->first();

            if (! $receiver) {
                return redirect()->to('/client/dashboard')->with('error', 'Destinataire introuvable.');
            }

            $operationType = $operationTypeModel->where('code', 'transfert')->first();

            $fee = $feeBracketModel
                ->where('operation_type_id', $operationType['id'])
                ->where('min_amount <=', $amount)
                ->where('max_amount >=', $amount)
                ->first();

            $fee_amount = $fee ? $fee['fee'] : 0;
            $total = $amount + $fee_amount;

            if ($sender['balance'] < $total) {
                return redirect()->to('/client/dashboard')->with('error', 'Solde insuffisant.');
            }

            $balance_before_sender = $sender['balance'];
            $balance_after_sender = $balance_before_sender - $total;
            $balance_before_receiver = $receiver['balance'];
            $balance_after_receiver = $balance_before_receiver + $amount;

            $clientModel->update($sender['id'], ['balance' => $balance_after_sender]);
            $clientModel->update($receiver['id'], ['balance' => $balance_after_receiver]);

            $transactionModel->insert([
                'client_id' => $sender['id'],
                'operation_type_id' => $operationType['id'],
                'amount' => $amount,
                'fee' => $fee_amount,
                'balance_before' => $balance_before_sender,
                'balance_after' => $balance_after_sender,
                'description' => 'Transfert vers ' . $receiver['phone_number'],
                'related_client_id' => $receiver['id'],
            ]);

            $transactionModel->insert([
                'client_id' => $receiver['id'],
                'operation_type_id' => $operationType['id'],
                'amount' => $amount,
                'fee' => 0,
                'balance_before' => $balance_before_receiver,
                'balance_after' => $balance_after_receiver,
                'description' => 'Transfert reçu de ' . $sender['phone_number'],
                'related_client_id' => $sender['id'],
            ]);

            return redirect()->to('/client/dashboard')->with('success', 'Transfert effectué avec succès.');
        }

        return view('client/transfert');
    }

    public function historique()
    {
        $session = session();
        if (! $session->get('client_id')) {
            return redirect()->to('/client/login');
        }

        $transactionModel = new TransactionModel();
        $operationTypeModel = new OperationTypeModel();

        $transactions = $transactionModel
            ->select('transactions.*, operation_types.name as operation_name')
            ->join('operation_types', 'operation_types.id = transactions.operation_type_id')
            ->where('transactions.client_id', $session->get('client_id'))
            ->orderBy('transactions.id', 'DESC')
            ->findAll();

        $data['transactions'] = $transactions;
        return view('client/historique', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/client/login');
    }
}
