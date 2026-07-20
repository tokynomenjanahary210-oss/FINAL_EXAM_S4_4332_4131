<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'operation_type_id', 'amount', 'fee', 'balance_before', 'balance_after', 'description', 'related_client_id'];
}
