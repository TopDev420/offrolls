<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Check whether the site is offline or not.
 *
 */

class Maintenance_hook {

    public function offline(){

        if(file_exists(APPPATH.'config/config.php')){

            include(APPPATH.'config/config.php');

            $base_url = $config['base_url'] . '/';
            if(isset($config['maintenance_mode']) && $config['maintenance_mode'] === TRUE){
                include_once(APPPATH . 'views/maintenance.php');
                exit;
            }
        }

    }
}
