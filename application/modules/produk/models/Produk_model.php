<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Produk_model extends CI_Model
{
  public function getDataProduk()
  {
    $this->db->select('a.*');
    $this->db->where('delete_sts', 0);
    $this->db->from('produk a');

    $query = $this->db->get();
    return $query;
  }

  public function insertData($data)
  {
    $this->db->insert('produk', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function updateData($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('produk', $data);

    $update = $this->db->affected_rows();

    if ($update == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function getDataProductDetail($id)
  {
    $this->db->select('produk.*');
    $this->db->where('produk.id', $id);
    $this->db->from('produk');

    $query = $this->db->get();
    return $query;
  }

  public function updateStokBarang($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('produk', $data);
  }
}
