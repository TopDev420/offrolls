<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    private $error = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('users');
        $this->load->helper('user');
        $this->load->model('Users_model', 'model_users');
    }

    public function index(){
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->doLogin();
        } else {
            $this->loadLoginForm();
        }
    }

    protected function loadLoginForm() {
        $this->check_login(); // Check Login
        if($this->users->isLogged()){
            $data['logged'] = true;
        } else {
            $data['logged'] = false;
        }

        $data['heading_title'] = 'Login';  //Heading Title
        $data['breadcrumb'] = array();  //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'home'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Signin',
            'href' => base_url() . 'signin'
        );

        if($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

        //Load Custom Style
        $this->document->addStyle(base_url('application/assets/css/account.css'));

        //Load Custom Js
        $this->document->addScript(base_url('application/assets/js/include/account.js'), 'footer');

        $data['company_success_link'] = base_url() . 'company/login/success';
        $data['candidate_success_link'] = base_url() . 'candidate/login/success';
        $data['freelancer_success_link'] = base_url() . 'freelancer/login/success';

        $data['company_action'] = base_url() . 'company/login/add';
        $data['candidate_action'] = base_url() . 'candidate/login/add';
        $data['freelancer_action'] = base_url() . 'freelancer/login/add';

        $this->load->view('header', $data);
        $this->load->view('login');
        $this->load->view('footer');
    }

	protected function doLogin() {
		$json = array();

	    $email = $this->input->post('user_email');
	    $password = $this->input->post('user_password');

		$login = $this->model_users->login($email, $password);

		if($login) {
            if($login->status == 0){
                $current_date = date('Y-m-d H:i:s');
                $activation_datetime = ($user->activation_datetime && $user->activation_datetime != '0000-00-00 00:00:00') ? $user->activation_datetime : false;
                $activation_date = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime($user->activation_datetime)));
                $json['error'] = true;
                $json['message'] = 'Please activate your account!';

                // Check activation date
                if($current_date > $activation_date || !$activation_datetime) {
                    $this->model_users->setAccountActivation($login->user_id); // Adding token and datetime
                    $send_mail = $this->sendActivationMail($login->user_id);
                    if($send_mail){
                        $json['message'] .= 'Activation mail sent to your mail';
                    } else {
                        $json['message'] .= 'Activation mail not send to your mail';
                    }
                }
            } else {
                $this->model_users->setLoginCredentials($login->user_id, $login->email);
                $link = getModuleActionURL($login->user_type);
                $json['success'] = true;
                $json['redirect'] = $link;
    			$json['message'] = 'Logged in successfully!';
            }

		} else {
			$json['error'] = true;
			$json['message'] = 'Invalid Email/Password!';
		}
		echo json_encode($json);
	}

    //Single Sign On Function (social media login)
    public function sso($name=null){

        $this->load->helper('string');
        $json = array();
        $json['success'] = $json['error'] = $json['data'] = $json['data'] = false;

        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $sform = $this->input->get('sform');
            if($name && $sform){
                $json['data']['sso'] = $name;
                switch($name){
                    case 'google':
                        $googlelink = $this->loadGoogleLogin();
                        $json['data']['link'] = $googlelink;
                        break;
                    case 'linkedin':

                        break;
                    default:
                }

                $json['success'] = true;

            } else {
                $json['error'] = true;
                $json['message'] = 'Invalid Details';
            }
        } else {
            $json['error'] = true;
            $json['message'] = 'Invalid Request';
        }

        echo json_encode($json);
    }

    //Load google library
    protected function loadGoogleLibrary(){
        $this->config->load('sso');  // Load SSO Config data

        $sso_data['application_name'] = $this->config->item('application_name', 'google');
        $sso_data['client_id'] = $this->config->item('client_id', 'google');
        $sso_data['client_secret'] = $this->config->item('client_secret', 'google');
        $sso_data['redirect_uri'] = base_url() . 'login/google_auth';
        $sso_data['api_key'] = $this->config->item('api_key', 'google');
        $sso_data['scopes'] = array();
        $this->load->library('sso/google', $sso_data);
    }

    // Load google login
    protected function loadGoogleLogin(){
        $this->loadGoogleLibrary();
        $sso_google_link = $this->google->loginURL();
        return $sso_google_link;
    }

    // Google Authentication Function
    public function google_auth(){

        $data['authentication'] = false;$data['profile'] = array();$data['account_link'] = false;

        if($this->input->get('code')){
            $this->loadGoogleLibrary();
            if($this->google->getAuthenticate()){
                $gdata = $this->google->getUserInfo();

                // Preparing data
                $userData = array(
                    'provider' => 'google',
                    'sso' => SSO_GOOGLE,
                    'first_name' => $gdata['given_name'],
                    'last_name' => $gdata['family_name'],
                    'email' => $gdata['email'],
                    'image' => $gdata['picture'],
                );

                $login = $this->model_users->ssoLogin($userData);
                if($login) {
    				$this->model_users->setLoginCredentials($login->user_id, $login->email);
                    $link = getModuleActionURL($login->user_type);
    				$this->session->set_userdata('success', 'Logged in successfully!');
    				redirect($link);    //Redirect to user dashboard
                } else {
                    $this->session->set_userdata('error', 'This google account was not associated with us. Please register!');
                }
            } else {
                $this->session->set_userdata('error', 'Google authentication was failed!');
            }

        } else {
            $this->session->set_userdata('error', 'Invalid API Response Data');
        }

        redirect(base_url() . 'login');
    }

    protected function check_login($return=false){
        $logged = $this->users->isLogged();
        $user_id = $logged;
        if($logged){
            $user_type = $this->users->getUserType();
            $redirect_url = getModuleActionURL($user_type);
            if($return){
                $this->error['warning'] = 'This account is logged in !';
            } else {
        		redirect($redirect_url);
            }

            return !$this->error;
		}
    }

    //Send mail
    protected function sendActivationMail($user_id){

        $this->load->library('email');

        $user = $this->model_users->getUser($user_id);
        if($user){
            $recipient = $user->email;
            $token = $user->token;

            //Mail configuration

            $config['mailtype'] = 'html'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

            $this->email->from('admin@offrolls.in', 'Offrolls');
            $this->email->to($recipient);
            $this->email->subject('Email address confirmation');

            $setting = getSettings('website');
            $activation_link = base_url() . 'register/activation/' . $token;
            $html = $this->load->view('mail/user_activation', ['activation_link' => $activation_link, 'setting' => $setting], TRUE);
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

}
