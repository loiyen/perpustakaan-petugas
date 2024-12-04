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
                  
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (isset($validation_errors)) {
                                echo $validation_errors;
                            } ?>
                            <!-- <?= form_error(
                                        'kategori',
                                        ' <div class="alert alert-danger alert-dismissible" role="alert">',
                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>'
                                    ); ?> -->
                        </div>
                        <div class="col-xxl">
                            <div class="card mb-4">

                                <div class="card-header d-flex align-items-center justify-content-between m-2">
                                    <h5 class="mb-0 fw-bold"><i class='bx bx-category'></i> Kategori Buku</h5>
                                    <small class="text-muted float-end">
                                        <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#basicModal">
                                            <i class='bx bx-plus'></i>Tambah kategori
                                        </button>
                                    </small>
                                </div>
                                <div class="card-body mb-1 mt-0">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-striped">
                                            <thead class="table-secondary">
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>Kategori</th>
                                                    <th>Jumlah buku</th>
                                                    <th>Update</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0 ">
                                                <?php
                                                $no = 1;
                                                foreach ($kategori as $val) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no; ?></td>
                                                        <td><strong><?= $val->nama_kategori; ?></strong></td>
                                                        <td class="text-center"><?= $val->jumlah_buku; ?></td>
                                                        <td class="text-center"><?= format_tanggal_indonesia($val->datecreated); ?></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal1<?= $val->id_kategori; ?>">
                                                                <i class='bx bxs-edit'></i> Edit
                                                            </button>
                                                            <!-- <a href="<?= site_url('kategori/editKategori/' . $val->id_kategori) ?>" class="btn btn-warning btn-sm"> Edit</a> -->
                                                            <a href="<?= site_url('kategori/hapus_kategori/' . $val->id_kategori) ?>" class="btn btn-danger btn-sm " id="btn-hapus"><i class="bx bx-trash me-1"></i> Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- tambah -->
                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                        <form action="<?= site_url('kategori/tambah_kategori') ?>" method="post">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Form Tambah Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameBasic" class="form-label">Nama Kategori</label>
                                                <input type="text" name="kategori" class="form-control" placeholder="Masukan nama kategori..." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Batal
                                        </button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- edit -->
                    <?php
                    foreach ($kategori as $val) :
                    ?>
                        <div class="modal fade" id="basicModal1<?= $val->id_kategori; ?>" tabindex="-1" aria-hidden="true">
                            <form action="<?= site_url('kategori/edit_kategori') ?>" method="post">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Form Edit Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Nama Kategori</label>
                                                    <input type="text" name="kategori" class="form-control" value="<?= $val->nama_kategori; ?>" placeholder="Masukan nama kategori..." />
                                                    <input type="hidden" name="id_kategori" class="form-control" value="<?= $val->id_kategori; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>