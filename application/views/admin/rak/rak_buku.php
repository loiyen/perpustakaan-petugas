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
                    <div class="row">
                        <div class="error-message">
                            <?php if (isset($validation_errors)) {
                                echo $validation_errors;
                            } ?>
                        </div>
                        <div class="col-xxl">
                            <div class="card mb-4">

                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 fw-bold"><i class='bx bx-collection'></i> DATA RAK</h5>
                                    <small class="text-muted float-end"> <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#basicModal">
                                            <i class='bx bx-plus'></i> Tambah rak
                                        </button></small>
                                </div>
                                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Form Tambah Rak</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= site_url('rak/tambah_rak') ?>" method="post">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Nama Rak</label>
                                                            <input type="text" name="rak" class="form-control" placeholder="Masukan Nama Rak Buku..." />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Kode Rak</label>
                                                            <input type="text" name="kode_rak" class="form-control" placeholder="Masukan Kode Rak Buku..." />
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
                                        <table class="table table-striped">
                                            <thead class="table-secondary">
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>Nama Rak</th>
                                                    <th>Kode Rak</th>
                                                    <th>Jumlah buku</th>
                                                    <th>Update</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php $no = 1;
                                                foreach ($rak as $val) : ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td> <strong><?= $val->nama_rak; ?></strong></td>
                                                        <td class="text-center"><?= $val->kode_rak; ?></td>
                                                        <td class="text-center"><?= $val->jumlah_buku; ?></td>
                                                        <td class="text-center"><?= format_tanggal_indonesia($val->datecreated); ?></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-warning btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#basicModal1<?= $val->id_rak ?>">
                                                                <i class='bx bxs-edit'></i> Edit
                                                            </button>
                                                            <a href="<?= site_url('rak/hapus/' . $val->id_rak) ?>" class="btn btn-danger btn-sm" id="btn-hapus"><i class="bx bx-trash me-1"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($rak as $val) :
                ?>
                    <div class="modal fade" id="basicModal1<?= $val->id_rak; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="exampleModalLabel1">FORM EDIT RAK</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('rak/edit_rak') ?>" method="post">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameBasic" class="form-label">Nama Rak</label>
                                                <input type="text" name="rak" value="<?= $val->nama_rak; ?>" class="form-control" placeholder="Masukan Nama Rak Buku..." />
                                                <input type="hidden" name="id_rak" value="<?= $val->id_rak; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameBasic" class="form-label">Kode Rak</label>
                                                <input type="text" name="kode_rak" value="<?= $val->kode_rak; ?>" class="form-control" placeholder="Masukan Kode Rak Buku..." />
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
            </div>