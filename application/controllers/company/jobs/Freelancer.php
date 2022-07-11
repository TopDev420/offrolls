<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freelancer extends CI_Controller
{
    private $page_name = 'freelancer_jobposts';
    private $user_id;
    private $company = array();
    private $menu_section = 'freelancer';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('recruiter');
        $this->validate();
    }

    public function index()
    {
        $this->getJobPostList();
    }

    public function post($job_action = 'list', $job_id = 0)
    {
        switch ($job_action) {
            case 'view':
                $this->viewJobPost($job_id);
                break;
            case 'review':
                $this->reviewJobPost($job_id);
                break;
            case 'add':
                $this->addJobPost();
                break;
            case 'publish':
                $this->publishJobPost($job_id);
                break;
            case 'draft':
                $this->draftJobPost($job_id);
                break;
            case 'edit':
                $this->editJobPost($job_id);
                break;
            case 'delete':
                $this->deleteJobPost($job_id);
                break;
            case 'deleteDraft':
                $this->deleteDraftJobPost($job_id);
                break;
            default:
                $this->getJobPostList();
        }
    }

    public function listPublishedJobs()
    {
        $data = array();

        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css'); //AddCss
        $data['logged'] = true;
        $data['heading_title'] = 'Freelancer Projects Post';    //Heading Title
        $data['breadcrumb'] = array();  //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Freelancer Projects',
            'href' => base_url() . 'company/jobs/freelancer/post'
        );
        $data['active_menu'] = 'mnu-jobs';
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

        $data['company'] = array();
        $data['jobs'] = array();

        if ($this->company) {
            //Load Image
            if ($this->company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $this->company->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $this->company->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['company'] = array(
                'name' => $this->company->company_name ? $this->company->company_name : '-',
                'email' => $this->company->email,
                'thumb' => $thumb,
                'status' => $this->company->status,
            );
        }
        $data['user'] = get_user_account($this->user_id);
        if ($data['user']) {
            $data['user']['company_name'] = $this->company->company_name;
        }

        $data['profile_link'] = base_url() . 'company/profile';
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['loadActiveJobs'] = base_url() . 'company/jobs/freelancer/activeJobs';

        $data['total_projects'] = 0;

        $this->load->view('header', $data);
        $this->load->view('company/activity/freelancer/published_jobs');
        $this->load->view('footer');
    }

    public function listDraftedJobs()
    {
        $data = array();

        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css'); //AddCss
        $data['logged'] = true;
        $data['heading_title'] = 'Freelancer Projects Post';    //Heading Title
        $data['breadcrumb'] = array();  //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Freelancer Projects',
            'href' => base_url() . 'company/jobs/freelancer/post'
        );
        $data['active_menu'] = 'mnu-jobs';
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

        $data['company'] = array();
        $data['jobs'] = array();

        if ($this->company) {
            //Load Image
            if ($this->company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $this->company->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $this->company->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['company'] = array(
                'name' => $this->company->company_name ? $this->company->company_name : '-',
                'email' => $this->company->email,
                'thumb' => $thumb,
                'status' => $this->company->status,
            );
        }
        $data['user'] = get_user_account($this->user_id);
        if ($data['user']) {
            $data['user']['company_name'] = $this->company->company_name;
        }

        $data['profile_link'] = base_url() . 'company/profile';
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['loadInactiveJobs'] = base_url() . 'company/jobs/freelancer/inactiveJobs';

        $data['total_projects'] = 0;

        // $msg = [
        //     'title' => 'New Project',
        //     'body' => 'A company has posted a new Project you may interested - Apply now.',
        // ];
        // $user_info = $this->model_user->getUserDetails(array('user_type' => 3));
        // foreach ($user_info as $user_token) {
        //     $device_id[] = $user_token->device_details;
        //     pushNotification($user_token->device_details, $msg);
        // }
        $this->load->view('header', $data);
        $this->load->view('company/activity/freelancer/drafted_jobs');
        $this->load->view('footer');
    }

    protected function getJobPostList($type = NULL)
    {
        $data = array();

        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css'); //AddCss
        $data['logged'] = true;
        $data['heading_title'] = 'Freelancer Projects Post';    //Heading Title
        $data['breadcrumb'] = array();  //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Freelancer Projects',
            'href' => base_url() . 'company/jobs/freelancer/post'
        );
        $data['active_menu'] = 'mnu-jobs';
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

        $data['company'] = array();
        $data['jobs'] = array();

        if ($this->company) {
            //Load Image
            if ($this->company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $this->company->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $this->company->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['company'] = array(
                'name' => $this->company->company_name ? $this->company->company_name : '-',
                'email' => $this->company->email,
                'thumb' => $thumb,
                'status' => $this->company->status,
                // 'total_projects' => $this->model_project->getTotalJobs($this->company->company_id, array('status' => 1))
            );
        }
        $data['user'] = get_user_account($this->user_id);
        if ($data['user']) {
            $data['user']['company_name'] = $this->company->company_name;
        }

        $data['profile_link'] = base_url() . 'company/profile';
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['loadActiveJobs'] = base_url() . 'company/jobs/freelancer/activeJobs';
        $data['loadInactiveJobs'] = base_url() . 'company/jobs/freelancer/inactiveJobs';


        $this->load->view('header', $data);
        $this->load->view('company/activity/freelancer/jobs');
        $this->load->view('footer');
    }

    public function activeJobs()
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //Get Page Number
            if ($this->uri->segment(5)) {
                $page = (int)$this->uri->segment(5);
            } else {
                $page = 1;
            }

            $limit = 10;
            $json['jobs'] = array();
            $jobs = $this->loadJobs(array('limit' => $limit, 'page' => $page, 'status' => 1, 'remove' => 0));
            if ($jobs) {
                $jList = $jobs->list;
                $jPagination = [];

                //Pagination
                $nextPage = ($limit * $page) < $jobs->total ? $page + 1 : false;
                if ($nextPage && $jobs->total) {
                    $jPagination = array(
                        'page' => $nextPage,
                        'href' => base_url() . 'company/jobs/freelancer/activeJobs/' . $nextPage
                    );
                }

                $json['jobs'] = array(
                    'total' => $jobs->total,
                    'list' => $jList,
                    'pagination' => $jPagination,
                );
            }
            $json['success'] = true;
        } else {
            $json['error'] = true;
        }
        echo json_encode($json);
    }

    public function inactiveJobs()
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //Get Page Number
            if ($this->uri->segment(5)) {
                $page = (int)$this->uri->segment(5);
            } else {
                $page = 1;
            }

            $limit = 10;
            $json['jobs'] = array();
            $json['pagination'] = '';
            $jobs = $this->loadJobs(array('limit' => $limit, 'page' => $page, 'status' => 0, 'remove' => 0));
            if ($jobs) {
                $jList = $jobs->list;
                //Pagination
                $this->load->library('pagination');

                $config['base_url'] = base_url() . 'company/jobs/freelancer/activeJobs/';
                $config['total_rows'] = $jobs->total;
                $config['per_page'] = $limit;
                $config['use_page_numbers'] = TRUE;
                $config['attributes'] = array('class' => 'page-numbers');

                $this->pagination->initialize($config);
                $jPagination = $this->pagination->create_links();

                $json['jobs'] = array(
                    'total' => $jobs->total,
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

    protected function loadJobs($filter)
    {
        $company_id = $this->company->company_id;

        $this->load->helper('category');
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');

        //Filter Data
        $filter_data = array(
            'start' => ($filter['limit'] * ($filter['page'] - 1)),
            'limit' => $filter['limit'],
            'status' => $filter['status'],
            'remove' => $filter['remove'],
            'sort' => 'job_id',
            'order' => 'DESC',
            'filter_date_from' => date('Y-m-d', strtotime('-' . $this->config->item('CJLTS'))),
            'filter_date_to' => date('Y-m-d')
        );
        // Get Jobs List
        $jobsList = array();
        $total_jobs = $this->model_freelancer_jobs->getTotalJobs($company_id, $filter_data);

        $jobs = $this->model_freelancer_jobs->getJobs($company_id, $filter_data);
        if ($jobs) {
            foreach ($jobs as $job) {
                //Filter Data
                $cfilter_data = array(
                    'job_id' => $job->job_id,
                    'applied' => 1,
                    'sort' => 'cj.freelancer_job_id',
                    'order' => 'DESC'
                );
                // Get Job List
                $total_applied_jobs = $this->model_freelancer_jobs->getTotalFreelancerJobs($company_id, $cfilter_data);

                $job_duration = get_project_duration($job->job_duration);
                if ($job->date_modified && $job->date_modified != '0000-00-00 00:00:00') {
                    $date_posted = $job->date_modified;
                } else {
                    $date_posted = $job->date_added;
                }

                // Get Job Details
                $freelancer_job = $this->model_freelancer_jobs->getFreelancerJobDetails($job->job_id);
                $isCompleted = '';
                if ($freelancer_job) {
                    $isCompleted = $freelancer_job->cj_isCompleted;
                }
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

                $jobsList[] = array(
                    'title' => $job->title,
                    'job_id' => $job->job_id,
                    'job_duration' => $job_duration,
                    'description' => $job->description,
                    'skills' => $jobskills,
                    'pay_type' => get_pay_type($job->pay_type),
                    'pay_amount' => format_currency($job->pay_amount),
                    'status' => $job->status ? $this->lang->line('active') : $this->lang->line('inactive'),
                    'view' => base_url() . 'company/jobs/freelancer/post/view/' . $job->job_id,
                    'edit' => base_url() . 'company/jobs/freelancer/post/edit/' . $job->job_id,
                    'review' => base_url() . 'company/jobs/freelancer/post/review/' . $job->job_id,
                    'remove' => base_url() . 'company/jobs/freelancer/post/delete/' . $job->job_id,
                    'delete' => base_url() . 'company/jobs/freelancer/post/deleteDraft/' . $job->job_id,
                    'total_applied_jobs' => $total_applied_jobs,
                    'completed' => $isCompleted,
                    'date_posted' => date('M d, Y', strtotime($date_posted))
                );
            }
        }

        return (object)array(
            'total' => $total_jobs,
            'list' => $jobsList,
        );
    }


    protected function getJobPostForm($job_id = 0)
    {
        $this->load->model('company/Freelancer_jobs_model', 'model_freelancer_jobs');     // Load Model

        $data['logged'] = true;
        $data['heading_title'] = 'Freelancer Project Post';    //Heading Title
        $data['breadcrumb'] = array();  //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        if ($job_id) {
            $data['breadcrumb'][] = array(
                'name' => 'Project Post',
                'href' => base_url() . 'company/jobs/freelancer/post/edit/' . $job_id
            );
        } else {
            $data['breadcrumb'][] = array(
                'name' => 'Project Post',
                'href' => base_url() . 'company/jobs/freelancer/post/add'
            );
        }

        $data['active_menu'] = 'mnu-jobs-post';
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
        $data['company'] = array();

        if ($this->company) {
            //Load Image
            if ($this->company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $this->company->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $this->company->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['company'] = array(
                'name' => $this->company->company_name ? $this->company->company_name : '-',
                'email' => $this->company->email,
                'thumb' => $thumb,
                'status' => $this->company->status,
            );
        }
        $data['user'] = get_user_account($this->user_id);
        $data['total_projects'] = $this->model_freelancer_jobs->getTotalJobs($this->company->company_id, array('status' => 1, 'remove' => 0));
        //Company Categories
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');

        // Get Job
        $data['job'] = array();
        $job = $this->model_freelancer_jobs->getJob($job_id);
        if ($job_id && $this->input->server('REQUEST_METHOD') != 'POST') {
            $data['form_action'] = base_url() . 'company/jobs/freelancer/post/edit/' . $job_id;
        } else {
            $data['form_action'] = base_url() . 'company/jobs/freelancer/post/add';
        }

        if (isset($job->job_id)) {
            $data['job_id'] = $job_id;
        } else {
            $data['job_id'] = 0;
        }

        if (isset($job->title)) {
            $data['job_title'] = $job->title;
        } else {
            $data['job_title'] = '';
        }

        if (isset($job->job_category)) {
            $data['job_category'] = $job->job_category;
        } else {
            $data['job_category'] = 0;
        }

        if (isset($job->job_specialization)) {
            $data['job_specialization'] = $job->job_specialization;
        } else {
            $data['job_specialization'] = 0;
        }

        if (isset($job->description)) {
            $data['job_description'] = $job->description;
        } else {
            $data['job_description'] = '';
        }

        if (isset($job->job_duration)) {
            $data['job_duration'] = $job->job_duration;
        } else {
            $data['job_duration'] = 0;
        }

        if (isset($job->job_type)) {
            $data['job_type'] = $job->job_type;
        } else {
            $data['job_type'] = '';
        }

        if (isset($job->job_time_period)) {
            $data['job_time_period'] = $job->job_time_period;
        } else {
            $data['job_time_period'] = 0;
        }

        $job_skills = array();
        if (isset($job->skills)) {
            $skills = $job->skills ? json_decode($job->skills) : array();
            if ($skills) {
                foreach ($skills as $skill) {
                    $jobskill = $this->model_jobcategory->getCategory($skill);
                    if ($jobskill) {
                        $job_skills[] = $jobskill;
                    }
                }
            }
            $data['job_skills'] = $job_skills;
        } else {
            $data['job_skills'] = $job_skills;
        }

        if (isset($job->location)) {
            $data['job_location'] = $job->location;
        } else {
            $data['job_location'] = '';
        }

        if (isset($job->experience_level)) {
            $data['job_experience_level'] = $job->experience_level;
        } else {
            $data['job_experience_level'] = '';
        }

        if (isset($job->experience)) {
            $data['job_experience'] = $job->experience;
        } else {
            $data['job_experience'] = 0;
        }

        $job_languages = array();
        if (isset($job->languages)) {
            $languages = $job->languages ? json_decode($job->languages) : array();
            if ($languages) {
                foreach ($languages as $language) {
                    $joblanguage = $this->model_jobcategory->getLanguage($language);
                    if ($joblanguage) {
                        $job_languages[] = $joblanguage;
                    }
                }
            }
            $data['job_languages'] = $job_languages;
        } else {
            $data['job_languages'] = $job_languages;
        }

        if (isset($job->pay_type)) {
            $data['job_pay_type'] = $job->pay_type;
        } else {
            $data['job_pay_type'] = '';
        }

        if (isset($job->pay_amount)) {
            $data['job_pay_amount'] = $job->pay_amount;
        } else {
            $data['job_pay_amount'] = '';
        }

        $filter_data = array(
            'status' => 1
        );
        $data['qualifications'] = $this->model_jobcategory->getCategories(QUALIFICATION_TYPE, $filter_data);

        $data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, $filter_data);

        $data['job']['job_skills'] = array();

        $data['job']['job_category'] = 0;

        $data['experiences'] = $this->model_jobcategory->getCategories(EXPERIENCE_TYPE, ['status' => 1, 'sort' => 'j.sort_order', 'order' => 'ASC']);
        if ($data['experiences']) {
            foreach ($data['experiences'] as $ekey => $experience) {
                if (strtolower($experience->name) == 'fresher') {
                    unset($data['experiences'][$ekey]);
                    break;
                }
            }
        }

        $data['project_types'] = get_project_types();
        $data['project_durations'] = get_project_durations();
        $data['project_time_periods'] = get_project_time_periods();
        $data['pay_types'] = get_pay_types();
        $data['experience_levels'] = get_experience_levels();


        $this->load->view('header', $data);
        $this->load->view('company/activity/freelancer/jobpost');
        $this->load->view('footer');
    }

    protected function viewJobpost($job_id)
    {
        if (!$job_id) {
            redirect(base_url() . 'company/jobs');
        }

        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/jobview.css');

        $data['logged'] = true;
        $data['heading_title'] = 'Job View';    //Heading Title
        $data['breadcrumb'] = array();  //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Freelancer',
            'href' => base_url() . 'company/jobs/freelancer/post'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Job',
            'href' => base_url() . 'company/jobs/freelancer/post/' . $job_id
        );
        $data['active_menu'] = 'mnu-jobs-view';
        $data['menu_section'] = $this->menu_section;

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['company'] = array();
        $company = $this->company;
        if ($company) {
            //Load Image
            if ($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $company->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['company'] = array(
                'name' => $company->company_name ? $company->company_name : '',
                'email' => $company->email,
                'thumb' => $thumb,
                'status' => $company->status,
            );
        }

        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Category Model

        // Get Job
        $data['job'] = $job_specialization = array();
        $job = $this->model_freelancer_jobs->getJob($job_id, array());
        if ($job) {
            $data['freelancer_jobs'] = array();
            $data['accepted_freelancer'] = array();


            //Freelancer Accepted Jobs
            //Filter Data
            $filter_data = array(
                'applied' => 1,
                'accepted' => 1,
                'sort' => 'cj.freelancer_job_id',
                'order' => 'DESC'
            );
            $freelancer_jobz = $this->model_freelancer_jobs->getFreelancerJobByCJ($job->company_id, $job->job_id, $filter_data);
            if ($freelancer_jobz) {

                //Load Image
                if ($freelancer_jobz->freelancer_image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer_jobz->freelancer_image)) {
                    $thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer_jobz->freelancer_image;
                } else {
                    $thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
                }

                if ($freelancer_jobz->cj_isRemoved) {
                    $freelancer_job_status = 'Removed';
                } else {
                    $freelancer_job_status = 'Applied';
                }

                $data['accepted_freelancer'] = array(
                    'job_id' => $freelancer_jobz->job_id,
                    'freelancer_name' => $freelancer_jobz->freelancer_name,
                    'title' => $freelancer_jobz->title,
                    'thumb' => $thumb,
                    'location' => $freelancer_jobz->location,
                    'job_type' => '',
                    'isApplied' => $freelancer_jobz->cj_isApplied,
                    'bid_amount' => format_currency($freelancer_jobz->cj_amount),
                    'bid_proposal' => $freelancer_jobz->cj_proposal,
                    'isAccepted' => $freelancer_jobz->cj_isAccepted,
                    'isRemoved' => $freelancer_jobz->cj_isRemoved,
                    'is_completed' => $freelancer_jobz->cj_isCompleted,
                    'job_link' => base_url() . 'company/activity/freelancer/accepted_job/' . $freelancer_jobz->job_id,
                    'job_status' => $freelancer_job_status,
                );
            }

            $job_category = $this->model_jobcategory->getCategory($job->job_category);  // Company Category
            $job_specialization = $this->model_jobcategory->getCategory($job->job_specialization, array('child' => 1));  // Job Category
            if ($job->experience_level == 'experienced') {
                $experience = $this->model_jobcategory->getCategory($job->experience);  // Experience
            } else {
                $experience = (object)array('name' => 'Fresher');
            }


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

            $job_languages = array();
            $languages = $job->languages ? json_decode($job->languages) : array();
            if ($languages) {
                foreach ($languages as $language) {
                    $joblanguage = $this->model_jobcategory->getLanguage($language);
                    if ($joblanguage) {
                        $job_languages[] = $joblanguage['name'];
                    }
                }
            }

            $data['job'] = array(
                'job_id' => $job->job_id,
                'title' => $job->title,
                'thumb' => $thumb,
                'description' => $job->description,
                'location' => $job->location,
                'job_skills' => $job_skills ? $job_skills : '',
                'job_duration' => get_project_duration($job->job_duration),
                'job_category' => isset($job_category->name) ? $job_category->name : '',
                'job_specialization' => isset($job_specialization->name) ? $job_specialization->name : '',
                'job_type' => get_project_type($job->job_type),
                'languages' => $job_languages,
                'experience_level' => $job->experience_level,
                'experience' => isset($experience->name) ? $experience->name : '',
                'pay_type' => get_pay_type($job->pay_type),
                'pay_amount' => format_currency($job->pay_amount),
                'status' => $job->status
            );
        }

        $data['moduleAction'] = 'company';
        $data['loadappliedjobs'] = base_url() . 'company/activity/freelancer/applied/' . $job_id;
        $data['review'] = 0;

        $this->load->view('header', $data);
        $this->load->view('company/activity/freelancer/jobpost_view');
        $this->load->view('footer');
    }

    protected function reviewJobpost($job_id)
    {
        if (!$job_id) {
            redirect(base_url() . 'company/jobs/freelancer/post');
        }

        $this->load->helper('date'); // Load date helper

        $data['logged'] = true;
        $data['heading_title'] = 'Job View';    //Heading Title
        $data['breadcrumb'] = array();  //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Freelancer',
            'href' => base_url() . 'company/jobs/freelancer/post'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Project Preview',
            'href' => base_url() . 'company/jobs/freelancer/post/' . $job_id
        );
        $data['active_menu'] = 'mnu-jobs-view';
        $data['menu_section'] = $this->menu_section;

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        $data['user'] = get_user_account($this->user_id);
        $data['profile_progress'] = get_profile_status($this->company, 'company');

        $data['company'] = array();
        $company = $this->company;
        if ($company) {
            //Load Image
            if ($company->image && file_exists(APPPATH . 'assets/uploads/logo/' . $company->image)) {
                $thumb = base_url() . 'application/assets/uploads/logo/' . $company->image;
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }

            $data['company'] = array(
                'name' => $company->company_name ? $company->company_name : '',
                'email' => $company->email,
                'thumb' => $thumb,
                'status' => $company->status,
                'location' => $company->city
            );
        }

        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Category Model

        // Get Job
        $data['job'] = array();
        $job = $this->model_freelancer_jobs->getJob($job_id, array());
        if ($job) {

            $job_category = $this->model_jobcategory->getCategory($job->job_category);  // Company Category
            $job_specialization = $this->model_jobcategory->getCategory($job->job_specialization, array('child' => 1));  // Job Category

            $experience = $this->model_jobcategory->getCategory($job->experience);  // Experience
            $freelancer_jobz = $this->model_freelancer_jobs->getFreelancerJobByCJ($job->company_id, $job->job_id);

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

            $job_languages = array();
            $languages = isset($job->languages) ? json_decode($job->languages) : array();
            if ($languages) {
                foreach ($languages as $language_id) {
                    $job_language = $this->model_jobcategory->getLanguage($language_id);  // Experience
                    if ($job_language) {
                        $job_languages[] = $job_language['name'];
                    }
                }
            }

            $data['job'] = array(
                'job_id' => $job->job_id,
                'title' => $job->title,
                'thumb' => $thumb,
                'description' => $job->description,
                'location' => $job->location,
                'job_skills' => $job_skills,
                'job_duration' => get_project_duration($job->job_duration),
                //'job_time_period' =>  get_project_time_periods(),
                'job_category' => isset($job_category->name) ? $job_category->name : '',
                'job_specialization' => isset($job_specialization->name) ? $job_specialization->name : '',
                'project_type' => get_project_type($job->project_type),
                'job_type' => get_project_type($job->job_type),
                'languages' => $job_languages,
                'isApplied' => isset($freelancer_jobz->cj_isApplied) ? $freelancer_jobz->cj_isApplied : '',
                'experience_level' => $job->experience_level,
                'experience' => isset($experience->name) ? $experience->name : '',
                'pay_type' => get_pay_type($job->pay_type),
                'pay_amount' => format_currency($job->pay_amount),
                'status' => $job->status,
                'post_date' => ($job->date_modified && $job->date_modified != '0000-00-00 00:00:00') ? $job->date_modified : $job->date_added,
                'edit' => base_url() . 'company/jobs/freelancer/post/edit/' . $job->job_id
            );

            if ($job->status) {
                $data['job']['draft'] = base_url() . 'company/jobs/freelancer/post/draft/' . $job->job_id;
            } else {
                $data['job']['publish'] = base_url() . 'company/jobs/freelancer/post/publish/' . $job->job_id;
            }
        }

        $data['moduleAction'] = 'company';

        $this->load->view('header', $data);
        $this->load->view('company/activity/freelancer/jobpost_review');
        $this->load->view('footer');
    }

    public function notifyJobPost($job_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->helper('category'); // Load category helper

            $job = $this->model_freelancer_jobs->getJob($job_id, array('status' => 1, 'remove' => 0));
            if ($job) {
                $this->load->library('notification'); //Load Notification Library

                //Filter Skills
                if ($job->skills) {
                    $cskills = ($job->skills) ? json_decode($job->skills) : array();
                    $filter_skills = $cskills;
                } else {
                    $filter_skills = array();
                }

                //Filter Experience
                $filter_experience = $job->experience;

                //Filter Job Type
                if ($job->job_type) {
                    $filter_jobtypes = array($job->job_type);
                } else {
                    $filter_jobtypes = '';
                }

                //Filter Location
                if ($job->location) {
                    $filter_location = $job->location;
                } else {
                    $filter_location = '';
                }

                $filter_qualifications = $this->model_freelancer_jobs->getJobQualifications($job_id);
                $job_qualifications = array();
                if ($job_qualifications) {
                    foreach ($filter_qualifications as $qualification) {
                        $job_qualification = $this->model_jobcategory->getCategory($qualification);
                        $filter_qualifications[] = isset($job_qualification->qualification) ? $job_qualification->qualification : '';
                    }
                }

                $filter_data = array(
                    'filter_skills' => $filter_skills,
                    'filter_location' => $filter_location,
                    //'filter_gender' => get_genderid_by_name($filter_genders),
                    'filter_experience' => isset($filter_experience->category_id) ? $filter_experience->category_id : '',
                    //'filter_qualification' => $filter_qualifications,
                    //'filter_jobtypes' => $filter_jobtypes,
                    //'candidate_filter' => ($filter_jobtypes || $filter_skills || $filter_qualifications) ? 'join' : 'none',
                    'sort' => 'f.freelancer_id',
                    'order' => 'DESC'
                );

                // Get Freelancer List
                $freelancers = $this->model_freelancer_jobs->getFreelancers($filter_data);
                if ($freelancers) {
                    foreach ($freelancers as $freelancer) {
                        $message = $this->company->company_name . ' posted a ' . $job->title . 'job';
                        $link = '';
                        $this->notification->add(
                            [
                                'sender_id' => $this->user_id,
                                'receiver_id' => $freelancer->user_id,
                                'message' => $message,
                                'link' => $link,
                                'publish' => 0,
                            ]
                        );
                    }

                    $json['message'] = 'Job post notified';
                } else {
                    $json['message'] = 'No freelanceers!';
                }

                $json['success'] = true;
            } else {
                $json['error'] = true;
                $json['message'] = 'No job available!';
            }
        } else {
            $json['error'] = true;
        }

        echo json_encode($json);
    }

    protected function addJobPost()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $json = array();
            $company_id = $this->company->company_id;
            $job_languages = array();
            $joblanguages = $this->input->post('job_language');
            if ($joblanguages) {
                foreach ($joblanguages as $joblanguage) {
                    $job_languages[] = strtolower($joblanguage);
                }
            }
            $job_skills = $this->input->post('job_skills');
            //$job_languages = $this->input->post('job_language');

            $job_id = $this->model_freelancer_jobs->addJob($company_id);
            if ($job_id) {
                $this->setFreelancerJobFilters($job_id, 'filter_skill', $job_skills); //Add filter skills
                $this->setFreelancerJobFilters($job_id, 'filter_language', $job_languages); //Add filter jobtypes
                //$this->setFreelancerJobFilters($job_id, 'filter_expeience', $job_experience);    //Add filter technology


                $json['success'] = true;
                $json['message'] = 'Job Post Added Successfully';
                $json['redirect'] = base_url() . 'company/jobs/freelancer/post/review/' . $job_id;
            } else {
                $json['error'] = true;
                $json['message'] = 'Job Post Not Added!';
                $json['redirect'] = '';
            }

            echo json_encode($json);
            exit;
        }

        $this->getJobPostForm();
    }

    protected function editJobPost($job_id)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $job_languages = array();
            $joblanguages = $this->input->post('job_language');
            if ($joblanguages) {
                foreach ($joblanguages as $joblanguage) {
                    $job_languages[] = strtolower($joblanguage);
                }
            }
            $job_skills = $this->input->post('job_skills');

            $job = $this->model_freelancer_jobs->getJob($job_id);
            if ($job) {
                $job_edit = $this->model_freelancer_jobs->editJob($job_id, array('company_id' => $this->company->company_id));
                if ($job_edit) {
                    $this->setFreelancerJobFilters($job_id, 'filter_skill', $job_skills); //Add filter skills
                    $this->setFreelancerJobFilters($job_id, 'filter_language', $job_languages); //Add filter jobtypes
                    //$this->setFreelancerJobFilters($job_id, 'filter_expeience', $job_experience);    //Add filter technology

                    $json['success'] = true;
                    $json['redirect'] = base_url() . 'company/jobs/freelancer/post/review/' . $job_id;
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

    protected function publishJobPost($job_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $job = $this->model_freelancer_jobs->getJob($job_id, array('status' => 0, 'remove' => 0));
            if ($job) {
                $result = $this->model_freelancer_jobs->setJobPublish($job_id, $publish = 1);
                if ($result) {
                    $msg = [
                        'title' => 'New Project alert!',
                        'body' => 'A company has posted a new Project you may interested - Apply now.',
                    ];
                    $user_info = $this->model_user->getUserDetails(array('user_type' => 3));
                    foreach ($user_info as $user_token) {
                        // $device_id[] = $user_token->device_details;
                        pushNotification($user_token->device_details, $msg);
                    }
                    $json['success'] = true;
                    $json['message'] = 'Jobpost Published';
                    $json['notify'] = base_url() . 'company/jobs/freelancer/notifyJobPost/' . $job_id;
                    $json['redirect'] = base_url() . 'company/dashboard';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Jobpost not Published!';
                }
            }
        }

        echo json_encode($json);
    }

    protected function draftJobPost($job_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $job = $this->model_freelancer_jobs->getJob($job_id, array('status' => 1, 'remove' => 0));
            if ($job) {
                $result = $this->model_freelancer_jobs->setJobPublish($job_id, $publish = 0);
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = 'Jobpost saved as Draft';
                    $json['redirect'] = base_url() . 'company/jobs/freelancer/listDraftedJobs';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Jobpost not saved as Draft!';
                }
            }
        }

        echo json_encode($json);
    }

    protected function deleteJobPost($job_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $job = $this->model_freelancer_jobs->getJob($job_id, array('status' => 1, 'remove' => 0));
            if ($job) {
                $remove = $this->model_freelancer_jobs->removeJob($job_id);
                if ($remove) {
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

    protected function deleteDraftJobPost($job_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $job = $this->model_freelancer_jobs->getJob($job_id, array('status' => 0, 'remove' => 0));
            if ($job) {
                $remove = $this->model_freelancer_jobs->deleteJob($job_id);
                if ($remove) {
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


    protected function validate()
    {
        //Check if company user is loggedin or not
        $this->user_id = $this->recruiter->isLogged();
        if (!$this->user_id) {
            redirect(base_url() . 'login');
        } else {
            $this->loadDetails();
        }

        $profile_status = $this->getProfileStatus('company');
        if (!$profile_status) {
            $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
            redirect(base_url() . 'company/profile?redirect=' . $this->page_name);
        }

        // Check commission agree
        if (!$this->company->isCommissionAgreed) {
            $this->document->addAlert('commission', 'info');
        }
    }

    protected function loadDetails()
    {
        $this->load->helper(array('user', 'api')); // Load user helper
        $this->load->helper('freelancer_category'); // Load freelancer category helper
        $this->load->model('company/Company_model', 'model_company');   //Load company model
        $this->load->model('company/Freelancer_jobs_model', 'model_freelancer_jobs');     // Load Model
        $this->load->model('Users_model', 'model_user'); //Load user model
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

    protected function setFreelancerJobFilters($job_id, $keyword, $datas)
    {

        if ($datas && is_array($datas)) {
            foreach ($datas as $data) {
                $filter = $this->model_freelancer_jobs->getFreelancerFilter($job_id, $keyword, $data);
                if ($filter) {
                    $this->model_freelancer_jobs->updateFreelancerFilter($filter->job_filter_id, $keyword, $data);
                } else {
                    $this->model_freelancer_jobs->addFreelancerFilter($job_id, $keyword, $data);
                }
            }
        }
    }


    //Recent Jobs
    public function getRecentJobs()
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->helper('category');
            $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
            $company_id = $this->company->company_id;

            //Filter Data
            $filter_data = array(
                'filter_date_from' => date('Y-m-d', strtotime('-' . $this->config->item('CJLTS'))),
                'filter_date_to' => date('Y-m-d'),
                'start' => 0,
                'limit' => 5,
                'sort' => 'job_id',
                'order' => 'DESC'
            );
            // Get Jobs List
            $json['jobs'] = array();
            $jobsList =  array();
            $jobs = $this->model_freelancer_jobs->getJobs($company_id, $filter_data);
            if ($jobs) {
                foreach ($jobs as $job) {
                    // Get Job List
                    $cfilter_data = array(
                        'job_id' => $job->job_id,
                        'applied' => 1,
                        'sort' => 'cj.freelancer_job_id',
                        'order' => 'DESC'
                    );
                    $total_applied_jobs = $this->model_freelancer_jobs->getTotalFreelancerJobs($company_id, $cfilter_data);
                    $job_duration = get_project_duration($job->job_duration);

                    if ($job->date_modified && $job->date_modified != '0000-00-00 00:00:00') {
                        $date_posted = $job->date_modified;
                    } else {
                        $date_posted = $job->date_added;
                    }

                    $jobsList[] = array(
                        'title' => $job->title,
                        'job_duration' => $job_duration,
                        'pay_type' => get_pay_type($job->pay_type),
                        'pay_amount' => format_currency($job->pay_amount),
                        'status' => $job->status ? $this->lang->line('active') : $this->lang->line('inactive'),
                        'view' => base_url() . 'company/jobs/freelancer/post/view/' . $job->job_id,
                        'total_applied_jobs' => $total_applied_jobs,
                        'date_posted' => date('M d, Y', strtotime($date_posted))
                    );
                }

                $json['jobs'] = array(
                    'view' => base_url() . 'company/jobs/freelancer/',
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
