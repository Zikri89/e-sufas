<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_export_model extends CI_Model {

	public function apn_assement($semester,$nama_assesment,$converttgl1,$converttgl2){
		$this->db->select('*,b.name as nameapnlist');
		$this->db->from('apn_assesment a');
		$this->db->join('apn_list b','a.apn_list_id=b.id');
		$this->db->join('user c','a.penyelia=c.id');
		$this->db->join('faskes d','a.kode_faskes=d.id');
		$this->db->join('apn_menu e','b.apn_menu_id=e.id');
		$this->db->where('semester',$semester);
        $this->db->where('a.kode_faskes',$nama_assesment);
        $this->db->where('create_at >=',$converttgl1);
        $this->db->where('create_at <=',$converttgl2);
		$query = $this->db->get();
		return $query->result();
	}

	public function kia_assement($semester,$nama_assesment,$converttgl1,$converttgl2){
		$this->db->select('*,b.name as namekialist');
		$this->db->from('kia_assesment a');
		$this->db->join('kia_list b','a.kia_list_id=b.id');
		$this->db->join('user c','a.penyelia=c.id');
		$this->db->join('faskes d','a.kode_faskes=d.id');
		$this->db->join('kia_menu e','b.kia_menu_id=e.id');
		$this->db->where('semester',$semester);
        $this->db->where('a.kode_faskes',$nama_assesment);
        $this->db->where('create_at >=',$converttgl1);
        $this->db->where('create_at <=',$converttgl2);
		$query = $this->db->get();
		return $query->result();
	}
	

}

/* End of file Excel_export_model.php */
/* Location: ./application/models/Excel_export_model.php */