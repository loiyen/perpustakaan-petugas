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
                                        <a href="<?= site_url('riwayat') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= $this->session->flashdata('not'); ?>
                        <div class="row mb-1">
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="card h-100">
                                    <h5 class="card-header text-center">Data Siswa</h5>
                                    <form action="peminjaman/add_session_siswa" method="post">
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
                                        <a href="<?= site_url('peminjaman/hapus_session_siswa') ?>" class="btn btn-danger btn-sm mt-2 "><i class="bx bx-trash me-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 text-center">Data Buku</h5>
                                        <small class="text-muted float-end">
                                            <a href="<?= site_url('peminjaman/hapus_session_buku') ?>" class="btn btn-danger btn-sm"><i class="bx bx-trash "></i></a>
                                        </small>
                                    </div>
                                    <form action="peminjaman/add_session_buku" method="post">
                                        <div class="card-body">
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
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (empty($data_buku)) {
                                                        echo "<tr><td colspan='4' class='text-center mt-5 mb-5'>Belum Ada Data Masuk.</td></tr>";
                                                    } else {
                                                        foreach ($data_buku as $item) : ?>
                                                            <tr>
                                                                <form action="<?= site_url('peminjaman/update_jumlah') ?>" method="post">
                                                                    <input type="hidden" name="id_buku" value="<?= $item['id_buku'] ?>">
                                                                    <td>
                                                                        <input type="text" name="jumlah" value="<?= $item['jumlah']; ?>" min="1" class="form-control" style="width: 50px; display: inline-block;">
                                                                        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                                                    </td>
                                                                </form>
                                                                <td><?= $item['judul_buku']; ?></td>
                                                                <td><a href="<?= site_url('peminjaman/hapus_buku_session/' . $item['id_buku']) ?>" class="btn btn-danger btn-sm"><i class="bx bx-trash me-1"></i></a></td>
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
                                    <h5 class="card-header  bg-secondary text-white text-center">Form Peminjaman </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="card-header mt-0">Nomor Peminjaman : <strong><?= $kode_pinjam; ?></strong> | <?= format_tanggal_indonesia($tanggal_hari_ini); ?></p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= site_url('peminjaman/proses_peminjaman') ?>" method="post">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Tanggal Pinjam</label>
                                                    <input class="form-control" type="date" name="tanggal_pinjam" value="<?= $tanggal_hari_ini ?>" readonly />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Tanggal Kembali</label>
                                                    <input class="form-control" type="date" name="tanggal_kembali" value="<?= $tanggal_5_hari_ke_depan ?>" readonly />
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                
                                                <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Tanggal Pinjam</label>
                                                    <input class="form-control" type="date" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Tanggal Kembali</label>
                                                    <input class="form-control" type="date"/>
                                                </div>
                                            </div> -->
                                            <button type="submit" class="btn btn-primary ">Simpan</button>
                                        </form>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>