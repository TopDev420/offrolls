<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    private $page_name = 'profile';
    private $candidateArr = array();
    private $user_id;
    private $candidate_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('candidate');
        $this->validate(); //
    }

    public function index(){

        $data = array();

        //If redirect Exist
        if($this->input->get('redirect')){
            $data['redirect'] = $this->input->get('redirect');
        } else {
            $data['redirect'] = '';
        }

        $data['logged'] = true;
        $user_type = 'candidate';

        $data['heading_title'] = 'Profile';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'candidate/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Profile',
            'href' => base_url() . 'candidate/profile'
        );
        $data['active_menu'] = 'mnu-profile';

        if($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		// Get candidate
		$profile_progress = 0;
		$data['candidate'] = array();
		$candidate = $this->candidateArr;

		if($candidate){
			$profile_progress = get_profile_status($this->candidateArr, 'candidate');

		    $this->load->model('Users_model', 'model_users');   // Load User Model
            $social_profiles = $this->model_users->getSocialProfiles($candidate->user_id);
		}

		if(isset($candidate->first_name)){
			$data['candidate']['first_name'] = $candidate->first_name;
		} else {
			$data['candidate']['first_name'] = '';
		}

		if(isset($candidate->last_name)){
			$data['candidate']['last_name'] = $candidate->last_name;
		} else {
			$data['candidate']['last_name'] = '';
		}

		if(isset($candidate->image)){
			$candidate_image = $candidate->image;
		} else {
			$candidate_image= '';
		}

		//Load Image
		if($candidate_image && is_readable(APPPATH . 'assets/uploads/logo/' . $candidate_image)){
			$data['candidate']['image'] = $candidate_image;
			$data['candidate']['thumb'] = base_url() . 'application/assets/uploads/logo/' . $candidate_image;
		} else {
			$data['candidate']['thumb'] = base_url() . 'application/assets/uploads/logo/default.png';
			$data['candidate']['image'] = '';
		}

		if(isset($candidate->email)){
			$data['candidate']['email'] = $candidate->email;
		} else {
			$data['candidate']['email'] = '';
		}

		if(isset($candidate->mobile)){
			$data['candidate']['mobile'] = $candidate->mobile;
		} else {
			$data['candidate']['mobile'] = '';
		}

		if(isset($company->about)){
			$data['candidate']['about'] = $company->about;
		} else {
			$data['candidate']['about'] = '';
		}

		if(isset($candidate->address)){
			$data['candidate']['address'] = $candidate->address;
		} else {
			$data['candidate']['address'] = '';
		}

		if(isset($candidate->city)){
			$data['candidate']['city'] = $candidate->city;
		} else {
			$data['candidate']['city'] = '';
		}

		if(isset($candidate->state)){
			$data['candidate']['state'] = $candidate->state;
		} else {
			$data['candidate']['state'] = '';
		}

		if(isset($candidate->country)){
			$data['candidate']['country'] = $candidate->country;
		} else {
			$data['candidate']['country'] = '';
		}

		if(isset($candidate->pin_code)){
			$data['candidate']['pin_code'] = $candidate->pin_code;
		} else {
			$data['candidate']['pin_code'] = '';
		}

		if($profile_progress >= 80){
			$data['candidate']['is_profileCompleted'] = 1;
		} else {
			$data['candidate']['is_profileCompleted'] = 0;
		}

		if(isset($social_profiles['facebook'])){
			$data['candidate']['facebook_profile'] = $social_profiles['facebook'];
		} else {
			$data['candidate']['facebook_profile'] = '';
		}

		if(isset($social_profiles['twitter'])){
			$data['candidate']['twitter_profile'] = $social_profiles['twitter'];
		} else {
			$data['candidate']['twitter_profile'] = '';
		}

		if(isset($social_profiles['instagram'])){
			$data['candidate']['instagram_profile'] = $social_profiles['instagram'];
		} else {
			$data['candidate']['instagram_profile'] = '';
		}

		if(isset($social_profiles['linkedin'])){
			$data['candidate']['linkedin_profile'] = $social_profiles['linkedin'];
		} else {
			$data['candidate']['linkedin_profile'] = '';
		}

		if(isset($candidate->status)){
			$data['candidate']['status'] = $candidate->status;
		} else {
			$data['candidate']['status'] = '';
		}

		// Get candidate
		$data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = $profile_progress;

		//candidate Categories
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
		$filter_data = array(
			'status' => 1
		);
		$data['candidate_categories'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE, $filter_data);

		$data['redirect_link'] = base_url() . 'candidate/dashboard';

		$data['moduleAction'] = 'candidate';

		$this->load->view('header', $data);
		$this->load->view('candidate/profile');
		$this->load->view('footer');
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
            $result = $result1 = '';
		    $social_profiles = $this->input->post('social_profiles');

			$candidate = $this->model_candidate->getCandidate($this->user_id);
			if($candidate){
                $user_data = array(
                	'first_name' => $this->input->post('first_name'),
        			'last_name' => $this->input->post('last_name'),
        		);
                $result = $this->model_users->setUserName($candidate->user_id, $user_data);
    			$result1 = $this->model_candidate->editCandidate($this->user_id);
    			if($result && $result1) {

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

    				$json['message'] = 'Candidate details added/modified successfully';
    			} else {
    			    $json['error'] = true;
    				$json['message'] = 'Candidate details not added/modified!';
    			}
			} else {
			    $json['error'] = true;
				$json['message'] = 'Candidate details not found!';
			}
		}

		echo json_encode($json);
	}

    //Save profile_image
    public function save_picture(){
        $json = array();
        $userInfo = $this->model_users->getUser($this->user_id);
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $upload_path = APPPATH . 'assets/uploads/logo/';

            //Upload Picture
			$upload = array();
			if(isset($_FILES['profile_image'])){
                if(!empty($_FILES['profile_image']['name'])) {
                    $upload = $this->savePicture($_FILES['profile_image'], $this->user_id);
                }
            } else {
            	if(!empty($this->input->post('profile_image'))) {
                    $upload = $this->savePicture($this->input->post('profile_image'), $this->user_id, '', 'blob');
                }
            }

            //Unlink Existing Image
            $thumb = $userInfo->image;
            if($thumb){
                if(is_readable($upload_path . $thumb)){
                    unlink($upload_path . $thumb);
                }
            }

            if($upload){
            	$json = $upload;
            } else {
                $json['error'] = true;
                $json['message'] = 'Upload image not available!';
            }
        }

        echo json_encode($json);
    }

    //Save image
    public function savePicture($uploadImage, $userid, $thumb='', $uploadType='file') {
        $json = array();
        $json['success'] = false;
        $json['error'] = false;
        $file_upload = false;

        if(!empty($uploadImage)) {
	        
	        // Load file storage library
	        $file_storage = 'Default';
	        if($file_storage){
	        	$this->load->library('storage/'. ucfirst($file_storage) . '_storage', NULL, 'fileStorage');
	        	if($uploadType == 'blob'){

	        		$file_data = array(
			        	'newname' => 'jspic' . date('YmdHis'). $userid,
			        	'upload_path' => APPPATH . 'assets/uploads/logo/',
			        	'blob' => $uploadImage,
			        	'extension' => 'png',
			        	'type' => 'image/png',
			        	'upload_file' => 'profile_image',
			        );

	        		$file_upload = $this->fileStorage->uploadBlobFile($file_data);
		        	if($thumb){
		        		$this->fileStorage->deleteFile($file_data['upload_path'].$thumb);
		        	}
	        	} else {

	        		$extension = pathinfo($uploadImage['name'], PATHINFO_EXTENSION);
			        $filename = pathinfo($uploadImage['name'], PATHINFO_FILENAME);
			        $file_data = array(
			        	'name' => $filename,
			        	'newname' => $filename . 'pic' . date('YmdHis'). $userid,
			        	'extension' => $extension,
			        	'tmp_name' => $uploadImage['tmp_name'],
			        	'type' => $uploadImage['type'],
			        	'allowed_types' => 'jpeg|jpg|png',
			        	'upload_file' => 'profile_image',
			        	'upload_path' => APPPATH . 'assets/uploads/logo/'
			        );

	        		$file_upload = $this->fileStorage->uploadFile($file_data);
		        	if($thumb){
		        		$this->fileStorage->deleteFile($file_data['upload_path'].$thumb);
		        	}
	        	}
	        	
	        }
	        
	        $file_upload_status = isset($file_upload['status']) ? $file_upload['status'] : false;
            if($file_upload_status){
                $saveImage = $this->model_candidate->saveImage($userid, $file_upload['name']);
                if($saveImage){
                    $json['success'] = true;
                    $json['message'] = 'Image uploaded';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Image not uploaded!';
                }
            } else {
                $json['error']= true;
                $json['message'] = $file_upload['message'];
            }
        } else {
            $json['error']= true;
            $json['message'] = 'Please upload image file!';
        }
        

        return $json;
    }

	protected function validate() {
		//Check if company user is loggedin or not
		$this->user_id = $this->candidate->isLogged();
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
        $this->load->model('candidate/Candidate_model', 'model_candidate');   //Load company model
		$this->candidateArr = $this->model_candidate->getCandidate($this->user_id);
		$this->candidate_id = isset($this->candidateArr->candidate_id) ? $this->candidateArr->candidate_id : 0;
	}

    //Upload Resume Document
	public function resume($action=''){
		$json = array();

		switch($action){
		    case 'upload':
		        $this->loadUploadResume();
		        break;
	        case 'download' :
	            $this->loadDownloadResume();
	            break;
	        default:
	            $this->getResumeDetails();
		}
	}

    protected function getResumeDetails(){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            //View Detail
			$candidate = $this->model_candidate->getCandidateResume($this->candidate_id);
			if($candidate){
                $resume_file = '';
                $resume_name = '';
                if($candidate->resume){
                    if(is_readable(APPPATH . 'assets/files/candidate/resume/' .$candidate->resume)){
                        $resume_file = base_url() . 'application/assets/files/candidate/resume/' .$candidate->resume;
                        $resume_name = $candidate->resume;
                    }
                }
				$json['success'] = true;
				//$json['resume_file'] = $resume_file;
				$json['resume_name'] = $resume_name;
				$json['message'] = 'show';
			} else {
				$json['error'] = true;
				$json['message'] = 'No candidate detail found';
			}
        }

        echo json_encode($json);
    }

    protected function loadUploadResume(){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST') {
	        $candidate_id = $this->candidate->getId();
			if(!empty($_FILES['upload_resume']['name'])) {
			    $upload_path = APPPATH . 'assets/files/candidate/resume/';

			    //Unlink Existing Resume
                $rfile = $this->input->post('resume_name');
                if($rfile && $rfile != 'undefined'){
                    if(is_readable($upload_path . $rfile)){
                        unlink($upload_path . $rfile);
                    }
                }

				$file_name = 'upload_resume';
				$upload = $this->upload_image($upload_path, $file_name, 'file');

            	if($upload){
            		$resume = $this->model_candidate->saveResume($this->candidate_id, $upload);
            		$json['success'] = true;
            		$json['resume_file'] = base_url() . 'assets/files/candidate/resume/' .$upload;
            		$json['resume_name'] = $upload;
            		$json['message'] = 'Resume uploaded successfully';
            	} else {
            	    $json['message'] = $this->upload->display_errors('<p>', '</p>');
            		$json['error'] = true;
            	}
			} else {
			    $json['error'] = true;
        		$json['message'] = 'Please upload your resume!';
        	}
		}

		echo json_encode($json);
    }

    protected function loadDownloadResume(){
        $data['message'] = '';
        $candidate = $this->model_candidate->getCandidateResume($this->candidate_id);
		if($candidate){
            if($candidate->resume){
                if(is_readable(APPPATH . 'assets/files/candidate/resume/' . $candidate->resume)){
        	        $this->load->helper('download');
    		        echo '<h2>Your file is downloading...</h2>';
    		        force_download(APPPATH . 'assets/files/candidate/resume/' . $candidate->resume, NULL);
    		    } else {
    			    $data['message'] = '<h2>There is no resume.Please upload one</h2>';
    		    }
            }  else {
    		    $data['message'] = '<h2>There is no resume.Please upload one</h2>';
		    }

		} else {
			$data['message'] = '<h2>No candidate detail found</h2>';
		}

		echo $data['message'];
    }

    //Upload Resume summary
	public function summary($action='view') {
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			if($action == 'edit'){
				$profile_summary = $this->model_candidate->editProfileSummary($this->candidate_id);
				if($profile_summary){
					$json['success'] = true;
					$json['message'] = 'Profile summary detail added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Profile summary not modified!';
				}
			} else {
				//View Detail
				$candidate = $this->model_candidate->getCandidateResume($this->candidate_id);
				if($candidate){
					$json['success'] = array(
						'profile_summary' => $candidate->about ? $candidate->about : ''
					);
					$json['message'] = 'show';
				} else {
					$json['error'] = true;
					$json['message'] = 'No candidate detail found';
				}
			}

		}

		echo json_encode($json);
	}

    //Upload Resume Personal Information
	public function personal($action='view') {
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			if($action == 'edit'){
				$profile_summary = $this->model_candidate->editPersonal($this->candidate_id);
				if($profile_summary){
					$json['success'] = true;
					$json['message'] = 'Personal details added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Personal details not modified!';
				}
			} else {
				//View Detail
				$candidate = $this->model_candidate->getCandidateResume($this->candidate_id);
				if($candidate){
					$json['success'] = array(
						'father_name' => $candidate->father_name ? $candidate->father_name : '',
						'mother_name' => $candidate->mother_name ? $candidate->mother_name : '',
						'dob' => ($candidate->dob && $candidate->dob != '0000-00-00') ? view_date_format($candidate->dob)  : '',
						'nationality' => $candidate->nationality ? $candidate->nationality : '',
						'gender' => $candidate->gender ? $candidate->gender : '',
				// 		'age' => $candidate->age ? $candidate->age : '',
					);
					$json['message'] = 'show';
				} else {
					$json['error'] = true;
					$json['message'] = 'No candidate detail found';
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
				$career_detail = $this->model_candidate->editCareer($this->candidate_id);
				if($career_detail){
					$json['success'] = true;
					$json['message'] = 'Career details added/modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'Career details not modified!';
				}
			} else {
				//View Detail
				$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
				$candidate = $this->model_candidate->getCandidateResume($this->candidate_id);
				if($candidate){
					$industry = $this->model_jobcategory->getCategory($candidate->company_category);
					// $job_role = $this->model_category->getCategory($candidate->job_role);
                    $job_type = $this->model_jobcategory->getCategory($candidate->job_type);

					$json['success'] = array(
						'industry_type_id' => $candidate->company_category ? $candidate->company_category : '',
						'job_type_id' => $candidate->job_type ? $candidate->job_type : '',
						'industry' => isset($industry->name) ? $industry->name : '',
						'job_type' => isset($job_type->name) ? $job_type->name : '',
						'salary_range_from' => $candidate->salary_range_from ? $candidate->salary_range_from : '',
						'salary_range_to' => $candidate->salary_range_to ? $candidate->salary_range_to : '',
						'salary_period' => $candidate->salary_period ? get_salary_period($candidate->salary_period) : '',
						'salary_period_id' => $candidate->salary_period ? $candidate->salary_period : '',
						'job_location' => isset($candidate->job_location) ? $candidate->job_location : ''
					);
					$json['message'] = 'show';
				} else {
					$json['error'] = true;
					$json['message'] = 'No candidate detail found';
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
				$candidate_skills = $this->model_candidate->editSkills($this->candidate_id);
				if($candidate_skills){
                    $this->deleteFilter('filter_skill'); //Delete Skill Filter
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
				$candidate = $this->model_candidate->getCandidateResume($this->candidate_id);
				if($candidate){
					$skills = array();
					$candidate_skills = $candidate->skills ? json_decode($candidate->skills) : '';
					if($candidate_skills){
						foreach($candidate_skills as $skill_id){
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
					$json['message'] = 'No candidate detail found';
				}
			}

		}

		echo json_encode($json);
	}

    //Set Candidate filter
    protected function setFilters($keyword, $datas){
        if($datas && is_array($datas)){
            foreach($datas as $data){
                $this->setCandidateFilter($keyword, $data);
            }
        }
    }

    protected function setFilter($keyword, $data){
        $filter = $this->model_candidate->getCandidateFilter($this->candidate_id, $keyword, $data);
        if($filter){
             $this->model_candidate->updateCandidateFilter($filter->candidate_filter_id, $keyword, $data);
        } else {
            $this->model_candidate->addCandidateFilter($this->candidate_id, $keyword, $data);
        }
    }

    //Delete Candidate Filter
    protected function deleteFilter($keyword){
        if($keyword){
            $this->model_candidate->deleteCandidateFilter($this->candidate_id, $keyword);
        }
    }

}
