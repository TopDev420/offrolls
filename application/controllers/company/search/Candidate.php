<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {
    private $page_name = 'candidates';
    private $user_id;
    private $company = array();
    private $menu_section='candidates';

    public function __construct(){
        parent::__construct();
        $this->load->library('recruiter');
        $this->validate();
    }

    public function index(){
        $data = array();

        //Get Page Number
        if($this->uri->segment(3)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['logged'] = true;


        $data['heading_title'] = 'Company List';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
    		'href' => base_url()
		);
		$data['breadcrumb'][] = array(
			'name' => 'Search Candidate',
			'href' => base_url() . 'search/candidate'
		);

        if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

		$data['candidates'] = array();
		//Filter Data
    	$filter_data = array(
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'user_id',
			'order' => 'DESC'
		);
		// Get Company List
		$total_candidates = $this->model_candidate->getTotalCandidates($filter_data);
		$candidates = $this->model_candidate->getCandidates($filter_data);

		if($candidates){

			foreach ($candidates as $candidate) {
				$candidate_resume = $this->model_candidate->getCandidateResume($candidate->user_id);
				//Load Image
				if($candidate->image && file_exists(APPPATH . 'assets/uploads/logo/' . $candidate->image)){
					$thumb = base_url() . 'application/assets/uploads/logo/' . $candidate->image;
				} else {
					$thumb = base_url() . 'application/assets/uploads/logo/default.png';
				}

				$data['candidates'][] = array(
					'candidate_id' => $candidate->user_id,
					'name' => $candidate->first_name . ' ' .$candidate->last_name,
					'thumb' => $thumb,
					'city' => $candidate->city,
					'address' => '',
					'resume_link' => $candidate_resume ? base_url() . 'company/search/candidate/resume/'.$candidate->user_id : ''
				);
			}

		}

        // Get candidate
		$data['company'] = array();
		$company = $this->company;

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'search/candidates/index/';
		$config['total_rows'] = $total_candidates;
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['attributes'] = array('class' => 'page-numbers');

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$data['redirect_link'] = base_url() . 'candidate/dashboard';

		$this->load->view('header', $data);
		$this->load->view('company/search/candidate');
		$this->load->view('footer');
	}

	public function resume($candidate_id=0) {
		if(!$candidate_id){
			redirect(base_url() . 'company/search/candidate');
		}

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

		$data = array();

		$logged = $this->recruiter->isLogged();
        if($logged){
        	$data['logged'] = $logged;
        } else {
        	$data['logged'] = false;
        }

        $data['heading_title'] = 'Candidate Search';    //Heading Title
    	$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url()
		);
		$data['breadcrumb'][] = array(
			'name' => 'Search Candidate',
			'href' => base_url() . 'search/candidate'
		);

		$this->load->model('candidate/Education_model', 'model_candidate_education');
		$this->load->model('candidate/Experience_model', 'model_candidate_experience');
		$this->load->model('candidate/Project_model', 'model_candidate_project');
		$this->load->model('candidate/Certification_model', 'model_candidate_certification');

		$data['candidate'] = array();

		$candidate = $this->model_candidate->getCandidateById($candidate_id);
		if($candidate){
			$this->load->model('admin/Category_model', 'model_category');

			$education = $this->model_candidate_education->getEducations($candidate_id);
			$project = $this->model_candidate_project->getProjects($candidate_id);
			$experience = $this->model_candidate_experience->getExperiences($candidate_id);
			$certification = $this->model_candidate_certification->getCertifications($candidate_id);

			if($candidate->image){
				$thumb = base_url() . 'application/assets/images/candidate/' . $candidate->image;
			} else {
				$thumb = base_url() . 'application/assets/images/candidate/default.png';
			}

			if($candidate->resume){
				$resume_download = base_url() . 'application/images/candidate/resume/'. $candidate->resume;
			} else {
				$resume_download = false;
			}

			$skills = array();
			if($candidate->skills){

				$skill_details = json_decode($candidate->skills);
				if($skill_details){
					foreach ($skill_details as $skill_detail) {
						$skill = $this->model_category->getCategory($skill_detail);
						if($skill){
							$skills[] = array(
								'id' => $skill->category_id,
								'name' => $skill->name
							);
						}
					}
				}
			}

			$personal_details = array(
				'father_name' => $candidate->father_name,
				'mother_name' => $candidate->mother_name,
				'dob' => $candidate->dob,
				'gender' => $candidate->gender,
				'nationality' => $candidate->nationality,
				'address' => $candidate->address,
			);

			$data['candidate'] = array(
				'candidate_id' => $candidate->candidate_id,
				'name' => $candidate->first_name . ' ' . $candidate->last_name,
                'email' => $candidate->email,
				'resume' => array('name' => $candidate->resume, 'download' => $resume_download),
				'thumb' => $thumb,
				'about' => $candidate->about,
				'skills' => $skills,
				'education' => $education,
				'project' => $project,
				'experience' => $experience,
				'certification' => $certification,
				'personal_details' => $personal_details,
			);
		}

		$this->load->view('header', $data);
		$this->load->view('company/search/candidate_resume');
		$this->load->view('footer');
	}

    protected function validate() {
        //Check if company user is loggedin or not
        $this->user_id = $this->recruiter->isLogged();
        if(!$this->user_id) {
            redirect(base_url() . 'login');
        } else {
            $this->loadDetails();
        }

        $profile_status = $this->getProfileStatus('company');
        if(!$profile_status){
            $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
            redirect(base_url() . 'company/profile?redirect='. $this->page_name);
        }
    }

    protected function loadDetails(){
        $this->load->helper('user'); // Load user helper
        $this->load->model('company/Company_model', 'model_company');   // Load Company Model
        $this->load->model('candidate/Candidate_model', 'model_candidate'); // Load Candidate Model
        $this->company = $this->model_company->getCompany($this->user_id);
    }


    //Check profile status. If it is below 80, redirect to profile page. Otherwise return status
    protected function getProfileStatus($type){
        if($this->user_id){
            $this->company = $this->model_company->getCompany($this->user_id);
            $profile_progress = get_profile_status($this->company, $type);
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
