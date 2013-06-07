<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ewb extends CI_Model
{
	
	private $table = 'tblewb';
	function list_data($where)
	{
		$q  = $this->db->query("select * from ".$this->table." ".$where." ");
		return $q;
	}
	
	function user_sort_limit($where, $sort , $limit)
	{
		$q = $this->db->query("select * from ".$this->table." ".$where." ".$sort." ".$limit);
		return $q;
	}
}