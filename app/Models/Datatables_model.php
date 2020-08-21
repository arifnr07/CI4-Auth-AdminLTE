<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Datatables_model extends Model
{
    // variable
    var $column_order = array(null, 'tanggal', 'nopol', 'truck', 'driver', 'id_sj', 'client', 'kota', 'keterangan', 'biaya', 'id_ssj', 'ket_tambah', 'ket_claim', 'sub_ket', 'custom_data', null); //set column field database for datatable orderable
    var $column_search = array('tanggal', 'nopol', 'truck', 'driver', 'id_sj', 'client', 'kota', 'keterangan', 'biaya', 'id_ssj', 'ket_tambah', 'ket_claim', 'sub_ket', 'custom_data'); //set column field database for datatable searchable just firstname , lastname , address are searchable

    //var $order = array('id' => 'desc'); // default order
    var $order = array('tanggal DESC,id DESC' => '');  //multi order

    public $id = 'id';
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'email'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->dt = db_connect();
        $this->db = $this->dt->table($this->table);
    }
    // load query, order and search
    private function _get_datatables_query()
    {
        $order = $this->order;
        $select = 'surat_jalan.id,tanggal, nopol,
		truck,driver, id_sj, client, kota, keterangan, biaya, id_ssj,
		ket_tambah, ket_claim, sub_ket, tabungan, tambah, claim, custom_data, checkbox,
		username, surat_jalan.updated_at';
        $this->db->select($select);
        //Join

        //Date Range Filter
        if ($this->request->getPost('min')) {
            $this->db->where('tanggal >=', $this->request->getPost('min'));
        }
        if ($this->request->getPost('max')) {
            $this->db->where('tanggal <=', $this->request->getPost('max'));
        }
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->db->groupStart();
                    $this->db->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->db->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->db->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->orderBy(key($order), $order[key($order)]);
        }
    }
    // get and load data query
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->db->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->db->get();
        return $query->getResult();
    }
    // count filter data
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->db->countAllResults();
    }
    // count all
    public function count_all()
    {
        return $this->db->countAll();
    }
}
