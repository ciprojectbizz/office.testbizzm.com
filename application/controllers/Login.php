<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{
	    if($this->session->has_userdata('user')!=NULL)
	    {
	        if($this->session->userdata('role')!=1)
	        {
	            redirect('project');
	        }
	        else
	        {
	            redirect('user');
	        }
	        //echo "Dashboard";
	        
	    }
	    else
	    {
	        redirect('authentication');
	    }
		
	}
}