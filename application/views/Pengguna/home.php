    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Halaman Dashboard Kios</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>Admin"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Halaman Utama Sistem</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
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
                <div class="col-xl-12 col-md-12">
                    <h3>Transaksi Prabayar</h3>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="<?= base_url() ?>Pengguna/pulsa">
                                <div class="card support-bar overflow-hidden">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-black">Pulsa</h4>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-bar-chart f-28"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="<?= base_url() ?>Pengguna/paket">
                                <div class="card support-bar overflow-hidden">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-black">Paket Internet</h4>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-wifi f-28"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <!-- <a href=""> -->
                            <a href="<?= base_url() ?>Pengguna/token">
                                <div class="card support-bar overflow-hidden">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-black">Pulsa PLN</h4>
                                                <!-- <span style="color: red;"><i>*Layanan belum tersedia</i></span> -->
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-zap f-28"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="<?= base_url() ?>Pengguna/e_money">
                                <!-- <a href=""> -->
                                <div class="card support-bar overflow-hidden">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-black">E-Money</h4>
                                                <h6 class="text-muted m-b-0">Transaksi Membutuhkan Waktu</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-layers f-28"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <hr>
                    <h3>Transaksi Pascabayar</h3>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="<?= base_url() ?>Pengguna/form_tagihan_listrik">
                                <div class="card support-bar overflow-hidden">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-black">PLN Pascabayar</h4>
                                                <!-- <span style="color: red;"><i>*Layanan belum tersedia</i></span> -->
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-zap f-28"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="<?= base_url() ?>Pengguna/list_internet_pasca">
                                <div class="card support-bar overflow-hidden">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-black">Internet Pasca</h4>
                                                <!-- <span style="color: red;"><i>*Layanan belum tersedia</i></span> -->
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-globe f-28"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="">
                                <div class="card support-bar overflow-hidden">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-black">Multifinance</h4>
                                                <span style="color: red;"><i>*Layanan belum tersedia</i></span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-user-check f-28"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>