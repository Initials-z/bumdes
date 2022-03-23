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
              <li class="breadcrumb-item"><a href="#!">Data Saldo Kios</a></li>
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
              <?php
              $sld = $saldo['data']['deposit'];

              if ($t_saldo['jumlah_saldo'] == null) {
                $tampil = 0;
              } else {
                $tampil = $t_saldo['jumlah_saldo'];
              }

              $itung = $sld - $tampil;

              if ($itung <= 0) {
                echo "<p>Saldo tidak mencukupi</p>";
              } else { ?>
                <a href="<?= base_url() ?>Kios/input_saldo" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Kelola Limit Saldo Kios</a>
                <hr>
              <?php }
              ?>
              <p>*Saldo anda pada saat ini adalah Rp. <?= number_format($itung) ?></p>
              <hr>
              <table id="example" class="table table-striped table-bordered no-wrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Kios</th>
                    <th>Nama Kios</th>
                    <th>Saldo Kios</th>
                    <th>Tanggal Pengisian</th>
                    <th>Proses</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($limit as $n => $l) {
                    $kios = $this->db->get_where('t_kios', ['id_kios' => $l['id_kios']])->row_array();
                  ?>
                    <tr>
                      <td><?= $n + 1 ?></td>
                      <td><?= $kios['kode_kios'] ?></td>
                      <td><?= $kios['nama_kios'] ?></td>
                      <td>Rp. <?= number_format($l['jumlah_saldo']) ?></td>
                      <td><?= date('d M Y', strtotime($l['tanggal_pengisian'])) ?></td>
                      <td>
                        <center>
                          <a href="<?= base_url() ?>Kios/edit_limit/<?= $l['id_saldo'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                          <a href="<?= base_url() ?>Kios/hapus_limit/<?= $l['id_saldo'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
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