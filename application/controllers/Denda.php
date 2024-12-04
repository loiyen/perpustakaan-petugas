<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Denda extends CI_Controller
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

        $data['denda'] = $this->madmin->get_denda();

        $data['kode_pembayaran'] = generate_random_code();
        $data['title'] = 'Denda';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/denda/daftar_denda', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function lunas()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $data['denda'] = $this->madmin->get_denda_lunas();

        $data['kode_pembayaran'] = generate_random_code();
        $data['title'] = 'Denda';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/denda/daftar_denda_lunas', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function hapus_denda($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $this->madmin->delete('tbl_denda', 'id_denda', $id);
        $this->session->set_flashdata('success', 'Denda Berhasil dihapus');
        redirect('denda');
    }

    public function cariData()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $a = $this->input->get('awal');
        $w = $this->input->get('akhir');
      
        $data['awal'] = $this->input->get('awal');
        $data['akhir'] = $this->input->get('akhir');
       
        $data['denda'] = $this->madmin->cari_denda_siswa($a, $w);
        
        $data['title'] = 'Denda';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/denda/pencarian_denda', $data);
        $this->load->view('Admin/layout/footer', $data);
    }
}
