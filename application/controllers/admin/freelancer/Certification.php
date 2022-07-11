<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certification extends CI_Controller {
	private $error = array();
	private $freelancer_id;
	private $page_name = 'profile';
    private $freelancerArr = array();
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->load->model('freelancer/Certification_model', 'model_certification');

		$this->valid = $this->validate();
	}

	public function index(){

		$json = array();

		if($this->valid){
			$certifications = $this->model_certification->getCertifications($this->freelancer_id);
			if($certifications) {
				$json['success'] = $certifications;
				$json['message'] = 'show';
			} else {
				$json['error'] = true;
				$json['message'] = 'No certifications found';
			}
		} else {
			$json['error'] = true;
			$json['show'] = true;
			$json['message'] = $this->error['warning'];
		}
		
		echo json_encode($json);
	}

	public function detail($certification_id){

		$json = array();
		if($this->valid){
			$filter_data['freelancer_id'] = $this->freelancer_id;
			$certification = $this->model_certification->getCertification($certification_id, $filter_data);
			if($certification) {
				$json['success'] = $certification;
				$json['message'] = 'show';
			} else {
				$json['error'] = true;
				$json['message'] = 'No certifications found';
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
			$certification_id = $this->model_certification->addCertification($this->freelancer_id);
			if($certification_id) {
				$json['success'] = $certification_id;
				$json['message'] = 'Certification added successfully';
			} else {
				$json['error'] = true;
				$json['message'] = 'Certification detail not added!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}
				
		echo json_encode($json);
	}

	public function edit($certification_id){

		$json = array();
		if($this->valid){
			$filter_data['freelancer_id'] = $this->freelancer_id;
			$certification = $this->model_certification->getCertification($certification_id, $filter_data);
			if($certification){
				$edit = $this->model_certification->editCertification($certification_id);
				if($edit) {
					$json['success'] = true;
					$json['message'] = 'Certification details modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Certification detail not modified!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'Certification detail not found!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}

		echo json_encode($json);
	}

	public function delete($certification_id){

		$json = array();

		if($this->valid){
			$certification = $this->model_certification->deleteCertification($certification_id);
			if($certification) {
				$json['success'] = true;
				$json['message'] = 'Certification details deleted successfully';
			} else {
				$json['error'] = true;
				$json['message'] = 'Certification detail not deleted!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}
		
		echo json_encode($json);
	}

	
	protected function validate() {
		//Check if company user is loggedin or not
		$this->user_id = $this->admin->isLogged();
		if(!$this->user_id) {
		    $this->error['warning'] = 'Please logged in your account';
		} else {
			$this->loadDetails();
		}
		
		return !$this->error;
	}

	protected function loadDetails(){
		$this->load->helper('user'); // Load user helper
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');   //Load company model
        $this->load->model('Users_model', 'model_users');
        $this->adminArr = $this->model_users->getUser($this->user_id);
		$this->freelancerArr = $this->model_freelancer->getFreelancerById($this->input->get('freelancer_id'));
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
