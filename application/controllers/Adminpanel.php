<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminpanel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('madmin');
	}

	public function index()
	{

		$this->load->view('Admin/Login');
	}

	public function login()
	{
		$u = $this->input->post('username');
		$p = $this->input->post('password');

		$this->form_validation->set_rules('username', 'Username', 'required', array(
			'required' => 'Masukan username anda'
		));
		$this->form_validation->set_rules('password', 'Password', 'required', array(
			'required' => 'Masukan password anda'
		));

		if ($this->form_validation->run() === FALSE) {

			$this->load->view('Admin/Login');
		} else {

			$user = $this->madmin->check_login($u, $p);

			if ($user) {

				$data_session = array(
					'id_admin' => $user['id_admin'],
					'username' => $user['username'],
					'status' => 'Login'
				);

				$this->session->set_userdata('session_admin', $data_session);
				$this->session->set_flashdata('success', 'Selamat datang didashboard Perpustakaan');
				redirect('dashboard');
			}
		}
	}


	public function Pengurutan()
	{
		if (empty($this->session->userdata('username') || empty($this->session->userdata('id_admin')))) {
			redirect('adminpanel');
		}


		$data['user'] = $this->db->get_where('tbl_admin', ['username' =>
		$this->session->userdata('username')])->row_array();

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

	public function update_status_terlambat_otomatis()
	{
		// Panggil fungsi dari model untuk melakukan pembaruan otomatis
		$this->madmin->update_status_terlambat_otomatis();
		$this->session->set_flashdata('success', 'Status Berhasil Diperbaharui');
		redirect('dashboard');
	}

	// Fungsi untuk menjadwalkan pembaruan otomatis
	public function schedule_update()
	{
		// Tentukan interval waktu untuk menjalankan pembaruan otomatis (misalnya setiap hari)
		// Pastikan untuk menyesuaikan dengan kebutuhan Anda
		$schedule_interval = '0 0 * * *'; // Setiap hari pukul 00:00

		// Tambahkan entri cron job untuk menjalankan fungsi pembaruan otomatis pada interval waktu tertentu
		exec('crontab -l | { cat; echo "' . $schedule_interval . '/usr/bin/php /lokasi/proyek/codeigniter/index.php peminjaman update_status_terlambat_otomatis"; } | crontab -');

		$this->session->set_flashdata('success', 'Pembaruan otomatis berhasil dijadwalkan.');
		redirect('adminpanel/dashboard');
	}

	// Fungsi untuk menghapus jadwal pembaruan otomatis
	public function unschedule_update()
	{
		// Hapus entri cron job untuk fungsi pembaruan otomatis
		exec('crontab -l | sed "/update_status_terlambat_otomatis/d" | crontab -');

		$this->session->set_flashdata('success', 'Jadwal pembaruan otomatis berhasil dihapus.');
		redirect('adminpanel/dashboard');
	}
	public function logout()
	{

		$this->session->unset_userdata('session_admin');

		$this->session->set_flashdata('not', '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Berhasil!</strong> Anda Berhasil Keluar.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>');
		redirect('adminpanel');
	}
}
