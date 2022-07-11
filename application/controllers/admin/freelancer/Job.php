<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
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
        $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');

        $data = array();
        //Get Page Number
        if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['logged'] = $this->admin->isLogged(); // User Login
        $data['heading_title'] = 'Projects';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'admin/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Freelancer Projects',
            'href' => base_url() . 'admin/freelancer/job'
        );
        
        $data['active_menu'] = 'mnu-freelancer-job';

        if($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

		$data['jobs'] = array();

		//Filter Data
		$filter_data = array(
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'j.job_id',
			'order' => 'DESC'
		);
		// Get Company List
		$total_jobs = $this->model_freelancer_job->getTotalJobs();
		$jobs = $this->model_freelancer_job->getJobs($filter_data);

		if($jobs){

			foreach($jobs as $job) {

				//Load Image
				if($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)){
					$thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
				} else {
					$thumb = base_url() . 'application/assets/uploads/logo/default.png';
				}

				$data['jobs'][] = array(
					'title' => $job->title,
					'company_name' => $job->company_name,
                    'company_logo' => $thumb,
					'post_date' => $job->date_modified ? $job->date_modified : $job->date_added,
                    'status' => $job->status,
					'view' => base_url() . 'admin/freelancer/job/view/' . $job->job_id,
				);
			}
		}


		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/freelancer/job/';
		$config['total_rows'] = $total_jobs;
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
		$this->load->view('admin/freelancer/job_list');
		$this->load->view('footer');
	}

    public function view() {
        $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model

        $this->load->helper('date');

        $data = array();
        //Get Page Number
        if($this->uri->segment(5)) {
            $job_id = (int)$this->uri->segment(5);
        } else {
            $job_id = 1;
        }

        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

        $data['logged'] = $this->admin->isLogged(); // User Login
        $data['heading_title'] = 'Projects';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
        	'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Freelancer Projects',
			'href' => base_url() . 'admin/freelancer/job'
		);

        $data['breadcrumb'][] = array(
    		'name' => 'View',
			'href' => base_url() . 'admin/freelancer/job/view/' . $job_id
		);

		$data['active_menu'] = 'mnu-freelancer-job';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

        //Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        $data['job'] = array();
        $job = $this->model_freelancer_job->getJob($job_id);
        if($job) {

                //$freelancer_job = $this->model_freelancer_job->getRecentFreelancerJob($freelancer->freelancer_id, $job->job_id);
                $job_category = $this->model_jobcategory->getCategory($job->job_category);  // Company Category
    		    $job_specialization = $this->model_jobcategory->getCategory($job->job_specialization, array('child' => 1));  // Job Category

                $total_applied_freelancers = $this->model_freelancer_job->getTotalFreelancerJobsByJID($job->job_id, array('applied' => 1));

                $jobexperience = array();
                if($job->experience_level == 'experienced'){
                    $jobexperience = $this->model_jobcategory->getCategory($job->experience);  // Experience
                }
                //Load Image
                if($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)){
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default.png';
                }

                $is_accepted = isset($freelancer_job->cj_isAccepted) ? $freelancer_job->cj_isAccepted : 0;
                $is_applied = isset($freelancer_job->cj_isApplied) ? $freelancer_job->cj_isApplied : 0;
                $is_saved = isset($freelancer_job->cj_isSaved) ? $freelancer_job->cj_isSaved : 0;


                //Get Job Skills
                $job_skills = array();
                $skills = $job->skills ? json_decode($job->skills) : array();
                if($skills){
                    foreach($skills as $skill){
                        $skillz = $this->model_jobcategory->getCategory($skill);
                        if($skillz){
                            $job_skills[] = $skillz->name;
                        }
                    }
                }

                $job_languages = array();
                $languages = isset($job->languages) ? json_decode($job->languages): array();
                if($languages) {
                    foreach($languages as $language_id) {
                        $job_language = $this->model_jobcategory->getLanguage($language_id);  // Experience
                        if($job_language) {
                            $job_languages[] = $job_language['name'];
                        }
                    }
                }

                if($job->date_modified && $job->date_modified != '0000-00-00 00:00:00') {
                    $post_date = $job->date_modified;
                } else {
                    $post_date = $job->date_added;
                }

            $data['job'] = array(
                'job_id' => $job->job_id,
                'company_name' => $job->company_name,
                'title' => $job->title,
                'thumb' => $thumb,
                'pay_type' => get_pay_type($job->pay_type),
                'pay_amount' => format_currency($job->pay_amount),
                'job_duration' => get_project_duration($job->job_duration),
                'accepted' => $is_accepted,
                'is_applied' => $is_applied,
                'is_saved' => $is_saved,
                'location' => $job->location,
                'description' => $job->description,
                'experience_level' => ucfirst($job->experience_level),
                'experience' => isset($jobexperience->name) ? $jobexperience->name : '',
                'job_skills' => $job_skills,
                'job_duration' => get_project_duration($job->job_duration),
    			'job_category' => isset($job_category->name) ? $job_category->name : '' ,
				'job_specialization' => isset($job_specialization->name) ? $job_specialization->name : '',
                'project_type' => get_project_type($job->project_type),
				'job_type' => get_project_type($job->job_type),
				'languages' => $job_languages,
                'status' => $job->status,
                'applied_freelancers' => $total_applied_freelancers,
                'view_job' => base_url() . 'freelancer/search/job/' . $job->job_id,
                'post_date' => timespan(strtotime($post_date), now(), 1) . ' ago'
            );
        }

        $data['no_fw'] = true;
    	$this->load->view('header', $data);
		$this->load->view('admin/freelancer/job_view');
		$this->load->view('footer');
    }

    //Accept
    public function accepted(){
        $this->load->model('company/Freelancer_jobs_model', 'model_company_freelancer_job');    //Company Freelancer Jobs
		$json = array();

        if($this->uri->segment(5)) {
            $job_id = (int)$this->uri->segment(5);
        } else {
            $job_id = 0;
        }

		if($this->input->server('REQUEST_METHOD') == 'POST'){
            $freelancers = array(
                'list' => array(),
                'pagination' => ''
            );
            $job = array();
    		// Get Job
            $job = $this->model_company_freelancer_job->getJob($job_id);
            if($job) {
                //Filter Data
                $filter_data = array(
                	'applied' => 1,
            		'accepted' => 1,
        			'sort' => 'cj.freelancer_job_id',
        			'order' => 'DESC'
        		);

                $freelancer_jobs = $this->model_company_freelancer_job->getFreelancerJobsByCJ($job->company_id, $job->job_id, $filter_data);
                if($freelancer_jobs) {

                    foreach($freelancer_jobs as $freelancer_job) {
                        $freelancer = $this->model_freelancer->getFreelancerById($freelancer_job->freelancer_id);
                        $freelancer_name = isset($freelancer->first_name) ? ($freelancer->first_name . ' ' . $freelancer->last_name) : '';
                        $freelancer_image = isset($freelancer->image) ? $freelancer->image : '';
                        //Load Image
                        if($freelancer_image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer_image)){
                            $freelancer_thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer_image;
                        } else {
                            $freelancer_thumb = base_url() . 'application/assets/uploads/logo/default.png';
                        }

                        $freelancers['list'][] = array(
                            'freelancer_name' => $freelancer_name,
                            'freelancer_image' => $freelancer_thumb,
                            'bid_amount' => format_currency($freelancer_job->cj_amount),
                            'bid_proposal' => $freelancer_job->cj_proposal,
                            'view' => base_url() . 'admin/freelancer/profile/' . $freelancer_job->freelancer_id,
                            'milestone' => base_url() . 'admin/freelancer/jobmilestone/' . $freelancer_job->freelancer_job_id
                        );
                    }
                } else {
                    $json['message'] = 'No Freelaners';
                }

                $json['success'] = true;
                $json['freelancers'] = $freelancers;
            } else {
                $json['success'] = true;
                $json['message'] = 'No Freelaners';
                $json['freelancers'] = $freelancers;
            }

		}

		echo json_encode($json);
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
			redirect(base_url() . 'admin/login');
		} else {
            $this->loadDetails();
        }
	}
}
