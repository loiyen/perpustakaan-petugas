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
                    <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kategori /</span>Edit Kategori Buku</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="<?= site_url('kategori/editkategori/' . $kategori->id_kategori) ?>" method="post">
                                <div class="card mb-4">
                                    <h5 class="card-header">Form Edit</h5>
                                    <input type="hidden" class="form-control" name="id_kategori"  value="<?= $kategori->id_kategori; ?>" />
                                    <div class="card-body">
                                        <div>
                                        <?= form_error('kategori', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                            <label for="defaultFormControlInput" class="form-label">Nama kategori</label>
                                            <input type="text" class="form-control" name="kategori" id="defaultFormControlInput" value="<?= $kategori->nama_kategori; ?>" />
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                        <a href="<?= site_url('kategori')?>" class="btn btn-danger mt-3">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- / Content -->
            </div>