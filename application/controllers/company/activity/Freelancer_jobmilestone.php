<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freelancer_jobmilestone extends CI_Controller
{
	private $error = array();
	private $page_name = 'applied_jobs';
	private $user_id;
	private $company = array();
	private $menu_section = 'freelancer_jobmilestone';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('recruiter');
		$this->validate();
	}

	public function index()
	{
		exit();
	}

	public function add($job_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
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
			if ($job) {
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
				if ($jid) {
					$add = $this->model_job->addJobMilestone($jid, $milestone_data);
					if ($add) {
						$msg = [
							'title' => 'A new milestone is created!',
							'body' => 'A new Milestone is created by Company.',
						];
						$user_info = $this->model_user->getUser($job->user_id);
						// foreach ($user_info as $user_token) {
						pushNotification($user_info->device_details, $msg);
						// }
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

	public function edit($freelancer_job_milestone_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$milestone_data = array(
				'description' =>  $this->input->post('ms_description') ? html_escape($this->input->post('ms_description')) : '',
				'duration' => $this->input->post('ms_duration'),
				'requirements' => $this->input->post('ms_requirements') ? html_escape($this->input->post('ms_requirements')) : '',
				'status' => 101,
				'amount' => $this->input->post('ms_amount'),
			);
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
			if ($job_milestone) {
				$edit = $this->model_job->editJobMilestone($freelancer_job_milestone_id, $milestone_data);
				if ($edit) {
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

	public function changeStatus($freelancer_job_milestone_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$status = $this->input->post('ms_status');
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
			if ($job_milestone) {
				$edit = $this->model_job->editJobMilestoneStatus($freelancer_job_milestone_id, $status);
				if ($edit) {
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

	public function detail($freelancer_job_milestone_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
			if ($job_milestone) {
				$json['data'] = array(
					'amount' => (int)$job_milestone->cjm_amount,
					'description' => html_entity_decode($job_milestone->cjm_description),
					'duration' => $job_milestone->cjm_duration,
					'requirements' => $job_milestone->cjm_requirements ? html_entity_decode($job_milestone->cjm_requirements) : '',
					'status' => $job_milestone->cjm_status
				);
				$json['success'] = true;
				$json['message'] = 'Job Milestone Available';
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

	public function accept($freelancer_job_milestone_id, $freelancer_user_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
			if ($job_milestone) {
				$accept = $this->model_job->acceptJobMilestone($freelancer_job_milestone_id, 1);
				if ($accept) {
					$msg = [
						'title' => 'Milestone accepted!',
						'body' => 'Your Milestone was accepeted by the company.',
					];
					$user_info = $this->model_user->getUser($freelancer_user_id);
					// foreach ($user_info as $user_token) {
					pushNotification($user_info->device_details, $msg);
					// }
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

	public function reject($freelancer_job_milestone_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
			if ($job_milestone) {
				$reject = $this->model_job->rejectJobMilestone($freelancer_job_milestone_id, 1);
				if ($reject) {
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

	public function pay($freelancer_job_milestone_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$filter_data = array(
				'accept' => 1,
				'reject' => 0,
				'complete' => 0
			);
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id, $filter_data); // Get Job milestone details
			if ($job_milestone) {

				$price_breakup = $this->calculatePriceBreakup($job_milestone);  //calculate
				$price_breakup['payer'] = 'CMP';
				$price_breakup['milestone_id'] = $freelancer_job_milestone_id;
				$payment = $this->model_job->getMilestonePaymentByMP($freelancer_job_milestone_id, 'CMP');
				if ($payment) {
					$pay_id = $this->model_job->editMilestonePayment($payment->milestone_payment_id, $price_breakup); //set Jobmilestone
				} else {
					$pay_id = $this->model_job->addMilestonePayment($price_breakup); //set Jobmilestone
				}

				if ($pay_id) {
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

	protected function calculatePriceBreakup($milestone)
	{
		$service_amount = 0;
		$service_fee_type = '';
		$amount = $milestone->cjm_amount;
		$service_fee = getSetting('payment', 'company_service_fee');
		$service_fee_type = getSetting('payment', 'service_fee_type');
		if ($service_fee) {
			if ($service_fee_type == 'percentage') {
				$service_amount = ($amount * $service_fee) / 100;
			} else {
				$service_amount = ($amount + $service_fee);
			}
		}

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

	/*public function deposit($freelancer_job_milestone_id){
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
                $price_breakup = $this->calculatePriceBreakup($job_milestone);
				$json['success'] = true;
        		$json['message'] = 'Redirecting to Payment Gateway';
                $json['redirect'] = base_url() . 'company/activity/freelancer_payment/process/'. $freelancer_job_milestone_id;
			} else {
				$json['error'] = true;
				$json['message'] = 'Job Milestone Not Available!';
			}
		} else {
			$json['error'] = true;
			$json['message'] = $this->loadErrors();
		}

		echo json_encode($json);
	}*/

	public function complete($freelancer_job_milestone_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$filter_data = array(
				'accept' => 1,
				'reject' => 0,
				'approve' => 1
			);
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id, $filter_data); // Get Job milestone details
			if ($job_milestone) {
				$complete = $this->model_job->completeJobMilestone($freelancer_job_milestone_id, 1);
				if ($complete) {
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

	public function close($freelancer_job_milestone_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$filter_data = array(
				'accept' => 1,
				'approve' => 1,
				'complete' => 1
			);
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id, $filter_data); // Get Job milestone details
			if ($job_milestone) {
				$close = $this->model_job->closeJobMilestone($freelancer_job_milestone_id, 1);
				if ($close) {
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

	public function delete($freelancer_job_milestone_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
			if ($job_milestone) {
				$delete = $this->model_job->deleteJobMilestone($freelancer_job_milestone_id);
				if ($delete) {
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

	protected function validate($type = '')
	{
		//Check if company user is loggedin or not
		$this->user_id = $this->recruiter->isLogged();
		if (!$this->user_id) {
			if ($type == 'return') {
				$this->error['warning'] = "Please login to your account";
			} else {
				redirect(base_url() . 'login');
			}
		} else {
			$this->loadDetails();
		}

		$profile_status = $this->getProfileStatus('company');
		if (!$profile_status) {
			if ($type == 'return') {
				$this->error['warning'] = "Please complete your profile";
			} else {
				$this->session->set_userdata('jobredirect', array('page' => $this->page_name, 'url' => current_url()));
				redirect(base_url() . 'company/profile?redirect=' . $this->page_name);
			}
		}

		// Check commission agree
		if (!$this->company->isCommissionAgreed) {
			if ($type == 'return') {
				$this->error['error'] = "Please agree commission policy!";
			} else {
				$this->document->addAlert('commission', 'info');
			}
		}

		if ($type == 'return') {
			return !$this->error;
		}
	}

	protected function loadDetails()
	{
		$this->load->helper(array('user', 'freelancer_category_helper', 'api')); // Load helpers
		$this->load->model('company/Company_model', 'model_company');   //Load company model
		$this->load->model('company/Freelancer_jobs_model', 'model_job'); //Load company jobs model
		$this->load->model('Users_model', 'model_user'); //Load user model
		$this->company = $this->model_company->getCompany($this->user_id);
	}


	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type)
	{
		if ($this->user_id) {
			$this->company = $this->model_company->getCompany($this->user_id);
			$profile_progress = get_profile_status($this->company, $type);
			if ($profile_progress < 80) {
				return false;
			} else {
				return $profile_progress;
			}
		} else {
			return true;
		}
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
