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
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>gambar/my3.png">
    <link href="<?= base_url('template/') ?>dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>dist/sweetalert.css">
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
                        <form class="mt-4" action="<?= base_url() ?>Welcome/login_pos" method="POST">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Email</label>
                                        <input class="form-control" id="uname" name="username" type="email" placeholder="Masukkan Email Anda">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control" id="pwd" name="password" type="password" placeholder="Masukkan Password Anda">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center mt-4">
                                    <button type="submit" style="width:100%;" class="btn btn-block btn-dark">Login</button>
                                </div>
                            </div>
                        </form>
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
    <script src="<?= base_url() ?>dist/sweetalert.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
    <script>
        <?php
        if ($this->session->flashdata('pass')) { ?>
            swal({
                type: 'error',
                title: 'Gagal login!',
                timer: 2500,
                showConfirmButton: false,
            });
        <?php } elseif ($this->session->flashdata('gagal')) { ?>
            swal({
                type: 'error',
                title: 'Gagal login!',
                timer: 2500,
                showConfirmButton: false,
            });
        <?php }
        ?>
    </script>
</body>

</html>