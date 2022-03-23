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
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Pengguna"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#!">Profile Admin</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
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
                <table width="100%">
                  <tr>
                    <td style="width:100px;">Kode Kios</td>
                    <td valign="top" style="width:20px;">
                      <center>:</center>
                    </td>
                    <td> <?= $user['kode_kios'] ?></td>
                  </tr>
                  <tr>
                    <td>Nama Kios</td>
                    <td valign="top" style="width:20px;">
                      <center>:</center>
                    </td>
                    <td> <?= $user['nama_kios'] ?></td>
                  </tr>
                  <tr>
                    <td valign="top">Lokasi Kios</td>
                    <td valign="top" style="width:20px;">
                      <center>:</center>
                    </td>
                    <td> <?= $user['lokasi'] ?></td>
                  </tr>
                  <tr>
                    <td valign="top">Pengawas</td>
                    <td valign="top" style="width:20px;">
                      <center>:</center>
                    </td>
                    <?php
                    $pengawas = $this->db->get_where('t_pengawas', ['id_pengawas' => $user['id_pengawas']])->row_array();
                    ?>
                    <td> <?= $pengawas['nama_pengawas'] ?></td>
                  </tr>
                  <tr>
                    <td valign="top">Kontak</td>
                    <td valign="top" style="width:20px;">
                      <center>:</center>
                    </td>
                    <td> <?= $pengawas['no_hp'] ?></td>
                  </tr>
                </table>
                <hr>
                <a href="<?= base_url() ?>Pengguna/ganti_password" class="btn btn-info"><i class="fas fa-key"></i> Ganti Password</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-7 col-md-12">
        <div class="card table-card">
          <div class="card-header">
            <h6><strong>Data Pengguna</strong></h6>
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
            <form action="<?= base_url() ?>Pengguna/proses_edit_profil" id="myform" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id_kios" value="<?= $user['id_kios'] ?>">
              <div class="form-group row">
                <div class="col-md-3 label">
                  <label for="nama">Kode Kios</label>
                </div>
                <div class="col-md-9">
                  <input type="text" value="<?= $user['kode_kios'] ?>" class="form-control" readonly>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3 label">
                  <label for="Nama Kios">Nama Kios</label>
                </div>
                <div class="col-md-9">
                  <input type="text" name="nama_kios" value="<?= $user['nama_kios'] ?>" class="form-control" placeholder="Nama Kios" id="Nama Kios" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3 label">
                  <label for="lokasi">Lokasi Kios</label>
                </div>
                <div class="col-md-9">
                  <textarea name="lokasi" id="lokasi" rows="5" class="form-control" placeholder="Lokasi Kios" required><?= $user['lokasi'] ?></textarea>
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
  </div>
</div>