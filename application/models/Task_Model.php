
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Task_Model extends CI_Model
{
	function getAllTasks()
	{
		$this->db->select('tasks.*,users.name as employee_name');
		$this->db->from('tasks');
		$this->db->join('users','users.id=tasks.created_by');
		return $this->db->get()->result_array();
	}
	
	function getAllSubTasks($taskId)
	{
	    $this->db->select('sub-tasks.*,users.name as employee_name');
	    $this->db->from('sub-tasks');
	    $this->db->join('users','users.id=sub-tasks.created_by');
	    $this->db->where('sub-tasks.task',$taskId);
	    return $this->db->get()->result_array();
	}
	
	function getAllSuperSubTasks($subTaskId)
	{
	    $this->db->select('super-sub-task.*,users.name as employee_name');
	    $this->db->from('super-sub-task');
	    $this->db->join('users','users.id=super-sub-task.created_by');
	    $this->db->where('super-sub-task.sub_task',$subTaskId);
	    return $this->db->get()->result_array();
	}
}