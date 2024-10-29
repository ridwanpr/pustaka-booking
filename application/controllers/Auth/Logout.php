<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function postLogout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
