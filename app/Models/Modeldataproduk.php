<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class Modeldataproduk extends Model
{
    protected $table = 'produk';
    protected $column_order = array(null, 'idbarcode', 'pr_name', 'ctg_name', 'readystock', 'harga_jual', null);
    protected $column_search = array('idbarcode', 'pr_name');
    protected $order = array('pr_name' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
    }
    
    private function _get_datatables_query($keywordkode)
    {
        // if(strlen($keywordkode)==0){
            // }else{
                //     $this->dt = $this->db->table($this->table)->join('kategori', 'ctg_id=pr_ctgid')->like('idbarcode', $keywordkode)->orLike('pr_name', $keywordkode)->get();
                // }
        $this->dt = $this->db->table($this->table)->join('kategori', 'ctg_id=pr_ctgid')->get();
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($keywordkode)
    {
        $this->_get_datatables_query($keywordkode);
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function count_filtered($keywordkode)
    {
        $this->_get_datatables_query($keywordkode);
        return $this->dt->countAllResults();
    }

    public function count_all($keywordkode)
    {
        $tbl_storage = $this->db->table($this->table)->join('kategori', 'ctg_id=pr_ctgid');
        return $tbl_storage->countAllResults();
    }
}