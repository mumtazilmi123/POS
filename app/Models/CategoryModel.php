<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'ctg_id';

    protected $allowedFields = ['ctg_id', 'ctg_name', 'ctg_brand'];

    public function cariData($cari)
    {
        return $this->table('kategori')->like('ctg_name', $cari);
    }
}