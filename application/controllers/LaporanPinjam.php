<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPinjam extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        is_admin();
    }

    public function laporan_pinjam()
    {
        try {
            $data['title'] = 'Laporan Data Pinjam';
            $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
            $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d,buku b,users u 
                where d.id_buku=b.id and p.id_user=u.id 
                and p.no_pinjam=d.no_pinjam")
                ->result_array();

            $this->loadViews('laporan-pinjam/laporan_pinjam', $data);
        } catch (Throwable $e) {
            $this->handleException($e);
        }
    }

    public function cetak_laporan_pinjam()
    {
        try {
            $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d, buku b,users u 
                where d.id_buku=b.id and p.id_user=u.id 
                and p.no_pinjam=d.no_pinjam")->result_array();

            $this->load->view('laporan-pinjam/cetak_laporan_pinjam', $data);
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

    public function laporan_pinjam_pdf()
    {
        $this->load->library('dompdf_gen');
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d, buku b,users u 
            where d.id_buku=b.id and p.id_user=u.id 
            and p.no_pinjam=d.no_pinjam")->result_array();

        $this->load->view('laporan-pinjam/laporan_pdf_pinjam', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Laporan Data Pinjam.pdf", array('Attachment' => 0));
    }

    public function export_excel()
    {
        $data['title'] = 'Laporan Pinjam';
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d, buku b,users u 
            where d.id_buku=b.id and p.id_user=u.id 
            and p.no_pinjam=d.no_pinjam")->result_array();
        $this->load->view('laporan-pinjam/export_excel_pinjam', $data);
    }
}
