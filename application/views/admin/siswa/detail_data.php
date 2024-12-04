<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">


        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <?php
            $this->load->view('Admin/layout/navbar');
            ?>


            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?= site_url('siswa') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6 col-lg-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body mb-1 mt-0">
                                    <h5 class="text-center mt-0"> <strong>KARTU PERPUSTAKAAN</strong></h5>
                                    <div class="card">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4 ">
                                            <?php
                                            if ($data_siswa->foto_siswa == null) {
                                                echo '<img src="' . base_url('asset/user1.png') . '" alt="foto profil" class="d-block rounded responsive" height="180" width="140" id="uploadedAvatar" />';
                                            } else {
                                                $img = URL_IMG . $data_siswa->foto_siswa;
                                                echo "<img src='$img' alt='foto profil' class='d-block rounded responsive' height='180' width='140' />";
                                            }
                                            ?>
                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th class="table-primary">Nama</th>
                                                            <th>:</th>
                                                            <th><?= $data_siswa->nama_siswa; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="table-primary">Kode siswa</th>
                                                            <th>:</th>
                                                            <th><?= $data_siswa->nisn; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="table-primary">Kelas</th>
                                                            <th>:</th>
                                                            <th><?= $data_siswa->kelas_siswa; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="table-primary">Jenis Kelamin</th>
                                                            <th>:</th>
                                                            <th>
                                                                <?php
                                                                if ($data_siswa->jenis_kelamin == '1') {
                                                                    echo 'Laki-laki';
                                                                } else if ($data_siswa->jenis_kelamin == '2') {
                                                                    echo 'Perempuan';
                                                                }
                                                                ?>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="table-primary">Angkatan</th>
                                                            <th>:</th>
                                                            <th><?= $data_siswa->angkatan_siswa; ?></th>
                                                        </tr>

                                                        <tr>
                                                            <th class="table-primary">Barcode</th>
                                                            <th>:</th>
                                                            <th>
                                                                <img src="<?= site_url('siswa/barcode/' . $data_siswa->nisn) ?>" alt="barcode  ">
                                                            </th>
                                                        </tr>

                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= site_url('siswa/cetak_kartu/' . $data_siswa->id_siswa); ?>" class="btn btn-danger btn-sm mt-2 "><i class='bx bx-printer'></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body mb-1 mt-0">
                                    <h5 class="text-center mt-0"> <strong>DATA</strong></h5>
                                    <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel">Kode Akses Siswa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h1> <strong><?= $data_siswa->kode_akses; ?></strong></h1>
                                                </div>
                                                <div class="modal-footer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive text-nowrap ">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th class="table-primary">Total Peminjaman</th>
                                                    <th>:</th>
                                                    <th><?= $peminjaman; ?></th>
                                                </tr>
                                                <tr>
                                                    <th class="table-primary">Total Pengembalian</th>
                                                    <th>:</th>
                                                    <th><?= $pengembalian; ?></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 mb-1 ">
                                            <div class="card h-100">
                                                <div class="card-body mb-0">
                                                    <h6 class="card-header text-center"> <i class='bx bxs-up-arrow-alt'></i> Total Denda</h6>
                                                    <h2 class="card-header text-center"> <?= rupiah_format($total); ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card h-100">
                                                <div class="card-body mb-0">
                                                    <h6 class="card-header text-center"> <i class='bx bxs-up-arrow-alt bx-rotate-180'></i> Total Pembayaran</h6>
                                                    <h2 class="card-header text-center"><?= rupiah_format($total_pembayaran); ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1 mb-2">

                        <div class="col-xxl">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Detail Data Siswa</h6>
                                    <small class="text-muted float-end">
                                        <button type="button" class="btn btn-primary btn-sm mt-1 mb-1" data-bs-toggle="modal" data-bs-target="#modalToggle">
                                            Kode Akses
                                        </button>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                                    <i class='bx bxs-up-arrow-alt' style='color:#00ff52'></i> Peminjaman Item

                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                                    <i class='bx bxs-up-arrow-alt bx-rotate-180' style='color:#fb0c00'></i> Pengembalian tem
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                                    <i class='bx bxs-wallet' style='color:#001cf7'></i> Pembayaran Denda
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">

                                <div class="table-responsive text-nowrap ">
                                    <table class="table table-striped">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Peminjaman</th>
                                                <th>Judul Buku</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Jumlah</th>
                                                <th>Denda</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php
                                            if (empty($datapeminjaman)) {
                                                echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                            } else {
                                                $no = 1;
                                                foreach ($datapeminjaman as $val) : ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td><?= $val['kode_peminjaman']; ?></td>
                                                        <td><?= $val['judul_buku']; ?></td>
                                                        <td><?= format_tanggal_indonesia($val['tanggal_pinjam']); ?></td>
                                                        <td><?= format_tanggal_indonesia($val['tanggal_kembali']); ?></td>
                                                        <td><?= $val['jumlah_pinjam']; ?></td>
                                                        <td><?= rupiah_format($val['denda']); ?></td>
                                                        <td>
                                                            <?php
                                                            if ($val['status'] == 'Belum Kembali') {
                                                                echo '<span class="badge bg-primary">' . $val['status'] . '</span>';
                                                            } else if ($val['status'] == 'Terlambat') {
                                                                echo '<span class="badge bg-danger">' . $val['status'] . '</span>';
                                                            } else {
                                                                echo '<span class="badge bg-success">' . $val['status'] . '</span>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">

                                <div class="table-responsive text-nowrap ">
                                    <table class="table table-striped">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Pengembalian</th>
                                                <th>Judul Buku</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Kondisi Buku</th>
                                                <th>Denda</th>
                                                <th>Jumlah</th>
                                                <th>Status Pembayaran</th>

                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php
                                            if (empty($datapengembalian)) {
                                                echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                            } else {
                                                $no = 1;
                                                foreach ($datapengembalian as $val) : ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td><?= $val['kode_pengembalian']; ?></td>
                                                        <td><?= $val['judul_buku']; ?></td>
                                                        <td><?= format_tanggal_indonesia($val['date']); ?></td>
                                                        <td> <?php
                                                                if ($val['kondisi_buku'] == 1) {
                                                                    echo '<span class="badge bg-success">Baik</span>';
                                                                } elseif ($val['kondisi_buku'] == 2) {
                                                                    echo '<span class="badge bg-warning">Robek / Bercoret</span>';
                                                                } elseif ($val['kondisi_buku'] == 3) {
                                                                    echo '<span class="badge bg-danger">Hilang</span>';
                                                                }
                                                                ?>
                                                        </td>
                                                        <td><?= rupiah_format($val['denda']); ?></td>
                                                        <td><?= $val['jumlah_kembali']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($val['status'] == 1) {
                                                                echo '<span class="badge bg-success">Selesai</span>';
                                                            } else if ($val['status'] == 2) {
                                                                echo '<span class="badge bg-warning">Belum bayar</span>';
                                                            } else {
                                                                echo '<span class="badge bg-warning">Menunggak</span>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                                <div class="table-responsive text-nowrap ">
                                    <table class="table table-striped">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Pembayaran</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal | Jam</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php
                                            if (empty($pembayaran)) {
                                                echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                            } else {
                                                $no = 1;
                                                foreach ($pembayaran as $val) : ?>
                                                    <tr>
                                                        <td scope="row"><?= $no; ?>.</td>
                                                        <td>
                                                            <?= $val['kode_pembayaran']; ?>
                                                            <div class="mt-1">
                                                                <?php
                                                                if ($val['status'] == 1) {
                                                                    echo '<span class="badge rounded-pill bg-success">Selesai</span>';
                                                                } elseif ($val['status'] == 2) {
                                                                    echo '<span class="badge rounded-pill bg-warning">Belum Bayar</span>';
                                                                } else {
                                                                    echo '<span class="badge rounded-pill bg-warning">Menunggak</span>';
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td><?= rupiah_format($val['jumlah']); ?></td>
                                                        <td><?= format_tanggal_indonesia($val['date_bayar']); ?> | <?= format_jam_indonesia($val['date_bayar']); ?></td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>