<?php class Newsletter_model extends CI_Model {
    
    public function __construct() {
		parent::__construct();
		$this->load->helper('string');
		
	}


	public function getSubscriber($email) {
        $this->db->where('user_email', $email);
        $query = $this->db->get('newsletter');
		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function addSubscriber($email) {
	    $insert_data = array(
	        'user_email' => $email,
	        'status' => 1,
	        'created_datetime' => date('Y-m-d H:i:s')
	    );
        
        $query = $this->db->insert('newsletter', $insert_data);
		return $this->db->insert_id();
	}
	
	public function removeSubscriber($email) {
	    $update_data = array(
	        'status' => 0,
	        'updated_datetime' => date('Y-m-d H:i:s')
	    );
        $this->db->where('user_email', $email);
        $result = $this->db->update('newsletter', $update_data);
		return $result;
	}
}