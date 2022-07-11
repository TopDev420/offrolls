<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobprofile extends CI_Controller {
    private $page_name = 'resume';
    private $freelancerArr = array();
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('freelancer');
        $this->validate();
    }

    public function index(){

        $data = array();
        $this->load->helper('category');
        $data['logged'] = true;

        $data['moduleAction'] = 'freelancer';

        // Add Css
        $this->document->addStyle(base_url(). 'application/assets/css/include/dashboard.css');

        $data['heading_title'] = 'Edit Resume';    //Heading Title
        $data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
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


        $freelancer_id = $this->freelancerArr->freelancer_id;
        //Check freelancer Resumes
        $freelancer_resume = $this->model_freelancer->getFreelancerResume($freelancer_id);
        if(!$freelancer_resume){
            $this->model_freelancer->addFreelancerResume($freelancer_id);
        }

		// Get freelancer
		$data['freelancer'] = array();
		if($this->freelancerArr){
			$data['freelancer'] = array(
				'status' => $this->freelancerArr->status,
			);
		}

		$data['user'] = get_user_account($this->user_id);
		$profile_progress = get_profile_status($this->freelancerArr, 'freelancer');
        
        if(isset($this->freelancerArr->first_name)){
            $data['freelancer']['first_name'] = $this->freelancerArr->first_name;
		} else {
			$data['freelancer']['first_name'] = '';
		}
        
        if(isset($this->freelancerArr->last_name)){
            $data['freelancer']['last_name'] = $this->freelancerArr->last_name;
		} else {
			$data['freelancer']['last_name'] = '';
		}
        
        if(isset($this->freelancerArr->image)){
    		$freelancer_image = $this->freelancerArr->image;
		} else {
			$freelancer_image= '';
		}

        if($freelancer_image && is_readable(APPPATH . 'assets/uploads/logo/' . $freelancer_image)){
    		$data['freelancer']['image'] = $freelancer_image;
			$data['freelancer']['thumb'] = base_url() . 'application/assets/uploads/logo/' . $freelancer_image;
		} else {
			$data['freelancer']['thumb'] = base_url() . 'application/assets/uploads/logo/default.png';
			$data['freelancer']['image'] = '';
		}

        if($profile_progress >= 80){
    		$data['freelancer']['is_profileCompleted'] = 1;
		} else {
			$data['freelancer']['is_profileCompleted'] = 0;
		}
        $data['profile_progress'] = get_profile_status($this->freelancerArr, 'freelancer');
        
        if(isset($this->freelancerArr->email)){
        	$data['freelancer']['email'] = $this->freelancerArr->email;
		} else {
			$data['freelancer']['email'] = '';
		}
        
        if(isset($this->freelancerArr->mobile)){
    		$data['freelancer']['mobile'] = $this->freelancerArr->mobile;
		} else {
			$data['freelancer']['mobile'] = '';
		}

		if(isset($this->freelancerArr->city)){
			$data['freelancer']['city'] = $this->freelancerArr->city;
		} else {
			$data['freelancer']['city'] = '';
		}


		//Qualifications
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
		$data['qualifications'] = $this->model_jobcategory->getCategories(QUALIFICATION_TYPE);
		$data['industry_types'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE);
        $data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE);

		$data['redirect_link'] = base_url() . 'freelancer/dashboard';

		$data['months'] = getMonths();
		$data['years'] = getYears();

		$this->load->view('header', $data);
		$this->load->view('freelancer/jobprofile');
		$this->load->view('footer');
	}

    public function publish() {
		$json = array();
		$freelancer_id = $this->freelancer->getId();

		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$published = $this->model_freelancer->setFreelancerResumePublish($freelancer_id, 1);
			if($published){
				$json['success'] = true;
				$json['message'] = 'Your profile was published. Now you will receive notifications related your profile';
			} else {
				$json['error'] = true;
				$json['message'] = 'Your profile not published!';
			}
		}

		echo json_encode($json);
	}

	protected function validate() {
		//Check if company user is loggedin or not
		$this->user_id = $this->freelancer->isLogged();
		if(!$this->user_id) {
		    $this->session->set_userdata('jobredirect', array('page' => 'dashboard', 'url' => current_url()));
			redirect(base_url() . 'login');
		} else {
			$this->loadDetails();
		}

		$profile_status = $this->getProfileStatus('freelancer');
		if(!$profile_status){
			$this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
			redirect(base_url() . 'freelancer/profile?redirect='. $this->page_name);
		}
	}

	protected function loadDetails(){
		$this->load->helper('user'); // Load user helper
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');   //Load company model
		$this->freelancerArr = $this->model_freelancer->getFreelancer($this->user_id);

	}

	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type){
		if($this->user_id){
			$profile_progress = get_profile_status($this->freelancerArr, $type);
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
