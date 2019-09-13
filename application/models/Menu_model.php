<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function side_server_json()
	{
		$this->datatables->select('user_menu.id_menu,menu,id,parent_id,menu_id,title,url,icon,is_active');
        $this->datatables->from('user_sub_menu');
        $this->datatables->join('user_menu','user_menu.id_menu=user_sub_menu.menu_id');
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_sub_menu" id="check_sub_menu" class="check_sub_menu" value="$1">','id');
        $this->datatables->add_column('tool2', '<button type="button" class="btn btn-primary edit_record_sub_menu" data-toggle="modal" data-id = "$1" data-parent="$2" data-menu = "$3" data-title = "$4" data-url = "$5" data-icon = "$6" data-status = "$7" data-menu_user = "$8" data-target="#modal-success-sub_menu"><i class="fa fa-pencil"></i></button>','id,parent_id,menu_id,title,url,icon,is_active,menu');
        return print_r($this->datatables->generate());
	}

	public function side_server_json_label()
	{
		$this->datatables->select('id_menu,menu');
        $this->datatables->from('user_menu');
        $this->db->order_by('id_menu','desc');
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_label_menu" id="check_label_menu" class="check_label_menu" value="$1">','id_menu');
        $this->datatables->add_column('tool2', '<button type="button" class="btn btn-primary edit_record_label" data-toggle="modal" data-id_menu = "$1" data-menu = "$2" data-target="#modal-success-label"><i class="fa fa-pencil"></i></button>','id_menu,menu');
        return print_r($this->datatables->generate());
	}

	public function side_server_json_role()
	{
		$this->datatables->select('id,role');
        $this->datatables->from('user_role');
        $this->db->order_by('id','desc');
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_role_menu" id="check_role_menu" class="check_role_menu" value="$1">','id');
        $this->datatables->add_column('tool2', '<button type="button" class="btn btn-primary edit_record_role" data-toggle="modal" data-id = "$1" data-role = "$2" data-target="#modal-success-role"><i class="fa fa-pencil"></i></button>','id,role');
        return print_r($this->datatables->generate());
	}	

	public function label_menu()
	{
		$this->db->select('*');
		$this->db->from('user_menu');
		$query = $this->db->get();
		return $query->result();
	}

	public function parent_menu()
	{
		$this->db->select('*');
		$this->db->from('user_sub_menu');
		$query = $this->db->get();
		return $query->result();
	}

	public function icon()
	{
		$this->db->select('*');
		$this->db->from('icons');
		$query = $this->db->get();
		return $query->result();
	}

	public function user_role()
	{
		$this->db->select('*');
		$this->db->from('user_role');
		$query = $this->db->get();
		return $query->result();
	}

}

/* End of file Manage_menu.php */
/* Location: ./application/models/Manage_menu.php */