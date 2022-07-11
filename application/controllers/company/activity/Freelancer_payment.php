<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancer_payment extends CI_Controller {
    private $instamojoAPI;
    private $error = array();
    private $page_name = 'milestone_payment';
    private $user_id;
    private $company = array();
    private $menu_section='jobmilestone_payment';

    function __construct() {
        parent::__construct();

        $this->load->library('recruiter');
        $api_key = getSetting('payment', 'gateway_key');
        $api_secret = getSetting('payment', 'gateway_secret');
        $api_url = getSetting('payment', 'gateway_url');
        //Instamojo
        include APPPATH . 'third_party/instamojo/src/Instamojo.php';
        $this->instamojoAPI = new Instamojo\Instamojo($api_key, $api_secret, $api_url);
    }

    public function process($MPID) {
        $this->validate();
        $data['message'] = array();
        $data['payment'] = array();
        $data['logged'] = true;

        $this->session->set_userdata('milestone_id', $MPID); // Set Milestone Id
        $milestone_payment = $this->model_job->getMilestonePayment($MPID);  // Get Milestone Payment
        if($milestone_payment) {
            $milestone = $this->model_job->getJobMilestone($milestone_payment->milestone_id);   // Get Job Milestone

            $freelancer_job_id = isset($milestone->freelancer_job_id) ? $milestone->freelancer_job_id : 0;
            $freelancer_job = $this->model_job->getFreelancerJob($freelancer_job_id);   // Get Freelancer Job

            if($freelancer_job && $milestone){
                $data['payment'] = $milestone;

                try {
                    $response = $this->instamojoAPI->paymentRequestCreate(array(
                        "buyer_name" => $this->company->company_name,
                        "purpose" => "Milestone Fees",
                        "amount" => $milestone_payment->total,
                        "send_email" => true,
                        "email" => $this->company->email,
                        "phone" => $this->company->mobile,
                        "redirect_url" => base_url() . "company/activity/freelancer_payment/response"
                        ));

                    // print_r($response);
                    $payment_request_id = $response['id'];
                    $this->session->set_userdata('payment_request_id', $payment_request_id);

                    $pay_url = $response['longurl'];
                    header('Location:' . $pay_url);
                    exit();
                }
                catch (Exception $e) {
                   $data['message'] = $e->getMessage();
                }
            } else {
               $this->session->unset_userdata('milestone_id');
               $data['message'] = 'No Payment Detail';
            }
        } else {
            $data['message'] = 'No Payment Detail';
        }

        $this->load->view('header', $data);
        $this->load->view('company/payment/process');
        $this->load->view('footer');
    }

    public function response() {
        $this->validate();
        $data['message'] = array();
        $data['status'] = '';
        $data['logged'] = true;
        $payment_request_id = $this->session->userdata('payment_request_id');
        $payment_id = $this->input->get('payment_id');
        $milestone_id = $this->session->userdata('milestone_id');
	    $milestone_payment = $this->model_job->getMilestonePayment($milestone_id);

	    if($milestone_payment && $payment_request_id){
            $milestone = $this->model_job->getJobMilestone($milestone_payment->milestone_id);   // Get Job Milestone
            $freelancer_job_id = isset($milestone->freelancer_job_id) ? $milestone->freelancer_job_id : 0;
            $freelancer_job = $this->model_job->getFreelancerJob($freelancer_job_id);   // Get Freelancer Job
            if($freelancer_job && $milestone) {
    	        try {
                    $response = $this->instamojoAPI->paymentRequestPaymentStatus($payment_request_id, $payment_id);

                    //Pay Mode
                    $data['instrument_type'] = isset($response['payment']['instrument_type']) ? $response['payment']['instrument_type'] : '';
                    $data['billing_instrument'] = isset($response['payment']['billing_instrument']) ? $response['payment']['billing_instrument'] : '';

                    $status = isset($response['payment']['status']) ? $response['payment']['status'] : '';
                    if($status == 'Credit'){
                        $data['message'] = '<p class="text-success">Payment was successfull. <br> Your payment id is ' . $response['payment']['payment_id'] . '</p>';
                        $data['status'] = 'Credit';
                        $status_data = array(
                            'message'=>$data['message'],
                            'status' => 1,
                            'payment_id' => $payment_id,
                            'instrument_type' => $data['instrument_type'],
                            'billing_instrument' => $data['billing_instrument'],
                        );
                        $payment = $this->model_job->setMilestonePayment($milestone_id, $status_data);
                        if($payment) {
                            $this->model_job->approveJobMilestone($milestone_payment->milestone_id, 1);
                        }
                        $send = $this->sendMail($milestone_id);
                        if($send){
                            $this->model_job->setMilestonePaymentNotify($milestone_id, 1);
                        } else {
                            $this->model_job->setMilestonePaymentNotify($milestone_id, 0);
                        }
                    } else {
                        $data['message'] = '<p class="text-danger">Payment was not done</p>';
                        $data['status'] = 'Failed';
                        $status_data = array(
                            'message'=>$data['message'],
                            'status' => 2,
                            'payment_id' => $payment_id,
                            'instrument_type' => $data['instrument_type'],
                            'billing_instrument' => $data['billing_instrument']
                        );
                        $payment = $this->model_job->setMilestonePayment($milestone_id, $status_data);
                        if($payment) {
                            $this->model_job->approveJobMilestone($milestone_payment->milestone_id, 0);
                        }
                    }

                }
                catch (Exception $e) {
                    $data['message'] =  '<p class="text-info">' .$e->getMessage() . '<p>';
                }

                $data['redirect_link'] = base_url() . 'company/activity/freelancer/accepted_job/' . $freelancer_job->job_id;
	        } else {
                $data['message'] =  '<p class="text-info">Error occured while updating payment details... Pls contact your admin</p>';
                $data['redirect_link'] = base_url() . 'company/activity/freelancer/job';
            }
	    } else {
	        $data['message'] =  '<p class="text-info">Payment detail not available</p>';
	        $data['redirect_link'] = base_url() . 'company/dashboard';
	    }

        $this->session->unset_userdata(array('payment_request_id', 'milestone_id'));

        $this->load->view('header', $data);
		$this->load->view('company/payment/response');
		$this->load->view('footer');
	}

	protected function sendMail($milestone_id){
	    $result = false;
	    $milestone = $this->model_job->getJobMilestone($milestone_id);
        $freelancer_job_id = isset($milestone->freelancer_job_id) ? $milestone->freelancer_job_id : 0;
        $freelancer_job = $this->model_job->getFreelancerJob($freelancer_job_id);
	    if($milestone && $freelancer_job){

            $milestone = isset($milestone) ? $milestone : '';
	        $recipient = $this->company->email;
            $config['mailtype'] = 'html'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

        	$this->email->from('admin@mentricgroup.com', 'Mentric');
    		$this->email->to($recipient);

    		$this->email->subject('milestone Payment');
            $html = $this->load->view('company/mail/milestone_payment', array('company' => $this->company, 'job' => $freelancer_job, 'milestone' => $milestone), TRUE);

    		$this->email->message($html);

            if($this->email->send()) {
    			$result = true;
            } else {
            	$result = false;
            }

	    }

	    return $result;
	}

	protected function validate($type = '') {
        //Check if company user is loggedin or not
		$this->user_id = $this->recruiter->isLogged();
		if(!$this->user_id) {
            if($type == 'return'){
                $this->error['warning'] = "Please login to your account";
            } else {
                redirect(base_url() . 'login');
            }
		} else {
			$this->loadDetails();
		}

		$profile_status = $this->getProfileStatus('company');
		if(!$profile_status){
            if($type == 'return'){
                $this->error['warning'] = "Please complete your profile";
            } else {
                $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
    		    redirect(base_url() . 'company/profile?redirect='. $this->page_name);
            }
		}

        // Check commission agree
        if(!$this->company->isCommissionAgreed){
            if($type == 'return'){
                $this->error['info'] = "Please agree commission policy!";
            } else {
                $this->document->addAlert('commission', 'info');
            } 
        }

        if($type == 'return'){
            return !$this->error;
        }
	}

	protected function loadDetails(){
		$this->load->helper(array('user', 'freelancer_category_helper')); // Load helpers
        $this->load->model('company/Company_model', 'model_company');   //Load company model
        $this->load->model('company/Freelancer_jobs_model', 'model_job'); //Load company jobs model
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

	protected function loadErrors(){
		if(isset($this->error['warning'])){
			return $this->error['warning'];
		} elseif (isset($this->error['error'])) {
			return $this->error['error'];
		} else {
			return '';
		}
	}
}
