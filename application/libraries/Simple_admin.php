<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_admin {
	
	// SET SUPER GLOBAL
	var $CI = NULL;
	public function __construct() {
		$this->CI =& get_instance();
	}
	
	// Login
	public function login($username, $password) {
		// Query untuk pencocokan data
		$check_email = $this->is_email($username);
		if($check_email){
		    // Kombinasi email & password
		    $query = $this->CI->db->query("SELECT * FROM user WHERE email = '".$username."' AND password = '".sha1($password)."' OR email = '".$username."' AND password_baru= '".sha1($password)."' ");
		} else {
		    // Kombinasi username & password
		    $query = $this->CI->db->query("SELECT * FROM user WHERE username = '".$username."' AND password = '".sha1($password)."' OR username = '".$username."' AND password_baru= '".sha1($password)."' ");
		}

	    if($query->num_rows() > 0)
	    {
	        //successfull login
	     	$row 	= $this->CI->db->query('SELECT *,a.id as iduser FROM user a JOIN faskes b ON a.faskes_id = b.id WHERE username="'.$username.'" OR email="'.$username.'" ');
			$user 	= $row->row();
			
			$id_user 		= $user->iduser;
			$faskes			= $user->name;
			$username		= $user->username;
			$email			= $user->email;
			$role_id		= $user->role_id;
			$jns_faskes		= $user->jenis_faskes;
			$is_active 		= $user->is_active;
			// $_SESSION['username'] = $username;
			$this->CI->session->set_userdata('id_user', $id_user);
			$this->CI->session->set_userdata('faskes', $faskes);
			$this->CI->session->set_userdata('username', $username); 
			$this->CI->session->set_userdata('email', $email); 
			$this->CI->session->set_userdata('role_id', $role_id);
			$this->CI->session->set_userdata('jns_faskes', $jns_faskes);
			$this->CI->session->set_userdata('is_active', $is_active);

			// Kalau benar di redirect
			if($this->CI->session->userdata('role_id')==1){
				redirect(base_url('dasbor'));
			}else if($this->CI->session->userdata('role_id')==2){
				redirect(base_url('dasbor'));
			}else if($this->CI->session->userdata('role_id')==3){
				redirect(base_url('dasbor'));
			}else if($this->CI->session->userdata('role_id')==4){
				redirect(base_url('dasbor'));
			}
	    } else {
	        $this->CI->session->set_flashdata('sukses','<span class="btn btn-block btn-danger">Oopss.. Username/Password salah</span>');
			redirect(base_url('login'));
	    }

		return false;
	}
	
	public function is_email($user){
	    if(filter_var($user, FILTER_VALIDATE_EMAIL)) {
	        return true;
	    } else {
	        return false;
	    }
	}

	// Cek login
	public function cek_login() {
		if($this->CI->session->userdata('username') == '' && $this->CI->session->userdata('role_id')=='') {
			$this->CI->session->set_flashdata('sukses','<span class="btn btn-block btn-danger">Oopss.. Anda belum login</span>');
			redirect(base_url('login'));
		}	
	}

	// Cek login
	public function cek_login_admin() {
		if($this->CI->session->userdata('role_id')!=1) {
			$this->CI->session->set_flashdata('sukses','<p style="text-align:center;color:red;">Nampaknya anda sedang melakukan tindakan yang mencurigakan sistem, mohon untuk tidak melakukan hal - hal yang dapat merugikan pihak lain</p>');
			redirect(base_url('login'));
		}	
	}

	// Cek login
	public function cek_login_faskes() {
		if($this->CI->session->userdata('role_id')!=2 && $this->CI->session->userdata('role_id')!=1) {
			$this->CI->session->set_flashdata('sukses','Nampaknya anda sedang melakukan tindakan yang mencurigakan sistem, mohon untuk tidak melakukan hal - hal yang dapat merugikan pihak lain');
			redirect(base_url('login'));
		}	
	}

	// Cek login
	public function cek_login_sudinkes() {
		if($this->CI->session->userdata('role_id')!=3 && $this->CI->session->userdata('role_id')!=1) {
			$this->CI->session->set_flashdata('sukses','Nampaknya anda sedang melakukan tindakan yang mencurigakan sistem, mohon untuk tidak melakukan hal - hal yang dapat merugikan pihak lain');
			redirect(base_url('login'));
		}	
	}

	// Cek login
	public function cek_login_penyelia() {
		if($this->CI->session->userdata('role_id')!=4 && $this->CI->session->userdata('role_id')!=1) {
			$this->CI->session->set_flashdata('sukses','Nampaknya anda sedang melakukan tindakan yang mencurigakan sistem, mohon untuk tidak melakukan hal - hal yang dapat merugikan pihak lain');
			redirect(base_url('login'));
		}	
	}

	// Cek login
	public function cek_active() {
		if($this->CI->session->userdata('is_active')!=1) {
			$this->CI->session->set_flashdata('sukses','<p style="text-align:center;color:red;">Maaf akun anda tidak aktiv silahkan aktivasi akun anda dengan menghubungi administrator</p>');
			redirect(base_url('login'));
		}	
	}
	
	// Logout
	public function logout() {
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('role_id');
		$this->CI->session->unset_userdata('nama_faskes');
		$this->CI->session->unset_userdata('id_user');
		$this->CI->session->unset_userdata('assesment_faskes');
		$this->CI->session->unset_userdata('assesment_faskes2');
		$this->CI->session->set_flashdata('sukses','Terimakasih, Anda berhasil logout');
		redirect(base_url('login'));
	}
	
}