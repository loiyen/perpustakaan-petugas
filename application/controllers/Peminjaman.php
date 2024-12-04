<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use FontLib\Table\Type\post;

class Peminjaman extends CI_Controller
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

		$data['data_siswa'] = $this->session->userdata('siswa_data');
		$data['data_buku'] = $this->session->userdata('buku_data');

		$tanggal_hari_ini = date('Y-m-d');
		$tanggal_5_hari_ke_depan = date('Y-m-d', strtotime('+5 days'));
		$data['tanggal_hari_ini'] = $tanggal_hari_ini;
		$data['tanggal_5_hari_ke_depan'] = $tanggal_5_hari_ke_depan;

		$data['kode_pinjam'] = $this->peminjaman_code->generate_code();

		$data['title'] = 'Peminjaman';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/peminjaman_buku/peminjaman', $data);
		$this->load->view('Admin/layout/footer');
	}
	// public function peminjaman_pribadi()
	// {
	// 	if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
	// 		redirect('adminpanel');
	// 	}

	// 	$id_admin = $this->session->userdata('session_admin')['id_admin'];
	// 	$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

	// 	$data['data_siswa'] = $this->session->userdata('siswa_data');
	// 	$data['data_buku'] = $this->session->userdata('buku_data');

	// 	$tanggal_hari_ini = date('Y-m-d');
	// 	$tanggal_5_hari_ke_depan = date('Y-m-d', strtotime('+5 days'));
	// 	$data['tanggal_hari_ini'] = $tanggal_hari_ini;
	// 	$data['tanggal_5_hari_ke_depan'] = $tanggal_5_hari_ke_depan;

	// 	$data['kode_pinjam'] = $this->peminjaman_code->generate_code();

	// 	$data['title'] = 'Peminjaman';
	// 	$this->load->view('Admin/layout/header', $data);
	// 	$this->load->view('Admin/layout/sidebar');
	// 	$this->load->view('Admin/peminjaman_buku/peminjaman', $data);
	// 	$this->load->view('Admin/layout/footer');
	// }

	public function add_session_siswa()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$kode_siswa = $this->input->post('kode_siswa');
		$siswa = $this->madmin->get_data_by_idsiswa($kode_siswa);

		if ($siswa) {
			$session_data = array(
				'id_siswa' => $siswa->id_siswa,
				'nama_siswa' => $siswa->nama_siswa,
				'kelas' => $siswa->kelas_siswa,
				'jurusan' => $siswa->jurusan_siswa,
				'jenis_kelamin' => $siswa->jenis_kelamin,
				'no_hp' => $siswa->no_hp,
				'foto' => $siswa->foto_siswa,
				'kode_siswa' => $siswa->nisn
			);

			$this->session->set_userdata('siswa_data', $session_data);
			redirect('peminjaman', 'refersh');
		} else {
			$error_message = "Siswa dengan kode akses ' $kode_siswa ' tidak ditemukan.";
			$this->session->set_flashdata('not', '  <div class="alert alert-danger
			 alert-dismissible" role="alert"><strong>Gagal!</strong>
			' . $error_message . '
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  </div>');
			redirect('peminjaman', 'refresh');
		}
	}

	public function hapus_session_siswa()
	{
		$this->session->unset_userdata('siswa_data');
		$this->session->set_flashdata('success', 'Data Siswa Berhasil dihapus');
		redirect('peminjaman');
	}

	public function add_session_buku()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$kode_buku = $this->input->post('kode_buku');

		$data_siswa = $this->session->userdata('siswa_data');
		$id_siswa = $data_siswa['id_siswa'];

		$buku_cek = $this->madmin->get_data_by_idbuku($kode_buku, $id_siswa);
		// var_dump($buku_cek);
		// die;
		if ($buku_cek && ($buku_cek->status === 'Belum Kembali' || $buku_cek->status === 'Terlambat')) {
			$error_message = "Anda sudah meminjam buku dengan kode '$kode_buku'.";
			$this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible mt-1" role="alert"><strong>Gagal!</strong> ' . $error_message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect('peminjaman', 'refresh');
		} else {
			$buku = $this->madmin->get_data_bykode($kode_buku);
			if ($buku) {

				$session_buku = $this->session->userdata('buku_data') ? $this->session->userdata('buku_data') : [];

				$session_buku[] = array(
					'id_buku' => $buku->id_buku,
					'judul_buku' => $buku->judul_buku,
					'jumlah' => 1,
					'kelas' => $buku->kelas_buku,
				);

				$this->session->set_userdata('buku_data', $session_buku);
				redirect('peminjaman', 'refresh');
			} else {
				$error_message = "Buku dengan kode '$kode_buku' tidak ditemukan.";
				$this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible" role="alert"><strong>Gagal!</strong> ' . $error_message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect('peminjaman', 'refresh');
			}
		}
	}

	public function update_jumlah()
	{

		$session_buku = $this->session->userdata('buku_data') ? $this->session->userdata('buku_data') : [];

		$id_buku = $this->input->post('id_buku');
		$jumlah = $this->input->post('jumlah');

		foreach ($session_buku as &$buku) {
			if ($buku['id_buku'] == $id_buku) {
				$buku['jumlah'] = $jumlah;
				break;
			}
		}

		$this->session->set_userdata('buku_data', $session_buku);
		$this->session->set_flashdata('success', 'Jumlah buku berhasil ditambah');
		redirect('peminjaman', 'refresh');
	}



	public function hapus_buku_session($id_buku)
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$session_buku = $this->session->userdata('buku_data');
		if (!empty($session_buku)) {
			foreach ($session_buku as $key => $buku) {
				if ($buku['id_buku'] == $id_buku) {
					unset($session_buku[$key]);
					$this->session->set_userdata('buku_data', $session_buku);
					$this->session->set_flashdata('success', 'Data Buku Berhasil dihapus');
					redirect('peminjaman');
				}
			}
			$this->session->set_flashdata('gagal', 'ID Buku Tidak Ditemukan');
			redirect('peminjaman');
		} else {

			$this->session->set_flashdata('gagal', 'Tidak Ada Data Buku');
			redirect('peminjaman');
		}
	}

	public function hapus_session_buku()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}


		$this->session->unset_userdata('buku_data');
		$this->session->set_flashdata('success', 'Data Buku Berhasil dihapus');
		redirect('peminjaman');
	}


	//form peminjaman
	public function proses_peminjaman()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();


		if (empty($this->session->userdata('siswa_data'))) {
			$this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible" 
			role="alert"><strong>Gagal!</strong> Data Siswa Kosong <button type="button"
			 class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect('peminjaman', 'refresh');
		} elseif (empty($this->session->userdata('buku_data'))) {
			$this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible" 
			role="alert"><strong>Gagal!</strong> Data Buku Kosong <button type="button"
			 class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect('peminjaman', 'refresh');
		}



		$id_admin = $this->session->userdata('session_admin')['id_admin'];

		$data['data_siswa'] = $this->session->userdata('siswa_data');
		$id_siswa = $data['data_siswa']['id_siswa'];

		$tanggal_pinjam = $this->input->post('tanggal_pinjam');
		$tanggal_kembali = $this->input->post('tanggal_kembali');
		$kode_pinjam = $this->peminjaman_code->generate_code();

		$data_buku = $this->session->userdata('buku_data');

		$jumlah = 0;
		foreach ($data_buku as $item) {
			$jumlah += $item['jumlah'];
		}
		$data_pinjam = [
			'id_siswa' => $id_siswa,
			'kode_peminjaman' => $kode_pinjam,
			'total_peminjaman' => $jumlah,
			'status_pinjam' => 'Prosess',
			'date_pinjam' => date('Y-m-d H:i:s'),
			'id_admin' => $id_admin
		];

		$this->db->insert('tbl_peminjaman', $data_pinjam);
		$peminjaman_id = $this->db->insert_id();

		foreach ($data_buku as $item) {
			$peminjaman_item = [
				'id_peminjaman' => $peminjaman_id,
				'id_buku' => $item['id_buku'],
				'tanggal_pinjam' => $tanggal_pinjam,
				'tanggal_kembali' => $tanggal_kembali,
				'jumlah_pinjam' => $item['jumlah'],
				'status' => 'Belum Kembali',
			];

			$this->db->insert('tbl_peminjamanitems', $peminjaman_item);
		}
		$this->session->unset_userdata('siswa_data');
		$this->session->unset_userdata('buku_data');
		$this->session->set_flashdata('success', 'Peminjaman Berhasil Dilakukan.');
		redirect('riwayat', 'refresh');
	}

	//pencarian data buku 
	public function cari()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$keyword = $this->input->get('keyword');
		$data['buku'] = $this->madmin->cariData($keyword);

		$data['title'] = 'Pencarian';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/peminjaman_buku/pencarian_buku', $data);
		$this->load->view('Admin/layout/footer');
	}
	//pencarian data mahasiswa 
	public function carisiswa()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$keyword = $this->input->get('keyword');
		$data['siswa'] = $this->madmin->cariDatasiswa($keyword);

		$data['title'] = 'Pencarian';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/peminjaman_buku/pencarian_siswa', $data);
		$this->load->view('Admin/layout/footer');
	}
	//pengurutan data
	public function pengurutanData()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		// Pagination configuration
		$config['total_rows'] = $this->madmin->count_buku();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		// Initialize pagination
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
		$offset = ($page - 1) * $config['per_page'];

		// Get sorted and paginated data
		$urutan = $this->input->post('urutan');
		$data['buku'] = $this->madmin->getSortedData($urutan, $config['per_page'], $offset);
		$data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

		$data['current_page'] = $page;
		$data['pagination'] = $this->pagination->create_links();

		// Pagination links
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = 'Peminjaman';

		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/peminjaman_buku/pengurutan_data', $data);
		$this->load->view('Admin/layout/footer');
	}

	//peminjaman items


	public function generate_pdf($id)
	{
		// Load Dompdf
		require_once FCPATH . 'vendor/autoload.php';

		// Instansiasi objek Dompdf
		$dompdf = new Dompdf();

		// Ambil data dari model
		$data['peminjaman'] = $this->madmin->get_peminjaman($id);
		$data['item_peminjaman'] = $this->madmin->get_detail_peminjaman_item($id);

		// Masukkan HTML ke dalam objek Dompdf
		$html = $this->load->view('Admin/laporan/laporan_detailpeminjaman', $data, TRUE);
		$dompdf->loadHtml($html);

		$dompdf->render();
		// Simpan PDF ke dalam file
		$dompdf->stream("Laporan Detail Peminjaman.pdf", array("Attachment" => FALSE));
	}

	// public function cetak_peminjaman()
	// {
		
	// 	require_once FCPATH . 'vendor/autoload.php';

	// 	$dompdf = new Dompdf();

	// 	// Ambil data dari model
	// 	$data['peminjaman'] = $this->madmin->get_data_peminjaman();

	// 	$data['pengembalian'] = $this->madmin->get_pengembalian($id);
	// 	$data['item_pengembalian'] = $this->madmin->get_detail_pengembalian_item($id);

	// 	// Masukkan HTML ke dalam objek Dompdf
	// 	$html = $this->load->view('Admin/laporan/laporan_peminjama', $data, TRUE);
	// 	$dompdf->loadHtml($html);

	// 	$dompdf->render();
	// 	// Simpan PDF ke dalam file
	// 	$dompdf->stream("Laporan Peminjaman.pdf", array("Attachment" => FALSE));
	// }
	// public function print()
	// {
	// 	$data['peminjaman'] = $this->madmin->get_data_peminjaman();
	// 	$this->load->view('Admin/laporan/laporan_peminjama', $data);
	// }
}
