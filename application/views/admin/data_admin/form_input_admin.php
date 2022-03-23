<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Halaman Input Admin</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin/admin_tabel">Tabel Data Admin</a></li>
              <li class="breadcrumb-item"><a href="#!">Form Input Admin</a></li>
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
            <h6><strong>Data Admin</strong></h6>
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
            <form action="<?= base_url() ?>Admin/proses_input" id="myform" method="POST" enctype="multipart/form-data">
              <div class="form-group row">
                <div class="col-md-2 label">
                  <label for="nama">Nama Admin</label>
                </div>
                <div class="col-md-4">
                  <input type="text" name="nama_admin" class="form-control" placeholder="Nama Admin" id="nama" required>
                </div>
                <div class="col-md-2 label">
                  <label for="email">Email Admin</label>
                </div>
                <div class="col-md-4">
                  <input type="email" name="email_admin" class="form-control" placeholder="Email@admin" id="email" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2 label">
                  <label for="no_hp">Nomor Hp</label>
                </div>
                <div class="col-md-4">
                  <input type="text" name="no_hp" class="form-control" placeholder="Nomor Hp" id="no_hp" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2 label">
                  <label for="alamat">Alamat</label>
                </div>
                <div class="col-md-10">
                  <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Alamat Admin" required></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2 label">
                  <label for="tempat">Tempat Lahir</label>
                </div>
                <div class="col-md-4">
                  <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" id="tempat" required>
                </div>
                <div class="col-md-2 label">
                  <label for="tanggal">Tanggal Lahir</label>
                </div>
                <div class="col-md-4">
                  <input type="date" name="tanggal_lahir" class="form-control" id="tanggal" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2 label">
                  <label for="foto">Foto</label>
                </div>
                <div class="col-md-4">
                  <input type="file" name="foto_admin" id="imgInp">
                </div>
                <div class="col-md-6">
                  <center>
                    <img src="" width="50%" id="blah">
                  </center>
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