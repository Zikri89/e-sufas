<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_assesment_model extends CI_Model {
	public function side_server_json_list_item_apn(){
		$this->datatables->select('a.id as idapnlist,b.id as idapnmenu,a.kode as kodeapnlist,name,apn_menu_id,asuhan_persalinan');
		$this->datatables->from('apn_list a');
		$this->datatables->join('apn_menu b','a.apn_menu_id=b.id');
		$this->datatables->add_column('check','<input type="checkbox" name="check_apn_list_item" id="check_apn_list_item" class="check_apn_list_item" value="$1">','idapnlist');
		$this->datatables->add_column('edit','<button type="button" name="edit_apn_list_item" id="edit_apn_list_item" class="btn btn-primary edit_apn_list_item" data-toggle="modal" data-target="#edit-apn-item" data-idapnlist="$1" data-idapnmenu="$2" data-asuhan_persalinan="$3" data-kodeapnlist="$4" data-name="$5"><i class="fa fa-pencil"></i></button>','idapnlist,idapnmenu,asuhan_persalinan,kodeapnlist,name');
		return print_r($this->datatables->generate());
	}

	public function side_server_json_list_item_kia(){
		$this->datatables->select('a.id as idkialist,b.id as idkiamenu,a.kode as kodekialist,name,kia_menu_id,asuhan_persalinan');
		$this->datatables->from('kia_list a');
		$this->datatables->join('kia_menu b','a.kia_menu_id=b.id');
		$this->datatables->add_column('check','<input type="checkbox" name="check_apn_list_item" id="check_apn_list_item" class="check_apn_list_item" value="$1">','idkialist');
		$this->datatables->add_column('edit','<button type="button" name="edit_kia_list_item" id="edit_kia_list_item" class="btn btn-primary edit_kia_list_item" data-toggle="modal" data-target="#edit-kia-item" data-idkialist="$1" data-idkiamenu="$2" data-asuhan_persalinan="$3" data-kodekialist="$4" data-name="$5"><i class="fa fa-pencil"></i></button>','idkialist,idkiamenu,asuhan_persalinan,kodekialist,name');
		return print_r($this->datatables->generate());
	}

	public function select2_kategori_apn($kategori,$column){
		$this->db->select('*');
		$this->db->from('apn_menu');
		$this->db->like('asuhan_persalinan',$kategori);
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}

	public function select2_kategori_kia($kategori,$column){
		$this->db->select('*');
		$this->db->from('kia_menu');
		$this->db->like('asuhan_persalinan',$kategori);
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}
}

/* End of file Item_assesment_model.php */
/* Location: ./application/models/Item_assesment_model.php */