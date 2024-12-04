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
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="<?= site_url('riwayat') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                               
                                <button type="button" class="btn btn-primary float-end fw-bold " data-bs-toggle="modal" data-bs-target="#modalCenter">
                                    <i class='bx bx-sort'></i>Urutkan
                                </button>
                            </div>
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 fw-bold"><i class='bx bx-book'></i> PEMINJAMAN ITEM</h5>
                                <small class="text-muted float-end">
                                </small>
                            </div>
                            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCenterTitle">Urutkan Data Peminjaman</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= site_url('peminjamanitem/process_form') ?>" method="post">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="nameWithTitle" class="form-label">Tanggal Awal</label>
                                                        <input type="date" name="tanggal_awal" id="nameWithTitle" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailWithTitle" class="form-label">Tanggal Akhir</label>
                                                        <input type="date" name="tanggal_akhir" id="emailWithTitle" class="form-control" />
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>#</th>
                                                <th>Status</th>
                                               
                                                <th>Judul Buku</th>
                                                <th>Tanggal Peminjaman</th>
                                                <th>Tanggal Pengembalian</th>
                                                <th>Jumlah</th>
                                                <th>Denda</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php

                                            if (empty($peminjaman)) {
                                                echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                            } else {
                                                $no = 1;
                                                foreach ($peminjaman as $val) :  ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td>
                                                            <div class="mb-3">
                                                                <?php
                                                                if ($val->status == 'Selesai') {
                                                                    echo '<span class="badge bg-success me-1"><strong>' . $val->status . '</strong></span>';
                                                                } elseif ($val->status == 'Belum Kembali') {
                                                                    echo '<span class="badge bg-primary me-1"><strong>' . $val->status . '</strong></span>';
                                                                } else {
                                                                    echo '<span class="badge bg-danger"><strong>' . $val->status . '</strong></span>';
                                                                }
                                                                ?>
                                                            </div>KODE :
                                                            <strong><?= $val->kode_peminjaman; ?></strong>
                                                        </td>
                                                        <td><?= $val->judul_buku; ?></td>
                                                        <td><?= format_tanggal_indonesia($val->tanggal_pinjam); ?></td>
                                                        <td><?= format_tanggal_indonesia($val->tanggal_kembali); ?></td>
                                                        <td><?= $val->jumlah_pinjam; ?></td>
                                                        <td><?= rupiah_format($val->denda); ?></td>
                                                    </tr>
                                            <?php $no++;
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