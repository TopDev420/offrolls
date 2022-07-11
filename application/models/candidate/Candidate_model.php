<?php class Candidate_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('string');
    }

    public function getCandidates($filter_data){
        $this->db->select('c.*, u.first_name, u.last_name, u.image, u.email, u.mobile, u.user_type, u.status');
        $this->db->from('user AS u');
        $this->db->join('candidate AS c', 'c.user_id=u.user_id');
        //Filter Condition
        $condition = array();
        if(isset($data['status'])){
            $condition['u.status'] = $data['status'];
        }
        if($condition){
    		$this->db->where($condition);
		}


		//Limit
		if(isset($data['limit']) && isset($data['start'])){

			if($data['limit']){
				$limit = $data['limit'];
			} else {
				$limit = 20;
			}

			if($data['start']){
				$start = $data['start'];
			} else {
				$start = 0;
			}

			$this->db->limit($limit, $start);
		}

		//Sort
		if(isset($data['sort'])){
			$sort = $data['sort'];
		} else {
			$sort = 'u.user_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
        $this->db->order_by($sort, $order);

        return $query = $this->db->get()->result();
	}

	public function getTotalCandidates($data = array()) {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('user AS u');
        $this->db->join('candidate AS c', 'c.user_id=u.user_id');
        //Filter Condition
        $condition = array();
		if(isset($data['status'])){
			$condition['u.status'] = $data['status'];
		}
		if($condition){
			$this->db->where($condition);
		}

		$query = $this->db->get();
        if($query->num_rows() > 0) {
        	$row = $query->row();
        	return $row->total;
        } else {
        	return false;
        }
	}

	public function getCandidate($user_id){
		$this->db->select('c.*, u.first_name, u.last_name, u.image, u.email, u.mobile, u.user_type, u.status');
        $this->db->from('user AS u');
        $this->db->join('candidate AS c', 'c.user_id=u.user_id');
		$this->db->where('u.user_id', $user_id);
		$query = $this->db->get();

        if($query->num_rows() > 0) {
        	return $query->row();
        } else {
        	return false;
        }
	}

    public function getCandidateById($candidate_id){
    	$this->db->select('c.*, u.first_name, u.last_name, u.image, u.email, u.mobile, u.user_type, u.status');
        $this->db->from('user AS u');
        $this->db->join('candidate AS c', 'c.user_id=u.user_id');
		$this->db->where('c.candidate_id', $candidate_id);
		$query = $this->db->get();

        if($query->num_rows() > 0) {
        	return $query->row();
        } else {
        	return false;
        }
	}

    public function getCandidateResume($candidate_id){
		$this->db->where('candidate_id', $candidate_id);
		$query = $this->db->get('candidate');

        if($query->num_rows() > 0) {
        	return $query->row();
        } else {
        	return false;
        }
	}

    public function addCandidateResume($candidate_id){
        $candidate_data = array(
            'candidate_id' => $candidate_id,
            'is_published' => 0
        );
		$result = $this->db->insert('candidate', $candidate_data);
		return $result;
	}

    public function addCandidateByUser($user_id, $data){
    	$user_data = array(
			'user_id' => $user_id,
            'dob' => $data['dob'],
            'experience' => $data['experience'],
            'can_date_added' => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert('candidate', $user_data);
		return $this->db->insert_id();
	}

	public function editCandidate($user_id){

	    $data = array(
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country'),
			'pin_code' => $this->input->post('pin_code'),
			'can_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'user_id' => $user_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('candidate', $data);
		return $result;
	}


	public function setCandidateProfileComplete($candidate_id, $status){
	    $condition_data = array(
			'user_id' => $candidate_id,
			'status' => 1
		);
	    $this->db->where($condition_data);
		$result = $this->db->update('user', array('is_profileCompleted' => $status));
		return $result;
	}

	public function editProfileSummary($candidate_id){
		$data = array(
			'about' => $this->input->post('ps_description'),
			'can_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'candidate_id' => $candidate_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('candidate', $data);
		return $result;
	}

    public function setExperience($candidate_id, $experience_id){
    	$data = array(
			'experience' => $experience_id,
			'can_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'candidate_id' => $candidate_id
		);
		$this->db->where($condition_data);

		$result = $this->db->update('candidate', $data);
		return $result;
	}

    public function setCandidateResumePublish($candidate_id, $publish=0) {
		$this->db->where('candidate_id', $candidate_id);
		$result = $this->db->update('candidate', array('is_published' => $publish));
		return $result;
	}

	public function editCareer($candidate_id){
		$salary_range = $this->input->post('job_salary_range');
		$data = array(
			'company_category' => $this->input->post('industry_type'),
			'job_type' => $this->input->post('job_type'),
			'job_location' => $this->input->post('job_location'),
			'salary_range_from' => isset($salary_range['from']) ? $salary_range['from'] : 0,
			'salary_range_to' => isset($salary_range['to']) ? $salary_range['to'] : 0,
			'salary_period' => isset($salary_range['period']) ? $salary_range['period'] : 0,
			'can_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'candidate_id' => $candidate_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('candidate', $data);
		return $result;
	}

	public function editPersonal($candidate_id){
		$data = array(
			'father_name' => $this->input->post('personal_father_name'),
			'mother_name' => $this->input->post('personal_mother_name'),
			'dob' => $this->input->post('personal_dob') ? dbdate_format($this->input->post('personal_dob')) : '',
			'nationality' => $this->input->post('personal_nationality'),
			'gender' => $this->input->post('personal_gender'),
// 			'age' => $this->input->post('personal_age'),
			'can_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'candidate_id' => $candidate_id
		);
		$this->db->where($condition_data);
		$result = $this->db->update('candidate', $data);
		return $result;
	}

	public function editSkills($candidate_id){
		$skills = $this->input->post('skill_category');

		$data = array(
			'skills' => $skills ? json_encode($skills) : '',
			'can_date_modified' => date('Y-m-d H:i:s')
		);

		$condition_data = array(
			'candidate_id' => $candidate_id
		);

		$this->db->where($condition_data);
		$result = $this->db->update('candidate', $data);
		return $result;
	}

	public function setAccountVerification($candidate_id) {
		$condition_data = array(
			'token' => '',
			'status' => 1,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('candidate_id', $candidate_id);
		$result = $this->db->update('user', $condition_data);
		return $result;
	}

	public function saveImage($user_id, $file_name) {
		$data = array(
			'image' => $file_name,
			'date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $data);
		return $result;
	}

	public function saveResume($candidate_id, $file_name) {
		$data = array(
			'resume' => $file_name,
			'can_date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('candidate_id', $candidate_id);
		$result = $this->db->update('candidate', $data);
		return $result;
	}


	public function setEmailOTP($email, $otp) {
		$data = array(
			'emailOTP' => $otp,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('email', $email);
		$result = $this->db->update('user', $data);

		return $result;
	}

	public function verifyEmailOTP($candidate_id) {
		$this->db->where('candidate_id', $candidate_id);
		$result = $this->db->update('user', array('emailOTP' => ''));
		return $result;
	}

	public function resetPassword($candidate_id, $password) {
		$salt = random_string('alnum', 9);
		$password = $this->password_encrypt($password, $salt);

		$reset_data = array(
			'salt' => $salt,
			'password' => $password,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('candidate_id', $candidate_id);
		$result = $this->db->update('user', $reset_data);
		return $result;
	}



// 	public function dbdate_format($date){
// 		$rdate = str_replace('/', '-', $date);
// 		$gdate = strtotime($rdate);
// 		return date('Y-m-d', $gdate);
// 	}


    //Candidate Filter
    public function getCandidateFilters($candidate_id){
        $this->db->where(array('candidate_id' => $candidate_id));
        $query = $this->db->get('candidate_filter');
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return false;
        }
    }

    public function getCandidateFilter($candidate_id, $keyword, $filter_id){
        $filter_data = array(
            'candidate_id' => $candidate_id,
            'filter_keyword' => $keyword,
            'filter_id' => $filter_id
        );
        $this->db->where($filter_data);
        $query = $this->db->get('candidate_filter');
        if($query->num_rows() > 0){
            return $query->row();
        } else {
            return false;
        }
    }

    public function addCandidateFilter($candidate_id, $keyword, $filter_id){
        $insert_data = array(
            'candidate_id' => $candidate_id,
            'filter_keyword' => $keyword,
            'filter_id' => $filter_id
        );

        $query = $this->db->insert('candidate_filter', $insert_data);
        return $this->db->insert_id();
    }

    public function updateCandidateFilter($candidate_filter_id, $keyword, $filter_id){
        $update_data = array(
            'filter_keyword' => $keyword,
            'filter_id' => $filter_id
        );
        $this->db->where('candidate_filter_id', $candidate_filter_id);
        $result = $this->db->update('candidate_filter', $update_data);
        return $result;
    }

    public function deleteCandidateFilter($candidate_id, $data=array()){
        $this->db->where('candidate_id', $candidate_id);
        if(isset($data['keyword'])){
            if($data['keyword']){
                $this->db->where('keyword', $data['keyword']);
            }
        }
        $result = $this->db->delete('candidate_filter');
        return $result;
    }
}
