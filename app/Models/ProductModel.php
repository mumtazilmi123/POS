<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'idbarcode';

    protected $allowedFields = [
        'idbarcode',
        'pr_name',
        'pr_uid',
        'pr_ctgid',
        'readystock',
        'harga_beli',
        'harga_jual',
    ];


    public function cariData($cari){
        return $this->table('produk')->join('kategori','ctg_id=pr_ctgid')->join('satuan','u_id=pr_uid')->like('idbarcode', $cari)->Like('pr_name', $cari);
    }
}