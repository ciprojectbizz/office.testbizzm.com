<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Model extends CI_Model
{
	function login($data)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($data);
		$query=$this->db->get();
		if($query->num_rows()==1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
}