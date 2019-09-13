<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function user_role()
	{
		$this->db->select('*');
		$this->db->from('user_role');
		$query = $this->db->get();
		return $query->result();
	}

	public function jenis_faskes()
	{
		$this->db->select('*');
		$this->db->from('jenis_faskes');
		$query = $this->db->get();
		return $query->result();
	}

	public function simpan_data_user($data)
	{
		$this->db->insert('user',$data);
	}

	public function side_server_json_user()
	{
		$this->datatables->select('id,username,email,jenis_faskes,faskes_id,alamat,kabupaten,kecamatan,kelurahan,is_active');
        $this->datatables->from('user');
        $this->db->order_by('id','desc');
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_user" id="check_user" class="check_user" value="$1">','id');
        $this->datatables->add_column('tool2', '<button type="button" class="btn btn-primary edit_record_user" data-toggle="modal" data-id = "$1" data-username="$2" data-email = "$3" data-jns_faskes = "$4" data-faskes = "$5" data-alamat = "$6" data-kabupaten = "$7" data-kecamatan = "$8" data-kelurahan = "$9" data-target="#edit-modal-user"><i class="fa fa-pencil"></i></button>','id,username,email,jenis_faskes,faskes_id,alamat,kabupaten,kecamatan,kelurahan');
        return print_r($this->datatables->generate());
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */