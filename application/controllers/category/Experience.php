<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Experience extends CI_Controller {
    private $category_type_id;

    public function __construct(){
		parent::__construct();

		$this->category_type_id = EXPERIENCE_TYPE;
		$this->load->library('admin');
		$this->load->model('admin/User_model', 'model_admin');
		$this->load->model('admin/Jobcategory_model', 'model_jobcategory');

		$this->validate(); // Check if admin is loggedin

		$this->lang->load(array('admin/category'));	//Load Language
	}

}
