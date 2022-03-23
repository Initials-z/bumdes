<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body shadow">
            <div class="table-responsive">
              <h6><strong>Data List Harga Pulsa All Operator</strong></h6>
              <hr>
              <table id="zero_config" class="table table-striped table-bordered no-wrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Provider</th>
                    <th>Produk</th>
                    <th>Harga</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($list as $k => $al) { ?>
                    <tr>
                      <td><?= ++$k ?></td>
                      <td><?= $al->buyer_sku_code ?></td>
                      <td><?= $al->brand ?></td>
                      <td><?= $al->product_name ?></td>
                      <td>Rp. <?= number_format($al->price) ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>