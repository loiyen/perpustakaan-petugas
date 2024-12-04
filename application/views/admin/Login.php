<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Petugas</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php echo base_url('asset/assets/vendor/fonts/boxicons.css') ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('asset/assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url('asset/assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url('asset/assets/css/demo.css') ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo base_url('asset/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?php echo base_url('asset/assets/vendor/css/pages/page-auth.css') ?>" />
    <!-- Helpers -->
    <script src="<?php echo base_url('asset/assets/vendor/js/helpers.js') ?>"></script>
    <script src="<?php echo base_url('asset/assets/js/config.js') ?>"></script>

    <style>
        #load1 {
            width: 100%;
            height: 100%;
            position: fixed;
            text-indent: 100%;
            background: #e0e0e0 url('/asset/load.gif') no-repeat;
        }
    </style>

</head>

<body>
    <!-- Content -->
    <div class="container-xxl">


        <div class="authentication-wrapper authentication-basic container-p-y">

            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">

                    <div class="card-body">
                        <!-- Logo -->
                        <?= $this->session->flashdata('not'); ?>
                        <div class="app-brand justify-content-center">
                            <img class="img-card-top " style="width: 30%;" src="<?= base_url('asset/LOGO.png') ?>" alt="logo">
                        </div>
                        <div class="app-brand justify-content-center">

                            <a href="#" class="app-brand-link gap-2">
                                <h3 class="app-brand- demo text-body fw-bolder">PERPUSTAKAAN <br>SMA N 1 KRAYAN</h3>
                            </a>
                        </div>

                        <form id="formAuthentication" class="mb-3" action="<?php echo site_url('adminpanel/login') ?>" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Masukan Username Anda..." autofocus />
                            </div>
                            <?= form_error('username', '<small class="text-danger ml-1 ">', '</small>'); ?>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <?= form_error('password', '<small class="text-danger ml-1 ">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span><b>Perhatian!</b> Halaman ini adalah Hak Akses Admin</span>

                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>



        <script src="<?php echo base_url('asset/assets/vendor/libs/jquery/jquery.js') ?>"></script>
        <script src="<?php echo base_url('asset/assets/vendor/libs/popper/popper.js') ?>"></script>
        <script src="<?php echo base_url('asset/assets/vendor/js/bootstrap.js') ?>"></script>
        <script src="<?php echo base_url('asset/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

        <script src="<?php echo base_url('asset/assets/vendor/js/menu.js') ?>"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="<?php echo base_url('asset/assets/js/main.js') ?>"></script>

        <!-- Page JS -->

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            <?php if ($this->session->flashdata('success')) { ?>
                var isi = <?php echo json_encode($this->session->flashdata('success')) ?>;
                Swal.fire({
                    title: 'Berhasil! ',
                    text: isi,
                    icon: 'success',
                })
            <?php } ?>
            <?php if ($this->session->flashdata('gagal')) { ?>
                var isi = <?php echo json_encode($this->session->flashdata('gagal')) ?>;
                Swal.fire({
                    title: 'gagal! ',
                    text: isi,
                    icon: 'error',
                })
            <?php } ?>
        </script>
</body>

</html>