<!DOCTYPE html>
<html lang="en">

<head>
  <title>BUMDES | <?= $judul ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="keywords" content="">
  <meta name="author" content="Bumdes Rimbo Panjang" />
  <link rel="icon" type="image/png" href="<?= base_url() ?>gambar/my3.png">
  <!-- vendor css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url('select2/') ?>css/select2.min.css">
  <link href="<?= base_url('data_tabel/') ?>jquery.dataTables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>dist/sweetalert.css">
  <style>
    .label {
      margin-top: 20px;
    }
  </style>
</head>

<body style="background:#4ccb0b00;">
  <div class="row">
    <div class="col-lg-12">
      <h1><strong>
          <center>BUMDES RIOMBO PANJANG</center>
        </strong></h1>
      <h5>
        <center><strong>Laporan transaksi periode <?= date('d-m-Y', strtotime($mulai)) ?> Sd <?= date('d-m-Y', strtotime($selesai)) ?></strong></center>
      </h5>
    </div>
  </div>
  <div class="row label">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
      <?php
      $kios = $this->db->get_where('t_kios', ['id_kios' => $id_kios])->row_array();
      $pengawas = $this->db->get_where('t_pengawas', ['id_pengawas' => $kios['id_pengawas']])->row_array();
      ?>
      <table>
        <tr>
          <td>Kios</td>
          <td>:</td>
          <td><?= $kios['nama_kios'] ?></td>
        </tr>
        <tr>
          <td>Pengawas</td>
          <td>:</td>
          <td><?= $pengawas['nama_pengawas'] ?></td>
        </tr>
        <tr>
          <td>Jenis Transaksi</td>
          <td>:</td>
          <td>Pascabayar</td>
        </tr>
      </table>
      <hr>
      <table id="example" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Deskripsi Transaksi</th>
            <th>No Pelanggan</th>
            <th>Harga Modal</th>
            <th>Harga Jual</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total = 0;
          $total_beli = 0;
          foreach ($transaksi as $k => $ki) {
            $kios = $this->db->get_where('t_kios', ['id_kios' => $ki['id_kios']])->row_array();
            $total += $ki['harga_jual'];
            $total_beli += $ki['harga_beli'];
          ?>
            <tr>
              <td><?= ++$k ?></td>
              <td><?= date('d-m-Y', strtotime($ki['tanggal'])) ?></td>
              <td><?= $ki['deskripsi'] ?></td>
              <td><?= $ki['no_pelanggan'] ?></td>
              <td><?= number_format($ki['harga_beli']) ?></td>
              <td><?= number_format($ki['harga_jual']) ?></td>
            </tr>
          <?php }
          ?>
          <tr>
            <td colspan="4">
              <center>Total</center>
            </td>
            <td><?= number_format($total_beli) ?></td>
            <td><?= number_format($total) ?></td>
          </tr>
          <tr>
            <td colspan="4">
              <center>Keuntungan</center>
            </td>
            <?php
            $keuntungan = $total - $total_beli;
            echo "<td colspan='2'><center>Rp. " . number_format($keuntungan) . "</center></td>";
            ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-lg-1"></div>
  </div>
  <script src="<?= base_url('data_tabel/') ?>jquery-3.5.1.js"></script>
  <script src="<?= base_url() ?>assets/js/vendor-all.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
  <script>
    window.print();
  </script>
</body>

</html>