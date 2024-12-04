<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_code_siswa')) {
    /**
     * Generate a random code with specified length.
     *
     * @param int $length Length of the random code
     * @return string Random code
     */
    function generate_code_siswa($length = 13)
    {
        $characters = '0123456789';
        $kode = '';

        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $kode .= $characters[rand(0, $max)];
        }

        return $kode;
    }
}
