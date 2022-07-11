<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newsletter extends CI_Controller
{
	private $subscriber_type_id;
	private $user_id;
	private $adminArr = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->library('admin');
		$this->validate(); // Check if admin is loggedin
		$this->lang->load(array('admin/category'));    //Load Language
	}

	public function index()
	{

		$data = array();
		$data['no_fw'] = true;

		//Get Page Number
		if ($this->uri->segment(5)) {
			$page = (int)$this->uri->segment(5);
		} else {
			$page = 1;
		}

		$limit = 10;

		$data['logged'] = true;
		$data['heading_title'] = 'Newsletter';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Newsletter',
			'href' => base_url() . 'admin/Newsletter'
		);
		$data['active_menu'] = 'mnu-newsletter';

		$data['breadcrumb_actions'][] = array(
			'type' => 'ajax',
			'name' => 'Add',
			'icon' => 'fas fa-plus',
			'id' => 'add-newsletter',
			'href' => '#'
		);

		//Get Admin Detail
		$data['admin'] = get_user_account($this->user_id);

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		//Filter Data
		$filter_data = array(
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'newsletter_id',
			'order' => 'DESC'
		);
		// Get Company List
		$total_newsletters = $this->model_newsletter->getTotalNewsletters();
		$data['newsletters'] = $this->model_newsletter->getNewsletters($filter_data);

		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/newsletter/index/';
		$config['total_rows'] = $total_newsletters;
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
		$this->load->view('admin/newsletter');
		$this->load->view('footer');
	}

	public function add()
	{
		$json = array();
		$subscriber_email = $this->input->post('subscriber_email');
		$newsletter_data = array(
			'email' => $this->input->post('subscriber_email'),
			'status' => $this->input->post('status'),
		);
		$subscriber = $this->model_newsletter->getNewsletterByEmail($subscriber_email);
		if ($subscriber) {
			$json['error'] = 'Subscriber already exist';
		} else {
			$result = $this->model_newsletter->addNewsletter($newsletter_data);
			if ($result) {
				$json['success'] = 'Subscriber Added';
			} else {
				$json['error'] = 'Subscriber not added!';
			}
		}

		echo json_encode($json);
	}

	public function edit($newsletter_id)
	{
		$json = array();

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('view') == 1) {
				$json = $this->view($newsletter_id);
			} else {
				$subscriber_email = $this->input->post('subscriber_email');
				$exist = $this->model_newsletter->getNewsletterByEmail($subscriber_email, array('except' => $newsletter_id));
				if ($exist) {
					$json['error'] = 'Subscriber already exist';
				} else {
					$subscriber = $this->model_newsletter->getNewsletter($newsletter_id);
					if ($subscriber) {
						$result = $this->model_newsletter->editNewsletter($newsletter_id);
						if ($subscriber) {
							$json['success'] = 'Subscriber modified';
						} else {
							$json['error'] = 'Subscriber not exist';
						}
					} else {
						$json['error'] = 'Subscriber not exist';
					}
				}
			}
		}

		echo json_encode($json);
	}

	protected function view($newsletter_id)
	{
		$json = array();
		$newsletter = $this->model_newsletter->getNewsletter($newsletter_id);
		if ($subscriber) {
			$json['success'] = $newsletter;
		} else {
			$json['error'] = 'Subscriber not exist';
		}

		return $json;
	}

	protected function loadDetails()
	{
		$this->load->helper('user'); // Load user helper
		$this->load->model('Users_model', 'model_user');
		$this->load->model('admin/newsletter_model', 'model_newsletter');
		$this->adminArr = $this->model_user->getUser($this->user_id);
	}

	protected function validate()
	{
		$this->user_id = $this->admin->isLogged();
		if (!$this->user_id) {
			redirect(base_url());
		} else {
			$this->loadDetails();
		}
	}

	public function delete($newsletter_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$subscriber = $this->model_newsletter->getNewsletter($newsletter_id);
			if ($subscriber) {
				$delete = $this->model_newsletter->removeNewsletter($newsletter_id);
				if ($delete) {
					$json['success'] = 'Subscriber Removed Successfully';
				} else {
					$json['error'] = 'Subscriber Not Deleted!';
				}
			} else {
				$json['error'] = 'Subscriber Not Found';
			}
		} else {
			$json['error'] = 'Direct Access denied';
		}

		echo json_encode($json);
	}
}
