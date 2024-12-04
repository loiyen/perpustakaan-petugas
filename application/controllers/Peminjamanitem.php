<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Peminjamanitem extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('madmin');
        $this->load->library('cart');
        $this->load->library('pagination');
        $this->load->library('peminjaman_code');
        $this->load->library('dompdf_lib');
    }

    public function index()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $config['total_rows'] = $this->madmin->countpeminjaman();
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

        $offset = ($page - 1) * $config['per_page'];
        $data['peminjaman'] = $this->madmin->get_peminjamanitems($config['per_page'], $offset);
        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);


        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Peminjaman Item';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/peminjamanitem/daftar_peminjamanitems', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function Pengurutan()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $start_date = $this->input->get('awal');
        $end_date = $this->input->get('akhir');

        $data['peminjaman'] = $this->madmin->get_sorted_data($start_date, $end_date);

        $data['title'] = 'Dashboard';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/peminjamanitem/pengurutan_data', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function process_form()
    {
        $data = array(
            'awal' => $this->input->post('tanggal_awal'),
            'akhir' => $this->input->post('tanggal_akhir')
        );
        redirect('peminjamanitem/Pengurutan?&awal=' . urlencode($data['awal']) . '&akhir=' . urlencode($data['akhir']));
    }

    public function print()
    {
        $data['peminjaman'] = $this->madmin->get_peminjamanitem_print();
        $this->load->view('Admin/peminjamanitem/daftar_peminjamanitems', $data);
    }
}
