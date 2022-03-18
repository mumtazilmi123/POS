<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'ctg_id';

    protected $allowedFields = ['ctg_id', 'ctg_name'];

    public function searchCategory($search)
    {
        return $this->table('categories')->like('ctg_id', 'ctg_name');
    }
}