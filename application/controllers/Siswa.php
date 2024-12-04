<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('madmin');
        $this->load->library('dompdf_lib');
        $this->load->helper('random_code');
        $this->load->helper('kode_siswa');
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

        $config['base_url'] = site_url('siswa/index');
        $config['total_rows'] = $this->madmin->count_siswa();
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

        $offset = ($page - 1) * $config['per_page'];
        $data['siswa'] = $this->madmin->get_all_datasiswa($config['per_page'], $offset);
        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Data Siswa';

        $data['per_page'] = $per_page;

        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/siswa/Daftar_siswa', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function tambah_siswa()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required', array(
            'required' => 'Nama Tidak Boleh Kosong!',

        ));
        // $this->form_validation->set_rules('nisn', 'Nisn', 'required|exact_length[10]', array(
        //     'required' => 'Nomor Nisn Tidak Boleh Kosong!',
        //     'exact_length' => 'Nomor Nisn harus terdiri dari 10 karakter!'
        // ));
        $this->form_validation->set_rules('kelas', 'Kelas', 'required', array(
            'required' => 'Kelas Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required', array(
            'required' => 'Jurusan Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required', array(
            'required' => 'Angkatan Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis_kelamin', 'required', array(
            'required' => 'Jenis Kelamin Tidak Boleh Kosong!',

        ));

        if ($this->form_validation->run() == FALSE) {
            if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
                redirect('adminpanel');
            }

            $id_admin = $this->session->userdata('session_admin')['id_admin'];
            $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

            $data['validation_errors'] = validation_errors('<div class="col-4"> <div class="alert alert-danger alert-dismissible" role="alert"><strong>Gagal ! </strong>', '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div></div>');

            $config['total_rows'] = $this->madmin->count_siswa();
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['use_page_numbers'] = TRUE;

            $this->pagination->initialize($config);
            $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;


            $offset = ($page - 1) * $config['per_page'];
            $data['siswa'] = $this->madmin->get_all_datasiswa($config['per_page'], $offset);
            $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

            $data['current_page'] = $page;
            $data['pagination'] = $this->pagination->create_links();

            $data['title'] = 'Data Siswa';
            $this->load->view('Admin/layout/header', $data);
            $this->load->view('Admin/layout/sidebar');
            $this->load->view('Admin/siswa/Daftar_siswa', $data);
            $this->load->view('Admin/layout/footer');
        } else {

            $nama = $this->input->post('nama');
            // $nisn = $this->input->post('nisn');
            $kelas = $this->input->post('kelas');
            $jurusan = $this->input->post('jurusan');
            $angkatan = $this->input->post('angkatan');
            $no_hp = $this->input->post('no_hp');
            $jenis_kelamin = $this->input->post('jenis_kelamin');

            $random_code = generate_random_code();
            $kode_siswa = generate_code_siswa();

            $duplicate_check = $this->db->get_where('tbl_siswa', array(
                'nama_siswa' => $nama,
            ))->row();

            if ($duplicate_check) {
                $notification_message = "Data siswa sudah ada.";
            } else {

                $config['upload_path'] = './asset/profilsiswa/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 10000;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Gagal!</strong> ' . $error . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
                    redirect('siswa');
                } else {
                   
                    $gambar = uploadFiles3New('siswa', 'gambar');

                    $datainput = array(
                        'nisn' => $kode_siswa,
                        'nama_siswa' => $nama,
                        'kelas_siswa' => $kelas,
                        'jenis_kelamin' => $jenis_kelamin,
                        'jurusan_siswa' => $jurusan,
                        'angkatan_siswa' => $angkatan,
                        'no_hp' => $no_hp,
                        'foto_siswa' => $gambar,
                        'kode_akses' => $random_code,
                        'datecreated' => date('Y-m-d H:i:s')
                    );

                    $this->madmin->insert('tbl_siswa', $datainput);
                    $this->session->set_flashdata('success', 'Tambah Data Siswa Berhasil!');
                    redirect('siswa');
                }
            }

            $data['notification_message'] = $notification_message;

            $id_admin = $this->session->userdata('session_admin')['id_admin'];
            $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

            $config['total_rows'] = $this->madmin->count_siswa();
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['use_page_numbers'] = TRUE;

            $this->pagination->initialize($config);
            $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

            $offset = ($page - 1) * $config['per_page'];
            $data['siswa'] = $this->madmin->get_all_datasiswa($config['per_page'], $offset);
            $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

            $data['current_page'] = $page;
            $data['pagination'] = $this->pagination->create_links();

            $data['title'] = 'Data Siswa';
            $this->load->view('Admin/layout/header', $data);
            $this->load->view('Admin/layout/sidebar');
            $this->load->view('Admin/siswa/Daftar_siswa', $data);
            $this->load->view('Admin/layout/footer');
        }
    }


    public function edit($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $data['siswa'] = $this->madmin->get_id_siswa($id);

        $data['title'] = 'Edit Data';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/siswa/edit_siswa', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function simpan_edit()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Tidak Boleh Kosong!'));
        $this->form_validation->set_rules('kelas', 'Kelas', 'required', array('required' => 'Kelas Tidak Boleh Kosong!'));
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required', array('required' => 'Jurusan Tidak Boleh Kosong!'));
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required', array('required' => 'Angkatan Tidak Boleh Kosong!'));
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis_kelamin', 'required', array('required' => 'Jenis Kelamin Tidak Boleh Kosong!'));

        if ($this->form_validation->run() == FALSE) {
            if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
                redirect('adminpanel');
            }

            $id_admin = $this->session->userdata('session_admin')['id_admin'];
            $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

            $data['validation_errors'] = validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> ', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            $id = $this->input->post('id_siswa');

            $data['siswa'] = $this->madmin->get_id_siswa($id);

            $data['title'] = 'Edit Data';
            $this->load->view('Admin/layout/header', $data);
            $this->load->view('Admin/layout/sidebar');
            $this->load->view('Admin/siswa/edit_siswa', $data);
            $this->load->view('Admin/layout/footer');
        } else {

            $id = $this->input->post('id_siswa');
            $nama = $this->input->post('nama');
            $kelas = $this->input->post('kelas');
            $jurusan = $this->input->post('jurusan');
            $angkatan = $this->input->post('angkatan');
            $no_hp = $this->input->post('no_hp');
            $jenis_kelamin = $this->input->post('jenis_kelamin');

            $data['siswa'] = $this->madmin->get_by_id('tbl_siswa', array('id_siswa' => $id))->row();
            $gambar = $data['siswa']->foto_siswa;

            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './asset/profilsiswa/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 10000;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> ' . $error . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                    redirect('buku');
                }
                
                $gambar = uploadFiles3New('siswa', 'gambar');
            }

        
            $datainput = array(
                'nama_siswa' => $nama,
                'kelas_siswa' => $kelas,
                'jenis_kelamin' => $jenis_kelamin,
                'jurusan_siswa' => $jurusan,
                'angkatan_siswa' => $angkatan,
                'no_hp' => $no_hp,
                'foto_siswa' => $gambar
            );

            $this->madmin->update('tbl_siswa', $datainput, 'id_siswa', $id);
            $this->session->set_flashdata('success', 'Edit Data Siswa Berhasil!');
            redirect('siswa/detail_data/' . $id);
        }
    }


    // public function edit($id)
    // {
    //     if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
    //         redirect('adminpanel');
    //     }

    //     $id_admin = $this->session->userdata('session_admin')['id_admin'];
    //     $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

    //     $data['siswa'] = $this->madmin->get_id_siswa($id);
    //     $data['file'] = $this->session->set_userdata('foto_siswa');

    //     $data['title'] = 'Edit Data';
    //     $this->load->view('Admin/layout/header', $data);
    //     $this->load->view('Admin/layout/sidebar');
    //     $this->load->view('Admin/siswa/edit_siswa', $data);
    //     $this->load->view('Admin/layout/footer');
    // }
    // public function simpan_edit()
    // {

    //     $this->form_validation->set_rules('nama', 'Nama', 'required', array(
    //         'required' => 'Nama Tidak Boleh Kosong!',

    //     ));
    //     $this->form_validation->set_rules('kelas', 'Kelas', 'required', array(
    //         'required' => 'Kelas Tidak Boleh Kosong!',

    //     ));
    //     $this->form_validation->set_rules('jurusan', 'Jurusan', 'required', array(
    //         'required' => 'Jurusan Tidak Boleh Kosong!',

    //     ));
    //     $this->form_validation->set_rules('angkatan', 'Angkatan', 'required', array(
    //         'required' => 'Angkatan Tidak Boleh Kosong!',

    //     ));
    //     $this->form_validation->set_rules('jenis_kelamin', 'Jenis_kelamin', 'required', array(
    //         'required' => 'Jenis Kelamin Tidak Boleh Kosong!',

    //     ));

    //     if ($this->form_validation->run() == FALSE) {
    //         if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
    //             redirect('adminpanel');
    //         }

    //         $id_admin = $this->session->userdata('session_admin')['id_admin'];
    //         $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();


    //         $data['validation_errors'] = validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //         <strong>Gagal!</strong> ', '
    //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>');

    //         $id = $this->input->post('id_siswa');

    //         $data['siswa'] = $this->madmin->get_id_siswa($id);

    //         $data['title'] = 'Edit Data';
    //         $this->load->view('Admin/layout/header', $data);
    //         $this->load->view('Admin/layout/sidebar');
    //         $this->load->view('Admin/siswa/edit_siswa', $data);
    //         $this->load->view('Admin/layout/footer');
    //     } else {
    //         $id = $this->input->post('id_siswa');
    //         $nama = $this->input->post('nama');
    //         $kelas = $this->input->post('kelas');
    //         $jurusan = $this->input->post('jurusan');
    //         $angkatan = $this->input->post('angkatan');
    //         $no_hp = $this->input->post('no_hp');
    //         $jenis_kelamin = $this->input->post('jenis_kelamin');

    //         $data['siswa'] = $this->madmin->get_by_id('tbl_siswa', array('id_siswa' => $id))->row();
    //         $gambar = $data['siswa']->foto_buku;

    //         if (!empty($_FILES['gambar']['name'])) {
    //             $config['upload_path'] = './asset/profilsiswa/';
    //             $config['allowed_types'] = 'jpg|jpeg|png';
    //             $config['max_size'] = 10000;

    //             $this->load->library('upload', $config);

    //             if (!$this->upload->do_upload('gambar')) {
    //                 $error = $this->upload->display_errors();
    //                 $this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //                     <strong>Gagal!</strong> ' . $error . '
    //                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //                 </div>');
    //                 redirect('buku');
    //             }
    //             $data_file = $this->upload->data();
    //             $gambar = $data_file['file_name'];
    //         }

    //         $datainput = array(
    //             'nama_siswa' => $nama,
    //             'kelas_siswa' => $kelas,
    //             'jenis_kelamin' => $jenis_kelamin,
    //             'jurusan_siswa' => $jurusan,
    //             'angkatan_siswa' => $angkatan,
    //             'no_hp' => $no_hp,
    //             'foto_siswa' => $gambar
    //         );

    //         $this->madmin->update('tbl_siswa', $datainput, 'id_siswa', $id);
    //         $this->session->set_flashdata('success', 'Edit Data Siswa Berhasil!');
    //         redirect('siswa', 'refersh');
    //     }
    // }

    public function detail_data($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $data['data_siswa'] = $this->madmin->get_id_siswa($id);
        $data['peminjaman'] = $this->madmin->hitung_jumlahpinjamsiswa($id);
        $data['pengembalian'] = $this->madmin->hitung_jumlahkembali($id);
        $data['total'] = $this->madmin->hitung_total_denda($id);
        $data['terlambat'] = $this->madmin->hitung_total_denda_terlambat($id);


        $data['datapeminjaman'] = $this->madmin->get_data_peminjamanbysiswa($id);
        $data['datapengembalian'] = $this->madmin->get_data_pengembalianbysiswa($id);
        $data['pembayaran'] = $this->madmin->get_pembayaranbysiswa($id);
        $data['total_pembayaran'] = $this->madmin->get_total_pembayaran_siswa($id);

        $data['title'] = 'Detail Data';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/siswa/detail_data', $data);
        $this->load->view('Admin/layout/footer');
    }


    public function carisiswa()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $keyword = $this->input->get('keyword');
        $data['kunci'] =  $keyword;
        $data['siswa'] = $this->madmin->cariDatasiswa($keyword);

        $data['title'] = 'Data Siswa';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/siswa/pencarian_siswa', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function cetak_pdf()
    {
        // Load Dompdf
        require_once FCPATH . 'vendor/autoload.php';

        // Instansiasi objek Dompdf
        $dompdf = new Dompdf();

        // Ambil data dari model
        $data['siswa'] = $this->madmin->get_all_siswa();

        // Masukkan HTML ke dalam objek Dompdf
        $html = $this->load->view('Admin/laporan/laporan_datasiswa', $data, TRUE);
        $dompdf->loadHtml($html);

        $dompdf->render();
        // Simpan PDF ke dalam file
        $dompdf->stream("Laporan Data Siswa.pdf", array("Attachment" => FALSE));
    }

    public function print()
    {
        $data['siswa'] = $this->madmin->get_all_siswa();
        $this->load->view('Admin/laporan/laporan_datasiswa', $data);
    }
    public function cetak_kartu($id)
    {
        $data['data_siswa'] = $this->madmin->get_id_siswa($id);
        $this->load->view('Admin/siswa/cetak_kartu', $data);
    }

    public function hapus($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $this->madmin->delete('tbl_siswa', 'id_siswa', $id);
        $this->session->set_flashdata('success', 'Data Buku siswa dihapus.');
        redirect('siswa');
    }
    public function barcode($code)
    {

        $this->load->library('Zend');
        $this->zend->load('Zend/Barcode');

        Zend_Barcode::render('code128', 'image', array('text' => $code));
    }
}
