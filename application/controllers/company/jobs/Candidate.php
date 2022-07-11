<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {
    private $page_name = 'jobposts';
    private $user_id;
    private $company = array();
    private $menu_section='job_seeker';

    public function __construct(){
        parent::__construct();
        $this->load->library('recruiter');
        $this->validate();
    }

    public function index(){
        $this->getJobPostList();
    }

    public function post($job_action='list', $job_id=0){
        switch($job_action){
            case 'view':
                $this->viewJobPost($job_id);
                break;
            case 'add':
              $this->addJobPost();
               break;
           case 'edit':
               $this->editJobPost($job_id);
               break;
           case 'notify':
               $this->notifyJobPost($job_id);
               break;
           case 'remove':
               $this->removeJobPost($job_id);
               break;
           case 'delete':
               $this->deleteJobPost($job_id);
               break;
           default:
               $this->getJobPostList();
        }
    }

    protected function getJobPostList(){
        $data = array();

        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css'); //AddCss
        $data['logged'] = $this->recruiter->isLogged();
        $data['heading_title'] = 'Jobs';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Jobseeker Jobs',
            'href' => base_url() . 'company/jobs'
        );
        $data['active_menu'] = 'mnu-jobs';
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
        $company_id = $this->company->company_id;
        $data['user'] = get_user_account($this->user_id);
        $data['profile_link'] = base_url(). 'company/profile';
        $data['profile_progress'] = get_profile_status($this->company, 'company');


        //Sidebar Filter Datas
        $this->load->helper('jobcategories');
        $data['categories'] = loadJobCategories($type='job');

        $data['moduleAction'] = 'company';
        $data['loadActiveJobs'] = base_url() . 'company/jobs/candidate/activeJobs';
        $data['loadInactiveJobs'] = base_url() . 'company/jobs/candidate/inactiveJobs';

        $this->load->view('header', $data);
        $this->load->view('company/activity/candidate/jobs');
        $this->load->view('footer');
    }

    public function activeJobs(){
        $json=array();
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            //print_r($this->uri->segment_array());
            //Get Page Number
            if($this->uri->segment(5)) {
                $page = (int)$this->uri->segment(5);
            } else {
                $page = 1;
            }

            $limit = 10;
            $json['jobs'] = array();
            $json['jobs']['pagination'] = '';
            $jobs = $this->loadJobs(array('limit' => $limit, 'page' => $page, 'status' => 1));
            if($jobs){
                $jList = $jobs->list;
                //Pagination
                $this->load->library('pagination');

                $config['base_url'] = base_url() . 'company/jobs/candidate/activeJobs/';
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
        }
        echo json_encode($json);
    }

    public function inactiveJobs(){
        $json=array();
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            //Get Page Number
            if($this->uri->segment(5)) {
                $page = (int)$this->uri->segment(5);
            } else {
                $page = 1;
            }

            $limit = 10;
            $json['jobs'] = array();
            $json['jobs']['pagination'] = '';
            $jobs = $this->loadJobs(array('limit' => $limit, 'page' => $page, 'status' => 0));
            if($jobs){
                $jList = $jobs->list;
                //Pagination
                $this->load->library('pagination');

                $config['base_url'] = base_url() . 'company/jobs/candidate/activeJobs/';
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
        }
        echo json_encode($json);
    }

    protected function loadJobs($filter){
        $company_id = $this->company->company_id;
        $this->load->helper('category');
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');

        //Filter Data
        $filter_data = array(
            'start' => ($filter['limit'] * ($filter['page'] - 1)),
            'limit' => $filter['limit'],
            'status' => $filter['status'],
            'sort' => 'job_id',
            'order' => 'DESC',
            'filter_date_from' => date('Y-m-d', strtotime('-' . $this->config->item('CJLTS'))),
            'filter_date_to' => date('Y-m-d')
        );
        // Get Jobs List
        $jobsList = array();
        $total_jobs = $this->model_job->getTotalJobs($company_id, $filter_data);
        $jobs = $this->model_job->getJobs($company_id, $filter_data);
        if($jobs){
            foreach($jobs as $job){

                //Filter Data
                $cfilter_data = array(
                    'job_id' => $job->job_id,
                    'applied' => 1,
                    'removed' => 0,
                    'sort' => 'cj.candidate_job_id',
        			'order' => 'DESC'
        		);
        		// Get Job List
        		$total_applied_jobs = $this->model_job->getTotalCandidateJobs($company_id, $cfilter_data);

                $job_typess = array();
                $job_types = $job->job_type ? json_decode($job->job_type) : array();
                if($job_types){
                    foreach($job_types as $job_type){
                        $jobtype = $this->model_jobcategory->getCategory($job_type);

                        if(isset($jobtype->name)){
                            $job_typess[] = $jobtype->name;
                        }
                    }
                }
                
                if($job->date_modified && $job->date_modified != '0000-00-00 00:00:00'){
                    $date_posted = $job->date_modified;
                } else {
                    $date_posted = $job->date_added;
                }
                    
                $jobsList[] = array(
                    'title' => $job->title,
                    'location' => $job->location,
                    'job_types' => $job_typess ? implode(', ', $job_typess) : '',
                    'expiry_date' => ($job->job_expiry_date && $job->job_expiry_date != '0000-00-00') ? date('M d, Y', strtotime($job->job_expiry_date)) : '',
                    'status' => $job->status ? $this->lang->line('active') : $this->lang->line('inactive'),
                    'view' => base_url() . 'company/jobs/candidate/post/view/'. $job->job_id,
                    'edit' => base_url() . 'company/jobs/candidate/post/edit/'. $job->job_id,
                    'remove' => base_url() . 'company/jobs/candidate/post/remove/'. $job->job_id,
                    'total_applied_jobs' => $total_applied_jobs,
                    'date_posted' => date('M d, Y', strtotime($date_posted))
                );
            }
        }

        return (object)array(
            'total' => $total_jobs,
            'list' => $jobsList
        );
    }

	protected function getJobPostForm($job_id=0) {

        $data['logged'] = true;
        $data['heading_title'] = 'Job Post';    //Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'company/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Jobs',
			'href' => base_url() . 'company/jobs/candidate/post'
		);
		$data['active_menu'] = 'mnu-jobs-post';
        $data['menu_section'] = $this->menu_section;

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$data['company'] = array();
		$company = $this->company;
		if($company){
			//Load Image
			if($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)){
				$thumb = base_url() . 'application/assets/uploads/logo/' . $company->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

            $company_category = array(
                'label' => '',
                'value' => '',
            );

			$data['company'] = array(
				'name' => $company->company_name? $company->company_name : '',
				'email' => $company->email,
				'thumb' => $thumb,
				'company_category' => $company_category,
				'status' => $company->status,
			);
		}

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

		//Company Categories
		$this->load->helper('category');

		$this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Category Model
        $this->load->model('admin/Industry_model', 'model_industry');   // Load Industry Model

        // Get Job
        $data['job'] = array();
        $job = $this->model_job->getJob($job_id);
        if($job_id && $this->input->server('REQUEST_METHOD') != 'POST'){
            $data['form_action'] = base_url() . 'company/jobs/candidate/post/edit/'.$job_id;
        } else {
            $data['form_action'] = base_url() . 'company/jobs/candidate/post/add';
        }


        if(isset($job->job_id)){
            $data['job']['job_id'] = $job_id;
        } else {
            $data['job']['job_id'] = 0;
        }


        if(isset($job->title)){
            $data['job']['title'] = $job->title;
        } else {
            $data['job']['title'] = '';
        }

        if(isset($job->company_logo)){
            $data['job']['thumb'] = $thumb;
        } else {
            $data['job']['thumb'] = '';
        }

        if(isset($job->location)){
            $data['job']['location'] = $job->location;
        } else {
            $data['job']['location'] = '';
        }

        $job_skills = array();
        if(isset($job->skills)){
            $skills = $job->skills ? json_decode($job->skills) : array();
            if($skills){
                foreach($skills as $skill){
                    $jobskill = $this->model_jobcategory->getCategory($skill);
                    if($jobskill){
                        $job_skills[] = $jobskill;
                    }
                }
            }
            $data['job']['job_skills'] = $job_skills;
        } else {
            $data['job']['job_skills'] = $job_skills;
        }


        $job_qualifications = $this->model_job->getJobQualifications($job_id);
        if($job_qualifications){
            $data['job']['job_qualifications'] = $job_qualifications;
        } else {
            $data['job']['job_qualifications'] = array();
        }

        $companycategory = array('label' => '','value' => '');
        if(isset($job->company_category)){
            $company_category = $this->model_industry->getIndustry($job->company_category);  // Company Category
            if($company_category){
                $companycategory['label'] = $company_category->industry_name;
                $companycategory['value'] = $company_category->id;
            }
            $data['job']['company_category'] = $companycategory;
        } else {
            $data['job']['company_category'] = $companycategory;
        }

        if(isset($job->job_category)){
            $data['job']['job_category'] = $job->job_category;
        } else {
            $data['job']['job_category'] = '';
        }

        $job_technologies = array();
        if(isset($job->technology)){
            $technologies = $job->technology ? json_decode($job->technology) : array();
            if($technologies){
                foreach($technologies as $technology){
                    $jobtechnology = $this->model_jobcategory->getCategory($technology);
                    if($jobtechnology){
                        $job_technologies[] = $jobtechnology;
                    }
                }
            }
            $data['job']['job_technology'] = $job_technologies;
        } else {
            $data['job']['job_technology'] = $job_technologies;
        }

        $job_certifications = array();
        if(isset($job->certification)){
            $certifications = $job->certification ? json_decode($job->certification) : array();
            if($certifications){
                foreach($certifications as $certification){
                    $jobcertification = $this->model_jobcategory->getCategory($certification);
                    if($jobcertification){
                        $job_certifications[] = $jobcertification;
                    }
                }
            }
            $data['job']['job_certification'] = $job_certifications;
        } else {
            $data['job']['job_certification'] = $job_certifications;
        }

        if(isset($job->keyword)){
            $data['job']['keyword'] = $job->keyword;
        } else {
            $data['job']['keyword'] = '';
        }

        if(isset($job->salary_package_from)){
            $data['job']['salary_package_from'] = $job->salary_package_from ? $job->salary_package_from : '';
        } else {
            $data['job']['salary_package_from'] = '';
        }

        if(isset($job->salary_package_to)){
            $data['job']['salary_package_to'] = $job->salary_package_to ? $job->salary_package_to : '' ;
        } else {
            $data['job']['salary_package_to'] = '';
        }

        if(isset($job->salary_package_period)){
            $data['job']['salary_package_period'] = $job->salary_package_period;
        } else {
            $data['job']['salary_package_period'] = '';
        }

        //Check salary period value
        $salary_periodvalue =  get_salary_periodvalue($data['job']['salary_package_period']);
        if($data['job']['salary_package_from'] && $salary_periodvalue){
            $data['job']['salary_package_from'] = ($data['job']['salary_package_from'] / $salary_periodvalue);
        }
        if($data['job']['salary_package_to'] && $salary_periodvalue){
            $data['job']['salary_package_to'] = ($data['job']['salary_package_to'] / $salary_periodvalue);
        }

        if(isset($job->job_type)){
            $job_types = $job->job_type ? json_decode($job->job_type) : array();    // Job Types
            $data['job']['job_type'] = $job_types;
        } else {
            $data['job']['job_type'] = array();
        }

        if(isset($job->gender)){
            $data['job']['gender'] = $job->gender;
        } else {
            $data['job']['gender'] = '';
        }

        if(isset($job->notice_period)){
            $data['job']['notice_period'] = $job->notice_period;
        } else {
            $data['job']['notice_period'] = '';
        }

        if(isset($job->experience)){
            $data['job']['experience'] = $job->experience;
        } else {
            $data['job']['experience'] = '';
        }

        if(isset($job->benefits)){
            $data['job']['benefits'] = $job->benefits;
        } else {
            $data['job']['benefits'] = '';
        }

        if(isset($job->description)){
            $data['job']['description'] = $job->description;
        } else {
            $data['job']['description'] = '';
        }

        if(isset($job->job_vacancy)){
            $data['job']['job_vacancy'] = $job->job_vacancy;
        } else {
            $data['job']['job_vacancy'] = '';
        }

        if(isset($job->job_expiry_date)){
            $data['job']['expiry_date'] = ($job->job_expiry_date && $job->job_expiry_date != '0000-00-00') ? date_picker_format($job->job_expiry_date) : '';
        } else {
            $data['job']['expiry_date'] = '';
        }

        if(isset($job->status) && $job){
            $data['job']['status'] = (int)$job->status;
        } else {
            $data['job']['status'] = '';
        }


        // Get Details
		$data['genders'] = get_genders();
		$data['salary_periods'] = get_salary_periods();
		$filter_data = array(
			'status' => 1
		);

		$data['job_categories'] = $this->model_jobcategory->getCategories(JOB_DEPARTMENT_TYPE, $filter_data);

		$data['job_designations'] = $this->model_jobcategory->getCategories(JOB_DESIGNATION_TYPE, $filter_data);

		$data['job_types'] = $this->model_jobcategory->getCategories(JOB_TYPE, $filter_data);

		$data['qualifications'] = $this->model_jobcategory->getCategories(QUALIFICATION_TYPE, $filter_data);

		$data['technologies'] = $this->model_jobcategory->getCategories(TECHNOLOGY_TYPE, $filter_data);

		$data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, $filter_data);

		$data['notice_periods'] = $this->model_jobcategory->getCategories(NOTICE_PERIOD_TYPE, $filter_data);

		$data['certifications'] = $this->model_jobcategory->getCategories(CERTIFICATION_TYPE, $filter_data);

		$data['keywords'] = $this->model_jobcategory->getCategories(KEYWORD_TYPE, $filter_data);

        $data['moduleAction'] = 'company';

		$this->load->view('header', $data);
		$this->load->view('company/activity/candidate/jobpost');
		$this->load->view('footer');
	}

	protected function viewJobpost($job_id){
	    $this->load->helper('category');    // Load category helper

        //Get Page Number
        if($this->uri->segment(7)) {
            $page = (int)$this->uri->segment(7);
        } else {
            $page = 1;
        }

		$limit = 10;

        $this->document->addStyle(base_url() . 'application/assets/css/include/jobview.css'); //AddCss
        //Filter Status
        if($this->input->get('filter_cj_status')) {
            $filter_cj_status = $this->input->get('filter_cj_status');
        } else {
            $filter_cj_status = '';
        }

		$data['logged'] = true;
        $data['job_id'] = $job_id;
        $data['heading_title'] = 'Job View';    //Heading Title
		$data['breadcrumb'] = array();	//Breadcrumb
		$data['breadcrumb'][] = array(
			'name' => 'Home',
			'href' => base_url() . 'company/dashboard'
		);
        $data['breadcrumb'][] = array(
    		'name' => 'Jobs',
			'href' => base_url() . 'company/jobs/candidate/post'
		);

		$data['active_menu'] = 'mnu-jobs-view';
        $data['menu_section'] = $this->menu_section;

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$data['company'] = array();
		$company = $this->company;
		if($company){
			//Load Image
			if($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)){
				$thumb = base_url() . 'application/assets/uploads/logo/' . $company->image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

			$data['company'] = array(
				'name' => $company->company_name? $company->company_name : '',
				'email' => $company->email,
				'thumb' => $thumb,
				'status' => $company->status,
			);
		}

        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Category Model
        $this->load->model('admin/Industry_model', 'model_industry');   // Load Industry Model

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        // Get Job
        $loadappliedJobs = '';
        $data['job'] = array();
        $job = $this->model_job->getJob($job_id, array());

        $data['candidates'] = array();

        if($job){
            /*** Company jobpost **/

            $data['breadcrumb'][] = array(
        		'name' => $job->title,
    			'href' => base_url() . 'company/jobs/candidate/post/view/' . $job_id
    		);

			$company_category = $this->model_industry->getIndustry($job->company_category);  // Company Category
			$job_category = $this->model_jobcategory->getCategory($job->job_category);  // Job Category
			$gender = get_gender($job->gender); // Gender

            // Job Types
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

            $experience = $this->model_jobcategory->getCategory($job->experience);  // Experience
            $notice_period = $this->model_jobcategory->getCategory($job->notice_period);    // Notice Period

            $salary_package = array();
            if($job->salary_package_from){
                $salary_package = array(
                    'code' => $job->salary_package_from . '-' . get_salary_period($job->salary_package_period),
                    'name' => format_currency($job->salary_package_from) . ' - ' . format_currency($job->salary_package_to) . ' ' . get_salary_period($job->salary_package_period)
                );
            } else {
                if($job->salary_package_to){
                    $salary_package = array(
                        'code' => $job->salary_package_to . '-' . get_salary_period($job->salary_package_period),
                        'name' => format_currency($job->salary_package_to) . ' ' . get_salary_period($job->salary_package_period)
                    );
                }
            }

            //Get Job Skills
            $job_skills = array();
            $skills = $job->skills ? json_decode($job->skills) : array();
            if($skills){
                foreach($skills as $skill){
                    $skillz = $this->model_jobcategory->getCategory($skill);
                    if($skillz){
                        $job_skills[] = $skillz->name;
                    }
                }
            }

            //Get Job Technologies
            $job_technologies = array();
            $technologies = $job->technology ? json_decode($job->technology) : array();
            if($technologies){
                foreach($technologies as $technology){
                    $jobtechnology = $this->model_jobcategory->getCategory($technology);
                    if($jobtechnology){
                        $job_technologies[] = $jobtechnology->name;
                    }
                }
            }

            //Get Job  certifications
            $job_certifications = array();
            $certifications = $job->certification ? json_decode($job->certification) : array();
            if($certifications){
                foreach($certifications as $certification){
                    $jobcertification = $this->model_jobcategory->getCategory($certification);
                    if($jobcertification){
                        $job_certifications[] = $jobcertification->name;
                    }
                }
            }
            $job_qualifications = array();
            $qualifications = $this->model_job->getJobQualifications($job->job_id);
            if($qualifications){
                foreach($qualifications as $qualification){
                    $qualificationz = $this->model_jobcategory->getCategory($qualification->qualification);
                    if(isset($qualificationz->name)){
                        $qualification_name =  $qualificationz->name;
                    } else {
                        $qualification_name =  '';
                    }

                    $job_qualifications[] = array(
                        'qualification' =>  $qualification_name,
                        'specialization' => $qualification->specialization
                    );
                }
            }

            $data['job'] = array(
                'job_id' => $job->job_id,
				'title' => $job->title,
				'thumb' => $thumb,
				'location' => $job->location,
				'job_skills' => $job_skills ? $job_skills : array(),
				'job_technology' => $job_technologies ? implode(', ', $job_technologies) : '',
				'job_certification' => $job_certifications ? implode(', ', $job_certifications) : '',
				'job_qualifications' => $job_qualifications ? $job_qualifications : array(),
				'company_category' => isset($company_category->industry_name) ? $company_category->industry_name : '' ,
				'job_category' => isset($job_category->name) ? $job_category->name : '' ,
				'salary_package' => $salary_package,
				'job_type' => $jobtypess ? $jobtypess : array(),
				'gender' => $gender ? $gender : '',
				'notice_period' => isset($notice_period->name) ? $notice_period->name : '',
				'experience' => isset($experience->name) ? $experience->name : '',
				'description' => $job->description,
				'benefits' => $job->benefits,
				'expiry_date' => $job->job_expiry_date ? date('M d, Y', strtotime($job->job_expiry_date)) : ''
            );

            $loadappliedJobs = base_url() . 'company/activity/candidate/applied/'.$job_id;
        }

        $data['loadappliedJobs'] = $loadappliedJobs;

        $data['job_processes'] = get_jobseeker_processes();
        $data['moduleAction'] = 'company';

        $data['filter_cj_status'] = $filter_cj_status;

		$this->load->view('header', $data);
		$this->load->view('company/activity/candidate/jobpost_view');
		$this->load->view('footer');
	}

    protected function notifyJobPost($job_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST'){

		    $this->load->helper('category'); // Load category helper

    		$json['candidates'] = array();
    		$job = $this->model_job->getJob($job_id, array('status' => 1));
            if($job){

                //Filter Skills
                if($job->skills){
                    $cskills = ($job->skills) ? json_decode($job->skills) : array();
                    $filter_skills = $cskills;
                } else {
                    $filter_skills = array();
                }

                //Filter Experience
                $filter_experience = $job->experience;

                //Filter Job Type
                if($job->job_type){
                    $filter_jobtypes = array($job->job_type);
                } else {
                    $filter_jobtypes = '';
                }

                //Filter Location
                if($job->location){
                    $filter_location = $job->location;
                } else {
                    $filter_location = '';
                }

                //Filter Gender
                if($job->gender){
                    $filter_genders = $job->gender;
                } else {
                    $filter_genders = '';
                }

                $filter_qualifications = $this->model_job->getJobQualifications($job_id);
                $job_qualifications = array();
                if($job_qualifications){
                    foreach($filter_qualifications as $qualification){
                        $job_qualification = $this->model_jobcategory->getCategory($qualification);
                        $filter_qualifications[] = isset($job_qualification->qualification) ? $job_qualification->qualification : '';
                    }
                }

                $filter_data = array(
                    //'filter_skills' => $filter_skills,
                    'filter_location' => $filter_location,
                    'filter_gender' => get_genderid_by_name($filter_genders),
                    //'filter_experience' => isset($filter_experience->category_id) ? $filter_experience->category_id : '',
                    //'filter_qualification' => $filter_qualifications,
                    //'filter_jobtypes' => $filter_jobtypes,
                    //'candidate_filter' => ($filter_jobtypes || $filter_skills || $filter_qualifications) ? 'join' : 'none',
                    'sort' => 'c.candidate_id',
                    'order' => 'DESC'
                );

                // Get Candidate List
                $candidates = $this->model_job->getCandidates($filter_data);

                if($candidates){
                    $this->load->model('Notification_model', 'model_notification'); // Load Notification Model
                    foreach($candidates as $candidate){
                        $message = $this->company->company_name . ' posted a '. $job->title .'job';
                        $link = '';
                        $notification_data = array(
                            'sender_id' => $this->user_id,
                            'receiver_id' => $candidate->user_id,
                            'message' => $message,
                            'link' => $link,
                            'publish' => 0,
                        );
                        $notifications = $this->model_notification->addNotification($notification_data); // Add Notification
                    }
                }
            }
        }

		echo json_encode($json);
	}

	protected function addJobPost(){
	    if($this->input->server('REQUEST_METHOD') == 'POST') {
	        $json = array();
			$qualifications = $this->input->post('job_qualifications');
			$job_skills = $this->input->post('job_skills');
			$job_types = $this->input->post('job_type');
			$job_technology = $this->input->post('job_technology');

			$job_id = $this->model_job->addJob($this->company->company_id);
			if($job_id) {
			    $this->setCandidateJobFilters($job_id,'filter_skill', $job_skills); //Add filter skills
			    $this->setCandidateJobFilters($job_id,'filter_jobtype', $job_types); //Add filter jobtypes
    			$this->setCandidateJobFilters($job_id, 'filter_technology', $job_technology);    //Add filter technology

				//Add Qualifications
				if($qualifications && is_array($qualifications)){
					foreach($qualifications as $qualification){
						$this->model_job->addJobQualifications($job_id, $qualification);
					}
				}

                $this->addJobTypes($job_id);    //Add JobTypes

				$json['success'] = true;
				$json['redirect'] = base_url() . 'company/jobs/candidate/post';
				$json['message'] = 'Job Post Added Successfully';
			} else {
			    $json['error'] = true;
				$json['message'] = 'Job Post Not Added!';
			}

            echo json_encode($json);
            exit;
		}

		$this->getJobPostForm();
	}

	protected function editJobPost($job_id){
	    if($this->input->server('REQUEST_METHOD') == 'POST') {
			$qualifications = $this->input->post('job_qualifications');
			$job_skills = $this->input->post('job_skills');
			$job_types = $this->input->post('job_type');
			$job_technology = $this->input->post('job_technology');

            $job = $this->model_job->getJob($job_id);
            if($job){
                $job_edit = $this->model_job->editJob($job_id);
    			if($job_edit) {

    			    $this->setCandidateJobFilters($job_id, 'filter_skill', $job_skills); //Add filter skills
    			    $this->setCandidateJobFilters($job_id,'filter_jobtype', $job_types); //Add filter jobtypes
    			    $this->setCandidateJobFilters($job_id, 'filter_technology', $job_technology);    //Add filter technology

    				//Add Qualifications
    				if($qualifications && is_array($qualifications)){
    					foreach($qualifications as $qualification){
    						$this->model_job->addJobQualifications($job_id, $qualification);
    					}
    				}

                    $this->addJobTypes($job_id);    //Add JobTypes

    				$json['success'] = true;
    				$json['redirect'] = base_url() . 'company/jobs/candidate/post';
    				$json['message'] = 'Job Post Updated Successfully';
    			} else {
    				$this->session->userdata('error', 'Job Post Not Updated!');
    			}
            } else {
                $json['error'] = true;
				$json['message'] = 'Job Post Not Available!';
			}

			echo json_encode($json);
			exit;
		}

		$this->getJobPostForm($job_id);
	}

    protected function addJobTypes($job_id){
        $jobz = $this->model_job->getJob($job_id);
        $job_types = isset($jobz->job_type) ? json_decode($jobz->job_type) : '';
        $this->load->model('company/Candidate_jobtype_model', 'model_company_candidate_jobtype');
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
        $this->model_company_candidate_jobtype->deleteJobType($job_id);   //Delete Job Types

        if($job_types){
            foreach($job_types as $job_type){
                $jcategory = $this->model_jobcategory->getCategory($job_type);
                $jcategory_name = isset($jcategory->name) ? strtolower($jcategory->name) : '';
                $jt_details = $this->input->post($jcategory_name.'_detail');
                //print_r($jt_details);
                if($jt_details){
                    $jt_data = array(
                        'job_type' => $job_type,
                        'duration' => $jt_details['duration'],
                        'period' => $jt_details['period'],
                    );
                    $this->model_company_candidate_jobtype->addJobType($job_id, $jt_data);
                }
            }

        }

        //exit;
    }

    protected function removeJobPost($job_id){
        $json = array();
	    if($this->input->server('REQUEST_METHOD') == 'POST'){
	        $job = $this->model_job->getJob($job_id);
            if($job){
                $remove = $this->model_job->removeJob($job_id);
                if($remove){
                    $json['success'] = true;
                    $json['message'] = 'Job Removed';
                } else {
                    $json['error'] = true;
                    $data['message'] = 'Job not removed!';
                }
            } else {
                $json['error'] = true;
                $data['message'] = 'No job available!';
            }
	    }

	    echo json_encode($json);
	}

	protected function deleteJobPost($job_id){
	    $json = array();
	    if($this->input->server('REQUEST_METHOD') == 'POST'){
	        $job = $this->model_job->getJob($job_id);
            if($job){
                $remove = $this->model_job->deleteJob($job_id);
                if($remove){
                    $json['success'] = true;
                    $json['message'] = 'Job Deleted';
                } else {
                    $json['error'] = true;
                    $data['message'] = 'Job not Deleted!';
                }
            } else {
                $json['error'] = true;
                $data['message'] = 'No job available!';
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

	protected function setCandidateJobFilters($job_id, $keyword, $datas){

        if($datas && is_array($datas)){
            foreach($datas as $data){
                $filter = $this->model_job->getCandidateFilter($job_id, $keyword, $data);
                if($filter){
                     $this->model_job->updateCandidateFilter($filter->job_filter_id, $keyword, $data);
                } else {
                    $this->model_job->addCandidateFilter($job_id, $keyword, $data);
                }

            }
        }
    }

    //Recent Jobs
    public function getRecentJobs(){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $this->load->helper('category');
            $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
            $company_id = $this->company->company_id;
            //Filter Data
            $filter_data = array(
                'start' => 0,
                'limit' => 5,
                'sort' => 'job_id',
                'order' => 'DESC',
                'filter_date_from' => date('Y-m-d', strtotime('-' . $this->config->item('CJLTS'))),
                'filter_date_to' => date('Y-m-d')
            );
            // Get Jobs List
            $json['jobs'] = array();
            $jobsList = array();
            $jobs = $this->model_job->getJobs($company_id, $filter_data);
            if($jobs){

                foreach($jobs as $job){

                    //Filter Data
                    $cfilter_data = array(
                        'job_id' => $job->job_id,
                		'applied' => 1,
                		'removed' => 0,
            			'sort' => 'cj.candidate_job_id',
            			'order' => 'DESC'
            		);
            		// Get Job List
            		$total_applied_jobs = $this->model_job->getTotalCandidateJobs($company_id, $cfilter_data);

                    $job_typess = array();
                    $job_types = $job->job_type ? json_decode($job->job_type) : array();
                    if($job_types){
                        foreach($job_types as $job_type){
                            $jobtype = $this->model_jobcategory->getCategory($job_type);

                            if(isset($jobtype->name)){
                                $job_typess[] = $jobtype->name;
                            }
                        }
                    }

                    if($job->date_modified && $job->date_modified != '0000-00-00 00:00:00'){
                        $date_posted = $job->date_modified;
                    } else {
                        $date_posted = $job->date_added;
                    }

                    $jobsList[] = array(
                        'title' => $job->title,
                        'location' => $job->location,
                        'job_types' => $job_typess ? implode(', ', $job_typess) : '',
                        'expiry_date' => ($job->job_expiry_date && $job->job_expiry_date != '0000-00-00') ? date('M d, Y', strtotime($job->job_expiry_date)) : '',
                        'status' => $job->status ? $this->lang->line('active') : $this->lang->line('inactive'),
                        'view' => base_url() . 'company/jobs/candidate/post/view/'. $job->job_id,
                        'total_applied_jobs' => $total_applied_jobs,
                        'date_posted' => date('M d, Y', strtotime($date_posted))
                    );
                }

                $json['jobs'] = array(
                    'view' => base_url() . 'company/jobs/candidate/',
                    'list' => $jobsList
                );

                $json['success'] = true;
                $json['message'] = 'Jobs Available';
            } else {
                $json['error'] = true;
                $json['message'] = 'No Jobs Available';
            }
        }

        echo json_encode($json);
    }
}
