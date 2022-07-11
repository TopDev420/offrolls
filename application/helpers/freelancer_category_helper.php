<?php

    //Job Types
    $project_durations = array(
        12 => 'Less than 1 Month',
        13 => '1 to 3 Months',
        14 => '3 to 6 Months',
        15 => 'More than 6 Months'
    );
    define('PROJECT_DURATIONS', $project_durations);

    function get_project_durations(){
        return PROJECT_DURATIONS;
    }

    function get_project_duration($id){
		$project_durations = PROJECT_DURATIONS;
		return isset($project_durations[$id]) ? $project_durations[$id] : '';
	}


    //Project Types
    $project_types = array(
        'onetime' => 'One Time Project',
        // 'complex' => 'Complex Project',
        'ongoing' => 'Ongoing Project'
	);
	define('PROJECT_TYPES', $project_types);

	function get_project_types(){
		return PROJECT_TYPES;
	}

	function get_project_type($id){
		$project_types = PROJECT_TYPES;
		return isset($project_types[$id]) ? $project_types[$id] : '';
	}

    //Project Time Period
    $project_time_periods = array(
        21 => 'Less than 30hr/week',
        22 => 'More than 30hr/week',
        23 => 'I dont know'
    );
	define('PROJECT_TIME_PERIODS', $project_time_periods);

	function get_project_time_periods(){
		return PROJECT_TIME_PERIODS;
	}

	function get_project_time_period($id){
		$project_time_periods = PROJECT_TIME_PERIODS;
		return isset($project_time_periods[$id]) ? $project_time_periods[$id] : '';
	}


    //PAY TYPES
    $pay_types = array(
        'hourly' => 'Pay by hourly',
        'fixed' => 'Pay a fixed price',
	);
	define('PAY_TYPES', $pay_types);

	function get_pay_types(){
		return PAY_TYPES;
	}

	function get_pay_type($id){
		$pay_types = PAY_TYPES;
		return isset($pay_types[$id]) ? $pay_types[$id] : '';
	}

    //Languages
    $languages = array(
        'en' => 'English',
        'ka' => 'Kannada',
        'kl' => 'Malayalam',
        'ta' => 'Tamil',
        'hi' => 'Hindi'
    );
	define('LANGUAGES', $languages);

	function get_languages(){
		return LANGUAGES;
	}

	function get_language($id){
		$languages = LANGUAGES;
		return isset($languages[$id]) ? $languages[$id] : '';
	}

	// Experience Levels

	function get_experience_levels(){
		return array(
	        ['id' => 1, 'value' => 'fresher', 'name' => 'Fresher'],
	        ['id' => 2, 'value' => 'experienced', 'name' => 'Experienced']
	    );
	}
