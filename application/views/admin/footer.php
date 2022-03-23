<script src="<?= base_url('data_tabel/') ?>jquery-3.5.1.js"></script>
<script src="<?= base_url() ?>assets/js/vendor-all.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
<!-- Apex Chart -->
<script src="<?= base_url() ?>assets/js/plugins/apexcharts.min.js"></script>
<!-- custom-chart js -->
<script src="<?= base_url() ?>assets/js/pages/dashboard-main.js"></script>
<script src="<?= base_url('data_tabel/') ?>jquery.dataTables.min.js"></script>
<script src="<?= base_url('select2/') ?>js/select2.min.js"></script>
<script src="<?= base_url() ?>dist/sweetalert.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                jQuery('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function() {
        readURL(this);
    });

    function reloadpage() {
        location.reload()
    }
</script>
<script>
    $(document).ready(function() {
        $("#myform").submit(function(e) {

            var formObj = $(this);
            var formURL = formObj.attr("action");
            var formData = new FormData(this);
            $.ajax({
                url: formURL,
                type: 'POST',
                data: formData,
                contentType: true,
                cache: false,
                processData: true,
                beforeSend: function() {
                    $("#loading").show(100).html("<div class='spinner-grow text-success' role='status'><span class='sr-only'>Loading...</span></div>");
                },
                success: function(data, textStatus, jqXHR) {
                    $("#result").html(data);
                    $("#loading").hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });
            e.preventDefault(); //Prevent Default action.
            e.unbind();
        });
        $('.js-example-basic-single').select2();
        $('#example').DataTable();
    });
</script>
<script type="text/javascript">
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script>
    function Toggle() {
        var lama = document.getElementById("ps-lama");
        var baru = document.getElementById("ps-baru");
        var temp = document.getElementById("ps-konfirmasi");
        if (lama.type === "password") {
            lama.type = "text";
        } else {
            lama.type = "password";
        }

        if (baru.type === "password") {
            baru.type = "text";
        } else {
            baru.type = "password";
        }

        if (temp.type === "password") {
            temp.type = "text";
        } else {
            temp.type = "password";
        }
    }
</script>
<script>
    <?php
    if ($this->session->flashdata('masuk')) { ?>
        swal({
            type: 'success',
            title: 'Selamat datang di halaman dashboard',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('pass')) { ?>
        swal({
            type: 'error',
            title: 'Gagal login, password salah!',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('gagal')) { ?>
        swal({
            type: 'error',
            title: 'Gagal login, username & password salah!',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('berhasil')) { ?>
        swal({
            type: 'success',
            title: 'Data berhasil ditambahkan !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('berubah')) { ?>
        swal({
            type: 'success',
            title: 'Data berhasil dirubah !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('terhapus')) { ?>
        swal({
            type: 'success',
            title: 'Data berhasil dihapus',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('nonaktif')) { ?>
        swal({
            type: 'success',
            title: 'Berhasil menonaktifkan akun !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('aktif')) { ?>
        swal({
            type: 'success',
            title: 'Berhasil mengaktifkan akun !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('lamasalah')) { ?>
        swal({
            type: 'error',
            title: 'Password lama anda salah !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('passama')) { ?>
        swal({
            type: 'error',
            title: 'Password lama dan password baru tidak boleh sama !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('bisaganti')) { ?>
        swal({
            type: 'success',
            title: 'Password berhasil diganti !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('gantifoto')) { ?>
        swal({
            type: 'success',
            title: 'Ganti foto berhasil !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('gagalfoto')) { ?>
        swal({
            type: 'error',
            title: 'Gagal mengganti foto',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('reset')) { ?>
        swal({
            type: 'success',
            title: 'Reset password berhasil !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('gagal_upload')) { ?>
        swal({
            type: 'error',
            title: 'Terjadi kesalahan dalam upload file !',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('berhasil_upload')) { ?>
        swal({
            type: 'success',
            title: 'File berhasil dikirim',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('bisa_lanjut')) { ?>
        swal({
            type: 'success',
            title: 'Data berhasil untuk dilanjutkan',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('aktif_tampilan')) { ?>
        swal({
            type: 'success',
            title: 'Berhasil melakukan aktivasi',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('nonaktif_tampilan')) { ?>
        swal({
            type: 'success',
            title: 'Berhasil menonaktifkan',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('email_ok')) { ?>
        swal({
            type: 'success',
            title: 'Email diperbaharui',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('berhasil_video')) { ?>
        swal({
            type: 'success',
            title: 'Video dokumentasi berhasil disimpan',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php }
    ?>
</script>
<script>
    $(document).ready(function() {
        $('.alertHapus').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                    title: 'Anda akan menghapus data ini?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6ce457',
                    cancelButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, hapus data !',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location = link
                    } else {
                        swal("Batal hapus", "Data belum terhapus", "error");
                    }
                });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.Nonaktif').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                    title: 'Apakah anda ingin menonaktifkan akun ini ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6ce457',
                    cancelButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, Nonaktifkan akun !',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location = link
                    } else {
                        swal("Batal Merubah status", "Data akun masih aktif", "error");
                    }
                });
        });
        $('.Aktif').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                    title: 'Apakah anda ingin mengaktifkan akun ini ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6ce457',
                    cancelButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, Aktifkan akun !',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location = link
                    } else {
                        swal("Batal Merubah status", "Data akun masih nonaktif", "error");
                    }
                });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.Reset').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                    title: 'Anda akan mereset password akun ini ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6ce457',
                    cancelButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, Reset password !',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location = link
                    } else {
                        swal("Batal hapus", "Data belum terhapus", "error");
                    }
                });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.akun-nonaktif').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                    title: 'Anda akan menonaktifkan akun ini ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6ce457',
                    cancelButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Nonaktifkan Akun !',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location = link
                    } else {
                        swal("Batal Menonaktifkan Akun", "Status akun tetap aktif", "error");
                    }
                });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.reset-password').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                    title: 'Anda akan mereset password akun ini ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6ce457',
                    cancelButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Reset Akun !',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location = link
                    } else {
                        swal("Batal Mereset Akun", "Password belum direset", "error");
                    }
                });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.akun-aktif').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                    title: 'Anda akan mengaktifkan akun ini ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6ce457',
                    cancelButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Aktifkan Akun !',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location = link
                    } else {
                        swal("Batal Aktifasi", "Status akun tetap nonaktif", "error");
                    }
                });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.kios-hapus').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                    title: 'Anda akan menghapus kios ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6ce457',
                    cancelButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Hapus',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location = link
                    } else {
                        swal("Batal Aktifasi", "Status akun tetap nonaktif", "error");
                    }
                });
        });
    });
</script>
<script>
    <?php
    if ($this->session->flashdata('berubah')) { ?>
        swal({
            type: 'success',
            title: 'Berhasi merubah data',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('berhasil')) { ?>
        swal({
            type: 'success',
            title: 'Berhsil menambahkan data',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('terhapus')) { ?>
        swal({
            type: 'success',
            title: 'Berhsil menghapus data',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('BerhasilReset')) { ?>
        swal({
            type: 'success',
            title: 'Berhsil mereset password',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('KiosDipilih')) { ?>
        swal({
            type: 'success',
            title: 'Berhsil memilih kios',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('KiosDihapus')) { ?>
        swal({
            type: 'success',
            title: 'Kios berhasil dihapus',
            timer: 2500,
            showConfirmButton: false,
        });
    <?php } elseif ($this->session->flashdata('gagalsetor')) { ?>
        swal({
            type: 'error',
            title: 'Gagal menambahkan setoran. Pastikan kios sudah memiliki pengawas !',
            timer: 3000,
            showConfirmButton: false,
        });
    <?php }
    ?>
</script>
</body>

</html>