<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends CI_Controller {

    public function index()
    {
        $data = array(
            'main_title'    =>  '404 Error Page',
            'submain_title' =>  '404 Error Page',
            'chiltitle'     =>  'Halaman Tidak di Temukan',
            'konten'        =>  'page/blank'
        );

        $this->load->view('layout/mainpage', $data, FALSE);
    }

}

/* End of file Blank.php */
/* Location: ./application/controllers/Blank.php */