<?php

namespace App\Controllers;

use App\Models\UnitsModel;
use App\Models\UnitsModelData;
use Config\Services;

class Units extends BaseController
{
    public function __construct()
    {
        $this->unit = new UnitsModel();
    }
    public function index()
    {
        return view('units/data');
    }

    function ambilDataSatuan()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $datasatuan = new UnitsModelData($request);
            if ($request->getMethod(true) == 'POST') {
                $lists = $datasatuan->get_datatables();
                $data = [];
                $no = $request->getPost("start");
                foreach ($lists as $list) {
                    $no++;

                    $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->u_id . "','" . $list->u_name . "')\"><i class=\"fa fa-trash-alt\"></i></button>";
                    $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . $list->u_id . "')\"><i class=\"fa fa-pencil-alt\"></i></button>";

                    $row = [];
                    $row[] = $no;
                    $row[] = $list->u_name;
                    $row[] = $tombolHapus . ' ' . $tombolEdit;
                    $data[] = $row;
                }
                $output = [
                    "draw" => $request->getPost('draw'),
                    "recordsTotal" => $datasatuan->count_all(),
                    "recordsFiltered" => $datasatuan->count_filtered(),
                    "data" => $data
                ];
                echo json_encode($output);
            }
        }
    }

    function add()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getPost('aksi');
            $msg = [
                'data' => view('units/add', ['aksi' => $aksi])
            ];
            echo json_encode($msg);
        }
    }

    function simpandata()
    {
        if ($this->request->isAJAX()) {
            $namasatuan = $this->request->getVar('namasatuan');

            $this->unit->insert([
                'u_name' => $namasatuan
            ]);

            $msg = [
                'sukses' => 'Satuan berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }
    function hapus()
    {
        if ($this->request->isAJAX()) {
            $idSatuan = $this->request->getVar('idsatuan');

            $this->unit->delete($idSatuan);

            $msg = [
                'sukses' => 'Satuan berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function edit()
    {
        if ($this->request->isAJAX()) {
            $idsatuan =  $this->request->getVar('idsatuan');

            $ambildatasatuan =$this->unit->find($idsatuan);
            $data = [
                'idsatuan' => $idsatuan,
                'namasatuan' => $ambildatasatuan['u_id']
            ];

            $msg = [
                'data' => view('units/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idsatuan = $this->request->getVar('idsatuan');
            $msg = [
                'sukses' =>  'Data satuan berhasil diupdate'
            ];
            echo json_encode($msg);
        }
    }
}