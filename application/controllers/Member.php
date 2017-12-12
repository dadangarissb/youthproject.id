<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Produk_model','Cart_model','Cart_customize_model','Order_model','Detail_order_model','Order_customize_model','Konf_pembayaran_model','Member_model','Packaging_model'));
        $this->load->library(array('form_validation','session','template','upload','image_lib','email','CKEditor'));
        $this->load->helper(array('url','html','form'));
        $this->load->helper('date');
       
        $this->load->helper(array('url','html','form'));
        if(!$this->session->userdata('sess_member') ){
            redirect(base_url());
        }

        date_default_timezone_set('Asia/Jakarta');
    }

    public function my_account($id_member)//untuk lihatprofil member 
    {
        $row=$this->Member_model->get_by_id($id_member);
        if ($row) {
        $data=array(
            'id_member' => $row->id_member,
            'nama_member' => $row->nama_member,
            'email' => $row->email,
            'no_hp' => $row->no_hp,
            'alamat_member' => $row->alamat_member,
            // 'nama_provinsi' => $row->nama_provinsi,
            // 'nama_kabupaten' => $row->nama_kabupaten,
            // 'nama_kecamatan' => $row->nama_kecamatan,
            'status_member' => $row->status_member,
            'active_tab' => 'my_profile',
            );

        $this->header();
        $this->load->view('frontend/v_my_profile_read', $data);
        $this->footer();
        }
        // else{
        //     redirect(base_url());
        // }
    }

    public function my_order($id_member) 
    {

        $row        = $this->Member_model->get_by_id($id_member);//untuk menampilkan sidebar profil
        $my_order   = $this->Order_model->get_by_id_member($id_member);
       
            $data = array(
            'id_member' => $row->id_member,
            'nama_member' => $row->nama_member,
            'email' => $row->email,
            'no_hp' => $row->no_hp,
            'status_member' => $row->status_member,
            'active_tab' => 'my_order',
            );
            $data['my_order']   = $my_order;
           
            $this->header();
            $this->load->view('frontend/v_my_order_list', $data);
            $this->footer();
    }

    public function riwayat_order($id_member) 
    {
        $row        = $this->Member_model->get_by_id($id_member);//untuk menampilkan sidebar profil
        $my_order   = $this->Order_model->get_by_username($id_member);
       
        $data = array(
            'id_member' => $row->id_member,
            'nama_member' => $row->nama_member,
            'email' => $row->email,
            'no_hp' => $row->no_hp,
            'alamat_member' => $row->alamat_member,
            // 'nama_provinsi' => $row->nama_provinsi,
            // 'nama_kabupaten' => $row->nama_kabupaten,
            // 'nama_kecamatan' => $row->nama_kecamatan,
            'status_member' => $row->status_member,
            );
            $data['my_order']   = $my_order;
           
            $this->load->view('frontend/v_my_order_list', $data);
    }

    //mengeksekusi data dari form cart untuk dimasukan ke tabel cart
    public function add_to_cart() 
    {
        $type_customize  = $this->input->post('type_cart_customize');
        $id_produk  = $this->input->post('id_produk',TRUE);
        $slug       = $this->input->post('slug',TRUE);

        $a=0;

        if ($type_customize) { 
        foreach($type_customize as $key => $val){
            if ($_POST['type_cart_customize'][$key]=='image') 
            {
                $files  = $_FILES;
                $images = array();
                $cpt    = count($_FILES['content_cart_customize']['name']);
                    $_FILES['userfile']['name']     = $files['content_cart_customize']['name'][$a];
                    $_FILES['userfile']['type']     = $files['content_cart_customize']['type'][$a];
                    $_FILES['userfile']['tmp_name'] = $files['content_cart_customize']['tmp_name'][$a];
                    $_FILES['userfile']['error']    = $files['content_cart_customize']['error'][$a];
                    echo $size_image=$_FILES['userfile']['size']     = $files['content_cart_customize']['size'][$a];
                    if ($size_image>1000000 | $size_image==0) {
                        $this->session->set_flashdata('message_image_fail', 'Ukuran gambar yang anda upload terlalu besar! Silahkan coba lama_pengiriman');
                       redirect(base_url('produk/'.$id_produk.'/'.$slug));
                    } 
                $a++;
            }
        } 
        }

        date_default_timezone_set('Asia/Jakarta');
        $rand=strtoupper(uniqid());
        $random=strtoupper(substr($rand, -4));
        $month2=strtoupper(substr(date("M"), -1));//ambil 1 karakter bulan dari akhir (N, L, Y)
        $year2=strtoupper(substr(date("Y"), -2));
        $day=strtoupper(substr(date("D"), -1));

        $id_cart="YP".date("h").date("s").$day.date("i").$random;

       //id produk digunakan nanti sbg parameter url 
        $id_produk      = $this->input->post('id_produk',TRUE);
        
        $sess_member    =$this->session->userdata('sess_member');
        $id_member      =$sess_member['id_member']; 

        $produk         =$this->Produk_model->get($id_produk);
        $harga_produk   =$produk->harga_produk;
        $jumlah_order   =$this->input->post('jumlah_order',TRUE);
        $id_packaging   =$this->input->post('id_packaging',TRUE);
        $catatan_lain   =$this->input->post('catatan_lain',TRUE);

        if ($id_packaging) 
        {
            $packaging      = $this->Packaging_model->get_by_id($id_packaging);

            $subtotal       =$harga_produk*$jumlah_order+($jumlah_order*$packaging->harga_packaging);
        }
        else
        {
            $subtotal       =$harga_produk*$jumlah_order;
        }
        $data = array(
            'id_cart'       => $id_cart,
            'id_member'     => $id_member,
            'id_produk'     => $id_produk,
            'id_packaging'  => $id_packaging,
            'jumlah_order'  => $jumlah_order,
            'subtotal'      => $subtotal,
            'catatan_lain'  => $catatan_lain,
            );
        $this->Cart_model->insert($data);

        $id_cart=$id_cart;

        $label  = $this->input->post('label_cart_customize');
        $type   = $this->input->post('type_cart_customize');

        $data_customize = array();
        $i=0;

        //if label untuk mengecek ada customize atau tidak
        if ($label) { 
        foreach($label as $key => $val){
            if ($_POST['type_cart_customize'][$key]=='image') 
            {
                $config['upload_path']      ='./uploads/images/image_customize/';
                $config['allowed_types']    ='jpeg|gif|jpg|png';
                $config['encrypt_name']     = TRUE;

                $files  = $_FILES;
                $images = array();
                $cpt    = count($_FILES['content_cart_customize']['name']);
                    $_FILES['userfile']['name']     = $files['content_cart_customize']['name'][$i];
                    $_FILES['userfile']['type']     = $files['content_cart_customize']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['content_cart_customize']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['content_cart_customize']['error'][$i];
                    echo $_FILES['userfile']['size']     = $files['content_cart_customize']['size'][$i];

                    $this->upload->initialize($config);
                    $this->upload->do_upload();
                    $image=$this->upload->data();

                $data_customize[] = array(
                'id_cart'                  => $id_cart,
                'label_cart_customize'     => $_POST['label_cart_customize'][$key],
                'type_cart_customize'      => $_POST['type_cart_customize'][$key],
                'content_cart_customize'   => $image['file_name'],
                );
                $i++;
            }
            else
            {
            $data_customize[] = array(
                'id_cart'                  => $id_cart,
                'label_cart_customize'     => $_POST['label_cart_customize'][$key],
                'type_cart_customize'      => $_POST['type_cart_customize'][$key],
                'content_cart_customize'   => $_POST['content_cart_customize'][$key],
                );
            }
        }            
        // fungsi dari codeigniter untuk menyimpan multi array
        $this->Cart_customize_model->insert_customize($data_customize, $batch='TRUE');
        } 
        redirect(base_url('member/my-cart/'.$id_member));
        }

    public function my_cart($id_member)
    {
        $my_cart        = $this->Cart_model->get_my_cart($id_member);
        $produk_rel     = $this->Produk_model->get_random_cart();
        $cart           = $this->Cart_model->get_my_cart($id_member);


        $total_harga_no_ongkir =0;
        $berat_total =0;
        foreach ($cart as $cart) {
            $total_harga_no_ongkir    = $total_harga_no_ongkir+$cart->subtotal;
            $berat_total        = $berat_total+($cart->berat_produk*$cart->jumlah_order);
        }

        $data['my_cart']    = $my_cart;
        $data['produk_rel'] = $produk_rel;
        $data['total_harga_no_ongkir'] = $total_harga_no_ongkir;
        $data['berat_total']     = $berat_total;

        $this->header();
        $this->load->view('frontend/v_my_cart',$data);
        $this->footer();
    }

    public function delete_cart($id_cart)
    {
        $cart = $this->Cart_model->get($id_cart);
        $customize = $this->Cart_customize_model->get_customize($id_cart);

        $sess_member    =$this->session->userdata('sess_member');
        $id_member      =$sess_member['id_member']; 

        if ($cart) {
            //delete image cart
            if ($customize) {
                foreach ($customize as $customize) {
                    if ($customize->type_cart_customize=='image') {
                    unlink('./uploads/images/image_customize/'.$customize->content_cart_customize);
                    $this->Cart_customize_model->delete($customize->id_cart_customize);
                    }

                    else {
                    $this->Cart_customize_model->delete($customize->id_cart_customize);
                    }
                }
            }
            //delete cart
        $this->Cart_model->delete($cart->id_cart);
        redirect(site_url('member/my-cart/'.$id_member));
        }
    }


    public function detail_cart($id_cart)
    {
        $cart       = $this->Cart_model->get_by_id($id_cart);
        $customize  = $this->Cart_customize_model->get_customize($id_cart);

        $sess_member=$this->session->userdata('sess_member');
        $id_member=$sess_member['id_member'];

        if ($cart) 
        {
            $data['cart']       = $cart;
            $data['customize']  = $customize; 
            $data['id_member']  = $id_member;

            $this->header();
            $this->load->view('frontend/v_detail_cart', $data);
            $this->footer();
        }   
    }

    public function order_form() 
    {
        $sess_member    =$this->session->userdata('sess_member');
        $id_member      =$sess_member['id_member'];

        $cart       = $this->Cart_model->get_my_cart($id_member);

        $total_harga_no_ongkir =0;
        $berat_total =0;
        foreach ($cart as $cart) {
            $total_harga_no_ongkir    = $total_harga_no_ongkir+$cart->subtotal;
            $berat_total        = $berat_total+($cart->berat_produk*$cart->jumlah_order);
        }
        
        $data['action']         = base_url('order/submit');

        $data['cart_data']      = $cart;
        $data['id_data_order']  = set_value('id_data_order');
        $data['id_member']      = $id_member;
        $data['nama_order']     = set_value('nama_order');
        $data['email_order']    = set_value('email_order');
        $data['no_hp']          = set_value('no_hp');
        $data['alamat_order']   = set_value('alamat_order');
        $data['id_provinsi']    = set_value('id_provinsi');
        $data['id_kabupaten']   = set_value('id_kabupaten');
        $data['id_kecamatan']   = set_value('id_kecamatan');
        $data['metode_pengambilan']     = set_value('metode_pengambilan');
        $data['metode_pembayaran']      = set_value('metode_pembayaran');
        $data['total_harga_no_ongkir']        = $total_harga_no_ongkir;
        $data['berat_total']            = $berat_total;

        $this->header();
        $this->load->view('frontend/v_order_form', $data);
        $this->footer();
    }

     public function edit_order_form($id_data_order) 
    {
        $sess_member=$this->session->userdata('sess_member');
        $id_member=$sess_member['id_member'];

        $detail_order       = $this->Detail_order_model->get_by_id_order($id_data_order);

        $order= $this->Order_model->get_by_id($id_data_order);

        $data['action']         = base_url('order/edit-form-action');
        $data['id_data_order']  = set_value('id_data_order',$id_data_order);
        $data['id_member']      = set_value('id_member',$order->id_member);
        $data['nama_order']     = set_value('nama_order',$order->nama_order);
        $data['email_order']    = set_value('email_order',$order->email_order);
        $data['no_hp']          = set_value('no_hp',$order->no_hp);
        $data['alamat_order']   = set_value('alamat_order',$order->alamat_order);
        $data['metode_pengambilan']     = set_value('metode_pengambilan',$order->metode_pengambilan);
        $data['metode_pembayaran']      = set_value('metode_pembayaran',$order->metode_pembayaran);
        $data['total_harga_no_ongkir']  = $order->total_harga_no_ongkir;
        $data['berat_total']            = $order->berat_total;

        $this->header();
        $this->load->view('frontend/v_order_form', $data);
        $this->footer();
    }

    public function edit_order_form_action() 
    {
        $post=$this->input->post();
        echo $id_data_order=$post['id_data_order'];
            $data = array(
                'id_data_order'  => $id_data_order,
                'id_member'      => $post['id_member'],
                'nama_order'    => $post['nama_order'],
                'email_order'   => $post['email_order'],
                'no_hp'         => $post['no_hp'],
                'metode_pengambilan' => $post['metode_pengambilan'],
                'alamat_order' => $post['alamat_order'],
                'metode_pembayaran' => '-',
                );

            $data_order =$this->Order_model->update($id_data_order,$data);

            $this->session->set_flashdata('message_success', 'Data telah diupdate');
            redirect(base_url('order/metode-pengambilan/'.$id_data_order));
    }
    
    public function order_action() 
    {
        $sess_member=$this->session->userdata('sess_member');
        $id_member=$sess_member['id_member'];
        
        date_default_timezone_set('Asia/Jakarta');
        $rand   =strtoupper(uniqid());
        $random =strtoupper(substr($rand, -4));
        $month2 =strtoupper(substr(date("M"), -1));//ambil 1 karakter bulan dari akhir (N, L, Y)
        $year2  =strtoupper(substr(date("Y"), -2));
        $day    =strtoupper(substr(date("D"), -1));
        $id_data_order="YP".date("h").$year2.$month2.date("s").$day.date("i").$random;

        $metode_pengambilan = $this->input->post('metode_pengambilan',TRUE);

            $data = array(
                'id_data_order'  => $id_data_order,
                'id_member'      => $id_member,
                'nama_order'    => $this->input->post('nama_order',TRUE),
                'email_order'   => $this->input->post('email_order',TRUE),
                'no_hp'         => $this->input->post('no_hp',TRUE),
                'alamat_order'         => $this->input->post('alamat_order',TRUE),
                'metode_pengambilan' => $metode_pengambilan,
                'metode_pembayaran' => '-',
                'total_harga_no_ongkir'   => $this->input->post('total_harga_no_ongkir',TRUE),
                'status_order'  => 'belum bayar',
                'berat_total'   => $this->input->post('berat_total',TRUE),
                'grand_total'   => $this->input->post('total_harga_no_ongkir',TRUE),
                );

            $data_order =$this->Order_model->insert($data,$id_data_order);

            $my_cart = $this->Cart_model->get_my_cart($id_member);
            if($my_cart){
                // var_dump($my_cart);
                foreach ($my_cart as $item){
                $order = array(
                    'id_data_order'   => $data_order->id_data_order,
                    'id_produk'       => $item->id_produk,
                    'id_packaging'    => $item->id_packaging,
                    'jumlah_order'    => $item->jumlah_order,
                    'status_detail_order'     => 'pemesanan',
                    'subtotal'        => $item->subtotal,
                    'catatan_lain'    => $item->catatan_lain,
                    );      

                $id_detail_order=$this->Detail_order_model->insert($order);
                
                // $cart_customize=$this->Cart_customize_model->get_customize($item->id_cart);
                // if ($cart_customize) {
                //     foreach ($cart_customize as $customize) {
                //         $data=array(
                //             'id_detail_order'             => $id_detail_order,
                //             'label_order_customize'       => $customize->label_cart_customize,
                //             'type_order_customize'        => $customize->type_cart_customize,
                //             'content_order_customize'     => $customize->content_cart_customize,
                //             );
                //         $this->Order_customize_model->insert($data);
                //         $id=$customize->id_cart_customize;
                //         $this->Cart_customize_model->delete($id);
                //     }
                // }
                // $id=$item->id_cart;
                // $this->Cart_model->delete($id);
                } 
            $this->session->set_flashdata('message_success', 'Pemesanan anda telah tercatat!');
            redirect(base_url('order/metode-pengambilan/'.$id_data_order));
            }
    }

    public function metode_pengambilan($id_data_order)
    {
        $sess_member=$this->session->userdata('sess_member');
        $id_member=$sess_member['id_member'];

        $detail_order       = $this->Detail_order_model->get_by_id_order($id_data_order);

        $row = $this->Order_model->get_by_id($id_data_order);

        $data['action']         = base_url('order/metode-pengambilan-action');
        $data['id_data_order']  = $row->id_data_order;
        $data['total_harga_no_ongkir']= $row->total_harga_no_ongkir;
        $data['berat_total']    = $row->berat_total;
        $data['grand_total']    = $row->total_harga_no_ongkir;
        
    
        $this->header();
        $this->load->view('frontend/v_metode_pengambilan',$data);
        $this->footer();
    }

    public function view_form_alamat_kirim()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 7bcee54df596abbb234094e3b1643f29"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data['err']            = $err;
        $data['response']       = $response;

        $this->load->view('frontend/v_form_alamat_kirim',$data);
    }

    public function hide_form_alamat_kirim()
    {
        $this->load->view('frontend/v_hide_form_alamat_kirim');
    }

    public function get_kota($province){        

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key:7bcee54df596abbb234094e3b1643f29"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            //echo json_encode($k['rajaongkir']['results']);
            for ($j=0; $j < count($data['rajaongkir']['results']); $j++)
            {
                echo "<option value='".$data['rajaongkir']['results'][$j]['city_id']."'>".$data['rajaongkir']['results'][$j]['city_name']."</option>";
            }
        }
    }

    function get_cost()
    {
        $origin = 445;
        $kota = $this->input->get('kota');
        $berat = $this->input->get('berat');
        $courier = $this->input->get('courier');

        if ($courier) {
            $data = array('origin' => $origin,
                    'destination' => $kota, 
                    'berat' => $berat, 
                    'courier' => $courier 
                    );
        $this->load->view('frontend/v_get_cost', $data);
        }
    }

    function get_courier()
    {

        $this->load->view('frontend/v_get_courier');
        
    }

    public function edit_metode_pengambilan($id_data_order)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 7bcee54df596abbb234094e3b1643f29"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $row = $this->Order_model->get_by_id($id_data_order);

        $detail_order       = $this->Detail_order_model->get_by_id_order($id_data_order);

        $data['action']         = base_url('order/edit-metode-pengambilan-action');
        $data['id_data_order']  = $row->id_data_order;
        $data['total_harga_no_ongkir']= $row->total_harga_no_ongkir;
        $data['berat_total']    = $row->berat_total;
        $data['grand_total']    = $row->total_harga_no_ongkir+$row->total_ongkir;
        $data['metode_pengambilan'] = $row->metode_pengambilan;
        $data['err']                =$err;
        $data['response']           =$response;

        $this->header();
        $this->load->view('frontend/v_metode_pengambilan',$data);
        $this->footer();
    }

    public function edit_metode_pengambilan_action()
    {
        $post   = $this->input->post();

        $id_data_order                  = $post['id_data_order'];
        $data['metode_pengambilan']     = $post['metode_pengambilan'];

        if ($post['metode_pengambilan']=="ambil") 
        {
          $data['id_provinsi']      = '-';
          $data['nama_provinsi']    = '-';
          $data['id_kota']          = '-';
          $data['nama_kota']        = '-';
          $data['id_kecamatan']     = '-';
          $data['nama_kecamatan']   = '-';
          $data['total_ongkir']     = '0';
          $data['lama_pengiriman']  = '-';
        }

        $this->Order_model->update($id_data_order,$data);

        redirect(base_url('order/metode-pembayaran/'.$id_data_order));
    }

    public function metode_pengambilan_action()
    {
        $metode_pengambilan     = $this->input->post('metode_pengambilan');
        $id_data_order          = $this->input->post('id_data_order');

        if ($metode_pengambilan=='ambil') 
        {
            $data2['metode_pengambilan']    = $metode_pengambilan;

            $this->Order_model->update($id_data_order,$data2);

            echo $id_data_order;
            redirect(base_url('order/metode-pembayaran/'.$id_data_order));
        } 
        else 
        {   
            $id_provinsi    = $this->input->post('provinsi_tujuan');
            $id_kota        = $this->input->post('kota');
            $paket_ongkir   = $this->input->post('paket_ongkir');
            $courier        = $this->input->post('courier');
            $origin         = $this->input->post('origin');
            $weight         = $this->input->post('weight');

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/province?id=$id_provinsi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 7bcee54df596abbb234094e3b1643f29"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              $data = json_decode($response, true);
              echo json_encode($data['rajaongkir']['results']['province_id']);
              echo json_encode($data['rajaongkir']['results']['province']);
              $nama_provinsi =json_encode($data['rajaongkir']['results']['province']);
            }

            //untuk get kota-------------------------------------------
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=$id_kota",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "key: 7bcee54df596abbb234094e3b1643f29"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              $data = json_decode($response, true);
              echo json_encode($data['rajaongkir']['results']['city_id']);
              echo json_encode($data['rajaongkir']['results']['city_name']);
              $nama_kota = json_encode($data['rajaongkir']['results']['city_name']);
            }
        
            //untuk get cost, paket, lama pengiriman -------------------------------------------
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$id_kota&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 7bcee54df596abbb234094e3b1643f29"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              $data = json_decode($response, true);
            }

            for ($k=0; $k < count($data['rajaongkir']['results']); $k++) 
            {
                for ($l=0; $l < count($data['rajaongkir']['results'][$k]['costs']); $l++) 
                {             
                    if ($l==$paket_ongkir) {
                        echo "nama paket :".$nama_paket     = $data['rajaongkir']['results'][$k]['costs'][$l]['service'];
                        echo $total_ongkir   = $data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value'];
                        echo $lama_pengiriman = $data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['etd'];
                    }
                 }
            }

            $data3['id_provinsi']           = $id_provinsi;
            $data3['nama_provinsi']         = $nama_provinsi;
            $data3['id_kota']               = $id_kota;
            $data3['nama_kota']             = $nama_kota;
            $data3['lama_pengiriman']       = $lama_pengiriman;
            $data3['total_ongkir']          = $total_ongkir;
            $data3['nama_kurir']            = $courier;
            $data3['nama_paket_ongkir']     = $nama_paket;

            // $this->Alamat_pengiriman_model->insert($data3);

            $this->Order_model->update($id_data_order,$data3);

            $row = $this->Order_model->get_by_id($id_data_order);

            $grand_total    = $total_ongkir+$row->total_harga_no_ongkir;

            $data2['metode_pengambilan']    = $metode_pengambilan;
            $data2['grand_total']           = $grand_total;

            $this->Order_model->update($id_data_order,$data2);

            redirect(base_url('order/metode-pembayaran/'.$id_data_order));
        }//end Else
    }

    public function metode_pembayaran($id_data_order) 
    {
        $row    = $this->Order_model->get_by_id($id_data_order);
        $produk =$this->Produk_model->get_produk_enam();
        $detail_order   = $this->Detail_order_model->get_by_id_order($id_data_order);

        $total_harga_no_ongkir =0;
        $berat_total =0;
        foreach ($detail_order as $detail) {
            $total_harga_no_ongkir  = $total_harga_no_ongkir+$detail->subtotal;
            $berat_total            = $berat_total+($detail->berat_produk*$detail->jumlah_order);
        }

        $data=array(
            'action'            => base_url('order/metode-pembayaran-action'),
            'id_data_order'     => $row->id_data_order,
            'total_harga_no_ongkir'    => $total_harga_no_ongkir,//untuk menampilkan total harga
            'email_order'       => $row->email_order,
            'nama_order'        => $row->nama_order,
            'berat_total'       => $berat_total,
            'grand_total'       => $row->grand_total,
            'total_ongkir'      => $row->total_ongkir,
            );
        $data['produk']=$produk;

        $this->header();
        $this->load->view('frontend/v_metode_pembayaran', $data);
        $this->footer();
    }

    public function metode_pembayaran_action() 
    {
        $sess_member        =$this->session->userdata('sess_member');
        $id_member          =$sess_member['id_member'];

        $id_data_order      =$this->input->post('id_data_order');
        $metode_pembayaran  =$this->input->post('metode_pembayaran');
        $nama_order         =$this->input->post('nama_order');
        $email_order        =$this->input->post('email_order');
        
        //menghapus data pada cart
        $my_cart = $this->Cart_model->get_my_cart($id_member);
        $cart_customize=$this->Cart_customize_model->get_customize($item->id_cart);

        foreach ($my_cart as $item){
            if ($my_cart) {
                if ($cart_customize) {
                    foreach ($cart_customize as $customize) {
                        $id=$customize->id_cart_customize;
                        $this->Cart_customize_model->delete($id);
                    }
                }
                $id=$item->id_cart;
                $this->Cart_model->delete($id);
            } 
        }
        
        
        if ($metode_pembayaran=='transfer') 
        {
            $row            = $this->Order_model->get_by_id($id_data_order);
            // $alamat         = $this->Alamat_pengiriman_model->get_by_id_data_order($id_data_order);

            // $kode_unik      = rand(0, 999);
            $kode_unik      = 0;
            $grand_total    = $row->grand_total+$kode_unik;

            $data=array(
                    'metode_pembayaran' => $metode_pembayaran,
                    'id_data_order'     => $id_data_order,
                    'kode_unik'         => $kode_unik,
                    'grand_total'       => $grand_total,
                    );
        }

        else{
            $data=array(
                    'metode_pembayaran' => $metode_pembayaran,
                    'id_data_order'     => $id_data_order,
                    );
        }

        $update         = $this->Order_model->update_metode_pemb($data,$id_data_order);
        if($update){
            $order           = $this->Order_model->get_by_id($id_data_order);
            // $alamat          = $this->Alamat_pengiriman_model->get_by_id_data_order($id_data_order);
            $detail_order    = $this->Detail_order_model->get_by_id_order($id_data_order);

            $data['detail_order']   = $detail_order;

            //kirim email verifikasi
            $from_email = 'youthproject.office@gmail.com';
            $subject    = 'tagihan pembayaran';
            $message    = '

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
      <h2 class="name" style="margin-top: -8px; text-align:center; padding:10px; background-color: #DC143C; color:white">Tagihan pembayaran</h2>
        <div id="invoice">
            <h2 class="name" style="margin-top: -8px; ">Kepada Yth. '.$order->nama_order.'</h2>
            <p style="font-size:11pt">Ini adalah tagihan pembayaran atas pemesanan dengan kode transaksi <b style="color:#DC143C;">'.$order->id_data_order.'</b></p>
        </div>
      </div>
      <table border="0" cellspacing="1" cellpadding="10px" >
        <thead style="background-color: #DC143C; color: white; ">
          <tr>
            <th class="no">#</th>
            <th class="" style="text-align: center;">Nama Produk</th>
            <th class="unit" style="text-align: center;">Jumlah pesan</th>
            <th class="unit" style="text-align: center;">Harga satuan</th>
            <th class="unit" style="text-align: center;">Harga Kemasan</th>
            <th class="unit" style="text-align: center;">Berat produk</th>
            <th class="qty" style="text-align: center; width: 120px;">Subtotal</th>
          </tr>
        </thead>
        <tbody>'; 
            $start = 0;
            $subtotal=0;
            foreach ($detail_order as $produk) 
            {
                if ($produk->id_packaging) {
                    $harga_packaging=$produk->harga_packaging;
                }
                else{
                    $harga_packaging=0;
                } 
          
            $message.='<tr style="background-color:#F5F5F5">
            <td class="no">'.++$start.'</td>
            <td class="desc">'.$produk->nama_produk.'</td>
            <td class="unit" style="text-align: center;">'.$produk->jumlah_order.'</td>
            <td class="qty" style="text-align: right;"> Rp. '.number_format($produk->harga_produk,0,",",".").'</td>
            <td class="qty" style="text-align: right;"> Rp. '.number_format($produk->harga_packaging,0,",",".").'</td>
            <td class="qty" style="text-align: right;">'.number_format($produk->berat_produk,0,",",".").' gram</td>
            <td class="total" style="text-align: right;"> Rp. '.number_format($produk->subtotal,0,",",".").'</td>
          </tr>';

            $this->email->clear(TRUE); 
            }
        $message.='</tbody>
        <tfoot style="background-color: #DCDCDC" >
          <tr>
            <td colspan="5" style="text-align: right;">TOTAL</td>
            <td colspan="2" style="text-align: right;">'.'Rp. '.number_format($order->total_harga_no_ongkir,0,",",".").'</td>
          </tr>
          <tr>
            <td colspan="5" style="text-align: right;">BERAT TOTAL</td>
            <td colspan="2" style="text-align: left;">'.number_format($order->berat_total,0,",",".").' gram </td>
           
          </tr>
          <tr>
            <td colspan="5" style="text-align: right;">ONGKIR (ONGKIR x BERAT TOTAL)</td>
            <td colspan="2" style="text-align: right;">'.'Rp. '.number_format($alamat->total_ongkir,0,",",".").'</td>
          </tr>
          <tr>
            <td colspan="5" style="text-align: right;">KODE UNIK</td>
            <td colspan="2" style="text-align: right;">'.'Rp. '.number_format($order->kode_unik,0,",",".").'</td>
          </tr>
          <tr>
            <td colspan="5" style="text-align: right;">GRAND TOTAL</td>
            <td colspan="2" style="text-align: right;">'.'Rp. '.number_format($order->grand_total,0,",",".").'</td>
          </tr>
        </tfoot>
      </table>
      <div style="margin-top:10px;">
        <div>NOTICE:</div>
        <div class="notice"><p style="font-size:12pt">Silahkan lakukan pembayaran dan konfirmasi pembayaran anda sebelum <b style="color:#DC143C;">12 jam</b> dari pemesanan</p></div>
      </div>
      <p style="font-size:11pt"><b style="color:#DC143C;">Berikut adalah daftar rekening kami</b></p>
      <p style="font-size:11pt"><b>BRI</b></p>
      <p style="font-size:11pt">No. Rekening : 086784527352813</p>
      <p style="font-size:11pt">a.n. youthproject</p>
    </main>
    <footer>
      <!-- Invoice was created on a computer and is valid without the signature and seal. -->
    </footer>
  </body>
</html>';
            
        
            //configure email setting
            $config['protocol']     ='smtp';
            $config['smtp_host']    ='ssl://smtp.gmail.com';
            $config['smtp_port']    = '465'; //smtp port number
            $config['smtp_user']    = $from_email;
            $config['smtp_pass']    = 'youthproject54321'; //$from_email password
            $config['mailtype']     = 'html';
            $config['charset']      = 'iso-8859-1';
            $config['wordwrap']     = TRUE;
            $config['newline']      = "\r\n"; //use double quotes
            $this->email->initialize($config);
            
            //send mail
            $this->email->from($from_email, 'admin youthproject');
            $this->email->to($email_order);
            $this->email->subject($subject);
            $this->email->message($message);
            //$this->email->attach($output,'application/pdf','invoice.pdf', false);
            $send=$this->email->send();
            if($send)
            {
                redirect(base_url('order/order-review/'.$id_data_order));
            }
            else
            {
                redirect(base_url('order/order-review/'.$id_data_order));
            }
        }

    }

    public function order_review($id_data_order)
    {
        $order      = $this->Order_model->get_by_id($id_data_order);
        $my_detail  = $this->Detail_order_model->get_by_id_order($id_data_order);

        $data=array(
                'my_detail'     => $my_detail,
                'order'         => $order,
                'id_data_order' => $id_data_order,
                'total_ongkir'  => $order->total_ongkir,
                'total_harga_no_ongkir' => $order->total_harga_no_ongkir,
                'grand_total'   => $order->grand_total,
                'kode_unik'     => $order->kode_unik,
                );

        $this->header();
        $this->load->view('frontend/v_order_review',$data);
        $this->footer();
        
    }


    public function konfirmasi_pembayaran($id_data_order)
    {
        $my_order = $this->Order_model->get_my_order($id_data_order);
        
        if ($my_order) {
            $order      = $this->Order_model->get_by_id($my_order->id_data_order);
            $my_detail  = $this->Detail_order_model->get_by_id_order($my_order->id_data_order);
            // $alamat     = $this->Alamat_pengiriman_model->get_by_id_data_order($my_order->id_data_order);
            $data=array(
                'my_detail'     => $my_detail,
                'id_data_order' => $my_order->id_data_order,
                'total_ongkir'  => $order->total_ongkir,
                'total_harga_no_ongkir' => $order->total_harga_no_ongkir,
                'grand_total'   => $order->grand_total,
                'kode_unik'     => $order->kode_unik,
                );
            $this->header();
            $this->load->view('frontend/v_konf_pembayaran_form', $data);
            $this->footer();
        }

        else{
            $this->load->view('frontend/v_konf_pembayaran_form',$data=array('my_order' => 'no_data'));
        }
        
    }

    

    public function konf_pemb_action(){

        $sess_member=$this->session->userdata('sess_member');
        $id_member=$sess_member['id_member'];
        
        $config['upload_path']='./uploads/images/bukti_pembayaran/';
        $config['allowed_types']='jpeg|gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);
        $this->upload->do_upload('bukti_pembayaran');
        $nama_image=$this->upload->data();

        $id_data_order=$this->input->post('id_data_order');

        $cek_duplicate = $this->Konf_pembayaran_model->cek_duplicate_entry($id_data_order);
        if ($cek_duplicate ==NULL) {
        $data = array(
            'id_data_order' => $id_data_order,
            'nama_bank' => $this->input->post('nama_bank'),
            'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran'),
            'tanggal_pembayaran' => $this->input->post('tanggal_pembayaran'),
            'bank_pengirim' => $this->input->post('bank_pengirim'),
            'nama_rek_pengirim' => $this->input->post('nama_rek_pengirim'),
            'status_konfirmasi' => 'menunggu konfirmasi',
            'bukti_pembayaran' => $nama_image['file_name'],
            );

        $this->Konf_pembayaran_model->insert($data);

            $data2['id_data_order']  = $id_data_order;
            $data2['status_order']   = 'menunggu konfirmasi';

           $this->Order_model->update($id_data_order,$data2);
        }

        $this->session->set_flashdata('konfirmasi','joss');
         redirect(base_url());
    }
    
    public function download_order_review()
    {
        $c_dataumkm = $this->M_DataUmkm->get_all();

        $data = array(
            'c_dataumkm_data' => $c_dataumkm
        );

        $this->load->view('c_dataumkm/cetak_data_umkm_list', $data);
        $html = $this->output->get_output();
  
             // Load/panggil library dompdfnya
             $this->load->library('dompdf_gen');
  
            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            //utk menampilkan preview pdf
            $this->dompdf->stream("Daftar UMKM Kota Solo.pdf",array('Attachment'=>0));
            //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
            //$this->dompdf->stream("welcome.pdf");
    }
}

/* End of file Member.php */
/* Location: ./application/controllers/Member.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-02-23 01:50:00 */
/* http://harviacode.com */