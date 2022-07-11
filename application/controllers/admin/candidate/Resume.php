<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resume extends CI_Controller {
    private $page_name = 'resume';
    private $candidateArr = array();
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate();
    }

    public function index(){

        $data = array();
        $this->load->helper('category');
        $data['logged'] = true;

        $data['moduleAction'] = 'candidate';
        $data['heading_title'] = 'Edit Resume';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'candidate/dashboard'
		);
		$data['active_menu'] = 'mnu-edit-resume';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}


        $candidate_id = $this->candidateArr->candidate_id;
        //Check Candidate Resumes
        $candidate_resume = $this->model_candidate->getCandidateResume($candidate_id);
        if(!$candidate_resume){
            $this->model_candidate->addCandidateResume($candidate_id);
        }

		// Get candidate
		$data['candidate'] = array();
		if($this->candidateArr){
			//Load Image
			if($this->candidateArr->image && file_exists(APPPATH . 'assets/uploads/logo/' . $this->candidateArr->image)){
				$thumb = base_url() . 'application/assets/uploads/logo/' . $this->candidateArr->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

			$data['candidate'] = array(
				'name' => $this->candidateArr->first_name,
				'email' => $this->candidateArr->email,
				'thumb' => $thumb,
				'status' => $this->candidateArr->status,
			);
		}

		$data['user'] = get_user_account($this->user_id);
		$data['profile_progress'] = get_profile_status($this->candidateArr, 'candidate');

        $user_age = get_age($this->candidateArr->dob);   //Get Age form user dob
        
		//Qualifications
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
		$data['qualifications'] = $this->model_jobcategory->getCategories(QUALIFICATION_TYPE);
		$data['industry_types'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE);

        $data['job_types'] = array();
        $job_types = $this->model_jobcategory->getCategories(JOB_TYPE);
        if($job_types){
            foreach($job_types as $jtkey => $job_type){
                //remove permanent job type for candidate who can have age greater than 45
                if(strtolower($job_type->name) == 'permanent'){
                    if($user_age >= 45){
                        unset($job_types[$jtkey]);
                    }
                }
            }
        }

        $data['job_types'] = $job_types;
        $data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE);

		$data['redirect_link'] = base_url() . 'candidate/dashboard';

		$data['months'] = getMonths();
		$data['years'] = getYears();

		$this->load->view('header', $data);
		$this->load->view('candidate/resume_edit');
		$this->load->view('footer');
	}

    public function publish() {
		$json = array();
		$candidate_id = $this->candidateArr->candidate_id;

		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$published = $this->model_candidate->setCandidateResumePublish($candidate_id, 1);
			if($published){
				$json['success'] = true;
				$json['message'] = 'Your resume was published. Now your resume will now be shown to recruiters';
			} else {
				$json['error'] = true;
				$json['message'] = 'Your resume not published!';
			}
		}

		echo json_encode($json);
	}

	protected function validate() {
		//Check if company user is loggedin or not
		$this->user_id = $this->admin->isLogged();
		if(!$this->user_id) {
		    $this->session->set_userdata('jobredirect', array('page' => 'dashboard', 'url' => current_url()));
			redirect(base_url() . 'login');
		} else {
			$this->loadDetails();
		}

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
}
