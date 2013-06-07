<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leads extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->globals->is_admin($this->session->userdata('logged'),$this->session->userdata('user_id'),$this->session->userdata('role'));	
	}
	
	function index()
	{
		$data['css'] =  $this->globals->css();
		$data['javascript'] = $this->globals->javascript();
		$data['title'] = 'SP Madrid - Leads';
		$this->load->view('header',$data);	
			$this->load->view('leads',$data);
		$this->load->view('footer');	
	}
	
	function bpi()
	{
		
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
		if ($query) {
			$qtype = explode('||', $qtype);
			$flag = 0;
			
			foreach ($qtype as $value) {
					if ($flag == 1) {
						$where .= " OR $value LIKE '%$query%' ";
					} else {
							$where .= " where $value LIKE '%$query%' ";
							$flag = 1;
					}
				}
			}
			$sql  = $this->bpi->list_data($where);
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
		
		
		  $query = $this->bpi->user_sort_limit($where, $sort,$limit);
		  if($query){
					if($query->num_rows() > 0){
							foreach($query->result() as $dis){
							$rows[] = array (
							"id" => $dis->ID,
							"cell" => array(
							'<input class="select_checkbox" id="check_slt" name="checkboxname" type="checkbox" value="'.$dis->ID.'" />'
							,$dis->ID
							,$dis->CHCode
							,$dis->Agent
							,$dis->CHName
							,$dis->Placement
							,$dis->OBCUTOFF
							)
							);
							}
					}
			}

		$data['rows'] = $rows;
		$data['params'] = $_POST;
		echo json_encode($data); 
	}
	
	function ewb()
	{
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
		if ($query) {
			$qtype = explode('||', $qtype);
			$flag = 0;
			
			foreach ($qtype as $value) {
					if ($flag == 1) {
						$where .= " OR $value LIKE '%$query%' ";
					} else {
							$where .= " where $value LIKE '%$query%' ";
							$flag = 1;
					}
				}
			}
			$sql  = $this->ewb->list_data($where);
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
		
		
		  $query = $this->ewb->user_sort_limit($where, $sort,$limit);
		  if($query){
					if($query->num_rows() > 0){
							foreach($query->result() as $dis){
							$rows[] = array (
							"id" => $dis->ID,
							"cell" => array(
							'<input class="select_checkbox" id="check_slt" name="checkboxname" type="checkbox" value="'.$dis->ID.'" />'
							,$dis->ID
							,$dis->CHCODE
							,$dis->AGENT
							,$dis->FULLNAME
						
							)
							);
							}
					}
			}

		$data['rows'] = $rows;
		$data['params'] = $_POST;
		echo json_encode($data); 
	}
	
	function fp()
	{
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
		if ($query) {
			$qtype = explode('||', $qtype);
			$flag = 0;
			
			foreach ($qtype as $value) {
					if ($flag == 1) {
						$where .= " OR $value LIKE '%$query%' ";
					} else {
							$where .= " where $value LIKE '%$query%' ";
							$flag = 1;
					}
				}
			}
			$sql  = $this->fp->list_data($where);
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
		
		
		  $query = $this->fp->user_sort_limit($where, $sort,$limit);
		  if($query){
					if($query->num_rows() > 0){
							foreach($query->result() as $dis){
							$rows[] = array (
							"id" => $dis->ID,
							"cell" => array(
							'<input class="select_checkbox" id="check_slt" name="checkboxname" type="checkbox" value="'.$dis->ID.'" />'
							,$dis->ID
							,$dis->CHCode
							,$dis->AgentNego
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
	}
}