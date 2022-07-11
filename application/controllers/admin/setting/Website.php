<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {
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
        $data['heading_title'] = 'Website';    //Heading Title

        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'admin/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Website Setting',
            'href' => base_url() . 'admin/setting/website'
        );

        $data['breadcrumb_actions'][] = array(
            'type' => 'ajax',
            'id' => 'btn-save',
            'name' => 'Save',
            'icon' => 'fas fa-save'
        );

        $data['active_menu'] = 'mnu-setting-website';

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

        $website = $this->model_admin_setting->getSettings('website');

        if(isset($website->first_name)){
            $data['first_name'] = $website->first_name;
        } else {
            $data['first_name'] = '';
        }

        if(isset($website->last_name)){
            $data['last_name'] = $website->last_name;
        } else {
            $data['last_name'] = '';
        }

        if(isset($website->company_name)){
            $data['company_name'] = $website->company_name;
        } else {
            $data['company_name'] = '';
        }

        if(isset($website->email)){
            $data['email'] = $website->email;
        } else {
            $data['email'] = '';
        }

        if(isset($website->mobile)){
            $data['mobile'] = $website->mobile;
        } else {
            $data['mobile'] = '';
        }

        if(isset($website->telephone)){
            $data['telephone'] = $website->telephone;
        } else {
            $data['telephone'] = '';
        }

        if(isset($website->description)){
            $data['about'] = html_entity_decode($website->description);
        } else {
            $data['about'] = '';
        }


        //Address
        if(isset($website->street_name)){
            $data['street_name'] = $website->street_name;
        } else {
            $data['street_name'] = '';
        }

        if(isset($website->city)){
            $data['city'] = $website->city;
        } else {
            $data['city'] = '';
        }

        if(isset($website->state)){
            $data['state'] = $website->state;
        } else {
            $data['state'] = '';
        }

        if(isset($website->country)){
            $data['country'] = $website->country;
        } else {
            $data['country'] = '';
        }

        if(isset($website->pincode)){
            $data['pincode'] = $website->pincode;
        } else {
            $data['pincode'] = '';
        }

        //Social
        if(isset($website->facebook_page)){
            $data['facebook_page'] = $website->facebook_page;
        } else {
            $data['facebook_page'] = '';
        }

        if(isset($website->twitter_page)){
            $data['twitter_page'] = $website->twitter_page;
        } else {
            $data['twitter_page'] = '';
        }

        if(isset($website->instagram_page)){
            $data['instagram_page'] = $website->instagram_page;
        } else {
            $data['instagram_page'] = '';
        }

        if(isset($website->linkedin_page)){
            $data['linkedin_page'] = $website->linkedin_page;
        } else {
            $data['linkedin_page'] = '';
        }

        $data['no_fw'] = true;
    	$this->load->view('header', $data);
		$this->load->view('admin/setting/website');
		$this->load->view('footer');
    }

    public function save() {

        $json = array();
        $resp = array();
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $posts = $this->input->post(NULL, TRUE);
            if($posts) {
                foreach($posts as $code => $value){
                    $setting = $this->model_admin_setting->getSetting('website', $code);
                    if($setting) {
                        $set = $this->model_admin_setting->editSetting($setting->setting_id, html_escape($value));
                    } else {
                        $set = $this->model_admin_setting->addSetting('website', $code, html_escape($value));
                    }

                    if($set) {
                        array_push($resp, 1);
                    } else {
                        array_push($resp, 0);
                    }
                }

                if(in_array(0, $resp) == false){
                    $json['message'] = 'Website settings are saved';
                } else {
                    $json['message'] = 'Website settings are saved... but some error is there';
                }

                $json['success'] = true;
            } else {
                $json['error'] = true;
                $json['message'] = 'No Post Values';
            }
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
