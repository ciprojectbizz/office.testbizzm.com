<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{
		if($this->session->has_userdata('user')!=false)
		{
			$data['arr']=$this->Dashboard->getYears();
			$data['dashboard']=$this->Dashboard->getAllDashboard();
			$data['employers']=$this->Employer->getAllEmployers();
			$data['employees']=$this->Employee->getAllEmployees();
			/*$data['tasks']=$this->Task->getAllTasks();
			$data['subtasks']=$this->Dashboard->getAllSubTasks();
			//$data['subtasks']=$this->Dashboard->getAssignedSubTasks();
            $data['supertasks']=$this->Dashboard->getAllSuperSubTasks();*/
			$this->layout->view('dashboard/dashboard',$data);
		}
		else
		{
			redirect('dashboard');
		}
		
	}
	public function dashboard_detail(){
		extract($_POST);
		$data = array(
		'company' => $employer_name,
		'task'=>$task_name,
		'sub_task'=>$sub_task_name,
		'super_sub_task'=>$super_sub_task_name,
		'project_manager'=>$project_manager,
		'created_by'=> $this->session->userdata('user'),
		'status'	=> $this->session->userdata('user'),                                   
		'completion'=> $this->input->post('completion'),                  
		'timeby' => $this->input->post('timeby')); 

		//$insert = $this->Project->storecaptureimage($data); 
		$clean_data=$this->security->xss_clean($data);
		$result=$this->Dashboard->insert('dashboard',$clean_data);
		if($result==true)
		{
			redirect('dashboard');
			//return redirect('dashboard/dashboard');
		}
		else
		{
			$errorUploadType = 'Some problem occurred, please try again.';
		}	

}
public function year_wise($year){
	//$data['employers']=$this->Employer->getAllEmployers();
	$data['array']=$this->Dashboard->getYear();
	$data['arr']=$this->Dashboard->getYears();
	$this->layout->view('dashboard/year-data',$data);
}

}
