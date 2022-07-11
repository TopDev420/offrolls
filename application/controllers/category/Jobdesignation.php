<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobdesignation extends CI_Controller {
    private $category_type_id;

    public function __construct(){
        parent::__construct();

    	$this->category_type_id = JOB_DESIGNATION_TYPE;
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');

		$this->lang->load(array('admin/category'));	//Load Language
	}

	public function autocomplete($filter_name=''){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {

			$filter_data = array(
				'filter_name' => $filter_name,
				'status' => 1,
				'start' => 0,
				'limit' => 5,
				'sort' => 'category_id',
				'order' => 'ASC'
			);

			$results = $this->model_jobcategory->getCategories($this->category_type_id, $filter_data);
            if($results){
                foreach ($results as $result) {
    				$json[] = array(
    					'value' => $result->category_id,
    					'label'        => strip_tags(html_entity_decode($result->name, ENT_QUOTES, 'UTF-8'))
    				);
    			}
            }

		}
		echo json_encode($json);
	}
}
