<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Category extends BaseController
{
    public function __construct()
    {
        $this->category= new CategoryModel();
    }
    public function index()
    {
        $data = [
            'categorydata' => $this->category->paginate(2),
            'pager' => $this->category->pager
        ];
        return view('category/data', $data);
    }
}
