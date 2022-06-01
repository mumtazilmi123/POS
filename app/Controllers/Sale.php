<?php

namespace App\Controllers;
use PHPUnit\Util\Json;
use App\Models\Modedataproduk;
use Config\Services;



class Sale extends BaseController
{
    public function index()
    {
        return view('sale/index');
    }

    public function input()
    {

        $data = [
            'nofaktur' => $this-> faktur()
        ];

        return view('sale/input', $data);
    } 

    public function faktur(){
        $tgl = $this->request->getPost('tanggal');
        $query = $this->db->query("SELECT MAX(sale_faktur) AS nofaktur FROM penjualan WHERE DATE_FORMAT(sale_tgl, '%Y-%m-%d') = '$tgl'");
        $hasil = $query->getRowArray();
        $data = $hasil['nofaktur'];

        $lastNoUrut = substr($data, -4);

        // Penambahan No Urut
        $nextNoUrut = intval($lastNoUrut)+1;

        $fakturPenjualan = 'J' . date('dmy', strtotime($tgl)) . sprintf("%04s", $nextNoUrut);

        return $fakturPenjualan;
    }

    public function dataDetail(){
        if($this->request->isAjax()){
        
            $nofaktur = $this->request->getPost('nofaktur');
            $tempSale = $this->db>tabel('temp_penjualan');
            $queryTampil = $tempSale->select('detjual_id as id, detjual_kodebarcode as kode, pr_name, detjual_hargajual as hargajual, detjual_jml as qty, detjual_subtotal as subtotal')->join('produk', 'detjual_kodebarcode=idbarcode')->where('detjual_faktur', $nofaktur)->orderBy('detjual_id', 'asc');
    
            $data = [
                'datadetail' => $queryTampil->get(),
                
            ];
    
            $msg = [
                'data' => view('sale/viewdetail', $data),
            ];
    
        }
    }

    public function viewDataProduk(){
        if($this->request->isAjax()){
            $keyword = $this->request->getPost('keyword');
            $data = [
                'keyword' => $keyword,
            ];

            $msg = [
                'viewmodal' => view('sale/viewmodalproduk', $data),
            ];
            echo json_encode($msg);
        }
    }

    public function listDataProduk(){
        if($this->request->isAjax()){
            $keywordkode = $this->request->getPost('keywordkode');
            $request = Services::request();
            $m_icd = new Modeldataproduk($request);
            if ($request->getMethod(true) === 'POST') {
                $lists = $m_icd->get_datatables($keywordkode);
                $data = [];
                $no = $request->getPost('start');
                foreach ($lists as $list) {
                    $no++;
                    $row = [];
                    $row[] = $no;
                    $row[] = $list->idbarcode;
                    $row[] = $list->pr_name;
                    $row[] = $list->ctg_name;
                    $row[] = number_format($list->readystock,0,',','.');
                    $row[] = number_format($list->harga_jual,0,',','.');
                    $row[] = "<button type= \"button\" class = \"btn btn-sm btn-primary\"  onclick = \"pilihitem('".$list->idbarcode."','".$list->pr_name."')\">Pilih<\button>";
                    $data[] = $row;
                }
                $output = [
                    "draw" => $request->getPost('draw'),
                    "recordsTotal" => $m_icd->count_all($keywordkode),
                    "recordsFiltered" => $m_icd->count_filtered($keywordkode),
                    "data" => $data,
                ];
                echo json_encode($output); 
            }
        }
    }

    public function simpanTemp(){
        if($this->request->isAjax()){
            $kodebarcode = $this->request->getPost('kodebarcode');
            $namaproduk = $this->request->getPost('namaproduk');
            $jumlah = $this->request->getPost('jumlah');
            $nofaktur = $this->request->getPost('nofaktur');

            $wueryCekProduk = $this->db->table('produk')->like('idbarcode', $kodebarcode)->orLike('pr_name', $kodebarcode)->get();
            $totalData = $queryCekProduk->getNumRows();

            if($totalData > 1){
                $msg = [
                    'totaldata' => 'banyak',
                ];
            }else{
                $msg = [
                    'totaldata' => 'satu',
                ];
            } 
            echo json_encode($msg);
            
        }
    }
}
