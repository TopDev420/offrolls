<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('freelancer');
		$this->validate(); //validation
	}

	public function index()
	{
		$this->load->model('freelancer/Feedback_model', 'model_feedback');	// Load feedback model
		$data = array();

		//If redirect Exist
		if ($this->input->get('redirect')) {
			$data['redirect'] = $this->input->get('redirect');
		} else {
			$data['redirect'] = '';
		}

		$data['logged'] = true;
		$user_type = 'freelancer';

		// Add Css
		// $this->document->addStyle(base_url(). 'application/assets/css/include/dashboard.css');

		$data['heading_title'] = 'Profile';    //Heading Title
		$data['breadcrumb'] = array();    //Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Profile',
			'href' => base_url() . 'freelancer/profile'
		);
		$data['active_menu'] = 'mnu-profile';

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		// Get freelancer
		$profile_progress = 0;
		$data['freelancer'] = array();
		$data['freelancer']['feedback'] = array(
			'total' => 0,
			'ratings' => 0
		);

		$freelancer = $this->freelancerArr;

		if ($freelancer) {

			$profile_progress = get_profile_status($this->freelancerArr, 'freelancer');

			$this->load->model('Users_model', 'model_users');   // Load User Model
			$social_profiles = $this->model_users->getSocialProfiles($freelancer->user_id);
			$feedback = $this->model_feedback->getFeedbacksRating($freelancer->freelancer_id);
			$data['freelancer']['feedback'] = array(
				'total' => isset($feedback->total) ? $feedback->total : 0,
				'ratings' => isset($feedback->ratings) ? $feedback->ratings : 0
			);
		}

		if (isset($freelancer->first_name)) {
			$data['freelancer']['first_name'] = $freelancer->first_name;
		} else {
			$data['freelancer']['first_name'] = '';
		}

		if (isset($freelancer->last_name)) {
			$data['freelancer']['last_name'] = $freelancer->last_name;
		} else {
			$data['freelancer']['last_name'] = '';
		}

		if (isset($freelancer->image)) {
			$freelancer_image = $freelancer->image;
		} else {
			$freelancer_image = '';
		}

		//Load Image
		if ($freelancer_image && is_readable(APPPATH . 'assets/uploads/logo/' . $freelancer_image)) {
			$data['freelancer']['image'] = $freelancer_image;
			$data['freelancer']['thumb'] = base_url() . 'application/assets/uploads/logo/' . $freelancer_image;
		} else {
			$data['freelancer']['thumb'] = base_url() . 'application/assets/uploads/logo/default.png';
			$data['freelancer']['image'] = '';
		}

		if (isset($freelancer->email)) {
			$data['freelancer']['email'] = $freelancer->email;
		} else {
			$data['freelancer']['email'] = '';
		}

		if (isset($freelancer->mobile)) {
			$data['freelancer']['mobile'] = $freelancer->mobile;
		} else {
			$data['freelancer']['mobile'] = '';
		}

		if (isset($company->about)) {
			$data['freelancer']['about'] = $company->about;
		} else {
			$data['freelancer']['about'] = '';
		}

		if (isset($freelancer->address)) {
			$data['freelancer']['address'] = $freelancer->address;
		} else {
			$data['freelancer']['address'] = '';
		}

		if (isset($freelancer->city)) {
			$data['freelancer']['city'] = $freelancer->city;
		} else {
			$data['freelancer']['city'] = '';
		}

		if (isset($freelancer->state)) {
			$data['freelancer']['state'] = $freelancer->state;
		} else {
			$data['freelancer']['state'] = '';
		}

		if (isset($freelancer->country)) {
			$data['freelancer']['country'] = $freelancer->country;
		} else {
			$data['freelancer']['country'] = '';
		}

		if (isset($freelancer->pin_code)) {
			$data['freelancer']['pin_code'] = $freelancer->pin_code;
		} else {
			$data['freelancer']['pin_code'] = '';
		}

		if ($profile_progress >= 80) {
			$data['freelancer']['is_profileCompleted'] = 1;
			$data['freelancer']['is_published'] = $freelancer->is_published;
		} else {
			$data['freelancer']['is_profileCompleted'] = 0;
			$data['freelancer']['is_published'] = 0;
		}

		if (isset($social_profiles['facebook'])) {
			$data['freelancer']['facebook_profile'] = $social_profiles['facebook'];
		} else {
			$data['freelancer']['facebook_profile'] = '';
		}

		if (isset($social_profiles['instagram'])) {
			$data['freelancer']['instagram_profile'] = $social_profiles['instagram'];
		} else {
			$data['freelancer']['instagram_profile'] = '';
		}

		if (isset($social_profiles['linkedin'])) {
			$data['freelancer']['linkedin_profile'] = $social_profiles['linkedin'];
		} else {
			$data['freelancer']['linkedin_profile'] = '';
		}

		if (isset($freelancer->status)) {
			$data['freelancer']['status'] = $freelancer->status;
		} else {
			$data['freelancer']['status'] = '';
		}

		// Get freelancer
		$data['user'] = get_user_account($this->user_id);
		$data['user']['progress'] = $profile_progress;
		$data['profile_progress'] = $profile_progress;

		//freelancer Categories
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
		$filter_data = array(
			'status' => 1
		);

		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, $filter_data);
		$data['qualifications'] = $this->model_jobcategory->getCategories(QUALIFICATION_TYPE, $filter_data);
		$data['freelancer_categories'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE, $filter_data);

		$data['redirect_link'] = base_url() . 'freelancer/dashboard';

		$data['moduleAction'] = 'freelancer';

		$this->load->view('header', $data);
		$this->load->view('freelancer/settings/setting');
		$this->load->view('footer');
	}


	public function details($action = 'view')
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($action == 'edit') {
				$this->load->model('Users_model', 'model_users');   // Load Users Model
				$result = $this->model_freelancer->editFreelancer($this->user_id);
				if ($result) {
					if (!$this->freelancerArr->mobile) {
						$mobile = $this->input->post('mobile');
						$this->model_users->setUserMobile($this->user_id, $mobile);
					}

					$json['success'] = true;
					$json['message'] = 'freelancer details updated';
				} else {
					$json['error'] = true;
					$json['message'] = 'freelancer details not updated!';
				}
			} else {
				$json['success'] = true;
				$json['data'] = array(
					'first_name' => $this->freelancerArr->first_name,
					'last_name' => $this->freelancerArr->last_name,
					'email' => $this->freelancerArr->email,
					'mobile' => $this->freelancerArr->mobile,
					'address' => $this->freelancerArr->address,
					'country' => $this->freelancerArr->country,
					'city' => $this->freelancerArr->city,
					'state' => $this->freelancerArr->state,
					'pin_code' => $this->freelancerArr->pin_code,
				);
				$json['message'] = 'freelancer details found';
			}
		}

		echo json_encode($json);
	}

	public function edit()
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->load->model('Users_model', 'model_users');   // Load Users Model

			if ($this->input->get('redirect')) {
				$redirect = $this->input->get('redirect');
			} else {
				$redirect = '';
			}

			$social_profiles = $this->input->post('social_profiles');

			$freelancer = $this->model_freelancer->getFreelancer($this->user_id);
			if ($freelancer) {
				$result = $this->model_freelancer->editFreelancer($this->user_id);
				if ($result) {
					if (!$freelancer->mobile) {
						$mobile = $this->input->post('mobile');
						$this->model_users->setUserMobile($this->user_id, $mobile);
					}
					if ($social_profiles) {
						foreach ($social_profiles as $sm_name => $link) {
							$sm = $this->model_users->getSocialProfile($this->user_id, $sm_name);
							if ($sm) {
								$this->model_users->updateSocialProfile($sm->social_profile_id, $link);
							} else {
								$this->model_users->addSocialProfile($this->user_id, $sm_name, $link);
							}
						}

						$json['success'] = true;
						$json['redirect'] = getRedirectURL($redirect);

						$json['message'] = 'freelancer details added/modified successfully';
					} else {
						$json['error'] = true;
						$json['message'] = 'freelancer details and social links not added/modified!';
					}
				} else {
					$json['error'] = true;
					$json['message'] = 'freelancer details not added/modified!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'freelancer details not found!';
			}
		}

		echo json_encode($json);
	}

	public function freelancerPyamentDetails()
	{
		$data = array();

		//If redirect Exist
		if ($this->input->get('redirect')) {
			$data['redirect'] = $this->input->get('redirect');
		} else {
			$data['redirect'] = '';
		}

		$data['logged'] = true;
		$user_type = 'freelancer';

		// Add Css
		// $this->document->addStyle(base_url(). 'application/assets/css/include/dashboard.css');

		$data['heading_title'] = 'Profile';    //Heading Title
		$data['breadcrumb'] = array();    //Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Profile',
			'href' => base_url() . 'freelancer/profile'
		);
		$data['active_menu'] = 'mnu-profile';

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

		$freelancer = $this->freelancerArr;


		$freelancer_payment = $this->model_freelancer->getPaymentInfo($freelancer->freelancer_id);
		//print_r($freelancer_payment);

		if (isset($freelancer_payment->account_number)) {
			$data['freelancer']['account_number'] = $freelancer_payment->account_number;
		} else {
			$data['freelancer']['account_number'] = '';
		}

		if (isset($freelancer_payment->ifsc_code)) {
			$data['freelancer']['ifsc_code'] = $freelancer_payment->ifsc_code;
		} else {
			$data['freelancer']['ifsc_code'] = '';
		}

		if (isset($freelancer_payment->bank_name)) {
			$data['freelancer']['bank_name'] = $freelancer_payment->bank_name;
		} else {
			$data['freelancer']['bank_name'] = '';
		}

		if (isset($freelancer_payment->branch_name)) {
			$data['freelancer']['branch_name'] = $freelancer_payment->branch_name;
		} else {
			$data['freelancer']['branch_name'] = '';
		}

		// Get freelancer
		$data['user'] = get_user_account($this->user_id);

		//freelancer Categories
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
		$filter_data = array(
			'status' => 1
		);

		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, $filter_data);
		$data['qualifications'] = $this->model_jobcategory->getCategories(QUALIFICATION_TYPE, $filter_data);
		$data['freelancer_categories'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE, $filter_data);

		$data['redirect_link'] = base_url() . 'freelancer/dashboard';

		$data['moduleAction'] = 'freelancer';

		$this->load->view('header', $data);
		$this->load->view('freelancer/settings/billing_payments');
		$this->load->view('footer');
	}

	public function editFreelancerPayment()
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->load->model('Users_model', 'model_users');   // Load Users Model

			$freelancer = $this->model_freelancer->getFreelancer($this->user_id);
			if ($freelancer) {
				$result = $this->model_freelancer->editPaymentInfo($freelancer->freelancer_id);
				if ($result) {
					$json['success'] = true;
					$json['message'] = 'freelancer Paymnet added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'freelancer Payment not added/modified!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'freelancer Payment not found!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

	public function passwordChangeInfo()
	{
		$data = array();

		//If redirect Exist
		if ($this->input->get('redirect')) {
			$data['redirect'] = $this->input->get('redirect');
		} else {
			$data['redirect'] = '';
		}

		$data['logged'] = true;
		$user_type = 'freelancer';

		// Add Css
		// $this->document->addStyle(base_url(). 'application/assets/css/include/dashboard.css');

		$data['heading_title'] = 'Profile';    //Heading Title
		$data['breadcrumb'] = array();    //Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Profile',
			'href' => base_url() . 'freelancer/profile'
		);
		$data['active_menu'] = 'mnu-profile';

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		// Get freelancer
		$data['user'] = get_user_account($this->user_id);
		//freelancer Categories
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
		$filter_data = array(
			'status' => 1
		);

		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, $filter_data);
		$data['qualifications'] = $this->model_jobcategory->getCategories(QUALIFICATION_TYPE, $filter_data);
		$data['freelancer_categories'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE, $filter_data);

		$data['redirect_link'] = base_url() . 'freelancer/dashboard';
		$data['login_link'] = base_url() . 'login';

		$data['moduleAction'] = 'freelancer';

		$this->load->view('header', $data);
		$this->load->view('freelancer/settings/password_change');
		$this->load->view('footer');
	}

	//Password reset Function
	public function resetPassword()
	{
		$this->load->model('Users_model', 'model_users');
		$json = array();

		$user_id['email'] = get_user_account($this->user_id);
		$current_password = $this->input->post('current_password');
		$password_check = $this->model_users->login($user_id['email']['email'], $current_password);
		if ($password_check) {
			$new_password = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');
			if ($confirm_password == $new_password) {
				$reset = $this->model_users->resetPassword($this->user_id, $new_password);
				if ($reset) {
					$json['success'] = 'Password Reset Successfully...';
				} else {
					$json['error'] = 'Password not reset!';
				}
			} else {

				$json['error'] = 'Confirm Password Not Matching!';
			}
		} else {
			$json['error'] = 'Cureent Password Wrong';
		}

		echo json_encode($json);
	}

	public function taxInformations()
	{
		$data = array();

		//If redirect Exist
		if ($this->input->get('redirect')) {
			$data['redirect'] = $this->input->get('redirect');
		} else {
			$data['redirect'] = '';
		}

		$data['logged'] = true;

		// Add Css
		// $this->document->addStyle(base_url(). 'application/assets/css/include/dashboard.css');

		$data['heading_title'] = 'Profile';    //Heading Title
		$data['breadcrumb'] = array();    //Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'freelancer/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Profile',
			'href' => base_url() . 'freelancer/profile'
		);
		$data['active_menu'] = 'mnu-profile';

		if ($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if ($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$data['freelancer'] = array();

		$freelancer = $this->freelancerArr;


		$freelancer_payment = $this->model_freelancer->getPaymentInfo($freelancer->freelancer_id);

		if (isset($freelancer_payment->pan_number)) {
			$data['freelancer']['pan_number'] = $freelancer_payment->pan_number;
		} else {
			$data['freelancer']['pan_number'] = '';
		}

		if (isset($freelancer_payment->gst_number)) {
			$data['freelancer']['gst_number'] = $freelancer_payment->gst_number;
		} else {
			$data['freelancer']['gst_number'] = '';
		}


		// Get freelancer
		$data['user'] = get_user_account($this->user_id);
		//freelancer Categories
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
		$filter_data = array(
			'status' => 1
		);

		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, $filter_data);
		$data['qualifications'] = $this->model_jobcategory->getCategories(QUALIFICATION_TYPE, $filter_data);
		$data['freelancer_categories'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE, $filter_data);

		$data['redirect_link'] = base_url() . 'freelancer/dashboard';
		$data['login_link'] = base_url() . 'login';

		$data['moduleAction'] = 'freelancer';

		$this->load->view('header', $data);
		$this->load->view('freelancer/settings/tax_informations');
		$this->load->view('footer');
	}

	public function editFreelancerTaxInfo()
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->load->model('Users_model', 'model_users');   // Load Users Model

			$freelancer = $this->model_freelancer->getFreelancer($this->user_id);
			if ($freelancer) {
				$result = $this->model_freelancer->editFreelancerTaxInfo($freelancer->freelancer_id);
				if ($result) {
					$json['success'] = true;
					$json['message'] = 'freelancer Paymnet added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'freelancer Payment not added/modified!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'freelancer Payment not found!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

	protected function validate()
	{
		//Check if company user is loggedin or not
		$this->user_id = $this->freelancer->isLogged();
		if (!$this->user_id) {
			$this->session->set_userdata('jobredirect', array('page' => 'dashboard', 'url' => current_url()));
			redirect(base_url() . 'login');
		} else {
			$this->loadDetails();
		}
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

	protected function loadDetails()
	{
		$this->load->helper(array('user', 'category')); // Load user helper
		$this->load->model('Users_model', 'model_users');   //Load users model
		$this->load->model('freelancer/Freelancer_model', 'model_freelancer');   //Load company model
		$this->freelancerArr = $this->model_freelancer->getFreelancer($this->user_id);
		$this->freelancer_id = isset($this->freelancerArr->freelancer_id) ? $this->freelancerArr->freelancer_id : 0;
	}
}
