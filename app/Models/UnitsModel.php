<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitsModel extends Model
{
    protected $table      = 'satuan';
    protected $primaryKey = 'u_id';

    protected $allowedFields = ['u_id', 'u_name'];
}