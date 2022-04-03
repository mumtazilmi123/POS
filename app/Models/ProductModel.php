<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'idbarcode';

    protected $allowedFields = [
        'idbarcode',
        'pr_name',
        'pr_uid',
        'pr_ctgid',
        'readystock',
        'purchase_prc',
        'sell_prc',
        'img',
    ];

    // public function cariData($cari)
    // {
    //     return $this->table('kategori')->like('ctg_name', $cari);
    // }
}