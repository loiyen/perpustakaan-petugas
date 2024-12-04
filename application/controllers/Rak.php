<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Rak extends CI_Controller
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

        $data['rak'] = $this->madmin->get_all_rak();

        $data['title'] = 'Rak Buku';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/rak/rak_buku', $data);
        $this->load->view('Admin/layout/footer');
    }
    public function tambah_rak()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $this->form_validation->set_rules('rak', 'Rak', 'required', array(
            'required' => 'Masukan nama rak anda'
        ));

        $this->form_validation->set_rules('kode_rak', 'Kode_rak', 'required', array(
            'required' => 'Masukan kode rak anda'
        ));

        if ($this->form_validation->run() == FALSE) {
            if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
                redirect('adminpanel');
            }

            $id_admin = $this->session->userdata('session_admin')['id_admin'];
            $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

            $data['rak'] = $this->madmin->get_all_rak();

            $data['validation_errors'] = validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> ', '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');


            $data['title'] = 'Rak Buku';
            $this->load->view('Admin/layout/header', $data);
            $this->load->view('Admin/layout/sidebar');
            $this->load->view('Admin/rak/rak_buku', $data);
            $this->load->view('Admin/layout/footer');
        } else {
            $rak = $this->input->post('rak');
            $kode_rak = $this->input->post('kode_rak');

            $datainput = array(
                'nama_rak' => $rak,
                'kode_rak' => $kode_rak,
                'datecreated' => date('Y-m-d H:i:s')
            );

            $this->madmin->insert('tbl_rak', $datainput);
            $this->session->set_flashdata('success', 'Tambah Rak Buku Berhasil');
            redirect('rak', 'refersh');
        }
    }

    public function edit_rak()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $this->form_validation->set_rules('rak', 'Rak', 'required', array(
            'required' => 'Nama Rak Tidak Boleh Kosong!',
        ));
        $this->form_validation->set_rules('kode_rak', 'Kode_rak', 'required', array(
            'required' => 'Kode Rak Tidak Boleh Kosong!',
        ));
        if ($this->form_validation->run() == FALSE) {
            if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
                redirect('adminpanel');
            }

            $id_admin = $this->session->userdata('session_admin')['id_admin'];
            $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

            $data['validation_errors'] = validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> ', '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

            $data['rak'] = $this->madmin->get_all_rak();

            $data['title'] = 'Edit Buku';
            $this->load->view('Admin/layout/header', $data);
            $this->load->view('Admin/layout/sidebar');
            $this->load->view('Admin/rak/rak_buku', $data);
            $this->load->view('Admin/layout/footer');
        } else {
            $id = $this->input->post('id_rak');
            $rak = $this->input->post('rak');
            $kode_rak = $this->input->post('kode_rak');

            $datainput = array(
                'nama_rak' => $rak,
                'kode_rak' => $kode_rak,
                'datecreated' => date('Y-m-d H:i:s')
            );
            $this->madmin->update('tbl_rak', $datainput, 'id_rak', $id);
            $this->session->set_flashdata('success', 'Edit Rak Buku Berhasil');
            redirect('rak', 'refersh');
        }
    }

    public function hapus($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $this->madmin->delete('tbl_rak', 'id_rak', $id);
        $this->session->set_flashdata('success', 'Hapus Rak Berhasil!');
        redirect('rak', 'refersh');
    }
}
