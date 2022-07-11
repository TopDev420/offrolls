<?php
class Candidate_jobtype_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getJobTypes($job_id) {
        $this->db->select('company_candidate_jobtype.*');
        $this->db->from('company_candidate_jobtype');

        //Filter Condition
        $condition = array();
    	$condition['job_id'] = $job_id;
		if($condition){
			$this->db->where($condition);
		}

		//Sort
		if(isset($data['sort'])){
			$sort = $data['sort'];
		} else {
			$sort = 'jobtype_duration_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);
        return $query = $this->db->get()->result();
	}

	public function getJobType($jobtype_duration_id, $data=array()) {
		$this->db->select('company_candidate_jobtype.*');
        $this->db->from('company_candidate_jobtype');

		//Filter Condition
		$condition = array();
		$condition['jobtype_duration_id'] = $jobtype_duration_id;
		if(isset($data['jobtype_duration_id'])){
			$condition['jobtype_duration_id'] = $data['jobtype_duration_id'];
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

	public function addJobType($job_id, $data=array()){
		$insert_data = array(
			'job_id' => $job_id,
			'cjt_id' => $data['job_type'],
			'cjt_duration' => $data['duration'],
			'cjt_period' => $data['period'],
			'cjt_date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('company_candidate_jobtype', $insert_data);
		return $this->db->insert_id();
	}


	public function deleteJobType($job_id, $data=array()){
		$condition_data = array(
			'job_id' => $job_id,
		);

		$result = $this->db->delete('company_candidate_jobtype', $condition_data);
		return $result;
	}
}

