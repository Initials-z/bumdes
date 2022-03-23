<?php
class M_koordinator extends CI_Model
{
  public function get_koordinator()
  {
    return $this->db->get('t_pengawas')->result_array();
  }

  public function input_koordinator()
  {
    $data = [
      'nama_pengawas' => htmlspecialchars($this->input->post('nama_pengawas')),
      'email_pengawas' => htmlspecialchars($this->input->post('email_pengawas')),
      'no_hp' => htmlspecialchars($this->input->post('no_hp')),
      'alamat' => htmlspecialchars($this->input->post('alamat')),
      'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir')),
      'tanggal_lahir' => $this->input->post('tanggal_lahir'),
      'foto' => 'user.png'
    ];

    $ps = 12345;
    $waktu = date('Y-m-d H:i:s');
    $akun = [
      'username' => htmlspecialchars($this->input->post('email_pengawas')),
      'password' => password_hash($ps, PASSWORD_DEFAULT),
      'akses' => '2',
      'waktu_input' => $waktu
    ];

    $this->db->set('id_pengawas', 'UUID()', FALSE);
    $this->db->insert('t_pengawas', $data);

    $this->db->set('id_user', 'UUID()', FALSE);
    $this->db->insert('t_user', $akun);
  }

  public function profil($id)
  {
    return $this->db->get_where('t_pengawas', ['id_pengawas' => $id])->row_array();
  }

  public function jumlah_koordinator()
  {
    $this->db->select('count(*) as jumlah_pengawas');
    $this->db->from('t_pengawas');
    $query = $this->db->get();
    return $query->row_array();
  }

  public function hapus_pengawas($id)
  {
    // $cek = $this->db->get_where('t_kios', ['id_kios' => $id])->row_array();

    $this->db->where('id_pengawas', $id);
    $this->db->update('t_kios', ['id_pengawas' => NULL]);

    $this->db->where('id_pengawas', $id);
    $this->db->delete('t_pengawas');
  }
}
