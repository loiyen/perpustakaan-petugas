<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use FontLib\Table\Type\post;

class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('madmin');
        $this->load->library('book_code');
        $this->load->library('pagination');
        $this->load->library('dompdf_lib');
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

        $config['total_rows'] = $this->madmin->count_buku();
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

        $offset = ($page - 1) * $config['per_page'];
        $data['buku'] = $this->madmin->get_buku($config['per_page'], $offset);
        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $per_page;

        $data['kategori'] = $this->madmin->get_all_kategori();
        $data['rak'] = $this->madmin->get_all_rak();

        $data['title'] = 'Buku';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/buku/Buku_perpustakaan', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function tambah_buku()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array(
            'required' => 'Kategori Tidak Boleh Kosong!',
        ));
        $this->form_validation->set_rules('rak', 'Rak', 'required', array(
            'required' => 'Rak Tidak Boleh Kosong!',
        ));
        $this->form_validation->set_rules('isbn', 'Isbn', 'required|exact_length[13]', array(
            'required' => 'Nomor ISBN Tidak Boleh Kosong!',
            'exact_length' => 'Nomor ISBN harus terdiri dari 13 karakter!'
        ));

        $this->form_validation->set_rules('judul', 'Judul', 'required', array(
            'required' => 'Judul Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('kelas', 'Kelas', 'required', array(
            'required' => 'Kelas Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('penulis', 'Penulis', 'required', array(
            'required' => 'Nama Penulis Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required', array(
            'required' => 'Nama Penerbit Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('tahun', 'Tahun', 'required', array(
            'required' => 'Tahun Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('stok', 'Stok', 'required', array(
            'required' => 'Stok Tidak Boleh Kosong!',

        ));


        if ($this->form_validation->run() == FALSE) {
            if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
                redirect('adminpanel');
            }

            $id_admin = $this->session->userdata('session_admin')['id_admin'];
            $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

            $data['validation_errors'] = validation_errors('<div class="col-4"> <div class="alert alert-danger 
            alert-dismissible" role="alert"><strong>Gagal ! </strong>', '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div></div>');

            $isbn = $this->input->post('isbn');
            $judul = $this->input->post('judul');
            $kelas = $this->input->post('kelas');
            $penulis = $this->input->post('penulis');
            $penerbit = $this->input->post('penerbit');
            $tahun = $this->input->post('tahun');
            $stok = $this->input->post('stok');

            $data['input_values'] = array(
                'isbn' => $isbn,
                'judul' => $judul,
                'kelas' => $kelas,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun' => $tahun,
                'stok' => $stok,

            );

            $per_page_input = $this->input->get('per_page');
            $per_page = is_numeric($per_page_input) ? intval($per_page_input) : 10;

            $config['total_rows'] = $this->madmin->count_buku();
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 3;
            $config['use_page_numbers'] = TRUE;

            $this->pagination->initialize($config);
            $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;


            $offset = ($page - 1) * $config['per_page'];
            $data['buku'] = $this->madmin->get_buku($config['per_page'], $offset);
            $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);


            $data['current_page'] = $page;
            $data['pagination'] = $this->pagination->create_links();
            $data['per_page'] = $per_page;

            $data['kategori'] = $this->madmin->get_all_kategori();
            $data['rak'] = $this->madmin->get_all_rak();

            $data['title'] = 'Buku';
            $this->load->view('Admin/layout/header', $data);
            $this->load->view('Admin/layout/sidebar');
            $this->load->view('Admin/buku/Buku_perpustakaan', $data);
            $this->load->view('Admin/layout/footer');
        } else {
            $kategori = $this->input->post('kategori');
            $rak = $this->input->post('rak');
            $isbn = $this->input->post('isbn');
            $judul = $this->input->post('judul');
            $kelas = $this->input->post('kelas');
            $penulis = $this->input->post('penulis');
            $penerbit = $this->input->post('penerbit');
            $tahun = $this->input->post('tahun');
            $stok = $this->input->post('stok');

            $book_code = $this->book_code->generate_code();

            $config['upload_path'] = './asset/fotobuku/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 10000;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> ' . $error . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                redirect('buku');
            } else {


                $gambar = uploadFiles3New('buku', 'gambar');

                $datainput = array(
                    'isbn' => $isbn,
                    'judul_buku' => $judul,
                    'kelas_buku' => $kelas,
                    'penulis_buku' => $penulis,
                    'penerbit_buku' => $penerbit,
                    'tahun_penerbit' => $tahun,
                    'stok_buku' => $stok,
                    'foto_buku' => $gambar,
                    'kode_buku' => $book_code,
                    'date_created' => date('Y-m-d H:i:s'),
                    'id_kategori' => $kategori,
                    'id_rak' => $rak,
                );

                $this->madmin->insert('tbl_buku', $datainput);
                $this->session->set_flashdata('success', 'Tambah Buku Berhasil!');
                redirect('buku');
            }
        }
    }

    // public function tambah_buku()
    // {

    //     if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
    //         redirect('adminpanel');
    //     }

    //     // Set validation rules for form inputs
    //     $this->form_validation->set_rules('kategori', 'Kategori', 'required', array(
    //         'required' => 'Kategori Tidak Boleh Kosong!',
    //     ));
    //     $this->form_validation->set_rules('rak', 'Rak', 'required', array(
    //         'required' => 'Rak Tidak Boleh Kosong!',
    //     ));
    //     $this->form_validation->set_rules('isbn', 'Isbn', 'required|exact_length[13]', array(
    //         'required' => 'Nomor ISBN Tidak Boleh Kosong!',
    //         'exact_length' => 'Nomor ISBN harus terdiri dari 13 karakter!'
    //     ));
    //     $this->form_validation->set_rules('judul', 'Judul', 'required', array(
    //         'required' => 'Judul Tidak Boleh Kosong!',
    //     ));
    //     $this->form_validation->set_rules('kelas', 'Kelas', 'required', array(
    //         'required' => 'Kelas Tidak Boleh Kosong!',
    //     ));
    //     $this->form_validation->set_rules('penulis', 'Penulis', 'required', array(
    //         'required' => 'Nama Penulis Tidak Boleh Kosong!',
    //     ));
    //     $this->form_validation->set_rules('penerbit', 'Penerbit', 'required', array(
    //         'required' => 'Nama Penerbit Tidak Boleh Kosong!',
    //     ));
    //     $this->form_validation->set_rules('tahun', 'Tahun', 'required', array(
    //         'required' => 'Tahun Tidak Boleh Kosong!',
    //     ));
    //     $this->form_validation->set_rules('stok', 'Stok', 'required', array(
    //         'required' => 'Stok Tidak Boleh Kosong!',
    //     ));

    //     if ($this->form_validation->run() == FALSE) {
    //         // Retrieve user data if validation fails
    //         $id_admin = $this->session->userdata('session_admin')['id_admin'];
    //         $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

    //         // Store validation errors and input values for re-display
    //         $data['validation_errors'] = validation_errors('<div class="col-4"> <div class="alert alert-danger 
    //         alert-dismissible" role="alert"><strong>Gagal ! </strong>', '
    //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //       </div></div>');

    //         // Capture input values to pre-fill form fields
    //         $data['input_values'] = array(
    //             'isbn' => $this->input->post('isbn'),
    //             'judul' => $this->input->post('judul'),
    //             'kelas' => $this->input->post('kelas'),
    //             'penulis' => $this->input->post('penulis'),
    //             'penerbit' => $this->input->post('penerbit'),
    //             'tahun' => $this->input->post('tahun'),
    //             'stok' => $this->input->post('stok'),
    //         );

    //         // Handle pagination setup
    //         $per_page_input = $this->input->get('per_page');
    //         $per_page = is_numeric($per_page_input) ? intval($per_page_input) : 10;
    //         $config['total_rows'] = $this->madmin->count_buku();
    //         $config['per_page'] = $per_page;
    //         $config['uri_segment'] = 3;
    //         $config['use_page_numbers'] = TRUE;
    //         $this->pagination->initialize($config);

    //         $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
    //         $offset = ($page - 1) * $config['per_page'];

    //         $data['buku'] = $this->madmin->get_buku($config['per_page'], $offset);
    //         $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);
    //         $data['current_page'] = $page;
    //         $data['pagination'] = $this->pagination->create_links();
    //         $data['per_page'] = $per_page;

    //         // Retrieve additional data for form fields
    //         $data['kategori'] = $this->madmin->get_all_kategori();
    //         $data['rak'] = $this->madmin->get_all_rak();

    //         // Load views with form data
    //         $data['title'] = 'Buku';
    //         $this->load->view('Admin/layout/header', $data);
    //         $this->load->view('Admin/layout/sidebar');
    //         $this->load->view('Admin/buku/Buku_perpustakaan', $data);
    //         $this->load->view('Admin/layout/footer');
    //     } else {
    //         // If validation passes, prepare data for insertion
    //         $datainput = array(
    //             'isbn' => $this->input->post('isbn'),
    //             'judul_buku' => $this->input->post('judul'),
    //             'kelas_buku' => $this->input->post('kelas'),
    //             'penulis_buku' => $this->input->post('penulis'),
    //             'penerbit_buku' => $this->input->post('penerbit'),
    //             'tahun_penerbit' => $this->input->post('tahun'),
    //             'stok_buku' => $this->input->post('stok'),
    //             'kode_buku' => $this->book_code->generate_code(),
    //             'date_created' => date('Y-m-d H:i:s'),
    //             'id_kategori' => $this->input->post('kategori'),
    //             'id_rak' => $this->input->post('rak'),
    //         );

    //         // Handle file upload
    //         $config['upload_path'] = './asset/fotobuku/';
    //         $config['allowed_types'] = 'jpg|png|jpeg';
    //         $config['max_size'] = 1000;
    //         $this->load->library('upload', $config);

    //         if (!$this->upload->do_upload('gambar')) {
    //             // Handle upload error
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //             <strong>Gagal!</strong> ' . $error . '
    //             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //         </div>');
    //             redirect('buku');
    //         } else {

    //             $datainput['foto_buku'] = uploadFiles3New('buku', 'gambar');

    //             $datainput = array(
    //                 'isbn' => $isbn,
    //                 'judul_buku' => $judul,
    //                 'kelas_buku' => $kelas,
    //                 'penulis_buku' => $penulis,
    //                 'penerbit_buku' => $penerbit,
    //                 'tahun_penerbit' => $tahun,
    //                 'stok_buku' => $stok,
    //                 'foto_buku' => $gambar,
    //                 'kode_buku' => $book_code,
    //                 'date_created' => date('Y-m-d H:i:s'),
    //                 'id_kategori' => $kategori,
    //                 'id_rak' => $rak,
    //             );

    //             $this->madmin->insert('tbl_buku', $datainput);
    //             $this->session->set_flashdata('success', 'Tambah Buku Berhasil!');
    //             redirect('buku');
    //         }
    //     }
    // }

    public function editBuku($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $data['kategori'] = $this->madmin->get_all_kategori();
        $data['buku'] = $this->madmin->get_data_by_id_buku($id);

        $data['file'] = $this->session->set_userdata('foto_buku');

        $data['title'] = 'Edit buku';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/buku/Editbuku_perpustakaan', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function edit_buku()
    {

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array(
            'required' => 'Kategori Tidak Boleh Kosong!',
        ));

        $this->form_validation->set_rules('judul', 'Judul', 'required', array(
            'required' => 'Judul Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('kelas', 'Kelas', 'required', array(
            'required' => 'Kelas Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('penulis', 'Penulis', 'required', array(
            'required' => 'Nama Penulis Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required', array(
            'required' => 'Nama Penerbit Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('tahun', 'Tahun', 'required', array(
            'required' => 'Tahun Tidak Boleh Kosong!',

        ));
        $this->form_validation->set_rules('stok', 'Stok', 'required', array(
            'required' => 'Stok Tidak Boleh Kosong!',

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


            $id = $this->input->post('id_buku');

            $data['kategori'] = $this->madmin->get_all_kategori();
            $data['buku'] = $this->madmin->get_data_by_id_buku($id);

            $data['title'] = 'Buku';
            $this->load->view('Admin/layout/header', $data);
            $this->load->view('Admin/layout/sidebar');
            $this->load->view('Admin/buku/Editbuku_perpustakaan', $data);
            $this->load->view('Admin/layout/footer');
        } else {
            $kategori = $this->input->post('kategori');
            $judul = $this->input->post('judul');
            $kelas = $this->input->post('kelas');
            $penulis = $this->input->post('penulis');
            $penerbit = $this->input->post('penerbit');
            $tahun = $this->input->post('tahun');
            $stok = $this->input->post('stok');

            $id = $this->input->post('id_buku');

            $data['buku'] = $this->madmin->get_by_id('tbl_buku', array('id_buku' => $id))->row();
            $gambar = $data['buku']->foto_buku;

            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './asset/fotobuku/';
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

                $gambar = uploadFiles3New('buku', 'gambar');
            }

            $datainput = array(
                'judul_buku' => $judul,
                'penulis_buku' => $penulis,
                'kelas_buku' => $kelas,
                'penerbit_buku' => $penerbit,
                'tahun_penerbit' => $tahun,
                'stok_buku' => $stok,
                'foto_buku' => $gambar,
                'date_created' => date('Y-m-d H:i:s'),
                'id_kategori' => $kategori
            );

            $this->madmin->update('tbl_buku', $datainput, 'id_buku', $id);
            $this->session->set_flashdata('success', 'Update Buku Berhasil!');
            redirect('buku/detail_buku/' . $id);
        }
    }

    public function detail_Buku($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $data['buku'] = $this->madmin->get_buku_with_kategori($id);

        $data['peminjaman'] = $this->madmin->get_jumlah_pinjam($id);
        $data['pengembalian'] = $this->madmin->get_jumlah_kembali($id);
        $data['hilang'] = $this->madmin->get_hilang($id);
        $data['rusak'] = $this->madmin->get_rusak($id);
        $data['belumkembali'] = $this->madmin->get_belum_kembali($id);
        $data['terlambat'] = $this->madmin->get_terlambat($id);
        $data['bybulan'] = $this->madmin->get_peminjamanbybulan($id);
        // var_dump($data['bybulan']);
        // die;

        $data['title'] = 'Buku';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/buku/Detailbuku_perpustakaan', $data);
        $this->load->view('Admin/layout/footer', $data);
    }


    public function hapus_buku($id)
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }



        $this->madmin->delete('tbl_buku', 'id_buku', $id);
        $this->session->set_flashdata('success', 'Data Buku Berhasil dihapus.');
        redirect('buku');
    }

    public function pencarian_buku()
    {
        if (!$this->session->userdata('session_admin') || empty($this->session->userdata('session_admin')['id_admin'])) {
            redirect('adminpanel');
        }

        $id_admin = $this->session->userdata('session_admin')['id_admin'];
        $data['user'] = $this->db->get_where('tbl_admin', ['id_admin' => $id_admin])->row_array();

        $keyword = $this->input->get('keyword');
        $data['kunci'] = $keyword;
        $data['buku'] = $this->madmin->cariData($keyword);

        $data['kategori'] = $this->madmin->get_all_kategori();
        $data['rak'] = $this->madmin->get_all_rak();

        $data['title'] = 'Pencarian';
        $this->load->view('Admin/layout/header', $data);
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/buku/pencarian_buku', $data);
        $this->load->view('Admin/layout/footer');
    }

    public function cetak_pdf()
    {
        // Load Dompdf
        require_once FCPATH . 'vendor/autoload.php';

        // Instansiasi objek Dompdf
        $dompdf = new Dompdf();

        // Ambil data dari model
        $data['buku'] = $this->madmin->get_all_buku();

        // Masukkan HTML ke dalam objek Dompdf
        $html = $this->load->view('Admin/laporan/laporan_databuku', $data, TRUE);
        $dompdf->loadHtml($html);

        $dompdf->render();
        // Simpan PDF ke dalam file
        $dompdf->stream("Laporan Data buku.pdf", array("Attachment" => FALSE));
    }

    // public function print()
    // {
    //     $data['buku'] = $this->madmin->get_all_buku();
    //     $this->load->view('Admin/laporan/laporan_databuku', $data);
    // }
    public function print_barcode()
    {
        $data['buku'] = $this->madmin->get_all_buku();
        $this->load->view('Admin/laporan/print_barcodebuku', $data);
    }
    // public function print_barcode_buku()
    // {
    //     $jumlah = $this->madmin->get_all_buku();
    //     $this->load->view('Admin/laporan/print_barcodebuku', $data);
    // }

    public function barcode($code)
    {

        $this->load->library('Zend');
        $this->zend->load('Zend/Barcode');

        Zend_Barcode::render('code128', 'image', array('text' => $code));
    }
}
