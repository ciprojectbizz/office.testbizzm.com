<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{
		if($this->session->has_userdata('user')!=false)
		{
			//$userId=$this->session->userdata('user');
			//$data['userId']=$userId;
			$data['tasks']=$this->Task->getAllTasks();
			$this->layout->view('task/tasks',$data);
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function add_task()
	{
		if($this->session->has_userdata('user')!=false)
		{
			$this->layout->view('task/add-task');
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function post_add_task()
	{
		if($_POST!=NULL)
		{
			if($this->session->has_userdata('user')!=false)
			{
				$result=$this->__form_validation();
				if($result==true)
				{
					extract($_POST);
					$data=array('name'=>$task,
								'created_by'=>$this->session->userdata('user'),
								'created_at'=>date('Y-m-d H:i:s'),
								'modified_at'=>date('Y-m-d H:i:s'));
					$clean_data=$this->security->xss_clean($data);
					$result=$this->Main->insert('tasks',$clean_data);
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
		$this->form_validation->set_rules('task','task','required|trim');
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
	
	public function subTasks()
	{
	    if($this->session->has_userdata('user'))
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $taskId=$this->uri->segment(3);
	            $data['taskId']=$taskId;
                $data['subtasks']=$this->Task->getAllSubTasks($taskId);
	            $this->layout->view('task/subtask',$data);
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
	
	public function add_sub_task()
	{
	    if($this->session->has_userdata('user'))
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $taskId=$this->uri->segment(3);
	            $data['taskId']=$taskId;
	            $this->layout->view('task/add-sub-task',$data);
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
	
	public function post_add_sub_task()
	{
	    if($_POST!=NULL)
	    {
	        if($this->session->has_userdata('user')!=false)
	        {
	            $taskId=$this->input->post('task');
                if($this->input->post('subtask'))
                {
                    foreach($this->input->post('subtask') as $key=>$value)
                    {
                        $data=array('name'=>$value,
                                    'task'=>$taskId,
                                    'created_by'=>$this->session->userdata('user'),
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'modified_at'=>date('Y-m-d H:i:s'));
					$clean_data=$this->security->xss_clean($data);
					$this->Main->insert('sub-tasks',$clean_data);
                    }
                    redirect('task/subTasks/'.$taskId);
                }
                else
                {
                    redirect('task/subTasks/'.$taskId);
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
	
	public function superSubTasks()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $subTaskId=$this->uri->segment(3);
	            $data['subTaskId']=$subTaskId;
                $data['superSubtasks']=$this->Task->getAllSuperSubTasks($subTaskId);
	            $this->layout->view('task/super-subtask',$data);
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
	
	public function add_super_sub_task()
	{
	    if($this->session->has_userdata('user'))
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $subTaskId=$this->uri->segment(3);
	            $data['subTaskId']=$subTaskId;
	            $this->layout->view('task/add-super-sub-task',$data);
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
	
	public function post_add_super_sub_task()
	{
	    if($_POST!=NULL)
	    {
	        if($this->session->has_userdata('user')!=false)
	        {
	            $subTaskId=$this->input->post('subtask');
                if($this->input->post('supersubtask'))
                {
                    foreach($this->input->post('supersubtask') as $key=>$value)
                    {
                        $data=array('name'=>$value,
                                    'sub_task'=>$subTaskId,
                                    'created_by'=>$this->session->userdata('user'),
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'modified_at'=>date('Y-m-d H:i:s'));
					$clean_data=$this->security->xss_clean($data);
					$this->Main->insert('super-sub-task',$clean_data);
                    }
                    redirect('task/superSubTasks/'.$subTaskId);
                }
                else
                {
                    redirect('task/superSubTasks/'.$subTaskId);
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
	
	public function superSubTaskEdit()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(4)!="")
	        {
	            $data['superSubTaskId']=$this->uri->segment(3);
	            $data['subTaskId']=$this->uri->segment(4);
	            $this->layout->view('task/super-sub-task-edit',$data);
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
	
	public function post_edit_super_sub_task()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(4)!="")
	        {
	            $superSubTaskId=$this->uri->segment(3);
	            $subTaskId=$this->uri->segment(4);
	            extract($_POST);
	            $data=array('name'=>$super_sub_task,
	                        'modified_at'=>date('Y-m-d H:i:s'));
	            $clean_data=$this->security->xss_clean($data);
                $result=$this->Main->update('id',$superSubTaskId,$data,'super-sub-task');
                if($result==true)
                {
                    redirect('task/superSubTasks/'.$subTaskId);
                }
                else
                {
                    redirect('task/superSubTasks/'.$subTaskId);
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
	
	public function subTaskEdit()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(4)!="")
	        {
	            $data['subTaskId']=$this->uri->segment(3);
	            $data['taskId']=$this->uri->segment(4);
	            $this->layout->view('task/sub-task-edit',$data);
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
	
	public function post_edit_sub_task()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(4)!="")
	        {
	            $subTaskId=$this->uri->segment(3);
	            $taskId=$this->uri->segment(4);
	            extract($_POST);
	            $data=array('name'=>$sub_task,
	                        'modified_at'=>date('Y-m-d H:i:s'));
	            $clean_data=$this->security->xss_clean($data);
                $result=$this->Main->update('id',$subTaskId,$data,'sub-tasks');
                if($result==true)
                {
                    redirect('task/subTasks/'.$taskId);
                }
                else
                {
                    redirect('task/subTasks/'.$taskId);
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
	
	public function editTask()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $data['taskId']=$this->uri->segment(3);
	            $this->layout->view('task/task-edit',$data);
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
	
	public function post_edit_task()
	{
	    if($this->session->has_userdata('user')!=false)
	    {
	        if($this->uri->segment(3)!="")
	        {
	            $taskId=$this->uri->segment(3);
	            extract($_POST);
	            $data=array('name'=>$task,
	                        'modified_at'=>date('Y-m-d H:i:s'));
	            $clean_data=$this->security->xss_clean($data);
                $result=$this->Main->update('id',$taskId,$data,'tasks');
                if($result==true)
                {
                    redirect('task');
                }
                else
                {
                    redirect('task');
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
	
	public function getSubTask()
	{
	    $this->output->set_content_type('json');
	    $tasks = explode(",",$this->input->post('task_id'));
        $data=array();
        for($i=0;$i<sizeof($tasks);$i++)
        {
            $subTasks=$this->Task->getAllSubTasks($tasks[$i]);
            $data=array_merge($subTasks,$data);
        }
		if($data)
		{
			$this->output->set_output(json_encode(['result'=> 1, 'subtasks'=>$data, 'all'=>count($data)]));
		} else

		{
			$this->output->set_output(json_encode(['result'=> 0]));
		}
	   
	}
	
	public function getSuperSubTask()
	{
	    $this->output->set_content_type('json');
	    $subtasks = explode(",",$this->input->post('sub_task_id'));
        $data=array();
        for($i=0;$i<sizeof($subtasks);$i++)
        {
            $superSubTasks=$this->Task->getAllSuperSubTasks($subtasks[$i]);
            $data=array_merge($superSubTasks,$data);
        }
		if($data)
		{
			$this->output->set_output(json_encode(['result'=> 1, 'supersubtasks'=>$data, 'all'=>count($data)]));
		} else

		{
			$this->output->set_output(json_encode(['result'=> 0]));
		}
	   
	}
}

