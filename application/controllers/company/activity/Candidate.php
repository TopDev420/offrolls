<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {
    private $page_name = 'archived_jobs';
    private $user_id;
    private $company = array();
    private $menu_section='job_seeker';

    public function __construct(){
        parent::__construct();
        $this->load->library('recruiter');
        $this->validate();
    }

    public function index(){
        redirect(base_url() . 'company/activity/candidate/archived');
    }

    public function pipelined(){
        $data = array();

        $data['logged'] = true;
        $data['heading_title'] = 'Pipelined Candidate';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/activity/candidate/pipelined'
        );
        $data['active_menu'] = 'mnu-candidate';
        $data['menu_section'] = $this->menu_section;

        if($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        // Get Company
        $data['company'] = $this->company;

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['loadjobs'] = base_url() . 'company/activity/candidate/jobs/pipelined';

        $this->load->view('header');
        $this->load->view('company/activity/candidate_pipelined', $data);
        $this->load->view('footer');
    }

    public function archived(){
        $data = array();

        $data['logged'] = true;
        $data['heading_title'] = 'Archived Candidate';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/activity/candidate/archived'
        );
        $data['active_menu'] = 'mnu-candidate';
        $data['menu_section'] = $this->menu_section;

        if($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        // Get Company
        $data['company'] = $this->company;

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['loadjobs'] = base_url() . 'company/activity/candidate/jobs/archived';

        $this->load->view('header');
        $this->load->view('company/activity/candidate_archived', $data);
        $this->load->view('footer');
    }

    //For AJAX Loading
    public function jobs($action){
        $json = array();

        $this->load->helper('category'); // Load category helper

        //Get Page Number
        if($this->input->get('page')) {
            $page = (int)$this->input->get('page');
        } else {
            $page = 1;
        }

        $json['page'] = $page;

        $limit = 10;

        // Get Company
        $company_id = $this->company->company_id;

        $json['jobs'] = array();
        //Filter Data
        $filter_data = array(
            'applied' => 1,
            'removed' => 0,
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'cj.candidate_job_id',
            'order' => 'DESC'
    	);

        switch($action){
            case 'pipelined':
                $filter_data['pipelined'] = 1;
                break;
            case 'archived':
                $filter_data['archived'] = 1;
                break;
            default:

        }
		// Get Job List
		$total_jobs = $this->model_job->getTotalCandidateJobs($company_id, $filter_data);
		$jobs = $this->model_job->getCandidateJobs($company_id, $filter_data);

		if($jobs){
			foreach($jobs as $job){

				//Load Image
    			if($job->candidate_image && file_exists(APPPATH . 'assets/uploads/logo/' . $job->candidate_image)){
    				$thumb = base_url() . 'application/assets/uploads/logo/' . $job->candidate_image;
    			} else {
    				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
    			}

				//Load Resume
				$candidate_resume = '';
				if($job->candidate_image){
					if(file_exists(APPPATH . 'assets/images/candidate/resume/' . $job->candidate_resume)){
						$candidate_resume = base_url() . 'application/assets/images/candidate/resume/' . $job->candidate_resume;
					}
				}

                if($job->cj_isRemoved){
                    $job_status = 'Removed';
                } else if($job->cj_isShortListed){
                    $job_status = 'Shortlisted';
                } else {
                    $job_status = 'Applied';
                }

				$json['jobs'][] = array(
					'job_id' => $job->job_id,
					'candidate_name' => $job->candidate_name,
					'title' => $job->title,
					'thumb' => $thumb,
					'location' => $job->location,
					'job_type' => get_job_type($job->job_type),
					'isApplied' => $job->cj_isApplied,
					'isShortlisted' => $job->cj_isShortListed,
					'isRemoved' => $job->cj_isRemoved,
                    'isPipelined' => $job->cj_isPipelined,
                    'isArchived' => $job->cj_isArchived,
					'job_status' => $job_status,
					'resume' => $candidate_resume,
					'shortlist' => base_url() . 'company/activity/candidate/shortlist/' . $job->candidate_job_id,
                    'pipeline' => base_url() . 'company/activity/candidate/pipeline/' . $job->candidate_job_id,
                    'archive' => base_url() . 'company/activity/candidate/archive/' . $job->candidate_job_id,
					'remove' => base_url() . 'company/activity/candidate/remove/' . $job->candidate_job_id
				);
			}

			//Pagination
    		$this->load->library('pagination');

    		$config['base_url'] = base_url() . 'company/activity/candidate/'. $action .'/';
    		$config['total_rows'] = $total_jobs;
    		$config['per_page'] = $limit;
    		$config['use_page_numbers'] = TRUE;
    		$config['attributes'] = array('class' => 'page-numbers');

    		$this->pagination->initialize($config);

    		$json['pagination'] = $this->pagination->create_links();

    		$json['success'] = true;
		    $json['message'] = 'Jobs';
		} else {
		    $json['success'] = true;
		    $json['message'] = 'No Job Details';
		}

        echo json_encode($json);
    }

	public function applied($job_id){
		$json = array();

		$this->load->helper('category'); // Load category helper

		//Get Page Number
        if($this->uri->segment(6)) {
            $page = (int)$this->uri->segment(6);
        } else {
            $page = 1;
        }
        $json['page'] = $page;

        //Filter Status
        if($this->input->get('filter_cj_status')) {
            $filter_cj_status = $this->input->get('filter_cj_status');
        } else {
            $filter_cj_status = '';
        }

        $data['moduleAction'] = 'company';
        $limit = 10;

        //Filter Location
        if($this->input->get('filter_location')){
            $filter_location = $this->input->get('filter_location');
        } else {
            $filter_location = '';
        }

        //Filter gender
        if($this->input->get('filter_gender')){
            if($this->input->get('filter_gender') != 'any'){
                $filter_gender = $this->input->get('filter_gender');
            }
        } else {
            $filter_gender = '';
        }

        //Filter Experiences
        if($this->input->get('filter_experiences')){
            $filter_experiences = $this->input->get('filter_experiences');
        } else {
            $filter_experiences = '';
        }

        //Filter Jobtypes
        if($this->input->get('filter_jobtypes')){
            $filter_jobtypes = explode(',', $this->input->get('filter_jobtypes'));
        } else {
            $filter_jobtypes = '';
        }

        //Filter Job Qualifications
        if($this->input->get('filter_qualifications')){
            $filter_qualifications = explode(',', $this->input->get('filter_qualifications'));
        } else {
            $filter_qualifications = '';
        }

        //Filter Skills
        if($this->input->get('filter_skills')){
            $filter_skills = explode(',', $this->input->get('filter_skills'));
        } else {
            $filter_skills = '';
        }

        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model
        //Filter Experience
        $filter_experience = '';
        if($filter_experiences){
            $filter_experiencez = $this->model_jobcategory->getCategoryByName($filter_experiences, EXPERIENCE_TYPE);
            $filter_experience = isset($filter_experiencez->category_id) ? $filter_experiencez->category_id : '';
        }

        //Filter Jobtype
        $filter_jobtype = array();
        if($filter_jobtypes){
            foreach($filter_jobtypes as $filter_jobtypez){
                $fjobtypez = $this->model_jobcategory->getLanguageByName($filter_jobtypez);
                if($fjobtypez){
                    $filter_jobtype = array($fjobtypez['id']);
                }
            }
        }

        $filter_job_qualifications = array();
        if($filter_qualifications){
            foreach($filter_qualifications as $qualification){
                $job_qualification = $this->model_jobcategory->getCategory($qualification);
                $filter_job_qualifications[] = isset($job_qualification->name) ? $job_qualification->name : '';
            }
        }

        $filter_job_skills = array();
        if($filter_skills){
            foreach($filter_skills as $skill){
                $job_skill = $this->model_jobcategory->getCategory($skill);
                $filter_job_skills[] = isset($job_skill->name) ? $job_skill->name : '';
            }
        }

		$json['logged'] = true;

		// Get Company
		$company_id = $this->company->company_id;

		$json['candidate_jobs'] = array();
        $json['pagination'] = '';
		//Filter Data
        $filter_data = array(
            'job_id' => $job_id,
            'applied' => 1,
            'removed'=> 0,
            'pipelined' => 0,
            'archived' => 0,
            'filter_location' => $filter_location,
            'filter_experience' => $filter_experience,
            'filter_jobtype' => $filter_jobtype,
            'filter_qualifications' => $filter_job_qualifications,
            'filter_skills' => $filter_job_skills,
            'freelancer_filter' => ($filter_jobtype ||  $filter_job_skills || $filter_job_qualifications) ? 'join' : 'none',
    		'sort' => 'cj.candidate_job_id',
			'order' => 'DESC'
		);

        if($filter_cj_status){
            switch($filter_cj_status){
                case 'applied':
                    $filter_data['applied'] = 1;
                    $filter_data['shortlisted'] = 0;
                    $filter_data['scheduled'] = 0;
                    $filter_data['removed'] = 0;
                    $filter_data['completed'] = 0;
                    break;
                case 'shortlisted':
                    $filter_data['applied'] = 1;
                    $filter_data['shortlisted'] = 1;
                    $filter_data['scheduled'] = 0;
                    $filter_data['removed'] = 0;
                    $filter_data['completed'] = 0;
                    break;
                case 'scheduled':
                    $filter_data['applied'] = 1;
                    $filter_data['shortlisted'] = 1;
                    $filter_data['scheduled'] = 1;
                    $filter_data['removed'] = 0;
                    $filter_data['completed'] = 0;
                    break;
                case 'removed':
                    $filter_data['removed'] = 1;
                    break;
                case 'completed':
                    $filter_data['completed'] = 1;
                    break;
                default:
            }
        }

		// Get Job List
		$total_candidate_jobs = $this->model_job->getTotalCandidateJobs($this->company->company_id, $filter_data);
        $candidate_jobs = $this->model_job->getCandidateJobs($this->company->company_id, $filter_data);

        if($candidate_jobs){
            $this->load->model('candidate/Candidate_model', 'model_candidate'); // Load Candidate Model
            $this->load->model('candidate/Education_model', 'model_candidate_education'); // Load Candidate Education Model
            $this->load->model('candidate/Experience_model', 'model_candidate_experience');   // Load Experience Candidate Model
            $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Category Model


    		foreach($candidate_jobs as $candidate_job){
                $candidate = $this->model_candidate->getCandidateById($candidate_job->candidate_id);
                $educations = $this->model_candidate_education->getEducations($candidate_job->candidate_id);
                $experiences = $this->model_candidate_experience->getExperiences($candidate_job->candidate_id);

                $job_skills=array();
                $skills = $candidate->skills ? json_decode($candidate->skills) : array();
                if($skills){
                    foreach($skills as $skill){
                        $jobskill = $this->model_jobcategory->getCategory($skill);
                        if($jobskill){
                            $job_skills[] = $jobskill->name;
                        }
                    }
                }
                $candidate_skills = $job_skills;

                $industry = $this->model_jobcategory->getCategory($candidate->company_category);  // Company Category

				//Load Image
    			if($candidate_job->candidate_image && file_exists(APPPATH . 'assets/uploads/logo/' . $candidate_job->candidate_image)){
    				$thumb = base_url() . 'application/assets/uploads/logo/' . $candidate_job->candidate_image;
    			} else {
    				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
    			}

				//Load Resume
				$candidate_resume = '';
				if($candidate_job->candidate_resume){
					if(file_exists(APPPATH . 'assets/images/candidate/resume/' . $candidate_job->candidate_resume)){
						$candidate_resume = base_url() . 'application/assets/images/candidate/resume/' . $candidate_job->candidate_resume;
					}
				}

                if($candidate_job->cj_isRemoved){
                    $job_status = 'Removed';
                } else if($candidate_job->cj_isScheduled){
                    $job_status = 'Scheduled';
                } else if($candidate_job->cj_isShortListed){
                    $job_status = 'Shortlisted';
                } else {
                    $job_status = 'Applied';
                }

                $scheduled_details = $candidate_job->cj_schedule_details ? json_decode($candidate_job->cj_schedule_details) : array();
                $job_scheduled_detail = array(
                    'schedule_date' => isset($scheduled_details->sdate) ? date('Y-m-d', strtotime($scheduled_details->sdate)) : '',
                    'schedule_time' => isset($scheduled_details->stime) ? date('h:i a', strtotime($scheduled_details->stime)) : '',
                    'schedule_venue' => isset($scheduled_details->svenue) ? $scheduled_details->svenue : '',
                    'schedule_comments' => isset($scheduled_details->scomments) ? $scheduled_details->scomments : '',
                );

				$json['candidate_jobs'][] = array(
					'job_id' => $candidate_job->job_id,
                    'candidate' => array(
                        'thumb' => $thumb,
                        'name' => $candidate->first_name . ' ' . $candidate->last_name,
                        'email' => $candidate->email,
                        'mobile' => $candidate->mobile,
                        'industry' => isset($industry->name) ? $industry->name : '',
                        'functional_area' => 'HR/Administration/IR',
                        'description' => $candidate->about,
                        'experience' => '10 years',
                        'job_type' => get_job_type($candidate_job->job_type),
                        'resume' => $candidate_resume,
                        'skills' => $candidate_skills ? implode(', ', $candidate_skills) : '',
                        'experiences' => $experiences ? $experiences[0] : array(),
                        'education' => $educations ? $educations[0] : array(),
                        'view_resume' => base_url() . 'company/activity/candidate/resume/' . $candidate_job->candidate_id,
                        'modified_date' => '14 Apr 20',
                        'active_date' => '14 Apr 20'
                    ),
					'job_title' => $candidate_job->title,
					'location' => $candidate_job->location,

					'isApplied' => $candidate_job->cj_isApplied,
					'isShortlisted' => $candidate_job->cj_isShortListed,
                    'isScheduled' => $candidate_job->cj_isScheduled,
                    'isCompleted' => $candidate_job->cj_isCompleted,
					'isRemoved' => $candidate_job->cj_isRemoved,
                    'isPipelined' => $candidate_job->cj_isPipelined,
                    'isArchived' => $candidate_job->cj_isArchived,
					'job_status' => $job_status,
                    'schedule_details' => $job_scheduled_detail,
                    'applied_date' => '14 Apr 20',

                    'schedule' => base_url() . 'company/activity/candidate/schedule/' . $candidate_job->candidate_job_id,
					'shortlist' => base_url() . 'company/activity/candidate/shortlist/' . $candidate_job->candidate_job_id,
                    'pipeline' => base_url() . 'company/activity/candidate/pipeline/' . $candidate_job->candidate_job_id,
                    'archive' => base_url() . 'company/activity/candidate/archive/' . $candidate_job->candidate_job_id,
                    'complete' => base_url() . 'company/activity/candidate/complete/' . $candidate_job->candidate_job_id,
					'remove' => base_url() . 'company/activity/candidate/remove/' . $candidate_job->candidate_job_id
				);
			}

            //Pagination
        	$this->load->library('pagination');

    		$config['base_url'] = base_url() . 'company/candidate/applied/'. $job_id;
    		$config['total_rows'] = $total_candidate_jobs;
    		$config['per_page'] = $limit;
    		$config['use_page_numbers'] = TRUE;
    		$config['attributes'] = array('class' => 'page-numbers');

    		$this->pagination->initialize($config);

    		$json['pagination'] = $this->pagination->create_links();
            $json['success'] = true;
		} else {
            $json['error'] = true;
        }

		echo json_encode($json);
	}

    public function resume($candidate_id=0) {
    	if(!$candidate_id){
            $data['heading'] = '404 - Not Found';
            $data['message'] = 'Requested pag was not found on this server';
            $html = $this->load->view('errors/html/custom_404.php', $data, TRUE);
            echo $html;
            exit;
        }

        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');
        $this->load->model('candidate/Candidate_model', 'model_candidate'); //Load Candidate Model

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

		$data = array();

		$logged = $this->recruiter->isLogged();
        if($logged){
        	$data['logged'] = $logged;
        } else {
        	$data['logged'] = false;
        }

        $data['heading_title'] = 'Candidate Search';    //Heading Title
    	$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url()
		);
		$data['breadcrumb'][] = array(
			'name' => 'Search Candidate',
			'href' => base_url() . 'search/candidate'
		);

		$this->load->model('candidate/Education_model', 'model_candidate_education');
		$this->load->model('candidate/Experience_model', 'model_candidate_experience');
		$this->load->model('candidate/Project_model', 'model_candidate_project');
		$this->load->model('candidate/Certification_model', 'model_candidate_certification');

		$data['candidate'] = array();
        $data['candidate_profile_progress'] = 0;
		$candidate = $this->model_candidate->getCandidateById($candidate_id);
		if($candidate){
            $data['candidate_profile_progress'] = get_profile_status($candidate, 'candidate');
			$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
            $industry = $this->model_jobcategory->getCategory($candidate->company_category);
            $job_type = $this->model_jobcategory->getCategory($candidate->job_type);

			$education = $this->model_candidate_education->getEducations($candidate_id);
			$project = $this->model_candidate_project->getProjects($candidate_id);
			$experience = $this->model_candidate_experience->getExperiences($candidate_id);
			$certification = $this->model_candidate_certification->getCertifications($candidate_id);

			//Load Image
    		if($candidate->image && file_exists(APPPATH . 'assets/uploads/logo/' . $candidate->image)){
				$thumb = base_url() . 'application/assets/uploads/logo/' . $candidate->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

            //Load Resume
			$candidate_resume = '';
			if($candidate->resume){
				if(file_exists(APPPATH . 'assets/files/candidate/resume/' . $candidate->resume)){
					$candidate_resume = base_url() . 'application/assets/files/candidate/resume/' . $candidate->resume;
				}
			}

			$skills = array();
			if($candidate->skills){

				$skill_details = json_decode($candidate->skills);
				if($skill_details){
					foreach ($skill_details as $skill_detail) {
						$skill = $this->model_jobcategory->getCategory($skill_detail);
						if($skill){
							$skills[] = array(
								'id' => $skill->category_id,
								'name' => $skill->name
							);
						}
					}
				}
			}

			$personal_details = array(
				'father_name' => $candidate->father_name,
				'mother_name' => $candidate->mother_name,
				'dob' => $candidate->dob,
				'gender' => $candidate->gender,
				'nationality' => $candidate->nationality,
				'address' => $candidate->address,
			);

            $desired_job = array(
    			'industry' => isset($industry->name) ? $industry->name : '',
				'job_type' => isset($job_type->name) ? $job_type->name : '',
				'salary_range_from' => $candidate->salary_range_from,
				'salary_range_to' => $candidate->salary_range_to,
				'salary_period' => get_salary_period($candidate->salary_period),
				'job_location' => isset($candidate->job_location) ? $candidate->job_location : ''
			);

			$data['candidate'] = array(
				'candidate_id' => $candidate->candidate_id,
				'name' => $candidate->first_name . ' ' . $candidate->last_name,
                'email' => $candidate->email,
                'mobile' => $candidate->mobile,
				'resume' => array('name' => $candidate->resume, 'download' => $candidate_resume),
				'thumb' => $thumb,
				'about' => $candidate->about,
				'skills' => $skills,
				'education' => $education,
				'project' => $project,
				'experience' => $experience,
				'certification' => $certification,
				'personal_details' => $personal_details,
                'desired_job' => $desired_job
			);
		}

        $this->load->view('header');
		$this->load->view('company/activity/candidate/resume', $data);
        $this->load->view('footer');
	}


    //Shortlist
	public function shortlist($candidate_job_id){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$filter_data = array(
				'applied' => 1,
			);
			$job = $this->model_job->getCandidateJob($candidate_job_id, $filter_data);
			if($job){
				$shortlist = $this->model_job->setCandidateJobActivity($job->candidate_job_id, array('shortlisted' => 1));
				if($shortlist){
                    $this->sendShortlistMail($job);

                    //Set Notification
                    $message = 'Your resume was shortlisted for '. $job->title .' by ' . $this->company->company_name;
                    $link = '';
                    $this->setNotification($job->user_id, $message, $link);

					$json['success'] = true;
					$json['message'] = 'Candidate Shortlisted';
				} else {
					$json['error'] = true;
					$json['message'] = 'Candidate Not Shortlisted!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'Candidate Job data Not Found';
			}
		}

		echo json_encode($json);
	}

	//pipeline
    public function pipeline($candidate_job_id){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$filter_data = array(
				'applied' => 1,
			);
			$job = $this->model_job->getCandidateJob($candidate_job_id, $filter_data);
			if($job){
				$pipeline = $this->model_job->setCandidateJobActivity($job->candidate_job_id, array('pipelined' => 1));
				if($pipeline){
					$json['success'] = true;
					$json['message'] = 'Moved to Pipelined';
				} else {
					$json['error'] = true;
					$json['message'] = 'Candidate Not Moved to Pipeline!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'Candidate Job data Not Found';
			}
		}

		echo json_encode($json);
	}

    //Archive
    public function archive($candidate_job_id){
    	$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$filter_data = array(
				'applied' => 1,
			);
			$job = $this->model_job->getCandidateJob($candidate_job_id, $filter_data);
			if($job){
				$archive = $this->model_job->setCandidateJobActivity($job->candidate_job_id, array('archived' => 1));
				if($archive){
					$json['success'] = true;
					$json['message'] = 'Moved to Archived';
				} else {
					$json['error'] = true;
					$json['message'] = 'Candidate Not Moved to Archive!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'Candidate Job data Not Found';
			}
		}

		echo json_encode($json);
	}

    //Schedule
	public function schedule($candidate_job_id){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$filter_data = array(
                'applied' => 1,
				'shortlisted' => 1,
			);
			$job = $this->model_job->getCandidateJob($candidate_job_id, $filter_data);
			if($job){
			    $schedule_data = array(
			        'sdate' => dbdate_format($this->input->post('schedule_date')),
			        'stime' => $this->input->post('schedule_time'),
			        'svenue' => $this->input->post('schedule_venue'),
			    );
				$shortlist = $this->model_job->setCandidateJobSchedule($job->candidate_job_id, array('schedule_details' => $schedule_data));
				if($shortlist){
                    $this->sendScheduleMail($job);

                    //Set Notification
                    $message = 'Iterview was scheduled for '. $job->title .' by ' . $this->company->company_name;
                    $link = '';
                    $this->setNotification($job->user_id, $message, $link);

					$json['success'] = true;
					$json['message'] = 'Candidate Interview Scheduled';
				} else {
					$json['error'] = true;
					$json['message'] = 'Candidate Interview Not Scheduled!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'Candidate Job data Not Found';
			}
		}

		echo json_encode($json);
	}

	/*public function scheduled(){
		$data = array();

		$this->load->helper('category'); // Load category helper

		//Get Page Number
        if($this->uri->segment(5)) {
            $page = (int)$this->uri->segment(5);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['moduleAction'] = 'company';
		$data['logged'] = true;
        $data['heading_title'] = 'Candidates Scheduled Interview ';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'company/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Candidates Scheduled Interview',
			'href' => base_url() . 'company/activity/candidate/scheduled'
		);
		$data['active_menu'] = 'mnu-candidate-scheduled-interview';
		$data['menu_section'] = $this->menu_section;

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		// Get Company
		$company_id = $this->company->company_id;
		$data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

		$data['jobs'] = array();
		//Filter Data
    	$filter_data = array(
    		'scheduled' => 1,
    		'removed' => 0,
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'cj.candidate_job_id',
			'order' => 'ASC'
		);
		// Get Job List
		$total_jobs = $this->model_job->getTotalCandidateJobs($company_id, $filter_data);
		$jobs = $this->model_job->getCandidateJobs($company_id, $filter_data);

		if($jobs){
			foreach($jobs as $job){

				//Load Image
    			if($job->candidate_image && file_exists(APPPATH . 'assets/uploads/logo/' . $job->candidate_image)){
    				$thumb = base_url() . 'application/assets/uploads/logo/' . $job->candidate_image;
    			} else {
    				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
    			}

				//Load Resume
				$candidate_resume = '';
				if($job->candidate_image){
					if(file_exists(APPPATH . 'assets/images/candidate/resume/' . $job->candidate_resume)){
						$candidate_resume = base_url() . 'application/assets/images/candidate/resume/' . $job->candidate_resume;
					}
				}

                $schedule_details = $job->cj_schedule_details ? json_decode($job->cj_schedule_details) : '';

				$data['jobs'][] = array(
					'job_id' => $job->job_id,
					'candidate_name' => $job->candidate_name,
					'title' => $job->title,
					'thumb' => $thumb,
					'location' => $job->location,
					'job_type' => get_job_type($job->job_type),
					'resume' => $candidate_resume,
					'schedule_date' => isset($schedule_details->sdate) ? view_date_format($schedule_details->sdate) : '',
					'schedule_time' => isset($schedule_details->stime) ? $schedule_details->stime : '',
					'schedule_venue' => isset($schedule_details->svenue) ? $schedule_details->svenue : '',
					'remove' => base_url() . 'company/activity/candidate/remove/' . $job->candidate_job_id
				);
			}
		}

		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'company/candidate/scheduled/';
		$config['total_rows'] = $total_jobs;
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['attributes'] = array('class' => 'page-numbers');

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('header');
		$this->load->view('company/activity/candidate_scheduled', $data);
		$this->load->view('footer');
	}*/

    //Finish/Complete
    public function complete($candidate_job_id){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$filter_data = array(
				'applied' => 1,
                'scheduled' => 1
			);
			$job = $this->model_job->getCandidateJob($candidate_job_id, $filter_data);
			if($job){
                $scheduled_data = array();
                $schedule_data = $job->cj_schedule_details ? json_decode($job->cj_schedule_details) : '';
                if($schedule_data){
                    $scheduled_data = array(
                        'sdate' => $schedule_data->sdate,
            	        'stime' => $schedule_data->stime,
    			        'svenue' => $schedule_data->svenue,
                        'scomments' => $this->input->post('schedule_comments')
                    );
                }

				$complete = $this->model_job->setCandidateJobComplete($job->candidate_job_id, array('scheduled_details' => $scheduled_data));
				if($complete){
                    //$this->sendCompleteMail($job);
					$json['success'] = true;
					$json['message'] = 'Candidate job interview status updated';
				} else {
					$json['error'] = true;
					$json['message'] = 'Candidate job interview status not updated!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'Candidate Job data Not Found';
			}
		}

		echo json_encode($json);
	}

	public function remove($candidate_job_id){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$filter_data = array(
				'applied' => 1,
			);
			$job = $this->model_job->getCandidateJob($candidate_job_id, $filter_data);
			if($job){
				$removed = $this->model_job->setCandidateJobActivity($job->candidate_job_id, array('removed' => 1));
				if($removed){
					$json['success'] = true;
					$json['message'] = 'Candidate Job Removed';
				} else {
					$json['error'] = true;
					$json['message'] = 'Candidate Job Not Removed!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'Candidate Job data Not Found';
			}
		}

		echo json_encode($json);
	}

	protected function validate() {
		//Check if company user is loggedin or not
		$this->user_id = $this->recruiter->isLogged();
		if(!$this->user_id) {
			redirect(base_url() . 'login');
		} else {
			$this->loadDetails();
		}

		$profile_status = $this->getProfileStatus('company');
		if(!$profile_status){
			$this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
			redirect(base_url() . 'company/profile?redirect='. $this->page_name);
		}
	}

	protected function loadDetails(){
		$this->load->helper('user'); // Load user helper
        $this->load->model('company/Company_model', 'model_company');   //Load company model
        $this->load->model('company/Jobs_model', 'model_job'); //Load company jobs model
		$this->company = $this->model_company->getCompany($this->user_id);
	}


	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type){
		if($this->user_id){
			$this->company = $this->model_company->getCompany($this->user_id);
			$profile_progress = get_profile_status($this->company, $type);
			if($profile_progress < 80 ){
				return false;
			} else {
				return $profile_progress;
			}
		} else {
			return true;
		}
	}

    protected function sendShortlistMail($job){
        $this->load->model('candidate/Candidate_model', 'model_candidate');
        $jobz = $this->model_job->getCandidateJob($job->candidate_job_id, array('shortlist' => 1));
        $candidate = $this->model_candidate->getCandidateById($job->candidate_id);
        if($candidate && $jobz){
            $data['candidate'] = array(
                'name' => $candidate->first_name . ' ' . $candidate->last_name
            );

            //Job
            $data['job'] = array(
                'title' => $jobz->title,
            );

            //Company
            $data['company'] = array(
                'user' => $this->company->first_name . ' ' . $this->company->last_name,
                'company_name' => $this->company->company_name
            );

            //SMTP mail configuration
            $this->config->load('smtp');  // Load SMTP Config data

            $config['protocol']    = 'smtp';

            $config['smtp_host']    = $this->config->item('host', 'smtp');

            $config['smtp_port']    = $this->config->item('port', 'smtp');

            $config['smtp_timeout'] = $this->config->item('timeout', 'smtp');

            $config['smtp_user']    = $this->config->item('user', 'smtp');

            $config['smtp_pass']    = $this->config->item('pass', 'smtp');

            $config['charset']    = 'utf-8';

            $config['mailtype'] = 'html'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);
            $this->email->from('admin@mentric.co.in', '45+ Jobs');
            $this->email->to($candidate->email);
            $this->email->subject('Job Application shortlisted');
            $html = $this->load->view('company/mail/candidate_shortlist', $data, TRUE);
            $this->email->message($html);


            if($this->email->send()) {
            	return true;
	        } else {
	        	return false;
	        }
        }
    }

    protected function sendScheduleMail($job){
        $this->load->model('candidate/Candidate_model', 'model_candidate');
        $jobz = $this->model_job->getCandidateJob($job->candidate_job_id, array('scheduled' => 1));
        $candidate = $this->model_candidate->getCandidateById($job->candidate_id);
        if($candidate && $jobz){
            $data['candidate'] = array(
                'name' => $candidate->first_name . ' ' . $candidate->last_name
            );

            //Job
            $schedule_details = $jobz->cj_schedule_details ? json_decode($jobz->cj_schedule_details) : array();
            $schedule_date = isset($schedule_details->sdate) ? $schedule_details->sdate : '';
            $schedule_time = isset($schedule_details->stime) ? $schedule_details->stime : '';
            if($schedule_date && $schedule_time){
                $schedule_datetime = date('d F, Y \a\t H:i A', strtotime($schedule_details->sdate . ' ' .$schedule_details->stime));
            } else {
                $schedule_datetime = date('d F, Y \a\t H:i A');
            }



            $data['job'] = array(
                'title' => $jobz->title,
                'schedule_venue' => isset($schedule_details->svenue) ? $schedule_details->svenue : '',
                'schedule_datetime' => $schedule_datetime
            );

            //Company
            $data['company'] = array(
                'user' => $this->company->first_name . ' ' . $this->company->last_name,
                'company_name' => $this->company->company_name
            );

            //SMTP mail configuration
            $this->config->load('smtp');  // Load SMTP Config data

            $config['protocol']    = 'smtp';

            $config['smtp_host']    = $this->config->item('host', 'smtp');

            $config['smtp_port']    = $this->config->item('port', 'smtp');

            $config['smtp_timeout'] = $this->config->item('timeout', 'smtp');

            $config['smtp_user']    = $this->config->item('user', 'smtp');

            $config['smtp_pass']    = $this->config->item('pass', 'smtp');

            $config['charset']    = 'utf-8';

            $config['newline']    = "\r\n";

            $config['mailtype'] = 'html'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);
            $this->email->from('admin@mentric.co.in', '45+ Jobs');
            $this->email->to($candidate->email);
            $this->email->subject('Interview Invitation');
            $html = $this->load->view('company/mail/candidate_schedule_interview', $data, TRUE);
            $this->email->message($html);


            if($this->email->send()) {
                return true;
	        } else {
	        	return false;
	        }
        }
    }

    //Set Notification
    protected function setNotification($receiver_id, $message, $link){
        $notification_data = array(
            'sender_id' => $this->user_id,
            'receiver_id' => $receiver_id,
            'message' => $message,
            'link' => $link,
            'publish' => 0,
        );
        $notifications = $this->model_notification->addNotification($notification_data); // Add Notification
    }
}
