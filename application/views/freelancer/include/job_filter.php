<?php
    //Load Filters
    $this->load->helper('freelancer_category');

    $filter_budget_type= isset($filter_budget_type) ? $filter_budget_type : 0;
    $salaryrange = $filter_budget_ranges;
    $filter_location = isset($filter_location) ? $filter_location : '';
    $filter_category = isset($filter_category) ? $filter_category : '';
    $filter_experiences = isset($filter_experiences) ? $filter_experiences : '';
    $filter_language = isset($filter_language) ? $filter_language : '';

    //Candidate_filter
    $freelancer_filter_skills = isset($freelancer_skills) ? $freelancer_skills : false;
    $freelancer_filter_location = isset($freelancer_location) ? $freelancer_location : false;
    $freelancer_filter_category = isset($freelancer_category) ? $freelancer_category : false;
    $freelancer_filter_languages = isset($freelancer_languages) ? $freelancer_languages : false;
    $freelancer_filter_experience = isset($freelancer_experience) ? $freelancer_experience : false;
?>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
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
    .job-filter .jtitle {
        font-size: 1.5rem;
        font-weight: 600;
        font-family: "Poppins", sans-serif;
        position: relative;
        cursor: pointer;
        -webkit-transition: all .3s ease;
        -o-transition: all .3s ease;
        transition: all .3s ease;
    }
    .job-filter-wrapper .bootstrap-select >.dropdown-toggle {
        border: 1px solid rgba(111, 116, 132, 0.4);
    }

    .job-filter-wrapper .dropdown-toggle::after {
        right: 10px;
    }

    .dropdown-menu .nav-item .nav-link {
        font-size: 1.3rem;
        display: block;
        transition: all 0.4s ease;
    }

    .dropdown-menu .nav-item .nav-link:hover {
        color: #fff;
        background-color: #246df8;
        transition: all 0.4s ease;
    }
</style>

<div class="ps-filtering px-5">
<div class="row job-filter-wrapper" id="job-filter-wrapper">

    <?php $budget_types = get_pay_types(); ?>
    <div class="col-md-12">
        <div class="job-filter job-type">
            <?php if($budget_types){ ?>
                  <h5 class="option-title cursor-default">Budget</h5>
                  <ul id="job-filter-budget ps-filter">
                    <?php foreach($budget_types as $bkey => $budget_type){ ?>
                        <li>
                            <label class="filter-checkbox">
                                <?php if(preg_replace('[\s]','-', strtolower($bkey)) == $filter_budget_type){ ?>
                                    <input type="radio" class="clickable" name="filter_budget_type" value="<?php echo preg_replace('[\s]','-', strtolower($bkey)); ?>" checked />
                                <?php } else { ?>
                                    <input type="radio" class="clickable" name="filter_budget_type" value="<?php echo preg_replace('[\s]','-', strtolower($bkey)); ?>" />
                                <?php } ?>
                                <?php echo $budget_type; ?>
                            </label>
                        </li>
                    <?php } ?>
                  </ul>
            <?php } ?>

            <?php if($salaryrange){ ?>
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
            <?php } ?>
        </div>
    </div>
    <hr class="col-12" />

    <?php if($experiences){ ?>
        <?php if(!$freelancer_filter_experience){ ?>
            <div class="col-md-12 my-3">
                <div class="job-filter experience job-type " id="job-filter-experiences">
                  <h5 class="option-title cursor-default">Experience</h5>
                  <ul class="ps-filter">
                    <?php foreach($experiences as $experience){ ?>
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
            </div>
            <hr class="col-12" />
        <?php } ?>
    <?php } ?>


    <?php if($job_languages){ ?>
        <div class="col-md-12 my-3">
            <div class="job-filter job-type  language" id="job-filter-language">
              <h5 class="option-title cursor-default">Language</h5>
              <ul class="ps-filter">
                <?php foreach($job_languages as $language){ ?>
                    <li>
                        <label class="filter-checkbox">
                            <?php if(preg_replace('[\s]','-', strtolower($language['name'])) == preg_replace('[\s]','-', strtolower($filter_language))){ ?>
                                <input type="radio" class="clickable" name="filter_language" value="<?php echo preg_replace('[\s]','-', strtolower($language['name'])); ?>" checked />
                            <?php } else { ?>
                                <input type="radio" class="clickable" name="filter_language" value="<?php echo preg_replace('[\s]','-', strtolower($language['name'])); ?>" />
                            <?php } ?>
                            <?php echo $language['name']; ?>
                        </label>
                    </li>
                <?php } ?>
              </ul>
            </div>
        </div>
        <hr class="col-12" />
    <?php } ?>

    <div class="col-md-12 my-3">
        <div class="job-filter  job-type">
            <h5 class="jtitle cursor-default">Location</h5>
            <ul class="ps-filter">
                <?php if($freelancer_filter_location){ ?>
                    <li><label><?php echo ucfirst($filter_location); ?></label></li>
                <?php } else { ?>
                    <li>
                        <select class="selectpicker" title="Select" id="job-filter-location">
                            <?php foreach($job_locations as $job_location){ ?>
                                <?php if($filter_location == preg_replace('[\s]','-', strtolower($job_location->name))){ ?>
                                    <option value="<?php echo preg_replace('[\s]','-', strtolower($job_location->name)); ?>" selected><?php echo $job_location->name; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo preg_replace('[\s]','-', strtolower($job_location->name)); ?>"><?php echo $job_location->name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <hr class="col-12" />

    <div class="col-md-12 my-3">
        <div class="job-filter  job-type">
            <h5 class="jtitle cursor-default">Category</h5>
            <ul class="ps-filter">
                <?php if($freelancer_filter_category){ ?>
                    <li><label><?php echo ucfirst($filter_category); ?></label></li>
                <?php } else { ?>
                    <li>
                        <select class="selectpicker" title="Select" id="job-filter-category">
                            <?php foreach($job_categories as $job_category){ ?>
                                <?php if($filter_category == preg_replace('[\s]','-', strtolower($job_category->name))){ ?>
                                    <option value="<?php echo preg_replace('[\s]','-', strtolower($job_category->name)); ?>" selected><?php echo $job_category->name; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo preg_replace('[\s]','-', strtolower($job_category->name)); ?>"><?php echo $job_category->name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

  </div>
</div>
<script>
      $(function(){
         //Filter Action
         var salaryrange_minvalue = '<?php echo isset($salaryrange["min"]) ? $salaryrange["min"] : 0; ?>';
         var salaryrange_maxvalue = '<?php echo isset($salaryrange["max"]) ? $salaryrange["max"] : 0; ?>';
         var jf_wrapper = $('#job-filter-wrapper');
         var jf_budget_type = $('#job-filter-budget');
         var jf_location = $('#job-filter-location');
         var jf_languages = $('#job-filter-language');
         var jf_experiences = $('#job-filter-experiences');
         var jf_dateposts = $('#job-filter-dateposts');
         var jf_priceranges = $('#priceRanges');
         var jf_url = '';
         var jf_search = $('#ps-form--job-search');

         jf_priceranges.nstSlider({
            "left_grip_selector": ".leftGrip",
            "right_grip_selector": ".rightGrip",
            "value_bar_selector": ".bar",
            "value_changed_callback": function (cause, leftValue, rightValue) {
              $(this).parent().find('.leftLabel').text(leftValue);
              $(this).parent().find('.rightLabel').text(rightValue);
            },
            user_mouseup_callback: function(vmin, vmax, left_grip_moved){
                //alert(vmin + ' - ' + vmax);
                filter_action();
            }
        });


         function filter_action(){
            $.FEED.showLoader(); //Show Loader

             var location_value = jf_location.val();
             if(location_value){
                 jf_url += '&filter_location=' + location_value;
             }


             /*var datepost_values = jf_dateposts.find('input[type=\'radio\']:checked').val();
             if(datepost_values){
                 jf_url += '&filter_dateposts=' + datepost_values;
             }*/

             var experience_values = jf_experiences.find('input[type=\'radio\']:checked').val();
             if(experience_values){
                 jf_url += '&filter_experiences=' + experience_values;
             }

             var language_values = jf_languages.find('input[type=\'radio\']:checked').val();
             if(language_values){
                 jf_url += '&filter_languages=' + language_values;
             }

             var budget_type_value = jf_budget_type.find('input[type=\'radio\']:checked').val();
             if(budget_type_value){
                 jf_url += '&filter_budget_type=' + budget_type_value;
             }

             var budget_minvalue = jf_priceranges.nstSlider('get_current_min_value');
             var budget_maxvalue = jf_priceranges.nstSlider('get_current_max_value');

             if(budget_minvalue!= '' && budget_maxvalue != ''){
                 jf_url += '&filter_budget_ranges=' + budget_minvalue + ':' + budget_maxvalue;
             }

            //  console.log(jf_url);
             window.location.href = $base_url + 'freelancer/search/jobs?filter=jobs' + jf_url;
         }


         jf_location.change(function(e){
             e.preventDefault();
             filter_action();
         });

         jf_wrapper.find('input[type=\'checkbox\'].clickable, input[type=\'radio\'].clickable').click(function(){
             filter_action();
         });

         $('#clear-selection').click(function(e){
             e.preventDefault();
             jf_wrapper.find('input[type=\'checkbox\'].clickable, input[type=\'radio\'].clickable').attr('checked', false);
             jf_wrapper.find('select').val('').selectpicker('refresh');
             jf_priceranges.nstSlider('set_position', salaryrange_minvalue, salaryrange_maxvalue);
         });
      });
  </script>
