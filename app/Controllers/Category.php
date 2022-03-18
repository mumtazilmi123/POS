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
        $searchButton = $this->request->getPost('tombolkategori');
        if(isset($searchButton)){
            $search = $this->request->getPost('carikategori');
            session()->set('carikategori, $search');
            redirect()->to('category/index');
        }else{
            $search = session()->get('carikategori');
        }

        $categoryData = $search ? this->category->searchCategory($search) : $this->category;
        
        $pages = $this->request->getVar('page_category') ? $this->request->getVar('page_category') : 1;
        $data = [
            'categorydata' => $this-> category->paginate(5, 'category'),
            'pager' => $this->category->pager,
            'pages'=> $pages
        ];
        return view('category/data', $data);
    }

    function addForm(){
        if($this->request->isAJAX()){
            $msg = [
                'data' => view('category/addcategory')
            ];

            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa dfitampilkan');
        }
    }
    public function saved(){
        $categoryname = $this->request->getVar('categoryname');
        $this->category->insert([
            'ctg_name' => $categoryname
        ]);

        $msg = [
            'success' => 'Berhasil Menambahkan Kategori'
        ];
        echo json_encode($msg);
    }
}
