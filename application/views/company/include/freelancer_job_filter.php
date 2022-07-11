<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
<!-- Freelancer Job Filter -->
<div class="card card-body  job-filter-wrapper no-bg-img" style="background-color: #285C7F; color: white;">
    <div class="px-1 text-center">
        <h5 style="color:white;">Job Options</h5>
        <!-- <hr> -->
    </div>
</div>

        <?php if($job['job_skills']){ ?>
        <div class="mb-4 card card-body job-filter-wrapper no-bg-img ps--border">
        <div class="mb-4">
            <div class="p-4 job-filter job-type same-pad" id="job-filter-skills">
              <h4 class="option-title">Skills</h4>
              <hr style="height:1px;border-width:0;color:white;background-color:white;">
              <ul class="p-0">
                <?php foreach($job['job_skills'] as $skill){ ?>
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" class="clickable" name="filter_skills[]" value="<?php echo preg_replace('[\s]','-', strtolower($skill)); ?>" />
                            <?php echo $skill; ?>
                        </label>
                    </li>
                <?php } ?>
              </ul>
            </div>
        </div>
        </div>
        
        <?php } ?>

        <?php if($job['location']){ ?>
        <div class="mb-4 card card-body  job-filter-wrapper no-bg-img ps--border">
        <div class="mb-4">
            <div class="p-4 job-filter job-type same-pad" id="job-filter-location">
              <h4 class="option-title">Location</h4>
              <hr style="height:1px;border-width:0;color:white;background-color:white;">
              <ul class="p-0">
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" class="clickable" name="filter_location" value="<?php echo preg_replace('[\s]','-', strtolower($job['location'])); ?>" />
                            <?php echo $job['location']; ?>
                        </label>
                    </li>
              </ul>
            </div>
        </div>
        </div>
        
        <?php } ?>

        <?php if($job['experience']){ ?>
        <div class="mb-4 card card-body  job-filter-wrapper no-bg-img ps--border">
        <div class="mb-4">
            <div class="p-4 job-filter job-type same-pad" id="job-filter-experiences">
              <h4 class="option-title">Experience</h4>
              <hr style="height:1px;border-width:0;color:white;background-color:white;">
              <ul class="p-0">
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" class="clickable" name="filter_experience" value="<?php echo preg_replace('[\s]','-', strtolower($job['experience'])); ?>" />
                            <?php echo $job['experience']; ?>
                        </label>
                    </li>
              </ul>
            </div>
        </div>
        </div>
        
        <?php } ?>

        <?php if($job['languages']){ ?>
        <div class="mb-4 card card-body job-filter-wrapper no-bg-img ps--border">
        <div class="mb-4">
            <div class="p-4 job-filter job-type same-pad" id="job-filter-languages">
              <h4 class="option-title">Languages</h4>
              <hr style="height:1px;border-width:0;color:white;background-color:white;">
              <ul class="p-0">
                <?php foreach($job['languages'] as $language){ ?>
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" class="clickable" name="filter_languages[]" value="<?php echo preg_replace('[\s]','-', strtolower($language)); ?>" />
                            <?php echo $language; ?>
                        </label>
                    </li>
                <?php } ?>
              </ul>
            </div>
        </div>
        </div>
        
        <?php } ?>
    