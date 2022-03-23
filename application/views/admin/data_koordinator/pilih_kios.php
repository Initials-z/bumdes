<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">List Kios</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin/koordinator">Tabel Data Pengawas/Koordinator</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url($kembali) ?>">List Kios</a></li>
              <li class="breadcrumb-item"><a href="">Pilihan Kios</a></li>
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
            <h6><strong>Data Koordinator Kios</strong></h6>
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
              <table>
                <tr>
                  <td style="width: 200px;">Nama Koordinator</td>
                  <td style="width: 20px;">
                    <center>:</center>
                  </td>
                  <td><?= $pengawas['nama_pengawas'] ?></td>
                </tr>
                <tr>
                  <td style="width: 200px;">Email Koordinator</td>
                  <td style="width: 20px;">
                    <center>:</center>
                  </td>
                  <td><?= $pengawas['email_pengawas'] ?></td>
                </tr>
                <tr>
                  <td style="width: 200px;">Nomor Hp</td>
                  <td style="width: 20px;">
                    <center>:</center>
                  </td>
                  <td><?= $pengawas['no_hp'] ?></td>
                </tr>
                <tr>
                  <td style="width: 200px;" valign="top">Alamat</td>
                  <td style="width: 20px;" valign="top">
                    <center>:</center>
                  </td>
                  <td><?= $pengawas['alamat'] ?></td>
                </tr>
                <tr>
                  <td style="width: 200px;" valign="top">Tempat Tanggal Lahir</td>
                  <td style="width: 20px;" valign="top">
                    <center>:</center>
                  </td>
                  <td><?= $pengawas['tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($pengawas['tanggal_lahir'])) ?></td>
                </tr>
              </table>
              <hr>
              <form action="<?= base_url() ?>Kios/proses_pilih" method="POST">
                <input type="hidden" name="id_pengawas" value="<?= $pengawas['id_pengawas'] ?>">
                <table id="example" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 50px;">Pilih</th>
                      <th>Kode Kios</th>
                      <th>Nama Kios</th>
                      <th>Lokasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($kios as $n => $a) {
                    ?>
                      <tr>
                        <td>
                          <center><input type="checkbox" name="pilihan[]" value="<?= $a['id_kios'] ?>"></center>
                        </td>
                        <td><?= $a['kode_kios'] ?></td>
                        <td><?= $a['nama_kios'] ?></td>
                        <td><?= $a['lokasi'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <hr>
                <div class="form-group row">
                  <div class="col-md-12" align="right">
                    <button type="submit" class="btn btn-success"><i class="fas fa-floppy-o"></i> Simpan</button>
                    <a href="<?= base_url($kembali) ?>" class="btn btn-danger"><i class="fas fa-times"></i> Kembali</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>