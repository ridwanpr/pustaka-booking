<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class Pinjam extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        is_admin();
    }

    public function index()
    {
        try {
            $data['title'] = "Data Pinjam";
            $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
            $data['pinjam'] = $this->ModelPinjam->joinData();

            $this->loadViews('pinjam/data-pinjam', $data);
        } catch (Throwable $e) {
            $this->handleException($e);
        }
    }

    public function ubahStatus()
    {
        try {
            $id_buku = $this->uri->segment(3);
            $no_pinjam = $this->uri->segment(4);
            $tgl = date('Y-m-d');
            $status = 'Kembali';

            $this->db->query("UPDATE pinjam, detail_pinjam 
                          SET pinjam.status='$status', pinjam.tgl_pengembalian='$tgl' 
                          WHERE detail_pinjam.id_buku='$id_buku' 
                          AND pinjam.no_pinjam='$no_pinjam'");

            $this->db->query("UPDATE buku, detail_pinjam 
                          SET buku.dipinjam = buku.dipinjam - 1, buku.stok = buku.stok + 1 
                          WHERE buku.id = detail_pinjam.id_buku");

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Status updated successfully!</div>');
        } catch (Exception $e) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>');
        }

        redirect(base_url('pinjam'));
    }


    public function daftarBooking()
    {
        try {
            ob_start();

            $data['title'] = 'Daftar Booking';
            $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
            $data['pinjam'] = $this->db->query("SELECT * FROM booking")->result_array();

            $this->loadViews('booking/daftar-booking', $data);

            ob_end_flush();
        } catch (Throwable $e) {
            $this->handleException($e);
        }
    }

    public function bookingDetail()
    {
        try {
            $id_booking = $this->uri->segment(3);
            $data['title'] = "Booking Detail";
            $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
            $data['agt_booking'] = $this->db->query("SELECT * FROM booking b, users u WHERE b.id_user = u.id AND b.id_booking = '$id_booking'")->result_array();
            $data['detail'] = $this->db->query("SELECT id_buku, judul_buku, pengarang, penerbit, tahun_terbit FROM booking_detail d, buku b WHERE d.id_buku = b.id AND d.id_booking = '$id_booking'")->result_array();

            $this->loadViews('booking/booking-detail', $data);
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

    public function pinjamAct()
    {
        try {
            $id_booking = $this->uri->segment(3);
            $lama = $this->input->post('lama', TRUE);
            $bo = $this->db->query("SELECT * FROM booking WHERE id_booking = '$id_booking'")->row();
            $tglsekarang = date('Y-m-d');
            $no_pinjam = $this->ModelBooking->kodeOtomatis('pinjam', 'no_pinjam');

            $databooking = [
                'no_pinjam' => $no_pinjam,
                'id_booking' => $id_booking,
                'tgl_pinjam' => $tglsekarang,
                'id_user' => $bo->id_user,
                'tgl_kembali' => date('Y-m-d', strtotime("+$lama days", strtotime($tglsekarang))),
                'tgl_pengembalian' => '0000-00-00',
                'status' => 'Pinjam',
                'total_denda' => 0
            ];

            $this->ModelPinjam->simpanPinjam($databooking);
            $this->ModelPinjam->simpanDetail($id_booking, $no_pinjam);

            $denda = $this->input->post('denda', TRUE);
            $this->db->query("UPDATE detail_pinjam SET denda = '$denda'");

            $this->ModelPinjam->deleteData('booking', ['id_booking' => $id_booking]);
            $this->ModelPinjam->deleteData('booking_detail', ['id_booking' => $id_booking]);

            $this->db->query("UPDATE buku, detail_pinjam SET buku.dipinjam = buku.dipinjam + 1, buku.dibooking = buku.dibooking - 1 WHERE buku.id = detail_pinjam.id_buku");

            $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Data Peminjaman Berhasil Disimpan</div>');
            redirect(base_url() . 'pinjam/daftarBooking');
        } catch (Throwable $e) {
            $this->handleException($e);
        }
    }
}
