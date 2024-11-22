<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanAnggota extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        is_admin();
    }

    public function laporan_anggota()
    {
        try {
            $data['title'] = 'Laporan Data Anggota';
            $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
            $data['anggota'] = $this->UserModel->getUserWhere('role_id = 2')->result_array();
            $this->loadViews('laporan-anggota/laporan_anggota', $data);
        } catch (Throwable $e) {
            $this->handleException($e);
        }
    }

    public function cetak_laporan_anggota()
    {
        try {
            $data['anggota'] = $this->UserModel->getUserWhere('role_id = 2')->result_array();

            $this->load->view('laporan-anggota/cetak_laporan_anggota', $data);
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

    public function laporan_anggota_pdf()
    {
        $this->load->library('dompdf_gen');
        $data['anggota'] = $this->UserModel->getUserWhere('role_id = 2')->result_array();

        $this->load->view('laporan-anggota/laporan_pdf_anggota', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Laporan Data Anggota.pdf", array('Attachment' => 0));
    }

    public function export_excel()
    {
        $data['title'] = 'Laporan Anggota';
        $data['anggota'] = $this->UserModel->getUserWhere('role_id = 2')->result_array();
        $this->load->view('laporan-anggota/export_excel_anggota', $data);
    }
}
