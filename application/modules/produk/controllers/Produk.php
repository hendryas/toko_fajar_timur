<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('Produk_model', 'produkModel');
    $this->load->model('category/Category_model', 'categoryModel');
  }

  public function index()
  {
    $data['title'] = 'Produk';

    $data['data_produk'] = $this->produkModel->getDataProduk()->result_array();
    $data['data_category'] = $this->categoryModel->getDataCategory()->result_array();
    $this->load->view('templates/header/header', $data);
    $this->load->view('produk/produk', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function insert_data()
  {
    $kategori = htmlspecialchars($this->input->post('kategori'));
    $nama_barang = htmlspecialchars($this->input->post('nama_barang'));
    $harga = htmlspecialchars($this->input->post('harga'));
    $berat = htmlspecialchars($this->input->post('berat'));
    $deskripsi = htmlspecialchars($this->input->post('deskripsi'));
    $stok = htmlspecialchars($this->input->post('stok'));
    $gambar_barang = $_FILES['image']['name'];
    $created_at = date('Y-m-d H:i:s');
    $kode_product = random_string('alnum', 10);

    $his    = date("His");
    $thbl   = date("Ymd");

    $dname = explode(".", $_FILES['image']['name']);
    $ext = end($dname);
    $new_image = $_FILES['image']['name'] = strtolower('barang' . '_' . $thbl . '-' . $his . '.' . $ext);

    if ($gambar_barang != null) {
      $file_name1 = 'barang' . '_' . $thbl . '-' . $his;
      $config1['upload_path']          = './assets/img/barang/';
      // $config1['allowed_types']        = 'doc|docx|pdf';
      $config1['allowed_types']        = 'jpg|png|jpeg';
      $config1['max_size']             = 3023;
      $config1['remove_space']         = TRUE;
      $config1['file_name']            = $file_name1;

      $this->load->library('upload', $config1);

      if ($this->upload->do_upload('image')) {
        $this->upload->data();

        $data = [
          'id_kategori' => $kategori,
          'kode_product' => $kode_product,
          'nama_barang' => $nama_barang,
          'harga' => $harga,
          'berat' => $berat,
          'deskripsi' => $deskripsi,
          'stok' => $stok,
          'image' => $new_image,
          'delete_sts' => 0,
          'created_at' => $created_at
        ];

        $qryInsert = $this->produkModel->insertData($data);

        if ($qryInsert == 1) {
          $status = "OK";
          $message = "Berhasil Tambah Data!";
          $log = "";
        } else {
          $status = "ERROR";
          $message = "Query Tambah Data Gagal!";
          $log = "";
        }
      } else {
        $status = "ERROR";
        $message = "Query Tambah Data Gagal & Gagal Insert Gambar!";
        $log = "";
      }
    } else {
      $status = "ERROR";
      $message = "Gambar Barang Kosong!";
      $log = "";
    }

    $response = array(
      "status" => $status,
      "message" => $message,
      "log" => $log
    );
    echo json_encode($response);
  }

  public function edit_data()
  {
    $id = htmlspecialchars($this->input->post('id'));
    $kategori = htmlspecialchars($this->input->post('kategori'));
    $nama_barang = htmlspecialchars($this->input->post('nama_barang'));
    $harga = htmlspecialchars($this->input->post('harga'));
    $berat = htmlspecialchars($this->input->post('berat'));
    $deskripsi = htmlspecialchars($this->input->post('deskripsi'));
    $stok = htmlspecialchars($this->input->post('stok'));
    $gambar_barang = $_FILES['image']['name'];
    $updated_at = date('Y-m-d H:i:s');

    if ($gambar_barang != null) {
      $his    = date("His");
      $thbl   = date("Ymd");

      $dname = explode(".", $_FILES['image']['name']);
      $ext = end($dname);
      $new_image = $_FILES['image']['name'] = strtolower('barang' . '_' . $thbl . '-' . $his . '.' . $ext);

      $file_name1 = 'barang' . '_' . $thbl . '-' . $his;
      $config1['upload_path']          = './assets/img/barang/';
      // $config1['allowed_types']        = 'doc|docx|pdf';
      $config1['allowed_types']        = 'jpg|png|jpeg';
      $config1['max_size']             = 3023;
      $config1['remove_space']         = TRUE;
      $config1['file_name']            = $file_name1;

      $this->load->library('upload', $config1);

      if ($this->upload->do_upload('image')) {
        $this->upload->data();

        $data = [
          'id_kategori' => $kategori,
          'nama_barang' => $nama_barang,
          'harga' => $harga,
          'berat' => $berat,
          'deskripsi' => $deskripsi,
          'stok' => $stok,
          'image' => $new_image,
          'updated_at' => $updated_at
        ];

        $qryUpdate = $this->produkModel->updateData($id, $data);

        if ($qryUpdate == 1) {
          $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
          <strong>Berhasil Ubah Data!</strong></div>');
          redirect('produk');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
          <strong>Query Ubah Data Gagal!</strong></div>');
          redirect('produk');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
          <strong>Query Update Data Gagal & Gagal Update Gambar!</strong></div>');
        redirect('produk');
      }
    } else {
      $data = [
        'id_kategori' => $kategori,
        'nama_barang' => $nama_barang,
        'harga' => $harga,
        'berat' => $berat,
        'deskripsi' => $deskripsi,
        'stok' => $stok,
        'updated_at' => $updated_at
      ];

      $qryUpdate = $this->produkModel->updateData($id, $data);

      if ($qryUpdate == 1) {
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                    <strong>Berhasil Ubah Data!</strong></div>');
        redirect('produk');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
        <strong>Ubah Data Gagal!</strong></div>');
        redirect('produk');
      }
    }
  }

  public function delete_data()
  {
    $id = htmlspecialchars($this->input->post('id'));

    $data = [
      'delete_sts' => 1,
    ];

    $qryUpdate = $this->produkModel->updateData($id, $data);

    if ($qryUpdate == 1) {
      $status = "OK";
      $message = "Berhasil Menghapus Data!";
      $log = "";
    } else {
      $status = "ERROR";
      $message = "Query Menghapus Data Gagal!";
      $log = "";
    }

    $response = array(
      "status" => $status,
      "message" => $message,
      "log" => $log
    );
    echo json_encode($response);
  }
}
