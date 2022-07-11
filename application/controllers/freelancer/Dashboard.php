<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    private $freelancer_id;
    private $page_name = 'dashboard';
    private $freelancerArr = array();
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('freelancer');

        $this->validate();
        $this->load->helper('category');
    }

    // public function index() {
    //     $this->load->helper('jobcategories'); //Load Jobcategories
    //     $this->load->model('freelancer/Jobs_model', 'model_job');

    //     //Add Css
    //     $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

    //     $data = array();
    //     $job_filter = 'none';
    //     $qstring = $this->input->server('QUERY_STRING');
    //     if($this->input->get('filter_type')) {
    //         $qstring = $qstring;
    //     } else {
    //         $qstring = 'filter_type=relevant_jobs' . ($qstring ? ('&' . $qstring) : '');
    //     }


    //     //Filter Type
    //     if($this->input->get('filter_type')){
    //         $filter_type = $this->input->get('filter_type');
    //     } else {
    //         $filter_type = '';
    //     }

    //     //Filter Location
    //     if($this->input->get('filter_location')){
    //         $filter_location = $this->input->get('filter_location');
    //     } else {
    //         $filter_location = '';
    //     }

    //     //Filter Category
    //     if($this->input->get('filter_category')){
    //         $filter_category = $this->input->get('filter_category');
    //     } else {
    //         $filter_category = '';
    //     }

    //     //Filter Experiences
    //     if($this->input->get('filter_experiences')){
    //         $filter_experiences = $this->input->get('filter_experiences');
    //     } else {
    //         $filter_experiences = '';
    //     }

    //     //Filter Languages
    //     if($this->input->get('filter_languages')){
    //         $filter_languages = $this->input->get('filter_languages');
    //     } else {
    //         $filter_languages = '';
    //     }

    //     //Filter Budget Type
    //     if($this->input->get('filter_budget_type')){
    //         $filter_budget_type = $this->input->get('filter_budget_type');
    //     } else {
    //         $filter_budget_type = '';
    //     }

    //     //Filter Budget Ranges
    //     if($this->input->get('filter_budget_ranges')){
    //         $filter_budget_ranges = $this->input->get('filter_budget_ranges');
    //     } else {
    //         $filter_budget_ranges = '';
    //     }

    //     $filter_budget_ranges = get_budget_range();
    //     if($filter_budget_ranges){
    //         $filter_budget_range_from = $filter_budget_ranges['curmin'];
    //         $filter_budget_range_to = $filter_budget_ranges['curmax'];
    //     } else {
    //         $filter_budget_range_from = 0;
    //         $filter_budget_range_to = 0;
    //     }

    //     //Filter Date Posts
    //     if($this->input->get('filter_dateposts')){
    //         $filter_dateposts = $this->input->get('filter_dateposts');
    //     } else {
    //         $filter_dateposts = '';
    //     }


    //     //Get Page Number
    //     if($this->uri->segment(4)) {
    //         $page = (int)$this->uri->segment(4);
    //     } else {
    //         $page = 1;
    //     }

    //     //Get Search
    //     if($this->input->get('csq')) {
    //         $searchQuery = $this->input->get('csq');
    //         $searchArray = explode(',', rtrim($searchQuery,','));
    //         $search = $searchArray;
    //     } else {
    //         $search = array();
    //         $searchQuery = '';
    //     }

    //     $limit = 10;
    //     $data['logged'] = true;
    //     $user_type = $this->freelancer->getUserType();

    //     $moduleAction = getModuleAction($user_type);
    //     if($moduleAction){
    //         $data['moduleAction'] = $moduleAction;
    //     } else {
    //         $data['moduleAction'] = 'candidate';
    //     }

    //     $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model
    //     //Filter Experience
    //     $filter_experience = '';
    //     if($filter_experiences){
    //         $filter_experiencez = $this->model_jobcategory->getCategoryByName($filter_experiences, EXPERIENCE_TYPE);
    //         $filter_experience = isset($filter_experiencez->category_id) ? $filter_experiencez->category_id : '';
    //     }

    //     //Filter Language
    //     $filter_language = array();
    //     if($filter_languages){
    //         $filter_languagez = $this->model_jobcategory->getLanguageByName($filter_languages);
    //         if($filter_languagez){
    //             $filter_language = array($filter_languagez['id']);
    //         }
    //     }

    //     $filter_skills = array();

    //     $data['heading_title'] = 'My Feeds';    //Heading Title
    //     $data['breadcrumb'] = array();    //Breadcrumb
    //     $data['breadcrumb'][] = array(
    //         'name' => 'My Feeds',
    //         'href' => base_url()
    //     );


    //     if($this->session->userdata('success')) {
    //         $data['success'] = $this->session->userdata('success');
    //         $this->session->unset_userdata('success');
    //     }

    //     if($this->session->userdata('error')) {
    //         $data['error'] = $this->session->userdata('error');
    //         $this->session->unset_userdata('error');
    //     }

    //     // Get candidate
    //     $data['candidate'] = array();
    //     $freelancer_skills = array();
    //     $freelancer_languages = array();
    //     $freelancer_experience = 0;
    //     $freelancer_location = 0;
    //     $freelancer_category = 0;
    //     $freelancer = $this->model_freelancer->getFreelancer($this->user_id);

    //     if($freelancer){
    //         //Load Image
    //         if($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)){
    //             $thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
    //         } else {
    //             $thumb = base_url() . 'application/assets/uploads/logo/default.png';
    //         }

    //         $data['candidate'] = array(
    //             'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
    //             'email' => $freelancer->email,
    //             'thumb' => $thumb,
    //             'status' => $freelancer->status,
    //         );

    //         //For Relevant Jobs
    //         //Filter Skills
    //         if($freelancer->skills){
    //             $skills = ($freelancer->skills) ? json_decode($freelancer->skills) : array();
    //             $filter_skills = $skills;
    //         } else {
    //             $skills = array();
    //         }

    //         if($skills){
    //             foreach($skills as $skill){
    //                 $freelancer_skill = $this->model_jobcategory->getCategory($skill);
    //                 $freelancer_skills[] = isset($freelancer_skill->name) ? $freelancer_skill->name : '';
    //             }
    //         }

    //         //Filter Experience
    //         $filter_experience = $freelancer->experience;
    //         $fexperience = $this->model_jobcategory->getCategory($freelancer->experience);
    //         $freelancer_experience = isset($fexperience->name) ? preg_replace('[\s]','-', strtolower($fexperience->name)) : '';

    //         //Filter Language
    //         $filter_language = array();
    //         $flanguages = array();
    //         if($freelancer->languages){
    //             $flanguages = ($freelancer->languages) ? json_decode($freelancer->languages) : array();
    //             $filter_language = $flanguages;
    //         }

    //         if($flanguages){
    //             foreach($flanguages as $flanguage){
    //                 $language = $this->model_jobcategory->getLanguage($flanguage);
    //                 if($language){
    //                     $freelancer_languages[] = $language['name'];
    //                 }
    //             }
    //         }

    //         //Filter Location
    //         /*if($freelancer->location){
    //             $filter_location = $freelancer->location;
    //         } else {
    //             $filter_location = '';
    //         }*/

    //     }

    //     $data['user'] = get_user_account($this->user_id);

    //     $data['profile_link'] = base_url() . 'freelancer/profile';

    //     $data['searchQuery'] = $searchQuery;  // Set Search Value

    //     $data['jobs'] = array();

    //     //Filter Values
    //     $data['filter_type'] = $filter_type;
    //     $data['filter_location'] = $filter_location;
    //     $data['filter_category'] = $filter_category;
    //     $data['filter_budget_type'] = $filter_budget_type;
    //     $data['filter_budget_ranges'] = $filter_budget_ranges;
    //     $data['filter_experiences'] = $filter_experiences;
    //     $data['filter_language'] = $filter_languages;
    //     $data['filter_dateposts'] = $filter_dateposts;
    //     $data['filter_budget_ranges'] = $filter_budget_ranges;

    //     $data['freelancer_skills'] = $freelancer_skills;
    //     $data['freelancer_experience'] = $freelancer_experience;
    //     $data['freelancer_languages'] = $freelancer_languages;
    //     $data['freelancer_location'] = $freelancer_location;
    //     $data['freelancer_category'] = $freelancer_category;

    //     $data['job_locations'] = $this->model_jobcategory->getJobLocations();
    //     $data['job_languages'] = $this->model_jobcategory->getLanguages();
    //     $data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, array('status' => 1));
    //     $data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, array('status' => 1));

    //     $data['loadJobs'] = base_url() . 'freelancer/search/getJobs' . ($qstring ? ('/?' . $qstring) : '');

    //     $this->load->view('header', $data);
    //     $this->load->view('freelancer/dashboard');
    //     $this->load->view('footer');
    // }

    public function index()
    {
        $this->load->helper('jobcategories'); //Load Jobcategories
        $this->load->model('freelancer/Jobs_model', 'model_job');

        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

        $params  =  array();
        $data = array();
        $job_filter = 'none';
        $qstringz = $this->input->server('QUERY_STRING');
        $qstring = 'filter_type=relevant_jobs' . ($qstringz ? ('&' . $qstringz) : '');


        if ($this->input->get('csq')) {
            $searchQuery = $this->input->get('csq');
            $params[]  = 'csq=' . $this->input->get('csq');
        } else {
            $searchQuery = '';
        }

        $user_id = $this->freelancer->getId();
        //Filter Type
        if ($this->input->get('filter_type')) {
            $filter_type = $this->input->get('filter_type');
            $params[]  = 'filter_type=' . $this->input->get('filter_type');
        } else {
            $filter_type = '';
        }

        //Filter Location
        if ($this->input->get('filter_location')) {
            $filter_location = $this->input->get('filter_location');
            $params[]  = 'filter_location=' . $this->input->get('filter_location');
        } else {
            $filter_location = '';
        }


        //Filter Category
        if ($this->input->get('filter_category')) {
            $filter_category = $this->input->get('filter_category');
            $params[]  = 'filter_category=' . $this->input->get('filter_category');
        } else {
            $filter_category = '';
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

        //Filter Budget Type
        if ($this->input->get('filter_budget_type')) {
            $filter_budget_type = $this->input->get('filter_budget_type');
            $params[]  = 'filter_budget_type=' . $this->input->get('filter_budget_type');
        } else {
            $filter_budget_type = '';
        }

        //Filter Budget Ranges
        if ($this->input->get('filter_budget_ranges')) {
            $filter_budget_ranges = $this->input->get('filter_budget_ranges');
            $params[]  = 'filter_budget_ranges=' . $this->input->get('filter_budget_ranges');
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
            $params[]  = 'filter_dateposts=' . $this->input->get('filter_dateposts');
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
        } else {
            $search = array();
            $searchQuery = '';
        }

        $limit = 10;
        $logged = $this->freelancer->isLogged();
        if ($logged) {
            $data['logged'] = $logged;
            $user_type = $this->freelancer->getUserType();
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

        $filter_skills = array();

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
        $freelancer_skills = array();
        $freelancer_languages = array();
        $freelancer_experience = 0;
        $freelancer_location = 0;
        $freelancer_category = 0;
        $freelancer = $this->model_freelancer->getFreelancer($user_id);

        if ($freelancer) {
            //Load Image
            if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
            }

            $data['freelancer'] = array(
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
                'email' => $freelancer->email,
                'thumb' => $thumb,
                'status' => $freelancer->status,
            );

            //For Relevant Jobs
            // if($filter_type == 'relevant_jobs'){

            //Filter Skills
            if ($freelancer->skills) {
                $skills = ($freelancer->skills) ? json_decode($freelancer->skills) : array();
                $filter_skills = $skills;
            } else {
                $skills = array();
            }

            if ($skills) {
                foreach ($skills as $skill) {
                    $freelancer_skill = $this->model_jobcategory->getCategory($skill);
                    $freelancer_skills[] = isset($freelancer_skill->name) ? $freelancer_skill->name : '';
                }
            }

            //Filter Experience
            $filter_experience = $freelancer->experience;
            $fexperience = $this->model_jobcategory->getCategory($freelancer->experience);
            $freelancer_experience = isset($fexperience->name) ? preg_replace('[\s]', '-', strtolower($fexperience->name)) : '';

            //Filter Language
            $filter_language = array();
            $flanguages = array();
            if ($freelancer->languages) {
                $flanguages = ($freelancer->languages) ? json_decode($freelancer->languages) : array();
                $filter_language = $flanguages;
            }

            if ($flanguages) {
                foreach ($flanguages as $flanguage) {
                    $language = $this->model_jobcategory->getLanguage($flanguage);
                    if ($language) {
                        $freelancer_languages[] = $language['name'];
                    }
                }
            }

            //Filter Location
            /*if($freelancer->location){
                    $filter_location = $freelancer->location;
                } else {
                    $filter_location = '';
                }*/
            // }
        }

        $data['user'] = get_user_account($user_id);

        $data['user']['progress'] = $this->getProfileStatus('freelancer');

        $data['profile_link'] = base_url() . 'freelancer/profile';

        $data['redirect_link'] = base_url() . 'freelancer/dashboard';

        $data['searchQuery'] = $searchQuery;  // Set Search Value

        $data['loadJobs'] = base_url() . 'freelancer/search/getJobs' . ($qstring ? ('/?' . $qstring) : '');

        $data['jobs'] = array();

        //Filter Values
        $data['filter_type'] = $filter_type;
        $data['filter_location'] = $filter_location;
        $data['filter_category'] = $filter_category;
        $data['filter_budget_type'] = $filter_budget_type;
        $data['filter_budget_ranges'] = $filter_budget_ranges;
        $data['filter_experiences'] = $filter_experiences;
        $data['filter_language'] = $filter_languages;
        $data['filter_dateposts'] = $filter_dateposts;
        $data['filter_budget_ranges'] = $filter_budget_ranges;

        $data['freelancer_skills'] = $freelancer_skills;
        $data['freelancer_experience'] = $freelancer_experience;
        $data['freelancer_languages'] = $freelancer_languages;
        $data['freelancer_location'] = $freelancer_location;
        $data['freelancer_category'] = $freelancer_category;

        $data['job_locations'] = $this->model_jobcategory->getCategories(CITY_TYPE, array('status' => 1, 'child' => true));
        $data['job_languages'] = $this->model_jobcategory->getLanguages();
        $data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, array('status' => 1));
        $data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, array('status' => 1));

        $qstring = $params ? ('?' . implode('&', $params)) : '';
        $data['loadSearchJobs'] = base_url() . 'freelancer/search/getJobs' . $qstring;

        $this->load->view('header', $data);
        $this->load->view('freelancer/dashboard');
        $this->load->view('footer');
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

        $profile_status = $this->getProfileStatus('freelancer');
        if (!$profile_status) {
            $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
            redirect(base_url() . 'freelancer/profile?redirect=' . $this->page_name);
        }

        // Check Payment_info
        if (!$this->freelancerArr->isPaymentInfoGiven) {
            $this->document->addAlert('payment_info', 'info');
        }
    }

    protected function loadDetails()
    {
        $this->load->helper('user'); // Load user helper
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');   //Load company model
        $this->freelancerArr = $this->model_freelancer->getFreelancer($this->user_id);
        $this->freelancer_id = isset($this->freelancerArr->freelancer_id) ? $this->freelancerArr->freelancer_id : 0;
    }

    //Check profile status. If it is below 80, redirect to profile page. Otherwise return status
    protected function getProfileStatus($type)
    {
        if ($this->user_id) {
            $profile_progress = get_profile_status($this->freelancerArr, $type);
            if ($profile_progress < 80) {
                return false;
            } else {
                return $profile_progress;
            }
        } else {
            return true;
        }
    }
}
