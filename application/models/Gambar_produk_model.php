<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gambar_produk_model extends MY_Model
{
    protected $_table_name      = 'gambar_produk';
    protected $_order_by        = 'id_gambar_produk';
    protected $_order_by_type   = 'DESC';
    protected $_primary_key     = 'id_gambar_produk';

    function __construct()
    {
        parent::__construct();
    }

    function insert_gambar_produk($data)
    {
        $this->db->insert($this->_table_name, $data);
    }

    function get_by_token($token)
    {
        $this->db->where('token', $token);
        return $this->db->get($this->_table_name)->row();
    }

    function get_by_id_produk($id_produk)
    {
        $this->db->where('id_produk', $id_produk);
        return $this->db->get($this->_table_name)->result();
    }
}
