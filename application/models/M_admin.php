<?php

class M_admin extends CI_Model
{
  public function tampil()
  {
    return $this->db->get('t_admin')->result_array();
  }

  public function input($gambar)
  {
    $data = [
      'nama_admin' => htmlspecialchars($this->input->post('nama_admin')),
      'email_admin' => htmlspecialchars($this->input->post('email_admin')),
      'no_hp' => htmlspecialchars($this->input->post('no_hp')),
      'alamat' => htmlspecialchars($this->input->post('alamat')),
      'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir')),
      'tanggal_lahir' => $this->input->post('tanggal_lahir'),
      'foto' => $gambar
    ];

    // var_dump($data);

    $ps = 12345;
    $waktu = date('Y-m-d H:i:s');
    $akun = [
      'username' => htmlspecialchars($this->input->post('email_admin')),
      'password' => password_hash($ps, PASSWORD_DEFAULT),
      'akses' => '0',
      'waktu_input' => $waktu
    ];

    $this->db->set('id_admin', 'UUID()', FALSE);
    $this->db->insert('t_admin', $data);

    $this->db->set('id_user', 'UUID()', FALSE);
    $this->db->insert('t_user', $akun);
  }

  public function hapus($id)
  {
    $pilih = $this->db->get_where('t_admin', ['id_admin' => $id])->row_array();

    if ($pilih['foto'] == 'user.png') {
      $ambil = $this->db->get_where('t_user', ['username' => $pilih['email_admin']])->row_array();
      $this->db->where('id_user', $ambil['id_user']);
      $this->db->delete('t_user');

      $this->db->where('id_admin', $id);
      $this->db->delete('t_admin');
    } else {
      $ambil = $this->db->get_where('t_user', ['username' => $pilih['email_admin']])->row_array();

      $lokasi = './gambar/admin/' . $pilih['foto'];
      unlink($lokasi);
      $this->db->where('id_user', $ambil['id_user']);
      $this->db->delete('t_user');

      $this->db->where('id_admin', $id);
      $this->db->delete('t_admin');
    }
  }

  public function tampil_profile_admin($id)
  {
    return $this->db->get_where('t_admin', ['id_admin' => $id])->row_array();
  }

  public function edit_proses($id, $gambar)
  {
    $data = [
      'nama_admin' => htmlspecialchars($this->input->post('nama_admin')),
      'email_admin' => htmlspecialchars($this->input->post('email_admin')),
      'no_hp' => htmlspecialchars($this->input->post('no_hp')),
      'alamat' => htmlspecialchars($this->input->post('alamat')),
      'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir')),
      'tanggal_lahir' => $this->input->post('tanggal_lahir'),
      'foto' => $gambar
    ];

    $this->db->where('id_admin', $id);
    $this->db->update('t_admin', $data);
  }

  public function jumlah_admin()
  {
    // count data as t_admin
    $this->db->select('count(*) as jumlah_admin');
    $this->db->from('t_admin');
    $query = $this->db->get();
    return $query->row_array();
  }

  public function edit_profil($gambar)
  {
    if ($gambar == "kosong") {
      $data = [
        'nama_admin' => htmlspecialchars($this->input->post('nama_admin')),
        'email_admin' => htmlspecialchars($this->input->post('email_admin')),
        'no_hp' => htmlspecialchars($this->input->post('no_hp')),
        'alamat' => htmlspecialchars($this->input->post('alamat')),
        'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir')),
        'tanggal_lahir' => $this->input->post('tanggal_lahir')
      ];

      $this->db->where('id_admin', $this->input->post('id_admin'));
      $this->db->update('t_admin', $data);
    } else {
      $data = [
        'nama_admin' => htmlspecialchars($this->input->post('nama_admin')),
        'email_admin' => htmlspecialchars($this->input->post('email_admin')),
        'no_hp' => htmlspecialchars($this->input->post('no_hp')),
        'alamat' => htmlspecialchars($this->input->post('alamat')),
        'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir')),
        'tanggal_lahir' => $this->input->post('tanggal_lahir'),
        'foto' => $gambar
      ];

      $this->db->where('id_admin', $this->input->post('id_admin'));
      $this->db->update('t_admin', $data);
    }
  }

  public function nonaktif($id)
  {
    $this->db->where('id_user', $id);
    $this->db->update('t_user', ['akun' => '0']);
  }
  public function aktif($id)
  {
    $this->db->where('id_user', $id);
    $this->db->update('t_user', ['akun' => '1']);
  }

  public function reset_admin($id)
  {
    $this->db->where('id_user', $id);
    $this->db->update('t_user', ['password' => password_hash('12345', PASSWORD_DEFAULT)]);
  }

  public function filter_laporan()
  {
    // var_dump($this->input->post());
    // die;
    if ($this->input->post('id_kios') == "-Pilih Kios-") {
      $this->db->where('tanggal >=', $this->input->post('mulai'));
      $this->db->where('tanggal <=', $this->input->post('selesai'));
      $data = $this->db->get('t_transaksi');
      return $data->result_array();
    } elseif ($this->input->post('id_kios') == null) {
      $this->db->where('tanggal >=', $this->input->post('mulai'));
      $this->db->where('tanggal <=', $this->input->post('selesai'));
      $data = $this->db->get('t_transaksi');
      return $data->result_array();
    } else {
      $this->db->where('tanggal >=', $this->input->post('mulai'));
      $this->db->where('tanggal <=', $this->input->post('selesai'));
      $this->db->where('id_kios', $this->input->post('id_kios'));
      $data = $this->db->get('t_transaksi');
      return $data->result_array();
    }
  }

  public function filter_laporan_pasca()
  {
    // var_dump($this->input->post());
    // die;
    if ($this->input->post('id_kios') == "-Pilih Kios-") {
      $this->db->where('tanggal >=', $this->input->post('mulai'));
      $this->db->where('tanggal <=', $this->input->post('selesai'));
      $data = $this->db->get('t_transaksi_pasca');
      return $data->result_array();
    } elseif ($this->input->post('id_kios') == null) {
      $this->db->where('tanggal >=', $this->input->post('mulai'));
      $this->db->where('tanggal <=', $this->input->post('selesai'));
      $data = $this->db->get('t_transaksi_pasca');
      return $data->result_array();
    } else {
      $this->db->where('tanggal >=', $this->input->post('mulai'));
      $this->db->where('tanggal <=', $this->input->post('selesai'));
      $this->db->where('id_kios', $this->input->post('id_kios'));
      $data = $this->db->get('t_transaksi_pasca');
      return $data->result_array();
    }
  }
  public function filter_cetak_laporan($mulai, $selesai, $id_kios)
  {
    // var_dump($this->input->post());
    // die;
    if ($id_kios == "-Pilih Kios-") {
      $this->db->where('tanggal >=', $mulai);
      $this->db->where('tanggal <=', $selesai);
      $data = $this->db->get('t_transaksi');
    } elseif ($id_kios == null) {
      $this->db->where('tanggal >=', $mulai);
      $this->db->where('tanggal <=', $selesai);
      $data = $this->db->get('t_transaksi');
    } else {
      $this->db->where('tanggal >=', $mulai);
      $this->db->where('tanggal <=', $selesai);
      $this->db->where('id_kios', $id_kios);
      $data = $this->db->get('t_transaksi');
    }
    return $data->result_array();
  }
  public function filter_cetak_laporan_pasca($mulai, $selesai, $id_kios)
  {
    // var_dump($this->input->post());
    // die;
    if ($id_kios == "-Pilih Kios-") {
      $this->db->where('tanggal >=', $mulai);
      $this->db->where('tanggal <=', $selesai);
      $data = $this->db->get('t_transaksi_pasca');
    } elseif ($id_kios == null) {
      $this->db->where('tanggal >=', $mulai);
      $this->db->where('tanggal <=', $selesai);
      $data = $this->db->get('t_transaksi_pasca');
    } else {
      $this->db->where('tanggal >=', $mulai);
      $this->db->where('tanggal <=', $selesai);
      $this->db->where('id_kios', $id_kios);
      $data = $this->db->get('t_transaksi_pasca');
    }
    return $data->result_array();
  }

  public function setoran()
  {
    $this->db->order_by('tanggal_setoran', 'DESC');
    $data = $this->db->get('t_setoran');
    return $data->result_array();
  }

  public function proses_setoran()
  {
    $waktu = date('Y-m-d H:i:s');
    $pengawas = $this->db->get_where('t_kios', ['id_kios' => $this->input->post('id_kios')])->row_array();

    // var_dump($waktu);
    // die;

    $pos = [
      'id_kios' => htmlspecialchars($this->input->post('id_kios')),
      'jumlah' => htmlspecialchars($this->input->post('jumlah')),
      'tanggal_setoran' => $waktu,
      'id_pengawas' => $pengawas['id_pengawas']
    ];

    $this->db->set('id_setoran', 'UUID()', FALSE);
    $cek = $this->db->insert('t_setoran', $pos);

    // var_dump($cek);
    // die;
  }

  public function hapus_setoran($id)
  {
    $this->db->where('id_setoran', $id);
    $this->db->delete('t_setoran');
  }
}
