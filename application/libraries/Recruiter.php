<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recruiter {

    private $CI;
	private $user_id;
	private $first_name;
	private $last_name;
	private $user_email;
	private $user_mobile;
	private $user_type;
	private $isVerified;

	public function __construct() {
	    $this->CI = &get_instance();
	    $user_id = $this->CI->session->userdata('user_id');
        $loggedin = $this->CI->session->userdata('loggedin');
        if($loggedin && $user_id) {
	      $this->login($user_id);
	    }
	}


	public function login($user_id) {
		$condition_data = array(
			'user_id' => $user_id,
			'user_type' => COMPANY_TYPE,
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
            $this->CI->session->set_userdata('user_id', $row->user_id);
    	    $this->CI->session->set_userdata('loggedin', 1);
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
            $this->CI->session->unset_userdata('user_id');
          	$this->CI->session->unset_userdata('loggedin');
      		$this->CI->session->unset_userdata('user_email');
      		$this->CI->session->unset_userdata('user_token');
		}

	}

	public function isLogged() {
		return $this->user_id;
	}

	public function getUserType() {
		return $this->user_type;
	}

	public function getId() {
		return $this->user_id;
	}

	public function getEmail() {
		return $this->user_email;
	}

	public function getMobile() {
		return $this->user_mobile;
	}

	public function getUserName() {
		return $this->first_name . ' ' . $this->last_name;
	}

	public function isVerified(){
		return $this->isVerified;
	}

}
