<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\TransactionModel;
use App\Models\OperationTypeModel;
use App\Models\FeeBracketModel;
use App\Models\OperatorModel;
use App\Models\OtherOperatorModel;

class ClientController extends BaseController
{
    public function login()
    {
        $session = session();

        if ($this->request->getPost('phone_number')) {
            $phone = $this->request->getPost('phone_number');
            $clientModel = new ClientModel();
            $operatorModel = new OperatorModel();

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
                return view('client/login', ['error' => 'Seuls les clients Airtel peuvent se connecter. Préfixes autorisés : ' . $operator['prefixes']]);
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

            return redirect()->to('/client/home');
        }

        if ($session->get('client_id')) {
            return redirect()->to('/client/home');
        }

        return view('client/login');
    }

    public function home()
    {
        $session = session();
        if (! $session->get('client_id')) {
            return redirect()->to('/client/login');
        }

        $clientModel = new ClientModel();
        $client = $clientModel->find($session->get('client_id'));

        $data['client'] = $client;
        return view('client/home', $data);
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

    private function detectExternalOperator($phone, OtherOperatorModel $otherOperatorModel)
    {
        $otherOperators = $otherOperatorModel->findAll();
        foreach ($otherOperators as $operator) {
            $prefixes = array_map('trim', explode(',', $operator['prefixes']));
            foreach ($prefixes as $prefix) {
                if (str_starts_with($phone, $prefix)) {
                    return $operator;
                }
            }
        }
        return null;
    }

    public function transfert()
    {
        $session = session();
        if (! $session->get('client_id')) {
            return redirect()->to('/client/login');
        }

        if ($this->request->getPost('phone_numbers') && $this->request->getPost('amount')) {
            $phones = $this->request->getPost('phone_numbers');
            $amount = (int) $this->request->getPost('amount');
            $include_retrait_fee = $this->request->getPost('include_retrait_fee') ? 1 : 0;

            $clientModel = new ClientModel();
            $transactionModel = new TransactionModel();
            $operationTypeModel = new OperationTypeModel();
            $feeBracketModel = new FeeBracketModel();
            $operatorModel = new OperatorModel();
            $otherOperatorModel = new OtherOperatorModel();

            $sender = $clientModel->find($session->get('client_id'));
            $operationType = $operationTypeModel->where('code', 'transfert')->first();

            $phones = array_map('trim', $phones);
            $recipients = [];
            $external_count = 0;

            foreach ($phones as $p) {
                if (empty($p) || $p === $sender['phone_number']) {
                    continue;
                }

                $external_operator = $this->detectExternalOperator($p, $otherOperatorModel);
                if ($external_operator) {
                    $external_count++;
                }

                $receiver = $clientModel->where('phone_number', $p)->first();
                if (! $receiver) {
                    $receiverId = $clientModel->insert([
                        'phone_number' => $p,
                        'balance' => 0,
                        'full_name' => '',
                    ]);
                    $receiver = $clientModel->find($receiverId);
                }
                $recipients[] = $receiver;
            }

            if (empty($recipients)) {
                return redirect()->to('/client/dashboard')->with('error', 'Aucun destinataire valide.');
            }

            if (count($recipients) > 1 && $external_count > 0) {
                return redirect()->to('/client/dashboard')->with('error', 'L\'envoi multiple n\'est autorisé qu\'entre clients Airtel.');
            }

            $share_amount = (int) floor($amount / count($recipients));
            $remainder = $amount % count($recipients);

            foreach ($recipients as $index => $receiver) {
                $current_amount = $share_amount + ($index === 0 ? $remainder : 0);

                $fee = $feeBracketModel
                    ->where('operation_type_id', $operationType['id'])
                    ->where('min_amount <=', $current_amount)
                    ->where('max_amount >=', $current_amount)
                    ->first();

                $fee_amount = $fee ? $fee['fee'] : 0;

                $external_operator = $this->detectExternalOperator($receiver['phone_number'], $otherOperatorModel);
                $is_external = $external_operator ? 1 : 0;

                $commission_amount = 0;
                if ($is_external) {
                    $operator = $operatorModel->first();
                    $commission_percentage = $operator['external_commission_percentage'] ?? 0;
                    $commission_amount = (int) floor($current_amount * $commission_percentage / 100);
                }

                $retrait_fee = 0;
                if ($include_retrait_fee && ! $is_external) {
                    $retrait_fee_bracket = $feeBracketModel
                        ->where('operation_type_id', 2)
                        ->where('min_amount <=', $current_amount)
                        ->where('max_amount >=', $current_amount)
                        ->first();
                    $retrait_fee = $retrait_fee_bracket ? $retrait_fee_bracket['fee'] : 0;
                }

                $total = $current_amount + $fee_amount + $commission_amount + $retrait_fee;

                if ($sender['balance'] < $total) {
                    return redirect()->to('/client/dashboard')->with('error', 'Solde insuffisant pour un ou plusieurs destinataires.');
                }

                $balance_before_sender = $sender['balance'];
                $balance_after_sender = $balance_before_sender - $total;
                $balance_before_receiver = $receiver['balance'];
                $balance_after_receiver = $balance_before_receiver + $current_amount;

                $clientModel->update($sender['id'], ['balance' => $balance_after_sender]);
                $clientModel->update($receiver['id'], ['balance' => $balance_after_receiver]);

                $description = 'Transfert vers ' . $receiver['phone_number'];
                if ($is_external) {
                    $description .= ' (externe vers ' . $external_operator['name'] . ')';
                }

                $transactionModel->insert([
                    'client_id' => $sender['id'],
                    'operation_type_id' => $operationType['id'],
                    'amount' => $current_amount,
                    'fee' => $fee_amount,
                    'balance_before' => $balance_before_sender,
                    'balance_after' => $balance_after_sender,
                    'description' => $description,
                    'related_client_id' => $receiver['id'],
                    'is_external' => $is_external,
                    'external_operator_id' => $is_external ? $external_operator['id'] : null,
                    'commission_amount' => $commission_amount,
                ]);

                $transactionModel->insert([
                    'client_id' => $receiver['id'],
                    'operation_type_id' => $operationType['id'],
                    'amount' => $current_amount,
                    'fee' => 0,
                    'balance_before' => $balance_before_receiver,
                    'balance_after' => $balance_after_receiver,
                    'description' => 'Transfert reçu de ' . $sender['phone_number'],
                    'related_client_id' => $sender['id'],
                ]);

                $sender['balance'] = $balance_after_sender;
            }

            return redirect()->to('/client/dashboard')->with('success', 'Transfert(s) effectué(s) avec succès.');
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
