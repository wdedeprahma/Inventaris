<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends CI_Model
{

    public function get_all_akun()
    {
        return   $this->db->get('akun')->result();
    }
    public function get_row_akun($id_akun)
    {
        $this->db->where('id_akun', $id_akun);

        return   $this->db->get('akun')->row();
    }


    public function get_all_barang()
    {

        return   $this->db->get('barang')->result();
    }

    public function get_row_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        return   $this->db->get('barang')->row();
    }

    public function get_all_kategori()
    {

        return   $this->db->get('kategori')->result();
    }
    public function get_all_lokasi()
    {

        return   $this->db->get('lokasi')->result();
    }

    public function get_row_kategori($id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        return   $this->db->get('kategori')->row();
    }

    public function get_all_pegawai()
    {

        return   $this->db->get('pegawai')->result();
    }

    public function get_row_pegawai($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        return   $this->db->get('pegawai')->row();
    }

    public function get_all_supplier()
    {

        return   $this->db->get('supplier')->result();
    }

    public function get_all_status()
    {

        return   $this->db->get('status')->result();
    }

    public function get_row_supplier($id_supplier)
    {
        $this->db->where('id_supplier', $id_supplier);
        return   $this->db->get('supplier')->row();
    }

    public function get_all_stokbarang()
    {

        return   $this->db->get('stok_b')->result();
    }
    // public function get_all_stokbarang()
    // {
    //     $this->db->join('barang', 'barang.id_barang = stokbarang.id_barang', 'left');
    //     $this->db->join('kategori', 'kategori.id_kategori = stokbarang.id_kategori', 'left');
    //     $this->db->order_by('id_stok', 'DESC');
    //     return   $this->db->get('stokbarang')->result();
    // }

    // public function relation_barang()
    // {
    //     $this->db->select('*');
    //     $this->db->from('barang');
    //     return $this->db->get()->result();
    // }

    public function get_row_stokbarang($id_stok)
    {

        $this->db->where('id_stok', $id_stok);

        $this->db->join('barang', 'barang.id_barang = stokbarang.id_barang', 'left');
        // $this->db->join('kategori', 'kategori.id_kategori = stokbarang.id_kategori', 'left');

        return   $this->db->get('stokbarang')->row();
    }

    public function get_all_barang_masuk()
    {
        // $this->db->join('barang', 'barang.id_barang = barang_masuk.id_barang', 'left');
        // // $this->db->join('kategori', 'kategori.id_kategori = barang_masuk.id_kategori', 'left');
        // $this->db->join('pegawai', 'pegawai.id_pegawai = barang_masuk.id_pegawai', 'left');
        // $this->db->join('supplier', 'supplier.id_supplier = barang_masuk.id_supplier', 'left');
        $this->db->order_by('id_bmasuk', 'DESC');
        return   $this->db->get('b_masuk')->result();
    }

    public function get_all_barang_keluar()
    {
        // $this->db->join('barang', 'barang.id_barang = barang_keluar.id_barang', 'left');
        // $this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
        $this->db->order_by('id_bkeluar', 'DESC');
        return   $this->db->get('b_keluar')->result();
    }

    public function get_all_pemeliharaan()
    {
        // $this->db->join('barang', 'barang.id_barang = barang_keluar.id_barang', 'left');
        // $this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
        $this->db->order_by('id_pemeliharaan', 'DESC');
        return   $this->db->get('pemeliharaan_b')->result();
    }

    public function get_all_peminjaman()
    {
        // $this->db->join('barang', 'barang.id_barang = peminjaman.id_barang', 'left');
        // $this->db->join('pegawai', 'pegawai.id_pegawai = peminjaman.id_pegawai', 'left');
        $this->db->order_by('id_peminjaman', 'DESC');
        return   $this->db->get('peminjaman_b')->result();
    }

    public function get_all_pengembalian()
    {
        // $this->db->join('barang', 'barang.id_barang = pengembalian.id_barang', 'left');
        // $this->db->join('pegawai', 'pegawai.id_pegawai = pengembalian.id_pegawai', 'left');
        $this->db->order_by('id_pengembalian', 'DESC');
        return   $this->db->get('pengembalian_b')->result();
    }

    public function get_all_pemusnahan()
    {
        // $this->db->join('barang', 'barang.id_barang = pemusnahan.id_barang', 'left');
        // $this->db->join('pegawai', 'pegawai.id_pegawai = pemusnahan.id_pegawai', 'left');
        $this->db->order_by('id_pemusnahan', 'DESC');
        return   $this->db->get('pemusnahan_b')->result();
    }
    public function get_all_pembelian()
    {
        // $this->db->join('barang', 'barang.id_barang = pembelian.id_barang', 'left');
        // $this->db->join('pegawai', 'pegawai.id_pegawai = pembelian.id_pegawai', 'left');
        $this->db->order_by('id_pembelian', 'DESC');
        return   $this->db->get('pembelian')->result();
    }

    public function get_all_audit()
    {
        // $this->db->join('barang', 'barang.id_barang = audit.id_barang', 'left');
        // $this->db->join('pegawai', 'pegawai.id_pegawai = audit.id_pegawai', 'left');
        $this->db->order_by('id_audit', 'DESC');
        return   $this->db->get('audit')->result();
    }
    public function get_stok_by_id($id_barang)
    {
        $this->db->select('stok');
        $this->db->from('barang');
        $this->db->where('id_barang', $id_barang);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->stok : NULL;
    }


    //khusus index--------------------------------------------------------------------------------------------------------------------------------------------------------------------

}

/* End of file alumni_m.php */
