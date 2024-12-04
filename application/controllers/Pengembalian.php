<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('madmin');
		$this->load->library('cart');
		$this->load->library('pagination');
		$this->load->library('pengembalian_code');
	}

	public function index()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$data['data_siswa'] = $this->session->userdata('siswa_data_pengembalian');
		$id = $data['data_siswa']['id_siswa'];

		$data['data_buku'] = $this->madmin->get_datapeminjaman_bysiswa($id);


		$data['data_buku_kembali'] = $this->session->userdata('buku_data_pengembalian');
		$data['nominal_tambah'] = $this->session->userdata('nominal_denda');
		$data['nominal_bayar'] = $this->session->userdata('nominal_bayar');
		$data['code_kembali'] = $this->pengembalian_code->generate_code();


		$tanggal_hari_ini = date('Y-m-d');
		$data['tanggal_hari_ini'] = $tanggal_hari_ini;

		$data['title'] = 'Pengembalian';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/pengembalian_buku/pengembalian', $data);
		$this->load->view('Admin/layout/footer');
	}

	public function add_session_siswa_pengembalian()
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

			$this->session->set_userdata('siswa_data_pengembalian', $session_data);
			redirect('pengembalian', 'refersh');
		} else {
			$error_message = "Siswa dengan kode akses ' $kode_siswa ' tidak ditemukan.";
			$this->session->set_flashdata('not', '  <div class="alert alert-danger
			 alert-dismissible" role="alert"><strong>Gagal!</strong>
			' . $error_message . '
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  </div>');
			redirect('pengembalian', 'refresh');
		}
	}

	public function hapus_session_siswa()
	{
		$this->session->unset_userdata('siswa_data_pengembalian');
		$this->session->unset_userdata('buku_data_pengembalian');
		$this->session->set_flashdata('success', 'Data Siswa Berhasil dihapus');
		redirect('pengembalian');
	}

	public function add_session_buku_pengembalian()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$kode_buku = $this->input->post('kode_buku');
		$data['data_siswa'] = $this->session->userdata('siswa_data_pengembalian');
		$id = $data['data_siswa']['id_siswa'];

		$buku = $this->madmin->get_tblpeminjaman_bysiswa($kode_buku, $id);

		if (!empty($buku)) {
			$buku = $buku[0];
			if (!$this->session->has_userdata('buku_data_pengembalian')) {
				$session_buku = array();
			} else {
				$session_buku = $this->session->userdata('buku_data_pengembalian');
			}
			$session_buku[] = array(
				'id_buku' => $buku['id_buku'],
				'judul_buku' => $buku['judul_buku'],
				'jumlah' => $buku['jumlah_pinjam'],
				'status' => $buku['status'],
				'tgl_kembali' => $buku['tanggal_kembali'],
				'denda' => $buku['denda'],
			);

			$this->session->set_userdata('buku_data_pengembalian', $session_buku);
			redirect('pengembalian', 'refresh');
		} else {
			$error_message = "Buku dengan kode '$kode_buku' tidak ditemukan.";
			$this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible"
			 role="alert"><strong>Gagal!</strong> ' . $error_message . '<button type="button" 
			 class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect('pengembalian', 'refresh');
		}
	}

	public function hapus_buku_session($id_buku)
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$session_buku = $this->session->userdata('buku_data_pengembalian');
		if (!empty($session_buku)) {
			foreach ($session_buku as $key => $buku) {
				if ($buku['id_buku'] == $id_buku) {
					unset($session_buku[$key]);
					$this->session->set_userdata('buku_data_pengembalian', $session_buku);
					$this->session->set_flashdata('success', 'Data Buku Berhasil dihapus');
					redirect('pengembalian');
				}
			}
			$this->session->set_flashdata('gagal', 'ID Buku Tidak Ditemukan');
			redirect('pengembalian');
		} else {

			$this->session->set_flashdata('gagal', 'Tidak Ada Data Buku');
			redirect('pengembalian');
		}
	}

	public function add_session_denda()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$nominal_tambah = $this->input->post('nominal');
		$data = array(
			'nominal' => $nominal_tambah
		);

		$this->session->set_userdata('nominal_denda', $data);
		$this->session->set_flashdata('success', 'Nominal Denda Berhasil ditambah.');
		redirect('pengembalian', 'refresh');
	}

	public function hapus_session_denda()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$this->session->unset_userdata('nominal_denda');
		$this->session->set_flashdata('success', 'Nominal Denda dihapus.');
		redirect('pengembalian', 'refresh');
	}
	public function add_session_pembayaran()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$nominal = $this->input->post('nominal');
		$data = array(
			'nominal_bayar' => $nominal
		);

		$this->session->set_userdata('nominal_bayar', $data);
		$this->session->set_flashdata('success', 'Pembayaran Berhasil ditambah.');
		redirect('pengembalian', 'refresh');
	}
	public function hapus_session_bayar()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$this->session->unset_userdata('nominal_bayar');
		$this->session->set_flashdata('success', 'Nominal Pembayaran dihapus.');
		redirect('pengembalian', 'refresh');
	}

	public function prosess_pengembalian()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

	
		$id_admin = $this->session->userdata('session_admin')['id_admin'];

		$data_buku = $this->session->userdata('buku_data_pengembalian');

		$data['data_siswa'] = $this->session->userdata('siswa_data_pengembalian');
		$id_siswa = $data['data_siswa']['id_siswa'];

		$data['nominal_tambah'] = $this->session->userdata('nominal_denda');
		$data['nominal_bayar'] = $this->session->userdata('nominal_bayar');
		$pembayaran = $data['nominal_bayar']['nominal_bayar'];

		$code_kembali = $this->pengembalian_code->generate_code();
		$total_denda = $this->input->post('total_denda');

		// if ($total_denda == 0) {
		// 	$status_pembayaran = 4;
		// } elseif ($pembayaran == 0) {
		// 	$status_pembayaran = 4;
		// } elseif ($total_denda == $pembayaran) {
		// 	$status_pembayaran = 1;
		// } elseif ($total_denda > $pembayaran) {
		// 	$status_pembayaran = 2;
		// } else {
		// 	$status_pembayaran = 3;
		// }

		if (empty($total_denda)) {
			$status = 1;
		} else {
			$status = 2;
		}

		$jumlah = 0;
		foreach ($data_buku as $item) {
			$jumlah += $item['jumlah'];
		}

		$data_pengembalian = [
			'id_siswa' => $id_siswa,
			'kode_pengembalian' => $code_kembali,
			'total_pengembalian' => $jumlah,
			'total_denda' => $total_denda,
			// 'total_bayar' => $pembayaran,
			'status' => $status,
			'id_admin' => $id_admin,
			'date' => date('Y-m-d H:i:s')
		];

		// var_dump($data_pengembalian);
		// die;

		$this->db->insert('tbl_pengambalian', $data_pengembalian);
		$pengembalian_id = $this->db->insert_id();

		foreach ($data_buku as $item) {

			$kondisi = isset($_POST['kondisi'][$item['id_buku']]) ? $_POST['kondisi'][$item['id_buku']] : 1;

			$pengembalian_item = [
				'id_pengembalian' => $pengembalian_id,
				'id_buku' => $item['id_buku'],
				'kondisi_buku' => $kondisi,
				'denda' => $item['denda'],
				'jumlah_kembali' => $item['jumlah'],
			];
			$this->db->insert('tbl_pengembalianitems', $pengembalian_item);
		}

		foreach ($data_buku as $item) {

			$buku_id = $item['id_buku'];

			$this->db->set('status', 'Selesai');
			$this->db->where('id_buku', $buku_id);
			$this->db->where("(status = 'Belum Kembali' OR status = 'Terlambat')");
			$this->db->update('tbl_peminjamanitems');
		}

		$this->db->set('status_pinjam', 'Selesai');
		$this->db->where('id_siswa', $id_siswa);
		$this->db->set('status_pinjam', 'CASE WHEN (SELECT COUNT(*) FROM tbl_peminjamanitems WHERE tbl_peminjamanitems.id_peminjaman =
		 tbl_peminjaman.id_peminjaman AND tbl_peminjamanitems.status IN ("Belum Kembali", "Terlambat")) > 0 THEN "Prosess" ELSE "Selesai" END', FALSE);
		$this->db->update('tbl_peminjaman');

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan pengembalian.');
		} else {

			$this->session->unset_userdata('nominal_denda');
			$this->session->unset_userdata('nominal_bayar');
			$this->session->unset_userdata('siswa_data_pengembalian');
			$this->session->unset_userdata('buku_data_pengembalian');
			$this->session->set_flashdata('success', 'Pengembalian Buku Berhasil.');
			redirect('riwayatkembali', 'refresh');
		}
	}
}
