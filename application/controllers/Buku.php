<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        is_admin();
    }

    public function index()
    {
        $data['title'] = 'Data Buku';
        $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->BookModel->getBuku()->result_array();
        $data['kategori'] = $this->BookModel->getKategori()->result_array();

        $this->callTemplate($data);
        $this->load->view('admin/buku', $data);
        $this->load->view('layouts/partials/dashboard/_footer');
    }

    public function postBuku()
    {
        $this->setValidationRules();
        if ($this->form_validation->run() == false) {
            $this->index();
            return;
        }

        $config = $this->imgUploadConfig();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $data = array('upload_data' => $this->upload->data());
            $gambar = $data['upload_data']['file_name'];
        }

        $data = [
            'judul_buku' => $this->input->post('judul_buku', true),
            'id_kategori' => $this->input->post('id_kategori', true),
            'pengarang' => $this->input->post('pengarang', true),
            'penerbit' => $this->input->post('penerbit', true),
            'tahun_terbit' => $this->input->post('tahun', true),
            'isbn' => $this->input->post('isbn', true),
            'stok' => $this->input->post('stok', true),
            'dipinjam' => 0,
            'dibooking' => 0,
            'image' => $gambar ?? null
        ];
        $this->BookModel->simpanBuku($data);
        redirect('buku');
    }

    public function edit()
    {
        $data['title'] = 'Ubah Data Buku';
        $data['user'] = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->BookModel->bukuWhere(['id' => $this->uri->segment(3)])->row_array();
        $kategori = $this->BookModel->joinKategoriBuku(['buku.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['nama_kategori'];
        }

        $data['kategori'] = $this->BookModel->getKategori()->result_array();
        $this->callTemplate($data);
        $this->load->view('admin/_edit-buku', $data);
        $this->load->view('layouts/partials/dashboard/_footer');
    }

    public function update($id)
    {
        $this->setValidationRules();
        if ($this->form_validation->run() == false) {
            $this->edit();
            return;
        }

        $config = $this->imgUploadConfig();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $image = $this->upload->data();
            unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
            $gambar = $image['file_name'];
        } else {
            $gambar = $this->input->post('old_pict', TRUE);
        }

        $data = [
            'judul_buku' => $this->input->post('judul_buku', true),
            'id_kategori' => $this->input->post('id_kategori', true),
            'pengarang' => $this->input->post('pengarang', true),
            'penerbit' => $this->input->post('penerbit', true),
            'tahun_terbit' => $this->input->post('tahun', true),
            'isbn' => $this->input->post('isbn', true),
            'stok' => $this->input->post('stok', true),
            'image' => $gambar
        ];

        $this->BookModel->updateBuku($data, ['id' => $id]);
        redirect('buku');
    }

    public function delete($id)
    {
        $where = ['id' => $id];
        $buku = $this->BookModel->bukuWhere($where)->row_array();
        if ($buku['image'] != null) {
            unlink('assets/img/upload/' . $buku['image']);
        }
        $this->BookModel->hapusBuku($where);
        redirect('buku');
    }

    private function imgUploadConfig()
    {
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|svg|jfif';
        $config['max_size'] = '4096';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';
        $config['file_name'] = 'img' . time();

        return $config;
    }

    private function callTemplate($data)
    {
        $this->load->view('layouts/partials/dashboard/_header', $data);
        $this->load->view('layouts/partials/dashboard/_sidebar', $data);
        $this->load->view('layouts/partials/dashboard/_topbar', $data);
    }

    private function setValidationRules()
    {
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
            'required' => 'Judul Buku harus diisi',
            'min_length' => 'Judul buku terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Nama pengarang harus diisi',
        ]);
        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
            'required' => 'Nama pengarang harus diisi',
            'min_length' => 'Nama pengarang terlalu pendek'
        ]);
        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
            'required' => 'Nama penerbit harus diisi',
            'min_length' => 'Nama penerbit terlalu pendek'
        ]);
        $this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
            'required' => 'Tahun terbit harus diisi',
            'min_length' => 'Tahun terbit terlalu pendek',
            'max_length' => 'Tahun terbit terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
            'required' => 'Nama ISBN harus diisi',
            'min_length' => 'Nama ISBN terlalu pendek',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
    }
}
