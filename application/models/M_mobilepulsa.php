<?php

class M_mobilepulsa extends CI_Model
{
  public function saldo()
  {
    $this->client = new \GuzzleHttp\Client;
    $username   = "vetazag4dJkg";
    // $apiKey   = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    $signature  = md5($username . $apiKey . 'depo');
    $client = $this->client->request('POST', 'https://api.digiflazz.com/v1/cek-saldo', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'cmd' => 'deposit',
        'username' => $username,
        'sign'     => $signature
      ]
    ]);
    $hasil = json_decode($client->getBody()->getContents(), true);
    return $hasil;
  }

  public function _list_harga($type)
  {
    $this->client = new \GuzzleHttp\Client;
    $username   = "vetazag4dJkg";
    // $apiKey   = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    $signature  = md5($username . $apiKey . 'pricelist');
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/price-list', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'cmd' => 'prepaid',
        'username' => $username,
        'sign'     => $signature,
        'brand'    => $type
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());

    return $output;
  }

  public function list_pasca($type)
  {
    $this->client = new \GuzzleHttp\Client;
    $username   = "vetazag4dJkg";
    // $apiKey   = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    $signature  = md5($username . $apiKey . 'pricelist');
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/price-list', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'cmd' => 'pasca',
        'username' => $username,
        'sign'     => $signature,
        'brand'    => $type
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());

    return $output;
  }

  public function cek_api($no_kostumer, $ref)
  {
    $this->client = new \GuzzleHttp\Client;
    $username   = "vetazag4dJkg";
    // $apiKey     = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    $signature  = md5($username . $apiKey . $ref);
    // // var_dump($signature);
    // // die;
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/transaction', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'commands'        => 'inq-pasca',
        'username'        => $username,
        'buyer_sku_code'  => 'PLNP',
        'customer_no'     => $no_kostumer,
        'ref_id'          => $ref,
        'sign'            => $signature
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());
    return $output;
  }

  public function cek_api_pasca($no_kostumer, $random, $kode_produk)
  {
    $this->client = new \GuzzleHttp\Client;
    $username   = "vetazag4dJkg";
    // $apiKey     = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    $signature  = md5($username . $apiKey . $random);
    // var_dump($signature);
    // die;
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/transaction', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'commands'        => 'inq-pasca',
        'username'        => $username,
        'buyer_sku_code'  => $kode_produk,
        'customer_no'     => $no_kostumer,
        'ref_id'          => $random,
        'sign'            => $signature
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());

    return $output;
  }

  public function total_saldo()
  {
    $this->db->select_sum('jumlah_saldo');
    $data = $this->db->get('t_saldo');
    return $data->row_array();
  }

  public function proses_beli_pulsa($random)
  {
    $this->client = new \GuzzleHttp\Client;
    $kode_produk = $this->input->post('buyer_sku_code');
    $no_kostumer = $this->input->post('custommer_no');
    $harga = $this->input->post('harga');

    // var_dump($this->input->post());
    // var_dump($no_kostumer);
    // die;
    $username   = "vetazag4dJkg";
    // $apiKey     = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    // $signature  = md5($username . $apiKey . 'dfwesx007wyh');
    $signature  = md5($username . $apiKey . $random);
    // var_dump($signature);
    // die;
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/transaction', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'username'        => $username,
        'buyer_sku_code'  => $kode_produk,
        'customer_no'     => $no_kostumer,
        'ref_id'          => $random,
        'sign'            => $signature
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());
    // $data = $output->getBody();
    // var

    return $output;
  }
  public function cek_status_transaksi()
  {
    $this->client = new \GuzzleHttp\Client;
    $kode_produk = $this->input->post('buyer_sku_code');
    $no_kostumer = $this->input->post('customer_no');
    $random = $this->input->post('ref_id');
    $harga = $this->input->post('harga');

    // var_dump($this->input->post());
    // var_dump($no_kostumer);
    // die;
    $username   = "vetazag4dJkg";
    // $apiKey     = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    // $signature  = md5($username . $apiKey . 'dfwesx007wyh');
    $signature  = md5($username . $apiKey . $random);
    // var_dump($signature);
    // die;
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/transaction', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'commands'        => 'status',
        'username'        => $username,
        'buyer_sku_code'  => $kode_produk,
        'customer_no'     => $no_kostumer,
        'ref_id'          => $random,
        'sign'            => $signature
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());
    return $output;
  }
  public function proses_beli_listrik($random)
  {
    $this->client = new \GuzzleHttp\Client;
    $kode_produk = $this->input->post('buyer_sku_code');
    $no_kostumer = $this->input->post('custommer_no');
    $harga = $this->input->post('harga');

    // var_dump($this->input->post());
    // var_dump($no_kostumer);
    // die;
    $username   = "vetazag4dJkg";
    // $apiKey     = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    $signature  = md5($username . $apiKey . $random);
    // var_dump($signature);
    // die;
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/transaction', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'username'        => $username,
        'buyer_sku_code'  => $kode_produk,
        'customer_no'     => $no_kostumer,
        'ref_id'          => $random,
        'sign'            => $signature
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());
    // $id = $this->db->get_where('t_kios', ['kode_kios' => $this->session->userdata('username')])->row_array();
    // $id_kios = $id['id_kios'];


    return $output;
  }

  public function cek_status($ref, $kd, $nomor)
  {
    $this->client = new \GuzzleHttp\Client;
    // var_dump($this->input->post());
    // var_dump($kode);
    // die;
    $username   = "vetazag4dJkg";
    // $apiKey     = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    $signature  = md5($username . $apiKey . $ref);
    var_dump($signature);
    // die;
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/transaction', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'commands'        => 'status-pasca',
        'username'        => $username,
        'buyer_sku_code'  => $kd,
        'customer_no'     => $nomor,
        'ref_id'          => $ref,
        'sign'            => $signature
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());
    return $output;
  }

  public function export_transaksi($kode, $unik, $no)
  {
    $this->client = new \GuzzleHttp\Client;
    $kode_produk = $kode;
    $no_kostumer = $no;
    $random = $unik;
    $harga = $this->input->post('harga');

    // var_dump($this->input->post());
    // var_dump($no_kostumer);
    // die;
    $username   = "vetazag4dJkg";
    // $apiKey     = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    // $signature  = md5($username . $apiKey . 'dfwesx007wyh');
    $signature  = md5($username . $apiKey . $random);
    // var_dump($signature);
    // die;
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/transaction', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'commands'        => 'status',
        'username'        => $username,
        'buyer_sku_code'  => $kode_produk,
        'customer_no'     => $no_kostumer,
        'ref_id'          => $random,
        'sign'            => $signature
      ]
    ]);
    $output = json_decode($output->getBody()->getContents());
    return $output;
  }

  public function depo()
  {
    $this->client = new \GuzzleHttp\Client;
    $jumlah = (int)$this->input->post('amount');
    $bank = $this->input->post('bank');
    $pemilik = $this->input->post('owner_name');
    $ref = "deposit";
    $username   = "vetazag4dJkg";
    // $apiKey     = "dev-34de8020-92cd-11ec-a19c-c7508ac03e38";
    $apiKey     = "d25fba63-dcae-5e3f-b722-8befcfe28698";
    $signature  = md5($username . $apiKey . $ref);
    // var_dump($jumlah);
    // var_dump($username);
    // var_dump($bank);
    // var_dump($pemilik);
    // var_dump($signature);
    // die;
    $output = $this->client->request('POST', 'https://api.digiflazz.com/v1/deposit', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'username'   => $username,
        'amount'     => $jumlah,
        'Bank'       => $bank,
        'owner_name' => $pemilik,
        'sign'       => $signature
      ]
    ]);

    $output = json_decode($output->getBody()->getContents());
    // print_r($output);
    // die($output);
    // exit();
    return $output;
  }
}
