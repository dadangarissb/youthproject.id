<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	
	// Index login
	function __construct()
    {
        parent::__construct();
        $this->load->model(array('Login_model'));
        $this->load->library(array('form_validation','session'));
        $this->load->helper(array('url','html'));
    }

    public function login() 
    {
        $this->header();
        $this->load->view('frontend/v_login_form');
        $this->footer();
    }

    public function login_action(){
        $this->_rules();

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->login();
        }
        else
        {
        $data = array(
            'email' => $email,
            'password' => md5($password).substr($email, 0,2),
            );

        $cek = $this->Login_model->cek_login($data);

        if(isset($cek))
        {
            if ($cek->status_member=="aktif") 
            {
                $data_session['id_member'] = $cek->id_member;
                $data_session['logged_in'] = TRUE;

                $page_url = $this->session->userdata('page_url');
                $this->session->set_userdata('sess_member',$data_session);
                if ($page_url) 
                {
                    redirect($page_url);
                }
                else
                {
                    redirect(base_url());
                }
            }

            elseif ($cek->status_member=="belum aktif") 
            {
                $this->session->set_flashdata('msg_email_belum_aktif','Oops! Anda belum melakukan verifikasi email. Jika link verifikasi belum terkirim ke email anda, silahkan kirim ulang.');
                $this->session->set_flashdata('to_email',$cek->email);
                $this->session->set_flashdata('nama_member',$cek->nama_member);
                $this->session->set_flashdata('id_member',$cek->id_member);
                redirect(site_url('member/login'));
            }

            elseif ($cek->status_member=="nonaktif") 
            {
                $this->session->set_flashdata('msg_error_email_non_aktif','Oops! Akun anda anda dalam status non aktif!');
                redirect(site_url('member/login'));
            }
        }

        else{
            $this->session->set_flashdata('error_login','<span class="text-danger">Email atau Password anda salah, Silahkan Coba Lagi !');
            redirect(base_url('member/login'));
        }

        
        
    }
    }

    
	
	// Logout di sini
	public function logout() {
		session_destroy();
        redirect(base_url()); 
	}	



    public function _rules() 
    {
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


}