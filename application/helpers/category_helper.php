<?php

    //Job Types
    $job_types = array(
		1 => 'Part Time' ,
		2 => 'Full Time'
	);
	define('JOB_TYPES', $job_types);

	function get_job_types(){
		return JOB_TYPES;
	}

	function get_job_type($id){
		$job_types = JOB_TYPES;
		return isset($job_types[$id]) ? $job_types[$id] : '';
	}

    //Gender
    $genders = array(
		1 => 'Male' ,
		2 => 'Female',
		3 => 'Any'
	);
	define('GENDERS', $genders);

	function get_genders(){
		return GENDERS;
	}

	function get_gender($id){
		$gender = GENDERS;
		return isset($gender[$id]) ? $gender[$id] : '';
	}

	function get_genderid_by_name($name){
	    $genderid = 0;
		$genders = GENDERS;
		foreach($genders as $gkey => $gender){
		    if(strtolower($gender) == strtolower($name)){
		        $genderid = $gkey;
		        break;
		    }
		}
		return $genderid;
	}


	//Salary Periods
	$salary_periods = array(
		1 => 'Per Week' ,
		2 => 'Per Month' ,
		3 => 'Per Year'
	);

	define('SALARY_PERIODS', $salary_periods);
	function get_salary_periods(){
		return SALARY_PERIODS;
	}

	function get_salary_period($id){
		$salary_periods = SALARY_PERIODS;
		return isset($salary_periods[$id]) ? $salary_periods[$id] : '';
	}

	function get_salary_periodvalue($id){
		$salary_periods = array(
    		1 => 52 ,
    		2 => 12 ,
    		3 => 1
    	);

		return isset($salary_periods[$id]) ? $salary_periods[$id] : 0;
	}

	//Filter Date Posts
    $dateposts = array(
		'1_hour' => 'Last hour' ,
		'24_hours' => 'Last 24 hour',
		'7_days' => 'Last 7 days',
		'14_days' => 'Last 14 days',
		'30_days' => 'Last 30 days',
	);
	define('DATEPOSTS', $dateposts);

	function get_dateposts(){
		return DATEPOSTS;
	}

	function getDate_of_datepost_by_name($name){
	    $datepost_date = '';
		$dateposts = DATEPOSTS;
		foreach($dateposts as $dkey => $datepost){
		    if(preg_replace('[\s]', '-', strtolower($datepost)) == preg_replace('[\s]', '-', strtolower($name))){
		        $datepost_day = preg_replace('/_/', ' ', $dkey);
		        $datepost_date = date('Y-m-d', strtotime('- '.$datepost_day));
		        break;
		    }
		}

		return $datepost_date;
	}


    //Jobseeker Processes
	function get_jobseeker_processes(){
		return array(
            201 => 'Applied',
            202 => 'Shortlisted',
            203 => 'Interview Scheduled',
            204 => 'Offer & Join',
            205 => 'Rejected'
        );
	}

	function get_jobseeker_status($id){
		$statuses = get_jobseeker_statuses();
		return isset($statuses[$id]) ? $statuses[$id] : '';
	}

