<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['home'] = 'Home/index';
$route['freelancer'] = 'freelancer/Home/index';
$route['jobseeker'] = 'candidate/Home/index';
$route['about'] = 'about/About/index';
$route['hirefreelancer'] = 'company/search/Freelancer/index';
$route['freelancerproject'] = 'freelancer/Search/jobs';

// Admin
$route['admin'] = 'admin/Login/index';
$route['admin/freelancer'] = 'admin/freelancer/Freelancer/index';
$route['admin/freelancer/:num'] = 'admin/freelancer/Freelancer/index/$1';
$route['admin/freelancer/view/:num'] = 'admin/freelancer/Freelancer/view/$1';
$route['admin/freelancer/job'] = 'admin/freelancer/Job/index';
$route['admin/freelancer/job/:num'] = 'admin/freelancer/Job/index';
$route['admin/freelancer/jobmilestone/:num'] = 'admin/freelancer/Jobmilestone/index';


$route['admin/candidate'] = 'admin/candidate/Candidate/index';
$route['admin/candidate/:num'] = 'admin/candidate/Candidate/index/$1';
$route['admin/candidate/view/:num'] = 'admin/candidate/Candidate/view/$1';
$route['admin/candidate/job'] = 'admin/candidate/Job/index';
$route['admin/candidate/job/:num'] = 'admin/candidate/Job/index';

$route['admin/company'] = 'admin/company/Company/index';
$route['admin/company/:num'] = 'admin/company/Company/index/$1';
$route['admin/company/view/:num'] = 'admin/company/Company/view/$1';


// Recruiter
$route['company'] = 'company/Login/index';
$route['company/search/jobseeker'] = 'company/search/candidate';
$route['company/search/getFreelancers'] = 'company/search/freelancer/getFreelancers';
$route['company/search/getFreelancers/:num'] = 'company/search/freelancer/getFreelancers/$1';
$route['company/freelancer/rating/add'] = 'company/activity/freelancer/addRating';

//Candidate
$route['companies'] = 'candidate/Search/companies';
$route['jobs'] = 'candidate/Search/jobs';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
