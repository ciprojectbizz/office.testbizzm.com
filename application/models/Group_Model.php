<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Group_Model extends CI_Model
{
	function getAllGroups()
	{
		$this->db->select('company_verticals.*,users.name as employee_name');
		$this->db->from('company_verticals');
		$this->db->join('users','users.id=company_verticals.created_by');
		return $this->db->get()->result_array();
	}
}