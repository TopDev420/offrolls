<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freelancer extends CI_Controller
{
    // private $user_id;

    public function __construct()
    {
        parent::__construct();
        //$this->load->library('recruiter');
        $this->load->library('Users');
        $this->load->helper(array('user', 'category', 'freelancer_category'));
        $this->load->model('company/Company_model', 'model_company');
        $this->load->model('company/freelancer_model', 'model_freelancer');
    }

    public function index()
    {
        $data = array();
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model

        //Get Page Number
        if ($this->uri->segment(3)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;
        $logged = $this->users->isLogged();
        $user_id = $logged;
        if ($logged) {
            $data['logged'] = $logged;
            $user_type = $this->users->getUserType();
        } else {
            $data['logged'] = false;
            $user_type = 0;
        }

        $moduleAction = getModuleAction($user_type);
        if ($moduleAction) {
            $data['moduleAction'] = $moduleAction;
        } else {
            $data['moduleAction'] = 'freelancer';
        }

        $params = array();
        //Get Search
        if ($this->input->get('csq')) {
            $searchQuery = $this->input->get('csq');
            $searchArray = explode(',', rtrim($searchQuery, ','));
            $search = $searchArray;
            $params[] = 'csq=' . $searchQuery;
        } else {
            $search = array();
            $searchQuery = '';
        }


        //Filter Location
        if ($this->input->get('filter_location')) {
            $filter_location = $this->input->get('filter_location');
            $params[]  = 'filter_location=' . $this->input->get('filter_location');
        } else {
            $filter_location = '';
        }

        //Filter Experiences
        if ($this->input->get('filter_experiences')) {
            $filter_experiences = $this->input->get('filter_experiences');
            $params[]  = 'filter_experiences=' . $this->input->get('filter_experiences');
        } else {
            $filter_experiences = '';
        }

        //Filter Languages
        if ($this->input->get('filter_languages')) {
            $filter_languages = $this->input->get('filter_languages');
            $params[]  = 'filter_languages=' . $this->input->get('filter_languages');
        } else {
            $filter_languages = '';
        }

        $data['heading_title'] = 'Company List';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url()
        );
        $data['breadcrumb'][] = array(
            'name' => 'Search freelancer',
            'href' => base_url() . 'search/freelancer'
        );

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        $this->user_id = $this->users->getId();
        $data['user'] = get_user_account($this->user_id);
        $this->company = $this->model_company->getCompany($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['redirect_link'] = base_url() . 'freelancer/dashboard';
        $qstring = $params ? ('?' . implode('&', $params)) : '';
        $data['searchQuery'] = $searchQuery;  // Set Search Value
        $data['loadSearchFreelancers'] = base_url() . 'company/search/getFreelancers' . $qstring;

        //Filter Values
        $data['filter_location'] = $filter_location;
        $data['filter_experiences'] = $filter_experiences;
        $data['filter_language'] = $filter_languages;

        // $data['freelancer_skills'] = $freelancer_skills;
        // $data['freelancer_experience'] = $freelancer_experience;
        // $data['freelancer_languages'] = $freelancer_languages;
        // $data['freelancer_location'] = $freelancer_location;

        $data['job_skills'] = $this->model_jobcategory->getCategories(SKILLS_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
        $data['job_locations'] = $this->model_jobcategory->getCategories(CITY_TYPE, array('status' => 1, 'sort' => 'j.name', 'order' => 'ASC', 'child' => true));
        $data['job_languages'] = $this->model_jobcategory->getLanguages();
        $data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
        $data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));

        $data['searchQuery'] = $searchQuery;  // Set Search Value

        $this->load->view('header', $data);
        $this->load->view('company/search/freelancer');
        $this->load->view('footer');
    }

    // public function profile($freelancer_id=0) {
    // 	if(!$freelancer_id){
    // 		redirect(base_url() . 'company/search/freelancer');
    // 	}

    // 	$data = array();

    // 	$logged = $this->recruiter->isLogged();
    //        if($logged){
    //        	$data['logged'] = $logged;
    //        } else {
    //        	$data['logged'] = false;
    //        }

    //        $data['heading_title'] = 'freelancer Search';    //Heading Title
    //    	$data['breadcrumb'] = array();	//Breadcrumb
    // 	$data['breadcrumb'][] = array(
    // 		'name' => 'Home',
    // 		'href' => base_url()
    // 	);
    // 	$data['breadcrumb'][] = array(
    // 		'name' => 'Search freelancer',
    // 		'href' => base_url() . 'search/freelancer'
    // 	);

    // 	$this->load->model('freelancer/Education_model', 'model_freelancer_education');
    // 	$this->load->model('freelancer/Experience_model', 'model_freelancer_experience');
    // 	$this->load->model('freelancer/Project_model', 'model_freelancer_project');
    // 	$this->load->model('freelancer/Certification_model', 'model_freelancer_certification');

    // 	$data['freelancer'] = array();

    // 	$freelancer = $this->model_freelancer->getfreelancerById($freelancer_id);
    //        //echo $this->db->last_query();
    //        print_r($freelancer);
    // 	if($freelancer){
    // 		$this->load->model('admin/Category_model', 'model_category');

    // 		$education = $this->model_freelancer_education->getEducations($freelancer_id);
    // 		$project = $this->model_freelancer_project->getProjects($freelancer_id);
    // 		$experience = $this->model_freelancer_experience->getExperiences($freelancer_id);
    // 		$certification = $this->model_freelancer_certification->getCertifications($freelancer_id);

    // 		if($freelancer->image){
    // 			$thumb = base_url() . 'application/assets/images/freelancer/' . $freelancer->image;
    // 		} else {
    // 			$thumb = base_url() . 'application/assets/images/freelancer/default.png';
    // 		}

    // 		if($freelancer->resume){
    // 			$resume_download = base_url() . 'application/images/freelancer/resume/'. $freelancer->resume;
    // 		} else {
    // 			$resume_download = false;
    // 		}

    // 		$skills = array();
    // 		if($freelancer->skills){

    // 			$skill_details = json_decode($freelancer->skills);
    // 			if($skill_details){
    // 				foreach ($skill_details as $skill_detail) {
    // 					$skill = $this->model_category->getCategory($skill_detail);
    // 					if($skill){
    // 						$skills[] = array(
    // 							'id' => $skill->category_id,
    // 							'name' => $skill->name
    // 						);
    // 					}
    // 				}
    // 			}
    // 		}

    // 		$personal_details = array(
    // 			//'father_name' => $freelancer->father_name,
    // 			//'mother_name' => $freelancer->mother_name,
    // 			//'dob' => $freelancer->dob,
    // 			//'gender' => $freelancer->gender,
    // 			//'nationality' => $freelancer->nationality,
    // 			'address' => $freelancer->address,
    // 		);

    // 		$data['freelancer'] = array(
    // 			'freelancer_id' => $freelancer->freelancer_id,
    // 			'first_name' => $freelancer->first_name,
    //                'last_name' => $freelancer->last_name,
    // 			'resume' => array('name' => $freelancer->resume, 'download' => $resume_download),
    // 			'thumb' => $thumb,
    // 			'about' => $freelancer->about,
    // 			'skills' => $skills,
    // 			'education' => $education,
    // 			'project' => $project,
    // 			'experience' => $experience,
    // 			'certification' => $certification,
    // 			'personal_details' => $personal_details,
    // 		);
    // 	}

    // 	$this->load->view('header', $data);
    // 	$this->load->view('company/search/freelancer_profile');
    // 	$this->load->view('footer');
    // }

    public function getFreelancers()
    {
        $json = array();
        $this->load->helper(array('jobcategories', 'date')); //Load Jobcategories
        $this->load->model('freelancer/Jobs_model', 'model_job');
        $this->load->model('Users_model', 'model_user');

        $freelancer_filter = 'none';

        $user_id = $this->users->getId();

        //Filter Type
        if ($this->input->get('filter_type')) {
            $filter_type = $this->input->get('filter_type');
        } else {
            $filter_type = '';
        }

        //Filter Location
        if ($this->input->get('filter_location')) {
            $filter_location = $this->input->get('filter_location');
        } else {
            $filter_location = '';
        }

        //Filter Job title/ category
        if ($this->input->get('filter_jobcategory')) {
            $filter_jobcategory = $this->input->get('filter_jobcategory');
        } else {
            $filter_jobcategory = '';
        }

        //Filter Experiences
        if ($this->input->get('filter_experiences')) {
            $filter_experiences = $this->input->get('filter_experiences');
        } else {
            $filter_experiences = '';
        }

        //Filter Languages
        if ($this->input->get('filter_languages')) {
            $filter_languages = $this->input->get('filter_languages');
        } else {
            $filter_languages = '';
        }

        //Filter Budget Type
        if ($this->input->get('filter_budget_type')) {
            $filter_budget_type = $this->input->get('filter_budget_type');
        } else {
            $filter_budget_type = '';
        }

        //Filter Budget Ranges
        if ($this->input->get('filter_budget_ranges')) {
            $filter_budget_ranges = $this->input->get('filter_budget_ranges');
        } else {
            $filter_budget_ranges = '';
        }

        $filter_budget_ranges = get_budget_range();
        if ($filter_budget_ranges) {
            $filter_budget_range_from = $filter_budget_ranges['curmin'];
            $filter_budget_range_to = $filter_budget_ranges['curmax'];
        } else {
            $filter_budget_range_from = 0;
            $filter_budget_range_to = 0;
        }

        //Filter Date Posts
        if ($this->input->get('filter_dateposts')) {
            $filter_dateposts = $this->input->get('filter_dateposts');
        } else {
            $filter_dateposts = '';
        }


        //Get Page Number
        if ($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        //Get Search
        if ($this->input->get('csq')) {
            $searchQuery = $this->input->get('csq');
            $searchArray = explode(',', rtrim($searchQuery, ','));
            $search = $searchArray;
            $filterskills = $searchArray;
        } else {
            $search = array();
            $searchQuery = '';
            $filterskills = array();
        }

        $limit = 10;
        $logged = $this->users->isLogged();
        if ($logged) {
            $data['logged'] = $logged;
            $user_type = $this->users->getUserType();
        } else {
            $data['logged'] = false;
            $user_type = 0;
        }

        $moduleAction = getModuleAction($user_type);
        if ($moduleAction) {
            $data['moduleAction'] = $moduleAction;
        } else {
            $data['moduleAction'] = 'freelancer';
        }

        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model

        //Filter Skill
        $filter_skills = array();
        if ($filterskills) {
            foreach ($filterskills as $fskill) {
                $filter_skillz = $this->model_jobcategory->getCategoryByName($fskill, SKILLS_TYPE);
                $category_id = isset($filter_skillz->category_id) ? $filter_skillz->category_id : '';
                if ($category_id) {
                    $filter_skills[] = $category_id;
                }
            }
        }

        //Filter Experience
        $filter_experience = '';
        if ($filter_experiences) {
            $filter_experiencez = $this->model_jobcategory->getCategoryByName($filter_experiences, EXPERIENCE_TYPE);
            $filter_experience = isset($filter_experiencez->category_id) ? $filter_experiencez->category_id : '';
        }

        //Filter Language
        $filter_language = array();
        if ($filter_languages) {
            $filter_languagez = $this->model_jobcategory->getLanguageByName($filter_languages);
            if ($filter_languagez) {
                $filter_language = array($filter_languagez['id']);
            }
        }

        // $filter_skills = array();
        //Get Page Number
        if ($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $json['freelancers'] = array();

        // Get freelancer
        $data['freelancer'] = array();
        $freelancer_skills = array();
        $freelancer_languages = array();
        $freelancer_experience = 0;
        $freelancer_location = 0;


        $filter_data = array(
            'search' => $search,
            'filter_location' => $filter_location,
            'filter_skills' => $filter_skills,
            'filter_title' => $filter_jobcategory,
            'filter_experience' => $filter_experience,
            'filter_language' => $filter_language,
            'filter_budget_type' => $filter_budget_type,
            'freelancer_filter' => ($filter_language || $filter_experience || $filter_skills) ? 'join' : 'none',
            'is_published' => 1,
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'f.freelancer_id',
            'order' => 'DESC'
        );

        $this->load->model('freelancer/Feedback_model', 'model_feedback');  // Load feedback model

        // Get Job List
        $json['freelancers']['total'] = 0;
        $json['freelancers']['list'] = array();
        // print_r($filter_data);
        $total_freelancers = $this->model_freelancer->getTotalFreelancers($filter_data);
        $freelancers = $this->model_freelancer->getFreelancers($filter_data);
        // print_r($freelancers);
        if ($freelancers) {
            $json['freelancers']['total'] = $total_freelancers;
            foreach ($freelancers as $freelancer) {


                $freelancerExperience = array();
                if ($freelancer->experience) {
                    $freelancerExperience = $this->model_jobcategory->getCategory($freelancer->experience);  // Experience
                }
                //Load Image
                if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
                }

                $freelancerskills = array();
                $freelancer_skills = $freelancer->skills ? json_decode($freelancer->skills) : array();
                if ($freelancer_skills) {
                    foreach ($freelancer_skills as $freelancer_skill) {
                        $freelancerskill = $this->model_jobcategory->getCategory($freelancer_skill);
                        if (isset($freelancerskill->name)) {
                            $freelancerskills[] = $freelancerskill->name;
                        }
                    }
                }
                if ($freelancer->fl_date_modified && $freelancer->fl_date_modified != '0000-00-00 00:00:00') {
                    $post_date = $freelancer->fl_date_modified;
                } else {
                    $post_date = $freelancer->fl_date_added;
                }

                $feedback = $this->model_feedback->getFeedbacksRating($freelancer->freelancer_id);
                $slug = $this->model_user->getUser($freelancer->user_id);

                $json['freelancers']['list'][] = array(
                    'freelancer_id' => $freelancer->freelancer_id,
                    'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
                    'slug' => $slug->slug,
                    'thumb' => $thumb,
                    'email' => $freelancer->email,
                    'mobile' => $freelancer->mobile,
                    'is_published' => $freelancer->is_published,
                    'is_verified' => $freelancer->isVerified,
                    'address' => $freelancer->address,
                    'city' => $freelancer->city,
                    'state' => $freelancer->state,
                    'pincode' => $freelancer->pin_code,
                    'country' => $freelancer->country,
                    'about' => $freelancer->about,
                    'experience' => isset($freelancerExperience->name) ? $freelancerExperience->name : '',
                    'skills'   => $freelancerskills,
                    'gender' => $freelancer->gender,
                    'industry' => $freelancer->industry,
                    'view_job' => base_url() . 'freelancer/search/job/' . $freelancer->freelancer_id,
                    'post_date' => timespan(strtotime($post_date), now(), 1) . ' ago',
                    'feedback' => array(
                        'total' => isset($feedback->total) ? $feedback->total : 0,
                        'ratings' => isset($feedback->ratings) ? $feedback->ratings : 0
                    )

                );
            }
        }
        $nextPage = ($limit * $page) < $total_freelancers ? $page + 1 : false;
        if ($nextPage && $total_freelancers) {
            $json['freelancers']['view_more'] = array(
                'page' => $nextPage,
                'href' => base_url() . 'company/search/getFreelancers/' . $nextPage
            );
        }


        $json['success'] = true;

        echo json_encode($json);
    }
}
