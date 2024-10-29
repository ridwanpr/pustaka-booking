<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function index()
    {
        if ($this->session->has_userdata('role_id')) {
            $user = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
            redirectUserBasedOnRole($user);
        }

        $data['title'] = 'Register Member';
        $this->load->view('layouts/partials/auth/_header', $data);
        $this->load->view('auth/register');
        $this->load->view('layouts/partials/auth/_footer');
    }

    public function postRegister()
    {
        $this->setValidationRules();

        if ($this->form_validation->run() == false) {
            $this->index();
            return;
        }

        $email = $this->input->post('email', true);
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($email),
            'image' => 'default.png',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1,
            'tanggal_input' => time()
        ];

        $this->UserModel->saveData($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-message" role="alert">Selamat! akun anda sudah dibuat.</div>');
        redirect('auth/login');
    }

    private function setValidationRules()
    {
        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required|trim',
            ['required' => 'Nama harus diisi!']
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[users.email]',
            ['is_unique' => 'Email sudah terdaftar', 'required' => 'Email harus diisi!', 'valid_email' => 'Email tidak valid!']
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim|min_length[3]|matches[confirm_password]',
            [
                'matches' => 'Password tidak sama!',
                'min_length' => 'Password minimal 3 karakter!',
                'required' => 'Password harus diisi!'
            ]
        );
        $this->form_validation->set_rules(
            'confirm_password',
            'Confirm Password',
            'required|trim|matches[password]',
            ['required' => 'Konfirmasi Password harus diisi!', 'matches' => 'Password tidak sama!']
        );
    }
}
