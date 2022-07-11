<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends CI_Controller {
	private $error = array();
	private $page_name = 'pricing';
	private $user_id;
	private $company = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('recruiter');
	}

	public function index(){
		$data = array();
        $this->validate();

        $data['logged'] = true;
    	$data['heading_title'] = 'Pricing';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'company/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Pricing',
			'href' => base_url() . 'company/pricing'
		);
		$data['active_menu'] = 'mnu-pricing';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$data['company'] = $this->company;
		
		$data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');
		
        $data['moduleAction'] = 'company';
        
		$this->load->view('header', $data);
		$this->load->view('company/pricing');
		$this->load->view('footer');
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

	protected function validate($type = '', $commission=false) {
    	//Check if company user is loggedin or not
		$this->user_id = $this->recruiter->isLogged();
		if(!$this->user_id) {
            if($type == 'return'){
                $this->error['warning'] = "Please login to your account";
            } else {
                redirect(base_url() . 'login');
            }
		} else {
			$this->loadDetails();
		}

		$profile_status = $this->getProfileStatus('company');
		if(!$profile_status){
            if($type == 'return'){
                $this->error['warning'] = "Please complete your profile";
            } else {
                $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
    		    redirect(base_url() . 'company/profile?redirect='. $this->page_name);
            }
		}

        // Check commission agree
        if(!$this->company->isCommissionAgreed && $commission){
            if($type == 'return'){
                $this->error['error'] = "Please agree commission policy!";
            } else {
                $this->document->addAlert('commission', 'info');
            } 
        }
        
        if($type == 'return'){
            return !$this->error;
        }
	}

	protected function loadErrors(){
		if(isset($this->error['warning'])){
			return $this->error['warning'];
		} elseif (isset($this->error['error'])) {
			return $this->error['error'];
		} else {
			return '';
		}
	}

	public function agreeCommissionPolicy(){
        $json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return', false)){
			if($this->company->isCommissionAgreed){
	            $json['error'] = true;
	            $json['message'] = "Commission policy has already agreed!";
	        } else {
	        	$update = $this->model_company->updateCommissionPolicy($this->company->company_id);
	        	if($update){
	        		$json['success'] = true;
	            	$json['message'] = "Commission policy agreed";
	        	} else {
	        		$json['error'] = true;
	            	$json['message'] = "Commission policy not agreed!";
	        	}
	        }
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}
}
