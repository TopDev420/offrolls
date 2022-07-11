<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    private $user_id;

    function __construct() {
        parent::__construct();
        $this->load->library('Users');
        $this->validate();
    }

    public function index(){
        $this->load->helper('category');

        echo 'User Activities Ready';
    }

    public function add(){
        $this->load->helper('category');

        echo 'User Activity Add';
    }

    public function list(){
        $this->load->helper('category');

        echo 'User Activity List Ready';
    }

    public function publish(){
        $this->load->helper('category');

        echo 'User Activity Publish';
    }

    protected function validate(){
        $this->user_id = $this->users->isLogged();
        if(!$this->user_id){
            redirect(base_url() . 'login');
        } else {
            $this->loadDetails();
        }
    }
    
    protected function loadDetails(){
    	$this->load->helper('user'); // Load user helper
	}
}
