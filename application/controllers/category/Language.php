<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {
    private $category_type_id;

    public function __construct(){
        parent::__construct();

        $this->lang->load(array('admin/category'));	//Load Language
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory');
	}


	public function autocomplete($filter_name=''){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {

			$results = $this->searchLanguages($filter_name, $limit=5);

			if($results){
                foreach ($results as $result) {
    				$json[] = array(
    					'value' => $result['id'],
    					'label'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
    				);
    			}
            }
		}
		echo json_encode($json);
	}

	protected function searchLanguages($filter_name, $limit=5){
	    $joblanguages = array(); $lc = 0;
	    $languages = $this->model_jobcategory->getLanguages();


	    foreach($languages as $language){
	        if($lc < $limit){
	            $pos = stripos($language['name'], $filter_name);
	            if($pos !== FALSE) {
    	            $joblanguages[] = $language;
    	            $lc++;
    	        }
	        } else {
	            break;
	        }

	    }

	    return $joblanguages;
	}
}
