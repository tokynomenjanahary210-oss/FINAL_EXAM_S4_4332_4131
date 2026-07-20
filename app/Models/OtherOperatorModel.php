<?php

namespace App\Models;

use CodeIgniter\Model;

class OtherOperatorModel extends Model
{
    protected $table = 'other_operators';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'prefixes'];
}
