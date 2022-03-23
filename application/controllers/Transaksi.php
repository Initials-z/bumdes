<?php
class Transaksi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_pengguna');
    $this->load->model('M_transaksi');
    $this->load->model('M_mobilepulsa');
    $this->load->model('M_kios');
    $this->load->helper('form');

    $this->client = new \GuzzleHttp\Client;

    $this->load->library('form_validation');
    $this->load->library('pdf');
    if (!$this->session->userdata('username')) {
      redirect('Welcome/not_found_user');
    } elseif ($this->session->userdata('akses') == 0) {
      redirect('Welcome/not_found_user');
    }
  }

  public function pulsa($kode, $harga, $des)
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $deskrip = rawurldecode($des);
    $data = [
      'judul' => 'Data List Pulsa',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'kode' => $kode,
      'harga' => $harga,
      'deskripsi' => $deskrip,
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/form_transaksi/pulsa', $data);
    $this->load->view('Pengguna/footer');
  }

  public function e_money($kode, $harga, $des)
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $deskrip = rawurldecode($des);
    $data = [
      'judul' => 'Data List Pulsa',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'kode' => $kode,
      'harga' => $harga,
      'deskripsi' => $deskrip,
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/form_transaksi/e_money', $data);
    $this->load->view('Pengguna/footer');
  }

  public function pulsa_pln($kode, $harga, $des)
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $deskrip = rawurldecode($des);
    $data = [
      'judul' => 'Data List Pulsa',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'kode' => $kode,
      'harga' => $harga,
      'deskripsi' => $deskrip,
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/form_transaksi/pulsa_pln', $data);
    $this->load->view('Pengguna/footer');
  }

  public function random_strings($length_of_string)
  {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    return substr(str_shuffle($str_result), 0, $length_of_string);
  }

  public function pulsa_proses()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];

    $urut = $this->M_kios->urutan_transaksi();
    $batas = (int) substr($urut['kode_transaksi'], -4, 4);
    $batas++;
    $kodebaru = "TP" . sprintf('%04s', $batas);

    $random = $this->random_strings(8);
    $respon = $this->M_mobilepulsa->proses_beli_pulsa($random)->data;
    $deskripsi = $this->input->post('deskripsi');

    $kode_produk = $this->input->post('buyer_sku_code');
    $no_kostumer = $this->input->post('custommer_no');
    $harga = $this->input->post('harga');
    $deskripsi = $this->input->post('deskripsi');

    $this->db->set('id_transaksi', 'UUID()', FALSE);
    $this->db->insert('t_transaksi', [
      'kode_transaksi' => $kodebaru,
      'deskripsi' => $deskripsi,
      'kode_produk' => $kode_produk,
      'id_kios' => $id_kios,
      'kode_produk' => $kode_produk,
      'no_pelanggan' => $no_kostumer,
      'harga_jual' => $harga,
      'harga_beli' => $respon->price,
      'tanggal' => date('Y-m-d H:i:s'),
      'ref_id' => $respon->ref_id,
      'status' => $respon->status,
    ]);

    $data = [
      'judul' => 'Detail Transaksi',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'respon' => $respon,
      'kode_transaksi' => $kodebaru,
      'deskripsi' => $deskripsi,
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/transaksi/detail_transaksi', $data);
    $this->load->view('Pengguna/footer');


    // $kode_produk = $this->input->post('buyer_sku_code');
    // $no_kostumer = $this->input->post('custommer_no');

    // $username   = "vetazag4dJkg";
    // $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    // $signature  = md5($username . $apiKey . $random);

    // $json = '{
    //   "username"        : ' . $username . ',
    //   "buyer_sku_code"  : ' . $kode_produk . ',
    //   "customer_no"     : ' . $no_kostumer . ',
    //   "ref_id"          : ' . $random . ',
    //   "sign"            : ' . md5($username . $apiKey . $random) . '
    //  }';
    // // var_dump($json);

    // $url = "https://api.digiflazz.com/v1/transaction";
    // $method = "POST";

    // $ch  = curl_init();
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // $data = curl_exec($ch);
    // curl_close($ch);

    // print_r($data);
  }

  public function pulsa_pln_proses()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];

    $urut = $this->M_kios->urutan_transaksi();
    $batas = (int) substr($urut['kode_transaksi'], -4, 4);
    $batas++;
    $kodebaru = "TP" . sprintf('%04s', $batas);

    $random = $this->random_strings(8);
    $respon = $this->M_mobilepulsa->proses_beli_listrik($random)->data;
    // var_dump($respon);
    // die;
    $data = [
      'judul' => 'Detail Transaksi',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'respon' => $respon,
      'kode_transaksi' => $kodebaru
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/transaksi/detail_transaksi', $data);
    $this->load->view('Pengguna/footer');
  }

  public function data($kode, $harga, $des)
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];
    $deskrip = rawurldecode($des);
    $data = [
      'judul' => 'Data List Pulsa',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'kode' => $kode,
      'harga' => $harga,
      'deskripsi' => $deskrip,
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/form_transaksi/data', $data);
    $this->load->view('Pengguna/footer');
  }

  public function data_proses()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];

    $urut = $this->M_kios->urutan_transaksi();
    $batas = (int) substr($urut['kode_transaksi'], -4, 4);
    $batas++;
    $kodebaru = "TP" . sprintf('%04s', $batas);

    $random = $this->random_strings(8);
    $respon = $this->M_mobilepulsa->proses_beli_pulsa($random)->data;
    $data = [
      'judul' => 'Detail Transaksi',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'respon' => $respon,
      'kode_transaksi' => $kodebaru
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/transaksi/detail_transaksi', $data);
    $this->load->view('Pengguna/footer');
  }
  public function e_money_proses()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];

    $urut = $this->M_kios->urutan_transaksi();
    $batas = (int) substr($urut['kode_transaksi'], -4, 4);
    $batas++;
    $kodebaru = "TP" . sprintf('%04s', $batas);

    $random = $this->random_strings(8);
    $respon = $this->M_mobilepulsa->proses_beli_pulsa($random)->data;
    $data = [
      'judul' => 'Detail Transaksi',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'saldo' => $this->M_pengguna->saldo($id_kios),
      'respon' => $respon,
      'kode_transaksi' => $kodebaru
    ];
    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/transaksi/detail_transaksi', $data);
    $this->load->view('Pengguna/footer');
  }

  public function cek_tagihan_pasca()
  {
    $no_kostumer = $this->input->post('custommer_no');
    $kode_produk = $this->input->post('buyer_sku_code');
    $random = $this->random_strings(8);
    $urut = $this->M_kios->urutan_transaksi_pasca();
    $batas = (int) substr($urut['kode_transaksi'], -5, 4);
    $batas++;
    $kodebaru = "PASCA" . sprintf('%04s', $batas);
    $cek_list = $this->M_mobilepulsa->cek_api_pasca($no_kostumer, $random, $kode_produk)->data;
    // var_dump($cek_list);
    // die;
    $data = [
      'judul' => 'Data Tagihan Listrik',
      'user' => $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array(),
      'list' => $cek_list,
      'kode_transaksi' => $kodebaru
    ];

    $this->load->view('Pengguna/head', $data);
    $this->load->view('Pengguna/data_pasca/tagihan', $data);
    $this->load->view('Pengguna/footer');
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
