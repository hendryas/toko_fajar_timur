<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
  //Method default yang selalu dijalankan ketika mengakses controller Auth
  public function __construct()
  {
    parent::__construct();
    ini_set('date.timezone', 'Asia/Jakarta');
    $this->load->model('produk/produk_model', 'barangModel');
    $this->load->model('cart/cart_model', 'cartModel');
    $this->load->model('user/User_model', 'userModel');
    // is_logged_in();
  }

  public function add()
  {
    if ($this->session->userdata('username') == '') {
      redirect('login');
    }
    $qty_barang = (int)$this->input->post('qty');
    $id_barang = $this->input->post('id');
    $cekStokBarang = $this->barangModel->getDataProductDetail($id_barang)->row_array();
    $stokBarang = (int)$cekStokBarang['stok'];

    if ($stokBarang >= $qty_barang) {
      $sisaStok = $stokBarang - $qty_barang;
      $data = [
        'stok' => $sisaStok
      ];
      $this->barangModel->updateStokBarang($id_barang, $data);
    } else {
      echo 'Opps... Stok Barang Habis!';
      die;
    }


    $redirect_page = $this->input->post('redirect_page');
    $data = array(
      'id'      => $this->input->post('id'),
      'qty'     => (int)$this->input->post('qty'),
      'price'   => $this->input->post('price'),
      'name'    => $this->input->post('name'),
    );

    $this->cart->insert($data);
    redirect($redirect_page, 'refresh');
  }

  public function viewcart()
  {
    $data['title'] = 'Halaman Cart';
    $email = $this->session->userdata('email');
    $data['data_user'] = $this->userModel->getDataUserByEmail($email)->row_array();

    $this->load->view('templates/header/headeruser', $data);
    $this->load->view('cart/viewcart', $data);
    $this->load->view('templates/footer/footeruser', $data);
  }

  public function updatebarangcart()
  {
    $i = 1;
    foreach ($this->cart->contents() as $items) {
      $data = array(
        'rowid' => $items['rowid'],
        'qty'   => $this->input->post($i . '[qty]')
      );

      $this->cart->update($data);
      $i++;
    }

    $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        <strong>Produk sudah di update!</strong></div>');
    redirect('cart/viewcart');
  }

  public function deletebarangcart($rowid, $qtycart, $id_barang)
  {
    $barang = $this->barangModel->getDataProductDetail($id_barang)->row_array();
    $stokBarang = (int)$barang['stok'];
    $qtyCart = (int)$qtycart;

    $hasilStokKembali = $stokBarang + $qtyCart;
    $data = [
      'stok' => $hasilStokKembali
    ];
    $this->barangModel->updateStokBarang($id_barang, $data);
    $this->cart->remove($rowid);
    redirect('cart/viewcart');
  }

  public function clearbarangcart()
  {
    $this->cart->destroy();
    redirect('home');
  }

  public function checkout()
  {
    $data['title'] = 'Halaman Checkout';
    $email = $this->session->userdata('email');
    $data['data_user'] = $this->userModel->getDataUserByEmail($email)->row_array();

    // $data['product'] = $this->barangModel->getDataProduct()->result_array();

    $this->load->view('templates/header/headeruser', $data);
    $this->load->view('cart/checkout', $data);
    $this->load->view('templates/footer/footeruser', $data);
  }

  public function proses_checkout()
  {
    $email = $this->session->userdata('email');
    $user = $this->menuModel->getDataUser($email)->row_array();
    $data = [
      'id_user' => $user['id'],
      'no_order' => $this->input->post('no_order'),
      'tgl_order' => date('Y-m-d H:i:s'),
      'nama_penerima' => $this->input->post('nama'),
      'provinsi' => $this->input->post('provinsi'),
      'kota' => $this->input->post('kota'),
      'alamat_penerima' => $this->input->post('alamat_penerima'),
      'grand_total' => $this->input->post('grand_total'),
      'total_bayar' => $this->input->post('total_bayar'),
      'hp_penerima' => $this->input->post('hp_penerima'),
      'status_pembayaran' => 0,
      'status_order' => 0,
      'date_created' => date('Y-m-d H:i:s'),
    ];
    $this->cartModel->simpan_transaksi($data);

    //simpak ke tbl rinci transaksi
    $i = 1;
    foreach ($this->cart->contents() as $items) {
      $data_rinci = array(
        'no_order' => $this->input->post('no_order'),
        'id_barang' => $items['id'],
        'qty' => $this->input->post('qty' . $i++),
      );
      $this->cartModel->simpan_rinci_transaksi($data_rinci);
    }

    $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
            <strong>Pesanan sudah di tambahkan!</strong></div>');
    $this->cart->destroy();
    redirect('rekappembayaran');
  }
}
