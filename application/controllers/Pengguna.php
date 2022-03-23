<?php
class Pengguna extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_pengguna');
    $this->load->model('M_transaksi');
    $this->load->model('M_mobilepulsa');
    $this->load->model('M_kios');
    $this->load->helper('form');

    $this->load->library('form_validation');
    if (!$this->session->userdata('username')) {
      redirect('Welcome/not_found_user');
    } elseif ($this->session->userdata('akses') == 0) {
      redirect('Welcome/not_found_user');
    }
  }

  public function random_strings($length_of_string)
  {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    return substr(str_shuffle($str_result), 0, $length_of_string);
  }

  public function index()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $data = [
      'judul' => 'Dashboard Kios',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'jumlah' => $this->M_pengguna->transaksi($id_kios),
      'transaksi' => $this->M_transaksi->jumlah_transaksi($id_kios),
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/home', $data);
    $this->load->view('Pengguna/footer', $data);
  }


  public function laporan()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $random = $this->random_strings(8);
    // $status = $this->M_mobilepulsa->cek_status($random)->data;
    $data = [
      'judul' => 'Dashboard Kios',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
      'transaksi' => $this->M_pengguna->transaksi($id_kios),
      // 'status' => $status,
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/transaksi/laporan_transaksi', $data);
    $this->load->view('Pengguna/footer', $data);
  }

  public function cek_status($kode, $nomor, $ref_id)
  {
    // $random = $this->random_strings(8);
    $ref = $ref_id;
    $status = $this->M_mobilepulsa->cek_status($ref, $kode, $nomor)->data;
    var_dump($status);
    die;
  }

  public function pulsa()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $cek_list = $this->M_mobilepulsa->_list_harga('TELKOMSEL')->data;
    // $rack_list = $this->suggest->get_rack_details();
    // var_dump($cek_list);
    // json_encode($cek_list);
    // print_r($cek_list);
    // die;
    $data = [
      'judul' => 'Data List Pulsa',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'transaksi' => $this->M_transaksi->jumlah_transaksi($id_kios),
      'list' => $cek_list,
      'harga' => $this->M_transaksi->harga(),
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_list/list_harga', $data);
    $this->load->view('Pengguna/footer');
  }
  public function paket()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $cek_list = $this->M_mobilepulsa->_list_harga('TELKOMSEL')->data;
    // $rack_list = $this->suggest->get_rack_details();
    // var_dump($cek_list);
    // json_encode($cek_list);
    // print_r($cek_list);
    // die;
    $data = [
      'judul' => 'Data List Pulsa',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'transaksi' => $this->M_transaksi->jumlah_transaksi($id_kios),
      'list' => $cek_list,
      'harga' => $this->M_transaksi->harga(),
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_list/list_paket', $data);
    $this->load->view('Pengguna/footer');
  }
  public function token()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $cek_list = $this->M_mobilepulsa->_list_harga('PULSA PLN')->data;
    // $rack_list = $this->suggest->get_rack_details();
    // var_dump($cek_list);
    // json_encode($cek_list);
    // print_r($cek_list);
    // die;
    $data = [
      'judul' => 'Data List Pulsa',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'transaksi' => $this->M_transaksi->jumlah_transaksi($id_kios),
      'list' => $cek_list,
      'harga' => $this->M_transaksi->harga(),
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_list/list_pln', $data);
    $this->load->view('Pengguna/footer');
  }
  public function e_money()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $cek_list = $this->M_mobilepulsa->_list_harga('E-Money')->data;
    // $rack_list = $this->suggest->get_rack_details();
    // var_dump($cek_list);
    // json_encode($cek_list);
    // print_r($cek_list);
    // die;
    $data = [
      'judul' => 'Data List Pulsa',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'transaksi' => $this->M_transaksi->jumlah_transaksi($id_kios),
      'list' => $cek_list,
      'harga' => $this->M_transaksi->harga(),
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_list/list_e-money', $data);
    $this->load->view('Pengguna/footer');
  }
  public function status_transaksi()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];

    $respon = $this->M_mobilepulsa->cek_status_transaksi()->data;
    $data = [
      'judul' => 'Detail Transaksi',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'respon' => $respon,
      'kode_transaksi' => $this->input->post('kode_transaksi'),
      'deskripsi' => $this->input->post('deskripsi'),
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/transaksi/detail_transaksi', $data);
    $this->load->view('Pengguna/footer');
  }

  public function profile()
  {
    $data = [
      'judul' => 'Profile',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/profile/data_profile', $data);
    $this->load->view('Pengguna/footer', $data);
  }

  public function proses_edit_profil()
  {
    $this->M_pengguna->pos_profil();

    $this->session->set_flashdata('berhasiledit', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
    redirect('Pengguna/profile');
  }
  public function ganti_password()
  {
    $data = [
      'judul' => 'Ganti Password',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'akses' => $this->db->get_where('t_user', ['username' => $this->session->userdata('username')])->row_array(),
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/profile/ganti_password', $data);
    $this->load->view('Pengguna/footer', $data);
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
        'user'      => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      ];

      $this->load->view('Pengguna/head', $data);
      $this->load->view('Pengguna/profile/ganti_password', $data);
      $this->load->view('Pengguna/footer', $data);
    } else {
      $cek = htmlspecialchars($this->input->post('pass_lama'), true);
      if (!password_verify($cek, $ps['password'])) {
        $this->session->set_flashdata('lamasalah', 'Password Lama Salah');
        redirect('Pengguna/ganti_password/' . $ps['id_user']);
      } else {
        if ($cek == $this->input->post('pass_baru')) {
          $this->session->set_flashdata('passama', 'Password baru tidak boleh sama dengan password lama');
          redirect('Pengguna/ganti_password/' . $id_user);
        } else {
          $hash = password_hash($this->input->post('pass_baru'), PASSWORD_DEFAULT);

          $this->db->set('password', $hash);
          $this->db->where('id_user', $id_user);
          $this->db->update('t_user');

          $this->session->set_flashdata('bisaganti', 'Berhasil merubah password');
          redirect('Pengguna/ganti_password/' . $id_user);
        }
      }
    }
  }

  public function selesai_transaksi()
  {
    $this->M_transaksi->selesai_transaksi();
    $this->session->set_flashdata('berhasilselesai', '<div class="alert alert-success" role="alert">Transaksi berhasil diselesaikan!</div>');
    redirect('Pengguna/laporan');
  }

  public function form_tagihan_listrik()
  {
    $data = [
      'judul' => 'Form Tagihan Listrik',
      'user'  => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
    ];

    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_tagihan/form_tagihan_listrik', $data);
    $this->load->view('Pengguna/footer');
  }

  public function cek_tagihan_listrik()
  {
    // $ip = $this->input->ip_address();
    // var_dump($ip);
    // die;
    $urut = $this->M_kios->urutan_transaksi_pasca();
    $batas = (int) substr($urut['kode_transaksi'], -4, 4);
    $batas++;
    $kodebaru = "TP" . sprintf('%04s', $batas);

    $no_kostumer = $this->input->post('custommer_no');
    $ref = $this->random_strings(8);
    $cek_list = $this->M_mobilepulsa->cek_api($no_kostumer, $ref)->data;
    $kode_pelanggan = $cek_list->customer_no;
    $nama_pelanggan = $cek_list->customer_name;
    $tagihan = $cek_list->desc->detail[0]->nilai_tagihan;
    // var_dump($cek_list);
    // die;
    $data = [
      'judul'          => 'Data Tagihan Listrik',
      'user'           => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'list'           => $cek_list,
      'kode_transaksi' => $kodebaru,
    ];

    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_tagihan/tagihan_listrik', $data);
    $this->load->view('Pengguna/footer');
  }

  public function bayar_pln_pasca()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $respon = $this->M_transaksi->bayar_pln_pasca()->data;
    // var_dump($respon);
    // die;
    if ($respon->status == 'Sukses') {
      $itung = $respon->desc->detail[0]->nilai_tagihan + $respon->desc->detail[0]->denda + $respon->desc->detail[0]->admin;
      $untung = $itung - $respon->desc->detail[0]->nilai_tagihan;
      $this->db->set('id_transaksi_pasca', 'UUID()', FALSE);
      $this->db->insert('t_transaksi_pasca', [
        'kode_transaksi'  => $this->input->post('kode_transaksi'),
        'deskripsi'       => 'Pembayaran Listrik Pascabayar',
        'kode_produk'     => $this->input->post('buyer_sku_code'),
        'id_kios'         => $id_kios,
        'no_pelanggan'    => $this->input->post('customer_no'),
        'harga_jual'      => $itung,
        'harga_beli'      => $respon->desc->detail[0]->nilai_tagihan,
        'keuntungan'      => $untung,
        'tanggal'         => date('Y-m-d H:i:s'),
        'ref_id'          => $this->input->post('ref_id'),
        'status'          => $respon->status,
      ]);
    }
    $data = [
      'judul'          => 'Data Tagihan Listrik',
      'user'           => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'list'           => $respon,
      'kode_transaksi' => $this->input->post('kode_transaksi'),
    ];

    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_tagihan/pembayaran_listrik', $data);
    $this->load->view('Pengguna/footer');
    // var_dump($respon);
    // die;
  }
  public function bayar_pasca()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $respon = $this->M_transaksi->bayar_pln_pasca()->data;
    // var_dump($respon);
    // die;
    if ($respon->status == 'Sukses') {
      if (!isset($respon->desc->detail[0]->denda)) {
        $itung = $respon->desc->detail[0]->nilai_tagihan + $respon->desc->detail[0]->admin;
      } else {
        $itung = $respon->desc->detail[0]->nilai_tagihan + $respon->desc->detail[0]->admin + $respon->desc->detail[0]->denda;
      }
      $untung = $itung - $respon->desc->detail[0]->nilai_tagihan;
      $this->db->set('id_transaksi_pasca', 'UUID()', FALSE);
      $this->db->insert('t_transaksi_pasca', [
        'kode_transaksi'  => $this->input->post('kode_transaksi'),
        'deskripsi'       => 'Pembayaran Internet Pascabayar',
        'kode_produk'     => $this->input->post('buyer_sku_code'),
        'id_kios'         => $id_kios,
        'no_pelanggan'    => $this->input->post('customer_no'),
        'harga_jual'      => $itung,
        'harga_beli'      => $respon->desc->detail[0]->nilai_tagihan,
        'keuntungan'      => $untung,
        'tanggal'         => date('Y-m-d H:i:s'),
        'ref_id'          => $this->input->post('ref_id'),
        'status'          => $respon->status,
      ]);
    }
    $data = [
      'judul'          => 'Data Tagihan Listrik',
      'user'           => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'list'           => $respon,
      'kode_transaksi' => $this->input->post('kode_transaksi'),
    ];

    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_pasca/pembayaran_pasca', $data);
    $this->load->view('Pengguna/footer');
    // var_dump($respon);
    // die;
  }

  public function list_internet_pasca()
  {
    $cek_pasca = $this->M_mobilepulsa->list_pasca('INTERNET PASCABAYAR')->data;
    // var_dump($cek_pasca);
    // die;
    $data = [
      'judul' => 'List Internet Pasca',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_pasca
    ];

    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_pasca/internet_pasca', $data);
    $this->load->view('Pengguna/footer');
  }

  public function list_multifinance()
  {
    $cek_pasca = $this->M_mobilepulsa->list_pasca('MULTIFINANCE')->data;
    // var_dump($cek_pasca);
    // die;
    $data = [
      'judul' => 'Data Saldo E-Money',
      'user' => $this->db->get_where('t_admin', ['email_admin' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_pasca
    ];

    $this->load->view('admin/head', $data);
    $this->load->view('admin/data_pasca/list_multifinance', $data);
    $this->load->view('admin/footer');
  }

  public function form_pasca($kode)
  {
    $data = [
      'judul' => 'Internet Pascabayar',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'kode_pasca' => $kode
    ];

    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_pasca/form_pasca', $data);
    $this->load->view('Pengguna/footer');
  }
}
