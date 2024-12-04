<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengembalian</title>
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
            max-height: 800px;
            margin: 20px auto;
            padding: 20px;
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

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
            <div class="mt-5 text-center fw-bold">
                <h3>Dinas Pemberdayaan Dan Kebudayaan Kabupaten Nunukan</h3>
                <h3>Laporan Peminjaman Buku Perpustakaan SMA N 1 KRAYAN</h2>
                    <p>alamat : JL. KAMPUNG BARU,RT / RW : 0 / 0 ,Kec. Krayan , Kab.
                        Nunukan , Prov. Kalimantan Utara Kode Pos : 77456</p>
            </div>

        </div>
        <hr>
        <h5>Data Pengembalian Buku</h5>
        <table>
            <tr>
                <th>No Pengembalian</th>
                <td><?= $pengembalian['kode_pengembalian']; ?></td>
            </tr>
            <tr>
                <th>Nama / Kelas</th>

                <td><?= $pengembalian['nama_siswa'] ?> / <?= $pengembalian['kelas_siswa'] ?> </td>
            </tr>
            <tr>
                <th>Total Pinjam</th>

                <td><?= $pengembalian['total_pengembalian'] ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>

                <td><?= format_tanggal_indonesia($pengembalian['date']) ?></td>
            </tr>
            <tr>
                <th>Total Denda</th>

                <td><?= rupiah_format($pengembalian['total_denda']) ?></td>
            </tr>
        </table>
        <h5>Daftar Buku Pengembalian</h5>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Kondisi Buku</th>
                    <th>Denda</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($item_pengembalian as $val) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $val['judul_buku']; ?></td>
                        <td><?php if ($val['kondisi_buku'] == 1) {
                                echo 'Baik';
                            } elseif ($val['kondisi_buku'] == 2) {
                                echo "Rusak / Robek";
                            } elseif ($val['kondisi_buku'] == 3) {
                                echo "Hilang";
                            }
                            ?>
                        </td>
                        <td><?= $val['denda']; ?></td>
                        <td><?= $val['jumlah_kembali']; ?></td>
                        <td> <?php
                                if ($val['status'] == 1) {
                                    echo '<span class="badge bg-success">Selesai</span>';
                                } else if ($val['status'] == 2) {
                                    echo '<span class="badge bg-warning">Belum bayar</span>';
                                } else {
                                    echo '<span class="badge bg-warning">Menunggak</span>';
                                }
                                ?></td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
        <!-- <script type="text/javascript">
            window.print();
        </script> -->
        <div class="footer">
            - Perpustakaan SMA N 1 KRAYAN -
        </div>
    </div>
</body>

</html>