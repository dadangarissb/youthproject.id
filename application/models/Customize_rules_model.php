<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customize_rules_model extends MY_Model
{

    protected $_table_name  = 'customize_rules';
    protected $_order_by    = 'id_customize_rules';
    protected $_order_by_type = 'DESC';
    protected $_primary_key = 'id_customize_rules';

    function __construct()
    {
        parent::__construct();
    }

    function cek_duplicate_entry($id_produk,$label)
    {
        $this->db->where('id_produk', $id_produk);
        $this->db->where('label_customize', $label);
        return $this->db->get($this->_table_name)->result();
    }

    function get_by_id_produk($id_produk)
    {
        $this->db->where('id_produk',$id_produk);
        return $this->db->get($this->_table_name)->result();
    }
}
