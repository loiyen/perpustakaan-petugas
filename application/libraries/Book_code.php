<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book_code
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function generate_code()
    {
        // Awalan tetap "241456"
        $prefix = '241456';

        // Mendapatkan bagian acak dari kode (6 digit)
        $random_number = mt_rand(100000, 999999);

        // Menggabungkan awalan dan angka acak
        $new_code = $prefix . $random_number;

        return $new_code;
    }
}
