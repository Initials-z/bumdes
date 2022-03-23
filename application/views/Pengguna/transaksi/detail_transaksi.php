<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Detail Transaksi</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Pengguna"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Pengguna/pulsa">Tabel Data Admin</a></li>
              <li class="breadcrumb-item"><a href="#!">Detail Transaksi</a></li>
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
            <h6><strong>Laporan Transaksi</strong></h6>
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
                <?php
                if ($respon->status == "Gagal") { ?>
                  <table width="100%">
                    <tr>
                      <td>Kode Referal</td>
                      <td> : </td>
                      <td><?= $respon->ref_id ?></td>
                    </tr>
                    <tr>
                      <td>Nomor Hp</td>
                      <td> : </td>
                      <td><?= $respon->customer_no ?></td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td> : </td>
                      <td><?= $respon->message ?></td>
                    </tr>
                  </table>
                <?php } elseif ($respon->status == "Sukses") { ?>
                  <table width="100%">
                    <tr>
                      <td>Kode Transaksi</td>
                      <td> : </td>
                      <td><?= $kode_transaksi ?></td>
                    </tr>
                    <tr>
                      <td>Kode Referal</td>
                      <td> : </td>
                      <td><?= $respon->ref_id ?></td>
                    </tr>
                    <tr>
                      <td>Nomor Hp</td>
                      <td> : </td>
                      <td><?= $respon->customer_no ?></td>
                    </tr>
                    <tr>
                      <td>Harga</td>
                      <td> : </td>
                      <?php
                      $jumlah_jual = $this->db->get_where('t_harga_jual', ['buyer_sku_code' => $respon->buyer_sku_code])->row_array();
                      ?>
                      <td>Rp. <?= number_format($jumlah_jual['harga']) ?></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td> : </td>
                      <td><?= $respon->status ?></td>
                    </tr>
                    <tr>
                      <td>Token</td>
                      <td> : </td>
                      <td><?= $respon->sn ?></td>
                    </tr>
                  </table>
                <?php } else { ?>
                  <table width="100%">
                    <tr>
                      <td>Kode Transaksi</td>
                      <td> : </td>
                      <td><?= $kode_transaksi ?></td>
                    </tr>
                    <tr>
                      <td>Kode Unik</td>
                      <td> : </td>
                      <td><?= $respon->ref_id ?></td>
                    </tr>
                    <tr>
                      <td>Nomor Hp</td>
                      <td> : </td>
                      <td><?= $respon->customer_no ?></td>
                    </tr>
                    <tr>
                      <td>Harga</td>
                      <td> : </td>
                      <?php
                      $jumlah_jual = $this->db->get_where('t_harga_jual', ['buyer_sku_code' => $respon->buyer_sku_code])->row_array();
                      ?>
                      <td>Rp. <?= number_format($jumlah_jual['harga']) ?></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td> : </td>
                      <td id="status_respon"><?= $respon->status ?></td>
                    </tr>
                    <tr>
                      <td>Kode Token</td>
                      <td> : </td>
                      <td id="respon_sn"><?= $respon->sn ?></td>
                    </tr>
                  </table>
                <?php }
                ?>
              </div>
              <div class="col-md-2">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" align="right">
                <hr>
                <?php
                if ($respon->status == "Gagal") { ?>
                  <a href="<?= base_url() ?>Pengguna" class="btn btn-danger"><i class="fas fa-cart-plus"></i> Transaksi Lainnya</a>
                <?php } elseif ($respon->status == "Sukses") { ?>
                  <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-3" align="right" style="margin-right:-20px;margin-bottom:20px;">
                      <form action="<?= base_url() ?>Pengguna/selesai_transaksi" method="POST">
                        <input type="hidden" name="ref_id" value="<?= $respon->ref_id ?>" readonly>
                        <input type="hidden" name="customer_no" value="<?= $respon->customer_no ?>" readonly>
                        <input type="hidden" name="buyer_sku_code" value="<?= $respon->buyer_sku_code ?>" readonly>
                        <input type="hidden" name="harga" value="<?= $jumlah_jual['harga'] ?>" readonly>
                        <input type="hidden" name="kode_transaksi" value="<?= $kode_transaksi ?>" readonly>
                        <input type="hidden" name="deskripsi" value="<?= $deskripsi ?>" readonly>
                        <input type="hidden" name="status" value="<?= $respon->status ?>" id="status_respon" readonly>
                        <button type="submit" class="btn btn-success btn-block"><i class="icon-copy fa fa-check"></i> Selesai Transaksi</button>
                      </form>
                    </div>
                    <div class="col-md-3" align="left">
                      <a href="<?= base_url() ?>Transaksi/pdf/<?= $kode_transaksi ?>/<?= $jumlah_jual['harga'] ?>/<?= $deskripsi ?>/<?= $respon->customer_no ?>/<?= $respon->ref_id ?>" target="_blank" class="btn btn-warning"><i class="fas fa-print"></i> Bukti Transaksi</a>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="row">
                    <div class="col-md-12" align="center">
                      <h4><i>* Sistem sedang melakukan proses pembelian</i></h4>
                    </div>
                  </div>
                  <div style="display:none;">
                    <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-3" align="right" style="margin-right:-20px;margin-bottom:20px;">
                        <form action="<?= base_url() ?>Pengguna/status_transaksi" method="POST">
                          <input type="hidden" name="ref_id" value="<?= $respon->ref_id ?>" readonly>
                          <input type="hidden" name="customer_no" value="<?= $respon->customer_no ?>" readonly>
                          <input type="hidden" name="buyer_sku_code" value="<?= $respon->buyer_sku_code ?>" readonly>
                          <input type="hidden" name="harga" value="<?= $jumlah_jual['harga'] ?>" readonly>
                          <input type="hidden" name="kode_transaksi" value="<?= $kode_transaksi ?>" readonly>
                          <input type="hidden" name="deskripsi" value="<?= $deskripsi ?>" readonly>
                          <input type="hidden" name="status" value="<?= $respon->status ?>" id="status_respon" readonly>
                          <button type="submit" class="btn btn-primary btn-block" id="update-status"><i class="icon-copy fa fa-history"></i> Cek Status</button>
                        </form>
                      </div>
                      <div class="col-md-3" align="right" style="margin-right:-20px;margin-bottom:20px;">
                        <a href="<?= base_url() ?>Pengguna" class="btn btn-danger btn-block"><i class="fas fa-cart-plus"></i> Transaksi Lainnya</a>
                      </div>
                      <div class="col-md-2" align="right">
                        <a href="<?= base_url() ?>Transaksi/pdf/<?= $kode_transaksi ?>/<?= $jumlah_jual['harga'] ?>/<?= $deskripsi ?>/<?= $respon->customer_no ?>/<?= $respon->ref_id ?>" class="btn btn-warning btn-block" _target="blank"><i class="fas fa-print"></i> Cetak</a>
                      </div>
                    </div>
                  </div>
                <?php }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>