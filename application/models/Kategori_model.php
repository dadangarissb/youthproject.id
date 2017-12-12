<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    public $_table_name = 'tbl_kategori';
    public $id    = 'id_kategori';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->_table_name, $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    function cek_duplicate_entry($nama_kategori)
    {
        $this->db->where('nama_kategori', $nama_kategori);
        return $this->db->get($this->_table_name)->result();
    }

    function get_all()
    {
        return $this->db->get($this->_table_name)->result();
    }

    function get_all_for_footer()
    {
        $this->db->limit(6);
        return $this->db->get($this->_table_name)->result();
    }
}
