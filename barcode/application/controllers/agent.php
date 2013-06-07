<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$data['css'] =  $this->globals->css();
		$data['javascript'] = $this->globals->javascript();
		$data['title'] = 'SP Madrid - Agent Leads';
		$this->load->view('header',$data);	
			$this->load->view('agentleads',$data);
		$this->load->view('footer');
	}
	
	function leads()
	{
		$bank = $this->input->get('bnk');
		$code = $this->session->userdata('code');
		$tbl = array(
			'bpi'=>'tblbpi'
		);
		switch($bank)
		{
			case 'BPI':
				$rows = array();
				$page =  $this->input->post('page');
				$rp = 	$this->input->post('rp');
				$sortname = ($this->input->post('sortname') == 'undefined') ? 'id' : addslashes($this->input->post('sortname'));
				$sortorder = ($this->input->post('sortorder') == 'undefined') ? 'desc' : addslashes($this->input->post('sortorder'));
				$rp = ($this->input->post('rp') == 'undefined') ? 10 : addslashes($this->input->post('rp'));
				$sort = "ORDER BY $sortname $sortorder";
				
				if (!$page) $page = 1;
				
				$start = (($page-1) * $rp);
				$limit = "LIMIT $start, $rp";
				
				$query = addslashes($this->input->post('query'));
				$qtype = $this->input->post('qtype');
				$where = "";
				$where .= " WHERE Agent = '".$code."' ";
				if ($query) {
					$qtype = explode('||', $qtype);
					$flag = 0;
					
					foreach ($qtype as $value) {
							if ($flag == 1) {
								$where .= " OR $value LIKE '%$query%' ";
							} else {
									$where .= " OR $value LIKE '%$query%' ";
									$flag = 1;
							}
						}
					}
					$sql  = $this->agentmodel->list_data($tbl['bpi'],$where);
					$resultarray = array();
					if($sql){
							if($sql->num_rows() > 0){
								foreach($sql->result() as $ro){
									$resultarray[] = $ro;
								}	
							}
					}
					
				$total = count($resultarray);
				$data['page'] = $page;
				$data['total'] = $total; 
				
				
				  $query = $this->agentmodel->user_sort_limit($tbl['bpi'],$where, $sort,$limit);
				  if($query){
							if($query->num_rows() > 0){
									foreach($query->result() as $dis){
									$rows[] = array (
									"id" => $dis->ID,
									"cell" => array(
									'<input class="select_checkbox" id="check_slt" name="checkboxname" type="checkbox" value="'.$dis->ID.'" />'
									,$dis->ID
									,$dis->CHCode
									,$dis->CHName
									,$dis->Placement
									)
									);
									}
							}
					}
		
				$data['rows'] = $rows;
				$data['params'] = $_POST;
				echo json_encode($data); 
			break;
			
			default:
			break;
		}
			
	}
	
}