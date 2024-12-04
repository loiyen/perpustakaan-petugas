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
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between mb-0">
                                    <h5 class="card-header fw-bold"><i class='bx bxs-wallet'></i> DATA DENDA</h5>
                                    <small class="float-end">
                                       
                                    </small>
                                </div>
                                <div class="card-header mb-0">
                                    <h6>Filter : </h6>
                                    <a href="<?= site_url('denda') ?>" class="btn btn-outline-warning"> Belum lunas</a>
                                    <a href="<?= site_url('denda/lunas') ?>" class="btn btn-primary"> Lunas</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-striped">
                                            <thead class="table-secondary">
                                                <tr>

                                                    <th>Nama anggota</th>
                                                    <th>Tanggal pengembalian</th>
                                                    <th>Denda dibayar</th>
                                                    <th>jumlah denda</th>
                                                    <th class="text-center">action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                if (empty($denda)) {
                                                    echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                } else {

                                                    foreach ($denda as $val) :
                                                ?>
                                                        <tr>

                                                            <td><?= $val->nama_siswa; ?>
                                                                <div class="mt-3">
                                                                    <span>Kode Pengembalian : <br><strong><?= $val->kode_pengembalian; ?></strong></span>
                                                                </div>
                                                            </td>
                                                            <td><?= format_tanggal_indonesia($val->date); ?> | <br><?= format_jam_indonesia($val->date); ?> </td>
                                                            <td><?= rupiah_format($val->total_pembayaran) ?></td>
                                                            <td>
                                                                <?php
                                                                $total_bayar = $val->total_pembayaran;
                                                                $total_denda = $val->total_denda;
                                                                $saldo_pembayaran = 0;
                                                                $saldo_pembayaran = $total_denda - $total_bayar;
                                                                echo rupiah_format($saldo_pembayaran);
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                
                                                                <a href="<?= site_url('riwayatkembali/detail_data/' . $val->id_pengembalian) ?>" class="btn btn-primary btn-sm">Detail</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($denda as $val) :
                ?>
                    <div class="modal fade" id="modalCenter<?= $val->id_pengembalian; ?>" tabindex="-1" aria-hidden="true">
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
                                                <input type="hidden" id="nameWithTitle" name="id_pengembalian" class="form-control" value="<?= $val->id_pengembalian; ?>" />
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
                <?php endforeach; ?>