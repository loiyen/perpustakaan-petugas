<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('format_tanggal_indonesia')) {
    function format_tanggal_indonesia($datetime) {
        $bulan = array(
            'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        );

        $tanggal = date('d', strtotime($datetime));
        $nama_bulan = $bulan[date('n', strtotime($datetime)) - 1];
        $tahun = date('Y', strtotime($datetime));

        return $tanggal . ' ' . $nama_bulan . ' ' . $tahun;
    }
}
?>
