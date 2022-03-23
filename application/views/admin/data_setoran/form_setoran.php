<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Halaman Form Input Setoran</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin/setoran">Data Setoran</a></li>
              <li class="breadcrumb-item"><a href="#!">Input Setoran</a></li>
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
              <form action="<?= base_url() ?>Admin/proses_setoran" id="myform" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-md-2 label">
                    <label for="kios">Kios</label>
                  </div>
                  <div class="col-md-9">
                    <select name="id_kios" aria-placeholder="Pilih Kios" class="form-control select2" id="kios">
                      <option value="">Pilih Kios</option>
                      <?php foreach ($kios as $kios) { ?>
                        <option value="<?= $kios['id_kios'] ?>"><?= $kios['nama_kios'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-2 label">
                    <label for="setoran">Jumlah Setoran</label>
                  </div>
                  <div class="col-md-9">
                    <input type="number" name="jumlah" pattern="[0-9]" class="form-control" placeholder="Jumlah Setoran" id="setoran" required>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-md-12" align="center">
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