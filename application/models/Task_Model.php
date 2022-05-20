
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Task_Model extends CI_Model
{
	function getAllTasks()
	{
		$this->db->select('tasks.*');
		$this->db->from('tasks');
		return $this->db->get()->result_array();
	}
	
	function getAllSubTasks($taskId)
	{
	    $this->db->select('sub_tasks.*');
	    $this->db->from('sub_tasks');
	    $this->db->where('sub_tasks.task_id',$taskId);
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
