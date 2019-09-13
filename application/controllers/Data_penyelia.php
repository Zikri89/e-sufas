<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_penyelia extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->simple_admin->cek_login();
        $this->simple_admin->cek_login_penyelia();
        $this->simple_admin->cek_active();
    }

    public function index()
    {
        $data = array(
            'main_title'    =>  'Data Penyelia',
            'submain_title' =>  'Data Penyelia Faskes',
            'chiltitle'		=>	'Daftar Nama Nama Penyelia Faskes',
            'konten'        =>  'page/penyelia'
        );

        $this->load->view('layout/mainpage', $data, FALSE);
    }

    function json_penyelia()
    {
        $result = $this->data_penyelia_model->side_server_json_penyelia();
    }
}

/* End of file Data_penyelia.php */
/* Location: ./application/controllers/Data_penyelia.php */