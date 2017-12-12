<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk_model extends MY_Model
{
    protected $_table_name      = 'produk';
    protected $_order_by        = 'id_produk';
    protected $_order_by_type   = 'DESC';
    protected $_primary_key     = 'id_produk';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        return $this->db->get($this->_table_name)->result();
    }

    function get_all_home()//untuk home pada tampilan user
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        // $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        $this->db->where('status_produk','aktif');
        return $this->db->get($this->_table_name)->result();
    }

    function get_random_cart()//untuk tampilan related produk pada cart
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        // $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        $this->db->where('status_produk','aktif');
        $this->db->limit(4);
        $this->db->order_by('rand()');
        return $this->db->get($this->_table_name)->result();
    }

    function get_detail()
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        return $this->db->get($this->_table_name)->row();
    }

    //untuk melihat detail produk pada sisi front
    function front_get_detail($id,$slug)
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        $this->db->where('id_produk', $id);
        $this->db->where('slug', $slug);
        return $this->db->get($this->_table_name)->row();
    }

    function related_products($tema)
    {
        $this->db->like('tema',$tema);
        return $this->db->get($this->_table_name)->result();
    }

    function all_products($number,$from)
    {
        $this->db->where('status_produk', 'aktif');
        $this->db->order_by('rand()');
        return $this->db->get($this->_table_name,$number,$from)->result();
    }

    function jumlah_data()
    {
        $this->db->where('status_produk', 'aktif');
        return $this->db->get($this->_table_name)->num_rows();
    }

    function get_produk_enam()//untuk menampilkan produk pada halaman pilih metode pembayaran
    {
        $this->db->where('status_produk', 'aktif');
        $this->db->limit(6);
        return $this->db->get($this->_table_name)->result();
    }

    function jumlah_search($keywords)
    {
        $this->db->or_like('produk.nama_produk',$keywords);
        $this->db->or_like('produk.deskripsi_produk',$keywords);
        $this->db->where('status_produk', 'aktif');
        return $this->db->get($this->_table_name)->num_rows();
    }

    function search($per_page,$from,$keywords)
    {
        $this->db->or_like('produk.nama_produk',$keywords);
        $this->db->or_like('produk.deskripsi_produk',$keywords);
        $this->db->where('status_produk', 'aktif');
        return $this->db->get($this->_table_name,$per_page,$from)->result();
    }

    function jumlah_sort_by_tema($tema)
    {
        $this->db->where('status_produk', 'aktif');
        $this->db->like('tema', $tema);
        return $this->db->get('produk')->num_rows();
    }

    function sort_by_tema($tema, $number,$from)
    {
        $this->db->where('status_produk', 'aktif');
        $this->db->like('tema', $tema);
        $this->db->order_by('rand()');
        return $this->db->get($this->_table_name,$number,$from)->result();
    }


    function jumlah_sort_by_kategori($nama_kategori)
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        $this->db->where('nama_kategori', $nama_kategori);
        $this->db->where('status_produk', 'aktif');
        return $this->db->get($this->_table_name)->num_rows();
    }

    function sort_by_kategori($nama_kategori,$number,$from)
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        $this->db->where('nama_kategori', $nama_kategori);
        $this->db->where('status_produk', 'aktif');
        return $this->db->get($this->_table_name,$number,$from)->result();
    }

    function jumlah_sort_by_subkategori($nama_subkategori)
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        $this->db->where('nama_subkategori', $nama_subkategori);
        $this->db->where('status_produk', 'aktif');
        return $this->db->get($this->_table_name)->num_rows();
    }

    function sort_by_subkategori($nama_subkategori,$number,$from)
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');
        $this->db->where('nama_subkategori', $nama_subkategori);
        $this->db->where('status_produk', 'aktif');
        return $this->db->get($this->_table_name,$number,$from)->result();
    }

    function jumlah_filter_by_kategori($kat)
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');

        foreach ($kat as $kat) {
           $this->db->or_where('nama_kategori', $kat);
           $this->db->where('status_produk', 'aktif');
        }
        $data=$this->db->get($this->_table_name)->num_rows();
        return $data;
    }

    function filter_by_kategori($kat,$number,$from)
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');

        foreach ($kat as $kat) {
           $this->db->or_where('nama_kategori', $kat);
           $this->db->where('status_produk', 'aktif');
        }
        $data=$this->db->get($this->_table_name,$number,$from)->result();
        return $data;
    }

    function jumlah_filter_by_subkategori($subkat)
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');

        foreach ($subkat as $subkat) {
           $this->db->or_where('nama_subkategori', $subkat);
           $this->db->where('status_produk', 'aktif');
        }
        $data=$this->db->get($this->_table_name)->num_rows();
        return $data;
    }

    function filter_by_subkategori($subkat,$number,$from)
    {
        $this->db->join('tbl_subkategori','tbl_produk.id_subkategori=tbl_subkategori.id_subkategori','left');
        $this->db->join('tbl_kategori','tbl_subkategori.id_kategori=tbl_kategori.id_kategori','left');

        foreach ($subkat as $subkat) {
           $this->db->or_where('nama_subkategori', $subkat);
           $this->db->where('status_produk', 'aktif');
        }
        $data=$this->db->get($this->_table_name,$number,$from)->result();
        // $data=$this->db->get($this->table_produk)->result();
        return $data;
    }
}
