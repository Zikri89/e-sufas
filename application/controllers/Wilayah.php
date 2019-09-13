<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->simple_admin->cek_login();
        $this->simple_admin->cek_active();
        $this->simple_admin->cek_login_admin();
    }

    public function index()
    {
        $data = array(
            'main_title'    =>  'Data Wilayah',
            'submain_title' =>  'Data Master Wilayah',
            'chiltitle'     =>  'Daftar nama wilayah',
            'konten'        =>  'page/wilayah'
        );

        $this->load->view('layout/mainpage', $data, FALSE);
    }

    function side_server_json_kabupaten()
    {
        $result = $this->wilayah_model->side_server_json_kabupaten();
    }

    public function select2_provinsi()
    {
        $provinsi = $this->input->get('provinsi');
        $query = $this->wilayah_model->provinsi($provinsi,'name');
        echo json_encode($query);
    }

    public function simpan_kabupaten()
    {
    	$i = $this->input;
    	$kode_kota		= $i->post('kode_kota');
    	$province_id 	= $i->post('province_id');
    	$nama_kabupaten = $i->post('nama_kabupaten');
    	$data = array(
    		'id'			=> $kode_kota,
    		'province_id'	=> $province_id,
    		'name' 			=> $nama_kabupaten
    		 );
    	var_dump($data);
		$query = $this->db->query('SELECT * FROM kabupaten WHERE id="'.$kode_kota.'" ');
    	if($query->num_rows()>0){
    		echo "<sapan class='btn btn-block btn-danger btn-lg'><b>Gagal!</b> Data <b>(".$nama_kabupaten.")</b> sudah terdaftar</span>";
    	}else{
    		$result = $this->db->insert('kabupaten',$data);
    		echo "<sapan class='btn btn-block btn-success btn-lg'><b>Sukses!</b> Data <b>(".$nama_kabupaten.")</b> berhasil di tambahkan</span>";
    	}
    }

    public function hapus_json_kabupaten()
    {
    	$id = $this->input->post('id');
    	foreach ($id as $id) {
    		$this->db->delete('kabupaten', array('id' => $id));
    	} 
    	echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";
    }

    public function update_json_kabupaten()
    {
    	$kode 		= $this->input->post('kode');
    	$provinsi 	= $this->input->post('provinsi');
    	$name 		= $this->input->post('name');

    	$data = array(	'id' 			=> $kode,
    					'province_id'	=> $provinsi,
    					'name'			=> $name
    	 );

		$this->db->where('id', $kode);
		$this->db->update('kabupaten', $data);
		echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }

    function side_server_json_kecamatan()
    {
        $result = $this->wilayah_model->side_server_json_kecamatan();
    }

    public function select2_kabupaten()
    {
        $kab = $this->input->get('kabupaten');
        $query = $this->wilayah_model->kabupaten($kab,'name');
        echo json_encode($query);
    }

	public function simpan_kecamatan()
    {
    	$i = $this->input;
    	$kode_kecamatan	= $i->post('kode_kecamatan');
    	$regency_id 	= $i->post('regency_id');
    	$nama_kecamatan = $i->post('nama_kecamatan');
    	$data = array(
    		'id'			=> $kode_kecamatan,
    		'regency_id'	=> $regency_id,
    		'name' 			=> $nama_kecamatan
    		 );

		var_dump($data);
    	$query = $this->db->query('SELECT * FROM kecamatan WHERE id="'.$kode_kecamatan.'" ');
    	if($query->num_rows()>0){
    		echo "<sapan class='btn btn-block btn-danger btn-lg'><b>Gagal!</b> Data <b>(".$nama_kecamatan.")</b> sudah terdaftar</span>";
    	}else{
    		$result = $this->db->insert('kecamatan',$data);
    		echo "<sapan class='btn btn-block btn-success btn-lg'><b>Sukses!</b> Data <b>(".$nama_kecamatan.")</b> berhasil di tambahkan</span>";
    	}
    }

    public function hapus_json_kecamatan()
    {
    	$id = $this->input->post('id');
    	foreach ($id as $id) {
    		$this->db->delete('kecamatan', array('id' => $id));
    	} 
    	echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";
    }

    public function update_json_kecamatan()
    {
    	$kode 		= $this->input->post('kode');
    	$kabupaten 	= $this->input->post('kabupaten');
    	$name 		= $this->input->post('name');

    	$data = array(	'id' 			=> $kode,
    					'regency_id'	=> $kabupaten,
    					'name'			=> $name
    	 );

		$this->db->where('id', $kode);
		$this->db->update('kecamatan', $data);
		echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }

    function side_server_json_kelurahan()
    {
        $result = $this->wilayah_model->side_server_json_kelurahan();
    }

    public function select2_kecamatan()
    {
        $kec = $this->input->get('kecamatan');
        $query = $this->wilayah_model->kecamatan($kec,'name');
        echo json_encode($query);
    }

    public function simpan_kelurahan()
    {
    	$i = $this->input;
    	$kode_kelurahan	= $i->post('kode_kelurahan');
    	$district_id 	= $i->post('district_id');
    	$nama_kelurahan = $i->post('nama_kelurahan');
    	$data = array(
    		'id'			=> $kode_kelurahan,
    		'district_id'	=> $district_id,
    		'name' 			=> $nama_kelurahan
    		 );

    	$query = $this->db->query('SELECT * FROM kelurahan WHERE id="'.$kode_kelurahan.'" ');
    	if($query->num_rows()>0){
    		echo "<sapan class='btn btn-block btn-danger btn-lg'><b>Gagal!</b> Data <b>(".$kode_kelurahan.")</b> sudah terdaftar</span>";
    	}else{
    		$result = $this->db->insert('kelurahan',$data);
    		echo "<sapan class='btn btn-block btn-success btn-lg'><b>Sukses!</b> Data <b>(".$kode_kelurahan.")</b> berhasil di tambahkan</span>";
    	}
    }

    public function hapus_json_kelurahan()
    {
    	$id = $this->input->post('id');
    	foreach ($id as $id) {
    		$this->db->delete('kelurahan', array('id' => $id));
    	} 
    	echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";
    }

    public function update_json_kelurahan()
    {
    	$kode 		= $this->input->post('kode');
    	$kecamatan 	= $this->input->post('kecamatan');
    	$name 		= $this->input->post('name');

    	$data = array(	'id' 			=> $kode,
    					'district_id'	=> $kecamatan,
    					'name'			=> $name
    	 );

		$this->db->where('id', $kode);
		$this->db->update('kelurahan', $data);
		echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }

}

/* End of file Kabupaten.php */
/* Location: ./application/controllers/Kabupaten.php */