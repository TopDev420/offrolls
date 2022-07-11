<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('admin');
		$this->load->model('admin/User_model', 'model_admin');

		$this->validate(); // Check if admin is loggedin

		$this->lang->load(array('admin/category'));	//Load Language
	}

	public function index(){	
	
		$data = array();
		$data['logged'] = $this->admin->isLogged();
		$data['heading_title'] = 'Dashboard';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Dashboard',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['active_menu'] = 'mnu-dashboard';
		
		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		// Get Company List
		$data['company'] = $this->model_admin->getCompany($this->admin->getId());

		$this->load->view('header', $data);
		$this->load->view('admin/dashboard');
		$this->load->view('footer');
	}

	protected function validate() {
		if(!$this->admin->isLogged()) {
			redirect(base_url() . 'admin/login');
		}	
	}
}