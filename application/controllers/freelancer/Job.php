<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job extends CI_Controller
{
	private $error = array();
	private $freelancer_id;
	private $page_name = 'job';
	private $freelancerArr = array();
	private $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('freelancer');
		$this->load->model('freelancer/Jobs_model', 'model_job');

		$this->load->helper(array('user', 'category', 'freelancer_category'));
	}

	public function index()
	{
		$this->getJobs();
	}

	public function getJobs()
	{
		$this->validate(); //Validate
		$data = array();


		$logged = $this->freelancer->isLogged();
		if ($logged) {
			$data['logged'] = $logged;
			$user_type = 'freelancer';
		} else {
			$data['logged'] = false;
			$user_type = '';
		}

		// Add Css
		$this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

		$data['moduleAction'] = $user_type;
		$data['user'] = get_user_account($this->user_id);
		$data['profile_progress'] = get_profile_status($this->freelancerArr, 'freelancer');

		$data['heading_title'] = 'Accepted Jobs';    //Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'My Jobs',
			'href' => base_url() . 'freelancer/job'
		);
		$data['active_menu'] = 'mnu-myjobs';

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}


		// Get freelancer
		$data['freelancer'] = array();
		$freelancer = $this->model_freelancer->getFreelancer($this->freelancer_id);

		if ($freelancer) {
			//Load Image
			if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
				$thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
			}

			$data['freelancer'] = array(
				'name' => $freelancer->fist_name . ' ' . $freelancer->last_name,
				'email' => $freelancer->email,
				'thumb' => $thumb,
				'status' => $freelancer->status,
			);
		}

		$data['loadAppliedJobs'] = base_url() . 'freelancer/job/getAppliedJobs';
		$data['loadAcceptedJobs'] = base_url() . 'freelancer/job/getAcceptedJobs';
		$data['loadSavedJobs'] = base_url() . 'freelancer/job/getSavedJobs';

		$this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model

		$data['job_skills'] = $this->model_jobcategory->getCategories(SKILLS_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
		$data['job_locations'] = $this->model_jobcategory->getCategories(CITY_TYPE, array('status' => 1, 'sort' => 'j.name', 'order' => 'ASC', 'child' => true));
		$data['job_languages'] = $this->model_jobcategory->getLanguages();
		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
		$data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));

		$data['user'] = get_user_account($this->user_id);
		if ($data['user']) {
			$data['user']['progress'] = $this->getProfileStatus('freelancer');
		}

		$data['profile_link'] = base_url() . 'freelancer/profile';

		$this->load->view('header', $data);
		$this->load->view('freelancer/job_list');
		$this->load->view('footer');
	}

	public function proposalJobs()
	{
		$this->validate(); //Validate
		$data = array();


		$logged = $this->freelancer->isLogged();
		if ($logged) {
			$data['logged'] = $logged;
			$user_type = 'freelancer';
		} else {
			$data['logged'] = false;
			$user_type = '';
		}


		$data['moduleAction'] = $user_type;
		$data['user'] = get_user_account($this->user_id);
		$data['profile_progress'] = get_profile_status($this->freelancerArr, 'freelancer');

		$data['heading_title'] = 'Accepted Jobs';    //Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'My Jobs',
			'href' => base_url() . 'freelancer/job'
		);
		$data['active_menu'] = 'mnu-myjobs';

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}


		// Get freelancer
		$data['freelancer'] = array();
		$freelancer = $this->model_freelancer->getFreelancer($this->freelancer_id);

		if ($freelancer) {
			//Load Image
			if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
				$thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
			}

			$data['freelancer'] = array(
				'name' => $freelancer->fist_name . ' ' . $freelancer->last_name,
				'email' => $freelancer->email,
				'thumb' => $thumb,
				'status' => $freelancer->status,
			);
		}

		$data['loadAppliedJobs'] = base_url() . 'freelancer/job/getAppliedJobs';

		$this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model

		$data['job_skills'] = $this->model_jobcategory->getCategories(SKILLS_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
		$data['job_locations'] = $this->model_jobcategory->getCategories(CITY_TYPE, array('status' => 1, 'sort' => 'j.name', 'order' => 'ASC', 'child' => true));
		$data['job_languages'] = $this->model_jobcategory->getLanguages();
		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
		$data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));

		$data['user'] = get_user_account($this->user_id);
		if ($data['user']) {
			$data['user']['progress'] = $this->getProfileStatus('freelancer');
		}

		$data['profile_link'] = base_url() . 'freelancer/profile';

		$this->load->view('header', $data);
		$this->load->view('freelancer/proposalProject');
		$this->load->view('footer');
	}

	public function acceptedProjects()
	{
		$this->validate(); //Validate
		$data = array();


		$logged = $this->freelancer->isLogged();
		if ($logged) {
			$data['logged'] = $logged;
			$user_type = 'freelancer';
		} else {
			$data['logged'] = false;
			$user_type = '';
		}


		$data['moduleAction'] = $user_type;
		$data['user'] = get_user_account($this->user_id);
		$data['profile_progress'] = get_profile_status($this->freelancerArr, 'freelancer');

		$data['heading_title'] = 'Accepted Jobs';    //Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'My Jobs',
			'href' => base_url() . 'freelancer/job'
		);
		$data['active_menu'] = 'mnu-myjobs';

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}


		// Get freelancer
		$data['freelancer'] = array();
		$freelancer = $this->model_freelancer->getFreelancer($this->freelancer_id);

		if ($freelancer) {
			//Load Image
			if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
				$thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
			}

			$data['freelancer'] = array(
				'name' => $freelancer->fist_name . ' ' . $freelancer->last_name,
				'email' => $freelancer->email,
				'thumb' => $thumb,
				'status' => $freelancer->status,
			);
		}

		$data['loadAppliedJobs'] = base_url() . 'freelancer/job/getAppliedJobs';

		$this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model

		$data['job_skills'] = $this->model_jobcategory->getCategories(SKILLS_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
		$data['job_locations'] = $this->model_jobcategory->getCategories(CITY_TYPE, array('status' => 1, 'sort' => 'j.name', 'order' => 'ASC', 'child' => true));
		$data['job_languages'] = $this->model_jobcategory->getLanguages();
		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
		$data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));

		$data['user'] = get_user_account($this->user_id);
		if ($data['user']) {
			$data['user']['progress'] = $this->getProfileStatus('freelancer');
		}

		$data['profile_link'] = base_url() . 'freelancer/profile';

		$this->load->view('header', $data);
		$this->load->view('freelancer/accepted_projects');
		$this->load->view('footer');
	}
	public function savedProjects()
	{
		$this->validate(); //Validate
		$data = array();


		$logged = $this->freelancer->isLogged();
		if ($logged) {
			$data['logged'] = $logged;
			$user_type = 'freelancer';
		} else {
			$data['logged'] = false;
			$user_type = '';
		}


		$data['moduleAction'] = $user_type;
		$data['user'] = get_user_account($this->user_id);
		$data['profile_progress'] = get_profile_status($this->freelancerArr, 'freelancer');

		$data['heading_title'] = 'Accepted Jobs';    //Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'My Jobs',
			'href' => base_url() . 'freelancer/job'
		);
		$data['active_menu'] = 'mnu-myjobs';

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}


		// Get freelancer
		$data['freelancer'] = array();
		$freelancer = $this->model_freelancer->getFreelancer($this->freelancer_id);

		if ($freelancer) {
			//Load Image
			if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
				$thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
			}

			$data['freelancer'] = array(
				'name' => $freelancer->fist_name . ' ' . $freelancer->last_name,
				'email' => $freelancer->email,
				'thumb' => $thumb,
				'status' => $freelancer->status,
			);
		}

		$data['loadAppliedJobs'] = base_url() . 'freelancer/job/getAppliedJobs';

		$this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model

		$data['job_skills'] = $this->model_jobcategory->getCategories(SKILLS_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
		$data['job_locations'] = $this->model_jobcategory->getCategories(CITY_TYPE, array('status' => 1, 'sort' => 'j.name', 'order' => 'ASC', 'child' => true));
		$data['job_languages'] = $this->model_jobcategory->getLanguages();
		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
		$data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));

		$data['user'] = get_user_account($this->user_id);
		if ($data['user']) {
			$data['user']['progress'] = $this->getProfileStatus('freelancer');
		}

		$data['profile_link'] = base_url() . 'freelancer/profile';

		$this->load->view('header', $data);
		$this->load->view('freelancer/saved_projects');
		$this->load->view('footer');
	}
	public function getAppliedJobs()
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {

			//Get Page Number
			if ($this->uri->segment(5)) {
				$page = (int)$this->uri->segment(5);
			} else {
				$page = 1;
			}

			$limit = 10;
			$json['jobs'] = array();
			$json['jobs']['pagination'] = '';
			$jobs = $this->loadJobs(array('limit' => $limit, 'applied' => 1, 'accepted' => 0, 'removed' => 0, 'page' => $page, 'status' => 1));
			if ($jobs) {
				$jList = $jobs->list;
				//Pagination
				$this->load->library('pagination');

				$config['base_url'] = base_url() . 'freelancer/job/getAppliedJobs/';
				$config['total_rows'] = $jobs->total;
				$config['per_page'] = $limit;
				$config['use_page_numbers'] = TRUE;
				$config['attributes'] = array('class' => 'page-numbers');

				$this->pagination->initialize($config);
				$jPagination = $this->pagination->create_links();

				$json['jobs'] = array(
					'list' => $jList,
					'pagination' => $jPagination
				);
			}
			$json['success'] = true;
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}
		echo json_encode($json);
	}

	public function getSavedJobs()
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {

			//Get Page Number
			if ($this->uri->segment(5)) {
				$page = (int)$this->uri->segment(5);
			} else {
				$page = 1;
			}

			$limit = 10;
			$json['jobs'] = array();
			$json['jobs']['pagination'] = '';
			$jobs = $this->loadJobs(array('limit' => $limit, 'applied' => 0, 'saved' => 1, 'page' => $page, 'status' => 1));
			if ($jobs) {
				$jList = $jobs->list;
				//Pagination
				$this->load->library('pagination');

				$config['base_url'] = base_url() . 'freelancer/job/getSavedJobs/';
				$config['total_rows'] = $jobs->total;
				$config['per_page'] = $limit;
				$config['use_page_numbers'] = TRUE;
				$config['attributes'] = array('class' => 'page-numbers');

				$this->pagination->initialize($config);
				$jPagination = $this->pagination->create_links();

				$json['jobs'] = array(
					'list' => $jList,
					'pagination' => $jPagination
				);
			}
			$json['success'] = true;
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}
		echo json_encode($json);
	}

	public function getAcceptedJobs()
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {

			//Get Page Number
			if ($this->uri->segment(5)) {
				$page = (int)$this->uri->segment(5);
			} else {
				$page = 1;
			}

			$limit = 10;
			$json['jobs'] = array();
			$json['jobs']['pagination'] = '';
			$jobs = $this->loadJobs(array('limit' => $limit, 'applied' => 1, 'accepted' => 1,  'page' => $page, 'status' => 1));
			if ($jobs) {
				$jList = $jobs->list;
				//Pagination
				$this->load->library('pagination');

				$config['base_url'] = base_url() . 'freelancer/job/getAcceptedJobs/';
				$config['total_rows'] = $jobs->total;
				$config['per_page'] = $limit;
				$config['use_page_numbers'] = TRUE;
				$config['attributes'] = array('class' => 'page-numbers');

				$this->pagination->initialize($config);
				$jPagination = $this->pagination->create_links();

				$json['jobs'] = array(
					'list' => $jList,
					'pagination' => $jPagination
				);
			}
			$json['success'] = true;
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}
		echo json_encode($json);
	}

	protected function loadJobs($filter)
	{

		$this->load->helper(array('category', 'date'));
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');

		// Get Jobs List
		$jobsList = array();
		$data['jobs'] = array();
		// Get Job List
		$filter_data = array(
			'start' => ($filter['limit'] * ($filter['page'] - 1)),
			'limit' => $filter['limit'],
			'sort' => 'j.job_id',
			'order' => 'DESC'
		);

		if (isset($filter['applied'])) {
			$filter_data['applied'] = $filter['applied'];
		}

		if (isset($filter['saved'])) {
			$filter_data['saved'] = $filter['saved'];
		}

		if (isset($filter['accepted'])) {
			$filter_data['accepted'] = $filter['accepted'];
		}

		if (isset($filter['removed'])) {
			$filter_data['removed'] = $filter['removed'];
		}

		$total_jobs = $this->model_job->getTotalFreelancerJobs($this->freelancer_id, $filter_data);
		$jobs = $this->model_job->getFreelancerJobs($this->freelancer_id, $filter_data);

		if ($jobs) {
			foreach ($jobs as $job) {

				//Load Image
				if ($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)) {
					$thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
				} else {
					$thumb = base_url() . 'application/assets/uploads/logo/default.png';
				}

				$jobexperience = array();
				if ($job->experience_level == 'experienced') {
					$jobexperience = $this->model_jobcategory->getCategory($job->experience);  // Experience
				}

				$jobskills = array();
				$job_skills = $job->skills ? json_decode($job->skills) : array();
				if ($job_skills) {
					foreach ($job_skills as $job_skill) {
						$jobskill = $this->model_jobcategory->getCategory($job_skill);
						if (isset($jobskill->name)) {
							$jobskills[] = $jobskill->name;
						}
					}
				}

				if ($job->date_modified && $job->date_modified != '0000-00-00 00:00:00') {
					$post_date = $job->date_modified;
				} else {
					$post_date = $job->date_added;
				}

				$jobsList[] = array(
					'job_id' => $job->job_id,
					'company_name' => $job->company_name,
					'title' => $job->title,
					'thumb' => $thumb,
					'is_applied' => $job->cj_isApplied ? (int)$job->cj_isApplied : 0,
					'is_accepted' => $job->cj_isAccepted ? (int)$job->cj_isAccepted : 0,
					'is_removed' => $job->cj_isRemoved ? (int)$job->cj_isRemoved : 0,
					'is_saved' => isset($job->cj_isSaved) ? $job->cj_isSaved : 0,
					'bid_amount' => format_currency($job->cj_amount),
					'bid_proposal' => $job->cj_proposal,
					'location' => $job->location,
					'job_type' => get_job_type($job->job_type),
					'pay_type' => get_pay_type($job->pay_type),
					'pay_amount' => format_currency($job->pay_amount),
					'job_duration' => get_project_duration($job->job_duration),
					'description' => $job->description,
					'experience_level' => ucfirst($job->experience_level),
					'experience' => isset($jobexperience->name) ? $jobexperience->name : '',
					'skills'   => $jobskills,
					'post_date' => timespan(strtotime($post_date), now(), 1) . ' ago',
					'view_job' => base_url() . 'freelancer/search/job/' . $job->job_id,
					'accepted_job' => base_url() . 'freelancer/job/view/' . $job->job_id,
					'remove_applied' => base_url() . 'freelancer/job/remove_applied/' . $job->job_id . '/' . $this->freelancer_id,
					'remove_bookmarked' => base_url() . 'freelancer/job/remove_bookmarked/' . $job->job_id . '/' . $this->freelancer_id,
				);
			}
		}

		return (object)array(
			'total' => $total_jobs,
			'list' => $jobsList
		);
	}

	public function apply($job_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;

			$job = $this->model_job->getJob($job_id);
			if ($job) {

				//return freelancer_job_id if job exist, otherwise add new one
				$recent_job = $this->model_job->getRecentFreelancerJob($this->freelancer_id, $job_id);
				if ($recent_job) {
					$add = $recent_job->freelancer_job_id;
				} else {
					$job_data = array(
						'freelancer_id' => $this->freelancer_id,
					);
					$add = $this->model_job->addFreelancerJob($job_id, $job_data);
				}

				if ($add) {
					$apply_data = array(
						'amount' => $this->input->post('aj_amount'),
						'proposal' => $this->input->post('aj_proposal')
					);
					$applied = $this->model_job->applyJob($add, $apply_data);
					if ($applied) {
						//Set Notification
						$this->load->library('notification');
						$message = $this->freelancer->getUserName() . ' sent quote for this project ' . $job->title;
						$link = '';
						$this->notification->add(
							[
								'sender_id' => $this->user_id,
								'receiver_id' => $job->user_id,
								'message' => $message,
								'link' => $link,
								'publish' => 0
							]
						);
						$msg = [
							'title' => 'You have recieved a new quote',
							'body' => 'A freelancer sent a quote to your project.',
						];
						$user_info = $this->model_user->getUser($job->user_id);
						// foreach ($user_info as $user_token) {
						pushNotification($user_info->device_details, $msg);
						// }
						$json['success'] = true;
						$json['message'] = 'Your Quote Submitted Successfully';
					} else {
						$json['error'] = true;
						$json['message'] = 'Your Quote not Submitted!';
					}
				} else {
					$json['error'] = true;
					$json['message'] = 'Job Not Added!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'No Job Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

	public function bookmark($job_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {

			$data['logged'] = true;
			$job = $this->model_job->getJob($job_id);
			if ($job) {

				//return freelancer_job_id if job exist, otherwise add new one
				$recent_job = $this->model_job->getRecentFreelancerJob($this->freelancer_id, $job_id);
				if ($recent_job) {
					$add = $recent_job->freelancer_job_id;
				} else {
					$job_data = array(
						'freelancer_id' => $this->freelancer_id,
					);
					$add = $this->model_job->addFreelancerJob($job_id, $job_data);
				}

				if ($add) {
					$saved = $this->model_job->setFreelancerJobActivity($add, array('saved' => 1));
					if ($saved) {
						$json['success'] = true;
						$json['message'] = 'Job bookmarked/saved Successfully';
					} else {
						$json['error'] = true;
						$json['message'] = 'Job Not bookmarked/saved!';
					}
				} else {
					$json['error'] = true;
					$json['message'] = 'Job Not Added!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'No Job Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

	public function view($job_id)
	{
		$this->validate(); //Validate

		//add css
		$this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

		/*if(!$job_id){
            redirect(base_url(). 'freelancer/job');
        }*/

		$data = array();

		$limit = 10;
		$logged = $this->freelancer->isLogged();
		if ($logged) {
			$data['logged'] = $logged;
			$user_type = 'freelancer';
		} else {
			$data['logged'] = false;
			$user_type = '';
		}

		$data['moduleAction'] = $user_type;
		// $data['user'] = get_user_account($this->user_id);
		// $data['profile_progress'] = get_profile_status($this->freelancerArr, 'freelancer');

		$data['heading_title'] = 'Accepted Jobs';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['active_menu'] = 'mnu-job';

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}


		// Get freelancer
		$data['freelancer'] = array();
		$freelancer = $this->model_freelancer->getFreelancer($this->freelancer_id);

		if ($freelancer) {
			//Load Image
			if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
				$thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
			}

			$data['freelancer'] = array(
				'name' => $freelancer->fist_name . ' ' . $freelancer->last_name,
				'email' => $freelancer->email,
				'thumb' => $thumb,
				'status' => $freelancer->status,
			);
		}

		$data['job'] = array();
		$data['milestones'] = array();
		// Get Job
		$job = $this->model_job->getRecentfreelancerJob($this->freelancer_id, $job_id);

		if ($job) {
			$data['heading_title'] = $job->title;
			$job_milestones  = $this->model_job->getJobMilestones($job->freelancer_job_id);
			if ($job_milestones) {
				foreach ($job_milestones as $job_milestone) {
					$status = get_status($job_milestone->cjm_status);
					$end_date = false;
					if ($job_milestone->cjm_start_date && ($job_milestone->cjm_start_date != '0000-00-00 00:00:00') && $job_milestone->cjm_duration) {
						$durationText = '+ ' . $job_milestone->cjm_duration . ' days';
						$enddate_str = strtotime($durationText, strtotime($job_milestone->cjm_start_date));
						$end_date = date('d M Y', $enddate_str);
					}
					$data['milestones'][] = array(
						'amount' => format_currency($job_milestone->cjm_amount),
						'description' => $job_milestone->cjm_description,
						'status' => $status ? $status['name'] : '',
						'initiator' => ('FR' == $job_milestone->cjm_initiator) ? true : false,
						'is_accepted' => $job_milestone->cjm_isAccepted ? $job_milestone->cjm_isAccepted : 0,
						'is_rejected' => $job_milestone->cjm_isRejected ? $job_milestone->cjm_isRejected : 0,
						'is_approved' => $job_milestone->cjm_isApproved ? $job_milestone->cjm_isApproved : 0,
						'is_completed' => $job_milestone->cjm_isCompleted ? $job_milestone->cjm_isCompleted : 0,
						'is_closed' => $job_milestone->cjm_isClosed ? $job_milestone->cjm_isClosed : 0,
						'is_payReleased' => $job_milestone->cjm_isPayReleased ? $job_milestone->cjm_isPayReleased : 0,
						'accept' => base_url() . 'freelancer/jobmilestone/accept/' . $job_milestone->freelancer_job_milestone_id . '/' . $job->user_id,
						'reject' => base_url() . 'freelancer/jobmilestone/reject/' . $job_milestone->freelancer_job_milestone_id,
						'deposit' => base_url() . 'freelancer/jobmilestone/deposit/' . $job_milestone->freelancer_job_milestone_id,
						'complete' => base_url() . 'freelancer/jobmilestone/complete/' . $job_milestone->freelancer_job_milestone_id,
						'close' => base_url() . 'freelancer/jobmilestone/close/' . $job_milestone->freelancer_job_milestone_id,
						'edit' => base_url() . 'freelancer/jobmilestone/edit/' . $job_milestone->freelancer_job_milestone_id,
						'delete' => base_url() . '/freelancer/jobmilestone/delete/' . $job_milestone->freelancer_job_milestone_id,
						'duration' => $job_milestone->cjm_duration,
						'start_date' => $job_milestone->cjm_start_date,
						'end_date' => $end_date,
						'date_added' => $job_milestone->cjm_date_added ? date('d M Y', strtotime($job_milestone->cjm_date_added)) : ''
					);
				}
			}

			//Load Image
			if ($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)) {
				$thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

			$data['job'] = array(
				'job_id' => $job->job_id,
				'company_name' => $job->company_name,
				'title' => $job->title,
				'thumb' => $thumb,
				'is_applied' => isset($job->cj_isApplied) ? $job->cj_isApplied : 0,
				'bid_amount' => format_currency($job->cj_amount),
				'bid_proposal' => $job->cj_proposal,
				'is_saved' => isset($job->cj_isSaved) ? $job->cj_isSaved : 0,
				'location' => $job->location,
				'job_type' => get_job_type($job->job_type),
				'view_job' => base_url() . 'freelancer/job/view/' . $job->job_id,
				'remove_applied' => base_url() . 'freelancer/job/remove_applied/' . $job->job_id,
			);
		}

		$data['add_milestone_action'] = base_url() . 'freelancer/jobmilestone/add/' . $job_id;
		$data['statuses'] = get_statuses();

		$data['user'] = get_user_account($this->user_id);
		if ($data['user']) {
			$data['user']['progress'] = $this->getProfileStatus('freelancer');
		}
		$data['profile_link'] = base_url() . 'freelancer/profile';

		$this->load->view('header', $data);
		$this->load->view('freelancer/job_view');
		$this->load->view('footer');
	}

	public function remove_applied($job_id, $freelancer_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$job = $this->model_job->getJob($job_id);
			if ($job) {
				$jid = 0;
				//return freelancer_job_id if job exist, otherwise add new one
				$recent_job = $this->model_job->getRecentFreelancerJob($freelancer_id, $job_id);
				if ($recent_job) {
					$jid = $recent_job->freelancer_job_id;
				}

				if ($jid) {
					$applied = $this->model_job->setFreelancerJobActivity($jid, array('applied' => 0));
					if ($applied) {
						$json['success'] = true;
						$json['message'] = 'Applied Job Removed Successfully';
					} else {
						$json['error'] = true;
						$json['message'] = 'Applied Job Not Removed!';
					}
				} else {
					$json['error'] = true;
					$json['message'] = 'Job Not Applied!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'No Job Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

	public function remove_bookmarked($job_id, $freelancer_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$job = $this->model_job->getJob($job_id);
			if ($job) {
				$jid = 0;
				//return freelancer_job_id if job exist, otherwise add new one
				$recent_job = $this->model_job->getRecentFreelancerJob($freelancer_id, $job_id);
				if ($recent_job) {
					$jid = $recent_job->freelancer_job_id;
				}

				if ($jid) {
					$shortlisted = $this->model_job->setFreelancerJobActivity($jid, array('saved' => 0));
					if ($shortlisted) {
						$json['success'] = true;
						$json['message'] = 'Bookmarked Job Removed Successfully';
					} else {
						$json['error'] = true;
						$json['message'] = 'Bookmarked Job Not Removed!';
					}
				} else {
					$json['error'] = true;
					$json['message'] = 'Job Not Bookmarked!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'No Job Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

	public function detail()
	{
		$this->validate(); // Validate
		$data = array();

		$data['profile_progress'] = 20;
		$data['logged'] = $this->freelancer->isLogged();
		$data['heading_title'] = 'Job Detail';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['active_menu'] = 'mnu-job';

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}


		// Get freelancer
		$data['freelancer'] = array();
		$freelancer = $this->model_freelancer->getFreelancer($this->freelancer->getId());

		if ($freelancer) {
			//Load Image
			if ($freelancer->user_image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->user_image)) {
				$thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->user_image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
			}

			$data['freelancer'] = array(
				'name' => $freelancer->fist_name . ' ' . $freelancer->last_name,
				'email' => $freelancer->email,
				'thumb' => $thumb,
				'status' => $freelancer->status,
			);

			$data['profile_progress'] = $freelancer->is_profileCompleted ? 100 : 30;
		}

		$data['moduleAction'] = 'freelancer';

		$this->load->view('header', $data);
		$this->load->view('freelancer/job_detail');
		$this->load->view('footer');
	}

	protected function validate($type = '')
	{
		//Check if freelancer user is loggedin or not
		$this->user_id = $this->freelancer->isLogged();
		if (!$this->user_id) {
			if ($type == 'return') {
				$this->error['warning'] = 'Please login to your account';
			} else {
				redirect(base_url() . 'home');
			}
		} else {
			$this->loadDetails();
		}


		//Check if freelancer user has verified or not
		$profile_status = $this->getProfileStatus('freelancer');
		if (!$profile_status) {
			if ($type == 'return') {
				$this->error['error'] = 'Please complete profile';
			} else {
				redirect(base_url() . 'freelancer/profile');
			}
		}


		/*if(!$freelancer_resume->is_published){
            if($type == 'return'){
				$this->error['error'] = 'Please publish your resume';
			} else {
				redirect(base_url() . 'freelancer/resume');
			}
        }*/


		if ($type == 'return') {
			return !$this->error;
		}
	}

	protected function loadDetails()
	{
		$this->load->helper(array('user', 'api')); // Load user helper
		$this->load->model('freelancer/freelancer_model', 'model_freelancer');   //Load company model
		$this->freelancerArr = $this->model_freelancer->getFreelancer($this->user_id);
		$this->load->model('Users_model', 'model_user'); //Load user model
		$this->freelancer_id = isset($this->freelancerArr->freelancer_id) ? $this->freelancerArr->freelancer_id : 0;
	}

	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type)
	{
		if ($this->user_id) {
			$profile_progress = get_profile_status($this->freelancerArr, $type);
			if ($profile_progress < 80) {
				return false;
			} else {
				return $profile_progress;
			}
		} else {
			return true;
		}
	}

	//Get freelancer similar jobs
	public function similarjobs($job_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$job = $this->model_job->getJob($job_id);
			if ($job) {
				$job_skills = $job->skills ? json_decode($job->skills) : '';
				$job_technology = $job->technology ? json_decode($job->technology) : '';

				$job_data = array(
					'filter_jobs_not' => array($job_id),
					'filter_title' => $job->title,
					'filter_skills' => $job_skills,
					'filter_technology' => $job_technology,
					'filter_location' => $job->location,
					'start' => 0,
					'limit' => 5,
				);

				$jobs = $this->model_job->getJobs($job_data);

				$json['success'] = true;
				$json['data'] = $jobs;
			} else {
				$json['error'] = true;
				$json['message'] = 'Sorry! No job found';
			}
		}

		echo json_encode($json);
	}

	protected function loadErrors()
	{
		if (isset($this->error['warning'])) {
			return $this->error['warning'];
		} elseif (isset($this->error['error'])) {
			return $this->error['error'];
		} else {
			return '';
		}
	}
}
