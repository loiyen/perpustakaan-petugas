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
                                    <h5 class="card-header fw-bold"><a href="<?= site_url('denda') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a> <i class='bx bxs-wallet'></i> DATA DENDA</h5>
                                    <small class="float-end">
                                        <form method="get" action="<?= site_url('denda/cariData') ?>">
                                            <div class="float-end">
                                                <div class="input-group">
                                                    <input type="date" name="akhir" class="form-control" aria-describedby="button-addon2" />
                                                </div>
                                            </div>
                                            <div class="float-end">
                                                <div class="input-group">
                                                    <input type="date" name="awal" class="form-control" aria-describedby="button-addon2" />
                                                </div>
                                            </div>
                                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                                        </form>
                                    </small>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-header">Daftar Pembayaran | <?= format_tanggal_indonesia($awal); ?> & <?= format_tanggal_indonesia($akhir); ?> </h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Kode pengembalian</th>
                                                        <th>Kode pembayaran</th>
                                                        <th>Jumlah</th>
                                                        <th>Tanggal</th>

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
                                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $val->kode_pengembalian; ?></strong>
                                                                    <a href="<?= site_url('riwayatkembali/detail_data/' . $val->id_pengembalian) ?>"><i class='bx bx-right-arrow-alt'></i></a>
                                                                </td>
                                                                <td># <?= $val->kode_pembayaran; ?></td>
                                                                <td><?= rupiah_format($val->jumlah); ?></td>
                                                                <td><?= format_tanggal_indonesia($val->date_bayar); ?> | <br><?= format_jam_indonesia($val->date_bayar); ?></td>
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
                </div>