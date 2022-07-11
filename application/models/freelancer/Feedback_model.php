<?php
class Feedback_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getTotalFeedbacks($freelancer_id, $data=array()) {
		$this->db->select('COUNT(*) AS total');
        $this->db->from('freelancer_feedback');

		//Filter Condition
		$condition = array();
		$condition['freelancer_id'] = $freelancer_id;
		if($condition){
			$this->db->where($condition);
		}

        return $query = $this->db->get()->row()->total;
	}

	public function getFeedbacks($freelancer_id, $data=array()) {
		$this->db->select('freelancer_feedback.*');
        $this->db->from('freelancer_feedback');

		//Filter Condition
		$condition = array();
		$condition['freelancer_id'] = $freelancer_id;
		if($condition){
			$this->db->where($condition);
		}

		//Limit
		if(isset($data['limit'])){
			$limit = 20;
			$start = 0;
	        if(isset($data['start'])){
		        $start = $data['start'];
			} 

			if($data['limit']){
	          $limit = $data['limit'];
	        }

	        $this->db->limit($limit, $start);
		}

		//Sort
		if(isset($data['sort'])){
			$sort = $data['sort'];
		} else {
			$sort = 'freelancer_feedback_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);
        return $query = $this->db->get()->result();
	}

	public function getFeedbacksRating($freelancer_id, $data=array()) {
		$this->db->select('AVG(rating_points) AS ratings, COUNT(*) AS total');
        $this->db->from('freelancer_feedback');

		//Filter Condition
		$condition = array();
		$condition['freelancer_id'] = $freelancer_id;
		if($condition){
			$this->db->where($condition);
		}

        return $query = $this->db->get()->row();
	}

	public function getFeedback($feedback_id, $data) {
		$this->db->select('freelancer_feedback.*');
        $this->db->from('freelancer_feedback');

		//Filter Condition
		$condition = array();
		$condition['freelancer_feedback_id'] = $feedback_id;
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

}