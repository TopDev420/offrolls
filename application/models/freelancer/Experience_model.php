<?php
class Experience_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getExperiences($freelancer_id) {
		$this->db->select('freelancer_experience.*');
        $this->db->from('freelancer_experience');

		//Filter Condition
		$condition = array();
		$condition['freelancer_id'] = $freelancer_id;
		if($condition){
			$this->db->where($condition);
		}

		//Sort
		if(isset($data['sort'])){
			$sort = $data['sort'];
		} else {
			$sort = 'freelancer_experience_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);
        return $query = $this->db->get()->result();
	}

	public function getExperience($experience_id, $data=array()) {
		$this->db->select('freelancer_experience.*');
        $this->db->from('freelancer_experience');

		//Filter Condition
		$condition = array();
		$condition['freelancer_experience_id'] = $experience_id;
		if(isset($data['freelancer_id'])){
			$condition['freelancer_id'] = $data['freelancer_id'];
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

	public function addExperience($freelancer_id, $data=array()){
        $current_company = $this->input->post('experience_current_company');
        if($current_company == 1){
            $experience_end_date = '';
        } else {
            $experience_end_date = json_encode($this->input->post('experience_end_date'));
        }
		$insert_data = array(
			'freelancer_id' => $freelancer_id,
			'cwe_job_title' => $this->input->post('experience_job_title'),
			'cwe_company_name' => $this->input->post('experience_company_name'),
			'cwe_current_company' => $this->input->post('experience_current_company'),
			'cwe_start_date' => json_encode($this->input->post('experience_start_date')),
    		'cwe_end_date' => $experience_end_date,
			'cwe_date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('freelancer_experience', $insert_data);
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
		$this->db->where('freelancer_experience_id', $experience_id);
		$result = $this->db->update('freelancer_experience', $update_data);
		return $result;
	}

	public function deleteExperience($experience_id, $data=array()){
		$condition_data = array(
			'freelancer_experience_id' => $experience_id,
		);

		$result = $this->db->delete('freelancer_experience', $condition_data);
		return $result;
	}

	public function dbdate_format($date){
		$rdate = str_replace('/', '-', $date);
		$gdate = strtotime($rdate);
		return date('Y-m-d', $gdate);
	}
}

