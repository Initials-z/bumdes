<?php

class M_transaksi extends CI_Model
{
  public function harga()
  {
    return $this->db->get('t_harga_jual')->result_array();
  }
  public function jumlah_transaksi()
  {
    // count data transaksi on this day
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->from('t_transaksi');
    return $this->db->count_all_results();
  }
  public function jumlah_transaksi_kios($id_kios)
  {
    // count data transaksi on this day
    $this->db->where('id_kios', $id_kios);
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->from('t_transaksi');
    return $this->db->count_all_results();
  }

  public function harga_jual()
  {
    $harga = $this->input->post('harga');
    $kode = $this->input->post('buyer_sku_code');
    $jumlah = count($this->input->post('buyer_sku_code'));
    for ($i = 0; $i < $jumlah; $i++) {
      $cek = $this->db->get_where('t_harga_jual', ['buyer_sku_code' => $kode[$i]])->row_array();
      // var_dump($cek);
      // die;
      if (isset($cek)) {
        $this->db->where('buyer_sku_code', $kode[$i]);
        $this->db->update('t_harga_jual', ['harga' => $harga[$i]]);
      } else {
        $data = array(
          'buyer_sku_code' => htmlspecialchars($kode[$i]),
          'harga' => htmlspecialchars($harga[$i])
        );

        $id = uniqid();
        $id_bar = $id . $i;

        $this->db->set('id_harga_jual', $id_bar);
        $this->db->insert('t_harga_jual', $data);
      }
    }
  }

  public function selesai_transaksi()
  {
    $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    $id_kios = $id['id_kios'];

    $harga = $this->input->post('harga');
    $saldo_kios = $this->db->get_where('t_saldo', ['id_kios' => $id_kios])->row_array();

    $itung = $saldo_kios['jumlah_saldo'] - $harga;

    $this->db->where('id_kios', $id_kios);
    $this->db->update('t_saldo', ['jumlah_saldo' => $itung]);

    $this->db->where('kode_transaksi', $this->input->post('kode_transaksi'));
    $this->db->update('t_transaksi', ['status' => 'Selesai']);
  }

  public function bayar_pln_pasca()
  {
    // var_dump($this->input->post());
    $this->client = new \GuzzleHttp\Client;
    $kode_produk = $this->input->post('buyer_sku_code');
    $no_kostumer = $this->input->post('customer_no');
    $ref_id = $this->input->post('ref_id');
    $harga = $this->input->post('harga');
    $username   = "vetazag4dJkg";
    // $apiKey     = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    $signature  = md5($username . $apiKey . $ref_id);
    // var_dump($signature);
    // die;
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/transaction', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'commands'        => 'pay-pasca',
        'username'        => $username,
        'buyer_sku_code'  => $kode_produk,
        'customer_no'     => $no_kostumer,
        'ref_id'          => $ref_id,
        'sign'            => $signature
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());
    // $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    // $id_kios = $id['id_kios'];
    // print_r($output->getBody());
    return $output;
  }
}
