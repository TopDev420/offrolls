<?php

class Cron extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->validate(); //check user agent
    }

    public function moveJobsToArchive(){
        //Freelancer
        $this->load->model('company/Jobs_model', 'model_candidate_job'); //Load candidate jobs model
        //Filter Data
        $filter_data = array(
            'applied' => 1,
            'archived' => 0,
            'removed' => 0,
            'pipelined' => 0,
            'filter_date_limit' => date('Y-m-d', strtotime('-'. $this->config->item('MJTAL', 'restrictions')))
        );

        // Get Job List
        $candidate_jobs = $this->model_candidate_job->getAllCandidateJobs($filter_data);
        if($candidate_jobs){
            foreach($candidate_jobs as $cjob){


                //check actions, if no action happened, move to archive.
                $action = 0;

                /*if($cjob->cj_isCompleted == 1){
                    $action = $cjob->cj_isCompleted;
                }

                if($cjob->cj_isScheduled == 1){
                    $action = $cjob->cj_isScheduled;
                }

                if($cjob->cj_isShortListed == 1){
                    $action = $cjob->cj_isShortListed;
                }*/

                if($action == 0){
                    echo '<br><pre>';
        print_r($cjob);
        echo '</pre>';
                    $this->model_candidate_job->setCandidateJobActivity($cjob->candidate_job_id, array('archived' => 1));
                }
            }
        }
    }

    protected function validate(){
        if(!is_cli()){
            exit('No direct script access allowed');
        }
    }
}
