<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends CI_Controller {
    private $error = array();
    private $candidate_id;
    private $page_name = 'profile';
    private $candidateArr = array();
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->load->model('candidate/Education_model', 'model_education');

        $this->valid = $this->validate();
    }

    public function index(){

        $json = array();

    	if($this->valid){
			$educations = $this->model_education->getEducations($this->candidate_id);
			if($educations) {
				$json['success'] = $educations;
				$json['message'] = 'show';
			} else {
				$json['error'] = true;
				$json['message'] = 'No educations found';
			}
		} else {
			$json['error'] = true;
			$json['show'] = true;
			$json['message'] = $this->error['warning'];
		}

		echo json_encode($json);
	}

	public function detail($education_id){

		$json = array();
		if($this->valid){
			$filter_data['candidate_id'] = $this->candidate_id;
			$education = $this->model_education->getEducation($education_id, $filter_data);
			if($education) {
				$json['success'] = $education;
				$json['message'] = 'show';
			} else {
				$json['error'] = true;
				$json['message'] = 'No educations found';
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
            $qualification = $this->input->post('education_qualification');
			$education_id = $this->model_education->addEducation($this->candidate_id);
			if($education_id) {
                $this->setFilter('filter_qualification', $qualification); // Set Skill Filter
				$json['success'] = $education_id;
				$json['message'] = 'education added successfully';
			} else {
				$json['error'] = true;
				$json['message'] = 'education detail not added!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}

		echo json_encode($json);
	}

	public function edit($education_id){

		$json = array();
		if($this->valid){
			$filter_data['candidate_id'] = $this->candidate_id;
            $qualification = $this->input->post('education_qualification');
			$education = $this->model_education->getEducation($education_id, $filter_data);
			if($education){
				$edit = $this->model_education->editEducation($education_id);
				if($edit) {
                    $this->deleteFilter('filter_qualification'); //Delete Qualification Filter
                    $this->setFilter('filter_qualification', $qualification); // Set Qualification Filter
					$json['success'] = true;
					$json['message'] = 'education details modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'education detail not modified!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'education detail not found!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}

		echo json_encode($json);
	}

	public function delete($education_id){

		$json = array();

		if($this->valid){
			$education = $this->model_education->deleteEducation($education_id);
			if($education) {
				$json['success'] = true;
				$json['message'] = 'education details deleted successfully';
			} else {
				$json['error'] = true;
				$json['message'] = 'education detail not deleted!';
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
        $this->load->model('candidate/Candidate_model', 'model_candidate');   //Load company model
        $this->load->model('Users_model', 'model_users');
        $this->adminArr = $this->model_users->getUser($this->user_id);
		$this->candidateArr = $this->model_candidate->getCandidateById($this->input->get('candidate_id'));
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

    //Set Candidate filter
    protected function setFilters($keyword, $datas){
        if($datas && is_array($datas)){
            foreach($datas as $data){
                $this->setFilter($keyword, $data);
            }
        }
    }

    protected function setFilter($keyword, $data){
        $filter = $this->model_candidate->getCandidateFilter($this->candidate_id, $keyword, $data);
        if($filter){
             $this->model_candidate->updateCandidateFilter($filter->candidate_filter_id, $keyword, $data);
        } else {
            $this->model_candidate->addCandidateFilter($this->candidate_id, $keyword, $data);
        }
    }

    //Delete Candidate filter
    protected function deleteFilter($keyword){
        if($keyword){
            $this->model_candidate->deleteCandidateFilter($this->candidate_id, $keyword);
        }
    }
}
