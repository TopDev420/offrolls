<!-- Candidate Job Filter -->

<div class="card card-body job-filter-wrapper no-bg-img" style="background-color: #4CB9BD; color: white;">
    <div class="px-1 text-center">
        <h5>Job Options</h5>
       <!--  <hr> -->
    </div>
</div>


   
        <?php if($job_processes){ ?>
        <div class="card card-body job-filter-wrapper no-bg-img shadow">
         <div class="mb-4">
            <div class="job-filter job-type same-pad" id="job-filter-process">
                <h4 class="option-title">Selection Process</h4>
                 <hr style="height:2px;border-width:0;color:white;background-color:white;">
                <ul>
                    <?php foreach($job_processes as $job_process){ ?>
                        <li>
                            <label class="filter-checkbox">
                                <input type="checkbox" class="clickable" name="filter_processes[]" value="<?php echo preg_replace('[\s]','-', strtolower($job_process)); ?>" />
                                <?php echo $job_process; ?>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        </div>
        <br/>
        <?php } ?>

        <?php if($job['job_skills']){ ?>
        <div class="card card-body job-filter-wrapper no-bg-img shadow">
        <div class="mb-4">
            <div class="job-filter job-type same-pad" id="job-filter-skills">
              <h4 class="option-title">Skills</h4>
              <hr style="height:2px;border-width:0;color:white;background-color:white;">
              <ul>
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
        <br/>
        <?php } ?>

        <?php if($job['job_qualifications']){ ?>
        <div class="card card-body job-filter-wrapper no-bg-img shadow">
         <div class="mb-4">
            <div class="job-filter job-type same-pad" id="job-filter-qualifications">
              <h4 class="option-title">Qualifications</h4>
               <hr style="height:2px;border-width:0;color:white;background-color:white;">
              <ul>
                <?php foreach($job['job_qualifications'] as $job_qualification){ ?>
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" class="clickable" name="filter_qualifications[]" value="<?php echo preg_replace('[\s]','-', strtolower($job_qualification['qualification'])); ?>" />
                            <?php echo $job_qualification['qualification']; ?>
                        </label>
                    </li>
                <?php } ?>
              </ul>
            </div>
        </div>
        </div>
        <br/>
        <?php } ?>

        <?php if($job['job_type']){ ?>
        <div class="card card-body job-filter-wrapper no-bg-img shadow">
         <div class="mb-4">
            <div class="job-filter job-type same-pad" id="job-filter-jobtypes">
              <h4 class="option-title">Job Type</h4>
               <hr style="height:2px;border-width:0;color:white;background-color:white;">
              <ul>
                <?php foreach($job['job_type'] as $jobtype){ ?>
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" class="clickable" name="filter_jobtypes[]" value="<?php echo preg_replace('[\s]','-', strtolower($jobtype)); ?>" />
                            <?php echo $jobtype; ?>
                        </label>
                    </li>
                <?php } ?>
              </ul>
            </div>
        </div>
        </div>
        <br/>
        <?php } ?>

        <?php /*if($job['salary_package']){*/ ?>
            <!--<div class="job-filter job-type same-pad" id="job-filter-salary">
              <h4 class="option-title">Salary Package</h4>
              <ul>
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" class="clickable" name="filter_location" value="<?php echo $job['salary_package']['code']; ?>" />
                            <?php echo $job['salary_package']['name']; ?>
                        </label>
                    </li>
              </ul>
            </div>-->
        <?php /*}*/ ?>

        <?php if($job['location']){ ?>
        <div class="card card-body job-filter-wrapper no-bg-img shadow">
         <div class="mb-4">
            <div class="job-filter job-type same-pad" id="job-filter-location">
              <h4 class="option-title">Location</h4>
               <hr style="height:2px;border-width:0;color:white;background-color:white;">
              <ul>
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
        <br/>
        <?php } ?>

        <?php if($job['experience']){ ?>
        <div class="card card-body job-filter-wrapper no-bg-img shadow">
         <div class="mb-4">
            <div class="job-filter job-type same-pad" id="job-filter-experiences">
              <h4 class="option-title">Experience</h4>
               <hr style="height:2px;border-width:0;color:white;background-color:white;">
              <ul>
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
         <br/>
        <?php } ?>

        <?php if($job['gender']){ ?>
        <div class="card card-body job-filter-wrapper no-bg-img shadow">
         <div class="mb-4">
            <div class="job-filter job-type same-pad" id="job-filter-gender">
              <h4 class="option-title">Gender</h4>
               <hr style="height:2px;border-width:0;color:white;background-color:white;">
              <ul>
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" class="clickable" name="filter_gender" value="<?php echo preg_replace('[\s]','-', strtolower($job['gender'])); ?>" />
                            <?php echo $job['gender']; ?>
                        </label>
                    </li>
              </ul>
            </div>
        </div>
        </div>
        <br/>
        <?php } ?>

        <?php /*if($job['languages']){*/ ?>
            <!--<div class="job-filter job-type same-pad" id="job-filter-languages">
              <h4 class="option-title">Languages</h4>
              <ul>
                <?php foreach($job['languages'] as $language){ ?>
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" class="clickable" name="filter_languages[]" value="<?php echo preg_replace('[\s]','-', strtolower($language)); ?>" />
                            <?php echo $language; ?>
                        </label>
                    </li>
                <?php } ?>
              </ul>
            </div>-->
        <?php /*}*/ ?>
    
