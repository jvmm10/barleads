<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Addons extends CI_Model
{
	private $table = "tblsupervisor";
	
	
	function lists()
	{
		$q = $this->db->query("select * from ".$this->table."");
		$result = $q->result();
		return $result;
	}
	
	function list_data($where,$table)
	{
		$q  = $this->db->query("select * from ".$table." ".$where." ");
		return $q;
	}
	
	function user_sort_limit($where, $sort , $limit,$table)
	{
		$q = $this->db->query("select * from ".$table." ".$where." ".$sort." ".$limit);
		return $q;
	}
	
	function submit($name,$table)
	{	
		switch($table)
		{
			case 'tblsupervisor':
			$data = array(
			'supervisor_name'=>$name
			);
			break;
			case 'tbllead':
			$data = array(
			'lead_name'=>$name
			);
			break;
			case 'tblbranch':
			$data = array(
			'branch_name'=>$name
			);
			break;
			case 'tblbank':
			$data = array(
			'bank_name'=>$name
			);
			break;
		}
	
	
	
		$q = $this->db->insert($table, $data);
		if($q)
		{
			return TRUE;
		}
		return FALSE;
	}
	
	function delete($id,$table)
	{
		$this->db->query("DELETE FROM ".$table." where id = '".$id."'");
		return TRUE;
	}
	
	function search($id,$table){
		$q= $this->db->where('id',$id)->from($table)->get();
		return $q->row();
	
	}
	
	
	function update($id,$name,$table)
	{
		switch($table)
		{
			case 'tblsupervisor':
			$q = $this->db->query("Update $table set supervisor_name = '".$name."' where id = '".$id."'");
			break;
			case 'tbllead':
			$q = $this->db->query("Update $table set lead_name = '".$name."' where id = '".$id."'");
			break;
			case 'tblbranch':
			$q = $this->db->query("Update $table set branch_name = '".$name."' where id = '".$id."'");
			break;
			case 'tblbank':
			$q = $this->db->query("Update $table set bank_name = '".$name."' where id = '".$id."'");
			break;
		}
		
		
		
		return TRUE;
	}
	
	function sup()
	{
		$string = "";
		$q = $this->db->query('select * from tblsupervisor');
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $index)
			{
					$string .= "<option value='".$index->supervisor_name."'>".$index->supervisor_name."</option>";
			}
		}
		
		return $string;
	}
	
	function lead()
	{
		$string = "";
		$q = $this->db->query('select * from tbllead');
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $index)
			{
					$string .= "<option value='".$index->lead_name."'>".$index->lead_name."</option>";
			}
		}
		
		return $string;
	}
	
	function branch()
	{
		$string = "";
		$q = $this->db->query('select * from tblbranch');
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $index)
			{
					$string .= "<option value='".$index->branch_name."'>".$index->branch_name."</option>";
			}
		}
		
		return $string;
	}
	
	function bank()
	{
		$string = "";
		$q = $this->db->query('select * from tblbank');
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $index)
			{
					$string .= "<option value='".$index->bank_name."'>".$index->bank_name."</option>";
			}
		}
		
		return $string;
	}
	
	function suparray()
	{
		$string = array();
		$q = $this->db->query('select * from tblsupervisor');
		$string[] = "SELECT";
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $index)
			{
					$string[$index->supervisor_name] = $index->supervisor_name;
			}
		}
		
		return $string;
	}
	
	function leadarray()
	{
		$string = array();
		$q = $this->db->query('select * from tbllead');
		$string[] = "SELECT";
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $index)
			{
					$string[$index->lead_name] = $index->lead_name;
			}
		}
		
		return $string;
	}
	
	function brancharray()
	{
		$string = array();
		$q = $this->db->query('select * from tblbranch');
		$string[] = "SELECT";
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $index)
			{
					$string[$index->branch_name] = $index->branch_name;
			}
		}
		
		return $string;
	}
	
	function bankarray()
	{
		$string = array();
		$q = $this->db->query('select * from tblbank');
		$string[] = "SELECT";
		if($q->num_rows() > 0)
		{
			foreach($q->result() as $index)
			{
					$string[$index->bank_name] = $index->bank_name;
			}
		}
		
		return $string;
	}
	
}