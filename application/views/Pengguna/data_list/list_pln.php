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
        <div class="col-lg-7 col-md-12">
          <!-- support-section start -->
          <div class="row">
            <div class="col-sm-6">
              <div class="card support-bar overflow-hidden">
                <?php
                if ($saldo['jumlah_saldo'] > 0) { ?>
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h4 class="text-c-yellow"><?= number_format($saldo['jumlah_saldo']) ?></h4>
                        <h6 class="text-muted m-b-0">Saldo</h6>
                      </div>
                      <div class="col-4 text-right">
                        <i class="feather icon-bar-chart-2 f-28"></i>
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h4 class="text-c-yellow"><?= number_format($saldo['jumlah_saldo']) ?></h4>
                        <h6 class="text-muted m-b-0">Saldo</h6>
                      </div>
                      <div class="col-4 text-right">
                        <i class="feather icon-bar-chart-2 f-28"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-c-red">
                    <div class="row align-items-center">
                      <div class="col-9">
                        <p class="text-white m-b-0">Saldo Anda Tidak Mencukupi</p>
                      </div>
                    </div>
                  </div>
                <?php }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-md-1">
          <div class="card table-card">
            <div class="card-header">
              <h6><strong>Pembelian Pulsa</strong></h6>
            </div>
            <div class="card-body p-2">
              <input type="text" class="form-control" id="searchbar" onkeyup="search_animal()" placeholder="Search for names.." title="Type in a name" name="search">
            </div>
          </div>
        </div>
        <?php
        foreach ($list as $al) {
          if ($al->category == "PLN") {
            $harga = $this->db->get_where('t_harga_jual', ['buyer_sku_code' => $al->buyer_sku_code])->row_array();
        ?>
            <div class="col-xl-12 col-md-1 animals">
              <div class="card table-card" style="padding:10px;">
                <div class="card-body p-2">
                  <div class="row">
                    <div class="col-md-10">
                      <h4 class="text-c-black"><?= $al->product_name ?></h4>
                      <h5 class="text-muted m-b-0"><?= $al->brand ?></h5>
                      <hr>
                    </div>
                    <div class="col-md-2 text-center" align="right">
                      <?php
                      if (empty($harga['harga'])) { ?>
                        <h6 class="text-muted m-b-10">Harga jual belum diatur oleh admin</h6>
                      <?php } else { ?>
                        <h6 class="text-muted m-b-10">Harga : Rp. <?= number_format($harga['harga']) ?></h6>
                        <a href="<?= base_url() ?>Transaksi/pulsa_pln/<?= $al->buyer_sku_code ?>/<?= $harga['harga'] ?>/<?= $al->product_name ?>" class="btn btn-info btn-block" style="border-radius: 7px;padding:5px;">Beli</a>
                      <?php }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php } else {
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>
</div>