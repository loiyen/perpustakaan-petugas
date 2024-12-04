<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="layout-page">

            <?php
            $this->load->view('Admin/layout/navbar');
            ?>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?= site_url('riwayat') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                    <a href="<?= site_url('riwayat/hapus_riwayat/' . $peminjaman['id_peminjaman']) ?>" id="btn-hapus" class="btn btn-outline-danger float-end"><i class="bx bx-trash"></i> Hapus</a>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-header fw-bold"><i class='bx bx-detail'></i> Detail Peminjaman</h5>
                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <td>No Peminjaman</td>
                                                            <td>:</td>
                                                            <td><?= $peminjaman['kode_peminjaman']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Pinjam</td>
                                                            <td>:</td>
                                                            <td><?= $peminjaman['total_peminjaman'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status Peminjaman</td>
                                                            <td>:</td>
                                                            <td><?php
                                                                if ($peminjaman['status_pinjam'] == 'Prosess') {
                                                                    echo ' <span class="badge bg-danger">' . $peminjaman['status_pinjam'] . '</span>';
                                                                } else {
                                                                    echo ' <span class="badge bg-success">' . $peminjaman['status_pinjam'] . '</span>';
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal & Jam</td>
                                                            <td>:</td>
                                                            <td><?= format_tanggal_indonesia($peminjaman['date_pinjam']) ?> | <?= format_jam_indonesia($peminjaman['date_pinjam']) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><a href="<?= site_url('riwayat/print/' . $peminjaman['id_peminjaman']) ?>" class="btn btn-danger mt-1 mb-1 btn-sm"><i class='bx bx-printer'></i></a></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-header fw-bold"><i class='bx bx-user'></i> Data Anggota</h5>
                                            <div class="d-flex align-items-start align-items-sm-center gap-4 ">
                                                <?php
                                                if ($peminjaman['foto_siswa'] == null) {
                                                    echo '<img src="' . base_url('asset/user1.png') . '" alt="foto profil" class="d-block rounded responsive" height="150" width="130" id="uploadedAvatar" />';
                                                } else {
                                                    echo '<img src="' . base_url('asset/profilsiswa/' . $peminjaman['foto_siswa']) . '" alt="foto profil" class="d-block rounded responsive" height="150" width="120" id="uploadedAvatar" />';
                                                }
                                                ?>

                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th class="table-primary">Nama</th>
                                                                <th>:</th>
                                                                <th><?= $peminjaman['nama_siswa']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th class="table-primary">No Anggota</th>
                                                                <th>:</th>
                                                                <th><?= $peminjaman['nisn']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th class="table-primary">Kelas</th>
                                                                <th>:</th>
                                                                <th><?= $peminjaman['kelas_siswa']; ?> <?= $peminjaman['jurusan_siswa']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th class="table-primary">Jenis Kelamin</th>
                                                                <th>:</th>
                                                                <th>
                                                                    <?php
                                                                    if ($peminjaman['jenis_kelamin'] == '1') {
                                                                        echo 'Laki-laki';
                                                                    } else if ($peminjaman['jenis_kelamin'] == '2') {
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
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xxl">
                            <div class="card">
                                <div class="card-body mb-1 mt-0">
                                    <h5 class="card-header fw-bold mb-0"><i class='bx bx-user-check'></i> Data Peminjaman Items</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-borderless">
                                                    <thead class="table-secondary">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Judul</th>
                                                            <th class="text-center">Jumlah</th>
                                                            <th class="text-center">Tgl Pinjam</th>
                                                            <th class="text-center">Tanggat</th>
                                                            <th>Denda</th>
                                                            <th>Status</th>
                                                            <th></th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        foreach ($item_peminjaman as $val) :
                                                        ?>
                                                            <tr>
                                                                <td><?= $no; ?></td>
                                                                <td><?= $val['judul_buku']; ?></td>
                                                                <td class="text-center"><?= $val['jumlah_pinjam']; ?></td>
                                                                <td><?= format_tanggal_indonesia($val['tanggal_pinjam']); ?></td>
                                                                <td><?= format_tanggal_indonesia($val['tanggal_kembali']); ?></td>
                                                                <td><?= rupiah_format($val['denda']); ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($val['status'] == 'Belum Kembali') {
                                                                        echo '  <span class="badge bg-primary">' . $val['status'] . '</span>';
                                                                    } else if ($val['status'] == 'Terlambat') {
                                                                        echo ' <span class="badge bg-danger">' . $val['status'] . '</span>';
                                                                    } else {
                                                                        echo ' <span class="badge bg-success ">' . $val['status'] . '</span>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><button type="button" class="btn btn-outline-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#basicModal<?= $val['id_peminjamanitems'] ?>">
                                                                        <i class='bx bxs-edit'></i> Edit
                                                                    </button></td>
                                                            </tr>
                                                        <?php $no++;
                                                        endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            foreach ($item_peminjaman as $val) :
                            ?>
                                <div class="modal fade" id="basicModal<?= $val['id_peminjamanitems'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Form Perpanjangan Peminjaman</h5><br>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= site_url('riwayat/perpanjangan')?>" method="post">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="emailBasic" class="form-label">Judul buku</label>
                                                            <input type="text" value="<?= $val['judul_buku'] ?>" id="emailBasic" class="form-control" />
                                                            <input type="hidden" name="id_peminjamanitems" value="<?= $val['id_peminjamanitems'] ?>" id="emailBasic" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            <label for="emailBasic" class="form-label">Tanggal pinjam</label>
                                                            <input type="text" value="<?= $val['tanggal_pinjam'] ?>" readonly id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx" />
                                                        </div>
                                                        <div class="col mb-0">
                                                            <label for="dobBasic" class="form-label">Tanggal kembali</label>
                                                            <input type="date" name="tanggal_tambah" value="<?= $val['tanggal_kembali'] ?>"  class="form-control" placeholder="DD / MM / YY" />
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
                            <?php endforeach; ?>

                            <div class="col-lg-12 mt-2 mb-2">
                                <div class="row">
                                    <di class="col-lg-3 col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold"><i class='bx bx-detail'></i> DETAIL BUKU
                                                </h5>
                                            </div>
                                        </div>
                                    </di>
                                    <di class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="card-body">
                                            <hr>
                                        </div>
                                    </di>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">

                                <div class="row">
                                    <?php
                                    foreach ($item_peminjaman as $val) :
                                    ?>
                                        <div class="col-md-4 col-lg-4 col-sm-4 mb-2">
                                            <div class="card h-100">
                                                <div class="col-md">
                                                    <div class="row g-0">
                                                        <div class="col-md-4 ">
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