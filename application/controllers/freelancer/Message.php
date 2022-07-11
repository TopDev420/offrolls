<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    private $error = array();
    private $page_name = 'freelancer_message';
    private $user_id;
    private $freelancerArr = array();
    private $freelancer_job = array();
    private $menu_section='freelancer_message';
    private $sender = 'CMP';
    private $receiver = 'FR';

    public function __construct(){
        parent::__construct();
        $this->load->library('freelancer');
        $this->validate();
    }

    public function index(){
        $data = array();

        $data['logged'] = true;
        $user_type = 'freelancer';


        $data['heading_title'] = 'Message';    //Heading Title
        $data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Message',
			'href' => base_url() . 'freelancer/message'
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

		// Get freelancer
		$data['freelancer'] = $this->freelancerArr;
		$data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->freelancer, 'freelancer');
        $data['moduleAction'] = 'freelancer';

		$this->load->view('header', $data);
		$this->load->view('freelancer/message');
		$this->load->view('footer');
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
		$this->freelancer = $this->model_freelancer->getFreelancer($this->user_id);
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
}
