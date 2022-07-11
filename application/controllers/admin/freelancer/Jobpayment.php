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
        $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');    // Load freelancer job model
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');  // Load freelancer model

        $data = array();
        //Get Page Number
        if ($this->uri->segment(5)) {
            $page = (int)$this->uri->segment(5);
            //print_r($page);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['logged'] = $this->admin->isLogged(); // User Login
        $data['heading_title'] = 'Freelancer Payments';    //Heading Title
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
            'complete' => 1,
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
                $milestone_payment_id = $payment->freelancer_job_milestone_id;
                $milestone_id = $payment->milestone_id;
                $freelancer = $this->model_freelancer->getFreelancerById($payment->freelancer_id);
                $freelancer_job = $this->model_freelancer_job->getRecentfreelancerJob($payment->freelancer_id, $payment->job_id);
                if ($freelancer) {
                    //Load Freelancer Image
                    $freelancer_image = $freelancer->image ? $freelancer->image : '';
                    if ($freelancer_image && file_exists(APPPATH . 'assets/uploads/logo/' . $freelancer_image)) {
                        $freelancer->thumb = base_url() . 'application/assets/uploads/logo/' . $freelancer_image;
                    } else {
                        $freelancer->thumb = base_url() . 'application/assets/uploads/logo/default.png';
                    }
                } else {
                    $freelancer->thumb = base_url() . 'application/assets/uploads/logo/default.png';
                }
                if ($freelancer_job) {
                    //Load Image
                    $company_image = $freelancer_job->company_logo ? $freelancer_job->company_logo : '';
                    if ($company_image && file_exists(APPPATH . 'assets/uploads/logo/' . $company_image)) {
                        $company_thumb = base_url() . 'application/assets/uploads/logo/' . $company_image;
                    } else {
                        $company_thumb = base_url() . 'application/assets/uploads/logo/default.png';
                    }

                    $freelancer_total = $payment->amount - $payment->service_amount;
                    $data['payments'][] = array(
                        'job_title' => $freelancer_job->title,
                        'company_name' => $freelancer_job->company_name,
                        'company_logo' => $company_thumb,
                        'milestone' => array(
                            'name' => 'milestone' . $payment->freelancer_job_milestone_id,
                            'duration' => $payment->cjm_duration
                        ),
                        'pay_release' => $payment->cjm_isPayReleased,
                        'payer' => $payment->payer,
                        'freelancer' => $freelancer,
                        'amount' => $payment->amount,
                        'service_amount' => $payment->service_amount,
                        'service_fees' => $payment->service_fee . $service_fee_type,
                        'freelancer_total' => $freelancer_total,
                        'total' => $payment->total,
                        'payment_id' => $payment->payment_id,
                        'instrument_type' => $payment->instrument_type,
                        'message' => $payment->message,
                        'date' => $payment->date_added,
                        'freelancer_pay' => $this->calculatePriceBreakup($payment->amount),
                        'payment_details' =>  base_url() . 'admin/freelancer/Jobpayment/freelancerPaymentDetails/' . $payment->freelancer_id,
                        'freelancer_pay_link' =>  base_url() . 'admin/freelancer/Jobpayment/pay/' . $milestone_payment_id . '/' . $payment->freelancer_id,
                        'freelancer_pay_view' => base_url() . 'admin/freelancer/Jobpayment/freelancerPayDetails/' . $milestone_id
                    );
                }
            }
        }

        //Pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/freelancer/jobpayment/index';
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

        //print_r($data['payments']);
        $data['no_fw'] = true;
        $this->load->view('header', $data);
        $this->load->view('admin/freelancer/job_payment');
        $this->load->view('footer');
    }

    // public function pay($milestone_payment_id){
    //     $json = array();
    //     if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //         $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');
    //         $milestone = $this->model_freelancer_job->getMilestonePayment($milestone_payment_id);
    //         if ($milestone) {
    //             $data = [];
    //             $result = $this->model_freelancer_job->addMilestonePayment($data);
    //             if ($result) {
    //                 $status = $this->model_freelancer_job->payReleasedJobMilestone($milestone_payment_id, $status = 1);
    //                 $json['success'] = true;
    //                 $json['message'] = 'Payment added successful';
    //             } else {
    //                 $json['error'] = true;
    //                 $json['message'] = 'Payment not successful!';
    //             }
    //         }
    //     }

    //     echo json_encode($json);
    // }

    public function freelancerPaymentDetails($freelancer_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');
            $data['logged'] = true;
            $limit = 10;
            if ($this->uri->segment(5)) {
                $page = (int)$this->uri->segment(5);
            } else {
                $page = 1;
            }
            $data['admin'] = get_user_account($this->user_id);
            $data['payments'] = array();

            $filter_data = array(
                'start' => ($limit * ($page - 1)),
                'limit' => $limit,
                // 'mpay_status' => 1,
                'payer' => 'CMP',
                'complete' => 1,
                'sort' => 'milestone_payment_id',
                'order' => 'DESC'
            );
            // print_r($milestone_payment);
            $freelancer_payment = $this->model_freelancer_job->getFreelancerpayment($freelancer_id);
            if ($freelancer_payment) {
                $json['freelancer'] = array(
                    'account_number' => $freelancer_payment->account_number,
                    'ifsc_code' => $freelancer_payment->ifsc_code,
                    'bank_name' => $freelancer_payment->bank_name,
                    'branch_name' => $freelancer_payment->branch_name,
                );
                $json['success'] = true;
                $json['message'] = 'Price breakup calculated';
            } else {
                $json['error'] = true;
                $json['message'] = 'Error occured!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    public function pay($freelancer_job_milestone_id, $freelancer_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');
            $data['logged'] = true;
            $limit = 10;
            if ($this->uri->segment(5)) {
                $page = (int)$this->uri->segment(5);
            } else {
                $page = 1;
            }
            $filter_data = array(
                'start' => ($limit * ($page - 1)),
                'limit' => $limit,
                // 'mpay_status' => 1,
                'complete' => 1,
                'payer' => 'ADM',
                'sort' => 'milestone_payment_id',
                'order' => 'DESC'
            );
            $job_milestone = $this->model_freelancer_job->getJobMilestone($freelancer_job_milestone_id, $filter_data); // Get Job milestone details
            if ($job_milestone) {
                $payment = $this->model_freelancer_job->getMilestonePaymentByMP($freelancer_job_milestone_id, 'CMP');
                if ($payment) {
                    $price_breakup = $this->calculatePriceBreakup($payment->amount);  //calculate
                    $price_breakup['payer'] = 'ADM';
                    $price_breakup['milestone_id'] = $freelancer_job_milestone_id;
                    $price_breakup['freelancer_transaction_type'] = $this->input->post('payment_type');
                    $price_breakup['freelancer_transaction_id'] = $this->input->post('transaction_id');
                    $pay_id = $this->model_freelancer_job->addMilestonePayment($price_breakup); //set Jobmilestone
                }
                if ($pay_id) {
                    $status = $this->model_freelancer_job->payReleasedJobMilestone($freelancer_job_milestone_id, $status = 1);
                    $this->sendFreelancerPaymentReleaseMail($freelancer_id);
                    $json['success'] = true;
                    $json['message'] = 'Freelancer Transaction Saved';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Error occured!';
                }
            } else {
                $json['error'] = true;
                $json['message'] = 'Job Milestone Not Available!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    public function freelancerPayDetails($milestone_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');
            $data['logged'] = true;
            $limit = 10;
            if ($this->uri->segment(4)) {
                $page = (int)$this->uri->segment(4);
            } else {
                $page = 1;
            }
            $filter_data = array(
                'start' => ($limit * ($page - 1)),
                'limit' => $limit,
                // 'mpay_status' => 1,
                'complete' => 1,
                'payer' => 'ADM',
                'sort' => 'milestone_payment_id',
                'order' => 'DESC'
            );
            $job_milestone = $this->model_freelancer_job->getJobMilestone($milestone_id, $filter_data); // Get Job milestone details
            if ($job_milestone) {

                $payment = $this->model_freelancer_job->getFreelancerMilestonePaymentByMP($milestone_id, 'ADM');

                if ($payment) {
                    $json['payment'] = array(
                        'amount' => (int)$payment->amount,
                        'service_amount' => (int)$payment->service_amount,
                        'total' => (int)$payment->total,
                        'freelancer_transaction_type' => $payment->freelancer_transaction_type,
                        'freelancer_transaction_id' => $payment->freelancer_transaction_id,
                        'date_added' => $payment->date_added
                    );
                    $json['success'] = true;
                    $json['message'] = 'Price breakup calculated';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Error occured!';
                }
            } else {
                $json['error'] = true;
                $json['message'] = 'Job Milestone Not Available!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    protected function validate()
    {
        $this->user_id = $this->admin->isLogged();
        if (!$this->user_id) {
            redirect(base_url() . 'login');
        }
    }

    protected function calculatePriceBreakup($amount)
    {
        $service_amount = 0;
        $service_fee_type = '';
        // $amount = $milestone->cjm_amount;
        $service_fee = getSetting('payment', 'freelancer_service_fee');
        $service_fee_type = getSetting('payment', 'service_fee_type');
        if ($service_fee) {
            if ($service_fee_type == 'percentage') {
                $service_amount = ($amount * $service_fee) / 100;
            } else {
                $service_amount = ($amount + $service_fee);
            }
        }

        $total = $amount - $service_amount;
        return array(
            'amount' => $amount,
            'price' => format_currency($amount),
            'service_fee' => $service_fee,
            'service_fee_type' => $service_fee_type,
            'service_amount' => $service_amount,
            'service_price' => format_currency($service_amount),
            'total' => $total,
            'total_price' => format_currency($total),
        );
    }

    protected function sendFreelancerPaymentReleaseMail($freelancer_id)
    {
        $this->load->model('freelancer/freelancer_model', 'model_freelancer');
        $freelancer = $this->model_freelancer->getFreelancerById($freelancer_id);
        if ($freelancer) {
            $data_freelancer = array(
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name
            );

            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            $this->email->initialize($config);

            $this->email->from('admin@offrolls.in', 'Offrolls');
            $this->email->to($freelancer->email);
            $this->email->subject('Payment Release');

            $setting = getSettings('website');
            $html = $this->load->view('company/mail/freelancer_shortlist', ['setting' => $setting, 'freelancer' => $data_freelancer], TRUE);
            $this->email->message($html);

            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        }
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
