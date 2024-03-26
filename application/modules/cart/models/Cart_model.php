<?php

class Cart_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function simpan_transaksi($data)
  {
    $this->db->insert('rekap_pembayaran_pelanggan', $data);
  }

  public function simpan_rinci_transaksi($data_rinci)
  {
    $this->db->insert('tbl_rinci_transaksi', $data_rinci);
  }
}
