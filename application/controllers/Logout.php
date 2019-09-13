<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		//Logout
		$this->simple_admin->logout();	
	}

}

/* End of file Logout.php */
/* Location: ./application/controllers/Dasbor_admin/Logout.php */