<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packaging extends MY_Controller 
{

	function __construct()
    {
        parent::__construct();
        $this->load->model(array('Packaging_model'));
        $this->load->library(array('template','upload','form_validation'));
        if(!$this->session->userdata('sess_admin') ){
            redirect(base_url('admin/Login'));
        }
        
    }

    public function index($modal_form='nonaktif'){
        $packaging       = $this->Packaging_model->get();

        $data['packaging']    = $packaging;
        $data['modal_form']   = $modal_form;

        $this->template->admin('admin/v_packaging_list',$data);
    }

    public function create_action()
    {
        $this->form_validation->set_rules('nama_packaging','Nama kemasan','required');
        $this->form_validation->set_rules('harga_packaging','Harga Kemansan','required');
    
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
       
        if ($this->form_validation->run()==FALSE){
            $this->index($modal_form='aktif'); // file form_view.php
        }
       
        else {     
            if (!file_exists('uploads/images/packaging')) {
                $folder=mkdir('uploads/images/packaging', 0777, true);
            }

            $config['upload_path']='uploads/images/packaging';
            $config['allowed_types']='jpg|png|gif|jpeg';
            $config['encrypt_name'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 600;
            $config['height'] = 600;

            $this->upload->initialize($config);
            $this->upload->do_upload('gambar_packaging');

            $packaging      =$this->upload->data();

            if ($packaging) {
                $post=$this->input->post();
                $data=array(
                    'nama_packaging'  => $post['nama_packaging'],
                    'harga_packaging' => $post['harga_packaging'],
                    'gambar_packaging'=> $packaging['file_name'],
                    'status_packaging'=> 'aktif',
                     );
            $success=$this->Packaging_model->insert($data);
            if ($success) 
            {
                $this->session->set_flashdata('message_success', 'Berhasil menambah data kemasan !');
                redirect(base_url('admin/Packaging'));
            }
            else
            {
                $this->session->set_flashdata('message_failed', 'Upss, terjadi masalah.Coba lagi !');
                redirect(base_url('admin/Packaging'));
            }
            }
        } 
    }

    public function status_packaging($id_packaging,$value)
    {
        $data['status_packaging'] = $value;

        $parameter['id_packaging'] = $id_packaging;

        $this->Packaging_model->update($data,$parameter);

        $this->session->set_flashdata('message_success', 'Data berhasil diperbarui !');
        redirect(base_url('admin/Packaging'));
    }

}