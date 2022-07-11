<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
	private $error = array();
	private $freelancer_id;
	private $page_name = 'profile';
    private $freelancerArr = array();
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('freelancer');
        $this->load->model('freelancer/Project_model', 'model_project');

		$this->valid = $this->validate();
	}

	public function index(){

		$json = array();

		if($this->valid){
			$projects = $this->model_project->getProjects($this->freelancer_id);
			if($projects) {
				$json['success'] = $projects;
				$json['message'] = 'show';
			} else {
				$json['error'] = true;
				$json['message'] = 'No projects found';
			}
		} else {
			$json['error'] = true;
			$json['show'] = true;
			$json['message'] = $this->error['warning'];
		}
		
		echo json_encode($json);
	}

	public function detail($project_id){

		$json = array();
		if($this->valid){
			$filter_data['freelancer_id'] = $this->freelancer_id;
			$project = $this->model_project->getProject($project_id, $filter_data);
			if($project) {
				$json['success'] = $project;
				$json['message'] = 'show';
			} else {
				$json['error'] = true;
				$json['message'] = 'No projects found';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}
		
		
		echo json_encode($json);
	}


    //Save profile_image
    public function save_picture(){
        $json = array();
        $userInfo = $this->model_users->getUser($this->user_id);
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $upload_path = APPPATH . 'assets/uploads/portfolio/';

            //Upload Picture
			$upload = array();
			if(isset($_FILES['portfolio_files'])){
                if(!empty($_FILES['portfolio_files']['name'])) {
                    $upload = $this->savePicture($_FILES['portfolio_files'], $this->user_id);
                }
            } else {
            	if(!empty($this->input->post('portfolio_files'))) {
                    $upload = $this->savePicture($this->input->post('portfolio_files'), $this->user_id, '', 'blob');
                }
            }

            //Unlink Existing Image
            $thumb = $userInfo->image;
            if($thumb){
                if(is_readable($upload_path . $thumb)){
                    unlink($upload_path . $thumb);
                }
            }

            if($upload){
            	$json = $upload;
            } else {
                $json['error'] = true;
                $json['message'] = 'Upload image not available!';
            }
        }

        echo json_encode($json);
    }

    //Save image
    public function savePicture($uploadImage, $userid, $thumb='', $uploadType='file') {
        $json = array();
        $json['success'] = false;
        $json['error'] = false;
        $file_upload = false;

        if(!empty($uploadImage)) {
	        
	        // Load file storage library
	        $file_storage = 'Default';
	        if($file_storage){
	        	$this->load->library('storage/'. ucfirst($file_storage) . '_storage', NULL, 'fileStorage');
	        	if($uploadType == 'blob'){

	        		$file_data = array(
			        	'newname' => 'flpic' . date('YmdHis'). $userid,
			        	'upload_path' => APPPATH . 'assets/uploads/portfolio/',
			        	'blob' => $uploadImage,
			        	'extension' => 'png',
			        	'type' => 'image/png',
			        	'upload_file' => 'portfolio_files',
			        );

	        		$file_upload = $this->fileStorage->uploadBlobFile($file_data);
		        	if($thumb){
		        		$this->fileStorage->deleteFile($file_data['upload_path'].$thumb);
		        	}
	        	} else {

	        		$extension = pathinfo($uploadImage['name'], PATHINFO_EXTENSION);
			        $filename = pathinfo($uploadImage['name'], PATHINFO_FILENAME);
			        $file_data = array(
			        	'name' => $filename,
			        	'newname' => $filename . 'pic' . date('YmdHis'). $userid,
			        	'extension' => $extension,
			        	'tmp_name' => $uploadImage['tmp_name'],
			        	'type' => $uploadImage['type'],
			        	'allowed_types' => 'jpeg|jpg|png',
			        	'upload_file' => 'portfolio_files',
			        	'upload_path' => APPPATH . 'assets/uploads/portfolio/'
			        );

	        		$file_upload = $this->fileStorage->uploadFile($file_data);
		        	if($thumb){
		        		$this->fileStorage->deleteFile($file_data['upload_path'].$thumb);
		        	}
	        	}
	        	
	        }
	        
	        $file_upload_status = isset($file_upload['status']) ? $file_upload['status'] : false;
            if($file_upload_status){
                $saveImage = $this->model_freelancer->saveImage($userid, $file_upload['name']);
                if($saveImage){
                    $json['success'] = true;
                    $json['message'] = 'Image uploaded';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Image not uploaded!';
                }
            } else {
                $json['error']= true;
                $json['message'] = $file_upload['message'];
            }
        } else {
            $json['error']= true;
            $json['message'] = 'Please upload image file!';
        }
        

        return $json;
    }

	public function add(){

		$json = array();
		if($this->valid){
			$project_id = $this->model_project->addProject($this->freelancer_id);
			if($project_id) {
				$json['success'] = $project_id;
				$json['message'] = 'project added successfully';
			} else {
				$json['error'] = true;
				$json['message'] = 'project detail not added!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}
				
		echo json_encode($json);
	}

	public function edit($project_id){

		$json = array();
		if($this->valid){
			$filter_data['freelancer_id'] = $this->freelancer_id;
			$project = $this->model_project->getProject($project_id, $filter_data);
			if($project){
				$edit = $this->model_project->editProject($project_id);
				if($edit) {
					$json['success'] = true;
					$json['message'] = 'project details modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'project detail not modified!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'project detail not found!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}

		echo json_encode($json);
	}

	public function delete($project_id){

		$json = array();

		if($this->valid){
			$project = $this->model_project->deleteProject($project_id);
			if($project) {
				$json['success'] = true;
				$json['message'] = 'project details deleted successfully';
			} else {
				$json['error'] = true;
				$json['message'] = 'project detail not deleted!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}
		
		echo json_encode($json);
	}

	protected function validate() {
		//Check if company user is loggedin or not
		$this->user_id = $this->freelancer->isLogged();
		if(!$this->user_id) {
		    $this->error['warning'] = 'Please logged in your account';
		} else {
			$this->loadDetails();
		}

		$profile_status = $this->getProfileStatus('freelancer');
		if(!$profile_status){
			$this->error['warning'] = 'Please complete your profile';
		}

		return !$this->error;
	}

	protected function loadDetails(){
		$this->load->helper('user'); // Load user helper
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');   //Load company model
		$this->freelancerArr = $this->model_freelancer->getFreelancer($this->user_id);
		$this->freelancer_id = isset($this->freelancerArr->freelancer_id) ? $this->freelancerArr->freelancer_id : 0;
	}

	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type){
		if($this->user_id){
			$profile_progress = get_profile_status($this->freelancerArr, $type);
			if($profile_progress < 80 ){
				return false;
			} else {
				return $profile_progress;
			}
		} else {
			return true;
		}
	}
}
