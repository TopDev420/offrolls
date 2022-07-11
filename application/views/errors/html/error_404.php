<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ci = new CI_Controller();
$ci = &get_instance();
$ci->load->helper('url');

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>

	<link rel="stylesheet" href="<?php echo base_url('application/assets/css/bootstrap.min.css'); ?>">

    <!-- External Css -->
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/fontawesome-all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/themify-icons.css'); ?>" />

    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600%7CRoboto:300i,400,500" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo base_url('application/assets/images/apple-touch-icon.png'); ?>">

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url('application/assets/js/jquery.min.js'); ?>"></script>

    <script src="<?php echo base_url('application/assets/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('application/assets/js/bootstrap.min.js'); ?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/dashboard/css/dashboard.css'); ?>">

</head>
<body>
	<div class="padding-top-80 section-padding-bottom alice-bg">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="section-padding-150 error-page-wrap text-center white-bg">
              <div class="icon">
                <img src="<?php echo base_url() . 'application/assets/images/error.png'; ?>" class="img-fluid" alt="">
              </div>
              <h2><?php echo $heading; ?></h2>
              <p><?php echo $message; ?></p>
              <a href="<?php echo base_url(); ?>" class="button">Go Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>