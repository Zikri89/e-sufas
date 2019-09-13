<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_menu extends CI_Controller {
public function __construct()
    {
        parent::__construct();
        $this->simple_admin->cek_login();
        $this->simple_admin->cek_active();
        $this->simple_admin->cek_login_admin();
    }
	public function index()
	{
		$menu 			= $this->menu_model->label_menu();
		$akses_menu		= $this->menu_model->label_menu();
		$parent_menu 	= $this->menu_model->parent_menu();
		$icon 			= $this->menu_model->icon();
		$user_role		= $this->menu_model->user_role();
		$data = array(
			'main_title' 	=> 'Managemen Menu',
			'submain_title'	=> 'Mengatur Menu Admin maupun User',
			'menu'			=>	$menu,
			'akses_menu'	=>	$akses_menu,
			'parent_menu'	=>	$parent_menu,
			'icon'			=>	$icon,
			'user_role'		=>	$user_role,
			'konten'		=> 'page/managemen_menu' );

		$this->load->view('layout/mainpage', $data, FALSE);		
	}


    public function simpan_data_set_role()
    {
    	$i = $this->input;
    	$user_role 	= $i->post('user_role');
    	$akses_menu = $i->post('akses_menu');
    	
    	foreach ($akses_menu as $key => $akses_menu) {
    		$data[] = array(
    			'role_id' => $user_role,
    			'menu_id' => $akses_menu
    	 	);

    	 	//var_dump($data[$key]) ;
    	}

    	$query = $this->db->query('SELECT * FROM user_akses_menu WHERE role_id="'.$user_role.'" AND menu_id="'.$akses_menu.'" ');
    	if($query->num_rows()>0){
    		echo "<sapan class='btn btn-block btn-danger btn-lg'><b>Gagal!</b> Label <b>(".$user_role.")</b> sudah terdaftar</span>";
    	}else{
    		$result = $this->db->insert_batch('user_akses_menu',$data);
    		echo "<sapan class='btn btn-block btn-success btn-lg'><b>Sukses!</b> Label <b>(".$user_role.")</b> berhasil di tambahkan</span>";
    	}
    }

    function json_role()
    {
        $result = $this->menu_model->side_server_json_role();
    }

    public function hapus_json_role()
    {
    	$id = $this->input->post('id');
    	foreach ($id as $id) {
    		$this->db->delete('user_role', array('id' => $id));
    	} 
    	echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";
    }

    public function update_json_role()
    {
    	$id 	= $this->input->post('id');
    	$role 	= $this->input->post('role');
		$this->db->where('id', $id);
		$this->db->update('user_role', array('role' => $role));
		echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }

    public function simpan_data_label()
    {
    	$i = $this->input;
    	$label = $i->post('label_menu');
    	$data = array('menu' => $label );

    	// /var_dump($data);

    	$query = $this->db->query('SELECT menu FROM user_menu WHERE menu="'.$label.'" ');
    	if($query->num_rows()>0){
    		echo "<sapan class='btn btn-block btn-danger btn-lg'><b>Gagal!</b> Label <b>(".$label.")</b> sudah terdaftar</span>";
    	}else{
    		$result = $this->db->insert('user_menu',$data);
    		echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> Label <b>(".$label.")</b> berhasil di tambahkan</span>";
    	}
    }

	function json_label()
    {
        $result = $this->menu_model->side_server_json_label();
    }

    public function hapus_json_label()
    {
    	$id = $this->input->post('id');
    	foreach ($id as $id) {
    		$this->db->delete('user_menu', array('id_menu' => $id));
    	} 
    	echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";
    }

    public function update_json_label()
    {
    	$id 	= $this->input->post('id');
    	$menu 	= $this->input->post('menu');
		$this->db->where('id_menu', $id);
		$this->db->update('user_menu', array('menu' => $menu));
		echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }

    public function simpan_data_parent_menu()
    {
    	$i = $this->input;
    	$sub_menu 			= $i->post('sub_menu_parent');
    	$parent_menu_add 	= $i->post('parent_menu_add');
    	$url_add 			= $i->post('url_add');
    	$icon_add 			= $i->post('icon_add');
    	$status_add 		= $i->post('status_add');
    	$data = array(
    		'parent_id' => 0,
    		'menu_id' 	=> $sub_menu,
    		'title' 	=> $parent_menu_add,
    		'url' 		=> $url_add,
    		'icon' 		=> $icon_add,
    		'is_active'	=> 1
    	 );

    	$query = $this->db->query('SELECT title FROM user_sub_menu WHERE title="'.$parent_menu_add.'" ');
    	if($query->num_rows()>0){
    		echo "<sapan class='btn btn-block btn-danger btn-lg'><b>Gagal!</b> Label <b>(".$parent_menu_add.")</b> sudah terdaftar</span>";
    	}else{
    		$result = $this->db->insert('user_sub_menu',$data);
    		echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> Label <b>(".$parent_menu_add.")</b> berhasil di tambahkan</span>";
    	}
    }

    public function simpan_data_sub_menu()
    {
    	$i = $this->input;
    	$parent_menu 		= $i->post('parent_menu');
    	$label_sub_menu		= $i->post('label_sub_menu');
    	$nama_sub_menu		= $i->post('nama_sub_menu');
    	$url 	 			= $i->post('url');
    	$icon 	 			= $i->post('icon');
    	$status 	  		= $i->post('status');
    	$data = array(
    		'parent_id' => $parent_menu,
    		'menu_id' 	=> $label_sub_menu,
    		'title' 	=> $nama_sub_menu,
    		'url' 		=> $url,
    		'icon' 		=> $icon,
    		'is_active'	=> 1
    	 );

    	$query = $this->db->query('SELECT title FROM user_sub_menu WHERE title="'.$nama_sub_menu.'" ');
    	if($query->num_rows()>0){
    		echo "<sapan class='btn btn-block btn-danger btn-lg'><b>Gagal!</b> Label <b>(".$nama_sub_menu.")</b> sudah terdaftar</span>";
    	}else{
    		$result = $this->db->insert('user_sub_menu',$data);
    		echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> Label <b>(".$nama_sub_menu.")</b> berhasil di tambahkan</span>";
    	}
    }

    function json()
    {
        $result = $this->menu_model->side_server_json();
    }

	function hapus_json()
    {
        $id = $this->input->post('id');
    	foreach ($id as $id) {
    		$this->db->delete('user_sub_menu', array('id' => $id));
    	}
    	echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";

    }

    public function update_json_sub_menu()
    {
    	$id 		= $this->input->post('id');
    	$parent		= $this->input->post('parent');
    	$menu 		= $this->input->post('menu');
    	$title 		= $this->input->post('title');
    	$url 		= $this->input->post('url');
    	$icon 		= $this->input->post('icon');
    	$status 	= $this->input->post('status');

    	$data = array(
    		'parent_id' => $parent,
    		'menu_id'	=> $menu,
    		'title'		=> $title,
    		'url'		=> $url,
    		'icon'		=> $icon,
    		'is_Active'	=> $status
    		 );

		$this->db->where('id', $id);
		$this->db->update('user_sub_menu', $data);
		echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }

}

/* End of file Manage_menu.php */
/* Location: ./application/controllers/Manage_menu.php */