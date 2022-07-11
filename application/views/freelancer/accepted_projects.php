    <!-- Menubar -->
    <?php include APPPATH . 'views/freelancer/include/menubar.php'; ?>
    <!-- Menubar End -->
    <style type="text/css">
        .jy-card .nav-tabs .nav-item.show .nav-link,
        .jy-card .nav-tabs .nav-link.active {
            background-color: #4CB9BD !important;
            border-color: #4CB9BD !important;
            color: white !important;
        }
    </style>

    <!-- Navbar -->
    <?php include APPPATH . 'views/freelancer/include/navbar.php'; ?>

    <div class="section-default-header"></div>


    <div class="ps-page">
        <div class="ps-section--sidebar ps-listing dashboard">
            <div class="container" id="card-body-blocks">
                <div class="ps-section__container">
                    <div class="ps-section__content">
                        <h3 class="ps-section--heading1 ps-padrt-md-100">Accepted Jobs</h3>
                        <div class="ps-padrt-md-100">

                            <!-- Accepted Projects -->
                            <div class="jy-card card mb-5 border-0" id="myjobs-accepted">
                                <div class="card-body p-0">
                                    <div class="manage-job-container">
                                        <div class="pb-4 jobs-block">
                                            <div class="job-items" data-timeline-loader="true"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ps-section__sidebar ps-section__filter">
                        <?php $user = isset($user) ? $user : ''; ?>
                        <?php if ($user) { ?>
                            <div class="widget widget_profile widget_edit-profile">
                                <a href="<?php echo $profile_link; ?>"><i class="fa fa-sliders"></i><span>Edit Profile</span><img src="<?php echo $user['thumb']; ?>" alt=""></a>
                                <div class="mt-4 p-4">
                                    <p class="mb-4">Setup your account</p>
                                    <div class="ps-progress"><span><?php echo $user['progress'] . '%'; ?></span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $user['progress']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                <a class="ps-btn ps-btn--outline ps-btn--sm pl-5" href="<?php echo base_url() . 'freelancer/job'; ?>">My Projects</a>
                            </div> -->
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>


        <script type="text/javascript" src="<?php echo base_url(); ?>application/assets/js/jquery.show-more.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>application/assets/js/include/freelancer/job_accepted.js"></script>
        <script>
            $(function() {
                $('.nav-tabs a').on('shown.bs.tab', function() {
                    let tid = $(this).attr('href');
                    $(tid).find('.short--view').showMore({
                        minheight: 80,
                        buttontxtmore: '...more',
                        buttontxtless: '...less',
                        animationspeed: 250
                    });
                });
            });
        </script>