<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">


        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <?php
            $this->load->view('Admin/layout/navbar');
            ?>

            <!-- / Navbar -->

            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a class="nav-link " href="<?= site_url('account') ?>"></i> Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= site_url('account/password') ?>"> Ubah Password</a>
                                </li>
                                <li class="nav-item">
                                <?php
                                    if($user['level'] == 1 ){
                                        echo '<a class="nav-link" href="' . site_url('account/petugas') . '">Tambah Akun Petugas</a>';
                                    } 
                                    ?>
                                </li>
                            </ul>

                            <div class="card">
                            <?= $this->session->flashdata('not'); ?>
                                <h5 class="card-header">Ubah Password</h5>
                                <div class="card-body">
                                    <div class="mb-3 col-12 mb-0">
                                        <div class="alert alert-warning">
                                            <h6 class="alert-heading fw-bold mb-1">Harap Masukan Password Yang Kuat!</h6>
                                            <?php echo validation_errors('<small class="text-danger ml-1 ">', '</small>', ' '); ?>
                                        </div>
                                    </div>
                                    <form id="formAccountSettings" method="post" action="<?= site_url('account/ubah_password') ?>">
                                    <input class="form-control" type="hidden" name="id_admin" value="<?= $user['id_admin']?>"/>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Password Lama</label>
                                                <input class="form-control" type="text" name="password" placeholder="Masukan Password lama..." />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Password Baru</label>
                                                <input class="form-control" type="text" name="password_baru" placeholder="Masukan Password lama..." />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Konfirmasi Password</label>
                                                <input class="form-control" type="password" name="konfirmasi" placeholder="Konfirmasi Password..." />
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary deactivate-account">Ubah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>