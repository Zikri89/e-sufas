<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends CI_Controller {

    public function index()
    {
        $data = array(
            'main_title'        =>  'Reset Password',
            'submain_title'     =>  'Halaman Reset Password E-Surfas',
        );

        $this->load->view('page/reset_password', $data, FALSE);
    }

	public function token()
	{
		$token = base64_decode($this->uri->segment(3));           
		$cleanToken = $this->security->xss_clean($token);  
		$user_info = $this->reset_password_model->isTokenValid($cleanToken);          
	 
		if(!$user_info){  
	 		$this->session->set_flashdata('sukses', '<p class="btn btn-danger btn-block" style="text-align:center;">Token tidak valid atau kadaluarsa</p>');  
	 		redirect(base_url('login'),'refresh');
		}

        $data = array(
            'main_title'    => 'Reset Password',
            'user_info'     => $user_info->username,
            'submain_title' => 'Halaman Reset Password');

        $this->load->view('page/reset_password', $data, FALSE);
	}

	public function update_pass(){
		$username 		= $this->input->post('username');
		$password_baru 	= sha1($this->input->post('newPassword'));
		$c_password_baru= sha1($this->input->post('confirmPassword'));
		if($password_baru == $c_password_baru){
			$data = array('password_baru' => $password_baru);
			$this->reset_password_model->updatePassword($username,$data);
			$notif = 1;
		}else{
			$notif = 2;
		}

		$arrayResetPass = array('notif' => $notif);
		echo json_encode($arrayResetPass);
	}

}

/* End of file Reset_password.php */
/* Location: ./application/controllers/Reset_password.php */