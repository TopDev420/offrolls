<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('admin');
	}

	public function index(){
		$data = array();
		
		$this->session->sess_destroy();

		$this->session->set_userdata('success', 'Logged Out Successfully');

		redirect(base_url() . 'home');
	}
}