<?php

namespace App\Models;

use CodeIgniter\Model;

class CustModel extends Model
{
    protected $table      = 'pelanggan';
    protected $primaryKey = 'cs_code';

    protected $allowedFields = ['cs_code', 'cs_name', 'cs_phone',  'cs_address'];

    public function cariData($cari)
    {
        return $this->table('pelanggan')->like('cs_name', $cari);
    }
}