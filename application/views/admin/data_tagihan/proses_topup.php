<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Halaman Topup</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin/topup">Proses Topup</a></li>
              <li class="breadcrumb-item"><a href="#!">Tiket Topup</a></li>
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
            <h6><strong>Tiket Topup</strong></h6>
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
            <div class="row">
              <div class="col-md-12">
                <center>
                  <?php
                  if ($bank == "BCA") { ?>
                    <img src="https://cdn.mobilepulsa.net/img/logo/payment/small/bca.png" alt="Bank Tujuan">
                  <?php } elseif ($bank == "MANDIRI") { ?>
                    <img src="https://cdn.mobilepulsa.net/img/logo/payment/small/mandiri.png" alt="Bank Tujuan">
                  <?php } else { ?>
                    <img src="https://cdn.mobilepulsa.net/img/logo/payment/small/bri.png" alt="Bank Tujuan">
                  <?php }

                  ?>
                  <h3>Tiket Topup Saldo</h3>
                </center>
                <hr>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6" style="border: 1px solid #c7f394;padding:10px;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                <div class="row">
                  <div class="col-sm-4">Kode Tiket</div>
                  <div class="col-sm-8"><?= $kode_baru ?></div>
                </div>
                <div class="row">
                  <div class="col-sm-4">Jumlah Transfer</div>
                  <div class="col-sm-8"><?= $respon->amount ?></div>
                </div>
                <?php
                if ($bank == "BCA") { ?>
                  <div class="row">
                    <div class="col-sm-4">Nomor Rekening</div>
                    <div class="col-sm-8">6042888890</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">Nama Penerima</div>
                    <div class="col-sm-8">PT DIGIFLAZZ INTERKONEKSI INDONESIA</div>
                  </div>
                <?php } elseif ($bank == "MANDIRI") { ?>
                  <div class="row">
                    <div class="col-sm-4">Nomor Rekening</div>
                    <div class="col-sm-8">1550009910111</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">Nama Penerima</div>
                    <div class="col-sm-8">PT DIGIFLAZZ INTERKONEKSI INDONESIA</div>
                  </div>
                <?php } else { ?>
                  <div class="row">
                    <div class="col-sm-4">Nomor Rekening</div>
                    <div class="col-sm-8">213501000291307</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">Nama Penerima</div>
                    <div class="col-sm-8">PT DIGIFLAZZ INTERKONEKSI INDONESIA</div>
                  </div>
                <?php }

                ?>
                <div class="row">
                  <div class="col-sm-4">Keterangan</div>
                  <div class="col-sm-8"><?= $respon->notes ?></div>
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6" style="border: 1px solid #c7f394;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;padding:10px;background: #c7f394;">
                <div class="row">
                  <div class="col-sm-12">
                    <p>Mohon untuk melakukan transfer sesuia dengan jumlah yang tertera (Tanpa Pembulatan Nominal), untuk memudahkan proses verifikasi transfer deposit. <br> Kemudian Sertakan catatan tiket padasaat melakukan transfer deposit</p>
                    <br>
                    <p><strong>Catatan:</strong> Jumlah transfer (Rp. <?= number_format($respon->amount) ?>) hanya berlaku pada hari ini saja (<?= date('d-m-Y', strtotime($data_bar['tanggal'])) ?>)</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <center>
                  <a href="<?= base_url() ?>Admin/topup" class="btn btn-success"><i class="fas fa-home"></i> Kembali</a>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>