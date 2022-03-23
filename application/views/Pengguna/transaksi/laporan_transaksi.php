<div class="pcoded-main-container">
  <div class="pcoded-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Halaman Laporan Transaksi</h5>
            </div>
            <ul class="breadcrumb">
              <?php
              if ($akses['akses'] == 0) {
              ?>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <?php } else { ?>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>Pengguna"><i class="feather icon-home"></i></a></li>
              <?php }
              ?>
              <li class="breadcrumb-item"><a href="#!">Tabel Data Laporan Transaksi</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card table-card">
          <div class="card-header">
            <h6><strong>Data Transaksi</strong></h6>
            <div class="card-header-right">
              <div class="btn-group card-option">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="feather icon-more-horizontal"></i>
                </button>
                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                  <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                  <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                  <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body p-2">
            <div class="table-responsive">
              <form action="">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label for="mulai">Mulai Filter Cetak</label>
                    <input type="date" class="form-control" name="mulai" id="mulai">
                  </div>
                  <div class="col-md-4">
                    <label for="selesai">Selesai Filter Cetak</label>
                    <input type="date" class="form-control" name="selesai" id="selesai">
                  </div>
                  <div class="col-md-4" style="margin-top:30px;">
                    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak Laporan</button>
                  </div>
                </div>
              </form>
              <hr>
              <table id="example" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Deskripsi Transaksi</th>
                    <th>No Pelanggan</th>
                    <th>Harga</th>
                    <th>Tanggal Transaksi</th>
                    <th>Proses</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($transaksi as $k => $ki) {
                  ?>
                    <tr>
                      <td><?= ++$k ?></td>
                      <td><?= $ki['kode_transaksi'] ?></td>
                      <td><?= $ki['deskripsi'] ?></td>
                      <td><?= $ki['no_pelanggan'] ?></td>
                      <td><?= number_format($ki['harga_jual']) ?></td>
                      <td><?= date('d-m-Y', strtotime($ki['tanggal'])) ?></td>
                      <td>
                        <center>
                          <a href="<?= base_url() ?>Transaksi/pdf/<?= $ki['kode_transaksi'] ?>/<?= $ki['harga_jual'] ?>/<?= $ki['deskripsi'] ?>/<?= $ki['no_pelanggan'] ?>/<?= $ki['ref_id'] ?>" target="_blank" class="btn btn-info"><i class="fas fa-print"></i> Cetak Bukti</a>
                        </center>
                      </td>
                    </tr>
                  <?php }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>