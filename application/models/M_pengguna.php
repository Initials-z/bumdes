<?php
class M_pengguna extends CI_Model
{
  public function saldo($id)
  {
    return $this->db->get_where('t_saldo', ['id_kios' => $id, 'status_penggunaan' => '1'])->row_array();
  }

  public function transaksi($id)
  {
    $this->db->order_by('kode_transaksi', 'DESC');
    $this->db->where('id_kios', $id);
    $data = $this->db->get('t_transaksi');
    return $data->result_array();
  }
  public function transaksi_admin()
  {
    return $this->db->get('t_transaksi')->result_array();
  }
  public function transaksi_pasca_admin()
  {
    return $this->db->get('t_transaksi')->result_array();
  }

  public function pos_profil()
  {
    $data = [
      'nama_kios' => $this->input->post('nama_kios'),
      'lokasi' => $this->input->post('lokasi')
    ];
    $this->db->where('id_kios', $this->input->post('id_kios'));
    $this->db->update('t_kios', $data);
  }
}
