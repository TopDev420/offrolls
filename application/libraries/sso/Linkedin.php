<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use LinkedIn\Client;
use LinkedIn\Scope;
use LinkedIn\AccessToken;

class Linkedin {
    private $scopes = [];
    private $CI;

    public function __construct(){
        $this->CI = & get_instance();
    }

    public function generateAuthorizeUrl($config){
        $client = new Client($config['client_id'], $config['client_secret']);
        
        $client->setRedirectUrl($config['redirect']);

        $scopes = [
            'r_liteprofile', 
            'r_emailaddress'
        ];
        $loginUrl = $client->getLoginUrl($scopes);
        $state = $client->getState();
        $this->CI->session->set_userdata('linkedin', ['state' => $state, 'timeout' => date('Y-m-d H:i:s', strtotime('15 minutes'))]);
        return $loginUrl;
    }

    public function getAccessToken($config){
        $client = new Client($config['client_id'], $config['client_secret']);
        
        $client->setRedirectUrl($config['redirect']);

        $scopes = [
            'r_liteprofile', 
            'r_emailaddress'
        ];
        return $client->getAccessToken($this->CI->input->get('code'));
    }

    public function getProfile($config){
        $client = new Client($config['client_id'], $config['client_secret']);
        
        $client->setRedirectUrl($config['redirect']);

        $scopes = [
            'r_liteprofile', 
            'r_emailaddress'
        ];
        print_r($this->CI->input->get('code'));
        $accessToken = $client->getAccessToken($this->CI->input->get('code'));

        $profile = $client->get(
            'me',
            ['fields' => 'ID,firstName,lastName,profilePicture']
        );

        return $profile;
    }

    public function getEmailAddress($config){
        $client = new Client($config['client_id'], $config['client_secret']);
        
        $client->setRedirectUrl($config['redirect']);

        $scopes = [
            'r_liteprofile', 
            'r_emailaddress'
        ];
        $accessToken = $client->getAccessToken($this->CI->input->get('code'));

        $emailAddress = $client->get('emailAddress', ['q' => 'members', 'projection' => '(elements*(handle~))']);

        return $emailAddress;
    }

}

