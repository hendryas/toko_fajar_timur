<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function index()
    {

        if ($this->session->userdata('id_role') == 1) {
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('id_role');

            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                <strong>Anda sudah keluar! </strong> Silahkan login untuk melanjutkan kembali.</div>');
            redirect('login');
        } elseif ($this->session->userdata('id_role') == 2) {
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('id_role');

            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                <strong>Anda sudah keluar! </strong> Silahkan login untuk melanjutkan kembali.</div>');
            redirect('login');
        }
    }
}
