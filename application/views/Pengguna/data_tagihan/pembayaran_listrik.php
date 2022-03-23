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
            <div class="row">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
                <table width="100%">
                  <tr>
                    <td>Kode Transaksi</td>
                    <td> : </td>
                    <td><?= $kode_transaksi ?></td>
                  </tr>
                  <tr>
                    <td valign="top">Kode Referal</td>
                    <td valign="top"> : </td>
                    <td><?= $list->ref_id ?> <br> <?= $list->buyer_sku_code ?></td>
                  </tr>
                  <tr>
                    <td>ID Pelanggan</td>
                    <td> : </td>
                    <td><?= $list->customer_no ?></td>
                  </tr>
                  <tr>
                    <td>Nama Pelanggan</td>
                    <td> : </td>
                    <td><?= $list->customer_name ?></td>
                  </tr>
                  <tr>
                    <td>Status Pembayaran</td>
                    <td> : </td>
                    <td><?= $list->status ?></td>
                  </tr>
                  <tr>
                    <td>Periode Pembayaran</td>
                    <td> : </td>
                    <?php
                    $cek = $list->desc->detail[0]->periode;
                    $pecah = substr($cek, 4);
                    $tahun = substr($cek, 0, 4);

                    $bulan = array(
                      '01' => 'Januari',
                      '02' => 'Februari',
                      '03' => 'Maret',
                      '04' => 'April',
                      '05' => 'Mei',
                      '06' => 'Juni',
                      '07' => 'Juli',
                      '08' => 'Agustus',
                      '09' => 'September',
                      '10' => 'Oktober',
                      '11' => 'November',
                      '12' => 'Desember',
                    );

                    $baru = $bulan[$pecah];

                    ?>
                    <td><?= $baru . ' ' . $tahun ?></td>
                  </tr>
                  <tr>
                    <td>Serial Number (S/N)</td>
                    <td> : </td>
                    <td><?= $list->sn ?></td>
                  </tr>
                </table>
                <table width="100%">
                  <tr>
                    <td>Jumlah Tagihan</td>
                    <td> </td>
                    <td align="right"> Rp. </td>
                    <td align="right"><?= number_format($list->desc->detail[0]->nilai_tagihan) ?></td>
                  </tr>
                  <tr>
                    <td>Denda</td>
                    <td> </td>
                    <td align="right"> Rp. </td>
                    <td align="right"><?= number_format($list->desc->detail[0]->denda) ?></td>
                  </tr>
                  <tr>
                    <td>Biaya Admin</td>
                    <td> </td>
                    <td align="right"> Rp. </td>
                    <td align="right"><?= number_format($list->desc->detail[0]->admin) ?></td>
                  </tr>
                </table>
                <hr>
                <table width="100%">
                  <tr>
                    <td>Total Pembayaran</td>
                    <td style="width: 180px;"></td>
                    <?php
                    $itung = $list->desc->detail[0]->nilai_tagihan + $list->desc->detail[0]->denda + $list->desc->detail[0]->admin;
                    ?>
                    <td align="right"> Rp. </td>
                    <td align="right"><?= number_format($itung) ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-2">
              </div>
            </div>
            <hr>
            <form action="<?= base_url() ?>Transaksi/struk_pln_pasca" target="_blank" method="POST">
              <div class="form-group row">
                <div class="col-md-6"></div>
                <div class="col-md-6" align="right" style="margin-top: 10px;">
                  <input type="hidden" name="buyer_sku_code" value="<?= $list->buyer_sku_code ?>">
                  <input type="hidden" name="customer_no" value="<?= $list->customer_no ?>">
                  <input type="hidden" name="ref_id" value="<?= $list->ref_id ?>">
                  <input type="hidden" name="kode_transaksi" value="<?= $kode_transaksi ?>">
                  <input type="hidden" name="total" value="<?= $itung ?>">
                  <input type="hidden" name="admin" value="<?= $list->desc->detail[0]->admin ?>">
                  <input type="hidden" name="denda" value="<?= $list->desc->detail[0]->denda ?>">
                  <input type="hidden" name="tagihan" value="<?= $list->desc->detail[0]->nilai_tagihan ?>">
                  <input type="hidden" name="periode" value="<?= $baru . ' ' . $tahun ?>">
                  <input type="hidden" name="nama" value="<?= $list->customer_name ?>">
                  <input type="hidden" name="Status" value="<?= $list->status ?>">
                  <input type="hidden" name="sn" value="<?= $list->sn ?>">
                  <button type="submit" class="btn btn-success"><i class="fas fa-print"></i> Cetak Struk</button>
                  <a href="<?= base_url() ?>Pengguna" class="btn btn-danger"><i class="fas fa-home"></i> Transaksi Lainnya</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>