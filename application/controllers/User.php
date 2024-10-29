<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
        $this->callTemplate($data);
        $this->load->view('user/index', $data);
    }

    public function ubahProfil()
    {
        $data['title'] = 'Ubah Profil';
        $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
        $this->callTemplate($data);
        $this->load->view('user/ubah-profile', $data);
    }

    public function postUbahProfile()
    {
        $this->setValidationRules();

        if ($this->form_validation->run() == false) {
            $this->ubahProfil();
            return;
        }

        $data['title'] = 'Ubah Profil';
        $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();

        $nama = $this->input->post('nama', true);
        $email = $this->input->post('email', true);

        //jika ada gambar yang akan diupload
        $upload_image = $_FILES['image']['name'];
        
        if ($upload_image) {
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|svg|jfif';
            $config['max_size'] = '4096';
            $config['max_width'] = '2048';
            $config['max_height'] = '2048';
            $config['file_name'] = 'pro' . time();
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $gambar_lama = $data['user']['image'];
                if ($gambar_lama != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' .
                        $gambar_lama);
                }
                $gambar_baru = $this->upload->data('file_name');
                $this->db->set('image', $gambar_baru);
            }
        }

        $this->db->set('nama', $nama);
        $this->db->where('email', $email);
        $this->db->update('users');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>');
        redirect('user');
    }

    private function callTemplate($data)
    {
        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('templates/templates-user/footer', $data);
    }

    private function setValidationRules()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama harus diisi!']);
    }
}
