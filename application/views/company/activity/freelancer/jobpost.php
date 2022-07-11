<script>
    var base_url = '<?php echo base_url(); ?>';
</script>

<!-- Menubar -->
<?php include APPPATH . 'views/company/include/menubar.php'; ?>
<!-- Menubar End -->
<div class="section-default-header"></div>
<?php include APPPATH . 'views/company/include/navbar.php'; ?>
<div class="ps-page">
    <div class="ps-section--sidebar ps-layout">
        <div class="container">
            <div class="ps-section__container">
                <div class="ps-section__content">
                    <form class="ps-form--post-a-job" id="jobPostForm" action="<?php echo $form_action; ?>" method="post">
                        <h3>Post a Projects</h3>
                        <div class="form-group">
                            <label>Project Title</label>
                            <input class="form-control" type="text" id="job_title" name="job_title" value="<?php echo $job_title; ?>" placeholder="e.g Senior Product Designer">
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg- col-md-12 col-sm-12 col-12">
                                <div class="form-group ele--jqvalid">
                                    <label>Project Category</label>
                                    <div class="ps-form__rule">
                                        <select class="ps-select" data-type="selectpicker" id="job-category" name="job_category">
                                            <option value="">Select Category</option>
                                            <?php if ($job_categories) { ?>
                                                <?php foreach ($job_categories as $category) { ?>
                                                    <?php if ($category->category_id == $job_category) { ?>
                                                        <option value="<?php echo $category->category_id; ?>" selected>
                                                            <?php echo $category->name; ?>
                                                        </option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $category->category_id; ?>">
                                                            <?php echo $category->name; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg- col-md-12 col-sm-12 col-12">
                                <div class="form-group ele--jqvalid">
                                    <label>Project Specialization</label>
                                    <div class="ps-form__rule" id="job-specialization">
                                        <select class="ps-select" data-type="selectpicker" name="job_specialization">
                                            <option value="1">Select Specialization</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="job-description-section">
                            <label>Description</label>
                            <textarea class="form-control" name="job_description" rows="6" placeholder="Enter your description here"><?php echo $job_title; ?></textarea>
                            <!-- <small><i>4700 chatater remaining</i></small> -->
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg- col-md-12 col-sm-12 col-12">
                                <div class="form-group ele--jqvalid">
                                    <label class="mandatory">Type of Project</label>
                                    <div class="ps-form__rule">
                                        <select class="ps-select" data-type="selectpicker" name="job_type">
                                            <option value="">Select</option>
                                            <?php if ($project_types) { ?>
                                                <?php foreach ($project_types as $tkey => $type) { ?>
                                                    <?php if ($tkey == $job_type) { ?>
                                                        <option value="<?php echo $tkey; ?>" selected>
                                                            <?php echo $type; ?>
                                                        </option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $tkey; ?>">
                                                            <?php echo $type; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group ele--jqvalid">
                                    <label class="mandatory">Project Duration</label>
                                    <div class="ps-form__rule">
                                        <select class="ps-select" data-type="selectpicker" name="job_duration">
                                            <option value="">Select</option>
                                            <?php if ($project_durations) { ?>
                                                <?php foreach ($project_durations as $dkey => $duration) { ?>
                                                    <?php if ($dkey == $job_duration) { ?>
                                                        <option value="<?php echo $dkey; ?>" selected>
                                                            <?php echo $duration; ?>
                                                        </option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $dkey; ?>">
                                                            <?php echo $duration; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group ele--jqvalid">
                                    <label class="mandatory">Time Requirement for Project</label>
                                    <div class="ps-form__rule">
                                        <select class="ps-select" data-type="selectpicker" name="job_time_period">
                                            <option value="">Select</option>
                                            <?php if ($project_time_periods) { ?>
                                                <?php foreach ($project_time_periods as $tpkey => $time_period) { ?>
                                                    <?php if (($tpkey == $job_time_period)) { ?>
                                                        <option value="<?php echo $tpkey; ?>" selected>
                                                            <?php echo $time_period; ?>
                                                        </option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $tpkey; ?>">
                                                            <?php echo $time_period; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Skills Required</label>
                            <div class="category-block">
                                <div id="skill-category" class="category-inner-block">
                                    <?php if ($job_skills) { ?>
                                        <?php foreach ($job_skills as $category) { ?>
                                            <div class="skill-category" id="skill-inner-category<?php echo $category->category_id; ?>">
                                                <i class="remove-skill fas fa-times-circle"></i> <?php echo $category->name; ?>
                                                <input type="hidden" name="job_skills[]" value="<?php echo $category->category_id; ?>" />
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <input class="form-control" id="input-skills" type="text" placeholder="e.g Hanoi">
                            </div>
                        </div>
                        <div class="form-group row ele--jqvalid">
                            <input type="hidden" id="hiddenId5" name="hiddenId5">
                            <label class="col-md-12 control-label mb-3 mandatory">Experience Level</label>
                            <div class="ps-form__rule mx-5">
                                <div class="form-group">
                                    <select class="ps-select experience-level" data-type="selectpicker" name="experience_level">
                                        <option value="">Select</option>
                                        <?php if ($experience_levels) {
                                            // print_r($job_experience_level); ?>
                                            <?php foreach ($experience_levels as $tpkey => $experience_level) { ?>
                                                <?php if (($experience_level['value'] == $job_experience_level)) { ?>
                                                    <option value="<?php echo $experience_level['value']; ?>" selected>
                                                        <?php echo $experience_level['name']; ?>
                                                    </option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $experience_level['value']; ?>">
                                                        <?php echo $experience_level['name']; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="ps-form__rules ele--jqvalid m-3 mb-0" id="applicant-experienced" style="<?php echo ('experienced' == $job_experience_level) ? 'display:block' : 'display:none'; ?>">
                                <div class="form-group">
                                    <label class="col-form-label mandatory">Select Your Experience</label>
                                    <div class="ps-form__rule">
                                        <select data-type="selectpicker" class="ps-select" name="experience" title="select">
                                            <?php foreach ($experiences as $experience) { ?>
                                                <?php if ($experience->category_id == $job_experience) { ?>
                                                    <option value="<?php echo $experience->category_id; ?>" selected><?php echo $experience->name; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $experience->category_id; ?>"><?php echo $experience->name; ?></option>
                                                <?php } ?>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">Location</label>
                            <div class="">
                                <input type="text" id="input-search-location" placeholder="e.g Bengaluru" value="<?php echo $job_location; ?>" autocomplete="off" class="form-control" />
                                <input type="hidden" name="location" value="<?php echo $job_location; ?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="clearfix col-md-12 col-form-label">Languages
                                <div class="float-right ps-form__rule-action">
                                    <a class="add_btn add-new-field btn-link mb-0" id="add-language"><i class="ps-icon--plus"></i><span>Add</span></a>
                                </div>
                            </label>
                            <div class="col-md-12">
                                <div id="language-wrap" class="row">
                                    <?php if ($job_languages) { ?>
                                        <?php foreach ($job_languages as $job_language) { ?>
                                            <div class="col-md-4 qrow mb-4">
                                                <div class="input-group">
                                                    <input type="text" class="input-search-language form-control" value="<?php echo $job_language['name']; ?>" placeholder="Enter" />
                                                    <input type="hidden" class="input-language form-control" name="job_language[]" value="<?php echo $job_language['id']; ?>" />
                                                    <?php if (count($job_languages) > 1) { ?>
                                                        <div class="input-group-append">
                                                            <span class="close_btn input-group-text"><i class="fas fa-times"></i></span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-12 control-label mandatory">How would you like to pay your freelancer</label>
                            <div class="col-md-12">
                                <div class="row align-items-center justify-content-start my-4 ele--jqvalid">
                                    <select class="ps-select paytype" data-type="selectpicker" name="pay_type">
                                        <option value="">Select</option>
                                        <?php if ($pay_types) { ?>
                                            <?php foreach ($pay_types as $ptkey => $pay_type) { ?>
                                                <?php if ($ptkey == $job_pay_type) { ?>
                                                    <option value="<?php echo $ptkey; ?>" selected><?php echo $pay_type; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $ptkey; ?>"><?php echo $pay_type; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="show_budget" class="form-group">
                            <label class="control-label mandatory">Enter your Amount</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" placeholder="₹" value="<?php echo $job_pay_amount; ?>" name="pay_amount">
                            </div>

                        </div>
                        <div class="ps-form__submit">
                            <button class="ps-btn ps-btn--gradient" id="btn-confirm-post-publish" type="button">Save & Preview</button>
                        </div>
                    </form>
                </div>
                <div class="ps-section__sidebar">
                    <aside class="widget widget_profile widget_progress">
                        <?php $company = isset($company) ? $company : ''; ?>
                        <?php if ($company) { ?>
                            <div class="ps-block--user">
                                <div class="ps-block__thumbnail"><img src="<?php echo $company['thumb']; ?>" alt=""></div>
                                <div class="ps-block__content">
                                    <h4><?php echo $company['name']; ?></h4>
                                    <a href="<?php echo base_url() . 'company/profile' ?>">View your profile<i class="fa fa-caret-right"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- <h5>Setup your account</h5>
                        <div class="ps-progress">
                            <span>65%</span>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width:65%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <a href="#">Add your address ( +5% )</a> -->
                    </aside>
                    <aside class="widget widget_profile widget_connections">
                        <?php $total_projects = isset($total_projects) ? $total_projects : 0; ?>
                        <a class="ps-btn" href=""><?php echo $total_projects; ?> Projects</a>

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

<script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>
<?php $this->document->addScript(base_url('application/assets/js/include/company/freelancer_jobpost.js'), 'footer'); ?>

<script>
    $(function() {
        var job_category = '<?php echo $job_category; ?>';
        var job_specialization = '<?php echo $job_specialization; ?>';

        var job_language_count = '<?php echo count($job_languages); ?>';
        //Add Language
        var qc = (job_language_count + 1);
        $('#add-language').click(function(e) {
            e.preventDefault();
            var qactions = '';
            //Minus Button
            if (qc > 1) {
                qactions = '<div class="input-group-append">' +
                    '<span class="close_btn input-group-text"><i class="fas fa-times"></i></span>' +
                    '</div>';
            }

            //Qualification content field
            var html = '<div class="col-md-4 qrow mb-4"><div class="input-group">' +
                '<input type="text" class="input-search-language form-control" placeholder="Enter" />' +
                '<input type="hidden" class="input-language form-control" name="job_language[]" />' +
                qactions +
                '</div></div>';

            $('#language-wrap').append(html);
            // Bootstrap selectpicker
            $('.selectpicker').selectpicker();

            $('.qrow .close_btn').click(function(e) {
                e.preventDefault();
                $(this).parents('.qrow').fadeOut(400).remove();
            });
            qc++;
        });

        //add language
        if (job_language_count < 1) {
            $('#add-language').trigger('click');
        }

        function loadCategory(jcid, type) {
            $.ajax({
                url: $base_url + 'category/jobspecialization/details',
                type: 'post',
                data: {
                    parent_id: jcid
                },
                dataType: 'json',
                beforeSend: function() {
                    //btn.html(spinner_icon).attr('disabled', false);
                },
                success: function(res) {
                    if (res.success) {
                        var categories = res.data;
                        $('#job-specialization');
                        $.each(categories, function(ckey, category) {
                            $('select[name=\'job_specialization\']').append('<option value="' + category.category_id + '">' + category.name + '</option>');
                        });

                        if (type == 'edit') {
                            $('select[name=\'job_specialization\']').val(job_specialization);
                        }

                        $('.selectpicker').selectpicker();
                    } else if (res.error) {
                        $.ALERT.show('danger', res.message);
                    } else {
                        $.ALERT.show('danger', 'No Data');
                    }

                },
                error: function(xhr, ajaxOptions, errorThown) {
                    console.log(xhr.statusText + ' - ' + xhr.responseText);
                },
                complete: function() {
                    //btn.html(button_txt).attr('disabled', false);
                }
            });
        }


        $('#job-category').change(function(e) {
            e.preventDefault();
            var jcid = $(this).val();
            loadCategory(jcid, 'list');
        });


        if (job_category && job_specialization) {
            loadCategory(job_category, 'edit');
        }
    });
</script>