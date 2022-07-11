<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
    private $user_id;
    private $adminArr = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); // Check if admin is loggedin
        $this->load->model('Users_model', 'model_users');   // Load Users Model
        $this->load->helper(array('user', 'category', 'freelancer_category'));
        $this->lang->load(array('admin/category'));    //Load Language
    }
    
	public function index(){

		$data = array();
		//Get Page Number
		if($this->uri->segment(4)) {
			$page = (int)$this->uri->segment(4);
		} else {
			$page = 1;
		}

		$limit = 10;

		$data['logged'] = $this->admin->isLogged(); // User Login
		$data['heading_title'] = 'Company';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Company',
			'href' => base_url() . 'admin/company'
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

		$data['companies'] = array();

		//Filter Data
		$filter_data = array(
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'company_id',
			'order' => 'DESC'
		);
		// Get Company List
		$total_companies = $this->model_company->getTotalCompanies();
		$companies = $this->model_company->getCompanies($filter_data);
		if($companies){

			foreach($companies as $company) {

				//Load Image
				if($company->image && file_exists(APPPATH . 'assets/images/company/' . $company->image)){
					$thumb = base_url() . 'application/assets/images/company/' . $company->image;
				} else {
					$thumb = base_url() . 'application/assets/images/company/default.png';
				}

				$data['companies'][] = array(
					'name' => $company->company_name? $company->company_name : '-',
					'email' => $company->email,
					'thumb' => $thumb,
					'status' => $company->status,
					'edit' => base_url() . 'admin/company/view/' . $company->company_id,
				);
			}
		}


		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/company/company/';
		$config['total_rows'] = $total_companies;
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
		$this->load->view('admin/company/list');
		$this->load->view('footer');
	}

	public function view($company_id){
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Category Model

		$data = array();
		$data['logged'] = $this->admin->isLogged(); // User Login
		$data['heading_title'] = 'Company View';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Company',
			'href' => base_url() . 'admin/company'
		);
		$data['breadcrumb'][] = array(
			'name' => 'View',
			'href' => base_url() . 'admin/company/'. $company_id
		);

        $data['breadcrumb_actions'][] = array(
        	'name' => 'Back',
            'icon' => 'fas fa-angle-double-left',
			'href' => base_url() . 'admin/company'
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
		$data['company'] = array();
		$posts = array();
		$company = $this->model_company->getCompanyById($company_id);
		$profile_progress=0;
		if($company){

			$profile_progress = get_profile_status($company, 'company');

            $company_categoryz = $this->model_jobcategory->getCategory($company->company_category); // Get Company Category

            $company_category = array(
                'label' => isset($company_categoryz->name) ? $company_categoryz->name : '',
                'value' => isset($company_categoryz->category_id) ?$company_categoryz->category_id : '',
            );

            $social_profiles = $this->model_users->getSocialProfiles($company->user_id);

			$this->load->model('company/Jobs_model', 'model_job');
			$candidate_posts = $this->model_job->getJobs($company_id, array('status' => 1));
			if($candidate_posts){
				foreach($candidate_posts as $post){
					$posts[] = array(
						'id'=> $post->job_id,
						'title' => $post->title,
						'status' => $post->status
					);
				}
			}
			//Load Image
			if($admin->image && file_exists(APPPATH . 'assets/images/company/' . $admin->image)){
				$thumb = base_url() . 'application/assets/images/company/' . $admin->image;
			} else {
				$thumb = base_url() . 'application/assets/images/company/default.png';
			}

			$data['company'] = array(
				'thumb' => $thumb,
				'name' => $company->first_name . ' ' . $company->last_name,
				'email' => $company->email,
				'mobile' => $company->mobile,
				'posts' => $posts
			);
		}

		$data['company']['posts'] = $posts;

        if(isset($company->first_name)){
    		$data['company']['first_name'] = $company->first_name;
		} else {
			$data['company']['first_name'] = '';
		}

        if(isset($company->last_name)){
    		$data['company']['last_name'] = $company->last_name;
		} else {
			$data['company']['last_name'] = '';
		}

		if(isset($company->company_name)){
			$data['company']['name'] = $company->company_name;
		} else {
			$data['company']['name'] = '';
		}

		if(isset($company->image)){
			$company_image = $company->image;
		} else {
			$company_image= '';
		}

		//Load Image
		if($company_image && is_readable(APPPATH . 'assets/uploads/logo/' . $company_image)){
			$data['company']['image'] = $company_image;
			$data['company']['thumb'] = base_url() . 'application/assets/uploads/logo/' . $company_image;
		} else {
			$data['company']['thumb'] = base_url() . 'application/assets/uploads/logo/default.png';
			$data['company']['image'] = '';
		}

		if(isset($company_category)){
			$data['company']['company_category'] = $company_category;
		} else {
			$data['company']['company_category'] = array();
		}

		if(isset($company->email)){
			$data['company']['email'] = $company->email;
		} else {
			$data['company']['email'] = '';
		}

		if(isset($company->mobile)){
			$data['company']['mobile'] = $company->mobile;
		} else {
			$data['company']['mobile'] = '';
		}

		if(isset($company->landline)){
			$data['company']['landline'] = $company->landline;
		} else {
			$data['company']['landline'] = '';
		}

		if(isset($company->web_link)){
			$data['company']['web_link'] = $company->web_link;
		} else {
			$data['company']['web_link'] = '';
		}

		if(isset($company->about)){
			$data['company']['about'] = $company->about;
		} else {
			$data['company']['about'] = '';
		}

		if(isset($company->gst_no)){
			$data['company']['gst_no'] = $company->gst_no;
		} else {
			$data['company']['gst_no'] = '';
		}

		if(isset($company->pan_no)){
			$data['company']['pan_no'] = $company->pan_no;
		} else {
			$data['company']['pan_no'] = '';
		}

		if(isset($company->address)){
			$data['company']['address'] = $company->address;
		} else {
			$data['company']['address'] = '';
		}

		if(isset($company->city)){
			$data['company']['city'] = $company->city;
		} else {
			$data['company']['city'] = '';
		}

		if(isset($company->state)){
			$data['company']['state'] = $company->state;
		} else {
			$data['company']['state'] = '';
		}

		if(isset($company->country)){
			$data['company']['country'] = $company->country;
		} else {
			$data['company']['country'] = '';
		}

		if(isset($company->pin_code)){
			$data['company']['pin_code'] = $company->pin_code;
		} else {
			$data['company']['pin_code'] = '';
		}

		if($profile_progress >= 80){
			$data['company']['is_profileCompleted'] = 1;
		} else {
			$data['company']['is_profileCompleted'] = 0;
		}

		if(isset($social_profiles['facebook'])){
			$data['company']['facebook_profile'] = $social_profiles['facebook'];
		} else {
			$data['company']['facebook_profile'] = '';
		}

		if(isset($social_profiles['instagram'])){
			$data['company']['instagram_profile'] = $social_profiles['instagram'];
		} else {
			$data['company']['instagram_profile'] = '';
		}

		if(isset($social_profiles['linkedin'])){
			$data['company']['linkedin_profile'] = $social_profiles['linkedin'];
		} else {
			$data['company']['linkedin_profile'] = '';
		}

		if(isset($company->status)){
			$data['company']['status'] = $company->status;
		} else {
			$data['company']['status'] = '';
		}

        $data['no_fw'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/company/view');
		$this->load->view('footer');
	}

	protected function loadDetails(){
        $this->load->helper('user'); // Load user helper
        $this->load->model('Users_model', 'model_user');
        $this->load->model('company/Company_model', 'model_company');
    	$this->adminArr = $this->model_user->getUser($this->user_id);
	}

    protected function validate() {
        $this->user_id = $this->admin->isLogged();
    	if(!$this->user_id) {
			redirect(base_url() . 'admin/login');
		} else {
            $this->loadDetails();
        }
	}
}
