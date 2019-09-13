<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {
	public function profile(){
		$this->db->select('*,a.id as iduser,a.alamat as alamatuser');
		$this->db->from('user a');
		$this->db->join('faskes b','a.faskes_id=b.id');
		$this->db->where('username',$this->session->userdata('username'));
		$query = $this->db->get();
		return $query->row();
	}
	

}

/* End of file Profile_model.php */
/* Location: ./application/models/Profile_model.php */