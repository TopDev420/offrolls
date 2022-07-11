<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('recruiter');
        $this->load->model('company/Company_model', 'model_company');

        $this->lang->load('company/register');    // Load Register
    }

    public function index()
	{
		//If User Loggedin
		if($this->recruiter->isLogged()) {
			redirect(base_url() .'company/dashboard');
		}

		$data = array();

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

		$this->load->model('admin/Category_model', 'model_category');	// Load Category Model
		$filter_data = array(
			'status' => 1,
		);
		$data['company_categories'] = $this->model_category->getCategories(COMPANY_CATEGORY_TYPE, $filter_data);

		$data['success_link'] = base_url() . 'company/register/success';
		$data['action'] = base_url() . 'company/register/add';

		$this->load->view('header');
		$this->load->view('company/register', $data);
		$this->load->view('footer');
	}

	public function add() {
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$email = $this->input->post('user_email');
			$email_count = $this->model_company->getCompanyByEmail($email);
			if($email_count) {
				$json['error'] = 'Email already Exist';
			} else {
				$company_id = $this->model_company->addCompany();
				if($company_id) {
					$json['success'] = 'Company Registered Successfully';
                    // $send_mail = $this->sendActivationMail($company_id);
                    // if($send_mail){
                    //     $json['success'] = 'Company Registered Successfully';
                    // } else {
                    //     $json['error'] = 'Company Registered Successfully! Activation mail not send to your mail';
                    // }

					set_cookie('company_registration', 1, 18000);
				} else {
					$json['error'] = 'Error occured while registering your company';
				}
			}
		} else {
			$json['error'] = 'Invalid Request';
		}

		echo json_encode($json);

	}

    protected function sendActivationMail($company_id){

    	$this->load->library('email');

        $company = $this->model_company->getCompany($company_id);
        if($company){
            $recipient = $company->email;
            $token = $company->token;

            //Mail configuration

            $config['mailtype'] = 'html'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

    		$this->email->from('admin@mentric.co.in', '45+ Jobs');
    		$this->email->to($recipient);

    		$this->email->subject('Thankyou for registering with 45+ JOBS');
            $html = "<p>Welcome to 45+ Jobs,<p>";
            $html .= "<p>To activate your account click the below link:</p>";
            $html .= base_url() . 'company/register/activation/' . $token;
    		$this->email->message($html);

    		if($this->email->send()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
	}

	public function success() {
		$data = array();

		$register = get_cookie('company_registration');
		if($register == 1) {
			$data['success'] = 'We have sent a verication link to your registered mail';
			delete_cookie('company_registration');

			$this->load->view('header');
			$this->load->view('company/success', $data);
			$this->load->view('footer');
		} else {
			redirect(base_url() . 'company/register');
		}
	}

	public function activation() {

		$data = array();
		$token = $this->uri->segment(4);

		$company = $this->model_company->getCompanyByToken($token);
		$current_date = date('Y-m-d H:i:s');
		if($company) {
			$activation_date = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime($company->date_added)));
			//echo $current_date; echo '<br>'; echo $activation_date;
			if($company->status == 0 && $current_date <= $activation_date) {

				$verify = $this->model_company->setAccountVerification($company->company_id);
				if($verify) {
					$data['success'] = 'Your account is activated';
					$data['login'] = true;
				} else {
					$data['error'] = 'Your account not activated...Pls try again later';
				}
			} else {
				$data['error'] = 'Account Activation Exceeded Time Limit!';
			}
		} else {
			$data['error'] = 'Your account detail not available!';
		}

		$this->load->view('header');
		$this->load->view('company/activation', $data);
		$this->load->view('footer');
	}
}
