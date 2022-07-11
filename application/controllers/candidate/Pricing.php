<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends CI_Controller {
    private $candidate_id;
    private $page_name = 'pricing';
    private $candidateArr = array();
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('candidate');
        $this->validate();
	}

	public function index(){
		$data = array();

        $data['logged'] = true;
        $user_type = 'candidate';


    	$data['heading_title'] = 'Pricing';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'candidate/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Pricing',
			'href' => base_url() . 'candidate/pricing'
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

		// Get candidate
		// Get candidate
		$data['candidate'] = $this->candidateArr;
		$data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->candidateArr, 'candidate');
		$data['moduleAction'] = 'candidate';

		$this->load->view('header', $data);
		$this->load->view('candidate/pricing');
		$this->load->view('footer');
	}

	protected function validate() {
		//Check if candidate user is loggedin or not
		$this->user_id = $this->candidate->isLogged();
		if(!$this->user_id) {
		    $this->session->set_userdata('jobredirect', array('page' => 'dashboard', 'url' => current_url()));
			redirect(base_url() . 'login');
		} else {
			$this->loadDetails();
		}

		$profile_status = $this->getProfileStatus('candidate');
		if(!$profile_status){
			$this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
			redirect(base_url() . 'candidate/profile?redirect='. $this->page_name);
		}
	}

	protected function loadDetails(){
		$this->load->helper('user'); // Load user helper
        $this->load->model('candidate/Candidate_model', 'model_candidate');   //Load company model
		$this->candidateArr = $this->model_candidate->getCandidate($this->user_id);
        $this->candidate_id = isset($this->candidateArr->candidate_id) ? $this->candidateArr->candidate_id : 0;
	}

	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type){
		if($this->user_id){
			$profile_progress = get_profile_status($this->candidateArr, $type);
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
