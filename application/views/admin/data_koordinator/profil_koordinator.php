<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Profile Admin</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin/admin_tabel">Tabel Data Admin</a></li>
              <li class="breadcrumb-item"><a href="#!">Profile Admin</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-5 col-md-12">
        <div class="card table-card">
          <div class="card-header">
            <h6><strong>Profile</strong></h6>
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
            <center>
              <img src="<?= base_url() ?>gambar/admin/<?= $koordinator['foto'] ?>" width="50%" alt="Foto Admin" id="blah">
            </center>
            <hr>
            <table width="100%">
              <tr>
                <td valign="top">Nama</td>
                <td valign="top" style="width:20px;">
                  <center>:</center>
                </td>
                <td align="right"><?= $koordinator['nama_pengawas'] ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td style="width:20px;">
                  <center>:</center>
                </td>
                <td align="right"><?= $koordinator['email_pengawas'] ?></td>
              </tr>
              <tr>
                <td>Kontak</td>
                <td style="width:20px;">
                  <center>:</center>
                </td>
                <td align="right"><?= $koordinator['no_hp'] ?></td>
              </tr>
              <tr>
                <td valign="top">Alamat</td>
                <td valign="top" style="width:20px;">
                  <center>:</center>
                </td>
                <td align="right"><?= $koordinator['alamat'] ?></td>
              </tr>
              <tr>
                <td>TTL</td>
                <td style="width:20px;">
                  <center>:</center>
                </td>
                <td align="right"><?= $koordinator['tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($koordinator['tanggal_lahir'])) ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-xl-7 col-md-12">
        <div class="card table-card">
          <div class="card-header">
            <h6><strong>Form Edit Data</strong></h6>
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
            <form action="<?= base_url() ?>Admin/proses_koordinator_edit" id="myform" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id_admin" value="<?= $koordinator['id_pengawas'] ?>">
              <div class="form-group row">
                <div class="col-md-3 label">
                  <label for="nama">Nama Admin</label>
                </div>
                <div class="col-md-9">
                  <input type="text" name="nama_admin" value="<?= $koordinator['nama_pengawas'] ?>" class="form-control" placeholder="Nama Admin" id="nama" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3 label">
                  <label for="email">Email Admin</label>
                </div>
                <div class="col-md-9">
                  <input type="email" name="email_admin" value="<?= $koordinator['email_pengawas'] ?>" class="form-control" placeholder="Email@admin" id="email" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3 label">
                  <label for="no_hp">Nomor Hp</label>
                </div>
                <div class="col-md-9">
                  <input type="text" name="no_hp" class="form-control" value="<?= $koordinator['no_hp'] ?>" placeholder="Nomor Hp" id="no_hp" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3 label">
                  <label for="alamat">Alamat</label>
                </div>
                <div class="col-md-9">
                  <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Alamat Admin" required><?= $koordinator['alamat'] ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3 label">
                  <label for="tempat">Tempat Lahir</label>
                </div>
                <div class="col-md-9">
                  <input type="text" name="tempat_lahir" value="<?= $koordinator['tempat_lahir'] ?>" class="form-control" placeholder="Tempat Lahir" id="tempat" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3 label">
                  <label for="tanggal">Tanggal Lahir</label>
                </div>
                <div class="col-md-9">
                  <input type="date" value="<?= $koordinator['tanggal_lahir'] ?>" name="tanggal_lahir" class="form-control" id="tanggal" required>
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-12" align="right">
                  <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan</button>
                  <button type="reset" class="btn btn-warning" onClick="document.location.reload(true)"> <i class="fas fa-sync"></i> Reload</button>
                  <a href="<?= base_url() ?><?= $kembali ?>" class="btn btn-danger"><i class="fas fa-times"></i> Kembali</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>