<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_model extends CI_Model
{

    public $_table_name     = 'data_order';
    public $id_data_order   = 'id_data_order';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
        $this->load->library('email'); // load email library
    }

    function get_all()
    {
        $this->db->order_by('waktu_order', 'DESC');
        return $this->db->get($this->_table_name)->result();
    }

    function get_kadaluarsa()
    {
        $this->db->where('status_order', 'belum bayar');
        return $this->db->get($this->_table_name)->result();
    }

    // get data by id
    function get_by_id($id_data_order)
    {
        // $this->db->join('alamat_pengiriman','alamat_pengiriman.id_data_order=data_order.id_data_order','left');
        $this->db->where('data_order.id_data_order', $id_data_order);
        return $this->db->get($this->_table_name)->row();
    }    

    function get_by_username($id_member)
    {
        // $this->db->join('provinsi','data_order.id_provinsi=provinsi.id_provinsi','left');
        // $this->db->join('kabupaten','data_order.id_kabupaten=kabupaten.id_kabupaten','left');
        // $this->db->join('kecamatan','data_order.id_kecamatan=kecamatan.id_kecamatan','left');
        $this->db->where('id_member', $id_member);
        $this->db->order_by('waktu_order','DESC');
        return $this->db->get($this->_table_name)->result();
    }

    // insert data
    function insert($data,$id_data_order)
    {
        $this->db->insert($this->_table_name, $data);
        $this->db->where($this->id_data_order, $id_data_order);
        return $this->db->get($this->_table_name)->row();
    }

    function update_metode_pemb($data,$id_data_order)
    {
        $this->db->where($this->id_data_order, $id_data_order);
        $query=$this->db->update($this->_table_name, $data);
        return $query;
    }

    function count_new_order(){//untuk menampilkan data order pada dashhboard
        $this->db->or_where('status_order','belum bayar');
        $this->db->or_where('status_order','menunggu konfirmasi');
        $this->db->or_where('status_order','produksi');
        $this->db->or_where('status_order','pengiriman');
        $this->db->from('data_order');
        return $this->db->count_all_results();
    }

    function get_by_id_member($id_member)
    {
        $this->db->where('id_member', $id_member);
        $this->db->order_by('waktu_order','DESC');
        return $this->db->get($this->_table_name)->result();
    }

    function send_tagihan_pembayaran($id_data_order)
    {   
        $this->Detail_order_model->get_by_id_order($id_data_order);
        $data=$this->db->get('detail_order')->result();
        $from_email = 'youthproject.office@gmail.com';
        $subject ='tagihan pembayaran';
        $message =$this->load->view('tagihan_pembayaran_view',$data);
        
    

        //configure email setting
        $config['protocol']='smtp';
        $config['smtp_host']='ssl://smtp.gmail.com';
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'youthproject54321'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        
        //send mail
        $this->email->from($from_email, 'admin youthproject');
        $this->email->to($data->email_order);
        $this->email->subject($subject);
        $this->email->message($message);
        //$this->email->attach($output,'application/pdf','invoice.pdf', false);
        return $this->email->send();
    }

    //Kirim email verifikasi
    function send_invoice($id_data_order)
    {   

        $order=$this->Order_model->get_by_id($id_data_order);
        $detail_order=$this->Detail_order_model->get_by_id_order($id_data_order);

        $data=array(
            'detail_order' => $detail_order,
            'nama_order' =>$order->nama_order,
            'id_data_order' => $order->id_data_order,
            'tanggal_order' => $order->waktu_order,
            'nama_order' => $order->nama_order,
            'no_hp'=> $order->no_hp,
            'email_order' => $order->email_order,
            'metode_pengambilan' => $order->metode_pengambilan,
            'alamat_order' => $order->alamat_order,
            // 'provinsi' => $order->nama_provinsi,
            // 'kecamatan' => $order->nama_kecamatan,
            // 'kabupaten' => $order->nama_kabupaten,
            'total_ongkir' => $order->total_ongkir,
            'berat_total' => $order->berat_total,
            'grand_total' => $order->grand_total,
            );

        $this->load->library('Dompdf_gen');
        $this->load->view('admin/invoice_view', $data);
        $html = $this->output->get_output();
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper("A4", "portrait" );
        $dompdf->render();

        // $html = $this->output->get_output();

        $output = $dompdf->output();

        $to_email=$order->email_order;


        $from_email = 'youthproject.office@gmail.com';
        $subject ='invoice-youthproject.id';
        $message = '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>invoice</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body class="page">
    <header class="clearfix">
      <div id="company">
        <h1 style="text-align:center; color:#DC143C; ">Youthproject.id</h1>
      </div>
      <hr>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
      <h2 class="name" style="margin-top: -8px; text-align:center; padding:10px; background-color: #DC143C; color:white">Invoice</h2>
        <div class="col-md-6">
        <table>
            <tr><td width="150px;">No. Transaksi</td><td width="10px;">:</td><td width="180px">'.$order->id_data_order.'</td> </tr>
            <tr><td>Nama</td><td>:</td><td>'.$order->nama_order.'</td> </tr>
            <tr><td>Email</td><td>:</td><td>'.$order->email_order.'</td> </tr>
            <tr><td>No. hp</td><td>:</td><td>'.$order->no_hp.'</td> </tr>
            <tr><td>Metode pengambilan</td><td>:</td><td>'.$order->metode_pengambilan.'</td> </tr>
            <tr><td>Metode pembayaran</td><td>:</td><td>'.$order->metode_pembayaran.'</td> </tr>
        </table>
        </div>
        <div class="col-md-6">
        <table>
            <tr><td width="150px;">Alamat</td><td width="10px;">:</td><td width="200px">'.$order->alamat_order.'</td> </tr>
            <tr><td>Provinsi</td><td>:</td><td>'.$order->nama_provinsi.'</td> </tr>
            <tr><td>Kabupaten/kota</td><td>:</td><td>'.$order->nama_provinsi.'</td> </tr>
            <tr><td>Kecamatan</td><td>:</td><td>'.$order->nama_provinsi.'</td> </tr>
            <tr><td>Lama pengiriman</td><td>:</td><td>'.$order->nama_provinsi.'</td> </tr>
            <tr><td>Status</td><td>:</td><td>'.$order->status_order.'</td> </tr>
        </table>
        </div>
      <br>
      <table border="0" cellspacing="1" cellpadding="10px" >
        <thead style="background-color: #DC143C; color: white; ">
          <tr>
            <th class="no">#</th>
            <th class="" style="text-align: center;">Nama Produk</th>
            <th class="unit" style="text-align: center;">Jumlah pesan</th>
            <th class="unit" style="text-align: center;">Harga satuan</th>
            <th class="unit" style="text-align: center;">Harga packaging</th>
            <th class="unit" style="text-align: center;">Berat produk</th>
            <th class="qty" style="text-align: center; width: 120px;">Subtotal</th>
          </tr>
        </thead>
        <tbody>'; 
            $start = 0;
            $subtotal=0;
            foreach ($detail_order as $produk) {
          
          $message.='<tr style="background-color:#F5F5F5">
            <td class="no">'.++$start.'</td>
            <td class="desc">'.$produk->nama_produk.'</td>
            <td class="unit" style="text-align: center;">'.$produk->jumlah_order.'</td>
            <td class="qty" style="text-align: right;"> Rp. '.number_format($produk->harga_produk,0,",",".").'</td>
            <td class="qty" style="text-align: right;"> Rp. '.number_format($produk->harga_packaging,0,",",".").'</td>
            <td class="qty" style="text-align: right;">'.number_format($produk->berat_produk,0,",",".").' gram</td>
            <td class="total" style="text-align: right;">Rp. '.number_format($produk->subtotal,0,",",".").'</td>
          </tr>';
         
            $subtotal=$subtotal+$produk->subtotal;
            $this->email->clear(TRUE); 
            }
        $message.='</tbody>
        <tfoot style="background-color: #DCDCDC" >
          <tr>
            <td colspan="5" style="text-align: right;">TOTAL</td>
            <td colspan="2" style="text-align: right;">'.'Rp. '.number_format($subtotal,0,",",".").'</td>
          </tr>
          <tr>
            <td colspan="5" style="text-align: right;">BERAT TOTAL</td>
            <td colspan="2" style="text-align: left;">'.number_format($order->berat_total,0,",",".").' gram </td>
           
          </tr>
          <tr>
            <td colspan="5" style="text-align: right;">ONGKIR (ONGKIR x BERAT TOTAL)</td>
            <td colspan="2" style="text-align: right;">'.'Rp. '.number_format($order->total_ongkir,0,",",".").'</td>
          </tr>
          
          <tr>
            <td colspan="5" style="text-align: right;">GRAND TOTAL</td>
            <td colspan="2" style="text-align: right;">'.'Rp. '.number_format($order->grand_total,0,",",".").'</td>
          </tr>
        </tfoot>
      </table>
      <div style="margin-top:10px;">
        <div>NOTICE:</div>
        <div class="notice"><p style="font-size:12pt">Harap membawa menunjukan invoice ini saat pengambilan barang (untuk metode pengambilan "ambil")</p></div>
      </div>
      <p style="font-size:11pt"><b style="color:#DC143C;">Berikut kami lampirkan invoice dalam format .pdf</b></p>
    </main>
    <footer>
      <!-- Invoice was created on a computer and is valid without the signature and seal. -->
    </footer>
  </body>
</html>';

        //configure email setting
        $config['protocol']='smtp';
        $config['smtp_host']='ssl://smtp.gmail.com';
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'youthproject54321'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        
        //send mail
        $this->email->from($from_email, 'admin youthproject');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($output,'application/pdf','invoice-youthproject .pdf', false);
        return $this->email->send();
    }

    function update($id_data_order,$data)
    {
        $this->db->where($this->id_data_order, $id_data_order);
        $this->db->update($this->_table_name, $data);
    }

    //untuk mengecek data pada form konfrmasi pembayran
    function get_my_order($id_data_order){
        $this->db->where('id_data_order', $id_data_order);
        $this->db->where('status_order', 'belum bayar');
        return $this->db->get($this->_table_name)->row();
    }

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-03-18 12:43:15 */
/* http://harviacode.com */