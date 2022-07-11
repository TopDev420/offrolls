<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
    private $user_id;
    private $adminArr = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); // Check if admin is loggedin

        $this->lang->load(array('admin/category'));    //Load Language
    }

    public function index(){
        $this->load->model('candidate/Jobs_model', 'model_candidate_job');

        $data = array();
        //Get Page Number
        if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['logged'] = $this->admin->isLogged(); // User Login
        $data['heading_title'] = 'Jobs';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
    		'name' => 'Home',
			'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Jobseeker Jobs',
			'href' => base_url() . 'admin/jobseeker/job'
		);

		$data['active_menu'] = 'mnu-jobseeker-job';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$data['jobs'] = array();

		//Filter Data
		$filter_data = array(
			'start' => ($limit * ($page - 1)),
			'limit' => $limit,
			'sort' => 'j.job_id',
			'order' => 'DESC'
		);
		// Get Company List
		$total_jobs = $this->model_candidate_job->getTotalJobs();
		$jobs = $this->model_candidate_job->getJobs($filter_data);

		if($jobs){

			foreach($jobs as $job) {

				//Load Image
				if($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)){
					$thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
				} else {
					$thumb = base_url() . 'application/assets/uploads/logo/default.png';
				}

				$data['jobs'][] = array(
					'title' => $job->title,
					'company_name' => $job->company_name,
                    'company_logo' => $thumb,
					'post_date' => $job->date_modified ? $job->date_modified : $job->date_added,
                    'status' => $job->status,
					'view' => base_url() . 'admin/candidate/job/view/' . $job->job_id,
				);
			}
		}


		//Pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/candidate/job/';
		$config['total_rows'] = $total_jobs;
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

		//Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);
		

        $data['no_fw'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/candidate/job_list');
		$this->load->view('footer');
	}

	public function view() {
        $this->load->helper(array('jobcategories', 'category')); //Load Jobcategories
        $this->load->model('candidate/Jobs_model', 'model_candidate_job');
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model

        $this->load->model('company/Company_model', 'model_company');   //Load company model
        $this->load->model('admin/Category_model', 'model_category');   // Load category model

        $this->load->model('Users_model', 'model_users');   // Load users model

        $this->load->model('admin/Industry_model', 'model_industry');   // Load Industry Model

        $this->load->helper('date');

        $data = array();
        //Get Page Number
        if($this->uri->segment(5)) {
            $job_id = (int)$this->uri->segment(5);
        } else {
            $job_id = 1;
        }

        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

        $data['logged'] = $this->admin->isLogged(); // User Login
        $data['heading_title'] = 'Job View';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
        	'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Candidate Job',
			'href' => base_url() . 'admin/candidate/job'
		);

        $data['breadcrumb'][] = array(
    		'name' => 'View',
			'href' => base_url() . 'admin/candidate/job/view/' . $job_id
		);

        $data['breadcrumb_actions'][] = array(
            'name' => 'Back',
            'icon' => 'fas fa-angle-double-left',
            'href' => base_url() . 'admin/candidate'
        );

		$data['active_menu'] = 'mnu-candidate-job';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

        //Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        $data['job'] = array();
        $data['job_id'] = $job_id;
        $job = $this->model_candidate_job->getJob($job_id);
        
        if($job){
            // Get Company
            $company = $this->model_company->getCompanyById($job->company_id);
            if($company){
                //Load Image
                if($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)){
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $company->image;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default.png';
                }

                $social_profiles = $this->model_users->getSocialProfiles($company->user_id);
                $data['company'] = array(
                    'company_name' => $company->company_name,
                    'email' => $company->email,
                    'mobile_number' => $company->mobile,
                    'thumb' => $thumb,
                    'description' => $company->about,
                    'company_category' => isset($company_category->name) ? $company_category->name : '',
                    'web_link' => format_weblink($company->web_link),
                    'address' => $company->address,
                    'city' => $company->city,
                    'state' => $company->state,
                    'country' => $company->country,
                    'pincode' => $company->pin_code,
                    'status' => $company->status,
                    'facebook_profile' => isset($social_profiles['facebook']) ? $social_profiles['facebook'] : '',
                    'linkedin_profile' => isset($social_profiles['linkedin']) ? $social_profiles['linkedin'] : '',
                    'instagram_profile' => isset($social_profiles['instagram']) ? $social_profiles['instagram'] : '',
                    'view' => base_url() . 'candidate/search/company/' . $company->user_id
                );

                // $candidate_job = $this->model_candidate_job->getRecentCandidateJob($candidate->candidate_id, $job->job_id);
                $candidate_job = array();

                if($candidate_job){
                    $is_applied = isset($candidate_job->cj_isApplied) ? $candidate_job->cj_isApplied : 0;
                    $is_saved = isset($candidate_job->cj_isSaved) ? $candidate_job->cj_isSaved : 0;
                } else {
                    $is_applied = 0;
                    $is_saved = 0;
                }

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

                //Salary Package
                $salary_package_from = $salary_package_to = 0;
                $salary_periodvalue =  get_salary_periodvalue($job->salary_package_period);
                if($job->salary_package_from && $salary_periodvalue){
                    $salary_package_from = ($job->salary_package_from / $salary_periodvalue);
                }
                if($job->salary_package_to && $salary_periodvalue){
                    $salary_package_to = ($job->salary_package_to / $salary_periodvalue);
                }
                if($salary_package_from){
                    $salary_package = format_currency($salary_package_from) . ' - ' . format_currency($salary_package_to) . ' ' . get_salary_period($job->salary_package_period);
                } else {
                    $salary_package = format_currency($salary_package_to) . ' ' . get_salary_period($job->salary_package_period);
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
                $qualifications = $this->model_candidate_job->getJobQualifications($job->job_id);
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
                    'company_name' => $job->company_name,
                    'title' => $job->title,
                    'thumb' => $thumb,
                    'is_applied' => $is_applied,
                    'is_saved' => $is_saved,
                    'location' => $job->location,
                    'job_skills' => $job_skills ? implode(', ', $job_skills) : '',
                    'job_technology' => $job_technologies ? implode(', ', $job_technologies) : '',
                    'job_certification' => $job_certifications ? implode(', ', $job_certifications) : '',
                    'job_qualifications' => $job_qualifications,
                    'company_category' => isset($company_category->industry_name) ? $company_category->industry_name : '' ,
                    'job_category' => isset($job_category->name) ? $job_category->name : '' ,
                    'salary_package' => $salary_package,
                    'job_type' => $jobtypess ? implode(', ', $jobtypess) : '',
                    'gender' => $gender ? $gender : '',
                    'notice_period' => isset($notice_period->name) ? $notice_period->name : '',
                    'experience' => isset($experience->name) ? $experience->name : '',
                    'description' => $job->description,
                    'benefits' => $job->benefits,
                    'expiry_date' => $job->job_expiry_date ? date('M d, Y', strtotime($job->job_expiry_date)) : '',
                    'apply_job' => base_url() . 'candidate/job/apply/' . $job->job_id,
                    'bookmark' => base_url() . 'candidate/job/bookmark/' . $job->job_id
                );
            }
        }

        $data['no_fw'] = true;

    	$this->load->view('header', $data);
		$this->load->view('admin/candidate/job_view');
		$this->load->view('footer');
    }

    protected function loadDetails(){
        $this->load->helper('user'); // Load user helper
        $this->load->model('Users_model', 'model_user');
        $this->load->model('candidate/Candidate_model', 'model_candidate');
		$this->adminArr = $this->model_user->getUser($this->user_id);
	}

    protected function validate() {
        $this->user_id = $this->admin->isLogged();
    	if(!$this->user_id) {
			redirect(base_url() . 'login');
		} else {
            $this->loadDetails();
        }
	}
}
