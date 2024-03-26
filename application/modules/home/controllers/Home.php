<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');

    $this->load->model('home/Home_model', 'homeModel');
    $this->load->model('produk/Produk_model', 'produkModel');
  }
  public function index()
  {
    $data['title'] = 'Home';

    $data['data_product'] = $this->produkModel->getDataProduk()->result_array();

    $this->load->view('templates/header/headeruser', $data);
    $this->load->view('home/home', $data);
    $this->load->view('templates/footer/footeruser', $data);
  }
}
