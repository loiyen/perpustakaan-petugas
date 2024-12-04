<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Times New Roman, Times, serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 50px;
            background-color: #fff;

        }


        .header {
            text-align: center;
            margin-bottom: 20px;
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
            margin-left: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        /* th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #666666;
        } */

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
            <div class="text-center mt-5">
                <h3>Dinas Pemberdayaan Dan Kebudayaan Kabupaten Nunukan</h3>
                <h3>Laporan Peminjaman Buku Perpustakaan SMA N 1 KRAYAN</h2>
                    <p>alamat : JL. KAMPUNG BARU,RT / RW : 0 / 0 ,Kec. Krayan , Kab.
                        Nunukan , Prov. Kalimantan Utara Kode Pos : 77456</p>
            </div>

        </div>
        <hr>
        <h5 class="mt-3 mb-3 fw-bold text-center">Data Peminjaman dan Pengembalian Buku Pada <?= format_tanggal_indonesia($awal); ?> d/s <?= format_tanggal_indonesia($akhir); ?></h5>
        <div class="card mb-3 mt-3">
            <table class="table table-borderless ">
                <tr>
                    <th>Jumlah Peminjaman </th>
                    <td><?= $hitungpeminjaman; ?></td>
                </tr>
                <tr>
                    <th>Jumlah Pengembalian </th>
                    <td> <?= $hitungpeminjaman; ?></td>
                </tr>
                <tr>
                    <th>Jumlah Buku</th>
                    <td><?= $hitungbuku; ?></td>
                </tr>
                <tr>
                    <th>Jumlah siswa</th>
                    <td><?= $hitungsiswa; ?></td>
                </tr>

            </table>

        </div>
        <div>
            <table class="table table-bordered">
                <h5 class="text-center fw-bold mt-5 mb-3">PEMINJAMAN</h5>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Referensi</th>
                        <th>Nama Siswa</th>
                        <th>Total Peminjaman</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($peminjaman as $val) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $val->kode_peminjaman; ?></td>
                            <td><?= $val->nama_siswa; ?></td>
                            <td><?= $val->total_peminjaman; ?></td>
                            <td><?= format_tanggal_indonesia($val->date_pinjam); ?></td>
                            <td>
                                <?php
                                if ($val->status_pinjam == 'Selesai') {
                                    echo '<h6 style="color: green;">' . $val->status_pinjam . '</h6>';
                                } else {
                                    echo '<h6 style="color: red;">' . $val->status_pinjam . '</h6>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>

                        <th>Kode Peminjaman</th>
                        <th>Judul</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Jumlah</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($peminjamanitem as $val) : ?>
                        <tr>

                            <td><?= $val->kode_peminjaman; ?></td>
                            <td><?= $val->judul_buku; ?></td>
                            <td><?= format_tanggal_indonesia($val->tanggal_pinjam); ?></td>
                            <td><?= format_tanggal_indonesia($val->date_pinjam); ?></td>
                            <td><?= $val->jumlah_pinjam; ?></td>
                            <td><?= rupiah_format($val->denda); ?></td>
                            <td><?= $val->status; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="table table-bordered">
                <h5 class="mt-5 mb-3 fw-bold text-center">PENGEMBALIAN</h5>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pengembalian</th>
                        <th>Nama / Kelas</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Jumlah</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pengembalian as $val) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $val->kode_pengembalian; ?></td>
                            <td><?= $val->nama_siswa; ?> / <?= $val->kelas_siswa; ?></td>
                            <td><?= format_tanggal_indonesia($val->date); ?></td>
                            <td><?= $val->total_pengembalian; ?></td>
                            <td><?= rupiah_format($val->total_denda) ?></td>
                            <td><?php
                                if ($val->status == 1) {
                                    echo '<h6 >Selesai</h6>';
                                } elseif ($val->status == 2) {
                                    echo '<h6 >Belum Bayar</h6>';
                                } else {
                                    echo '<h6 >Menunggak</h6>';
                                }
                                ?></td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>

            </table>
            <table class="table table-bordered">

                <thead>
                    <tr>

                        <th>Kode Pengembalian</th>
                        <th>Judul</th>
                        <th>Kondisi Buku</th>
                        <th>Denda</th>
                        <th>Jumlah</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($pengembalianitem as $val) : ?>
                        <tr>

                            <td><?= $val->kode_pengembalian; ?></td>
                            <td><?= $val->judul_buku; ?> </td>
                            <td> <?php
                                    if ($val->kondisi_buku == 1) {
                                        echo '<h6 ">Baik</h6>';
                                    } elseif ($val->kondisi_buku == 2) {
                                        echo '<h6 >Robek / Bercoret</h6>';
                                    } elseif ($val->kondisi_buku == 3) {
                                        echo '<h6 >Hilang</h6>';
                                    }
                                    ?>
                            </td>

                            <td><?= rupiah_format($val->denda) ?></td>
                            <td><?= $val->jumlah_kembali;?></td>
                        </tr>

                    <?php endforeach; ?>
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