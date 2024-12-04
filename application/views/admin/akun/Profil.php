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
                                    <a class="nav-link active" href="<?= site_url('account') ?>"></i> Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= site_url('account/password') ?>"> Ubah Password</a>
                                </li>
                                <li class="nav-item">
                                    <?php
                                    if($user['level'] == 1 ){
                                        echo '<a class="nav-link" href="' . site_url('account/petugas') . '">Tambah Akun Petugas</a>';
                                    } 
                                    ?>
                                    
                                </li>
                            </ul>
                            <div class="card mb-4">
                                <h5 class="card-header">Detail Profil</h5>
                                <!-- Account -->
                                <div class="card-body">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <?php
                                        $foto_profil = $user['foto_admin'];

                                        if (empty($foto_profil)) {
                                            // Jika foto profil kosong, tampilkan foto default
                                            $default_foto = base_url('asset/assets/img/avatars/1.png');
                                            echo '<img src="' . $default_foto . '" alt="Default Foto Profil" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />';
                                        } else {
                                            // Jika foto profil tidak kosong, tampilkan foto profil user
                                            $profil_foto = base_url('asset/fotoprofil/' . $foto_profil);
                                            echo '<img src="' . $profil_foto . '" alt="Foto Profi" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />';
                                        }
                                        ?>
                                        <div class="button-wrapper">
                                            <p>Username : <?= $user['username'] ?></p>
                                            <p>Email : <?= $user['email_admin'] ?></p>
                                        </div>

                                    </div>
                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <?= $this->session->flashdata('not'); ?>
                                    <h3>Data Anda</h3>
                                    <?php echo validation_errors('<small class="text-danger ml-1 ">', '</small>', ' '); ?>
                                    <form id="formAccountSettings" method="POST" action="<?= site_url('account/edit_profil') ?>" enctype="multipart/form-data">
                                        <input class="form-control" type="hidden" name="id_admin" value="<?= $user['id_admin'] ?>" />
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Nama Lengkap</label>
                                                <input class="form-control" type="text" name="nama" value="<?= $user['nama_admin'] ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="text" name="email" value="<?= $user['email_admin'] ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="organization" class="form-label">Jabatan</label>
                                                <input type="text" class="form-control" name="jabatan" value="<?= $user['jabatan_admin'] ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="address" class="form-label">No Handphone</label>
                                                <input type="text" class="form-control" name="no_hp" value="<?= $user['no_telfon'] ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="address" class="form-label">Upload Foto Profil</label>
                                                <p class="text-muted mb-0">Type file : JPG,JEPG & PNG. Maximal Size 5 Mb</p>
                                                <input type="file" class="form-control" name="gambar" />
                                            </div>
                                            <tr>

                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                            <button type="reset" class="btn btn-outline-secondary">Batal</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Account -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>