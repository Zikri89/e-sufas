<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_penyelia_model extends CI_Model {
        public function side_server_json_penyelia()
        {
        	$this->datatables->select('p.id,faskes_id,p.name,f.id as idfas,f.name as namefas');
                $this->datatables->from('penyelia p');
                $this->datatables->join('faskes f','p.faskes_id=f.id');
                $this->db->order_by('id','desc');
                $this->datatables->add_column('tool', '<input type="checkbox" name="check_penyelia" id="check_penyelia" class="check_penyelia" value="$1">','id');
                $this->datatables->add_column('tool2', '<button type="button" class="btn btn-primary edit_record_user" data-toggle="modal" data-id = "$1" data-faskes_id="$2" data-name = "$3" data-idfas = "$4" data-namefas = "$5" data-target="#edit-modal-penyelia"><i class="fa fa-pencil"></i></button>','id,faskes_id,name,idfas,namefas');
                return print_r($this->datatables->generate());
        }

}

/* End of file Data_penyelia.php */
/* Location: ./application/models/Data_penyelia.php */