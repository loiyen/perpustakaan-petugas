<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Buku</title>

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
          
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Dinas Pemberdayaan Dan Kebudayaan Kabupaten Nunukan</h2>
            <h3>Laporan Data   Buku Perpustakaan SMA N 1 KRAYAN</h2>
                <p>alamat : JL. KAMPUNG BARU,RT / RW : 0 / 0 ,Kec. Krayan , Kab.
                    Nunukan , Prov. Kalimantan Utara Kode Pos : 77456</p>
        </div>
        <hr>
        <h4>Data Buku Perpustakaan </h4>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>ISBN</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Kelas</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Nama Rak</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                $no = 1;
                foreach ($buku as $val) : ?>
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <?= $no; ?>.</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><i><?= $val->isbn; ?></i></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $val->kode_buku; ?></strong></td>
                        <td> <strong><?= $val->judul_buku; ?></strong></td>
                        <td><?= $val->kelas_buku; ?></td>
                        <td><?= $val->penerbit_buku; ?></td>
                        <td><?= $val->tahun_penerbit; ?></td>
                        <td><?= $val->stok_buku; ?></td>
                        <td><?= $val->nama_kategori; ?></td>
                        <td><?= $val->nama_rak; ?> / <?= $val->kode_rak; ?> </td>
                    </tr>
                <?php
                    $no++;
                endforeach;
                ?>
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