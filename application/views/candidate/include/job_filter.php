<?php
    //Load Filters
    $this->load->helper('jobcategories');
    $categories = loadJobCategories($type='job');

    //Initialize
    $filter_industry = isset($filter_industry) ? $filter_industry : '';
    $filter_location = isset($filter_location) ? $filter_location : '';
    $filter_jobtypes = isset($filter_jobtypes) ? $filter_jobtypes : '';
    if($filter_jobtypes){
        $filter_jobtypes = explode(',', $filter_jobtypes);
    }
    $filter_experiences = isset($filter_experiences) ? $filter_experiences : '';
    $filter_dateposts = isset($filter_dateposts) ? $filter_dateposts : '';
    $filter_genders = isset($filter_genders) ? $filter_genders : '';
    $filter_qualifications = isset($filter_qualifications) ? $filter_qualifications : '';
    if($filter_qualifications){
        $filter_qualifications = explode(',', $filter_qualifications);
    }

    //Candidate_filter
    $candidate_filter_location = isset($candidate_filter_location) ? $candidate_filter_location : false;
    $candidate_filter_gender = isset($candidate_filter_gender) ? $candidate_filter_gender : false;
    $candidate_filter_skills = isset($candidate_filter_skills) ? $candidate_filter_skills : false;
    $candidate_filter_jobtype = isset($candidate_filter_jobtype) ? $candidate_filter_jobtype : false;
    $candidate_filter_experience = isset($candidate_filter_experience) ? $candidate_filter_experience : false;
    $candidate_filter_qualifications = isset($candidate_filter_qualifications) ? $candidate_filter_qualifications : false;
?>

<style>
    .job-filter-wrapper .disable-filter {
        position: relative;
    }

    .job-filter-wrapper .disable-filter:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: auto;
        background-color: rgba(0,0,0, 0.015);
        z-index: 1;
    }

</style>

<div class="job-filter-wrapper" id="job-filter-wrapper">
    <div class="selected-options same-pad mb-3 pt-4 pb-4 shadow" style="display:block;">
      <div class="selection-title">
        <a href="javascript:void(0)" id="clear-selection">Clear Selection</a>
      </div>
    </div>

    <?php if($categories['job_categories']){ ?>
        <!--<div class="job-filter-dropdown same-pad mb-3 pt-4 pb-4 category">
          <select class="selectpicker" title="Job Category" id="job-filter-category">
              <?php foreach($categories['job_categories'] as $job_category){ ?>
                <?php if($filter_jobcategory == preg_replace('[\s]','-', strtolower($job_category->name))){ ?>
                    <option value="<?php echo preg_replace('[\s]','-', strtolower($job_category->name)); ?>" selected><?php echo $job_category->name; ?></option>
                <?php } else { ?>
                    <option value="<?php echo preg_replace('[\s]','-', strtolower($job_category->name)); ?>"><?php echo $job_category->name; ?></option>
                <?php } ?>

              <?php } ?>
          </select>
        </div>-->
    <?php } ?>

    <div class="job-filter-dropdown same-pad mb-3 pt-4 pb-4 location job-filter shadow">
        <?php if($candidate_filter_location){ ?>
            <h4 class="option-title">Location</h4>
            <ul>
                <li><?php echo ucfirst($filter_location); ?></li>
            </ul>
        <?php } else { ?>
            <select class="selectpicker" title="Location" id="job-filter-location">
                <?php foreach($categories['locations'] as $job_location){ ?>
                    <?php if($filter_location == preg_replace('[\s]','-', strtolower($job_location->name))){ ?>
                        <option value="<?php echo preg_replace('[\s]','-', strtolower($job_location->name)); ?>" selected><?php echo $job_location->name; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo preg_replace('[\s]','-', strtolower($job_location->name)); ?>"><?php echo $job_location->name; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        <?php } ?>
    </div>

    <?php if($candidate_filter_skills){ ?>
        <div class="job-filter skill same-pad mb-3 pt-4 pb-4">
          <h4 class="option-title">Skills</h4>
          <ul>
            <?php foreach($candidate_filter_skills as $skill){ ?>
            <li>
                <label class="filter-checkbox">
                    <?php echo $skill; ?>
                </label>
            </li>
            <?php } ?>
          </ul>
        </div>
    <?php } ?>

    <?php if($categories['job_types']){ ?>
        <?php if($candidate_filter_jobtype){ ?>
            <div class="job-filter same-pad mb-3 pt-4 pb-4 shadow">
              <h4 class="option-title">Job Type</h4>
              <ul>
                <?php foreach($categories['job_types'] as $job_type){ ?>
                    <?php if(preg_replace('[\s]','-', strtolower($job_type->name)) == $candidate_filter_jobtype){ ?>
                        <li>
                            <label class="filter-checkbox">
                                <?php echo $job_type->name; ?>
                            </label>
                        </li>
                    <?php } ?>
                <?php } ?>
              </ul>
            </div>
        <?php } else { ?>
            <div class="job-filter job-type same-pad mb-3 pt-4 pb-4 shadow" id="job-filter-jobtypes">
              <h4 class="option-title">Job Type</h4>
              <ul>
                <?php foreach($categories['job_types'] as $job_type){ ?>
                    <li>
                        <label class="filter-checkbox">
                            <?php if($filter_jobtypes && in_array(preg_replace('[\s]','-', strtolower($job_type->name)), $filter_jobtypes)){ ?>
                                <input type="checkbox" class="clickable" name="filter_jobtypes[]" value="<?php echo preg_replace('[\s]','-', strtolower($job_type->name)); ?>" checked />
                            <?php } else { ?>
                                <input type="checkbox" class="clickable" name="filter_jobtypes[]" value="<?php echo preg_replace('[\s]','-', strtolower($job_type->name)); ?>" />
                            <?php } ?>
                            <?php echo $job_type->name; ?>
                        </label>
                    </li>
                <?php } ?>
              </ul>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($categories['experiences']){ ?>
        <?php if($candidate_filter_experience){ ?>
            <div class="job-filter experience same-pad mb-3 pt-4 pb-4">
              <h4 class="option-title">Experience</h4>
              <ul>
                <?php foreach($categories['experiences'] as $experience){ ?>
                    <?php if(preg_replace('[\s]','-', strtolower($experience->name)) == $candidate_filter_experience){ ?>
                        <li>
                            <label class="filter-checkbox">
                                <?php echo $experience->name; ?>
                            </label>
                        </li>
                    <?php } ?>
                <?php } ?>
              </ul>
            </div>
        <?php } else { ?>
            <div class="job-filter experience job-type same-pad mb-3 pt-4 pb-4 shadow" id="job-filter-experiences">
              <h4 class="option-title">Experience</h4>
              <ul>
                <?php foreach($categories['experiences'] as $experience){ ?>
                <li>
                    <label class="filter-checkbox">
                        <?php if(preg_replace('[\s]','-', strtolower($experience->name)) == $filter_experiences){ ?>
                            <input type="radio" class="clickable" name="filter_experience" value="<?php echo preg_replace('[\s]','-', strtolower($experience->name)); ?>" checked />
                        <?php } else { ?>
                            <input type="radio" class="clickable" name="filter_experience" value="<?php echo preg_replace('[\s]','-', strtolower($experience->name)); ?>" />
                        <?php } ?>
                        <?php echo $experience->name; ?>
                    </label>
                </li>
                <?php } ?>
              </ul>
            </div>
        <?php } ?>
    <?php } ?>


    <?php $salaryrange = get_salaryrange(); ?>
    <?php if($salaryrange){ ?>
    <div class="job-filter same-pad mb-3 pt-4 pb-4 shadow">
      <h4 class="option-title">Salary Range</h4>
      <div class="price-range-slider">
        <div class="nstSlider" id="priceRanges" data-range_min="<?php echo $salaryrange['min']; ?>" data-range_max="<?php echo $salaryrange['max']; ?>"
         data-cur_min="<?php echo $salaryrange['curmin']; ?>"  data-cur_max="<?php echo $salaryrange['curmax'] ; ?>">
          <div class="bar"></div>
          <div class="leftGrip"></div>
          <div class="rightGrip"></div>
          <div class="grip-label">
            <span class="leftLabel"></span>
            <span class="rightLabel"></span>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>

    <?php $dateposts = get_dateposts(); ?>
    <?php if($dateposts){ ?>
        <div class="job-filter job-type post same-pad mb-3 pt-4 pb-4 shadow" id="job-filter-dateposts">
          <h4 class="option-title">Date Posted</h4>
          <ul>
            <?php foreach($dateposts as $datepost){ ?>
                <li>
                    <label class="filter-checkbox">
                        <?php if(preg_replace('[\s]','-', strtolower($datepost)) == $filter_dateposts){ ?>
                            <input type="radio" class="clickable" name="filter_datepost" value="<?php echo preg_replace('[\s]','-', strtolower($datepost)); ?>" checked />
                        <?php } else { ?>
                            <input type="radio" class="clickable" name="filter_datepost" value="<?php echo preg_replace('[\s]','-', strtolower($datepost)); ?>" />
                        <?php } ?>
                        <?php echo $datepost; ?>
                    </label>
                </li>
            <?php } ?>
          </ul>
        </div>
    <?php } ?>


    <?php $genders = get_genders(); ?>
    <?php if($genders){ ?>
        <?php if($candidate_filter_gender){ ?>
            <div class="job-filter same-pad mb-3 pt-4 pb-4 gender shadow">
              <h4 class="option-title">Gender</h4>
                <ul>
                    <?php foreach($genders as $gender){ ?>
                    <?php if(preg_replace('[\s]','-', strtolower($gender)) == $candidate_filter_gender){ ?>
                        <li>
                            <label class="filter-checkbox">
                                <?php echo $gender; ?>
                            </label>
                        </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        <?php } else { ?>
            <div class="job-filter job-type same-pad mb-3 pt-4 pb-4 gender shadow" id="job-filter-genders">
              <h4 class="option-title">Gender</h4>
                <ul>
                    <?php foreach($genders as $gender){ ?>
                        <li>
                            <label class="filter-checkbox">
                                <?php if(preg_replace('[\s]','-', strtolower($gender)) == $filter_genders){ ?>
                                    <input type="radio" class="clickable" name="filter_genders" value="<?php echo preg_replace('[\s]','-', strtolower($gender)); ?>" checked />
                                <?php } else { ?>
                                    <input type="radio" class="clickable" name="filter_genders" value="<?php echo preg_replace('[\s]','-', strtolower($gender)); ?>" />
                                <?php } ?>
                                <?php echo $gender; ?>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    <?php } ?>


    <?php if($candidate_filter_qualifications){ ?>
        <div class="job-filter qualification same-pad mb-3 pt-4 pb-4">
          <h4 class="option-title">Qualification</h4>
          <ul>
            <?php foreach($candidate_filter_qualifications as $qualification){ ?>
            <li>
                <label class="filter-checkbox">
                    <?php echo $qualification; ?>
                </label>
            </li>
            <?php } ?>
          </ul>
        </div>
    <?php } else { ?>
        <?php if($categories['qualifications']){ ?>
            <div class="job-filter job-type qualification same-pad mb-3 pt-4 pb-4 shadow" id="job-filter-qualifications">
              <h4 class="option-title">Qualification</h4>
              <ul>
                <?php foreach($categories['qualifications'] as $qualification){ ?>
                <li>
                    <label class="filter-checkbox">
                        <?php if($filter_qualifications && in_array(preg_replace('[\s]','-', strtolower($qualification->name)), $filter_qualifications)){ ?>
                            <input type="checkbox" class="clickable" name="filter_qualifications[]" value="<?php echo preg_replace('[\s]','-', strtolower($qualification->name)); ?>" checked />
                        <?php } else { ?>
                            <input type="checkbox" class="clickable" name="filter_qualifications[]" value="<?php echo preg_replace('[\s]','-', strtolower($qualification->name)); ?>" />
                        <?php } ?>
                        <?php echo $qualification->name; ?>
                    </label>
                </li>
                <?php } ?>
              </ul>
            </div>
        <?php } ?>
    <?php } ?>
  </div>

  <script>
      $(function(){
         //Filter Action
         var salaryrange_minvalue = '<?php echo $salaryrange['min']; ?>';
         var salaryrange_maxvalue = '<?php echo $salaryrange['max']; ?>';
         var jf_wrapper = $('#job-filter-wrapper');
         var jf_jobcategory = $('#job-filter-category');
         var jf_location = $('#job-filter-location');
         var jf_jobtypes = $('#job-filter-jobtypes');
         var jf_experiences = $('#job-filter-experiences');
         var jf_dateposts = $('#job-filter-dateposts');
         var jf_genders = $('#job-filter-genders');
         var jf_qualifications = $('#job-filter-qualifications');
         var jf_priceranges = $('#priceRanges');
         var jf_relevant = $('#input-relevant-jobs');
         var jf_url = '';
         var candidate_filter_location = '<?php echo $candidate_filter_location; ?>';
         var candidate_filter_gender = '<?php echo $candidate_filter_gender; ?>';

         jf_priceranges.nstSlider({
            "left_grip_selector": ".leftGrip",
            "right_grip_selector": ".rightGrip",
            "value_bar_selector": ".bar",
            "value_changed_callback": function (cause, leftValue, rightValue) {
              $(this).parent().find('.leftLabel').text(leftValue);
              $(this).parent().find('.rightLabel').text(rightValue);
            },
            user_mouseup_callback: function(vmin, vmax, left_grip_moved){
                // alert(vmin + ' - ' + vmax);
                filter_action();
            }
        });


         function filter_action(){
            $.FEED.showLoader(); //Show Loader

             var jobcategory_value = jf_jobcategory.val();
             if(jobcategory_value){
                 jf_url += '&filter_jobcategory=' + jobcategory_value;
             }

             var location_value = jf_location.val();
             if(location_value){
                 jf_url += '&filter_location=' + location_value;
             }

             var jobtype_values = jf_jobtypes.find('input[type=\'checkbox\']:checked').map(function(){return $(this).val(); }).get();
             if(jobtype_values.length > 0){
                 jf_url += '&filter_jobtypes=' + jobtype_values.join(',');
             }

             var datepost_values = jf_dateposts.find('input[type=\'radio\']:checked').val();
             if(datepost_values){
                 jf_url += '&filter_dateposts=' + datepost_values;
             }

             var experience_values = jf_experiences.find('input[type=\'radio\']:checked').val();
             if(experience_values){
                 jf_url += '&filter_experiences=' + experience_values;
             }

             var gender_values = jf_genders.find('input[type=\'radio\']:checked').val();
             if(gender_values){
                 jf_url += '&filter_genders=' + gender_values;
             }

             var qualification_values = jf_qualifications.find('input[type=\'checkbox\']:checked').map(function(){return $(this).val(); }).get();
             if(qualification_values.length > 0){
                 jf_url += '&filter_qualifications=' + qualification_values.join(',');
             }

             var salary_minvalue = $('#priceRanges').nstSlider('get_current_min_value');
             var salary_maxvalue = $('#priceRanges').nstSlider('get_current_max_value');

             if(salary_minvalue!= '' && salary_maxvalue != ''){
                 jf_url += '&filter_salary_packages=' + salary_minvalue + ':' + salary_maxvalue;
             }

             //Relevant Jobs
             if(jf_relevant.prop("checked") == true){
                 jf_url += '&filter_type=relevant_jobs';
             }

            //  console.log(jf_url);
             window.location.href = $base_url + 'jobs?filter=jobs' + jf_url;
         }

         jf_jobcategory.change(function(e){
             e.preventDefault();
             filter_action();
         });

         jf_location.change(function(e){
             e.preventDefault();
             filter_action();
         });

         jf_wrapper.find('input[type=\'checkbox\'].clickable, input[type=\'radio\'].clickable').click(function(){
             filter_action();
         });

         $('#clear-selection').click(function(e){
             e.preventDefault();
             jf_wrapper.find('input[type=\'checkbox\'], input[type=\'radio\']').attr('checked', false);
             jf_wrapper.find('select').val('').selectpicker('refresh');
             jf_priceranges.nstSlider('set_position', salaryrange_minvalue, salaryrange_maxvalue);
         });
      });
  </script>
