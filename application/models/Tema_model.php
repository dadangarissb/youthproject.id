<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tema_model extends MY_Model
{

    public $_table_name = 'tbl_tema';
    public $id    = 'id_tema';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function cek_duplicate_entry($nama_tema)
    {
        $this->db->where('nama_tema', $nama_tema);
        return $this->db->get($this->_table_name)->result();
    }

    function get_all()
    {
        return $this->db->get($this->_table_name)->result();
    }
}
