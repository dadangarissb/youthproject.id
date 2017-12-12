<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member_model extends CI_Model
{

    public $_table_name = 'member';
    public $id = 'id_member';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
        $this->load->library('email'); // load email library
    }

    // get all
    function get_all()
    {   
        $this->db->join('provinsi','member.id_provinsi=provinsi.id_provinsi');
        $this->db->join('kabupaten','member.id_kabupaten=kabupaten.id_kabupaten');
        $this->db->join('kecamatan','member.id_kecamatan=kecamatan.id_kecamatan');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function count_member()
    {
        $this->db->where('status_member','aktif');
        $this->db->from('member');
        return $this->db->count_all_results();
    }

    // get data by id
    function get_by_id($id_member)
    {     
        $this->db->where('member.id_member', $id_member);
        return $this->db->get($this->_table_name)->row();
    }

     //activate user account
    function verify_email_id($id_member)
    {
        $data = array('status_member' => 'aktif');
        $this->db->where('id_member', $id_member);
        $query= $this->db->update($this->_table_name, $data);
        return $query;
    }

    // insert data
    // function insert($data)
    // {
    //     $query=$this->db->insert($this->table, $data);
    //     return $query;
    // }

    // // update data
    // function update($id, $data)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->update($this->table, $data);
    // }

    function get_by_email($email)
    {
        $this->db->where('email', $email);
        $this->db->where('status_member', 'aktif');
        $query=$this->db->get($this->_table_name);

         if ($query->num_rows() > 0) {
            return 1;
        }
        else{
            return 0;
        }
    }

    function insert($data)
    {
        $query=$this->db->insert($this->_table_name, $data);
        return $query;
    }



}
?>


