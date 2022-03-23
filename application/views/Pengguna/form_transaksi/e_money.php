<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Pembelian E-Money</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>Pengguna"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#!">Pembelian E-Money</a></li>
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
            <h6><strong>Input Nomor Pelanggan</strong></h6>
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
            <form action="<?= base_url() ?>Transaksi/e_money_proses" id="myform" method="POST">
              <input type="hidden" name="buyer_sku_code" value="<?= $kode ?>">
              <input type="hidden" name="harga" value="<?= $harga ?>">
              <input type="hidden" name="deskripsi" value="<?= $deskripsi ?>">
              <div class="form-group row">
                <div class="col-md-1 label">
                </div>
                <div class="col-md-2 label">
                  <label for="no_hp">Nomor Pelanggan</label>
                </div>
                <div class="col-md-8">
                  <input type="text" name="custommer_no" class="form-control" placeholder="Nomor Pelanggan" id="no_hp" required>
                </div>
                <div class="col-md-1 label">
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-11" align="right">
                  <button type="submit" class="btn btn-success"> <i class="fas fa-cart-plus"></i> Proses Beli</button>
                  <a href="<?= base_url() ?>Pengguna/e_money" class="btn btn-danger"><i class="fas fa-times"></i> Kembali</a>
                </div>
              </div>
            </form>
            <center>
              <div id="loading"></div>
            </center><br>
            <div id="result"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>