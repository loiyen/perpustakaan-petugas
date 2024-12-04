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
                    <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rak /</span>Edit Rak</h5>
                    <div class="row">

                        <div class="col-md-6">

                            <form action="<?= site_url('rak/edit/' . $rak->id_rak) ?>" method="post">
                                <div class="card mb-4">
                                    <h5 class="card-header">Form Edit</h5>
                                    <input type="hidden" class="form-control" name="id_rak" value="<?= $rak->id_rak; ?>" />
                                    <div class="card-body">
                                        <div>
                                            <?= form_error('rak', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                            <label for="defaultFormControlInput" class="form-label">Nama Rak</label>
                                            <input type="text" class="form-control" name="rak" id="defaultFormControlInput" value="<?= $rak->nama_rak; ?>" />
                                        </div>
                                        <div>
                                            <?= form_error('kode_rak', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                            <label for="defaultFormControlInput" class="form-label">Kode Rak</label>
                                            <input type="text" class="form-control" name="kode_rak" id="defaultFormControlInput" value="<?= $rak->kode_rak; ?>" />
                                        </div>
                                        <a href="<?= site_url('rak') ?>" class="btn btn-danger mt-3">Kembali</a>
                                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- / Content -->
            </div>