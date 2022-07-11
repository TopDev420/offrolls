<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Controller {
    private $user_id;
    private $error = array();
    private $adminArr = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); // Check if admin is loggedin
        $this->lang->load(array('admin/category'));    //Load Language
    }

    public function index(){
        $data = array();

        if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['logged'] = $this->admin->isLogged();
        $data['heading_title'] = 'Informations List';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'admin/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Informations',
            'href' => base_url() . 'admin/information'
    	);
		$data['active_menu'] = 'mnu-information';

        $data['breadcrumb_actions'][] = array(
            'name' => 'Add',
            'icon' => 'fas fa-plus',
            'id' => 'add-information',
			'href' => base_url() . 'admin/information/add'
		);

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		//Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        $data['informations'] = array();

    	//Filter Data
		$filter_data = array(
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'information_id',
			'order' => 'DESC'
		);
		// Get Information List
		$total_informations = $this->model_information->getTotalInformations();
		$informations = $this->model_information->getInformations($filter_data);
		if($informations){
			foreach($informations as $information) {
				$data['informations'][] = array(
					'title' => $information->title,
					'status' => $information->status,
					'edit' => base_url() . 'admin/information/edit/' . $information->information_id,
				);
			}
		}


		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/information/index/';
		$config['total_rows'] = $total_informations;
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['attributes'] = array('class' => 'page-numbers');

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

        $data['no_fw'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/information/list');
		$this->load->view('footer');
	}

    protected function getForm($information_id=0){
        $data = array();

        //Add Css
        $this->document->addStyle(base_url(). 'application/assets/css/include/dashboard.css');

        $data['logged'] = $this->admin->isLogged();
        $data['heading_title'] = 'Information Form';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin'
		);
        $data['breadcrumb'][] = array(
    		'name' => 'Information Form',
			'href' => base_url() . 'admin/information'
		);
		$data['active_menu'] = 'mnu-information';

        $data['breadcrumb_actions'][] = array(
            'type' => 'ajax',
            'name' => 'Save',
            'icon' => 'fas fa-save',
            'id' => 'btn-save-information',
    		'href' => ''
		);

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		//Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        //Information
        $information = $this->model_information->getInformation($information_id);
        if($information) {
            $data['action'] = base_url() . 'admin/information/edit/'. $information_id;
        } else {
            $data['action'] = base_url() . 'admin/information/add';
        }

        if(isset($information->title)){
            $data['title'] = $information->title;
        } else {
            $data['title'] = '';
        }

        if(isset($information->description)){
            $data['description'] = html_entity_decode($information->description);
        } else {
            $data['description'] = '';
        }


        //Meta
        if(isset($information->meta_title)){
            $data['meta_title'] = $information->meta_title;
        } else {
            $data['meta_title'] = '';
        }

        if(isset($information->meta_description)){
            $data['meta_description'] = $information->meta_description;
        } else {
            $data['meta_description'] = '';
        }

        if(isset($information->meta_keyword)){
            $data['meta_keyword'] = $information->meta_keyword;
        } else {
            $data['meta_keyword'] = '';
        }

        if(isset($information->status)){
            $data['status'] = (int)$information->status;
        } else {
            $data['status'] = 0;
        }
        
        $data['no_fw'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/information/form');
		$this->load->view('footer');
	}

    public function add() {
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->addForm();
        } else {
            $this->getForm();
        }
    }

    public function edit($information_id) {
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->editForm($information_id);
        } else {
            $this->getForm($information_id);
        }
    }

    protected function addForm() {
        $json = array();
        $posts = $this->input->post(NULL, TRUE);
        if($this->validateForm()){
            $add = $this->model_information->addInformation($posts);
            if($add) {
                $json['success'] = true;
                $json['message'] = 'Information added successfully';
                $json['redirect'] = base_url() . 'admin/information';
            } else {
                $json['error'] = true;
                $json['message'] = 'Information not added!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    protected function editForm($information_id) {
        $json = array();
        $posts = $this->input->post(NULL, TRUE);
        if($this->validateForm()){
            $information = $this->model_information->getInformation($information_id);
            if($information) {
                $edit = $this->model_information->editInformation($information_id, $posts);
                if($edit) {
                    $json['success'] = true;
                    $json['message'] = 'Information updated successfully';
                    $json['redirect'] = base_url() . 'admin/information';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Information not updated!';
                }
            } else {
                $json['error'] = true;
                $json['message'] = 'Information not available!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    protected function delete($information_id) {
        $json = array();
        $information = $this->model_information->getInformation($information_id);
        if($information) {
            $edit = $this->model_information->deleteInformation($information_id);
            if($add) {
                $json['success'] = true;
                $json['message'] = 'Information updated successfully';
            } else {
                $json['error'] = true;
                $json['message'] = 'Information not updated!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = 'Information not available!';
        }

        echo json_encode($json);
    }

	protected function loadDetails(){
        $this->load->helper(array('user', 'category'));
        $this->load->model('Users_model', 'model_user');
    	$this->adminArr = $this->model_user->getUser($this->user_id);
        $this->load->model('admin/Information_model', 'model_information');
	}

    protected function validate() {
        $this->user_id = $this->admin->isLogged();
    	if(!$this->user_id) {
			redirect(base_url() . 'admin/login');
		} else {
            $this->loadDetails();
        }
	}

    protected function validateForm() {
        $filter_data = array();
        $title = $this->input->post('title');
        if(!$title) {
            $this->error['error'] = 'Please enter title';
        } else {
            $code = generateStringCode($title);
            if($this->uri->segment(4)){
                $information_id = (int)$this->uri->segment(4);
                $filter_data['except'] = array($information_id);
            }
            $information = $this->model_information->getInformationByCode($code, $filter_data);
            if($information) {
                $this->error['error'] = 'Information already exist!';
            }
        }
        return !$this->error;
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
