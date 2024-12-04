<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Dompdf_lib
{

    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        require_once FCPATH . 'vendor/autoload.php';
    }

    public function generate_pdf($html, $filename = 'Laporan Peminjaman.pdf', $paper = 'A1', $orientation = 'portrait')
    {
        // Load DOMPDF
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper($paper, $orientation);

        // Render HTML to PDF
        $dompdf->render();

        // Output PDF (stream or save)
        $dompdf->stream($filename, array("Attachment" => FALSE));
    }
}
