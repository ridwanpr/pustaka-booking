<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('is_admin')) {
    function is_admin()
    {
        $ci = get_instance();
        if ($ci->session->userdata('role_id') != 1) {
            redirect('user/index');
        }
    }
}
