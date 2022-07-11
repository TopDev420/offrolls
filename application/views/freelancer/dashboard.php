<!-- Menubar -->
<?php include APPPATH . 'views/freelancer/include/menubar.php'; ?>
<!-- Menubar End -->
<div class="section-default-header"></div>

<style>
    .user-info h5 {
        font-size: 1.8rem;
    }

    p {
        font-size: 1.4rem !important;
    }

    strong.theme-default {
        font-weight: 500;
        color: #212529;
    }
</style>

<?php $searchQuery = isset($searchQuery) ? $searchQuery : ''; ?>

<!-- Navbar -->
<?php include APPPATH . 'views/freelancer/include/navbar.php'; ?>

<div class="ps-page">
    <div class="ps-section--sidebar ps-listing dashboard">
        <div class="container" id="card-body-blocks">
            <div class="ps-section__container">
                <div class="ps-section__content">
                    <div class="ps-section__search">
                        <h3>Find Projects</h3>
                        <form class="ps-form--job-search" id="jobSearchIn" action="#" method="get">
                            <div class="form-group"><i class="fa fa fa-search"></i>
                                <input class="form-control" name="search" type="text" value="<?php echo $searchQuery; ?>" placeholder="Enter job title">
                                <button type="submit" class="ps-btn ps-btn--gradient">Find Now</button>
                            </div>
                        </form>
                    </div>
                    <div class="ps-section__items">
                        <!-- <h4 class="ps-heading--2 mb-40 ps--totals">0 results</h4> -->
                        <div class="ps-employers-block">
                            <div class="ps-employer" data-timeline-loader="true"></div>
                            <hr>
                            <div class="ps-employer" data-timeline-loader="true"></div>
                            <hr>
                            <div class="ps-employer" data-timeline-loader="true"></div>
                            <hr>
                        </div>
                    </div>
                    <div class="ps-section__footer text-center ps--pagination"></div>
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
                    <div class="widget widget_profile widget_find-employers">
                        <h3 class="widget-title">Find a Projects</h3>
                        <!-- Filter -->
                        <?php include APPPATH . 'views/freelancer/include/job_filter.php'; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>application/assets/js/jquery.show-more.js"></script>
<script>
    $(function() {
        var href_loadJobs = '<?php echo $loadJobs; ?>';
        var cardBodyBlocks = $('#card-body-blocks .ps-employers-block');
        var searchedJobsPagination = $('#card-body-blocks .ps--pagination');
        var totalJobsBlock = $('#card-body-blocks .ps--totals');

        //LoadJobs
        function loadJobsView(elementBlock, jobs) {
            if (jobs.total) {
                //totalJobsBlock.html('<span>' + jobs.total + ' Results</span>');
            } else {
                totalJobsBlock.html('');
            }

            elementBlock.html('');
            searchedJobsPagination.html('');
            var jobsList = jobs.list;
            if ($.isArray(jobsList) && jobsList.length > 0) {
                $.each(jobsList, function(jkey, job) {
                    let jSkills = '';
                    $.each(job.skills, function(skey, skill) {
                        jSkills += '<span class="ps-tag">' + skill + '</span>';
                    });

                    let job_location = '';
                    if (job.location) {
                        job_location = '<span class="mr-4">' +
                            '<i class="fa fa-map-marker" aria-hidden="true"></i> ' +
                            '<strong class="theme-default">' + job.location + '<strong>' +
                            '</span>';
                    }
                    elementBlock.append('<div class="ps-employer">' +
                        '<div class="col-12">' +
                        '<div class="row">' +
                        '<div class="col-12 pt-5">' +
                        '<div class="d-flex">' +
                        '<div class="user-info">' +
                        '<div class="mb-4">' +
                        '<h5 class="font-500"><a href="' + job.view_job + '" class="title-h5 job--title--text">' + job.title + ' </a></h5>' +
                        '<p class="mb-0"><strong class="theme-default">' + job.pay_type + ': ' + job.pay_amount + '-' + job.experience_level + ' - Time: ' + job.job_duration + ' - posted ' + job.post_date + '.</strong></p>' +
                        '</div>' +

                        '<div class="info info-content mb-4">' +
                        '<div class="row">' +
                        '<div class="col-12">' +
                        '<div class="d-block short--view"><p class="mb-2 text-justify">' + job.description + ' </p></div>' +
                        '</div>' +
                        '<br>' +
                        '<div class="col-12">' +
                        jSkills +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-12 mb-2">' +

                        '<div class="bottom-info row">' +
                        '<div class="col-md-8">' +
                        '<span class="mr-4">' +
                        '<i class="fas fa-check-circle "></i> ' +
                        '<strong class="theme-default" class="">Payment verified</strong>' +
                        '</span>' +
                        '<span class="mr-4"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></span>' +
                        job_location +
                        '</div>' +
                        '<div class="col-md-4 text-md-right">' +
                        '<span class="mr-4">Proposals : <strong class="theme-default">' + job.applied_freelancers + '</strong></span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>');
                });


                if (jobs.view_more) {
                    let viewMore = jobs.view_more;
                    if (parseInt(viewMore.page) > 1) {
                        searchedJobsPagination.html('<a class="ps-link--viewmore" href="' + viewMore.href + '"><span class="ps-icon--dots"><i></i></span> View more</a>');

                        searchedJobsPagination.find('a.ps-link--viewmore').click(function(e) {
                            e.preventDefault();
                            let page_link = $(this).attr('href');
                            loadSearchJobs(jobBlocks, page_link);
                        });
                    }
                }

            } else {
                elementBlock.append('<div class="ps-employer">' +
                    '<div class="text-center" colspan="4">' +
                    '<h5 >No Jobs Found</h5>' +
                    '</div>' +
                    '</div>');
            }

            feather.replace();
            elementBlock.find('.short--view').showMore({
                minheight: 80,
                buttontxtmore: '...more',
                buttontxtless: '...less',
                animationspeed: 250
            });
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

        function loadAcceptedJobs(element, href) {
            $.ajax({
                url: href,
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    element.find('tr.job-items td').attr('data-timeline-loader', 'true');
                    // Load Timeline Loader
                    $.TIMELINE.loader(element);
                },
                success: function(res) {
                    if (res.success) {
                        loadJobsView(element, res.jobs);
                    } else if (res.error) {
                        //$.ALERT.show('danger', res.message);
                        Toast.fire({
                            icon: 'error',
                            title: res.message,
                        });
                    } else {
                        //$.ALERT.show('danger', 'No Data');
                        Toast.fire({
                            icon: 'error',
                            title: 'No Data',
                        });
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

        loadAcceptedJobs(cardBodyBlocks, href_loadJobs);

        //Search Submit
        $('#jobSearchIn').submit(function(e) {
            e.preventDefault();
            $.FEED.showLoader(); //Show Loader

            var $cur = $(this);
            var csq = '';
            var searchQuery = $cur.find('input[name=\'search\']').val();
            if (searchQuery) {
                csq = '?csq=' + encodeURIComponent(searchQuery);
            }

            window.location.href = $base_url + 'freelancer/search/jobs' + csq;
        });
    });
</script>