<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobpayment extends CI_Controller
{
    private $user_id;
    private $adminArr = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); // Check if admin is loggedin
        $this->load->helper(array('user', 'category', 'freelancer_category'));
        $this->lang->load(array('admin/category'));    //Load Language
    }

    public function index()
    {
        $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');

        $data = array();
        //Get Page Number
        if ($this->uri->segment(5)) {
            $page = (int)$this->uri->segment(5);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['logged'] = $this->admin->isLogged(); // User Login
        $data['heading_title'] = 'Company Payments';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'admin/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Freelancer Projects',
            'href' => base_url() . 'admin/freelancer/job'
        );

        $data['breadcrumb'][] = array(
            'name' => 'Payment',
            'href' => base_url() . 'admin/freelancer/jobpayment'
        );

        $data['active_menu'] = 'mnu-freelancer-jobpayment';

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        //Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);
        $data['payments'] = array();
        //Filter Data
        $filter_data = array(
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            // 'mpay_status' => 1,
            'payer' => 'CMP',
            'sort' => 'milestone_payment_id',
            'order' => 'DESC'
        );
        $total_payments = $this->model_freelancer_job->getTotalMilestonePayments();
        $payments = $this->model_freelancer_job->getMilestonePayments($filter_data);
        if ($payments) {
            foreach ($payments as $payment) {
                if ($payment->service_fee_type == 'percentage') {
                    $service_fee_type = '%';
                } else {
                    $service_fee_type = '';
                }

                $freelancer_job = $this->model_freelancer_job->getRecentfreelancerJob($payment->freelancer_id, $payment->job_id);
                if ($freelancer_job) {
                    //Load Image
                    $company_image = $freelancer_job->company_logo ? $freelancer_job->company_logo : '';
                    if ($company_image && file_exists(APPPATH . 'assets/uploads/logo/' . $company_image)) {
                        $company_thumb = base_url() . 'application/assets/uploads/logo/' . $company_image;
                    } else {
                        $company_thumb = base_url() . 'application/assets/uploads/logo/default.png';
                    }


                    $data['payments'][] = array(
                        'job_title' => $freelancer_job->title,
                        'company_name' => $freelancer_job->company_name,
                        'company_logo' => $company_thumb,
                        'milestone' => array(
                            'name' => 'milestone' . $payment->freelancer_job_milestone_id,
                            'duration' => $payment->cjm_duration
                        ),
                        'payer' => $payment->payer,
                        'amount' => $payment->amount,
                        'service_amount' => $payment->service_amount,
                        'service_fees' => $payment->service_fee . $service_fee_type,
                        'total' => $payment->total,
                        'payment_id' => $payment->payment_id,
                        'instrument_type' => $payment->instrument_type,
                        'message' => $payment->message,
                        'date' => $payment->date_added
                    );
                }
            }
        }

        //Pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/company/jobpayment/index/';
        $config['total_rows'] = $total_payments;
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
        // print_r($data['payments']);
        $data['no_fw'] = true;
        $this->load->view('header', $data);
        $this->load->view('admin/company/job_payment');
        $this->load->view('footer');
    }

    protected function validate()
    {
        $this->user_id = $this->admin->isLogged();
        if (!$this->user_id) {
            redirect(base_url() . 'login');
        }
    }
}
