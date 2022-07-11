<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
    private $error = array();
    private $candidate_id;
    private $page_name = 'job';
    private $candidateArr = array();
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->load->library('candidate');
        $this->load->model('candidate/Jobs_model', 'model_job');

        $this->load->helper('category');
    }

    public function index(){
        $this->validate(); //Validate
        $this->load->helper('jobcategories'); //Load Jobcategories
        $data = array();
        $job_filter = 'none';

        $data['logged'] = true;
        $data['moduleAction'] = 'candidate';

        //Filter Job Types
        if($this->input->get('filter_jobtypes')){
            $filter_jobtypes = explode(',', $this->input->get('filter_jobtypes'));
        } else {
            $filter_jobtypes = '';
        }

        //Filter Location
        if($this->input->get('filter_location')){
            $filter_location = $this->input->get('filter_location');
        } else {
            $filter_location = '';
        }

        //Filter Job title/ category
        if($this->input->get('filter_jobcategory')){
            $filter_jobcategory = $this->input->get('filter_jobcategory');
        } else {
            $filter_jobcategory = '';
        }

        //Filter Jobtypes
        if($this->input->get('filter_jobtypes')){
            $filter_jobtypes = $this->input->get('filter_jobtypes');
        } else {
            $filter_jobtypes = '';
        }

        //Filter Gender
        if($this->input->get('filter_genders')){
            $filter_genders = $this->input->get('filter_genders');
        } else {
            $filter_genders = '';
        }

        //Filter Experiences
        if($this->input->get('filter_experiences')){
            $filter_experiences = $this->input->get('filter_experiences');
        } else {
            $filter_experiences = '';
        }

        //Filter Qualifications
        if($this->input->get('filter_qualifications')){
            $filter_qualifications = $this->input->get('filter_qualifications');
        } else {
            $filter_qualifications = '';
        }

        //Filter Salary Package
        if($this->input->get('filter_salary_packages')){
            $filter_salary_packages = $this->input->get('filter_salary_packages');
        } else {
            $filter_salary_packages = '';
        }

        $salary_packages = get_salaryrange();
        if($salary_packages){
            $filter_salary_package_from = $salary_packages['curmin'];
            $filter_salary_package_to = $salary_packages['curmax'];
        } else {
            $filter_salary_package_from = 0;
            $filter_salary_package_to = 0;
        }

        //Filter Date Posts
        if($this->input->get('filter_dateposts')){
            $filter_dateposts = $this->input->get('filter_dateposts');
        } else {
            $filter_dateposts = '';
        }


        //Get Page Number
        if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        //Get Search
        if($this->input->get('csq')) {
            $searchQuery = $this->input->get('csq');
            $searchArray = explode(',', rtrim($searchQuery,','));
            $search = $searchArray;
        } else {
            $search = array();
            $searchQuery = '';
        }

        $limit = 10;
        $data['heading_title'] = 'Search Jobs';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url()
        );
        $data['breadcrumb'][] = array(
            'name' => 'Search Jobs',
            'href' => base_url() . 'jobs'
        );

        if($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        // Get candidate
        $data['candidate'] = array();
        $candidate = $this->model_candidate->getCandidate($this->user_id);

        if($candidate){
            //Load Image
            if($candidate->image && file_exists(APPPATH . 'assets/uploads/logo/' . $candidate->image)){
                $thumb = base_url() . 'application/assets/uploads/logo/' . $candidate->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['candidate'] = array(
                'name' => $candidate->first_name . ' ' . $candidate->last_name,
                'email' => $candidate->email,
                'thumb' => $thumb,
                'status' => $candidate->status,
            );

            //Filter Location
            if($candidate->job_location){
                $filter_location = $candidate->job_location;
                $data['candidate_filter_location'] = true;
            } else {
                $filter_location = '';
                $data['candidate_filter_location'] = '';
            }

            //Filter Gender
            if($candidate->gender){
                $filter_genders = $candidate->gender;
                $data['candidate_filter_gender'] = true;
            } else {
                $filter_genders = '';
                $data['candidate_filter_gender'] = '';
            }
        }

        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model
        $data['jobs']= array();

        //Filter Data
        $filter_experience = array();
        if($filter_experiences){
            $filter_experience = $this->model_jobcategory->getCategoryByName($filter_experiences, EXPERIENCE_TYPE);
        }

        $filter_qualification = array();
        $filter_qualificationss = explode(',', $filter_qualifications);
        if($filter_qualificationss){
            foreach($filter_qualificationss as $fqualification){
                $filter_fqualification = $this->model_jobcategory->getCategoryByName($fqualification, QUALIFICATION_TYPE);
                if($filter_fqualification){
                    $filter_qualification[] = $filter_fqualification->category_id;
                }
            }
        }

        $filter_jobtype = array();
        $filter_jobtypess = explode(',', $filter_jobtypes);
        if($filter_jobtypess){
            foreach($filter_jobtypess as $fjobtype){
                $filter_fjobtype = $this->model_jobcategory->getCategoryByName($fjobtype, JOB_TYPE);
                if($filter_fjobtype){
                    $filter_jobtype[] = $filter_fjobtype->category_id;
                }
            }
        }

        $filter_data = array(
            'search' => $search,
            'filter_location' => $filter_location,
            'filter_title'=> $filter_jobcategory,
            'filter_datepost' => getDate_of_datepost_by_name($this->input->get('filter_dateposts')),
            'filter_gender' => get_genderid_by_name($filter_genders),
            'filter_experience' => isset($filter_experience->category_id) ? $filter_experience->category_id : '',
            'filter_qualification' => $filter_qualification,
            'filter_jobtypes' => $filter_jobtype,
            'job_filter' => $filter_jobtype ? 'join' : 'none',
            'filter_salary_package_from' => $filter_salary_package_from,
            'filter_salary_package_to' => $filter_salary_package_to,
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'job_id',
            'order' => 'DESC',
            'expiry_date' => date('Y-m-d')
        );

        // Get Job List
        $total_jobs = $this->model_job->getTotalJobs($filter_data);
        $jobs = $this->model_job->getJobs($filter_data);

        if($jobs){
            foreach($jobs as $job){
                if($candidate){
                    $candidate_job = $this->model_job->getRecentCandidateJob($candidate->candidate_id, $job->job_id);
                } else {
                    $candidate_job = array();
                }


                //Load Image
                if($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)){
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default.png';
                }

                if($candidate_job){
                    $is_applied = isset($candidate_job->cj_isApplied) ? $candidate_job->cj_isApplied : 0;
                    $is_saved = isset($candidate_job->cj_isSaved) ? $candidate_job->cj_isSaved : 0;
                } else {
                    $is_applied = 0;
                    $is_saved = 0;
                }

                $jobtypess = array();
                $job_types = $job->job_type ? json_decode($job->job_type) : array();
                if($job_types){
                    foreach($job_types as $job_type){
                        $jobtype = $this->model_jobcategory->getCategory($job_type);
                        if(isset($jobtype->name)){
                            $jobtypess[] = $jobtype->name;
                        }
                    }
                }
                $data['jobs'][] = array(
                    'job_id' => $job->job_id,
                    'company_name' => $job->company_name,
                    'title' => $job->title,
                    'thumb' => $thumb,
                    'is_applied' => $is_applied,
                    'is_saved' => $is_saved,
                    'location' => $job->location,
                    'expiry_date' => $job->job_expiry_date ? date('M d, Y', strtotime($job->job_expiry_date)) : '',
                    'job_type' => $jobtypess ? implode(', ', $jobtypess) : '',
                    'view_job' => base_url() . 'candidate/search/job/' . $job->job_id,
                );
            }
        }



        $data['user'] = get_user_account($this->user_id);

        //Pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'candidate/search/jobs/';
        $config['total_rows'] = $total_jobs;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['attributes'] = array('class' => 'page-numbers');
        $config['suffix'] = '?' . http_build_query($_GET,'','&');
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        $data['redirect_link'] = base_url() . 'candidate/dashboard';

        $data['searchQuery'] = $searchQuery;  // Set Search Value
        //Filter Values
        $data['filter_jobcategory'] = $filter_jobcategory;
        $data['filter_location'] = $filter_location;
        $data['filter_jobtypes'] = $filter_jobtypes;
        $data['filter_experiences'] = $filter_experiences;
        $data['filter_dateposts'] = $filter_dateposts;
        $data['filter_genders'] = $filter_genders;
        $data['filter_qualifications'] = $filter_qualifications;
        $data['filter_salary_packages'] = $filter_salary_packages;

        // //Load Filters
        // $this->load->helper('jobcategories');
        // $data['categories'] = loadJobCategories($type='job');

        $this->load->view('header', $data);
        $this->load->view('candidate/search/job');
        $this->load->view('footer');
    }

    public function apply($job_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
            $data['logged'] = true;

            $job = $this->model_job->getJob($job_id);
            if($job){

                //return candidate_job_id if job exist, otherwise add new one
                $recent_job = $this->model_job->getRecentCandidateJob($this->candidate_id, $job_id);
                if($recent_job){
    				$add = $recent_job->candidate_job_id;
				} else {
					$job_data = array(
						'candidate_id' => $this->candidate_id,
					);
					$add = $this->model_job->addCandidateJob($job_id, $job_data);
				}

				if($add){
					$applied = $this->model_job->setCandidateJobActivity($add, array('applied' => 1));
					if($applied){
                        //Set Notification
                        $message = $this->candidateArr->first_name . ' '. $this->candidateArr->first_name . ' applied for '. $job->title .'job';
                        $link = '';
                        $this->setNotification($job->user_id, $message, $link);

						$json['success'] = true;
						$json['message'] = 'Job Applied Successfully';
					} else {
						$json['error'] = true;
						$json['message'] = 'Job Not Applied!';
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

	public function bookmark($job_id){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){

			$data['logged'] = true;
			$job = $this->model_job->getJob($job_id);
			if($job){

				//return candidate_job_id if job exist, otherwise add new one
				$recent_job = $this->model_job->getRecentCandidateJob($this->candidate_id, $job_id);
				if($recent_job){
					$add = $recent_job->candidate_job_id;
				} else {
					$job_data = array(
						'candidate_id' => $this->candidate_id,
					);
					$add = $this->model_job->addCandidateJob($job_id, $job_data);
				}

				if($add){
					$saved = $this->model_job->setCandidateJobActivity($add, array('saved' => 1));
					if($saved){
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

	public function applied(){
		$this->validate(); //Validate
		$data = array();

        $data['profile_progress'] = 70;

        //Get Page Number
        if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;
        $logged = $this->candidate->isLogged();
        if($logged){
        	$data['logged'] = $logged;
        	$user_type = 'candidate';
        } else {
        	$data['logged'] = false;
        	$user_type = '';
        }

        $data['moduleAction'] = $user_type;

        $data['heading_title'] = 'Applied Job';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'candidate/dashboard'
		);
		$data['active_menu'] = 'mnu-job';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		// Get candidate
		$data['candidate'] = array();
		$candidate = $this->model_candidate->getCandidate($this->candidate_id);

		if($candidate){
			//Load Image
			if($candidate->user_image && file_exists(APPPATH . 'assets/uploads/logo/' . $candidate->user_image)){
				$thumb = base_url() . 'application/assets/uploads/logo/' . $candidate->user_image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

			$data['candidate'] = array(
				'name' => $candidate->fist_name . ' ' . $candidate->last_name,
				'email' => $candidate->email,
				'thumb' => $thumb,
				'status' => $candidate->status,
			);
		}

		$data['jobs'] = array();
		// Get Job List
		$filter_data = array(
			'applied' => 1,
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'j.job_id',
			'order' => 'DESC'
		);
		$total_jobs = $this->model_job->getTotalCandidateJobs($this->candidate_id, $filter_data);
		$jobs = $this->model_job->getCandidateJobs($this->candidate_id, $filter_data);
		if($jobs){
			foreach($jobs as $job){

				//Load Image
				if($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)){
					$thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
				} else {
					$thumb = base_url() . 'application/assets/uploads/logo/default.png';
				}

				$data['jobs'][] = array(
					'job_id' => $job->job_id,
					'company_name' => $job->company_name,
					'title' => $job->title,
					'thumb' => $thumb,
					'is_applied' => isset($candidate_job->cj_isApplied) ? $candidate_job->cj_isApplied : 0,
					'is_saved' => isset($candidate_job->cj_isSaved) ? $candidate_job->cj_isSaved : 0,
					'location' => $job->location,
					'job_type' => get_job_type($job->job_type),
					'view_job' => base_url() . 'candidate/search/job/' . $job->job_id,
					'remove_applied' => base_url() . 'candidate/job/remove_applied/' . $job->job_id,
				);
			}

		}

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->candidateArr, 'candidate');

		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'candidate/job/applied';
		$config['total_rows'] = $total_jobs;
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['attributes'] = array('class' => 'page-numbers');

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();


		$this->load->view('header', $data);
		$this->load->view('candidate/job_applied');
		$this->load->view('footer');
	}

	public function remove_applied($job_id){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
			$data['logged'] = true;
			$candidate_id = $this->candidate->getId();
			$job = $this->model_job->getJob($job_id);
			if($job){
				$jid = 0;
				//return candidate_job_id if job exist, otherwise add new one
				$recent_job = $this->model_job->getRecentCandidateJob($this->candidate_id, $job_id);
				if($recent_job){
					$jid = $recent_job->candidate_job_id;
				}

				if($jid){
					$applied = $this->model_job->setCandidateJobActivity($jid, array('applied' => 0));
					if($applied){
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

	public function bookmarked(){
		$this->validate(); // Validate
		$data = array();

        $data['profile_progress'] = 20;

        //Get Page Number
        if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['logged'] = $this->candidate->isLogged();
        $data['heading_title'] = 'Jobs Bookmarked';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'candidate/dashboard'
		);
		$data['active_menu'] = 'mnu-jobs-bookmarked';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		// Get candidate
		$data['candidate'] = array();
		$candidate = $this->model_candidate->getCandidate($this->candidate_id);

		if($candidate){
			//Load Image
			if($candidate->image && file_exists(APPPATH . 'assets/uploads/logo/' . $candidate->image)){
				$thumb = base_url() . 'application/assets/uploads/logo/' . $candidate->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

			$data['candidate'] = array(
				'name' => $candidate->fist_name . ' ' . $candidate->last_name,
				'email' => $candidate->email,
				'thumb' => $thumb,
				'status' => $candidate->status,
			);

			$data['profile_progress'] = $candidate->is_profileCompleted ? 100 : 30;
		}

        $data['jobs'] = array();
		// Get Job List
		$filter_data = array(
			'saved' => 1,
	        'applied' => 0,
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'j.job_id',
			'order' => 'DESC'
		);
		$total_jobs = $this->model_job->getTotalCandidateJobs($this->candidate_id, $filter_data);
		$jobs = $this->model_job->getCandidateJobs($this->candidate_id, $filter_data);
		if($jobs){
			foreach($jobs as $job){

				//Load Image
				if($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)){
					$thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
				} else {
					$thumb = base_url() . 'application/assets/uploads/logo/default.png';
				}

				$data['jobs'][] = array(
					'job_id' => $job->job_id,
					'company_name' => $job->company_name,
					'title' => $job->title,
					'thumb' => $thumb,
					'is_applied' => isset($candidate_job->cj_isApplied) ? $candidate_job->cj_isApplied : 0,
					'is_saved' => isset($candidate_job->cj_isSaved) ? $candidate_job->cj_isSaved : 0,
					'expiry_date' => $job->job_expiry_date ? date('M d, Y', strtotime($job->job_expiry_date)) : '',
					'location' => $job->location,
					'job_type' => get_job_type($job->job_type),
					'view_job' => base_url() . 'candidate/search/job/' . $job->job_id,
					'remove_bookmarked' => base_url() . 'candidate/job/remove_bookmarked/' . $job->job_id,
				);
			}
		}

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->candidateArr, 'candidate');

		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'candidate/job/applied';
		$config['total_rows'] = $total_jobs;
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['attributes'] = array('class' => 'page-numbers');

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$data['moduleAction'] = 'candidate';

		$this->load->view('header', $data);
		$this->load->view('candidate/job_bookmarked');
		$this->load->view('footer');
	}

    public function remove_bookmarked($job_id){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
			$data['logged'] = true;
			$candidate_id = $this->candidate->getId();
			$job = $this->model_job->getJob($job_id);
			if($job){
				$jid = 0;
				//return candidate_job_id if job exist, otherwise add new one
				$recent_job = $this->model_job->getRecentCandidateJob($this->candidate_id, $job_id);
				if($recent_job){
					$jid = $recent_job->candidate_job_id;
				}

				if($jid){
					$shortlisted = $this->model_job->setCandidateJobActivity($jid, array('saved' => 0));
					if($shortlisted){
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

	public function detail(){
		$this->validate(); // Validate
		$data = array();

        $data['profile_progress'] = 20;
        $data['logged'] = $this->candidate->isLogged();
        $data['heading_title'] = 'Job Detail';	//Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'candidate/dashboard'
		);
		$data['active_menu'] = 'mnu-job';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}


		// Get candidate
		$data['candidate'] = array();
		$candidate = $this->model_candidate->getCandidate($this->candidate->getId());

		if($candidate){
			//Load Image
			if($candidate->user_image && file_exists(APPPATH . 'assets/uploads/logo/' . $candidate->user_image)){
				$thumb = base_url() . 'application/assets/uploads/logo/' . $candidate->user_image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

			$data['candidate'] = array(
				'name' => $candidate->fist_name . ' ' . $candidate->last_name,
				'email' => $candidate->email,
				'thumb' => $thumb,
				'status' => $candidate->status,
			);

			$data['profile_progress'] = $candidate->is_profileCompleted ? 100 : 30;
		}

        $data['moduleAction'] = 'candidate';

		$this->load->view('header', $data);
		$this->load->view('candidate/job_detail');
		$this->load->view('footer');
	}

	protected function validate($type='') {
		//Check if candidate user is loggedin or not
		$this->user_id = $this->candidate->isLogged();
		if(!$this->user_id) {
			if($type == 'return'){
				$this->error['warning'] = 'Please login to your account';
			} else {
				redirect(base_url() . 'home');
			}

		} else {
			$this->loadDetails();
		}


		//Check if candidate user has verified or not
		$profile_status = $this->getProfileStatus('candidate');
		if(!$profile_status) {
			if($type == 'return'){
				$this->error['error'] = 'Please complete profile';
			} else {
				redirect(base_url() . 'candidate/profile');
			}
		}

        if($this->user_id && $this->candidate_id) {
            $candidate_resume = $this->model_candidate->getCandidateResume($this->candidate_id);
            if(!$candidate_resume){
                if($type == 'return'){
    				$this->error['error'] = 'Please complete your resume';
    			} else {
    				redirect(base_url() . 'candidate/resume');
    			}
            } else {
                if(!$candidate_resume->is_published){
                    if($type == 'return'){
        				$this->error['error'] = 'Please publish your resume';
        			} else {
        				redirect(base_url() . 'candidate/resume');
        			}
                }

            }
        }
		if($type == 'return'){
			return !$this->error;
		}
	}

    protected function loadDetails(){
		$this->load->helper('user'); // Load user helper
        $this->load->model('candidate/Candidate_model', 'model_candidate');   //Load company model
		$this->candidateArr = $this->model_candidate->getCandidate($this->user_id);
		$this->candidate_id = isset($this->candidateArr->candidate_id) ? $this->candidateArr->candidate_id : 0;
	}

	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type){
		if($this->user_id){
			$profile_progress = get_profile_status($this->candidateArr, $type);
			if($profile_progress < 80 ){
				return false;
			} else {
				return $profile_progress;
			}
		} else {
			return true;
		}
	}

    //Get Candidate similar jobs
    public function similarjobs($job_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $job = $this->model_job->getJob($job_id);
            if($job){
                $job_skills = $job->skills ? json_decode($job->skills) : '';
                $job_technology = $job->technology ? json_decode($job->technology) : '';

                $job_data = array(
                    'filter_jobs_not' => array($job_id),
                    'filter_title' => $job->title,
                    'filter_skills' => $job_skills,
                    'filter_technology' => $job_technology,
                    'filter_location' => $job->location,
                    'start' => 0,
                    'limit'=> 5,
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

	protected function loadErrors(){
		if(isset($this->error['warning'])){
			return $this->error['warning'];
		} elseif (isset($this->error['error'])) {
			return $this->error['error'];
		} else {
			return '';
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
