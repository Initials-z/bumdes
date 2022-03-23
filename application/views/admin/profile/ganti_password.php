<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Profile</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin/profile">Profile Admin</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin/ganti_password">Ganti Password</a></li>
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
            <h6><strong>Ganti Password</strong></h6>
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
            <form action="<?= base_url() ?>Admin/ganti_password_proses/<?= $akses['id_user'] ?>" method="post">
              <div class="form-group row">
                <div class="col-md-3" style="margin-top: 6px;">
                  <label for="pas_lama">Password Lama</label>
                </div>
                <div class="col-md-9">
                  <input type="password" name="pass_lama" id="ps-lama" placeholder="Password Lama" class="form-control">
                  <?= form_error('pass_lama', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3" style="margin-top: 6px;">
                  <label for="pas_baru">Password Baru</label>
                </div>
                <div class="col-md-9">
                  <input type="password" name="pass_baru" id="ps-baru" placeholder="Password Baru" class="form-control">
                  <?= form_error('pass_baru', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3" style="margin-top: 6px;">
                  <label for="konfirmasi">Konfirmasi Password</label>
                </div>
                <div class="col-md-9">
                  <input type="password" name="pass_konfirmasi" id="ps-konfirmasi" placeholder="Konfirmasi Password" class="form-control">
                  <?= form_error('pass_konfirmasi', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3" style="margin-top: 6px;">
                </div>
                <div class="col-md-9">
                  <input type="checkbox" onclick="Toggle()">
                  <span>Tampilkan Password</span>
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-12" align="right">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan Perubahan</button>
                  <a href="<?= base_url() ?>Admin/profile" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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