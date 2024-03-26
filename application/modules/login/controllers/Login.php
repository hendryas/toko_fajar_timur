<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('auth/Auth_model', 'authModel');
  }
  public function index()
  {
    $data['title'] = 'Login';

    $this->load->view('templates/header/headeruser', $data);
    $this->load->view('login/login', $data);
    $this->load->view('templates/footer/footeruser', $data);
  }

  public function loginuser()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->authModel->getDataUser($username)->row_array();

    // Jika usernya ada
    if ($user) {
      //jika usernya aktif
      if ($user['is_active'] == 1) {
        // cek password
        if (password_verify($password, $user['password'])) {
          // jika data benar
          $data = [
            'id' => $user['id'],
            'email' => $user['email'],
            'username' => $username,
            'id_role' => $user['id_role']
          ];
          $this->session->set_userdata($data);
          if ($user['id_role'] == 1) {
            redirect('dashboard');
          } elseif ($user['id_role'] == 2) {
            redirect('home');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                        <strong>Password salah!</strong> Silahkan coba lagi.</div>');
          redirect('login');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                    <strong>E-mail ini belum di aktivasi!</strong> Silahkan cek email anda untuk mengaktivasi E-mail anda.</div>');
        redirect('login');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                <strong>Username belum terdaftar!</strong> Silahkan daftarkan Username anda.</div>');
      redirect('login');
    }
  }
}
