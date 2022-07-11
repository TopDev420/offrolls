<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobtype extends CI_Controller {
    private $category_type_id;

    public function __construct(){
		parent::__construct();

		$this->category_type_id = JOB_TYPE;
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');
		$this->lang->load(array('admin/category'));	//Load Language
	}

}
