<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Document_Model extends CI_Model
{
    function insert($table,$data)
    {
        $this->db->insert($table,$data);
        //$this->db->set($data);
        return $this->db->insert_id();
       
    }
    function get_All_Images($userId)
    {
        $this->db->select('image.*,projects.name as project_name');
        $this->db->from('image');
        $this->db->join('projects','projects.id=image.project');
        $this->db->where('image.created_by',$userId);
        
        return $this->db->get()->result_array();
    }
    function storecaptureimage($data)
	{
		$insert = $this->db->insert('image',$data); 
		return true;
	}
	function createfolder($data)
	{
		$insert = $this->db->insert('file_assign',$data); 
		return true;
	}
   
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('docfile');
        $this->db->where('status','1');
        $this->db->order_by('created_at','desc');
        if(array_key_exists('id',$params) && !empty($params['id'])){
            $this->db->where('id',$params['id']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        //return fetched data
        return $result;
    }
    function inserts($data = array())
    {
        $insert = $this->db->insert_batch('docfile',$data); 
        return true;
    }
    /*function getDocImages($userId,$id)
    {
        $this->db->select('docfile.*');
        $this->db->join('file_assign','file_assign.id = docfile.file_assign_id');
        $this->db->where('docfile.created_by',$userId);
        $this->db->where('docfile.file_assign_id',$id);
        $this->db->from('docfile');
        return $this->db->get()->result_array();
    }*/
	function getDocImages($userId,$id)
    {
        $this->db->select('image.*');
        $this->db->join('file_assign','file_assign.id = image.folder_assign_id');
        $this->db->where('image.created_by',$userId);
        $this->db->where('image.folder_assign_id',$id);
        $this->db->from('image');
        return $this->db->get()->result_array();
    }
  	function getRowss($id = ''){ 
        $this->db->select('docfile.*'); 
        $this->db->from('docfile'); 
        if($id){ 
            $this->db->where('id',$id); 
            $query = $this->db->get(); 
            $result = $query->row_array(); 
        }else{ 
            $this->db->order_by('created_at','desc'); 
            $query = $this->db->get(); 
            $result = $query->result_array(); 
        } 
         
        return !empty($result)?$result:false; 
    } 
     
    /* 
     * Insert file data into the database 
     * @param array the data for inserting into the table 
     */ 
     /*function insertss($data = array()){ 
        $insert = $this->db->insert('docfile', $data); 
        return $insert?true:false; 
    } */
    function getImageData($imageId)
    {
        $this->db->select('image_name');
        $this->db->from('image');
        $this->db->where('id',$imageId);
        $query=$this->db->get();
        $row=$query->row_array();
        return $row['image_name'];
    }
	function getCompany_verticals()
	{
		$this->db->select('company_verticals.*');
		$this->db->from('company_verticals');
		return $this->db->get()->result_array();
	}
	function getSearchYeardata($year){

		$this->db->select("file_assign.*");
		$this->db->from("file_assign");
		$this->db->like('file_assign.folder_name', $year);
		return $this->db->get()->result_array();
	}
	function getSearchCompanydata($companyName,$folderid){

		$sql_company_image = "SELECT image.*, 
		projects.company,
		companies.company_name 
		FROM image 
		LEFT JOIN projects ON projects.id = image.project 
		LEFT JOIN companies ON companies.id = projects.company 
		WHERE image.folder_assign_id = '$folderid' AND companies.company_name LIKE '%$companyName%'  ORDER BY image.id asc"; 
		$company_imagequery = $this->db->query($sql_company_image); 
		return $result_company_image = $company_imagequery->result_array();	
		
	}
	function getSearchGroupNamedata($group_name,$folderid){

		$sql_company_image = "SELECT image.*, 
		projects.company,
		companies.company_name,
		companies.company_vertical
		FROM image 
		LEFT JOIN projects ON projects.id = image.project 
		LEFT JOIN companies ON companies.id = projects.company 
		WHERE image.folder_assign_id = '$folderid' AND companies.company_vertical LIKE '%$group_name%'  
		ORDER BY image.id asc"; 
		$company_imagequery = $this->db->query($sql_company_image); 
		return $result_company_image = $company_imagequery->result_array();	
		
	}
	function getSearchFromDatedata($from_date,$to_date,$folderid){

		$sql_company_image = "SELECT image.*, DATE_FORMAT(image.created_at, '%Y-%m-%d') Date FROM image WHERE image.folder_assign_id = 3 AND DATE_FORMAT(image.created_at, '%Y-%m-%d')>='$from_date' AND DATE_FORMAT(image.created_at, '%Y-%m-%d')<='$to_date'";
		
		$company_imagequery = $this->db->query($sql_company_image); 
		return $result_company_image = $company_imagequery->result_array();	
		
	}
	function addRegistrars_companies($data)
	{
		$insert = $this->db->insert('registrars_of_companies', $data);
		return true;
	}

    function registrars_companies_numrow(){
		$roc_query = $this->db->query('SELECT * FROM registrars_of_companies');  
		return $roc_query->num_rows();
	}
	
	function addForm_number($data)
	{
		$insert = $this->db->insert('roc_form_number', $data);
		return true;
	}

	/*function getSearchFileYeardata($year,$folderid){

		$sql_company_image = "SELECT image.*, 
		projects.company,
		companies.company_name 
		FROM image 
		LEFT JOIN projects ON projects.id = image.project 
		LEFT JOIN companies ON companies.id = projects.company 
		WHERE image.folder_assign_id = '$folderid' AND image.created_at LIKE '%$year%'  ORDER BY image.id asc"; 
		$company_imagequery = $this->db->query($sql_company_image); 
		return $result_company_image = $company_imagequery->result_array();	
		
	}*/
    function all_registrars_companies($id)
    {
        $this->db->select('registrars_of_companies.*,companies.company_name,users.name AS user_name,roc_form_number.form_number');
        $this->db->from('registrars_of_companies');
        $this->db->join('companies','companies.id = registrars_of_companies.company_name');
        $this->db->join('users','users.id = registrars_of_companies.created_by');
		$this->db->join('roc_form_number','roc_form_number.id = registrars_of_companies.form_number_id');
        $this->db->where('registrars_of_companies.folder_assign_id',$id);
        return $this->db->get()->result_array();
    }
	
	function getAllform_number()
	{
		$this->db->select('roc_form_number.*');
		$this->db->from('roc_form_number');
		return $this->db->get()->result_array();
	}
}
