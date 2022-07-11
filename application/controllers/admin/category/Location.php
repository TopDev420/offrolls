<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
	private $category_type_id;

	public function __construct(){
		parent::__construct();

		$this->lang->load(array('admin/category'));	//Load Language
	}
	
	
	public function autocomplete($filter_name=''){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			
			$results = $this->searchJobLocations($filter_name, $limit=5);

			if($results){
                foreach ($results as $result) {
    				$json[] = array(
    					'id' => $result['id'],
    					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
    				);
    			}
            }
		}
		echo json_encode($json);
	}
	
	protected function searchJobLocations($filter_name, $limit=5){
	    $joblocations = array(); $lc = 0;
	    $locations = array(
	        array('id' => 1, 'name' => 'Chennai'),
	        array('id' => 2, 'name' => 'Bangalore'),
	        array('id' => 3, 'name' => 'Pune'),
	        array('id' => 4, 'name' => 'Delhi'), 
	        array('id' => 5, 'name' => 'Hyderabad'),
	        array('id' => 6, 'name' => 'Guragon'),
	    );
	    
	    
	    foreach($locations as $location){
	        if($lc < $limit){
	            $pos = stripos($location['name'], $filter_name);
	            if($pos !== FALSE) {
    	            $joblocations[] = $location;
    	            $lc++;
    	        }
	        } else {
	            break;
	        }
	        
	    }
	    
	    return $joblocations;
	}
}