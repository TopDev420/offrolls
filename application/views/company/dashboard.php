<!-- Menubar -->
<?php include APPPATH . 'views/company/include/menubar.php'; ?>
<!-- Menubar End -->
<div class="section-default-header"></div>
<div class="ps-page" id="dashboard">
    <?php include APPPATH . 'views/company/include/navbar.php'; ?>
    <div class="ps-dashboard ps-section--sidebar">
        <div class="container">
            <div class="ps-section__container">
                <div class="ps-section__content">
                    <figure>
                        <div class="ps-trending-jobs" id="home-tab">
                            <!-- <h3 class="ps-heading">Projects</h3> -->
                            <div class="ps-section__containe" id="candidates-tbody1">
                                <div class="ps-section__content">
                                    <div class="ps-my-project">
                                    </div>
                                </div>
                            </div>
                            <div class="ps-section__footer text-center" id="searched--freelancers--pagination"></div>
                        </div>
                    </figure>
                </div>
                <div class="ps-section__sidebar">
                    <aside class="widget widget_profile widget_progress">
                        <?php $user = isset($user) ? $user : ''; ?>
                        <?php if ($user) { ?>
                            <div class="ps-block--user">
                                <div class="ps-block__thumbnail"><img src="<?php echo $user['thumb']; ?>" alt=""></div>
                                <div class="ps-block__content">
                                    <h4><?php echo $user['company_name']; ?></h4>
                                    <a href="<?php echo $profile_link; ?>">View your profile<i class="fa fa-caret-right"></i></a>
                                </div>
                            </div>
                        <?php } ?>

                    </aside>
                    <aside class="widget widget_profile widget_connections">
                        <a class="ps-btn" href=""><?php echo $total_projects; ?>-Projects</a>
                        <div class="widget__content">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                                </div>
                            </div>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>application/assets/js/jquery.show-more.js"></script>
<script>
    $(function() {
        //Job Actions
        function loadJobAction(href, current) {
            $.ajax({
                url: href,
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $.FEED.showLoader();
                },
                success: function(res) {
                    if (res.success) {
                        $.ALERT.show('success', res.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    } else if (res.error) {
                        $.ALERT.show('danger', res.message);
                    } else {
                        $.ALERT.show('danger', 'No Data');
                    }
                },
                error: function(xhr, ajaxOptions, errorThrown) {
                    console.log(xhr.responseText + ' ' + xhr.statusText);
                },
                complete: function() {
                    $.FEED.hideLoader();
                }
            });
        }

        $(document).on('click', '#candidates-tbody .btn-remove, #candidates-tbody1 .btn-remove, #candidates-tbody2 .btn-remove', function(e) {
            e.preventDefault();
            var current = $(this);
            var remove_href = $(this).attr('href');
            //Remove Confirm Modal
            $.ALERT.confirm({
                icon: '<i class="fas fa-times-circle"></i>',
                className: 'danger-alert',
                message: 'Are you sure to remove?',
                buttons: ['Remove', 'Cancel'],
                confirm: {
                    remove_callback: function() {
                        loadJobAction(remove_href, current);
                    },
                    cancel_callback: function() {

                    }
                }
            });
        });

    });
</script>
<script>
    $(function() {
        var href_loadActiveJobs = '<?php echo $loadActiveJobs; ?>';
        var href_loadInactiveJobs = '<?php echo $loadInactiveJobs; ?>';
        var href_loadRecentProjects = '<?php echo $loadActiveProjects; ?>';

        var candidates_tbody1 = $('#candidates-tbody1 .ps-my-project');
        var searchedfreelancersPagination = $('#searched--freelancers--pagination');

        //LoadJobs
        function loadJobsView(elementBlock, jobs, type) {
            // elementBlock.html('');
            searchedfreelancersPagination.html('');
            var jobsList = jobs.list;
            if ($.isArray(jobsList) && jobsList.length > 0) {
                $.each(jobsList, function(jkey, job) {

                    let jSkills = '';
                    if (job.skills.length > 0) {
                        jSkills = '<div class="mb-4">';
                        $.each(job.skills, function(skey, skill) {
                            jSkills += '<a class=""> <span class="ps-tag">' + skill + '</span> </a>';
                        });
                        jSkills += '</div>';
                    }

                    var job_actions = '';
                    // if (type == 'drafted') {
                    //     job_actions += '<a data-toggle="tooltip" title="Edit Job" href="' + job.review + '" class="edit"><i data-feather="edit"></i></a>';
                    // }
                    // job_actions += '<a data-toggle="tooltip" title="Remove Job" href="' + job.remove + '" class="remove btn-remove"><i data-feather="x-circle"></i></a>';
                    var completed_project = '';
                    if (job.completed == 1) {
                        completed_project += 'Project Completed';
                    }
                    elementBlock.append('<div class="ps-job ps-job--editable">' +
                        '<div class="ps-job__content">' +
                        '<h4 class="mb-1"><a href="' + job.review + '" class="ps-job__title">' + job.title + '</a></h4>' +
                        '<p>' + job.pay_amount + ' | ' + job.pay_type + ' | ' + job.job_duration + '</p>' +
                        '<p class="mb-4 d-block text-justify short--view" style="line-height: 1.85">' + job.description + '</p><br>' +
                        jSkills +
                        '<div class="ps-job__action">' +
                        // '<a href="' + job.remove + '" class="ps-btn ps-btn--outline ps-btn--sm">Delete</a>' +
                        '<a href="' + job.view + '" class="ps-btn ps-btn--outline ps-btn--sm">' + job.total_applied_jobs + '-Application</a>' +
                        '</div>' +
                        '<p><small>Posted on ' + job.date_posted + '</small></p>' +
                        '<p><small>' + completed_project + '</small></p>' +
                        '</div>' +
                        '</div>');
                });

                elementBlock.find('.short--view').showMore({
                    minheight: 80,
                    buttontxtmore: '...more',
                    buttontxtless: '...less',
                    animationspeed: 250
                });

                if (jobs.pagination) {
                    let viewMore = jobs.pagination;
                    if (parseInt(viewMore.page) > 1) {
                        searchedfreelancersPagination.html('<a class="ps-link--viewmore" href="' + viewMore.href + '"><span class="ps-icon--dots"><i></i></span> View more</a>');

                        searchedfreelancersPagination.find('a.ps-link--viewmore').click(function(e) {
                            e.preventDefault();
                            let page_link = $(this).attr('href');
                            // loadJobsView(jobs, page_link);
                            loadJobs(candidates_tbody1, page_link, 'projects');
                        });
                    }
                }
            } else {
                elementBlock.append('<div class="card-body job-items">' +
                    '<div class="text-center" colspan="4">' +
                    '<h5 >No Jobs Found</h5>' +
                    '</div>' +
                    '</div>');
            }

            feather.replace(); // Load feater icons
        }

        function clampPara(element) {
            let maxLength = 300;
            let paraLength = element.text().length;
            if (paraLength > maxLength) {
                element.addClass('clamp-para-3');
                /*element.next('<p class="m-0"><a href="javascript:void(0)" class="btn-show-more"><strong class="theme-default">more</strong></a></p>');

                element.parent().find('.btn-show-more').click(function(e){
                    e.preventDefault();
                });*/
            }
        }

        function loadJobs(element, href, type) {
            $.ajax({
                url: href,
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    searchedfreelancersPagination.html('<div class="ps-link--viewmore"><span class="ps-icon--dots"><i></i></span> Loading <span class="ps-icon--dots"><i></i></span></div>');
                },
                success: function(res) {
                    if (res.success) {
                        loadJobsView(element, res.jobs, type);
                    } else if (res.error) {
                        $.ALERT.show('danger', res.message);
                    } else {
                        $.ALERT.show('danger', 'No Data');
                    }
                },
                error: function(xhr, ajaxOptions, errorThrown) {
                    console.log(xhr.responseText + ' ' + xhr.statusText);
                },
                complete: function() {
                    element.find('tr.job-items td').attr('data-timeline-loader', 'false');
                }
            });
        }


        //Ontab click load Jobs
        // $("a[href='\#published-jobs\']").click(function(e){
        //     if($(this).hasClass('active')){
        //         e.preventDefault();
        //     } else {
        //         loadJobs(candidates_tbody, href_loadActiveJobs, 'published');
        //     }
        // });

        // $("a[href='\#drafted-jobs\']").click(function(e) {
        //     if ($(this).hasClass('active')) {
        //         e.preventDefault();
        //     } else {
        //         loadJobs(candidates_tbody1, href_loadInactiveJobs, 'drafted');
        //     }
        // });

        // $("a[href='\#published-projects\']").click(function(e) {
        //     if ($(this).hasClass('active')) {
        //         e.preventDefault();
        //     } else {
        //         loadJobs(candidates_tbody2, href_loadRecentProjects, 'projects');
        //     }
        // });

        loadJobs(candidates_tbody1, href_loadRecentProjects, 'projects');
        //Load Active Jobs
        // loadJobs(candidates_tbody, href_loadActiveJobs, 'published');


    });
</script>