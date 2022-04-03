<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProductModel();
        $this->db = db_connect();
    }
    public function index()
    {

        return view('product/data');
    }
    
    public function add(){
        return view('product/add');
    }
}