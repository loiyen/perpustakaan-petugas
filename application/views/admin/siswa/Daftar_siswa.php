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
                        <?php if (isset($validation_errors)) {
                            echo $validation_errors;
                        } ?>
                        <?php
                        if (isset($notification_message)) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Perhatian!!</strong> ' . $notification_message . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        }
                        ?>

                    </div>

                    <!-- <div class="card mb-2">
                        <div class="card-body">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Data Siswa</h4>
                                <small class="text-white float-end">
                                    <button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#basicModal">
                                        <i class='bx bx-plus'></i>Daftarkan Siswa
                                    </button>
                                    <a href="<?= site_url('siswa/cetak_pdf') ?>" class="btn btn-danger  "><i class='bx bxs-download'></i></a>
                                    <a href="<?= site_url('siswa/print') ?>" class="btn btn-danger btn "><i class='bx bx-printer'></i></a>
                                </small>
                            </div>

                            <form method="get" action="<?= site_url('siswa/carisiswa') ?>">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Cari Siswa </label>
                                    <div class="input-group rounded">
                                        <input type="text" name="keyword" class="form-control rounded" placeholder="Cari nama siswa / kelas..." aria-label="Search" value="<?php echo $this->input->get('keyword'); ?>" aria-describedby="search-addon" />
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
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 fw-bold"><i class='bx bx-user'></i> DATA ANGGOTA
                            </h5>
                            <small class="text-white float-end">
                                <form method="get" action="<?= site_url('siswa/carisiswa') ?>">
                                    <div class="float-end">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                            <input type="text" name="keyword" class="form-control" placeholder="Masukan nama siswa..." aria-label="Recipient's username" aria-describedby="button-addon2" />
                                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                                            <button type="button" class="btn btn-primary m-3 fw-bold " data-bs-toggle="modal" data-bs-target="#basicModal">
                                                <i class='bx bx-plus'></i>Tambah anggota
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </small>
                        </div>
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Form Pendaftaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?= site_url('siswa/tambah_siswa') ?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Nama Siswa / Siswi</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama..." />
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Nisn</label>
                                                    <input type="text" name="nisn" class="form-control" placeholder="Masukan Nisn..." />
                                                </div>
                                            </div> -->
                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="emailBasic" class="form-label">Kelas</label>
                                                    <input type="text" name="kelas" class="form-control" placeholder="Masukan Kelas..." />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="dobBasic" class="form-label">Jurusan</label>
                                                    <input type="text" name="jurusan" class="form-control" placeholder="Masukan Jurusan : Exp. IPA / IPS" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="dobBasic" class="form-label">No HandPhone</label>
                                                    <input type="text" name="no_hp" class="form-control" placeholder="Masukan No Handphone ..." />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="defaultSelect" class="form-label">Jenis Kelamin</label>
                                                    <select id="defaultSelect" class="form-select" name="jenis_kelamin">
                                                        <option disabled selected hidden>Pilih Jenis Kelamin --</option>
                                                        <option value="1">Laki - Laki</option>
                                                        <option value="2">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="emailBasic" class="form-label">Angkatan</label>
                                                    <input type="text" name="angkatan" class="form-control" placeholder="Masukan Angkatan : Exp.2021 ..." />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Foto siswa </label>
                                                <p class="text-muted mb-0">Type file : JPG,JEPG & PNG. Maximal Size 10 Mb</p>
                                                <input class="form-control" name="gambar" type="file" id="formFile" />
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
                            <form action="<?= site_url('siswa') ?>" method="get">
                                <div class="mb-2 col-1">
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
                                            <th>Barcode</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>No Handphone</th>
                                            <th>Jenis Kelamin</th>
                                            <th></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php
                                        $items_per_page = 10;
                                        if (empty($siswa)) {
                                            echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                        } else {

                                            $start_number = ($current_page - 1) * $items_per_page + 1;
                                            foreach ($siswa as $key => $val) :
                                                $no = $start_number + $key + 0; ?>

                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger "></i><?= $no; ?></td>
                                                    <td>
                                                        <img src="<?= site_url('siswa/barcode/' . $val->nisn) ?>" alt="barcode <?= $val->nisn; ?>">
                                                    </td>
                                                    <td>
                                                        <?= $val->nama_siswa ?>
                                                        <div class="mt-2">
                                                            <span>Kode siswa :<br><strong><?= $val->nisn; ?></strong></span>
                                                        </div>

                                                    </td>
                                                    <td class="text-center"><?= $val->kelas_siswa; ?></td>
                                                    <td><?= $val->no_hp; ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($val->jenis_kelamin == '1') {
                                                            echo ' <h6>Laki - Laki </h6>';
                                                        } else {
                                                            echo ' <h6 >Perempuan </h6>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><a href="<?= site_url('siswa/detail_data/' . $val->id_siswa); ?>" class="btn btn-primary btn-sm"><i class='bx bx-show'></i></a></td>
                                                    <td>
                                                        <a href="<?= site_url('siswa/edit/' . $val->id_siswa); ?>" class="btn btn-warning btn-sm"><i class='bx bxs-edit'></i> Edit</a>
                                                        <a href="<?= site_url('siswa/hapus/' . $val->id_siswa); ?>" class="btn btn-danger btn-sm" id="btn-hapus"><i class="bx bx-trash me-1"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                        <?php $no++;
                                            endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="demo-inline-spacing">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li class="page-item <?= $current_page == 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" href="<?= base_url('index.php/siswa/index/' . max(1, $current_page - 1)) ?>"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                        </li>
                                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                            <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                <a class="page-link" href="<?= base_url('index.php/siswa/index/' . $i) ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?= $current_page == $total_pages ? 'disabled' : '' ?>">
                                            <a class="page-link" href="<?= base_url('index.php/siswa/index/' . min($total_pages, $current_page + 1)) ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>