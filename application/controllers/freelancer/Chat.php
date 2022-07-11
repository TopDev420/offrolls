<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    private $error = array();
    private $page_name = 'freelancer_chatbox';
    private $user_id;
    private $freelancerArr = array();
    private $freelancer_job = array();
    private $menu_section='freelancer_chatbox';
    private $sender = 'FR';
    private $receiver = 'CMP';

    public function __construct() {
        parent::__construct();
        $this->load->library('freelancer');
    }

    public function start() {
        if($this->validate('return')) {
            $this->getMessages();
        } else {
            $json = array();
            $json['error'] = true;
            $json['message'] = $this->loadErrors();

            echo json_encode($json);
        }
    }

    public function listMessages() {
        if($this->validate('return')) {
            $this->getMessages();
        } else {
            $json = array();
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
            echo json_encode($json);
        }
    }

    protected function getMessages(){
        $json = array();

        //Get Page Number
        if($this->uri->segment(5)) {
            $page = (int)$this->uri->segment(5);
        } else {
            $page = 1;
        }

        $limit = 10;

        $freelancer_job_id = $this->freelancer_job->freelancer_job_id;
        $this->load->model('freelancer/Message_model', 'model_freelancer_message');
        //Filter Data
        $filter_data = array(
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'freelancer_job_id',
            'order' => 'DESC'
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
                    $_image = $this->freelancerArr->image;
                } else {
                    $_sender = 'out';
                    $_image = $this->freelancer_job->company_logo;
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
                    'date_added' => date('d F Y H:i A', strtotime($message->cjm_date_added))
                );
            }
        }

        $json['success'] = true;

        echo json_encode($json);
    }

    public function addMessage() {
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
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

        echo json_encode($json);
    }

    protected function validate($type = '') {
        //Check login
        $this->user_id = $this->freelancer->isLogged();
        if(!$this->user_id) {
            if($type == 'return'){
                $this->error['warning'] = "Please login to your account";
            } else {
                redirect(base_url() . 'login');
            }
        } else {
            $this->loadDetails();
        }

        $profile_status = $this->getProfileStatus('freelancer');
        if(!$profile_status){
            if($type == 'return'){
                $this->error['warning'] = "Please complete your profile";
            } else {
                $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
                redirect(base_url() . 'freelancer/profile?redirect='. $this->page_name);
            }
        }

        if($this->uri->segment(4)) {
            $job_id = (int)$this->uri->segment(4);
        } else {
            $job_id = 0;
        }

        $filter_data = array('applied' => 1, 'accepted' => 1);
        $this->freelancer_job = $this->model_freelancer_job->getRecentfreelancerJob($this->freelancerArr->freelancer_id, $job_id);
        if(!$this->freelancer_job) {
            if($type == 'return'){
                $this->error['warning'] = "Please choose a valid job";
            } else {
                $this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
                redirect(base_url() . 'company/dashboard');
            }
        }

        if($type == 'return'){
            return !$this->error;
        }
    }

    protected function loadDetails(){
        $this->load->helper('user'); // Load user helper
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');   //Load freelancer model
        $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');   //Load freelancer job model
        $this->load->model('freelancer/Message_model', 'model_freelancer_message');   //Load freelancer message model
        $this->freelancerArr = $this->model_freelancer->getFreelancer($this->user_id);
    }

    //Check profile status. If it is below 80, redirect to profile page. Otherwise return status
    protected function getProfileStatus($type){
        if($this->user_id){
            $profile_progress = get_profile_status($this->freelancerArr, $type);
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
