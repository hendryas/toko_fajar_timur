<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth_model extends CI_Model
{
  public function getDataUserByEmail($email)
  {
    $this->db->select('user.*');
    $this->db->from('user');
    $this->db->where('email', $email);

    $result = $this->db->get();
    return $result;
  }

  public function insertDataUser($data)
  {
    $this->db->insert('user', $data);
  }

  public function getDataUser($username)
  {
    $this->db->select('user.*');
    $this->db->from('user');
    $this->db->where('username', $username);

    $result = $this->db->get();
    return $result;
  }
}
