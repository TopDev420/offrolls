<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {
    private $category_type_id;
    private $user_id;
    private $adminArr = array();

    public function __construct(){
        parent::__construct();
        $this->category_type_id = CITY_TYPE;
        $this->load->library('admin');
        $this->validate(); // Check if admin is loggedin
        $this->lang->load(array('admin/category'));    //Load Language
    }

    public function index(){

        $this->validate(); // Check if admin is loggedin

		$data = array();
        $data['no_fw'] = true;

		//Get Page Number
		if($this->uri->segment(5)) {
			$page = (int)$this->uri->segment(5);
		} else {
			$page = 1;
		}

		$limit = 10;

		$data['logged'] = true;
		$data['heading_title'] = 'City';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'City',
			'href' => base_url() . 'admin/city'
		);
		$data['active_menu'] = 'mnu-city';

        $data['breadcrumb_actions'][] = array(
            'type' => 'ajax',
        	'name' => 'Add',
            'icon' => 'fas fa-plus',
            'id' => 'add-category',
			'href' => '#'
		);

		//Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		//Filter Data
		$filter_data = array(
			'child' => true,
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'j.name',
			'order' => 'ASC'
		);
		// Get Company List
		$total_categories = $this->model_jobcategory->getTotalCategories($this->category_type_id, $filter_data);
		$data['categories'] = $this->model_jobcategory->getCategories($this->category_type_id, $filter_data);

		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/category/city/index/';
		$config['total_rows'] = $total_categories;
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['prev_link'] = false;
		$config['next_link'] = false;
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';


		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('header', $data);
		$this->load->view('admin/category/city');
		$this->load->view('footer');
	}

	public function add() {
	    $this->validate(); // Check if admin is loggedin
		$json = array();
		$category_name = $this->input->post('category_name');
		$category = $this->model_jobcategory->getCategoryByName($category_name, $this->category_type_id);
		if($category) {
			$json['error'] = 'City Name already exist';
		} else {
			$result = $this->model_jobcategory->addCategory($this->category_type_id);
			if($result) {
				$json['success'] = 'City Added';
			} else {
				$json['error'] = 'City not added!';
			}
		}

		echo json_encode($json);
	}

	public function edit($category_id) {
		$json = array();
        $this->validate(); // Check if admin is loggedin
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			if($this->input->post('view') == 1){
				$json = $this->view($category_id);
			} else {
				$category_name = $this->input->post('category_name');
				$exist = $this->model_jobcategory->getCategoryByName($category_name, $this->category_type_id, array('except' => $category_id));
				if($exist) {
					$json['error'] = 'City Name already exist';
				} else {
					$category = $this->model_jobcategory->getCategory($category_id);
					if($category) {
						$result = $this->model_jobcategory->editCategory($category_id);
						if($category) {
							$json['success'] = 'City information modified';
						} else {
							$json['error'] = 'City not exist';
						}
					} else {
						$json['error'] = 'City not exist';
					}
				}
			}
		}

		echo json_encode($json);
	}

	protected function view($category_id){
		$json = array();
		$category = $this->model_jobcategory->getCategory($category_id);
		if($category) {
			$json['success'] = $category;
		} else {
			$json['error'] = 'City not exist';
		}

		return $json;

	}

	protected function loadDetails(){
        $this->load->helper('user'); // Load user helper
        $this->load->model('Users_model', 'model_user');
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
        $this->adminArr = $this->model_user->getUser($this->user_id);
    }

    protected function validate() {
        $this->user_id = $this->admin->isLogged();
        if(!$this->user_id) {
			redirect(base_url() . 'admin/login');
		} else {
            $this->loadDetails();
        }
	}

	public function delete($category_id) {
		$json = array();
		$this->validate(); // Check if admin is loggedin
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$category = $this->model_jobcategory->getCategory($category_id);
			if($category) {
				$delete = $this->model_jobcategory->deleteCategory($category_id);
				if($delete) {
					$json['success'] = 'City Deleted Successfully';
				} else {
					$json['error'] = 'City Not Deleted!';
				}
			} else {
				$json['error'] = 'City Not Found';
			}
		} else {
			$json['error'] = 'Direct Access denied';
		}

		echo json_encode($json);
	}

	public function autocomplete($filter_name=''){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {

			$filter_data = array(
			    'child' => 1,
				'filter_name' => $filter_name,
				'status' => 1,
				'start' => 0,
				'limit' => 5,
				'sort' => 'category_id',
				'order' => 'ASC'
			);

			$results = $this->model_jobcategory->getCategories($this->category_type_id, $filter_data);
            if($results){
                foreach ($results as $result) {
    				$json[] = array(
    					'category_id' => $result->category_id,
    					'name'        => strip_tags(html_entity_decode($result->name, ENT_QUOTES, 'UTF-8'))
    				);
    			}
            }

		}
		echo json_encode($json);
	}
}
