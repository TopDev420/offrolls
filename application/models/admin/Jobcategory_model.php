<?php class Jobcategory_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('string');
	}

	//Total Category
	public function getTotalCategories($type_id, $data = array())
	{
		$condition = array(
			'j.type_id' => $type_id
		);

		if (isset($data['child'])) {
			if ($data['child']) {
				$condition['j.parent_id >'] = 0;
			} else {
				$condition['j.parent_id'] = 0;
			}
		} else {
			$condition['j.parent_id'] = 0;
		}

		if (isset($data['parent_id'])) {
			$condition['j.parent_id '] = $data['parent_id'];
		}

		$this->db->where($condition);
		$this->db->from('job_category AS j');

		return $this->db->count_all_results();
	}

	//Get All Category
	public function getCategories($type_id, $data = array())
	{

		$this->db->select('j.*,(SELECT name FROM job_category AS jp WHERE j.parent_id=jp.category_id) AS parent_name');
		//Condition
		$condition = array(
			'j.type_id' => $type_id
		);
		//Filter Status
		if (isset($data['status'])) {
			$condition['j.status'] = $data['status'];
		}

		if (isset($data['child'])) {
			if ($data['child']) {
				$condition['j.parent_id >'] = 0;
			} else {
				$condition['j.parent_id'] = 0;
			}
		} else {
			$condition['j.parent_id'] = 0;
		}

		if (isset($data['parent_id'])) {
			$condition['j.parent_id '] = $data['parent_id'];
		}

		$this->db->where($condition);
		//Like
		if (isset($data['filter_name'])) {
			$this->db->like('j.name',  $data['filter_name']);
		}

		//Limit
		if (isset($data['limit']) && isset($data['start'])) {

			if ($data['limit']) {
				$limit = $data['limit'];
			} else {
				$limit = 20;
			}

			if ($data['start']) {
				$start = $data['start'];
			} else {
				$start = 0;
			}

			$this->db->limit($limit, $start);
		}

		//Sort
		if (isset($data['sort'])) {
			$sort = $data['sort'];
		} else {
			$sort = 'j.category_id';
		}

		if (isset($data['order'])) {
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);


		$query = $this->db->get('job_category AS j');

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	//Get Category by Id
	public function getCategory($category_id)
	{
		$this->db->select('j.*, (SELECT name FROM job_category AS jp WHERE j.parent_id=jp.category_id) AS parent_name');
		$condition = array(
			'j.category_id' => $category_id,
		);
		$this->db->where($condition);
		$query = $this->db->get('job_category AS j');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getCategoryByName($category_name, $type_id, $data = array())
	{
		$condition = array(
			'LOWER(REPLACE(name, " ", "-")) = ' => preg_replace('[\s]', '-', strtolower($category_name)),
			'type_id' => $type_id
		);
		$this->db->where($condition);

		if (isset($data['except'])) {
			$this->db->where_not_in('category_id', $data['except']);
		}

		$query = $this->db->get('job_category');

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	//Add Category
	public function addCategory($type_id)
	{
		$parent_id = $this->input->post('parent_id') ? $this->input->post('parent_id') : 0;
		$sort_order = $this->input->post('sort_order') ? $this->input->post('sort_order') : 0;
		$category_data = array(
			'name' => $this->input->post('category_name'),
			'status' => $this->input->post('status'),
			'sort_order' => $sort_order,
			'type_id' => $type_id,
			'parent_id' => $parent_id,
			'date_added' => date('Y-m-d H:i:s')
		);
		$this->db->insert('job_category', $category_data);
		return $this->db->insert_id();
	}

	//Edit Category
	public function editCategory($category_id)
	{
		$parent_id = $this->input->post('parent_id') ? $this->input->post('parent_id') : 0;
		$sort_order = $this->input->post('sort_order') ? $this->input->post('sort_order') : 0;
		$category_data = array(
			'name' => $this->input->post('category_name'),
			'status' => $this->input->post('status'),
			'sort_order' => $sort_order,
			'parent_id' => $parent_id,
			'date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('category_id', $category_id);
		$result = $this->db->update('job_category', $category_data);
		return $result;
	}


	//Delete Category
	public function deleteCategory($category_id)
	{
		$this->db->where('category_id', $category_id);
		$result = $this->db->delete('job_category');
		return $result;
	}


	//Job Locations City
	public function getJobLocations()
	{
		$locations = array(
			array('id' => 1, 'name' => 'Chennai'),
			array('id' => 2, 'name' => 'Bangalore'),
			array('id' => 3, 'name' => 'Pune'),
			array('id' => 4, 'name' => 'Delhi'),
			array('id' => 5, 'name' => 'Hyderabad'),
			array('id' => 6, 'name' => 'Guragon'),
		);
		return $locations;
	}

	//Job Languages
	public function getLanguages()
	{
		$languages = array(
			array('id' => 1, 'name' => 'English', 'code' => 'en'),
			array('id' => 2, 'name' => 'Kannada', 'code' => 'ka'),
			array('id' => 4, 'name' => 'Hindi', 'code' => 'hi'),
			array('id' => 5, 'name' => 'Malayalam', 'code' => 'ma'),
			array('id' => 6, 'name' => 'Bengali', 'code' => 'be'),
			array('id' => 7, 'name' => 'Marathi', 'code' => 'mr'),
			array('id' => 8, 'name' => 'Telugu', 'code' => 'te'),
			array('id' => 9, 'name' => 'Tamil', 'code' => 'ta'),
			array('id' => 10, 'name' => 'Gujarati', 'code' => 'gu'),
			array('id' => 11, 'name' => 'Odia', 'code' => 'od'),
			array('id' => 12, 'name' => 'Punjabi', 'code' => 'pu'),
			array('id' => 13, 'name' => 'Urdu', 'code' => 'ur'),
		);
		return $languages;
	}

	public function getLanguage($language_id)
	{
		$languages = $this->getLanguages();
		$result = array();
		if ($languages) {
			foreach ($languages as $lkey => $language) {
				if ($language['id'] == $language_id) {
					$result = $languages[$lkey];
					break;
				}
			}
		}

		return $result;
	}

	public function getLanguageByName($category_name)
	{
		$languages = $this->getLanguages();
		$result = array();
		if ($languages) {
			foreach ($languages as $lkey => $language) {
				$lang = preg_replace('[\s]', '-', strtolower($language['name']));
				if ($lang == preg_replace('[\s]', '-', strtolower($category_name))) {
					$result = $languages[$lkey];
					break;
				}
			}
		}

		return $result;
	}
}
