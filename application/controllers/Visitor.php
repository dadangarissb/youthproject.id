<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor extends MY_Controller 
{
    protected $per_page   = 12;

	function __construct()
    {
        parent::__construct();
        $this->load->model(array('Produk_model','Gambar_produk_model','Customize_rules_model','Kategori_model','Subkategori_model','Tema_model','Member_model','Packaging_model','Slider_model'));
        $this->load->library(array('pagination','email','form_validation'));
        $this->load->helper(array('url','html','form'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $kategori   = $this->Kategori_model->get_all();
        $produk     = $this->Produk_model->get_all_home();
        $tema       = $this->Tema_model->get_all();
        $slider     =$this->Slider_model->get_slider();

        $data['produk']     = $produk;
        $data['kategori']   = $kategori;
        $data['tema']       = $tema;
        $data['slider']     = $slider;

        $this->header();
        $this->load->view('frontend/v_home',$data);
        $this->footer();
    }


    public function detail($id_produk,$slug)
    {   
        $sess_member=$this->session->userdata('sess_member');
        $id_member=$sess_member['id_member']; 
        
        $produk             =$this->Produk_model->front_get_detail($id_produk,$slug);

        if ($produk) 
        {
            $gambar_produk      = $this->Gambar_produk_model->get_by_id_produk($id_produk);
            $related            = $this->Produk_model->related_products($produk->tema);
            $packaging          = $this->Packaging_model->get();
            $customize_rules    = $this->Customize_rules_model->get_by_id_produk($id_produk);

            $kategori       =$this->Kategori_model->get_all();//for right sidebar
            $tema           =$this->Tema_model->get_all();//for right sidebar

            $data['produk']         = $produk;
            $data['packaging']      = $packaging;
            $data['id_produk']      = $produk->id_produk;
            $data['id_member']      = $id_member;
            $data['gambar_produk']  = $gambar_produk;
            $data['related']        = $related;
            $data['customize_rules']= $customize_rules;
            $data['customize_rules_for_image']= $customize_rules;

            $data['kategori']       =$kategori;
            $data['tema']           =$tema;
            $data['sess_member']    =$sess_member;

            $this->header();
            $this->load->view('frontend/v_detail_produk',$data);
            $this->footer();

        } 

        else
        {
            $this->load->view('frontend/v_error404');
        }
    }

    public function filter_by()
    {
        $param      =$this->uri->segment(2);
        $tema       =$this->Tema_model->get_all();
        $kategori   = $this->Kategori_model->get_all();
        $subkategori   = $this->Subkategori_model->get_all();
        // var_dump($search_result);
        $data['tema']           = $tema;
        $data['kategori']       = $kategori;
        $data['subkategori']    = $subkategori;


        if ($param=='kategori') {
            $kat=str_replace('-', ' ', $this->input->get('nama_kategori'));
       
            if ($kat) {
                $jumlah_data   = $this->Produk_model->jumlah_filter_by_kategori($kat);

                $config['base_url']     = base_url('filter-by/kategori/');
                $config['total_rows']   = $jumlah_data;
                $config['per_page']     = $this->per_page;
                $from = $this->uri->segment(3);
                $this->pagination->initialize($config);

                $produk=$this->Produk_model->filter_by_kategori($kat,$config['per_page'],$from);

                if ($jumlah_data<$this->per_page) 
                {
                    $per_page=$jumlah_data;
                }
                else
                {
                    $per_page=$this->per_page;
                }

                $data['produk'] = $produk;
                $data['jumlah_data']=$jumlah_data;
                $data['per_page']   =$per_page;

                $this->header();
                $this->load->view('frontend/v_all_products',$data);
                $this->footer();
            }
        }

        if ($param=='subkategori') {
            $subkat=str_replace('-', ' ', $this->input->get('nama_subkategori'));
       
            if ($subkat) {
                $jumlah_data   = $this->Produk_model->jumlah_filter_by_subkategori($subkat);

                $config['base_url']     = base_url('filter-by/subkategori/');
                $config['total_rows']   = $jumlah_data;
                $config['per_page']     = $per_page;
                $from = $this->uri->segment(3);
                $this->pagination->initialize($config);

                $produk=$this->Produk_model->filter_by_subkategori($subkat,$config['per_page'],$from);
                $data['produk'] = $produk;
                $data['jumlah_data']=$jumlah_data;
                $data['per_page']   =$per_page;

                $this->header();
                $this->load->view('frontend/v_all_products',$data);
                $this->footer();
            }
        }
    }

    public function all_products($from=NULL)
    {
        // $best_seller            = $this->Detail_order_model->best_seller();
        $jumlah_data            = $this->Produk_model->jumlah_data();

        $config['base_url']     = base_url('all-products/');
        $config['total_rows']   = $jumlah_data;
        $config['per_page']     = $this->per_page;
        $from                   = $this->uri->segment(2);
        $this->pagination->initialize($config);

        $produk         = $this->Produk_model->all_products($config['per_page'],$from);
        $kategori       =$this->Kategori_model->get_all();//for left sidebar
        $subkategori    =$this->Subkategori_model->get_all();//for left sidebar
        $tema           =$this->Tema_model->get_all();//for left sidebar

        if ($jumlah_data<$this->per_page) 
        {
            $per_page=$jumlah_data;
        }
        else
        {
            $per_page=$this->per_page;
        }

        $data['produk']     =$produk;
        $data['jumlah_data']=$jumlah_data;
        $data['per_page']   =$per_page;
        $data['subkategori']=$subkategori;
        $data['kategori']   =$kategori;
        $data['tema']       =$tema;
        
        // $data['best_seller']= $best_seller;
        $this->header();
        $this->load->view('frontend/v_all_products',$data);
        $this->footer();
    }

    public function search($from=NULL) 
    {
        $keywords    =$this->input->get('keywords');
        // $best_seller = $this->Detail_order_model->best_seller();

        $jumlah_data            = $this->Produk_model->jumlah_search($keywords);

        $config['base_url']     = base_url('search/');
        $config['total_rows']   = $jumlah_data;
        $config['per_page']     = $this->per_page;
        $from                   = $this->uri->segment(3);
        $this->pagination->initialize($config);

        $search_result  =$this->Produk_model->search($config['per_page'],$from,$keywords);
        $tema           =$this->Tema_model->get_all();
        $kategori       = $this->Kategori_model->get_all();
        $subkategori    = $this->Subkategori_model->get_all();
        // var_dump($search_result);

        if ($jumlah_data<$this->per_page) 
        {
            $per_page=$jumlah_data;
        }
        else
        {
            $per_page=$this->per_page;
        }

        $data['produk']         = $search_result;
        $data['tema']           = $tema;
        $data['kategori']       = $kategori;
        $data['subkategori']    = $subkategori;
        $data['jumlah_data']    =$jumlah_data;
        $data['per_page']       =$per_page;
        // $data['best_seller']    = $best_seller;

        $session = '<p>Menampilkan hasil pencarian untuk kata kunci '.'"'.$keywords.'"'.'</p>';
        $this->session->set_flashdata('message_success', $session);

        $this->header();
        $this->load->view('frontend/v_all_products', $data);
        $this->footer();
    }

    public function sort_by_tema($nama_tema) 
    {
        $tema           = $this->Tema_model->get_all();//untuk sidebar
        $kategori       = $this->Kategori_model->get_all();
        $subkategori    = $this->Subkategori_model->get_all();

        $nama_tema=str_replace('-', ' ', $nama_tema);
        $jumlah_data            = $this->Produk_model->jumlah_sort_by_tema($nama_tema);

        $config['base_url']     = base_url('kado-untuk/'.$nama_tema."/");
        $config['total_rows']   = $jumlah_data;
        $config['per_page']     = $this->per_page;
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);

        $sort_by_tema           =$this->Produk_model->sort_by_tema($nama_tema, $config['per_page'],$from);

        if ($jumlah_data<$this->per_page) 
        {
            $per_page=$jumlah_data;
        }
        else
        {
            $per_page=$this->per_page;
        }
    
        $data['produk']         = $sort_by_tema;
        $data['jumlah_data']    = $jumlah_data;
        $data['per_page']       = $per_page;
        $data['tema']           = $tema;
        $data['kategori']       = $kategori;
        $data['subkategori']    = $subkategori;
        
        $session = '<p>Menampilkan hasil pencarian untuk kata kunci '.'"'.$nama_tema.'"'.'</p>';
        $this->session->set_flashdata('message_success', $session);

        $this->header();
        $this->load->view('frontend/v_all_products',$data);
        $this->footer();
    }

    public function register_member()
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

        $data = array(
            'email'         => set_value('email'),
            'nama_member'   => set_value('nama_member'),
            'no_hp'         => set_value('no_hp'),
            'tgl_lahir'     => set_value('tgl_lahir'),
            'alamat_member' => set_value('alamat_member'),
            'err'           => $err,
            'response'      => $response,
            );

        $this->header();
        $this->load->view('frontend/v_member_register_form',$data);
        $this->footer();
    }

    public function cek_email()
    {
        $email      =$this->input->get('email');
        $cek_email  =$this->Member_model->get_by_email($email);

        if ($cek_email == 1) {
            echo "email ini sudah terdaftar, silahkan gunakan email lain";
        }
        else
        {
            echo "";
        }
    }

    public function register_action() 
    {
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required|min_length[5]'); // min_length[5] password tidak boleh kurang dari lima
        $this->form_validation->set_rules('confirm_password','Retype Password','required|min_length[5]|matches[password]'); // matches[password] mencocokan password
        $this->form_validation->set_rules('nama_member','Nama','required'); 
        $this->form_validation->set_rules('no_hp','Nomor Handphone','required'); 
        $this->form_validation->set_rules('tgl_lahir','Tanggal lahir','required'); 
        $this->form_validation->set_rules('alamat_member','Alamat','required'); 
        
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
       
        if ($this->form_validation->run()==FALSE){
            $this->register_member(); // file form_view.php
        }
       
        else {      
            $email=$this->input->post('email');
            $cek_email=$this->Member_model->get_by_email($email);

            if ($cek_email == 1) {
                $this->session->set_flashdata('email','email sudah terdaftar, silahkan gunakan email yang lain');
                $this->register();
            }
            else
            {
            $rand=uniqid();
            $id_member=date('his').date('Ymd').$rand;
            $password = $this->input->post('password',TRUE);


            $data = array(
                    'id_member'    => $id_member,
                    'password'    => md5($password).substr($email, 0,2),
                    'email'       => $this->input->post('email',TRUE),
                    'nama_member' => $this->input->post('nama_member',TRUE),
                    'no_hp'       => $this->input->post('no_hp',TRUE),
                    'tgl_lahir'   => $this->input->post('tgl_lahir',TRUE),
                    'alamat_member' => $this->input->post('alamat_member',TRUE),
                    'id_provinsi' => $this->input->post('id_provinsi',TRUE),
                    'id_kota'     => $this->input->post('id_kota',TRUE),
                    // 'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
                    'status_member' => 'belum aktif',
                   );

            $to_email   =$this->input->post('email',TRUE);
            $nama_member=$this->input->post('nama_member',TRUE);
            $id_member  =$id_member; 

            $insert=$this->Member_model->insert($data);

            if($insert){
                    //kirim email verifikasi
                    $from_email = 'youthproject.office@gmail.com';
                    $subject ='Verify your email address';
                    $message = '
                    <h2 class="name" style="margin-top: -8px; text-align:center; padding:10px; background-color: #DC143C; color:white">verifikasi pendaftaran</h2>
                        Kepada Yth '.$nama_member.'<br/><br/> Silahkan klik link dibawah ini untuk memverifikasi akun anda.<br/><br/>'.base_url('confirm-email-verification')."/".$id_member.'<br/><br/><br/> Terimakasih';
                

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
                    //$this->email->attach($output,'application/pdf','invoice.pdf', false);
                    $kirim=$this->email->send();

                //kirim email verifikasi
                if($kirim)
                {
                    //sukses kirim email
                    $this->session->set_flashdata('msg_success','<b>Registrasi berhasil!</b> Silahkan aktifkan akun anda melalui link yang kami kirimkan ke email anda');
                    redirect(site_url('member/login'));
                }
                else
                {
                // error
                $this->session->set_flashdata('msg_error_email','Oops! Email verifikasi belum terkirim ke email anda, silahkan klik tombol kirim email berikut ini!!!');
                $this->session->set_flashdata('to_email',$to_email);
                $this->session->set_flashdata('nama_member',$nama_member);
                $this->session->set_flashdata('id_member',$id_member);
                redirect(site_url('member/login'));
                }
            }

            else
                {
                    // error
                    $this->session->set_flashdata('msg_error_register','Oops! Error. Pendaftaran gagal, silahkan coba lagi!!');
                    redirect(site_url('member/register'));
                }
            }
        }
    }

    function verify($id_member=NULL)  
    {
        if ($this->Member_model->verify_email_id($id_member))
        {
            $this->session->set_flashdata('msg_success','<div class="alert alert-success text-center">Email anda telah terverifikasi, silahkan login untuk menggunakan layanan kami</div>');
            redirect('member/login');
        }
        else
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Opps, maaf error!</div>');
            redirect('user/register');
        }
    }

    public function resend_email_verification()
    {
        $to_email   =$this->input->post('email',TRUE);
        $nama_member=$this->input->post('nama_member',TRUE);
        $id_member  =$this->input->post('id_member',TRUE);
        //kirim email verifikasi
        $from_email = 'youthproject.office@gmail.com';
        $subject ='Verify your email address';
        $message = '
        <h2 class="name" style="margin-top: -8px; text-align:center; padding:10px; background-color: #DC143C; color:white">verifikasi pendaftaran</h2>
            Kepada Yth '.$nama_member.'<br/><br/> Silahkan klik link dibawah ini untuk memverifikasi akun anda.<br/><br/>'.base_url('confirm-email-verification')."/".$id_member.'<br/><br/><br/> Terimakasih';
                

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
        //$this->email->attach($output,'application/pdf','invoice.pdf', false);
        $kirim=$this->email->send();

    //kirim email verifikasi
    if($kirim)
    {
        //sukses kirim email
        $this->session->set_flashdata('msg_success','<b>Registrasi berhasil!</b> Silahkan aktifkan akun anda melalui link yang kami kirimkan ke email anda');
        redirect(site_url('member/login'));
    }
    else
    {
    // error
    $this->session->set_flashdata('msg_error_email','Oops! Email verifikasi belum terkirim ke email anda, silahkan klik tombol kirim email berikut ini!!!');
    $this->session->set_flashdata('to_email',$to_email);
    $this->session->set_flashdata('nama_member',$nama_member);
    $this->session->set_flashdata('id_member',$id_member);
    redirect(site_url('member/login'));
    }

    }

    public function sort_by($rules,$param) 
    {
        if ($rules=='kategori') {
            $nama_kategori = str_replace('-', ' ', $param);
            $jumlah_data            = $this->Produk_model->jumlah_sort_by_kategori($nama_kategori);
            $config['base_url']     = base_url('sort-by/kategori/'.$param."/");
            $config['total_rows']   = $jumlah_data;
            $config['per_page']     = $this->per_page;
            $from = $this->uri->segment(4);
            $this->pagination->initialize($config);

            $produk =$this->Produk_model->sort_by_kategori($nama_kategori, $config['per_page'],$from);
            $kategori       =$this->Kategori_model->get_all();//for left sidebar
            $subkategori    =$this->Subkategori_model->get_all();//for left sidebar
            $tema           =$this->Tema_model->get_all();//for left sidebar

            if ($jumlah_data<$this->per_page) 
            {
                $per_page=$jumlah_data;
            }
            else
            {
                $per_page=$this->per_page;
            }

            $data['produk']     =$produk;
            $data['subkategori']=$subkategori;
            $data['kategori']   =$kategori;
            $data['jumlah_data']    = $jumlah_data;
            $data['per_page']       = $this->per_page;
            $data['tema']       =$tema;

            $session = '<p>Menampilkan hasil pencarian untuk kata kunci '.'"'.$nama_kategori.'"'.'</p>';
            $this->session->set_flashdata('message_success', $session);

            $this->header();
            $this->load->view('frontend/v_all_products',$data);
            $this->footer();
        }

        else if ($rules=='subkategori') {
            $nama_subkategori = str_replace('-', ' ', $param);
            $jumlah_data            = $this->Produk_model->jumlah_sort_by_subkategori($nama_subkategori);
            $config['base_url']     = base_url('sort-by/subkategori/'.$param."/");
            $config['total_rows']   = $jumlah_data;
            $config['per_page']     = $this->per_page;
            $from = $this->uri->segment(4);
            $this->pagination->initialize($config);

            $produk =$this->Produk_model->sort_by_subkategori($nama_subkategori, $config['per_page'],$from);
            $kategori       =$this->Kategori_model->get_all();//for left sidebar
            $subkategori    =$this->Subkategori_model->get_all();//for left sidebar
            $tema           =$this->Tema_model->get_all();//for left sidebar

            if ($jumlah_data<$this->per_page) 
            {
                $per_page=$jumlah_data;
            }
            else
            {
                $per_page=$this->per_page;
            }

            $data['produk']     =$produk;
            $data['subkategori']=$subkategori;
            $data['kategori']   =$kategori;
            $data['tema']       =$tema;
            $data['jumlah_data']    = $jumlah_data;
            $data['per_page']       = $this->per_page;

            $session = '<p>Menampilkan hasil pencarian untuk kata kunci '.'"'.$nama_subkategori.'"'.'</p>';
            $this->session->set_flashdata('message_success', $session);

            $this->header();
            $this->load->view('frontend/v_all_products',$data);
            $this->footer(  );
        }
    }

    public function konfirmasi_pembayaran_no_login()
    {
        $id_data_order = $this->input->get('id_data_order');
        $my_order = $this->Order_model->get_my_order($id_data_order);
        
        if ($my_order) {
            $order=$this->Order_model->get_by_id($my_order->id_data_order);
            $my_detail = $this->Detail_order_model->get_by_id_order($my_order->id_data_order);
            $data=array(
                'my_detail' => $my_detail,
                'id_data_order' => $my_order->id_data_order,
                'total_ongkir' => $order->total_ongkir,
                'total_harga_no_ongkir'=> $order->total_harga_no_ongkir,
                'grand_total'=> $order->grand_total,
                );
            $this->header();
            $this->load->view('frontend/v_konf_pembayaran_form', $data);
            $this->footer();
        }

        else{
            $this->header();
            $this->load->view('frontend/v_konf_pembayaran_form',$data=array('my_detail' => 'no_data'));
            $this->footer();
        }
        
    }

    //untuk my cart jika belum login
    public function my_cart()
    {
        $id_member      = NULL;

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

}