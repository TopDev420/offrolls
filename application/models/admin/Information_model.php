<?php

class Information_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Total Category
    public function getTotalInformations($data=array()){
        $condition = array();

        //Filter Status
        if(isset($data['status'])){
			$condition['status'] = $data['status'];
		}

		if($condition){
			$this->db->where($condition);
		}

		$this->db->from('information');
		return$this->db->count_all_results();
	}

	//Get All Category
	public function getInformations($data=array()){
		$condition = array();

		//Filter Status
		if(isset($data['status'])){
			$condition['status'] = $data['status'];
		}

		if($condition){
			$this->db->where($condition);
		}


		//Like
		if(isset($data['filter_name'])){
			$this->db->like('information_name',  $data['filter_name']);
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
			$sort = 'information_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);


		$query = $this->db->get('information');
        if($query->num_rows() > 0) {
        	return $query->result();
        } else {
        	return false;
        }
	}

	//Get Category by Id
	public function getInformation($information_id){
		$condition = array(
			'information_id' => $information_id,
		);
		$this->db->where($condition);
		$query = $this->db->get('information');
        if($query->num_rows() > 0) {
        	return $query->row();
        } else {
        	return false;
        }
	}

	public function getInformationByCode($code, $data=array()){
		$condition = array(
			'code' => $code,
		);
		$this->db->where($condition);

		if(isset($data['except'])){
			$this->db->where_not_in('information_id', $data['except']);
		}

		$query = $this->db->get('information');
        if($query->num_rows() > 0) {
        	return $query->row();
        } else {
        	return false;
        }
	}

    public function addInformation($data){
		$insert_data = array(
            'title' => $data['title'],
			'code' => generateStringCode($data['title']),
            'description' => isset($data['description']) ? html_escape($data['description']) : '',
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
            'meta_keyword' => $data['meta_keyword'],
            'status' => $data['status'],
            'date_added' => date('Y-m-d H:i:s')
		);
		$this->db->insert('information', $insert_data);
        return $this->db->insert_id();
	}

    public function editInformation($information_id, $data){
    	$insert_data = array(
            'title' => $data['title'],
			'code' => generateStringCode($data['title']),
            'description' => isset($data['description']) ? html_escape($data['description']) : '',
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
            'meta_keyword' => $data['meta_keyword'],
            'status' => $data['status'],
            'date_modified' => date('Y-m-d H:i:s')
		);
        $this->db->where('information_id', $information_id);
		$result = $this->db->update('information', $insert_data);
        return $result;
	}

    public function deleteInformation($information_id){
        $this->db->where('information_id', $information_id);
		$result = $this->db->delete('information');
        return $result;
	}
}
