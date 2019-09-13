<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perlengkapan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->simple_admin->cek_login();
        $this->simple_admin->cek_login_penyelia();
    }

    public function index()
    {
        $data = array(
            'main_title'    =>  'Asuhan Persalinan',
            'submain_title' =>  'Penilaian Struktur Fisik',
            'chiltitle'     =>  'Struktur Fisik Ruang Persalinan Faskes <strong>('.$this->session->userdata('assesment_faskes2').' )</strong>',
            'konten'        =>  'page/struktur_fisik'
        );

        $this->load->view('layout/mainpage', $data, FALSE);
    }

    function side_server_json_assesment($param)
    {
        $result = $this->assesment_model->side_server_json_assesment($param);
    }

}

/* End of file Perlengkapan.php */
/* Location: ./application/controllers/asuhan_persalinan/Perlengkapan.php */