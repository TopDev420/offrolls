<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
    	parent::__construct();
		$this->load->library('admin');
		$this->load->model('admin/User_model', 'model_admin');

	}

	public function index() {
		//If User Loggedin
		if($this->admin->isLogged()) {
			redirect(base_url() .'admin/dashboard');
		}

		if($this->input->server('REQUEST_METHOD') == 'POST') {
            $json = array();
			$login = $this->model_admin->login();
			if($login) {
				$json['success'] = 'Loggedin successfully!';

			} else {
				$json['error'] = 'Email/Password not registered with us!';
			}

            echo json_encode($json);
            exit;
		}

		$this->getView();
	}

	protected function getView() {
		$data['logged'] = 0;
		//Load Alert Values
		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$this->load->view('header', $data);
		$this->load->view('admin/login');
		$this->load->view('footer');
	}
}
