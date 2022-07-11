<?php class Newsletter_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string');
	}

	public function getTotalNewsletters($data = [])
	{
		$condition = array();

		if (isset($data['user_email'])) {
			$condition['user_email'] = $data['email'];
		}

		if (isset($data['status'])) {
			$condition['status'] = (int)$data['status'];
		}

		$this->db->select('COUNT(*) AS total');
		$this->db->from('newsletter');
		if ($condition) {
			$this->db->where($condition);
		}

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->total;
		} else {
			return 0;
		}
	}

	public function getNewsletters($data = [])
	{
		$condition = array();

		if (isset($data['user_email'])) {
			$condition['user_email'] = $data['email'];
		}

		if (isset($data['status'])) {
			$condition['status'] = (int)$data['status'];
		}

		$this->db->select('*');
		$this->db->from('newsletter');
		if ($condition) {
			$this->db->where($condition);
		}

		//Limit
		if (isset($data['limit'])) {
			$limit = 20;
			$start = 0;
			if (isset($data['start'])) {
				$start = $data['start'];
			}

			if ($data['limit']) {
				$limit = $data['limit'];
			}

			$this->db->limit($limit, $start);
		}

		//Sort
		if (isset($data['sort'])) {
			$sort = $data['sort'];
		} else {
			$sort = 'newsletter_id';
		}

		if (isset($data['order'])) {
			$order = $data['order'];
		} else {
			$order = 'DESC';
		}
		$this->db->order_by($sort, $order);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function getNewsletter($newsletter_id)
	{
		$condition = array(
			'newsletter_id' => $newsletter_id
		);

		if (isset($data['user_email'])) {
			$condition['user_email'] = $data['email'];
		}

		if (isset($data['status'])) {
			$condition['status'] = (int)$data['status'];
		}

		if ($condition) {
			$this->db->where($condition);
		}

		$query = $this->db->get('newsletter');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getNewsletterByEmail($email)
	{
		$condition = array(
			'user_email' => $email
		);

		if (isset($data['status'])) {
			$condition['status'] = (int)$data['status'];
		}

		if ($condition) {
			$this->db->where($condition);
		}

		$query = $this->db->get('newsletter');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function addNewsletter($data)
	{
		$insert_data = array(
			'user_email' => $data['email'],
			'status' => $data['status'],
			'created_datetime' => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert('newsletter', $insert_data);
		return $this->db->insert_id();
	}

	public function removeNewsletter($newsletter_id)
	{
		$update_data = array(
			'status' => 0,
			'updated_datetime' => date('Y-m-d H:i:s')
		);
		$this->db->where('newsletter_id', $newsletter_id);
		$result = $this->db->update('newsletter', $update_data);
		return $result;
	}
}
