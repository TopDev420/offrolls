<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends CI_Controller {
	private $error = array();
	private $page_name = 'pricing';
    private $freelancerArr = array();
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('freelancer');
	}

	public function index(){
		$data = array();
        $this->validate();

        $data['logged'] = true;
        $user_type = 'freelancer';
        
        
    	$data['heading_title'] = 'Pricing';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Pricing',
			'href' => base_url() . 'freelancer/pricing'
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

		// Get freelancer
		// Get freelancer
		$data['freelancer'] = $this->freelancerArr;
		$data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->freelancer, 'freelancer');
		$data['moduleAction'] = 'freelancer';
		
		$this->load->view('header', $data);
		$this->load->view('freelancer/pricing');
		$this->load->view('footer');
	}

	protected function validate($type = '', $payment_info=false) {
		//Check if freelancer user is loggedin or not
		$this->user_id = $this->freelancer->isLogged();
		if(!$this->user_id) {
			if($type == 'return'){
				$this->error['warning'] = "Please login to your account";
			} else {
				$this->session->set_userdata('jobredirect', array('page' => 'dashboard', 'url' => current_url()));
				redirect(base_url() . 'login');
			}
		} else {
			$this->loadDetails();
		}
	

		$profile_status = $this->getProfileStatus('freelancer');
			if(!$profile_status){
				if($type == 'return'){
					$this->error['warning'] = "Please complete your profile";
				} else {
				$this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
				redirect(base_url() . 'freelancer/profile?redirect='. $this->page_name);
			}
		}

		// Check payment-info agree
		if(!$this->freelancerArr->isPaymentInfoGiven && $payment_info){
            if($type == 'return'){
                $this->error['error'] = "Please Submit the Bank Details!";
            } else {
                $this->document->addAlert('payment_info', 'info');
            } 
        }
        
        if($type == 'return'){
            return !$this->error;
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

	protected function loadErrors(){
		if(isset($this->error['warning'])){
			return $this->error['warning'];
		} elseif (isset($this->error['error'])) {
			return $this->error['error'];
		} else {
			return '';
		}
	}

	public function savePaymentInfo(){
        $json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return', false)){
			if($this->freelancerArr->isPaymentInfoGiven){
	            $json['error'] = true;
	            $json['message'] = "Payment information has already available!";
	        } else {
	        	// Checking payment info. if exist, record will be deleted
	        	$exist = $this->model_freelancer->getPaymentInfo($this->freelancerArr->freelancer_id);
	        	if($exist){
	        		$this->model_freelancer->deletePaymentInfo($this->freelancerArr->freelancer_id);
	        	}

	        	// Adding payment info  
	        	$insert = $this->model_freelancer->addPaymentInfo($this->freelancerArr->freelancer_id);
	        	if($insert){
	        		$this->model_freelancer->updatePaymentInfo($this->freelancerArr->freelancer_id, 1);
	        		$json['success'] = true;
	            	$json['message'] = "Payment information saved";
	        	} else {
	        		$json['error'] = true;
	            	$json['message'] = "Payment information not saved!";
	        	}
	        }
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}
}
