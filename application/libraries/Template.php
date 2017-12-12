<?php
class Template {
	
	protected $_ci;
	
	function __construct(){
		$this ->_ci=&get_instance();
	}
	
	function admin($template,$data=null){
		$data['_content']=
		$this->_ci->load->view($template,$data,true);
		//$data['_user-panel']=
		//$this->_ci->load->view('template/user_panel',$data,true);
		$data['_header']=
		$this->_ci->load->view('admin/template/header',$data,true);
		//$data['_section']=
		//$this->_ci->load->view('template/section',$data,true);
		$data['_sidebar']=
		$this->_ci->load->view('admin/template/sidebar',$data,true);
		$data['_footer']=
		$this->_ci->load->view('admin/template/footer',$data,true);
		$this->_ci->load->view('admin/template/template_admin.php',$data);
	}
}