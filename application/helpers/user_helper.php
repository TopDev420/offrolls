<?php

//Get Module Action
function getUserType($type_name)
{
    $type_id = 0;
    switch ($type_name) {
        case 'company':
            $type_id = COMPANY_TYPE;
            break;
        case 'candidate':
            $type_id = CANDIDATE_TYPE;
            break;
        case 'freelancer':
            $type_id = FREELANCER_TYPE;
            break;
        case 'admin':
            $type_id = ADMIN_TYPE;
            break;
        default:
    }

    return $type_id;
}

//Get Module Action
function getModuleAction($user_type)
{
    $moduleName = '';
    switch ($user_type) {
        case COMPANY_TYPE:
            $moduleName = 'company';
            break;
        case CANDIDATE_TYPE:
            $moduleName = 'candidate';
            break;
        case FREELANCER_TYPE:
            $moduleName = 'freelancer';
            break;
        case ADMIN_TYPE:
            $moduleName = 'admin';
            break;
        default:
    }

    return $moduleName;
}

//Get Module Action URL
function getModuleActionURL($user_type)
{
    $moduleURL = false;
    switch ($user_type) {
        case COMPANY_TYPE:
            $moduleURL = base_url() . 'company/dashboard';
            break;
        case CANDIDATE_TYPE:
            $moduleURL = base_url() . 'candidate/dashboard';
            break;
        case FREELANCER_TYPE:
            $moduleURL = base_url() . 'freelancer/dashboard';
            break;
        case ADMIN_TYPE:
            $moduleURL = base_url() . 'admin/dashboard';
            break;
        default:
            $moduleURL = base_url() . 'home';
    }

    return $moduleURL;
}

function get_profile_status($userdata, $type = '')
{
    $profile_status = 0;

    if ($userdata) {
        if ($userdata->email) {
            $profile_status += 10;
        }

        if ($type == 'company') {
            if ($userdata->company_name) {
                $profile_status += 10;
            }

            if ($userdata->first_name) {
                $profile_status += 5;
            }

            if ($userdata->last_name) {
                $profile_status += 5;
            }
        } else {
            if ($userdata->first_name) {
                $profile_status += 10;
            }

            if ($userdata->last_name) {
                $profile_status += 10;
            }
        }

        if ($userdata->mobile) {
            $profile_status += 10;
        }

        if ($userdata->address) {
            $profile_status += 10;
        }

        if ($userdata->city) {
            $profile_status += 10;
        }

        if ($userdata->state) {
            $profile_status += 10;
        }

        if ($userdata->country) {
            $profile_status += 10;
        }

        // if ($userdata->about) {
        //     $profile_status += 10;
        // }

        if ($userdata->image && file_exists(APPPATH . 'assets/uploads/logo/' . $userdata->image)) {
            $profile_status += 20;
        }
    }
    return $profile_status;
}

function get_user_account($user_id)
{
    $CI = &get_instance();
    $CI->load->model('Users_model', 'model_users');

    $account = array();
    $user = $CI->model_users->getUser($user_id);
    if ($user) {
        $type = getModuleAction($user->user_type);

        //Load Image
        if ($user->image && file_exists(APPPATH . 'assets/uploads/logo/' . $user->image)) {
            $thumb = base_url() . 'application/assets/uploads/logo/' . $user->image;
        } else {
            if ($type == 'freelancer') {
                $thumb = base_url() . 'application/assets/uploads/logo/default_freelancer.png';
            } else {
                $thumb = base_url() . 'application/assets/uploads/logo/default.png';
            }
        }

        $account = array(
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
            'thumb' => $thumb,
            'status' => $user->status
        );
    }
    return $account;
}

function get_statuses()
{
    $statuses = array(
        array('id' => 101, 'name' => 'Pending'),
        array('id' => 102, 'name' => 'Processing'),
        array('id' => 103, 'name' => 'Processed'),
        array('id' => 104, 'name' => 'Completed'),
    );

    return $statuses;
}


function get_status($status_id)
{
    $statuses = get_statuses();
    $statusz = array();
    if ($statuses) {
        foreach ($statuses as $skey => $status) {
            if ($status['id'] == $status_id) {
                $statusz = $statuses[$skey];
                break;
            }
        }
    }

    return $statusz;
}
