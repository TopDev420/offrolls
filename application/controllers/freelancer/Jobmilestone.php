<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobmilestone extends CI_Controller
{
	private $error = array();
	private $freelancer_id;
	private $page_name = 'job';
	private $freelancerArr = array();
	private $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('freelancer');
		$this->load->model('freelancer/Jobs_model', 'model_job');

		$this->load->helper('category');
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
			//$freelancer_id = $this->freelancer->getId();
			$job = $this->model_job->getJob($job_id);
			if ($job) {
				$jid = 0;
				//return freelancer_job_id if job exist, otherwise add new one
				$recent_job = $this->model_job->getRecentFreelancerJob($this->freelancerArr->freelancer_id, $job_id);
				if ($recent_job) {
					$jid = $recent_job->freelancer_job_id;
				}

				$milestone_data = array(
					'initiator' => 'FR',
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
							'body' => 'A new Milestone is created by Freelancer.',
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
				// 'description' =>  $this->input->post('ms_description') ? html_escape($this->input->post('ms_description')) : '',
				// 'duration' => $this->input->post('ms_duration'),
				// 'requirements' => $this->input->post('ms_requirements') ? html_escape($this->input->post('ms_requirements')) : '',
				'status' => $this->input->post('ms_status'),
				// 'amount' => $this->input->post('ms_amount'),
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

	public function detail($freelancer_job_milestone_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
			if ($job_milestone) {
				$json['data'] = array(
					'amount' => (int)$job_milestone->cjm_amount,
					'description' => $job_milestone->cjm_description,
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

	public function accept($freelancer_job_milestone_id, $company_user_id)
	{
		$json = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
			$data['logged'] = true;
			$job_milestone = $this->model_job->getJobMilestone($freelancer_job_milestone_id); // Get Job milestone details
			if ($job_milestone) {
				$accept = $this->model_job->acceptJobMilestone($freelancer_job_milestone_id, 1);
				if ($accept) {
					$msg = [
						'title' => 'A new milestone is created!',
						'body' => 'A new Milestone is created by Freelancer.',
					];
					$user_info = $this->model_user->getUser($company_user_id);
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
		//Check if freelancer user is loggedin or not
		$this->user_id = $this->freelancer->isLogged();
		if (!$this->user_id) {
			if ($type == 'return') {
				$this->error['warning'] = 'Please login to your account';
			} else {
				redirect(base_url() . 'home');
			}
		} else {
			$this->loadDetails();
		}


		//Check if freelancer user has verified or not
		$profile_status = $this->getProfileStatus('freelancer');
		if (!$profile_status) {
			if ($type == 'return') {
				$this->error['error'] = 'Please complete profile';
			} else {
				redirect(base_url() . 'freelancer/profile');
			}
		}


		/*if(!$freelancer_resume->is_published){
            if($type == 'return'){
				$this->error['error'] = 'Please publish your resume';
			} else {
				redirect(base_url() . 'freelancer/resume');
			}
        }*/


		if ($type == 'return') {
			return !$this->error;
		}
	}

	protected function loadDetails()
	{
		$this->load->helper(array('user', 'api')); // Load user helper
		$this->load->model('freelancer/freelancer_model', 'model_freelancer');   //Load company model
		$this->load->model('Users_model', 'model_user'); //Load user model
		$this->freelancerArr = $this->model_freelancer->getFreelancer($this->user_id);
		$this->freelancer_id = isset($this->freelancerArr->freelancer_id) ? $this->freelancerArr->freelancer_id : 0;
	}

	//Check profile status. If it is below 80, redirect to profile page. Otherwise return status
	protected function getProfileStatus($type)
	{
		if ($this->user_id) {
			$profile_progress = get_profile_status($this->freelancerArr, $type);
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
