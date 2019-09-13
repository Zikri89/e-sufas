<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dasbor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->simple_admin->cek_login();
        $this->simple_admin->cek_active();
    }

    public function index()
    {
        $data = array(
            'main_title'        =>  'Dasbor',
            'submain_title'     =>  'Halaman Dasbor E-Surfas',
            'konten'            =>  'page/dasbor'
        );

        $this->load->view('layout/mainpage', $data, FALSE);
    }
}
        
    /* End of file  Dasbor2.php */
