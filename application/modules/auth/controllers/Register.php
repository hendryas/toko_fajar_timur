<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('Auth_model', 'authModel');
  }

  public function index()
  {
    $data['title'] = 'Register';

    $this->load->view('templates/header/headeruser', $data);
    $this->load->view('auth/register', $data);
    $this->load->view('templates/footer/footeruser', $data);
  }

  public function notfound()
  {
    $data['title'] = 'Halaman Tidak ditemukan';

    $this->load->view('templates/header/header', $data);
    $this->load->view('auth/notfound', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function registration()
  {
    $nama = $this->input->post('nama');
    $username = $this->input->post('username');
    $no_hp = $this->input->post('no_hp');
    $email = $this->input->post('email');
    $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

    $data = [
      'nama' => $nama,
      'username' => $username,
      'no_hp' => $no_hp,
      'email' => $email,
      'password' => $password,
      'id_role' => 2,
      'is_active' => 1,
      'delete_sts' => 0,
      'created_at' => date('Y-m-d H:i:s')
    ];

    $this->authModel->insertDataUser($data);

    $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
    <strong>Selamat akun anda sudah di buat!</strong></div>');
    redirect('login');
  }
}
