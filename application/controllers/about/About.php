<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

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
    		$user_type = $this->users->getUserType();
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

        $data['searchQuery'] = '';
		$data['redirect_link'] = base_url() . 'freelancer/dashboard';

		$this->load->view('header', $data);
		$this->load->view('about/about');
		$this->load->view('footer');
	}
}
