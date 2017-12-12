<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk_packaging_model extends MY_Model
{
    protected $_table_name      = 'produk_packaging';
    protected $_order_by        = 'id_produk_packaging';
    protected $_order_by_type   = 'DESC';
    protected $_primary_key     = 'id_produk_packaging';

    function __construct()
    {
        parent::__construct();
    }

    function cek_duplicate_entry($id_produk,$id_packaging)
    {
        $this->db->where('id_produk', $id_produk);
        $this->db->where('id_packaging', $id_packaging);
        return $this->db->get($this->_table_name)->result();
    }
}