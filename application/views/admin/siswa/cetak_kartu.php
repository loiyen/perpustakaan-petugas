<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Perpustakaan</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .library-card {
            width: 650px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
            text-align: center;
        }

        .card-header {
            background-color: #6366ff;
            color: white;
            padding: 10px 0;
            border-radius: 8px 8px 0 0;
            margin-left: 10px;

        }

        .card-body {
            display: flex;
            align-items: center;
            margin: 20px 0;
            margin-left: 10px;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        p {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .card-info {
            text-align: left;
            font-size: 16px;
            margin-left: 10px;
        }

        .card-info p {
            margin: 5px 0;
        }

        .card-barcode {
            margin: 20px 0;
            margin-left: 20px;
        }

        .card-footer {
            border-top: 1px solid #ccc;
            padding-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .foto {
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <div class="library-card">
        <div class="card-header">
            <h1>PERPUSTAKAAN SMA N 1 KRAYAN</h1>
        </div>
        <div class="card-body">
            <div class="foto">
                <img src="<?= URL_IMG . $data_siswa->foto_siswa; ?>" alt="foto profil" class="d-block rounded responsive" height="180" width="140" id="uploadedAvatar" />;
            </div>
            <div class="card-info">
                <p><strong>Nama :</strong> <?= $data_siswa->nama_siswa; ?></p>
                <p><strong>Nomor Kartu :</strong> <?= $data_siswa->nisn; ?></p>
                <p><strong>kelas :</strong> <?= $data_siswa->kelas_siswa; ?></p>
                <p><strong>Jenis Kelamin :</strong> <?php
                                                    if ($data_siswa->jenis_kelamin == '1') {
                                                        echo 'Laki-laki';
                                                    } else if ($data_siswa->jenis_kelamin == '2') {
                                                        echo 'Perempuan';
                                                    }
                                                    ?></p>
                <p><strong>Angkatan :</strong> <?= $data_siswa->angkatan_siswa; ?></p>

            </div>

            <div class="card-barcode">
                <img src="<?= site_url('siswa/barcode/' . $data_siswa->nisn) ?>" height="100px" alt="Barcode <?= $data_siswa->nisn; ?>">
            </div>
        </div>

        <script type="text/javascript">
            window.print();
        </script>
    </div>
</body>

</html>