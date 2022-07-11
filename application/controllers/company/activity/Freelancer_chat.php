<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancer_chat extends CI_Controller {
    private $error = array();
    private $page_name = 'freelancer_chatbox';
    private $user_id;
    private $company = array();
    private $freelancer_job = array();
    private $menu_section='freelancer_chatbox';
    private $sender = 'CMP';
    private $receiver = 'FR';

    public function __construct(){
        parent::__construct();
        $this->load->library('recruiter');
    }

    public function start() {
        if($this->validate('return')) {
            $this->getMessages();
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
            echo json_encode($json);
        }
    }

    public function listMessages() {
        if($this->validate('return')) {
            $this->getMessages();
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
            echo json_encode($json);
        }
    }

    protected function getMessages(){
        $proceed = false;
        
        $this->load->helper('date');    //Load Date Helper
        
        //Get Page Number
        if($this->uri->segment(6)) {
            $page = (int)$this->uri->segment(6);
        } else {
            $page = 1;
        }

        $limit = 10;

        $freelancer_job_id = $this->freelancer_job->freelancer_job_id;
        $this->load->model('freelancer/Message_model', 'model_freelancer_message');

        $proceed = $this->validateJob();

        if($proceed) {
            //Filter Data
            $filter_data = array(
                'start' => ($limit * ($page - 1)),
                'limit' => $limit,
                'sort' => 'freelancer_job_message_id',
                'order' => 'ASC'
            );
            $json['messages'] = array();
            $messages = $this->model_freelancer_message->getMessages($freelancer_job_id, $filter_data);
            if($messages) {
                foreach($messages as $message) {
                    if($message->cjm_sender == $this->sender && $message->cjm_isSenderNotify == 0) {
                        $this->model_freelancer_message->setMessageSenderNotify($message->freelancer_job_message_id, 1);
                    }

                    if($message->cjm_receiver == $this->sender && $message->cjm_isReceiverNotify == 0) {
                        $this->model_freelancer_message->setMessageReceiverNotify($message->freelancer_job_message_id, 1);
                    }

                    if($message->cjm_sender == $this->sender) {
                        $_sender = 'in';
                        $_image = $this->company->image;
                    } else {
                        $_sender = 'out';
                        $_image = $this->freelancer_job->freelancer_image;
                    }

                    //Load Image
                    if($_image && is_readable(APPPATH . 'assets/uploads/logo/' . $_image)){
                        $_thumb = base_url() . 'application/assets/uploads/logo/' . $_image;
                    } else {
                        $_thumb = base_url() . 'application/assets/uploads/logo/default.png';
                    }

                    $json['messages'][] = array(
                        'sender' => $_sender,
                        'thumb' => $_thumb,
                        'freelancer_job_id' => $message->freelancer_job_id,
                        'type' => $message->cjm_type,
                        'message' => $message->cjm_message,
                        'date_added' => timespan(strtotime($message->cjm_date_added), time())
                    );
                }
            }
            $json['success'] = true;
        }  else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }


        echo json_encode($json);
    }

    public function addMessage() {
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {

            if($this->validateJob()) {
                $this->load->model('freelancer/Message_model', 'model_freelancer_message'); // Load freelancer message modal
                $message = $this->input->post('message');
                if($message){
                    $message_data = array(
                        'freelancer_job_id' => $this->freelancer_job->freelancer_job_id,
                        'sender' => $this->sender,
                        'receiver' => $this->receiver,
                        'type' => 'text',
                        'message' => $message
                    );
                    $add = $this->model_freelancer_message->addMessage($message_data);
                    if($add) {
                        $json['success'] = true;
                        $json['message'] = 'Message added successfully';
                    } else {
                        $json['error'] = true;
                        $json['message'] = 'Message not added!';
                    }
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Please enter message';
                }
            } else {
                $json['error'] = true;
                $json['message'] = $this->loadErrors();
            }

        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    protected function validate($type = '') {
        //Check if company user is loggedin or not
        $this->user_id = $this->recruiter->isLogged();
        if(!$this->user_id) {
            if($type == 'return'){
                $this->error['warning'] = "Please login to your account";
            } else {
                redirect(base_url() . 'login');
            }
        } else {
            $this->loadDetails();
        }

        $profile_status = $this->getProfileStatus('company');
        if(!$profile_status){
            if($type == 'return'){
                $this->error['warning'] = "Please complete your profile";
            } else {
                $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
                redirect(base_url() . 'company/profile?redirect='. $this->page_name);
            }
        }

        if($this->uri->segment(5)) {
            $freelancer_jobid = (int)$this->uri->segment(5);
        } else {
            $freelancer_jobid = 0;
        }

        $filter_data = array('applied' => 1);
        $this->freelancer_job = $this->model_job->getFreelancerJob($freelancer_jobid, $filter_data);
        if(!$this->freelancer_job) {
            if($type == 'return'){
                $this->error['warning'] = "No job data";
            } else {
                $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
                redirect(base_url() . 'company/dashboard');
            }
        }

        if($type == 'return'){
            return !$this->error;
        }
	}

    //validate Job by accepted and completed status
    protected function validateJob() {
        $proceed = false;

        if($this->freelancer_job->cj_isAccepted == 1 && $this->freelancer_job->cj_isCompleted == 1) {
            $this->error['warning'] = "Job Work was completed!";
        } else if($this->freelancer_job->cj_isAccepted == 1 && $this->freelancer_job->cj_isCompleted == 0) {
            $proceed = true;
        } else {
            $filter_data = array('applied' => 1, 'accepted' => 1, 'completed' => 1);
            $freelancerjob = $this->model_job->getFreelancerJobsByCJ($this->company->company_id, $this->freelancer_job->job_id, $filter_data);
            if($freelancerjob) {
                $this->error['error'] = 'Timeout... Job was already Completed!';
            } else {
                $filter_data = array('applied' => 1, 'accepted' => 1, 'completed' => 0);
                $freelancerjob = $this->model_job->getFreelancerJobsByCJ($this->company->company_id, $this->freelancer_job->job_id, $filter_data);
                if($freelancerjob) {
                    $this->error['error'] = 'Timeout... Job was already Accepted!';
                } else {
                    $proceed = true;
                }
            }
        }

        return $proceed;
    }

	protected function loadDetails(){
		$this->load->helper(array('user', 'freelancer_category_helper')); // Load helpers
        $this->load->model('company/Company_model', 'model_company');   //Load company model
        $this->load->model('company/Freelancer_jobs_model', 'model_job'); //Load company jobs model
		$this->company = $this->model_company->getCompany($this->user_id);
	}


	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type){
		if($this->user_id){
			$this->company = $this->model_company->getCompany($this->user_id);
			$profile_progress = get_profile_status($this->company, $type);
			if($profile_progress < 80 ){
				return false;
			} else {
				return $profile_progress;
			}
		} else {
			return true;
		}
	}


	protected function loadErrors(){
		if(isset($this->error['warning'])){
			return $this->error['warning'];
		} elseif (isset($this->error['error'])) {
			return $this->error['error'];
		} else {
			return '';
		}
	}
}
