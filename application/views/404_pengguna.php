<!DOCTYPE html>
<html dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <title>BUMDES | <?= $judul ?></title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>gambar/my2.png">
  <link href="<?= base_url('template/') ?>dist/css/style.min.css" rel="stylesheet">
  <style>
    .shadow {
      box-shadow: 10px 10px 10px rgb(60 59 59 / 69%);
      border: 5px solid #4c4c4c61;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(<?= base_url('template/') ?>assets/images/big/auth-bg.jpg) no-repeat center center;">
      <div class="auth-box row shadow">
        <div class="col-lg-12 col-md-7 bg-white">
          <div class="p-3">
            <div class="text-center">
              <img src="<?= base_url() ?>gambar/my3.png" width="280px" alt="wrapkit">
            </div>
            <center>
              <h1><strong>404 NOT FOUND</strong></h1>
            </center>
            <center>
              <h3><strong>Terjadi kesalahaan pada akun anda silakan login atau konfirmasi ke admin !</strong></h3>
            </center>
            <br>

            <center>
              <a href="<?= base_url('index.php') ?>Welcome/kios" class="btn btn-success btn-block"><i class="fas fa-lock"></i> Login</a>
            </center>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- All Required js -->
  <!-- ============================================================== -->
  <script src="<?= base_url('template/') ?>assets/libs/jquery/dist/jquery.min.js "></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?= base_url('template/') ?>assets/libs/popper.js/dist/umd/popper.min.js "></script>
  <script src="<?= base_url('template/') ?>assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
  <!-- ============================================================== -->
  <!-- This page plugin js -->
  <!-- ============================================================== -->
  <script>
    $(".preloader ").fadeOut();
  </script>
</body>

</html>