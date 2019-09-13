<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assesment extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->simple_admin->cek_login();
        $this->simple_admin->cek_active();
        $this->simple_admin->cek_login_penyelia();
    }

    public function index(){
        $task = $this->db->get('task')->num_rows();
        $data = array(
            'main_title'    => 'Setting Assesment',
            'submain_title' => 'Halaman Setting Assesment',
            'task'          => $task,
            'konten'        => 'page/setting_assesment' );
        $this->load->view('layout/mainpage', $data, FALSE);
    }

    public function select2_faskes()
    {
        $faskes = $this->input->get('faskes');
        $query = $this->assesment_model->faskes($faskes,'name');
        echo json_encode($query);
    }

    public function set_assesment_faskes(){
        $i = $this->input;
        $id_faskes = $i->post('id_faskes');
        $faskes = $i->post('faskes');
        $semester = $i->post('semester');

        $this->session->set_userdata('assesment_faskes',$id_faskes);
        $this->session->set_userdata('assesment_faskes2',$faskes);
        $this->session->set_userdata('semester',$semester);

        $data = array('status' => 1 );

        $this->db->where('faskes_id', $id_faskes);
        $this->db->update('task', $data);

        $this->db->where('faskes_id', $id_faskes);
        $this->db->update('task_kia', $data);

        echo "<sapan class='btn btn-block btn-success btn-lg'><b>Sukses!</b> faskes assesment telah di set ".$this->session->userdata('semester')."</span>";
        //redirect('dasbor','refresh');
    }

}

/* End of file Assesment.php */
/* Location: ./application/controllers/Assesment.php */