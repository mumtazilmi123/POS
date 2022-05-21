<?php

namespace App\Controllers;

use App\Models\CustModel;

class Cust extends BaseController
{
    public function __construct()
    {
        $this-> cust = new CustModel();
    }
    public function index()
    {
        $tombolCari = $this->request->getPost('tombolcust');

        if (isset($tombolCari)) {
            $cari = $this->request->getPost('caricust');
            session()->set('caricust', $cari);
            redirect()->to('/cust/index');
        } else {
            $cari = session()->get('caricust');
        }

        $datacust = $cari ? $this-> cust ->cariData($cari) : $this->cust ;

        $noHalaman = $this->request->getVar('page_cust') ? $this->request->getVar('page_cust') : 1;
        $data = [
            'datacust' => $datacust->paginate(6, 'cust'),
            'pager' => $this->cust ->pager,
            'nohalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('cust/data', $data);
    }

    function addcust()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getPost('aksi');
            $msg = [
                'data' => view('cust/addcust', ['aksi' => $aksi])
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $namacust = $this->request->getVar('namacust');
            $phone = $this->request->getVar('phone');
            $address = $this->request->getVar('address');

            $this->cust ->insert([
                'cs_name'     => $namacust,
                'cs_phone'    => $phone,
                'cs_address'  => $address
            ]);

            $msg = [
                'sukses' => 'Customer berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $idcust = $this->request->getVar('idcust');

            $this->cust ->delete($idcust);

            $msg = [
                'sukses' => 'Customer berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function editcust()
    {
        if ($this->request->isAJAX()) {
            $idcust =  $this->request->getVar('idcust');

            $ambildatacust = $this->cust ->find($idcust);
            $data = [
                'idcust'        => $idcust,
                'namacust'      => $ambildatacust['cs_name'],
                'phone'         => $ambildatacust['cs_phone'],
                'address'        => $ambildatacust['cs_address']
            ];

            $msg = [
                'data' => view('cust/editcust', $data)
            ];
            echo json_encode($msg);
        }
    }

    function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idcust = $this->request->getVar('idcust');
            $namacust = $this->request->getVar('namacust');
            $phone = $this->request->getVar('phone');
            $address = $this->request->getVar('address');

            $this->cust ->update($idcust, [
                'cs_name'     => $namacust,
                'cs_phone'    => $phone,
                'cs_address'  => $address
            ]);

            $msg = [
                'sukses' =>  'Data Customer berhasil diupdate'
            ];
            echo json_encode($msg);
        }
    }
}