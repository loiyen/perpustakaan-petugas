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
                        <div class="col-lg-12 mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?= site_url('buku') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-2">
                            <div class="card h-100">
                                <img class="img-card-top w-100 h-100 " src="<?= URL_IMG . $buku->foto_buku ?>" alt="foto buku" />
                            </div>
                            <!-- <div class="row mt-2">
                                <div class="col-lg-6 col-md-6 col-sm-6  mb-2">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-header text-center">Kategori Buku</h5>
                                            <p class="text-center"><strong><i><?= $buku->nama_kategori; ?></i></strong></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-2">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-header text-center">Nama Rak</h5>
                                            <p class="text-center"><strong><i><?= $buku->nama_rak; ?></i></strong></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6  mb-2">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-header text-center">Kode Rak</h5>
                                            <p class="text-center"><strong><i><?= $buku->kode_rak; ?></i></strong></p>
                                        </div>
                                    </div>
                                </div>
                               
                            </div> -->
                        </div>

                        <div class="col-md-8 col-lg-8 mb-2">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-header">
                                        <h5><i class='bx bx-book'></i> DETAIL DATA / <?= $buku->judul_buku; ?> </h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="mb-2">
                                                <span>Judul</span>
                                                <h6><?= $buku->judul_buku; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>ISBN</span>
                                                <h6><?= $buku->isbn; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>Kelas</span>
                                                <h6><?= $buku->kelas_buku; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>Penulis</span>
                                                <h6><?= $buku->penulis_buku; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>Penerbit</span>
                                                <h6><?= $buku->penerbit_buku; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>Tahun</span>
                                                <h6><?= $buku->tahun_penerbit; ?></h6>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="mb-2">
                                                <span>Stok</span>
                                                <h6><?= $buku->stok_buku; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>Kategori</span>
                                                <h6><?= $buku->nama_kategori; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>Rak buku</span>
                                                <h6><?= $buku->nama_rak; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>Kode rak</span>
                                                <h6><?= $buku->kode_rak; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>Kode buku</span>
                                                <h6><?= $buku->kode_buku; ?></h6>
                                            </div>
                                            <div class="mb-2">
                                                <span>Barcode</span>
                                                <img class="card-img-top w-50 h-50" src="<?= site_url('buku/barcode/' . $buku->kode_buku) ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body ">
                                            <div id="container"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>