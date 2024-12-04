<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('madmin');
        $this->load->library('dompdf_lib');
    }

    public function index()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $data['admin'] = $this->madmin->get_admin();
        $data['peminjaman'] = $this->madmin->get_peminjaman_count();
        $data['pengembalian'] = $this->madmin->get_pengembalian_count();
        $data['buku'] = $this->madmin->get_buku_count();
        $data['siswa'] = $this->madmin->get_siswa_count();
        $data['kategori'] = $this->madmin->get_kategori_count();
        $data['rak'] = $this->madmin->get_rak_count();
        $data['denda'] = $this->madmin->get_denda_count();
        $data['peminjamanitem'] = $this->madmin->get_peminjamanitem_count();
        $data['pengembalianitem'] = $this->madmin->get_pengembalianitem_count();
        $data['total_bayar'] = $this->madmin->all_hitung_jumlahtotalpembayaran();
        $data['dendaall'] = $this->madmin->all_hitung_jumlahdenda();



        $data['title'] = 'Laporan';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/laporan/laporan', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function hasil_laporan()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $data['admin'] = $this->madmin->get_admin();

        $id = $this->input->get('admin');
        $a = $this->input->get('awal');
        $w = $this->input->get('akhir');

        $data['awal'] = $this->input->get('awal');
        $data['akhir'] = $this->input->get('akhir');

        $data['peminjaman'] = $this->madmin->laporan_admin_peminjaman($id, $a, $w);
        $data['pengembalian'] = $this->madmin->laporan_admin_pengembalian($id, $a, $w);
        $data['hitungpeminjaman'] = $this->madmin->hitung_jumlah_peminjamanlaporan($id, $a, $w);
        $data['hitungpengembalian'] = $this->madmin->hitung_jumlah_pengembalianlaporan($id, $a, $w);
        $data['hitungbuku'] = $this->madmin->hitung_jumlahbukulaporan($a, $w);
        $data['hitungsiswa'] = $this->madmin->hitung_jumlahsiswalaporan($a, $w);
        $data['hitungpembayaran'] = $this->madmin->hitung_jumlahpembayaran($a, $w);
        $data['total_peminjamanitem'] = $this->madmin->hitung_jumlahpeminjamanitem($a, $w);
        $data['total_pengembalianitem'] = $this->madmin->hitung_jumlahpengembalianitem($a, $w);
        $data['total_pembayaran'] = $this->madmin->hitung_jumlahtotalpembayaran($a, $w);
        $data['total_denda'] = $this->madmin->hitung_jumlahdenda($a, $w);

        $data['title'] = 'Laporan';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/laporan/laporan_admin', $data);
        $this->load->view('Admin/layout/footer', $data);
    }

    public function process_form()
    {
        $data = array(
            'id' => $this->input->post('admin'),
            'awal' => $this->input->post('awal'),
            'akhir' => $this->input->post('akhir')
        );

        redirect('laporan/hasil_laporan?admin=' . urlencode($data['id']) . '&awal=' . urlencode($data['awal']) . '&akhir=' . urlencode($data['akhir']));
    }

    // public function pdf()
    // {

    //     require_once FCPATH . 'vendor/autoload.php';

    //     $dompdf = new Dompdf();

    //     $id = $this->input->post('admin');
    //     $a = $this->input->post('awal');
    //     $w = $this->input->post('akhir');

    //     $data['awal'] = $this->input->post('awal');
    //     $data['akhir'] = $this->input->post('akhir');

    //     $data['peminjaman'] = $this->madmin->laporan_admin_peminjaman($id, $a, $w);
    //     $data['pengembalian'] = $this->madmin->laporan_admin_pengembalian($id, $a, $w);

    //     $data['hitungpeminjaman'] = $this->madmin->hitung_jumlah_peminjamanlaporan($id, $a, $w);
    //     $data['hitungpengembalian'] = $this->madmin->hitung_jumlah_pengembalianlaporan($id, $a, $w);
    //     $data['hitungbuku'] = $this->madmin->hitung_jumlahbukulaporan($a, $w);
    //     $data['hitungsiswa'] = $this->madmin->hitung_jumlahsiswalaporan($a, $w);
    //     // $data['hitungpembayaran'] = $this->madmin->hitung_jumlahpembayaranlaporan($a, $w);
    //     $data['totalpembayaran'] = $this->madmin->hitung_laporanpembayaran($a, $w);

    //     $this->load->view('Admin/laporan/pdf_laporanadmin', $data, TRUE);
    //     $dompdf->loadHtml($html);

    //     $dompdf->render();
    //     $dompdf->stream("Laporan admin.pdf", array("Attachment" => FALSE));
    // }

    public function print()
    {
        $id = $this->input->post('admin');
        $a = $this->input->post('awal');
        $w = $this->input->post('akhir');

        $data['awal'] = $this->input->post('awal');
        $data['akhir'] = $this->input->post('akhir');

        $data['peminjaman'] = $this->madmin->laporan_admin_peminjaman($id, $a, $w);
        $data['peminjamanitem'] = $this->madmin->laporan_admin_peminjamanitems($id, $a, $w);

        $data['pengembalian'] = $this->madmin->laporan_admin_pengembalian($id, $a, $w);
        $data['pengembalianitem'] = $this->madmin->laporan_admin_pengembalianitem($id, $a, $w);

        // var_dump($data['pengembalianitem']);
        // die;

        $data['hitungpeminjaman'] = $this->madmin->hitung_jumlah_peminjamanlaporan($id, $a, $w);
        $data['hitungpengembalian'] = $this->madmin->hitung_jumlah_pengembalianlaporan($id, $a, $w);
        $data['hitungbuku'] = $this->madmin->hitung_jumlahbukulaporan($a, $w);
        $data['hitungsiswa'] = $this->madmin->hitung_jumlahsiswalaporan($a, $w);
        // $data['hitungpembayaran'] = $this->madmin->hitung_jumlahpembayaranlaporan($a, $w);
        // $data['totalpembayaran'] = $this->madmin->hitung_laporanpembayaran($a, $w);

        $this->load->view('Admin/laporan/print_laporanadmin', $data);
    }

    public function print_all_laporan()
    {
        $data['tanggal'] = date('Y-m-d');

        $data['peminjaman'] = $this->madmin->get_peminjaman_count();
        $data['pengembalian'] = $this->madmin->get_pengembalian_count();
        $data['buku1'] = $this->madmin->get_buku_count();
        $data['siswa'] = $this->madmin->get_siswa_count();

        $data['anggota'] = $this->madmin->get_all_anggota();
        $data['buku'] = $this->madmin->get_all_buku();

        $this->load->view('Admin/laporan/print_all_laporan', $data);
    }
}
