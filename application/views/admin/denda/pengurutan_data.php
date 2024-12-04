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
                    <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Denda /</span> Daftar Denda </h5>

                    <div class="row">
                        <!-- Basic Layout -->
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">Daftar Denda Masuk</h5>
                                </div>
                                <form action="<?= site_url('denda/pengurutanData') ?>" method="post">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <label for="defaultSelect" class="form-label">Tampilkan Data : </label>
                                        <select id="defaultSelect" class="form-select" name="urutan">
                                            <option disabled selected hidden>Tampilkan Berdasarkan --</option>
                                            <option value="2">Telat ( 1 - 7 ) Hari = Rp. 5.000</option>
                                            <option value="3">Telat ( 7 - 14 ) Hari = Rp. 15.000</option>
                                            <option value="4">Hilang = Rp. 50.000</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="card">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Buku / Kelas </th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Denda</th>
                                                    <th>Catatan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                if (empty($riwayat)) {
                                                    echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                } else {
                                                    foreach ($riwayat as $val) : ?>
                                                        <tr>
                                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $val->nama_siswa; ?></strong></td>
                                                            <td><?= $val->judul_buku; ?> / <?= $val->kelas_buku; ?></td>
                                                            <td><?= format_tanggal_indonesia($val->tanggal_kembali); ?></td>
                                                            <td><?php
                                                                if ($val->denda == '1') {
                                                                    echo 'Tidak Ada';
                                                                } elseif ($val->denda == '2') {
                                                                    echo 'Telat ( 1 - 7 ) Hari = Rp. 5.000';
                                                                } elseif ($val->denda == '3') {
                                                                    echo 'Telat ( 7 - 14 ) Hari = Rp. 15.000';
                                                                } elseif ($val->denda == '4') {
                                                                    echo 'Hilang = Rp. 50.000';
                                                                }
                                                                ?></td>
                                                            <td>Note : <?= $val->catatan; ?> </td>


                                                        </tr>
                                                <?php endforeach;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="demo-inline-spacing">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination pagination-sm">
                                                <li class="page-item prev">
                                                    <a class="page-link" href="<?= base_url('index.php/riwayatkembali/index/' . ($current_page - 1)) ?>"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                </li>
                                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                    <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                        <a class="page-link" href="<?= base_url('index.php/riwayatkembali/index/' . $i) ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>
                                                <li class="page-item next">
                                                    <a class="page-link" href="<?= base_url('index.php/riwayatkembali/index/' . ($current_page + 1)) ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
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