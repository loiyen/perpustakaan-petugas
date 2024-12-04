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

                        <div class="col-md-8">
                            <div class="card h-100">
                                <div class="card body h-100">
                                    <div id="container3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">

                                    <ul class="p-0 m-0 mt-2">
                                        <li class="d-flex mb-4 pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <i class='bx bxs-category' style='color:#0affbb'></i>
                                            </div>
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <small class="text-muted d-block mb-1">Buku</small>
                                                    <h6 class="mb-0">Kategori</h6>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <h6 class="mb-0"><?= $kategori; ?></h6>

                                                </div>
                                            </div>
                                        </li>

                                        <li class="d-flex mb-4 pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <i class='bx bx-current-location' style='color:#9b0aff'></i>
                                            </div>
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <small class="text-muted d-block mb-1">Buku</small>
                                                    <h6 class="mb-0">Rak</h6>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <h6 class="mb-0"><?= $rak; ?></h6>

                                                </div>
                                            </div>
                                        </li>

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
                                                    <h6 class="mb-0"><?= $peminjamanitem; ?></h6>

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
                                                    <h6 class="mb-0">Pengembalian items</h6>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <h6 class="mb-0"><?= $pengembalianitem; ?></h6>

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
                                                    <h6 class="mb-0"><?= rupiah_format($dendaall) ?></h6>

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
                                                    <h6 class="mb-0"><?= rupiah_format($total_bayar) ?></h6>

                                                </div>
                                            </div>
                                        </li>


                                    </ul>
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

            <div class="modal fade" id="basicModal1" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Form Download PDF</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= site_url('laporan/pdf') ?>" method="post">
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