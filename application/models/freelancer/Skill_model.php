<?php
class Skill_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSkills($freelancer_id) {
		$this->db->select('freelancer_skills.*');
        $this->db->from('freelancer_skills');

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
			$sort = 'freelancer_skill_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);
        return $query = $this->db->get()->result();
	}

	public function getSkill($skill_id, $data=array()) {
		$this->db->select('freelancer_skills.*');
        $this->db->from('freelancer_skills');

		//Filter Condition
		$condition = array();
		$condition['freelancer_skill_id'] = $skill_id;
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

	public function addSkill($freelancer_id, $data){
		$insert_data = array(
			'freelancer_id' => $freelancer_id,
			'skill_id' => $data['skill_id'],
			'percentage' => $data['skill_percentage'],
			'date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('freelancer_skills', $insert_data);
		// echo $this->db->last_query();
		return $this->db->insert_id();
	}

	public function editSkill($skill_id, $data){
		$update_data = array(
			'skill_id' => $data['skill_id'],
			'percentage' => $data['skill_percentage'],
			'cp_date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('freelancer_skill_id', $skill_id);
		$result = $this->db->update('freelancer_skills', $update_data);
		return $result;
	}

	public function deleteSkill($skill_id, $data=array()){
		$condition_data = array(
			'freelancer_skill_id' => $skill_id,
		);

		$result = $this->db->delete('freelancer_skills', $condition_data);
		return $result;
	}

	public function deleteSkills($freelancer_id, $data=array()){
		$condition_data = array(
			'freelancer_id' => $freelancer_id,
		);

		$result = $this->db->delete('freelancer_skills', $condition_data);
		return $result;
	}

}

