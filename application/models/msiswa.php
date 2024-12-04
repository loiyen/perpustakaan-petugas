<?php
class msiswa extends CI_Model
{
    public function check_login($u, $p)
    {
        $this->db->select('id_siswa,nama_siswa,password');
        $this->db->from('tbl_siswa');
        $this->db->where('nama_siswa', $u);
        $query = $this->db->get();

        $user = $query->row_array();

        if ($user) {
            if (password_verify($p, $user['password'])) {
                return $user;
            } else {
                $this->session->set_flashdata('gagal', 'Verifikasi kata sandi gagal.');
                redirect('siswapanel');
            }
        } else {
            $this->session->set_flashdata('gagal', 'Nama siswa tidak ditemukan.');
            redirect('siswapanel');
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

    public function check_kode($kode)
    {
        $this->db->select('id_siswa,nama_siswa,kode_akses');
        $this->db->from('tbl_siswa');
        $this->db->where('kode_akses', $kode);
        $query = $this->db->get();
        return $query->result();
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
    ///

    //hirungdata
    public function hitung_jumlahpinjam($id)
    {
        $this->db->where('id_siswa', $id);
        return $this->db->count_all_results('tbl_peminjaman');
    }
    public function hitung_jumlahkembali($id)
    {
        $this->db->where('id_siswa', $id);
        return $this->db->count_all_results('tbl_pengambalian');
    }
    public function hitung_pembayaran($id)
    {
        $this->db->select_sum('jumlah');
        $this->db->where('id_siswa', $id);
        $query = $this->db->get('tbl_pembayaran');
        return $query->row()->jumlah;
    }
    public function hitung_jumlahterlambat($id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->where('denda', 2);
        return $this->db->count_all_results('tbl_pengambalian');
    }
    public function hitung_jumlahterlambat1($id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->where('denda', 3);
        return $this->db->count_all_results('tbl_pengambalian');
    }
    public function hitung_jumlahthilang($id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->where('denda', 4);
        return $this->db->count_all_results('tbl_pengambalian');
    }

   
}
