<?php

function getParam($arg){
    $CI = &get_instance();
    if($CI->input->get($arg)){
        $value = $CI->input->get($arg);
    } else if($CI->input->post($arg)){
        $value = $CI->input->post($arg);
    } else {
        $value = '';
    }

    return $value;
}

//Check Web URL
function format_weblink($link)
{
    if ($link) {
        $lpos = strpos($link, 'http://');
        if ($lpos) {
            return $link;
        } else {
            return 'http://' . $link;
        }
    } else {
        return $link;
    }
}

//View date Picker Format Function
function date_picker_format($date)
{
    return date('d/m/Y', strtotime($date));
}

//View date Format Function
function view_date_format($date)
{
    return date('d/M/Y', strtotime($date));
}

//change given date to db date format
function dbdate_format($date)
{
    $rdate = str_replace('/', '-', $date);
    $gdate = strtotime($rdate);
    return date('Y-m-d', $gdate);
}

//find date difference
function date_difference($date)
{
    $date1 = date_create($date);
    $date2 = date_create(date('Y-m-d'));
    $diff = date_diff($date1, $date2);
    return $diff;
}

//Check redirect url exist in session, return url if exist
function getRedirectURL($redirect_page)
{
    $CI = &get_instance();
    $session_redirect = $CI->session->userdata('jobredirect');
    $session_redirect_page = isset($session_redirect['page']) ? $session_redirect['page'] : '';
    $session_redirect_url = isset($session_redirect['url']) ? $session_redirect['url'] : '';

    if ($redirect_page == $session_redirect_page) {
        if ($session_redirect_url) {
            $CI->session->unset_userdata('jobredirect');
            return $session_redirect_url;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

//change amount(20000) to currency format(₹ 20,000.00)
function format_currency($number, $value = '', $format = true)
{
    $symbol_left = '₹';
    $symbol_right = '';
    $decimal_place = '';

    if (!$value) {
        $value = 1;
    }

    $amount = $value ? (float)$number * $value : (float)$number;

    $amount = round($amount, (int)$decimal_place);

    if (!$format) {
        return $amount;
    }

    $string = '';

    if ($symbol_left) {
        $string .= $symbol_left;
    }

    $string .= number_format($amount, (int)$decimal_place, '.', ',');

    if ($symbol_right) {
        $string .= $symbol_right;
    }

    return $string;
}


//Months

function getMonths()
{
    $months = array(
        '01' => "Jan",
        '02' => "Feb",
        '03' => "Mar",
        '04' => "Apr",
        '05' => "May",
        '06' => "Jun",
        '07' => "Jul",
        '08' => "Aug",
        '09' => "Sep",
        '10' => "Oct",
        '11' => "Nov",
        '12' => "Dec"
    );
    return $months;
}

function getMonthByKey($mkey)
{
    $months = getMonths();
    return isset($months[$mkey]) ? $months[$mkey] : '';
}

//Years
$years = array();
for ($y = 1980; $y <= date('Y'); $y++) {
    $years[] = $y;
}
rsort($years);
define('YEARS', $years);

function getYears()
{
    return YEARS;
}

//Copy Image from url
function saveImageFromURL($image_url, $image_path)
{
    file_put_contents($image_path, file_get_contents($image_url));
}


//get Age in years
function get_age($user_dob)
{
    $user_ndob = dbdate_format($user_dob);
    $date1 = date_create($user_ndob);
    $date2 = date_create(date('Y-m-d'));
    $diff = date_diff($date2, $date1);
    return $diff->y;
}

//Setting
function getSetting($keyword, $code)
{
    $CI = &get_instance();
    $CI->db->reset_query(); //Reset Query Builder
    $condition = array(
        'keyword' => $keyword,
        'code' => $code
    );
    $CI->db->where($condition);
    $query = $CI->db->get('setting');
    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->value;
    } else {
        return '';
    }
}

function getSettings($keyword)
{
    $CI = &get_instance();
    $CI->db->reset_query(); //Reset Query Builder
    $condition = array(
        'keyword' => $keyword
    );
    $CI->db->where($condition);
    $query = $CI->db->get('setting');
    if ($query->num_rows() > 0) {
        $result_array = array();
        $results = $query->result();
        foreach ($results as $result) {
            $result_array[$result->code] = $result->value;
        }
        return (object)$result_array;
    } else {
        return false;
    }
}

function generateStringCode($string)
{
    return preg_replace('/[^a-z0-9]/', '_', strtolower($string));
}
