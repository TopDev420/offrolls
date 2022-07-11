<?php class Freelancer_jobs_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        //Company Categories
        $this->load->helper('category');
    }

    public function getJobs($company_id, $data = array())
    {
        $this->db->select('cfj.*');
        $this->db->from('company_freelancer_jobs AS cfj');

        //Filter Condition
        $condition = array();
        $condition['cfj.company_id'] = $company_id;
        if (isset($data['status'])) {
            $condition['cfj.status'] = $data['status'];
        }
        if (isset($data['remove'])) {
            $condition['cfj.remove'] = $data['remove'];
        }
        if ($condition) {
            $this->db->where($condition);
        }

        //Filter Date From
        if (isset($data['filter_date_from'])) {
            if ($data['filter_date_from']) {
                $this->db->where('DATE(cfj.date_added) >=', $data['filter_date_from']);
            }
        }

        //Filter Date To
        if (isset($data['filter_date_to'])) {
            if ($data['filter_date_to']) {
                $this->db->where('DATE(cfj.date_added) <=', $data['filter_date_to']);
            }
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
            $sort = 'cfj.job_id';
        }

        if (isset($data['order'])) {
            $order = $data['order'];
        } else {
            $order = 'DESC';
        }

        $this->db->order_by($sort, $order);
        $query = $this->db->get()->result();
        return $query;
    }

    public function getTotalJobs($company_id, $data = array())
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('company_freelancer_jobs AS cfj');

        $condition['cfj.company_id'] = $company_id;
        if (isset($data['status'])) {
            $condition['cfj.status'] = $data['status'];
        }
        if (isset($data['remove'])) {
            $condition['cfj.remove'] = $data['remove'];
        }
        if ($condition) {
            $this->db->where($condition);
        }

        //Filter Date From
        if (isset($data['filter_date_from'])) {
            if ($data['filter_date_from']) {
                $this->db->where('DATE(cfj.date_added) >=', $data['filter_date_from']);
            }
        }

        //Filter Date To
        if (isset($data['filter_date_to'])) {
            if ($data['filter_date_to']) {
                $this->db->where('DATE(cfj.date_added) <=', $data['filter_date_to']);
            }
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->total;
        } else {
            return false;
        }
    }

    public function getJob($job_id, $data = array())
    {
        $this->db->select('cfj.*');
        $this->db->from('company_freelancer_jobs AS cfj');

        $condition['cfj.job_id'] = $job_id;
        if (isset($data['status'])) {
            $condition['cfj.status'] = $data['status'];
        }
        if (isset($data['remove'])) {
            $condition['cfj.remove'] = $data['remove'];
        }
        if ($condition) {
            $this->db->where($condition);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getJobQualifications($job_id, $data = array())
    {
        $this->db->select('job_qualification.*');

        $condition['job_id'] = $job_id;

        if ($condition) {
            $this->db->where($condition);
        }

        $query = $this->db->get('job_qualification');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addJob($company_id)
    {
        $experience = ($this->input->post('experience_level') == 'experienced') ? $this->input->post('experience') : 0;
        $data = array(
            'company_id' => $company_id,
            'title' => $this->input->post('job_title'),
            'description' => $this->input->post('job_description'),
            'job_category' => $this->input->post('job_category'),
            'job_specialization' => $this->input->post('job_specialization'),
            'job_type' => $this->input->post('job_type'),
            'job_duration' => $this->input->post('job_duration'),
            'job_time_period' => $this->input->post('job_time_period'),
            'experience_level' => $this->input->post('experience_level'),
            'experience' => $experience,
            'skills' => $this->input->post('job_skills') ? json_encode($this->input->post('job_skills')) : '',
            'location' => $this->input->post('location'),
            'languages' => $this->input->post('job_language') ? json_encode($this->input->post('job_language')) : '',
            'pay_type' => $this->input->post('pay_type'),
            'pay_amount' => $this->input->post('pay_amount'),
            'status' => 0,
            'date_added' => date('Y-m-d H:i:s')
        );

        $this->db->insert('company_freelancer_jobs', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }

    /*public function addJobQualifications($job_id, $data){
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

	}*/

    public function setJobPublish($job_id, $publish)
    {
        $update_data = array(
            'status' => $publish,
            'date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('job_id', $job_id);
        $result = $this->db->update('company_freelancer_jobs', $update_data);
        return $result;
    }

    public function editJob($job_id, $data = array())
    {
        $experience = ($this->input->post('experience_level') == 'experienced') ? $this->input->post('experience') : 0;
        $data = array(
            'company_id' => $data['company_id'],
            'title' => $this->input->post('job_title'),
            'description' => $this->input->post('job_description'),
            'job_category' => $this->input->post('job_category'),
            'job_specialization' => $this->input->post('job_specialization'),
            'job_type' => $this->input->post('job_type'),
            'job_duration' => $this->input->post('job_duration'),
            'job_time_period' => $this->input->post('job_time_period'),
            'experience_level' => $this->input->post('experience_level'),
            'experience' => $experience,
            'skills' => $this->input->post('job_skills') ? json_encode($this->input->post('job_skills')) : '',
            'location' => $this->input->post('location'),
            'languages' => $this->input->post('job_language') ? json_encode($this->input->post('job_language')) : '',
            'pay_type' => $this->input->post('pay_type'),
            'pay_amount' => $this->input->post('pay_amount'),
            'status' => 0,
            'date_added' => date('Y-m-d H:i:s')
        );

        $this->db->where('job_id', $job_id);
        $result = $this->db->update('company_freelancer_jobs', $data);
        return $result;
    }

    /*public function editJobQualifications($job_id, $data){
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
	}*/

    //freelancer
    public function getFreelancers($data = array())
    {
        $this->db->select('f.*, CONCAT(u.first_name, " ", u.last_name) AS freelancer_name, u.user_id, u.user_id, u.image As freelancer_image');
        $this->db->from('freelancer AS f');
        $this->db->join('user AS u', 'u.user_id = f.user_id');

        //Filter Condition
        $condition = array();
        $condition['f.status'] = 1;

        //Candidate Filters
        if (isset($data['freelancer_filter'])) {
            if ($data['freelancer_filter'] == 'join') {
                $this->db->join('freelancer_filter AS ffs', 'ffs.candidate_id = f.candidate_id');

                //Filter Skills
                if (isset($data['filter_skills'])) {
                    if ($data['filter_skills']) {
                        $this->db->where('ffs.filter_keyword', 'filter_skill');
                        $this->db->where_in('ffs.filter_id', $data['filter_skills']);
                    }
                }

                //Filter Job Types
                if (isset($data['filter_jobtypes'])) {
                    if ($data['filter_jobtypes']) {
                        $this->db->where('ffs.filter_keyword', 'filter_jobtype');
                        $this->db->where_in('ffs.filter_id', $data['filter_jobtypes']);
                    }
                }

                //Filter Qualifications
                if (isset($data['filter_qualifications'])) {
                    if ($data['filter_qualifications']) {
                        $this->db->where('ffs.filter_keyword', 'filter_qualification');
                        $this->db->where_in('ffs.filter_id', $data['filter_qualifications']);
                    }
                }
            }
        }

        //Filter Location
        if (isset($data['filter_location'])) {
            if ($data['filter_location']) {
                $this->db->where('LOWER(f.city)', strtolower($data['filter_location']));
            }
        }

        //Filter Gender
        if (isset($data['filter_gender'])) {
            if ($data['filter_gender']) {
                $this->db->where('f.gender', $data['filter_gender']);
            }
        }

        //Filter Experience
        if (isset($data['filter_experience'])) {
            if ($data['filter_experience']) {
                $this->db->where('f.experience', $data['filter_experience']);
            }
        }

        //Limit
        if (isset($data['limit']) && isset($data['start'])) {

            if ($data['limit']) {
                $limit = $data['limit'];
            }

            if ($data['start']) {
                $start = $data['start'];
            }

            $this->db->limit($limit, $start);
        }

        //Sort
        if (isset($data['sort'])) {
            $sort = $data['sort'];
        } else {
            $sort = 'cj.candidate_job_id';
        }

        if (isset($data['order'])) {
            $order = $data['order'];
        } else {
            $order = 'DESC';
        }


        $this->db->order_by($sort, $order);
        $result = $this->db->get()->result();

        return $result;
    }

    public function getFreelancerJobs($company_id, $data = array())
    {
        $this->db->select('cj.*, CONCAT(u.first_name, " ", u.last_name) AS freelancer_name, u.user_id, u.image As freelancer_image, j.title, j.location');
        $this->db->from('company_freelancer_jobs AS j');
        $this->db->join('freelancer_jobs AS cj', 'cj.job_id = j.job_id');
        $this->db->join('freelancer AS f', 'f.freelancer_id = cj.freelancer_id');
        $this->db->join('user AS u', 'u.user_id = f.user_id');

        //Filter Condition
        $condition = array();
        $condition['j.company_id'] = $company_id;
        $condition['j.status'] = 1;
        $condition['j.remove'] = 0;

        if (isset($data['job_id'])) {
            $condition['cj.job_id'] = $data['job_id'];
        }

        if (isset($data['applied'])) {
            $condition['cj.cj_isApplied'] = $data['applied'];
        }

        if (isset($data['accepted'])) {
            $condition['cj.cj_isAccepted'] = $data['accepted'];
        }

        if (isset($data['saved'])) {
            $condition['cj.cj_isSaved'] = $data['saved'];
        }

        if (isset($data['completed'])) {
            $condition['cj.cj_isCompleted'] = $data['completed'];
        }

        if (isset($data['removed'])) {
            $condition['cj.cj_isRemoved'] = $data['removed'];
        }

        if ($condition) {
            $this->db->where($condition);
        }

        //Freelancer Filters
        if (isset($data['freelancer_filter'])) {
            if ($data['freelancer_filter'] == 'join') {
                $this->db->join('freelancer_filter AS ffs', 'ffs.freelancer_id = f.freelancer_id');

                //Filter Skills
                if (isset($data['filter_skills'])) {
                    if ($data['filter_skills']) {
                        $this->db->where('ffs.filter_keyword', 'filter_skill');
                        $this->db->where_in('ffs.filter_id', $data['filter_skills']);
                    }
                }

                //Filter language
                if (isset($data['filter_language'])) {
                    if ($data['filter_language']) {
                        $this->db->where('ffs.filter_keyword', 'filter_language');
                        $this->db->where_in('ffs.filter_id', $data['filter_language']);
                    }
                }
            }
        }

        //Filter Location
        if (isset($data['filter_location'])) {
            if ($data['filter_location']) {
                $this->db->where('LOWER(f.city)', strtolower($data['filter_location']));
            }
        }

        //Filter Experience
        if (isset($data['filter_experience'])) {
            if ($data['filter_experience']) {
                $this->db->where('f.experience', $data['filter_experience']);
            }
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
            $sort = 'cj.freelancer_job_id';
        }

        if (isset($data['order'])) {
            $order = $data['order'];
        } else {
            $order = 'DESC';
        }

        //echo $this->db->last_query();
        $this->db->order_by($sort, $order);
        $result = $this->db->get()->result();

        return $result;
    }

    public function getTotalFreelancerJobs($company_id, $data = array())
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('company_freelancer_jobs AS j');
        $this->db->join('freelancer_jobs AS cj', 'cj.job_id = j.job_id');
        $this->db->join('freelancer AS f', 'f.freelancer_id = cj.freelancer_id');
        $this->db->join('user AS u', 'u.user_id = f.user_id');

        //Filter Condition
        $condition = array();
        $condition['j.company_id'] = $company_id;
        $condition['j.status'] = 1;
        $condition['j.remove'] = 0;

        if (isset($data['job_id'])) {
            $condition['cj.job_id'] = $data['job_id'];
        }
        if (isset($data['applied'])) {
            $condition['cj.cj_isApplied'] = $data['applied'];
        }

        if (isset($data['accepted'])) {
            $condition['cj.cj_isAccepted'] = $data['accepted'];
        }

        if (isset($data['saved'])) {
            $condition['cj.cj_isSaved'] = $data['saved'];
        }

        if (isset($data['completed'])) {
            $condition['cj.cj_isCompleted'] = $data['completed'];
        }

        if (isset($data['removed'])) {
            $condition['cj.cj_isRemoved'] = $data['removed'];
        }

        if ($condition) {
            $this->db->where($condition);
        }

        //Freelancer Filters
        if (isset($data['freelancer_filter'])) {
            if ($data['freelancer_filter'] == 'join') {
                $this->db->join('freelancer_filter AS ffs', 'ffs.freelancer_id = f.freelancer_id');

                //Filter Skills
                if (isset($data['filter_skills'])) {
                    if ($data['filter_skills']) {
                        $this->db->where('ffs.filter_keyword', 'filter_skill');
                        $this->db->where_in('ffs.filter_id', $data['filter_skills']);
                    }
                }

                //Filter language
                if (isset($data['filter_language'])) {
                    if ($data['filter_language']) {
                        $this->db->where('ffs.filter_keyword', 'filter_language');
                        $this->db->where_in('ffs.filter_id', $data['filter_language']);
                    }
                }
            }
        }

        //Filter Location
        if (isset($data['filter_location'])) {
            if ($data['filter_location']) {
                $this->db->where('LOWER(f.city)', strtolower($data['filter_location']));
            }
        }

        //Filter Experience
        if (isset($data['filter_experience'])) {
            if ($data['filter_experience']) {
                $this->db->where('f.experience', $data['filter_experience']);
            }
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->total;
        } else {
            return false;
        }
    }

    public function getFreelancerJobsByCJ($company_id, $job_id, $data = array())
    {
        $this->db->select('cj.*, CONCAT(u.first_name, " ", u.last_name) AS freelancer_name, u.image As freelancer_image, j.title, j.location, j.job_type, j.job_duration');
        $this->db->from('freelancer_jobs AS cj');
        $this->db->join('company_freelancer_jobs AS j', 'cj.job_id = j.job_id');
        $this->db->join('freelancer AS c', 'c.freelancer_id = cj.freelancer_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

        //Filter Condition
        $condition = array();
        $condition['j.company_id'] = $company_id;
        $condition['j.job_id'] = $job_id;
        $condition['j.status'] = 1;
        $condition['j.remove'] = 0;
        if (isset($data['applied'])) {
            $condition['cj.cj_isApplied'] = $data['applied'];
        }

        if (isset($data['accepted'])) {
            $condition['cj.cj_isAccepted'] = $data['accepted'];
        }

        if (isset($data['saved'])) {
            $condition['cj.cj_isSaved'] = $data['saved'];
        }

        if (isset($data['completed'])) {
            $condition['cj.cj_isCompleted'] = $data['completed'];
        }

        if ($condition) {
            $this->db->where($condition);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getFreelancerJobByCJ($company_id, $job_id, $data = array())
    {
        $this->db->select('cj.*, CONCAT(u.first_name, " ", u.last_name) AS freelancer_name, u.image As freelancer_image, j.title, j.location, j.job_type, j.job_duration, u.user_id');
        $this->db->from('freelancer_jobs AS cj');
        $this->db->join('company_freelancer_jobs AS j', 'cj.job_id = j.job_id');
        $this->db->join('freelancer AS c', 'c.freelancer_id = cj.freelancer_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

        //Filter Condition
        $condition = array();
        $condition['j.company_id'] = $company_id;
        $condition['j.job_id'] = $job_id;
        $condition['j.status'] = 1;
        $condition['j.remove'] = 0;
        if (isset($data['applied'])) {
            $condition['cj.cj_isApplied'] = $data['applied'];
        }

        if (isset($data['accepted'])) {
            $condition['cj.cj_isAccepted'] = $data['accepted'];
        }

        if (isset($data['saved'])) {
            $condition['cj.cj_isSaved'] = $data['saved'];
        }

        if (isset($data['completed'])) {
            $condition['cj.cj_isCompleted'] = $data['completed'];
        }

        if ($condition) {
            $this->db->where($condition);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getFreelancerJob($freelancer_job_id, $data = array())
    {
        $this->db->select('cj.*, CONCAT(u.first_name, " ",u.last_name) AS freelancer_name, u.image As freelancer_image, u.user_id, j.title, j.location, j.job_type, j.job_duration');
        $this->db->from('freelancer_jobs AS cj');
        $this->db->join('company_freelancer_jobs AS j', 'cj.job_id = j.job_id');
        $this->db->join('freelancer AS c', 'c.freelancer_id = cj.freelancer_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

        //Filter Condition
        $condition = array();
        $condition['cj.freelancer_job_id'] = $freelancer_job_id;
        $condition['j.status'] = 1;
        $condition['j.remove'] = 0;
        if (isset($data['applied'])) {
            $condition['cj.cj_isApplied'] = $data['applied'];
        }

        if (isset($data['accepted'])) {
            $condition['cj.cj_isAccepted'] = $data['accepted'];
        }

        if (isset($data['saved'])) {
            $condition['cj.cj_isSaved'] = $data['saved'];
        }

        if (isset($data['completed'])) {
            $condition['cj.cj_isCompleted'] = $data['completed'];
        }

        if ($condition) {
            $this->db->where($condition);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getFreelancerJobDetails($job_id)
    {
        $this->db->where('job_id', $job_id);
        $query = $this->db->get('freelancer_jobs');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function setFreelancerJobShortlist($freelancer_job_id)
    {
        $update_data = array(
            'cj_isShortlisted' => 1,
            'cj_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_id', $freelancer_job_id);
        $result = $this->db->update('freelancer_jobs', $update_data);
        return $result;
    }

    public function setFreelancerJobSchedule($freelancer_job_id, $data)
    {
        $update_data = array(
            'cj_isScheduled' => 1,
            'cj_schedule_details' => $data['schedule_details'] ? json_encode($data['schedule_details']) : '',
            'cj_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_id', $freelancer_job_id);
        $result = $this->db->update('freelancer_jobs', $update_data);
        return $result;
    }

    public function setFreelancerJobActivity($freelancer_job_id, $data)
    {
        if ($data) {
            if (isset($data['shortlisted'])) {
                $update_data['cj_isShortlisted'] = $data['shortlisted'];
            }
            if (isset($data['accepted'])) {
                $update_data['cj_isAccepted'] = $data['accepted'];
            }

            if (isset($data['applied'])) {
                $update_data['cj_isApplied'] = $data['applied'];
            }

            if (isset($data['saved'])) {
                $update_data['cj_isSaved'] = $data['saved'];
            }

            if (isset($data['completed'])) {
                $update_data['cj_isCompleted'] = $data['completed'];
            }

            if (isset($data['removed'])) {
                $update_data['cj_isRemoved'] = $data['removed'];
            }

            $update_data['cj_date_modified'] = date('Y-m-d H:i:s');

            $this->db->where('freelancer_job_id', $freelancer_job_id);
            $result = $this->db->update('freelancer_jobs', $update_data);
            return $result;
        } else {
            return false;
        }
    }

    public function removeJob($job_id)
    {
        $this->db->where('job_id', $job_id);
        $result = $this->db->update('company_freelancer_jobs', array('status' => 0));
        return $result;
    }

    public function deleteJob($job_id)
    {
        $this->db->where('job_id', $job_id);
        $result = $this->db->update('company_freelancer_jobs', array('remove' => 1));
        return $result;
    }

    //freelancer Job Filter
    public function getFreelancerFilters($job_id)
    {
        $this->db->where(array('job_id' => $job_id, 'type' => FREELANCER_TYPE));
        $query = $this->db->get('job_filter');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getFreelancerFilter($job_id, $keyword, $filter_id)
    {
        $filter_data = array(
            'job_id' => $job_id,
            'filter_keyword' => $keyword,
            'filter_id' => $filter_id,
            'type' => FREELANCER_TYPE
        );
        $this->db->where($filter_data);
        $query = $this->db->get('job_filter');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function addFreelancerFilter($job_id, $keyword, $filter_id)
    {
        $insert_data = array(
            'job_id' => $job_id,
            'filter_keyword' => $keyword,
            'filter_id' => $filter_id,
            'type' => FREELANCER_TYPE
        );

        $query = $this->db->insert('job_filter', $insert_data);
        return $this->db->insert_id();
    }

    public function updateFreelancerFilter($job_filter_id, $keyword, $filter_id)
    {
        $update_data = array(
            'filter_keyword' => $keyword,
            'filter_id' => $filter_id
        );
        $this->db->where('job_filter_id', $job_filter_id);
        $result = $this->db->update('job_filter', $update_data);
        return $result;
    }

    public function deleteFreelancerFilter($job_id)
    {
        $this->db->where(array('job_id' => $job_id, 'type' => FREELANCER_TYPE));
        $result = $this->db->delete('job_filter');
        return $result;
    }

    public function publish_post($data)
    {
        $this->db->set('status', 1);
        $this->db->where('job_id', $data['job_id']);
        return $this->db->update('company_freelancer_jobs');
    }


    //Milestones
    public function getJobMilestones($freelancer_job_id, $data = array())
    {
        $this->db->where('freelancer_job_id', $freelancer_job_id);
        $query = $this->db->get('freelancer_milestones');

        $condition = array();
        if (isset($data['accept'])) {
            $condition['cjm_isAccepted'] = $data['accept'];
        }

        if (isset($data['reject'])) {
            $condition['cjm_isRejected'] = $data['reject'];
        }

        if (isset($data['approve'])) {
            $condition['cjm_isApproved'] = $data['approve'];
        }

        if (isset($data['complete'])) {
            $condition['cjm_isCompleted'] = $data['complete'];
        }

        if (isset($data['close'])) {
            $condition['cjm_isClosed'] = $data['close'];
        }

        if ($condition) {
            $this->db->where($condition);
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getJobMilestone($freelancer_job_milestone_id, $data = array())
    {
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $query = $this->db->get('freelancer_milestones');

        $condition = array();
        if (isset($data['accept'])) {
            $condition['cjm_isAccepted'] = $data['accept'];
        }

        if (isset($data['reject'])) {
            $condition['cjm_isRejected'] = $data['reject'];
        }

        if (isset($data['approve'])) {
            $condition['cjm_isApproved'] = $data['approve'];
        }

        if (isset($data['complete'])) {
            $condition['cjm_isCompleted'] = $data['complete'];
        }

        if (isset($data['close'])) {
            $condition['cjm_isClosed'] = $data['close'];
        }

        if ($condition) {
            $this->db->where($condition);
        }

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function addJobMilestone($freelancer_job_id, $data)
    {
        $milestone_data = array(
            'freelancer_job_id' => $freelancer_job_id,
            'cjm_initiator' => $data['initiator'],
            'cjm_amount' => $data['amount'],
            'cjm_description' => $data['description'],
            'cjm_duration' => $data['duration'],
            'cjm_requirements' => $data['requirements'],
            'cjm_status' => $data['status'],
            'cjm_date_added' => date('Y-m-d H:i:s')
        );

        $result = $this->db->insert('freelancer_milestones', $milestone_data);
        return $this->db->insert_id();
    }

    public function editJobMilestone($freelancer_job_milestone_id, $data)
    {
        $milestone_data = array(
            'cjm_amount' => $data['amount'],
            'cjm_description' => $data['description'],
            'cjm_duration' => $data['duration'],
            'cjm_requirements' => $data['requirements'],
            'cjm_status' => $data['status'],
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function editJobMilestoneStatus($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_status' => $status,
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function acceptJobMilestone($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isAccepted' => $status,
            'cjm_isRejected' => 0,
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function rejectJobMilestone($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isAccepted' => 0,
            'cjm_isRejected' => $status,
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function approveJobMilestone($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isAccepted' => 1,
            'cjm_isApproved' => $status,
            'cjm_start_date' => date('y-m-d'),
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function completeJobMilestone($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isCompleted' => $status,
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function releaseJobMilestonePay($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isPayReleased' => $status,
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $condition = array(
            'freelancer_job_milestone_id' => $freelancer_job_milestone_id,
            'cjm_isAccepted' => 1,
            'cjm_isApproved' => 1,
            'cjm_isCompleted' => 1,
        );
        $this->db->where($condition);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function closeJobMilestone($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isClosed' => $status,
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function deleteJobMilestone($freelancer_job_milestone_id)
    {
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->delete('freelancer_milestones');
        return $result;
    }


    //Payment
    public function getMilestonePayment($milestone_payment_id)
    {
        $this->db->where('milestone_payment_id', $milestone_payment_id);
        $query = $this->db->get('freelancer_milestones_payment');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getMilestonePaymentByMP($freelancer_job_milestone_id, $payer)
    {
        $condition = array(
            'milestone_id' => $freelancer_job_milestone_id,
            'payer' => 'CMP'
        );
        $this->db->where($condition);
        $query = $this->db->get('freelancer_milestones_payment');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function addMilestonePayment($data)
    {
        $milestone_data = array(
            'milestone_id' => $data['milestone_id'],
            'payer' => $data['payer'],
            'amount' => $data['amount'],
            'service_fee' => $data['service_fee'],
            'service_fee_type' => $data['service_fee_type'],
            'service_amount' => $data['service_amount'],
            'total' => $data['total'],
            'date_added' => date('Y-m-d H:i:s')
        );
        $this->db->insert('freelancer_milestones_payment', $milestone_data);
        return $this->db->insert_id();
    }

    public function editMilestonePayment($milestone_payment_id, $data)
    {
        $milestone_data = array(
            'amount' => $data['amount'],
            'service_fee' => $data['service_fee'],
            'service_fee_type' => $data['service_fee_type'],
            'service_amount' => $data['service_amount'],
            'total' => $data['total'],
            'date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('milestone_payment_id', $milestone_payment_id);
        $this->db->update('freelancer_milestones_payment', $milestone_data);
        return $milestone_payment_id;
    }

    public function setMilestonePayment($milestone_payment_id, $data)
    {
        $milestone_data = array(
            'message' => $data['message'],
            'status' => $data['status'],
            'payment_id' => $data['payment_id'],
            'instrument_type' => $data['instrument_type'],
            'billing_instrument' => $data['billing_instrument'],
        );
        $this->db->where('milestone_payment_id', $milestone_payment_id);
        $result = $this->db->update('freelancer_milestones_payment', $milestone_data);
        return $result;
    }

    public function setMilestonePaymentNotify($milestone_payment_id, $status)
    {
        $milestone_data = array(
            'is_payNotify' => $status,
            'date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('milestone_payment_id', $milestone_payment_id);
        $result = $this->db->update('freelancer_milestones_payment', $milestone_data);
        return $result;
    }

    // Feedback & Rating
    public function addFreelancerFeedback($data)
    {
        $feedback_data = array(
            'freelancer_id' => $data['freelancer_id'],
            'company_id' => $data['company_id'],
            'job_id' => $data['job_id'],
            'rating_points' => $data['rating_points'],
            'feedback_content' => $data['feedback_content'],
            'date_added' => date('Y-m-d H:i:s')
        );
        $this->db->insert('freelancer_feedback', $feedback_data);
        return $this->db->insert_id();
    }
}
