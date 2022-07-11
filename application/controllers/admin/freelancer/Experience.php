<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Experience extends CI_Controller {
    private $error = array();
    private $freelancer_id;
	private $page_name = 'profile';
    private $freelancerArr = array();
    private $user_id;
    private $experienceDates = array();

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->load->model('freelancer/Experience_model', 'model_experience');

		$this->valid = $this->validate();
	}

	public function index(){

		$json = array();

		if($this->valid){
			$experiences = $this->model_experience->getExperiences($this->freelancer_id);
			if($experiences) {
                foreach($experiences as $experience){
                    $start_date = $experience->cwe_start_date ? json_decode($experience->cwe_start_date) : '';
                    $expStartDate = $start_date ? ($start_date->year . '-'.$start_date->month . '-01') : '';

                    $end_date = $experience->cwe_end_date ? json_decode($experience->cwe_end_date) : '';
                    if($experience->cwe_current_company == 1){
                        $enddate = 'Present';
                        $expEndDate = date('Y-m-d');
                    } else {
                        $enddate = $end_date ? getMonthByKey($end_date->month) . ' ' . $end_date->year : '';
                        $expEndDate = $end_date ? ($end_date->year . '-'.$end_date->month . '-01') : '';
                    }
                    $expTotal = $this->calculateExperience($expStartDate, $expEndDate);

                    $experiencesz[] = array(
                        'freelancer_experience_id' => $experience->freelancer_experience_id,
                        'freelancer_id' => $experience->freelancer_id,
                        'cwe_job_title' => $experience->cwe_job_title,
                        'cwe_company_name' => $experience->cwe_company_name,
                        'cwe_current_company' => $experience->cwe_current_company,
                        'cwe_start_date' =>  $start_date ? getMonthByKey($start_date->month) . ' ' . $start_date->year : '',
                        'cwe_end_date' => $enddate,
                        'cwe_total' => $expTotal,
                        'cwe_date_added' => $experience->cwe_date_added,
                        'cwe_date_modified' => $experience->cwe_date_modified,
                    );
                }

                $json['experiences'] = array('total' => $this->getTotalExperiences(), 'data' => $experiencesz);
                $json['success'] = true;
                $json['message'] = 'show';
            } else {
                $json['error'] = true;
                $json['message'] = 'No experiences found';
            }
		} else {
			$json['error'] = true;
			$json['show'] = true;
			$json['message'] = $this->error['warning'];
		}

		echo json_encode($json);
	}

	public function detail($experience_id){

		$json = array();
		if($this->valid){
			$filter_data['freelancer_id'] = $this->freelancer_id;
			$experience = $this->model_experience->getExperience($experience_id, $filter_data);
			if($experience) {
				$json['success'] = $experience;
				$json['message'] = 'show';
			} else {
				$json['error'] = true;
				$json['message'] = 'No experiences found';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}


		echo json_encode($json);
	}

	public function add(){

		$json = array();
		if($this->valid){
			$experience_id = $this->model_experience->addExperience($this->freelancer_id);
			if($experience_id) {
				$json['success'] = $experience_id;
				$json['message'] = 'experience added successfully';
			} else {
				$json['error'] = true;
				$json['message'] = 'experience detail not added!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}

		echo json_encode($json);
	}

	public function edit($experience_id){

		$json = array();
		if($this->valid){
			$filter_data['freelancer_id'] = $this->freelancer_id;
			$experience = $this->model_experience->getExperience($experience_id, $filter_data);
			if($experience){
				$edit = $this->model_experience->editExperience($experience_id);
				if($edit) {
					$json['success'] = true;
					$json['message'] = 'experience details modified successfully';
				} else {
					$json['error'] = true;
					$json['message'] = 'experience detail not modified!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'experience detail not found!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}

		echo json_encode($json);
	}

	public function delete($experience_id){

		$json = array();

		if($this->valid){
			$experience = $this->model_experience->deleteExperience($experience_id);
			if($experience) {
				$json['success'] = true;
				$json['message'] = 'experience details deleted successfully';
			} else {
				$json['error'] = true;
				$json['message'] = 'experience detail not deleted!';
			}
		}  else {
			$json['error'] = true;
			$json['message'] = $this->error['warning'];
		}

		echo json_encode($json);
	}

	protected function validate() {
		//Check if company user is loggedin or not
		$this->user_id = $this->admin->isLogged();
		if(!$this->user_id) {
		    $this->error['warning'] = 'Please logged in your account';
		} else {
			$this->loadDetails();
		}

		
		return !$this->error;
	}

	protected function loadDetails(){
		$this->load->helper('user'); // Load user helper
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');   //Load company model
        $this->load->model('Users_model', 'model_users');
        $this->adminArr = $this->model_users->getUser($this->user_id);
		$this->freelancerArr = $this->model_freelancer->getFreelancerById($this->input->get('freelancer_id'));
		$this->freelancer_id = isset($this->freelancerArr->freelancer_id) ? $this->freelancerArr->freelancer_id : 0;
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

    protected function calculateExperience($start_date, $end_date){
        if($start_date && $end_date){
            $date1 = date_create($start_date);
            $date2 = date_create($end_date);
            $diff = date_diff($date2, $date1);

            // Get Difference
            $year = isset($diff->y) ? $diff->y : 0;
            $month = isset($diff->m) ? $diff->m : 0;
            $day = isset($diff->d) ? $diff->d : 0;

            //Set two digit values
            $days = ($day < 9) ? '0'.$day : $day;
            $months = ($month < 9) ? '0'.$month : $month;
            $years = ($year < 9) ? '0'.$year : $year;

            $this->experienceDates[] = $year . '-' . $month . '-' . $days;

            $experience = '';
            if($year){
                $experience .= $year . ' Years ';
            }

            if($month){
                $experience .= $month . ' Months';
            }

            return $experience;
        }
    }

    protected function getTotalExperiences(){
        $cdate = date('Y-m-d');
        $diff_str = '';
        $exdate = $cdate;
        if($this->experienceDates){
            foreach($this->experienceDates as $cexperience){
                $exp_str = '';
                //$cexperience = $experience->cwe_experience;

                if($cexperience){
                    $ceArr = explode('-', $cexperience);
                    $year = $ceArr[0] ? (int)$ceArr[0] : 0;
                    $month = $ceArr[1] ? (int)$ceArr[1] : 0;
                    $day = $ceArr[2] ? (int)$ceArr[2] : 0;

                    if($year){
                        $exp_str .= $year . ' years ';
                    }

                    if($month){
                        $exp_str .= $month . ' months ';
                    }

                    if($day){
                        $exp_str .= $day . ' days ';
                    }


                    if($exp_str){
                        $date1 = date_create($exdate);
                        date_add($date1, date_interval_create_from_date_string($exp_str));
                        $exdate = date_format($date1, 'Y-m-d');
                    }
                }
            }
        }

        $diff = date_diff(date_create($exdate), date_create($cdate));
        if($diff->y){
            $diff_str .= $diff->y . ' years ';
        }

        if($diff->m){
            $diff_str .= $diff->m . ' months ';
        }

        /*if($diff->d){
            $diff_str .= $diff->d . ' days ';
        }*/

        return $diff_str;
    }
}
