<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends CI_Controller {
	
	function __construct()
	{
			parent::__construct();
			$this->globals->is_admin($this->session->userdata('logged'),$this->session->userdata('user_id'),$this->session->userdata('role'));		
	}	
	 
	function index()
	{
		$data['css'] =  $this->globals->css();
		$data['javascript'] = $this->globals->javascript();
		$data['title'] = 'SP Madrid - Add Ons';
		$this->load->view('header',$data);	
			$this->load->view('addon_index',$data);
		$this->load->view('footer');	
	}
	
	function supervisor()
	{
			$this->load->view('supervisor');		
	}
	
	function suplist()
	{
		$table = $this->input->get('table');	
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
			$sql  = $this->addons->list_data($where,$table);
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
		
		
		  $query = $this->addons->user_sort_limit($where, $sort,$limit,$table);
		  if($query){
					if($query->num_rows() > 0){
							foreach($query->result() as $dis){
switch($table)
		{
			case 'tblsupervisor':
			$rows[] = array ("id" => $dis->id,"cell" => array(
	'<input class="select_checkbox" id="check_slt" name="checkboxname" type="checkbox" value="'.$dis->id.'" />'
	,$dis->id,$dis->supervisor_name));
			break;
			case 'tbllead':
			$rows[] = array ("id" => $dis->id,"cell" => array(
	'<input class="select_checkbox" id="check_slt" name="checkboxname" type="checkbox" value="'.$dis->id.'" />'
	,$dis->id,$dis->lead_name));
			break;
			case 'tblbranch':
		$rows[] = array ("id" => $dis->id,"cell" => array(
	'<input class="select_checkbox" id="check_slt" name="checkboxname" type="checkbox" value="'.$dis->id.'" />'
	,$dis->id,$dis->branch_name));	
			break;
			case 'tblbank':
		$rows[] = array ("id" => $dis->id,"cell" => array(
	'<input class="select_checkbox" id="check_slt" name="checkboxname" type="checkbox" value="'.$dis->id.'" />'
	,$dis->id,$dis->bank_name));	
			break;
		}								
								
								
								
								
		
							}
					}
			}

		$data['rows'] = $rows;
		$data['params'] = $_POST;
		echo json_encode($data);
	}
	
	function tlead()
	{
		$this->load->view('lead');	
	}
	
	function branch()
	{
		$this->load->view('branch');	
	}
	
	function bank()
	{
		$this->load->view('bank');	
	}
	
	
	function addnamic($cur)
	{
		switch($cur)
		{
			case 'tblsupervisor':
			$data['header'] = 'Add Supervisor';
			$data['table'] = 'tblsupervisor';
			break;
			case 'tbllead':
			$data['header'] = 'Add Team Lead';
			$data['table'] = 'tbllead';
			break;
			case 'tblbranch':
			$data['header'] = 'Add Branch';
			$data['table'] = 'tblbranch';
			break;
			case 'tblbank':
			$data['header'] = 'Add Bank';
			$data['table'] = 'tblbank';
			break;
		}

		$this->load->view('addons_add',$data);
	}
	
	function save()
	{
		$name = $this->input->post('name');
		$table = $this->input->post('hidden');
		$response = array();
		if($this->addons->submit($name,$table))
		{
			$response['status'] = TRUE;
		}else
		{
			$response['status'] = FALSE;
			$response['error'] = "Can not save this time";
		}
		
		
		echo json_encode($response);
		exit;
	}
	
	
	function deletenames()
	{
		foreach($this->input->post('del_lead') as $index)
		{
			$this->addons->delete($index,$this->input->post('table'));
		}
		echo "1";
		exit;
	}
	
	
	function edit()
	{
		$id =  $this->input->get('id');
		$table = $this->input->get('table');
		$data['result'] = $this->addons->search($id,$table);
		$data['header'] = "Update";
		$data['table'] = $table;
		
		$this->load->view('addons_edit',$data);
	}
	
	
	function update()
	{
		$name = $this->input->post('name');
		$id = $this->input->post('id');
		$table = $this->input->post('hidden');
		$response = array();
		if($this->addons->update($id,$name,$table))
		{
			$response['status'] = TRUE;
		}else
		{
			$response['status'] = FALSE;
			$response['error'] = "Can not update this time";
		}
		
		
		echo json_encode($response);
		exit;
	}
	
}