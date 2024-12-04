<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayatkembali extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('madmin');
		$this->load->library('pagination');
		$this->load->helper('random_code');
	}

	public function index()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$per_page_input = $this->input->get('per_page');
		$per_page = is_numeric($per_page_input) ? intval($per_page_input) : 20;

		$config['total_rows'] = $this->madmin->countDatariwayatpengembalian();
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
		$offset = ($page - 1) * $config['per_page'];

		$data['riwayat_kembali'] = $this->madmin->get_al_riwayatpengembalian($config['per_page'], $offset);

		$data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['current_page'] = $page;
		$data['pagination'] = $this->pagination->create_links();
		$data['per_page'] = $per_page;


		$data['title'] = 'Riwayat pengembalian';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_pengembalian/daftar_pengembalian', $data);
		$this->load->view('Admin/layout/footer');
	}

	public function pengurutanData()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		if ($this->input->post('urutan')) {
			$this->session->set_userdata('urutan', $this->input->post('urutan'));
			redirect('riwayatkembali/pengurutanData');
		}

		$urutan = $this->session->userdata('urutan');

		$per_page_input = $this->input->get('per_page');
		$per_page = is_numeric($per_page_input) ? intval($per_page_input) : 10;

		$config['total_rows'] = $this->madmin->countDatariwayat();
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

		$offset = ($page - 1) * $config['per_page'];
		$data['riwayat_kembali'] = $this->madmin->sortriwayatpengembalian($urutan, $config['per_page'], $offset);

		$data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

		$data['current_page'] = $page;
		$data['pagination'] = $this->pagination->create_links();
		$data['per_page'] = $per_page;

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$data['title'] = 'Riwayat Peminjaman';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_pengembalian/pengurutan_data', $data);
		$this->load->view('Admin/layout/footer');
	}

	//cari kode
	public function cariData()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$keyword = $this->input->get('keyword');
		$data['kunci'] = $keyword;
		$data['riwayat_kembali'] = $this->madmin->search_riwayat_by_kode($keyword);

		$per_page = 10;
		$data['per_page'] = $per_page;

		$data['title'] = 'Pencarian Riwayat';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_pengembalian/pencarian_riwayat', $data);
		$this->load->view('Admin/layout/footer');
	}
	public function detail_data($id)
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$data['pengembalian'] = $this->madmin->get_pengembalian($id);
		$data['item_pengembalian'] = $this->madmin->get_detail_pengembalian_item($id);
		$data['pembayaran'] = $this->madmin->get_pembayaran($id);
		$data['total_pembayaran'] = $this->madmin->get_total_pembayaran($id);

		$data['kode_pembayaran'] = generate_random_code();

		$data['title'] = 'Detail Pengembalian';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_pengembalian/detail_pengembalian', $data);
		$this->load->view('Admin/layout/footer');
	}

	public function pembayaran_denda()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$this->form_validation->set_rules('jumlah_bayar', 'Jumlah_bayar', 'required', array(
			'required' => 'Jumlah Pembayaran Tidak Boleh Kosong!',
		));

		if ($this->form_validation->run() == false) {
			if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
				redirect('adminpanel');
			}

			$id_admin = $this->session->userdata('session_admin')['id_admin'];
			$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();


			$id = $this->input->post('id_pengembalian');

			$data['validation_errors'] = validation_errors('<div class="col-12"> <div class="alert alert-danger 
            alert-dismissible" role="alert"><strong>Gagal ! </strong>', '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div></div>');

			$data['pengembalian'] = $this->madmin->get_pengembalian($id);
			$data['item_pengembalian'] = $this->madmin->get_detail_pengembalian_item($id);

			$data['kode_pembayaran'] = generate_random_code();

			$data['title'] = 'Detail Pengembalian';
			$this->load->view('Admin/layout/header', $data);
			$this->load->view('Admin/layout/sidebar');
			$this->load->view('Admin/riwayat_pengembalian/detail_pengembalian', $data);
			$this->load->view('Admin/layout/footer');
		} else {
			$id_pengembalian = $this->input->post('id_pengembalian');
			$bayar = $this->input->post('jumlah_bayar');
			$kode_bayar = $this->input->post('kode_bayar');

			$data_denda = array(
				'id_pengembalian' => $id_pengembalian,
				'kode_pembayaran' => $kode_bayar,
				'jumlah' => $bayar,
				'date_bayar' => date('Y-m-d H:i:s')
			);

			$this->madmin->insert('tbl_denda', $data_denda);
			$data['total_pembayaran'] = $this->madmin->get_total_pembayaran_update($id_pengembalian);
			$this->session->set_flashdata('success', 'Pembayaran Berhasil!');
			redirect('riwayatkembali/detail_data/' . $id_pengembalian);
		}
	}

	public function hapus_riwayat($id)
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$this->madmin->delete('tbl_pengambalian', 'id_pengembalian', $id);
		$this->session->set_flashdata('success', 'Data Pengembalian Berhasil dihapus.');
		redirect('riwayatkembali', 'refresh');
	}

	public function print($id)
	{
		$data['pengembalian'] = $this->madmin->get_pengembalian($id);
		$data['item_pengembalian'] = $this->madmin->get_detail_pengembalian_item($id);

		$this->load->view('Admin/laporan/laporan_detailpengembalian', $data);
	}
}
