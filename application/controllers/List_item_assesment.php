<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_item_assesment extends CI_Controller {

	public function index()
	{
        $data = array(
            'main_title'        =>  'Item List Menu',
            'submain_title'     =>  'Halaman Item List Menu',
            'chiltitle'     	=>  'Daftar List Item',
            'konten'            =>  'page/list_item_assesment'
        );		

        $this->load->view('layout/mainpage', $data, FALSE);
	}

    function json_list_item_apn()
    {
        $result = $this->item_assesment_model->side_server_json_list_item_apn();
    }

    function json_list_item_kia()
    {
        $result = $this->item_assesment_model->side_server_json_list_item_kia();
    }

    public function select2_kategori_apn(){
    	$kategori = $this->input->get('apn_menu');
        $query = $this->item_assesment_model->select2_kategori_apn($kategori,'asuhan_persalinan');
        echo json_encode($query);
    }

    public function select2_kategori_kia(){
    	$kategori = $this->input->get('kia_menu');
        $query = $this->item_assesment_model->select2_kategori_kia($kategori,'asuhan_persalinan');
        echo json_encode($query);
    }

    public function simpan_data_item_apn(){
    	$kategori 	= $this->input->post('kategori_apn');
    	$kode 		= $this->input->post('kode_apn');
    	$name 		= $this->input->post('name_apn');

    	$data = array(
    		'kode' 			=> $kode,
    		'name' 			=> $name,
    		'apn_menu_id'	=> $kategori
    	);

        $query = $this->db->query("SELECT apn_menu_id,kode FROM apn_list WHERE apn_menu_id=".$kategori." AND kode =".$kode." ");
        if($query->num_rows()>0){
            $notif = 1;
        }else{
            $this->db->insert('apn_list',$data);
            $notif = 2;
        }

        $arrNotif = array('notif' => $notif);
        echo json_encode($arrNotif);
    }

    public function simpan_data_item_kia(){
    	$kategori 	= $this->input->post('kategori_kia');
    	$kode 		= $this->input->post('kode_kia');
    	$name 		= $this->input->post('name_kia');

    	$data = array(
    		'kode' 			=> $kode,
    		'name' 			=> $name,
    		'kia_menu_id'	=> $kategori
    	);

        $query = $this->db->query("SELECT kia_menu_id,kode FROM kia_list WHERE kia_menu_id=".$kategori." AND kode =".$kode." ");
        if($query->num_rows()>0){
            $notif = 1;
        }else{
            $this->db->insert('kia_list',$data);
            $notif = 2;
        }

        $arrNotif = array('notif' => $notif);
        echo json_encode($arrNotif);
    }

    public function hapus_json_ls_item_apn()
    {
        $id = $this->input->post('id');
        foreach ($id as $id) {
            $this->db->delete('apn_list', array('id' => $id));
        } 
        echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";
    }

    public function hapus_json_ls_item_kia()
    {
        $id = $this->input->post('id');
        foreach ($id as $id) {
            $this->db->delete('kia_list', array('id' => $id));
        } 
        echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";
    }

    public function edit_apn_list_item(){
        $edit_idapnlist    = $this->input->post('edit_idapnlist');
    	$edit_kategori_apn = $this->input->post('edit_kategori_apn');
    	$edit_kode_apn 	   = $this->input->post('edit_kode_apn');
    	$edit_name_apn 	   = $this->input->post('edit_name_apn');
    	
    	$data = array(
            'apn_menu_id'   => $edit_kategori_apn,
    		'kode' 			=> $edit_kode_apn,
    		'name' 			=> $edit_name_apn
    	);

    	$result = $this->db->where('id',$edit_idapnlist)->update('apn_list',$data);
        if($result){
            $notif = 2; 
        }else{
            $notif = 1;
        }

        $arrNotif = array("notif" => $notif);
        echo json_encode($arrNotif);
    }

    public function edit_kia_list_item(){
        $edit_idkialist    = $this->input->post('edit_idkialist');
        $edit_kategori_kia = $this->input->post('edit_kategori_kia');
        $edit_kode_kia     = $this->input->post('edit_kode_kia');
        $edit_name_kia     = $this->input->post('edit_name_kia');
        
        $data = array(
            'kia_menu_id'   => $edit_kategori_kia,
            'kode'          => $edit_kode_kia,
            'name'          => $edit_name_kia
        );

        $result = $this->db->where('id',$edit_idkialist)->update('kia_list',$data);
        if($result){
            $notif = 2; 
        }else{
            $notif = 1;
        }

        $arrNotif = array("notif" => $notif);
        echo json_encode($arrNotif);
    }
}

/* End of file Apn_menu.php */
/* Location: ./application/controllers/Apn_menu.php */