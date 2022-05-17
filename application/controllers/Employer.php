<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->library('Csvimport');
	}

	public function index()
	{

		if($this->session->has_userdata('user')!=false)
		{
			$data['employers']=$this->Employer->getAllEmployers();
			$this->layout->view('employer/employers',$data);
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function add_employer()
	{
		$data['groups']=$this->Group->getAllGroups();
		$this->layout->view('employer/add-employer',$data);
	}

	public function post_add_employer()
	{
		if($_POST!=NULL)
		{
			if($this->session->has_userdata('user')!=false)
			{
				$result=$this->__form_validation();
				if($result==true)
				{
					$previous_employer_id=$this->Employer->employer_id();
					$employer_id="COMP".$this->Others->id($previous_employer_id);
					$password=$this->Others->password(8);
					//extract($_POST);
					extract($_POST);
					$data=array('company_id'=>$employer_id,
								'company_vertical'=>$group,
								'company_name'=>$company_name,
								'contact_person'=>$contact_person,
								'registered_office_address'=>$registered_office_address,
								'corporate_office_address'=>$corporate_office_address,
								'admin_office_address'=>$admin_office_address,
								'factory_address'=>$factory_address,
								'branch_address'=>$branch_address,
								'email'=>$email,
								'password'=>hash('sha512',$password),
								'website'=>$website,
								'office_number'=>$office_number,
								'mobile_number'=>$mobile_number,
								'work_of_client'=>$work_of_client,
								'status'=>1,
								'created_by'=>$this->session->userdata('user'),
								'created_at'=>date('Y-m-d H:i:s'),
								'modified_at'=>date('Y-m-d H:i:s'));

					$clean_data=$this->security->xss_clean($data);
					
					$body='Hi <br> 
					       Your Password is '.$password;
					
                    $mail_result=$this->Others->mail($contact_person,$email,$body,'Company Registration Details','erp@bizzmanweb.com','Office Management');
                    
                    if(true)
                    {
    					$result=$this->Main->insert('companies',$clean_data);
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

	private function __form_validation()
	{
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('group','group','required|trim');
		$this->form_validation->set_rules('company_name','company_name','required|trim');
		$this->form_validation->set_rules('contact_person','contact_person','required|trim');
		$this->form_validation->set_rules('registered_office_address','registered_office_address','required|trim');
		$this->form_validation->set_rules('email','email','required|trim');
		$this->form_validation->set_rules('website','website','required|trim');
		$this->form_validation->set_rules('office_number','office_number','required|trim');	
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
	public function editEmployer()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $data['employerId']=$this->uri->segment(3);
	            $this->layout->view('employer/employer-edit',$data);
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
	
	public function post_edit_employer()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $employerId=$this->uri->segment(3);
	            extract($_POST);
	            $data=array('contact_person'=>$contact,
	            	        'email'=>$email,
	                        'modified_at'=>date('Y-m-d H:i:s'));
	            $clean_data=$this->security->xss_clean($data);
                $result=$this->Main->update('id',$employerId,$data,'companies');
                if($result==true)
                {
                    redirect('employer');
                }
                else
                {
                    redirect('employer');
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
	public function deleteEmployer()
    {
        if($this->session->has_userdata('user')!=false)
        {
            $employerId=$this->uri->segment(3);
            $result=$this->Main->delete('id',$employerId,'companies');
            if($result==true)
            {
                redirect('employer');
            }
            else
            {
                redirect('employer');
            }
        }
    }
	public function import_csv() {
        
        //Check file is uploaded in tmp folder
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            //validate whether uploaded file is a csv file
            $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileArr = explode('.', $_FILES['file']['name']);
            $ext = end($fileArr);
            if (($ext == 'csv') && in_array($mime, $csvMimes)) {
                $file = $_FILES['file']['tmp_name'];
                $csvData = $this->csvimport->get_array($file);
                $headerArr = array("Company Id", "Group", "Company Name", "Contact Person","Registered Office Address","Corporate Office Address","Admin Office Address","Factory Address","Branch Address","Email","Password","Website","Office Number","Mobile Number","Work Of Client");
                if (!empty($csvData)) {
                    //Validate CSV headers
                    $csvHeaders = array_keys($csvData[0]);
                    $headerMatched = 1;
                    foreach ($headerArr as $header) {
                        if (!in_array(trim($header), $csvHeaders)) {
                            $headerMatched = 0;
                        }
                    }
                    if ($headerMatched == 0) {
                        $this->session->set_flashdata("error_msg", "CSV headers are not matched.");
                        redirect('employer');
                    } else {
                        foreach ($csvData as $row) {
                            $employee_data = array(
                                "company_id" => $row['Company Id'],
                                "company_vertical" => $row['Group'],
                                "company_name" => $row['Company Name'],
								"contact_person" => $row['Contact Person'],
                                "registered_office_address" => $row['Registered Office Address'],
                                "corporate_office_address" => $row['Corporate Office Address'],
								"admin_office_address" => $row['Admin Office Address'],
                                "factory_address" => $row['Factory Address'],
                                "branch_address" => $row['Branch Address'],
								"email" => $row['Email'],
                                "password" => $row['Password'],
                                "website" => $row['Website'],
								"office_number" => $row['Office Number'],
                                "mobile_number" => $row['Mobile Number'],
                                "work_of_client" => $row['Work Of Client'],
                                "created_by" => '1');
                            $table_name = "companies";
                            $this->Employer->save($table_name, $employee_data);
                        }
                        $this->session->set_flashdata("success_msg", "CSV File imported successfully.");
                        redirect('employer');
                    }
                }
            } else {
                $this->session->set_flashdata("error_msg", "Please select CSV file only.");
                redirect('employer');
            }
        } else {
            $this->session->set_flashdata("error_msg", "Please select a CSV file to upload.");
            redirect('employer');
        }
    }
}


