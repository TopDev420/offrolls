<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
    private $category_type_id;

    public function __construct(){
		parent::__construct();

		// $this->category_type_id = CITY_TYPE;
		$this->lang->load(array('admin/category'));	//Load Language
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
	}

	public function autocomplete($filter_name=''){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {

			$filter_data = array(
			    'child' => 1,
				'filter_name' => $filter_name,
				'status' => 1,
				'start' => 0,
				'limit' => 5,
				'sort' => 'category_id',
				'order' => 'ASC'
			);
			if($this->input->get('state')){
				$filter_data['parent_id'] = $this->input->get('state');
			}
			$results = $this->model_jobcategory->getCategories(CITY_TYPE, $filter_data);
            if($results){
                foreach ($results as $result) {
    				$json[] = array(
    					'value' => $result->category_id,
    					'label' => strip_tags(html_entity_decode($result->name, ENT_QUOTES, 'UTF-8'))
    				);
    			}
            }

		}
		echo json_encode($json);
	}

	public function stateAutocomplete($filter_name=''){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {

			$filter_data = array(
			    // 'child' => 1,
				'filter_name' => $filter_name,
				'status' => 1,
				'start' => 0,
				'limit' => 5,
				'sort' => 'category_id',
				'order' => 'ASC'
			);

			$results = $this->model_jobcategory->getCategories(STATE_TYPE, $filter_data);
            if($results){
                foreach ($results as $result) {
    				$json[] = array(
    					'value' => $result->category_id,
    					'label' => strip_tags(html_entity_decode($result->name, ENT_QUOTES, 'UTF-8'))
    				);
    			}
            }

		}
		echo json_encode($json);
	}

	// public function autocomplete($filter_name=''){
	// 	$json = array();
	// 	if($this->input->server('REQUEST_METHOD') == 'POST') {

	// 		$results = $this->searchJobLocations($filter_name, $limit=5);

	// 		if($results){
 //                foreach ($results as $result) {
 //    				$json[] = array(
 //    					'id' => $result['id'],
 //    					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
 //    				);
 //    			}
 //            }
	// 	}
	// 	echo json_encode($json);
	// }

	protected function searchJobLocations($filter_name, $limit=5){
	    $joblocations = array(); $lc = 0;
	    $locations = $this->model_jobcategory->getJobLocations();


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
