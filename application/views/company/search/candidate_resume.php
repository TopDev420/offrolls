    <!-- Menubar -->
    <?php include APPPATH .'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->

  <!-- Breadcrumb -->
  <?php include APPPATH. 'views/company/include/breadcrumb.php'; ?>
  <!-- Breadcrumb End -->



    <div class="alice-bg section-padding-bottom">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-container">
              <div class="dashboard-sidebar">
                <div class="user-info">
                  <div class="thumb">
                    <img src="<?php echo $candidate['thumb']; ?>" class="img-fluid" alt="">
                  </div>
                  <div class="user-body">
                    <h5><?php echo $candidate['name']; ?></h5>
                    <span><?php echo $candidate['email']; ?></span>
                  </div>
                </div>
                <div class="profile-progress">
                  <div class="progress-item">
                    <div class="progress-head">
                      <p class="progress-on">Profile</p>
                    </div>
                    <div class="progress-body">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
                      </div>
                      <p class="progress-to">70%</p>
                    </div>
                  </div>
                </div>
                <div class="post-sidebar">
                  <h5><i data-feather="arrow-down-circle"></i>Navigation</h5>
                  <ul class="sidebar-menu">
                    <li><a href="#attach-document">Attach Document</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#summary">Profile Summary</a></li>
                    <li><a href="#education">Education</a></li>
                    <li><a href="#experience">Work Experiance</a></li>
                    <li><a href="#professional-skill">Professional Skill</a></li>
                    <li><a href="#project">Project</a></li>
                    <li><a href="#certification">Certification</a></li>
                    <li><a href="#desired-career-detail">Desired Career Detail</a></li>
                    <li><a href="#personal-details">Personal Details</a></li>
                  </ul>
                </div>
              </div>

              <div class="dashboard-content-wrapper">
                <div class="download-resume dashboard-section">
                  <a href="#">Download CV<i data-feather="download"></i></a>
                </div>

                <?php if($candidate['skills']) { ?>
                  <div class="skill-and-profile dashboard-section">
                    <div class="skill">
                      <label>Skills:</label>
                      <?php foreach($candidate['skills'] as $skill) { ?>
                        <a href="#"><?php echo $skill['name']; ?></a>
                      <?php } ?>
                    </div>
                  </div>
                <?php } ?>

                <?php if($candidate['about']) { ?>
                  <div class="about-details details-section dashboard-section">
                    <h4><i data-feather="align-left"></i>Profile Summary</h4>
                    <p><?php echo $candidate['about']; ?></p>
                  </div>
                <?php } ?>

                <?php if($candidate['education']) { ?>
                  <div class="edication-background details-section dashboard-section">
                    <h4><i data-feather="book"></i>Education</h4>
                    <?php foreach($candidate['education'] as $education){ ?>
                      <div class="education-label">
                        <span class="study-year"><?php echo $education->ce_yop; ?></span>
                        <h5><?php echo $education->ce_specialization; ?><span>@ <?php echo $education->ce_institute; ?></span></h5>
                        <p>Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>

                <?php if($candidate['experience']) { ?>
                  <div class="experience dashboard-section details-section">
                    <h4><i data-feather="briefcase"></i>Work Experiance</h4>
                    <?php foreach($candidate['experience'] as $experience){ ?>
                      <div class="experience-section">
                        <span class="service-year"><?php echo view_date_format($experience->cwe_start_date); ?> - <?php echo view_date_format($experience->cwe_end_date); ?></span>
                        <h5><?php echo $experience->cwe_job_title; ?><span>@ <?php echo $experience->cwe_company_name; ?></span></h5>
                        <p>Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>

                <!--<div class="professonal-skill dashboard-section details-section">
                  <h4><i data-feather="feather"></i>Professional Skill</h4>
                  <p>Combined with a handful of model sentence structures, to generate lorem Ipsum which  It has survived not only five centuries, but also the leap into electronic typesetting</p>
                  <div class="progress-group">
                    <div class="progress-item">
                      <div class="progress-head">
                        <p class="progress-on">Photoshop</p>
                      </div>
                      <div class="progress-body">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
                        </div>
                        <p class="progress-to">70%</p>
                      </div>
                    </div>
                    <div class="progress-item">
                      <div class="progress-head">
                        <p class="progress-on">HTML/CSS</p>
                      </div>
                      <div class="progress-body">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
                        </div>
                        <p class="progress-to">90%</p>
                      </div>
                    </div>
                    <div class="progress-item">
                      <div class="progress-head">
                        <p class="progress-on">JavaScript</p>
                      </div>
                      <div class="progress-body">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
                        </div>
                        <p class="progress-to">74%</p>
                      </div>
                    </div>
                    <div class="progress-item">
                      <div class="progress-head">
                        <p class="progress-on">PHP</p>
                      </div>
                      <div class="progress-body">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
                        </div>
                        <p class="progress-to">86%</p>
                      </div>
                    </div>
                  </div>
                </div>-->

                <?php if($candidate['project']) { ?>
                  <div class="edication-background details-section dashboard-section">
                    <h4><i data-feather="book"></i>Project</h4>
                    <?php foreach($candidate['project'] as $project){ ?>
                      <div class="education-label">
                        <!-- <span class="study-year"><?php echo $project->ce_yop; ?></span> -->
                        <h5><?php echo $project->cp_name; ?><span>@ <?php echo $project->cp_company_name; ?></span></h5>
                        <p><?php echo $project->cp_description; ?></p>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>

                <?php if($candidate['certification']) { ?>
                  <div class="edication-background details-section dashboard-section">
                    <h4><i data-feather="book"></i>Certification</h4>
                    <?php foreach($candidate['certification'] as $certification){ ?>
                      <div class="education-label">
                        <span class="study-year"><?php echo $certification->cc_completion_year; ?></span>
                        <h5><?php echo $certification->cc_name; ?></h5>
                        <p><?php echo $certification->cc_description; ?></p>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>

                <?php if($candidate['personal_details']) { ?>
                  <?php $personal_details = $candidate['personal_details']; ?>
                  <div class="personal-information dashboard-section last-child details-section">
                    <h4><i data-feather="user-plus"></i>Personal Deatils</h4>
                    <ul>
                      <li><span>Father's Name:</span> <?php echo $personal_details['father_name']; ?></li>
                      <li><span>Mother's Name:</span> <?php echo $personal_details['mother_name']; ?></li>
                      <li><span>Date of Birth:</span> <?php echo view_date_format($personal_details['dob']); ?></li>
                      <li><span>Nationality:</span> <?php echo $personal_details['nationality']; ?></li>
                      <li><span>Sex:</span> <?php echo ucfirst($personal_details['gender']); ?></li>
                      <li><span>Address:</span> <?php echo $personal_details['address']; ?></li>
                    </ul>
                  </div>
                <?php } ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Call to Action -->
    <div class="call-to-action-bg padding-top-90 padding-bottom-90">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="call-to-action-2">
              <div class="call-to-action-content">
                <h2>For Find Your Dream Job or Candidate</h2>
                <p>Add resume or post a job. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec.</p>
              </div>
              <div class="call-to-action-button">
                <a href="add-resume.html" class="button">Add Resume</a>
                <span>Or</span>
                <a href="post-job.html" class="button">Post A Job</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Call to Action End -->
