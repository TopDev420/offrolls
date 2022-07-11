<?php
class Jobs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getJobs($data=array()) {
        $this->db->distinct();
        $this->db->select('j.*, c.company_name AS company_name, c.company_id, u.user_id, u.image AS company_logo');
        $this->db->from('jobs AS j');
        $this->db->join('company AS c', 'j.company_id = c.company_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

        //Filter Condition
        $condition = array();
        $condition['j.status'] = 1;
        if(isset($data['expiry_date'])) {
            $condition['DATE(j.job_expiry_date) >= '] = $data['expiry_date'];
        }
        
    	if(isset($data['company_id'])){
			$condition['j.company_id'] = $data['company_id'];
		}

		if($condition){
			$this->db->where($condition);
		}


        // For Search Query
        if(isset($data['search'])){
            if(is_array($data['search'])){
                if($data['search']){
                    //  $this->db->join('job_category AS jc', 'j.job_category = jc.category_id');
    		        foreach($data['search'] as $search){
    		            $this->db->like('j.title', $search);
    		        }

    		      //  $this->db->like('company_name', $data['search']);
    		      //  $this->db->or_where_in('jc.name', $data['search']);
    		    }
            }

		}

		//Filter Job id
		if(isset($data['filter_jobs_not'])){
		    $this->db->where_not_in('j.job_id', $data['filter_jobs_not']);
		}

		//Filter Title/Category
		if(isset($data['filter_title'])){
		    if($data['filter_title']){
		        $this->db->like('REPLACE(j.title, " ", "-")', preg_replace('[\s]', '-', $data['filter_title']));
		    }
		}

		//Job Filters
		if(isset($data['job_filter'])){
		    if($data['job_filter'] == 'join'){
		        $this->db->join('job_filter AS jfs', 'j.job_id = jfs.job_id');
                $this->db->where('jfs.type', CANDIDATE_TYPE);

    		    //Filter Skills
        		if(isset($data['filter_skills'])){
        		    if($data['filter_skills']){
            		    $this->db->where('jfs.filter_keyword', 'filter_skill');
            		    $this->db->where_in('jfs.filter_id', $data['filter_skills']);
        		    }

        		}

        		//Filter Technology
        		if(isset($data['filter_technology'])){
        		    if($data['filter_technology']){
            		    $this->db->where('jfs.filter_keyword', 'filter_technology');
            		    $this->db->where_in('jfs.filter_id', $data['filter_technology']);
            		}
        		}

        		//Filter Technology
        		if(isset($data['filter_jobtypes'])){
        		    if($data['filter_jobtypes']){
            		    $this->db->where('jfs.filter_keyword', 'filter_jobtype');
            		    $this->db->where_in('jfs.filter_id', $data['filter_jobtypes']);
            		}
        		}
		    }
		}

		//Filter Location
		if(isset($data['filter_location'])){
		    if($data['filter_location']){
		        $this->db->where('LOWER(j.location)', strtolower($data['filter_location']));
		    }
		}

		//Filter Qualification
		if(isset($data['filter_qualification'])){
		    if($data['filter_qualification']){
		        $this->db->join('job_qualification AS jq', 'j.job_id = jq.job_id');
    		    $this->db->where_in('jq.qualification', $data['filter_qualification']);
    		}
		}

		//Filter Gender
		if(isset($data['filter_gender'])){
		    if($data['filter_gender']){
		        $this->db->where('j.gender', $data['filter_gender']);
		    }
		}

		//Filter Experience
		if(isset($data['filter_experience'])){
		    if($data['filter_experience']){
		        $this->db->where('j.experience', $data['filter_experience']);
		    }
		}

		//Filter DatePost
		if(isset($data['filter_datepost'])){
		    if($data['filter_datepost']){
		        $this->db->where('IF(j.date_modified, DATE(j.date_modified), DATE(j.date_added)) >=', $data['filter_datepost']);
		    }
		}

		//Filter Salary Package From
		if(isset($data['filter_salary_package_from'])){
		    if($data['filter_salary_package_from']){
		        $this->db->where('j.salary_package_from >=', $data['filter_salary_package_from']);
		    }
		}

		//Filter Salary Package To
		if(isset($data['filter_salary_package_to'])){
		    if($data['filter_salary_package_to']){
		        $this->db->where('j.salary_package_to <=', $data['filter_salary_package_to']);
		    }
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
			$sort = 'j.job_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}

		$this->db->order_by($sort, $order);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return false;
        }

	}

	public function getTotalJobs($data=array()) {
	    $this->db->distinct();
		$this->db->select('COUNT(*) AS total');
		$this->db->from('jobs AS j');
		$this->db->join('company AS c', 'j.company_id = c.company_id');
		$this->db->join('user AS u', 'u.user_id = c.user_id');
       //For Search Query
        if(isset($data['search'])){
            if($data['search']){
                $this->db->join('job_category AS jc', 'j.job_category = jc.category_id');
            }
        }

		$condition['j.status'] = 1;
		if(isset($data['expiry_date'])) {
            $condition['DATE(j.job_expiry_date) >= '] = $data['expiry_date'];
        }
		if(isset($data['company_id'])){
			$condition['j.company_id'] = $data['company_id'];
		}

		if(isset($data['job_filter'])){
		    if($data['job_filter'] == 'join'){
		        $this->db->join('job_filter AS jfs', 'j.job_id = jfs.job_id');
                $this->db->where('jfs.type', CANDIDATE_TYPE);

    		    //Filter Skills
        		if(isset($data['filter_skills'])){
        		    if($data['filter_skills']){
            		    $this->db->where('jfs.filter_keyword', 'filter_skill');
            		    $this->db->where_in('jfs.filter_id', $data['filter_skills']);
        		    }

        		}

        		//Filter Technology
        		if(isset($data['filter_technology'])){
        		    if($data['filter_technology']){
            		    $this->db->where('jfs.filter_keyword', 'filter_technology');
            		    $this->db->where_in('jfs.filter_id', $data['filter_technology']);
            		}
        		}

        		//Filter Technology
        		if(isset($data['filter_jobtypes'])){
        		    if($data['filter_jobtypes']){
            		    $this->db->where('jfs.filter_keyword', 'filter_jobtypes');
            		    $this->db->where_in('jfs.filter_id', $data['filter_jobtypes']);
            		}
        		}
		    }
		}

		//Filter Title/Category
		if(isset($data['filter_title'])){
		    if($data['filter_title']){
		        $this->db->like('REPLACE(j.title, " ", "-")', preg_replace('[\s]', '-', $data['filter_title']));
		    }
		}

		//Filter Location
		if(isset($data['filter_location'])){
		    if($data['filter_location']){
		        $condition['LOWER(j.location)'] = strtolower($data['filter_location']);
		    }
		}

		//Filter Qualification
		if(isset($data['filter_qualification'])){
		    if($data['filter_qualification']){
		        $this->db->join('job_qualification AS jq', 'j.job_id = jq.job_id');
    		    $this->db->where_in('jq.qualification', $data['filter_qualification']);
    		}
		}

		//Filter Gender
		if(isset($data['filter_gender'])){
		    if($data['filter_gender']){
		        $condition['j.gender'] =  $data['filter_gender'];
		    }
		}

		//Filter Experience
		if(isset($data['filter_experience'])){
		    if($data['filter_experience']){
		        $this->db->where('j.experience', $data['filter_experience']);
		    }
		}

		//Filter DatePost
		if(isset($data['filter_datepost'])){
		    if($data['filter_datepost']){
		        $condition['IF(j.date_modified, DATE(j.date_modified), DATE(j.date_added)) >='] =  $data['filter_datepost'];
		    }
		}

		//Filter Salary Package From
		if(isset($data['filter_salary_package_from'])){
		    if($data['filter_salary_package_from']){
		        $this->db->where('j.salary_package_from >=', $data['filter_salary_package_from']);
		    }
		}

		//Filter Salary Package To
		if(isset($data['filter_salary_package_to'])){
		    if($data['filter_salary_package_to']){
		        $this->db->where('j.salary_package_to <=', $data['filter_salary_package_to']);
		    }
		}

		$this->db->where($condition);

		// For Search Query
        if(isset($data['search'])){
		    if($data['search']){
		        $this->db->where_in('company_name', $data['search']);
		        $this->db->or_where_in('j.title', $data['search']);
		      //  $this->db->or_where_in('jc.name', $data['search']);
		    }
		}

		$query = $this->db->get();
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->total;
		} else {
			return false;
		}
	}

	public function getJob($job_id) {
		$this->db->select('j.*, c.company_name AS company_name, c.company_id, u.user_id, u.image AS company_logo');

		$condition_data = array(
			'j.job_id' => $job_id,
			'j.status' => 1
		);
		$this->db->where($condition_data);

		$this->db->from('jobs AS j');
		$this->db->join('company AS c', 'j.company_id = c.company_id');
		$this->db->join('user AS u', 'u.user_id = c.user_id');
		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return false;
		}
	}

    public function getJobQualifications($job_id, $data=array()) {
    	$this->db->select('job_qualification.*');

       	$condition['job_id'] = $job_id;

		if($condition){
			$this->db->where($condition);
		}

		$query = $this->db->get('job_qualification');

        if($query->num_rows() > 0) {
        	return $query->result();
        } else {
        	return false;
        }
	}

	//Candidate Jobs
	public function getCandidateJobs($candidate_id, $data=array()) {
		$this->db->select('j.*, cj.candidate_job_id, cj.cj_isApplied, c.company_name AS company_name, u.image AS company_logo');
        $this->db->from('jobs AS j');
        $this->db->join('candidate_jobs AS cj', 'j.job_id = cj.job_id');
		$this->db->join('company AS c', 'j.company_id = c.company_id');
		$this->db->join('user AS u', 'u.user_id = c.user_id');

		//Filter Condition
		$condition = array();
		$condition['j.status'] = 1;
		$condition['cj.candidate_id'] = $candidate_id;

		if(isset($data['applied'])) {
			$condition['cj.cj_isApplied'] = $data['applied'];
		}
		if($condition){
			$this->db->where($condition);
		}

		if(isset($data['saved'])) {
			$condition['cj.cj_isSaved'] = $data['saved'];
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
			$sort = 'j.job_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);
        return $query = $this->db->get()->result();
	}

	public function getTotalCandidateJobs($candidate_id, $data=array()) {
		$this->db->select('COUNT(*) AS total');
		$this->db->from('jobs AS j');
		$this->db->join('candidate_jobs AS cj', 'j.job_id = cj.job_id');
		$this->db->join('company AS c', 'j.company_id = c.company_id');
		$this->db->join('user AS u', 'u.user_id = c.user_id');

		//Filter Condition
		$condition = array();
		$condition['j.status'] = 1;
        $condition['cj.candidate_id'] = $candidate_id;

		if(isset($data['applied'])) {
			$condition['cj.cj_isApplied'] = $data['applied'];
		}

		if(isset($data['saved'])) {
			$condition['cj.cj_isSaved'] = $data['saved'];
		}

		if($condition){
			$this->db->where($condition);
		}

		$query = $this->db->get();
		$row = $query->row();
		return $row->total;
	}

	public function getRecentCandidateJob($candidate_id, $job_id) {
		$this->db->select('j.*, cj.candidate_job_id, cj.cj_isApplied, cj.cj_isSaved, c.company_name AS company_name, u.image AS company_logo');

		$condition_data = array(
		    'cj.candidate_id' => $candidate_id,
			'j.job_id' => $job_id,
			'j.status' => 1,
			'cj.cj_isRemoved' => 0,
			'cj.cj_isCompleted' => 0
		);
		$this->db->where($condition_data);

		$this->db->from('jobs AS j');
		$this->db->join('candidate_jobs AS cj', 'j.job_id = cj.job_id');
		$this->db->join('company AS c', 'j.company_id = c.company_id');
		$this->db->join('user AS u', 'u.user_id = c.user_id');
		$this->db->limit(1);
		$this->db->order_by('j.job_id', 'DESC');

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return false;
		}
	}

	public function addCandidatejob($job_id, $data) {
		$job_data = array(
			'job_id' => $job_id,
			'candidate_id' => $data['candidate_id'],
			'cj_isApplied' => 0,
			'cj_isSaved' => 0,
			'cj_date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('candidate_jobs', $job_data);

		return $this->db->insert_id();
	}

	public function saveJob($candidate_job_id) {
		$job_data = array(
			'cj_isSaved' => 1,
			'cj_date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('candidate_job_id', $candidate_job_id);
		$result = $this->db->update('candidate_jobs', $job_data);

		return $result;
	}

	public function applyJob($candidate_job_id) {
		$job_data = array(
			'cj_isApplied' => 1,
			'cj_isSaved' => 0,
			'cj_date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('candidate_job_id', $candidate_job_id);
		$result = $this->db->update('candidate_jobs', $job_data);

		return $result;
	}

	public function setCandidateJobActivity($candidate_job_id, $data){
		if($data){
			if(isset($data['shortlisted'])){
				$update_data['cj_isShortlisted'] = $data['shortlisted'];
			}
			if(isset($data['applied'])){
				$update_data['cj_isApplied'] = $data['applied'];
			}

			if(isset($data['saved'])){
				$update_data['cj_isSaved'] = $data['saved'];
			}

			$update_data['cj_date_modified'] = date('Y-m-d H:i:s');

			$this->db->where('candidate_job_id', $candidate_job_id);
			$result = $this->db->update('candidate_jobs', $update_data);

			return $result;
		} else {
			return false;
		}

	}


}

