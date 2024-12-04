<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">


        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <?php

            use PhpParser\Node\Stmt\Echo_;

            $this->load->view('Admin/layout/navbar');
            ?>


            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <?php if (isset($validation_errors)) {
                            echo $validation_errors;
                        } ?>
                    </div>
                    <!-- <div class="card mb-4">
                        <div class="card-body">
                            <form method="get" action="<?= site_url('buku/pencarian_buku') ?>">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Cari Buku Perpustakaan </label>
                                    <div class="input-group rounded">

                                        <span class="input-group-text border-0" id="search-addon">
                                            <i class="bx bx-search fs-4 lh-0"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->
                    <div class="card">
                        <?= $this->session->flashdata('not'); ?>
                        <div class="card-header">
                            <a href="<?= site_url('buku') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                        </div>
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 fw-bold"><i class='bx bx-book'></i> DATA BUKU</h5>
                            <small class="float-end">
                                <form method="get" action="<?= site_url('buku/pencarian_buku') ?>">
                                    <div class="float-end">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                            <input type="text" name="keyword" class="form-control" placeholder="Cari judul / kode buku ..." aria-label="Recipient's username" aria-describedby="button-addon2" />

                                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                                            <button type="button" class="btn btn-primary m-3 fw-bold" data-bs-toggle="modal" data-bs-target="#basicModal">
                                                <i class='bx bx-plus'></i>Tambah buku
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- <a href="<?= site_url('buku/cetak_pdf') ?>" class="btn btn-danger btn-sm "><i class='bx bxs-download'></i></a>
                                <a href="<?= site_url('buku/print') ?>" class="btn btn-danger btn-sm "><i class='bx bx-printer'></i></a> -->
                            </small>
                        </div>

                        <!-- Modal -->
                         <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                            <form action="<?= site_url('buku/tambah_buku') ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Form Tambah Buku</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="defaultSelect" class="form-label">Kategori Buku</label>
                                                <select id="defaultSelect" class="form-select" name="kategori" required>
                                                    <option disabled selected hidden>Pilih Kategori Buku --</option>
                                                    <?php foreach ($kategori as $val) : ?>
                                                        <option value="<?= $val->id_kategori ?>"><?= $val->nama_kategori; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nameBasic" class="form-label">Judul Buku</label>
                                                <input type="text" name="judul" class="form-control" placeholder="Masukan Judul Buku..." value="<?php echo isset($input_values['judul']) ? $input_values['judul'] : ''; ?>" />

                                            </div>

                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="defaultSelect" class="form-label">Rak Buku</label>
                                                    <select id="defaultSelect" class="form-select" name="rak" required>
                                                        <option disabled selected hidden>Pilih Rak Buku --</option>
                                                        <?php foreach ($rak as $val) : ?>
                                                            <option value="<?= $val->id_rak ?>"><?= $val->nama_rak; ?> / <?= $val->kode_rak; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Kelas</label>
                                                    <input type="text" name="kelas" class="form-control" placeholder="Masukan Kelas Buku..." value="<?php echo isset($input_values['kelas']) ? $input_values['kelas'] : ''; ?>" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="emailBasic" class="form-label">Penulis</label>
                                                    <input type="text" name="penulis" class="form-control" placeholder="Masukan Nama Penulis..." value="<?php echo isset($input_values['penulis']) ? $input_values['penulis'] : ''; ?>" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="dobBasic" class="form-label">Penerbit</label>
                                                    <input type="text" name="penerbit" class="form-control" placeholder="Masukan Nama Penerbit..." value="<?php echo isset($input_values['penerbit']) ? $input_values['penerbit'] : ''; ?>" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="emailBasic" class="form-label">Tahun Terbit</label>
                                                    <input type="text" name="tahun" class="form-control" placeholder="Masukan Terbit : Exp 2020/2022/... " value="<?php echo isset($input_values['tahun']) ? $input_values['tahun'] : ''; ?>" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="dobBasic" class="form-label">Stok / Tersedia</label>
                                                    <input type="text" name="stok" class="form-control" placeholder="Masukan Jumlah Stok Buku... " value="<?php echo isset($input_values['stok']) ? $input_values['stok'] : ''; ?>" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Foto Buku </label>
                                                <p class="text-muted mb-0">Type file : JPG,JEPG & PNG. Maximal Size 10 Mb</p>
                                                <input class="form-control" name="gambar" type="file" id="formFile" />
                                            </div>
                                            <div class="mb-1">
                                                <h6>Scan ISBN Buku</h6>
                                                <div class="form-floating">
                                                    <input type="text" name="isbn" class="form-control" placeholder="Scan ISBN Buku... " value="<?php echo isset($input_values['isbn']) ? $input_values['isbn'] : ''; ?>" />
                                                    <label for="floatingInput">Nomor ISBN</label>
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

                        <div class="card-body mt-0">
                            <h5 class="card-title text-center ">-- Pencarian <i>" <?= $kunci ?> "</i> --</h5>
                            <form action="<?= site_url('buku') ?>" method="get">
                                <div class="mb-2 col-lg-1 col-md-1">
                                    <label for="exampleFormControlInput1" class="form-label">Dari : </label>
                                    <input type="number" name="per_page" class="form-control" placeholder="10" />
                                    <button hidden type="submit"></button>
                                </div>
                            </form>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>barcode</th>
                                            <th class="col-3">Judul Buku</th>
                                            <th>Kategori</th>
                                            <th>rak</th>
                                            <th>Jumlah</th>
                                            <th></th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php
                                        $items_per_page = 10;
                                        if (empty($buku)) {
                                            echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                        } else {
                                            $start_number = 1;
                                            foreach ($buku as $key => $val) :
                                                $no = $start_number + $key + 0; ?>
                                                <tr>
                                                    <td><i class="fab fa-angular fa-sm text-danger"></i> <?= $no; ?>.</td>
                                                    <td>
                                                        <img src="<?php echo site_url('buku/Barcode/' . $val->kode_buku) ?>" alt="Barcode <?php echo $val->kode_buku; ?>">
                                                    </td>
                                                    <td><strong><?= $val->judul_buku; ?></strong>
                                                        <div class="mt-2">
                                                            <span>Kode buku :<br><strong><?= $val->kode_buku; ?></strong></span>
                                                        </div>
                                                    </td>
                                                    <td><?= $val->nama_kategori; ?></td>
                                                    <td><?= $val->nama_rak; ?> | <?= $val->kode_rak; ?> </td>
                                                    <td class="text-center"><?= $val->stok_buku; ?></td>
                                                    <td>
                                                        <a href="<?= site_url('buku/detail_Buku/' . $val->id_buku) ?>" class="btn btn-primary btn-sm"><i class='bx bx-show'></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= site_url('buku/editBuku/' . $val->id_buku) ?>" class="btn btn-warning btn-sm"><i class='bx bxs-edit'></i> Edit</a>
                                                        <a href="<?= site_url('buku/hapus_buku/' . $val->id_buku) ?>" class="btn btn-danger btn-sm" id="btn-hapus"><i class="bx bx-trash me-1"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $no++;
                                            endforeach;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- / Content -->
            </div>