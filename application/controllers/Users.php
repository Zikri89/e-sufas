<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->simple_admin->cek_login();
        $this->simple_admin->cek_active();
        $this->simple_admin->cek_login_admin();
    }

    public function index()
    {
        $user_role = $this->user_model->user_role();
        $user_role2 = $this->user_model->user_role();
        $jenis_faskes = $this->user_model->jenis_faskes();
        $jenis_faskes2 = $this->user_model->jenis_faskes();
        $data = array(
            'main_title'    =>  'Users',
            'submain_title' =>  'Entry data dasar faskes',
            'chiltitle'     =>  'Daftar Nama Nama Penyelia Faskes',
            'user_role'     =>  $user_role,
            'user_role2'    => $user_role2,
            'jenis_faskes'  =>  $jenis_faskes,
            'jenis_faskes2' =>  $jenis_faskes2,
            'konten'        =>  'page/users'
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

    public function simpan_data_user()
    {
        $i = $this->input;
        $username   = strtolower(str_replace(' ', '_', $this->security->xss_clean($i->post('username'))));
        $password   = sha1($i->post('password'));
        $jns_faskes = $this->security->xss_clean($i->post('jns_faskes'));
        $faskes     = $this->security->xss_clean($i->post('faskes'));
        $alamat     = $this->security->xss_clean($i->post('alamat'));
        $kabupaten  = $this->security->xss_clean($i->post('kabupaten'));
        $kecamatan  = $this->security->xss_clean($i->post('kecamatan'));
        $kelurahan  = $this->security->xss_clean($i->post('kelurahan'));
        $level      = $this->security->xss_clean($i->post('level'));

        $data = array(
            'username'      => $username,
            'password'      => $password,
            'jenis_faskes'  => $jns_faskes,
            'faskes_id'     => $faskes,
            'alamat'        => $alamat,
            'kabupaten'     => $kabupaten,
            'kecamatan'     => $kecamatan,
            'kelurahan'     => $kelurahan,
            'role_id'       => $level,
            'is_active'     => 1,
            'created_date'  => date('Y-m-d h:i:s'),
             );

        $query = $this->db->query('SELECT username FROM user WHERE username="'.$username.'" ');
        if($query->num_rows()>0){
            echo "<sapan class='btn btn-block btn-danger btn-lg'>Maaf username yang anda pilih sudah terdaftar</span>";
        }else{
            $result = $this->user_model->simpan_data_user($data);
            echo "<sapan class='btn btn-block btn-success btn-lg'><b>Sukses!</b> faskes <b>(".$faskes.")</b> berhasil di daftarkan selanjutnya silahkan hubungi administrator untuk aktivasi akun</span>";
        }
    }

    public function hapus_json_user()
    {
        $id = $this->input->post('id');
        foreach ($id as $id) {
            $this->db->delete('user', array('id' => $id));
        } 
        echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di hapus</span>";
    }

    public function update_json_user()
    {
        $i = $this->input;
        $id_user     = $i->post('id_user');
        //$username    = $i->post('username');
        $jns_faskes  = $i->post('jns_faskes');
        /*$alamat      = $i->post('alamat');
        $kabupaten   = $i->post('kabupaten');
        $kecamatan   = $i->post('kecamatan');
        $kelurahan   = $i->post('kelurahan');*/
        $level       = $i->post('level');
        $status      = $i->post('status');

        $data = array(
            //'username'      => $username,
            'jenis_faskes'  => $jns_faskes,
            /*'alamat'        => $alamat,
            'kabupaten'     => $kabupaten,
            'kecamatan'     => $kecamatan,
            'kelurahan'     => $kelurahan,*/
            'role_id'       => $level,
            'is_active'     => $status
        );

        $this->db->where('id', $id_user);
        $this->db->update('user', $data);
        echo "<sapan class='btn btn-block btn-primary btn-lg'><b>Sukses!</b> data berhasil di ubah</span>";
    }
}
        
    /* End of file  Users.php */
