<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_code
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function generate_code()
    {
        $today = date('Ymd'); // Mendapatkan tanggal hari ini dalam format YYYYMMDD
        $query = $this->CI->db->query("SELECT MAX(kode_peminjaman) as max_id FROM tbl_peminjaman WHERE kode_peminjaman LIKE '$today%'");
        $row = $query->row();
        $max_id = $row->max_id;

        if (!$max_id) {
            return $today . '01'; // Jika tidak ada kode peminjaman, mulai dari tahun ini, tanggal hari ini, dan nomor urut 01
        }

        // Mendapatkan nomor urut dari kode peminjaman terakhir di hari ini
        $last_code_number = intval(substr($max_id, 8)); // Mengambil angka dari indeks 8 ke depan

        // Membuat nomor urut untuk kode peminjaman berikutnya
        $new_code_number = $last_code_number + 1;
        $new_code = $today . sprintf('%02d', $new_code_number); // Menggunakan sprintf untuk format nomor dengan leading zero

        return $new_code;
    }
}
