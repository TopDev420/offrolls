<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {
    private $user_id;
    private $adminArr = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); // Check if admin is loggedin

        $this->lang->load(array('admin/category'));    //Load Language
    }

    public function index(){

        $data = array();
        //Get Page Number
        if($this->uri->segment(3)) {
            $page = (int)$this->uri->segment(3);
        } else {
            $page = 1;
        }

    	$limit = 10;

		$data['logged'] = $this->admin->isLogged(); // User Login
		$data['heading_title'] = 'Jobseeker';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Jobseeker',
			'href' => base_url() . 'admin/jobseeker'
		);

		$data['active_menu'] = 'mnu-company';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$data['candidates'] = array();

		//Filter Data
		$filter_data = array(
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'company_id',
			'order' => 'DESC'
		);
		// Get Company List
		$total_candidates = $this->model_candidate->getTotalCandidates();
		$candidates = $this->model_candidate->getCandidates($filter_data);
		if($candidates){

			foreach($candidates as $candidate) {

				//Load Image
				if($candidate->image && file_exists(APPPATH . 'assets/uploads/logo/' . $candidate->image)){
					$thumb = base_url() . 'application/assets/uploads/logo/' . $candidate->image;
				} else {
					$thumb = base_url() . 'application/assets/uploads/logo/default.png';
				}

				$data['candidates'][] = array(
					'name' => $candidate->first_name . ' ' . $candidate->last_name,
					'email' => $candidate->email,
					'thumb' => $thumb,
					'status' => $candidate->status,
					'edit' => base_url() . 'admin/candidate/view/' . $candidate->candidate_id,
				);
			}
		}


		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/jobseeker/';
		$config['total_rows'] = $total_candidates;
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['prev_link'] = false;
		$config['next_link'] = false;
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		//Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        $data['no_fw'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/candidate/list');
		$this->load->view('footer');
	}

	public function view(){
        if($this->uri->segment(4)){
            $candidate_id = (int)$this->uri->segment(4);
        } else {
            $candidate_id = 0;
        }

		$data = array();
		$data['candidate_id'] = $candidate_id;
		$data['logged'] = $this->admin->isLogged(); // User Login
		$data['heading_title'] = 'Jobseeker View';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Jobseeker',
			'href' => base_url() . 'admin/candidate'
		);
		$data['breadcrumb'][] = array(
			'name' => 'View',
			'href' => base_url() . 'admin/candidate/view/'. $candidate_id
		);

        $data['breadcrumb_actions'][] = array(
        	'name' => 'Back',
            'icon' => 'fas fa-angle-double-left',
			'href' => base_url() . 'admin/candidate'
		);

		$data['active_menu'] = 'mnu-company';

		//Get Admin Detail
		$data['admin'] = array();
		$admin = $this->model_user->getUser($this->admin->getId());
		if($admin){
			//Load Image
			if($admin->image && file_exists(APPPATH . 'assets/uploads/logo/' . $admin->image)){
				$thumb = base_url() . 'application/assets/uploads/logo/' . $admin->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

			$data['admin'] = array(
				'name' => $admin->first_name . ' ' . $admin->last_name,
				'email' => $admin->email,
				'thumb' => $thumb,
				'status' => $admin->status,
			);
		}

		//Get Company Detail
		$profile_progress = 0;
		$data['candidate'] = array();
		$candidate = $this->model_candidate->getCandidateById($candidate_id);
		$posts = array();

		if($candidate){
			$profile_progress = get_profile_status($candidate, 'candidate');

		    $this->load->model('Users_model', 'model_users');   // Load User Model
            $social_profiles = $this->model_users->getSocialProfiles($candidate->user_id);

			
			$this->load->model('company/Jobs_model', 'model_job');
			$candidate_posts = $this->model_job->getJobs($candidate_id, array('status' => 1));
			if($candidate_posts){
				foreach($candidate_posts as $post){
					$posts[] = array(
						'id'=> $post->job_id,
						'title' => $post->title,
						'status' => $post->status
					);
				}
			}
			
		}

		if(isset($candidate->first_name)){
			$data['candidate']['first_name'] = $candidate->first_name;
		} else {
			$data['candidate']['first_name'] = '';
		}

		if(isset($candidate->last_name)){
			$data['candidate']['last_name'] = $candidate->last_name;
		} else {
			$data['candidate']['last_name'] = '';
		}

		if(isset($candidate->image)){
			$candidate_image = $candidate->image;
		} else {
			$candidate_image= '';
		}

		//Load Image
		if($candidate_image && is_readable(APPPATH . 'assets/uploads/logo/' . $candidate_image)){
			$data['candidate']['image'] = $candidate_image;
			$data['candidate']['thumb'] = base_url() . 'application/assets/uploads/logo/' . $candidate_image;
		} else {
			$data['candidate']['thumb'] = base_url() . 'application/assets/uploads/logo/default.png';
			$data['candidate']['image'] = '';
		}

		if(isset($candidate->email)){
			$data['candidate']['email'] = $candidate->email;
		} else {
			$data['candidate']['email'] = '';
		}

		if(isset($candidate->mobile)){
			$data['candidate']['mobile'] = $candidate->mobile;
		} else {
			$data['candidate']['mobile'] = '';
		}

		if(isset($company->about)){
			$data['candidate']['about'] = $company->about;
		} else {
			$data['candidate']['about'] = '';
		}

		if(isset($candidate->address)){
			$data['candidate']['address'] = $candidate->address;
		} else {
			$data['candidate']['address'] = '';
		}

		if(isset($candidate->city)){
			$data['candidate']['city'] = $candidate->city;
		} else {
			$data['candidate']['city'] = '';
		}

		if(isset($candidate->state)){
			$data['candidate']['state'] = $candidate->state;
		} else {
			$data['candidate']['state'] = '';
		}

		if(isset($candidate->country)){
			$data['candidate']['country'] = $candidate->country;
		} else {
			$data['candidate']['country'] = '';
		}

		if(isset($candidate->pin_code)){
			$data['candidate']['pin_code'] = $candidate->pin_code;
		} else {
			$data['candidate']['pin_code'] = '';
		}

		if($profile_progress >= 80){
			$data['candidate']['is_profileCompleted'] = 1;
		} else {
			$data['candidate']['is_profileCompleted'] = 0;
		}

		if(isset($social_profiles['facebook'])){
			$data['candidate']['facebook_profile'] = $social_profiles['facebook'];
		} else {
			$data['candidate']['facebook_profile'] = '';
		}

		if(isset($social_profiles['twitter'])){
			$data['candidate']['twitter_profile'] = $social_profiles['twitter'];
		} else {
			$data['candidate']['twitter_profile'] = '';
		}

		if(isset($social_profiles['instagram'])){
			$data['candidate']['instagram_profile'] = $social_profiles['instagram'];
		} else {
			$data['candidate']['instagram_profile'] = '';
		}

		if(isset($social_profiles['linkedin'])){
			$data['candidate']['linkedin_profile'] = $social_profiles['linkedin'];
		} else {
			$data['candidate']['linkedin_profile'] = '';
		}

		if(isset($candidate->status)){
			$data['candidate']['status'] = $candidate->status;
		} else {
			$data['candidate']['status'] = '';
		}

		// Get candidate
        $data['profile_progress'] = $profile_progress;

		//candidate Categories
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
		$filter_data = array(
			'status' => 1
		);
		$data['candidate_categories'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE, $filter_data);

        $data['no_fw'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/candidate/view');
		$this->load->view('footer');
	}

	protected function loadDetails(){
        $this->load->helper('user'); // Load user helper
        $this->load->model('Users_model', 'model_user');
        $this->load->model('candidate/Candidate_model', 'model_candidate');
    	$this->adminArr = $this->model_user->getUser($this->user_id);
	}

    protected function validate() {
        $this->user_id = $this->admin->isLogged();
    	if(!$this->user_id) {
			redirect(base_url() . 'login');
		} else {
            $this->loadDetails();
        }
	}
}
