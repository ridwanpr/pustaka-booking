<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        if ($this->session->has_userdata('role_id')) {
            $user = $this->UserModel->checkUser(['email' => $this->session->userdata('email')])->row_array();
            redirectUserBasedOnRole($user);
        }

        $data['title'] = 'Login';
        $data['user'] = '';

        $this->load->view('layouts/partials/auth/_header', $data);
        $this->load->view('auth/login');
        $this->load->view('layouts/partials/auth/_footer');
    }

    public function postLogin()
    {
        $this->set_validation_rules();
        if ($this->form_validation->run() == false) {
            $this->index();
            return;
        }

        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $user = $this->UserModel->checkUser(['email' => $email])->row_array();

        if (!$user || !password_verify($password, $user['password'])) {
            $this->showErrorMessage('Email atau Password salah!');
            return;
        }

        if ($user['is_active'] == 0) {
            $this->showErrorMessage('User belum diaktivasi!');
            return;
        }

        $this->setSessionData($user);
        redirectUserBasedOnRole($user);
    }

    private function set_validation_rules()
    {
        $config = [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
                ],
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Password harus diisi!',
                ],
            ],
        ];
        $this->form_validation->set_rules($config);
    }

    private function setSessionData($user)
    {
        $userData = [
            'id_user' => $user['id'],
            'email' => $user['email'],
            'role_id' => $user['role_id']
        ];

        $this->session->set_userdata($userData);
    }

    private function showErrorMessage($message)
    {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert">' . $message . '</div>');
        redirect('auth/login');
    }
}

