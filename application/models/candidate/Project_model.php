<?php
class Project_model extends CI_Model {

    public function __construct() {
        parent::__construct();
	}

	public function getProjects($candidate_id) {
		$this->db->select('candidate_project.*');
        $this->db->from('candidate_project');

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
			$sort = 'candidate_project_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);
        return $query = $this->db->get()->result();
	}

	public function getProject($project_id, $data=array()) {
		$this->db->select('candidate_project.*');
        $this->db->from('candidate_project');

		//Filter Condition
		$condition = array();
		$condition['candidate_project_id'] = $project_id;
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

	public function addProject($candidate_id, $data=array()){
		$insert_data = array(
			'candidate_id' => $candidate_id,
			'cp_name' => $this->input->post('project_name'),
			'cp_company_name' => $this->input->post('project_company_name'),
			'cp_url' => $this->input->post('project_url'),
			'cp_description' => $this->input->post('project_description'),
			'cp_status' => $this->input->post('project_status'),
			'cp_start_date' => json_encode($this->input->post('project_start_date')),
			'cp_end_date' => json_encode($this->input->post('project_end_date')),
			'cp_date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('candidate_project', $insert_data);
		return $this->db->insert_id();
	}

	public function editProject($project_id, $data=array()){
		$update_data = array(
			'cp_name' => $this->input->post('project_name'),
			'cp_company_name' => $this->input->post('project_company_name'),
			'cp_url' => $this->input->post('project_url'),
			'cp_description' => $this->input->post('project_description'),
			'cp_status' => $this->input->post('project_status'),
			'cp_start_date' => json_encode($this->input->post('project_start_date')),
			'cp_end_date' => json_encode($this->input->post('project_end_date')),
			'cp_date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('candidate_project_id', $project_id);
		$result = $this->db->update('candidate_project', $update_data);
		return $result;
	}

	public function deleteProject($project_id, $data=array()){
		$condition_data = array(
			'candidate_project_id' => $project_id,
		);

		$result = $this->db->delete('candidate_project', $condition_data);
		return $result;
	}

	protected function formDTArray($date){
		$month = '';
		$year = '';
		if($date){
			$DA = explode('/', $date);
			if($DA){
				$month = isset($DA[0]) ? $DA[0] : false;
				$year = isset($DA[1]) ? $DA[1] : false;
			}
		}

		return array(
			'month' => $month,
			'year' => $year
		);
	}
}

