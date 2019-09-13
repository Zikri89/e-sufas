<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faskes_assesment extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->simple_admin->cek_login();
        $this->simple_admin->cek_login_penyelia();
    }

    public function penilaian($param)
    {
        $data = array(
            'main_title'    =>  'Asuhan Persalinan',
            'submain_title' =>  'Penilaian',
            'chiltitle'     =>  'Faskes <strong>('.$this->session->userdata('assesment_faskes2').' )</strong>',
            'konten'        =>  'page/struktur_fisik'
        );

        $this->load->view('layout/mainpage', $data, FALSE);
    }

    function side_server_json_assesment($param)
    {
        $result = $this->assesment_model->side_server_json_assesment($param);
    }

    function side_server_json_hasil_assesment()
    {
        error_reporting(0);
        $semester       = $this->input->post('semester');
        $faskes         = $this->input->post('faskes');
        $reservation    = $this->input->post('reservation');
        //conver tanggal
        $pecah_tanggal  = explode('-', $reservation);
        $converttgl1    = date('Y-m-d',strtotime($pecah_tanggal[0]));
        $converttgl2    = date('Y-m-d',strtotime($pecah_tanggal[1]));
        //var_dump($converttgl1);
        $result = $this->assesment_model->side_server_json_hasil_assesment($semester,$faskes,$converttgl1,$converttgl2);
    }

    public function my_assesment() {
        error_reporting(0);
        $ids    = $this->input->post_get('ids');
        $char   = $this->input->post_get('char');
        $char2  = $this->input->post_get('char2');
        foreach ($ids as $id => $asses) {
            if (!empty($asses)) {
                $data = array(  'semester'      =>  $this->session->userdata('semester'),
                                'kode_faskes'   =>  $this->session->userdata('assesment_faskes'),
                                'apn_list_id'   =>  $id,
                                'check_list'    =>  $asses,
                                'nilai_aktual'  =>  $char2,
                                'nilai_harapan' =>  $char,
                                'create_at'     =>  date('Y-m-d'),
                                'aktif'         =>  'ya',
                                'penyelia'      =>  $this->session->userdata('id_user')
                                 );

            $this->db->insert('apn_assesment',$data);

            $count_apnlist      =  $this->db->count_all_results("apn_list")-23;//total item apn di kurangi 23 item tile apn 
            $count_apnassesment = $this->db->where('kode_faskes',$this->session->userdata('assesment_faskes'))->count_all_results("apn_assesment");
            $persen = ceil(($count_apnassesment/$count_apnlist) * 100);
            }
        }

        $query_task = $this->db->where('faskes_id',$this->session->userdata('assesment_faskes'))->get('task')->row();
        if($query_task->persen==0){
            $jml_persen = $persen;    
        }else{
            $jml_persen = $query_task->persen+$persen;
        }

        if($persen==100){
            $status = 2;
        }else{
            $status = 1;
        }

        $data = array('persen' =>$persen,'status' => $status);
        $this->db->where('faskes_id',$this->session->userdata('assesment_faskes'));
        $this->db->update('task',$data);

        echo "<sapan class='btn btn-block btn-info btn-lg'><b>Sukses!</b> Data assesment berhasil disimpan</span>";
    }

}

/* End of file Struktur_fisik.php */
/* Location: ./application/controllers/asuhan_persalinan/Struktur_fisik.php */