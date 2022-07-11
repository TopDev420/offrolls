<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	private $page_name = 'profile';
	private $freelancerArr = array();
	private $user_id;
	private $freelancer_id;

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

		//$this->uri->slash_segment(3, 'leading');;

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
			$data['freelancer']['thumb'] = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
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

		if (isset($freelancer->about)) {
			$data['freelancer']['about'] = $freelancer->about;
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
		$this->load->model('Users_model', 'model_user');
		$slug = $this->model_user->getUser($this->user_id);
		$data['slug'] = $slug->slug;
		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, $filter_data);
		$data['qualifications'] = $this->model_jobcategory->getCategories(QUALIFICATION_TYPE, $filter_data);
		$data['freelancer_categories'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE, $filter_data);
		$data['copy_profile_link'] = base_url() . 'company/activity/freelancer/profile/' . $slug->slug;

		$data['redirect_link'] = base_url() . 'freelancer/dashboard';

		$data['moduleAction'] = 'freelancer';

		$this->load->view('header', $data);
		$this->load->view('freelancer/profile');
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
					}

					$json['success'] = true;
					$json['redirect'] = getRedirectURL($redirect);

					$json['message'] = 'freelancer details added/modified successfully';
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

	//Save profile_image
	public function save_picture()
	{
		$json = array();
		$userInfo = $this->model_users->getUser($this->user_id);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$upload_path = APPPATH . 'assets/uploads/logo/';

			//Upload Picture
			$upload = array();
			if (isset($_FILES['profile_image'])) {
				if (!empty($_FILES['profile_image']['name'])) {
					$upload = $this->savePicture($_FILES['profile_image'], $this->user_id);
				}
			} else {
				if (!empty($this->input->post('profile_image'))) {
					$upload = $this->savePicture($this->input->post('profile_image'), $this->user_id, '', 'blob');
				}
			}

			//Unlink Existing Image
			$thumb = $userInfo->image;
			if ($thumb) {
				if (is_readable($upload_path . $thumb)) {
					unlink($upload_path . $thumb);
				}
			}

			if ($upload) {
				$json = $upload;
			} else {
				$json['error'] = true;
				$json['message'] = 'Upload image not available!';
			}
		}

		echo json_encode($json);
	}

	//Save image
	public function savePicture($uploadImage, $userid, $thumb = '', $uploadType = 'file')
	{
		$json = array();
		$json['success'] = false;
		$json['error'] = false;
		$file_upload = false;

		if (!empty($uploadImage)) {

			// Load file storage library
			$file_storage = 'Default';
			if ($file_storage) {
				$this->load->library('storage/' . ucfirst($file_storage) . '_storage', NULL, 'fileStorage');
				if ($uploadType == 'blob') {

					$file_data = array(
						'newname' => 'flpic' . date('YmdHis') . $userid,
						'upload_path' => APPPATH . 'assets/uploads/logo/',
						'blob' => $uploadImage,
						'extension' => 'png',
						'type' => 'image/png',
						'upload_file' => 'profile_image',
					);

					$file_upload = $this->fileStorage->uploadBlobFile($file_data);
					if ($thumb) {
						$this->fileStorage->deleteFile($file_data['upload_path'] . $thumb);
					}
				} else {

					$extension = pathinfo($uploadImage['name'], PATHINFO_EXTENSION);
					$filename = pathinfo($uploadImage['name'], PATHINFO_FILENAME);
					$file_data = array(
						'name' => $filename,
						'newname' => $filename . 'pic' . date('YmdHis') . $userid,
						'extension' => $extension,
						'tmp_name' => $uploadImage['tmp_name'],
						'type' => $uploadImage['type'],
						'allowed_types' => 'jpeg|jpg|png',
						'upload_file' => 'profile_image',
						'upload_path' => APPPATH . 'assets/uploads/logo/'
					);

					$file_upload = $this->fileStorage->uploadFile($file_data);
					if ($thumb) {
						$this->fileStorage->deleteFile($file_data['upload_path'] . $thumb);
					}
				}
			}

			$file_upload_status = isset($file_upload['status']) ? $file_upload['status'] : false;
			if ($file_upload_status) {
				$saveImage = $this->model_freelancer->saveImage($userid, $file_upload['name']);
				if ($saveImage) {
					$json['success'] = true;
					$json['message'] = 'Image uploaded';
				} else {
					$json['error'] = true;
					$json['message'] = 'Image not uploaded!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = $file_upload['message'];
			}
		} else {
			$json['error'] = true;
			$json['message'] = 'Please upload image file!';
		}


		return $json;
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

	protected function loadDetails()
	{
		$this->load->helper(array('user', 'category', 'api')); // Load user helper
		$this->load->model('Users_model', 'model_users');   //Load users model
		$this->load->model('freelancer/Freelancer_model', 'model_freelancer');   //Load company model
		$this->freelancerArr = $this->model_freelancer->getFreelancer($this->user_id);
		$this->freelancer_id = isset($this->freelancerArr->freelancer_id) ? $this->freelancerArr->freelancer_id : 0;
	}



	//Upload Profile summary
	public function summary($action = 'view')
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($action == 'edit') {
				$profile_summary = $this->model_freelancer->editProfileSummary($this->freelancer_id);
				if ($profile_summary) {
					$json['success'] = true;
					$json['message'] = 'Profile summary detail added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Profile summary not modified!';
				}
			} else {
				//View Detail
				$freelancer = $this->model_freelancer->getFreelancerResume($this->freelancer_id);
				if ($freelancer) {
					$json['success'] = array(
						'profile_summary' => $freelancer->about ? $freelancer->about : ''
					);
					$json['message'] = 'show';
				} else {
					$json['error'] = true;
					$json['message'] = 'No freelancer detail found';
				}
			}
		}

		echo json_encode($json);
	}

	//Upload Profile Personal Information
	public function personal($action = 'view')
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($action == 'edit') {
				$profile_summary = $this->model_freelancer->editPersonal($this->freelancer_id);
				if ($profile_summary) {
					$json['success'] = true;
					$json['message'] = 'Personal details added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Personal details not modified!';
				}
			} else {
				//View Detail
				$freelancer = $this->model_freelancer->getFreelancerResume($this->freelancer_id);
				if ($freelancer) {
					$json['success'] = array(
						'father_name' => $freelancer->father_name,
						'mother_name' => $freelancer->mother_name,
						'dob' => view_date_format($freelancer->dob),
						'nationality' => $freelancer->nationality,
						'gender' => $freelancer->gender,
						// 		'age' => $freelancer->age,
					);
					$json['message'] = 'show';
				} else {
					$json['error'] = true;
					$json['message'] = 'No freelancer detail found';
				}
			}
		}

		echo json_encode($json);
	}

	//Upload Resume Personal Information
	public function desired_job($action = 'view')
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($action == 'edit') {
				$languages = $this->input->post('job_languages');
				$desiredjob = $this->model_freelancer->editDesiredJob($this->freelancer_id);
				if ($desiredjob) {
					$this->deleteFilter('filter_language'); // Delete Language Filter
					$this->setFilters('filter_language', $languages); // Set Language Filter
					$json['success'] = true;
					$json['message'] = 'Desired Details added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Desired details not modified!';
				}
			} else {
				//View Detail
				$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
				$freelancer = $this->model_freelancer->getFreelancerResume($this->freelancer_id);
				if ($freelancer) {
					$languages = array();
					$freelancer_languages = $freelancer->languages ? json_decode($freelancer->languages) : '';
					if ($freelancer_languages) {
						foreach ($freelancer_languages as $language_id) {
							$detail = $this->model_jobcategory->getLanguage($language_id);
							if ($detail) {
								$languages[] = array(
									'language_id' => $detail['id'],
									'name' => $detail['name']
								);
							}
						}
					}
					$json['success'] = true;
					$json['data'] = array(
						'experience' => $this->model_jobcategory->getCategory($freelancer->experience),
						'languages' => $languages,
					);
					$json['message'] = 'show';
				} else {
					$json['error'] = true;
					$json['message'] = 'No freelancer detail found';
				}
			}
		}

		echo json_encode($json);
	}

	//Upload Resume Career Details
	public function career($action = 'view')
	{

		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($action == 'edit') {
				$job_location = $this->input->post('job_location');
				$career_detail = $this->model_freelancer->editCareer($this->freelancer_id);
				if ($career_detail) {
					$json['success'] = true;
					$json['message'] = 'Career details added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Career details not modified!';
				}
			} else {
				//View Detail
				$this->load->model('admin/Category_model', 'model_category');
				$freelancer = $this->model_freelancer->getFreelancerResume($this->freelancer_id);
				if ($freelancer) {
					$industry = $this->model_category->getCategory($freelancer->industry);
					// $job_role = $this->model_category->getCategory($freelancer->job_role);

					$json['success'] = array(
						'industry_type_id' => $freelancer->industry,
						'job_type_id' => $freelancer->job_type,
						'industry' => isset($industry->name) ? $industry->name : '',
						'job_type' => get_job_type($freelancer->job_type),
						'salary_range_from' => $freelancer->salary_range_from,
						'salary_range_to' => $freelancer->salary_range_to,
						'salary_period' => get_salary_period($freelancer->salary_period),
						'salary_period_id' => $freelancer->salary_period,
						'job_location' => isset($freelancer->job_location) ? $freelancer->job_location : ''
					);
					$json['message'] = 'show';
				} else {
					$json['error'] = true;
					$json['message'] = 'No freelancer detail found';
				}
			}
		}

		echo json_encode($json);
	}

	//Upload Resume Skills
	public function skills($action = 'view')
	{
		$this->load->model('freelancer/skill_model', 'model_freelancer_skill'); // Load skills
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($action == 'edit') {
				$skillContainer = [];
				$skill_categorysz = [];
				$skill_categorys = $this->input->post('skill_category');

				if ($skill_categorys) {
					$this->model_freelancer_skill->deleteSkills($this->freelancer_id);	// Delete skills
					foreach ($skill_categorys as $key => $skill_category) {
						$skill_categorysz[] = $skill_category['skill_id']; // Add to skill filter array
						$freelancer_skills = $this->model_freelancer_skill->addSkill($this->freelancer_id, $skill_category);
						if ($freelancer_skills) {
							array_push($skillContainer, 1);
						}
					}
				}

				if (in_array(1, $skillContainer) == true) {
					$this->deleteFilter('filter_skill'); // Delete Skill Filter
					$this->setFilters('filter_skill', $skill_categorysz); // Set Skill Filter
					$json['success'] = true;
					$json['message'] = 'Skills added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Skills not modified!';
				}
			} else {
				//View Detail
				$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
				$freelancer_skills = $this->model_freelancer_skill->getSkills($this->freelancer_id);
				$skills = array();
				if ($freelancer_skills) {
					foreach ($freelancer_skills as $skill) {
						$detail = $this->model_jobcategory->getCategory($skill->skill_id);
						if ($detail) {
							$skills[] = array(
								'skill_id' => $detail->category_id,
								'name' => $detail->name,
								'percentage' => $skill->percentage
							);
						}
					}
				}

				$json['success'] = $skills;
				$json['message'] = 'show';
			}
		}

		echo json_encode($json);
	}

	public function publish()
	{
		$json = array();

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$published = $this->model_freelancer->setFreelancerProfilePublish($this->freelancerArr->freelancer_id, 1);
			//echo $this->db->last_query();
			if ($published) {
				$json['success'] = true;
				$json['message'] = 'Your profile was published. Now you will receive notifications related your profile';
			} else {
				$json['error'] = true;
				$json['message'] = 'Your profile not published!';
			}
		}

		echo json_encode($json);
	}

	//Set Freelancer filter
	protected function setFilters($keyword, $datas)
	{
		if ($datas && is_array($datas)) {
			foreach ($datas as $data) {
				$this->setFilter($keyword, $data);
			}
		}
	}

	protected function setFilter($keyword, $data)
	{
		$filter = $this->model_freelancer->getFreelancerFilter($this->freelancer_id, $keyword, $data);
		if ($filter) {
			$this->model_freelancer->updateFreelancerFilter($filter->freelancer_filter_id, $keyword, $data);
		} else {
			$this->model_freelancer->addFreelancerFilter($this->freelancer_id, $keyword, $data);
		}
	}

	//Delete Freelancer filter
	protected function deleteFilter($keyword)
	{
		if ($keyword) {
			$this->model_freelancer->deleteFreelancerFilter($this->freelancer_id, $keyword);
		}
	}
}
