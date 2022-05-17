<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_Model extends CI_Model
{
	// function employee_id()
	// {
	// 	$this->db->select('company_id');
	// 	$this->db->from('companies');
	// 	$this->db->order_by('company_id','DESC');
	// 	$this->db->limit(1);
	// 	$query=$this->db->get();
	// 	if($query->num_rows()==0)
	// 	{
	// 		return "000";
	// 	}
	// 	else
	// 	{
	// 		$row=$query->row_array();
	// 		return $row['company_id'];
	// 	}
	// }


	function getAllEmployees()
	{
		$this->db->select('u1.*,u2.name as created_by_name,u3.name as reporting_manager_name');
		$this->db->from('users u1');
		$this->db->join('users u2','u2.id=u1.created_by');
		$this->db->join('users u3','u3.id=u1.reporting_manager','left');
		$this->db->where('u1.user_status','1');
		return $this->db->get()->result_array();
	}

}