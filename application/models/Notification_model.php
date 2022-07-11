<?php class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('string');
    }

    //User Activity
    public function getNotifications($receiver_id, $data=array()){
        $condition = array(
            'receiver_id' => $receiver_id
        );
        if(isset($data['publish'])){
            $condition['is_published'] = $data['publish'];
        }
        if(isset($data['date'])){
            $condition['DATE(date_added)'] = $data['date'];
        }
        $this->db->where($condition);

        $query = $this->db->get('notification');
        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //User Activity
    public function getTotalNotifications($receiver_id, $data=array()){
        $this->db->select('COUNT(*) AS total');
        $condition = array(
            'receiver_id' => $receiver_id
        );
        if(isset($data['publish'])){
            $condition['is_published'] = $data['publish'];
        }
        if(isset($data['date'])){
            $condition['DATE(date_added)'] = $data['date'];
        }
        $this->db->where($condition);

        $query = $this->db->get('notification');
        if($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return false;
        }
	}

    public function getNotification($notification_id){
        $condition = array(
	        'notification_id' => $notification_id
        );
	    $this->db->where($condition);
		$query = $this->db->get('notification');
        if($query->num_rows() > 0) {
            $socials = array();
        	return $query->row();
        } else {
        	return false;
        }
	}

	public function addNotification($data){
	    $insert_data = array(
            'sender_id' => $data['sender_id'],
            'receiver_id' => $data['receiver_id'],
            'message' => $data['message'],
            'link' => $data['link'],
            'is_published' => $data['publish'],
            'date_added' => date('Y-m-d H:i:s')
        );
        $this->db->insert('notification', $insert_data);
        return $this->db->insert_id();
	}

	public function setNotificationPublish($notification_id, $publish){
	    $update_data = array(
            'is_published' => $publish,
            'date_modified' => date('Y-m-d H:i:s')
        );

        $this->db->where('notification_id', $notification_id);
        $query = $this->db->update('notification', $update_data);
        return $this->db->insert_id();
	}

    public function deleteNotifications($sender_id, $data=array()){
        $condition = array(
            'sender_id' => $sender_id
        );
        if(isset($data['publish'])){
            $condition['is_published'] = $data['publish'];
        }
        if(isset($data['date'])){
            $condition['DATE(date_added) <'] = $data['date'];
        }
        $this->db->where($condition);

        $this->db->delete('notification');
    }

	public function deleteNotification($notification_id){
        $this->db->where('notification_id', $notification_id);
        $this->db->delete('notification');
	}
}
