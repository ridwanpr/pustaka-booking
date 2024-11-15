<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        is_admin();
    }

    public function index()
    {
        $data['title'] = 'Anggota';
        $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
        $data['member'] = $this->UserModel->getUsers()->result_array();

        $this->callTemplate($data);
        $this->load->view('admin/member', $data);
        $this->load->view('layouts/partials/dashboard/_footer');
    }

    private function callTemplate($data)
    {
        $this->load->view('layouts/partials/dashboard/_header', $data);
        $this->load->view('layouts/partials/dashboard/_sidebar', $data);
        $this->load->view('layouts/partials/dashboard/_topbar', $data);
    }
}
