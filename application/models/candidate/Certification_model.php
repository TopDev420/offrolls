<?php
class Certification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
	}

	public function getCertifications($candidate_id) {
		$this->db->select('candidate_certification.*');
        $this->db->from('candidate_certification');

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
			$sort = 'certification_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);
        return $query = $this->db->get()->result();
	}

	public function getCertification($certification_id, $data=array()) {
		$this->db->select('candidate_certification.*');
        $this->db->from('candidate_certification');

		//Filter Condition
		$condition = array();
		$condition['certification_id'] = $certification_id;
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

	public function addCertification($candidate_id, $data=array()){
		$insert_data = array(
			'candidate_id' => $candidate_id,
			'cc_name' => $this->input->post('certification_name'),
			'cc_description' => $this->input->post('certification_description'),
			'cc_completion_year' => $this->input->post('certification_completion_year'),
			'cc_date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('candidate_certification', $insert_data);
		return $this->db->insert_id();
	}

	public function editCertification($certification_id, $data=array()){
		$update_data = array(
			'cc_name' => $this->input->post('certification_name'),
			'cc_description' => $this->input->post('certification_description'),
			'cc_completion_year' => $this->input->post('certification_completion_year'),
			'cc_date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('certification_id', $certification_id);
		$result = $this->db->update('candidate_certification', $update_data);
		return $result;
	}

	public function deleteCertification($certification_id, $data=array()){
		$condition_data = array(
			'certification_id' => $certification_id,
		);

		$result = $this->db->delete('candidate_certification', $condition_data);
		return $result;
	}
}

