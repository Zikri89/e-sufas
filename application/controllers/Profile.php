<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{
		$profile = $this->profile_model->profile();
		$jenis_faskes = $this->user_model->jenis_faskes();
        $data = array(
            'main_title'    =>  'Profile',
            'submain_title' =>  'Data Profile faskes',
            'profile'		=>	$profile,
            'jenis_faskes'	=>	$jenis_faskes,
            'konten'        =>  'page/profile'
        );

        $this->load->view('layout/mainpage', $data, FALSE);		
	}
	
	function json_user()
    {
        $result = $this->user_model->side_server_json_user();
    }

    public function faskes()
    {
        $faskes = $this->input->get('faskes');
        $query = $this->wilayah_model->faskes($faskes,'name');
        echo json_encode($query);
    }

    public function kabupaten()
    {
        $kab = $this->input->get('kabupaten');
        $query = $this->wilayah_model->kabupaten($kab,'name');
        echo json_encode($query);
    }

    public function kecamatan()
    {
        $kec = $this->input->get('kecamatan');
        $query = $this->wilayah_model->kecamatan($kec,'name');
        echo json_encode($query);
    }

    public function kelurahan()
    {
        $kel = $this->input->get('kelurahan');
        $query = $this->wilayah_model->kelurahan($kel,'name');
        echo json_encode($query);
    }

    public function update_json_user()
    {
        $i = $this->input;
        $id_user     = $i->post('id_user');
        $jns_faskes  = $i->post('jns_faskes');
        $alamat      = $i->post('alamat');
        $kabupaten   = $i->post('kabupaten');
        $kecamatan   = $i->post('kecamatan');
        $kelurahan   = $i->post('kelurahan');

        $data = array(
            'jenis_faskes'  => $jns_faskes,
            'alamat'        => $alamat,
            'kabupaten'     => $kabupaten,
            'kecamatan'     => $kecamatan,
            'kelurahan'     => $kelurahan,
        );

        $this->db->where('id', $id_user);
        $this->db->update('user', $data);
        echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }

    public function update_password()
    {
        $i = $this->input;
        $passwordLama   = $i->post('passwordLama');
        $passwordBaru   = $i->post('passwordBaru');

        $data = array(
            'password_baru'  => sha1($passwordBaru)
        );
        $query = $this->db->query("SELECT * FROM user WHERE id='".$this->session->userdata('id_user')."' ");
        $row = $query->row(); 
        if($row->password===sha1($passwordLama)){
        	$this->db->where('id', $this->session->userdata('id_user'));
	        $this->db->where('password', sha1($passwordLama));
	        $this->db->update('user', $data);
	        $notif = 1;	
        }else{
        	$notif = 2;
        }

        $arrayData = array('notif' => $notif);
        echo json_encode($arrayData);
    }

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */