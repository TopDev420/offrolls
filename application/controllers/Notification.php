<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
    private $user_id;
    private $user_type;
    private $error = array();

    function __construct()
    {
        parent::__construct();
        $this->load->library('Users');
        $this->validate();
    }

    public function index()
    {
        $this->load->helper('category');

        echo 'Notification Ready';
    }

    public function add()
    {
        $this->load->helper('category');
        $json = array();

        echo 'Notification Add';
    }

    public function alert()
    {
        $json = array();
        $this->load->helper('category');
        $total_notifications = 0;
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
            $filter_data = array(
                'publish' => 0,
                'date' => date('Y-m-d')
            );
            $total_notifications = $this->model_notification->getTotalNotifications($this->user_id, $filter_data);
            $notifications = $this->model_notification->getNotifications($this->user_id, $filter_data);
            if ($total_notifications) {
                $json['message'] = 'Show';
            } else {
                $json['message'] = 'No Notification Available!';
            }

            $this->set_notification_publish($notifications); //Set Notification Publish
            $json['data'] = array('total' => $total_notifications);

            //Chat Message Notification
            $this->load->model('freelancer/Message_model', 'model_freelancer_message');
            $json['chat'] = array();
            $module = getModuleAction($this->user_type);

            switch ($module) {
                case 'company':
                    $this->load->model('company/Company_model', 'model_company');
                    $this->load->model('company/Freelancer_jobs_model', 'model_company_freelancer_job');
                    $company = $this->model_company->getCompany($this->user_id);
                    $company_id = isset($company->company_id) ? $company->company_id : 0;
                    $accepted_jobs = $this->model_company_freelancer_job->getFreelancerJobs($company_id, array('applied' => 1, 'accepted' => 1, 'completed' => 0));
                    $sender = 'FR';
                    $receiver = 'CMP';
                    break;
                case 'freelancer':
                    $this->load->model('freelancer/Freelancer_model', 'model_freelancer');
                    $this->load->model('freelancer/Jobs_model', 'model_freelancer_job');
                    $freelancer = $this->model_freelancer->getFreelancer($this->user_id);
                    $freelancer_id = isset($freelancer->freelancer_id) ? $freelancer->freelancer_id : 0;
                    $accepted_jobs = $this->model_freelancer_job->getFreelancerJobs($freelancer_id, array('applied' => 1, 'accepted' => 1, 'completed' => 0));
                    $sender = 'CMP';
                    $receiver = 'FR';
                    break;
                default:
                    $accepted_jobs = array();
                    $sender = '';
                    $receiver = '';
            }

            if ($accepted_jobs) {
                foreach ($accepted_jobs as $job) {

                    if ($sender == 'FR') {
                        $_name = $job->freelancer_name;
                        $_image = $job->freelancer_image;
                        $_jobid = $job->freelancer_job_id;
                    } elseif ($sender == 'CMP') {
                        $_name = $job->company_name;
                        $_image = $job->company_logo;
                        $_jobid = $job->job_id;
                    } else {
                        $_name = '';
                        $_image = '';
                    }

                    //Load Image
                    if ($_image && is_readable(APPPATH . 'assets/uploads/logo/' . $_image)) {
                        $_thumb = base_url() . 'application/assets/uploads/logo/' . $_image;
                    } else {
                        $_thumb = base_url() . 'application/assets/uploads/logo/default.png';
                    }

                    $total_messages = $this->model_freelancer_message->getTotalMessages($job->freelancer_job_id, array('sender' => $sender, 'receiverNotify' => 0));
                    if ($total_messages) {
                        $json['chat'][] = array(
                            'name' => $_name,
                            'thumb' => $_thumb,
                            'job_id' => $_jobid,
                            'receiver' => strtolower($receiver)
                        );
                    }
                }
            }


            $json['success'] = true;
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    public function get_informations()
    {
        $json = array();
        $this->load->helper(array('category', 'date'));
        $total_notifications = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
            $filter_data = array(
                'publish' => 1,
                'date' => date('Y-m-d')
            );
            $notifications = $this->model_notification->getNotifications($this->user_id, $filter_data);
            if ($notifications) {
                foreach ($notifications as $nkey => $notification) {
                    $notification->timespan = timespan(strtotime($notification->date_added), time(), 1);
                    $user_info = $this->model_user->getUser($notification->sender_id);
                    $user_name = $user_info->first_name . ' ' . $user_info->last_name;
                    $json['user_name'] = $user_name;
                }

                $json['message'] = 'Show';
            } else {
                $json['message'] = 'No Notification Available!';
            }

            $json['data'] = $notifications;
            $json['success'] = true;
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    public function addDeviceDetails()
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
            $device_id = $this->input->post('token');
            $details = $this->model_user->deviceDetails($this->user_id, $device_id);
            if ($details) {
                $json['success'] = true;
                $json['message'] = 'Device Details updated';
            } else {
                $json['error'] = true;
                $json['message'] = 'Details not updated!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }

        echo json_encode($json);
    }

    protected function set_notification_publish($notifications)
    {
        if ($notifications) {
            foreach ($notifications as $notification) {
                $this->model_notification->setNotificationPublish($notification->notification_id, 1);
            }
        }
    }

    protected function validate($type = '')
    {
        $this->user_id = $this->users->isLogged();
        if (!$this->user_id) {
            if ($type == 'return') {
                $this->error['warning'] = 'Please login to your account';
            } else {
                redirect(base_url() . 'login');
            }
        } else {
            $this->loadDetails();
        }

        if ($type == 'return') {
            return !$this->error;
        }
    }

    protected function loadDetails()
    {
        $this->load->helper('user'); // Load user helper
        $this->user_type = $this->users->getUserType();
        $this->load->model('Notification_model', 'model_notification');   //Load notification model
        $this->load->model('Users_model', 'model_user'); //Load User model
    }

    protected function loadErrors()
    {
        if (isset($this->error['warning'])) {
            return $this->error['warning'];
        } elseif (isset($this->error['error'])) {
            return $this->error['error'];
        } else {
            return '';
        }
    }
}
