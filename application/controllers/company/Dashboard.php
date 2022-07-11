<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $page_name = 'dashboard';
    private $user_id;
    private $company = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('recruiter');
        $this->validate();
    }

    public function index(){

        $data = array();
        $this->load->model('company/Dashboard_model', 'model_dashboard'); // Load dashboard model
        $data['profile_progress'] = 20;

        $data['logged'] = true;

        //add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

        $data['heading_title'] = 'Dashboard';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
    		'href' => base_url() . 'company/dashboard'
		);
		$data['active_menu'] = 'mnu-dashboard';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$this->load->model('company/Jobs_model', 'model_job'); //Load company jobs model
		$this->load->model('company/Freelancer_jobs_model', 'model_project'); //Load company jobs model

		// Get Company
        $data['user'] = get_user_account($this->user_id);
        if($data['user']){
        	$data['user']['company_name'] = $this->company->company_name;
        }        

        $data['profile_link'] = base_url(). 'company/profile';
        $data['profile_progress'] = get_profile_status($this->company, 'company');
        $data['loadRecentJobs'] = base_url(). 'company/jobs/candidate/getRecentJobs';
        $data['loadRecentProjects'] = base_url(). 'company/jobs/freelancer/getRecentJobs';

        $data['total_jobs'] = $this->model_job->getTotalJobs($this->company->company_id, array('status' => 1));
        $data['total_projects'] = $this->model_project->getTotalJobs($this->company->company_id, array('status' => 1));

        $data['postProject'] = base_url(). 'company/jobs/freelancer/post/add';
        $data['postJob'] = base_url(). 'company/jobs/candidate/post/add';

		//Get Page Number
		  if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }
		
		//pagination
		$limit = 10;
		$nextPage = ($limit * $page) < $data['total_projects'] ? $page + 1 : false;
        if($nextPage && $data['total_projects']){
            $json['projects']['view_more'] = array(
                'page' => $nextPage,
                'href' => base_url() . 'company/dashboard' . $nextPage
            );
        }
        

        //Sidebar Filter Datas
        $this->load->helper('jobcategories');
        $data['categories'] = loadJobCategories($type='job');

        $data['moduleAction'] = 'company';
        $data['loadActiveJobs'] = base_url() . 'company/jobs/candidate/activeJobs';
        $data['loadInactiveJobs'] = base_url() . 'company/jobs/candidate/inactiveJobs';

        $data['loadActiveProjects'] = base_url() . 'company/jobs/freelancer/activeJobs';
        // $data['loadInactiveJobs'] = base_url() . 'company/jobs/freelancer/inactiveJobs';

		$this->load->view('header', $data);
		$this->load->view('company/dashboard');
		$this->load->view('footer');
	}

	protected function validate() {
		//Check if company user is loggedin or not
		$this->user_id = $this->recruiter->isLogged();
		if(!$this->user_id) {
		    $this->session->set_userdata('jobredirect', array('page' => 'dashboard', 'url' => current_url()));
			redirect(base_url() . 'login');
		} else {
			$this->loadDetails();
		}

		$profile_status = $this->getProfileStatus('company');
		if(!$profile_status){
			$this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
			redirect(base_url() . 'company/profile?redirect='. $this->page_name);
		}

		// Check commission agree
		if(!$this->company->isCommissionAgreed){
			$this->document->addAlert('commission', 'info');
		}
	}

	protected function loadDetails(){
		$this->load->helper('user'); // Load user helper
        $this->load->model('company/Company_model', 'model_company');   //Load company model
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
