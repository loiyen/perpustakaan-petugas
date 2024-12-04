<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('madmin');
    }

    public function index()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();


        $data['jumlah'] = $this->madmin->hitung_jumlah_peminjaman();
        $data['jumlahbuku'] = $this->madmin->hitung_jumlahbuku();
        $data['jumlahsiswa'] = $this->madmin->hitung_jumlahsiswa();
        $data['kategori'] = $this->madmin->hitung_jumlahkategori();
        $data['rak'] = $this->madmin->hitung_jumlahrak();
        $data['jumlahpinjam'] = $this->madmin->hitung_jumlahpinjam();
        $data['jumlahpinjamitem'] = $this->madmin->hitung_jumlahpinjamitem();
        $data['jumlahkembaliitem'] = $this->madmin->hitung_jumlahkembaliitem();
        $data['jumlahkembali'] = $this->madmin->hitung_jumlahpengembalian();
        $data['total_pembayaran'] = $this->madmin->get_total_pembayarands();

        $data['peminjaman_today'] = $this->madmin->get_peminjaman_today();
        $data['pengembalian_today'] = $this->madmin->get_pengembalian_today();
        $data['denda_today'] = $this->madmin->get_denda_today();
        $data['denda_today'] = $this->madmin->get_denda_today();
        $data['bayar_today'] = $this->madmin->get_pembayaran_today();


        $this->madmin->update_status_terlambat_otomatis();
        $this->madmin->hitung_denda_terlambat();

   
        $data['peminjaman'] = $this->madmin->get_peminjamanitemsds();
        $data['pengembalian'] = $this->madmin->get_pengembalianitemsds();
        $data['denda'] = $this->madmin->get_dendads();
      

        $data['title'] = 'Dashboard';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/Dashboard', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function Pengurutan()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $data['title'] = 'Dashboard';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/Dashboard', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function print()
    {
        $data['peminjaman'] = $this->madmin->print_peminjamanitems();
        $this->load->view('admin/laporan/laporan_detailpeminjamanitem', $data);
    }
}
