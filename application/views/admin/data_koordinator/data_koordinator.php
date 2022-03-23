<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Halaman Tabel Data Pengawas/Koordinator</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#!">Tabel Data Pengawas/Koordinator</a></li>
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
            <h6><strong>Data Koordinator</strong></h6>
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
              <a href="<?= base_url() ?>Admin/input_koordinator" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data Koordinator/Pengawas</a>
              <hr>
              <table id="example" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pengawas</th>
                    <th>Email Pengawas</th>
                    <th>Proses</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($koordinator as $n => $a) {
                    $aktifasi = $this->db->get_where('t_user', ['username' => $a['email_pengawas']])->row_array();
                  ?>
                    <tr>
                      <td><?= ++$n ?></td>
                      <td><?= $a['nama_pengawas'] ?></td>
                      <td><?= $a['email_pengawas'] ?></td>
                      <td>
                        <center>
                          <a href="<?= base_url('Admin/tampil_koordinator/') . $a['id_pengawas'] ?>" class="btn btn-warning"><i class="fas fa-eye"></i> Profile</a>
                          <?php
                          if ($user['email_admin'] == $aktifasi['username']) {
                          } else {
                            if ($aktifasi['akun'] == 1) { ?>
                              <a href="<?= base_url('Admin/koor_nonaktif/') . $aktifasi['id_user'] ?>" class="btn btn-success Nonaktif" id="Nonaktif"><i class="fas fa-check"></i> Aktif</a>
                            <?php } else { ?>
                              <a href="<?= base_url('Admin/koor_aktif/') . $aktifasi['id_user'] ?>" class="btn btn-info"><i class="fas fa-power-off"></i> Nonaktif</a>
                            <?php }
                            ?>
                            <a href="<?= base_url('Admin/hapus_pengawas/') . $a['id_pengawas'] ?>" class="btn btn-danger alertHapus" id="alertHapus"><i class="fas fa-trash"></i> Hapus</a>
                            <a href="<?= base_url('Admin/cek_kios/') . $a['id_pengawas'] ?>" class="btn btn-info"><i class="fas fa-list"></i> Lihat Kios</a>
                          <?php }
                          ?>
                        </center>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>