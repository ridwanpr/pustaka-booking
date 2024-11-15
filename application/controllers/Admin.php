<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        is_admin();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->UserModel->getUserLimit()->result_array();
        $data['buku'] = $this->BookModel->getLimitBuku()->result_array();

        $this->load->view('layouts/partials/dashboard/_header', $data);
        $this->load->view('layouts/partials/dashboard/_sidebar', $data);
        $this->load->view('layouts/partials/dashboard/_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('layouts/partials/dashboard/_footer');
    }
    
}
