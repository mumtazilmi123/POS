<?php

namespace App\Controllers;

class Sale extends BaseController
{
    public function index()
    {
        return view('sale/index');
    }

    public function input()
    {
        // $tgl = $this->request->getPost('tanggal');
        // $query = $this->db->query("SELECT MAX(sale_faktur) AS nofaktur FROM penjualan WHERE DATE_FORMAT(sale_tgl, '%Y-%m-%d') = '$tgl'");
        // $hasil = $query->getRowArray();
        // $data = $hasil['nofaktur'];
        // $nofaktur = $data + 1;

        // $lastNoUrut = substr($data, -4);

        // // Penambahan No Urut
        // $nextNoUrut = intval($lastNoUrut)+1;

        // $fakturPenjualan = 'J' . date('dmy', strtotime($tgl)) . sprintf("%04s", $nextNoUrut);
        // $data = [
        //     'nofaktur' => $fakturPenjualan,  
        // ];
        return view('sale/input');
    } 

    public function faktur(){
        $tgl = $this->request->getPost('tanggal');
        $query = $this->db->query("SELECT MAX (sale_faktur) AS nofaktur FROM penjualan WHERE DATE_FORMAT (sale_tgl, '%Y-%m-%d') = '$tgl'");
        $hasil = $query->getRowArray();
        $data = $hasil['nofaktur'];

        $lastNoUrut = substr($data, -4);

        // Penambahan No Urut
        $nextNoUrut = intval($lastNoUrut)+1;

        $fakturPenjualan = 'J' . date('dmy', strtotime($tgl)) . sprintf("%04s", $nextNoUrut);
        $msg = ['fakturpenjualan' => $fakturPenjualan];
        echo json_encode($msg); 
    }

    public function dataDetail(){
        $nofaktur = $this->request->getPost('nofaktur');
        $tempSale = $this->db>table('temp_penjualan');
        $queryShow = $tempSale->select('detjual_id as id, detjual_kodebarcode as code, pr_name, detjual_hargajual as hargajual, detjual_jml as qty, detjual_subtotal as subtotal')->join('produk', 'detjual_kodebarcode=idbarcode')->where('detjual_faktur', $nofaktur)->orderBy('detjual_id', 'ASC');

        $data = [
            'datadetail' => $queryTampil->get(),
        ];

        $msg = [
            'data' => view('sale/viewdetail', $data),
        ];

        echo json_encode($msg); 
    }
}
