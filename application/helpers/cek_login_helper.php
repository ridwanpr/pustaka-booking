<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('cek_login')) {
    function cek_login()
    {
        $ci = get_instance();
        if (!$ci->session->userdata('email')) {
            $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!!</div>');
            redirect('auth/login');
        } else {
            $role_id = $ci->session->userdata('role_id');
        }
    }
}
