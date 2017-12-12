<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {
	
	// Index login
	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
    }

    public function index()
    {
        $this->load->view('frontend/v_error404');
    }
}