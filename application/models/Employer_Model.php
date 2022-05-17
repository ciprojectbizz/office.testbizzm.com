<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_Model extends CI_Model
{
	function employer_id()
	{
		$this->db->select('company_id');
		$this->db->from('companies');
		$this->db->order_by('company_id','DESC');
		$this->db->limit(1);
		$query=$this->db->get();
		if($query->num_rows()==0)
		{
			return "000";
		}
		else
		{
			$row=$query->row_array();
			return $row['company_id'];
		}
	}

	function getAllEmployers()
	{
		$this->db->select('companies.*, users.name as employee_name');
		$this->db->from('companies');
		$this->db->join('users','users.id=companies.created_by');
		return $this->db->get()->result_array();
	}
	public function save($table_name, $data = array()) {
        $insert = $this->db->insert($table_name, $data);
        return $insert;
    }
}
