<?php

class M_kios extends CI_Model
{
  public function tampil()
  {
    $this->db->order_by('kode_kios', 'ASC');
    $tampil = $this->db->get('t_kios');
    return $tampil->result_array();
  }
  public function tampil_pengawas($pengawas)
  {
    // var_dump($pengawas);
    // die;
    $id = $pengawas['id_pengawas'];
    // return $this->db->get_where('t_kios', ['id_pengawas' => $id])->result_array();
    $this->db->where('id_pengawas', $id);
    $this->db->order_by('kode_kios', 'ASC');
    $tampil = $this->db->get('t_kios');
    return $tampil->result_array();
  }

  public function urutan_kios()
  {
    $this->db->select_max('kode_kios');
    $dapat = $this->db->get('t_kios');
    return $dapat->row_array();
  }

  public function urutan_transaksi()
  {
    $this->db->select_max('kode_transaksi');
    $dapat = $this->db->get('t_transaksi');
    return $dapat->row_array();
  }
  public function urutan_transaksi_pasca()
  {
    $this->db->select_max('kode_transaksi');
    $dapat = $this->db->get('t_transaksi_pasca');
    return $dapat->row_array();
  }

  public function input_kios()
  {
    $data = [
      'kode_kios' => htmlspecialchars($this->input->post('kode_kios')),
      'nama_kios' => htmlspecialchars($this->input->post('nama_kios')),
      'lokasi'    => htmlspecialchars($this->input->post('lokasi'))
    ];

    $akun = [
      'username' => htmlspecialchars($this->input->post('kode_kios')),
      'password' => password_hash($this->input->post('kode_kios'), PASSWORD_DEFAULT),
      'akses' => '1',
      'waktu_input' => time()
    ];
    $this->db->set('id_kios', 'UUID()', FALSE);
    $this->db->insert('t_kios', $data);

    $this->db->set('id_user', 'UUID()', FALSE);
    $this->db->insert('t_user', $akun);
  }

  public function hapus_kios($id)
  {
    $cek = $this->db->get_where('t_kios', ['id_kios' => $id])->row_array();

    $user = $this->db->get_where('t_user', ['username' => $cek['kode_kios']])->row_array();

    $this->db->delete('t_user', ['id_user' => $user['id_user']]);
    $this->db->delete('t_kios', ['id_kios' => $id]);
  }

  public function proses_edit()
  {
    $data = [
      'kode_kios' => htmlspecialchars($this->input->post('kode_kios')),
      'nama_kios' => htmlspecialchars($this->input->post('nama_kios')),
      'lokasi'    => htmlspecialchars($this->input->post('lokasi'))
    ];

    $this->db->where('id_kios', htmlspecialchars($this->input->post('id_kios')));
    $this->db->update('t_kios', $data);
  }

  public function reset_kios($id)
  {
    $cek = $this->db->get_where('t_kios', ['id_kios' => $id])->row_array();

    $user = $this->db->get_where('t_user', ['username' => $cek['kode_kios']])->row_array();

    $data = [
      'password' => password_hash($cek['kode_kios'], PASSWORD_DEFAULT)
    ];

    $this->db->where('id_user', $user['id_user']);
    $this->db->update('t_user', $data);
  }

  public function proses_saldo($tsp3)
  {
    $data = [
      'id_kios' => htmlspecialchars($this->input->post('id_kios')),
      'jumlah_saldo' => $tsp3,
      'tanggal_pengisian' => date('Y-m-d'),
      'status_penggunaan' => '1'
    ];

    $this->db->set('id_saldo', 'UUID()', FALSE);
    $this->db->insert('t_saldo', $data);
  }

  public function limit()
  {
    $this->db->order_by('status_penggunaan', 'ASC');
    $tampil = $this->db->get('t_saldo');
    return $tampil->result_array();
  }

  public function edit_saldo_kios()
  {
    $edit = [
      'id_saldo' => htmlspecialchars($this->input->post('id_saldo')),
      'id_kios' => htmlspecialchars($this->input->post('id_kios')),
      'jumlah_saldo' => htmlspecialchars($this->input->post('jumlah_saldo')),
    ];

    $this->db->where('id_saldo', htmlspecialchars($this->input->post('id_saldo')));
    $this->db->update('t_saldo', $edit);
  }

  public function hapus_limit($id)
  {
    $this->db->delete('t_saldo', ['id_saldo' => $id]);
  }

  public function jumlah_kios()
  {
    // count data t_kios
    $this->db->select('count(*) as jumlah_kios');
    $this->db->from('t_kios');
    $query = $this->db->get();
    return $query->row_array();
  }

  public function cek_kios($id)
  {
    $this->db->where('id_pengawas', $id);
    $this->db->order_by('kode_kios', 'ASC');
    return $this->db->get('t_kios')->result_array();
    // return $this->db->get_where('t_kios', ['id_pengawas' => $id])->result_array();
  }

  public function input_pilihan()
  {
    $id_kios = $this->input->post('pilihan');
    $jumlah = count($this->input->post('pilihan'));
    for ($i = 0; $i < $jumlah; $i++) {
      $this->db->where('id_kios', $id_kios[$i]);
      $this->db->update('t_kios', ['id_pengawas' => $this->input->post('id_pengawas')]);
    }
  }

  public function del_kios_pilihan($id)
  {
    $this->db->where('id_kios', $id);
    $this->db->update('t_kios', ['id_pengawas' => NULL]);
  }

  public function urutan_tiket()
  {
    $this->db->select_max('kode_tiket');
    $dapat = $this->db->get('t_topup');
    return $dapat->row_array();
  }
}
