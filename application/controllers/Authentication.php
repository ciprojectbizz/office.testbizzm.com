<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller 
{

	public function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{
	    if($this->session->has_userdata('user')==false)
	    {
	        $this->load->view('authentication/login');
	    }
	    else
	    {
	        redirect('dashboard');
	    }
		
	}

	public function post_login()
	{
		if($_POST!=NULL)
		{
			if($this->session->has_userdata('user')==false)
			{
				$this->output->set_content_type('application/json');
				$this->form_validation->set_rules('username','username','trim|required');
				$this->form_validation->set_rules('password','password','trim|required');
				$this->form_validation->set_error_delimiters('<div class="text text-danger">', '</div>');
				if($this->form_validation->run()==true)
				{
					extract($_POST);
					$data=$this->security->xss_clean(['username'=>$username,'password'=>hash('sha512', $password),'user_status'=>'1']);
					$result=$this->Auth->login($data);
					if($result==false)
					{
						$this->output->set_output(json_encode(['result'=>2]));
						return false;
					}
					else
					{
						$userid = $result[0]['id'];
						$this->session->set_userdata('user',$userid);
						$this->output->set_output(json_encode(['result' => 1]));
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
		
	public function forgot_pass()
	{
		//$this->layout->view('authentication/forgot_pass');
		if($this->input->post('forgot_pass'))
		{
			$email=$this->input->post('email');
			$que=$this->db->query("select password,email from users where email='$email'");
			$row=$que->row();
			$user_email=$row->email;
			if((!strcmp($email, $user_email))){
			$password=$row->password;
				/*Mail Code*/
				$to = $user_email;
				$subject = "Password";
				$txt = "Your password is $password .";
				$headers = "From: twinkal.bizzmanweb@gmail.com" . "\r\n" .
				"CC: twinkakjais14@gmail.com";

				mail($to,$subject,$txt,$headers);
				}
			else{
			$data['error']="Invalid Email ID !";
			}
		
	}
	   $this->load->view('authentication/forgot_pass',@$data);	
   }     

	public function logout()
	{
		if($this->session->has_userdata('user'))
		{
			$this->session->sess_destroy('user');
			redirect('login');
		}
		else
		{
			redirect('dashboard');
		}
	}
}
