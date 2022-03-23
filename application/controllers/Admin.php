<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->client = new \GuzzleHttp\Client;

    $this->load->model('M_login');
    $this->load->model('M_admin');
    $this->load->model('M_mobilepulsa');
    $this->load->model('M_kios');
    $this->load->model('M_transaksi');
    $this->load->model('M_pengguna');
    $this->load->model('M_koordinator');
    $this->load->library('pdf');

    // $this->load->library('Curl');
    $this->load->library('form_validation');
    if ($this->session->userdata('akun') == '1') {
      if (!$this->session->userdata('username')) {
        redirect('Welcome/not_found');
      } elseif ($this->session->userdata('akses') == '1') {
        redirect('Welcome/not_found_user');
      }
    } else {
      redirect('Welcome/not_found');
    }
  }

  public function index()
  {
    $data1 = $this->M_mobilepulsa->saldo();
    $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    // var_dump($akun['akses']);
    // die;
    if ($akun['akses'] == '2') {
      $data = [
        'judul' => 'Halaman Koordinator',
        'user' => $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        'jumlah' => $this->M_kios->jumlah_kios(),
        'jumlah_adm' => $this->M_admin->jumlah_admin(),
        'jumlah_koordinator' => $this->M_koordinator->jumlah_koordinator(),
        'transaksi' => $this->M_transaksi->jumlah_transaksi()
      ];
    } else {
      $data = [
        'judul' => 'Halaman Admin',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        'jumlah' => $this->M_kios->jumlah_kios(),
        'jumlah_adm' => $this->M_admin->jumlah_admin(),
        'jumlah_koordinator' => $this->M_koordinator->jumlah_koordinator(),
        'transaksi' => $this->M_transaksi->jumlah_transaksi()
      ];
    }
    // var_dump($data1);
    // die;

    $this->load->view('admin/head', $data);
    $this->load->view('admin/home', $data);
    $this->load->view('admin/footer');
  }

  public function admin_tabel()
  {
    // $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    $data = [
      'judul' => 'Tabel Data Admin',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'tampil' => $this->M_admin->tampil()
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_admin/tabel_admin', $data);
    $this->load->view('admin/footer');
  }

  public function reset_admin($id)
  {
    $this->M_admin->reset_admin($id);
    $this->session->set_flashdata('BerhasilReset', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
    redirect('Admin/admin_tabel');
  }

  public function form_input()
  {
    $data = [
      'judul' => 'Form Input Data Admin',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'kembali' => 'tabel_admin',
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_admin/form_input_admin', $data);
    $this->load->view('admin/footer');
  }

  public function proses_input()
  {
    $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim');
    $this->form_validation->set_rules('email_admin', 'Email Admin', 'required|trim|valid_email|is_unique[t_admin.email_admin]', [
      'is_unique' => 'Email sudah terdaftar!'
    ]);
    $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|trim|numeric');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
    $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data = [
        'judul' => 'Form Input Data Admin',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'kembali' => 'tabel_admin',
      ];
      $this->load->view('admin/head', $data);
      $this->load->view('admin/data_admin/form_input_admin', $data);
      $this->load->view('admin/footer');
    } else {
      $nbar = $this->input->post('nama_admin');
      $tsp = str_replace(" ", "", $nbar);
      $tsp1 = str_replace(".", "", $tsp);
      $tsp2 = str_replace(",", "", $tsp1);

      $file_name                  = $tsp2 . '-' . time();
      $config['upload_path']      = './gambar/admin/';
      $config['allowed_types']    = 'png|jpg|jpeg';
      $config['encrypt_name']     = FALSE;
      $config['file_name']        = $file_name;
      $config['max_size']         = 100000;

      $cek = $this->load->library('upload', $config);

      if ($this->upload->do_upload('foto_admin')) {
        $data = array('upload_data' => $this->upload->data());
        $gambar = $data['upload_data']['file_name'];
        $this->M_admin->input($gambar);
      } else {
        $gambar = 'user.png';
        $this->M_admin->input($gambar);
      }

      $this->session->set_flashdata('berhasil', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
      redirect('Admin/admin_tabel');
    }
  }

  public function tampil_admin($id)
  {
    $data = [
      'judul' => 'Data Profile Admin',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'tampil' => $this->M_admin->tampil_profile_admin($id),
      'kembali' => 'Admin/admin_tabel',
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_admin/tampil_admin', $data);
    $this->load->view('admin/footer');
  }

  public function hapus_admin($id)
  {
    $this->M_admin->hapus($id);
    $this->session->set_flashdata('terhapus', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
    redirect('Admin/admin_tabel');
  }

  public function nonaktif($id)
  {
    $this->M_admin->nonaktif($id);
    $this->session->set_flashdata('nonaktif', '<div class="alert alert-success" role="alert">Data berhasil dinonaktifkan!</div>');
    redirect('Admin/admin_tabel');
  }
  public function aktif($id)
  {
    $this->M_admin->aktif($id);
    $this->session->set_flashdata('aktif', '<div class="alert alert-success" role="alert">Data berhasil dinonaktifkan!</div>');
    redirect('Admin/admin_tabel');
  }
  public function koor_nonaktif($id)
  {
    $this->M_admin->nonaktif($id);
    $this->session->set_flashdata('nonaktif', '<div class="alert alert-success" role="alert">Data berhasil dinonaktifkan!</div>');
    redirect('Admin/koordinator');
  }
  public function koor_aktif($id)
  {
    $this->M_admin->aktif($id);
    $this->session->set_flashdata('aktif', '<div class="alert alert-success" role="alert">Data berhasil dinonaktifkan!</div>');
    redirect('Admin/koordinator');
  }

  public function proses_admin_edit()
  {
    $id = htmlspecialchars($this->input->post('id_admin'));
    $nbar = $this->input->post('nama_admin');
    $tsp = str_replace(" ", "", $nbar);
    $tsp1 = str_replace(".", "", $tsp);
    $tsp2 = str_replace(",", "", $tsp1);

    $file_name                  = $tsp2 . '-' . time();
    $config['upload_path']      = './gambar/admin/';
    $config['allowed_types']    = 'png|jpg|jpeg';
    $config['encrypt_name']     = FALSE;
    $config['file_name']        = $file_name;
    $config['max_size']         = 100000;

    $cek = $this->load->library('upload', $config);
    $pilih = $this->db->get_where('t_admin', ['id_admin' => $id])->row_array();

    if ($this->upload->do_upload('foto_admin')) {
      $lokasi = './gambar/admin/' . $pilih['foto'];
      unlink($lokasi);

      $data = array('upload_data' => $this->upload->data());
      $gambar = $data['upload_data']['file_name'];
      $this->M_admin->edit_proses($id, $gambar);
    } else {
      $gambar = $pilih['foto'];
      $this->M_admin->edit_proses($id, $gambar);
    }

    $this->session->set_flashdata('berubah', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
    redirect('Admin/tampil_admin/' . $id);
  }

  public function limit()
  {
    $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    // var_dump($akun);
    // die;
    if ($akun['akses'] == '2') {
      $data = [
        'judul' => 'Halaman Limit Saldo',
        'user' => $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'kios' => $this->M_kios->tampil(),
        'limit' => $this->M_kios->limit(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        't_saldo' => $this->M_mobilepulsa->total_saldo(),
      ];
    } else {
      $data = [
        'judul' => 'Data Saldo Pulsa',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'kios' => $this->M_kios->tampil(),
        'limit' => $this->M_kios->limit(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        't_saldo' => $this->M_mobilepulsa->total_saldo(),
      ];
    }


    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_limit/tabel_limit', $data);
    $this->load->view('admin/footer');
  }

  public function list()
  {
    $cek_list = $this->M_mobilepulsa->_list_harga('TELKOMSEL')->data;
    // var_dump($cek_list);
    // print_r($cek_list);
    // die;
    $data = [
      'judul' => 'Data List Pulsa',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_list,
      'harga' => $this->M_transaksi->harga(),
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_list/list_harga', $data);
    $this->load->view('admin/footer');
  }

  public function list_paket()
  {
    $cek_list = $this->M_mobilepulsa->_list_harga('data')->data;
    // var_dump($cek_list);
    // die;
    $data = [
      'judul' => 'Data List Paket Data',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_list
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_list/list_paket', $data);
    $this->load->view('admin/footer');
  }

  public function list_pln()
  {
    $cek_list = $this->M_mobilepulsa->_list_harga('pln')->data;
    $data = [
      'judul' => 'Data List PLN',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_list
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_list/list_pln', $data);
    $this->load->view('admin/footer');
  }

  public function list_game()
  {
    $cek_list = $this->M_mobilepulsa->_list_harga('game')->data;
    // var_dump($cek_list);
    // die;
    $data = [
      'judul' => 'Data List Top Up Game',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_list
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_list/list_game', $data);
    $this->load->view('admin/footer');
  }

  public function list_money()
  {
    $cek_list = $this->M_mobilepulsa->_list_harga('etoll')->data;
    // var_dump($cek_list);
    // die;
    $data = [
      'judul' => 'Data Saldo E-Money',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_list
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_list/list_e-money', $data);
    $this->load->view('admin/footer');
  }

  public function list_internet_pasca()
  {
    $cek_pasca = $this->M_mobilepulsa->list_pasca('INTERNET PASCABAYAR')->data;
    // var_dump($cek_pasca);
    // die;
    $data = [
      'judul' => 'Data Saldo E-Money',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_pasca
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_pasca/internet_pasca', $data);
    $this->load->view('admin/footer');
  }
  public function list_multifinance()
  {
    $cek_pasca = $this->M_mobilepulsa->list_pasca('MULTIFINANCE')->data;
    // var_dump($cek_pasca);
    // die;
    $data = [
      'judul' => 'Data Saldo E-Money',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_pasca
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_pasca/list_multifinance', $data);
    $this->load->view('admin/footer');
  }

  public function form_tagihan_listrik()
  {
    $data = [
      'judul' => 'Form Tagihan Listrik',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
    ];


    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_tagihan/form_tagihan_listrik', $data);
    $this->load->view('admin/footer');
  }

  public function cek_tagihan_listrik()
  {
    $no_kostumer = $this->input->post('custommer_no');
    $ref = $this->random_strings(8);
    $cek_list = $this->M_mobilepulsa->cek_api($no_kostumer, $ref)->data;
    $kode_pelanggan = $cek_list->customer_no;
    $nama_pelanggan = $cek_list->customer_name;
    $tagihan = $cek_list->desc->detail[0]->nilai_tagihan;
    // var_dump($cek_list);
    // die;
    $data = [
      'judul' => 'Data Tagihan Listrik',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_list
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_tagihan/tagihan_listrik', $data);
    $this->load->view('admin/footer');
  }

  public function random_strings($length_of_string)
  {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    return substr(str_shuffle($str_result), 0, $length_of_string);
  }

  public function cek_tagihan_pasca()
  {
    $no_kostumer = $this->input->post('custommer_no');
    $kode_produk = $this->input->post('buyer_sku_code');
    $random = $this->random_strings(8);
    $cek_list = $this->M_mobilepulsa->cek_api_pasca($no_kostumer, $random, $kode_produk)->data;
    // var_dump($cek_list);
    // die;
    $data = [
      'judul' => 'Tagihan Pascabayar',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_list
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_pasca/tagihan', $data);
    $this->load->view('admin/footer');
  }

  public function form_pasca($kode)
  {
    $data = [
      'judul' => 'Data Pascabayar Internet',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'kode_pasca' => $kode
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_pasca/form_pasca', $data);
    $this->load->view('admin/footer');
  }

  public function form_multi($kode)
  {
    $data = [
      'judul' => 'Multi Finance',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'kode_pasca' => $kode
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_pasca/form_multi', $data);
    $this->load->view('admin/footer');
  }

  public function cek_tagihan_multi()
  {
    $no_kostumer = $this->input->post('custommer_no');
    $kode_produk = $this->input->post('buyer_sku_code');
    $random = $this->random_strings(8);
    $cek_list = $this->M_mobilepulsa->cek_api_pasca($no_kostumer, $random, $kode_produk)->data;
    // var_dump($cek_list);
    // die;
    $data = [
      'judul' => 'Tagihan Multi Finance',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_list
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_pasca/tagihan_pasca', $data);
    $this->load->view('admin/footer');
  }

  public function pos_harga()
  {
    $kembali = htmlspecialchars($this->input->post('redir'));
    // var_dump($this->input->post());
    // die;
    $this->M_transaksi->harga_jual();
    redirect($kembali);
  }
  public function laporan()
  {
    $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    if ($akun['akses'] == '2') {
      $pengawas = $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array();
      $data = [
        'judul' => 'Data Laporan Transaksi Kios',
        'user' => $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'transaksi' => $this->M_pengguna->transaksi_admin(),
        'kios' => $this->M_kios->tampil()
      ];
    } else {
      $data = [
        'judul' => 'Halaman Setoran',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'transaksi' => $this->M_pengguna->transaksi_admin(),
        'kios' => $this->M_kios->tampil()
      ];
    }

    $this->load->view('admin/head', $data);
    $this->load->view('admin/transaksi/laporan_prabayar', $data);
    $this->load->view('admin/footer', $data);
  }

  public function profile()
  {
    $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    // var_dump($akun);
    // die;
    if ($akun['akses'] == '2') {
      $data = [
        'judul' => 'Halaman Profile',
        'user' => $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      ];
    } else {
      $data = [
        'judul' => 'Halaman Profile',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      ];
    }
    $this->load->view('admin/head', $data);
    $this->load->view('admin/profile/data_profile', $data);
    $this->load->view('admin/footer', $data);
  }

  public function proses_edit_profil()
  {
    // var_dump($this->input->post());
    // die;
    $nbar = $this->input->post('nama_admin');
    $tsp = str_replace(" ", "", $nbar);
    $tsp1 = str_replace(".", "", $tsp);
    $tsp2 = str_replace(",", "", $tsp1);

    $file_name                  = $tsp2 . '-' . time();
    $config['upload_path']      = './gambar/admin/';
    $config['allowed_types']    = 'png|jpg|jpeg';
    $config['encrypt_name']     = FALSE;
    $config['file_name']        = $file_name;
    $config['max_size']         = 100000;

    $cek = $this->load->library('upload', $config);

    if ($this->upload->do_upload('foto_admin')) {
      $data = array('upload_data' => $this->upload->data());
      $gambar = $data['upload_data']['file_name'];
      $this->M_admin->edit_profil($gambar);
    } else {
      $gambar = "kosong";
      // echo "$gambar";
      $this->M_admin->edit_profil($gambar);
    }

    $this->session->set_flashdata('berhasiledit', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
    redirect('Admin/profile');
  }

  public function ganti_password()
  {
    $data = [
      'judul' => 'Ganti Password',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/profile/ganti_password', $data);
    $this->load->view('admin/footer', $data);
  }

  public function ganti_password_proses($id_user)
  {
    $this->form_validation->set_rules('pass_lama', 'Password Lama', 'trim|required|min_length[4]');
    $this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|required|min_length[4]|matches[pass_konfirmasi]');
    $this->form_validation->set_rules('pass_konfirmasi', 'Password Konfirmasi', 'trim|required|min_length[4]|matches[pass_baru]');

    $ps = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();

    if ($this->form_validation->run() == false) {
      $data = [
        'judul'     => 'Ganti Password',
        'user'      => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      ];


      $this->load->view('admin/head', $data);
      $this->load->view('admin/profile/ganti_password', $data);
      $this->load->view('admin/footer', $data);
    } else {
      $cek = htmlspecialchars($this->input->post('pass_lama'), true);
      if (!password_verify($cek, $ps['password'])) {
        $this->session->set_flashdata('lamasalah', 'Password Lama Salah');
        redirect('Admin/ganti_password/' . $ps['id_user']);
      } else {
        if ($cek == $this->input->post('pass_baru')) {
          $this->session->set_flashdata('passama', 'Password baru tidak boleh sama dengan password lama');
          redirect('Admin/ganti_password/' . $id_user);
        } else {
          $hash = password_hash($this->input->post('pass_baru'), PASSWORD_DEFAULT);

          $this->db->set('password', $hash);
          $this->db->where('id_user', $id_user);
          $this->db->update('t_user');

          $this->session->set_flashdata('bisaganti', 'Berhasil merubah password');
          redirect('Admin/ganti_password/' . $id_user);
        }
      }
    }
  }

  public function koordinator()
  {
    $data = [
      'judul' => 'Koordinator',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'koordinator' => $this->M_koordinator->get_koordinator(),
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_koordinator/data_koordinator', $data);
    $this->load->view('admin/footer', $data);
  }

  public function input_koordinator()
  {
    $data = [
      'judul' => 'Input Koordinator',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'kembali' => 'Admin/koordinator',
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_koordinator/input_koordinator', $data);
    $this->load->view('admin/footer', $data);
  }

  public function proses_input_koordinator()
  {
    // var_dump($this->input->post());
    // die;
    $this->form_validation->set_rules('nama_pengawas', 'Nama Koordinator', 'trim|required|min_length[4]');
    $this->form_validation->set_rules('email_pengawas', 'Email Koordinator', 'trim|required|min_length[4]|valid_email|is_unique[t_pengawas.email_pengawas]');
    $this->form_validation->set_rules('no_hp', 'No HP Koordinator', 'trim|required|min_length[4]');
    $this->form_validation->set_rules('alamat', 'Alamat Koordinator', 'trim|required|min_length[4]');

    if ($this->form_validation->run() == false) {
      $data = [
        'judul'     => 'Input Koordinator',
        'user'      => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'akses'     => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'kembali'   => 'Admin/input_koordinator',
      ];

      $this->load->view('admin/head', $data);
      $this->load->view('admin/data_koordinator/input_koordinator', $data);
      $this->load->view('admin/footer', $data);
    } else {
      $this->M_koordinator->input_koordinator();
      $this->session->set_flashdata('berhasil', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
      redirect('Admin/koordinator');
    }
  }

  public function tampil_koordinator($id)
  {
    $data = [
      'judul' => 'Tampil Profile Koordinator',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'koordinator' => $this->M_koordinator->profil($id),
      'kembali' => 'Admin/koordinator',
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_koordinator/profil_koordinator', $data);
    $this->load->view('admin/footer', $data);
  }

  public function proses_koordinator_edit()
  {
    $this->M_koordinator->ubah_koordinator();
    $this->session->set_flashdata('berubah', '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>');
    redirect('Admin/koordinator');
  }

  public function cek_kios($id)
  {
    // $cek =
    $data = [
      'judul' => 'Cek Kios',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'pengawas' => $this->db->get_where('t_pengawas', ['id_pengawas' => $id])->row_array(),
      'kios' => $this->M_kios->cek_kios($id),
      'kembali' => 'Admin/koordinator',
    ];
    // var_dump($data);
    // die;
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_koordinator/cek_kios', $data);
    $this->load->view('admin/footer', $data);
  }

  public function hapus_pengawas($id)
  {
    $this->M_koordinator->hapus_pengawas($id);
    $this->session->set_flashdata('terhapus', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
    redirect('Admin/koordinator');
  }

  public function topup()
  {
    $data = [
      'judul' => 'Top Up',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_tagihan/data_topup', $data);
    $this->load->view('admin/footer', $data);
  }

  public function proses_deposit()
  {
    $cek = $this->M_mobilepulsa->depo()->data;
    $tiket = $this->M_kios->urutan_tiket();
    $batas = (int) substr($tiket['kode_tiket'], -4, 4);
    $batas++;
    $kodebaru = "TK" . sprintf('%04s', $batas);
    // var_dump($cek);
    // die;
    if ($cek->rc == '00') {
      $pos = [
        'jumlah' => $cek->amount,
        'bank' => $this->input->post('bank'),
        'tanggal' => date('Y-m-d'),
        'pemilik_rek' => $this->input->post('owner_name'),
        'catatan_tiket' => $cek->notes,
        'kode_tiket' => $kodebaru,

      ];
      $this->db->set('id_topup', 'UUID()', FALSE);
      $this->db->insert('t_topup', $pos);
    }

    $ambil = $this->db->get_where('t_topup', ['kode_tiket' => $kodebaru])->row_array();
    $data = [
      'judul' => 'Deposit Saldo',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'kode_baru' => $kodebaru,
      'respon' => $cek,
      'bank' => $this->input->post('bank'),
      'data_bar' => $ambil
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_tagihan/proses_topup', $data);
    $this->load->view('admin/footer', $data);
  }

  public function coming()
  {
    $data = [
      'judul' => 'Coming Soon',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/coming', $data);
    $this->load->view('admin/footer', $data);
  }

  public function filter_laporan()
  {
    // $cek = $this->M_admin->filter_laporan();
    $mulai = $this->input->post('mulai');
    $selesai = $this->input->post('selesai');
    $id_kios = $this->input->post('id_kios');
    // var_dump($this->input->post());
    // die;
    $data = [
      'judul' => 'Filter Laporan',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'transaksi' => $this->M_admin->filter_laporan(),
      'mulai' => $mulai,
      'selesai' => $selesai,
      'id_kios' => $id_kios,
      'kios' => $this->M_kios->tampil()
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/transaksi/filter_laporan', $data);
    $this->load->view('admin/footer', $data);
  }

  public function cetak_laporan($mulai, $selesai, $id_kios)
  {
    // var_dump($id_kios);

    $data = [
      'judul' => 'Laporan Transaksi Prabayar',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'transaksi' => $this->M_admin->filter_cetak_laporan($mulai, $selesai, $id_kios),
      'mulai' => $mulai,
      'selesai' => $selesai,
      'id_kios' => $id_kios,
      'kios' => $this->M_kios->tampil()
    ];

    $this->load->view('admin/transaksi/cetak_prabayar', $data);
  }
  public function filter_laporan_pasca()
  {
    // $cek = $this->M_admin->filter_laporan();
    $mulai = $this->input->post('mulai');
    $selesai = $this->input->post('selesai');
    $id_kios = $this->input->post('id_kios');
    // var_dump($this->input->post());
    // die;
    $data = [
      'judul' => 'Filter Laporan',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'transaksi' => $this->M_admin->filter_laporan_pasca(),
      'mulai' => $mulai,
      'selesai' => $selesai,
      'id_kios' => $id_kios,
      'kios' => $this->M_kios->tampil()
    ];
    $this->load->view('admin/head', $data);
    $this->load->view('admin/transaksi/filter_laporan_pasca', $data);
    $this->load->view('admin/footer', $data);
  }

  public function cetak_laporan_pasca($mulai, $selesai, $id_kios)
  {
    // var_dump($id_kios);

    $data = [
      'judul' => 'Laporan Transaksi Prabayar',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'transaksi' => $this->M_admin->filter_cetak_laporan_pasca($mulai, $selesai, $id_kios),
      'mulai' => $mulai,
      'selesai' => $selesai,
      'id_kios' => $id_kios,
      'kios' => $this->M_kios->tampil()
    ];

    $this->load->view('admin/transaksi/cetak_pasca', $data);
  }

  public function laporan_pasca()
  {
    $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    if ($akun['akses'] == '2') {
      $pengawas = $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array();
      $data = [
        'judul' => 'Data Laporan Transaksi Kios',
        'user' => $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'transaksi' => $this->M_pengguna->transaksi_pasca_admin(),
        'kios' => $this->M_kios->tampil()
      ];
    } else {
      $data = [
        'judul' => 'Halaman Setoran',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'saldo' => $this->M_mobilepulsa->saldo(),
        'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'transaksi' => $this->M_pengguna->transaksi_pasca_admin(),
        'kios' => $this->M_kios->tampil()
      ];
    }
    $this->load->view('admin/head', $data);
    $this->load->view('admin/transaksi/laporan_pascabayar', $data);
    $this->load->view('admin/footer', $data);
  }

  public function setoran()
  {
    $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    if ($akun['akses'] == '2') {
      $pengawas = $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array();
      $data = [
        'judul' => 'Halaman Setoran',
        'user' => $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'setoran' => $this->M_admin->setoran(),
        'kios' => $this->M_kios->tampil_pengawas($pengawas)
      ];
    } else {
      $data = [
        'judul' => 'Halaman Setoran',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'setoran' => $this->M_admin->setoran(),
        'kios' => $this->M_kios->tampil()
      ];
    }
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_setoran/setoran', $data);
    $this->load->view('admin/footer', $data);
  }

  public function form_setoran()
  {
    $akun = $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array();
    if ($akun['akses'] == '2') {
      $pengawas = $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array();
      $data = [
        'judul' => 'Halaman Form Setoran',
        'user' => $this->db->get_where('t_pengawas', ['email_pengawas' => $this->session->userdata('username')])->row_array(),
        'akun' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'kios' => $this->M_kios->tampil_pengawas($pengawas),
        'kembali' => "Admin/setoran"
      ];
    } else {
      $data = [
        'judul' => 'Halaman Form Setoran',
        'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
        'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
        'kios' => $this->M_kios->tampil(),
        'kembali' => "Admin/setoran"
      ];
    }
    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_setoran/form_setoran', $data);
    $this->load->view('admin/footer', $data);
  }

  public function proses_setoran()
  {
    $this->M_admin->proses_setoran();
    $this->session->set_flashdata('berhasil', 'Berhasil setor');
    redirect('Admin/setoran');
  }

  public function setoran_hapus($id)
  {
    $this->M_admin->hapus_setoran($id);
    $this->session->set_flashdata('terhapus', 'Berhasil hapus');
    redirect('Admin/setoran');
  }


  public function pdf($kode, $harga, $deskripsi, $no, $unik)
  {
    $rs = $this->M_mobilepulsa->export_transaksi($kode, $unik, $no)->data;
    // var_dump($rs);
    // die;
    $pdf = new FPDF('P', 'mm', array(100, 80));
    // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial', 'B', 9);
    // mencetak string
    $pdf->Cell(60, 1, 'Bukti Transaksi BUMDES RIMBO PANJANG', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Cell(60, 5, 'BUKTI TRANSAKSI UNTUK PEMBELIAN PULSA', 0, 1, 'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(60, 1, '_________________________________________________________________________________', 0, 1, 'C');
    $pdf->Cell(5, 5, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(40, 2, 'Kode Transaksi', 0, 0);
    $pdf->Cell(15, 2, $kode, 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(40, 2, 'Kode Unik', 0, 0);
    $pdf->Cell(15, 2, $unik, 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(40, 2, 'Nomer Hp', 0, 0);
    $pdf->Cell(15, 2, $no, 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(40, 2, 'Status', 0, 0);
    $pdf->Cell(15, 2, $rs->status, 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(40, 2, 'SN', 0, 0);
    $pdf->Cell(15, 2, $rs->sn, 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(40, 2, 'Harga', 0, 0);
    $pdf->Cell(15, 2, 'Rp. ' . number_format($harga), 0, 1);
    $pdf->Cell(60, 10, '____________________________________________________________________________', 0, 1, 'C');
    $pdf->Cell(60, 5, 'Terimakasih Telah Melakukan Transaksi', 0, 1, 'C');
    $pdf->Cell(60, 2, 'Bersama BUMDES Riombo Panjang', 0, 1, 'C');
    $pdf->Output();
  }

  public function struk_pln_pasca()
  {
    // var_dump($this->input->post());
    // die;
    $pdf = new FPDF('p', 'mm', array(100, 80));
    // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial', 'B', 9);
    // mencetak string
    $pdf->Cell(60, 1, 'Bukti Transaksi BUMDES RIMBO PANJANG', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Cell(60, 5, 'STRUK PEMBAYARAN TAGIHAN LISTRIK', 0, 1, 'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(60, 1, '_______________________________________________________________________________________________', 0, 1, 'C');
    $pdf->Cell(5, 5, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Kode Transaksi', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('kode_transaksi'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Kode Unik', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('ref_id'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'ID Pelanggan', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('customer_no'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Nama Pelanggan', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('nama'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Periode', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('periode'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Serian Number', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('sn'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->Cell(40, 2, '', 0, 0);
    $pdf->Cell(15, 2, '_____________________________________________', 0, 1, 'R');
    $pdf->Cell(5, 3, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(40, 2, 'Tagihan', 0, 0);
    $pdf->Cell(15, 2, 'Rp. ' . number_format($this->input->post('tagihan')), 0, 1, 'R');
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->Cell(40, 2, 'Denda', 0, 0);
    $pdf->Cell(15, 2, 'Rp. ' . number_format($this->input->post('denda')), 0, 1, 'R');
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->Cell(40, 2, 'Biaya Admin', 0, 0);
    $pdf->Cell(15, 2, 'Rp. ' . number_format($this->input->post('admin')), 0, 1, 'R');
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->Cell(40, 2, '', 0, 0);
    $pdf->Cell(15, 2, '____________________________________________+', 0, 1, 'R');
    $pdf->Cell(5, 3, '', 0, 1);
    $pdf->Cell(40, 2, 'Total Pembayaran', 0, 0);
    $pdf->Cell(15, 2, 'Rp. ' . number_format($this->input->post('total')), 0, 1, 'R');
    $pdf->Cell(60, 10, '____________________________________________________________________________', 0, 1, 'C');
    $pdf->Cell(60, 5, 'Terimakasih Telah Melakukan Transaksi', 0, 1, 'C');
    $pdf->Cell(60, 2, 'Bersama BUMDES Riombo Panjang', 0, 1, 'C');
    $pdf->Output();
  }
  public function struk_pasca()
  {
    // var_dump($this->input->post());
    // die;
    $pdf = new FPDF('p', 'mm', array(105, 80));
    // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial', 'B', 9);
    // mencetak string
    $pdf->Cell(60, 1, 'Bukti Transaksi BUMDES RIMBO PANJANG', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Cell(60, 5, 'STRUK PEMBAYARAN TAGIHAN', 0, 1, 'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(60, 1, '_______________________________________________________________________________________________', 0, 1, 'C');
    $pdf->Cell(5, 5, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Kode Transaksi', 0, 0);
    $pdf->Cell(15, 2, ': PASCA0001', 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Kode Unik', 0, 0);
    $pdf->Cell(15, 2, ': uWPfqowl', 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'ID Pelanggan', 0, 0);
    $pdf->Cell(15, 2, ': 0761007875886', 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Nama Pelanggan', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('nama'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Periode', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('periode'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Serian Number', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('sn'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(20, 2, 'Deskripsi', 0, 0);
    $pdf->Cell(15, 2, ': ' . $this->input->post('deskripsi'), 0, 1);
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->Cell(40, 2, '', 0, 0);
    $pdf->Cell(15, 2, '_____________________________________________', 0, 1, 'R');
    $pdf->Cell(5, 3, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(40, 2, 'Tagihan', 0, 0);
    $pdf->Cell(15, 2, 'Rp. ' . number_format($this->input->post('tagihan')), 0, 1, 'R');
    $pdf->Cell(5, 1, '', 0, 1);
    if ($this->input->post('denda') == null) {
    } else {
      $pdf->Cell(40, 2, 'Denda', 0, 0);
      $pdf->Cell(15, 2, 'Rp. ' . number_format($this->input->post('denda')), 0, 1, 'R');
      $pdf->Cell(5, 1, '', 0, 1);
    }
    $pdf->Cell(40, 2, 'Biaya Admin', 0, 0);
    $pdf->Cell(15, 2, 'Rp. 2,500', 0, 1, 'R');
    $pdf->Cell(5, 1, '', 0, 1);
    $pdf->Cell(40, 2, '', 0, 0);
    $pdf->Cell(15, 2, '____________________________________________+', 0, 1, 'R');
    $pdf->Cell(5, 3, '', 0, 1);
    $pdf->Cell(40, 2, 'Total Pembayaran', 0, 0);
    $pdf->Cell(15, 2, 'Rp. 299,500', 0, 1, 'R');
    $pdf->Cell(60, 10, '____________________________________________________________________________', 0, 1, 'C');
    $pdf->Cell(60, 5, 'Terimakasih Telah Melakukan Transaksi', 0, 1, 'C');
    $pdf->Cell(60, 2, 'Bersama BUMDES Riombo Panjang', 0, 1, 'C');
    $pdf->Output();
  }
}
