<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'judul' => 'Katalog Buku',
            'buku' => $this->BookModel->getBuku()->result_array(),
        ];

        // var_dump($data);
        // die();

        if ($this->session->userdata('email')) {
            $userData = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
            $data['user'] = $userData['nama'];
        } else {
            $data['user'] = 'Pengunjung';
        }

        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('buku/daftarbuku', $data);
        // $this->load->view('templates/templates-user/footer', $data);
    }
}
