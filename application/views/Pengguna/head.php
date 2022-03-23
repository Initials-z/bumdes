<!DOCTYPE html>
<html lang="en">

<head>
    <title>BUMDES | <?= $judul ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Bumdes Rimbo Panjang" />
    <link rel="icon" type="image/png" href="<?= base_url() ?>gambar/my3.png">
    <!-- vendor css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('select2/') ?>css/select2.min.css">
    <link href="<?= base_url('data_tabel/') ?>jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>dist/sweetalert.css">
    <style>
        .label {
            margin-top: 5px;
        }
    </style>
</head>

<body class="">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <nav class="pcoded-navbar menu-light ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">
                <div class="">
                    <div class="main-menu-header">
                        <img style="width:80%;" src="<?= base_url() ?>gambar/konter.png" alt="User-Profile-Image">
                        <div class="user-details">
                            <div id="more-details"><?= substr($user['nama_kios'], 0, 14) ?></div>
                        </div>
                    </div>
                </div>

                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Menu Utama</label>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>Pengguna" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Laporan Transaksi</label>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>Pengguna/laporan" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Laporan Penjualan</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="<?= base_url() ?>gambar/tulisan_atas.png" width="70%" style="margin-left: 45px;margin-top:10px;" class="logo">
                <img src="<?= base_url() ?>gambar/tulisan_atas.png" width="70%" style="margin-left: 54px;" alt="" class="logo-thumb">
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head" style="background: #349104fa;">
                                <img src="<?= base_url() ?>/gambar/konter.png" class="img-radius" alt="User-Profile-Image">
                                <span><?= substr($user['nama_kios'], 0, 14) ?></span>
                            </div>
                            <ul class="pro-body">
                                <li><a href="<?= base_url() ?>Pengguna/profile" class="dropdown-item"><i class="feather icon-settings"></i> Profile</a></li>
                                <li><a href="<?= base_url() ?>Welcome/logout_pengguna" class="dropdown-item"><i class="feather icon-log-out"></i> Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>