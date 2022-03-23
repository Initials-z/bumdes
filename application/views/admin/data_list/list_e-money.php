<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Halaman List Harga Pulsa</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#!">List Harga Pulsa</a></li>
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
            <h6><strong>Data Harga Pulsa</strong></h6>
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
              <form action="<?= base_url() ?>Admin/pos_harga" method="POST">
                <input type="hidden" name="redir" value="Admin/list_money">
                <table id="example" class="table table-striped table-bordered no-wrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Produk</th>
                      <th>Provider</th>
                      <th>Distributor</th>
                      <th>Produk</th>
                      <th>Harga</th>
                      <th>Harga Jual</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $k = 1;
                    foreach ($list as $al) {
                      if ($al->category == "E-Money") {
                        $harga = $this->db->get_where('t_harga_jual', ['buyer_sku_code' => $al->buyer_sku_code])->row_array();
                    ?>
                        <tr>
                          <td><?= $k ?></td>
                          <td><?= $al->buyer_sku_code ?></td>
                          <td><?= $al->brand ?></td>
                          <td><?= $al->seller_name ?></td>
                          <td><?= $al->product_name ?></td>
                          <td>Rp. <?= number_format($al->price) ?></td>
                          <?php
                          if ($harga == null) { ?>
                            <td>
                              <div class="form-gorup row">
                                <div class="col-md-12">
                                  <input type="hidden" name="buyer_sku_code[]" value="<?= $al->buyer_sku_code ?>">
                                  <input type="text" name="harga[]" class="form-control" placeholder="Harga Jual">
                                </div>
                              </div>
                            </td>
                          <?php } else { ?>
                            <td>
                              <div class="form-gorup row">
                                <div class="col-md-12">
                                  <input type="hidden" name="buyer_sku_code[]" value="<?= $al->buyer_sku_code ?>">
                                  <input type="text" name="harga[]" value="<?= $harga['harga'] ?>" class="form-control" placeholder="Harga Jual">
                                </div>
                              </div>
                            </td>
                          <?php }
                          ?>
                        </tr>
                      <?php
                        $k = $k + 1;
                      } else {
                      }
                      ?>

                    <?php } ?>
                  </tbody>
                </table>
                <hr>
                <div class="form-group row">
                  <div class="col-md-12" align="right">
                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-save"></i> Simpan Perubahan</button>
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