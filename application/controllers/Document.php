<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller
{ 
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('download');
	}
 
	
    public function view_details()
	{
		
        $data['image'] = $this->Document->getRows();
		$data['employers'] = $this->Employer->getAllEmployers();
		$data['employees'] = $this->Employee->getAllEmployees();
        $id = $this->uri->segment(3);
        $data['folder'] = $this->Project->getData($id);

		if($this->session->has_userdata('user')!=NULL)
		{
			$data['images']=$this->Document->get_All_Images($this->session->userdata('user'));
			//$data['project_id']=$this->uri->segment(3);
			$this->layout->view('document/document',$data);
			
		}
		else
		{
			redirect('dashboard');
		}
	}
	
	public function file_upload()
	{
        //$data['image'] = $this->Project->getRows();
		//$data['docfile'] = $this->Document->getRowss();
		//$data['companies_numrow'] = $this->Document->registrars_companies_numrow();
		$data['employers'] = $this->Employer->getAllEmployers();
		$data['employees'] = $this->Employee->getAllEmployees();
		$data['form_number'] = $this->Document->getAllform_number();
		$id = $this->uri->segment(3);
		$data['registrars_companies'] = $this->Document->all_registrars_companies($id);
		$data['folder'] = $this->Project->getData($id);
		$data['file']=$this->Document->getDocImages($this->session->userdata('user'),$id);
		$data['company_verticals'] = $this->Document->getCompany_verticals();
		$this->layout->view('document/folder',$data);
		
	}

	public function post_add_image()
    {
    	$errorUploadType = "";
    	$statusMsg = "";
    	if($_POST!=NULL)
    	{
    		if($this->session->has_userdata('user')!=false)
    		{
    			if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0)
    			{
    				//$type=$this->input->post('type');
    				$project_id=$this->uri->segment(3);
    				//$sub_task_id=$this->uri->segment(4);
    				//$tagname = $this->Project->getTagName($project_id);
    				//$previous_image_tag=$this->Project->lastImageTag($project_id);
    				//$tag_number=$this->Project->tagNumber($previous_image_tag);
    				$filesCount = count($_FILES['files']['name']);
    				for($i = 0; $i < $filesCount; $i++)
    				{
						$_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
						$_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
						$_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
						$_FILES['file']['size']     = $_FILES['files']['size'][$i]; 
						$uploadPath = 'uploads/'; 
						$config['upload_path'] = $uploadPath; 
						$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx'; 
						$config['max_size'] = ""; // Can be set to particular file size , here it is 2 MB(2048 Kb)
                        $config['max_height'] = "";
                        $config['max_width'] = "";
						$this->load->library('upload', $config); 
						$this->upload->initialize($config);

						if($this->upload->do_upload('file'))
						{
	                        $fileData = $this->upload->data(); 
	                        $uploadData[$i]['image_name'] = $fileData['file_name']; 
	                        $uploadData[$i]['type']=$fileData['file_type'];
	                        //$uploadData[$i]['project'] = $project_id;
	                        //$uploadData[$i]['sub_task_id'] = $sub_task_id;
	                        //$uploadData[$i]['type'] = $type;
	                        //$uploadData[$i]['tag'] = $tagname.''.($tag_number+1);
	                        $uploadData[$i]['created_by'] = $this->session->userdata('user');
	                        $uploadData[$i]['status'] = $this->session->userdata('user');
	                        $uploaddata[$i]['date']=date("y-m-d");
	                        $uploadData[$i]['created_at'] = date("Y-m-d H:i:s");
							$uploadData[$i]['modified_at'] = date("Y-m-d H:i:s"); 
							$uploadData[$i]['file_assign_id'] = $this->uri->segment(3);
							//$tag_number++;
						}
						else
						{
							$errorUploadType .= $_FILES['file']['name'].' | ';
						}

						$errorUploadType = !empty($errorUploadType)?'<br/>File Type Error: '.trim($errorUploadType, ' | '):''; 
					}

					if(!empty($uploadData))
					{
						$insert = $this->Document->inserts($uploadData); 
						$id=$this->uri->segment(3);
						if($insert==true)
						{
							redirect('document/file_upload/'.$id);
						}
						else
						{
							$errorUploadType = 'Some problem occurred, please try again.';
						}					
					}
					else
					{
						$statusMsg = "Sorry, there was an error uploading your file.".$errorUploadType;
					}
    			}
    			else
    			{
    				echo "Please Select File to Upload";
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
    /*function dragDropUpload(){ 
        if(!empty($_FILES)){ 
            // File upload configuration 
            $uploadPath = 'uploads/'; 
            $config['upload_path'] = $uploadPath; 
            $config['allowed_types'] = '*'; 
             
            // Load and initialize upload library 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
             
            // Upload file to the server 
            if($this->upload->do_upload('file')){ 
                $fileData = $this->upload->data(); 
                $uploadData[$i]['image_name'] = $fileData['file_name'];
                $uploadData[$i]['type']=$fileData['file_type'];
	            $uploadData[$i]['created_by'] = $this->session->userdata('user');
	            $uploadData[$i]['status'] = $this->session->userdata('user');
	            //$uploaddata[$i]['date']=date("y-m-d");
	            $uploadData[$i]['created_at'] = date("Y-m-d H:i:s");
	            $uploadData[$i]['modified_at'] = date("Y-m-d H:i:s");              
                 
                // Insert files info into the database 
                //$insert = $this->Document->inserts($uploadData); 
            } 
            if(!empty($uploadData))
			{
				$insert = $this->Document->inserts($uploadData); 
				if($insert==true)
				{
					redirect('document/file_upload/');
				}
				else
				{
					$errorUploadType = 'Some problem occurred, please try again.';
				}					
			}
			else
			{
				$statusMsg = "Sorry, there was an error uploading your file.".$errorUploadType;
			}
        } 
    } */

    public function download($id)
	{
		if (!empty($id)) {
			//load download helper
			//$this->load->helper('download');

			//get file info from database
			$fileInfo = $this->Document->getRows(array('id' => $id));

			//file path
			$file = 'uploads/' . $fileInfo['image_name'];
 
			//download file from directory
			force_download($file, NULL);
		}
	}
	
	public function fetchSearchYearData()
	{
		$year = $_POST['year'];
		
		$data['Searchfolder'] = $this->Document->getSearchYeardata($year);
		$data['folder'] = $this->Project->getData();

		$this->load->view('document/searchFolder',$data); 
	}
	public function searchCompanyData()
	{
		$companyName = $_POST['companyName'];
		$folderid = $_POST['folder_id'];
		
		$data['file'] = $this->Document->getSearchCompanydata($companyName,$folderid);
		
		//$data['folder'] = $this->Project->getData();

		$this->load->view('document/searchFile',$data); 
	}
	public function searchGroupNameData()
	{
		$group_name = $_POST['group_name'];
		$folderid = $_POST['folder_id'];
		
		$data['file'] = $this->Document->getSearchGroupNamedata($group_name,$folderid);

		$this->load->view('document/searchFile',$data); 
	}
	public function searchFromDateData()
	{
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];

		/*$from_date= date('Y-m-d', strtotime($_POST['from_date']));
		$to_date= date('Y-m-d', strtotime($_POST['to_date']));*/
		$folderid = $_POST['folder_id'];

		$data['file'] = $this->Document->getSearchFromDatedata($from_date,$to_date,$folderid);
		//$data['folder'] = $this->Project->getData();

		$this->load->view('document/searchFile',$data); 
	}
	public function capture_image()
	{
		$project_id = $this->input->post('projectsId');
		$folderid = $this->input->post('folderid');
		extract($_POST);
		$data = array(
			'image_name' => $this->input->post('webcam'),
			'type' => "capture/image",
			'project' => $project_id,
			'roc_id' => $registrars_companiesId,
			'folder_assign_id' => $folderid,
			'created_by' => $this->session->userdata('user'),
			'status'	=> $this->session->userdata('user'),
			'created_at'	=> date("Y-m-d H:i:s"),
			'modified_at' => date("Y-m-d H:i:s")
		);

		$insert = $this->Project->storecaptureimage($data);
		if ($insert == true) {
			return redirect('document/file_upload/' . $folderid);
		} else {
			$errorUploadType = 'Some problem occurred, please try again.';
		}
	}
	public function showSrnCheck(){
		
		$srnCheck = $_GET['srnCheck'];
		//$date = date("Y-m-d");
		
		$srnCheck_sql  = "SELECT registrars_of_companies.srn 
		FROM registrars_of_companies 
		WHERE registrars_of_companies.srn = '".$srnCheck."'"; 
		
		$srnCheck_query = $this->db->query($srnCheck_sql);
		$srnCheck_rownum = $srnCheck_query->num_rows();
		echo json_encode( $srnCheck_rownum );

	}
	public function post_add_registrars_companies()
	{
		$folderid = $this->input->post("folderid");
		extract($_POST);
		$data = array(
			'folder_assign_id' => $folderid,
			'form_number_id' => $form_number,
			'company_name' => $company_name,
			'form_name' => $form_name,
			'statutory_due_date' => $statutory_due_date,
			'created_by' => $created_by,
			'year_period' => $year_period,
			'date_of_filing'	=> $date_of_filing,
			'srn'	=> $srn,
			'amount' => $amount,
			'type_ofFee' => $type_ofFee
		);

		$insert = $this->Document->addRegistrars_companies($data);
		$insert_id = $this->db->insert_id();

		$this->load->library('upload');
		//echo $_FILES['roc_challan']['name'];exit;
		if($_FILES['roc_challan']['name'] != '')
		{

			$_FILES['file']['name']       = $_FILES['roc_challan']['name'];
			$_FILES['file']['type']       = $_FILES['roc_challan']['type'];
			$_FILES['file']['tmp_name']   = $_FILES['roc_challan']['tmp_name'];
			$_FILES['file']['error']      = $_FILES['roc_challan']['error'];
			$_FILES['file']['size']       = $_FILES['roc_challan']['size'];

			// File upload configuration
			$uploadPath = 'uploads/roc_img/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|docx';
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
				$uploadImgData['roc_challan'] = $imageData['file_name'];
				$updateroc_formData['challan_type'] = $imageData['file_type'];
			}
			$updatechallan =$this->Main->update('id',$insert_id, $uploadImgData,'registrars_of_companies');         
		} 

		if($_FILES['roc_form']['name'] != '')
		{

			$_FILES['file']['name']       = $_FILES['roc_form']['name'];
			$_FILES['file']['type']       = $_FILES['roc_form']['type'];
			$_FILES['file']['tmp_name']   = $_FILES['roc_form']['tmp_name'];
			$_FILES['file']['error']      = $_FILES['roc_form']['error'];
			$_FILES['file']['size']       = $_FILES['roc_form']['size'];

			// File upload configuration
			$uploadPath = 'uploads/roc_img/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|docx';
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
				$updateroc_formData['roc_form'] = $imageData['file_name'];
				$updateroc_formData['form_type'] = $imageData['file_type'];
			}
			$updateroc_form =$this->Main->update('id',$insert_id, $updateroc_formData,'registrars_of_companies');         
		} 
		if($_FILES['additional_file_1']['name'] != '')
		{

			$_FILES['file']['name']       = $_FILES['additional_file_1']['name'];
			$_FILES['file']['type']       = $_FILES['additional_file_1']['type'];
			$_FILES['file']['tmp_name']   = $_FILES['additional_file_1']['tmp_name'];
			$_FILES['file']['error']      = $_FILES['additional_file_1']['error'];
			$_FILES['file']['size']       = $_FILES['additional_file_1']['size'];

			// File upload configuration
			$uploadPath = 'uploads/roc_img/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|docx';
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
				$updateroc_additionalData['additional_file_1'] = $imageData['file_name'];
				$updateroc_additionalData['additional_file1_type'] = $imageData['file_type'];
			}
			$updateroc_additional1 =$this->Main->update('id',$insert_id, $updateroc_additionalData,'registrars_of_companies');         
		}
		if($_FILES['additional_file_2']['name'] != '')
		{

			$_FILES['file']['name']       = $_FILES['additional_file_2']['name'];
			$_FILES['file']['type']       = $_FILES['additional_file_2']['type'];
			$_FILES['file']['tmp_name']   = $_FILES['additional_file_2']['tmp_name'];
			$_FILES['file']['error']      = $_FILES['additional_file_2']['error'];
			$_FILES['file']['size']       = $_FILES['additional_file_2']['size'];

			// File upload configuration
			$uploadPath = 'uploads/roc_img/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|docx';
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
				$updateroc_additional2Data['additional_file_2'] = $imageData['file_name'];
				$updateroc_additional2Data['additional_file2_type'] = $imageData['file_type'];
			}
			$updateroc_additional2 =$this->Main->update('id',$insert_id, $updateroc_additional2Data,'registrars_of_companies');         
		}

		if ($insert == true || $updatechallan == true || $updateroc_form == true || $updateroc_additional1 == true || $updateroc_additional2 == true) {
			return redirect('document/file_upload/'.$folderid);
		} else {
			$errorUploadType = 'Some problem occurred, please try again.';
		}
	}
	public function post_add_form_number()
	{
		$folderid = $this->input->post("folderid");
		extract($_POST);
		$data = array(
			'form_number' => $form_number
		);

		$insert = $this->Document->addForm_number($data);
		if ($insert == true) {
			return redirect('document/file_upload/'.$folderid);
		} else {
			$errorUploadType = 'Some problem occurred, please try again.';
		}
	}
	public function updateroc_status()
	{
		$folderid = $this->input->post("folderid");
		$rocStatusId = $this->input->post("rocStatusId");
		extract($_POST);
		$roc_Data = array(
			'status' => $status_name
		);

		$updateroc_form =$this->Main->update('id',$rocStatusId, $roc_Data,'registrars_of_companies');  
		if ($updateroc_form == true) {
			return redirect('document/file_upload/'.$folderid);
		} else {
			$errorUploadType = 'Some problem occurred, please try again.';
		}
	}
	public function delete_form_number()
	{
		$form_numberid = $this->uri->segment(3);
		$folderid = $this->uri->segment(4);

		$result=$this->Main->delete('id',$form_numberid,'roc_form_number');
		if($result==true)
		{
			redirect('document/file_upload/'.$folderid);
		}
	}
}
