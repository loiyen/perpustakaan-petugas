<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Siswa</title>

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

        <h4>Data Siswa / Siswi </h4>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>No Hp</th>
                    <th>Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($siswa as $val) :  ?>
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger "></i><?= $no; ?></td>
                        <td><i class="fab fa-angular fa-lg text-danger"></i> <strong><?= $val->nama_siswa ?></strong></td>
                        <td><?= $val->kelas_siswa; ?></td>
                        <td>
                            <?php
                            if ($val->jenis_kelamin == '1') {
                                echo ' <span class="badge bg-secondary">Laki - Laki </span>';
                            } else {
                                echo ' <span class="badge bg-info">Perempuan </span>';
                            }
                            ?>
                        </td>
                        <td><?= $val->jurusan_siswa; ?></td>
                        <td><?= $val->angkatan_siswa; ?></td>
                        <td><?= $val->no_hp; ?></td>
                        <td><?= format_tanggal_indonesia($val->datecreated); ?></td>
                    </tr>
                <?php $no++;
                endforeach ?>
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