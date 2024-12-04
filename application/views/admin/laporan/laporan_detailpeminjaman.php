<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
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
        <h5 class="fw-bold">Data Peminjaman Buku</h5>
        <div class="card mb-2">
            <table class="table table-borderless">
                <tr>
                    <th>Kode Peminjaman</th>
                    <td><?= $peminjaman['kode_peminjaman']; ?></td>
                </tr>
                <tr>
                    <th>Nama / Kelas </th>
                    <td><?= $peminjaman['nama_siswa']; ?> / <?= $peminjaman['kelas_siswa']; ?> </td>
                </tr>
                <tr>
                    <th>Total Peminjaman</th>
                    <td><?= $peminjaman['total_peminjaman']; ?></td>
                </tr>
                <tr>
                    <th>Status Peminjaman</th>
                    <td><?= $peminjaman['status_pinjam']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?= format_tanggal_indonesia($peminjaman['datecreated']); ?></td>
                </tr>
            </table>
        </div>
        <div class="card mb-2">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Jumlah</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($item_peminjaman as $val) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $val['judul_buku']; ?></td>
                            <td><?= format_tanggal_indonesia($val['tanggal_pinjam']); ?></td>
                            <td><?= format_tanggal_indonesia($val['tanggal_kembali']); ?></td>
                            <td><?= $val['jumlah_pinjam']; ?></td>
                            <td><?= $val['denda']; ?></td>
                            <td><?= $val['status']; ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
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