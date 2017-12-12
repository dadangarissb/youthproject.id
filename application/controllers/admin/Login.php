<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	// Index login
	function __construct()
    {
        parent::__construct();
        $this->load->model(array('Login_model'));
        $this->load->library(array('form_validation','session'));
        $this->load->helper(array('url','html'));
    }

    public function index() 
    {
        $this->load->view('admin/v_admin_login_form');
    }

    public function login_action(){
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        }
        
        else{
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        // $hak_akses  = $this->input->post('hak_akses');

        $data = array(
            'username_admin' => $username,
            'password'       => $password,
            // 'hak_akses'      => $hak_akses,
            );
        $cek = $this->Login_model->cek_login_admin($data);

        if(isset($cek))
        {
            $data_session = array(
                'username_admin' => $username,
                'hak_akses'      => $cek->hak_akses,
                'nama_admin'     => $cek->nama_admin,
                'loged_in' => TRUE,
                );
            if ($cek->hak_akses=='admin') {
            $this->session->set_userdata('sess_admin',$data_session);
            redirect(base_url('admin/Dashboard'));
            }
            elseif ($cek->hak_akses=='manajer') {
            $this->session->set_userdata('sess_manajer',$data_session);
            redirect(base_url('admin/Dashboard_manajer'));
            }
        }
        
        else{
            $this->session->set_flashdata('message','(<span class="text-danger">Username atau Password anda salah ! ) <br> Silahkan Coba Lagi');
            redirect(base_url("admin/Login"));
        }
    }
    }

    	
	// Logout di sini
	public function logout() {
		session_destroy();
        redirect(base_url('admin/Login')); 
	}	


}