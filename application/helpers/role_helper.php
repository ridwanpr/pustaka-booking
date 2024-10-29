<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('redirectUserBasedOnRole')) {
    function redirectUserBasedOnRole($user)
    {
        $CI =& get_instance();

        if ($user['role_id'] == 1) {
            redirect('admin');
        } else {
            if ($user['image'] == 'default.png') {
                $CI->session->set_flashdata(
                    'message',
                    '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>'
                );
            }
            redirect('/');
        }
    }
}