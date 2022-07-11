<?php
class Experience_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getExperiences($candidate_id) {
        $this->db->select('candidate_experience.*');
        $this->db->from('candidate_experience');

        //Filter Condition
    	$condition = array();
		$condition['candidate_id'] = $candidate_id;
		if($condition){
			$this->db->where($condition);
		}

		//Sort
		if(isset($data['sort'])){
			$sort = $data['sort'];
		} else {
			$sort = 'candidate_experience_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return false;
        }
	}

	public function getExperience($experience_id, $data=array()) {
		$this->db->select('candidate_experience.*');
        $this->db->from('candidate_experience');

		//Filter Condition
		$condition = array();
		$condition['candidate_experience_id'] = $experience_id;
		if(isset($data['candidate_id'])){
			$condition['candidate_id'] = $data['candidate_id'];
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

	public function addExperience($candidate_id, $data=array()){
        $current_company = $this->input->post('experience_current_company');
        if($current_company == 1){
            $experience_end_date = '';
        } else {
            $experience_end_date = json_encode($this->input->post('experience_end_date'));
        }
		$insert_data = array(
			'candidate_id' => $candidate_id,
			'cwe_job_title' => $this->input->post('experience_job_title'),
			'cwe_company_name' => $this->input->post('experience_company_name'),
			'cwe_current_company' => $this->input->post('experience_current_company'),
			'cwe_start_date' => json_encode($this->input->post('experience_start_date')),
			'cwe_end_date' => $experience_end_date,
			'cwe_date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('candidate_experience', $insert_data);
		return $this->db->insert_id();
	}

	public function editExperience($experience_id, $data=array()){
        $current_company = $this->input->post('experience_current_company');
        if($current_company == 1){
            $experience_end_date = '';
        } else {
            $experience_end_date = json_encode($this->input->post('experience_end_date'));
        }
		$update_data = array(
			'cwe_job_title' => $this->input->post('experience_job_title'),
			'cwe_company_name' => $this->input->post('experience_company_name'),
			'cwe_current_company' => $this->input->post('experience_current_company'),
			'cwe_start_date' => json_encode($this->input->post('experience_start_date')),
    		'cwe_end_date' => $experience_end_date,
			'cwe_date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('candidate_experience_id', $experience_id);
		$result = $this->db->update('candidate_experience', $update_data);
		return $result;
	}

    public function setExperience($experience_id, $experience){
        $update_data = array(
            'cwe_experience' => $experience
        );

        $this->db->where('candidate_experience_id', $experience_id);
		$result = $this->db->update('candidate_experience', $update_data);
		return $result;
	}

	public function deleteExperience($experience_id, $data=array()){
		$condition_data = array(
			'candidate_experience_id' => $experience_id,
		);

		$result = $this->db->delete('candidate_experience', $condition_data);
		return $result;
	}

	public function dbdate_format($date){
		$rdate = str_replace('/', '-', $date);
		$gdate = strtotime($rdate);
		return date('Y-m-d', $gdate);
	}
}

