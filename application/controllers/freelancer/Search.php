<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Users');
        $this->load->helper(array('user', 'category', 'freelancer_category'));
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');
    }

    public function companies()
    {
        $this->load->model('company/Company_model', 'model_company');
        $this->load->model('freelancer/Jobs_model', 'model_job');

        $data = array();
        //Get Page Number
        if ($this->uri->segment(4)) {
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

        $data['heading_title'] = 'Company List';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url()
        );
        $data['breadcrumb'][] = array(
            'name' => 'Companies',
            'href' => base_url() . 'companies'
        );

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        $data['companies'] = array();
        $this->load->model('admin/Industry_model', 'model_industry');   // Load Industry Model

        //Filter Data
        $filter_data = array(
            'status' => 1,
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'company_name',
            'order' => 'ASC'
        );
        // Get Company List
        $total_companies = $this->model_company->getTotalCompanies($filter_data);
        $companies = $this->model_company->getCompanies($filter_data);

        if ($companies) {
            foreach ($companies as $company) {
                //Load Image
                if ($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)) {
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $company->image;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default.png';
                }

                $company_category = $this->model_industry->getIndustry($company->company_category);
                $total_jobs = $this->model_job->getTotalJobs(array('company_id' => $company->company_id));

                $data['companies'][] = array(
                    'company_name' => $company->company_name,
                    'email' => $company->email,
                    'company_category' => isset($company_category->industry_name) ? $company_category->industry_name : '',
                    'thumb' => $thumb,
                    'about' => $company->about,
                    'address' => $company->address,
                    'city' => $company->city,
                    'state' => $company->state,
                    'country' => $company->country,
                    'pincode' => $company->pin_code,
                    'status' => $company->status,
                    'total_jobs' => $total_jobs,
                    'view' => base_url() . 'freelancer/search/company/' . $company->user_id
                );
            }
        }

        // Get freelancer
        $data['freelancer'] = array();
        $freelancer = $this->model_freelancer->getfreelancer($this->users->getId());

        if ($freelancer) {
            //Load Image
            if ($freelancer->image && file_exists(APPPATH . 'application/assets/uploads/logo/' . $freelancer->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['freelancer'] = array(
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
                'email' => $freelancer->email,
                'thumb' => $thumb,
                'status' => $freelancer->status
            );
        }

        $data['user'] = get_user_account($user_id);

        //Pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'freelancer/search/companies/';
        $config['total_rows'] = $total_companies;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['attributes'] = array('class' => 'page-numbers');
        $config['suffix'] = '?' . http_build_query($_GET, '', '&');

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        $data['redirect_link'] = base_url() . 'freelancer/dashboard';

        $data['searchQuery'] = '';  // Set Search Value

        $this->load->view('header', $data);
        $this->load->view('freelancer/search/company');
        $this->load->view('footer');
    }

    public function company($company_id)
    {
        $this->load->model('company/Company_model', 'model_company');
        $this->load->model('admin/Category_model', 'model_category');
        $data = array();

        $user_id = $this->users->getId();

        //Get Page Number
        if ($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
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

        $data['heading_title'] = 'Company View';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url()
        );
        $data['breadcrumb'][] = array(
            'name' => 'Company View',
            'href' => base_url() . 'company View'
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
        $freelancer = $this->model_freelancer->getfreelancer($user_id);

        if ($freelancer) {
            //Load Image
            if ($freelancer->image && file_exists(APPPATH . 'application/assets/uploads/logo/' . $freelancer->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['freelancer'] = array(
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
                'email' => $freelancer->email,
                'thumb' => $thumb,
                'status' => $freelancer->status,
            );
        }

        $data['companies'] = array();
        $data['jobs'] = array();
        //Filter Data
        $filter_data = array(
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'company_name',
            'order' => 'ASC'
        );


        $this->load->model('freelancer/Jobs_model', 'model_job');    // Load Job Model
        $this->load->model('Users_model', 'model_users'); // Load users Modal
        $this->load->model('admin/Industry_model', 'model_industry');   // Load Industry Model
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Category Modal

        // Get Company
        $company = $this->model_company->getCompany($company_id);

        if ($company) {

            //Load Image
            if ($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $company->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $social_profiles = $this->model_users->getSocialProfiles($company->user_id);

            //$company_category = $this->model_category->getCategory($company->company_category);
            $company_category = $this->model_industry->getIndustry($company->company_category);

            //Get Jobs
            $total_jobs = $this->model_job->getTotalJobs(array('company_id' => $company->company_id));
            $jobs = $this->model_job->getJobs(array('company_id' => $company->company_id));
            if ($jobs) {
                foreach ($jobs as $job) {
                    if ($freelancer) {
                        $freelancer_job = $this->model_job->getRecentFreelancerJob($freelancer->freelancer_id, $job->job_id);
                    } else {
                        $freelancer_job = array();
                    }

                    if ($logged) {
                        $is_applied = isset($freelancer_job->cj_isApplied) ? $freelancer_job->cj_isApplied : 0;
                        $is_saved = isset($freelancer_job->cj_isSaved) ? $freelancer_job->cj_isSaved : 0;
                    } else {
                        $is_applied = 0;
                        $is_saved = 0;
                    }

                    $jobtypess = array();
                    $job_types = $job->job_type ? json_decode($job->job_type) : array();
                    if ($job_types) {
                        foreach ($job_types as $job_type) {
                            $jobtype = $this->model_jobcategory->getCategory($job_type);
                            if (isset($jobtype->name)) {
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
                        'view_job' => base_url() . 'freelancer/search/job/' . $job->job_id
                    );
                }
            }


            $data['company'] = array(
                'company_name' => $company->first_name . ' ' . $company->last_name,
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
                'total_jobs' => $total_jobs,
                'view' => base_url() . 'freelancer/search/company/' . $company->user_id
            );
        }




        $data['user'] = get_user_account($user_id);

        $data['redirect_link'] = base_url() . 'freelancer/dashboard';

        $data['searchQuery'] = '';  // Set Search Value

        $this->load->view('header', $data);
        $this->load->view('freelancer/search/company_view');
        $this->load->view('footer');
    }

    public function jobs()
    {
        $this->load->helper('jobcategories'); //Load Jobcategories
        $this->load->model('freelancer/Jobs_model', 'model_job');

        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

        $params  =  array();
        $data = array();
        $job_filter = 'none';
        if ($this->input->get('csq')) {
            $searchQuery = $this->input->get('csq');
            $params[]  = 'csq=' . $this->input->get('csq');
        } else {
            $searchQuery = '';
        }

        $user_id = $this->users->getId();
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
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['freelancer'] = array(
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
                'email' => $freelancer->email,
                'thumb' => $thumb,
                'status' => $freelancer->status,
            );

            //For Relevant Jobs
            if ($filter_type == 'relevant_jobs') {

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
            }
        }

        $data['user'] = get_user_account($user_id);

        $data['redirect_link'] = base_url() . 'freelancer/dashboard';

        $data['searchQuery'] = $searchQuery;  // Set Search Value

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

        $data['job_locations'] = $this->model_jobcategory->getCategories(CITY_TYPE, array('status' => 1, 'sort' => 'j.name', 'order' => 'ASC', 'child' => true));
        $data['job_languages'] = $this->model_jobcategory->getLanguages();
        $data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));
        $data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, array('status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC'));

        $qstring = $params ? ('?' . implode('&', $params)) : '';
        $data['loadSearchJobs'] = base_url() . 'freelancer/search/getJobs' . $qstring;

        $this->load->view('header', $data);
        $this->load->view('freelancer/search/job_list');
        $this->load->view('footer');
    }

    public function getJobs()
    {
        $json = array();
        $this->load->helper(array('jobcategories', 'date')); //Load Jobcategories
        $this->load->model('freelancer/Jobs_model', 'model_job');

        $job_filter = 'none';

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
        } else {
            $search = array();
            $searchQuery = '';
        }

        $limit = 10;
        $logged = $this->users->isLogged();
        if ($logged) {
            $json['logged'] = true;
            $user_type = $this->users->getUserType();
        } else {
            $json['logged'] = false;
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
        //Get Page Number
        if ($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $json['jobs'] = array();

        // Get freelancer
        $data['freelancer'] = array();
        $freelancer_skills = array();
        $freelancer_languages = array();
        $freelancer_experience = 0;
        $freelancer_location = 0;
        $freelancer = $this->model_freelancer->getFreelancer($user_id);

        if ($freelancer) {
            //Load Image
            if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $json['freelancer'] = array(
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
                'email' => $freelancer->email,
                'thumb' => $thumb,
                'status' => $freelancer->status,
            );

            //For Relevant Jobs
            if ($filter_type == 'relevant_jobs') {

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
            }
        }


        $filter_data = array(
            'search' => $search,
            'filter_location' => $filter_location,
            'filter_skills' => $filter_skills,
            'filter_title' => $filter_jobcategory,
            //'filter_datepost' => getDate_of_datepost_by_name($this->input->get('filter_dateposts')),
            'filter_experience' => $filter_experience,
            'filter_language' => $filter_language,
            'filter_budget_type' => $filter_budget_type,
            'job_filter' => ($filter_language || $filter_experience) ? 'join' : 'none',
            'filter_budget_range_from' => $filter_budget_range_from,
            'filter_budget_range_to' => $filter_budget_range_to,
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'job_id',
            'order' => 'DESC'
        );

        // Get Job List
        $json['jobs']['total'] = 0;
        $json['jobs']['list'] = array();
        $total_jobs = $this->model_job->getTotalJobs($filter_data);

        $jobs = $this->model_job->getJobs($filter_data);

        if ($jobs) {
            $json['jobs']['total'] = $total_jobs;
            foreach ($jobs as $job) {
                if ($freelancer) {
                    $freelancer_job = $this->model_job->getRecentFreelancerJob($freelancer->freelancer_id, $job->job_id);
                } else {
                    $freelancer_job = array();
                }

                $total_applied_freelancers = $this->model_job->getTotalFreelancerJobsByJID($job->job_id, array('applied' => 1));

                $jobexperience = array();
                if ($job->experience_level == 'experienced') {
                    $jobexperience = $this->model_jobcategory->getCategory($job->experience);  // Experience
                }
                //Load Image
                if ($job->company_logo && file_exists(APPPATH . 'assets/uploads/logo/' . $job->company_logo)) {
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $job->company_logo;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default.png';
                }

                $is_accepted = isset($freelancer_job->cj_isAccepted) ? $freelancer_job->cj_isAccepted : 0;
                $is_applied = isset($freelancer_job->cj_isApplied) ? $freelancer_job->cj_isApplied : 0;
                $is_saved = isset($freelancer_job->cj_isSaved) ? $freelancer_job->cj_isSaved : 0;


                $jobskills = array();
                $job_skills = $job->skills ? json_decode($job->skills) : array();
                if ($job_skills) {
                    foreach ($job_skills as $job_skill) {
                        $jobskill = $this->model_jobcategory->getCategory($job_skill);
                        if (isset($jobskill->name)) {
                            $jobskills[] = $jobskill->name;
                        }
                    }
                }
                if ($job->date_modified && $job->date_modified != '0000-00-00 00:00:00') {
                    $post_date = $job->date_modified;
                } else {
                    $post_date = $job->date_added;
                }
                $slug = url_title($job->title);
                $json['jobs']['list'][] = array(
                    'job_id' => $job->job_id,
                    'slug' => $slug,
                    'company_name' => $job->company_name,
                    'title' => $job->title,
                    'thumb' => $thumb,
                    'pay_type' => get_pay_type($job->pay_type),
                    'pay_amount' => format_currency($job->pay_amount),
                    'job_duration' => get_project_duration($job->job_duration),
                    'accepted' => $is_accepted,
                    'is_applied' => $is_applied,
                    'is_saved' => $is_saved,
                    'location' => $job->location,
                    'description' => $job->description,
                    'experience_level' => ucfirst($job->experience_level),
                    'experience' => isset($jobexperience->name) ? $jobexperience->name : '',
                    'skills'   => $jobskills,
                    'applied_freelancers' => $total_applied_freelancers,
                    'view_job' => base_url() . 'freelancer/search/job/' . $slug . '/' . $job->job_id,
                    'post_date' => timespan(strtotime($post_date), now(), 1) . ' ago'
                );
            }
        }

        // $json['jobs']['pagination'] = '';
        //Pagination
        $nextPage = ($limit * $page) < $total_jobs ? $page + 1 : false;
        if ($nextPage && $total_jobs) {
            $json['jobs']['view_more'] = array(
                'page' => $nextPage,
                'href' => base_url() . 'freelancer/search/getJobs/' . $nextPage
            );
        }


        $json['success'] = true;

        echo json_encode($json);
    }

    //Want  to Work
    public function job($slug, $job_id)
    {
        $this->load->model('company/Company_model', 'model_company');   //Load company model
        $this->load->model('admin/Category_model', 'model_category');   // Load category model

        $this->load->model('Users_model', 'model_users');   // Load users model

        $this->load->helper('date');
        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

        $data = array();

        $user_id = $this->users->getId();

        //Get Page Number
        if ($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
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

        $data['heading_title'] = 'Job View';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url()
        );
        $data['breadcrumb'][] = array(
            'name' => 'Jobs',
            'href' => base_url() . 'jobs'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Job View',
            'href' => base_url() . 'freelancer/search/job/' . $job_id
        );

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        $data['company'] = array();
        $data['job'] = array();
        //Filter Data
        $filter_data = array(
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'company_name',
            'order' => 'ASC'
        );

        // Load Job Model
        $this->load->model('freelancer/Jobs_model', 'model_job');
        // Load Job Category Model
        $this->load->model('admin/Industry_model', 'model_industry');
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');

        // Get freelancer
        $data['freelancer'] = array();
        $freelancer = $this->model_freelancer->getFreelancer($user_id);

        if ($freelancer) {
            //Load Image
            if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['freelancer'] = array(
                'name' => $freelancer->first_name . ' ' . $freelancer->first_name,
                'email' => $freelancer->email,
                'thumb' => $thumb,
                'status' => $freelancer->status,
            );
        }

        //Get Job
        $data['job_id'] = $job_id;
        $job = $this->model_job->getJob($job_id);

        if ($job) {

            // Get Company
            $company = $this->model_company->getCompanyById($job->company_id);
            if ($company) {
                //Load Image
                if ($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)) {
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
                    'view' => base_url() . 'freelancer/search/company/' . $company->user_id
                );


                if ($freelancer) {

                    $freelancer_job = $this->model_job->getRecentFreelancerJob($freelancer->freelancer_id, $job->job_id);
                } else {
                    $freelancer_job = array();
                }


                if ($logged && $freelancer_job) {
                    $is_applied = isset($freelancer_job->cj_isApplied) ? $freelancer_job->cj_isApplied : 0;
                    $is_saved = isset($freelancer_job->cj_isSaved) ? $freelancer_job->cj_isSaved : 0;
                    $bid_amount = format_currency($freelancer_job->cj_amount);
                    $bid_proposal = $freelancer_job->cj_proposal;
                } else {
                    $is_applied = 0;
                    $is_saved = 0;
                    $bid_amount = 0;
                    $bid_proposal = '';
                }


                $job_category = $this->model_jobcategory->getCategory($job->job_category);  // Job Category
                $job_specialization = $this->model_jobcategory->getCategory($job->job_specialization);  // Job Specialization
                $gender = get_gender(0); // Gender

                // Job Types
                $jobtypess = array();
                $job_types = $job->job_type ? json_decode($job->job_type) : array();
                if ($job_types) {
                    foreach ($job_types as $job_type) {
                        $jobtype = $this->model_jobcategory->getCategory($job_type);
                        if (isset($jobtype->name)) {
                            $jobtypess[] = $jobtype->name;
                        }
                    }
                }

                $experience = $this->model_jobcategory->getCategory($job->experience);  // Experience


                //Get Job Skills
                $job_skills = array();
                $skills = $job->skills ? json_decode($job->skills) : array();
                if ($skills) {
                    foreach ($skills as $skill) {
                        $skillz = $this->model_jobcategory->getCategory($skill);
                        if ($skillz) {
                            $job_skills[] = $skillz->name;
                        }
                    }
                }

                //Get Job Languages
                $job_languages = array();
                $languages = $job->languages ? json_decode($job->languages) : array();
                if ($languages) {
                    foreach ($languages as $language_id) {
                        $language = $this->model_jobcategory->getLanguage($language_id);
                        if ($language) {
                            $job_languages[] = $language['name'];
                        }
                    }
                }

                $data['job'] = array(
                    'job_id' => $job->job_id,
                    'company_name' => $job->company_name,
                    'title' => $job->title,
                    'thumb' => $thumb,
                    'is_applied' => $is_applied,
                    'bid_amount' => $bid_amount,
                    'bid_proposal' => $bid_proposal,
                    'is_saved' => $is_saved,
                    'location' => $job->location,
                    'description' => $job->description,
                    'experience_level' => ucfirst($job->experience_level),
                    'experience' => isset($experience->name) ? $experience->name : '',
                    'skills'   => $job_skills,
                    'languages' => $job_languages,
                    'job_category' => isset($job_category->name) ? $job_category->name : '',
                    'job_specialization' => isset($job_specialization->name) ? $job_specialization->name : '',
                    'job_duration' => get_project_duration($job->job_duration),
                    'project_type' => get_project_type($job->project_type),
                    'pay_type' => get_project_type($job->job_type),
                    'pay_amount' => format_currency($job->pay_amount),
                    'post_date' => ($job->date_modified && $job->date_modified != '0000-00-00 00:00:00') ? $job->date_modified : $job->date_added,
                    'apply_job' => base_url() . 'freelancer/job/apply/' . $job->job_id,
                    'bookmark' => base_url() . 'freelancer/job/bookmark/' . $job->job_id
                );
            }
        }

        $data['user'] = get_user_account($user_id);

        $data['redirect_link'] = base_url() . 'freelancer/dashboard';

        $data['searchQuery'] = '';

        $this->load->view('header', $data);
        $this->load->view('freelancer/search/job_view');
        $this->load->view('footer');
    }

    public function autocomplete($filter_name = '')
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
            $this->load->model('company/Company_model', 'model_company');

            $filter_data = array(
                'filter_name' => $filter_name,
                'start' => 0,
                'limit' => 5,
                'sort' => 'category_id',
                'status' => 1,
                'order' => 'ASC'
            );

            //         $skills = $this->model_jobcategory->getCategories(SKILLS_TYPE, $filter_data);
            //         if($skills){
            //             foreach ($skills as $skill) {
            //              $json[] = array(
            //                  'type' => 'skills_'.$skill->category_id,
            //                  'name'        => strip_tags(html_entity_decode($skill->name, ENT_QUOTES, 'UTF-8'))
            //              );
            //          }
            //         }

            $filter_data['child'] = 1;
            $designations = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, $filter_data);
            if ($designations) {
                foreach ($designations as $designation) {
                    $json[] = array(
                        'type' => 'designations_' . $designation->category_id,
                        'name'        => strip_tags(html_entity_decode($designation->name, ENT_QUOTES, 'UTF-8'))
                    );
                }
            }

            $filter_data = array(
                'filter_name' => $filter_name,
                'start' => 0,
                'limit' => 5,
                'sort' => 'user_id',
                'status' => 1,
                'order' => 'ASC'
            );
        }
        echo json_encode($json);
    }
}
