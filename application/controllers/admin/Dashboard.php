<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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

        $this->load->model('company/Company_model', 'model_company');
        $this->load->model('candidate/Candidate_model', 'model_candidate');
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');

        $data['logged'] = $this->admin->isLogged();
    	$data['heading_title'] = 'Dashboard';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Dashboard',
			'href' => base_url() . 'admin/dashboard'
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

		//Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        $this->load->model('candidate/Jobs_model', 'model_candidate_job');
        $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');
        $data['total_jobs'] = $this->model_candidate_job->getTotalJobs();
        $data['total_projects'] = $this->model_freelancer_job->getTotalJobs();
        $data['total_companies'] = $this->model_company->getTotalCompanies();
        $data['total_freelancers'] = $this->model_freelancer->getTotalFreelancers();
        $data['total_candidates'] = $this->model_candidate->getTotalCandidates();

        $data['no_fw'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/dashboard');
		$this->load->view('footer');
	}

	protected function loadDetails(){
        $this->load->helper('user'); // Load user helper
        $this->load->model('Users_model', 'model_user');
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
