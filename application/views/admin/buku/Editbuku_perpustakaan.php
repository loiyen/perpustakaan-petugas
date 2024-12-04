<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">


        <!-- Layout container -->
        <div class="layout-page">
            <?php
            $this->load->view('Admin/layout/navbar');
            ?>


            <div class="content-wrapper">

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?= site_url('buku') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-header fw-bold"><i class='bx bxs-edit'></i> Form Edit Buku</h5>
                                  
                                    <div class="row">
                                        <div class="col-lg-4">

                                            <div class="card-body">
                                                <img class="card-img-top w-70 h-60 " src="<?= base_url('asset/fotobuku/' . $buku->foto_buku) ?>" alt="foto buku" />
                                                <span class="card-title fw-bold"><?= $buku->foto_buku; ?></span>
                                                <div class="mt-3">
                                                    <label for="defaultFormControlInput" class="form-label">Kode Buku</label>
                                                    <input type="text" disabled class="form-control" id="defaultFormControlInput" value="<?= $buku->kode_buku; ?>" />
                                                    <input type="hidden" class="form-control" name="id_buku" id="defaultFormControlInput" value="<?= $buku->id_buku; ?>" />
                                                </div>
                                                <div class="mt-1">
                                                    <label for="defaultFormControlInput" class="form-label">ISBN</label>
                                                    <input type="text" class="form-control" disabled id="defaultFormControlInput" value="<?= $buku->isbn; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col lg-6">
                                            <form action="<?= site_url('buku/edit_buku/' . $buku->id_buku) ?>" enctype="multipart/form-data" method="post">
                                                <div class="card-body">
                                                    <div class="">
                                                        <label for="defaultSelect" class="form-label">Kategori Buku</label>
                                                        <select id="defaultSelect" class="form-select" name="kategori" required>
                                                            <option disabled selected hidden>Pilih Kategori Buku --</option>
                                                            <?php foreach ($kategori as $val) { ?>
                                                                <option value="<?php echo $val->id_kategori; ?>" <?php if ($val->id_kategori == $buku->id_kategori) echo 'selected'; ?>>
                                                                    <?php echo $val->nama_kategori; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <?= form_error('judul', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Judul Buku</label>
                                                        <input type="text" class="form-control" name="judul" id="defaultFormControlInput" value="<?= $buku->judul_buku; ?>" />
                                                        <input type="hidden" class="form-control" name="id_buku" id="defaultFormControlInput" value="<?= $buku->id_buku; ?>" />
                                                    </div>
                                                    <div>
                                                        <?= form_error('kelas', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Kelas</label>
                                                        <input type="text" class="form-control" name="kelas" id="defaultFormControlInput" value="<?= $buku->kelas_buku; ?>" />
                                                    </div>
                                                    <div>
                                                        <?= form_error('penulis', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Penulis</label>
                                                        <textarea type="text" class="form-control" name="penulis" id="defaultFormControlInput"><?= $buku->penulis_buku; ?></textarea>
                                                    </div>
                                                    <div>
                                                        <?= form_error('penerbit', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Penerbit</label>
                                                        <textarea type="text" class="form-control" name="penerbit" id="defaultFormControlInput"><?= $buku->penerbit_buku; ?></textarea>
                                                    </div>
                                                    <div>
                                                        <?= form_error('tahun', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Tahun</label>
                                                        <input type="text" class="form-control" name="tahun" id="defaultFormControlInput" value="<?= $buku->tahun_penerbit; ?>" />
                                                    </div>
                                                    <div>
                                                        <?= form_error('stok', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Stok / Tersedia </label>
                                                        <input type="text" class="form-control" name="stok" id="defaultFormControlInput" value="<?= $buku->stok_buku; ?>" />
                                                    </div>
                                                    <div class="mb-2 mt-2">
                                                        <label for="formFile" class="form-label">Upload Foto Buku</label>
                                                        <p class="text-muted mb-0">Type file : JPG,JEPG & PNG. Maximal Size 10 Mb</p>
                                                        <input class="form-control" name="gambar" type="file" id="formFile" />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>