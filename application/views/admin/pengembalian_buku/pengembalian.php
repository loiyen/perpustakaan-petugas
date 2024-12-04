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

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="<?= site_url('riwayatkembali') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= $this->session->flashdata('not'); ?>
                        <div class="row mb-1">
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="card h-100">
                                    <h5 class="card-header text-center">Data Siswa</h5>
                                    <form action="pengembalian/add_session_siswa_pengembalian" method="post">
                                        <div class="card-body mt-2">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text" id="basic-addon-search31"><i class='bx bx-barcode-reader'></i></span>
                                                <input type="text" class="form-control" name="kode_siswa" placeholder="Scan Barcode Siswa..." aria-label="Search..." />
                                            </div>
                                        </div>
                                    </form>
                                    <div class="card-body mb-1 mt-0">
                                        <h5 class="text-center mt-0"> <strong>KARTU PERPUSTAKAAN</strong></h5>
                                        <div class="card">
                                            <div class="d-flex align-items-start align-items-sm-center gap-4 ">
                                                <?php
                                                if ($data_siswa['foto'] == null) {
                                                    echo '<img src="' . base_url('asset/user1.png') . '" alt="foto profil" class="d-block rounded responsive" height="150" width="130" id="uploadedAvatar" />';
                                                } else {
                                                    echo '<img src="' . URL_IMG . $data_siswa['foto'] . '" alt="foto profil" class="d-block rounded responsive" height="150" width="120" id="uploadedAvatar" />';
                                                }
                                                ?>
                                                
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th class="table-primary">Nama</th>
                                                                <th>:</th>
                                                                <th><?= $data_siswa['nama_siswa']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th class="table-primary">No Anggota</th>
                                                                <th>:</th>
                                                                <th><?= $data_siswa['kode_siswa']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th class="table-primary">Kelas</th>
                                                                <th>:</th>
                                                                <th><?= $data_siswa['kelas']; ?> <?= $data_siswa['jurusan']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th class="table-primary">Jenis Kelamin</th>
                                                                <th>:</th>
                                                                <th>
                                                                    <?php
                                                                    if ($data_siswa['jenis_kelamin'] == '1') {
                                                                        echo 'Laki-laki';
                                                                    } else if ($data_siswa['jenis_kelamin'] == '2') {
                                                                        echo 'Perempuan';
                                                                    }
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?= site_url('pengembalian/hapus_session_siswa') ?>" class="btn btn-danger btn-sm mt-2 "><i class="bx bx-trash me-1"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="card h-100">
                                    <h5 class="card-header text-center">Data Buku</h5>
                                    <form action="pengembalian/add_session_buku_pengembalian" method="post">
                                        <div class="card-body mt-2">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text" id="basic-addon-search31"><i class='bx bx-barcode-reader'></i></span>
                                                <input type="text" class="form-control" name="kode_buku" placeholder="Scan Barcode Buku..." aria-label="Search..." aria-describedby="basic-addon-search31" />
                                            </div>
                                        </div>
                                    </form>
                                    <div class="card-body mt-0">
                                        <h5 class="mt-0 text-center"> <strong>DAFTAR BUKU</strong></h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-striped">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Jumlah</th>
                                                        <th>Judul</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (empty($data_buku)) {
                                                        echo "<tr><td colspan='3' class='text-center mt-5 mb-5'>Belum Ada Data Masuk.</td></tr>";
                                                    } else {
                                                        foreach ($data_buku as $item) : ?>
                                                            <tr>
                                                                <td><?= $item['jumlah_pinjam']; ?> </td>
                                                                <td><?= $item['judul_buku']; ?></td>
                                                                <td>
                                                                    <?php
                                                                    $buku_dikembalikan = false;
                                                                    if (is_array($data_buku_kembali)) {
                                                                        foreach ($data_buku_kembali as $buku_kembali) {

                                                                            if ($item['id_buku'] == $buku_kembali['id_buku']) {
                                                                                $buku_dikembalikan = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                    if ($buku_dikembalikan) {
                                                                        echo "<i class='bx bx-check' style='color:#00ff36'  ></i>";
                                                                    } else {
                                                                        echo "<i class='bx bx-x' style='color:#ff2900'  ></i>";
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                    <?php endforeach;
                                                    } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <h5 class="card-header bg-secondary text-center text-white fw-bold">Pengembalian Buku </h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="card-header mt-0">Nomor Pengembalian : <strong>#<?= $code_kembali; ?></strong> | <?= format_tanggal_indonesia($tanggal_hari_ini); ?> </p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">

                                                <div class="col-md-6">
                                                </div>
                                                <div class="col-md-6">
                                                    <form action="pengembalian/add_session_denda" method="post">
                                                        <div class="card-body">
                                                            <label for="defaultFormControlInput" class="form-label">Denda Lainya
                                                                <a href="<?= site_url('pengembalian/hapus_session_denda') ?>" class="btn btn-sm btn-danger" id="btn-hapus"><i class="bx bx-trash me-1"></i></a></label>
                                                            <input type="text" name="nominal" class="form-control" id="defaultFormControlInput" placeholder="Nominal..." aria-describedby="defaultFormControlHelp" />
                                                            <div id="defaultFormControlHelp" class="form-text">
                                                                <?= rupiah_format($nominal_tambah['nominal']) ?>
                                                            </div>
                                                            <div id="defaultFormControlHelp" class="form-text text-danger">
                                                                *Denda lainya untuk buku rusak atau hilang
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Jumlah</th>
                                                        <th>Judul Buku</th>
                                                        <th>Batas Peminjaman</th>
                                                        <th>Status</th>
                                                        <th>Denda</th>
                                                        <th>Kondisi Buku</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    if (empty($data_buku_kembali)) {
                                                    } else {
                                                        foreach ($data_buku_kembali as $val) : ?>
                                                            <tr>
                                                                <td><?= $val['jumlah']; ?></td>
                                                                <td><strong><?= $val['judul_buku'] ?></strong></td>
                                                                <td><?= format_tanggal_indonesia($val['tgl_kembali']) ?></td>
                                                                <td><?php
                                                                    if ($val['status'] == 'Belum Kembali') {
                                                                        echo '<span class="badge bg-primary">' . $val['status'] . '</span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-danger">' . $val['status'] . '</span>';
                                                                    }
                                                                    ?></td>
                                                                <td><?= rupiah_format($val['denda']) ?></td>
                                                                <td>
                                                                    <div class="col-md-12">
                                                                        <form action="pengembalian/prosess_pengembalian" method="post">
                                                                            <div class="mb-0 mt-0">
                                                                                <label for="kondisi_<?= $val['id_buku']; ?>"></label>
                                                                                <select id="kondisi_<?= $val['id_buku']; ?>" class="form-select" name="kondisi[<?= $val['id_buku']; ?>]">
                                                                                    <option disabled selected hidden>Pilih Kondisi --</option>
                                                                                    <option value="2">Rusak / Robek</option>
                                                                                    <option value="3">Hilang</option>
                                                                                </select>
                                                                            </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= site_url('pengembalian/hapus_buku_session/' . $val['id_buku']) ?>" class="btn btn-danger btn-sm"><i class="bx bx-trash me-1"></i></a>

                                                                </td>
                                                            </tr>
                                                    <?php endforeach;
                                                    }; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 mt-3 text-end">
                                                        <h5 class="divider-text mt-4 fw-bold">TOTAL DENDA</h5>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="defaultFormControlInput" class="form-label">Total</label>
                                                        <input type="text" name="total_denda" class="form-control" id="defaultFormControlInput" value="<?php
                                                                                                                                                        if (empty($data_buku_kembali)) {
                                                                                                                                                            echo 0;
                                                                                                                                                        } else {
                                                                                                                                                            $total_denda = 0;
                                                                                                                                                            foreach ($data_buku_kembali as $val) {
                                                                                                                                                                $total_denda += $val['denda'];
                                                                                                                                                            }
                                                                                                                                                            if (empty($total_denda ||  $nominal_tambah['nominal'] || $nominal_bayar['nominal_bayar'])) {
                                                                                                                                                                echo 0;
                                                                                                                                                            } else {
                                                                                                                                                                echo $total_denda + $nominal_tambah['nominal'];
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                        ?>" readonly />


                                                        <button type="submit" class="btn btn-primary col-12 mt-2">Simpan</button>
                                                    </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>