<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assesment_model extends CI_Model {

    public function faskes($faskes,$column){
        $this->db->select('*');
        $this->db->from('task a');
        $this->db->join('faskes b','a.faskes_id=b.id');
        $this->db->like($column,$faskes);
        if($this->session->userdata('role_id')!=1){
            $this->db->where('a.penyelia',$this->session->userdata('id_user'));
        }
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }

   	public function side_server_json_assesment($param)
	{
        $check = $this->check_side_server_json_assesment($param);

        $this->datatables->select('l.id,l.kode,l.name,m.id as idapm,m.kode as kodeapm,asuhan_persalinan,check_list,aktif,kode_faskes');
        $this->datatables->from('apn_list l');
        $this->datatables->join('apn_menu m','l.apn_menu_id=m.id','left');
        $this->datatables->join('apn_assesment n','l.id=n.apn_list_id','left');
        $this->datatables->group_by('l.id');
        $this->datatables->where('apn_menu_id',$param);
        if ($check > 0) {
            $this->datatables->where('kode_faskes', $this->session->userdata('assesment_faskes'));
        }
        $this->datatables->add_column('tool','<select name="nilai" id="nilai" class="form-control nilai"><option></option><option value="$1">Ya</option><option value="$2">Tidak</option><option></option></select>','Ya,Tidak,check_list');
        return print_r($this->datatables->generate());
	}

    public function check_side_server_json_assesment($param) {
        $this->db->select('l.id,l.kode,l.name,m.id as idapm,m.kode as kodeapm,asuhan_persalinan,check_list,aktif,kode_faskes');
        $this->db->from('apn_list l');
        $this->db->join('apn_menu m','l.apn_menu_id=m.id','left');
        $this->db->join('apn_assesment n','l.id=n.apn_list_id','left');
        $this->db->group_by('l.id');
        $this->db->where('apn_menu_id',$param);
        $this->db->where('kode_faskes', $this->session->userdata('assesment_faskes'));
        return $this->db->get()->num_rows();
    }

    public function side_server_json_assesment_kia($param)
    {
        $check = $this->check_side_server_json_assesment_kia($param);
        $this->datatables->select('l.id,l.kode,l.name,m.id as idkia,m.kode as kodekia,asuhan_persalinan,check_list,aktif,kode_faskes');
        $this->datatables->from('kia_list l');
        $this->datatables->join('kia_menu m','l.kia_menu_id=m.id','left');
        $this->datatables->join('kia_assesment n','l.id=n.kia_list_id','left');
        $this->datatables->group_by('l.id');
        $this->datatables->where('kia_menu_id',$param);
        if ($check > 0) {
            $this->datatables->where('kode_faskes', $this->session->userdata('assesment_faskes'));
        }
        $this->datatables->add_column('tool','<select name="nilai" id="nilai" class="form-control nilai"><option></option><option value="$1">Ya</option><option value="$2">Tidak</option><option></option></select>','Ya,Tidak,check_list');
        return print_r($this->datatables->generate());
    }

    public function check_side_server_json_assesment_kia($param) {
        $this->db->select('l.id,l.kode,l.name,m.id as idkia,m.kode as kodekia,asuhan_persalinan,check_list,aktif,kode_faskes');
        $this->db->from('kia_list l');
        $this->db->join('kia_menu m','l.kia_menu_id=m.id','left');
        $this->db->join('kia_assesment n','l.id=n.kia_list_id','left');
        $this->db->group_by('l.id');
        $this->db->where('kia_menu_id',$param);
        $this->db->where('kode_faskes', $this->session->userdata('assesment_faskes'));
        return $this->db->get()->num_rows();
    }

    public function side_server_json_hasil_assesment($semester,$faskes,$converttgl1,$converttgl2)
    {
        $this->datatables->select('s.id,semester,a.name as nameapn,a.kode,f.name as namefaskes,check_list,username,asuhan_persalinan,kode_faskes,create_at');
        $this->datatables->from('apn_assesment s');
        $this->datatables->join('apn_list a','s.apn_list_id=a.id');
        $this->datatables->join('faskes f','s.kode_faskes=f.id');
        $this->datatables->join('user u','s.penyelia=u.id');
        $this->datatables->join('apn_menu m','a.apn_menu_id=m.id');
        $this->datatables->where('semester',$semester);
        $this->datatables->where('kode_faskes',$faskes);
        $this->datatables->where('create_at >=',$converttgl1);
        $this->datatables->where('create_at <=',$converttgl2);
        $this->datatables->add_column('tool','$1','check_list');
        $this->datatables->add_column('tool2','$1','username');
        $this->datatables->add_column('tool3','$1','asuhan_persalinan');
        $this->datatables->add_column('tool4','$1','kode_faskes');
        $this->datatables->add_column('tool5','$1','create_at');
        return print_r($this->datatables->generate());
    }

    public function side_server_json_hasil_assesment_kia($semester,$faskes,$converttgl1,$converttgl2)
    {
        $this->datatables->select('s.id,semester,a.name as namekia,a.kode,f.name as namefaskes,check_list,username,asuhan_persalinan,kode_faskes,create_at');
        $this->datatables->from('kia_assesment s');
        $this->datatables->join('kia_list a','s.kia_list_id=a.id');
        $this->datatables->join('faskes f','s.kode_faskes=f.id');
        $this->datatables->join('user u','s.penyelia=u.id');
        $this->datatables->join('kia_menu m','a.kia_menu_id=m.id');
        $this->datatables->where('semester',$semester);
        $this->datatables->where('kode_faskes',$faskes);
        $this->datatables->where('create_at >=',$converttgl1);
        $this->datatables->where('create_at <=',$converttgl2);
        $this->datatables->add_column('tool','$1','check_list');
        $this->datatables->add_column('tool2','$1','username');
        $this->datatables->add_column('tool3','$1','asuhan_persalinan');
        $this->datatables->add_column('tool4','$1','kode_faskes');
        $this->datatables->add_column('tool5','$1','create_at');
        return print_r($this->datatables->generate());
    }    
}

/* End of file Assesment_model.php */
/* Location: ./application/models/Assesment_model.php */