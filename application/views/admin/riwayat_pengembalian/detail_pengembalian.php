<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">

            <?php
            $this->load->view('Admin/layout/navbar');
            ?>

            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="<?= site_url('riwayatkembali') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                <a href="<?= site_url('riwayatkembali/hapus_riwayat/' . $pengembalian['id_pengembalian']) ?>" id="btn-hapus" class="btn btn-outline-danger float-end"><i class="bx bx-trash"></i> Hapus</a>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-header fw-bold"><i class='bx bx-detail'></i> <strong>Detail Pengembalian</strong></h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <td> <strong>No Pengembalian</strong></td>
                                                    <td>:</td>
                                                    <td> <strong><?= $pengembalian['kode_pengembalian']; ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Pinjam</td>
                                                    <td>:</td>
                                                    <td><?= $pengembalian['total_pengembalian'] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal & Jam</td>
                                                    <td>:</td>
                                                    <td><?= format_tanggal_indonesia($pengembalian['date']) ?> | <?= format_jam_indonesia($pengembalian['date']) ?></td>
                                                </tr>

                                                <tr>
                                                    <th><a href="<?= site_url('riwayatkembali/print/' . $pengembalian['id_pengembalian']) ?>" class="btn btn-danger mt-1 mb-1 btn-sm"><i class='bx bx-printer'></i></a></th>

                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <h5 class="card-header fw-bold"><i class='bx bx-user'></i> Detail Data Siswa</h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <td class="table-primary"> <strong>No Anggota</strong></th>
                                                    <td>:</td>
                                                    <td><strong><?= $pengembalian['nisn']; ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-primary">Nama</ts>
                                                    <td>:</td>
                                                    <td><?= $pengembalian['nama_siswa']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-primary">Kelas</td>
                                                    <td>:</td>
                                                    <td><?= $pengembalian['kelas_siswa']; ?> <?= $pengembalian['jurusan_siswa']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-primary">Jenis Kelamin</th>
                                                    <td>:</td>
                                                    <td>
                                                        <?php
                                                        if ($pengembalian['jenis_kelamin'] == '1') {
                                                            echo 'Laki-laki';
                                                        } else if ($pengembalian['jenis_kelamin'] == '2') {
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
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <div class="card">
                                    <h6 class="card-header"><i class='bx bx-user-check'></i> <strong>Detail Buku Pengembalian</strong></h6>
                                </div>
                                <div class="row">
                                    <?php foreach ($item_pengembalian as $val) : ?>
                                        <div class="col-md-6 mt-2">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h6><i class='bx bxs-book-alt' undefined></i> <strong><?= $val['judul_buku']; ?></strong> </h6>
                                                    <div class="table-responsive text-nowrap">
                                                        <table class="table table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <td><strong>Kode Buku</strong></th>
                                                                    <td>:</td>
                                                                    <td><?= $val['kode_buku']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Kelas</strong></th>
                                                                    <td>:</td>
                                                                    <td><?= $val['kelas_buku']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Penulis</strong></th>
                                                                    <td>:</td>
                                                                    <td><?= $val['penulis_buku']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Kode Rak</strong></th>
                                                                    <td>:</td>
                                                                    <td><?= $val['kode_rak']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Jumlah</strong></th>
                                                                    <td>:</td>
                                                                    <td><?= $val['jumlah_kembali']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Denda Terlambat</strong></th>
                                                                    <td>:</td>
                                                                    <td><?= rupiah_format($val['denda']); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Kondisi Buku</strong></th>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <?php
                                                                        if ($val['kondisi_buku'] == 1) {
                                                                            echo '<span class="badge bg-success">Baik</span>';
                                                                        } elseif ($val['kondisi_buku'] == 2) {
                                                                            echo '<span class="badge bg-warning">Robek / Bercoret</span>';
                                                                        } elseif ($val['kondisi_buku'] == 3) {
                                                                            echo '<span class="badge bg-danger">Hilang</span>';
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <?php if (isset($validation_errors)) {
                                    echo $validation_errors;
                                } ?>
                                <div class="card">
                                    <h6 class="card-header"> <strong>Detail Denda Pengembalian</strong></h6>
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Total Denda<small>(T + DL)</small></th>
                                                        <th>:</th>
                                                        <th><?= rupiah_format($pengembalian['total_denda'] - $total_pembayaran) ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Dibayar</th>
                                                        <th>:</th>
                                                        <th><?= rupiah_format($total_pembayaran) ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <th>:</th>
                                                        <th> <?php
                                                                if ($pengembalian['status'] == 1) {
                                                                    echo '<span class="badge rounded-pill bg-success">Selesai</span>';
                                                                } elseif ($pengembalian['status'] == 2) {
                                                                    echo '<span class="badge rounded-pill bg-warning">Belum Bayar</span>';
                                                                } else {
                                                                    echo '<span class="badge rounded-pill bg-warning">Menunggak</span>';
                                                                }
                                                                ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="mt-3 mb-2">
                                            <h6> Riwayat Pembayaran : </h6>
                                            <?php
                                            if (empty($pembayaran)) {
                                                echo '<p class="card-text mt-2 text-center"> Data Kosong</p>';
                                            } else {
                                                foreach ($pembayaran as $val) : ?>
                                                    <div class="alert alert-dark mb-1 mt-1 " role="alert"><?= format_tanggal_indonesia($val['date_bayar']); ?>
                                                        <?= format_jam_indonesia($val['date_bayar']); ?> | <?= rupiah_format($val['jumlah']); ?></div>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                    if ($pengembalian['total_denda'] == $total_pembayaran) {
                                        echo '<button type="button" class="btn btn-warning" disabled data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        Bayar
                                    </button>';
                                    } else {
                                        echo '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                      Bayar
                                  </button>';
                                    }
                                    ?>
                                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">Pembayaran Denda - #<?= $kode_pembayaran; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= site_url('riwayatkembali/pembayaran_denda') ?>" method="post">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameWithTitle" class="form-label">Jumlah Pembayaran</label>
                                                                <input type="text" name="jumlah_bayar" id="nameWithTitle" class="form-control" placeholder="Masukan Jumlah Pembayaran..." />
                                                                <input type="hidden" id="nameWithTitle" name="id_pengembalian" class="form-control" value="<?= $pengembalian['id_pengembalian']; ?>" />
                                                                <input type="hidden" id="nameWithTitle" name="kode_bayar" class="form-control" value="<?= $kode_pembayaran; ?>" />
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>




                    <!-- <div class="row mt-5">
                        <div class="col-md-8 mt-2">
                            <div class="card ">
                                <?php if (isset($validation_errors)) {
                                    echo $validation_errors;
                                } ?>
                                <div class="card-header  d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">Data Pengembalian Items</h5>
                                </div>
                                <div class="card-body mb-1 mt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Judul</th>
                                                            <th>Kondisi</th>
                                                            <th>Jumlah</th>
                                                            <th>Denda</th>
                                                            <th>Status</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        foreach ($item_pengembalian as $val) :
                                                        ?>
                                                            <tr>
                                                                <td><?= $no; ?></td>
                                                                <td><?= $val['judul_buku']; ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($val['kondisi_buku'] == 1) {
                                                                        echo '<span class="badge bg-success">Baik</span>';
                                                                    } elseif ($val['kondisi_buku'] == 2) {
                                                                        echo '<span class="badge bg-warning">Robek / Bercoret</span>';
                                                                    } elseif ($val['kondisi_buku'] == 3) {
                                                                        echo '<span class="badge bg-danger">Hilang</span>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?= $val['jumlah_kembali']; ?></td>
                                                                <td><?= rupiah_format($val['denda']); ?></td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                        <?php $no++;
                                                        endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12 mt-5">
                                            <div class="row">
                                                <?php
                                                foreach ($item_pengembalian as $val) :
                                                ?>
                                                    <div class="col-md-4 col-lg-4 mb-2">
                                                        <div class="card h-100">
                                                            <div class="col-md">
                                                                <div class="row g-0">
                                                                    <div class="col-md-4">
                                                                        <img class="card-img card-img-left" src="<?= base_url('asset/fotobuku/' . $val['foto_buku']) ?>" alt="Card image" />
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="card-body">
                                                                            <h6 class="card-title"><?= $val['judul_buku']; ?></h6>
                                                                            <p class="card-text mb-0">
                                                                                <small class="text-muted">
                                                                                    Kelas : <?= $val['kelas_buku'] ?>
                                                                                </small>
                                                                            </p>
                                                                            <p class="card-text mb-0">
                                                                                <small class="text-muted">
                                                                                    Penerbit : <?= $val['penerbit_buku'] ?>
                                                                                </small>
                                                                            </p>
                                                                            <p class="card-text"> <small class="text-muted"> Stok : <?= $val['stok_buku']; ?></small></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 mt-2 ">
                            <div class="card h-100 ">
                                <h5 class="card-header text-center">Denda</h5>
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Terlambat</th>
                                                    <th>:</th>
                                                    <th>13 hari</th>
                                                </tr>
                                                <tr>
                                                    <th>Total Denda<small>(T + DL)</small></th>
                                                    <th>:</th>
                                                    <th>Rp.12.000</th>
                                                </tr>
                                                <tr>
                                                    <th>Dibayar</th>
                                                    <th>:</th>
                                                    <th>Rp.0</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>