<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header">
            <h3><strong>Form Input Data Kios</strong></h3>
          </div>
          <div class="card-body">
            <form action="<?= base_url() ?>Kios/proses_kios" id="myform" method="POST" enctype="multipart/form-data">
              <div class="form-group row">
                <div class="col-md-2 label">
                  <label for="operator">Nama Operator</label>
                </div>
                <div class="col-md-4">
                  <input type="text" name="nama_pemilik" placeholder="Nama Operator" class="form-control" readonly>
                </div>
                <div class="col-md-2 label">
                  <label for="email">Email Operator</label>
                </div>
                <div class="col-md-4">
                  <input type="email" name="email_pemilik" class="form-control" placeholder="Email Operator" id="email" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2 label">
                  <label for="operator">Nama Operator</label>
                </div>
                <div class="col-md-4">
                  <input type="text" name="nama_pemilik" placeholder="Nama Operator" class="form-control" readonly>
                </div>
                <div class="col-md-2 label">
                  <label for="email">Email Operator</label>
                </div>
                <div class="col-md-4">
                  <input type="email" name="email_pemilik" class="form-control" placeholder="Email Operator" id="email" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2 label">
                  <label for="alamat">Lokasi</label>
                </div>
                <div class="col-md-10">
                  <textarea name="lokasi" id="alamat" rows="5" class="form-control" placeholder="Lokasi Kios" required></textarea>
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-12" align="right">
                  <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan</button>
                  <a href="<?= base_url() ?><?= $kembali ?>" class="btn btn-danger"><i class="fas fa-times"></i> Kembali</a>
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