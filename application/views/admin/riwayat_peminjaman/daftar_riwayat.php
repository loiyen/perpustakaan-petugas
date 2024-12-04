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
                    <div class="col-xxl">
                       

                        <div class="card mb-2 ">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Daftar Peminjaman Item<a href="<?= site_url('peminjamanitem') ?>" class="mt-1 mb-1 btn-sm">Lihat data<i class='bx bxs-right-arrow-alt' undefined></i></a></h6>
                                    <small class="text-muted float-end">
                                    </small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between btn-sm">
                            <h5 class="card-header fw-bold"><i class='bx bxs-up-arrow' style='color:#20ff00'></i> DATA PEMINJAMAN</h5>
                            <small class="float-end">
                                <form method="get" action="<?= site_url('riwayat/cariData') ?>">
                                    <div class="float-end">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                            <input type="text" name="keyword" class="form-control" placeholder="Cari nomor peminjaman / nama siswa..." aria-label="Recipient's username" aria-describedby="button-addon2" />

                                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                                            <a href="<?= site_url('peminjaman') ?>" class="btn btn-primary  m-2 fw-bold"><i class='bx bx-plus'></i> Tambah peminjaman </a>

                                        </div>
                                    </div>
                                   
                                </form>
                            </small>
                        </div>

                        <div class="card-body">
                            <div class="row mt-3 mb-1">
                                <div class="col-1">
                                    <form action="<?= site_url('riwayat') ?>" method="get">
                                        <input type="number" name="per_page" class="form-control" placeholder="<?= $per_page; ?>" />
                                        <button hidden type="submit"></button>
                                    </form>
                                </div>
                                <div class="col-4 mb-2">
                                    <form action="<?= site_url('riwayat/pengurutanData') ?>" method="post">
                                        <div class="input-group">
                                            <select id="defaultSelect" class="form-select" name="urutan">
                                                <option disabled selected hidden>Urutkan Berdasarkan --</option>
                                                <option value="1">Hari Ini</option>
                                                <option value="2">1 Minggu Lalu</option>
                                                <option value="3">1 Bulan Lalu</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">Urutkan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead class="table-secondary">
                                        <tr >
                                            <th>#</th>
                                            <th class="text-center">Kode Peminjaman</th>
                                            <th>Nama anggota</th>
                                            <th class="text-center">total buku</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Tanggal | Jam</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php
                                        $items_per_page = $per_page;
                                        if (empty($riwayat)) {
                                            echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                        } else {
                                            $start_number = ($current_page - 1) * $items_per_page + 1;
                                            foreach ($riwayat as $key => $val) :
                                                $no = $start_number + $key + 0; ?>
                                                <tr>
                                                    <td class="text-center"><?= $no; ?></td>
                                                    <td class="text-center m-3"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $val['kode_peminjaman']; ?></strong>
                                                        <div class="text-center m-3">
                                                            <span>Petugas : <br><?= $val['nama_admin']; ?></span>
                                                        </div>
                                                    </td>
                                                    <td><?= $val['nama_siswa']; ?></td>
                                                    <td class="text-center"><?= $val['total_peminjaman']; ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($val['status_pinjam'] == 'Selesai') {
                                                            echo '<span class="btn rounded-pill btn-success btn-sm"><strong>' . $val['status_pinjam'] . '</strong></span>';
                                                        } else {
                                                            echo '<span class="btn rounded-pill btn-danger btn-sm"><strong>' . $val['status_pinjam'] . '</strong></span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><?= format_tanggal_indonesia($val['date_pinjam']) ?> |<br> <?= format_jam_indonesia($val['date_pinjam']) ?></td>
                                                    <td class="text-center">
                                                        <a href="<?= site_url('riwayat/detail_riwayat/' . $val['id_peminjaman']) ?>" class="btn btn-primary btn-sm"> Detail</a>
                                                        <!-- <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="<?= site_url('riwayat/detail_riwayat/' . $val['id_peminjaman']) ?>"><i class='bx bx-show-alt'></i> Lihat Detail</a>

                                                                <a class="dropdown-item" href="<?= site_url('riwayat/hapus_riwayat/' . $val['id_peminjaman']) ?>" id="btn-hapus"><i class="bx bx-trash me-1"></i> Hapus</a>
                                                            </div>
                                                        </div> -->
                                                    </td>
                                                </tr>
                                        <?php endforeach;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="demo-inline-spacing">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination">
                                        <li class="page-item prev">
                                            <a class="page-link" href="<?= base_url('index.php/riwayat/index/' . ($current_page - 1)) ?>"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                        </li>
                                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                            <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                <a class="page-link" href="<?= base_url('index.php/riwayat/index/' . $i) ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item next">
                                            <a class="page-link" href="<?= base_url('index.php/riwayat/index/' . ($current_page + 1)) ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Contoh tautan untuk menjadwalkan pembaruan otomatis -->


                    </div>
                </div>
            </div>