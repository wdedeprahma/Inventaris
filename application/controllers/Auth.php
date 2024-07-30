<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('auth_m');
    }

    public function index()
    {
        $data['data'] = false;
        $data['pesan'] = $this->session->flashdata('pesan');
        $data['judul'] = 'Login';
        $this->load->view('auth/template_auth/header', $data);
        $this->load->view('auth/index', $data);
        $this->load->view('auth/template_auth/footer', $data);
    }

    public function user_login()
    {
        $data['data'] = false;
        $data['pesan'] = $this->session->flashdata('pesan');
        $data['judul'] = 'Login User';
        $this->load->view('auth/template_auth/header', $data);
        $this->load->view('auth/user_login', $data);
        $this->load->view('auth/template_auth/footer', $data);
    }

    public function auth()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['data'] = false;
            $data['judul'] = 'Login';
            $this->load->view('auth/template_auth/header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('auth/template_auth/footer');
        } else {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $cek = $this->auth_m->login($username, $password);

            if ($cek) {
                foreach ($cek as $row) {
                    $this->session->set_userdata('nama', $row->username);
                    $this->session->set_userdata('id_akun', $row->id_akun);
                    $this->session->set_userdata('level', $row->level);

                    if ($row->level == "admin") {
                        redirect('admin');
                    } elseif ($row->level == "user") {
                        redirect('user');
                    } elseif ($row->level == "kepsek") {
                        redirect('kepsek');
                    }
                }
            } else {
                // Jika login gagal, set pesan kesalahan
                $this->session->set_flashdata('error', 'Username atau Password salah.');
                redirect('auth');
            }
        }
    }

    public function keluar()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
