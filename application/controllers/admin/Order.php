<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Order_model','Order_customize_model'));
        $this->load->library(array('form_validation','template','upload','email'));
        $this->session->userdata('sess_admin');
        if(!$this->session->userdata('sess_admin') ){
            redirect(base_url('admin/Login'));
        }
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $order = $this->Order_model->get_all();
        $order_kadaluarsa = $this->Order_model->get_kadaluarsa();

        foreach ($order_kadaluarsa as $data) {
            $datestr    =$data->waktu_order;//Your date
            $date       =strtotime($datestr);
            $time_out   =$date+(60*60*10);
            
            //waktu kadaluarsa 10 jam
            $interval   =$time_out-time();
            $id_data_order=$data->id_data_order;

            if ($interval<=0) {
                $data=array(
                    'status_order'  => 'kadaluarsa',
                );
                $this->Order_model->update($id_data_order,$data);
            }
        }

        $data = array(
            'order_data' => $order
        );

        $this->template->admin('admin/v_order_list', $data);
    }

    public function read($id_data_order) 
    {
        $row = $this->Order_model->get_by_id($id_data_order);
        $detail_order= $this->Detail_order_model->get_by_id_order($id_data_order);
        $order_customize = $this->Order_customize_model->get_by_id_data_order($id_data_order);

       
        if ($row) {
            $data = array(
        'id_data_order'   => $row->id_data_order,
        'id_member'        => $row->id_member,
        'nama_order'      => $row->nama_order,
        'email_order'     => $row->email_order,
        'alamat_order'    => $row->alamat_order,
        'waktu_order'     => $row->waktu_order,
        'detail_order'    =>$detail_order,
        'status_order'    => $row->status_order,
        'metode_pengambilan'    => $row->metode_pengambilan,
        'metode_pembayaran'     => $row->metode_pembayaran,
        'nama_provinsi'         => $row->nama_provinsi,
        'nama_kota'             => $row->nama_kota,
        'nama_kecamatan'        => $row->nama_kecamatan,
        'order_customize' =>$order_customize,
        );

            $this->template->admin('admin/v_order_read', $data);
        } 
        else 
        {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('order'));
        }
    }

    public function konfirmasi_pembayaran_list()
    {
        $konf_bayar         = $this->Konf_pembayaran_model->get_belum_selesai();
        $konf_bayar_selesai = $this->Konf_pembayaran_model->get_selesai();

        $data['konf_bayar']         = $konf_bayar;
        $data['konf_bayar_selesai'] = $konf_bayar_selesai;
        $data['aktif']              = 'tab_belum';


        $this->template->admin('admin/v_konfirmasi_pembayaran_list', $data);
    }


    public function konfirmasi_pembayaran_read($id_konfirmasi)
    {
        $row = $this->Konf_pembayaran_model->get_by_id($id_konfirmasi);

        $data['konfirmasi'] = $row;

        $this->template->admin('admin/v_konfirmasi_pembayaran_read', $data);
    }

    public function update_status_order($id_data_order, $status) 
    {
        $status     =$status;
        $status_new =str_replace("%20"," ", $status);

        $data=array
            (
            'status_order'  => $status_new,
            );
        $this->Order_model->update($id_data_order,$data);
        redirect(site_url('admin/order/read/'.$id_data_order));
    }

    public function status_pemb_sudah($id_konfirmasi) 
    {
        $konfirmasi     =$this->Konf_pembayaran_model->get_by_id($id_konfirmasi);
        $id_data_order  =$konfirmasi->id_data_order;
        $data=array
            (
            'status_order'      => 'produksi',
            'id_data_order'     => $id_data_order,
            );

        $data2=array(
            'status_konfirmasi' => 'sudah bayar',
            );
        
        $this->Konf_pembayaran_model->update($id_konfirmasi,$data2);
        $this->Order_model->update($id_data_order,$data);
          
        redirect(site_url('admin/Order/send_invoice/'.$id_data_order.'/'.$id_konfirmasi));
    }

    public function send_invoice($id_data_order,$id_konfirmasi)
    {
        $send_invoice=$this->Order_model->send_invoice($id_data_order);
            if($send_invoice)
            {
                //sukses kirim email
                $this->session->set_flashdata('konfirmasi_sukses','Pembayaran telah dikonfirmasi, Invoice telah dikirm !');
                redirect(base_url('admin/konfirmasi-pembayaran/read/'.$id_konfirmasi));
            }
            else
                {
                $this->session->set_flashdata('error_send_email','Pembayaran telah dikonfirmasi!, Invoice gagal dikirim !');
                $this->session->set_flashdata('id_data_order',$id_data_order);
                $this->session->set_flashdata('id_konfirmasi',$id_konfirmasi);

                redirect(base_url('admin/konfirmasi-pembayaran/read/'.$id_konfirmasi));
                }
    }



}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-03-18 12:43:15 */
/* http://harviacode.com */