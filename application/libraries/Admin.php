<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin {

    private $CI;
    private $user_id;
    private $first_name;
	private $last_name;
	private $email;
	private $mobile;
	private $user_type;
	private $isVerified;

	public function __construct() {
        $this->CI = &get_instance();
	    $email = $this->CI->session->userdata('user_email');
	    $token = $this->CI->session->userdata('user_token');
	    if($email && $token) {
	      $this->login($email, $token);
	    }
	}


	public function login($email, $token) {
        $condition_data = array(
    		'email' => $email,
			'token' => $token,
			'user_type' => ADMIN_TYPE,
			'status' => 1
		);
		$this->CI->db->where($condition_data);
		$result = $this->CI->db->get('user');

		if($result->num_rows()) {
    		$row = $result->row();
			$this->user_id = $row->user_id;
		    $this->first_name = $row->first_name;
		    $this->last_name = $row->last_name;
		    $this->user_email = $row->email;
		    $this->user_mobile = $row->mobile;
		    $this->user_type = $row->user_type;

		    //Set Session Values
		    $this->CI->session->set_userdata('user_email', $row->email);
		    $this->CI->session->set_userdata('user_token', $row->token);

		} else {
			$this->user_id = 0;
		    $this->first_name = '';
		    $this->last_name = '';
		    $this->user_email = 0;
		    $this->user_mobile = 0;
		    $this->user_type = 0;

      		//Unset Session Values
      		$email = $this->CI->session->unset_userdata('user_email');
      		$token = $this->CI->session->unset_userdata('user_token');
		}

	}

    public function getUserType() {
    	return $this->user_type;
	}

	public function isLogged() {
		return $this->user_id;
	}

	public function getId() {
		return $this->user_id;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getMobile() {
		return $this->mobile;
	}

	public function getUserName() {
		return $this->first_name . ' ' . $this->last_name;
	}

	public function isVerified(){
		return 1;
	}

}
