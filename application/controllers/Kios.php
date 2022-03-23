<?php

class Kios extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_kios');
    $this->load->model('M_admin');
    $this->load->model('M_mobilepulsa');

    $this->load->library('form_validation');
    if (!$this->session->userdata('username')) {
      redirect('Welcome/not_found');
    } elseif ($this->session->userdata('akses') == '1') {
      redirect('Welcome/not_found');
    }
  }

  public function index()
  {
    $data = [
      'judul' => 'Halaman Kios',
      'user'  => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'kios'  => $this->M_kios->tampil()
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_kios/tabel', $data);
    $this->load->view('admin/footer');
  }

  public function form_input()
  {
    $urut = $this->M_kios->urutan_kios();
    $batas = (int) substr($urut['kode_kios'], -4, 4);
    $batas++;
    $kodebaru = "K" . sprintf('%04s', $batas);
    $data = [
      'judul'   => 'Halaman Tambah Kios',
      'user'    => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'kembali' => 'Kios',
      'urutan'  => $kodebaru
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_kios/form_input', $data);
    $this->load->view('admin/footer');
  }

  public function proses_kios()
  {
    $this->M_kios->input_kios();
    return redirect('Kios');
  }

  public function pemilik($kode)
  {
    $data = [
      'judul' => 'Halaman Pemilik Kios',
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'user'  => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_kios/form_pemilik', $data);
    $this->load->view('admin/footer');
  }

  public function hapus_kios($id)
  {
    $this->M_kios->hapus_kios($id);
    $this->session->set_flashdata('terhapus', '<div class="alert alert-success" role="alert">Data Kios Berhasil Dihapus</div>');
    return redirect('Kios');
  }

  public function tampil_edit($id)
  {
    $data = [
      'judul' => 'Halaman Edit Kios',
      'user'  => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'kios'  => $this->db->get_where('t_kios', ['id_kios' => $id])->row_array(),
      'kembali' => 'Kios'
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_kios/form_edit', $data);
    $this->load->view('admin/footer');
  }

  public function proses_edit_kios()
  {
    $this->M_kios->proses_edit();
    $this->session->set_flashdata('berubah', '<div class="alert alert-success" role="alert">Data Kios Berhasil Diubah</div>');
    return redirect('Kios');
  }

  public function reset_kios($id)
  {
    $this->M_kios->reset_kios($id);
    $this->session->set_flashdata('reset', '<div class="alert alert-success" role="alert">Data Kios Berhasil Direset</div>');
    return redirect('Kios');
  }

  public function input_saldo()
  {
    $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    $pengawas = $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array();
    // var_dump($akun);
    // die;
    if ($akun['akses'] == '2') {
      $data = [
        'judul' => 'Halaman Koordinator',
        'user' => $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'kios'  => $this->M_kios->tampil_pengawas($pengawas),
        'saldo' => $this->M_mobilepulsa->saldo(),
        't_saldo' => $this->M_mobilepulsa->total_saldo(),
        'kembali' => 'Admin/limit'
      ];
    } else {
      $data = [
        'judul' => 'Halaman Admin',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'kios'  => $this->M_kios->tampil(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        't_saldo' => $this->M_mobilepulsa->total_saldo(),
        'kembali' => 'Admin/limit'
      ];
    }

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_limit/form_input_saldo', $data);
    $this->load->view('admin/footer');
  }

  public function proses_saldo_kios()
  {
    $this->form_validation->set_rules('id_kios', 'Kios', 'required');
    $this->form_validation->set_rules('jumlah_saldo', 'Jumlah Saldo', 'required');

    if ($this->form_validation->run() == FALSE) {
      $data = [
        'judul' => 'Halaman Input Saldo',
        'user'  => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'kios'  => $this->M_kios->tampil(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        't_saldo' => $this->M_mobilepulsa->total_saldo(),
        'kembali' => 'Admin/limit'
      ];

      $this->load->view('admin/head', $data);
      $this->load->view('admin/data_limit/form_input_saldo', $data);
      $this->load->view('admin/footer');
    } else {
      $tsp = str_replace(" ", "", htmlspecialchars($this->input->post('jumlah_saldo')));
      $tsp1 = str_replace(".", "", $tsp);
      $tsp2 = str_replace(",", "", $tsp1);
      $tsp3 = str_replace("Rp", "", $tsp2);
      // var_dump($tsp3);
      // die;
      $this->M_kios->proses_saldo($tsp3);
      $this->session->set_flashdata('berhasil', '<div class="alert alert-success" role="alert">Saldo Berhasil Ditambahkan</div>');
      return redirect('Admin/limit');
    }
  }

  public function edit_limit($id)
  {
    $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    $pengawas = $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array();
    // var_dump($akun);
    // die;
    if ($akun['akses'] == '2') {
      $data = [
        'judul' => 'Halaman Koordinator',
        'user' => $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'saldo_edit'  => $this->db->get_where('t_saldo', ['id_saldo' => $id])->row_array(),
        'kios'  => $this->M_kios->tampil_pengawas($pengawas),
        'saldo' => $this->M_mobilepulsa->saldo(),
        't_saldo' => $this->M_mobilepulsa->total_saldo(),
        'kembali' => 'Admin/limit'
      ];
    } else {
      $data = [
        'judul' => 'Halaman Admin',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'saldo_edit'  => $this->db->get_where('t_saldo', ['id_saldo' => $id])->row_array(),
        'kios'  => $this->M_kios->tampil(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        't_saldo' => $this->M_mobilepulsa->total_saldo(),
        'kembali' => 'Admin/limit'
      ];
    }

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_limit/form_edit_saldo', $data);
    $this->load->view('admin/footer');
  }

  public function proses_edit_saldo_kios()
  {
    // var_dump($this->input->post());
    // die;
    $this->M_kios->edit_saldo_kios();
    $this->session->set_flashdata('berubah', '<div class="alert alert-success" role="alert">Saldo Berhasil Diubah</div>');
    return redirect('Admin/limit');
  }

  public function hapus_limit($id)
  {
    $this->M_kios->hapus_limit($id);
    $this->session->set_flashdata('terhapus', '<div class="alert alert-success" role="alert">Saldo Berhasil Dihapus</div>');
    return redirect('Admin/limit');
  }

  public function tanggung_jawab_kios($id)
  {
    $data = [
      'judul' => 'Halaman Tanggung Jawab Kios',
      'user'  => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'kios'  => $this->db->get_where('t_kios', ['id_pengawas' => NULL])->result_array(),
      'pengawas' => $this->db->get_where('t_pengawas', ['id_pengawas' => $id])->row_array(),
      'kembali' => 'Admin/cek_kios/' . $id . '',
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_koordinator/pilih_kios', $data);
    $this->load->view('admin/footer');
  }

  public function proses_pilih()
  {
    // var_dump($this->input->post());
    // die;
    $this->M_kios->input_pilihan();
    $this->session->set_flashdata('KiosDipilih', '<div class="alert alert-success" role="alert">Pilihan Berhasil Diubah</div>');
    return redirect('Admin/cek_kios/' . $this->input->post('id_pengawas') . '');
  }

  public function hapus_kios_pilihan($id, $pengawas)
  {
    $this->M_kios->del_kios_pilihan($id);
    $this->session->set_flashdata('KiosDihapus', '<div class="alert alert-success" role="alert">Pilihan Berhasil Dihapus</div>');
    return redirect('Admin/cek_kios/' . $pengawas . '');
  }
}
