<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            font-family: Times New Roman, Times, serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;

        }

        .header {

            margin-bottom: 15px;
        }

        .header img {
            width: 100px;
            height: auto;
        }

        h1 {
            color: #333;
            margin-bottom: 1px;
            font-size: 17xp;
        }

        p {
            font-size: 12px;
        }

        /* table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        } */

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #C0C0C0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #8d7d7d;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="mt-5 text-center fw-bod">
                <h3>Dinas Pemberdayaan Dan Kebudayaan Kabupaten Nunukan</h3>
                <h3>Laporan Peminjaman Buku Perpustakaan SMA N 1 KRAYAN</h2>
                    <p>alamat : JL. KAMPUNG BARU,RT / RW : 0 / 0 ,Kec. Krayan , Kab.
                        Nunukan , Prov. Kalimantan Utara Kode Pos : 77456</p>
            </div>
        </div>
        <hr>
        <h5 class="text-center fw-bold">Rekapan Data Perpustakaan </h5>
        <p class="text-center fw-bold"><?= format_tanggal_indonesia($tanggal); ?></p>
        <div class="row mt-4 mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        Jumlah Anggota : <?= $siswa; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        Jumlah Buku : <?= $buku1;?>
                    </div>
                </div>
            </div>
           
           

        </div>
        <div class="row">
            <div class="card-header text-center">
                <h5>Data anggota</h5>
            </div>
            <table class="table">
                <thead class="table-secondary">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th>No Handphone</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php

                    if (empty($anggota)) {
                        echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                    } else {

                        $no = 1;
                        foreach ($anggota as  $val) :
                    ?>
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger "></i><?= $no; ?></td>
                                <td><img width="70" height="80" src="<?= URL_IMG . $val->foto_siswa; ?>" alt=""></td>

                                <td>
                                    <?= $val->nama_siswa ?>
                                    <div class="mt-2">
                                        <span>Kode siswa :<br><strong><?= $val->nisn; ?></strong></span>
                                    </div>

                                </td>
                                <td class="text-center"><?= $val->kelas_siswa; ?></td>
                                <td class="text-center"><?= $val->jurusan_siswa; ?></td>
                                <td class="text-center"><?= $val->angkatan_siswa; ?></td>
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

                            </tr>
                    <?php $no++;
                        endforeach;
                    } ?>
                </tbody>
            </table>

        </div>
        <div class="row">
            <div class="card-header text-center">
                <h5>Data buku</h5>
            </div>
            <table class="table">
                <thead class="table-secondary">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Kode buku</th>
                        <th>Judul</th>
                        <th>Kelas</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Kategori</th>
                        <th>Rak</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php

                    if (empty($buku)) {
                        echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                    } else {

                        $no = 1;
                        foreach ($buku as  $val) :
                    ?>
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger "></i><?= $no; ?></td>
                                <td><?= $val->kode_buku ?></td>

                                <td>
                                    <?= $val->judul_buku ?>
                                    <div class="mt-2">
                                        <span>Kode ISBN :<br><strong><?= $val->isbn; ?></strong></span>
                                    </div>

                                </td>
                                <td ><?= $val->kelas_buku; ?></td>
                                <td ><?= $val->penulis_buku; ?></td>
                                <td ><?= $val->penerbit_buku; ?></td>
                                <td><?= $val->tahun_penerbit; ?></td>
                                <td class="text-center">
                                    <?= $val->stok_buku; ?>
                                </td>
                                <td >
                                    <?= $val->nama_kategori; ?>
                                </td>
                                <td >
                                    <?= $val->nama_rak; ?>
                                </td>

                            </tr>
                    <?php $no++;
                        endforeach;
                    } ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            window.print();
        </script>
        <div class="footer">
            - Perpustakaan SMA N 1 KRAYAN -
        </div>
    </div>
</body>

</html>