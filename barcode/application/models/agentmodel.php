<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agentmodel extends CI_Model
{
	
	function  __construct()
	{
			parent::__construct();
	}
	
	
	function list_data($table,$where)
	{
		$q  = $this->db->query("select * from ".$table." ".$where." ");
		return $q;
	}
	
	function user_sort_limit($table,$where, $sort , $limit)
	{
		$q = $this->db->query("select * from ".$table." ".$where." ".$sort." ".$limit);
		return $q;
	}
	
	function checkbar($table,$barcode,$code)
	{
		$q = $this->db->query("SELECT * FROM ".$table." where CHCode='".$barcode."' and Agent= '".$code."' limit 1");
		if($q->num_rows() > 0 ){
			return $q->row();
		}
		return FALSE;
	}
	
	function insertstatus($data,$table)
	{
		$q = $this->db->insert($table,$data);
		if($q)
		{
				return TRUE;
		}
		return FALSE;
	}
	
}