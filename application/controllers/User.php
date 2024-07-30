<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model('jabatan_m');
        // $this->load->model('lowongan_m');
        $this->load->model('admin_m');
        // $this->load->model('alumni_m');

        $level_akun = $this->session->userdata('level');
        if ($level_akun != "user") {
            return redirect('auth');
        }
    }

    public function index()
    {
        $data['nama'] = $this->session->userdata('nama');

        $data['judul'] = 'Dashboard';

        $this->load->view('template_user/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template_user/footer', $data);
    }
    public function data_pengguna()
    {
        $data['judul'] = 'User';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->get_all_akun();
        $this->load->view('template_user/header', $data);
        $this->load->view('user/akun/data_akun', $data);
        $this->load->view('template_user/footer');
    }
    public function tambah_akun()
    {
        $data['judul'] = 'User';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->get_all_akun();
        $this->load->view('template_user/header', $data);
        $this->load->view('user/akun/input_akun', $data);
        $this->load->view('template_user/footer');
    }
    public function edit_akun($id_akun)
    {
        $data['judul'] = 'User';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->get_row_akun($id_akun);
        $this->load->view('template_user/header', $data);
        $this->load->view('user/akun/edit_akun', $data);
        $this->load->view('template_user/footer');
    }
    public function proses_tambah_akun()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'nama' => $this->input->post('nama'),
            'password' => md5($this->input->post('password')),
            'bidang' => $this->input->post('bidang'),
            'jabatan' => $this->input->post('jabatan'),
            'level' => "user",

        );

        $this->db->insert('akun', $data);
        return redirect('user/data_pengguna');
    }
    public function hapus_akun($id_akun)
    {
        $this->db->where('id_akun', $id_akun);
        $this->db->delete('akun');
        return redirect('user/data_pengguna');
    }
    // public function hapus_suratizin($id_surat_izin)
    // {
    //     $this->db->where('id_surat_izin', $id_surat_izin);
    //     $this->db->delete('surat_izin');
    //     return redirect('user/surat_izin');
    // }
    public function proses_edit_akun($id_akun)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'nama' => $this->input->post('nama'),
            'password' => md5($this->input->post('password')),
            'bidang' => $this->input->post('bidang'),
            'jabatan' => $this->input->post('jabatan'),

        );
        $this->db->where('id_akun', $id_akun);
        $this->db->update('akun', $data);
        return redirect('user/data_pengguna');
    }
    public function ubah_admin($id_akun)
    {
        $data = array(
            'level' => "admin",

        );
        $this->db->where('id_akun', $id_akun);
        $this->db->update('akun', $data);
        return redirect('user/data_pengguna');
    }
    public function ubah_user($id_akun)
    {
        $data = array(
            'level' => "user",

        );
        $this->db->where('id_akun', $id_akun);
        $this->db->update('akun', $data);
        return redirect('user/data_pengguna');
    }

    public function data_peminjaman()
    {
        $data['judul'] = 'User';
        $data['nama'] = $this->session->userdata('nama');
        $data['peminjaman'] = $this->admin_m->get_all_peminjaman();
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $this->load->view('template_user/header', $data);
        $this->load->view('user/peminjaman/data_peminjaman', $data);
        $this->load->view('template_user/footer');
    }


    public function tambah_peminjaman() //view inpu 
    {
        $data['judul'] = 'User';
        $data['nama'] = $this->session->userdata('nama');
        $data['peminjaman'] = $this->admin_m->get_all_peminjaman();
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $this->load->view('template_user/header', $data);
        $this->load->view('user/peminjaman/input_peminjaman', $data);
        $this->load->view('template_user/footer');
    }

    public function proses_tambahpeminjaman()
    {
        $data = array(
            'tanggal_peminjaman' => $this->input->post('tanggal_peminjaman'),
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'jumlah' => $this->input->post('jumlah'),
            'tujuan' => $this->input->post('tujuan'),
            'tanggal_pengembalian' => $this->input->post('tanggal_pengembalian'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'status_peminjaman' => 'Menunggu Persetujuan'
        );
        $this->db->insert('peminjaman_b', $data);
        redirect('user/data_peminjaman');
    }

    //-------------------------------------------------------PENGEMBALIAN BARANG--------------------------------------------------------------------------

    public function data_pengembalian()
    {
        $data['judul'] = 'User';
        $data['nama'] = $this->session->userdata('nama');
        $data['pengembalian'] = $this->admin_m->get_all_pengembalian();
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $this->load->view('template_user/header', $data);
        $this->load->view('user/pengembalian/data_pengembalian', $data);
        $this->load->view('template_user/footer');
    }


    public function tambah_pengembalian() //view inpu 
    {
        $data['judul'] = 'User';
        $data['nama'] = $this->session->userdata('nama');
        $data['pengembalian'] = $this->admin_m->get_all_pengembalian();
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $this->load->view('template_user/header', $data);
        $this->load->view('user/pengembalian/input_pengembalian', $data);
        $this->load->view('template_user/footer');
    }

    public function proses_tambahpengembalian()
    {
        $data = array(
            'tanggal_pengembalian' => $this->input->post('tanggal_pengembalian'),
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'jumlah' => $this->input->post('jumlah'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'status_pengembalian' => 'Dalam Proses'
        );
        $this->db->insert('pengembalian_b', $data);
        redirect('user/data_pengembalian');
    }
}

/* End of file User.php */
