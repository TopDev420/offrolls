<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification {

    private $CI;

    public function __construct() {
        $this->CI = &get_instance();
	    $this->CI->load->model('Notification_model', 'model_notification'); //Load notification model
	}

    public function add($data){
        $notification_data = array(
            'sender_id' => $data['sender_id'],
            'receiver_id' => $data['receiver_id'],
            'message' => $data['message'],
            'link' => $data['link'],
            'publish' => 0,
        );
        $notifications = $this->CI->model_notification->addNotification($notification_data); // Add Notification
    }
}
