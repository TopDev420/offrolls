<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    private $page_name = 'profile';
    private $candidateArr = array();
    private $user_id;
    private $candidate_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); //
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
				    $saveImage = $this->model_candidate->saveImage($this->user_id, $image_name);
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
		        $config_filename = 'file' . date('YmdHis'). $this->candidate_id;
		    break;
		    case 'image':
		        $allowed_types = 'gif|jpg|png';
		        $config_filename = 'picture' . date('YmdHis'). $this->candidate_id;;
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
        $this->load->model('candidate/Candidate_model', 'model_candidate');   //Load company model
        $this->load->model('Users_model', 'model_users');
        $this->adminArr = $this->model_users->getUser($this->user_id);
		$this->candidateArr = $this->model_candidate->getCandidateById($this->input->get('candidate_id'));
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
