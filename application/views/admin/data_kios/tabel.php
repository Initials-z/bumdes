<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Halaman Tabel Data Admin</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#!">Tabel Data Admin</a></li>
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
              <a href="<?= base_url() ?>Kios/form_input" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Tambah Data Kios</a>
              <hr>
              <table id="example" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Kios</th>
                    <th>Nama Kios</th>
                    <th>Lokasi</th>
                    <th>Proses</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($kios as $k => $ki) { ?>
                    <tr>
                      <td><?= ++$k ?></td>
                      <td><?= $ki['kode_kios'] ?></td>
                      <td><?= $ki['nama_kios'] ?></td>
                      <td><?= $ki['lokasi'] ?></td>
                      <td>
                        <center>
                          <a href="<?= base_url('Kios/tampil_edit/') . $ki['id_kios'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                          <a href="<?= base_url('Kios/reset_kios/') . $ki['id_kios'] ?>" class="btn btn-info reset-password"><i class="fas fa-key"></i> Reset Password</a>
                          <a href="<?= base_url('Kios/hapus_kios/') . $ki['id_kios'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
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