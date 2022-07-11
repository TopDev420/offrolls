<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    private $error= array();
    public function __construct(){
        parent::__construct();
        $this->load->library('recruiter');
        $this->load->helper('user'); // Load user helper
        $this->load->model('Users_model', 'model_users');   // Load Users Model
        $this->load->model('company/Company_model', 'model_company');

        $this->validate();
    }

    public function index(){

        $user_id = $this->recruiter->getId();
        $profile_progress = 0;
        $data = array();

        //add Css
        //$this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');
        $data['logged'] = $this->recruiter->isLogged();
        $data['heading_title'] = 'Profile';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
        	'href' => base_url() . 'company/dashboard'
		);
		$data['breadcrumb'][] = array(
			'name' => 'Profile',
			'href' => base_url() . 'company/profile'
		);
		$data['active_menu'] = 'mnu-profile';

        //If redirect Exist
        if($this->input->get('redirect')){
            $data['redirect'] = $this->input->get('redirect');
        } else {
            $data['redirect'] = '';
        }

		if($this->session->userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		}

		if($this->session->userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}

        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); // Load Job Category Model

		$data['company'] = array(); $company_category = array();
		$social_profiles = array();
		$user_id = $this->recruiter->getId();

		$company = $this->model_company->getCompany($user_id);

		if($company){

		    $profile_progress = get_profile_status($company, 'company');

            $company_categoryz = $this->model_jobcategory->getCategory($company->company_category); // Get Company Category

            $company_category = array(
                'label' => isset($company_categoryz->name) ? $company_categoryz->name : '',
                'value' => isset($company_categoryz->category_id) ?$company_categoryz->category_id : '',
            );

            $social_profiles = $this->model_users->getSocialProfiles($company->user_id);

		}

		//User account
		$data['user'] = get_user_account($user_id, 'company');
		$data['profile_progress'] = $profile_progress;

        if(isset($company->first_name)){
    		$data['company']['first_name'] = $company->first_name;
		} else {
			$data['company']['first_name'] = '';
		}

        if(isset($company->last_name)){
    		$data['company']['last_name'] = $company->last_name;
		} else {
			$data['company']['last_name'] = '';
		}

		if(isset($company->company_name)){
			$data['company']['name'] = $company->company_name;
		} else {
			$data['company']['name'] = '';
		}

		if(isset($company->image)){
			$company_image = $company->image;
		} else {
			$company_image= '';
		}

		//Load Image
		if($company_image && is_readable(APPPATH . 'assets/uploads/logo/' . $company_image)){
			$data['company']['image'] = $company_image;
			$data['company']['thumb'] = base_url() . 'application/assets/uploads/logo/' . $company_image;
		} else {
			$data['company']['thumb'] = base_url() . 'application/assets/uploads/logo/default.png';
			$data['company']['image'] = '';
		}

		if($company_category){
			$data['company']['company_category'] = $company_category;
		} else {
			$data['company']['company_category'] = array();
		}

		if(isset($company->email)){
			$data['company']['email'] = $company->email;
		} else {
			$data['company']['email'] = '';
		}

		if(isset($company->mobile)){
			$data['company']['mobile'] = $company->mobile;
		} else {
			$data['company']['mobile'] = '';
		}

		if(isset($company->landline)){
			$data['company']['landline'] = $company->landline;
		} else {
			$data['company']['landline'] = '';
		}

		if(isset($company->web_link)){
			$data['company']['web_link'] = $company->web_link;
		} else {
			$data['company']['web_link'] = '';
		}

		if(isset($company->about)){
			$data['company']['about'] = $company->about;
		} else {
			$data['company']['about'] = '';
		}

		if(isset($company->gst_no)){
			$data['company']['gst_no'] = $company->gst_no;
		} else {
			$data['company']['gst_no'] = '';
		}

		if(isset($company->pan_no)){
			$data['company']['pan_no'] = $company->pan_no;
		} else {
			$data['company']['pan_no'] = '';
		}

		if(isset($company->address)){
			$data['company']['address'] = $company->address;
		} else {
			$data['company']['address'] = '';
		}

		if(isset($company->city)){
			$data['company']['city'] = $company->city;
		} else {
			$data['company']['city'] = '';
		}

		if(isset($company->state)){
			$data['company']['state'] = $company->state;
		} else {
			$data['company']['state'] = '';
		}

		if(isset($company->country)){
			$data['company']['country'] = $company->country;
		} else {
			$data['company']['country'] = '';
		}

		if(isset($company->pin_code)){
			$data['company']['pin_code'] = $company->pin_code;
		} else {
			$data['company']['pin_code'] = '';
		}

		if($profile_progress >= 80){
			$data['company']['is_profileCompleted'] = 1;
		} else {
			$data['company']['is_profileCompleted'] = 0;
		}

		if(isset($social_profiles['facebook'])){
			$data['company']['facebook_profile'] = $social_profiles['facebook'];
		} else {
			$data['company']['facebook_profile'] = '';
		}

		if(isset($social_profiles['instagram'])){
			$data['company']['instagram_profile'] = $social_profiles['instagram'];
		} else {
			$data['company']['instagram_profile'] = '';
		}

		if(isset($social_profiles['linkedin'])){
			$data['company']['linkedin_profile'] = $social_profiles['linkedin'];
		} else {
			$data['company']['linkedin_profile'] = '';
		}

		if(isset($company->status)){
			$data['company']['status'] = $company->status;
		} else {
			$data['company']['status'] = '';
		}

		//Company Categories
		$filter_data = array(
			'status' => 1
		);
		$data['company_categories'] = $this->model_jobcategory->getCategories(COMPANY_CATEGORY_TYPE, $filter_data);
        $data['moduleAction'] = 'company';

		$this->load->view('header', $data);
		$this->load->view('company/profile');
		$this->load->view('footer');
	}

	public function editName() {
	    $json=array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {
            $result = $result1 = '';
		    $social_profiles = $this->input->post('social_profiles');
			$user_id = $this->recruiter->getId();
			$company = $this->model_company->getCompany($user_id);
			if($company){

                $user_data = array(
            		'first_name' => $this->input->post('first_name'),
        			'last_name' => $this->input->post('last_name'),
        		);
                $result = $this->model_users->setUserName($company->user_id, $user_data);
			}

			if($result) {
				$json['success'] = true;
				$json['message'] = 'Personal details added/modified successfully';
			} else {
			    $json['error'] = true;
				$json['message'] = 'Personal details not added/modified!';
			}
		}

		echo json_encode($json);
	}

    public function editCompany() {
        $json=array();
		if($this->input->server('REQUEST_METHOD') == 'POST') {

            $result = '';
			$user_id = $this->recruiter->getId();
			$company = $this->model_company->getCompany($user_id);
			if($company){
				$result = $this->model_company->editCompany($company->company_id);
			}

			if($result) {
				$json['success'] = true;
				$json['message'] = 'Company details added/modified successfully';
			} else {
			    $json['error'] = true;
				$json['message'] = 'Company details not added/modified!';
			}
		}

		echo json_encode($json);
	}

    public function editLocation() {
        $json=array();
    	if($this->input->server('REQUEST_METHOD') == 'POST') {

            $result = '';
			$user_id = $this->recruiter->getId();
			$company = $this->model_company->getCompany($user_id);
			if($company){
				$result = $this->model_company->editLocation($company->company_id);
			}

			if($result) {
				$json['success'] = true;
				$json['message'] = 'Location details added/modified successfully';
			} else {
			    $json['error'] = true;
				$json['message'] = 'Location details not added/modified!';
			}
		}

		echo json_encode($json);
	}

    public function editSocialLinks() {
        $json=array();
    	if($this->input->server('REQUEST_METHOD') == 'POST') {

            $result = '';
		    $social_profiles = $this->input->post('social_profiles');
			$user_id = $this->recruiter->getId();
			$company = $this->model_company->getCompany($user_id);
			if($company){
				if($social_profiles){
    		        foreach($social_profiles as $sm_name => $link){
			            $sm = $this->model_users->getSocialProfile($user_id, $sm_name);
			            if($sm){
			                $this->model_users->updateSocialProfile($sm->social_profile_id, $link);
			            } else {
			                $this->model_users->addSocialProfile($user_id, $sm_name, $link);
			            }
			        }

                    $json['success'] = true;
    			    $json['message'] = 'Social Links added/modified successfully';

			    } else {
                    $json['error'] = true;
    			    $json['message'] = 'Social Links not added/modified!';
                }
			} else {
                $json['error'] = true;
    		    $json['message'] = 'Company Details Not Availabe';
            }

		}

		echo json_encode($json);
	}

	protected function validate() {
		if(!$this->recruiter->isLogged()) {
			$this->session->set_userdata('jobredirect', array('page' => 'dashboard', 'url' => current_url()));
			redirect(base_url() . 'login');
		}
	}


    //Save profile_image
    public function save_picture(){
        $json = array();
        $user_id = $this->recruiter->getId();
        $userInfo = $this->model_users->getUser($user_id);
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $upload_path = APPPATH . 'assets/uploads/logo/';

            //Upload Picture
			$upload = array();
			if(isset($_FILES['profile_image'])){
                if(!empty($_FILES['profile_image']['name'])) {
                    $upload = $this->savePicture($_FILES['profile_image'], $user_id);
                }
            } else {
            	if(!empty($this->input->post('profile_image'))) {
                    $upload = $this->savePicture($this->input->post('profile_image'), $user_id, '', 'blob');
                }
            }

            //Unlink Existing Image
            $thumb = $userInfo->image;
            if($thumb){
                if(is_readable($upload_path . $thumb)){
                    unlink($upload_path . $thumb);
                }
            }

            if($upload){
            	$json = $upload;
            } else {
                $json['error'] = true;
                $json['message'] = 'Upload image not available!';
            }
        }

        echo json_encode($json);
    }

    //Save image
    public function savePicture($uploadImage, $user_id, $thumb='', $uploadType='file') {
        $json = array();
        $json['success'] = false;
        $json['error'] = false;
        $file_upload = false;

        if(!empty($uploadImage)) {
	        
	        // Load file storage library
	        $file_storage = 'Default';
	        if($file_storage){
	        	$this->load->library('storage/'. ucfirst($file_storage) . '_storage', NULL, 'fileStorage');
	        	if($uploadType == 'blob'){

	        		$file_data = array(
			        	'newname' => 'cmppic' . date('YmdHis'). $user_id,
			        	'upload_path' => APPPATH . 'assets/uploads/logo/',
			        	'blob' => $uploadImage,
			        	'extension' => 'png',
			        	'type' => 'image/png',
			        	'upload_file' => 'profile_image',
			        );

	        		$file_upload = $this->fileStorage->uploadBlobFile($file_data);
		        	if($thumb){
		        		$this->fileStorage->deleteFile($file_data['upload_path'].$thumb);
		        	}
	        	} else {

	        		$extension = pathinfo($uploadImage['name'], PATHINFO_EXTENSION);
			        $filename = pathinfo($uploadImage['name'], PATHINFO_FILENAME);
			        $file_data = array(
			        	'name' => $filename,
			        	'newname' => $filename . 'pic' . date('YmdHis'). $user_id,
			        	'extension' => $extension,
			        	'tmp_name' => $uploadImage['tmp_name'],
			        	'type' => $uploadImage['type'],
			        	'allowed_types' => 'jpeg|jpg|png',
			        	'upload_file' => 'profile_image',
			        	'upload_path' => APPPATH . 'assets/uploads/logo/'
			        );

	        		$file_upload = $this->fileStorage->uploadFile($file_data);
		        	if($thumb){
		        		$this->fileStorage->deleteFile($file_data['upload_path'].$thumb);
		        	}
	        	}
	        	
	        }
	        
	        $file_upload_status = isset($file_upload['status']) ? $file_upload['status'] : false;
            if($file_upload_status){
                $saveImage = $this->model_company->saveImage($user_id, $file_upload['name']);
                if($saveImage){
                    $json['success'] = true;
                    $json['message'] = 'Image uploaded';
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Image not uploaded!';
                }
            } else {
                $json['error']= true;
                $json['message'] = $file_upload['message'];
            }
        } else {
            $json['error']= true;
            $json['message'] = 'Please upload image file!';
        }
        

        return $json;
    }

 
}
