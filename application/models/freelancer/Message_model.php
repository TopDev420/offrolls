<?php
class Message_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getTotalMessages($freelancer_job_id, $data=array()) {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('freelancer_jobs_message');

        //Filter Condition
        $condition = array();
        $condition['freelancer_job_id'] = $freelancer_job_id;

        if(isset($data['sender'])) {
            $condition['cjm_sender'] = $data['sender'];
        }

        if(isset($data['receiverNotify'])) {
            $condition['cjm_isReceiverNotify'] = $data['receiverNotify'];
        }

        if($condition){
        	$this->db->where($condition);
		}

		//Sort
		if(isset($data['sort'])){
			$sort = $data['sort'];
		} else {
			$sort = 'freelancer_job_message_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'ASC';
		}
		$this->db->order_by($sort, $order);
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return false;
        }

	}

    public function getMessages($freelancer_job_id, $data=array()) {
        $this->db->select('freelancer_jobs_message.*');
        $this->db->from('freelancer_jobs_message');

        //Filter Condition
        $condition = array();
        $condition['freelancer_job_id'] = $freelancer_job_id;
        if(isset($data['sender'])) {
            $condition['cjm_sender'] = $data['sender'];
        }

        if(isset($data['receiverNotify'])) {
            $condition['cjm_isReceiverNotify'] = $data['receiverNotify'];
        }

		if($condition){
			$this->db->where($condition);
		}

		//Sort
		if(isset($data['sort'])){
			$sort = $data['sort'];
		} else {
			$sort = 'freelancer_job_message_id';
		}

		if(isset($data['order'])){
			$order = $data['order'];
		} else {
			$order = 'ASC';
		}
		$this->db->order_by($sort, $order);
        return $query = $this->db->get()->result();
	}

	public function getMessage($message_id, $data=array()) {
		$this->db->select('freelancer_jobs_message.*');
        $this->db->from('freelancer_jobs_message');

		//Filter Condition
		$condition = array();
		$condition['freelancer_job_message_id'] = $message_id;
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

	public function addMessage($data){
		$insert_data = array(
			'freelancer_job_id' => $data['freelancer_job_id'],
			'cjm_sender' => $data['sender'],
			'cjm_receiver' => $data['receiver'],
			'cjm_type' => $data['type'],
			'cjm_message' => $data['message'],
			'cjm_date_added' => date('Y-m-d H:i:s')
		);

		$this->db->insert('freelancer_jobs_message', $insert_data);
		return $this->db->insert_id();
	}

	public function setMessageSenderNotify($message_id, $status){
		$update_data = array(
			'cjm_isSenderNotify' => $status,
			'cjm_date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('freelancer_job_message_id', $message_id);
		$result = $this->db->update('freelancer_jobs_message', $update_data);
		return $result;
	}

    public function setMessageReceiverNotify($message_id, $status){
    	$update_data = array(
			'cjm_isReceiverNotify' => $status,
			'cjm_date_modified' => date('Y-m-d H:i:s')
		);
		$this->db->where('freelancer_job_message_id', $message_id);
		$result = $this->db->update('freelancer_jobs_message', $update_data);
		return $result;
	}

	public function deleteMessage($message_id, $data=array()){
		$condition_data = array(
			'freelancer_job_message_id' => $message_id,
		);

		$result = $this->db->delete('freelancer_jobs_message', $condition_data);
		return $result;
	}
}

