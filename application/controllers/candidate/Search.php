<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('Users');
        $this->load->helper(array('user', 'category'));
        $this->load->model('candidate/Candidate_model', 'model_candidate');
    }

    public function companies(){
           $this->load->model('company/Company_model', 'model_company');
           $this->load->model('candidate/Jobs_model', 'model_job');

        $data = array();
        //Get Page Number
        if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;
        $logged = $this->users->isLogged();
        $user_id = $logged;
        if($logged){
            $data['logged'] = $logged;
            $user_type = $this->users->getUserType();
        } else {
            $data['logged'] = false;
            $user_type = 0;
        }

        $moduleAction = getModuleAction($user_type);
        if($moduleAction){
            $data['moduleAction'] = $moduleAction;
        } else {
            $data['moduleAction'] = 'candidate';
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

        if($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if($this->session->userdata('error')) {
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

        if($companies){
            foreach($companies as $company){
                //Load Image
                if($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)){
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
                    'address' => $company->address,
                    'city' => $company->city,
                    'state' => $company->state,
                    'country' => $company->country,
                    'pincode' => $company->pin_code,
                    'status' => $company->status,
                    'total_jobs' => $total_jobs,
                    'view' => base_url() . 'candidate/search/company/' . $company->user_id
                );
            }
        }

        // Get candidate
        $data['candidate'] = array();
        $candidate = $this->model_candidate->getCandidate($this->users->getId());

        if($candidate){
            //Load Image
            if($candidate->image && file_exists(APPPATH . 'application/assets/uploads/logo/' . $candidate->image)){
                $thumb = base_url() . 'application/assets/uploads/logo/' . $candidate->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['candidate'] = array(
                'name' => $candidate->first_name . ' ' . $candidate->last_name,
                'email' => $candidate->email,
                'thumb' => $thumb,
                'status' => $candidate->status
            );
        }

        $data['user'] = get_user_account($user_id);

        //Pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'candidate/search/companies/';
        $config['total_rows'] = $total_companies;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['attributes'] = array('class' => 'page-numbers');
        $config['suffix'] = '?' . http_build_query($_GET,'','&');

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        $data['redirect_link'] = base_url() . 'candidate/dashboard';

        $data['searchQuery'] = '';  // Set Search Value

        $this->load->view('header', $data);
        $this->load->view('candidate/search/company');
        $this->load->view('footer');
    }

    public function company($company_id){
        $this->load->model('company/Company_model', 'model_company');
        $this->load->model('admin/Category_model', 'model_category');
        $data = array();

        $user_id = $this->users->getId();

        //Get Page Number
        if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;
        $logged = $this->users->isLogged();
        if($logged){
            $data['logged'] = $logged;
            $user_type = $this->users->getUserType();
        } else {
            $data['logged'] = false;
            $user_type = 0;
        }

        $moduleAction = getModuleAction($user_type);
        if($moduleAction){
            $data['moduleAction'] = $moduleAction;
        } else {
            $data['moduleAction'] = 'candidate';
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
        $candidate = $this->model_candidate->getCandidate($user_id);

        if($candidate){
            //Load Image
            if($candidate->image && file_exists(APPPATH . 'application/assets/uploads/logo/' . $candidate->image)){
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


        $this->load->model('candidate/Jobs_model', 'model_job');    // Load Job Model
        $this->load->model('Users_model', 'model_users'); // Load users Modal
        $this->load->model('admin/Industry_model', 'model_industry');   // Load Industry Model
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Category Modal

        // Get Company
        $company = $this->model_company->getCompany($company_id);

        if($company){

            //Load Image
            if($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)){
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
            if($jobs){
                foreach($jobs as $job){
                    if($candidate){
                        $candidate_job = $this->model_job->getRecentCandidateJob($candidate->candidate_id, $job->job_id);
                    } else {
                        $candidate_job = array();
                    }

                    if($logged){
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
                        'view_job' => base_url() . 'candidate/search/job/' . $job->job_id
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
                'view' => base_url() . 'candidate/search/company/' . $company->user_id
            );

        }




        $data['user'] = get_user_account($user_id);

        $data['redirect_link'] = base_url() . 'candidate/dashboard';

        $data['searchQuery'] = '';  // Set Search Value

        $this->load->view('header', $data);
        $this->load->view('candidate/search/company_view');
        $this->load->view('footer');
    }

    public function jobs(){
        $this->load->helper('jobcategories'); //Load Jobcategories
        $this->load->model('candidate/Jobs_model', 'model_job');
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Catgory Model

        $data = array();
        $job_filter = 'none';

        $user_id = $this->users->getId();
        $logged = $this->users->isLogged();
        if($logged){
            $data['logged'] = $logged;
            $user_type = $this->users->getUserType();
        } else {
            $data['logged'] = false;
            $user_type = 0;
        }

        $moduleAction = getModuleAction($user_type);
        if($moduleAction){
            $data['moduleAction'] = $moduleAction;
        } else {
            $data['moduleAction'] = 'candidate';
        }

        //Filter Relevant Jobs
        if($this->input->get('filter_type')){
            $filter_type = $this->input->get('filter_type');
        } else {
            $filter_type = '';
        }

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

        //Filter Data
        $filter_experience = array();
        if($filter_experiences){
            $filter_experience = $this->model_jobcategory->getCategoryByName($filter_experiences, EXPERIENCE_TYPE);
        }

        //Filter Qualifications
        if($this->input->get('filter_qualifications')){
            $filter_qualifications = $this->input->get('filter_qualifications');
        } else {
            $filter_qualifications = '';
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


        $data['jobs']= array();

        // Get candidate
        $data['candidate'] = array();
        $candidate_skills = $filter_skills = array();
        $candidate_jobtype = 0;
        $candidate_experience = 0;
        $candidate_location = 0;
        $candidate_gender = 0;
        $candidate_qualifications = array();
        $candidate = $this->model_candidate->getCandidate($user_id);

        if($candidate && $logged){
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

            if($filter_type == 'relevant_jobs'){

                //Filter Skills
                if($candidate->skills){
                    $cskills = ($candidate->skills) ? json_decode($candidate->skills) : array();
                    $filter_skills = $cskills;
                } else {
                    $filter_skills = array();
                    $cskills = array();
                }

                if($cskills){
                    foreach($cskills as $skill){
                        $candidate_skill = $this->model_jobcategory->getCategory($skill);
                        $candidate_skill_name = isset($candidate_skill->name) ? $candidate_skill->name : '';
                        if($candidate_skill_name){
                            $candidate_skills[] = $candidate_skill_name;
                        }
                    }
                }

                //Filter Experience
                $filter_experience = $candidate->experience;
                $fexperience = $this->model_jobcategory->getCategory($candidate->experience);
                $fexperience_name = isset($fexperience->name) ? $fexperience->name : '';
                if($fexperience_name){
                    $candidate_experience = preg_replace('[\s]','-', strtolower($fexperience_name));
                }


                //Filter Job Type
                if($candidate->job_type){
                    $filter_jobtype = array($candidate->job_type);
                } else {
                    $filter_jobtype = '';
                }

                if($candidate->job_type){
                    $candidate_jobtypez = $this->model_jobcategory->getCategory($candidate->job_type);
                    if($candidate_jobtypez){
                        $candidate_jobtype = preg_replace('[\s]','-', strtolower($candidate_jobtypez->name));
                    }
                }

                //Filter Location

                if($candidate->job_location){
                    $filter_location = $candidate->job_location;
                    $candidate_location = preg_replace('[\s]','-', strtolower($candidate->job_location));
                } else {
                    $filter_location = '';
                }

                //Filter Gender
                if($candidate->gender){
                    $filter_genders = $candidate->gender;
                    $candidate_gender = preg_replace('[\s]','-', strtolower($candidate->gender));
                } else {
                    $filter_genders = '';
                }

                $this->load->model('candidate/Education_model', 'model_education');
                $educations = $this->model_education->getEducations($candidate->candidate_id);
                if($educations){
                    foreach($educations as $education){
                        $filter_qualification[] = $education->ce_qualification;
                        $qualification = $this->model_jobcategory->getCategory($education->ce_qualification);
                        $qualification_name = isset($qualification->name) ? $qualification->name : '';
                        if($qualification_name){
                            $candidate_qualifications[] = $qualification_name;
                        }
                    }
                }

                if($candidate_qualifications){
                    array_unique($candidate_qualifications);
                }
            }
        }


        $filter_data = array(
            'search' => $search,
            'filter_skills' => $filter_skills,
            'filter_location' => $filter_location,
            'filter_title'=> $filter_jobcategory,
            'filter_datepost' => getDate_of_datepost_by_name($this->input->get('filter_dateposts')),
            'filter_gender' => get_genderid_by_name($filter_genders),
            'filter_experience' => isset($filter_experience->category_id) ? $filter_experience->category_id : '',
            'filter_qualification' => $filter_qualification,
            'filter_jobtypes' => $filter_jobtype,
            'job_filter' => ($filter_jobtype || $candidate_skills) ? 'join' : 'none',
            'filter_salary_package_from' => $filter_salary_package_from,
            'filter_salary_package_to' => $filter_salary_package_to,
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'job_id',
            'order' => 'DESC'
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

                if($logged){
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



        $data['user'] = get_user_account($user_id);

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
        $data['filter_type'] = $filter_type;
        $data['filter_jobcategory'] = $filter_jobcategory;
        $data['filter_location'] = $filter_location;
        $data['filter_jobtypes'] = $filter_jobtypes;
        $data['filter_experiences'] = $filter_experiences;
        $data['filter_dateposts'] = $filter_dateposts;
        $data['filter_genders'] = $filter_genders;
        $data['filter_qualifications'] = $filter_qualifications;
        $data['filter_salary_packages'] = $filter_salary_packages;

        $data['candidate_filter_skills'] = $candidate_skills;
        $data['candidate_filter_experience'] = $candidate_experience;
        $data['candidate_filter_jobtype'] = $candidate_jobtype;
        $data['candidate_filter_location'] = $candidate_location;
        $data['candidate_filter_gender'] = $candidate_gender;
        $data['candidate_filter_qualifications'] = $candidate_qualifications;

        // //Load Filters
        // $this->load->helper('jobcategories');
        // $data['categories'] = loadJobCategories($type='job');

        $this->load->view('header', $data);
        $this->load->view('candidate/search/job');
        $this->load->view('footer');
    }

    //Want  to Work
    public function job($job_id){
        $this->load->model('company/Company_model', 'model_company');   //Load company model
        $this->load->model('admin/Category_model', 'model_category');   // Load category model

        $this->load->model('Users_model', 'model_users');   // Load users model

        $data = array();

        $user_id = $this->users->getId();

        //Get Page Number
        if($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;
        $logged = $this->users->isLogged();
        if($logged){
            $data['logged'] = $logged;
            $user_type = $this->users->getUserType();
        } else {
            $data['logged'] = false;
            $user_type = 0;
        }

        $moduleAction = getModuleAction($user_type);
        if($moduleAction){
            $data['moduleAction'] = $moduleAction;
        } else {
            $data['moduleAction'] = 'candidate';
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
            'href' => base_url() . 'candidate/search/job/'.$job_id
        );

        if($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if($this->session->userdata('error')) {
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
        $this->load->model('candidate/Jobs_model', 'model_job');
        // Load Job Category Model
        $this->load->model('admin/Industry_model', 'model_industry');
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');

        // Get candidate
        $data['candidate'] = array();
        $candidate = $this->model_candidate->getCandidate($user_id);

        if($candidate){
            //Load Image
            if($candidate->image && file_exists(APPPATH . 'assets/uploads/logo/' . $candidate->image)){
                $thumb = base_url() . 'application/assets/uploads/logo/' . $candidate->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['candidate'] = array(
                'name' => $candidate->first_name . ' ' . $candidate->first_name,
                'email' => $candidate->email,
                'thumb' => $thumb,
                'status' => $candidate->status,
            );
        }

        //Get Job
        $data['job_id'] = $job_id;
        $job = $this->model_job->getJob($job_id);

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

                if($candidate){
                    $candidate_job = $this->model_job->getRecentCandidateJob($candidate->candidate_id, $job->job_id);
                } else {
                    $candidate_job = array();
                }

                if($logged){
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

        $data['user'] = get_user_account($user_id);

        $data['redirect_link'] = base_url() . 'candidate/dashboard';

        $data['searchQuery'] = '';

        $this->load->view('header', $data);
        $this->load->view('candidate/search/job_view');
        $this->load->view('footer');
    }


    public function autocomplete($filter_name=''){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST') {
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
            if($designations){
                foreach ($designations as $designation) {
                    $json[] = array(
                        'type' => 'designations_'.$designation->category_id,
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

//          $companies = $this->model_company->getCompanies($filter_data);
//          if($companies){
//                 foreach ($companies as $company) {
//                  $json[] = array(
//                      'type' => 'company_'.$company->user_id,
//                      'name'        => strip_tags(html_entity_decode($company->company_name, ENT_QUOTES, 'UTF-8'))
//                  );
//              }
//          }
        }
        echo json_encode($json);
    }
}
