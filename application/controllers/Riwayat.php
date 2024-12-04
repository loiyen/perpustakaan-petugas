<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('madmin');
		$this->load->library('pagination');
	}

	public function index()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$per_page_input = $this->input->get('per_page');
		$per_page = is_numeric($per_page_input) ? intval($per_page_input) : 20;

		$config['total_rows'] = $this->madmin->countDatariwayat();
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);

		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

		$offset = ($page - 1) * $config['per_page'];

		$data['riwayat'] = $this->madmin->get_peminjaman_info($config['per_page'], $offset);

		$data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['current_page'] = $page;
		$data['pagination'] = $this->pagination->create_links();
		$data['per_page'] = $per_page;

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$data['title'] = 'Riwayat Peminjaman';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_peminjaman/daftar_riwayat', $data);
		$this->load->view('Admin/layout/footer');
	}

	public function detail_riwayat($id)
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$data['peminjaman'] = $this->madmin->get_peminjaman($id);

		$data['item_peminjaman'] = $this->madmin->get_detail_peminjaman_item($id);

		$data['title'] = 'Detail Peminjaman';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_peminjaman/detail_riwayat_peminjaman', $data);
		$this->load->view('Admin/layout/footer');
	}
	public function perpanjangan()
	{
		$id = $this->input->post('id_peminjamanitems');
		$tambah = $this->input->post('tanggal_tambah');
		// var_dump($id);
		// die;
		$this->db->set('tanggal_kembali', $tambah);
		$this->db->where('id_peminjamanitems', $id);
		$this->db->update('tbl_peminjamanitems');
		$this->session->set_flashdata('success', 'Buku berhasil diperpanjang');
		redirect('riwayat');
	}




	public function pengurutanData()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		if ($this->input->post('urutan')) {
			$this->session->set_userdata('urutan', $this->input->post('urutan'));
			redirect('riwayat/pengurutanData');
		}

		$per_page_input = $this->input->get('per_page');
		$per_page = is_numeric($per_page_input) ? intval($per_page_input) : 10;

		$urutan = $this->session->userdata('urutan');

		$config['total_rows'] = $this->madmin->countDatariwayat();
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

		$offset = ($page - 1) * $config['per_page'];
		$data['riwayat'] = $this->madmin->sortriwayat($urutan, $config['per_page'], $offset);
		// var_dump($data['riwayat']);
		// die;
		$data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['per_page'] = $per_page;

		$data['current_page'] = $page;
		$data['pagination'] = $this->pagination->create_links();


		$data['title'] = 'Riwayat Peminjaman';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_peminjaman/pengurutan_data', $data);
		$this->load->view('Admin/layout/footer');
	}
	//pencarian riwayat
	public function cariData()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$keyword = $this->input->get('keyword');
		$data['kunci'] = $keyword;
		$data['riwayat'] = $this->madmin->search_peminjaman_by_kode($keyword);
		$per_page = 10;
		$data['per_page'] = $per_page;

		$data['title'] = 'Pencarian Riwayat';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_peminjaman/pencarian_riwayat', $data);
		$this->load->view('Admin/layout/footer');
	}

	public function update_status_terlambat_otomatis()
	{

		$this->madmin->update_status_terlambat_otomatis();
		$this->madmin->hitung_denda_terlambat();

		$this->session->set_flashdata('success', 'Riwayat Berhasil Diperbaharui');
		redirect('riwayat');
	}

	public function hapus_riwayat($id)
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$this->madmin->delete('tbl_peminjaman', 'id_peminjaman', $id);
		$this->session->set_flashdata('success', 'Data Peminjaman Berhasil dihapus.');
		redirect('riwayat', 'refresh');
	}

	public function print($id)
	{

		$data['peminjaman'] = $this->madmin->get_peminjaman($id);
		$data['item_peminjaman'] = $this->madmin->get_detail_peminjaman_item($id);

		$this->load->view('Admin/laporan/laporan_detailpeminjaman', $data);
	}
}
