    <!-- Menubar -->
    <?php include APPPATH . 'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->
    <div class="section-default-header"></div>

    <?php include APPPATH . 'views/company/include/navbar.php'; ?>

    <?php $post_date = timespan(strtotime($job['post_date']), time(), 1); ?>
    <div class="ps-page">
        <div class="ps-section--sidebar ps-listing">
            <div class="container">
                <div class="ps-section__container">
                    <div class="ps-section__content">
                        <div class="ps-job--detail">
                            <div class="ps-job--detail">
                                <div class="ps-job__header">
                                    <?php if (isset($job['job_category']) && $job['job_category']) { ?>
                                        <h2><?php echo html_escape($job['title']); ?></h2>
                                        <p>Created: <strong><?php echo $post_date; ?> Ago.</strong> <?php echo $job['pay_type']; ?>: <span class="ps-highlight"><?php echo $job['pay_amount']; ?></span>| <i class="fa fa-map-marker"></i> <strong><?php echo $job['location'] ? html_escape($job['location']) : '  '; ?></strong></p>
                                        <figure>
                                            <figcaption>Category<span class="ps-highlight"> <?php echo html_escape($job['job_category']); ?></span></figcaption>
                                            <div class="ps-job__rating">
                                                <?php if ($job['status']) { ?>
                                                    <?php if ($job['isApplied'] == 0) { ?>
                                                        <a href="<?php echo $job['draft']; ?>" class="save-btn d-block ps-btn ps-btn--sm ps-btn--shadow mb-2" id="btn-draft-post"><i class="fa fa-heart"></i> Draft</a>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <a href="<?php echo $job['edit']; ?>" class="save-btn d-block ps-btn ps-btn--sm ps-btn--white ps-btn--shadow mb-2"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="<?php echo $job['publish']; ?>" class="save-btn d-block ps-btn ps-btn--sm ps-btn--shadow border-default mb-2" id="btn-publish-post"><i class="fa fa-heart"></i> Publish</a>
                                                <?php } ?>
                                            </div>
                                        </figure>
                                    <?php } ?>
                                </div>
                                <div class="ps-job__content ps-document">
                                    <figure>
                                        <figcaption class="ps-heading--2 text-justify">Project Description</figcaption>
                                        <p class="text-justify"><?php echo $job['description']; ?></p>
                                    </figure>
                                    <figure>
                                        <figcaption class="ps-heading--2">Skills required</figcaption>
                                        <p>
                                            <?php if ($job['job_skills']) { ?>
                                                <?php foreach ($job['job_skills'] as $job_skill) { ?>
                                                    <span class="ps-highlight"><?php echo ($job_skill); ?></span>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <span class="ps-tag"> No skills</span>
                                            <?php } ?>
                                        </p>
                                    </figure>
                                    <figure>
                                        <!-- <figcaption class="ps-heading--2">Company introduction</figcaption> -->
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                                                <div class="ps-job__desc">
                                                    <h6>Project Duration</h6>
                                                    <p><span class="ps-highlight"><?php echo $job['job_duration']; ?></span></p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                                                <div class="ps-job__desc">
                                                    <h6>Language</h6>
                                                    <p>
                                                        <?php if ($job['languages']) { ?>
                                                            <?php foreach ($job['languages'] as $job_language) { ?>
                                                                <span class="ps-tag"><?php echo $job_language; ?></span>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <span class="ps-tag"></span>
                                                        <?php } ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                                                <div class="ps-job__desc">
                                                    <h6>Project Type</h6>
                                                    <p><span class="ps-highlight"><?php echo $job['job_type']; ?></span></p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                                                <div class="ps-job__desc">
                                                    <h6>Experience Level</h6>
                                                    <p>
                                                        <span class="ps-highlight">
                                                            <?php if ($job['experience_level'] == 'experienced') { ?>
                                                                <?php echo $job['experience'] ?>
                                                            <?php } else { ?>
                                                                <?php echo $job['experience_level']; ?>
                                                            <?php } ?>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                                                <div class="ps-job__desc">
                                                    <h6>specialization</h6>
                                                    <p><span class="ps-highlight"><?php echo $job['job_specialization']; ?></span></p>
                                                </div>
                                            </div>
                                            <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                                                <div class="ps-job__desc">
                                                    <h6>specialization</h6>
                                                    <p>
                                                        <span class="ps-highlight">
                                                            <?php if ($job['job_time_period']) { ?>
                                                                <?php foreach ($project_time_periods as $tpkey => $time_period) { ?>
                                                                    <?php echo $time_period; ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div> -->
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#btn-publish-post, #btn-draft-post').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function() {
                        $.FEED.showLoader();
                    },
                    success: function(res) {
                        if (res.success) {
                            //$.ALERT.show('success', res.message);
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            });
                            if (res.notify) {
                                $.post(res.notify);
                            }
                            if (res.redirect) {
                                setTimeout(function() {
                                    window.location.href = res.redirect;
                                }, 1500);
                            }
                        } else if (res.error) {
                            // $.ALERT.show('danger', res.message);
                            Toast.fire({
                                icon: 'error',
                                title: res.message
                            });
                        } else {
                            //$.ALERT.show('danger', 'No Data');
                            Toast.fire({
                                icon: 'error',
                                title: 'No Data'
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, errorThrown) {
                        $.ALERT.show('danger', xhr.statusText);
                    },
                    complete: function() {
                        $.FEED.hideLoader();
                    }
                });
            });
        })
    </script>