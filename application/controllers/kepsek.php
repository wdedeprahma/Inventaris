<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepsek extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin_m');

        $level_akun = $this->session->userdata('level');
        if ($level_akun != "kepsek") {
            return redirect('auth');
        }
    }

    public function index()
    {
        $data['nama'] = $this->session->userdata('nama');

        $data['judul'] = 'Dashboard';

        $this->load->view('template_kepsek/header', $data);
        $this->load->view('kepsek/index', $data);
        $this->load->view('template_kepsek/footer', $data);
    }
}
