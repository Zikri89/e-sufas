<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

	public function index()
    {
        $data = array(
            'main_title'        =>  'Task List',
            'submain_title'     =>  'Halaman Task',
            'chiltitle'			=>	'Data Task List Pekerjaan',
            'konten'            =>  'page/task_list'
        );

        $this->load->view('layout/mainpage', $data, FALSE);
    }

    public function select2_faskes()
    {
        $faskes = $this->input->get('faskes');
        $query = $this->task_model->faskes($faskes,'name');
        echo json_encode($query);
    }

    function json_task()
    {
        $result = $this->task_model->side_server_json_task();
    }

    function json_task_kia()
    {
        $result = $this->task_model->side_server_json_task_kia();
    }

    public function simpan_data_task()
    {
        $i = $this->input;
        $faskes   		= $i->post('faskes');
        $reservation 	= $this->input->post('reservation');
        //convert tanggal
        $pecah_tanggal 	= explode('-', $reservation);
        $converttgl1 	= date('Y-m-d',strtotime($pecah_tanggal[0]));
        $converttgl2 	= date('Y-m-d',strtotime($pecah_tanggal[1]));

        $data = array(
            'tanggal_mulai'		=> $converttgl1,
            'tanggal_selesai'   => $converttgl2,
            'status'  			=> 0,
            'faskes_id'         => $faskes,
            'penyelia'     	    => $this->session->userdata('id_user'),
             );

        $query = $this->db->query('SELECT * FROM task WHERE faskes_id="'.$faskes.'" AND tanggal_mulai="'.$converttgl1.'" ');
        if($query->num_rows()>0){
            echo "<sapan class='btn btn-block btn-danger btn-lg'>Maaf task sudah terdaftar</span>";
        }else{
            $result = $this->task_model->simpan_data_task($data);
            //update tag pada table faskes
            $this->db->where('id',$data['faskes_id']);
            $this->db->update('faskes',array('tag' => '1'));
            echo "<sapan class='btn btn-block btn-success btn-lg'><b>Sukses!</b> Task berhasil di simpan</span>";
        }
    }

    public function hapus_json_task()
    {
        $id     = $this->input->post('id');
        foreach ($id as $id) {
            $this->db->delete('task', array('id' => $id));
            $this->db->delete('task_kia', array('id' => $id));
            //update tag pada table faskes
            $faskes = $this->input->post('faskes');
            foreach ($faskes as $faskes) {
                $this->db->where('id',$faskes);
                $this->db->update('faskes',array('tag' => '0'));
            }
        } 
        echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";
    }

    public function update_json_task()
    {
        $i = $this->input;
        $id_task     		= $i->post('id_task');
        $edit_faskes    	= $i->post('edit_faskes');
        $edit_reservation  	= $i->post('edit_reservation');
        //convert tanggal
        $pecah_tanggal 	= explode('-', $edit_reservation);
        $converttgl1 	= date('Y-m-d',strtotime($pecah_tanggal[0]));
        $converttgl2 	= date('Y-m-d',strtotime($pecah_tanggal[1]));

        $data = array(
            'tanggal_mulai'		=> $converttgl1,
            'tanggal_selesai'   => $converttgl2,
            'status'  			=> 0,
             );

        $this->db->where('id', $id_task);
        $this->db->update('task', $data);
        echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }

    public function update_json_task_kia()
    {
        $i = $this->input;
        $id_task            = $i->post('id_task');
        $edit_faskes        = $i->post('edit_faskes');
        $edit_reservation   = $i->post('edit_reservation');
        //convert tanggal
        $pecah_tanggal  = explode('-', $edit_reservation);
        $converttgl1    = date('Y-m-d',strtotime($pecah_tanggal[0]));
        $converttgl2    = date('Y-m-d',strtotime($pecah_tanggal[1]));

        $data = array(
            'tanggal_mulai'     => $converttgl1,
            'tanggal_selesai'   => $converttgl2,
            'status'            => 0,
             );

        $this->db->where('id', $id_task);
        $this->db->update('task_kia', $data);
        echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }

}

/* End of file Task.php */
/* Location: ./application/controllers/Task.php */