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

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-8 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Selamat Datang !! <?= $user['nama_admin']; ?></h5>
                                            <p class="mb-4">
                                                Update data Peminjaman item adalah <span class="fw-bold"><?= $jumlahpinjamitem ?> </span> dan Pengembalian item adalah <span class="fw-bold"> <?= $jumlahkembaliitem ?> </span>
                                            </p>
                                            <a href="<?= site_url('riwayat'); ?>" class="btn btn-sm btn-outline-primary">Lihat data</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0 px-md-4">
                                            <img src="<?php echo base_url('asset/assets/img/illustrations/man-with-laptop-light.png') ?>" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 order-1">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-6 mb-2 ">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-book' style='color:#20bb00'></i>
                                                </div>
                                                <span class="d-block mb-1">Buku</span>
                                            </div>

                                            <h2 class="card-title text-center mb-2"><?= $jumlahbuku; ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-6 mb-2">
                                    <div class="card h-100">
                                        <div class="card-body ">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bx-user' style='color:#001f79'></i>
                                                </div>
                                                <span>Anggota</span>
                                            </div>
                                            <h2 class="card-title text-nowrap text-center mb-5"> <?= $jumlahsiswa; ?></h2>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="card mb-2">
                                <div class="row  g-0">
                                    <div class="card-header">
                                        <h5>Data hari ini </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mt-0">
                                            <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                                                <span><i class='bx bxs-up-arrow' style='color:#03f900'></i> Peminjaman</span>
                                                <h2 class="card-header"><?= $peminjaman_today; ?></h2>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                                                <span><i class='bx bxs-down-arrow' style='color:#f91f00'></i> Pengembalian</span>
                                                <h2 class="card-header "><?= $pengembalian_today ?></h2>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                                                <span><i class='bx bxs-info-circle' style='color:#f9e100'></i> Denda</span>
                                                <h2 class="card-header"><?= $denda_today; ?></h2>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                                                <span><i class='bx bxs-wallet' style='color:#4100f9'></i> Pembayaran</span>
                                                <h2 class="card-header"><?= $bayar_today; ?></h2>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="row  g-0">
                                    <div class="card mb-2">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0"> Iktisar 7 hari terakhir</h6>
                                            <small class="text-muted float-end">
                                            </small>
                                        </div>
                                    </div>
                                    <div class="nav-align-top mb-4">
                                        <ul class="nav nav-tabs nav-fill" role="tablist">
                                            <li class="nav-item">
                                                <button type="button" class="nav-link active text-success" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                                                    Peminjaman

                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link text-danger" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                                                    Pengembalian
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link text-primary" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                                                    Denda
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>

                                                                <th>Status</th>
                                                                <th>Kode Peminjaman</th>
                                                                <th>Judul Buku</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="table-border-bottom-0">
                                                            <?php

                                                            if (empty($peminjaman)) {
                                                                echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                            } else {

                                                                foreach ($peminjaman as $key => $val) :
                                                            ?>
                                                                    <tr>

                                                                        <td>
                                                                            <?php
                                                                            if ($val->status == 'Selesai') {
                                                                                echo '<span class="badge bg-success me-1"><strong>' . $val->status . '</strong></span>';
                                                                            } elseif ($val->status == 'Belum Kembali') {
                                                                                echo '<span class="badge bg-primary me-1"><strong>' . $val->status . '</strong></span>';
                                                                            } else {
                                                                                echo '<span class="badge bg-danger"><strong>' . $val->status . '</strong></span>';
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td># <strong><a class="text-secondary" href="<?= site_url('riwayat/detail_riwayat/' . $val->id_peminjaman) ?>"><?= $val->kode_peminjaman; ?></a></strong></td>
                                                                        <td><?= $val->judul_buku; ?></td>
                                                                        <td class="text-center"><?= $val->jumlah_pinjam; ?></td>
                                                                    </tr>
                                                            <?php
                                                                endforeach;
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>Status</th>
                                                                <th>Kode Pengembalian</th>
                                                                <th>Judul Buku</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="table-border-bottom-0">
                                                            <?php
                                                            if (empty($pengembalian)) {
                                                                echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                            } else {
                                                                foreach ($pengembalian as $val) :
                                                            ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php
                                                                            if ($val->status == 1) {
                                                                                echo '<span class="badge bg-success me-1"><strong>Selesai</strong></span>';
                                                                            } elseif ($val->status == 2) {
                                                                                echo '<span class="badge bg-warning me-1"><strong>Belum Bayar</strong></span>';
                                                                            } else {
                                                                                echo '<span class="badge bg-warning me-1"><strong>Menunggak</strong></span>';
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td># <strong><a class="text-secondary" href="<?= site_url('riwayat/detail_riwayat/' . $val->id_pengembalian) ?>"><?= $val->kode_pengembalian; ?></a></strong></td>
                                                                        <td><?= $val->judul_buku; ?></td>
                                                                        <td class="text-center"><?= $val->jumlah_kembali; ?></td>
                                                                    </tr>
                                                            <?php
                                                                endforeach;
                                                            } ?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>Total denda</th>
                                                                <th>Kode pembayaran</th>
                                                                <th>total bayar</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="table-border-bottom-0">
                                                            <?php
                                                            if (empty($denda)) {
                                                                echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                            } else {
                                                                foreach ($denda as $val) :
                                                            ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?= rupiah_format($val->total_denda) ?>
                                                                        </td>
                                                                        <td># <?= $val->kode_pembayaran ?></td>
                                                                        <td><?= rupiah_format($val->jumlah); ?></td>
                                                                    </tr>
                                                            <?php
                                                                endforeach;
                                                            } ?>
                                                        </tbody>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                            <div class="row">
                                <div class="col-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-book' style='color:#7414e6'></i>
                                                </div>
                                                <span class="d-block mb-1">Kategori</span>
                                            </div>
                                            <h2 class="card-title text-nowrap text-center mb-2"><?= $kategori ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-book' style='color:#f5d500'></i>
                                                </div>
                                                <span class="d-block mb-1">Rak Buku</span>
                                            </div>

                                            <h2 class="card-title text-center text-nowrap mb-2"><?= $rak ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6  mb-2">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-up-arrow-circle' style='color:#00e01e'></i>
                                                </div>
                                                <span class="d-block mb-1">Peminjaman</span>
                                            </div>
                                            <h2 class="card-title text-center mb-2"><?= $jumlahpinjam; ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6 mb-2">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-down-arrow-circle' style='color:#ff0105'></i>
                                                </div>
                                                <span class="d-block mb-1">Pengembalian</span>
                                            </div>
                                            <h2 class="card-title mb-2 text-center"><?= $jumlahkembali; ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-sm-12 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bx-money' style='color:#03aebb'></i>
                                                </div>

                                            </div>
                                            <span class="fw-semibold d-block mb-1">Total Pendapatan Denda</span>
                                            <h4 class="card-title mb-2"><?= rupiah_format($total_pembayaran); ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <i class='bx bx-money' style='color:#ef950a'></i>
                                            </div>

                                        </div>
                                        <span class="fw-semibold d-block mb-1">Total Denda</span>
                                        <h4 class="card-title mb-2"><?= rupiah_format($total_pembayaran); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->