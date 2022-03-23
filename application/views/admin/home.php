    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10"><?= $judul ?></h5>
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
                        <div class="col-sm-4">
                            <div class="card support-bar overflow-hidden">
                                <div class="card-body pb-0">
                                    <h2 class="m-0"><?= $jumlah_adm['jumlah_admin'] ?></h2>
                                    <span class="text-c-blue">Admin</span>
                                    <p class="mb-3 mt-3">Jumlah Data Admin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card support-bar overflow-hidden">
                                <div class="card-body pb-0">
                                    <h2 class="m-0"><?= $jumlah['jumlah_kios'] ?></h2>
                                    <span class="text-c-green">Kios</span>
                                    <p class="mb-3 mt-3">Jumlah Data Kios</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card support-bar overflow-hidden">
                                <div class="card-body pb-0">
                                    <h2 class="m-0"><?= $jumlah_koordinator['jumlah_pengawas'] ?></h2>
                                    <span class="text-c-green">Pengawas</span>
                                    <p class="mb-3 mt-3">Jumlah Pengawas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- support-section end -->
                </div>
                <div class="col-lg-5 col-md-12">
                    <!-- page statustic card start -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-yellow"><?= number_format($saldo['data']['deposit']) ?></h4>
                                            <h6 class="text-muted m-b-0">Saldo</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-file-text f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($saldo['data']['deposit'] > 0) { ?>
                                    <div class="card-footer bg-c-gren">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <p class="text-white m-b-0">Mencukupi</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
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
                    <div class="card table-card">
                        <div class="card-header">
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
                        <div class="card-body p-0">
                            <div class="table-responsive" style="padding:50px;">
                                <center>
                                    <img src="<?= base_url() ?>gambar/my3.png" width="50%" alt="">
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>