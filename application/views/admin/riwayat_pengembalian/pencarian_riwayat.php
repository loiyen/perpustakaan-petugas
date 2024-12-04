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

                    <!-- <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="get" action="<?= site_url('riwayatkembali/cariData') ?>">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Cari Kode Pengembalian</label>
                                        <div class="input-group rounded">
                                            <input type="text" name="keyword" class="form-control rounded" placeholder="Masukan Kode Pengembalian..." aria-label="Search" aria-describedby="search-addon" />
                                            <span class="input-group-text border-0" id="search-addon">
                                                <i class="bx bx-search fs-4 lh-0"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->

                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between btn-sm">
                            <h5 class="card-header fw-bold"><i class='bx bxs-down-arrow' style='color:#fd0000'></i> DATA PENGEMBALIAN</h5>
                            <small class="float-end">
                                <form action="<?= site_url('riwayatkembali/cariData') ?>" method="get">
                                    <div class="float-end">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                            <input type="text" name="keyword" class="form-control" placeholder="Cari nomor peminjaman / nama siswa..." aria-label="Recipient's username" aria-describedby="button-addon2" />
                                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                                            <a href="<?= site_url('pengembalian') ?>" class="btn btn-primary  m-2 fw-bold"><i class='bx bx-plus'></i> Tambah pengembalian</a>
                                        </div>
                                    </div>
                                </form>
                            </small>
                        </div>

                        <div class="card-body">
                            <div class="row mt-3 mb-1">
                                <div class="col-1">
                                    <form action="<?= site_url('riwayatkembali') ?>" method="get">
                                        <input type="number" name="per_page" class="form-control" placeholder="<?= $per_page; ?>" />
                                        <button hidden type="submit"></button>
                                    </form>
                                </div>
                                <div class="col-4 mb-2">
                                    <form action="<?= site_url('riwayatkembali/pengurutanData') ?>" method="post">
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
                            <h6 class="card-header text-center">-- Pencarian "<i><?= $kunci; ?></i>" --</h6>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Kode Pengembalian</th>
                                            <th>Nama anggota</th>
                                            <th>Total Buku</th>
                                            <th>Total Denda</th>
                                            <th>Status Pembayaran</th>
                                            <th>Tanggal | Jam</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php
                                        if (empty($riwayat_kembali)) {
                                            echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                        } else {

                                            foreach ($riwayat_kembali as $key => $val) :
                                        ?>
                                                <tr>
                                                    <td class="text-center m-3 "><strong><?= $val->kode_pengembalian; ?></strong>
                                                        <div class="text-center m-3">
                                                            <span>Petugas : <br><?= $val->nama_admin; ?></span>
                                                        </div>
                                                    </td>
                                                    <td><?= $val->nama_siswa; ?></td>
                                                    <td class="text-center"><?= $val->total_pengembalian; ?></td>
                                                    <td>
                                                        <i><?= rupiah_format($val->total_denda); ?></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($val->status == 1) {
                                                            echo '<span class="btn rounded-pill btn-success btn-sm">Selesai</span>';
                                                        } elseif ($val->status == 2) {
                                                            echo '<span class="btn rounded-pill btn-warning btn-sm">Belum Bayar</span>';
                                                        } else {
                                                            echo '<span class="btn rounded-pill btn-warning btn-sm">Menunggak</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?= format_tanggal_indonesia($val->date); ?> |<br> <?= format_jam_indonesia($val->date); ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?= site_url('riwayatkembali/detail_data/' . $val->id_pengembalian) ?>" class="btn btn-primary btn-sm">Detail</a>
                                                        <!-- <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="<?= site_url('riwayatkembali/detail_data/' . $val->id_pengembalian) ?>"><i class='bx bx-show-alt'></i> Detail Data</a>

                                                                <a class="dropdown-item" href="<?= site_url('riwayatkembali/hapus_riwayat/' . $val->id_pengembalian) ?>" id="btn-hapus"><i class="bx bx-trash "></i> Hapus</a>
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

                        </div>
                    </div>
                </div>
            </div>