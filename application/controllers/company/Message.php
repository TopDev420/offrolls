<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {
	private $page_name = 'message';
	private $user_id;
    private $company = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('recruiter');
        $this->validate();
    }

    public function index(){
        $data = array();
        
        $data['logged'] = true;
        $data['heading_title'] = 'Message';    //Heading Title
    	$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'company/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Message',
			'href' => base_url() . 'company/message'
		);
		$data['active_menu'] = 'mnu-message';

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
        
        $data['moduleAction'] = 'company';
        
		$this->load->view('header', $data);
		$this->load->view('company/message');
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
