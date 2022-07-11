<div class="bg-white">
  <div class="container no-gliters">
    <div class="row no-gliters">
      <div class="col">
        <div class="dashboard-container mb-4">
          <div class="dashboard-sidebar w-100">
            <div class="user-info">
              <div class="thumb">
                <img src="<?php echo $freelancer['thumb']; ?>" class="img-fluid" alt="">
              </div>
              <div class="user-body">
                <h5><?php echo $freelancer['name']; ?></h5>
                <span><?php echo $freelancer['email']; ?></span>
              </div>
            </div>
            <div class="profile-progress">
              <div class="progress-item">
                <div class="progress-head">
                  <p class="progress-on">Profile</p>
                </div>
                <div class="progress-body">
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $freelancer_profile_progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $freelancer_profile_progress; ?>%;"></div>
                  </div>
                  <p class="progress-to"><?php echo $freelancer_profile_progress; ?>%</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="dashboard-container">
          <div class="dashboard-content-wrapper w-100">

            <?php if($freelancer['resume']['name']) { ?>
            <div class="download-resume dashboard-section">
              <a href="<?php echo $freelancer['resume']['download']; ?>" download><?php echo $freelancer['resume']['name']; ?> <i data-feather="download"></i></a>
            </div>
            <?php } ?>

            <?php if($freelancer['skills']) { ?>
              <div class="skill-details details-section dashboard-section">
                <h4 class="w-100 d-block"><i data-feather="command"></i>Skills</h4>
                <div class="skill-and-profile">
                  <div class="skill">
                      <?php foreach($freelancer['skills'] as $skill) { ?>
                        <a href="#" class="mb-3"><?php echo $skill['name']; ?></a>
                      <?php } ?>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if($freelancer['about']) { ?>
              <div class="about-details details-section dashboard-section">
                <h4><i data-feather="align-left"></i>Profile Summary</h4>
                <p><?php echo $freelancer['about']; ?></p>
              </div>
            <?php } ?>

            <?php if($freelancer['education']) { ?>
              <div class="edication-background details-section dashboard-section">
                <h4><i data-feather="book"></i>Education</h4>
                <?php foreach($freelancer['education'] as $education){ ?>
                  <div class="education-label">
                    <span class="study-year"><?php echo $education->ce_yop; ?></span>
                    <h5><?php echo $education->ce_specialization; ?><span>@ <?php echo $education->ce_institute; ?></span></h5>
                    <p>Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

            <?php if($freelancer['experience']) { ?>
              <div class="experience dashboard-section details-section">
                <h4><i data-feather="briefcase"></i>Work Experiance</h4>
                <?php foreach($freelancer['experience'] as $experience){ ?>
                  <div class="experience-section">
                    <span class="service-year"><?php echo view_date_format($experience->cwe_start_date); ?> - <?php echo view_date_format($experience->cwe_end_date); ?></span>
                    <h5><?php echo $experience->cwe_job_title; ?><span>@ <?php echo $experience->cwe_company_name; ?></span></h5>
                    <p>Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>



            <?php if($freelancer['project']) { ?>
              <div class="edication-background details-section dashboard-section">
                <h4><i data-feather="book"></i>Project</h4>
                <?php foreach($freelancer['project'] as $project){ ?>
                  <div class="education-label">
                    <!-- <span class="study-year"><?php echo $project->ce_yop; ?></span> -->
                    <h5><?php echo $project->cp_name; ?><span>@ <?php echo $project->cp_company_name; ?></span></h5>
                    <p><?php echo $project->cp_description; ?></p>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

            <?php if($freelancer['certification']) { ?>
              <div class="edication-background details-section dashboard-section">
                <h4><i data-feather="book"></i>Certification</h4>
                <?php foreach($freelancer['certification'] as $certification){ ?>
                  <div class="education-label">
                    <span class="study-year"><?php echo $certification->cc_completion_year; ?></span>
                    <h5><?php echo $certification->cc_name; ?></h5>
                    <p><?php echo $certification->cc_description; ?></p>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

            <?php if($freelancer['desired_job']) { ?>
                  <?php $desired_job = $freelancer['desired_job']; ?>
                  <div class="personal-information dashboard-section last-child details-section">
                    <h4><i data-feather="user-plus"></i>Desired Job</h4>
                    <ul>
                      <li><span>Experience:</span> <?php echo $desired_job['experience']; ?></li>
                      <li><span>Languages:</span> <?php echo $desired_job['languages']; ?></li>
                    </ul>
                  </div>
                <?php } ?>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

