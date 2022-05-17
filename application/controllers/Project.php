<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('phpqrcode/qrlib');
		//$this->load->helper(array('form', 'url')); 
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->helper('download');
	}

	public function index()
	{
		//$this->load->view('project/super_sub_tasks', array('error' => ' ' )); 

		if ($this->session->has_userdata('user') != false) {
			$data['projects'] = $this->Project->getAllProjects();
			$data['PendingProjects'] = $this->Project->getAllPendingProjects();
			$data['CompletedProjects'] = $this->Project->getAllCompletedProjects();
			$data['file_assign'] = $this->Project->getData();
			$this->layout->view('project/projects', $data);
		} else {
			redirect('dashboard');
		}
	}

	public function add_project()
	{
		if ($this->session->has_userdata('user') != false) {
			$data['employers'] = $this->Employer->getAllEmployers();
			$data['employees'] = $this->Employee->getAllEmployees();
			$data['tasks'] = $this->Task->getAllTasks();
			$data['subtasks']=$this->Dashboard->getAllSubTasks();
            $data['supertasks']=$this->Dashboard->getAllSuperSubTasks();
			$this->layout->view('project/add-project', $data);
		} else {
			redirect('dashboard');
		}
	}

	public function post_add_project()
	{
		if ($_POST != NULL){
			$result = $this->__form_validation();
			$previous_project_id=$this->Project->project_id();
			$year = date("Y");
			$work_id="OFFM_".$year.'_'.$this->Others->id($previous_project_id);
			if($result == true){
				extract($_POST);
				$data = array(
					'work_id' => $work_id,
					'project_name' => $project_name,
					'company' => $employer_name,
					'project_manager' => $project_manager,
					'expected_delivery' => $expected_delivery,
					'created_by' => $this->session->userdata('user'),
					'created_at' => date('Y-m-d H:i:s'),
					//'modified_at' => date('Y-m-d H:i:s'),
					'completion_date' => $completion_date,
					'date_of_bill' => $date_of_bill,
					'problems_issues' => $problems_issues,
					'short_out_issues' => $short_out_issues,
					'priority'   => $priority
				);


				$clean_data = $this->security->xss_clean($data);

				$result = $this->Project->insert('projects', $clean_data);
				$insert_id = $this->db->insert_id();
				
					if($_FILES['Receiptsfiles']['name'] != '')
					{
		
						$_FILES['file']['name']       = $_FILES['Receiptsfiles']['name'];
						$_FILES['file']['type']       = $_FILES['Receiptsfiles']['type'];
						$_FILES['file']['tmp_name']   = $_FILES['Receiptsfiles']['tmp_name'];
						$_FILES['file']['error']      = $_FILES['Receiptsfiles']['error'];
						$_FILES['file']['size']       = $_FILES['Receiptsfiles']['size'];
		
						// File upload configuration
						$uploadPath = 'uploads/UploadReceipts/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
						$config['max_size'] = ""; // Can be set to particular file size , here it is 2 MB(2048 Kb)
						$config['max_height'] = "";
						$config['max_width'] = "";
		
						// Load and initialize upload library
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
		
						// Upload file to server
						if($this->upload->do_upload('file')){
							// Uploaded file data
							$imageData = $this->upload->data();
							$uploadImgData['Receiptsfiles'] = $imageData['file_name'];
						}
						$update2 =$this->Main->update('id',$insert_id, $uploadImgData,'projects');         
					} 
					else
					{
						$errorUploadType = 'Some problem occurred, please try again.';
					}  

					/*if ($result) {
						foreach ($_POST['task'] as $t) {
							$task_data = array(
								'task' => $t,
								'project' => $result,
								'created_by' => $this->session->userdata('user'),
								'created_at' => date('Y-m-d H:i:s'),
								'modified_at' => date('Y-m-d H:i:s')
							);

							$this->db->insert('task_assign', $task_data);
						}

						foreach ($_POST['sub_task'] as $st) {
							$sub_task_data = array(
								'sub_task' => $st,
								'project' => $result,
								'created_by' => $this->session->userdata('user'),
								'created_at' => date('Y-m-d H:i:s'),
								'modified_at' => date('Y-m-d H:i:s')
							);

							$this->db->insert('sub_task_assign', $sub_task_data);
						}

						foreach ($_POST['super_sub_task'] as $sst) {
							$super_task_data = array(
								'super_sub_task' => $sst,
								'project' => $result,
								'created_by' => $this->session->userdata('user'),
								'created_at' => date('Y-m-d H:i:s'),
								'modified_at' => date('Y-m-d H:i:s')
							);

							$this->db->insert('super_sub_task_assign', $super_task_data);
						}

						$this->output->set_output(json_encode(['result' => 1]));
						return false;
					} else {
						$this->output->set_output(json_encode(['result' => 2]));
						return false;
					}*/
					redirect('project');
				}/*else {
					$this->output->set_output(json_encode(['result' => 0]));
					return false;
				}*/
			
		} else {
			redirect('dashboard');
		}
	}
	public function edit_tasks()
	{
		if ($this->session->has_userdata('user') != false) {
			$taskid = $this->uri->segment(3);
			$data['taskedit'] = $this->Project->getAllEditProjects($taskid);
			$data['employers'] = $this->Employer->getAllEmployers();
			$data['employees'] = $this->Employee->getAllEmployees();
			$this->layout->view('project/editTask', $data);
		} else {
			redirect('dashboard');
		}
	}
	public function post_edit_project()
	{

		$taskid = $this->input->post('taskid');
			extract($_POST);
			$data = array(
				'project_name' => $project_name,
				'company' => $employer_name,
				'project_manager' => $project_manager,
				'expected_delivery' => $expected_delivery,
				'created_by' => $this->session->userdata('user'),
				'modified_at' => date('Y-m-d H:i:s'),
				'completion_date' => $completion_date,
				'date_of_bill' => $date_of_bill,
				'problems_issues' => $problems_issues,
				'short_out_issues' => $short_out_issues,
				'priority'   => $priority
			);


			$clean_data = $this->security->xss_clean($data);

			$update = $this->Main->update('id',$taskid, $clean_data,'projects');    
			
			if($_FILES['Receiptsfiles']['name'] != '')
			{

				$_FILES['file']['name']       = $_FILES['Receiptsfiles']['name'];
				$_FILES['file']['type']       = $_FILES['Receiptsfiles']['type'];
				$_FILES['file']['tmp_name']   = $_FILES['Receiptsfiles']['tmp_name'];
				$_FILES['file']['error']      = $_FILES['Receiptsfiles']['error'];
				$_FILES['file']['size']       = $_FILES['Receiptsfiles']['size'];

				// File upload configuration
				$uploadPath = 'uploads/UploadReceipts/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
				$config['max_size'] = ""; // Can be set to particular file size , here it is 2 MB(2048 Kb)
				$config['max_height'] = "";
				$config['max_width'] = "";

				// Load and initialize upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				// Upload file to server
				if($this->upload->do_upload('file')){
					// Uploaded file data
					$imageData = $this->upload->data();
					$uploadImgData['Receiptsfiles'] = $imageData['file_name'];
				}
				if(!empty($uploadImgData)){
					$update2 =$this->Main->update('id',$taskid, $uploadImgData,'projects');         
				}
			}
			
			
			if($update || $update2){
				redirect('project/edit_tasks/'.$taskid);
			}
		
	}
	public function updateProject_status()
	{
	
		$projectId = $this->input->post('projectId');
        $data = array(
			'status' => $this->input->post('status_name'),
		);  
		
		$result=$this->Main->update('id',$projectId, $data,'projects');
		if($result == true)
		{
			return redirect('project');
		}
		else
		{
			$errorUploadType = 'Some problem occurred, please try again.';
		}      
	}
	public function delete_tasks()
	{
		$taskid = $this->uri->segment(3);
		$result=$this->Main->delete('id',$taskid,'projects');
		if($result==true)
		{
			redirect('project');
		}
	}
	private function __form_validation()
	{
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('project_name', 'project_name', 'required|trim');
		$this->form_validation->set_rules('employer_name', 'employer_name', 'required|trim');
		$this->form_validation->set_rules('project_manager', 'project_manager', 'required|trim');
		/*$this->form_validation->set_rules('task[]', 'task', 'required|trim');
		$this->form_validation->set_rules('sub_task[]', 'sub-task', 'required|trim');
		$this->form_validation->set_rules('super_sub_task[]', 'super-sub-task', 'required|trim');*/
		$this->form_validation->set_rules('expected_delivery', 'expected_delivery', 'required|trim');
		$this->form_validation->set_error_delimiters('<div class="text text-danger">', '</div>');
		if ($this->form_validation->run() == true) {
			return true;
		} else {
			return false;
		}
	}

	public function tasks()
	{
		if ($this->session->has_userdata('user') != false) {
			$data['tasks'] = $this->Project->getAssignedTasks($this->uri->segment(3));
			$data['project_id'] = $this->uri->segment(3);
			$this->layout->view('project/tasks', $data);
		} else {
			redirect('dashboard');
		}
	}

	public function sub_tasks()
	{
		if ($this->session->has_userdata('user') != false) {
			$data['tasks'] = $this->Project->getAssignedSubTasks($this->uri->segment(3), $this->uri->segment(4));
			$data['task_id'] = $this->uri->segment(3);
			$data['project_id'] = $this->uri->segment(4);
			$this->layout->view('project/sub-tasks', $data);
		} else {
			redirect('dashboard');
		}
	}

	public function super_sub_tasks()
	{
		if ($this->session->has_userdata('user') != false) {
			$data['tasks'] = $this->Project->getAssignedSuperSubTasks($this->uri->segment(3), $this->uri->segment(4));
			$data['file_assign'] = $this->Project->getData();
			$data['sub_task_id'] = $this->uri->segment(3);
			$data['project_id'] = $this->uri->segment(4);
			$this->layout->view('project/super-sub-tasks', $data);
		} else {
			redirect('dashboard');
		}
	}

	public function view_images()
	{
		if ($this->session->has_userdata('user') != NULL) {
			if ($this->uri->segment(3) != "") {
				$data['project_id'] = $this->uri->segment(3);
				$data['images'] = $this->Project->getAllImages($data['project_id'], $this->session->userdata('user'));
				$this->layout->view('project/upload_success', $data);
			} else {
				redirect('dashboard');
			}
		} else {
			redirect('dashboard');
		}
	}

	public function post_add_image()
	{
		// $errorUploadType = "";
		// $statusMsg = "";
		// if($_POST!=NULL)
		// {
		// 	if($this->session->has_userdata('user')!=false)
		// 	{
		// 		if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0)
		// 		{
		// 			//$type=$this->input->post('type');
		// 			$project_id=$this->uri->segment(3);
		// 			$sub_task_id=$this->uri->segment(4);
		// 			//$tagname = $this->Project->getTagName($project_id);
		// 			//$previous_image_tag=$this->Project->lastImageTag($project_id);
		// 			//$tag_number=$this->Project->tagNumber($previous_image_tag);
		// 			$filesCount = count($_FILES['files']['name']);
		// 			for($i = 0; $i < $filesCount; $i++)
		// 			{
		// 				$_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
		// 				$_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
		// 				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
		// 				$_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
		// 				$_FILES['file']['size']     = $_FILES['files']['size'][$i]; 
		// 				$uploadPath = 'uploads/'; 
		// 				$config['upload_path'] = $uploadPath; 
		// 				$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx'; 
		// 				$config['max_size'] = ""; // Can be set to particular file size , here it is 2 MB(2048 Kb)
		//                 $config['max_height'] = "";
		//                 $config['max_width'] = "";
		// 				$this->load->library('upload', $config); 
		// 				$this->upload->initialize($config);

		// 				if($this->upload->do_upload('file'))
		// 				{
		//                     $fileData = $this->upload->data(); 
		//                     $uploadData[$i]['image_name'] = $fileData['file_name']; 
		//                     $uploadData[$i]['type']=$fileData['file_type'];
		//                     $uploadData[$i]['project'] = $project_id;
		//                     $uploadData[$i]['sub_task_id'] = $sub_task_id;
		//                     //$uploadData[$i]['type'] = $type;
		//                     //$uploadData[$i]['tag'] = $tagname.''.($tag_number+1);
		//                     $uploadData[$i]['created_by'] = $this->session->userdata('user');
		//                     $uploadData[$i]['status'] = $this->session->userdata('user');
		//                     $uploaddata[$i]['date']=date("y-m-d");
		//                     $uploadData[$i]['created_at'] = date("Y-m-d H:i:s");
		// 					$uploadData[$i]['modified_at'] = date("Y-m-d H:i:s"); 
		// 					//$tag_number++;
		// 				}
		// 				else
		// 				{
		// 					$errorUploadType .= $_FILES['file']['name'].' | ';
		// 				}

		// 				$errorUploadType = !empty($errorUploadType)?'<br/>File Type Error: '.trim($errorUploadType, ' | '):''; 
		// 			}

		// 				if(!empty($uploadData))
		// 				{
		// 					$insert = $this->Project->inserts($uploadData); 
		// 					if($insert==true)
		// 					{
		// 						redirect('project/view_images/'.$project_id);
		// 					}
		// 					else
		// 					{
		// 						$errorUploadType = 'Some problem occurred, please try again.';
		// 					}					
		// 				}
		// 				else
		// 				{
		// 					$statusMsg = "Sorry, there was an error uploading your file.".$errorUploadType;
		// 				}
		// 		}
		// 		else
		// 		{
		// 			echo "Please Select File to Upload";
		// 		}
		// 	}
		// 	else
		// 	{
		// 		redirect('dashboard');
		// 	}
		// }
		// else
		// {
		// 	redirect('dashboard');
		// }
		if ($this->session->has_userdata('user') != false) {
			/*$this->load->helper('form');
			$this->load->library('form_validation');*/

			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules('task_id', 'Task Id', 'callback_check_project_exists');
			/*$this->form_validation->set_rules('sub_task_id', 'Sub Task Id', 'callback_check_sub_task_exists');
			$this->form_validation->set_rules('super_sub_task_id', 'Super sub Task Id', 'callback_check_super_sub_task_exists');*/
			$this->form_validation->set_rules('files', '', 'callback_file_check');
			if ($this->form_validation->run() == FALSE) {
				$error = array(
					'status' => 'failed',
					"error_project_id" => form_error('task_id'),
					'error_file' => form_error('files'),
				);
				return $this->output
					->set_output(json_encode($error));
			} else {
				$insert = false;
				$filesCount = count($_FILES['files']['name']);

				for ($i = 0; $i < $filesCount; $i++) {

					$_FILES['file']['name']     = $_FILES['files']['name'][$i];
					$_FILES['file']['type']     = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error']     = $_FILES['files']['error'][$i];
					$_FILES['file']['size']     = $_FILES['files']['size'][$i];


					$config["upload_path"] = "./uploads/";
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['max_size'] = 200000;
					$config['max_width'] = '';
					$config['max_height'] = '';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('file')) {
						$error = array('error' => $this->upload->display_errors('', ''), 'status' => 'failed');
						return $this->output
							->set_output(json_encode($error));
					} else {
						$fileData = $this->upload->data();
						$uploadData[$i]['image_name'] = $fileData['file_name'];
						$uploadData[$i]['type'] = $fileData['file_type'];
						$uploadData[$i]['folder_assign_id'] = $this->input->post('folder_name');
						$uploadData[$i]['project'] = $this->input->post('task_id');
						$uploadData[$i]['created_by'] = $this->session->userdata('user');
						$uploadData[$i]['status'] = $this->session->userdata('user');
						$uploaddata[$i]['date'] = date("y-m-d");
						$uploadData[$i]['created_at'] = date("Y-m-d H:i:s");
						$uploadData[$i]['modified_at'] = date("Y-m-d H:i:s");
					}
				}
				if (!empty($uploadData)) {
					$insert = $this->Project->inserts($uploadData);
					if ($insert == true) {
						echo json_encode([
							'status' => 'success',
							'url' => 'document/file_upload/' . $this->input->post('folder_name')
						]);
					}
				}
			}
		} else {
			return redirect('dashboard');
		}
	}

	public function file_check($str)
	{
		$allowed_mime_type_arr = array('application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf', 'image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');
		$filesCount = count($_FILES['files']['name']);
		if (isset($_FILES['files']['name']) && $_FILES['files']['name'] != "") {
			for ($i = 0; $i < $filesCount; $i++) {

				$_FILES['file']['name']     = $_FILES['files']['name'][$i];
				$_FILES['file']['type']     = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error']     = $_FILES['files']['error'][$i];
				$_FILES['file']['size']     = $_FILES['files']['size'][$i];

				$mime = get_mime_by_extension($_FILES['file']['name']);
				if (in_array($mime, $allowed_mime_type_arr)) {
					return true;
				} else {
					$this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png/doc/docx file.');
					return false;
				}
			}
		} else {
			$this->form_validation->set_message('file_check', 'Please choose a file to upload.');
			return false;
		}
	}

	public function check_project_exists($id)
	{
		$check =  $this->Project->check_project_id($id);
		if ($check) {
			return true;
		} else {
			$this->form_validation->set_message('check_project_exists', 'Please Refresh Something Wrong');
			return false;
		}
	}

	public function check_sub_task_exists($id)
	{
		$check =  $this->Project->check_sub_task_id($id);
		if ($check) {
			return true;
		} else {
			$this->form_validation->set_message('check_sub_task_exists', 'Please Refresh Something Wrong');
			return false;
		}
	}
 
	public function check_super_sub_task_exists($id)
	{
		$check =  $this->Project->check_super_sub_task_id($id);
		if ($check) {
			return true;
		} else {
			$this->form_validation->set_message('check_super_sub_task_exists', 'Please Refresh Something Wrong');
			return false;
		}
	}


	public function capture_image($project_id)
	{
		$data = array(
			'image_name' => $this->input->post('webcam'),
			'type' => "capture/image",
			'project' => $project_id,
			'created_by' => $this->session->userdata('user'),
			'status'	=> $this->session->userdata('user'),
			'created_at'	=> date("Y-m-d H:i:s"),
			'modified_at' => date("Y-m-d H:i:s")
		);

		$insert = $this->Project->storecaptureimage($data);
		if ($insert == true) {
			return redirect('project/view_details/' . $project_id);
		} else {
			$errorUploadType = 'Some problem occurred, please try again.';
		}
	}

	public function view_details()
	{
		$data['image'] = $this->Project->getRows();
		if ($this->session->has_userdata('user') != NULL) {
			if ($this->uri->segment(3) != NULL) {

				//$data['task_id']=$this->uri->segment(3);
				$data['sub_task_id'] = $this->uri->segment(4);
				$data['project_id'] = $this->uri->segment(3);
				$data['super_sub_task_id'] = $this->uri->segment(5);
				//$data['detail'] = $this->Project->getAllImages($data['project_id'], $data['sub_task_id'], $data['super_sub_task_id'], $this->session->userdata('user'));
				$data['images'] = $this->Project->get_All_Images($data['project_id'], $data['sub_task_id'], $data['super_sub_task_id'], $this->session->userdata('user'));
				$this->layout->view('project/view-details', $data);
			} else {
				redirect('dashboard');
			}
		} else {
			redirect('dashboard');
		}
	}
	public function folder_create(){
	        $id= $this->uri->segment(3);
	        $data['folder'] = $this->Project->getData($id);
	        //$data['folder'] = $this->Project->getData();
 	         $data=array(
 		'folder_name'=>$this->input->post('create_folder'),
 		//'project' => $project_id,
 		'created_by' =>  $this->session->userdata('user'),                                  
        'created_at' => date("Y-m-d H:i:s"),                       
        'modified_at' => date("Y-m-d H:i:s"));
        $insert= $this->Project->createfolder($data); 
			if($insert==true)
			{
				return redirect('document/view_details/');
			}
			else
			{
				$errorUploadType = 'Some problem occurred, please try again.';
			}
 	}

	public function download($id)
	{
		if (!empty($id)) {
			//load download helper
			//$this->load->helper('download');

			//get file info from database
			$fileInfo = $this->Project->getRows(array('id' => $id));

			//file path
			$file = 'uploads/' . $fileInfo['image_name'];
 
			//download file from directory
			force_download($file, NULL);
		}
	}

	public function downloadcam($id)
	{
		if (!empty($id)) {
			//load download helper
			//$this->load->helper('download');

			//get file info from database
			$fileInfo = $this->Project->getRows(array('id' => $id));

			//file path
			$file = $fileInfo['image_name'];

			//download file from directory
			force_download($file, 'capture/image');
		}
	}

	public function addRemarks()
	{
		if ($this->uri->segment(3) != "") {
	 		if ($this->session->has_userdata('user')) {
				$data['image_id'] = $this->uri->segment(3);
				$data['project_id'] = $this->uri->segment(4);
				$this->layout->view('project/remark', $data);
			} else {
				redirect('dashboard');
			}
		} else {
			redirect('dashboard');
		}
	}

	public function add_remark_post()
	{
		// if($_POST!=NULL)
		// {
		if ($this->uri->segment(3) != "") {
			if ($this->session->has_userdata('user')) {
				$image_id = $this->uri->segment(3);
				$remark = $this->input->post('remark');
				$result = $this->Main->update('id', $image_id, 'image', ['remarks' => $remark]);
				redirect('project/view_images/' . $this->uri->segment(4));
			} else {
				redirect('dashbaord');
			}
		} else {
			redirect('dashboard');
		}
		// }
		// else
		// {
		// 	redirect('dashboard');
		// }
	}
	public function deleteImage()
	{
		if ($this->session->has_userdata('user') != false) {
			$imageId = $this->uri->segment(3);
			$imageName = $this->Project->getImageData($imageId);
			$result = $this->Main->delete('id', $imageId, 'image');
			if ($result == true) {
				unlink(FCPATH . 'images/' . $imageName);
			}
			redirect('project/open_images/' . $this->uri->segment(4));
		} else {
			redirect('dashboard');
		}
	}
	public function deleteProject()
	{
		if ($this->session->has_userdata('user') != false) {
			$projectId = $this->uri->segment(3);
			$result = $this->Main->delete('id', $projectId, 'project');
			if ($result == true) {
				redirect('project');
			} else {
				redirect('project');
			}
		}
	}
	public function assign_tasks()
	{
		if ($this->session->has_userdata('user') != false) {
			$data['assign_id'] = $this->uri->segment(3);
			$data['project_id'] = $this->uri->segment(4);
			$data['employees'] = $this->Employee->getAllEmployees();
			$this->layout->view('project/assign-task', $data);
		} else {
			redirect('dashboard');
		}
	}
	public function post_assign_task()
	{
		if ($_POST != NULL) {
			if ($this->session->has_userdata('user') != false) {
				$assign_id = $this->uri->segment(3);
				$project_id = $this->uri->segment(4);
				extract($_POST);
				$result = $this->Main->update('id', $assign_id, ['assign_to' => $project_manager], 'task_assign');
				if ($result == true) {
					redirect('project/tasks/' . $project_id);
				} else {
					redirect('project/tasks/' . $project_id);
				}
			} else {
				redirect('dashboard');
			}
		} else {
			redirect('dashboard');
		}
	}

	public function assign_sub_tasks()
	{
		if ($this->session->has_userdata('user') != false) {
			$data['assign_id'] = $this->uri->segment(3);
			$data['task_id'] = $this->uri->segment(4);
			$data['project_id'] = $this->uri->segment(5);
			$data['employees'] = $this->Employee->getAllEmployees();
			$this->layout->view('project/assign-sub-task', $data);
		} else {
			redirect('dashboard');
		}
	}

	public function post_assign_sub_task()
	{
		if ($_POST != NULL) {
			if ($this->session->has_userdata('user') != false) {
				$assign_id = $this->uri->segment(3);
				$task_id = $this->uri->segment(4);
				$project_id = $this->uri->segment(5);
				extract($_POST);
				$result = $this->Main->update('id', $assign_id, ['assign_to' => $project_manager], 'sub_task_assign');
				if ($result == true) {
					redirect('project/sub_tasks/' . $task_id . '/' . $project_id);
				} else {
					redirect('project/sub_tasks/' . $task_id . '/' . $project_id);
				}
			} else {
				redirect('dashboard');
			}
		} else {
			redirect('dashboard');
		}
	}

	public function assign_super_sub_tasks()
	{
		if ($this->session->has_userdata('user') != false) {
			$data['assign_id'] = $this->uri->segment(3);
			$data['sub_task_id'] = $this->uri->segment(4);
			$data['project_id'] = $this->uri->segment(5);
			$data['employees'] = $this->Employee->getAllEmployees();
			$this->layout->view('project/assign-super-sub-task', $data);
		} else {
			redirect('dashboard');
		}
	}

	// 	public function assign_super_sub_tasks()
	// 	{
	// 	    if($this->session->has_userdata('user')!=false)
	// 	    {
	// 	        $data['assign_id']=$this->uri->segment(3);
	// 	        $data['task_id']=$this->uri->segment(4);
	// 	        $data['project_id']=$this->uri->segment(5);
	// 	        $data['employees']=$this->Employee->getAllEmployees();
	// 	        $this->layout->view('project/assign-sub-task',$data);
	// 	    }
	// 	    else
	// 	    {
	// 	        redirect('dashboard');
	// 	    }
	// 	}

	public function post_assign_super_sub_task()
	{
		if ($_POST != NULL) {
			if ($this->session->has_userdata('user') != false) {
				$assign_id = $this->uri->segment(3);
				$sub_task_id = $this->uri->segment(4);
				$project_id = $this->uri->segment(5);
				extract($_POST);
				$result = $this->Main->update('id', $assign_id, ['assign_to' => $project_manager], 'super_sub_task_assign');
				if ($result == true) {
					redirect('project/super_sub_tasks/' . $sub_task_id . '/' . $project_id);
				} else {
					redirect('project/super_sub_tasks/' . $sub_task_id . '/' . $project_id);
				}
			} else {
				redirect('dashboard');
			}
		} else {
			redirect('dashboard');
		}
	}
	
}
