<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('Users');
        $this->load->model('Users_model', 'model_user');

    }

    public function index() {
        //If User Loggedin
        $logged = $this->users->isLogged();
        if($logged){
            // Redirect to user dasboard based on user type
    		$user_type = $this->users->getUserType();
			$link = getModuleActionURL($user_type);
            redirect($link);
		}

		$this->getView();
	}

	protected function getView() {
		$data['login_link'] = base_url(). 'login';

		//Load Alert Values
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
        
		$this->load->view('header');
		$this->load->view('forgot_password', $data);
		$this->load->view('footer');
	}


	//Send OTP to mail Function
	public function sendEmailOTP() {
		$json = array();
		$this->load->helper('string');
		$otp = random_string('alnum', 6);
		$email = $this->input->post('user_email');

		$user = $this->model_user->getUserByEmail($email, array('status' => 1, 'sso' => 0));
	
		if($user) {
			$result = $this->model_user->setEmailOTP($email, $otp);
			$sess_data = array(
				'email' => $email,
				'isEmailOTP' => 1,
			);


            //SMTP & mail configuration
            $recipient = $email;

            //mail configuration
            $config['protocol']    = 'mail';
            
            $config['charset']    = 'utf-8';

            $config['newline']    = "\r\n";

            $config['mailtype'] = 'html'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);
        	$this->email->from('admin@offrolls.in', 'Offrolls');
    		$this->email->to($recipient);
			$this->email->subject('Password Reset Request');

			$setting = getSettings('website');
            $html = $this->load->view('mail/password_reset', ['otp' => $otp, 'setting' => $setting], TRUE);
            $this->email->message($html);

    		// $this->email->subject('Offrolls password reset');
            // $html = "<p>Welcome to Offrolls,<p>";
            // $html .= '<p>Your OTP is: ' . $otp . '</p>';
            // $html .= "<br><p>Note: Do not share OTP with anyone</p>";
    		// $this->email->message($html);

	        if($this->email->send()) {
	        	set_cookie('email_otp', $otp, 18000);
				set_cookie('user_email', $email, 18000);
				$result = true;
	        } else {
	        	$result = false;
	        }

			if($result) {
				$json['success'] = 'Password reset OTP is sent to your mail';
                $this->session->set_userdata('user_pwd_reset', $sess_data);
			} else {
				$json['error'] = 'OTP Not Sent to your mail';
			}
		} else {
			$json['error'] = 'Your email is not associated with us';
		}

		echo json_encode($json);
	}


	//OTP Verify Function
	public function verifyEmailOTP() {
		$json = array();

		//Get Post Values
		$otp = $this->input->post('user_otp');
		$email = $this->input->post('user_email');

		//Get session Values
		$reset_data =  $this->session->userdata('user_pwd_reset');
		$isEmailOTP = isset($reset_data['isEmailOTP'])? 1 : 0;
		$reset_email = isset($reset_data['email'])?  $reset_data['email'] : 0;
		$user = array();

		$user = $this->model_user->getUserByEmail($reset_email);

		if($user) {
			if($isEmailOTP == 1 && $user->emailOTP == $otp) {
				$sess_data = array(
					'user_id' => $user->user_id,
					'isEmailOTP' => 1,
					'email' => $email,
				);
				$verify = $this->model_user->verifyEmailOTP($user->user_id);
				if($verify) {
					$sess_data['isOTPVerified'] = 1;
					$this->session->set_userdata('user_pwd_reset', $sess_data);
					$json['success'] = 'Verified';
				} else {
					$json['error'] = 'OTP Not Verified';
				}

			} else {
				$json['error'] = 'Please enter valid OTP';
			}
		} else {
			$json['error'] = 'Your email is not registered as user';
		}

		echo json_encode($json);
	}


	//Password reset Function
	public function reset() {
		$json = array();
		$reset_data =  $this->session->userdata('user_pwd_reset');
		$user_id = isset($reset_data['user_id'])?  $reset_data['user_id'] : 0;
		$otp_verified = isset($reset_data['isOTPVerified'])?  $reset_data['isOTPVerified'] : 0;
		$this->session->unset_userdata('user_pwd_reset');

		if($otp_verified && $user_id) {
			$password = $this->input->post('new_password');
			$reset = $this->model_user->resetPassword($user_id, $password);
			if($reset) {
				$json['success'] = 'Password Reset Successfully... You will be redirect to login';
			} else {
				$json['error'] = 'Password not reset!';
			}
		} else {
			$json['error'] = 'No details found about you';
		}

		echo json_encode($json);
	}
}
