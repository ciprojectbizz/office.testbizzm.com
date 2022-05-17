<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{
		if($this->session->has_userdata('user')!=false)
		{
			$data['groups']=$this->Group->getAllGroups();
			$this->layout->view('group/groups',$data);
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function add_group()
	{
		if($this->session->has_userdata('user')!=false)
		{
			$this->layout->view('group/add-group');
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function post_add_group()
	{
		if($_POST!=NULL)
		{
			if($this->session->has_userdata('user')!=false)
			{
				$result=$this->__form_validation();
				if($result==true)
				{
					extract($_POST);
					$data=array('name'=>$group,
								'created_by'=>$this->session->userdata('user'),
								'created_at'=>date('Y-m-d H:i:s'),
								'modified_at'=>date('Y-m-d H:i:s'));
					$clean_data=$this->security->xss_clean($data);
					$result=$this->Main->insert('company_verticals',$clean_data);
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

	private function __form_validation()
	{
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('group','group','required|trim');
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
	public function editGroup()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $data['groupId']=$this->uri->segment(3);
	            $this->layout->view('group/group-edit',$data);
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
	
	public function post_edit_group()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $groupId=$this->uri->segment(3);
	            extract($_POST);
	            $data=array('name'=>$groups,
	                        'modified_at'=>date('Y-m-d H:i:s'));
	            $clean_data=$this->security->xss_clean($data);
                $result=$this->Main->update('id',$groupId,$data,'company_verticals');
                if($result==true)
                {
                    redirect('group');
                }
                else
                {
                    redirect('group');
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
	 public function deleteGroup()
    {
        if($this->session->has_userdata('user')!=false)
        {
            $groupId=$this->uri->segment(3);
            $result=$this->Main->delete('id',$groupId,'company_verticals');
            if($result==true)
            {
                redirect('group');
            }
            else
            {
                redirect('group');
            }
        }
    }
}