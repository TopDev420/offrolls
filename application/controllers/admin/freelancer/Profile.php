<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    private $page_name = 'profile';
    private $adminArr = array();
    private $freelancerArr = array();
    private $user_id;
    private $freelancer_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); //validation
    }

    
    public function details($action='view') {
        $json=array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
            if($action == 'edit'){
                $this->load->model('Users_model', 'model_users');   // Load Users Model
                $result = $this->model_freelancer->editFreelancer($this->user_id);
                if($result) {
                    if(!$this->freelancerArr->mobile){
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

    public function edit() {
	    $json=array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
		    $this->load->model('Users_model', 'model_users');   // Load Users Model

		    if($this->input->get('redirect')){
		        $redirect = $this->input->get('redirect');
		    } else {
		        $redirect = '';
		    }

		    $social_profiles = $this->input->post('social_profiles');

			$freelancer = $this->model_freelancer->getFreelancer($this->user_id);
			if($freelancer){
    			$result = $this->model_freelancer->editFreelancer($this->user_id);
    			if($result) {
    			    if(!$freelancer->mobile){
						$mobile = $this->input->post('mobile');
						$this->model_users->setUserMobile($this->user_id, $mobile);
					}
    			    if($social_profiles){
    			        foreach($social_profiles as $sm_name => $link){
    			            $sm = $this->model_users->getSocialProfile($this->user_id, $sm_name);
    			            if($sm){
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
    public function save_picture(){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $upload_path = APPPATH . 'assets/uploads/logo/';

            //Unlink Existing Image
            $thumb = $this->input->post('thumb');
            if($thumb && $thumb != 'thumb'){
                if(is_readable($upload_path . $thumb)){
                    unlink($upload_path . $thumb);
                }
            }

            if(!empty($_FILES['profile_image']['name'])) {
				$file_name = 'profile_image';
				$image_name = $this->upload_image($upload_path,$file_name, 'image');
				if($image_name){
				    $saveImage = $this->model_freelancer->saveImage($this->user_id, $image_name);
				    if($saveImage){
                	    $json['success']= true;
                	    $json['picture'] = $image_name;
                	    $json['picture_path'] = base_url() . 'application/assets/uploads/logo/' . $image_name;
    			        $json['message'] = 'Profile image updated successfully';
                	} else {
                	    $json['error']= true;
    			        $json['message'] = 'Profile image not uploaded!';
                	}
				} else {
            	    $json['error']= true;
			        $json['message'] = $this->error['error'];
            	}
			} else {
			    $json['error']= true;
			    $json['message'] = 'Please upload image file!';
			}
        }

        echo json_encode($json);
    }

	protected function upload_image($path, $file_name, $extType) {
		$config['upload_path'] = $path;
		$allowed_types = $config_filename = '';
		switch($extType){
		    case 'file':
		        $allowed_types = 'doc|docx|pdf';
		        $config_filename = 'file' . date('YmdHis'). $this->freelancer_id;
		    break;
		    case 'image':
		        $allowed_types = 'gif|jpg|png';
		        $config_filename = 'picture' . date('YmdHis'). $this->freelancer_id;;
		    break;
		    default:
		}
		$config['allowed_types'] = $allowed_types;
		$config['overwrite'] = TRUE;
        $config['file_name'] = $config_filename;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if($this->upload->do_upload($file_name)) {
			$uploadData =  $this->upload->data();
			return $uploadData['file_name'];
		} else {
			$this->error['error'] = $this->upload->display_errors();
			return false;
		}
	}

	protected function validate() {
		//Check if company user is loggedin or not
		$this->user_id = $this->admin->isLogged();
		if(!$this->user_id) {
		    $this->session->set_userdata('jobredirect', array('page' => 'dashboard', 'url' => current_url()));
			redirect(base_url() . 'login');
		} else {
			$this->loadDetails();
		}
	}

	protected function loadDetails(){
		$this->load->helper(array('user','category')); // Load user helper
		$this->load->model('Users_model', 'model_users');   //Load users model
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');
        $this->adminArr = $this->model_users->getUser($this->user_id);
		$this->freelancerArr = $this->model_freelancer->getFreelancerById($this->input->get('freelancer_id'));
		$this->freelancer_id = isset($this->freelancerArr->freelancer_id) ? $this->freelancerArr->freelancer_id : 0;
	}



    //Upload Profile summary
	public function summary($action='view') {
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			if($action == 'edit'){
				$profile_summary = $this->model_freelancer->editProfileSummary($this->freelancer_id);
				if($profile_summary){
					$json['success'] = true;
					$json['message'] = 'Profile summary detail added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Profile summary not modified!';
				}
			} else {
				//View Detail
				$freelancer = $this->model_freelancer->getFreelancerResume($this->freelancer_id);
				if($freelancer){
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
	public function personal($action='view') {
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			if($action == 'edit'){
				$profile_summary = $this->model_freelancer->editPersonal($this->freelancer_id);
				if($profile_summary){
					$json['success'] = true;
					$json['message'] = 'Personal details added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Personal details not modified!';
				}
			} else {
				//View Detail
				$freelancer = $this->model_freelancer->getFreelancerResume($this->freelancer_id);
				if($freelancer){
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
    public function desired_job($action='view') {
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			if($action == 'edit'){
                $languages = $this->input->post('job_languages');
				$desiredjob = $this->model_freelancer->editDesiredJob($this->freelancer_id);
				if($desiredjob){
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
				if($freelancer){
                    $languages = array();
    				$freelancer_languages = $freelancer->languages ? json_decode($freelancer->languages) : '';
					if($freelancer_languages){
						foreach($freelancer_languages as $language_id){
							$detail = $this->model_jobcategory->getLanguage($language_id);
							if($detail){
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
	public function career($action='view') {

		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			if($action == 'edit'){
			    $job_location = $this->input->post('job_location');
				$career_detail = $this->model_freelancer->editCareer($this->freelancer_id);
				if($career_detail){
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
				if($freelancer){
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
	public function skills($action='view') {
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			if($action == 'edit'){
			    $skill_category = $this->input->post('filter_skill', 'skill_category');
				$freelancer_skills = $this->model_freelancer->editSkills($this->freelancer_id);
				if($freelancer_skills){
                    $this->deleteFilter('filter_skill'); // Delete Skill Filter
				    $this->setFilters('filter_skill', $skill_category); // Set Skill Filter
					$json['success'] = true;
					$json['message'] = 'Skills added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Skills not modified!';
				}
			} else {
				//View Detail
				$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
				$freelancer = $this->model_freelancer->getFreelancerResume($this->freelancer_id);
				if($freelancer){
					$skills = array();
					$freelancer_skills = $freelancer->skills ? json_decode($freelancer->skills) : '';
					if($freelancer_skills){
						foreach($freelancer_skills as $skill_id){
							$detail = $this->model_jobcategory->getCategory($skill_id);
							if($detail){
								$skills[] = array(
									'skill_id' => $detail->category_id,
									'name' => $detail->name
								);
							}
						}
					}
					$json['success'] = $skills;
					$json['message'] = 'show';
				} else {
					$json['error'] = true;
					$json['message'] = 'No freelancer detail found';
				}
			}

		}

		echo json_encode($json);
	}

    public function publish() {
    	$json = array();

		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$published = $this->model_freelancer->setFreelancerProfilePublish($this->freelancerArr->freelancer_id, 1);
            //echo $this->db->last_query();
			if($published){
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
    protected function setFilters($keyword, $datas){
        if($datas && is_array($datas)){
            foreach($datas as $data){
                $this->setFilter($keyword, $data);
            }
        }
    }

    protected function setFilter($keyword, $data){
        $filter = $this->model_freelancer->getFreelancerFilter($this->freelancer_id, $keyword, $data);
        if($filter){
             $this->model_freelancer->updateFreelancerFilter($filter->freelancer_filter_id, $keyword, $data);
        } else {
            $this->model_freelancer->addFreelancerFilter($this->freelancer_id, $keyword, $data);
        }
    }

    //Delete Freelancer filter
    protected function deleteFilter($keyword){
        if($keyword){
            $this->model_freelancer->deleteFreelancerFilter($this->freelancer_id, $keyword);
        }
    }
}
