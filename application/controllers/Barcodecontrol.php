<?php
// application/controllers/Barcodecontrol.php
defined('BASEPATH') or exit('No direct script access allowed');

class Barcodecontrol extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('madmin');
        $this->load->library('book_code');
        $this->load->library('pagination');
        $this->load->library('dompdf_lib');
    }

    public function index()
    {
        // Mendapatkan semua data buku
        $data['buku'] = $this->madmin->get_all_buku();

        // Menampilkan barcode untuk setiap kode buku
        foreach ($data['buku'] as $buku) {
            $data = $this->set_barcode($buku->kode_buku);
        }
    }

    private function set_barcode($code)
    {
        // Load library
        $this->load->library('Zend');

        // Load in folder Zend
        $this->zend->load('Zend/Barcode');

        // Generate barcode
        Zend_Barcode::render('code128', 'image', array('text' => $code), array());
    }
}
