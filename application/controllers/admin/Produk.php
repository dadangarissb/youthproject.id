<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller 
{

	function __construct()
    {
        parent::__construct();
        $this->load->model(array('Produk_model','Customize_rules_model','Kategori_model','Subkategori_model','Gambar_produk_model','Tema_model','Packaging_model','Produk_packaging_model'));
        $this->load->library(array('template','CKeditor','upload','image_lib'));
        if(!$this->session->userdata('sess_admin') ){
            redirect(base_url('admin/Login'));
        }
        
    }

    public function index($tab_aktif='tab_produk'){
        $kategori       = $this->Kategori_model->get_all();
        $subkategori    = $this->Subkategori_model->get_all();
        $produk         = $this->Produk_model->get_all();
        $tema           = $this->Tema_model->get_all();

        $data=array(
            'aktif'     => $tab_aktif,
            );
        $data['produk']         = $produk;
        $data['tema']           = $tema;
        $data['kategori']       = $kategori;
        $data['dd_kategori']    = $kategori;
        $data['count_subkategori']    = $subkategori;
        $data['subkategori']    = $subkategori;
        $this->template->admin('admin/v_produk_list',$data);
    }

    //untuk melihat detail produk
    public function detail($id_produk)
    {
        $produk =$this->Produk_model->get_detail($id_produk);
        $gambar =$this->Gambar_produk_model->get_by_id_produk($id_produk);

        $data['produk'] = $produk;
        $data['gambar_produk'] = $gambar;

        if ($produk) {
           $this->template->admin('admin/v_detail_produk',$data);
        } else {
           $this->session->set_flashdata('message_danger', 'Data yang anda pilih tidak ada');
           redirect(base_url('admin/Produk'));
        }
        
    }

    public function insert(){
        $subkategori    = $this->Subkategori_model->get_all();
        $tema           = $this->Tema_model->get_all();

        $width = '100%';
        $height = '200px';
        //configure base path of cek_kategoriditor folder
        $this->ckeditor->basePath = base_url().'templates/backend/plugins/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        // $this->ckeditor->config['toolbar'] =  array(
        //         array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
        //                                             );
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = $width;
        $this->ckeditor->config['height'] = $height;

        $data['action']            = base_url('admin/Produk/insert_action');
        $data['method']            = 'POST';
        $data['dd_subkategori']    = $subkategori;
        $data['tema']              = $tema;
        $this->template->admin('admin/v_form_produk', $data);
    }

    public function insert_action()
    {
        $post=$this->input->post();

        $date=strtoupper(substr(date("M"), 0,1));
        $day=strtoupper(substr(date("D"), 0,2));

        $config['upload_path']='./uploads/images/thumbnails/';
        $config['allowed_types']='jpg|png|gif|jpeg';
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);
        $this->upload->do_upload('thumbnail');

        $thumbnail      =$this->upload->data();

        $config2['image_library'] = 'gd2';
        $config2['source_image'] = './uploads/images/thumbnails/'.$thumbnail['file_name'];
        // $config2['create_thumb'] = TRUE;
        $config2['maintain_ratio'] = FALSE;
        $config2['width']         = 800;
        $config2['height']       = 800;

        $this->image_lib->initialize($config2);
        $this->image_lib->resize();


        $tema =$this->input->post('nama_tema');

        $nama_produk = $post['nama_produk']." ".$date.$day.date("is");

        if ($thumbnail) {
            $data=array(
                'nama_produk'     => $nama_produk,
                'slug'            => strtolower(str_replace(' ', '-', $post['slug'])),
                'id_subkategori'  => $post['id_subkategori'],
                'tema'            => implode(', ', $tema),
                'berat_produk'    => $post['berat_produk'],
                'harga_produk'    => $post['harga_produk'],
                'thumbnail'       => $thumbnail['file_name'],
                'deskripsi_produk'=> $post['deskripsi_produk'],
                'status_produk'   => 'aktif',
                'keyword'         => $post['keyword'],
                 );
            $id_produk=$this->Produk_model->insert($data);
            $this->session->set_flashdata('message_success', 'Berhasil menambah data produk !');
            redirect(base_url('admin/produk/upload_gambar_produk/'.$id_produk));
        }
    }

    function upload_gambar_produk($id_produk)
    {
        $packaging     = $this->Packaging_model->get();

        $data['id_produk'] = $id_produk;
        $data['packaging'] = $packaging;

        $this->template->admin('admin/gambar_produk_form', $data);
    }

    //Untuk proses upload foto
    function proses_upload($id_produk ){
        $config['upload_path']   = FCPATH.'/uploads/images/gambar_produk/';
        $config['allowed_types']='jpg|png|gif|jpeg|ico';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);

        $this->upload->initialize($config);

        if($this->upload->do_upload('userfile')){
            //$token=$this->input->post('token_foto');
            $id_produk  =$this->uri->segment(4);
            $nama       =$this->upload->data('file_name');
            $token      =$this->input->post('token_foto');
            $data       =array(
                        'nama_gambar_produk' => $nama,
                        'id_produk' => $id_produk,
                        'token'     => $token,
                        );

            $this->Gambar_produk_model->insert_gambar_produk($data);
        }
    }

    //Untuk menghapus foto
    function remove_gambar()
    {
        //Ambil token foto
        $token=$this->input->post('token');

        $gambar=$this->Gambar_produk_model->get_by_token($token);

        if($gambar){
            $nama_gambar_produk=$gambar->nama_gambar_produk;
            if(file_exists($file=FCPATH.'/uploads/images/gambar_produk/'.$nama_gambar_produk)){
                unlink($file);
            }
            $this->Gambar_produk_model->delete($gambar->id_gambar_produk);

        }
        echo "{}";
    }

    public function update_status_produk($id_produk,$value)
    {
        $row = $this->Produk_model->get($id_produk);

        if ($row) {
            $data['status_produk'] = $value;

            $this->Produk_model->update($data,array('id_produk' =>$row->id_produk));
            $this->session->set_flashdata('message_success', 'Berhasil update status produk !');
            redirect(base_url('admin/produk/detail/'.$id_produk));
        }
        
    }

    public function add_packaging_product()
    {
        $id_packaging   = $this->input->post('id_packaging');
        $id_produk      = $this->input->post('id_produk');

        if ($id_packaging) 
        {
            foreach ($id_packaging as $id_packaging) 
            {
                $cek_duplicate = $this->Produk_packaging_model->cek_duplicate_entry($id_produk, $id_packaging);

                if ($cek_duplicate ==NULL) {
                    $data_packaging=array(
                        'id_packaging'  => $id_packaging,
                        'id_produk'     => $id_produk,
                        );
                    $this->Produk_packaging_model->insert($data_packaging);
                }
            }
        }
        redirect(base_url('admin/Produk/insert_customize/'.$id_produk));
    }

    public function insert_customize($id_produk)
    {
        $row    = $this->Produk_model->get($id_produk);

        $data=array(
            'action'    => base_url('admin/produk/customize-action'),
            'method'    => 'POST',
            'id_produk' => $id_produk,
            );

        $customize      = $this->Customize_rules_model->get_by_id_produk($id_produk);

        $data['customize']  = $customize;
        $data['preview']    = $row;

        $this->template->admin('admin/v_form_customize', $data);
    }

    public function insert_customize_action()
    {
        $post=$this->input->post();
        $id_produk = $post['id_produk'];

        $label_customize = $post['label_customize'];
        $cek_duplicate = $this->Customize_rules_model->cek_duplicate_entry($id_produk,$label_customize);
        if ($cek_duplicate ==NULL) {
        $data=array(
             'label_customize'   => $label_customize,
             'placeholder_customize'   => $post['placeholder_customize'],
             'type_customize'    => $post['type_customize'],
             'id_produk'         => $id_produk,
             );
        $this->Customize_rules_model->insert($data);
        }
        $this->session->set_flashdata('message_success', 'Berhasil menambah customize !');
        redirect(base_url('admin/produk/customize/'.$id_produk));
    }

    //untuk menghapus form customize pada saat preview
    public function delete_customize($id_customize_rules)
    {
        $row= $this->Customize_rules_model->get($id_customize_rules); 
        

        if ($row) {
            $this->Customize_rules_model->delete($id_customize_rules);
            $this->session->set_flashdata('message_delete', 'Data berhasil dihapus !');
            redirect(base_url('admin/produk/customize/'.$row->id_produk));
        }
    }

    public function finish_customize($id_produk)
    {
        $this->session->set_flashdata('message_success', 'Produk baru telah berhasil ditambahkan !');
        redirect(base_url('admin/Produk'));
    }

    public function insert_kategori()
    {
        $post=$this->input->post();
        $nama_kategori = $post['nama_kategori'];

        $config['upload_path']='./uploads/images/gambar_kategori/';
        $config['allowed_types']='jpg|png|gif|jpeg';
        $config['encrypt_name'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['width']    = 600;
        $config['height']   = 600;

        $this->upload->initialize($config);
        $this->upload->do_upload('gambar_kategori');

        $gambar      =$this->upload->data();

        $data=array(
                'nama_kategori'     =>$nama_kategori,
                'gambar_kategori'   =>$gambar['file_name'],
            );
        $cek_duplicate = $this->Kategori_model->cek_duplicate_entry($nama_kategori);
    
        if($cek_duplicate==NULL)
        {
            if($this->Kategori_model->insert($data))
            {  
            redirect(base_url('admin/Produk/index/tab_kategori'));
            }
        }
        else
        {
            redirect(base_url('admin/Produk/index/tab_kategori'));
        }
    }

    public function insert_subkategori()
    {
        $get=$this->input->get();
        $nama_subkategori = $get['nama_subkategori'];

        $data=array(
                'nama_subkategori'  =>$nama_subkategori,
                'id_kategori'       =>$get['id_kategori'],
                'status_subkategori'=>'aktif',
            );
        $cek_duplicate = $this->Subkategori_model->cek_duplicate_entry($nama_subkategori);
        
        if($cek_duplicate==NULL)
        {
            if($this->Subkategori_model->insert($data))
            {  
            redirect(base_url('admin/Produk/index/tab_subkategori'));
            }
        }
        else
        {
            redirect(base_url('admin/Produk/index/tab_subkategori'));
        }
    }

    public function insert_tema()
    {
        $get=$this->input->get();
        $nama_tema = $get['nama_tema'];

        $data=array(
                'nama_tema'         =>$nama_tema,
                'status_tema'       =>'aktif',
            );
        $cek_duplicate = $this->Tema_model->cek_duplicate_entry($nama_tema);
        
        if($cek_duplicate==NULL)
        {
            if($this->Tema_model->insert($data))
            {  
            redirect(base_url('admin/Produk/index/tab_tema'));
            }
        }
        else
        {
            redirect(base_url('admin/Produk/index/tab_tema'));
        }
    }

}