<?php

function loadJobCategories(){
    $categories = array();
    $CI = &get_instance();

    $CI->load->model('admin/Jobcategory_model', 'model_jobcategory');
    $filter_data = array(
        'status' => 1,
        'sort' => 'j.sort_order',
		'order' => 'ASC'
    );

    $categories['locations'] = $CI->model_jobcategory->getJobLocations();

    $categories['job_categories'] = $CI->model_jobcategory->getCategories(JOB_DESIGNATION_TYPE, $filter_data);

    $categories['job_types'] = $CI->model_jobcategory->getCategories(JOB_TYPE, $filter_data);

	$categories['qualifications'] = $CI->model_jobcategory->getCategories(QUALIFICATION_TYPE, $filter_data);

	$categories['technologies'] = $CI->model_jobcategory->getCategories(TECHNOLOGY_TYPE, $filter_data);

	$categories['experiences'] = $CI->model_jobcategory->getCategories(EXPERIENCE_TYPE, $filter_data);

	$categories['notice_periods'] = $CI->model_jobcategory->getCategories(NOTICE_PERIOD_TYPE, $filter_data);

	$categories['certifications'] = $CI->model_jobcategory->getCategories(CERTIFICATION_TYPE, $filter_data);

	$categories['keywords'] = $CI->model_jobcategory->getCategories(KEYWORD_TYPE, $filter_data);

	return $categories;
}


//Filter Salary Range
function get_salaryrange(){
    $CI = &get_instance();

    $salarymin = 0;
    $salarymax = 2000000;

    $salary_packages = $CI->input->get('filter_salary_packages');
    if($salary_packages){
	    $salarypackages = explode(':', $salary_packages);
	    if($salarypackages){
	        $salarymin = $salarypackages[0];
	        $salarymax = isset($salarypackages[1]) ? $salarypackages[1] :  $salarypackages[0];
	    }
    }
    return array(
        'min' => 0,
        'max' => 2000000,
        'curmin' => $salarymin,
        'curmax' => $salarymax

    );
}

//Filter Budget Range
function get_budget_range(){
    $CI = &get_instance();

    $rangemin = 0;
    $rangemax = 200000;

    $budget_ranges = $CI->input->get('filter_budget_ranges');
    if($budget_ranges){
        $budgetranges = explode(':', $budget_ranges);
        if($budgetranges){
	        $rangemin = $budgetranges[0];
	        $rangemax = isset($budgetranges[1]) ? $budgetranges[1] :  $budgetranges[0];
	    }
    }
    return array(
        'min' => 0,
        'max' => 200000,
        'curmin' => $rangemin,
        'curmax' => $rangemax

    );
}
