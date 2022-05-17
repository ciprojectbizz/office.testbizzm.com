<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model
{
	function getAllDashboard()
	{
		$this->db->select('dashboard.*, u1.name as employee_name, u2.name as project_manager_name, companies.company_name');
		$this->db->from('dashboard');
		$this->db->join('users u1','u1.id=dashboard.created_by');
		$this->db->join('users u2','u2.id=dashboard.project_manager');
		$this->db->join('companies','companies.id=dashboard.company');
		return $this->db->get()->result_array();
	}
	function insert($table,$data)
	{
	    $this->db->insert($table,$data);
	    //$this->db->set($data);
	    return $this->db->insert_id();
	   
	}

	function getAllSubTasks()
	{
	    $this->db->select('sub-tasks.*,users.name as employee_name');
	    $this->db->from('sub-tasks');
	    $this->db->join('users','users.id=sub-tasks.created_by');
	    //$this->db->where('sub-tasks.task',$taskId);
	    return $this->db->get()->result_array();
	}
	

	function getAllSuperSubTasks()
	{
	    $this->db->select('super-sub-task.*,users.name as employee_name');
	    $this->db->from('super-sub-task');
	    $this->db->join('users','users.id=super-sub-task.created_by');
	  
	    return $this->db->get()->result_array();	    
	}
	function getYears(){
		$this->db->select('created_at as year');
		$this->db->distinct();
		$this->db->from('companies');
		$this->db->order_by('created_at','ASC');
		$query=$this->db->get();
		return $query->result();
	}
	function getYear($year){
		$this->db->select('companies.*');
		$this->db->from('companies');
		$this->db->where('created_at',$year);
		$query=$this->db->get();
		return $query->result();
	}
	
}	
