<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Users');
        $this->load->helper('user');
    }

    public function index(){
        $this->load->helper('category');

    	$data = array();

		$logged = $this->users->isLogged();
		$user_id = $logged;
		if($logged){
            $data['logged'] = true;
			// $user_type = $this->users->getUserType();
			// $redirect_url = getModuleActionURL($user_type);
			// redirect($redirect_url);
		} else {
            $data['logged'] = false;
        }

        $data['moduleAction'] = 'freelancer';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$data['login'] = base_url() . 'login';
		$data['register'] = base_url() . 'register';

        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
        $this->load->model('freelancer/Jobs_model', 'model_job');

        $data['recent_jobs'] = array();
        $filter_jdata = array(
            'start' => 0,
            'limit' => 10,
			'status' => 1,
			'sort' => 'job_id',
			'order' => 'DESC'
		);

		$recent_jobs = $this->model_job->getJobs($filter_jdata);

        if($recent_jobs){
    		foreach($recent_jobs as $job){
    		    if($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)){
    				$thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
    			} else {
    				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
    			}

                $job_type = get_job_type($job->job_type);
    			$data['recent_jobs'][] = array(
    				'job_id' => $job->job_id,
    				'company_name' => $job->company_name,
    				'title' => $job->title,
    				'thumb' => $thumb,
    				'location' => $job->location,
    				'job_type' => $job_type ? $job_type : 'Full Time',
    				'view_job' => base_url() . 'candidate/search/job/' . $job->job_id
    			);
    		}
    	}

    	$data['companies'] = array();
    	$this->load->model('company/Company_model', 'model_company');
    	$filter_cdata = array(
            'start' => 0,
            'limit' => 10,
			'status' => 1,
			'sort' => 'user_id',
			'order' => 'DESC'
		);
    	$companies = $this->model_company->getCompanies($filter_cdata);
    	if($companies){
    	    foreach($companies as $company){
    	        $total_jobs = $this->model_job->getTotalJobs(array('company_id' => $company->user_id));
    	        if($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)){
    				$thumb = base_url() . 'application/assets/uploads/logo/' . $company->image;
    			} else {
    				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
    			}
    	        $data['companies'][] = array(
    	            'thumb' => $thumb,
    	            'company_name' => $company->company_name,
    	            'address' => $company->address,
    	            'city' => $company->city,
    	            'state' => $company->state,
    	            'opened_positions' => $total_jobs
    	        );
    	    }
    	}
        
        $data['searchQuery'] = '';
		$data['job_categories'] = $this->model_jobcategory->getCategories(JOB_DEPARTMENT_TYPE, array('status' => 1));

		$data['redirect_link'] = base_url() . 'freelancer/dashboard';

		// print_r($_SESSION);
		$this->load->view('header', $data);
		$this->load->view('candidate/home');
		$this->load->view('footer');
	}
}
