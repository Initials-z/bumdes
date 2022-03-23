<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Halaman Form Input Kios</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin/limit">Tabel Data Limit</a></li>
              <li class="breadcrumb-item"><a href="#!">Input Data Saldo Kios</a></li>
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
            <h6><strong>Data Kios</strong></h6>
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
              <form action="<?= base_url() ?>Kios/proses_saldo_kios" id="myform" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-md-2">
                    <label for="kios">Nama Kios</label>
                  </div>
                  <div class="col-md-10">
                    <select class="js-example-basic-single form-control" name="id_kios" required>
                      <option>Pilih Kios</option>
                      <?php
                      foreach ($kios as $vk) { ?>
                        <option value="<?= $vk['id_kios'] ?>"><?= $vk['nama_kios'] ?></option>
                      <?php }
                      ?>
                    </select>
                    <?= validation_errors('id_kios'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-2 label">
                    <label for="saldo">Jumlah Saldo</label>
                  </div>
                  <div class="col-md-10">
                    <?= validation_errors('jumlah_saldo'); ?>
                    <?php
                    $sld = $saldo['data']['deposit'];

                    if ($t_saldo['jumlah_saldo'] == null) {
                      $tampil = 0;
                    } else {
                      $tampil = $t_saldo['jumlah_saldo'];
                    }

                    $itung = $sld - $tampil;

                    if ($itung == 0) { ?>
                      <input type="text" name="jumlah_saldo" class="form-control" value="<?= form_error('jumlah_saldo') ?>" placeholder="Jumlah Saldo" disabled>
                    <?php } else { ?>
                      <input type="text" name="jumlah_saldo" class="form-control" value="<?= form_error('jumlah_saldo') ?>" placeholder="Jumlah Saldo" id="rupiah" required>
                      <hr>
                    <?php }
                    ?>
                    <span>*Jumlah saldo saat ini Rp. <?= number_format($itung) ?></span>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-md-12" align="right">
                    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan</button>
                    <a href="<?= base_url() ?><?= $kembali ?>" class="btn btn-danger"><i class="fas fa-times"></i> Kembali</a>
                  </div>
                </div>
              </form>
              <center>
                <div id="loading"></div>
              </center><br>
              <div id="result"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>