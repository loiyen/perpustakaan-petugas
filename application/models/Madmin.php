<?php

use phpDocumentor\Reflection\Types\This;

class Madmin extends CI_Model
{
    public function check_login($u, $p)
    {
        $this->db->select('id_admin, username, password,Status');
        $this->db->from('tbl_admin');
        $this->db->where('username', $u);
        $query = $this->db->get();

        $user = $query->row_array();

        if ($user) {
            if (password_verify($p, $user['password'])) {
                if ($user['Status'] == '1') {
                    return $user;
                } else {
                    $this->session->set_flashdata('gagal', 'Akun tidak aktif. Harap hubungi administrator.');
                    redirect('adminpanel');
                }
            } else {
                $this->session->set_flashdata('gagal', 'Verifikasi kata sandi gagal.');
                redirect('adminpanel');
            }
        } else {
            $this->session->set_flashdata('gagal', 'Username tidak ditemukan.');
            redirect('adminpanel');
        }
    }


    public function hash_string($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function verify_string($input, $hash)
    {
        return password_verify($input, $hash);
    }


    //dataquery
    public function insert($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function get_by_id($tabel, $id)
    {
        return $this->db->get_where($tabel, $id);
    }
    public function update($tabel, $data, $pk, $id)
    {
        $this->db->where($pk, $id);
        $this->db->update($tabel, $data);
    }
    public function delete($tabel, $id, $val)
    {
        $this->db->delete($tabel, array($id => $val));
    }


    //tambah petugas 
    public function lev_petugas()
    {
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->where('level', 0);

        $query = $this->db->get();
        return $query->result();
    }

    public function ubahStatusaktif_0($id, $status)
    {
        $data = array('Status' => $status);
        $this->db->where('id_admin', $id);
        $this->db->update('tbl_admin', $data);
    }
    public function ubahStatusaktif_1($id, $status)
    {
        $data = array('Status' => $status);
        $this->db->where('id_admin', $id);
        $this->db->update('tbl_admin', $data);
    }

    //kategori
    public function get_all_kategori()
    {

        $this->db->select('tbl_kategori.*, COUNT(tbl_buku.id_buku) as jumlah_buku');
        $this->db->from('tbl_kategori');
        $this->db->join('tbl_buku', 'tbl_buku.id_kategori = tbl_kategori.id_kategori', 'left');
        $this->db->group_by('tbl_kategori.id_kategori');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_data_by_id($id)
    {
        $query = $this->db->get_where('tbl_kategori', array('id_kategori' => $id));
        return $query->row();
    }

    //siswa
    public function get_all_datasiswa($limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('tbl_siswa');
        return $query->result();
    }
    public function count_siswa()
    {
        return $this->db->count_all('tbl_siswa');
    }

    public function get_id_siswa($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function hitung_jumlahpinjamsiswa($id)
    {
        $this->db->where('id_siswa', $id);
        return $this->db->count_all_results('tbl_peminjaman');
    }

    public function hitung_jumlahkembali($id)
    {
        $this->db->where('id_siswa', $id);
        return $this->db->count_all_results('tbl_pengambalian');
    }

    public function hitung_total_denda($id_siswa)
    {
        $this->db->select_sum('total_denda');
        $this->db->where('id_siswa', $id_siswa);
        $query = $this->db->get('tbl_pengambalian');
        $result = $query->row();
        return $result->total_denda;
    }
    public function hitung_total_denda_terlambat($id_siswa)
    {
        $this->db->select_sum('denda');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tbl_peminjaman.id_siswa', $id_siswa);
        $query = $this->db->get('tbl_peminjamanitems');
        $result = $query->row();
        return $result->denda;
    }
    public function hitung_jumlahselesai($id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->where('Status_pinjam', 'Selesai');
        return $this->db->count_all_results('tbl_peminjaman');
    }

    public function get_data_peminjamanbysiswa($id_siswa)
    {
        $this->db->select('tbl_peminjamanitems.*,tbl_buku.judul_buku,tbl_peminjaman.kode_peminjaman');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->where('tbl_peminjaman.id_siswa', $id_siswa);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_data_pengembalianbysiswa($id_siswa)
    {
        $this->db->select('tbl_pengembalianitems.*,tbl_buku.judul_buku,tbl_pengambalian.kode_pengembalian,date,status');
        $this->db->from('tbl_pengembalianitems');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_pengembalianitems.id_pengembalian');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengembalianitems.id_buku');
        $this->db->where('tbl_pengambalian.id_siswa', $id_siswa);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_pembayaranbysiswa($id)
    {
        $this->db->select('tbl_denda.*,tbl_pengambalian.status,tbl_siswa.nama_siswa');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian ');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa ');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_total_pembayaran_siswa($id)
    {
        // Hitung total pembayaran
        $this->db->select_sum('tbl_denda.jumlah', 'total_pembayaran');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa ');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $query = $this->db->get();
        return $query->row()->total_pembayaran;
    }

    //rak
    public function get_all_rak()
    {
        $this->db->select('tbl_rak.*, COUNT(tbl_buku.id_buku) as jumlah_buku');
        $this->db->from('tbl_rak');
        $this->db->join('tbl_buku', 'tbl_buku.id_rak = tbl_rak.id_rak', 'left');
        $this->db->group_by('tbl_rak.id_rak');
        $query = $this->db->get();
        return $query->result();
    }

    public function edit_rak($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_rak');
        $this->db->where('tbl_rak.id_rak', $id);
        $query = $this->db->get();
        return $query->row();
    }


    //barcode siswa
    public function get_data_by_idsiswa($kode_siswa)
    {
        $query = $this->db->get_where('tbl_siswa', array('nisn' => $kode_siswa));
        return $query->row();
    }
    public function get_data_bykode($kode_buku)
    {
        $query = $this->db->get_where('tbl_buku', array('kode_buku' => $kode_buku));
        return $query->row();
    }
    public function get_data_by_idbuku($kode_buku, $id_siswa)
    {
        $this->db->select('tbl_buku.*, tbl_peminjamanitems.*, tbl_peminjaman.*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_peminjamanitems', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tbl_buku.kode_buku', $kode_buku);
        $this->db->where('tbl_peminjaman.id_siswa', $id_siswa);
        $this->db->where('tbl_peminjaman.status_pinjam !=', 'Selesai');
        $query = $this->db->get();
        return $query->row();
    }


    //buku
    public function get_kode_buku($kode_buku)
    {
        $query = $this->db->get_where('tbl_buku', array('kode_buku' => $kode_buku));
        return $query->row();
    }

    public function get_data_by_id_buku($id)
    {

        $query = $this->db->get_where('tbl_buku', array('id_buku' => $id));
        return $query->row();
    }

    public function get_all_buku()
    {
        $this->db->select('tbl_buku.*,tbl_kategori.*,tbl_rak.*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori');
        $query = $this->db->get();
        return $query->result();
    }
    public function cariData($keyword)
    {
        $this->db->select('tbl_buku.*,tbl_kategori.*,tbl_rak.*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori');
        $this->db->like('tbl_buku.judul_buku', $keyword);
        $this->db->or_like('tbl_buku.kode_buku', $keyword);
        $query = $this->db->get('');
        return $query->result();
    }

    public function get_buku_with_kategori($id)
    {
        $this->db->select('buku.*,tbl_rak.*, kategori.nama_kategori');
        $this->db->from('tbl_buku as buku');
        $this->db->join('tbl_kategori as kategori', 'buku.id_kategori = kategori.id_kategori', 'left');
        $this->db->join('tbl_rak', 'buku.id_rak = tbl_rak.id_rak');
        $this->db->where('buku.id_buku', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_jumlah_pinjam($id)
    {
        $this->db->select('tbl_buku.*,COUNT(*) as total');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->where('tbl_buku.id_buku', $id);
        $query = $this->db->get('tbl_peminjamanitems');

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['total'];
        } else {
            // Return 0 if no records found
            return 0;
        }
    }
    public function get_jumlah_kembali($id)
    {
        $this->db->select('tbl_buku.*,COUNT(*) as total');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengembalianitems.id_buku');
        $this->db->where('tbl_buku.id_buku', $id);
        $query = $this->db->get('tbl_pengembalianitems');

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['total'];
        } else {
            // Return 0 if no records found
            return 0;
        }
    }
    public function get_hilang($id)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->where('id_buku', $id);
        $this->db->where('kondisi_buku', 3);
        $query = $this->db->get('tbl_pengembalianitems');

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['total'];
        } else {
            // Return 0 if no records found
            return 0;
        }
    }
    public function get_rusak($id)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->where('id_buku', $id);
        $this->db->where('kondisi_buku', 2);
        $query = $this->db->get('tbl_pengembalianitems');

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['total'];
        } else {
            // Return 0 if no records found
            return 0;
        }
    }
    public function get_belum_kembali($id)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->where('id_buku', $id);
        $this->db->where('status', 'Belum Kembali');
        $query = $this->db->get('tbl_peminjamanitems');

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['total'];
        } else {
            // Return 0 if no records found
            return 0;
        }
    }
    public function get_terlambat($id)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->where('id_buku', $id);
        $this->db->where('status', 'Terlambat');
        $query = $this->db->get('tbl_peminjamanitems');

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['total'];
        } else {
            // Return 0 if no records found
            return 0;
        }
    }
    public function get_peminjamanbybulan($id)
    {
        $this->db->select('DATE_FORMAT(tanggal_pinjam, "%Y-%m") as bulan, COUNT(*) as total');
        $this->db->where('id_buku', $id);
        $query = $this->db->get('tbl_peminjamanitems');

        $this->db->select('DATE_FORMAT(tanggal_pinjam, "%Y-%m") as bulan, COUNT(*) as total');
        $this->db->where('id_buku', $id);
        $query = $this->db->get('tbl_peminjamanitems');

        if ($query->num_rows() > 0) {
            // Return the result as an array of month and count
            return $query->result_array();
        } else {
            // Return an empty array if no records found
            return [];
        }
    }

    //peminjaman 
    public function get_all_siswa()
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        $this->db->order_by('tbl_siswa.nama_siswa', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }




    //pagination peminjaman buku
    public function get_buku($limit, $start)
    {
        $this->db->select('tbl_buku.*,tbl_kategori.nama_kategori,tbl_rak.nama_rak,kode_rak');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
        $this->db->limit($limit, $start);
        $this->db->order_by('date_created', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_buku()
    {
        return $this->db->count_all('tbl_buku');
    }
    //pengurutan
    public function getSortedData($urutan, $limit, $offset)
    {

        switch ($urutan) {
            case 'judul_asc':
                $this->db->order_by('judul_buku', 'ASC');
                break;
            case 'judul_desc':
                $this->db->order_by('judul_buku', 'DESC');
                break;
            case 'tanggal_asc':
                $this->db->order_by('date_created', 'ASC');
                break;
            case 'tanggal_desc':
                $this->db->order_by('date_created', 'DESC');
                break;
            default:
                // Default sorting criteria
                $this->db->order_by('judul_buku', 'ASC');
                break;
        }

        // Get paginated data from the database
        $query = $this->db->get('tbl_buku', $limit, $offset);
        return $query->result();
    }
    public function countAllData()
    {
        return $this->db->count_all('tbl_siswa');
    }

    public function cariDatasiswa($keyword)
    {
        $this->db->group_start();
        $this->db->like('nama_siswa', $keyword);
        $this->db->or_like('kelas_siswa', $keyword);
        $this->db->group_end();
        $query = $this->db->get('tbl_siswa');
        return $query->result();
    }
    public function get_all_denda()
    {
        $query = $this->db->get('tbl_denda');
        return $query->result();
    }



    //riwayat  + pagination 
    public function get_peminjaman_info($limit, $offset)
    {
        $this->db->select('tbl_peminjaman.*, tbl_siswa.nama_siswa, tbl_admin.nama_admin');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $this->db->order_by('tbl_peminjaman.date_pinjam', 'DESC'); // Urutkan berdasarkan tanggal peminjaman secara descending (terbaru ke terlama)
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function countDatariwayat()
    {
        return $this->db->count_all('tbl_peminjaman');
    }

    public function get_peminjaman($id)
    {
        $this->db->select('tbl_peminjaman.*, tbl_siswa.*');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->where('tbl_peminjaman.id_peminjaman', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_detail_peminjaman_item($id)
    {
        $this->db->select('tbl_peminjamanitems.*, tbl_buku.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->where('tbl_peminjamanitems.id_peminjaman', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function update_tanggal_kembali($id_peminjamanitems, $tanggal_tambah)
    {

        if ($id_peminjamanitems && $tanggal_tambah) {

            $this->db->where('id_peminjamanitems', $id_peminjamanitems);
            $this->db->update('tbl_peminjamanitems', array('tanggal_kembali' => $tanggal_tambah));
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    public function sortriwayat($urutan, $limit, $offset)
    {
        switch ($urutan) {
            case '1':
                $this->db->where('DATE(tbl_peminjaman.date_pinjam)', date('Y-m-d'));
                break;
            case '2':
                $this->db->where('DATE(tbl_peminjaman.date_pinjam) >=', date('Y-m-d', strtotime('-1 week')));
                break;
            case '3':
                $this->db->where('DATE(tbl_peminjaman.date_pinjam) >=', date('Y-m-d', strtotime('-1 month')));
                break;
            default:

                break;
        }
        $this->db->select('tbl_peminjaman.*, tbl_siswa.nama_siswa, tbl_admin.nama_admin');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $this->db->order_by('tbl_peminjaman.date_pinjam', 'desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        return $query->result_array();
    }

    //pdf peminjaman 
    public function get_data($id)
    {
        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman', 'left');
        $this->db->where('tbl_peminjamanitems.id_peminjaman', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_data_peminjaman()
    {
        $this->db->select('tbl_peminjaman.*,tbl_siswa.*,tbl_admin.*');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $query = $this->db->get();
        return $query->result();
    }

    //pencarian riwayat
    public function search_peminjaman_by_kode($keyword)
    {
        $this->db->select('tbl_peminjaman.*, tbl_siswa.nama_siswa, tbl_admin.nama_admin');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');

        $this->db->group_start();
        $this->db->like('tbl_peminjaman.kode_peminjaman', $keyword);
        $this->db->or_like('tbl_siswa.nama_siswa', $keyword);
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();
    }


    public function update_status_terlambat_otomatis()
    {
        $this->db->where('status', 'Belum Kembali');
        $peminjaman = $this->db->get('tbl_peminjamanitems')->result();

        foreach ($peminjaman as $p) {

            if (strtotime($p->tanggal_kembali) < strtotime(date('Y-m-d'))) {

                $this->db->where('id_peminjamanitems', $p->id_peminjamanitems);
                $this->db->update('tbl_peminjamanitems', array('status' => 'Terlambat'));
            }
        }
    }
    public function hitung_denda_terlambat()
    {

        $this->db->where('status', 'Terlambat');
        $peminjaman_items = $this->db->get('tbl_peminjamanitems')->result();

        foreach ($peminjaman_items as $item) {

            $tanggal_kembali = strtotime($item->tanggal_kembali);
            $tanggal_sekarang = strtotime(date('Y-m-d'));
            $selisih_hari = floor(($tanggal_sekarang - $tanggal_kembali) / (60 * 60 * 24));

            $denda = $selisih_hari * 2000;

            $this->db->where('id_peminjamanitems', $item->id_peminjamanitems);
            $this->db->update('tbl_peminjamanitems', array('denda' => $denda));
        }
    }

    // public function hitung($id)
    // {

    // }

    //PENGEMBALIAN
    public function get_datapeminjaman_bysiswa($id)
    {
        $this->db->select('tbl_peminjaman.*, tbl_peminjamanitems.*, tbl_buku.*');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_peminjamanitems', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->where('tbl_peminjaman.id_siswa', $id);
        $this->db->where('tbl_peminjamanitems.status !=', 'Selesai');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_tblpeminjaman_bysiswa($kode_buku, $id_siswa)
    {
        $this->db->select('tbl_peminjaman.*,tbl_buku.*,tbl_peminjamanitems.*,tbl_siswa.id_siswa');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_peminjamanitems', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->where('tbl_buku.kode_buku', $kode_buku);
        $this->db->where('tbl_siswa.id_siswa', $id_siswa);
        $this->db->where_in('tbl_peminjamanitems.status', array('Belum Kembali', 'Terlambat'));
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_pengembalian_by_id($item_id)
    {
        $this->db->select('tbl_peminjamanitems.*, tbl_buku.judul_buku, tbl_peminjaman.kode_peminjaman');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tbl_peminjamanitems.id_peminjamanitems', $item_id); // Mengubah kondisi where menjadi id_peminjamanitems
        $query = $this->db->get();
        return $query->row(); // Menggunakan row() karena kita hanya ingin satu hasil, bukan array dari hasil
    }


    //PAGINATION riwayat pengembalian
    public function get_al_riwayatpengembalian($limit, $offset)
    {
        $this->db->select('tbl_pengambalian.*,tbl_siswa.*, tbl_admin.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->order_by('tbl_pengambalian.date', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function countDatariwayatpengembalian()
    {
        return $this->db->count_all('tbl_pengambalian');
    }

    public function sortriwayatpengembalian($urutan, $limit, $offset)
    {
        switch ($urutan) {
            case '1':
                $this->db->where('DATE(tbl_pengambalian.date)', date('Y-m-d'));
                break;
            case '2':
                $lastWeek = date('Y-m-d', strtotime('-1 week'));
                $this->db->where('DATE(tbl_pengambalian.date) >=', $lastWeek);
                $this->db->where('DATE(tbl_pengambalian.date) <=', date('Y-m-d'));
                break;
            case '3':
                $lastMonth = date('Y-m-d', strtotime('-1 month'));
                $this->db->where('DATE(tbl_pengambalian.date) >=', $lastMonth);
                $this->db->where('DATE(tbl_pengambalian.date) <=', date('Y-m-d'));
                break;
            default:
                redirect('riwayatkembali');
                break;
        }
        $this->db->select('tbl_pengambalian.*,tbl_siswa.*, tbl_admin.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function search_riwayat_by_kode($keyword)
    {
        $this->db->select('tbl_pengambalian.*,tbl_siswa.*, tbl_admin.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');

        $this->db->group_start();
        $this->db->like('tbl_pengambalian.kode_pengembalian', $keyword);
        $this->db->or_like('tbl_siswa.nama_siswa', $keyword);
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();
    }
    //detail pengembalian 
    public function get_pengembalian($id)
    {
        $this->db->select('tbl_pengambalian.*, tbl_siswa.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->where('tbl_pengambalian.id_pengembalian', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_detail_pengembalian_item($id)
    {
        $this->db->select('tbl_pengembalianitems.*, tbl_buku.*,tbl_rak.kode_rak,tbl_pengambalian.status');
        $this->db->from('tbl_pengembalianitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengembalianitems.id_buku');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_pengembalianitems.id_pengembalian ');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
        $this->db->where('tbl_pengembalianitems.id_pengembalian', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_pembayaran($id)
    {
        $this->db->select('tbl_denda.*');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian ');
        $this->db->where('tbl_pengambalian.id_pengembalian', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_total_pembayaran_update($id)
    {

        $this->db->select_sum('tbl_denda.jumlah', 'total_pembayaran');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian');
        $this->db->where('tbl_pengambalian.id_pengembalian', $id);
        $query = $this->db->get();
        $total_pembayaran = $query->row()->total_pembayaran;

        $this->db->select('total_denda');
        $this->db->from('tbl_pengambalian');
        $this->db->where('id_pengembalian', $id);
        $query = $this->db->get();
        $total_denda = $query->row()->total_denda;


        if ($total_pembayaran == $total_denda) {

            $this->db->set('status', 1);
        } else {
            $this->db->set('status', 3);
        }
        $this->db->where('id_pengembalian', $id);
        $this->db->update('tbl_pengambalian');

        return $total_pembayaran;
    }
    public function get_total_pembayaran($id)
    {
        $this->db->select_sum('tbl_denda.jumlah', 'total_pembayaran');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian');
        $this->db->where('tbl_pengambalian.id_pengembalian', $id);
        $query = $this->db->get();
        return $query->row()->total_pembayaran;
    }

    public function get_total_denda($id)
    {
        $this->db->select('total_denda');
        $this->db->from('tbl_pengambalian');
        $this->db->where('id_pengembalian', $id);
        $query = $this->db->get();
        return $query->row()->total_denda;
    }
    public function update_pembayaran($id)
    {
        $this->db->select_sum('tbl_denda.jumlah', 'total_pembayaran');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian');
        $this->db->where('tbl_pengambalian.id_pengembalian', $id);
        $query = $this->db->get();
        $total_pembayaran = $query->row()->total_pembayaran;

        $this->db->select('total_denda');
        $this->db->from('tbl_pengambalian');
        $this->db->where('id_pengembalian', $id);
        $query = $this->db->get();
        $total_denda = $query->row()->total_denda;

        if ($total_pembayaran == $total_denda) {

            $this->db->set('status', 1);
        } else {
            $this->db->set('status', 3);
        }
        $this->db->where('id_pengembalian', $id);
        $this->db->update('tbl_pengambalian');

        if ($total_pembayaran == $total_denda) {

            $this->db->set('status', 1);
        } else {
            $this->db->set('status', 3);
        }
        $this->db->where('id_pengembalian', $id);
        $this->db->update('tbl_pengambalian');
    }

    //denda
    public function get_denda()
    {

        $this->db->select('id_pengembalian, SUM(jumlah) as total_pembayaran');
        $this->db->from('tbl_denda');
        $this->db->group_by('id_pengembalian');
        $subquery = $this->db->get_compiled_select();

        $this->db->select('tbl_pengambalian.*, tbl_siswa.*, tbl_admin.*, IFNULL(subquery.total_pembayaran, 0) as total_pembayaran');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->join("($subquery) as subquery", 'tbl_pengambalian.id_pengembalian = subquery.id_pengembalian', 'left');
        $this->db->where_in('tbl_pengambalian.status', [2, 3]);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_denda_lunas()
    {

        $this->db->select('id_pengembalian, SUM(jumlah) as total_pembayaran');
        $this->db->from('tbl_denda');
        $this->db->group_by('id_pengembalian');
        $subquery = $this->db->get_compiled_select();

        $this->db->select('tbl_pengambalian.*, tbl_siswa.*, tbl_admin.*, IFNULL(subquery.total_pembayaran, 0) as total_pembayaran');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->join("($subquery) as subquery", 'tbl_pengambalian.id_pengembalian = subquery.id_pengembalian', 'left');
        // $this->db->where_in('tbl_pengambalian.total_denda', [2, 3]);
        $this->db->where('tbl_pengambalian.total_denda !=', 0);
        $query = $this->db->get();
        return $query->result();
    }


    public function countDatadenda()
    {
        return $this->db->count_all('tbl_denda');
    }

    public function cari_denda_siswa($a, $w)
    {
        $this->db->select('tbl_denda.*,tbl_pengambalian.kode_pengembalian');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian');
        $this->db->where('tbl_denda.date_bayar >=', $a);
        $this->db->where('tbl_denda.date_bayar <=', $w);
        $this->db->order_by('tbl_denda.date_bayar', 'ASC');

        $query = $this->db->get();
        if ($query === FALSE) {
            return [];  // Return empty array on failure
        }

        return $query->result();  // Return query results
    }


    //dasboard
    public function hitung_jumlah_peminjaman()
    {
        return $this->db->count_all('tbl_peminjaman');
    }
    public function hitung_jumlahbuku()
    {
        return $this->db->count_all('tbl_buku');
    }
    public function hitung_jumlahsiswa()
    {
        return $this->db->count_all('tbl_siswa');
    }
    public function hitung_jumlahkategori()
    {
        return $this->db->count_all('tbl_kategori');
    }
    public function hitung_jumlahrak()
    {
        return $this->db->count_all('tbl_rak');
    }
    public function hitung_jumlahpinjamitem()
    {
        return $this->db->count_all('tbl_peminjamanitems');
    }
    public function hitung_jumlahkembaliitem()
    {
        return $this->db->count_all('tbl_pengembalianitems');
    }

    public function hitung_jumlahpinjam()
    {
        return $this->db->count_all('tbl_peminjaman');
    }
    public function hitung_jumlahpengembalian()
    {
        return $this->db->count_all('tbl_pengambalian');
    }
    public function get_total_pembayarands()
    {

        $this->db->select_sum('jumlah', 'total_pembayaran');
        $this->db->from('tbl_denda');
        $query = $this->db->get();


        if ($query->num_rows() > 0) {

            return $query->row()->total_pembayaran;
        } else {

            return 0;
        }
    }

    public function get_peminjaman_today()
    {
        $today = date('Y-m-d');
        $this->db->where('DATE(date_pinjam)', $today);
        $count = $this->db->count_all_results('tbl_peminjaman');
        return $count;
    }
    public function get_pengembalian_today()
    {
        $today = date('Y-m-d');
        $this->db->where('DATE(date)', $today);
        $count = $this->db->count_all_results('tbl_pengambalian');
        return $count;
    }
    public function get_pembayaran_today()
    {
        $today = date('Y-m-d');
        $this->db->where('DATE(date_bayar)', $today);
        $count = $this->db->count_all_results('tbl_denda');
        return $count;
    }
    public function get_denda_today()
    {
        $this->db->where('status', 'Terlambat');
        $count = $this->db->count_all_results('tbl_peminjamanitems');
        return $count;
    }

    //peminjaman item
    public function get_peminjamanitemsds()
    {
        $hari = date('Y-m-d', strtotime('-7 days'));
        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tbl_peminjamanitems.tanggal_pinjam >=', $hari);
        $this->db->order_by('tbl_peminjamanitems.tanggal_pinjam', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_pengembalianitemsds()
    {
        $hari = date('Y-m-d', strtotime('-7 days'));
        $this->db->select('tbl_pengembalianitems.*, tbl_buku.*, tbl_pengambalian.date,kode_pengembalian,status');
        $this->db->from('tbl_pengembalianitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengembalianitems.id_buku');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_pengembalianitems.id_pengembalian');
        $this->db->where('tbl_pengambalian.date >=', $hari);
        $this->db->order_by('tbl_pengambalian.date', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_dendads()
    {
        $hari = date('Y-m-d', strtotime('-7 days'));
        $this->db->select('tbl_denda.*, tbl_pengambalian.total_denda');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian');
        $this->db->where('tbl_denda.date_bayar >=', $hari);
        $this->db->order_by('tbl_denda.date_bayar', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_peminjamanitems($limit, $offset)
    {

        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');

        $this->db->order_by('tbl_peminjamanitems.tanggal_pinjam', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_peminjamanitem_print()
    {

        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->order_by('tbl_peminjamanitems.tanggal_pinjam', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function countpeminjaman()
    {
        return $this->db->count_all('tbl_peminjamanitems');
    }

    //sort tanggal dasboard 
    public function get_sorted_data($start_date, $end_date)
    {
        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tanggal_pinjam >=', $start_date);
        $this->db->where('tanggal_pinjam <=', $end_date);
        $this->db->order_by('tanggal_pinjam', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }
    //print laporan peminjamanitems
    public function print_peminjamanitems()
    {
        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->order_by('tbl_peminjamanitems.tanggal_pinjam', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    //laporan admin
    public function get_admin()
    {
        $query = $this->db->get('tbl_admin');
        return $query->result();
    }
    public function get_peminjaman_count()
    {
        return $this->db->from('tbl_peminjaman')->count_all_results();
    }
    public function get_pengembalian_count()
    {
        return $this->db->from('tbl_pengambalian')->count_all_results();
    }
    public function get_buku_count()
    {
        return $this->db->from('tbl_buku')->count_all_results();
    }
    public function get_siswa_count()
    {
        return $this->db->from('tbl_siswa')->count_all_results();
    }
    public function get_kategori_count()
    {
        return $this->db->from('tbl_kategori')->count_all_results();
    }
    public function get_rak_count()
    {
        return $this->db->from('tbl_rak')->count_all_results();
    }
    public function get_denda_count()
    {
        return $this->db->from('tbl_denda')->count_all_results();
    }
    public function get_peminjamanitem_count()
    {
        return $this->db->from('tbl_peminjamanitems')->count_all_results();
    }
    public function get_pengembalianitem_count()
    {
        return $this->db->from('tbl_pengembalianitems')->count_all_results();
    }

    public function all_hitung_jumlahtotalpembayaran()
    {
        $this->db->select_sum('jumlah', 'total');
        $this->db->from('tbl_denda');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }

    public function all_hitung_jumlahdenda()
    {
        $this->db->select_sum('denda', 'total');
        $this->db->from('tbl_peminjamanitems');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }



    public function laporan_admin_peminjaman($id, $a, $w)
    {

        $this->db->select('tbl_peminjaman.*, tbl_siswa.nama_siswa, tbl_admin.nama_admin');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $this->db->where('tbl_peminjaman.id_admin', $id);
        $this->db->where('tbl_peminjaman.date_pinjam >=', $a);
        $this->db->where('tbl_peminjaman.date_pinjam <=', $w);
        $this->db->order_by('tbl_peminjaman.date_pinjam', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function laporan_admin_peminjamanitems($id, $a, $w)
    {

        $this->db->select('tbl_peminjamanitems.*,tbl_peminjaman.*, tbl_buku.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tbl_peminjaman.id_admin', $id);
        $this->db->where('tbl_peminjaman.date_pinjam >=', $a);
        $this->db->where('tbl_peminjaman.date_pinjam <=', $w);
        $this->db->order_by('tbl_peminjaman.date_pinjam', 'Az');
        $query = $this->db->get();
        return $query->result();
    }

    public function laporan_admin_pengembalian($id, $a, $w)
    {
        $this->db->select('tbl_pengambalian.*,tbl_siswa.*, tbl_admin.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->where('tbl_pengambalian.id_admin', $id);
        $this->db->where('tbl_pengambalian.date >=', $a);
        $this->db->where('tbl_pengambalian.date <=', $w);
        $this->db->order_by('tbl_pengambalian.date', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function laporan_admin_pengembalianitem($id, $a, $w)
    {
        $this->db->select('tbl_pengembalianitems.*,tbl_pengambalian.*, tbl_buku.*');
        $this->db->from('tbl_pengembalianitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengembalianitems.id_buku');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_pengembalianitems.id_pengembalian');
        $this->db->where('tbl_pengambalian.id_admin', $id);
        $this->db->where('tbl_pengambalian.date >=', $a);
        $this->db->where('tbl_pengambalian.date <=', $w);
        $this->db->order_by('tbl_pengambalian.date', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function hitung_jumlah_peminjamanlaporan($id, $a, $w)
    {
        $this->db->where('tbl_peminjaman.id_admin', $id);
        $this->db->where('tbl_peminjaman.date_pinjam >=', $a);
        $this->db->where('tbl_peminjaman.date_pinjam <=', $w);
        return $this->db->count_all_results('tbl_peminjaman');
    }
    public function hitung_jumlah_pengembalianlaporan($id, $a, $w)
    {
        $this->db->where('tbl_pengambalian.id_admin', $id);
        $this->db->where('tbl_pengambalian.date >=', $a);
        $this->db->where('tbl_pengambalian.date <=', $w);
        return $this->db->count_all_results('tbl_pengambalian');
    }
    public function hitung_jumlahbukulaporan($a, $w)
    {

        $this->db->where('tbl_buku.date_created >=', $a);
        $this->db->where('tbl_buku.date_created <=', $w);
        return $this->db->count_all_results('tbl_buku');
    }
    public function hitung_jumlahsiswalaporan($a, $w)
    {

        $this->db->where('tbl_siswa.datecreated >=', $a);
        $this->db->where('tbl_siswa.datecreated <=', $w);
        return $this->db->count_all_results('tbl_siswa');
    }
    public function hitung_jumlahpembayaran($a, $w)
    {

        $this->db->where('tbl_denda.date_bayar >=', $a);
        $this->db->where('tbl_denda.date_bayar <=', $w);
        return $this->db->count_all_results('tbl_denda');
    }
    public function hitung_jumlahpeminjamanitem($a, $w)
    {
        $this->db->select_sum('total_peminjaman', 'total');
        $this->db->from('tbl_peminjaman');
        $this->db->where('tbl_peminjaman.date_pinjam >=', $a);
        $this->db->where('tbl_peminjaman.date_pinjam <=', $w);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }
    public function hitung_jumlahpengembalianitem($a, $w)
    {
        $this->db->select_sum('total_pengembalian', 'total');
        $this->db->from('tbl_pengambalian');
        $this->db->where('tbl_pengambalian.date >=', $a);
        $this->db->where('tbl_pengambalian.date <=', $w);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }
    public function hitung_jumlahtotalpembayaran($a, $w)
    {
        $this->db->select_sum('jumlah', 'total');
        $this->db->from('tbl_denda');
        $this->db->where('tbl_denda.date_bayar >=', $a);
        $this->db->where('tbl_denda.date_bayar <=', $w);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }
    public function hitung_jumlahdenda($a, $w)
    {
        $this->db->select_sum('denda', 'total');
        $this->db->from('tbl_peminjamanitems');
        $this->db->where('tbl_peminjamanitems.tanggal_pinjam >=', $a);
        $this->db->where('tbl_peminjamanitems.tanggal_pinjam <=', $w);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }


    public function get_book_code()
    {
        // Ambil kode buku dari tabel buku
        $query = $this->db->select('book_code')
            ->from('book')
            ->limit(1) // Anda bisa ubah sesuai kebutuhan
            ->get();

        // Return kode buku jika ada
        if ($query->num_rows() > 0) {
            return $query->row()->book_code;
        } else {
            return false; // Return false jika tidak ada kode buku
        }
    }


    //laporan all 

    public function get_all_anggota()
    {
        $query = $this->db->get('tbl_siswa');
        return $query->result();
    }
    
}
