<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
    private $user_id;
    private $adminArr = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); // Check if admin is loggedin

        $this->lang->load(array('admin/category'));    //Load Language
    }

    public function index() {
        $data['logged'] = true;
        $data['heading_title'] = 'Payment';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'admin/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Payment Setting',
			'href' => base_url() . 'admin/setting/payment'
		);

        $data['breadcrumb_actions'][] = array(
            'type' => 'ajax',
            'id' => 'btn-save',
            'name' => 'Save',
            'icon' => 'fas fa-save'
		);

		$data['active_menu'] = 'mnu-setting-payment';

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

        //Get Admin Detail
    	$data['admin'] = get_user_account($this->user_id);

        $payment = $this->model_admin_setting->getSettings('payment');

        if(isset($payment->company_service_fee)){
            $data['company_service_fee'] = $payment->company_service_fee;
        } else {
            $data['company_service_fee'] = '';
        }
        
        if(isset($payment->freelancer_service_fee)){
            $data['freelancer_service_fee'] = $payment->freelancer_service_fee;
        } else {
            $data['freelancer_service_fee'] = '';
        }

        if(isset($payment->gateway_name)){
            $data['gateway_name'] = $payment->gateway_name;
        } else {
            $data['gateway_name'] = '';
        }

        if(isset($payment->gateway_key)){
            $data['gateway_key'] = $payment->gateway_key;
        } else {
            $data['gateway_key'] = '';
        }

        if(isset($payment->gateway_secret)){
            $data['gateway_secret'] = $payment->gateway_secret;
        } else {
            $data['gateway_secret'] = '';
        }
        
        if(isset($payment->gateway_url)){
            $data['gateway_url'] = $payment->gateway_url;
        } else {
            $data['gateway_url'] = '';
        }

        $data['no_fw'] = true;
    	$this->load->view('header', $data);
		$this->load->view('admin/setting/payment');
		$this->load->view('footer');
    }

    public function save() {

        $json = array();
        $resp = array();
        if($this->input->server('REQUEST_METHOD') == 'POST') {

            $payment_datas = array(
                'company_service_fee' => $this->input->post('company_service_fee') ? $this->input->post('company_service_fee') : 0,
                'freelancer_service_fee' => $this->input->post('freelancer_service_fee') ? $this->input->post('freelancer_service_fee'): 0,
                'service_fee_type' => 'percentage',
                'gateway_name' => $this->input->post('gateway_name'),
                'gateway_key' => $this->input->post('gateway_key'),
                'gateway_secret' => $this->input->post('gateway_secret'),
                'gateway_url' => $this->input->post('gateway_url'),
            );
            foreach($payment_datas as $code => $value){
                $setting = $this->model_admin_setting->getSetting('payment', $code);
                if($setting) {
                    $set = $this->model_admin_setting->editSetting($setting->setting_id, $value);
                } else {
                    $set = $this->model_admin_setting->addSetting('payment', $code, $value);
                }

                if($set) {
                    array_push($resp, 1);
                } else {
                    array_push($resp, 0);
                }
            }

            if(in_array(0, $resp) == false){
                $json['message'] = 'Payment settings are saved';
            } else {
                $json['message'] = 'Payment settings are saved... but some error is there';
            }

            $json['success'] = true;
        } else {
            $json['error'] = true;
        }

        echo json_encode($json);
    }

    protected function loadDetails(){
    	$this->load->helper('user'); // Load user helper
        $this->load->model('Users_model', 'model_user');
        $this->load->model('admin/Setting_model', 'model_admin_setting');
		$this->adminArr = $this->model_user->getUser($this->user_id);
	}

    protected function validate() {
        $this->user_id = $this->admin->isLogged();
    	if(!$this->user_id) {
			redirect(base_url() . 'admin/login');
		} else {
            $this->loadDetails();
        }
	}
}
