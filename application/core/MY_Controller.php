<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{

	function __construct()
    {
        parent::__construct();
        $this->load->model(array('Subkategori_model','Konf_pembayaran_model','Detail_order_model','Order_model','Cart_model','Kategori_model','Subkategori_model','Tema_model'));
        $this->load->library(array('template','email','session'));
        // $this->session->userdata('sess_admin');
        // if(!$this->session->userdata('sess_admin') ){
        //     redirect(base_url('admin/Login'));
        // }
        date_default_timezone_set('Asia/Jakarta');

        $sess_member    =$this->session->userdata('sess_member');
        $id_member      =$sess_member['id_member']; 

        $my_cart        = $this->Cart_model->get_my_cart($id_member);
        

        $total=0;
        $harga_packaging=0;
        $berat_total=0;
        foreach ($my_cart as $produk)
        {
            $total=$total+$produk->subtotal;
            $harga_packaging=$harga_packaging+($produk->harga_packaging*$produk->jumlah_order);
            $berat_total = $berat_total+($produk->berat_produk*$produk->jumlah_order);
        }

        $data['total_harga']      = $total;
        $data['berat_total']      = $berat_total;
        $data['harga_packaging']  = $harga_packaging;
        $data['total_no_ongkir']  = $total+$harga_packaging;
        
        $data['my_cart']    = $my_cart;
    }

    protected function header()
    {
        $sess_member    =$this->session->userdata('sess_member');
        $id_member      =$sess_member['id_member']; 
        $menu_kategori  = $this->Kategori_model->get_all();
        $menu_subkategori = $this->Subkategori_model->get_all();

         $count_my_cart=$this->Cart_model->count_my_cart($id_member);

         $data['count_my_cart'] = $count_my_cart;
         $data['menu_kategori'] = $menu_kategori;
         $data['menu_subkategori'] = $menu_subkategori;

         $this->load->view('frontend/template/header',$data);
    }

    protected function footer()
    {
        $kategori_footer  = $this->Kategori_model->get_all_for_footer();

        $data['kategori_footer'] = $kategori_footer;

        $this->load->view('frontend/template/footer', $data);
    }

    public function order_summary()
    {
        $sess_member    =$this->session->userdata('sess_member');
        $id_member      =$sess_member['id_member']; 
        $my_cart        = $this->Cart_model->get_my_cart($id_member);
        

        $total=0;
        $harga_packaging=0;
        $berat_total=0;
        foreach ($my_cart as $produk)
        {
            $total=$total+$produk->subtotal;
            $harga_packaging=$harga_packaging+($produk->harga_packaging*$produk->jumlah_order);
            $berat_total = $berat_total+($produk->berat_produk*$produk->jumlah_order);
        }

        $data['total_harga']      = $total;
        $data['berat_total']      = $berat_total;
        $data['harga_packaging']  = $harga_packaging;
        $data['total_no_ongkir']  = $total+$harga_packaging;
        
        $data['my_cart']    = $my_cart;
    }
}