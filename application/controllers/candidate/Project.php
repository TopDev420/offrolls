<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
	private $error = array();
	private $candidate_id;
	private $page_name = 'profile';
    private $candidateArr = array();
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('candidate');
        $this->load->model('candidate/Project_model', 'model_project');

		$this->valid = $this->validate();
	}

	public function index(){

		$json = array();

		if($this->valid){
			$projects = $this->model_project->getProjects($this->candidate_id);
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
			$filter_data['candidate_id'] = $this->candidate_id;
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

	public function add(){

		$json = array();
		if($this->valid){
			$project_id = $this->model_project->addProject($this->candidate_id);
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
			$filter_data['candidate_id'] = $this->candidate_id;
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
		$this->user_id = $this->candidate->isLogged();
		if(!$this->user_id) {
		    $this->error['warning'] = 'Please logged in your account';
		} else {
			$this->loadDetails();
		}

		$profile_status = $this->getProfileStatus('candidate');
		if(!$profile_status){
			$this->error['warning'] = 'Please complete your profile';
		}

		return !$this->error;
	}

	protected function loadDetails(){
		$this->load->helper('user'); // Load user helper
        $this->load->model('candidate/Candidate_model', 'model_candidate');   //Load company model
		$this->candidateArr = $this->model_candidate->getCandidate($this->user_id);
		$this->candidate_id = isset($this->candidateArr->candidate_id) ? $this->candidateArr->candidate_id : 0;
	}

	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type){
		if($this->user_id){
			$profile_progress = get_profile_status($this->candidateArr, $type);
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
