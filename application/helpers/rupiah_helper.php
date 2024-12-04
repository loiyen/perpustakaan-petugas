<?php
// File: application/helpers/rupiah_helper.php

if (!function_exists('rupiah_format')) {
    function rupiah_format($angka)
    {
        // Periksa apakah $angka adalah null
        if ($angka === null) {
            return 'Rp.0'; // Jika null, kembalikan string kosong atau nilai default lainnya
        }

        // Jika $angka bukan null, panggil number_format() seperti biasa
        $rupiah = number_format($angka, 0, ',', '.');
        return 'Rp ' . $rupiah;
    }
}
