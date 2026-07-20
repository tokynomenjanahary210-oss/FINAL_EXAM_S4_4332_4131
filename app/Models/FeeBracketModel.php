<?php

namespace App\Models;

use CodeIgniter\Model;

class FeeBracketModel extends Model
{
    protected $table = 'fee_brackets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['operation_type_id', 'min_amount', 'max_amount', 'fee'];
}
