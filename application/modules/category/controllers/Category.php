<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('Category_model', 'categoryModel');
  }

  public function index()
  {
    $data['title'] = 'Category';

    $data['data_category'] = $this->categoryModel->getDataCategory()->result_array();
    $this->load->view('templates/header/header', $data);
    $this->load->view('category/category', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function insert_data()
  {
    $nama_kategori = htmlspecialchars($this->input->post('nama_kategori'));

    $data = [
      'kategori' => $nama_kategori,
      'delete_sts' => 0,
      'created_at	' => date('Y-m-d H:i:s')
    ];

    $qryInsert = $this->categoryModel->insertDataCategory($data);

    if ($qryInsert == 1) {
      $status = "OK";
      $message = "Berhasil Tambah Data!";
      $log = "";
    } else {
      $status = "ERROR";
      $message = "Query Tambah Data Gagal!";
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
    $id_kategori = htmlspecialchars($this->input->post('id_kategori'));
    $nama_kategori = htmlspecialchars($this->input->post('nama_kategori'));

    $data = [
      'kategori' => $nama_kategori,
      'updated_at' => date('Y-m-d H:i:s')
    ];

    $qryUpdate = $this->categoryModel->updateDataCategory($id_kategori, $data);

    if ($qryUpdate == 1) {
      $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                <strong>Berhasil Ubah Data!</strong></div>');
      redirect('category');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
      <strong>Query Ubah Data Gagal!</strong></div>');
      redirect('category');
    }
  }

  public function delete_data()
  {
    $id_kategori = htmlspecialchars($this->input->post('id_kategori'));

    $data = [
      'delete_sts' => 1,
    ];

    $qryUpdate = $this->categoryModel->updateDataCategory($id_kategori, $data);

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
  // hei
}
