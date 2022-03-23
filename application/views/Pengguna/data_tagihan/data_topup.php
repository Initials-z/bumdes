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
            <form action="<?= base_url() ?>Admin/proses_deposit" id="myform" method="POST" enctype="multipart/form-data">
              <div class="form-group row">
                <div class="col-md-1 label">
                </div>
                <div class="col-md-2 label">
                  <label for="kode_konsumen">Nominal</label>
                </div>
                <div class="col-md-8">
                  <input type="text" name="amount" class="form-control" placeholder="Jumlah Deposit" id="kode_konsumen" required>
                </div>
                <div class="col-md-1 label">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-1 label">
                </div>
                <div class="col-md-2 label">
                  <label for="pembayaran">Tujuan</label>
                </div>
                <div class="col-md-8">
                  <select name="bank" class="form-control" id="">
                    <option value="">-Pilih Bank-</option>
                    <option value="BCA">BCA</option>
                    <option value="BRI">BRI</option>
                    <option value="MANDIRI">MANDIRI</option>
                  </select>
                </div>
                <div class="col-md-1 label">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-1 label">
                </div>
                <div class="col-md-2 label">
                  <label for="pemilik">Pemilik Rekening</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="owner_name" placeholder="Pemilik Rekening" id="pemilik">
                </div>
                <div class="col-md-1 label">
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-11" align="right">
                  <button type="submit" class="btn btn-success"> <i class="fas fa-paper-plane"></i> Proses Deposit</button>
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