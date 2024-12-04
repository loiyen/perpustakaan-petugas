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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <form action="<?= site_url('laporan/process_form') ?>" method="post">
                                    <h5 class="card-header">Admin dan Staf</h5>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="defaultSelect" class="form-label">Pilih Admin dan Staf</label>
                                            <select id="defaultSelect" class="form-select" name="admin">
                                                <option disabled selected hidden>Pilih Admin / Staff --</option>
                                                <?php foreach ($admin as $val) :  ?>
                                                    <option value="<?= $val->id_admin; ?>"><?= $val->nama_admin; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <h5 class="card-header">Masukan Tanggal</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="defaultSelect" class="form-label">Dari Tanggal</label>
                                            <input type="date" name="awal" class="form-control" aria-describedby="defaultFormControlHelp" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="defaultSelect" class="form-label">Sampai Tanggal</label>
                                            <input type="date" name="akhir" class="form-control" aria-describedby="defaultFormControlHelp" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal">
                            <i class='bx bx-printer'></i>
                        </button>
                        </div>
                       
                        </form>
                        
                    </div>

                    <div class="row mt-5">
                        <div class="col-xl-12">
                            <div class="nav-align-top mb-4">
                                <small class="text-muted float-end"><?= format_tanggal_indonesia($awal); ?> s/d <?= format_tanggal_indonesia($akhir); ?> </small>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                                            Peminjaman
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                                            Pengembalian
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">
                                            Visualiasi
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-striped">
                                                <thead class="table-secondary ">
                                                    <tr>
                                                        <th>Kode Peminjaman</th>
                                                        <th>Nama</th>
                                                        <th class="text-center">Jumlah</th>
                                                        <th>Tanggal & Jam</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">actions</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    if (empty($peminjaman)) {
                                                        echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                    } else {
                                                        foreach ($peminjaman as $val) : ?>
                                                            <tr>
                                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $val->kode_peminjaman; ?></strong></td>
                                                                <td><?= $val->nama_siswa; ?></td>
                                                                <td class="text-center"><?= $val->total_peminjaman; ?></td>
                                                                <td><?= format_tanggal_indonesia($val->date_pinjam) ?><br> | <?= format_jam_indonesia($val->date_pinjam) ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    if ($val->status_pinjam == 'Selesai') {
                                                                        echo '<span class="btn rounded-pill btn-success btn-sm"><strong>' . $val->status_pinjam . '</strong></span>';
                                                                    } else {
                                                                        echo '<span class="btn rounded-pill btn-danger btn-sm"><strong>' . $val->status_pinjam . '</strong></span>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="<?= site_url('riwayat/detail_riwayat/' . $val->id_peminjaman) ?>" class="btn btn-primary btn-sm"> Detail</a>
                                                                </td>

                                                            </tr>
                                                    <?php endforeach;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-striped">
                                                <thead class="table-secondary">
                                                    <tr>
                                                        <th>Kode Pengembalian</th>
                                                        <th>Nama</th>
                                                        <th class="text-center">Total buku</th>
                                                        <th>Total Denda</th>
                                                        <th class="text-center">Status pembayaran</th>
                                                        <th>Tanggal</th>
                                                        <th class="text-center"> action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    if (empty($pengembalian)) {
                                                        echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                    } else {
                                                        foreach ($pengembalian as $val) : ?>
                                                            <tr>
                                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $val->kode_pengembalian; ?></strong></td>
                                                                <td><?= $val->nama_siswa; ?></td>
                                                                <td class="text-center"><?= $val->total_pengembalian; ?></td>
                                                                <td><?= rupiah_format($val->total_denda); ?></td>
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
                                                                <td><?= format_tanggal_indonesia($val->date) ?> <br>| <?= format_jam_indonesia($val->date) ?> </td>
                                                                <td class="text-center">
                                                                    <a href="<?= site_url('riwayatkembali/detail_data/' . $val->id_pengembalian) ?>" class="btn btn-primary btn-sm">Detail</a>
                                                                </td>
                                                            </tr>
                                                    <?php endforeach;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                                        <di class="row">
                                            <div class="col-lg-6 col-md-6 mb-2 ">
                                                <div class="card body h-100">
                                                    <div id="container1"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2 ">
                                                <div class="card body h-100">
                                                    <div class="card-header">
                                                        <h5>Detail item</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul class="p-0 m-0">
                                                            <li class="d-flex mb-4 pb-1">
                                                                <div class="avatar flex-shrink-0 me-3">
                                                                    <i class='bx bx-up-arrow-circle' style='color:#03e403'></i>
                                                                </div>
                                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                    <div class="me-2">
                                                                        <small class="text-muted d-block mb-1">Buku</small>
                                                                        <h6 class="mb-0">Peminjaman items</h6>
                                                                    </div>
                                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                                        <h6 class="mb-0"><?= $total_peminjamanitem; ?></h6>

                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="d-flex mb-4 pb-1">
                                                                <div class="avatar flex-shrink-0 me-3">
                                                                    <i class='bx bx-down-arrow-circle' style='color:#e40303'></i>
                                                                </div>
                                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                    <div class="me-2">
                                                                        <small class="text-muted d-block mb-1">Buku</small>
                                                                        <h6 class="mb-0">Pengembalian</h6>
                                                                    </div>
                                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                                        <h6 class="mb-0"><?= $total_pengembalianitem; ?></h6>

                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="d-flex mb-4 pb-1">
                                                                <div class="avatar flex-shrink-0 me-3">
                                                                    <i class='bx bx-wallet-alt' style='color:#f9f407'></i>
                                                                </div>
                                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                    <div class="me-2">
                                                                        <small class="text-muted d-block mb-1">Denda</small>
                                                                        <h6 class="mb-0">Total Denda</h6>
                                                                    </div>
                                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                                        <h6 class="mb-0"><?= rupiah_format($total_denda); ?></h6>

                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="d-flex mb-4 pb-1">
                                                                <div class="avatar flex-shrink-0 me-3">
                                                                    <i class='bx bxs-wallet-alt' style='color:#020ade'></i>
                                                                </div>
                                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                    <div class="me-2">
                                                                        <small class="text-muted d-block mb-1">Denda</small>
                                                                        <h6 class="mb-0">Pembayaran</h6>
                                                                    </div>
                                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                                        <h6 class="mb-0"><?= rupiah_format($total_pembayaran); ?></h6>

                                                                    </div>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </di>


                                        <!-- <div class="row ">
                                            <div class="col-md-6 col-lg-4 mt-1">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h1 class="text-center"><?= $hitungpeminjaman; ?></h1>
                                                        <p class="card-text text-center">peminjaman</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 mt-1">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h1 class="text-center"><?= $hitungpengembalian; ?></h1>
                                                        <p class="card-text text-center">Pengembalian</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 mt-1">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <h1 class="text-center"><?= $hitungbuku; ?></h1>
                                                        <p class="card-text text-center">Buku</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 mt-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h1 class="text-center"><?= $hitungsiswa; ?></h1>
                                                        <p class="card-text text-center">Siswa</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 mt-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h1 class="text-center"></h1>
                                                        <p class="card-text text-center">Pembayaran Masuk</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 mt-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h1 class="text-center"></h1>
                                                        <p class="card-text text-center">Total Denda</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Form Print</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= site_url('laporan/print') ?>" method="post">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="defaultSelect" class="form-label">Pilih Admin dan Staf</label>
                                        <select id="defaultSelect" class="form-select" name="admin">
                                            <option disabled selected hidden>Pilih Admin / Staff --</option>
                                            <?php foreach ($admin as $val) :  ?>
                                                <option value="<?= $val->id_admin; ?>"><?= $val->nama_admin; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="defaultSelect" class="form-label">Dari Tanggal</label>
                                        <input type="date" name="awal" class="form-control" aria-describedby="defaultFormControlHelp" />
                                    </div>
                                    <div class="col mb-0">
                                        <label for="defaultSelect" class="form-label">Sampai Tanggal</label>
                                        <input type="date" name="akhir" class="form-control" aria-describedby="defaultFormControlHelp" />
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>