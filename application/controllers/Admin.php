<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin_m');

        $level_akun = $this->session->userdata('level');
        if ($level_akun != "admin") {
            return redirect('auth');
        }
    }

    public function index()
    {
        $data['nama'] = $this->session->userdata('nama');

        $data['judul'] = 'Dashboard';

        $this->load->view('template/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer', $data);
    }
    public function data_pengguna()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->get_all_akun();
        $this->load->view('template/header', $data);
        $this->load->view('admin/akun/data_akun', $data);
        $this->load->view('template/footer');
    }
    public function tambah_akun()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->get_all_akun();
        $this->load->view('template/header', $data);
        $this->load->view('admin/akun/input_akun', $data);
        $this->load->view('template/footer');
    }
    public function edit_akun($id_akun)
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->get_row_akun($id_akun);
        $this->load->view('template/header', $data);
        $this->load->view('admin/akun/edit_akun', $data);
        $this->load->view('template/footer');
    }
    public function proses_tambah_akun()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'password' => md5($this->input->post('password')),
            'level' => "user",

        );

        $this->db->insert('akun', $data);
        return redirect('admin/data_pengguna');
    }
    public function hapus_akun($id_akun)
    {
        $this->db->where('id_akun', $id_akun);
        $this->db->delete('akun');
        return redirect('admin/data_pengguna');
    }
    public function hapus_suratizin($id_surat_izin)
    {
        $this->db->where('id_surat_izin', $id_surat_izin);
        $this->db->delete('surat_izin');
        return redirect('admin/surat_izin');
    }
    public function proses_edit_akun($id_akun)
    {
        $data = array(
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'password' => md5($this->input->post('password')),

        );
        $this->db->where('id_akun', $id_akun);
        $this->db->update('akun', $data);
        return redirect('admin/data_pengguna');
    }
    public function ubah_admin($id_akun)
    {
        $data = array(
            'level' => "admin",

        );
        $this->db->where('id_akun', $id_akun);
        $this->db->update('akun', $data);
        return redirect('admin/data_pengguna');
    }
    public function ubah_user($id_akun)
    {
        $data = array(
            'level' => "user",

        );
        $this->db->where('id_akun', $id_akun);
        $this->db->update('akun', $data);
        return redirect('admin/data_pengguna');
    }

    // barang master----------------------------------------------------------------------------------------------------------------------------------------------------------

    public function data_barang()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_barang();
        $this->load->view('template/header', $data);
        $this->load->view('admin/data_barang/data_barang', $data);
        $this->load->view('template/footer');
    }

    public function tambah_barang()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/data_barang/input_barang', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambah_barang()
    {
        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'stok' => $this->input->post('stok'),
        );

        $this->db->insert('barang', $data);
        return redirect('admin/data_barang');
    }

    public function proses_edit_barang($id_barang)
    {
        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'stok' => $this->input->post('stok'),

        );
        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang', $data);
        return redirect('admin/data_barang');
    }

    public function hapus_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('barang');
        return redirect('admin/data_barang');
    }

    // kategori master -------------------------------------------------------------------------------------------------------------------------------------

    public function data_kategori()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_kategori();
        $this->load->view('template/header', $data);
        $this->load->view('admin/kategori/data_kategori', $data);
        $this->load->view('template/footer');
    }

    public function tambah_kategori()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/kategori/input_kategori', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambah_kategori()
    {
        $data = array(
            'kategori' => $this->input->post('kategori'),

        );

        $this->db->insert('kategori', $data);
        return redirect('admin/data_kategori');
    }

    public function proses_edit_kategori($id_kategori)
    {
        $data = array(
            'kategori' => $this->input->post('kategori'),

        );
        $this->db->where('id_kategori', $id_kategori);
        $this->db->update('kategori', $data);
        return redirect('admin/data_kategori');
    }

    public function hapus_kategori($id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->delete('kategori');
        return redirect('admin/data_kategori');
    }

    // lokasi master-----------------------------------------------------------------------------------------------------------------------------------------

    public function data_lokasi()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_lokasi();
        $this->load->view('template/header', $data);
        $this->load->view('admin/lokasi/data_lokasi', $data);
        $this->load->view('template/footer');
    }

    public function tambah_lokasi()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/lokasi/input_lokasi', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambah_lokasi()
    {
        $data = array(
            'lokasi' => $this->input->post('lokasi'),

        );

        $this->db->insert('lokasi', $data);
        return redirect('admin/data_lokasi');
    }

    public function proses_edit_lokasi($id_lokasi)
    {
        $data = array(
            'lokasi' => $this->input->post('lokasi'),

        );
        $this->db->where('id_lokasi', $id_lokasi);
        $this->db->update('lokasi', $data);
        return redirect('admin/data_lokasi');
    }

    public function hapus_lokasi($id_lokasi)
    {
        $this->db->where('id_lokasi', $id_lokasi);
        $this->db->delete('lokasi');
        return redirect('admin/data_lokasi');
    }


    // pegawai master-----------------------------------------------------------------------------------------------------------------------------------------

    public function data_pegawai()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_pegawai();
        $this->load->view('template/header', $data);
        $this->load->view('admin/pegawai/data_pegawai', $data);
        $this->load->view('template/footer');
    }

    public function tambah_pegawai()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/pegawai/input_pegawai', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambah_pegawai()
    {
        $data = array(
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'jabatan' => $this->input->post('jabatan'),

        );

        $this->db->insert('pegawai', $data);
        return redirect('admin/data_pegawai');
    }

    public function proses_edit_pegawai($id_pegawai)
    {
        $data = array(
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'jabatan' => $this->input->post('jabatan'),

        );
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->update('pegawai', $data);
        return redirect('admin/data_pegawai');
    }

    public function hapus_pegawai($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->delete('pegawai');
        return redirect('admin/data_pegawai');
    }

    // supplier master --------------------------------------------------------------------------------------------------------------------------------

    public function data_supplier()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_supplier();
        $this->load->view('template/header', $data);
        $this->load->view('admin/supplier/data_supplier', $data);
        $this->load->view('template/footer');
    }

    public function tambah_supplier()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('admin/supplier/input_supplier', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambah_supplier()
    {
        $data = array(
            'nama_supplier' => $this->input->post('nama_supplier'),
            'alamat' => $this->input->post('alamat'),
            'no_telp' => $this->input->post('no_telp'),
        );

        $this->db->insert('supplier', $data);
        return redirect('admin/data_supplier');
    }

    public function proses_edit_supplier($id_supplier)
    {
        $data = array(
            'nama_supplier' => $this->input->post('nama_supplier'),
            'alamat' => $this->input->post('alamat'),
            'no_telp' => $this->input->post('no_telp'),
        );
        $this->db->where('id_supplier', $id_supplier);
        $this->db->update('supplier', $data);
        return redirect('admin/data_supplier');
    }

    public function hapus_supplier($id_supplier)
    {
        $this->db->where('id_supplier', $id_supplier);
        $this->db->delete('supplier');
        return redirect('admin/data_supplier');
    }

    // BATAS DATA MASTER------------------------------------------------------------------------------------------------------------------------
    // STOK BARANG-----------------------------------------------------------------------------------------------------------------------------------------------------------

    public function data_stokbarang()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama'); // Assuming 'nama' is a session variable holding user's name

        // Load your model (assuming it's named Admin_m)
        $this->load->model('Admin_m', 'admin_m');

        // Fetch all barang, kategori, and stokbarang
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();

        // Get all stokbarang
        $stokbarang = $this->admin_m->get_all_stokbarang();

        // Apply filters
        if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
            $kategori_filter = $_GET['kategori'];
            $stokbarang = array_filter($stokbarang, function ($x) use ($kategori_filter) {
                return $x->id_kategori == $kategori_filter;
            });
        }

        if (isset($_GET['tanggalupdate']) && !empty($_GET['tanggalupdate'])) {
            // Convert input dates to PHP date objects
            $tanggalupdate_filter = date('Y-m-d', strtotime($_GET['tanggalupdate']));
            $tanggalakhir_filter = isset($_GET['tanggalakhir']) ? date('Y-m-d', strtotime($_GET['tanggalakhir'])) : $tanggalupdate_filter;

            // Filter stokbarang based on date range
            $stokbarang = array_filter($stokbarang, function ($x) use ($tanggalupdate_filter, $tanggalakhir_filter) {
                $tanggal_stok = date('Y-m-d', strtotime($x->tanggalupdate));
                return ($tanggal_stok >= $tanggalupdate_filter && $tanggal_stok <= $tanggalakhir_filter);
            });
        }

        $data['stokbarang'] = $stokbarang;

        // Load views with data
        $this->load->view('template/header', $data);
        $this->load->view('admin/stok_barang/data_stokbarang', $data);
        $this->load->view('template/footer');
    }


    public function tambah_stokbarang() //view inpu stok
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_barang(); //function model join master data barang
        $data['kategori'] = $this->admin_m->get_all_kategori(); //function model join master kategori
        $this->load->view('template/header', $data);
        $this->load->view('admin/stok_barang/input_stokbarang', $data);
        $this->load->view('template/footer');
    }
    public function proses_tambahstokbarang()
    {
        // Ambil data dari inputan form
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'tanggalupdate' => $this->input->post('tanggalupdate'),
            'satuan' => $this->input->post('satuan'),
            'hargaunit' => $this->input->post('hargaunit') ? number_format((float)$this->input->post('hargaunit'), 2, '.', '') : null,
        );

        // Masukkan data ke dalam tabel 'stok_b'
        $this->db->insert('stok_b', $data);

        // Redirect kembali ke halaman data stok barang
        redirect('admin/data_stokbarang');
    }



    public function proses_editstokbarang($id_stok)
    {
        // Ambil data dari inputan form
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'tanggalupdate' => $this->input->post('tanggalupdate'),
            'satuan' => $this->input->post('satuan'),
            'hargaunit' => $this->input->post('hargaunit') ? number_format((float)$this->input->post('hargaunit'), 2, '.', '') : null,
        );

        // Update data di tabel 'stok_b' berdasarkan id_stok
        $this->db->where('id_stok', $id_stok);
        $this->db->update('stok_b', $data);

        // Redirect kembali ke halaman data stok barang
        return redirect('admin/data_stokbarang');
    }


    public function hapus_stokbarang($id_stok)
    {
        $this->db->where('id_stok', $id_stok);
        $this->db->delete('stok_b');
        return redirect('admin/data_stokbarang');
    }

    public function cetak_stokbarang()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $stokbarang = $this->admin_m->get_all_stokbarang();

        // Get filter parameters
        $kategori = $this->input->get('kategori');
        $tanggalmulai = $this->input->get('tanggalmulai');
        $tanggalakhir = $this->input->get('tanggalakhir');

        // Apply filters
        $filteredStokbarang = [];
        foreach ($stokbarang as $x) {
            $isFiltered = true;
            if (!empty($kategori) && $kategori != $x->id_kategori) {
                $isFiltered = false;
            }
            if (!empty($tanggalmulai)) {
                $tanggal_mulai = date('Y-m-d', strtotime($tanggalmulai));
                if (date('Y-m-d', strtotime($x->tanggalupdate)) < $tanggal_mulai) {
                    $isFiltered = false;
                }
            }
            if (!empty($tanggalakhir)) {
                $tanggal_akhir = date('Y-m-d', strtotime($tanggalakhir));
                if (date('Y-m-d', strtotime($x->tanggalupdate)) > $tanggal_akhir) {
                    $isFiltered = false;
                }
            }
            if ($isFiltered) {
                $filteredStokbarang[] = $x;
            }
        }

        $data['stokbarang'] = $filteredStokbarang;
        // $this->load->view('template/header', $data);
        $this->load->view('admin/stok_barang/cetak_stokbarang', $data);
        // $this->load->view('template/footer');
    }

    // BARANG MASUK----------------------------------------------------------------------------------------------------------- --------------------------------------

    public function data_barang_masuk()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama'); // Assuming 'nama' is a session variable holding user's name

        // Load your model (assuming it's named Admin_m)
        $this->load->model('Admin_m', 'admin_m');

        // Fetch all barang, kategori, and barang_masuk
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['supplier'] = $this->admin_m->get_all_supplier();

        // Get all barang_masuk
        $barang_masuk = $this->admin_m->get_all_barang_masuk();

        // Apply filters
        if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
            $kategori_filter = $_GET['kategori'];
            $barang_masuk = array_filter($barang_masuk, function ($x) use ($kategori_filter) {
                return $x->id_kategori == $kategori_filter;
            });
        }

        if (isset($_GET['tanggal_masuk']) && !empty($_GET['tanggal_masuk'])) {
            // Convert input dates to PHP date objects
            $tanggal_masuk_filter = date('Y-m-d', strtotime($_GET['tanggal_masuk']));
            $tanggalakhir_filter = isset($_GET['tanggalakhir']) ? date('Y-m-d', strtotime($_GET['tanggalakhir'])) : $tanggal_masuk_filter;

            // Filter barang_masuk based on date range
            $barang_masuk = array_filter($barang_masuk, function ($x) use ($tanggal_masuk_filter, $tanggalakhir_filter) {
                $tanggal_stok = date('Y-m-d', strtotime($x->tanggal_masuk));
                return ($tanggal_stok >= $tanggal_masuk_filter && $tanggal_stok <= $tanggalakhir_filter);
            });
        }

        $data['barang_masuk'] = $barang_masuk;

        // Load views with data
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang_masuk/data_barang_masuk', $data);
        $this->load->view('template/footer');
    }


    public function tambah_barang_masuk() //view inpu stok
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_barang(); //function model join master data barang
        $data['kategori'] = $this->admin_m->get_all_kategori(); //function model join master kategori
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['supplier'] = $this->admin_m->get_all_supplier();
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang_masuk/input_barang_masuk', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambahbarang_masuk()
    {
        // Ambil data umum dari inputan form
        $tanggal_masuk = $this->input->post('tanggal_masuk');
        $id_pegawai = $this->input->post('id_pegawai');
        $id_supplier = $this->input->post('id_supplier');

        // Ambil data barang dari inputan form
        $items = $this->input->post('items');

        // Proses setiap barang yang ditambahkan
        foreach ($items as $item) {
            $data = array(
                'id_barang' => $item['id_barang'],
                'id_kategori' => $item['id_kategori'],
                'jumlahm' => $item['jumlahm'],
                'tanggal_masuk' => $tanggal_masuk,
                'id_pegawai' => $id_pegawai,
                'id_supplier' => $id_supplier,
            );

            // Masukkan data ke dalam tabel 'b_masuk'
            $this->db->insert('b_masuk', $data);
        }

        // Redirect kembali ke halaman data barang masuk
        redirect('admin/data_barang_masuk');
    }


    public function proses_editbarang_masuk($id_bmasuk)
    {
        $data = array(
            // 'id_bmasuk' => $this->input->post('id_bmasuk'),
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'id_supplier' => $this->input->post('id_supplier'),
            'jumlahm' => $this->input->post('jumlahm'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
        );
        $this->db->where('id_bmasuk', $id_bmasuk);
        $this->db->update('b_masuk', $data);
        return redirect('admin/data_barang_masuk');
    }

    public function hapus_barang_masuk($id_bmasuk)
    {
        $this->db->where('id_bmasuk', $id_bmasuk);
        $this->db->delete('b_masuk');
        return redirect('admin/data_barang_masuk');
    }

    public function cetak_barang_masuk()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['supplier'] = $this->admin_m->get_all_supplier();
        $barang_masuk = $this->admin_m->get_all_barang_masuk();


        // Get filter parameters
        $kategori = $this->input->get('kategori');
        $tanggalmulai = $this->input->get('tanggalmulai');
        $tanggalakhir = $this->input->get('tanggalakhir');

        // Apply filters
        $filteredbarang_masuk = [];
        foreach ($barang_masuk as $x) {
            $isFiltered = true;
            if (!empty($kategori) && $kategori != $x->id_kategori) {
                $isFiltered = false;
            }
            if (!empty($tanggalmulai)) {
                $tanggal_mulai = date('Y-m-d', strtotime($tanggalmulai));
                if (date('Y-m-d', strtotime($x->tanggal_masuk)) < $tanggal_mulai) {
                    $isFiltered = false;
                }
            }
            if (!empty($tanggalakhir)) {
                $tanggal_akhir = date('Y-m-d', strtotime($tanggalakhir));
                if (date('Y-m-d', strtotime($x->tanggal_masuk)) > $tanggal_akhir) {
                    $isFiltered = false;
                }
            }
            if ($isFiltered) {
                $filteredbarang_masuk[] = $x;
            }
        }

        $data['barang_masuk'] = $filteredbarang_masuk;
        // $this->load->view('template/header', $data);
        $this->load->view('admin/barang_masuk/cetak_barang_masuk', $data);
        // $this->load->view('template/footer');
    }

    // BARANG KELUAR-----------------------------------------------------------------------------------------------------------------------------------------
    public function data_barang_keluar()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama'); // Assuming 'nama' is a session variable holding user's name

        // Load your model (assuming it's named Admin_m)
        $this->load->model('Admin_m', 'admin_m');

        // Fetch all barang, kategori, and barang_keluar
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();

        // Get all barang_keluar
        $barang_keluar = $this->admin_m->get_all_barang_keluar();

        // Apply filters
        if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
            $kategori_filter = $_GET['kategori'];
            $barang_keluar = array_filter($barang_keluar, function ($x) use ($kategori_filter) {
                return $x->id_kategori == $kategori_filter;
            });
        }

        if (isset($_GET['tanggal_keluar']) && !empty($_GET['tanggal_keluar'])) {
            // Convert input dates to PHP date objects
            $tanggal_keluar_filter = date('Y-m-d', strtotime($_GET['tanggal_keluar']));
            $tanggalakhir_filter = isset($_GET['tanggalakhir']) ? date('Y-m-d', strtotime($_GET['tanggalakhir'])) : $tanggal_keluar_filter;

            // Filter barang_keluar based on date range
            $barang_keluar = array_filter($barang_keluar, function ($x) use ($tanggal_keluar_filter, $tanggalakhir_filter) {
                $tanggal_stok = date('Y-m-d', strtotime($x->tanggal_keluar));
                return ($tanggal_stok >= $tanggal_keluar_filter && $tanggal_stok <= $tanggalakhir_filter);
            });
        }

        $data['barang_keluar'] = $barang_keluar;

        // Load views with data
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang_keluar/data_barang_keluar', $data);
        $this->load->view('template/footer');
    }


    public function tambah_barang_keluar() //view inpu stok
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_barang(); //function model join master data barang
        $data['kategori'] = $this->admin_m->get_all_kategori(); //function model join master kategori
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang_keluar/input_barang_keluar', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambahbarang_keluar()
    {
        // Ambil data dari inputan form
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'jumlahk' => $this->input->post('jumlahk'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar'),
            'keterangan' => $this->input->post('keterangan'),
        );

        // keluarkan data ke dalam tabel 'stok_b'
        $this->db->insert('b_keluar', $data);

        // Redirect kembali ke halaman data stok barang
        redirect('admin/data_barang_keluar');
    }


    public function proses_editbarang_keluar($id_bkeluar)
    {
        $data = array(
            // 'id_bkeluar' => $this->input->post('id_bkeluar'),
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'jumlahk' => $this->input->post('jumlahk'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $this->db->where('id_bkeluar', $id_bkeluar);
        $this->db->update('b_keluar', $data);
        return redirect('admin/data_barang_keluar');
    }

    public function hapus_barang_keluar($id_bkeluar)
    {
        $this->db->where('id_bkeluar', $id_bkeluar);
        $this->db->delete('b_keluar');
        return redirect('admin/data_barang_keluar');
    }

    public function cetak_barang_keluar()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $barang_keluar = $this->admin_m->get_all_barang_keluar();


        // Get filter parameters
        $kategori = $this->input->get('kategori');
        $tanggalmulai = $this->input->get('tanggalmulai');
        $tanggalakhir = $this->input->get('tanggalakhir');

        // Apply filters
        $filteredbarang_keluar = [];
        foreach ($barang_keluar as $x) {
            $isFiltered = true;
            if (!empty($kategori) && $kategori != $x->id_kategori) {
                $isFiltered = false;
            }
            if (!empty($tanggalmulai)) {
                $tanggal_mulai = date('Y-m-d', strtotime($tanggalmulai));
                if (date('Y-m-d', strtotime($x->tanggal_keluar)) < $tanggal_mulai) {
                    $isFiltered = false;
                }
            }
            if (!empty($tanggalakhir)) {
                $tanggal_akhir = date('Y-m-d', strtotime($tanggalakhir));
                if (date('Y-m-d', strtotime($x->tanggal_keluar)) > $tanggal_akhir) {
                    $isFiltered = false;
                }
            }
            if ($isFiltered) {
                $filteredbarang_keluar[] = $x;
            }
        }

        $data['barang_keluar'] = $filteredbarang_keluar;
        // $this->load->view('template/header', $data);
        $this->load->view('admin/barang_keluar/cetak_barang_keluar', $data);
        // $this->load->view('template/footer');
    }

    // barang Pemeliharaan ------------------------------------------------------------------------------------------------------------------------

    public function data_pemeliharaan()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama'); // Assuming 'nama' is a session variable holding user's name

        // Load your model (assuming it's named Admin_m)
        $this->load->model('Admin_m', 'admin_m');

        // Fetch all barang, kategori, and pemeliharaan
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $data['status'] = $this->admin_m->get_all_status();

        // Get all pemeliharaan
        $pemeliharaan = $this->admin_m->get_all_pemeliharaan();

        // Apply filters
        if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
            $kategori_filter = $_GET['kategori'];
            $pemeliharaan = array_filter($pemeliharaan, function ($x) use ($kategori_filter) {
                return $x->id_kategori == $kategori_filter;
            });
        }

        if (isset($_GET['tanggal_pemeliharaan']) && !empty($_GET['tanggal_pemeliharaan'])) {
            // Convert input dates to PHP date objects
            $tanggal_pemeliharaan_filter = date('Y-m-d', strtotime($_GET['tanggal_pemeliharaan']));
            $tanggalakhir_filter = isset($_GET['tanggalakhir']) ? date('Y-m-d', strtotime($_GET['tanggalakhir'])) : $tanggal_pemeliharaan_filter;

            // Filter pemeliharaan based on date range
            $pemeliharaan = array_filter($pemeliharaan, function ($x) use ($tanggal_pemeliharaan_filter, $tanggalakhir_filter) {
                $tanggal_stok = date('Y-m-d', strtotime($x->tanggal_pemeliharaan));
                return ($tanggal_stok >= $tanggal_pemeliharaan_filter && $tanggal_stok <= $tanggalakhir_filter);
            });
        }

        $data['pemeliharaan'] = $pemeliharaan;

        // Load views with data
        $this->load->view('template/header', $data);
        $this->load->view('admin/pemeliharaan/data_pemeliharaan', $data);
        $this->load->view('template/footer');
    }


    public function tambah_pemeliharaan() //view inpu stok
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_barang(); //function model join master data barang
        $data['kategori'] = $this->admin_m->get_all_kategori(); //function model join master kategori
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $data['status'] = $this->admin_m->get_all_status();
        $this->load->view('template/header', $data);
        $this->load->view('admin/pemeliharaan/input_pemeliharaan', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambahpemeliharaan()
    {
        // Ambil data dari inputan form
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'id_status' => $this->input->post('id_status'),
            'tanggal_pemeliharaan' => $this->input->post('tanggal_pemeliharaan'),
            'keterangan' => $this->input->post('keterangan'),
            'tindakan' => $this->input->post('tindakan'),
        );

        // pemeliharaankan data ke dalam tabel 'stok_b'
        $this->db->insert('pemeliharaan_b', $data);

        // Redirect kembali ke halaman data stok barang
        redirect('admin/data_pemeliharaan');
    }


    public function proses_editpemeliharaan($id_pemeliharaan)
    {
        $data = array(
            // 'id_pemeliharaan' => $this->input->post('id_pemeliharaan'),
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'id_status' => $this->input->post('id_status'),
            'tanggal_pemeliharaan' => $this->input->post('tanggal_pemeliharaan'),
            'keterangan' => $this->input->post('keterangan'),
            'tindakan' => $this->input->post('tindakan'),
        );
        $this->db->where('id_pemeliharaan', $id_pemeliharaan);
        $this->db->update('pemeliharaan_b', $data);
        return redirect('admin/data_pemeliharaan');
    }

    public function hapus_pemeliharaan($id_pemeliharaan)
    {
        $this->db->where('id_pemeliharaan', $id_pemeliharaan);
        $this->db->delete('pemeliharaan_b');
        return redirect('admin/data_pemeliharaan');
    }

    public function cetak_pemeliharaan()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $data['status'] = $this->admin_m->get_all_status();
        $pemeliharaan = $this->admin_m->get_all_pemeliharaan();


        // Get filter parameters
        $kategori = $this->input->get('kategori');
        $tanggalmulai = $this->input->get('tanggalmulai');
        $tanggalakhir = $this->input->get('tanggalakhir');

        // Apply filters
        $filteredpemeliharaan = [];
        foreach ($pemeliharaan as $x) {
            $isFiltered = true;
            if (!empty($kategori) && $kategori != $x->id_kategori) {
                $isFiltered = false;
            }
            if (!empty($tanggalmulai)) {
                $tanggal_mulai = date('Y-m-d', strtotime($tanggalmulai));
                if (date('Y-m-d', strtotime($x->tanggal_pemeliharaan)) < $tanggal_mulai) {
                    $isFiltered = false;
                }
            }
            if (!empty($tanggalakhir)) {
                $tanggal_akhir = date('Y-m-d', strtotime($tanggalakhir));
                if (date('Y-m-d', strtotime($x->tanggal_pemeliharaan)) > $tanggal_akhir) {
                    $isFiltered = false;
                }
            }
            if ($isFiltered) {
                $filteredpemeliharaan[] = $x;
            }
        }

        $data['pemeliharaan'] = $filteredpemeliharaan;
        // $this->load->view('template/header', $data);
        $this->load->view('admin/pemeliharaan/cetak_pemeliharaan', $data);
        // $this->load->view('template/footer');
    }

    //--------------------------------------------------------------------------------------Peminjaman_---------------------------------------------

    public function data_peminjaman()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama'); // Assuming 'nama' is a session variable holding user's name

        // Load your model (assuming it's named Admin_m)
        $this->load->model('Admin_m', 'admin_m');

        // Fetch all barang, kategori, and peminjaman
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();

        // Get all peminjaman
        $peminjaman = $this->admin_m->get_all_peminjaman();

        // Apply filters
        if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
            $kategori_filter = $_GET['kategori'];
            $peminjaman = array_filter($peminjaman, function ($x) use ($kategori_filter) {
                return $x->id_kategori == $kategori_filter;
            });
        }

        if (isset($_GET['tanggal_peminjaman']) && !empty($_GET['tanggal_peminjaman'])) {
            // Convert input dates to PHP date objects
            $tanggal_peminjaman_filter = date('Y-m-d', strtotime($_GET['tanggal_peminjaman']));
            $tanggalakhir_filter = isset($_GET['tanggalakhir']) ? date('Y-m-d', strtotime($_GET['tanggalakhir'])) : $tanggal_peminjaman_filter;

            // Filter peminjaman based on date range
            $peminjaman = array_filter($peminjaman, function ($x) use ($tanggal_peminjaman_filter, $tanggalakhir_filter) {
                $tanggal_stok = date('Y-m-d', strtotime($x->tanggal_peminjaman));
                return ($tanggal_stok >= $tanggal_peminjaman_filter && $tanggal_stok <= $tanggalakhir_filter);
            });
        }

        $data['peminjaman'] = $peminjaman;

        // Load views with data
        $this->load->view('template/header', $data);
        $this->load->view('admin/peminjaman/data_peminjaman', $data);
        $this->load->view('template/footer');
    }


    public function tambah_peminjaman() //view inpu stok
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_barang(); //function model join master data barang
        $data['kategori'] = $this->admin_m->get_all_kategori(); //function model join master kategori
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $this->load->view('template/header', $data);
        $this->load->view('admin/peminjaman/input_peminjaman', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambahpeminjaman()
    {
        // Ambil data dari inputan form
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'tanggal_peminjaman' => $this->input->post('tanggal_peminjaman'),
            'tanggal_pengembalian' => $this->input->post('tanggal_pengembalian'),
            'jumlah' => $this->input->post('jumlah'),
            'tujuan' => $this->input->post('tujuan'),
            'status' => $this->input->post('status'),

        );

        // peminjamankan data ke dalam tabel 'stok_b'
        $this->db->insert('peminjaman_b', $data);

        // Redirect kembali ke halaman data stok barang
        redirect('admin/data_peminjaman');
    }


    public function proses_editpeminjaman($id_peminjaman)
    {
        $data = array(
            // 'id_peminjaman' => $this->input->post('id_peminjaman'),
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'tanggal_peminjaman' => $this->input->post('tanggal_peminjaman'),
            'tanggal_pengembalian' => $this->input->post('tanggal_pengembalian'),
            'jumlah' => $this->input->post('jumlah'),
            'tujuan' => $this->input->post('tujuan'),
            'status_peminjaman' => $this->input->post('status_peminjaman'),
        );
        $this->db->where('id_peminjaman', $id_peminjaman);
        $this->db->update('peminjaman_b', $data);
        return redirect('admin/data_peminjaman');
    }

    public function hapus_peminjaman($id_peminjaman)
    {
        $this->db->where('id_peminjaman', $id_peminjaman);
        $this->db->delete('peminjaman_b');
        return redirect('admin/data_peminjaman');
    }

    public function cetak_peminjaman()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $peminjaman = $this->admin_m->get_all_peminjaman();


        // Get filter parameters
        $kategori = $this->input->get('kategori');
        $tanggalmulai = $this->input->get('tanggalmulai');
        $tanggalakhir = $this->input->get('tanggalakhir');

        // Apply filters
        $filteredpeminjaman = [];
        foreach ($peminjaman as $x) {
            $isFiltered = true;
            if (!empty($kategori) && $kategori != $x->id_kategori) {
                $isFiltered = false;
            }
            if (!empty($tanggalmulai)) {
                $tanggal_mulai = date('Y-m-d', strtotime($tanggalmulai));
                if (date('Y-m-d', strtotime($x->tanggal_peminjaman)) < $tanggal_mulai) {
                    $isFiltered = false;
                }
            }
            if (!empty($tanggalakhir)) {
                $tanggal_akhir = date('Y-m-d', strtotime($tanggalakhir));
                if (date('Y-m-d', strtotime($x->tanggal_peminjaman)) > $tanggal_akhir) {
                    $isFiltered = false;
                }
            }
            if ($isFiltered) {
                $filteredpeminjaman[] = $x;
            }
        }

        $data['peminjaman'] = $filteredpeminjaman;
        // $this->load->view('template/header', $data);
        $this->load->view('admin/peminjaman/cetak_peminjaman', $data);
        // $this->load->view('template/footer');
    }

    public function setujui_peminjaman($id_peminjaman)
    {
        $this->db->update('peminjaman_b', ['status_peminjaman' => 'Disetujui'], ['id_peminjaman' => $id_peminjaman]);
        redirect('admin/data_peminjaman');
    }

    public function tolak_peminjaman($id_peminjaman)
    {
        $this->db->update('peminjaman_b', ['status_peminjaman' => 'Ditolak'], ['id_peminjaman' => $id_peminjaman]);
        redirect('admin/data_peminjaman');
    }
    //-----------------------------------------------------------Pengembalian Barang------------------------------------------------------------------------------------

    public function data_pengembalian()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama'); // Assuming 'nama' is a session variable holding user's name

        // Load your model (assuming it's named Admin_m)
        $this->load->model('Admin_m', 'admin_m');

        // Fetch all barang, kategori, and pengembalian
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();

        // Get all pengembalian
        $pengembalian = $this->admin_m->get_all_pengembalian();

        // Apply filters
        if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
            $kategori_filter = $_GET['kategori'];
            $pengembalian = array_filter($pengembalian, function ($x) use ($kategori_filter) {
                return $x->id_kategori == $kategori_filter;
            });
        }

        if (isset($_GET['tanggal_pengembalian']) && !empty($_GET['tanggal_pengembalian'])) {
            // Convert input dates to PHP date objects
            $tanggal_pengembalian_filter = date('Y-m-d', strtotime($_GET['tanggal_pengembalian']));
            $tanggalakhir_filter = isset($_GET['tanggalakhir']) ? date('Y-m-d', strtotime($_GET['tanggalakhir'])) : $tanggal_pengembalian_filter;

            // Filter pengembalian based on date range
            $pengembalian = array_filter($pengembalian, function ($x) use ($tanggal_pengembalian_filter, $tanggalakhir_filter) {
                $tanggal_stok = date('Y-m-d', strtotime($x->tanggal_pengembalian));
                return ($tanggal_stok >= $tanggal_pengembalian_filter && $tanggal_stok <= $tanggalakhir_filter);
            });
        }

        $data['pengembalian'] = $pengembalian;

        // Load views with data
        $this->load->view('template/header', $data);
        $this->load->view('admin/pengembalian/data_pengembalian', $data);
        $this->load->view('template/footer');
    }


    public function tambah_pengembalian() //view inpu stok
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_all_barang(); //function model join master data barang
        $data['kategori'] = $this->admin_m->get_all_kategori(); //function model join master kategori
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $this->load->view('template/header', $data);
        $this->load->view('admin/pengembalian/input_pengembalian', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambahpengembalian()
    {
        // Ambil data dari inputan form
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'tanggal_pengembalian' => $this->input->post('tanggal_pengembalian'),
            'jumlah' => $this->input->post('jumlah'),

        );

        // pengembaliankan data ke dalam tabel 'stok_b'
        $this->db->insert('pengembalian_b', $data);

        // Redirect kembali ke halaman data stok barang
        redirect('admin/data_pengembalian');
    }


    public function proses_editpengembalian($id_pengembalian)
    {
        $data = array(
            // 'id_pengembalian' => $this->input->post('id_pengembalian'),
            'id_barang' => $this->input->post('id_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_pegawai' => $this->input->post('id_pegawai'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'tanggal_pengembalian' => $this->input->post('tanggal_pengembalian'),
            'tanggal_diterima' => $this->input->post('tanggal_diterima'),
            'jumlah' => $this->input->post('jumlah'),
            'status_pengembalian' => $this->input->post('status_pengembalian'),
        );
        $this->db->where('id_pengembalian', $id_pengembalian);
        $this->db->update('pengembalian_b', $data);
        return redirect('admin/data_pengembalian');
    }

    public function hapus_pengembalian($id_pengembalian)
    {
        $this->db->where('id_pengembalian', $id_pengembalian);
        $this->db->delete('pengembalian_b');
        return redirect('admin/data_pengembalian');
    }

    public function cetak_pengembalian()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai();
        $data['lokasi'] = $this->admin_m->get_all_lokasi();
        $pengembalian = $this->admin_m->get_all_pengembalian();


        // Get filter parameters
        $kategori = $this->input->get('kategori');
        $tanggalmulai = $this->input->get('tanggalmulai');
        $tanggalakhir = $this->input->get('tanggalakhir');

        // Apply filters
        $filteredpengembalian = [];
        foreach ($pengembalian as $x) {
            $isFiltered = true;
            if (!empty($kategori) && $kategori != $x->id_kategori) {
                $isFiltered = false;
            }
            if (!empty($tanggalmulai)) {
                $tanggal_mulai = date('Y-m-d', strtotime($tanggalmulai));
                if (date('Y-m-d', strtotime($x->tanggal_pengembalian)) < $tanggal_mulai) {
                    $isFiltered = false;
                }
            }
            if (!empty($tanggalakhir)) {
                $tanggal_akhir = date('Y-m-d', strtotime($tanggalakhir));
                if (date('Y-m-d', strtotime($x->tanggal_pengembalian)) > $tanggal_akhir) {
                    $isFiltered = false;
                }
            }
            if ($isFiltered) {
                $filteredpengembalian[] = $x;
            }
        }

        $data['pengembalian'] = $filteredpengembalian;
        // $this->load->view('template/header', $data);
        $this->load->view('admin/pengembalian/cetak_pengembalian', $data);
        // $this->load->view('template/footer');
    }

    public function setujui_pengembalian($id_pengembalian)
    {
        $this->db->update('pengembalian_b', [
            'status_pengembalian' => 'Diterima',
            'tanggal_diterima' => date('Y-m-d')
        ], ['id_pengembalian' => $id_pengembalian]);
        redirect('admin/data_pengembalian');
    }


    public function tolak_pengembalian($id_pengembalian)
    {
        $this->db->update('pengembalian_b', [
            'status_pengembalian' => 'Belum Diterima'
        ], ['id_pengembalian' => $id_pengembalian]);
        redirect('admin/data_pengembalian');
    }
    //------------------------------------------------------------------audit barang---------------------------------------------------------
    public function data_audit()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama'); // Assuming 'nama' is a session variable holding user's name

        // Load your model (assuming it's named Admin_m)
        $this->load->model('Admin_m', 'admin_m');

        // Fetch all barang, kategori, and audit
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai(); //fu
        $data['stokbarang'] = $this->admin_m->get_all_stokbarang(); //fu


        // Get all audit data
        $audit = $this->admin_m->get_all_audit();

        // Apply filters
        if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
            $kategori_filter = $_GET['kategori'];
            $audit = array_filter($audit, function ($x) use ($kategori_filter) {
                return $x->id_kategori == $kategori_filter;
            });
        }

        if (isset($_GET['tanggal_audit']) && !empty($_GET['tanggal_audit'])) {
            // Convert input dates to PHP date objects
            $tanggal_audit_filter = date('Y-m-d', strtotime($_GET['tanggal_audit']));
            $tanggalakhir_filter = isset($_GET['tanggalakhir']) ? date('Y-m-d', strtotime($_GET['tanggalakhir'])) : $tanggal_audit_filter;

            // Filter audit based on date range
            $audit = array_filter($audit, function ($x) use ($tanggal_audit_filter, $tanggalakhir_filter) {
                $tanggal_audit = date('Y-m-d', strtotime($x->tanggal_audit));
                return ($tanggal_audit >= $tanggal_audit_filter && $tanggal_audit <= $tanggalakhir_filter);
            });
        }

        $data['audit'] = $audit;

        // Load views with data
        $this->load->view('template/header', $data);
        $this->load->view('admin/audit/data_audit', $data);
        $this->load->view('template/footer');
    }
    public function tambah_audit()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['barang'] = $this->admin_m->get_all_barang(); //function model join master data barang
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai(); //function model join master kategori
        $this->load->view('template/header', $data);
        $this->load->view('admin/audit/input_audit', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambah_audit()
    {
        // Handle file upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*'; // Add or change allowed types if necessary
        $config['max_size'] = 2048; // Maximum file size in kilobytes

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti')) {
            $error = $this->upload->display_errors();
            // Handle upload error if needed
            $this->session->set_flashdata('error', $error);
            redirect('admin/tambah_audit'); // Adjust redirect as needed
        } else {
            $upload_data = $this->upload->data();
            $bukti = $upload_data['file_name']; // Get the uploaded file name
        }

        // Get input values
        $id_barang = $this->input->post('id_barang');
        $stok_aktual = $this->input->post('stok_aktual');

        // Retrieve the system stock (stok_sistem) from the database
        $this->load->model('Admin_m');
        $stok_sistem = $this->Admin_m->get_stok_by_id($id_barang);

        if ($stok_sistem === NULL) {
            // Handle error if the stock is not found
            $this->session->set_flashdata('error', 'Stok sistem tidak ditemukan untuk barang yang dipilih.');
            redirect('admin/tambah_audit');
        }

        // Calculate stock difference
        $selisih_stok = $stok_aktual - $stok_sistem;

        // Prepare data for insertion
        $data = array(
            'id_pegawai' => $this->input->post('id_pegawai'),
            'id_barang' => $id_barang,
            'id_kategori' => $this->input->post('id_kategori'),
            'tanggal_audit' => $this->input->post('tanggal_audit'),
            'stok_sistem' => $stok_sistem,
            'stok_aktual' => $stok_aktual,
            'selisih_stok' => $selisih_stok,
            'harga_per_unit' => $this->input->post('harga_per_unit'),
            'hasil_audit' => $this->input->post('hasil_audit'),
            'catatan_audit' => $this->input->post('catatan_audit'),
            'bukti' => $bukti, // Add the file name to data
        );

        // Save data to the database
        $this->db->insert('audit', $data);

        // Redirect to the audit data page
        redirect('admin/data_audit');
    }



    public function proses_edit_audit($id_audit)
    {
        // Ambil data dari form
        $id_barang = $this->input->post('id_barang');
        $id_kategori = $this->input->post('id_kategori');
        $tanggal_audit = $this->input->post('tanggal_audit');
        $stok_sistem = $this->input->post('stok_sistem');
        $stok_aktual = $this->input->post('stok_aktual');
        $harga_per_unit = $this->input->post('harga_per_unit');
        $hasil_audit = $this->input->post('hasil_audit');
        $catatan_audit = $this->input->post('catatan_audit');

        // Debug log
        log_message('debug', "Stok Sistem: {$stok_sistem}");
        log_message('debug', "Stok Aktual: {$stok_aktual}");

        $selisih_stok = $stok_aktual - $stok_sistem;

        // Debug log
        log_message('debug', "Selisih Stok: {$selisih_stok}");

        $data = array(
            'id_barang' => $id_barang,
            'id_kategori' => $id_kategori,
            'tanggal_audit' => $tanggal_audit,
            'stok_sistem' => $stok_sistem,
            'stok_aktual' => $stok_aktual,
            'selisih_stok' => $selisih_stok,
            'harga_per_unit' => $harga_per_unit,
            'hasil_audit' => $hasil_audit,
            'catatan_audit' => $catatan_audit,
        );

        // Cek apakah ada file bukti yang diupload
        if (!empty($_FILES['bukti']['name'])) {
            // Load library upload
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = '*'; // Menentukan jenis file yang diizinkan
            $config['max_size']      = 2048; // Maksimal ukuran file 2MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('bukti')) {
                $upload_data = $this->upload->data();
                $data['bukti'] = $upload_data['file_name'];

                // Hapus file lama jika ada
                $audit_data = $this->db->get_where('audit', array('id_audit' => $id_audit))->row();
                if (!empty($audit_data->bukti)) {
                    @unlink('./uploads/' . $audit_data->bukti);
                }
            } else {
                // Jika gagal upload, tampilkan error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                return redirect('admin/data_audit');
            }
        } else {
            // Jika tidak ada file yang di-upload, pertahankan file lama
            $audit_data = $this->db->get_where('audit', array('id_audit' => $id_audit))->row();
            $data['bukti'] = $audit_data->bukti;
        }

        // Update data di tabel 'audit'
        $this->db->where('id_audit', $id_audit);
        $this->db->update('audit', $data);

        // Redirect ke halaman data audit
        return redirect('admin/data_audit');
    }


    public function download_bukti($filename)
    {
        $this->load->helper('download');
        $filepath = './uploads/' . $filename;

        // Check if the file exists
        if (file_exists($filepath)) {
            force_download($filepath, NULL);
        } else {
            show_404(); // Show 404 if file does not exist
        }
    }

    public function hapus_audit($id_audit)
    {
        $this->db->where('id_audit', $id_audit);
        $this->db->delete('audit');
        return redirect('admin/data_audit');
    }
    public function cetak_audit()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['barang'] = $this->admin_m->get_all_barang();
        $data['kategori'] = $this->admin_m->get_all_kategori();
        $data['pegawai'] = $this->admin_m->get_all_pegawai(); //fu
        $audit = $this->admin_m->get_all_audit();

        // Get filter parameters
        $kategori = $this->input->get('kategori');
        $tanggalmulai = $this->input->get('tanggalmulai');
        $tanggalakhir = $this->input->get('tanggalakhir');

        // Apply filters
        $filtered_audit = [];
        foreach ($audit as $x) {
            $isFiltered = true;
            if (!empty($kategori) && $kategori != $x->id_kategori) {
                $isFiltered = false;
            }
            if (!empty($tanggalmulai)) {
                $tanggal_mulai = date('Y-m-d', strtotime($tanggalmulai));
                if (date('Y-m-d', strtotime($x->tanggal_audit)) < $tanggal_mulai) {
                    $isFiltered = false;
                }
            }
            if (!empty($tanggalakhir)) {
                $tanggal_akhir = date('Y-m-d', strtotime($tanggalakhir));
                if (date('Y-m-d', strtotime($x->tanggal_audit)) > $tanggal_akhir) {
                    $isFiltered = false;
                }
            }
            if ($isFiltered) {
                $filtered_audit[] = $x;
            }
        }

        $data['audit'] = $filtered_audit;
        $this->load->view('admin/audit/cetak_audit', $data);
    }
}



/* End of file Admin.php */
