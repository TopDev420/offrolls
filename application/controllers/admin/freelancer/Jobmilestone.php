<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobmilestone extends CI_Controller {
    private $error = array();
    private $page_name = 'applied_jobs';
    private $user_id;
    private $adminArr = array();
    private $menu_section='freelancer_jobmilestone';

    public function __construct(){
        parent::__construct();
        $this->load->library('admin');
        $this->validate();
    }

    public function index(){
        $data = array();
        if($this->uri->segment(4)) {
            $freelancer_job_id = (int)$this->uri->segment(4);
        } else {
            $freelancer_job_id = 0;
        }

        //Add Css
        $this->document->addStyle(base_url() . 'application/assets/css/include/dashboard.css');

        $this->load->helper('category'); // Load category helper

        $data['moduleAction'] = 'company';

        $data['logged'] = true;
        $data['heading_title'] = 'Accepted Freelancer Jobs';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'company/dashboard'
        );
        $data['breadcrumb'][] = array(
			'name' => 'Accepted Jobs',
			'href' => base_url() . 'company/activity/freelancer/applied'
		);
		$data['active_menu'] = 'mnu-freelancer-applied';
		$data['menu_section'] = $this->menu_section;

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

		$data['job'] = array();
        $data['milestones'] = array();

		// Get Job
        $job = $this->model_job->getFreelancerJob($freelancer_job_id);
		if($job){

            $job_milestones  = $this->model_job->getJobMilestones($job->freelancer_job_id);
            if($job_milestones){
                foreach($job_milestones as $job_milestone){
                    $status = get_status($job_milestone->cjm_status);
                    $data['milestones'][] = array(
                        'amount' => format_currency($job_milestone->cjm_amount),
                        'description' => html_entity_decode($job_milestone->cjm_description),
                        'status' => $status ? $status['name'] : '',
                        'initiator' => ('CMP' == $job_milestone->cjm_initiator) ? true : false,
                        'is_accepted' => $job_milestone->cjm_isAccepted ? $job_milestone->cjm_isAccepted : 0,
                        'is_rejected' => $job_milestone->cjm_isRejected ? $job_milestone->cjm_isRejected : 0,
                        'is_approved' => $job_milestone->cjm_isApproved ? $job_milestone->cjm_isApproved : 0,
                        'is_completed' => $job_milestone->cjm_isCompleted ? $job_milestone->cjm_isCompleted : 0,
                        'is_closed' => $job_milestone->cjm_isClosed ? $job_milestone->cjm_isClosed : 0,
                        'is_payReleased' => $job_milestone->cjm_isPayReleased ? $job_milestone->cjm_isPayReleased : 0,
                        'accept' => base_url() . 'company/activity/freelancer_jobmilestone/accept/' . $job_milestone->freelancer_job_milestone_id,
                        'reject' => base_url() . 'company/activity/freelancer_jobmilestone/reject/' . $job_milestone->freelancer_job_milestone_id,
                        'pay' => base_url() . 'company/activity/freelancer_jobmilestone/pay/' . $job_milestone->freelancer_job_milestone_id,
                        'complete' => base_url() . 'company/activity/freelancer_jobmilestone/complete/' . $job_milestone->freelancer_job_milestone_id,
                        'close' => base_url() . 'company/activity/freelancer_jobmilestone/close/' . $job_milestone->freelancer_job_milestone_id,
                        'edit' => base_url() . 'company/activity/freelancer_jobmilestone/edit/' . $job_milestone->freelancer_job_milestone_id,
                        'change_status' => base_url() . 'company/activity/freelancer_jobmilestone/changeStatus/' . $job_milestone->freelancer_job_milestone_id,
                        'delete' => base_url() . 'company/activity/freelancer_jobmilestone/delete/'. $job_milestone->freelancer_job_milestone_id,
                        'date_added' => $job_milestone->cjm_date_added ? date('d M Y', strtotime($job_milestone->cjm_date_added)) : ''
                    );
                }
            }

			//Load Image
			if($job->freelancer_image && file_exists(APPPATH . 'assets/uploads/logo/' . $job->freelancer_image)){
				$thumb = base_url() . 'application/assets/uploads/logo/' . $job->freelancer_image;
			} else {
				$thumb = base_url() . 'application/assets/uploads/logo/default.png';
			}

            if($job->cj_isRemoved){
                $job_status = 'Removed';
            } else if($job->cj_isAccepted){
                $job_status = 'accepted';
            } else {
                $job_status = 'Applied';
            }

			$data['job'] = array(
                'freelancer_job_id' => $job->freelancer_job_id,
				'job_id' => $job->job_id,
				'freelancer_name' => $job->freelancer_name,
				'title' => $job->title,
				'thumb' => $thumb,
				'location' => $job->location,
                'bid_amount' => format_currency($job->cj_amount),
                'job_duration' => get_project_duration($job->job_duration),
				'isApplied' => $job->cj_isApplied,
				'isAccepted' => $job->cj_isAccepted,
				'isRemoved' => $job->cj_isRemoved,
				'job_status' => $job_status,
				'remove' => base_url() . 'admin/freelancer/jobmilestone/remove/' . $job->freelancer_job_id
			);

            $data['add_milestone_action'] = base_url() . 'admin/freelancer/jobmilestone/add/' . $job->job_id;
            $data['back'] = base_url() . 'company/jobs/freelancer/post/view/' . $job->job_id;
		}

        $data['statuses'] = get_statuses();

        $data['no_fw'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/freelancer/job_milestone');
		$this->load->view('footer');
	}

    public function add($job_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
            $data['logged'] = true;
            //Filter Data
            $filter_data = array(
                'applied' => 1,
                'accepted' => 1,
                'sort' => 'cj.freelancer_job_id',
                'order' => 'DESC'
            );
            // Get Job
            $job = $this->model_job->getFreelancerJobByCJ($this->company->company_id, $job_id, $filter_data);
            if($job){
                $jid = $job->freelancer_job_id;
                //return freelancer_job_id if job exist, otherwise add new one

                /*$recent_job = $this->model_job->getRecentFreelancerJob($this->freelancerArr->freelancer_id, $job_id);
        		if($recent_job){
					$jid = $recent_job->freelancer_job_id;
				}*/

                $milestone_data = array(
                    'initiator' => 'CMP',
                    'description' => $this->input->post('ms_description') ? html_escape($this->input->post('ms_description')) : '',
                    'duration' => $this->input->post('ms_duration'),
                    'requirements' => $this->input->post('ms_requirements') ? html_escape($this->input->post('ms_requirements')) : '',
                    'status' => 101,
                    'amount' => $this->input->post('ms_amount'),
                );
				if($jid){
					$add = $this->model_job->addJobMilestone($jid, $milestone_data);
					if($add){
						$json['success'] = true;
						$json['message'] = 'Milestone added Successfully';
					} else {
						$json['error'] = true;
						$json['message'] = 'Milestone not Added!';
					}
				} else {
					$json['error'] = true;
					$json['message'] = 'Job Not Applied!';
				}
			} else {
				$json['error'] = true;
				$json['message'] = 'No Job Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

    public function edit($freelancer_job_milestone_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
			$data['logged'] = true;
            $milestone_data = array(
                'description' =>  $this->input->post('ms_description') ? html_escape($this->input->post('ms_description')) : '',
                'duration' => $this->input->post('ms_duration'),
                'requirements' => $this->input->post('ms_requirements') ? html_escape($this->input->post('ms_requirements')) : '',
                'status' => 101,
                'amount' => $this->input->post('ms_amount'),
            );
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
            if($job_milestone){
				$edit = $this->model_job->editJobMilestone($freelancer_job_milestone_id, $milestone_data);
                if($edit){
                    $json['success'] = true;
    		        $json['message'] = 'Job Milestone Modified Successfully';
                } else {
                    $json['error'] = true;
    		        $json['message'] = 'Job Milestone Not Modified';
                }
			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

    public function changeStatus($freelancer_job_milestone_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
        	$data['logged'] = true;
            $status = $this->input->post('ms_status');
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
            if($job_milestone){
				$edit = $this->model_job->editJobMilestoneStatus($freelancer_job_milestone_id, $status);
                if($edit){
                    $json['success'] = true;
    		        $json['message'] = 'Job Milestone Status Modified Successfully';
                } else {
                    $json['error'] = true;
    		        $json['message'] = 'Job Milestone Status Not Modified';
                }
			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

    public function detail($freelancer_job_milestone_id){
        $json = array();
    	if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
            if($job_milestone){
				$json['data'] = array(
                    'amount' => (int)$job_milestone->cjm_amount,
                    'description' => html_entity_decode($job_milestone->cjm_description),
                    'duration' => $job_milestone->cjm_duration,
                    'requirements' => $job_milestone->cjm_requirements ? html_entity_decode($job_milestone->cjm_requirements) : '',
                    'status' => $job_milestone->cjm_status
                );
                $json['success'] = true;
			    $json['message'] = 'Job Milestone Deleted';
			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

    public function accept($freelancer_job_milestone_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
            if($job_milestone){
				$accept = $this->model_job->acceptJobMilestone($freelancer_job_milestone_id, 1);
                if($accept){
                    $json['success'] = true;
    			    $json['message'] = 'Job Milestone Accepted';
                } else {
                    $json['error'] = true;
    			    $json['message'] = 'Job Milestone Not Accepted!';
                }
			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

    public function reject($freelancer_job_milestone_id){
        $json = array();
    	if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
            if($job_milestone){
				$reject = $this->model_job->rejectJobMilestone($freelancer_job_milestone_id, 1);
                if($reject){
                    $json['success'] = true;
    			    $json['message'] = 'Job Milestone Rejected';
                } else {
                    $json['error'] = true;
    			    $json['message'] = 'Job Milestone Not Rejected!';
                }
			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

    public function pay($freelancer_job_milestone_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
        	$data['logged'] = true;
            $filter_data = array(
                'accept' => 1,
                'reject' => 0,
                'complete' => 0
            );
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id, $filter_data); // Get Job milestone details
            if($job_milestone){

                $price_breakup = $this->calculatePriceBreakup($job_milestone);  //calculate
                $price_breakup['payer'] = 'CMP';
                $price_breakup['milestone_id'] = $freelancer_job_milestone_id;
                $payment = $this->model_job->getMilestonePaymentByMP($freelancer_job_milestone_id, 'FR');
                if($payment) {
                    $pay_id = $this->model_job->editMilestonePayment($payment->milestone_payment_id, $price_breakup); //set Jobmilestone
                } else {
                    $pay_id = $this->model_job->addMilestonePayment($price_breakup); //set Jobmilestone
                }

                if($pay_id) {
                    $json['success'] = true;
            	    $json['message'] = 'Price breakup calculated';
                    $json['data'] = $price_breakup;
                    $json['data']['pay'] = base_url() . 'company/activity/freelancer_payment/process/' . $pay_id;
                } else {
                    $json['error'] = true;
                    $json['message'] = 'Error occured!';
                }

			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

    protected function calculatePriceBreakup($milestone) {
        $amount = $milestone->cjm_amount;
        $service_fee = 10;
        $service_fee_type = '%';
        $service_amount = ($amount * $service_fee) / 100;
        $total = $amount + $service_amount;
        return array(
            'amount' => $amount,
            'price' => format_currency($amount),
            'service_fee' => $service_fee,
            'service_fee_type' => $service_fee_type,
            'service_amount' => $service_amount,
            'service_price' => format_currency($service_amount),
            'total' => $total,
            'total_price' => format_currency($total),
        );
    }

    public function complete($freelancer_job_milestone_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
			$data['logged'] = true;
            $filter_data = array(
                'accept' => 1,
                'reject' => 0,
                'approve' => 1
            );
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id, $filter_data); // Get Job milestone details
            if($job_milestone){
				$complete = $this->model_job->completeJobMilestone($freelancer_job_milestone_id, 1);
                if($complete){
                    $json['success'] = true;
    			    $json['message'] = 'Job Milestone Completed';
                } else {
                    $json['error'] = true;
    			    $json['message'] = 'Job Milestone Not Completed!';
                }
			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

    public function close($freelancer_job_milestone_id){
        $json = array();
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
			$data['logged'] = true;
            $filter_data = array(
                'accept' => 1,
                'approve' => 1,
                'complete' => 1
            );
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id, $filter_data); // Get Job milestone details
            if($job_milestone){
				$close = $this->model_job->closeJobMilestone($freelancer_job_milestone_id, 1);
                if($close){
                    $json['success'] = true;
    			    $json['message'] = 'Job Milestone Closed';
                } else {
                    $json['error'] = true;
    			    $json['message'] = 'Job Milestone Not Closed!';
                }
			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}
    public function delete($freelancer_job_milestone_id){
        $json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')){
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
            if($job_milestone){
				$delete = $this->model_job->deleteJobMilestone($freelancer_job_milestone_id);
                if($delete){
                    $json['success'] = true;
    			    $json['message'] = 'Job Milestone Deleted';
                } else {
                    $json['error'] = true;
    			    $json['message'] = 'Job Milestone Not Deleted!';
                }
			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}

    protected function validate($type = '') {
    	//Check if company user is loggedin or not
		$this->user_id = $this->admin->isLogged();
		if(!$this->user_id) {
            if($type == 'return'){
                $this->error['warning'] = "Please login to your account";
            } else {
                redirect(base_url() . 'login');
            }
		} else {
			$this->loadDetails();
		}

        if($type == 'return'){
            return !$this->error;
        }
	}

	protected function loadDetails(){
		$this->load->helper(array('user', 'freelancer_category_helper')); // Load helpers
        $this->load->model('Users_model', 'model_user');  // Load Admin User Modal
        $this->load->model('company/Company_model', 'model_company');   //Load company model
        $this->load->model('company/Freelancer_jobs_model', 'model_job'); //Load company jobs model
        $this->load->model('freelancer/Freelancer_model', 'model_freelancer');
		$this->adminArr = $this->model_user->getUser($this->user_id);
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
