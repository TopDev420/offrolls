<?php
class Certification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
	}

	public function getCertifications($freelancer_id) {
		$this->db->select('freelancer_certification.*');
        $this->db->from('freelancer_certification');

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
			$sort = 'freelancer_certification_id';
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
		$this->db->select('freelancer_certification.*');
        $this->db->from('freelancer_certification');

		//Filter Condition
		$condition = array();
		$condition['freelancer_certification_id'] = $certification_id;
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

	public function addCertification($freelancer_id, $data=array()){
		$insert_data = array(
			'freelancer_id' => $freelancer_id,
			'cc_name' => $this->input->post('certification_name'),
			'cc_description' => $this->input->post('certification_description'),
			'cc_completion_year' => $this->input->post('certification_completion_year'),
			'cc_date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('freelancer_certification', $insert_data);
		return $this->db->insert_id();
	}

	public function editCertification($certification_id, $data=array()){
		$update_data = array(
			'cc_name' => $this->input->post('certification_name'),
			'cc_description' => $this->input->post('certification_description'),
			'cc_completion_year' => $this->input->post('certification_completion_year'),
			'cc_date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('freelancer_certification_id', $certification_id);
		$result = $this->db->update('freelancer_certification', $update_data);
		return $result;
	}

	public function deleteCertification($certification_id, $data=array()){
		$condition_data = array(
			'freelancer_certification_id' => $certification_id,
		);

		$result = $this->db->delete('freelancer_certification', $condition_data);
		return $result;
	}
}

