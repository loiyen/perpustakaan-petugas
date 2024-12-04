<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            ,PERPUSTAKAN SMAN 1 KRAYAN
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>


<!-- / Layout wrapper -->

<!-- <div class="buy-now">
    <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank" class="btn btn-danger btn-buy-now">Customer Service Web</a>
</div> -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?php echo base_url('asset/assets/vendor/libs/jquery/jquery.js') ?>"></script>
<script src="<?php echo base_url('asset/assets/vendor/libs/popper/popper.js') ?>"></script>
<script src="<?php echo base_url('asset/assets/vendor/js/bootstrap.js') ?>"></script>
<script src="<?php echo base_url('asset/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

<script src="<?php echo base_url('asset/assets/vendor/js/menu.js') ?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?php echo base_url('asset/assets/vendor/libs/apex-charts/apexcharts.js') ?>"></script>

<!-- Main JS -->
<script src="<?php echo base_url('asset/assets/js/main.js') ?>"></script>

<!-- Page JS -->
<script src="<?php echo base_url('asset/assets/js/dashboards-analytics.js') ?>"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="<?php echo base_url('asset/assets/js/js/sweetalert2.all.min.js') ?>"></script>
<script src="<?php echo base_url('asset/assets/js/myjs') ?>"></script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($this->session->flashdata('success')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('success')) ?>;
        Swal.fire({
            title: 'Berhasil! ',
            text: isi,
            icon: 'success',
        })
    <?php } ?>
</script>

<script>
    $(document).on('click', '#btn-hapus', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = link;
            }
        });
    })
</script>

<!-- chart data buku -->
<script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Data Rincian Buku'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,

            data: [{
                    name: 'Peminjaman',
                    y: <?= $peminjaman; ?>
                },
                {
                    name: 'Pengembalian',
                    y: <?= $pengembalian; ?>
                },
                {
                    name: 'Hilang',
                    y: <?= $hilang; ?>
                },
                {
                    name: 'Rusak / Sobek',
                    y: <?= $rusak; ?>
                },
                {
                    name: 'Belum kembali',
                    y: <?= $belumkembali; ?>
                },
                {
                    name: 'Terlambat',
                    y: <?= $terlambat; ?>
                },
            ]

        }]
    });
</script>

<!-- chart data laporan -->
<script type="text/javascript">
    Highcharts.chart('container1', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Data Perpustakaan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,

            data: [{
                    name: 'Peminjaman',
                    y: <?= $hitungpeminjaman; ?>
                },
                {
                    name: 'Pengembalian',
                    y: <?= $hitungpengembalian; ?>
                },
                {
                    name: 'Buku',
                    y: <?= $hitungbuku; ?>
                },
                {
                    name: 'Siswa',
                    y: <?= $hitungsiswa; ?>
                },
                {
                    name: 'Pembayaran',
                    y: <?= $hitungpembayaran; ?>
                },

            ]

        }]
    });
</script>

<!-- chart data laporan -->
<script type="text/javascript">
    Highcharts.chart('container3', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Data Perpustakaan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,

            data: [{
                    name: 'Peminjaman',
                    y: <?= $peminjaman; ?>
                },
                {
                    name: 'Pengembalian',
                    y: <?= $pengembalian;?>
                },
                {
                    name: 'Buku',
                    y: <?= $buku; ?>
                },
                {
                    name: 'Siswa',
                    y: <?= $siswa; ?>
                },
                {
                    name: 'Pembayaran',
                    y: <?= $denda; ?>
                },

            ]

        }]
    });
</script>














</body>

</html>