<?php
   
    $searchQuery = isset($searchQuery) ? $searchQuery : '';
    $filter_skill = isset($filter_skill) ? $filter_skill : '';
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
<!-- Freelancer Job Filter -->
<div class="ps-filtering px-5">
<div class="row job-filter-wrapper" id="job-filter-wrapper">
    <?php if($job_skills){ ?>
        <!-- <div class="col-md-12 my-3">
            <div class="job-filter job-type skill" id="job-filter-skill">
              <h5 class="option-title cursor-default">Skills</h5>
              <ul class="ps-filter">
                <?php foreach($job_skills as $skill){ ?>
                    <li>
                        <label class="filter-checkbox">
                            <?php if(preg_replace('[\s]','-', strtolower($skill->name)) == preg_replace('[\s]','-', strtolower($filter_skill))){ ?>
                                <input type="radio" class="clickable" name="filter_skill" value="<?php echo preg_replace('[\s]','-', strtolower($skill->name)); ?>" checked />
                            <?php } else { ?>
                                <input type="radio" class="clickable" name="filter_skill" value="<?php echo preg_replace('[\s]','-', strtolower($skill->name)); ?>" />
                            <?php } ?>
                            <?php echo $skill->name; ?>
                        </label>
                    </li>
                <?php } ?>
              </ul>
            </div>
        </div>
        <hr class="col-12" /> -->
    <?php } ?>

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

  </div>
</div>    




<script>
      $(function(){
         //Filter Action
         var searchQuery = '<?php echo $searchQuery; ?>';
         var jf_wrapper = $('#job-filter-wrapper');
         var jf_location = $('#job-filter-location');
         var jf_languages = $('#job-filter-language');
         var jf_experiences = $('#job-filter-experiences');
         var jf_dateposts = $('#job-filter-dateposts');
         var jf_url = '';
         var jf_search = $('#ps-form--job-search');


         function filter_action(){
            $.FEED.showLoader(); //Show Loader

            if(searchQuery != ''){
                jf_url += '&csq=' + searchQuery;
            }

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

            //  console.log(jf_url);
             window.location.href = $base_url + 'company/search/freelancer?filter=jobs' + jf_url;
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
         });
      });
</script>