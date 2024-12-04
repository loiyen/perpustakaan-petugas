<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <form method="get" action="<?= site_url('buku/pencarian_buku') ?>">
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" name="keyword" class="form-control border-0 shadow-none" placeholder="Cari judul / Kode buku..." />
                </div>
            </div>
        </form>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <div class="navbar-nav flex-row align-items-center ms-auto">

                <a href="<?= site_url('peminjaman') ?>" class="col-lg-4 col-md-4 col-sm-4 btn btn-primary btn-sm m-2 ">Ajukan peminjaman</a>
                <a href="<?= site_url('pengembalian') ?>" class="col-lg-4 col-md-4 col-sm-4 btn btn-outline-warning btn-sm m-2">Pengembalian buku</a>


            </div>
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
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
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <?php
                                        $foto_profil = $user['foto_admin'];
                                        if (empty($foto_profil)) {
                                            $default_foto = base_url('asset/assets/img/avatars/1.png');
                                            echo '<img src="' . $default_foto . '" alt="Default Foto Profil" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />';
                                        } else {
                                            $profil_foto = base_url('asset/fotoprofil/' . $foto_profil);
                                            echo '<img src="' . $profil_foto . '" alt="Foto Profi" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block"><?= $user['username'] ?></span>
                                    <small class="text-muted"><?= format_tanggal_indonesia($user['datecreated']) ?> | <?= format_jam_indonesia($user['datecreated']) ?> </small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= site_url('account') ?>">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Akun</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="<?= site_url('laporan/print_all_laporan') ?>">
                            <span class="d-flex align-items-center align-middle">
                                <i class='bx bx-printer me-2'></i>
                                <span class="flex-grow-1 align-middle">Print Laporan</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= site_url('adminpanel/update_status_terlambat_otomatis') ?>">
                            <i class='bx bx-refresh me-2'></i>
                            <span class="align-middle">Pembaharui Riwayat</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= site_url('adminpanel/logout') ?>">
                            <i class='bx bx-log-out me-2'></i>
                            <span class="align-middle">Keluar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>