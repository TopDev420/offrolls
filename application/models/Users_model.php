<?php class Users_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string');
	}

	public function getUser($user_id)
	{
		$condition = array();
		$this->db->where('user_id', $user_id);
		if (isset($data['status'])) {
			$condition['status'] = $data['status'];
		}
		if (isset($data['sso'])) {
			$condition['sso'] = $data['sso'];
		}
		$this->db->where($condition);
		$query = $this->db->get('user');
		if ($query->num_rows()) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getUserBySlug($slug)
	{
		$condition = array();
		$this->db->where('slug', $slug);
		if (isset($data['status'])) {
			$condition['status'] = $data['status'];
		}
		if (isset($data['sso'])) {
			$condition['sso'] = $data['sso'];
		}
		$this->db->where($condition);
		$query = $this->db->get('user');
		if ($query->num_rows()) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getUserDetails($data = [])
	{
		$condition = array();
		if (isset($data['status'])) {
			$condition['status'] = $data['status'];
		}
		if (isset($data['user_type'])) {
			$condition['user_type'] = $data['user_type'];
		}

		$this->db->select('');
		$this->db->from('user');
		$this->db->where($condition);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function getUserByEmail($email, $data = array())
	{
		$condition['email'] = $email;
		if (isset($data['status'])) {
			$condition['status'] = $data['status'];
		}
		if (isset($data['sso'])) {
			$condition['sso'] = $data['sso'];
		}

		$this->db->where($condition);
		$query = $this->db->get('user');

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getUserByToken($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('user');
		if ($query->num_rows()) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function addUser($data)
	{
		$password = $data['user_password'];
		$salt = random_string('alnum', 9);
		$password = $this->password_encrypt($password, $salt);
		$insert_data = array(
			'email' => $data['user_email'],
			'mobile' => $data['user_mobile'],
			'password' => $password,
			'salt' => $salt,
			'user_type' => $data['user_type'],
			'sso' => 0,
			'temp_details' => $data['user_temp_details'] ? json_encode($data['user_temp_details']) : '',
			'status' => 0,
			'date_added' => date('Y-m-d H:i:s')
		);

		if (isset($data['sso'])) {
			if ($data['sso']) {
				$insert_data['sso'] = $data['sso'];
			}
		}

		$this->db->insert('user', $insert_data);
		return $this->db->insert_id();
	}

	public function addSSOUser($data)
	{

		$insert_data = array(
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'image' => $data['user_image'],
			'email' => $data['user_email'],
			'mobile' => $data['user_mobile'],
			'password' => '',
			'salt' => '',
			'user_type' => $data['user_type'],
			'token' => '',
			'sso' => $data['sso'],
			'status' => $data['status'],
			'date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('user', $insert_data);
		return $this->db->insert_id();
	}

	public function setUserName($user_id, $data)
	{
		$user_data = array(
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $user_data);
		return $result;
	}

	public function setUserImage($user_id, $image)
	{
		$user_data = array(
			'image' => $image,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $user_data);
		return $result;
	}

	public function password_encrypt($password, $salt)
	{
		return sha1($salt . sha1($salt . md5($password)));
	}

	public function login($email, $password)
	{
		$condition = array(
			'email' => $email,
			'sso' => 0
		);

		$this->db->where($condition);
		$this->db->where('password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, MD5("' . $password . '")))))');
		$query = $this->db->get('user');

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function passwordChange($email, $password)
	{
		$condition = array(
			'email' => $email,
			'sso' => 0
		);

		$this->db->where($condition);
		$this->db->where('password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, MD5("' . $password . '")))))');
		$query = $this->db->get('user');

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function ssoLogin($userData)
	{
		$login_data = array(
			'email' => $userData['email'],
			'sso' => $userData['sso'],
			'status' => 1
		);

		$this->db->where($login_data);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function setEmailOTP($email, $otp)
	{
		$data = array(
			'emailOTP' => $otp,
			'date_added' => date('Y-m-d H:i:s')
		);
		$this->db->where('email', $email);
		$result = $this->db->update('user', $data);

		return $result;
	}

	public function verifyEmailOTP($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', array('emailOTP' => ''));
		return $result;
	}

	public function resetPassword($user_id, $password)
	{
		$salt = random_string('alnum', 9);
		$password = $this->password_encrypt($password, $salt);

		$reset_data = array(
			'password' => $password,
			'salt' => $salt,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $reset_data);
		return $result;
	}

	public function deviceDetails($user_id, $device_id)
	{

		$update_data = array(
			'device_details' => $device_id,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $update_data);
		return $result;
	}

	public function setAccountVerification($user_id)
	{
		$condition_data = array(
			'token' => '',
			'status' => 1,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $condition_data);
		return $result;
	}

	public function setLoginCredentials($user_id, $email)
	{
		$this->session->set_userdata('user_id', $user_id);
		$this->session->set_userdata('user_email', $email);
		$token = random_string('alnum', 32);
		$login_data = array(
			'token' => $token,
			'emailOTP' => '',
		);
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $login_data);
		$this->session->set_userdata('user_token', $token);
		$this->session->set_userdata('loggedin', 1);
		$this->session->unset_userdata('user_pwd_reset');
	}

	public function setToken($user_id, $token)
	{
		$login_data = array(
			'token' => $token
		);
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $login_data);
	}

	public function setUserMobile($user_id, $mobile)
	{
		$login_data = array(
			'mobile' => $mobile
		);
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $login_data);
	}

	//Social Profiles
	public function getSocialProfiles($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('social_profile');
		if ($query->num_rows() > 0) {
			$socials = array();
			$results = $query->result();
			if ($results) {
				foreach ($results as $result) {
					$sm_name = $result->sm_name;
					$socials[$sm_name] = $result->sm_link;
				}
			}

			return $socials;
		} else {
			return false;
		}
	}

	public function getSocialProfile($user_id, $sm_name)
	{
		$condition = array(
			'user_id' => $user_id,
			'sm_name' => $sm_name
		);
		$this->db->where($condition);
		$query = $this->db->get('social_profile');
		if ($query->num_rows() > 0) {
			$socials = array();
			return $query->row();
		} else {
			return false;
		}
	}

	public function addSocialProfile($user_id, $sm_name, $link)
	{
		$insert_data = array(
			'user_id' => $user_id,
			'sm_name' => $sm_name,
			'sm_link' => $link,
		);
		$this->db->insert('social_profile', $insert_data);
		return $this->db->insert_id();
	}

	public function updateSocialProfile($profile_id, $link)
	{
		$update_data = array(
			'sm_link' => $link
		);

		$this->db->where('social_profile_id', $profile_id);
		$query = $this->db->update('social_profile', $update_data);
		return $this->db->insert_id();
	}

	public function deleteSocialProfile($profile_id)
	{
		$this->db->where('social_profile_id', $profile_id);
		$this->db->delete('social_profile');
	}


	//User Activity
	public function getActivities($user_id, $data = array())
	{
		$condition = array(
			'user_id' => $user_id
		);
		if (isset($data['notify'])) {
			$condition['is_notify'] = $data['notify'];
		}
		$this->db->where($condition);
		$query = $this->db->get('user_activity');
		if ($query->num_rows() > 0) {
			$socials = array();
			return $query->result();
		} else {
			return false;
		}
	}

	public function getActivity($user_id)
	{
		$condition = array(
			'user_id' => $user_id
		);
		$this->db->where($condition);
		$query = $this->db->get('user_activity');
		if ($query->num_rows() > 0) {
			$socials = array();
			return $query->row();
		} else {
			return false;
		}
	}

	public function addActivity($user_id, $data)
	{
		$insert_data = array(
			'user_id' => $user_id,
			'keyword' => $data['keyword'],
			'message' => $data['message'],
			'link' => $data['link'],
			'is_notify' => $data['notify']
		);
		$this->db->insert('user_activity', $insert_data);
		return $this->db->insert_id();
	}

	public function setActivityNotify($user_activity_id, $notify)
	{
		$update_data = array(
			'is_notify' => $notify,
			'date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('user_activity_id', $user_activity_id);
		$query = $this->db->update('user_activity', $update_data);
		return $this->db->insert_id();
	}

	public function deleteActivity($user_activity_id)
	{
		$this->db->where('user_activity_id', $user_activity_id);
		$this->db->delete('user_activity');
	}

	// Generate Token
	public function getUniqueToken()
	{
		$token = random_string('alnum', 32);
		$exist = $this->getUserByToken($token);
		if ($exist) {
			$this->getUniqueToken();
		} else {
			return $token;
		}
	}

	// Set activation
	public function setAccountActivation($user_id)
	{
		$condition_data = array(
			'token' => $this->getUniqueToken(),
			'activation_datetime' => date('Y-m-d H:i:s'),
			'status' => 0,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $condition_data);
		return $result;
	}
}
