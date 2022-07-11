<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('admin');
		$this->load->model('admin/User_model', 'model_admin');
		$this->load->model('company/Company_model', 'model_company');

		$this->validate(); // Check if admin is loggedin

		$this->lang->load(array('admin/category'));	//Load Language
	}

	public function index(){	
	
		$data = array();
		//Get Page Number
		if($this->uri->segment(4)) {
			$page = (int)$this->uri->segment(4);
		} else {
			$page = 1;
		}

		$limit = 10;

		$data['logged'] = $this->admin->isLogged(); // User Login
		$data['heading_title'] = 'Company';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Dashboard',
			'href' => base_url() . 'admin/company/company'
		);
		$data['active_menu'] = 'mnu-company';
		
		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$data['companies'] = array();

		//Filter Data
		$filter_data = array(
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'company_id',
			'order' => 'DESC'
		);
		// Get Company List
		$total_companies = $this->model_company->getTotalCompanies();
		$companies = $this->model_company->getCompanies($filter_data);
		if($companies){
						
			foreach($companies as $company) {

				//Load Image
				if($company->image && file_exists(APPPATH . 'assets/images/company/' . $company->image)){
					$thumb = base_url() . 'application/assets/images/company/' . $company->image;
				} else {
					$thumb = base_url() . 'application/assets/images/company/default.png';
				}
			
				$data['companies'][] = array(
					'name' => $company->company_name,
					'thumb' => $thumb,
					'status' => $company->status,
					'edit' => base_url() . 'admin/company/view/' . $company->company_id,
				);
			}
		}
		

		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/company/company/';
		$config['total_rows'] = $total_companies;
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['attributes'] = array('class' => 'page-numbers');

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();


		$this->load->view('header', $data);
		$this->load->view('admin/company/company_list');
		$this->load->view('footer');
	}

	protected function validate() {
		if(!$this->admin->isLogged()) {
			redirect(base_url() . 'admin/login');
		}	
	}
}