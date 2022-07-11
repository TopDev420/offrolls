<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Offrolls, one of the top freelance websites, makes it easy for you to connect and hire freelancers to get your job done.">
    <meta name="keywords" content="freelancing,freelance graphic designer,best freelance websites,best freelancing sites,top freelancing sites,best freelance websites for beginners,freelance platform,freelance projects,top freelance websites,freelancer company,freelancer in hindi">
    <meta name="google-site-verification" content="furms288XR11Mvm5ME4w2O_OT57ejysSz7DApxAJhVo" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php if (isset($meta_title)) { ?>
        <title><?php echo $meta_title; ?></title>
    <?php } else { ?>
        <title>Hire freelancers- Offrolls | Freelancer company in bangalore</title>
    <?php } ?>
    <!-- Bootstrap -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/bootstrap.min.css'); ?>">

    <!-- External Css -->
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/fontawesome-all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/themify-icons.css'); ?>" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?php echo base_url('application/assets/select2/dist/css/select2.min.css'); ?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/style.css'); ?>">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600%7CRoboto:300i,400,500" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url('application/assets/images/favicon.png'); ?>">
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

    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/et-line.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/bootstrap-select.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/plyr.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/flag.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/slick.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/owl.carousel.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/jquery.nstSlider.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('application/assets/fonts/font-awesome/css/font-awesome.min.css'); ?>" />

    <link rel="stylesheet" href="<?php echo base_url('application/assets/css/datetimepicker/jquery.datetimepicker.min.css'); ?>" />

    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/dashboard/css/dashboard.css'); ?>"> -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/vendor/sweet-alert2/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/vendor/rating/icons.min.css'); ?>">


    <!-- Load Custom Styles -->
    <?php $styles = $this->document->getStyles(); ?>
    <?php if ($styles) { ?>
        <?php foreach ($styles as $style) { ?>
            <?php if (isset($style['rel']) && isset($style['href'])) { ?>
                <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" />
            <?php } ?>

        <?php } ?>
    <?php } ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3Q4G1KZJPQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-3Q4G1KZJPQ');
    </script>

</head>

<body>

    <script>
        $(function() {
            $base_url = "<?php echo base_url(); ?>";
            $loading_txt = "<?php echo $this->lang->line('loading'); ?>";
            $updating_txt = "<?php echo $this->lang->line('updating'); ?>";
            $minAge = "<?php echo $this->config->item('minAge', 'restrictions'); ?>";
            $minExperience = "<?php echo $this->config->item('minExperience', 'restrictions'); ?>";
            $maxExperience = "<?php echo $this->config->item('maxExperience', 'restrictions'); ?>";
            $sso_register = false; //initialize sso register
        });
    </script>

    <!-- Response Block -->
    <!-- <div id="jy-response-wrap">
        <div class="jy-alert-box">
            <?php if (isset($success)) { ?>
                <div class="jy-alert success-alert">
                    <div class="jy-alert-inner">
                          <div class="icon"><i class="fas fa-check-circle"></i></div>
                          <h5 class="msg_"><?php echo $success; ?></h5>
                    </div>
                </div>
            <?php } ?>

            <?php if (isset($error)) { ?>
                  <div class="jy-alert danger-alert">
                    <div class="jy-alert-inner">
                          <div class="icon"><i class="fas fa-exclamation-circle"></i></div>
                          <h5 class="msg_"><?php echo $error; ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div> -->

    <div id="jy-alert-wrap"></div>

    <!--Loader section-->
    <div id="jy-loader-section">
        <div class="jy-loader-block">
            <div class="jy-inner-loader">
                <div class="spinner"></div>
                <div class="jy-loader-status"></div>
            </div>
        </div>
    </div>

    <script>
        // $(function(){
        $.extend({
            TIMELINE: {
                loader: function(eblock = '') {
                    let blockElement = '';
                    if (eblock != '' && eblock) {
                        blockElement = eblock.find('[data-timeline-loader=true]');
                    } else {
                        blockElement = $('[data-timeline-loader=true]');
                    }

                    blockElement.html('<div id="timeline-wrapper">' +
                        '<div class="timeline-item">' +
                        '<div class="animated-background">' +
                        '<div class="background-masker strip strip1"></div>' +
                        '<div class="background-masker strip strip2"></div>' +
                        '<div class="background-masker strip strip3"></div>' +
                        '</div>' +
                        '</div>' +
                        '</div>');
                }
            }
        });

        // });
    </script>