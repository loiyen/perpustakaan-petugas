<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjamansiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('msiswa');
        $this->load->model('madmin');
    }

    public function index()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $id = $data['user']['id_siswa'];

        $config['total_rows'] = $this->msiswa->countDatariwayatpeminjaman($id);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;


        $offset = ($page - 1) * $config['per_page'];
        $data['riwayat'] = $this->msiswa->get_data_peminjaman($id, $config['per_page'], $offset);
        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);


        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Peminjaman Siswa';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/peminjamansiswa/daftar_peminjaman', $data);
        $this->load->view('siswa/layout/footer');
    }

    public function peminjamanitem($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $data['riwayat'] = $this->madmin->get_detail_peminjaman($id);

        $data['title'] = 'Detail Peminjaman';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/peminjamansiswa/detail_riwayat_peminjaman', $data);
        $this->load->view('siswa/layout/footer');
    }
}
