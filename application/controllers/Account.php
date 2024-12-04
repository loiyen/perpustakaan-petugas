<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
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


		$data['title'] = 'Akun';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/akun/Profil', $data);
		$this->load->view('Admin/layout/footer');
	}

	public function edit_profil()
	{

		$this->form_validation->set_rules('nama', 'Nama', 'required', array(
			'required' => 'Nama Tidak Boleh Kosong!'
		));
		$this->form_validation->set_rules('email', 'Email', 'required', array(
			'required' => 'Email Tidak Boleh Kosong!'
		));
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required', array(
			'required' => 'Jabatan Tidak Boleh Kosong!'
		));
		$this->form_validation->set_rules('no_hp', 'No_hp', 'required', array(
			'required' => 'No Hp Tidak Boleh Kosong!'
		));

		if ($this->form_validation->run() === FALSE) {
			if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
				redirect('adminpanel');
			}

			$id_admin = $this->session->userdata('session_admin')['id_admin'];

			$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

			$data['title'] = 'Akun';
			$this->load->view('Admin/layout/header', $data);
			$this->load->view('Admin/layout/sidebar');
			$this->load->view('Admin/akun/Profil', $data);
			$this->load->view('Admin/layout/footer');
		} else {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$jabatan = $this->input->post('jabatan');
			$no_telfon = $this->input->post('no_hp');

			$id = $this->session->userdata('session_admin')['id_admin'];
			$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id])->row_array();


			$data['admin'] = $this->madmin->get_by_id('tbl_admin', array('id_admin' => $id))->row();
			$gambar = $data['admin']->foto_admin;

			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path'] = './asset/fotoprofil/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 5120; // in kilobytes

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('gambar')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Gagal!</strong> ' . $error . '
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>');
					redirect('account');
				}
				$data_file = $this->upload->data();
				$gambar = $data_file['file_name'];
			}


			// Set data baru ke dalam database
			$this->db->set('nama_admin', $nama);
			$this->db->set('email_admin', $email);
			$this->db->set('jabatan_admin', $jabatan);
			$this->db->set('no_telfon', $no_telfon);
			$this->db->set('foto_admin', $gambar);
			$this->db->set('datecreated', date('Y-m-d H:i:s'));
			$this->db->where('id_admin', $id);
			$this->db->update('tbl_admin');

			$this->session->set_flashdata('not', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Berhasil!</strong> Edit data Profile Berhasil.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
			redirect('account');
		}
	}

	//ubah password

	public function password()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$data['title'] = 'Akun';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/akun/Ubah_password', $data);
		$this->load->view('Admin/layout/footer');
	}

	public function ubah_password()
	{

		$this->form_validation->set_rules('password', 'Password', 'required|trim', array(
			'required' => 'Password tidak boleh kosong'
		));
		$this->form_validation->set_rules(
			'password_baru',
			'Password Baru',
			'required|trim|min_length[5]|matches[konfirmasi]'
		);
		$this->form_validation->set_rules(
			'konfirmasi',
			'Konfirmasi',
			'required|trim|min_length[5]|matches[password_baru]'
		);

		if ($this->form_validation->run() == FALSE) {
			if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
				redirect('adminpanel');
			}

			$id_admin = $this->session->userdata('session_admin')['id_admin'];
			$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

			$data['title'] = 'Akun';
			$this->load->view('Admin/layout/header', $data);
			$this->load->view('Admin/layout/sidebar');
			$this->load->view('Admin/akun/Ubah_password', $data);
			$this->load->view('Admin/layout/footer');
		} else {

			$id  = $this->input->post('id_admin');
			$password  = $this->input->post('password');
			$password_baru  = $this->input->post('password_baru');

			$id_admin = $this->session->userdata('session_admin')['id_admin'];
			$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

			if (!password_verify($password, $data['user']['password'])) {

				$this->session->set_flashdata('not', '<div class="alert alert-danger" role="alert">
					Password Tidak Sama.
				</div>');
				redirect('account/ubah_password');
			} elseif ($password == $password_baru || empty($password_baru)) {
				$this->session->set_flashdata('not', '<div class="alert alert-danger" role="alert">
					Password baru dan lama tidak boleh sama atau kosong.
				</div>');
				redirect('account/ubah_password');
			} else {
				// Password oke, lanjutkan dengan pembaruan
				$password_baru_hashed = $this->madmin->hash_string($password_baru);
				// Update password
				$dataUpdate = array('password' => $password_baru_hashed);
				$this->madmin->update('tbl_admin', $dataUpdate, 'id_admin', $id);

				$this->session->set_flashdata('not', '<div class="alert alert-success" role="alert">
					Password Berhasil diubah.
				</div>');
				redirect('account/ubah_password');
			}
		}
	}

	//tambah akun petugas
	public function petugas()
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$id_admin = $this->session->userdata('session_admin')['id_admin'];
		$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

		$data['petugas'] = $this->madmin->lev_petugas('tbl_admin');

		$data['title'] = 'Akun';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/akun/tambah_petugas', $data);
		$this->load->view('Admin/layout/footer');
	}
	public function tambah_akun()
	{

		$this->form_validation->set_rules('username', 'Username', 'required', array(
			'required' => 'Username Tidak Boleh Kosong!'
		));
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[8]', array(
			'required' => 'Password tidak boleh kosong!',
			'max_length' => 'Password tidak boleh lebih dari 8 karakter!'
		));

		if ($this->form_validation->run() === FALSE) {
			if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
				redirect('adminpanel');
			}

			$id_admin = $this->session->userdata('session_admin')['id_admin'];
			$data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();


			$data['petugas'] = $this->madmin->lev_petugas('tbl_admin');

			$data['title'] = 'Akun';
			$this->load->view('Admin/layout/header', $data);
			$this->load->view('Admin/layout/sidebar');
			$this->load->view('Admin/akun/tambah_petugas', $data);
			$this->load->view('Admin/layout/footer');
		} else {

			$datainput = array(
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'level' => 0,
				'Status' => 1,
				'datecreated' => date('Y-m-d H:i:s')
			);
			$this->madmin->insert('tbl_admin', $datainput);

			$this->session->set_flashdata('not', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Berhasil!</strong> Tambah Akun Berhasil.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
			redirect('account/petugas');
		}
	}
	public function ubah_status_aktif_0($id)
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$this->madmin->ubahStatusaktif_0($id, '0');

		$this->session->set_flashdata('not_akun', '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Berhasil!</strong> Akun Berhasil Dinonaktifkan.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>');
		redirect('account/petugas');
	}
	public function ubah_status_aktif_1($id)
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$this->madmin->ubahStatusaktif_1($id, '1');

		$this->session->set_flashdata('not_akun', '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Berhasil!</strong> Akun Berhasil Diaktifkan.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>');
		redirect('account/petugas');
	}
	public function hapus_akun($id)
	{
		if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
			redirect('adminpanel');
		}

		$this->madmin->delete('tbl_admin', 'id_admin', $id);
		$this->session->set_flashdata('not_akun', '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Berhasil!</strong> Akun Berhasil Dihapus.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>');
		redirect('account/petugas');
	}
}
