<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('users');
		$this->load->model('Users_model', 'model_users');
        $this->validate(); // Check if user is logged in or not.
	}

	public function index(){
		$data = array();
        
		$this->session->sess_destroy();

		$this->model_users->setToken($this->user_id, $token='');
		$this->session->set_userdata('success', 'Logged Out Successfully');

		redirect(base_url() . 'login');
	}

    protected function validate(){
        $this->user_id = $this->users->isLogged();
        if(!$this->user_id){
            redirect(base_url() . 'login');
        }
    }
}
