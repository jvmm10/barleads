<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

		function index()
		{
			
			$this->load->view('error');
		}
		
		
		function logout()
		{
				$newdata = array(
					'user_id'=>NULL,
					'role'=>NULL,
					'username'=>NULL,
					'logged'=>NULL,
				);
				$this->session->unset_userdata($newdata);
				redirect('/welcome/index/');
		}
}