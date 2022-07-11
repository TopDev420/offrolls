<?php class Setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('string');
    }

    //Setting
    public function getSettings($keyword){
    	$condition = array(
			'keyword' => $keyword,
		);
		$this->db->where($condition);
		$query = $this->db->get('setting');
        if($query->num_rows() > 0) {
            $result_array = array();
        	$results = $query->result();
            foreach($results as $result){
                $result_array[$result->code] = $result->value;
            }
            return (object)$result_array;
        } else {
        	return false;
        }
	}

    public function getSetting($keyword, $code){
        $condition = array(
			'keyword' => $keyword,
            'code' => $code
		);
		$this->db->where($condition);
		$query = $this->db->get('setting');
        if($query->num_rows() > 0) {
        	return $query->row();
        } else {
        	return false;
        }
	}

    public function addSetting($keyword, $code, $value){
        $insert_data = array(
    		'keyword' => $keyword,
            'code' => $code,
            'value' => $value,
            'date_added' => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert('setting', $insert_data);
        return $this->db->insert_id();
	}

    public function editSetting($setting_id, $value){
        $update_data = array(
            'value' => $value,
            'date_modified' => date('Y-m-d H:i:s')
		);

		$this->db->where('setting_id', $setting_id);
		$query = $this->db->update('setting', $update_data);
        return $query;
	}

}
