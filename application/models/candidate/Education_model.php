<?php
class Education_model extends CI_Model {

    public function __construct() {
        parent::__construct();
	}

	public function getEducations($candidate_id) {
		$this->db->select('ce.*, jc.name AS ce_qualification_name');
        $this->db->from('candidate_education AS ce');
        $this->db->join('job_category AS jc', 'ce.ce_qualification=jc.category_id');

		//Filter Condition
		$condition = array();
		$condition['ce.candidate_id'] = $candidate_id;
		if($condition){
			$this->db->where($condition);
		}

		//Sort
		if(isset($data['sort'])){
			$sort = $data['sort'];
		} else {
			$sort = 'candidate_education_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);
        return $query = $this->db->get()->result();
	}

	public function getEducation($education_id, $data=array()) {
		$this->db->select('ce.*, jc.name AS ce_qualification_name');
        $this->db->from('candidate_education AS ce');
        $this->db->join('job_category AS jc', 'ce.ce_qualification=jc.category_id');

		//Filter Condition
		$condition = array();
		$condition['ce.candidate_education_id'] = $education_id;
		if(isset($data['candidate_id'])){
			$condition['ce.candidate_id'] = $data['candidate_id'];
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

	public function addEducation($candidate_id, $data=array()){
		$insert_data = array(
			'candidate_id' => $candidate_id,
			'ce_qualification' => $this->input->post('education_qualification'),
			'ce_specialization' => $this->input->post('education_specialization'),
			'ce_institute' => $this->input->post('education_institute'),
			'ce_location' => $this->input->post('education_location'),
			'ce_description' => $this->input->post('education_description'),
			'ce_course_type' => $this->input->post('education_course_type'),
			'ce_yop' => $this->input->post('education_yop'),
			'ce_date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('candidate_education', $insert_data);
		return $this->db->insert_id();
	}

	public function editEducation($education_id, $data=array()){
		$update_data = array(
			'ce_qualification' => $this->input->post('education_qualification'),
			'ce_specialization' => $this->input->post('education_specialization'),
			'ce_institute' => $this->input->post('education_institute'),
			'ce_location' => $this->input->post('education_location'),
			'ce_description' => $this->input->post('education_description'),
			'ce_course_type' => $this->input->post('education_course_type'),
			'ce_yop' => $this->input->post('education_yop'),
			'ce_date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('candidate_education_id', $education_id);
		$result = $this->db->update('candidate_education', $update_data);
		return $result;
	}

	public function deleteEducation($education_id, $data=array()){
		$condition_data = array(
			'candidate_education_id' => $education_id,
		);

		$result = $this->db->delete('candidate_education', $condition_data);
		return $result;
	}
}

