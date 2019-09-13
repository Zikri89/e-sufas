<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_faskes extends CI_Controller {

	public function index()
	{
        $data = array(
            'main_title'        =>  'Data Faskes',
            'submain_title'     =>  'Halaman Data Faskes',
            'chiltitle'			=>	'Data Faskes',
            'konten'            =>  'page/data_faskes'
        );

        $this->load->view('layout/mainpage', $data, FALSE);		
	}

	function side_server_json()
    {
        $result = $this->faskes_model->side_server_json();
    }

    public function simpan_data_faskes()
    {
    	$i = $this->input;
    	$kode_faskes	= $i->post('kode_faskes');
    	$regency_id 	= $i->post('regency_id');
    	$nama_faskes 	= $i->post('nama_faskes');
    	$alamat_faskes 	= $i->post('alamat_faskes');
    	$data = array(
    		'id'			=> $kode_faskes,
    		'regency_id'	=> $regency_id,
    		'name' 			=> $nama_faskes,
    		'alamat' 		=> $alamat_faskes
    		 );
		$query = $this->db->query('SELECT id FROM faskes WHERE id="'.$kode_faskes.'" ');
    	if($query->num_rows()>0){
    		echo "<sapan class='btn btn-block btn-danger btn-lg'><b>Gagal!</b> Data <b>(".$kode_faskes.")</b> sudah terdaftar</span>";
    	}else{
    		$result = $this->db->insert('faskes',$data);
    		echo "<sapan class='btn btn-block btn-success btn-lg'><b>Sukses!</b> Data <b>(".$kode_faskes.")</b> berhasil di tambahkan</span>";
    	}
    }

    public function hapus_json_faskes()
    {
    	$id = $this->input->post('id');
    	foreach ($id as $id) {
    		$this->db->delete('faskes', array('id' => $id));
    	} 
    }

    public function update_json_faskes()
    {
    	$i = $this->input;
    	$edit_regency_id 	= $i->post('edit_regency_id');
    	$edit_faskes_id		= $i->post('edit_faskes_id');
    	$edit_nama_faskes 	= $i->post('edit_nama_faskes');
    	$edit_alamat_faskes = $i->post('edit_alamat_faskes');
    	$data = array(
    		'regency_id'	=> $edit_regency_id,
    		'name' 			=> $edit_nama_faskes,
    		'alamat' 		=> $edit_alamat_faskes
    		 );

		$result = $this->db->where('id', $edit_faskes_id)->update('faskes', $data);
		if($result){
			$notif = "Sukses! data faskes berhasil di ubah";
		}else{
			$notif = "Gagal! Terjadi kesalahan pada server silahkan hubungi Administrator";
		}

		$arrResult = array('notif' => $notif);
		echo json_encode($arrResult);
    }

}

/* End of file Data_faskes.php */
/* Location: ./application/controllers/Data_faskes.php */