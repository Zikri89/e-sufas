<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah_model extends CI_Model {

	public function faskes($faskes,$column)
	{
		$this->db->select('*');
		$this->db->from('faskes');
		$this->db->like('name',$faskes);
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}

	public function provinsi($provinsi,$column)
	{
		$this->db->select('*');
		$this->db->from('provinsi');
		$this->db->like('name',$provinsi);
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}

	public function kabupaten($kab,$column)
	{
		$this->db->select('*');
		$this->db->from('kabupaten');
		$this->db->like('name',$kab);
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}

	public function side_server_json_kabupaten()
	{
		$this->datatables->select('k.id,province_id,k.name,p.id as idprov,p.name as nameprov');
        $this->datatables->from('kabupaten k');
        $this->datatables->join('provinsi p','k.province_id=p.id','left');
        $this->db->order_by('id','desc');
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_kabupaten" id="check_kabupaten" class="check_kabupaten" value="$1">','id');
        $this->datatables->add_column('tool2', '<button type="button" class="btn btn-primary edit_record_kabupaten" data-toggle="modal" data-id = "$1" data-province_id="$2" data-name="$3" data-idprov="$4" data-nameprov="$5" data-target="#edit-modal-kabupaten"><i class="fa fa-pencil"></i></button>','id,province_id,name,idprov,nameprov');
        return print_r($this->datatables->generate());
	}

	public function side_server_json_kecamatan()
	{
		$this->datatables->select('a.id,regency_id,a.name,b.id as idkab,b.name as namekab');
        $this->datatables->from('kecamatan a');
        $this->datatables->join('kabupaten b','a.regency_id=b.id','left');
        $this->db->order_by('id','desc');
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_kecamatan" id="check_kecamatan" class="check_kecamatan" value="$1">','id');
        $this->datatables->add_column('tool2', '<button type="button" class="btn btn-primary edit_record_kecamatan" data-toggle="modal" data-id = "$1" data-regency_id="$2" data-name="$3" data-idkab="$4" data-namekab="$5" data-target="#edit-modal-kecamatan"><i class="fa fa-pencil"></i></button>','id,regency_id,name,idkab,namekab');
        return print_r($this->datatables->generate());
	}

	public function side_server_json_kelurahan()
	{
		$this->datatables->select('a.id,district_id,a.name,b.id as idkec,b.name as namekec');
        $this->datatables->from('kelurahan a');
        $this->datatables->join('kecamatan b','a.district_id=b.id');
        $this->db->order_by('id','desc');
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_kelurahan" id="check_kelurahan" class="check_kelurahan" value="$1">','id');
        $this->datatables->add_column('tool2', '<button type="button" class="btn btn-primary edit_record_kelurahan" data-toggle="modal" data-id = "$1" data-district_id="$2" data-name="$3" data-idkec="$4" data-namekec="$5" data-target="#edit-modal-kelurahan"><i class="fa fa-pencil"></i></button>','id,district_id,name,idkec,namekec');
        return print_r($this->datatables->generate());
	}

	public function kecamatan($kec,$column)
	{
		$this->db->select('*');
		$this->db->from('kecamatan');
		$this->db->like('name',$kec);
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}

	public function kelurahan($kel,$column)
	{
		$this->db->select('*');
		$this->db->from('kelurahan');
		$this->db->like('name',$kel);
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}

}

/* End of file Wilayah_model.php */
/* Location: ./application/models/Wilayah_model.php */