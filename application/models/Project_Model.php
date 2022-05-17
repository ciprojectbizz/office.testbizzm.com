<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Project_Model extends CI_Model
{
	function getAllProjects()
	{
		$this->db->select('projects.*, u1.name as employee_name, u2.name as project_manager_name, companies.company_name');
		$this->db->from('projects');
		$this->db->join('users u1', 'u1.id=projects.created_by');
		$this->db->join('users u2', 'u2.id=projects.project_manager');
		$this->db->join('companies', 'companies.id=projects.company');
		return $this->db->get()->result_array();
	}
	function getAllPendingProjects()
	{
		$this->db->select('projects.*, u1.name as employee_name, u2.name as project_manager_name, companies.company_name');
		$this->db->from('projects');
		$this->db->join('users u1', 'u1.id=projects.created_by');
		$this->db->join('users u2', 'u2.id=projects.project_manager');
		$this->db->join('companies', 'companies.id=projects.company');
		$this->db->where('projects.status', '2');
		return $this->db->get()->result_array();
	}
	function getAllCompletedProjects()
	{
		$this->db->select('projects.*, u1.name as employee_name, u2.name as project_manager_name, companies.company_name');
		$this->db->from('projects');
		$this->db->join('users u1', 'u1.id=projects.created_by');
		$this->db->join('users u2', 'u2.id=projects.project_manager');
		$this->db->join('companies', 'companies.id=projects.company');
		$this->db->where('projects.status', '1');
		return $this->db->get()->result_array();
	}
	function project_id()
	{
		$this->db->select('work_id');
		$this->db->from('projects');
		$this->db->order_by('work_id','DESC');
		$this->db->limit(1);
		$query=$this->db->get();
		if($query->num_rows()==0)
		{
			return "000";
		}
		else
		{
			$row=$query->row_array();
			return $row['work_id'];
		}
	}
	function getAllEditProjects($id){
		$this->db->select('projects.*');
		$this->db->from('projects');
		$this->db->where('projects.id', $id);
		return $this->db->get()->result_array();
	}
	function insert($table, $data)
	{
		$this->db->insert($table, $data);
		//$this->db->set($data);
		return true;
		//$this->db->insert_id();
	}

	function getAssignedTasks($project_id)
	{
		$this->db->select('task_assign.*,u1.name as assign_to_name,u2.name as created_by_name, tasks.name as task_name,');
		$this->db->from('task_assign');
		$this->db->join('users u1', 'u1.id=task_assign.assign_to', 'left');
		$this->db->join('users u2', 'u2.id=task_assign.created_by', 'left');
		$this->db->join('tasks', 'tasks.id=task_assign.task', 'left');
		$this->db->where('project', $project_id);
		return $this->db->get()->result_array();
	}

	function getAssignedSubTasks($taskId, $project_id)
	{
		$this->db->select('sub_task_assign.*,u1.name as assign_to_name,u2.name as created_by_name,sub-tasks.name as sub_task_name');
		$this->db->from('sub_task_assign');
		$this->db->join('users u1', 'u1.id=sub_task_assign.assign_to', 'left');
		$this->db->join('users u2', 'u2.id=sub_task_assign.created_by', 'left');
		$this->db->join('sub-tasks', 'sub-tasks.id=sub_task_assign.sub_task', 'left');
		$this->db->where('project', $project_id);
		$this->db->where('sub-tasks.task', $taskId);
		return $this->db->get()->result_array();
	}

	function getAssignedSuperSubTasks($subTaskId, $project_id)
	{
		$this->db->select('super_sub_task_assign.*,u1.name as assign_to_name,u2.name as created_by_name,super-sub-task.name as super_sub_task_name,super-sub-task.id as super_sub_task_id ');
		$this->db->from('super_sub_task_assign');
		$this->db->join('users u1', 'u1.id=super_sub_task_assign.assign_to', 'left');
		$this->db->join('users u2', 'u2.id=super_sub_task_assign.created_by', 'left');
		$this->db->join('super-sub-task', 'super-sub-task.id=super_sub_task_assign.super_sub_task', 'left');
		$this->db->where('project', $project_id);
		$this->db->where('super-sub-task.sub_task', $subTaskId);
		return $this->db->get()->result_array();
	}
	function getAllImages($project_id, $sub_task_Id, $super_sub_task_id, $userId)
	{
		$this->db->select('image.*,projects.project_name as project_name,c1.contact_person as user_name,t1.name as task_name,sub-tasks.name as sub_task_name,super-sub-task.name as super_sub_task_name');
		$this->db->from('image');
		$this->db->join('projects', 'projects.id=image.project', 'left');
		$this->db->join('companies c1', 'c1.company_vertical=projects.id', 'left');
		$this->db->join('tasks t1', 't1.id=projects.id', 'left');
		$this->db->join('sub-tasks', 'sub-tasks.id=t1.id', 'left');
		$this->db->join('super-sub-task', 'super-sub-task.id=sub-tasks.id', 'left');
		$this->db->where('image.created_by', $userId);
		$this->db->where('image.project', $project_id);
		$this->db->where('image.sub_task_id', $sub_task_Id);
		$this->db->where('image.super_sub_task_id', $super_sub_task_id);
		return $this->db->get()->result_array();
	}
	function get_All_Images($project_id, $sub_task_Id, $super_sub_task_id, $userId)
	{
		$this->db->select('image.*');
		$this->db->from('image');
		$this->db->where('image.created_by', $userId);
		$this->db->where('image.project', $project_id);
		$this->db->where('image.sub_task_id', $sub_task_Id);
		$this->db->where('image.super_sub_task_id', $super_sub_task_id);
		return $this->db->get()->result_array();
	}
	function storecaptureimage($data)
	{
		$insert = $this->db->insert('image', $data);
		return true;
	}
	function createfolder($data)
	{
		$insert = $this->db->insert('file_assign', $data);
		return true;
	}
	function getData()
	{
		$this->db->select('file_assign.*');
		$this->db->from('file_assign');
		return $this->db->get()->result_array();
	}
	
	function getRows($params = array())
	{
		$this->db->select('*');
		$this->db->from('image');
		$this->db->where('status', '1');
		$this->db->order_by('created_at', 'desc');
		if (array_key_exists('id', $params) && !empty($params['id'])) {
			$this->db->where('id', $params['id']);
			//get records
			$query = $this->db->get();
			$result = ($query->num_rows() > 0) ? $query->row_array() : FALSE;
		} else {
			//set start and limit
			if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
				$this->db->limit($params['limit'], $params['start']);
			} elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
				$this->db->limit($params['limit']);
			}
			//get records
			$query = $this->db->get();
			$result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
		}
		//return fetched data
		return $result;
	}
	function inserts($data = array())
	{
		$insert = $this->db->insert_batch('image', $data);
		return true;
	}

	function check_project_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('projects');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function check_sub_task_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('sub-tasks');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function check_super_sub_task_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('super-sub-task');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	function getImageData($imageId)
	{
		$this->db->select('image_name');
		$this->db->from('image');
		$this->db->where('id', $imageId);
		$query = $this->db->get();
		$row = $query->row_array();
		return $row['image_name'];
	}
	
}
