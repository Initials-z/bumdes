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
    <?php
    if ($akun['akses'] == 0) { ?>
        <nav class="pcoded-navbar menu-light ">
            <div class="navbar-wrapper  ">
                <div class="navbar-content scroll-div ">
                    <div class="">
                        <div class="main-menu-header">
                            <img class="img-radius" src="<?= base_url('gambar/admin/') . $user['foto'] ?>" alt="User-Profile-Image" style="width:50%;">
                            <div class="user-details">
                                <div id="more-details"><?= substr($user['nama_admin'], 0, 14) ?></div>
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
                            <a href="<?= base_url() ?>Admin" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/admin_tabel" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Data Admin</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/koordinator" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Koordinator</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Kios" class="nav-link "><span class="pcoded-micon"><i class="feather icon-briefcase"></i></span><span class="pcoded-mtext">Data Kios</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/limit" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Limit Kios</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/topup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-link"></i></span><span class="pcoded-mtext">Topup Saldo</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/setoran" class="nav-link "><span class="pcoded-micon"><i class="feather icon-award"></i></span><span class="pcoded-mtext">Setoran</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>List</label>
                        </li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Produk Prabayar</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="<?= base_url() ?>Admin/list">Pulsa</a></li>
                                <li><a href="<?= base_url() ?>Admin/list_paket">Paket Internet</a></li>
                                <li><a href="<?= base_url() ?>Admin/list_pln">Pulsa PLN</a></li>
                                <!-- <li><a href="<?= base_url() ?>Admin/list_game">List Topup Game</a></li> -->
                                <li><a href="<?= base_url() ?>Admin/list_money">Topup E-Money</a></li>
                            </ul>
                        </li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Produk Pascabayar</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="<?= base_url() ?>Admin/form_tagihan_listrik">PLN Pascabayar</a></li>
                                <li><a href="<?= base_url() ?>Admin/list_internet_pasca">Internet Pascabayar</a></li>
                                <li><a href="<?= base_url() ?>Admin/list_multifinance">Multifinance</a></li>
                            </ul>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Laporan Transaksi</label>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/laporan" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Transaksi Prabayar</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/laporan_pasca" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Transaksi Pascabayar</span></a>
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
                                    <img src="<?= base_url('gambar/admin/') . $user['foto'] ?>" class="img-radius" alt="User-Profile-Image">
                                    <span><?= substr($user['nama_admin'], 0, 14) ?></span>
                                </div>
                                <ul class="pro-body">
                                    <li><a href="<?= base_url() ?>Admin/profile" class="dropdown-item"><i class="feather icon-settings"></i> Profile</a></li>
                                    <li><a href="<?= base_url() ?>Welcome/logout" class="dropdown-item"><i class="feather icon-log-out"></i> Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
    <?php } else { ?>
        <nav class="pcoded-navbar menu-light ">
            <div class="navbar-wrapper  ">
                <div class="navbar-content scroll-div ">
                    <div class="">
                        <div class="main-menu-header">
                            <img class="img-radius" src="<?= base_url('gambar/konter.png') ?>" alt="User-Profile-Image" style="width:50%;">
                            <div class="user-details">
                                <div id="more-details"><?= substr($user['nama_pengawas'], 0, 14) ?></div>
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
                            <a href="<?= base_url() ?>Admin" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/limit" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Limit Kios</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/setoran" class="nav-link "><span class="pcoded-micon"><i class="feather icon-award"></i></span><span class="pcoded-mtext">Setoran</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Laporan Transaksi</label>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/laporan" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Transaksi Prabayar</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Admin/laporan_pasca" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Transaksi Pascabayar</span></a>
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
                                    <img src="<?= base_url('gambar/konter.png') ?>" class="img-radius" alt="User-Profile-Image">
                                    <span><?= substr($user['nama_pengawas'], 0, 14) ?></span>
                                </div>
                                <ul class="pro-body">
                                    <li><a href="<?= base_url() ?>Admin/profile" class="dropdown-item"><i class="feather icon-settings"></i> Profile</a></li>
                                    <li><a href="<?= base_url() ?>Welcome/logout" class="dropdown-item"><i class="feather icon-log-out"></i> Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
    <?php }

    ?>