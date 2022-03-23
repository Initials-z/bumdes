<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Halaman Tabel Data Setoran Kios</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#!">Tabel Setoran Kios</a></li>
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
              <a href="<?= base_url() ?>Admin/form_setoran" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Tambah Data Setoran</a>
              <hr>
              <table id="example" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Waktu Setoran</th>
                    <th>Nama Kios</th>
                    <th>Jumlah Setoran</th>
                    <th>Pengawas</th>
                    <th>Proses</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($setoran as $k => $st) {
                    $kios = $this->db->get_where('t_kios', ['id_kios' => $st['id_kios']])->row_array();
                    $pengawas = $this->db->get_where('t_pengawas', ['id_pengawas' => $st['id_pengawas']])->row_array();
                  ?>
                    <tr>
                      <td><?= ++$k ?></td>
                      <td><?= date('d-m-Y H:i:s', strtotime($st['tanggal_setoran'])) ?></td>
                      <td><?= $kios['nama_kios'] ?></td>
                      <td><?= number_format($st['jumlah']) ?></td>
                      <td><?= $pengawas['nama_pengawas'] ?></td>
                      <td>
                        <center>
                          <a href="<?= base_url('Admin/setoran_edit/') . $st['id_setoran'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                          <a href="<?= base_url('Admin/setoran_hapus/') . $st['id_setoran'] ?>" class="btn btn-danger alertHapus"><i class="fas fa-trash"></i> Hapus</a>
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