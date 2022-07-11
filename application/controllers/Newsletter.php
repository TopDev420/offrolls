<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Newsletter_model', 'model_newsletter');
	}

	public function index() {
	    redirect(base_url());
	}
	
	public function subscribe(){
	    $json = array();
	    if($this->input->server('REQUEST_METHOD') == 'POST'){
	        $email = $this->input->post('user_email');
	        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
	            $subscriber = $this->model_newsletter->getSubscriber($email);
	            if($subscriber){
	                $json['error'] = true;
	                $json['message'] = 'Sorry...! <br> This email id is already subscribed for this service!';
	            } else {
	                $add = $this->model_newsletter->addSubscriber($email);
	                if($add){
	                    $json['success'] = true;
	                    $json['message'] = 'Email subscription successfully';
	                } else {
	                    $json['error'] = true;
	                    $json['message'] = 'Sorry..! <br>Email subscription not done!';
	                }
	            }
	            
	        } else {
	            $json['error'] = true;
	            $json['message'] = 'Please enter valid email id';
	        }
	    }
	    
	    echo json_encode($json);
	}
	
	public function unsubscribe(){
	    $json = array();
	    if($this->input->server('REQUEST_METHOD') == 'POST'){
	        
	    }
	    
	    echo json_encode($json);
	}
}