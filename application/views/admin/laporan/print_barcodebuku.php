<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
        <h4 class="mb-5">Barcode Buku</h4>
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="row">
                    <?php foreach ($buku as $val) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-4 mb-5 ">
                            <div class="card h-100">
                                <div class=" text-center">
                                    <p class="fw-bold">PERPUSTAKAAN SMA N 1 KRAYAN</p>
                                    <p><?= $val->judul_buku; ?></p>
                                </div>
                                <div class="card">
                                    <img src="<?php echo site_url('buku/Barcode/' . $val->kode_buku) ?>" alt="Barcode <?php echo $val->kode_buku; ?>">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
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