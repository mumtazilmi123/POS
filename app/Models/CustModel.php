<?php

namespace App\Models;

use CodeIgniter\Model;

class CustModel extends Model
{
    protected $table      = 'customers';
    protected $primaryKey = 'cust_id';

    protected $allowedFields = ['cust_id', 'cust_name', 'cust_phone',  'cust_address'];

    public function cariData($cari)
    {
        return $this->table('customers')->like('cust_name', $cari);
    }
}