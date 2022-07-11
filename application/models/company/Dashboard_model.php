<?php
    class Dashboard_model extends CI_Model {

        public function __construct() {
            parent::__construct();
            $this->load->helper('string');
    	}

        public function getTotalCandidateJobs($company_id, $data=array()) {
            $this->db->distinct();
            $this->db->select('COUNT(*) AS total');
            $this->db->from('jobs AS j');
            $this->db->join('company AS c', 'j.company_id = c.company_id');
            $this->db->join('user AS u', 'u.user_id = c.user_id');

           //For Search Query
            if(isset($data['candidate_jobs'])){
                if($data['candidate_jobs']){
                    $this->db->join('candidate_jobs AS cj', 'j.job_id = cj.job_id');

                    if(isset($data['applied'])) {
                        $condition['cj.cj_isApplied'] = $data['applied'];
            		}

            		if(isset($data['saved'])) {
            			$condition['cj.cj_isSaved'] = $data['saved'];
            		}

            		if(isset($data['month'])) {
            		    $condition['MONTH(cj.cj_date_added)'] =  $data['month'];
            		}

            		if(isset($data['year'])) {
            	        $condition['YEAR(cj.cj_date_added)'] = $data['year'];
            		}

                }
            }

            $condition['j.status'] = 1;
            $condition['j.company_id'] = $company_id;

    		if($condition){
    			$this->db->where($condition);
    		}

            $query = $this->db->get();
            if($query->num_rows() > 0){
                $row = $query->row();
                return $row->total;
            } else {
                return false;
            }
        }

        public function getTotalFreelancerJobs($company_id, $data=array()) {
            $this->db->distinct();
            $this->db->select('COUNT(*) AS total');
            $this->db->from('company_freelancer_jobs AS j');
            $this->db->join('company AS c', 'j.company_id = c.company_id');
            $this->db->join('user AS u', 'u.user_id = c.user_id');

           //For Search Query
            if(isset($data['freelancer_jobs'])){
                if($data['freelancer_jobs']){
                    $this->db->join('freelancer_jobs AS cj', 'j.job_id = cj.job_id');

                    if(isset($data['applied'])) {
                        $condition['cj.cj_isApplied'] = $data['applied'];
                	}

            		if(isset($data['accepted'])) {
            			$condition['cj.cj_isAccepted'] = $data['accepted'];
            		}

            		if(isset($data['month'])) {
            		    $condition['MONTH(cj.cj_date_added)'] =  $data['month'];
            		}

            		if(isset($data['year'])) {
            	        $condition['YEAR(cj.cj_date_added)'] = $data['year'];
            		}

                }
            }

            $condition['j.status'] = 1;
            $condition['j.company_id'] = $company_id;

    		if($condition){
    			$this->db->where($condition);
    		}

            $query = $this->db->get();
            if($query->num_rows() > 0){
                $row = $query->row();
                return $row->total;
            } else {
                return false;
            }
        }


	    public function getJobPostsByMY($company_id, $month, $year, $data=array()){
	         $this->db->select('COUNT(*) AS total' );

	         $this->db->from('jobs AS j');
            $this->db->join('user AS c', 'j.company_id = c.user_id');

	        $this->db->where('j.company_id', $company_id);
	        $this->db->where('j.status', 1);
	        $this->db->where('MONTH(j.date_added)', $month);
	        $this->db->where('YEAR(j.date_added)', $year);
	        $query = $this->db->get();
	        if($query->num_rows() > 0){
	            $row = $query->row();
	            return $row->total;
	        } else {
	            return false;
	        }
	    }

	    public function getCandidatesByMY($company_id, $month, $year, $data = array()){
	        $this->db->select('COUNT(*) AS total' );

	        $this->db->from('jobs AS j');
	        $this->db->join('candidate_jobs AS cj', 'j.job_id = cj.job_id');
    		$this->db->join('user AS c', 'j.company_id = c.user_id');

    		//Filter Condition
    		$condition = array();
    		$condition['j.status'] = 1;

    		if(isset($data['applied'])) {
    			$condition['cj.cj_isApplied'] = $data['applied'];
    		}
    		if($condition){
    			$this->db->where($condition);
    		}

	        $this->db->where('j.company_id', $company_id);
	        $this->db->where('MONTH(cj.cj_date_added)', $month);
	        $this->db->where('YEAR(cj.cj_date_added)', $year);
	        $query = $this->db->get();
	        if($query->num_rows() > 0){
	            $row = $query->row();
	            return $row->total;
	        } else {
	            return false;
	        }
	    }
    }
