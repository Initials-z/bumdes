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
              <li class="breadcrumb-item"><a href="#!">Profile Admin</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <?php
    if ($akun['akses'] == '0') { ?>
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
              <div class="row">
                <div class="col-md-12">
                  <center>
                    <img src="<?= base_url() ?>gambar/admin/<?= $user['foto'] ?>" width="50%" alt="Foto Profile" id="blah">
                  </center>
                  <hr>
                  <table width="100%">
                    <tr>
                      <td style="width:100px;">Nama</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['nama_admin'] ?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['email_admin'] ?></td>
                    </tr>
                    <tr>
                      <td>No. Telp</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['no_hp'] ?></td>
                    </tr>
                    <tr>
                      <td valign="top">Alamat</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['alamat'] ?></td>
                    </tr>
                    <tr>
                      <td valign="top">Tempat Lahir</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['tempat_lahir'] ?></td>
                    </tr>
                    <tr>
                      <td valign="top">Tanggal Lahir</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= date('d-m-Y', strtotime($user['tanggal_lahir'])) ?></td>
                    </tr>
                  </table>
                  <hr>
                  <a href="<?= base_url() ?>Admin/ganti_password" class="btn btn-info"><i class="fas fa-key"></i> Ganti Password</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-7 col-md-12">
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
              <form action="<?= base_url() ?>Admin/proses_edit_profil" id="myform" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_admin" value="<?= $user['id_admin'] ?>">
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="nama">Nama Admin</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="nama_admin" value="<?= $user['nama_admin'] ?>" class="form-control" placeholder="Nama Admin" id="nama" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="email">Email Admin</label>
                  </div>
                  <div class="col-md-9">
                    <input type="email" name="email_admin" value="<?= $user['email_admin'] ?>" class="form-control" placeholder="Email@admin" id="email" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="no_hp">Nomor Hp</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="no_hp" value="<?= $user['no_hp'] ?>" class="form-control" placeholder="Nomor Hp" id="no_hp" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="alamat">Alamat</label>
                  </div>
                  <div class="col-md-9">
                    <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Alamat Admin" required><?= $user['alamat'] ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="tempat">Tempat Lahir</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?= $user['tempat_lahir'] ?>" id="tempat" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="tanggal">Tanggal Lahir</label>
                  </div>
                  <div class="col-md-9">
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= $user['tanggal_lahir'] ?>" id="tanggal" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="foto">Foto</label>
                  </div>
                  <div class="col-md-4">
                    <input type="file" name="foto_admin" id="imgInp">
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-md-12" align="right">
                    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan</button>
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
    <?php } else { ?>
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
              <div class="row">
                <div class="col-md-12">
                  <center>
                    <img src="<?= base_url() ?>gambar/admin/<?= $user['foto'] ?>" width="50%" alt="Foto Profile" id="blah">
                  </center>
                  <hr>
                  <table width="100%">
                    <tr>
                      <td style="width:100px;">Nama</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['nama_admin'] ?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['email_admin'] ?></td>
                    </tr>
                    <tr>
                      <td>No. Telp</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['no_hp'] ?></td>
                    </tr>
                    <tr>
                      <td valign="top">Alamat</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['alamat'] ?></td>
                    </tr>
                    <tr>
                      <td valign="top">Tempat Lahir</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= $user['tempat_lahir'] ?></td>
                    </tr>
                    <tr>
                      <td valign="top">Tanggal Lahir</td>
                      <td valign="top" style="width:20px;">
                        <center>:</center>
                      </td>
                      <td> <?= date('d-m-Y', strtotime($user['tanggal_lahir'])) ?></td>
                    </tr>
                  </table>
                  <hr>
                  <a href="<?= base_url() ?>Admin/ganti_password" class="btn btn-info"><i class="fas fa-key"></i> Ganti Password</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-7 col-md-12">
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
              <form action="<?= base_url() ?>Admin/proses_edit_profil" id="myform" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_admin" value="<?= $user['id_admin'] ?>">
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="nama">Nama Admin</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="nama_admin" value="<?= $user['nama_admin'] ?>" class="form-control" placeholder="Nama Admin" id="nama" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="email">Email Admin</label>
                  </div>
                  <div class="col-md-9">
                    <input type="email" name="email_admin" value="<?= $user['email_admin'] ?>" class="form-control" placeholder="Email@admin" id="email" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="no_hp">Nomor Hp</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="no_hp" value="<?= $user['no_hp'] ?>" class="form-control" placeholder="Nomor Hp" id="no_hp" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="alamat">Alamat</label>
                  </div>
                  <div class="col-md-9">
                    <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Alamat Admin" required><?= $user['alamat'] ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="tempat">Tempat Lahir</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?= $user['tempat_lahir'] ?>" id="tempat" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="tanggal">Tanggal Lahir</label>
                  </div>
                  <div class="col-md-9">
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= $user['tanggal_lahir'] ?>" id="tanggal" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3 label">
                    <label for="foto">Foto</label>
                  </div>
                  <div class="col-md-4">
                    <input type="file" name="foto_admin" id="imgInp">
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-md-12" align="right">
                    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan</button>
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
    <?php }
    ?>
  </div>
</div>