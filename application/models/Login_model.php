<?php 

class Login_model extends CI_Model{	

	protected $_table_name = 'tbl_member';

    function __construct()
    {
        parent::__construct();
    }

	function cek_login($data){		
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);
		$query=$this->db->get('member')->row();

		 if ($query) {
            return $query;
        }
	}	

	function cek_login_admin($data){		
		$this->db->where('username_admin', $data['username_admin']);
		$this->db->where('password', $data['password']);
		// $this->db->where('hak_akses', $data['hak_akses']);
		$query=$this->db->get('admin')->row();

		 if ($query) {
            return $query;
        }
	}	

}
