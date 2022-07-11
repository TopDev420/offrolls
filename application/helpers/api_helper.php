<?php

function pushNotification($device_id, $message)
{

    //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';
    /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
    $api_key = 'AAAAFmU0JVU:APA91bEXnlv0A2p_-_T_YkhypgF0HuIKNZcpIwV1aRJLZldKo85i9gdVYKj4CN5NSlHeXO2j61JyqNJLWGWDpZBzXq-DaRQW8VWAR4mmjo-cKUus7sMBeWhfntdZPyQX9MBOJOCOgDmU';
    // $msg = [
    //     'title' => 'FCM Notification',
    //     'body' => 'FCM Notification from codesolution',
    //     'icon' => 'img/icon.png',
    //     'image' => 'img/c.png',
    //   ];     
    $fields = array(
        'registration_ids' => array($device_id),
        'data' => $message
    );

    //header includes Content type and api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key=' . $api_key
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
