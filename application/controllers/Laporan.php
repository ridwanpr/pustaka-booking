<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        is_admin();
    }

    public function laporan_buku()
    {
        try {
            $data['title'] = 'Laporan Data Buku';
            $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
            $data['buku'] = $this->BookModel->getBuku()->result_array();
            $data['kategori'] = $this->BookModel->getKategori()->result_array();

            $this->loadViews('buku/laporan_buku', $data);
        } catch (Throwable $e) {
            $this->handleException($e);
        }
    }

    public function cetak_laporan_buku()
    {
        try {
            $data['buku'] = $this->BookModel->getBuku()->result_array();
            $data['kategori'] = $this->BookModel->getKategori()->result_array();

            $this->load->view('buku/laporan_print_buku', $data);
        } catch (Throwable $e) {
            $this->handleException($e);
        }
    }

    private function loadViews($view, $data)
    {
        try {
            $this->load->view('layouts/partials/dashboard/_header', $data);
            $this->load->view('layouts/partials/dashboard/_sidebar', $data);
            $this->load->view('layouts/partials/dashboard/_topbar', $data);
            $this->load->view($view, $data);
            $this->load->view('layouts/partials/dashboard/_footer');
        } catch (Throwable $e) {
            $this->handleException($e);
        }
    }
}
