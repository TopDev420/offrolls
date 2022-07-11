<?php class Industry_model extends CI_Model {
	
	public function __construct() {        
		parent::__construct();

		$this->load->helper('string');
	} 

	//Total Category
	public function getTotalIndustries($data=array()){
		
		$this->db->from('industry');
		return$this->db->count_all_results();
	}

	//Get All Category
	public function getIndustries($data=array()){

		//Like
		if(isset($data['filter_name'])){
			$this->db->like('industry_name',  $data['filter_name']);
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
			$sort = 'id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);


		$query = $this->db->get('industry');
        if($query->num_rows() > 0) {
        	return $query->result();
        } else {
        	return false;
        }
	}

	//Get Category by Id
	public function getIndustry($industry_id){
		$condition = array(
			'id' => $industry_id,
		);
		$this->db->where($condition);
		$query = $this->db->get('industry');
        if($query->num_rows() > 0) {
        	return $query->row();
        } else {
        	return false;
        }
	}


}