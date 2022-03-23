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
                    <td>Kode Referal</td>
                    <td> : </td>
                    <td><?= $list->ref_id ?></td>
                  </tr>
                  <tr>
                    <td>Kode Pelanggan</td>
                    <td> : </td>
                    <td><?= $list->customer_no ?></td>
                  </tr>
                  <tr>
                    <td>Nama Pelanggan</td>
                    <td> : </td>
                    <td><?= $list->customer_name ?></td>
                  </tr>
                  <?php
                  if (!isset($list->desc->jatuh_tempo)) { ?>
                    <tr>
                      <td>Jatuh Tempo</td>
                      <td> : </td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <td>Nama Nomor Polisi</td>
                      <td> : </td>
                      <td>-</td>
                    </tr>
                  <?php } else { ?>
                    <tr>
                      <td>Jatuh Tempo</td>
                      <td> : </td>
                      <td><?= date('d-m-Y', strtotime($list->desc->jatuh_tempo)) ?></td>
                    </tr>
                    <tr>
                      <td>Nama Nomor Polisi</td>
                      <td> : </td>
                      <td><?= $list->desc->no_pol ?></td>
                    </tr>
                  <?php }
                  ?>
                  <tr>
                    <td>Priode Pembayaran</td>
                    <td> : </td>
                    <td><?= $list->desc->detail[0]->periode ?></td>
                  </tr>
                </table>
                <table width="100%">
                  <tr>
                    <td>Jumlah Tagihan</td>
                    <td> </td>
                    <td align="right"> Rp. </td>
                    <td align="right"><?= number_format($list->selling_price) ?></td>
                  </tr>
                  <tr>
                    <td>Biaya Denda</td>
                    <td> </td>
                    <td align="right"> Rp. </td>
                    <td align="right"><?= number_format($list->desc->detail[0]->denda) ?></td>
                  </tr>
                  <tr>
                    <td>Biaya Lainnya</td>
                    <td> </td>
                    <td align="right"> Rp. </td>
                    <td align="right"><?= number_format($list->desc->detail[0]->biaya_lain) ?></td>
                  </tr>
                </table>
                <hr>
                <table width="100%">
                  <tr>
                    <td>Total Tagihan</td>
                    <td style="width: 180px;"></td>
                    <?php
                    $itung = $list->selling_price + $list->desc->detail[0]->denda + $list->desc->detail[0]->biaya_lain;
                    ?>
                    <td align="right"> Rp. </td>
                    <td align="right"><?= number_format($itung) ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-2">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" align="right">
                <hr>
                <a href="<?= base_url() ?>Admin/form_multi/<?= $list->buyer_sku_code ?>" class="btn btn-danger">Cek Kode Pelanggan Lainnya</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>