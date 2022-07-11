<?php class freelancer_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string');
	}

	public function getFreelancers($data)
	{
		$this->db->select('c.*, u.first_name, u.last_name, u.image, u.email, u.mobile, u.user_type, u.status');
		$this->db->from('user AS u');
		$this->db->join('freelancer AS c', 'c.user_id=u.user_id');
		//Filter Condition
		$condition = array();
		if (isset($data['status'])) {
			$condition['u.status'] = $data['status'];
		}
		if ($condition) {
			$this->db->where($condition);
		}


		//Limit
		if (isset($data['limit']) && isset($data['start'])) {

			if ($data['limit']) {
				$limit = $data['limit'];
			} else {
				$limit = 20;
			}

			if ($data['start']) {
				$start = $data['start'];
			} else {
				$start = 0;
			}

			$this->db->limit($limit, $start);
		}

		//Sort
		if (isset($data['sort'])) {
			$sort = $data['sort'];
		} else {
			$sort = 'u.user_id';
		}

		if (isset($data['order'])) {
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);

		return $query = $this->db->get()->result();
	}

	public function getTotalFreelancers($data = array())
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('user AS u');
		$this->db->join('freelancer AS c', 'c.user_id=u.user_id');
		//Filter Condition
		$condition = array();
		if (isset($data['status'])) {
			$condition['u.status'] = $data['status'];
		}
		if ($condition) {
			$this->db->where($condition);
		}

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->total;
		} else {
			return false;
		}
	}

	public function getFreelancer($user_id)
	{
		$this->db->select('c.*, u.first_name, u.last_name, u.image, u.email, u.mobile, u.user_type, u.status');
		$this->db->from('user AS u');
		$this->db->join('freelancer AS c', 'c.user_id=u.user_id');
		$this->db->where('u.user_id', $user_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getFreelancerById($freelancer_id)
	{
		$this->db->select('c.*, u.first_name, u.last_name, u.image, u.email, u.mobile, u.user_type, u.status');
		$this->db->from('user AS u');
		$this->db->join('freelancer AS c', 'c.user_id=u.user_id');
		$this->db->where('c.freelancer_id', $freelancer_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getFreelancerResume($freelancer_id)
	{
		$this->db->where('freelancer_id', $freelancer_id);
		$query = $this->db->get('freelancer');

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function addFreelancerResume($freelancer_id)
	{
		$insert_data = array(
			'freelancer_id' => $freelancer_id,
			'is_published' => 0
		);
		$result = $this->db->insert('freelancer', $insert_data);
		return $result;
	}

	public function addFreelancerByUser($user_id, $data)
	{
		$freelancer_data = array(
			'user_id' => $user_id,
			'dob' => $data['dob'],
			'experience' => $data['experience'],
			'fl_date_added' => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert('freelancer', $freelancer_data);
		return $this->db->insert_id();
	}

	public function editFreelancer($user_id)
	{

		$title = $this->input->post('first_name') . ' ' . ' ' . $this->input->post('last_name') . ' ' . $user_id; //Joining first name last name and id
		$user_data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'slug' => url_title($title, 'dash', TRUE), // converting title to SEO url
		);
		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $user_data);

		$data = array(
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city_label'),
			'state' => $this->input->post('state_label'),
			'country' => $this->input->post('country'),
			'pin_code' => $this->input->post('pin_code'),
			'fl_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'user_id' => $user_id
		);
		$this->db->where($condition_data);
		$result1 = $this->db->update('freelancer', $data);
		return ($result && $result1) ? true : false;
	}


	public function setFreelancerProfileComplete($freelancer_id, $status)
	{
		$condition_data = array(
			'user_id' => $freelancer_id,
			'status' => 1
		);
		$this->db->where($condition_data);
		$result = $this->db->update('user', array('is_profileCompleted' => $status));
		return $result;
	}

	public function editProfileSummary($freelancer_id)
	{
		$data = array(
			'about' => $this->input->post('ps_description'),
			'fl_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'freelancer_id' => $freelancer_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('freelancer', $data);
		return $result;
	}

	public function setFreelancerProfilePublish($freelancer_id, $publish = 0)
	{
		$this->db->where('freelancer_id', $freelancer_id);
		$result = $this->db->update('freelancer', array('is_published' => $publish));
		return $result;
	}

	public function editCareer($freelancer_id)
	{
		$salary_range = $this->input->post('job_salary_range');
		$data = array(
			'industry' => $this->input->post('industry_type'),
			'job_type' => $this->input->post('job_type'),
			'job_location' => $this->input->post('job_location'),
			'salary_range_from' => isset($salary_range['from']) ? $salary_range['from'] : 0,
			'salary_range_to' => isset($salary_range['to']) ? $salary_range['to'] : 0,
			'salary_period' => isset($salary_range['period']) ? $salary_range['period'] : 0,
			'fl_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'freelancer_id' => $freelancer_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('freelancer', $data);
		return $result;
	}

	public function editDesiredJob($freelancer_id)
	{
		$languages = $this->input->post('job_languages');
		$data = array(
			// 'experience' => $this->input->post('job_experience'),
			'languages' => $languages ? json_encode($languages) : '',
			'fl_date_modified' => date('Y-m-d H:i:s')
		);
		$condition_data = array(
			'freelancer_id' => $freelancer_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('freelancer', $data);
		return $result;
	}

	public function editPersonal($freelancer_id)
	{
		$data = array(
			'father_name' => $this->input->post('personal_father_name'),
			'mother_name' => $this->input->post('personal_mother_name'),
			'dob' => dbdate_format($this->input->post('personal_dob')),
			'nationality' => $this->input->post('personal_nationality'),
			'gender' => $this->input->post('personal_gender'),
			// 			'age' => $this->input->post('personal_age'),
			'fl_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'freelancer_id' => $freelancer_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('freelancer', $data);
		return $result;
	}

	// public function editSkills($freelancer_id){
	// 	$skills = $this->input->post('skill_category');

	// 	$data = array(
	// 		'skills' => $skills ? json_encode($skills) : '',
	// 		'fl_date_modified' => date('Y-m-d H:i:s')
	// 	);

	// 	$condition_data = array(
	// 		'freelancer_id' => $freelancer_id
	// 	);

	// 	$this->db->where($condition_data);
	// 	$result = $this->db->update('freelancer', $data);
	// 	return $result;
	// }

	public function setAccountVerification($freelancer_id)
	{
		$condition_data = array(
			'token' => '',
			'status' => 1,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('freelancer_id', $freelancer_id);
		$result = $this->db->update('user', $condition_data);
		return $result;
	}

	public function saveImage($user_id, $file_name)
	{
		$data = array(
			'image' => $file_name,
			'date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $data);
		return $result;
	}

	public function saveResume($freelancer_id, $file_name)
	{
		$data = array(
			'resume' => $file_name,
			'fl_date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('freelancer_id', $freelancer_id);
		$result = $this->db->update('freelancer', $data);
		return $result;
	}


	public function setEmailOTP($email, $otp)
	{
		$data = array(
			'emailOTP' => $otp,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('email', $email);
		$result = $this->db->update('user', $data);

		return $result;
	}

	public function verifyEmailOTP($freelancer_id)
	{
		$this->db->where('freelancer_id', $freelancer_id);
		$result = $this->db->update('user', array('emailOTP' => ''));
		return $result;
	}

	public function resetPassword($freelancer_id, $password)
	{
		$salt = random_string('alnum', 9);
		$password = $this->password_encrypt($password, $salt);

		$reset_data = array(
			'salt' => $salt,
			'password' => $password,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('freelancer_id', $freelancer_id);
		$result = $this->db->update('user', $reset_data);
		return $result;
	}



	// 	public function dbdate_format($date){
	// 		$rdate = str_replace('/', '-', $date);
	// 		$gdate = strtotime($rdate);
	// 		return date('Y-m-d', $gdate);
	// 	}

	//freelancer Filter
	public function getFreelancerFilters($freelancer_id)
	{
		$this->db->where(array('freelancer_id' => $freelancer_id));
		$query = $this->db->get('freelancer_filter');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function getFreelancerFilter($freelancer_id, $keyword, $filter_id)
	{
		$filter_data = array(
			'freelancer_id' => $freelancer_id,
			'filter_keyword' => $keyword,
			'filter_id' => $filter_id
		);
		$this->db->where($filter_data);
		$query = $this->db->get('freelancer_filter');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function addFreelancerFilter($freelancer_id, $keyword, $filter_id)
	{
		$insert_data = array(
			'freelancer_id' => $freelancer_id,
			'filter_keyword' => $keyword,
			'filter_id' => $filter_id
		);

		$query = $this->db->insert('freelancer_filter', $insert_data);
		return $this->db->insert_id();
	}

	public function updateFreelancerFilter($job_filter_id, $keyword, $filter_id)
	{
		$update_data = array(
			'filter_keyword' => $keyword,
			'filter_id' => $filter_id
		);
		$this->db->where('freelancer_filter_id', $freelancer_filter_id);
		$result = $this->db->update('freelancer_filter', $update_data);
		return $result;
	}

	public function deleteFreelancerFilter($freelancer_id, $data = array())
	{
		$this->db->where('freelancer_id', $freelancer_id);
		if (isset($data['keyword'])) {
			if ($data['keyword']) {
				$this->db->where('keyword', $data['keyword']);
			}
		}
		$result = $this->db->delete('freelancer_filter');
		return $result;
	}

	// freelancer payment
	public function updatePaymentInfo($freelancer_id, $status)
	{
		$condition = array(
			'freelancer_id' => $freelancer_id
		);
		$this->db->where($condition);
		$update_data = array(
			'isPaymentInfoGiven' => $status,
			'payment_Info_Given_Datetime' => date('Y-m-d H:i:s'),
			'fl_date_modified' => date('Y-m-d H:i:s')
		);
		$result = $this->db->update('freelancer', $update_data);
		return $result;
	}

	public function getPaymentInfo($freelancer_id)
	{
		$condition = array(
			'freelancer_id' => $freelancer_id
		);
		$this->db->where($condition);
		$this->db->order_by('freelancer_payment_id', 'DESC');
		$query = $this->db->get('freelancer_payment');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function addPaymentInfo($freelancer_id)
	{
		$insert_data = array(
			'freelancer_id' => $freelancer_id,
			'account_number' => $this->input->post('account_number'),
			'ifsc_code' => $this->input->post('ifsc_code'),
			'bank_name' => $this->input->post('bank_name'),
			'branch_name' => $this->input->post('branch_name'),
			// 'upi_id' => $this->input->post('upi_id'),
			'fp_created_datetime' => date('Y-m-d H:i:s')
		);
		$this->db->insert('freelancer_payment', $insert_data);
		return $this->db->insert_id();
	}

	public function editPaymentInfo($freelancer_id)
	{

		$data = array(
			'account_number' => $this->input->post('account_number'),
			'ifsc_code' => $this->input->post('ifsc_code'),
			'bank_name' => $this->input->post('bank_name'),
			'branch_name' => $this->input->post('branch_name'),
			'fp_updated_datetime' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'freelancer_id' => $freelancer_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('freelancer_payment', $data);
		return $result;
	}

	public function editFreelancerTaxInfo($freelancer_id)
	{

		$data = array(
			'pan_number' => $this->input->post('pan_number'),
			'gst_number' => $this->input->post('gst_number'),
			'fp_updated_datetime' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'freelancer_id' => $freelancer_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('freelancer_payment', $data);
		return $result;
	}

	public function deletePaymentInfo($freelancer_id)
	{
		$condition = array(
			'freelancer_id' => $freelancer_id
		);
		$this->db->where($condition);
		$this->db->delete('freelancer_payment');
	}
}
