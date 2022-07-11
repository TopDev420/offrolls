<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancer extends CI_Controller {
    private $user_id;
    private $adminArr = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); // Check if admin is loggedin
        $this->load->helper(array('user', 'category', 'freelancer_category'));
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
		$data['heading_title'] = 'Freelancer';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Freelancer',
			'href' => base_url() . 'admin/freelancer'
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

		$data['freelancers'] = array();

		//Filter Data
		$filter_data = array(
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'freelancer_id',
			'order' => 'DESC'
		);
		// Get Company List
		$total_freelancers = $this->model_freelancer->getTotalFreelancers();
		$freelancers = $this->model_freelancer->getFreelancers($filter_data);

		if($freelancers){

			foreach($freelancers as $freelancer) {

				//Load Image
				if($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)){
					$thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
				} else {
					$thumb = base_url() . 'application/assets/uploads/logo/default.png';
				}

				$data['freelancers'][] = array(
					'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
					'email' => $freelancer->email,
					'thumb' => $thumb,
					'status' => $freelancer->status,
					'edit' => base_url() . 'admin/freelancer/view/' . $freelancer->freelancer_id,
				);
			}
		}


		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/freelancer/';
		$config['total_rows'] = $total_freelancers;
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
		$this->load->view('admin/freelancer/list');
		$this->load->view('footer');
	}

	public function view(){

        if($this->uri->segment(4)){
            $freelancer_id = (int)$this->uri->segment(4);
        } else {
            $freelancer_id = 0;
        }

		$data = array();
		$data['freelancer_id'] = $freelancer_id;
		$data['logged'] = $this->admin->isLogged(); // User Login
		$data['heading_title'] = 'Freelancer View';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Freelancer',
			'href' => base_url() . 'admin/freelancer'
		);
		$data['breadcrumb'][] = array(
			'name' => 'View',
			'href' => base_url() . 'admin/freelancer/view/'. $freelancer_id
		);

        $data['breadcrumb_actions'][] = array(
        	'name' => 'Back',
            'icon' => 'fas fa-angle-double-left',
			'href' => base_url() . 'admin/freelancer'
		);

		$data['active_menu'] = 'mnu-freelancer';

		//Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

		//Get Company Detail
		$data['freelancer'] = array();
		$posts = array();
		$freelancer = $this->model_freelancer->getFreelancerById($freelancer_id);

		if($freelancer){
			$profile_progress = get_profile_status($freelancer, 'freelancer');

		    $this->load->model('Users_model', 'model_users');   // Load User Model
            $social_profiles = $this->model_users->getSocialProfiles($freelancer->user_id);

			$this->load->model('freelancer/Jobs_model', 'model_job');
			$candidate_posts = $this->model_job->getJobs($freelancer_id, array('status' => 1));
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

		$data['freelancer']['posts'] = $posts;

		if(isset($freelancer->first_name)){
			$data['freelancer']['first_name'] = $freelancer->first_name;
		} else {
			$data['freelancer']['first_name'] = '';
		}

		if(isset($freelancer->last_name)){
			$data['freelancer']['last_name'] = $freelancer->last_name;
		} else {
			$data['freelancer']['last_name'] = '';
		}

		if(isset($freelancer->image)){
			$freelancer_image = $freelancer->image;
		} else {
			$freelancer_image= '';
		}

		//Load Image
		if($freelancer_image && is_readable(APPPATH . 'assets/uploads/logo/' . $freelancer_image)){
			$data['freelancer']['image'] = $freelancer_image;
			$data['freelancer']['thumb'] = base_url() . 'application/assets/uploads/logo/' . $freelancer_image;
		} else {
			$data['freelancer']['thumb'] = base_url() . 'application/assets/uploads/logo/default.png';
			$data['freelancer']['image'] = '';
		}

		if(isset($freelancer->email)){
			$data['freelancer']['email'] = $freelancer->email;
		} else {
			$data['freelancer']['email'] = '';
		}

		if(isset($freelancer->mobile)){
			$data['freelancer']['mobile'] = $freelancer->mobile;
		} else {
			$data['freelancer']['mobile'] = '';
		}

		if(isset($company->about)){
			$data['freelancer']['about'] = $company->about;
		} else {
			$data['freelancer']['about'] = '';
		}

		if(isset($freelancer->address)){
			$data['freelancer']['address'] = $freelancer->address;
		} else {
			$data['freelancer']['address'] = '';
		}

		if(isset($freelancer->city)){
			$data['freelancer']['city'] = $freelancer->city;
		} else {
			$data['freelancer']['city'] = '';
		}

		if(isset($freelancer->state)){
			$data['freelancer']['state'] = $freelancer->state;
		} else {
			$data['freelancer']['state'] = '';
		}

		if(isset($freelancer->country)){
			$data['freelancer']['country'] = $freelancer->country;
		} else {
			$data['freelancer']['country'] = '';
		}

		if(isset($freelancer->pin_code)){
			$data['freelancer']['pin_code'] = $freelancer->pin_code;
		} else {
			$data['freelancer']['pin_code'] = '';
		}

		if($profile_progress >= 80){
			$data['freelancer']['is_profileCompleted'] = 1;
            $data['freelancer']['is_published'] = $freelancer->is_published;
		} else {
			$data['freelancer']['is_profileCompleted'] = 0;
            $data['freelancer']['is_published'] = 0;
		}

		if(isset($freelancer->status)){
			$data['freelancer']['status'] = $freelancer->status;
		} else {
			$data['freelancer']['status'] = '';
		}

		$data['profile_progress'] = $profile_progress;

        $data['no_fw'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/freelancer/view');
		$this->load->view('footer');
	}

	protected function loadDetails(){
        $this->load->helper('user'); // Load user helper
        $this->load->model('Users_model', 'model_user');
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');
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
