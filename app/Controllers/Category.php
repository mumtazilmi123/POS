<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Category extends BaseController
{
    public function __construct()
    {
        $this-> category = new CategoryModel();
    }
    public function index()
    {
        $tombolCari = $this->request->getPost('tombolkategori');

        if (isset($tombolCari)) {
            $cari = $this->request->getPost('carikategori');
            session()->set('carikategori', $cari);
            redirect()->to('/category/index');
        } else {
            $cari = session()->get('carikategori');
        }

        $dataKategori = $cari ? $this->category ->cariData($cari) : $this->category ;

        $noHalaman = $this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : 1;
        $data = [
            'datakategori' => $dataKategori->paginate(6, 'category'),
            'pager' => $this->category ->pager,
            'nohalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('category/data', $data);
    }

    function formTambah()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getPost('aksi');
            $msg = [
                'data' => view('category/addcategory', ['aksi' => $aksi])
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $namakategori = $this->request->getVar('namakategori');
            $brand = $this->request->getVar('brand');

            $this->category ->insert([
                'ctg_name' => $brand,
                'ctg_name' => $namakategori
            ]);

            $msg = [
                'sukses' => 'Kategori berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $idKategori = $this->request->getVar('idkategori');

            $this->category ->delete($idKategori);

            $msg = [
                'sukses' => 'Kategori berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function formEdit()
    {
        if ($this->request->isAJAX()) {
            $idKategori =  $this->request->getVar('idkategori');

            $ambildatakategori = $this->category ->find($idKategori);
            $data = [
                'idkategori'    => $idKategori,
                'namakategori'  => $ambildatakategori['ctg_name'],
                'brand'         => $ambildatakategori['ctg_brand']
            ];

            $msg = [
                'data' => view('category/editCategory', $data)
            ];
            echo json_encode($msg);
        }
    }

    function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idKategori = $this->request->getVar('idkategori');
            $namaKategori = $this->request->getVar('namakategori');
            $brand = $this->request->getVar('brand');

            $this->category ->update($idKategori, [
                'ctg_name' => $namaKategori,
                'ctg_brand' => $brand
            ]);

            $msg = [
                'sukses' =>  'Data kategori berhasil diupdate'
            ];
            echo json_encode($msg);
        }
    }
}