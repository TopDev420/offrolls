<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freelancer extends CI_Controller
{
    private $error = array();
    private $page_name = 'applied_jobs';
    private $user_id;
    private $company = array();
    private $menu_section = 'freelancer';

    public function __construct()
    {
        parent::__construct();
        //$this->load->library('recruiter');
        $this->load->helper(array('user', 'category', 'freelancer_category'));
    }

    public function index()
    {
        $this->validate(); // Load validation
        $data = array();

        $data['logged'] = true;
        $data['heading_title'] = 'freelancer';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/freelancer'
        );
        $data['active_menu'] = 'mnu-freelancer';
        $data['menu_section'] = $this->menu_section;


        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/jobview.css');

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        // Get Company
        $data['company'] = $this->company;

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['moduleAction'] = 'company';
        $this->load->view('header');
        $this->load->view('company/freelancer_list', $data);
        $this->load->view('footer');
    }

    //For AJAX Loading
    public function applied($job_id)
    {
        $json = array();

        // Validation
        if (!$this->validate(true)) {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
            echo json_encode($json);
            exit;
        }

        $this->load->helper('category'); // Load category helper

        //Get Page Number
        if ($this->input->get('page')) {
            $page = (int)$this->input->get('page');
        } else {
            $page = 1;
        }
        $json['page'] = $page;
        $limit = 10;

        //Filter Location
        if ($this->input->get('filter_location')) {
            $filter_location = $this->input->get('filter_location');
        } else {
            $filter_location = '';
        }

        //Filter Experiences
        if ($this->input->get('filter_experiences')) {
            $filter_experiences = $this->input->get('filter_experiences');
        } else {
            $filter_experiences = '';
        }

        //Filter Languages
        if ($this->input->get('filter_languages')) {
            $filter_languages = explode(',', $this->input->get('filter_languages'));
        } else {
            $filter_languages = '';
        }

        //Filter Skills
        if ($this->input->get('filter_skills')) {
            $filter_skills = explode(',', $this->input->get('filter_skills'));
        } else {
            $filter_skills = '';
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
            foreach ($filter_languages as $filter_languagez) {
                $flanguagez = $this->model_jobcategory->getLanguageByName($filter_languagez);
                if ($flanguagez) {
                    $filter_language = array($flanguagez['id']);
                }
            }
        }

        $filter_job_skills = array();
        if ($filter_skills) {
            foreach ($filter_skills as $skill) {
                $job_skill = $this->model_jobcategory->getCategory($skill);
                $filter_job_skills[] = isset($job_skill->name) ? $job_skill->name : '';
            }
        }
        // Get Company
        $accepted_job = 0;
        $json['jobs'] = array();

        //Freelancer AppliedJobs
        //Filter Data
        $filter_data = array(
            'job_id' => $job_id,
            'applied' => 1,
            'filter_location' => $filter_location,
            'filter_experience' => $filter_experience,
            'filter_language' => $filter_language,
            'filter_skills' => $filter_job_skills,
            'freelancer_filter' => $filter_language ||  $filter_job_skills ? 'join' : 'none',
            'sort' => 'cj.cj_isAccepted, cj.freelancer_job_id',
            'order' => 'DESC'
        );
        $total_jobs = $this->model_job->getTotalFreelancerJobs($this->company->company_id, $filter_data);
        $jobs = $this->model_job->getFreelancerJobs($this->company->company_id, $filter_data);
        if ($jobs) {
            $this->load->model('freelancer/Freelancer_model', 'model_freelancer');  //Load freelancer model

            foreach ($jobs as $job) {
                $freelancer = $this->model_freelancer->getFreelancerById($job->freelancer_id);
                $location = isset($freelancer->city) ? $freelancer->city : '';
                $fskills = isset($freelancer->skills) ? $freelancer->skills : '';
                $skills = $fskills ? json_decode($fskills) : array();
                $job_skills = array();
                if ($skills) {
                    foreach ($skills as $skill) {
                        $jobskill = $this->model_jobcategory->getCategory($skill);
                        if ($jobskill) {
                            $job_skills[] = $jobskill->name;
                        }
                    }
                }


                //Load Image
                if ($job->freelancer_image && file_exists(APPPATH . 'assets/uploads/logo/' . $job->freelancer_image)) {
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $job->freelancer_image;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
                }

                if ($job->cj_isRemoved) {
                    $freelancer_job_status = 'Removed';
                } else {
                    $freelancer_job_status = 'Applied';
                }

                if ($job->cj_isAccepted == 1) {
                    $accepted = 1;
                    $milestone_link = base_url() . "company/activity/freelancer/accepted_job/" . $job->job_id;
                    $cancel_link = base_url() . "company/activity/freelancer/cancel/" . $job->freelancer_job_id;
                } else {
                    $accepted = 0;
                    $milestone_link = '';
                    $cancel_link = '';
                }

                $json['jobs'][] = array(
                    'freelancer_job_id' => $job->freelancer_job_id,
                    'job_id' => $job->job_id,
                    'freelancer_id' => $job->freelancer_id,
                    'title' => $job->title,
                    'job_type' => '',
                    'isApplied' => $job->cj_isApplied,
                    'accepted' => $accepted,
                    'milestone_link' => $milestone_link,
                    'cancel_link' => $cancel_link,
                    'bid_amount' => format_currency($job->cj_amount),
                    'bid_proposal' => $job->cj_proposal,
                    'isAccepted' => $job->cj_isAccepted,
                    'isCompleted' => $job->cj_isCompleted,
                    'isRemoved' => $job->cj_isRemoved,
                    'job_status' => $freelancer_job_status,
                    'freelancer' => array(
                        'name' => $job->freelancer_name,
                        'thumb' => $thumb,
                        'location' => $location,
                        'skills' => $job_skills ? implode(', ', $job_skills) : '',
                        'view' => base_url() . 'company/activity/freelancer/profile/' . $job->freelancer_id,
                        'accept' => base_url() . 'company/activity/freelancer/accept/' . $job->freelancer_job_id,
                        'remove' => base_url() . 'company/activity/freelancer/remove/' . $job->freelancer_job_id
                    ),
                    'post_date' => $job->cj_date_modified && $job->cj_date_modified != '0000-00-00 00:00:00' ? date('d F Y', strtotime($job->cj_date_modified)) : ''

                );
            }
            $json['success'] = true;
        } else {
            $json['error'] = true;
            $json['accepted_job'] = $accepted_job;
        }

        echo json_encode($json);
    }


    public function accepted()
    {
        $data = array();

        // Validation
        $this->validate();

        $this->load->helper('category'); // Load category helper

        //Get Page Number
        if ($this->uri->segment(5)) {
            $page = (int)$this->uri->segment(5);
        } else {
            $page = 1;
        }

        $data['moduleAction'] = 'company';

        $limit = 10;

        $this->load->library('recruiter');
        $data['logged'] = $this->recruiter->isLogged();
        $data['heading_title'] = 'Accepted Freelancer Jobs';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Accepted Jobs',
            'href' => base_url() . 'company/activity/freelancer/applied'
        );
        $data['active_menu'] = 'mnu-freelancer-applied';
        $data['menu_section'] = $this->menu_section;

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }


        // Get Company
        $data['company'] = $this->company;
        $company_id = $this->company->company_id;
        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['jobs'] = array();
        //Filter Data
        $filter_data = array(
            'applied' => 1,
            'accepted' => 1,
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'cj.freelancer_job_id',
            'order' => 'DESC'
        );
        // Get Job List
        $total_jobs = $this->model_job->getTotalFreelancerJobs($company_id, $filter_data);
        $jobs = $this->model_job->getFreelancerJobs($company_id, $filter_data);

        if ($jobs) {
            foreach ($jobs as $job) {

                //Load Image
                if ($job->freelancer_image && file_exists(APPPATH . 'assets/uploads/logo/' . $job->freelancer_image)) {
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $job->freelancer_image;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
                }

                //Load Resume
                $freelancer_resume = '';
                if ($job->freelancer_resume) {
                    if (file_exists(APPPATH . 'assets/images/freelancer/resume/' . $job->freelancer_resume)) {
                        $freelancer_resume = base_url() . 'application/assets/images/freelancer/resume/' . $job->freelancer_resume;
                    }
                }

                if ($job->cj_isRemoved) {
                    $job_status = 'Removed';
                } else if ($job->cj_isAccepted) {
                    $job_status = 'accepted';
                } else {
                    $job_status = 'Applied';
                }

                $data['jobs'][] = array(
                    'freelancer_job_id' => $job->freelancer_job_id,
                    'job_id' => $job->job_id,
                    'freelancer_name' => $job->freelancer_name,
                    'title' => $job->title,
                    'thumb' => $thumb,
                    'location' => $job->location,
                    'job_type' => '', //get_job_type($job->job_type),
                    'isApplied' => $job->cj_isApplied,
                    'isAccepted' => $job->cj_isAccepted,
                    'isRemoved' => $job->cj_isRemoved,
                    'job_status' => $job_status,
                    'resume' => $freelancer_resume,
                    'view' => base_url() . 'company/activity/freelancer/accepted_job/' . $job->job_id,
                    'remove' => base_url() . 'company/activity/freelancer/remove/' . $job->freelancer_job_id
                );
            }
        }

        //Pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'company/freelancer/applied/';
        $config['total_rows'] = $total_jobs;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['attributes'] = array('class' => 'page-numbers');

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        $data['loadjobs'] = base_url() . 'company/activity/freelancer/acceptedJobs';
        $data['moduleAction'] = 'company';
        $this->load->view('header');
        $this->load->view('company/activity/freelancer/accepted', $data);
        $this->load->view('footer');
    }

    public function profile($slug)
    {
        $data = array();

        // if (!$freelancer_id) {
        //     $data['heading'] = '404 - Not Found';
        //     $data['message'] = 'Requested pag was not found on this server';
        //     $html = $this->load->view('errors/html/custom_404.php', $data, TRUE);
        //     echo $html;
        //     exit;
        // }

        $this->load->model('Users_model', 'model_user');
        $this->load->library('Users');
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

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }


        $user = $this->model_user->getUserBySlug($slug);
        $this->loadDetails(); // Load details
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer'); //Load freelancer Model

        $data['logged'] = $this->user_id = $this->users->isLogged();
        if ($this->user_id) {
            $data['user'] = get_user_account($this->user_id);
            $data['profile_progress'] = get_profile_status($this->company, 'company');
        } else {
            $data['user'] = [];
            $data['profile_progress'] = false;
        }

        $this->load->model('freelancer/Education_model', 'model_freelancer_education');
        $this->load->model('freelancer/Experience_model', 'model_freelancer_experience');
        $this->load->model('freelancer/Project_model', 'model_freelancer_project');
        $this->load->model('freelancer/Certification_model', 'model_freelancer_certification');

        $data['freelancer'] = array();
        $data['freelancer_profile_progress'] = 0;
        $freelancer = $this->model_freelancer->getFreelancer($user->user_id);
        if ($freelancer) {
            $data['freelancer_profile_progress'] = get_profile_status($freelancer, 'freelancer');
            $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
            $this->load->model('freelancer/Feedback_model', 'model_feedback');  // Load feedback model
            $feedback = $this->model_feedback->getFeedbacksRating($freelancer->freelancer_id);

            //$industry = $this->model_jobcategory->getCategory($freelancer->company_category);
            //$job_type = $this->model_jobcategory->getCategory($freelancer->job_type);

            $education = $this->model_freelancer_education->getEducations($freelancer->freelancer_id);
            $project = $this->model_freelancer_project->getProjects($freelancer->freelancer_id);
            $experience = $this->model_freelancer_experience->getExperiences($freelancer->freelancer_id);
            $certification = $this->model_freelancer_certification->getCertifications($freelancer->freelancer_id);

            //Load Image
            if ($freelancer->image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
            }

            //Load Resume
            $freelancer_resume = '';
            if ($freelancer->resume) {
                if (file_exists(APPPATH . 'assets/files/freelancer/resume/' . $freelancer->resume)) {
                    $freelancer_resume = base_url() . 'application/assets/files/freelancer/resume/' . $freelancer->resume;
                }
            }

            $skills = array();
            if ($freelancer->skills) {

                $skill_details = json_decode($freelancer->skills);
                if ($skill_details) {
                    foreach ($skill_details as $skill_detail) {
                        $skill = $this->model_jobcategory->getCategory($skill_detail);
                        if ($skill) {
                            $skills[] = array(
                                'id' => $skill->category_id,
                                'name' => $skill->name
                            );
                        }
                    }
                }
            }

            /*$personal_details = array(
				'father_name' => $freelancer->father_name,
				'mother_name' => $freelancer->mother_name,
				'dob' => $freelancer->dob,
				'gender' => $freelancer->gender,
				'nationality' => $freelancer->nationality,
				'address' => $freelancer->address,
			);*/


            $languages = array();
            $freelancer_languages = $freelancer->languages ? json_decode($freelancer->languages) : '';
            if ($freelancer_languages) {
                foreach ($freelancer_languages as $language_id) {
                    $detail = $this->model_jobcategory->getLanguage($language_id);
                    if ($detail) {
                        $languages[] = $detail['name'];
                    }
                }
            }

            $dexperience = $this->model_jobcategory->getCategory($freelancer->experience);
            $desired_job = array(
                'experience' => isset($dexperience->name) ? $dexperience->name : '',
                'languages' => $languages ? implode(', ', $languages) : '',
            );
            $data['freelancer'] = array(
                'freelancer_id' => $freelancer->freelancer_id,
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
                'email' => $freelancer->email,
                'resume' => array('name' => $freelancer->resume, 'download' => $freelancer_resume),
                'thumb' => $thumb,
                'about' => $freelancer->about,
                'skills' => $skills,
                'education' => $education,
                'city' => $freelancer->city,
                'state' => $freelancer->state,
                'project' => $project,
                'experience' => $experience,
                'certification' => $certification,
                //'personal_details' => $personal_details,
                'desired_job' => $desired_job,
                'feedback' => array(
                    'total' => isset($feedback->total) ? $feedback->total : 0,
                    'ratings' => isset($feedback->ratings) ? $feedback->ratings : 0
                )
            );
        }

        $html = $this->load->view('company/activity/freelancer/resume', $data, TRUE);

        $json['success'] = true;
        $json['html'] = $html;
        $this->load->view('header');
        $this->load->view('company/activity/freelancer/profile', $data);
        $this->load->view('footer');
    }

    //Load Skills
    public function skills($freelancer_id)
    {
        $this->load->model('freelancer/skill_model', 'model_freelancer_skill'); // Load skills
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
            $freelancer_skills = $this->model_freelancer_skill->getSkills($freelancer_id);
            $skills = array();
            if ($freelancer_skills) {
                foreach ($freelancer_skills as $skill) {
                    $detail = $this->model_jobcategory->getCategory($skill->skill_id);
                    if ($detail) {
                        $skills[] = array(
                            'skill_id' => $detail->category_id,
                            'name' => $detail->name,
                            'percentage' => $skill->percentage
                        );
                    }
                }
            }

            $json['success'] = $skills;
            $json['message'] = 'show';
        }

        echo json_encode($json);
    }

    //For AJAX Loading
    public function acceptedJobs()
    {
        $json = array();

        // Validation
        if (!$this->validate(true)) {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
            echo json_encode($json);
            exit;
        }

        $this->load->helper('category'); // Load category helper

        //Get Page Number
        if ($this->input->get('page')) {
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
            'accepted' => 1,
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'cj.freelancer_job_id',
            'order' => 'DESC'
        );
        // Get Job List
        $total_jobs = $this->model_job->getTotalFreelancerJobs($company_id, $filter_data);
        $jobs = $this->model_job->getFreelancerJobs($company_id, $filter_data);

        if ($jobs) {
            foreach ($jobs as $job) {

                //Load Image
                if ($job->freelancer_image && file_exists(APPPATH . 'assets/uploads/logo/' . $job->freelancer_image)) {
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $job->freelancer_image;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
                }

                //Load Resume
                $freelancer_resume = '';
                if ($job->freelancer_image) {
                    if (file_exists(APPPATH . 'assets/images/freelancer/resume/' . $job->freelancer_resume)) {
                        $freelancer_resume = base_url() . 'application/assets/images/freelancer/resume/' . $job->freelancer_resume;
                    }
                }

                if ($job->cj_isRemoved) {
                    $job_status = 'Removed';
                } else if ($job->cj_isShortListed) {
                    $job_status = 'Shortlisted';
                } else {
                    $job_status = 'Applied';
                }

                $json['jobs'][] = array(
                    'job_id' => $job->job_id,
                    'freelancer_name' => $job->freelancer_name,
                    'title' => $job->title,
                    'thumb' => $thumb,
                    'location' => $job->location,
                    'job_type' => '', //get_job_type($job->job_type),
                    'isApplied' => $job->cj_isApplied,
                    'isShortlisted' => $job->cj_isShortListed,
                    'isRemoved' => $job->cj_isRemoved,
                    'job_status' => $job_status,
                    'resume' => $freelancer_resume,
                    'view' => base_url() . 'company/activity/freelancer/accepted_job/' . $job->job_id,
                    'remove' => base_url() . 'company/activity/freelancer/remove/' . $job->freelancer_job_id
                );
            }

            //Pagination
            $this->load->library('pagination');

            $config['base_url'] = base_url() . 'company/freelancer/applied/';
            $config['total_rows'] = $total_jobs;
            $config['per_page'] = $limit;
            $config['use_page_numbers'] = TRUE;
            $config['attributes'] = array('class' => 'page-numbers');

            $this->pagination->initialize($config);

            $json['pagination'] = $this->pagination->create_links();

            $json['success'] = true;
            $json['message'] = 'Applied Jobs';
        } else {
            $json['success'] = true;
            $json['message'] = 'No Job Details';
        }


        echo json_encode($json);
    }

    public function accepted_job($job_id)
    {
        $data = array();

        //Validation
        $this->validate();

        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

        $this->load->helper('category'); // Load category helper

        $data['moduleAction'] = 'company';

        $this->load->library('recruiter');
        $data['logged'] = $this->recruiter->isLogged();
        $data['heading_title'] = 'Accepted Freelancer Jobs';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Accepted Jobs',
            'href' => base_url() . 'company/activity/freelancer/applied'
        );
        $data['active_menu'] = 'mnu-freelancer-applied';
        $data['menu_section'] = $this->menu_section;

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }


        // Get Company
        $data['company'] = $this->company;
        $company_id = $this->company->company_id;
        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['job'] = array();
        $data['milestones'] = array();

        //Filter Data
        $filter_data = array(
            'applied' => 1,
            'accepted' => 1,
            'sort' => 'cj.freelancer_job_id',
            'order' => 'DESC'
        );
        // Get Job
        $job = $this->model_job->getFreelancerJobByCJ($this->company->company_id, $job_id, $filter_data);
        if ($job) {
            $job_milestones  = $this->model_job->getJobMilestones($job->freelancer_job_id);
            if ($job_milestones) {
                foreach ($job_milestones as $job_milestone) {
                    $status = get_status($job_milestone->cjm_status);
                    $end_date = false;
                    if ($job_milestone->cjm_start_date && ($job_milestone->cjm_start_date != '0000-00-00 00:00:00') && $job_milestone->cjm_duration) {
                        $durationText = '+ ' . $job_milestone->cjm_duration . ' days';
                        $enddate_str = strtotime($durationText, strtotime($job_milestone->cjm_start_date));
                        $end_date = date('d M Y', $enddate_str);
                    }

                    $data['milestones'][] = array(
                        'amount' => format_currency($job_milestone->cjm_amount),
                        'description' => html_entity_decode($job_milestone->cjm_description),
                        'status' => $status ? $status['name'] : '',
                        'initiator' => ('CMP' == $job_milestone->cjm_initiator) ? true : false,
                        'is_accepted' => $job_milestone->cjm_isAccepted ? $job_milestone->cjm_isAccepted : 0,
                        'is_rejected' => $job_milestone->cjm_isRejected ? $job_milestone->cjm_isRejected : 0,
                        'is_approved' => $job_milestone->cjm_isApproved ? $job_milestone->cjm_isApproved : 0,
                        'is_completed' => $job_milestone->cjm_isCompleted ? $job_milestone->cjm_isCompleted : 0,
                        'is_closed' => $job_milestone->cjm_isClosed ? $job_milestone->cjm_isClosed : 0,
                        'is_payReleased' => $job_milestone->cjm_isPayReleased ? $job_milestone->cjm_isPayReleased : 0,
                        'accept' => base_url() . 'company/activity/freelancer_jobmilestone/accept/' . $job_milestone->freelancer_job_milestone_id . '/' . $job->user_id,
                        'reject' => base_url() . 'company/activity/freelancer_jobmilestone/reject/' . $job_milestone->freelancer_job_milestone_id,
                        'pay' => base_url() . 'company/activity/freelancer_jobmilestone/pay/' . $job_milestone->freelancer_job_milestone_id,
                        'complete' => base_url() . 'company/activity/freelancer_jobmilestone/complete/' . $job_milestone->freelancer_job_milestone_id,
                        'close' => base_url() . 'company/activity/freelancer_jobmilestone/close/' . $job_milestone->freelancer_job_milestone_id,
                        'edit' => base_url() . 'company/activity/freelancer_jobmilestone/edit/' . $job_milestone->freelancer_job_milestone_id,
                        'change_status' => base_url() . 'company/activity/freelancer_jobmilestone/changeStatus/' . $job_milestone->freelancer_job_milestone_id,
                        'delete' => base_url() . 'company/activity/freelancer_jobmilestone/delete/' . $job_milestone->freelancer_job_milestone_id,
                        'start_date' => $job_milestone->cjm_start_date,
                        'duration' => $job_milestone->cjm_duration,
                        'duration_period' => ['code' => 'day', 'name' => 'Day'],
                        'end_date' => $end_date,
                        'date_added' => $job_milestone->cjm_date_added ? date('d M Y', strtotime($job_milestone->cjm_date_added)) : ''
                    );
                }
            }

            //Load Image
            if ($job->freelancer_image && file_exists(APPPATH . 'assets/uploads/logo/' . $job->freelancer_image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $job->freelancer_image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
            }

            if ($job->cj_isRemoved) {
                $job_status = 'Removed';
            } else if ($job->cj_isAccepted) {
                $job_status = 'accepted';
            } else {
                $job_status = 'Applied';
            }

            $data['job'] = array(
                'freelancer_id' => $job->freelancer_id,
                'freelancer_job_id' => $job->freelancer_job_id,
                'job_id' => $job->job_id,
                'freelancer_name' => $job->freelancer_name,
                'title' => $job->title,
                'thumb' => $thumb,
                'location' => $job->location,
                'bid_amount' => format_currency($job->cj_amount),
                'job_duration' => get_project_duration($job->job_duration),
                'isApplied' => $job->cj_isApplied,
                'isAccepted' => $job->cj_isAccepted,
                'isCompleted' => $job->cj_isCompleted,
                'isRemoved' => $job->cj_isRemoved,
                'job_status' => $job_status,
                'remove' => base_url() . 'company/activity/freelancer/remove/' . $job->freelancer_job_id,
                'completed' => base_url() . 'company/activity/freelancer/projectCompleted/' . $job->freelancer_job_id,
            );
        }

        $data['add_milestone_action'] = base_url() . 'company/activity/freelancer_jobmilestone/add/' . $job_id;
        $data['back'] = base_url() . 'company/jobs/freelancer/post/view/' . $job_id;
        $data['statuses'] = get_statuses();



        $this->load->view('header');
        $this->load->view('company/activity/freelancer/accepted_job', $data);
        $this->load->view('footer');
    }

    //Accept
    public function accept($freelancer_job_id)
    {
        $json = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate(true)) {
            $filter_data = array(
                'applied' => 1,
            );
            $job = $this->model_job->getFreelancerJob($freelancer_job_id, $filter_data);

            if ($job) {
                //print_r($job);
                $acceptedJob = $this->model_job->getFreelancerJobsByCJ($this->company->company_id, $job->job_id, ['applied' => 1, 'accepted' => 1, 'removed' => 0]);

                if ($acceptedJob) {
                    $json['error'] = true;
                    $json['message'] = 'Someone Freelancer is Already Accepted!';
                } else {
                    $shortlist = $this->model_job->setFreelancerJobActivity($job->freelancer_job_id, array('accepted' => 1));
                    if ($shortlist) {
                        $this->sendShortlistMail($job);

                        //Set Notification
                        $this->load->library('notification');
                        $message = 'Your job proposal for ' . $job->title . ' was accepted by ' . $this->company->company_name;
                        $link = '';
                        $this->notification->add(
                            [
                                'sender_id' => $this->user_id,
                                'receiver_id' => $job->user_id,
                                'message' => $message,
                                'link' => $link,
                                'publish' => 0
                            ]
                        );
                        $msg = [
                            'title' => 'You are accepted by the company',
                            'body' => 'Your Bid was accepeted by the company. Cheers!',
                        ];
                        $user_info = $this->model_user->getUser($job->user_id);
                        // foreach ($user_info as $user_token) {
                        pushNotification($user_info->device_details, $msg);
                        // }
                        $jobs = $this->model_job->getFreelancerJobsByCJ($this->company->company_id, $job->job_id, ['applied' => 1, 'accepted' => 0, 'removed' => 0, 'except' => [$job->freelancer_job_id]]);
                        if ($jobs) {
                            foreach ($jobs as $jobz) {
                                $shortlist = $this->model_job->setFreelancerJobActivity($jobz->freelancer_job_id, array('removed' => 1));
                            }
                        }

                        $json['success'] = true;
                        $json['message'] = 'freelancer Accepted';
                    } else {
                        $json['error'] = true;
                        $json['message'] = 'freelancer Not Accepted!';
                    }
                }
            } else {
                $json['error'] = true;
                $json['message'] = 'freelancer Project data Not Found';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->error ? $this->loadErrors() : 'Invalid Method';
        }

        echo json_encode($json);
    }

    //Cancel
    public function cancel($freelancer_job_id)
    {
        $json = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate(true)) {
            $filter_data = array(
                'applied' => 1,
                'accepted' => 1,
            );
            $job = $this->model_job->getFreelancerJob($freelancer_job_id, $filter_data);

            if ($job) {
                //print_r($job);
                $acceptedJob = $this->model_job->getFreelancerJobsByCJ($this->company->company_id, $job->job_id, ['applied' => 1, 'accepted' => 1, 'removed' => 0]);

                if ($acceptedJob) {
                    $cancel = $this->model_job->setFreelancerJobActivity($job->freelancer_job_id, array('accepted' => 0));
                    if ($cancel) {
                        // $this->sendShortlistMail($job);

                        //Set Notification
                        $this->load->library('notification');
                        $message = 'Your job proposal for ' . $job->title . ' was canceled by ' . $this->company->company_name;
                        $link = '';
                        $this->notification->add(
                            [
                                'sender_id' => $this->user_id,
                                'receiver_id' => $job->user_id,
                                'message' => $message,
                                'link' => $link,
                                'publish' => 0
                            ]
                        );
                        $jobs = $this->model_job->getFreelancerJobsByCJ($this->company->company_id, $job->job_id, ['applied' => 1, 'accepted' => 0, 'removed' => 0, 'except' => [$job->freelancer_job_id]]);
                        if ($jobs) {
                            foreach ($jobs as $jobz) {
                                $this->model_job->setFreelancerJobActivity($jobz->freelancer_job_id, array('removed' => 0));
                            }
                        }
                        $json['success'] = true;
                        $json['message'] = 'freelancer Accepted canceled';
                    } else {
                        $json['error'] = true;
                        $json['message'] = 'freelancer Not canceled!';
                    }
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Cannot cancel freelancer!';
                }
            } else {
                $json['error'] = true;
                $json['message'] = 'freelancer Project data Not Found';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->error ? $this->loadErrors() : 'Invalid Method';
        }

        echo json_encode($json);
    }


    public function remove($freelancer_job_id)
    {
        $json = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate(true)) {
            $filter_data = array(
                'applied' => 1,
            );
            $job = $this->model_job->getFreelancerJob($freelancer_job_id, $filter_data);
            if ($job) {
                $removed = $this->model_job->setFreelancerJobActivity($job->freelancer_job_id, array('removed' => 1));
                if ($removed) {
                    $json['success'] = true;
                    $json['message'] = 'freelancer Job Removed/Rejected';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'freelancer Job Not Removed/Rejected!';
                }
            } else {
                $json['error'] = true;
                $json['message'] = 'freelancer Job data Not Found';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->error ? $this->loadErrors() : 'Invalid Method';
        }

        echo json_encode($json);
    }

    public function projectCompleted($freelancer_job_id)
    {
        $json = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate(true)) {
            $filter_data = array(
                'applied' => 1,
            );
            $job = $this->model_job->getFreelancerJob($freelancer_job_id, $filter_data);
            if ($job) {
                $removed = $this->model_job->setFreelancerJobActivity($job->freelancer_job_id, array('completed' => 1));
                if ($removed) {
                    $json['success'] = true;
                    $json['message'] = 'freelancer Project completed';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'freelancer Project Not completed!';
                }
            } else {
                $json['error'] = true;
                $json['message'] = 'freelancer Project data Not Found';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->error ? $this->loadErrors() : 'Invalid Method';
        }

        echo json_encode($json);
    }

    protected function validate($return = false)
    {
        //Check if company user is loggedin or not
        $this->load->library('recruiter');
        $this->user_id = $this->recruiter->isLogged();
        if (!$this->user_id) {
            if ($return) {
                $this->error['login'] = 'Please login to your account';
            } else {
                redirect(base_url() . 'login');
            }
        } else {
            $this->loadDetails();
        }

        $profile_status = $this->getProfileStatus('company');
        if (!$profile_status) {
            if ($return) {
                $this->error['profile'] = 'Please complete profile';
            } else {
                $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
                redirect(base_url() . 'company/profile?redirect=' . $this->page_name);
            }
        }

        // Check commission agree
        if (!$this->company->isCommissionAgreed) {
            if ($return) {
                $this->error['commission'] = 'Please agree commission Policy';
            } else {
                $this->document->addAlert('commission', 'info');
            }
        }

        if ($return) {
            return !$this->error;
        }
    }

    protected function validateCommission()
    {
        if (!$this->company->isCommissionAgreed) {
            $this->error['commission'] = "Please agree commission policy";
        }

        return !$this->error;
    }

    protected function loadDetails()
    {
        $this->load->helper(array('user', 'freelancer_category_helper')); // Load helpers
        $this->load->model('company/Company_model', 'model_company');   //Load company model
        $this->load->model('company/Freelancer_jobs_model', 'model_job'); //Load company jobs model
        $this->load->model('Notification_model', 'model_notification'); //Load notification model
        $this->company = $this->model_company->getCompany($this->user_id);
    }


    //Check profile status. If it is below 80, redirect to profile page. Otherwise return status
    protected function getProfileStatus($type)
    {
        if ($this->user_id) {
            $this->company = $this->model_company->getCompany($this->user_id);
            $profile_progress = get_profile_status($this->company, $type);
            if ($profile_progress < 80) {
                return false;
            } else {
                return $profile_progress;
            }
        } else {
            return true;
        }
    }

    protected function sendShortlistMail($job)
    {
        $this->load->model('freelancer/freelancer_model', 'model_freelancer');
        $jobz = $this->model_job->getFreelancerJob($job->freelancer_job_id, array('shortlist' => 1));
        $freelancer = $this->model_freelancer->getFreelancerById($job->freelancer_id);
        if ($freelancer && $jobz) {
            $data['freelancer'] = array(
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name
            );

            //Job
            $job_data = array(
                'title' => $jobz->title,
            );

            //Company
            $company_data = array(
                'user' => $this->company->first_name . ' ' . $this->company->last_name,
                'company_name' => $this->company->company_name
            );
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            $this->email->initialize($config);

            $this->email->from('admin@offrolls.in', 'Offrolls');
            $this->email->to($freelancer->email);
            $this->email->subject('Project Application shortlisted');

            $setting = getSettings('website');
            $html = $this->load->view('company/mail/freelancer_shortlist', ['setting' => $setting, 'job' => $job_data, 'company' => $company_data], TRUE);
            $this->email->message($html);



            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        }
    }

    protected function sendScheduleMail($job)
    {
        $this->load->model('freelancer/freelancer_model', 'model_freelancer');
        $jobz = $this->model_job->getFreelancerJob($job->freelancer_job_id, array('scheduled' => 1));
        $freelancer = $this->model_freelancer->getFreelancerById($job->freelancer_id);
        if ($freelancer && $jobz) {
            $data['freelancer'] = array(
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name
            );

            //Job
            $schedule_details = $jobz->cj_schedule_details ? json_decode($jobz->cj_schedule_details) : array();
            $schedule_date = isset($schedule_details->sdate) ? $schedule_details->sdate : '';
            $schedule_time = isset($schedule_details->stime) ? $schedule_details->stime : '';
            if ($schedule_date && $schedule_time) {
                $schedule_datetime = date('d F, Y \a\t H:i A', strtotime($schedule_details->sdate . ' ' . $schedule_details->stime));
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
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            $this->email->initialize($config);

            $this->email->from('admin@offrolls.in', 'Offrolls');
            $this->email->to($freelancer->email);
            $this->email->subject('Interview Invitation');
            $html = $this->load->view('company/mail/freelancer_schedule_interview', $data, TRUE);
            $this->email->message($html);


            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function addRating()
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate(true)) {
            $freelancer_job_id = $this->input->post('freelancer_job_id');
            $filter_data = array(
                'applied' => 1,
            );
            $job = $this->model_job->getFreelancerJob($freelancer_job_id, $filter_data);
            if ($job) {
                $feedback_data = array(
                    'freelancer_id' => $job->freelancer_id,
                    'company_id' => $this->user_id,
                    'job_id' => $job->job_id,
                    'rating_points' => $this->input->post('rating_points'),
                    'feedback_content' => $this->input->post('feedback_content'),
                );
                // print_r($feedback_data);
                $feedback = $this->model_job->addFreelancerFeedback($feedback_data);
                if ($feedback) {
                    $json['success'] = true;
                    $json['message'] = 'Feedback Submitted';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Feedback Not Submitted!';
                }
            } else {
                $json['error'] = true;
                $json['message'] = 'Freelancer Job data Not Found!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    protected function loadErrors()
    {
        $errorContent = '';
        if (isset($this->error['login'])) {
            $errorContent = $this->error['login'];
        } elseif (isset($this->error['profile'])) {
            $errorContent = $this->error['profile'];
        } elseif (isset($this->error['commission'])) {
            $errorContent = $this->error['commission'];
        }

        return $errorContent;
    }
}
