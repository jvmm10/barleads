<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
			parent::__construct();
			$this->is_logged_in();
	}
	 
	public function index()
	{	
		$data['css'] =  $this->globals->login();
		$data['javascript'] = $this->globals->javascript();
		$data['error'] = '';
		$this->load->view('login/header',$data);
		$this->load->view('login/login' ,$data);
		$this->load->view('login/footer');
	}
	
	function login()
	{
		$data['css'] =  $this->globals->login();
		$data['javascript'] = $this->globals->javascript();
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Passwrod', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['error'] = 'Username or Password is not match.';
			$this->load->view('login/header',$data);
			$this->load->view('login/login',$data);
			$this->load->view('login/footer');
		}
		else
		{
			$valid = $this->tblAgent->validate_account();
			if($valid)
			{	
				$newdata = array(
					'user_id'=>$valid->ID,
					'role'=>$valid->AccessL,
					'username'=>$valid->AgentName,
					'bank'=>$valid->AgentBank,
					'code'=>$valid->AgentCode,
					'logged'=>TRUE,
				);
				$this->session->set_userdata($newdata);
				
				$pos = $this->session->userdata('role');
				if($pos == 'ADMIN')
				{
					redirect('/admin/index/');	
				}else if($pos == 'AGENT')
				{
					redirect('/agent/index/');
				}
				else if($pos == 'HEADADMIN')
				{
					redirect('/add/index/');
				}
				
				
			}else
			{

				
				$data['error'] = 'Username or Password is not match.';
				$this->load->view('login/header',$data);
				$this->load->view('login/login',$data);
				$this->load->view('login/footer');	
			}
		}
	}
	
	
	function is_logged_in()
	{
		if($this->session->userdata('logged'))
		{
			$pos = $this->session->userdata('role');
					if($pos == 'ADMIN')
					{
						redirect('/admin/index/');	
					}else if($pos == 'AGENT')
					{
						redirect('/agent/index/');
					}			
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */