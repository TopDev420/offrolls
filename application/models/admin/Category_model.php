<?php class Category_model extends CI_Model {
	
	public function __construct() {        
		parent::__construct();

		$this->load->helper('string');
	} 

	//Total Category
	public function getTotalCategories($data=array()){
		$condition = array();
		if(isset($data['parent_id'])){
			$condition['parent_id'] = $data['parent_id'];
		}

		//Filter Status
		if(isset($data['status'])){
			$condition['status'] = $data['status'];
		}

		if($condition){
			$this->db->where($condition);
		}


		$this->db->from('category');
		return$this->db->count_all_results();
	}

	//Get All Category
	public function getCategories($data=array()){
		$condition = array();
		if(isset($data['parent_id'])){
			$condition['parent_id'] = $data['parent_id'];
		}

		//Filter Status
		if(isset($data['status'])){
			$condition['status'] = $data['status'];
		}

		if($condition){
			$this->db->where($condition);
		}
		
		
		//Like
		if(isset($data['filter_name'])){
			$this->db->like('category_name',  $data['filter_name']);
		}

		//Limit
		if(isset($data['limit']) && isset($data['start'])){

			if($data['limit']){
				$limit = $data['limit'];
			} else {
				$limit = 20;
			}

			if($data['start']){
				$start = $data['start'];
			} else {
				$start = 0;
			}

			$this->db->limit($limit, $start);
		}

		//Sort
		if(isset($data['sort'])){
			$sort = $data['sort'];
		} else {
			$sort = 'category_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);


		$query = $this->db->get('category');
        if($query->num_rows() > 0) {
        	return $query->result();
        } else {
        	return false;
        }
	}

	//Get Category by Id
	public function getCategory($category_id){
		$condition = array(
			'category_id' => $category_id,
		);
		$this->db->where($condition);
		$query = $this->db->get('category');
        if($query->num_rows() > 0) {
        	return $query->row();
        } else {
        	return false;
        }
	}

	public function getCategoryByName($category_name, $data=array()){
		$condition = array(
			'category_name' => $category_name,
		);
		$this->db->where($condition);

		if(isset($data['except'])){
			$this->db->where_not_in('category_id', $data['except']);
		}
		
		$query = $this->db->get('category');
        if($query->num_rows() > 0) {
        	return $query->row();
        } else {
        	return false;
        }
	}

}