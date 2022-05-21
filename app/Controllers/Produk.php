<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Produk extends BaseController
{
    public function __construct()
    {
        $this->produk  = new ProductModel();
        $this->db = db_connect();
    }
    public function index()
    {

        // $data = [
        //     'dataproduk' => $this->produk->join('kategori', 'produk_katid=katid')
        //         ->join('satuan', 'produk_satid=satid')
        //         ->paginate(10, 'produk'),
        //     'pager' => $this->produk->pager,
        //     // 'nohalaman' => $noHalaman,
        //     // 'cari' => $cari
        // ];
        return view('product/data');
    }

    public function add()
    {
        return view('product/add');
    }

    public function ambilDataKategori()
    {
        if ($this->request->isAJAX()) {
            $datakategori = $this->db->table('kategori')->get();

            $isidata = "<option value='' selected>-Pilih-</option>";

            foreach ($datakategori->getResultArray() as $row) :
                $isidata .= '<option value="' . $row['ctg_id'] . '">' . $row['ctg_name'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isidata
            ];
            echo json_encode($msg);
        }
    }

    public function ambilDataSatuan()
    {
        if ($this->request->isAJAX()) {
            $datasatuan = $this->db->table('satuan')->get();

            $isidata = "<option value='' selected>-Pilih-</option>";

            foreach ($datasatuan->getResultArray() as $row) :
                $isidata .= '<option value="' . $row['u_id'] . '">' . $row['u_name'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isidata
            ];
            echo json_encode($msg);
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $kodebarcode    = $this->request->getVar('barcode');
            $namaproduk     = $this->request->getVar('namaproduk');
            $stok           = $this->request->getVar('stok');
            $kategori       = $this->request->getVar('kategori');
            $satuan         = $this->request->getVar('satuan');
            $hargabeli      = str_replace(',', '', $this->request->getVar('hargabeli'));
            $hargajual      = str_replace(',', '', $this->request->getVar('hargajual'));

            $validation =  \Config\Services::validation();

            $doValid = $this->validate([
                'kodebarcode' => [
                    'label' => 'Kode Barcode',
                    'rules' => 'is_unique[produk.kodebarcode]|required',
                    'errors' => [
                        'is_unique' => '{field} sudah ada, coba dengan kode yang lain',
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'namaproduk' => [
                    'label' => 'Nama Produk',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'stok' => [
                    'label' => 'Stok Tersedia',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'satuan' => [
                    'label' => 'Satuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'hargabeli' => [
                    'label' => 'Harga Beli',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh Kosong',
                    ]
                ],
                'hargajual' => [
                    'label' => 'Harga Jual',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh Kosong'
                    ]
                ],
            ]);

            if (!$doValid) {
                $msg = [
                    'error' => [
                        'errorKodeBarcode' => $validation->getError('barcode'),
                        'errorNamaProduk' => $validation->getError('namaproduk'),
                        'errorStok' => $validation->getError('stok'),
                        'errorKategori' => $validation->getError('kategori'),
                        'errorSatuan' => $validation->getError('satuan'),
                        'errorHargaBeli' => $validation->getError('hargabeli'),
                        'errorHargaJual' => $validation->getError('hargajual'),
                        'errorUpload' => $validation->getError('uploadgambar')
                    ]
                ];
            } 

                $this->produk->insert([
                    'barcode' => $barcode,
                    'namaproduk' => $namaproduk,
                    'produk_satid' => $satuan,
                    'produk_katid' => $kategori,
                    'stok_tersedia' => $stok,
                    'hargabeli' => $hargabeli,
                    'hargajual' => $hargajual,
                    'gambar' => $pathGambar
                ]);

                $msg = [
                    'sukses' => 'Berhasil ditambahkan'
                ];
            }

            echo json_encode($msg);
        }
    }
}