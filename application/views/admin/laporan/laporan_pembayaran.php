<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            background-color: #666666;
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
            <h2>Dinas Pemberdayaan Dan Kebudayaan Kabupaten Nunukan</h2>
            <h3>Laporan Peminjaman Buku Perpustakaan SMA N 1 KRAYAN</h2>
                <p>alamat : JL. KAMPUNG BARU,RT / RW : 0 / 0 ,Kec. Krayan , Kab.
                    Nunukan , Prov. Kalimantan Utara Kode Pos : 77456</p>
        </div>
        <hr>

        <h4>Laporan Pembayaran Denda</h4>
        <p>Tanggal :<?php echo format_tanggal_indonesia($tanggal); ?></p>
        <p>Jam :<?php echo format_jam_indonesia($jam); ?></p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Judul Buku</th>
                    <th>Kelas</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($pembayaran as $val) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><strong><?= $val->nama_siswa; ?></strong></td>
                        <td><?= $val->judul_buku; ?></td>
                        <td><?= $val->kelas_buku; ?></td>
                        <td><?= rupiah_format($val->jumlah); ?></td>
                        <td><?= format_tanggal_indonesia($val->datecreated); ?></td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
        <script type="text/javascript">
            window.print();
        </script>
        <div class="footer">
            - Perpustakaan SMA N 1 KRAYAN -
        </div>
    </div>
</body>

</html>