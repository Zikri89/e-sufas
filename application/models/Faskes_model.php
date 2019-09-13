<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faskes_model extends CI_Model {

	public function side_server_json()
	{
		$this->datatables->select('a.id as faskes_id,regency_id,a.name as namefaskes,b.name as namekab,alamat');
        $this->datatables->from('faskes a');
        $this->datatables->join('kabupaten b','a.regency_id=b.id','left');
        $this->db->order_by('a.id','desc');
        $this->datatables->add_column('tool', '<input type="checkbox" name="check_faskes" id="check_faskes" class="check_faskes" value="$1">','faskes_id');
        $this->datatables->add_column('tool2', '<button type="button" class="btn btn-primary edit_record_faskes" data-toggle="modal" data-id = "$1" data-kab="$2" data-regency_id="$3" data-namefaskes="$4" data-alamat="$5" data-target="#edit-modal-faskes"><i class="fa fa-pencil"></i></button>','faskes_id,namekab,regency_id,namefaskes,alamat');
        return print_r($this->datatables->generate());
	}

}

/* End of file Faskes_model.php */
/* Location: ./application/models/Faskes_model.php */