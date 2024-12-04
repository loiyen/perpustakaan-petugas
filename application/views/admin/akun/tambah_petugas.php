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
                                    <a class="nav-link " href="<?= site_url('account/password') ?>"> Ubah Password</a>
                                </li>
                                <li class="nav-item  ">
                                    <?php
                                    if ($user['level'] == 1) {
                                        echo '<a class="nav-link active" href="' . site_url('account/petugas') . '">Tambah Akun Petugas</a>';
                                    }
                                    ?>
                                </li>
                            </ul>

                            <div class="card">
                                <?= $this->session->flashdata('not'); ?>
                                <h5 class="card-header">Form Tambah Akun</h5>

                                <div class="card-body">
                                    <form id="formAccountSettings" method="POST" action="<?= site_url('account/tambah_akun') ?>">
                                        <input class="form-control" type="hidden" name="id_admin" value="<?= $user['id_admin'] ?>" />
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <?= form_error('username', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                <label for="firstName" class="form-label">Username</label>
                                                <input class="form-control" type="text" name="username" placeholder="Masukan Username..." />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <?= form_error('password', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                <label for="firstName" class="form-label">Password</label>
                                                <input class="form-control" type="text" name="password" placeholder="Masukan Password..." />
                                            </div>

                                            <tr>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                            <button type="reset" class="btn btn-outline-secondary">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <?= $this->session->flashdata('not_akun'); ?>
                                <h5 class="card-header">Daftar Akun</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php
                                            foreach ($petugas as $val) :
                                            ?>
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $val->username; ?></strong></td>
                                                    <td><?= $val->password; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($val->level == 0) {
                                                            echo 'Staff';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><span class="badge bg-label-primary me-1">
                                                            <?php
                                                            if ($val->Status == 0) {
                                                                echo 'Nonaktif';
                                                            } else {
                                                                echo 'Aktif';
                                                            }
                                                            ?>
                                                        </span></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <?php
                                                                if ($val->Status == '1') {
                                                                    echo '<a class="dropdown-item" href="' . site_url('account/ubah_status_aktif_0/' . $val->id_admin) . '"><i class="bx bx-edit-alt me-1"></i>Nonaktikan</a>';
                                                                } else{
                                                                    echo '<a class="dropdown-item" href="' . site_url('account/ubah_status_aktif_1/' . $val->id_admin) . '"><i class="bx bx-edit-alt me-1"></i>Aktifkan</a>';
                                                                }
                                                                ?>
                                                              
                                                                <a class="dropdown-item" href="<?= site_url('account/hapus_akun/'.$val->id_admin)?>" id="btn-hapus"><i class="bx bx-trash me-1"></i> Hapus</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>