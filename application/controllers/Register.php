<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    private $error = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('users');
        $this->load->helper('user');
        $this->load->model('Users_model', 'model_users');
    }

    public function index()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->doRegister();
        } else {

            $this->loadRegisterForm();
        }
    }

    protected function loadRegisterForm()
    {

        $this->check_login(); // Check Login
        if ($this->users->isLogged()) {
            $data['logged'] = true;
        } else {
            $data['logged'] = false;
        }

        $signin_email = $this->input->get('signin_email');
        $signin_email = trim($signin_email, '#');
        if (($this->input->get('sso_register') == true) && filter_var($signin_email, FILTER_VALIDATE_EMAIL)) {
            $data['sso_register'] = true;
            $data['sso_provider'] = $this->input->get('sso');
            $data['signin_email'] = $this->input->get('signin_email');
        } else {
            $data['sso_register'] = false;
            $data['sso_provider'] = '';
            $data['signin_email'] = '';
        }

        //Delete SSO cookie
        delete_cookie('sso_form');
        delete_cookie('sso_action');
        delete_cookie('sso_name');

        $data['heading_title'] = 'Register';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'home'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Register',
            'href' => base_url() . 'register'
        );

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        //Load Custom Style
        $this->document->addStyle(base_url('application/assets/css/account.css'));

        //Load Custom Js
        $this->document->addScript(base_url('application/assets/js/include/account.js'), 'footer');

        $data['sso_google_signup'] = base_url() . 'signup/sso/google?rform=user';
        $data['sso_linkedin_signup'] = base_url() . 'signup/sso/linkedin?rform=user';

        $data['success_link'] = base_url() . 'register/success';

        $data['user_action'] = base_url() . 'register';

        $this->load->view('header');
        $this->load->view('register', $data);
        $this->load->view('footer');
    }

    protected function doRegister()
    {
        $json = array();

        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $user_email = $this->input->post('user_email');
        $user_mobile = $this->input->post('user_mobile');
        $user_password = $this->input->post('user_password');

        // if($this->input->post('user_dob') && $this->input->post('user_experience')){
        //     $user_temp_details = array(
        //         'dob' => dbdate_format($this->input->post('user_dob')),
        //         'experience' => $this->input->post('user_experience')
        //     );
        // } else {
        //     $user_temp_details = array();
        // }

        $user_type = $this->input->post('user_type');
        $user_type = getUserType($user_type);

        $register_data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_email' => $user_email,
            'user_mobile' => $user_mobile,
            'user_password' => $user_password,
            'user_type' => $user_type,
            'user_status' => 1,
            'user_temp_details' => array()
        );
        if ($this->validateForm()) {
            $user = $this->model_users->getUserByEmail($user_email);
            if ($user) {
                $json['error'] = true;
                if ($user->status == 0) {
                    $json['message'] = 'This email already registered with us. Please activate your account...!';

                    // Checking activation datetime
                    $current_date = date('Y-m-d H:i:s');
                    $activation_datetime = ($user->activation_datetime && $user->activation_datetime != '0000-00-00 00:00:00') ? $user->activation_datetime : false;
                    $activation_date = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime($user->activation_datetime)));
                    if ($current_date > $activation_date || !$activation_datetime) {
                        $this->model_users->setAccountActivation($user->user_id); // Adding token and datetime
                        $send_mail = $this->sendActivationMail($user->user_id);
                        if ($send_mail) {
                            $json['message'] .= 'Activation mail sent to your mail';
                        } else {
                            $json['message'] .= 'Activation mail not send to your mail';
                        }
                    }
                } else {
                    $json['message'] = 'This email already registered with us. Please login...!';
                }
            } else {
                $user_id = $this->model_users->addUser($register_data);
                if ($user_id) {
                    $this->model_users->setAccountActivation($user_id); // Adding token and datetime
                    $send_mail = $this->sendActivationMail($user_id);
                    if ($send_mail) {
                        $message = 'Activation mail sent to your mail';
                    } else {
                        $message = 'Activation mail not send to your mail';
                    }
                    set_cookie('user_registration', 1, 18000);
                    $json['success'] = true;
                    $json['message'] = 'Account created Successfully <br> ' . $message . '<br> redirecting...';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Error occured while creating your account';
                }
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    protected function validateForm()
    {
        $user_email = $this->input->post('user_email');
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $this->error['warning'] = 'Please enter valid email';
        }

        $user_type = $this->input->post('user_type');
        // $user_dob = $this->input->post('user_dob');

        if (!$user_type) {
            $this->error['warning'] = 'Please specify user type';
        }

        // if($user_type != 'company'){
        //     $user_experience = $this->input->post('user_experience');
        //     if($user_experience <= $this->config->item('minExperience', 'restrictions') || $user_experience >= $this->config->item('maxExperience', 'restrictions')){
        //         $this->error['warning'] = 'Please enter experience in range of 10 -100 years';
        //     }


        //     if($user_dob){
        //         $age = get_age($user_dob);   // Get Age from user dob
        //         if($age < $this->config->item('minAge', 'restrictions')){
        //             $this->error['warning'] = 'Age must be above or equal to 35';
        //         }
        //     } else {
        //         $this->error['warning'] = 'Please specify your date of birth';
        //     }
        // }

        return !$this->error;
    }


    public function check_email()
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $email = $this->input->post('sign_in_email');
            $user = $this->model_users->getUserByEmail($email);
            if ($user) {
                $json = false;
            } else {
                $json = true;
            }
        }

        echo json_encode($json);
    }


    //Single Sign On Function (social media register)
    public function sso($name = null)
    {

        $this->load->helper('string');
        $json = array();
        $json['success'] = $json['error'] = $json['data'] = $json['data'] = false;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $sform = $this->input->get('sform');
            if ($name && $sform) {
                $json['data']['sso'] = $name;
                switch ($name) {
                    case 'google':
                        $googlelink = $this->loadGoogleLogin();
                        $json['data']['link'] = $googlelink;
                        break;
                    case 'linkedin':
                        $linkedinLink = $this->loadLinkedinLogin();
                        $json['data']['link'] = $linkedinLink;
                        break;
                    default:
                        $json['data']['link'] = '';
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
    protected function loadGoogleLibrary()
    {
        $this->config->load('sso');  // Load SSO Config data

        $sso_data['application_name'] = $this->config->item('application_name', 'google');
        $sso_data['client_id'] = $this->config->item('client_id', 'google');
        $sso_data['client_secret'] = $this->config->item('client_secret', 'google');
        $sso_data['redirect_uri'] = base_url() . 'register/google_auth';
        $sso_data['api_key'] = $this->config->item('api_key', 'google');
        $sso_data['scopes'] = array();

        $this->load->library('sso/google', $sso_data);
    }

    // Load google login
    protected function loadGoogleLogin()
    {
        $this->loadGoogleLibrary();
        $sso_google_link = $this->google->loginURL();
        return $sso_google_link;
    }

    // Google Authentication Function
    public function google_auth()
    {

        $data['authentication'] = false;
        $data['profile'] = array();
        $data['account_link'] = false;

        if ($this->input->get('code')) {
            $this->loadGoogleLibrary();
            if ($this->google->getAuthenticate()) {
                $gdata = $this->google->getUserInfo();

                // Preparing data
                $userData = array(
                    'provider' => 'google',
                    'first_name' => $gdata['given_name'],
                    'last_name' => $gdata['family_name'],
                    'email' => $gdata['email'],
                    'image' => $gdata['picture'],
                    'login' => 1
                );

                $user = $this->model_users->getUserByEmail($userData['email']);
                if ($user) {
                    $this->session->set_userdata('error', 'This email has already have an account. Pls login');
                } else {
                    foreach ($userData as $ukey => $uval) {
                        set_cookie('sso_' . $ukey, $uval, 18000);
                    }

                    redirect(base_url() . 'register?sso=' . $userData['provider'] . '&sso_register=true&signin_email=' . $userData['email']);
                }
            } else {
                $this->session->set_userdata('error', 'User Authentication Failed');
            }
        } else {
            $this->session->set_userdata('error', 'Invalid API Response Data');
        }

        redirect(base_url() . 'register');
    }

    public function sso_account()
    {
        $json = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $sso_email = get_cookie('sso_email');
            $sso_login = get_cookie('sso_login');

            if ($sso_email && $sso_login) {
                $user_email = $this->input->post('user_email');
                $user_mobile = $this->input->post('user_mobile');
                $image_url = get_cookie('sso_image');  //Get User sso image form cookie

                if ($user_email == $sso_email) {

                    $user_type_name = $this->input->post('user_type');
                    $user_type = getUserType($user_type_name);
                    $link = getModuleActionURL($user_type); // Get Url based on user type

                    $register_data = array(
                        'first_name' => get_cookie('sso_first_name'),
                        'last_name' => get_cookie('sso_last_name'),
                        'user_email' => $user_email,
                        'user_mobile' => $user_mobile,
                        'user_image' => '',
                        'sso' => SSO_GOOGLE,
                        'user_type' => $user_type,
                        'status' => 1
                    );
                    $user = $this->model_users->getUserByEmail($user_email);
                    if ($user) {
                        $json['error'] = true;
                        $json['message'] = 'This google account is associated with us. Please Login';
                    } else {
                        $user_id = $this->model_users->addSSOUser($register_data);
                        if ($user_id) {
                            // Save SSO account image and set into user
                            $image_name = 'profile' . date('YmdHis') . $user_id . '.jpg';
                            $image_path = APPPATH . 'assets/uploads/logo/';
                            saveImageFromURL($image_url,  $image_path . $image_name);
                            if (is_readable($image_path)) {
                                $this->model_users->setUserImage($user_id, $image_name);
                            }

                            $this->create_account($user_id, $user_type); // Create account based on user id, type
                            $this->model_users->setLoginCredentials($user_id, $user_email);
                            // Delete SSO Cookies
                            delete_cookie('sso_first_name');
                            delete_cookie('sso_last_name');
                            delete_cookie('sso_email');
                            delete_cookie('sso_image');
                            delete_cookie('sso_provider');
                            delete_cookie('sso_login');

                            $json['success'] = true;
                            $json['redirect'] = $link;
                            $json['message'] = 'Account created Successfully <br> redirecting...';
                        } else {
                            $json['error'] = true;
                            $json['message'] = 'Error occured while creating your account';
                        }
                    }
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Please Register again/later';
                }
            } else {
                $json['error'] = true;
                $json['message'] = 'Not a valid email. Please register again/later';
            }
        }
        echo json_encode($json);
    }

    protected function sendActivationMail($user_id)
    {

        $this->load->library('email');

        $user = $this->model_users->getUser($user_id);
        if ($user) {
            $recipient = $user->email;
            $token = $user->token;

            //mail configuration
            $config['protocol']    = 'mail';

            $config['charset']    = 'utf-8';

            $config['newline']    = "\r\n";

            $config['mailtype'] = 'html'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);
            $this->email->from('admin@offrolls.in', 'Offrolls');
            $this->email->to($recipient);
            $this->email->subject('Email address confirmation');

            // $this->email->subject('Thankyou for registering with Offrolls');
            // $html = "<p>Welcome to Offrolls,<p>";
            // $html .= "<p>To activate your account click the below link:</p>";
            $setting = getSettings('website');
            $activation_link = base_url() . 'register/activation/' . $token;
            $html = $this->load->view('mail/user_activation', ['activation_link' => $activation_link, 'setting' => $setting], TRUE);
            $this->email->message($html);

            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function success()
    {
        $data = array();

        $register = get_cookie('user_registration');
        if ($register == 1) {
            $data['success'] = 'We have sent a verification link to your registered mail id';
            delete_cookie('user_registration');

            $this->load->view('header');
            $this->load->view('success', $data);
            $this->load->view('footer');
        } else {
            redirect(base_url() . 'register');
        }
    }

    public function activation($token = '')
    {

        $data = array();

        $user = $this->model_users->getUserByToken($token);
        $current_date = date('Y-m-d H:i:s');
        if ($user) {

            $activation_date = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime($user->activation_datetime)));
            //echo $current_date; echo '<br>'; echo $activation_date;
            if ($user->status == 0 && $current_date <= $activation_date) {

                $verify = $this->model_users->setAccountVerification($user->user_id);
                if ($verify) {
                    $creation = $this->create_account($user->user_id, $user->user_type);
                    if ($creation) {
                        $this->session->set_userdata('success', 'Your account is activated');
                    } else {
                        $this->session->set_userdata('success', 'Your account is activated');
                        $this->session->set_userdata('error', 'Required details are not setup correctly..!');
                    }

                    redirect(base_url() . 'login');
                } else {
                    $this->session->set_userdata('error', 'Your account not activated...Pls try again later');
                }
            } else {
                $this->session->set_userdata('error', 'Account Activation Exceeded Time Limit!');
            }
        } else {
            $this->session->set_userdata('error', 'Your account detail not available!');
        }

        redirect(base_url() . 'login');
    }

    protected function create_account($user_id, $user_type)
    {
        $cexperience = array();
        $cdob = '';
        $user_dob = '';
        $user_experience = '';
        $user = $this->model_users->getUser($user_id);
        if ($user->temp_details) {
            $user_temp_details = $user->temp_details ? json_decode($user->temp_details) : '';
            $user_dob = $user_temp_details->dob;
            $user_experience = $user_temp_details->experience;
        }

        if ($user_dob) {
            $cdob = dbdate_format($user_dob);
        }

        $account_creation = 0;
        switch ($user_type) {
            case CANDIDATE_TYPE:
                $this->load->model('candidate/Candidate_model', 'model_candidate');
                $user_data = array(
                    'dob' => $cdob,
                    'experience' => $user_experience,
                );
                $account_creation = $this->model_candidate->addCandidateByUser($user_id, $user_data);
                break;
            case FREELANCER_TYPE:
                $this->load->model('freelancer/Freelancer_model', 'model_freelancer');
                $user_data = array(
                    'dob' => $cdob,
                    'experience' => $user_experience,
                );
                $account_creation = $this->model_freelancer->addFreelancerByUser($user_id, $user_data);
                break;
            case COMPANY_TYPE:
                $this->load->model('company/Company_model', 'model_company');
                $account_creation = $this->model_company->addCompanyByUser($user_id);
                break;
            default:
        }

        return $account_creation;
    }

    protected function check_login($return = false)
    {
        $logged = $this->users->isLogged();
        $user_id = $logged;
        if ($logged) {
            $user_type = $this->users->getUserType();
            $redirect_url = getModuleActionURL($user_type);
            if ($return) {
                $this->error['warning'] = 'This account is logged in !';
            } else {
                redirect($redirect_url);
            }

            return !$this->error;
        }
    }








    /*** SSO Linkedin ***/
    //Load linkedin library
    protected function loadLinkedinLibrary()
    {
        $this->load->library('sso/linkedin');
        $this->config->load('sso');  // Load SSO Config data

        $sso_data['client_id'] = $this->config->item('client_id', 'linkedin');
        $sso_data['client_secret'] = $this->config->item('client_secret', 'linkedin');
        $sso_data['redirect'] = base_url() . 'register/linkedin_auth';

        return $sso_data;
    }

    // Load linkedin login
    protected function loadLinkedinLogin()
    {
        $ssoData = $this->loadLinkedinLibrary();

        // $this->linkedin->getRequestToken();
        // $requestToken = serialize($this->linkedin->request_token);
        // $this->session->set_userdata(array(
        //     'requestToken' => $requestToken
        // ));

        $sso_linkedin_link = $this->linkedin->generateAuthorizeUrl($ssoData);
        return $sso_linkedin_link;
    }

    public function linkedin_auth()
    {
        if ($this->input->get('code')) {
            $ssoData = $this->loadLinkedinLibrary(); // Load linkedin library

            $linkedin_sess_data = $this->session->userdata('linkedin');
            if ($this->input->get('state') &&  isset($linkedin_sess_data['state']) && $this->input->get('state') === $linkedin_sess_data['state']) {
                // $accessToken = $this->linkedin->getAccessToken($ssoData);
                // Get Profile
                $profile = $this->linkedin->getProfile($ssoData);

                // Get Email Address
                $emailInfo = $this->linkedin->getEmailAddress($ssoData);
                pp($profile);
                pp($emailInfo);
            } else {
                $this->session->set_userdata('error', 'Invalid State');
            }
        } else {
            $this->session->set_userdata('error', 'Invalid API Response Data');
        }

        redirect(base_url() . 'register');
    }

    public function linkedauth()
    {        //optional
        $get    =    $this->input->get();
        print_r($get);
    }




    /*** Load Error Function ***/
    protected function loadErrors()
    {
        if (isset($this->error['warning'])) {
            return $this->error['warning'];
        } elseif (isset($this->error['error'])) {
            return $this->error['error'];
        } else {
            return '';
        }
    }

    function pp($anything)
    {
        echo '<pre>' . print_r($anything, true) . '</pre>';
    }
}
