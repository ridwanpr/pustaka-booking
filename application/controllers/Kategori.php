<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin();
    }

    public function index()
    {
        $data['title'] = 'Kategori Buku';
        $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->BookModel->getKategori()->result_array();

        $this->callTemplate($data);
        $this->load->view('admin/kategori', $data);
        $this->load->view('layouts/partials/dashboard/_footer');
    }

    public function postKategori()
    {
        $this->form_validation->set_rules('nama_kategori', 'Kategori', 'required', ['required' => 'Judul Buku harus diisi']);
        
        if ($this->form_validation->run() == false) {
            $this->index();
            return;
        }

        $data = ['nama_kategori' => $this->input->post('nama_kategori')];
        $this->BookModel->simpanKategori($data);

        redirect('kategori');
    }

    public function delete()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->BookModel->hapusKategori($where);
        redirect('kategori');
    }

    public function edit($id)
    {
        $data['title'] = 'Kategori Buku';
        $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->BookModel->kategoriWhere(['id' => $id])->row_array();

        $this->callTemplate($data);
        $this->load->view('admin/_edit-kategori', $data);
        $this->load->view('layouts/partials/dashboard/_footer');
    }

    public function update($id)
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];

        $this->BookModel->updateKategori(['id' => $id], $data);
        redirect('kategori');
    }

    private function callTemplate($data)
    {
        $this->load->view('layouts/partials/dashboard/_header', $data);
        $this->load->view('layouts/partials/dashboard/_sidebar', $data);
        $this->load->view('layouts/partials/dashboard/_topbar', $data);
    }
}
