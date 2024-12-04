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
                    <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Denda /</span> Pembayaran Denda </h5>

                    <div class="row">
                        <!-- Basic Layout -->
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <?= $this->session->flashdata('not'); ?>
                                <?php if (isset($validation_errors)) {
                                    echo $validation_errors;
                                } ?>
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">Daftar Pembayaran Denda</h5>
                                    <small class="text-muted float-end"> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">
                                            <i class='bx bx-plus'></i> Tambah Denda
                                        </button>
                                        <a href="<?= site_url('denda/cetak_pdf') ?>" class="btn btn-danger btn-sm "><i class='bx bxs-download'></i></a>
                                        <a href="<?= site_url('denda/print') ?>" class="btn btn-danger btn-sm "><i class='bx bx-printer'></i></a>
                                    </small>
                                </div>
                                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Form Tambah Denda</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?= site_url('denda/tambah_pembayaran') ?>" method="post">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="defaultSelect" class="form-label">Nama Siswa</label>
                                                            <select id="defaultSelect" class="form-select" name="siswa" required>
                                                                <option disabled selected hidden>Pilih Nama Siswa --</option>
                                                                <?php foreach ($siswa as $val) : ?>
                                                                    <option value="<?= $val->id_siswa ?>"><?= $val->nama_siswa; ?> </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="defaultSelect" class="form-label">Judul Buku</label>
                                                            <select id="defaultSelect" class="form-select" name="buku" required>
                                                                <option disabled selected hidden>Pilih Judul Buku --</option>
                                                                <?php foreach ($buku as $val) : ?>
                                                                    <option value="<?= $val->id_buku ?>"><?= $val->kode_buku; ?> - <?= $val->judul_buku; ?> / <?= $val->kelas_buku; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="defaultSelect" class="form-label">Jumlah Pembayaran</label>
                                                            <input type="text" name="jumlah" class="form-control" placeholder="Masukan Jumlah EXP : 5000" />
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
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Judul Buku / Kelas</th>
                                                    <th>Jumlah</th>
                                                    <th>Tanggal</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                if (empty($pembayaran)) {
                                                    echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                } else {
                                                    foreach ($pembayaran as $val) : ?>
                                                        <tr>
                                                            <td><strong><?= $val->nama_siswa; ?></strong></td>
                                                            <td><?= $val->judul_buku; ?> / <?= $val->kelas_buku; ?></td>
                                                            <td><?= rupiah_format($val->jumlah); ?></td>
                                                            <td><?= format_tanggal_indonesia($val->datecreated); ?></td>
                                                            <td>
                                                                <a href="<?= site_url('denda/hapus/' . $val->id_pembayaran) ?>" id="btn-hapus" class="btn btn-sm btn-danger">Hapus</a>
                                                            </td>
                                                        </tr>
                                                <?php endforeach;
                                                } ?>
                                            </tbody>
                                        </table>
                                        <div class="demo-inline-spacing">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination pagination-sm">
                                                    <li class="page-item prev">
                                                        <a class="page-link" href="<?= base_url('index.php/denda/pembayaran/' . ($current_page - 1)) ?>"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                    </li>
                                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                        <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                            <a class="page-link" href="<?= base_url('index.php/denda/pembayaran/' . $i) ?>"><?= $i ?></a>
                                                        </li>
                                                    <?php endfor; ?>
                                                    <li class="page-item next">
                                                        <a class="page-link" href="<?= base_url('index.php/denda/pembayaran/' . ($current_page + 1)) ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>