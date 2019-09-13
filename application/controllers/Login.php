<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $jenis_faskes = $this->user_model->jenis_faskes();
        $jenis_faskes2 = $this->user_model->jenis_faskes();
        //Validasi login
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        $this->form_validation->set_rules('username', 'username', 'trim|required',
                                array(  'required' => 'Username Harus di Isi'));

        $this->form_validation->set_rules('password', 'password', 'trim|required',
                                array(  'required' => 'Password Harus Di Isi'));

        if($this->form_validation->run()!=false){
            $this->simple_admin->login($username,$password,base_url('dasbor'), base_url('login'));
        }

        $data = array(
            'main_title'    =>  'Login',
            'jenis_faskes'  =>  $jenis_faskes,
            'jenis_faskes2' =>  $jenis_faskes2,
            'submain_title' =>  'Halaman Login E-Surfas'
        );

        $this->load->view('page/login', $data, FALSE);
    }

    public function reset_password(){
        $email     = $this->input->post('email');
        $clean     = $this->security->xss_clean($email);  
        $userInfo  = $this->reset_password_model->getUserInfoByEmail($clean);  

        $query = $this->db->query('SELECT * FROM user WHERE email="'.$clean.'" ');
        $row   = $query->row();

        if($query->num_rows()>0){
            //build token          
            $token      = $this->reset_password_model->insertToken($userInfo->id);       
            $qstring    = base64_encode($token);           
            $url        = base_url() . 'reset_password/token/' . $qstring;  
            $link       = '<a href="' . $url . '">' . $url . '</a>';   
            
            //config email
            $config = Array(
                'protocol'  => 'smtp',
                'smtp_host' => 'srv69.niagahoster.com',
                'smtp_port' => 587,//465,
                'smtp_user' => 'resetpass_sufas@dinkes-dki.com',
                'smtp_pass' => 'dinkesdkijakarta',
                'mailtype'  => 'html', 
                'charset'   => 'UTF-8'//iso-8859-1
            );

            $this->load->library('email',$config);
            $this->email->set_newline("\r\n");
            $this->email->from('resetpass_sufas@dinkes-dki.com');
            $this->email->to($clean);
            $this->email->subject('Reset Password Sufas');
            $this->email->message('<p>Dear <strong>'.$row->username.'</strong></p><br/>Untuk dapat mereset password anda, silahkan anda klik link dibawah ini<br/>'.$link."<br/><br/> <strong>Note :</strong> Link di atas aktif hingga ".date("d-m-Y",strtotime("+1 day")));
            $this->email->send();
            $notif = 1;
        }else{
            $notif = 2;
        }
        
        $arrayResetPass = array('notif' => $notif);
        echo json_encode($arrayResetPass);
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
        $email      = $this->security->xss_clean($i->post('email'));
        $password   = sha1($i->post('password'));
        $jns_faskes = $this->security->xss_clean($i->post('jns_faskes'));
        $faskes     = $this->security->xss_clean($i->post('faskes'));
        $alamat     = $this->security->xss_clean($i->post('alamat'));
        $kabupaten  = $this->security->xss_clean($i->post('kabupaten'));
        $kecamatan  = $this->security->xss_clean($i->post('kecamatan'));
        $kelurahan  = $this->security->xss_clean($i->post('kelurahan'));

        $data = array(
            'username'      => $username,
            'email'         => $email,
            'password'      => $password,
            'jenis_faskes'  => $jns_faskes,
            'faskes_id'     => $faskes,
            'alamat'        => $alamat,
            'kabupaten'     => $kabupaten,
            'kecamatan'     => $kecamatan,
            'kelurahan'     => $kelurahan,
            'role_id'       => 4,
            'is_active'     => 0,
            'created_date'  => date('Y-m-d h:i:s'),
             );

        $query = $this->db->query('SELECT username FROM user WHERE username="'.$username.'" OR email="'.$email.'" ');
        if($query->num_rows()>0){
            $notif = 2;
        }else{
            $result = $this->user_model->simpan_data_user($data);
            $notif =1;
        }

        $arrayLogin = array('notif' => $notif);
        echo json_encode($arrayLogin);
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */