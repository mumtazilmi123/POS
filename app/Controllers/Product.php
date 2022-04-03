<?php

namespace App\Controllers;

use App\Models\ProductModel;
// use App\Models\CategoryModel;

class Product extends BaseController
{
    public function __construct()
    {
        $this->produk  = new ProductModel();
        // $this->kategori= new CategoryModel();
        $this->db = db_connect();
    }
    public function index()
    {
        $tombolCari = $this->request->getPost('tombolproduk');

        if (isset($tombolCari)) {
            $cari = $this->request->getPost('cariproduk');
            session()->set('cariproduk', $cari);
            redirect()->to('/product/index');
        } else {
            $cari = session()->get('cariproduk');
        }

        $dataproduk = $cari ? $this->produk ->cariData($cari) : $this->produk ;

        $noHalaman = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;
        $data = [
            'dataproduk' => $dataproduk->paginate(6, 'product'),
            'pager' => $this->produk ->pager,
            'nohalaman' => $noHalaman,
            'cari' => $cari
        ];

        return view('product/data');
    }
    
    public function add(){
        return view('product/add');
    }

    public function ambilDataKategori(){
        if($this->request->isAjax()){
            $datakategori = $this->db->table('categories')->get();

            $isidata = "<option value='' selected>-Pilih Data-</option>";

            foreach ($datakategori->getResultArray() as $row){
                $isidata .= '<option value="' . $row['ctg_id'] .'">' . $row ['ctg_name'] . '</option>';

            }
            $msg=[
                'data' => $isidata
            ];
            echo json_encode($msg);
        }
    }

    public function ambilDataSatuan(){
        if($this->request->isAjax()){
            $datasatuan = $this->db->table('units')->get();

            $isidata = "<option value='' selected>-Pilih Data-</option>";

            foreach ($datasatuan->getResultArray() as $row){
                $isidata .= '<option value="' . $row['u_id'] .'">' . $row ['u_name'] . '</option>';

            }
            $msg=[
                'data' => $isidata
            ];
            echo json_encode($msg);
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $barcode    = $this->request->getVar('barcode');
            $namaproduk = $this->request->getVar('namaproduk');
            $stok       = $this->request->getVar('stok');
            $kategori   = $this->request->getVar('kategori');
            $satuan     = $this->request->getVar('satuan');
            $hargabeli  = str_replace(',', '', $this->request->getVar('hargabeli'));
            $hargajual  = str_replace(',', '', $this->request->getVar('hargajual'));

            $validation =  \Config\Services::validation();

            $doValid = $this->validate([
                'barcode'           => [
                    'label'         => 'Barcode',
                    'rules'         => 'is_unique[products.idbarcode]|required',
                    'errors'        => [
                        'is_unique' => '{field} sudah ada, coba dengan kode yang lain',
                        'required'  => '{field} tidak boleh kosong'
                    ]
                ],
                'namaproduk'       => [
                    'label'        => 'Nama Produk',
                    'rules'        => 'required',
                    'errors'       => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'stok'             => [
                    'label'        => 'Stok Tersedia',
                    'rules'        => 'required',
                    'errors'       => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'kategori'         => [
                    'label'        => 'Kategori',
                    'rules'        => 'required',
                    'errors'       => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'satuan'           => [
                    'label'        => 'Satuan',
                    'rules'        => 'required',
                    'errors'       => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'hargabeli'        => [
                    'label'        => 'Harga Beli',
                    'rules'        => 'required',
                    'errors'       => [
                        'required' => '{field} tidak boleh Kosong',
                    ]
                ],
                'hargajual'        => [
                    'label'        => 'Harga Jual',
                    'rules'        => 'required',
                    'errors'       => [
                        'required' => '{field} tidak boleh Kosong'
                    ]
                ],
                'uploadgambar' => [
                    'label'    => 'Upload Gambar',
                    'rules'    => 'mime_in[uploadgambar,image/png,image/jpg,image/jpeg]|ext_in[uploadgambar,png,jpg,jpeg]|is_image[uploadgambar]',
                ]
            ]);

            if (!$doValid) {
                $msg = [
                    'error' => [
                        'errorBarcode'      => $validation->getError('barcode'),
                        'errorNamaProduk'   => $validation->getError('namaproduk'),
                        'errorStok'         => $validation->getError('stok'),
                        'errorKategori'     => $validation->getError('kategori'),
                        'errorSatuan'       => $validation->getError('satuan'),
                        'errorHargaBeli'    => $validation->getError('hargabeli'),
                        'errorHargaJual'    => $validation->getError('hargajual'),
                        'errorUpload'       => $validation->getError('uploadgambar')
                    ]
                ];
            } else {
                $uploadGambar = $_FILES['uploadgambar']['name'];

                if ($uploadGambar != NULL) {
                    $namaFileGambar = "$barcode-$namaproduk";
                    $fileGambar = $this->request->getFile('uploadgambar');
                    $fileGambar->move('assets/upload', $namaFileGambar . '.' . $fileGambar->getExtension());

                    $pathGambar = '.assets/upload/' . $fileGambar->getName();
                } else {
                    $pathGambar = '';
                }

                $this->produk->insert([
                    'idbarcode'   => $barcode,
                    'pr_name'     => $namaproduk,
                    'pr_uid'      => $satuan,
                    'pr_ctgid'    => $kategori,
                    'readystock'  => $stok,
                    'purchase_prc'=> $hargabeli,
                    'sell_prc'    => $hargajual,
                    'img'         => $pathGambar
                ]);

                $msg = [
                    'sukses' => 'Berhasil ditambahkan'
                ];
            }

            echo json_encode($msg);
        }
    }
}