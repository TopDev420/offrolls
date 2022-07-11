<?php class Company_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string');
	}

	public function getCompanies($data = array())
	{
		$this->db->select('c.*, u.first_name, u.last_name, u.image, u.email, u.mobile, u.user_type, u.status');
		$this->db->from('user AS u');
		$this->db->join('company AS c', 'c.user_id=u.user_id');
		//Filter Condition
		$condition = array();
		$condition['u.user_type'] = COMPANY_TYPE;

		if (isset($data['status'])) {
			$condition['u.status'] = $data['status'];
		}

		if ($condition) {
			$this->db->where($condition);
		}

		//Like
		if (isset($data['filter_name'])) {
			$this->db->like('c.company_name',  $data['filter_name']);
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
			$sort = 'u.user_id';
		}

		if (isset($data['order'])) {
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);

		$query = $this->db->get()->result();

		return $query;
	}

	public function getTotalCompanies($data = array())
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('user AS u');
		$this->db->join('company AS c', 'c.user_id=u.user_id');
		//Filter Condition
		$condition = array();
		$condition['u.user_type'] = COMPANY_TYPE;
		if (isset($data['status'])) {
			$condition['u.status'] = $data['status'];
		}
		if ($condition) {
			$this->db->where($condition);
		}

		//Like
		if (isset($data['filter_name'])) {
			$this->db->like('c.company_name',  $data['filter_name']);
		}

		$query = $this->db->get();
		$row = $query->row();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->total;
		} else {
			return false;
		}
	}

	public function getCompany($user_id)
	{
		$this->db->select('c.*, u.first_name, u.last_name, u.image,u.email, u.mobile, u.user_type, u.status');
		$this->db->from('user AS u');
		$this->db->join('company AS c', 'c.user_id=u.user_id');
		$condition['u.user_type'] = COMPANY_TYPE;
		$condition['u.user_id'] = $user_id;
		if (isset($data['status'])) {
			$condition['u.status'] = $data['status'];
		}
		if ($condition) {
			$this->db->where($condition);
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getCompanyById($company_id)
	{
		$this->db->select('c.*, u.first_name, u.last_name, u.image,u.email, u.mobile, u.user_type, u.status');
		$this->db->from('user AS u');
		$this->db->join('company AS c', 'c.user_id=u.user_id');
		$condition['u.user_type'] = COMPANY_TYPE;
		$condition['c.company_id'] = $company_id;
		if (isset($data['status'])) {
			$condition['u.status'] = $data['status'];
		}
		if ($condition) {
			$this->db->where($condition);
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function addCompanyByUser($user_id)
	{
		$company_data = array(
			'user_id' => $user_id,
			'cmp_date_added' => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert('company', $company_data);
		return $this->db->insert_id();
	}

	public function editCompany($company_id)
	{
		$data = array(
			'company_name' => $this->input->post('company_name'),
			'landline' => $this->input->post('landline'),
			'company_category' => $this->input->post('company_category'),
			'about' => $this->input->post('about'),
			'gst_no' => $this->input->post('gst_number'),
			'pan_no' => $this->input->post('pan_number'),
			'web_link' => $this->input->post('web_link'),
			'cmp_date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('company_id', $company_id);
		$result = $this->db->update('company', $data);
		return $result;
	}

	public function editLocation($company_id)
	{
		$data = array(
			'address' => $this->input->post('address'),
			'city' => $this->input->post('company_city'),
			'state' => $this->input->post('company_state'),
			'country' => $this->input->post('country'),
			'pin_code' => $this->input->post('pincode'),
			'cmp_date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('company_id', $company_id);
		$result = $this->db->update('company', $data);
		return $result;
	}

	public function updateCommissionPolicy($company_id)
	{
		$data = array(
			'isCommissionAgreed' => 1,
			'commission_agreed_datetime' => date('Y-m-d H:i:s'),
			'cmp_date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('company_id', $company_id);
		$result = $this->db->update('company', $data);
		return $result;
	}

	public function saveImage($user_id, $file_name)
	{
		$data = array(
			'image' => $file_name,
			'date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', $data);
		return $result;
	}
}
