<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller 
{

	function __construct()
    {
        parent::__construct();
        $this->load->model(array('Member_model','Slider_model'));
        $this->load->library(array('template','upload','image_lib'));
        $this->session->userdata('sess_admin');
        if(!$this->session->userdata('sess_admin') ){
            redirect(base_url('admin/Login'));
        }
    }

    function index()
    {
        $count_member = $this->Member_model->count_member();
        $count_jenis_produk = $this->Subkategori_model->count_subkategori();
        $slider         =$this->Slider_model->get_slider();
        $data_slider    =$this->Slider_model->get_slider_list();

        $data['count_member'] = $count_member;
        $data['count_jenis_produk'] =$count_jenis_produk;
        $data['slider']         =$slider;
        $data['data_slider']    =$data_slider;


        $this->template->admin('admin/v_dashboard',$data);
    }

    function add_slider_action()
    {
        $config['upload_path']='./uploads/images/slider/';
        $config['allowed_types']='jpg|png|gif|jpeg';
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);
        $this->upload->do_upload('gambar_slider');

        
        $slider =$this->upload->data();
        
        $config2['image_library'] = 'gd2';
        $config2['source_image'] = './uploads/images/slider/'.$slider['file_name'];
        // $config2['create_thumb'] = TRUE;
        $config2['maintain_ratio'] = FALSE;
        $config2['width']         = 1200;
        $config2['height']       = 563;

        $this->image_lib->initialize($config2);
        $this->image_lib->resize();

        if ($slider['file_name']) 
        {
            $data=array
            (   
                'nama_slider' =>  $this->input->post('nama_slider'),
                'gambar_slider'   =>  $slider['file_name'],
                'status_slider' =>  'aktif',
            );

            $this->Slider_model->insert($data);
            redirect (base_url('admin/Dashboard'));
        }
        else 
        {
            $data['modal_slider'] = 'aktif';

            $this->session->set_flashdata('message_danger', 'Upss, file anda tidak dapat di upload. Mungkin ukuran file terlalu besar.');
            redirect (base_url('admin/Dashboard'));
        }
    }

    function slider_status($id_slider,$status)
    {
      $data=array
      (
        'status_slider' => $status,
      );
      $this->Slider_model->update($id_slider,$data);
      redirect (base_url('admin/Dashboard'));
    }

    function delete_slider($id_slider)
    {
      $row=$this->Slider_model->get_by_id($id_slider);
      $delete=$this->Slider_model->delete_slider($id_slider);
      if ($delete) {
        unlink('./images/slider images/'.$row->gambar_slider);
        redirect (base_url('admin/Dashboard'));
      }
      
    }

}