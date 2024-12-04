<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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

        $data['kategori'] = $this->madmin->get_all_kategori();

        $data['title'] = 'Kategori Buku';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/kategori/Kategori_buku', $data);
        $this->load->view('Admin/layout/footer');
    }
    public function tambah_kategori()
    {

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array(
            'required' => 'Kategori Tidak Boleh Kosong!',

        ));

        if ($this->form_validation->run() == FALSE) {
            if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
                redirect('adminpanel');
            }

            $id_admin = $this->session->userdata('session_admin')['id_admin'];
            $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

            $data['kategori'] = $this->madmin->get_all_kategori();

            $data['validation_errors'] = validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> ', '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

            $data['title'] = 'Kategori Buku';
            $this->load->view('Admin/layout/header', $data);
            $this->load->view('Admin/layout/sidebar');
            $this->load->view('Admin/kategori/Kategori_buku', $data);
            $this->load->view('Admin/layout/footer');
        } else {
            $kategori = $this->input->post('kategori');

            $datainput = array(
                'nama_kategori' => $kategori,
                'datecreated' => date('Y-m-d H:i:s'),
            );
            $this->madmin->insert('tbl_kategori', $datainput);

            $this->session->set_flashdata('success', 'Tambah kategori berhasil.');
            redirect('kategori');
        }
    }
    public function edit_kategori()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }


        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array(
            'required' => 'Kategori Tidak Boleh Kosong!',
        ));


        if ($this->form_validation->run() == FALSE) {
            if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
                redirect('adminpanel');
            }

            $data['validation_errors'] = validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> ', '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

            $id_admin = $this->session->userdata('session_admin')['id_admin'];
            $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

            $data['kategori'] = $this->madmin->get_all_kategori();
            $data['title'] = 'Kategori Buku';
            $this->load->view('Admin/layout/header', $data);
            $this->load->view('Admin/layout/sidebar');
            $this->load->view('Admin/kategori/kategori_buku', $data);
            $this->load->view('Admin/layout/footer');
        } else {

            $id_kategori = $this->input->post('id_kategori');
            $kategori = $this->input->post('kategori');

            $datainput = array(
                'id_kategori' => $id_kategori,
                'nama_kategori' => $kategori,
                'datecreated' => date('Y-m-d H:i:s'),
            );

            // var_dump($datainput);
            // die;
            $this->madmin->update('tbl_kategori', $datainput, 'id_kategori', $id_kategori);
            $this->session->set_flashdata('success', 'Kategori berhasil diedit.');
            redirect('kategori');
        }
    }
    public function hapus_kategori($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }


        $this->madmin->delete('tbl_kategori', 'id_kategori', $id);

        $this->session->set_flashdata('success', 'Kategori Berhasil dihapus.');
        redirect('kategori');
    }
}
