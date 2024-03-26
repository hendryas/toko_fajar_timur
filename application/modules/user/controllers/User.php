<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('User_model', 'userModel');
  }

  public function index()
  {
    $data['title'] = 'User';

    $data['data_user'] = $this->userModel->getDataUser()->result_array();
    $this->load->view('templates/header/header', $data);
    $this->load->view('user/user', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function insert_data()
  {
    $nama = htmlspecialchars($this->input->post('nama'));
    $username = htmlspecialchars($this->input->post('username'));
    $alamat = htmlspecialchars($this->input->post('alamat'));
    $email = htmlspecialchars($this->input->post('email'));
    $phone = htmlspecialchars($this->input->post('phone'));
    $gambar_user = $_FILES['image']['name'];
    $role = htmlspecialchars($this->input->post('role'));
    $is_active = htmlspecialchars($this->input->post('is_active'));
    $password = htmlspecialchars($this->input->post('password'));
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $his    = date("His");
    $thbl   = date("Ymd");

    $dname = explode(".", $_FILES['image']['name']);
    $ext = end($dname);
    $new_image = $_FILES['image']['name'] = strtolower('user' . '_' . $thbl . '-' . $his . '.' . $ext);

    if ($gambar_user != null) {
      $file_name1 = 'user' . '_' . $thbl . '-' . $his;
      $config1['upload_path']          = './assets/img/user/';
      // $config1['allowed_types']        = 'doc|docx|pdf';
      $config1['allowed_types']        = 'jpg|png|jpeg';
      $config1['max_size']             = 3023;
      $config1['remove_space']         = TRUE;
      $config1['file_name']            = $file_name1;

      $this->load->library('upload', $config1);

      if ($this->upload->do_upload('image')) {
        $this->upload->data();

        $data = [
          'nama' => $nama,
          'username' => $username,
          'alamat' => $alamat,
          'email' => $email,
          'no_hp' => $phone,
          'image' => $new_image,
          'id_role' => $role,
          'is_active' => $is_active,
          'password' => $password_hash,
          'delete_sts' => 0,
          'created_at' => $created_at,
          'updated_at' => $updated_at
        ];

        $qryInsert = $this->userModel->insertData($data);

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
    $id_user =  htmlspecialchars($this->input->post('id_user'));
    $nama = htmlspecialchars($this->input->post('nama'));
    $username = htmlspecialchars($this->input->post('username'));
    $alamat = htmlspecialchars($this->input->post('alamat'));
    $email = htmlspecialchars($this->input->post('email'));
    $phone = htmlspecialchars($this->input->post('phone'));
    $role = htmlspecialchars($this->input->post('role'));
    $is_active = htmlspecialchars($this->input->post('is_active'));
    $password = htmlspecialchars($this->input->post('password'));
    $updated_at = date('Y-m-d H:i:s');

    if ($password != '' || $password != null) {
      $password_hash = password_hash($password, PASSWORD_DEFAULT);

      $data = [
        'nama' => $nama,
        'username' => $username,
        'alamat' => $alamat,
        'email' => $email,
        'no_hp' => $phone,
        'password' => $password_hash,
        'id_role' => $role,
        'is_active' => $is_active,
        'updated_at' => $updated_at
      ];
    } else {
      $data = [
        'nama' => $nama,
        'username' => $username,
        'email' => $email,
        'no_hp' => $phone,
        'alamat' => $alamat,
        'id_role' => $role,
        'is_active' => $is_active,
        'updated_at' => $updated_at
      ];
    }

    $this->userModel->updateData($id_user, $data);

    $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
    <strong>Berhasil Edit Data!</strong></div>');
    redirect('user');
  }

  public function delete_data()
  {
    $id_user = htmlspecialchars($this->input->post('id_user'));

    $data = [
      'delete_sts' => 1,
    ];

    $qryUpdate = $this->userModel->updateDataUserById($id_user, $data);

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
