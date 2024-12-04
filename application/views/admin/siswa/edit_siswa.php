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
                        <?php $validation_errors; ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?= site_url('siswa') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-header fw-bold"><i class='bx bxs-edit'></i> Form Edit Data Anggota</h5>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card-body">
                                                <img class="card-img-top w-70 h-60 " src="<?= URL_IMG . $siswa->foto_siswa; ?>" alt="foto siswa" />
                                                <span class="card-title fw-bold"><?= $siswa->foto_siswa; ?></span>
                                                <div class="mt-1">
                                                    <label for="defaultFormControlInput" class="form-label">Kode siswa</label>
                                                    <input type="text" class="form-control" disabled id="defaultFormControlInput" value="<?= $siswa->nisn; ?>" />
                                                </div>
                                                <div class="mt-1">
                                                    <label for="defaultFormControlInput" class="form-label">Angkatan</label>
                                                    <input type="text" class="form-control" disabled id="defaultFormControlInput" value="<?= $siswa->angkatan_siswa; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col lg-6">
                                            <form action="<?= site_url('siswa/simpan_edit/' . $siswa->id_siswa) ?>" enctype="multipart/form-data" method="post">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <?= form_error('nama', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Nama lengkap</label>
                                                        <input type="text" class="form-control" name="nama" id="defaultFormControlInput" value="<?= $siswa->nama_siswa ?>" />
                                                        <input type="hidden" class="form-control" name="id_siswa" value="<?= $siswa->id_siswa ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <?= form_error('kelas', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Kelas</label>
                                                        <input type="text" class="form-control" name="kelas" id="defaultFormControlInput" value="<?= $siswa->kelas_siswa ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <?= form_error('jenis_kelamin', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Jenis kelamin</label>
                                                        <select id="jenis_kelamin" class="form-select" name="jenis_kelamin">
                                                            <option disabled hidden>Pilih Jenis Kelamin</option>
                                                            <option value="1" <?php if ($siswa->jenis_kelamin == 1) echo 'selected'; ?>>Laki - Laki</option>
                                                            <option value="2" <?php if ($siswa->jenis_kelamin == 2) echo 'selected'; ?>>Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <?= form_error('jurusan', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Jurusan</label>
                                                        <input type="text" class="form-control" name="jurusan" id="defaultFormControlInput" value="<?= $siswa->jurusan_siswa ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <?= form_error('angkatan', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">Angkatan</label>
                                                        <input type="text" class="form-control" name="angkatan" id="defaultFormControlInput" value="<?= $siswa->angkatan_siswa ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <?= form_error('no_hp', '<small class="text-danger ml-1 ">', '</small>'); ?>
                                                        <label for="defaultFormControlInput" class="form-label">No hp</label>
                                                        <input type="text" class="form-control" name="no_hp" id="defaultFormControlInput" value="<?= $siswa->no_hp; ?>" />
                                                    </div>

                                                    <div class="mb-5 mt-4">
                                                        <label for="formFile" class="form-label">Upload Foto foto</label>
                                                        <p class="text-muted mb-0">Type file : JPG,JEPG & PNG. Maximal Size 10 Mb</p>
                                                        <input class="form-control" name="gambar" type="file" id="formFile" />
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>