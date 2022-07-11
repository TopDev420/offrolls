<?php

class Dashboard_model extends CI_Model {
    public function getTotalCompanies($data = array()) {
        $this->db->select('COUNT(*) AS total');

        //Filter Condition
        $condition = array();
        if(isset($data['status'])){
			$condition['status'] = $data['status'];
		} else {
			$condition['status'] = 1;
		}

		if($condition){
			$this->db->where($condition);
		}

		$query = $this->db->get('company');
        if($query->num_rows() > 0) {
        	$row = $query->row();
        	return $row->total;
        } else {
        	return false;
        }
	}

	public function getTotalFreelancerJobs($freelancer_id, $data=array()) {
		$this->db->select('COUNT(*) AS total');
		$this->db->where('j.status', 1);
		$this->db->from('jobs AS j');
		$this->db->join('freelancer_jobs AS cj', 'j.job_id = cj.job_id');
		$this->db->join('user AS c', 'j.company_id = c.user_id');

		//Filter Condition
		$condition = array();
		$condition['j.status'] = 1;
        $condition['cj.freelancer_id'] = $freelancer_id;

		if(isset($data['applied'])) {
			$condition['cj.cj_isApplied'] = $data['applied'];
		}
		if($condition){
			$this->db->where($condition);
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

		if($condition){
			$this->db->where($condition);
		}

		$query = $this->db->get();
		$row = $query->row();
		return $row->total;
	}
}
