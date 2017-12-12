<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subkategori_model extends CI_Model
{

    protected $_table_name = 'tbl_subkategori';
    protected $id    = 'id_subkategori';
    protected $order = 'DESC';

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

    function count_subkategori()
    {
        $this->db->where('status_subkategori','aktif');
        $this->db->from('subkategori');
        return $this->db->count_all_results();
    }

    function cek_duplicate_entry($nama_subkategori)
    {
        $this->db->where('nama_subkategori', $nama_subkategori);
        return $this->db->get($this->_table_name)->result();
    }

    function get_all()
    {
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        return $this->db->get($this->_table_name)->result();
    }

    function get_by_id($id_subkategori)
    {
        $this->db->where($this->id_subkategori, $id_subkategori);
        return $this->db->get($this->_table_name)->row();
    }
}
