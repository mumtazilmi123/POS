<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'ctg_id';

    protected $allowedFields = ['ctg_id', 'ctg_name'];
}