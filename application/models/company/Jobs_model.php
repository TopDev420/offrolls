<?php class Jobs_model extends CI_Model {

  public function __construct() {
      parent::__construct();

      //Company Categories
      $this->load->helper('category');
  }

  public function getJobs($company_id,$data=array()){
    $this->db->select('jobs.*');
      $this->db->from('jobs');

      //Filter Condition
      $condition = array();
          $condition['company_id'] = $company_id;
      if(isset($data['status'])){
        $condition['status'] = $data['status'];
      }
      if($condition){
        $this->db->where($condition);
      }

        //Filter Date From
        if(isset($data['filter_date_from'])){
            if($data['filter_date_from']){
                $this->db->where('DATE(date_added) >=', $data['filter_date_from']);
            }
        }

    	//Filter Date To
		if(isset($data['filter_date_to'])){
		    if($data['filter_date_to']){
		        $this->db->where('DATE(date_added) <=', $data['filter_date_to']);
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
        $sort = 'job_id';
      }

      if(isset($data['order'])){
        $order = $data['order'];
      } else {
        $order = 'DESC';
      }

      $this->db->order_by($sort, $order);
          $query = $this->db->get()->result();
          return $query;
  }

  public function getTotalJobs($company_id, $data=array()) {
      $this->db->select('COUNT(*) AS total');

      $condition['company_id'] = $company_id;
      if(isset($data['status'])){
        $condition['status'] = $data['status'];
      }
      if($condition){
        $this->db->where($condition);
      }

        //Filter Date From
        if(isset($data['filter_date_from'])){
		    if($data['filter_date_from']){
		        $this->db->where('DATE(date_added) >=', $data['filter_date_from']);
		    }
		}

		//Filter Date To
		if(isset($data['filter_date_to'])){
		    if($data['filter_date_to']){
		        $this->db->where('DATE(date_added) <=', $data['filter_date_to']);
		    }
		}

      $query = $this->db->get('jobs');

      if($query->num_rows() > 0) {
        $row = $query->row();
        return $row->total;
      } else {
        return false;
      }
  }

  public function getJob($job_id, $data=array()) {
    $this->db->select('jobs.*');

      $condition['job_id'] = $job_id;
    if(isset($data['status'])){
      $condition['status'] = $data['status'];
    }
    if($condition){
      $this->db->where($condition);
    }

    $query = $this->db->get('jobs');

        if($query->num_rows() > 0) {
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

  public function addJob($company_id) {

    $salary_package = $this->input->post('job_salary_package');
    $salary_package_from = $salary_package['from'] ? $salary_package['from'] : 0;
    $salary_package_to = $salary_package['to'] ? $salary_package['to'] : 0;
    if(isset($salary_package['period'])){
        $periodvalue = get_salary_periodvalue($salary_package['period']);
        $salary_package_from = $salary_package_from * $periodvalue;
        $salary_package_to = $salary_package_to * $periodvalue;
    }

    $data = array(
      'company_id' => $company_id,
      'title' => $this->input->post('job_title'),
      'description' => $this->input->post('job_description'),
      'company_category' => $this->input->post('company_category'),
      'job_category' => $this->input->post('job_category'),
      'job_type' => $this->input->post('job_type') ? json_encode($this->input->post('job_type')) : 0,
      'gender' => $this->input->post('job_gender'),
      'job_vacancy' => $this->input->post('job_vacancy'),
      'experience' => $this->input->post('job_experience'),
      'notice_period' => $this->input->post('job_notice_period'),
      'skills' => $this->input->post('job_skills') ? json_encode($this->input->post('job_skills')) : 0,
      'technology' => $this->input->post('job_technology') ? json_encode($this->input->post('job_technology')) : 0,
      'certification' => $this->input->post('job_certification') ? json_encode($this->input->post('job_certification')) : 0,
      'location' => $this->input->post('job_location'),
      'keyword' => $this->input->post('job_keyword'),
      'salary_package_from' => $salary_package_from,
      'salary_package_to' => $salary_package_to,
      'salary_package_period' => isset($salary_package['period']) ? $salary_package['period'] : 0,
      'benefits' => $this->input->post('job_benefits'),
      'job_expiry_date' => $this->input->post('job_expiry_date') ? dbdate_format($this->input->post('job_expiry_date')) : date('Y-m-d'),
      'status' => $this->input->post('visibility'),
      'date_added' => date('Y-m-d H:i:s')
    );

    $this->db->insert('jobs', $data);
    $insert_id = $this->db->insert_id();
    if($insert_id) {
      return $insert_id;
    } else {
      return false;
    }
  }

  public function addJobQualifications($job_id, $data){
    //Add Qualification
    $qualification = isset($data['qualification']) ? $data['qualification'] : 0;
    $specialization= isset($data['specialization']) ? $data['specialization'] : 0;
    if($data['qualification'] && $data['specialization']) {
      $data_data = array(
        'qualification' => $qualification,
        'specialization' => $specialization,
        'job_id' => $job_id
      );
      $this->db->insert('job_qualification', $data_data);
    }

  }

  public function editJob($job_id) {
    $salary_package = $this->input->post('job_salary_package');
    $salary_package_from = $salary_package['from'] ? $salary_package['from'] : 0;
    $salary_package_to = $salary_package['to'] ? $salary_package['to'] : 0;
    if(isset($salary_package['period'])){
        $periodvalue = get_salary_periodvalue($salary_package['period']);
        $salary_package_from = $salary_package_from * $periodvalue;
        $salary_package_to = $salary_package_to * $periodvalue;
    }

    $data = array(
      'title' => $this->input->post('job_title'),
      'description' => $this->input->post('job_description'),
      'company_category' => $this->input->post('company_category'),
      'job_category' => $this->input->post('job_category'),
      'job_type' => $this->input->post('job_type') ? json_encode($this->input->post('job_type')) : 0,
      'gender' => $this->input->post('job_gender'),
      'job_vacancy' => $this->input->post('job_vacancy'),
      'experience' => $this->input->post('job_experience'),
      'notice_period' => $this->input->post('job_notice_period'),
      'skills' => $this->input->post('job_skills') ? json_encode($this->input->post('job_skills')) : 0,
      'technology' => $this->input->post('job_technology') ? json_encode($this->input->post('job_technology')) : 0,
      'certification' => $this->input->post('job_certification') ? json_encode($this->input->post('job_certification')) : 0,
      'location' => $this->input->post('job_location'),
      'keyword' => $this->input->post('job_keyword'),
      'salary_package_from' => $salary_package_from,
      'salary_package_to' => $salary_package_to,
      'salary_package_period' => isset($salary_package['period']) ? $salary_package['period'] : 0,
      'benefits' => $this->input->post('job_benefits'),
      'job_expiry_date' => $this->input->post('job_expiry_date') ? dbdate_format($this->input->post('job_expiry_date')) : date('Y-m-d'),
      'status' => $this->input->post('visibility'),
      'date_added' => date('Y-m-d H:i:s')
    );

    $this->db->where('job_id', $job_id);
    $result = $this->db->update('jobs', $data);
    return $result;
  }

  public function editJobQualifications($job_id, $data){
      $this->db->delete('job_qualification', array('job_id' => $job_id));

      if($data){
          //Add Qualification
        $qualification = isset($data['qualification']) ? $data['qualification'] : 0;
        $specialization= isset($data['specialization']) ? $data['specialization'] : 0;
        if($data['qualification'] && $data['specialization']) {
          $insert_data = array(
            'qualification' => $qualification,
            'specialization' => $specialization,
            'job_id' => $job_id
          );
          $this->db->insert('job_qualification', $insert_data);
        }
      }
  }

  //Candidate
  public function getCandidates($data=array()) {
    $this->db->select('c.*, CONCAT(u.first_name, u.last_name) AS candidate_name, u.user_id, u.image As candidate_image');
    $this->db->from('candidate AS c');
    $this->db->join('user AS u', 'u.user_id = c.user_id');

    //Filter Condition
    $condition = array();
    $condition['c.status'] = 1;

    //Candidate Filters
    if(isset($data['candidate_filter'])){
        if($data['candidate_filter'] == 'join'){
            $this->db->join('candidate_filter AS cfs', 'cfs.candidate_id = c.candidate_id');

            //Filter Skills
            if(isset($data['filter_skills'])){
                if($data['filter_skills']){
                    $this->db->where('cfs.filter_keyword', 'filter_skill');
                    $this->db->where_in('cfs.filter_id', $data['filter_skills']);
                }
            }

            //Filter Job Types
            if(isset($data['filter_jobtypes'])){
                if($data['filter_jobtypes']){
                    $this->db->where('cfs.filter_keyword', 'filter_jobtype');
                    $this->db->where_in('cfs.filter_id', $data['filter_jobtypes']);
                }
        	}

            //Filter Qualifications
            if(isset($data['filter_qualifications'])){
                if($data['filter_qualifications']){
                    $this->db->where('cfs.filter_keyword', 'filter_qualification');
                    $this->db->where_in('cfs.filter_id', $data['filter_qualifications']);
                }
            }
        }
    }

    //Filter Location
    if(isset($data['filter_location'])){
        if($data['filter_location']){
            $this->db->where('LOWER(c.job_location)', strtolower($data['filter_location']));
        }
    }

    //Filter Gender
    if(isset($data['filter_gender'])){
	    if($data['filter_gender']){
	        $this->db->where('c.gender', $data['filter_gender']);
	    }
	}

    //Filter Experience
    if(isset($data['filter_experience'])){
        if($data['filter_experience']){
            $this->db->where('c.experience', $data['filter_experience']);
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
      $sort = 'cj.candidate_job_id';
    }

    if(isset($data['order'])){
      $order = $data['order'];
    } else {
      $order = 'DESC';
    }


    $this->db->order_by($sort, $order);

    $query = $this->db->get();
    if($query->num_rows() > 0){
        $result = $query->result();
    } else {
        $result = false;
    }

        return $result;
  }

  public function getAllCandidateJobs($data=array()) {
    $this->db->select('cj.*, CONCAT(u.first_name, u.last_name) AS candidate_name, u.user_id, u.image As candidate_image, c.resume as candidate_resume, j.title, j.location, j.job_type');
        $this->db->from('candidate_jobs AS cj');
        $this->db->join('jobs AS j', 'cj.job_id = j.job_id');
        $this->db->join('candidate AS c', 'cj.candidate_id = c.candidate_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

    //Filter Condition
    $condition = array();
    $condition['j.status'] = 1;

    if(isset($data['applied'])){
      $condition['cj.cj_isApplied'] = $data['applied'];
    }

    if(isset($data['shortlisted'])){
      $condition['cj.cj_isShortlisted'] = $data['shortlisted'];
    }

    if(isset($data['saved'])){
      $condition['cj.cj_isSaved'] = $data['saved'];
    }

    if(isset($data['pipelined'])){
      $condition['cj.cj_isPipelined'] = $data['pipelined'];
    }

    if(isset($data['archived'])){
      $condition['cj.cj_isArchived'] = $data['archived'];
    }

    if(isset($data['removed'])){
      $condition['cj.cj_isRemoved'] = $data['removed'];
    }

    if(isset($data['scheduled'])){
      $condition['cj.cj_isScheduled'] = $data['scheduled'];
    }

    if(isset($data['completed'])){
      $condition['cj.cj_isCompleted'] = $data['completed'];
    }

    if($condition){
      $this->db->where($condition);
    }

    if(isset($data['filter_date_limit'])){
        if($data['filter_date_limit']){
            $this->db->where('DATE(cj_date_added) < ', $data['filter_date_limit']);
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
      $sort = 'cj.candidate_job_id';
    }

    if(isset($data['order'])){
      $order = $data['order'];
    } else {
      $order = 'DESC';
    }
    $this->db->order_by($sort, $order);

    $query = $this->db->get();
    
    if($query->num_rows() > 0){
        $result = $query->result();
    } else {
        $result = false;
    }

        return $result;
  }


  public function getCandidateJobs($company_id, $data=array()) {
    $this->db->select('cj.*, CONCAT(u.first_name, u.last_name) AS candidate_name, u.user_id, u.image As candidate_image, c.resume as candidate_resume, j.title, j.location, j.job_type');
        $this->db->from('candidate_jobs AS cj');
        $this->db->join('jobs AS j', 'cj.job_id = j.job_id');
        $this->db->join('candidate AS c', 'cj.candidate_id = c.candidate_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

    //Filter Condition
    $condition = array();
    $condition['j.company_id'] = $company_id;
    $condition['j.status'] = 1;

    if(isset($data['job_id'])){
      $condition['cj.job_id'] = $data['job_id'];
    }

    if(isset($data['applied'])){
      $condition['cj.cj_isApplied'] = $data['applied'];
    }

    if(isset($data['shortlisted'])){
      $condition['cj.cj_isShortlisted'] = $data['shortlisted'];
    }

    if(isset($data['saved'])){
      $condition['cj.cj_isSaved'] = $data['saved'];
    }

    if(isset($data['pipelined'])){
      $condition['cj.cj_isPipelined'] = $data['pipelined'];
    }

    if(isset($data['archived'])){
      $condition['cj.cj_isArchived'] = $data['archived'];
    }

    if(isset($data['removed'])){
      $condition['cj.cj_isRemoved'] = $data['removed'];
    }

    if(isset($data['scheduled'])){
      $condition['cj.cj_isScheduled'] = $data['scheduled'];
    }

    if(isset($data['completed'])){
      $condition['cj.cj_isCompleted'] = $data['completed'];
    }

    if($condition){
      $this->db->where($condition);
    }

    //Candidate Filters
    if(isset($data['candidate_filter'])){
        if($data['candidate_filter'] == 'join'){
            $this->db->join('candidate_filter AS cfs', 'cfs.candidate_id = c.candidate_id');

            //Filter Skills
            if(isset($data['filter_skills'])){
                if($data['filter_skills']){
                    $this->db->where('cfs.filter_keyword', 'filter_skill');
                    $this->db->where_in('cfs.filter_id', $data['filter_skills']);
                }
            }

            //Filter Job Types
            if(isset($data['filter_jobtypes'])){
                if($data['filter_jobtypes']){
        		    $this->db->where('cfs.filter_keyword', 'filter_jobtype');
        		    $this->db->where_in('cfs.filter_id', $data['filter_jobtypes']);
        		}
    		}

            //Filter Qualifications
            if(isset($data['filter_qualifications'])){
                if($data['filter_qualifications']){
                    $this->db->where('cfs.filter_keyword', 'filter_qualification');
                    $this->db->where_in('cfs.filter_id', $data['filter_qualifications']);
                }
            }
        }
    }

    //Filter Location
    if(isset($data['filter_location'])){
        if($data['filter_location']){
            $this->db->where('LOWER(c.job_location)', strtolower($data['filter_location']));
        }
    }

    //Filter Gender
    if(isset($data['filter_gender'])){
	    if($data['filter_gender']){
	        $this->db->where('c.gender', $data['filter_gender']);
	    }
	}

    //Filter Experience
    if(isset($data['filter_experience'])){
        if($data['filter_experience']){
            $this->db->where('c.experience', $data['filter_experience']);
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
      $sort = 'cj.candidate_job_id';
    }

    if(isset($data['order'])){
      $order = $data['order'];
    } else {
      $order = 'DESC';
    }


    $this->db->order_by($sort, $order);
        $result = $this->db->get()->result();

        return $result;
  }

  public function getTotalCandidateJobs($company_id, $data=array()) {
    $this->db->select('COUNT(*) AS total');
    $this->db->from('candidate_jobs AS cj');
    $this->db->join('jobs AS j', 'cj.job_id = j.job_id');
    $this->db->join('candidate AS c', 'cj.candidate_id = c.candidate_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

    //Filter Condition
    $condition = array();
    $condition['j.company_id'] = $company_id;
    $condition['j.status'] = 1;

    if(isset($data['job_id'])){
      $condition['cj.job_id'] = $data['job_id'];
    }

    if(isset($data['applied'])){
      $condition['cj.cj_isApplied'] = $data['applied'];
    }

    if(isset($data['shortlisted'])){
      $condition['cj.cj_isShortlisted'] = $data['shortlisted'];
    }

    if(isset($data['saved'])){
      $condition['cj.cj_isSaved'] = $data['saved'];
    }

    if(isset($data['pipelined'])){
      $condition['cj.cj_isPipelined'] = $data['pipelined'];
    }

    if(isset($data['archived'])){
      $condition['cj.cj_isArchived'] = $data['archived'];
    }

    if(isset($data['removed'])){
      $condition['cj.cj_isRemoved'] = $data['removed'];
    }

    if(isset($data['scheduled'])){
      $condition['cj.cj_isScheduled'] = $data['scheduled'];
    }

    if(isset($data['completed'])){
      $condition['cj.cj_isCompleted'] = $data['completed'];
    }

    if($condition){
      $this->db->where($condition);
    }


    //Candidate Filters
    if(isset($data['candidate_filter'])){
        if($data['candidate_filter'] == 'join'){
            $this->db->join('candidate_filter AS cfs', 'cfs.candidate_id = c.candidate_id');

            //Filter Skills
            if(isset($data['filter_skills'])){
                if($data['filter_skills']){
                    $this->db->where('cfs.filter_keyword', 'filter_skill');
                    $this->db->where_in('cfs.filter_id', $data['filter_skills']);
                }
            }

            //Filter Job Types
            if(isset($data['filter_jobtypes'])){
                if($data['filter_jobtypes']){
        		    $this->db->where('cfs.filter_keyword', 'filter_jobtype');
        		    $this->db->where_in('cfs.filter_id', $data['filter_jobtypes']);
        		}
    		}

            //Filter Qualifications
            if(isset($data['filter_qualifications'])){
                if($data['filter_qualifications']){
                    $this->db->where('cfs.filter_keyword', 'filter_qualification');
                    $this->db->where_in('cfs.filter_id', $data['filter_qualifications']);
                }
            }
        }
    }

    //Filter Location
    if(isset($data['filter_location'])){
        if($data['filter_location']){
            $this->db->where('LOWER(c.job_location)', strtolower($data['filter_location']));
        }
    }

    //Filter Gender
    if(isset($data['filter_gender'])){
	    if($data['filter_gender']){
	        $this->db->where('c.gender', $data['filter_gender']);
	    }
	}

    //Filter Experience
    if(isset($data['filter_experience'])){
        if($data['filter_experience']){
            $this->db->where('c.experience', $data['filter_experience']);
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

  public function getCandidateJob($candidate_job_id, $data=array()) {
    $this->db->select('cj.*, CONCAT(u.first_name,u.last_name) AS candidate_name, u.user_id, u.image As candidate_image, j.title, j.location, j.job_type');
    $this->db->from('candidate_jobs AS cj');
    $this->db->join('jobs AS j', 'cj.job_id = j.job_id');
    $this->db->join('candidate AS c', 'cj.candidate_id = c.candidate_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

    //Filter Condition
    $condition = array();
    $condition['cj.candidate_job_id'] = $candidate_job_id;
    $condition['j.status'] = 1;
    if(isset($data['applied'])){
      $condition['cj.cj_isApplied'] = $data['applied'];
    }

    if(isset($data['shortlisted'])){
      $condition['cj.cj_isShortlisted'] = $data['shortlisted'];
    }

    if(isset($data['saved'])){
      $condition['cj.cj_isSaved'] = $data['saved'];
    }

        if(isset($data['scheduled'])){
      $condition['cj.cj_isScheduled'] = $data['scheduled'];
    }

    if(isset($data['completed'])){
      $condition['cj.cj_isCompleted'] = $data['completed'];
    }

    if($condition){
      $this->db->where($condition);
    }

    $query = $this->db->get();
    if($query->num_rows() > 0){
      return $query->row();
    } else {
      return false;
    }
  }

  public function setCandidateJobShortlist($candidate_job_id){
    $update_data = array(
      'cj_isShortlisted' => 1,
      'cj_date_modified' => date('Y-m-d H:i:s')
    );
    $this->db->where('candidate_job_id', $candidate_job_id);
    $result = $this->db->update('candidate_jobs', $update_data);
    return $result;
  }

  public function setCandidateJobSchedule($candidate_job_id, $data){
    $update_data = array(
      'cj_isScheduled' => 1,
      'cj_schedule_details' => $data['schedule_details'] ? json_encode($data['schedule_details']) : '',
      'cj_date_modified' => date('Y-m-d H:i:s')
    );
    $this->db->where('candidate_job_id', $candidate_job_id);
    $result = $this->db->update('candidate_jobs', $update_data);
    return $result;
  }

  public function setCandidateJobComplete($candidate_job_id, $data){
    $update_data = array(
      'cj_isCompleted' => 1,
      'cj_schedule_details' => $data['scheduled_details'] ? json_encode($data['scheduled_details']) : '',
      'cj_date_modified' => date('Y-m-d H:i:s')
    );
    $this->db->where('candidate_job_id', $candidate_job_id);
    $result = $this->db->update('candidate_jobs', $update_data);
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

      if(isset($data['pipelined'])){
        $update_data['cj_isPipelined'] = $data['pipelined'];
      }

      if(isset($data['archived'])){
        $update_data['cj_isArchived'] = $data['archived'];
      }

      if(isset($data['removed'])){
        $update_data['cj_isRemoved'] = $data['removed'];
      }

      $update_data['cj_date_modified'] = date('Y-m-d H:i:s');

      $this->db->where('candidate_job_id', $candidate_job_id);
      $result = $this->db->update('candidate_jobs', $update_data);
      return $result;
    } else {
      return false;
    }

  }

  public function removeJob($job_id){
      $this->db->where('job_id', $job_id);
      $result = $this->db->update('jobs', array('status' => 0));
      return $result;
  }

  public function deleteJob($job_id){
      $this->db->where('job_id', $job_id);
      $result = $this->db->delete('jobs');
      return $result;
  }

  //Candidate Job Filter
    public function getCandidateFilters($job_id){
        $this->db->where(array('job_id' => $job_id, 'type' => CANDIDATE_TYPE));
        $query = $this->db->get('job_filter');
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return false;
        }
    }

    public function getCandidateFilter($job_id, $keyword, $filter_id){
        $filter_data = array(
            'job_id' => $job_id,
            'filter_keyword' => $keyword,
            'filter_id' => $filter_id,
            'type' => CANDIDATE_TYPE
        );
        $this->db->where($filter_data);
        $query = $this->db->get('job_filter');
        if($query->num_rows() > 0){
            return $query->row();
        } else {
            return false;
        }
    }

    public function addCandidateFilter($job_id, $keyword, $filter_id){
        $insert_data = array(
            'job_id' => $job_id,
            'filter_keyword' => $keyword,
            'filter_id' => $filter_id,
            'type' => CANDIDATE_TYPE
        );

        $query = $this->db->insert('job_filter', $insert_data);
        return $this->db->insert_id();
    }

    public function updateCandidateFilter($job_filter_id, $keyword, $filter_id){
        $update_data = array(
            'filter_keyword' => $keyword,
            'filter_id' => $filter_id
        );
        $this->db->where('job_filter_id', $job_filter_id);
        $result = $this->db->update('job_filter', $update_data);
        return $result;
    }

    public function deleteCandidateFilter($job_id){
        $this->db->where(array('job_id' => $job_id, 'type' => CANDIDATE_TYPE));
        $result = $this->db->delete('job_filter');
        return $result;
    }
}
