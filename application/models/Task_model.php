<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

	public function side_server_json_task()
	{
		$this->datatables->select('a.id as idtask,faskes_id,tanggal_mulai,tanggal_selesai,a.status as statustask,persen,b.id as faskesid,name');
        $this->datatables->from('task a');
        $this->datatables->join('faskes b','a.faskes_id=b.id');
        $this->db->order_by('a.id','desc');
        if($this->session->userdata('role_id')!=1){
            $this->db->where('penyelia',$this->session->userdata('id_user'));
        }
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_task" id="check_task" class="check_task" data-kdfaskes="$1" value="$2">','faskesid,idtask');
        $this->datatables->add_column('tool2','$1','persen');
        $this->datatables->add_column('tool3', '<button type="button" class="btn btn-primary edit_record_task" data-toggle="modal" data-id = "$1" data-faskes_id="$2" data-tanggal_mulai = "$3" data-tanggal_selesai = "$4" data-faskesid="$5" data-faskes="$6" data-target="#edit-modal-task"><i class="fa fa-pencil"></i></button>','idtask,faskes_id,tanggal_mulai,tanggal_selesai,faskesid,name');
        return print_r($this->datatables->generate());
	}

    public function side_server_json_task_kia()
    {
        $this->datatables->select('a.id as idtask,faskes_id,tanggal_mulai,tanggal_selesai,a.status as statustask,persen,b.id as faskesid,name');
        $this->datatables->from('task_kia a');
        $this->datatables->join('faskes b','a.faskes_id=b.id');
        $this->db->order_by('a.id','desc');
        if($this->session->userdata('role_id')!=1){
            $this->db->where('penyelia',$this->session->userdata('id_user'));
        }
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_task" id="check_task" class="check_task" value="$1">','idtask');
        $this->datatables->add_column('tool2','$1','persen');
        $this->datatables->add_column('tool3', '<button type="button" class="btn btn-primary edit_record_task_kia" data-toggle="modal" data-id = "$1" data-faskes_id="$2" data-tanggal_mulai = "$3" data-tanggal_selesai = "$4" data-faskesid="$5" data-faskes="$6" data-target="#edit-modal-task-kia"><i class="fa fa-pencil"></i></button>','idtask,faskes_id,tanggal_mulai,tanggal_selesai,faskesid,name');
        return print_r($this->datatables->generate());
    }	

	public function simpan_data_task($data)
	{
        $this->db->insert('task',$data);
		$this->db->insert('task_kia',$data);
	}

	public function faskes($faskes,$column){
        $this->db->select('*');
        $this->db->from('faskes');
        $this->db->like($column,$faskes);
        $this->db->where('tag','0');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }

}

/* End of file Task_model.php */
/* Location: ./application/models/Task_model.php */