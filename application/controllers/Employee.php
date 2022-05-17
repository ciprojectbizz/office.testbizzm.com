<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{

		if($this->session->has_userdata('user')!=false)
		{
			$data['employees']=$this->Employee->getAllEmployees();
			$this->layout->view('employee/employees',$data);
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function add_employee()
	{
		if($this->session->has_userdata('user')!=false)
		{
			$data['employees']=$this->Employee->getAllEmployees();
			$this->layout->view('employee/add-employee',$data);
		}
		else
		{
			redirect('dashboard');
		}		
	}

	public function post_add_employee()
	{
		if($_POST!=NULL)
		{
			if($this->session->has_userdata('user'))
			{
				$result=$this->__employee_form_validation();
				if($result==true) 
				{
					extract($_POST);
					$data=array('name'=>$name,
								'email'=>$email,
								'username'=>$username,
								'password'=>hash('sha512',$password),
								'user_status'=>'1',
								'created_by'=>$this->session->userdata('user'),
								'created_at'=>date('Y-m-d H:i:s'),
								'modified_at'=>date('Y-m-d H:i:s'),
								'reporting_manager'=>$reporting_manager);
					$clean_data=$this->security->xss_clean($data);
					$result=$this->Main->insert('users',$clean_data);
					if($result==true)
					{
						$this->output->set_output(json_encode(['result'=>1]));
						return false;
					}
					else
					{
						$this->output->set_output(json_encode(['result'=>2]));
						return false;
					}
				}
				else
				{
					$this->output->set_output(json_encode(['result'=>0]));
					return false;
				}
			}
			else
			{
				redirect('dashboard');
			}
		}
		else
		{
			redirect('dashboard');
		}
	}

	private function __employee_form_validation()
	{
		$this->output->set_content_type('application_json');
		$this->form_validation->set_rules('reporting_manager','reporting_manager','trim|required');
		$this->form_validation->set_rules('name','name','trim|required');
		$this->form_validation->set_rules('email','email','trim|required');
		$this->form_validation->set_rules('username','username','trim|required');
		$this->form_validation->set_rules('password','password','trim|required');
		$this->form_validation->set_error_delimiters('<div class="text text-danger">', '</div>');		
		if($this->form_validation->run()==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

   public function editEmployee()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $data['employeeId']=$this->uri->segment(3);
	            $this->layout->view('employee/employee-edit',$data);
	        }
	        else
	        {
	            redirect('dashboard');
	        }
	    }
	    else
	    {
	        redirect('dashboard');
	    }
	}
	
	public function post_edit_employee()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $employeeId=$this->uri->segment(3);
	            extract($_POST);
	            $data=array('name'=>$name,
	            	        'email'=>$email,
	                        'modified_at'=>date('Y-m-d H:i:s'));
	            $clean_data=$this->security->xss_clean($data);
                $result=$this->Main->update('id',$employeeId,$data,'users');
                if($result==true)
                {
                    redirect('employee');
                }
                else
                {
                    redirect('employee');
                }
	        }
	        else
	        {
	            redirect('dashboard');
	        }
	    }
	    else
	    {
	        redirect('dashboard');
	    }
	}
	public function deleteEmployee()
    {
        if($this->session->has_userdata('user')!=false)
        {
            $employeeId=$this->uri->segment(3);
            $result=$this->Main->delete('id',$employeeId,'users');
            if($result==true)
            {
                redirect('employee');
            }
            else
            {
                redirect('employee');
            }
        }
    }
}
