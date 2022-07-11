    <!-- Menubar -->
    <?php include APPPATH. 'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
    <style type="text/css">
        .alice-bg {
             background: white !important; 
        }
        /* .content__style {
            background-color: #EAEAEA !important;
        } */
        /* .card-footer {
            background-color: #EAEAEA !important;
        } */
        .vertical-line{
          display: inline-block;
          border-left: 2px solid #ccc;
          margin: 0 10px;
          height: 37px;
        }
        /* .pt-5 {
            background-color: #EAEAEA !important;
        } */
    </style>

    <div class="section-default-header"></div>

    <div class="alice-bg padding-top-60 padding-bottom-60">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col-12">
            <!-- Company Details -->
            <div class="section-padding-bottom">
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    <div class="company-details" style="background-image: linear-gradient(to right, #285C7F , #4CB9BD); padding: 5px !important;">
                    </div>
                    <div class="company-details mb-5">
                      <!-- <div class="title-and-info"> -->
                      <div class="row">
                        <div class="col-md-8">
                          <div class="title">
                            <div class="title-body">
                              <div class="row">
                              <h5 style="color: #696969;"><?php echo $job['title']; ?></h5>
                              <span class="vertical-line"></span>
                             <!--  <div class="info"> -->
                                <h5 style="color: #696969;"><!-- <i data-feather="briefcase"></i> --><?php echo $job['job_category']; ?></h5>
                                <span class="vertical-line"></span>
                                <h5 style="color: #696969;"><!-- <i data-feather="map-pin"></i> --><?php echo $job['location']; ?></h5>
                              </div>
                             <!--  </div> -->
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="action-block">
                            <a href="<?php echo base_url() . 'company/dashboard'; ?>" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow ml-2">Back to jobs</a>
                            <a href="#" id="btn-job-details" class="ps-btn small" >Details</a>
                          </div>
                        </div>
                      </div>
                    </div>
                     <!--  </div> -->
                    </div>
                  </div>

                  <div class="col-12" >
                    <div class="row">
                        <div class="col-sm-3" id="job-filter-wrapper">
                            <!-- Candidate Job Filter -->
                            <?php include APPPATH. 'views/company/include/candidate_job_filter.php'; ?>
                            <!-- Candidate Job Filter End -->
                        </div>
                        <div class="col-sm-9" id="candidates-content-area">
                            <div class="card card-body alice-bg card-shadow candidates-card-header mb-4 content__style">
                                <div class="row align-items-center">
                                    <div class="col overlay-actionsz">
                                        <input type="checkbox" name="candidate_action[]" class="mr-2">
                                        <a href="javascript:void(0)" class="button-default small mr-2 btn-email light-gray-color"><!-- <i data-feather="mail"></i> --> Email</a>
                                        <a href="javascript:void(0)" style="margin-left: 20px;" class="button-default small mr-2 btn-download light-gray-color"><!-- <i data-feather="download"></i> --> Download</a>
                                        <a href="javascript:void(0)" style="margin-left: 20px;" class="button-default small mr-2 btn-pipeline light-gray-color"><!-- <i data-feather="pocket"></i> --> Pipeline</a>
                                        <a href="javascript:void(0)" style="margin-left: 20px;" class="button-default small mr-2 btn-archive light-gray-color"><!-- <i data-feather="archive"></i> --> Archive</a>
                                    </div>
                                </div>
                            </div>

                            <hr style="height:2px;border-width:0;color:#346E96;background-color:#346E96;">


                            <div id="candidate-content">
                                <div class="manage-candidate-container">
                                  <div id="candidates-card-body">
                                    <div class="card candidates-list p-0 border mb-5" >
                                        <div class="card-body">
                                            <div class="text-center" data-timeline-loader="true"></div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>

                        </div>
                    </div>
                  </div>

                </div>
              </div>

            </div>
            <!-- Company Details End -->
          </div>
        </div>
      </div>
    </div>

    <!-- candidate detail modal -->
    <div class="modal fade account-entry" id="candidate-details-modal">
        <div class="modal-dialog modal-dialog-slideout modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Candidate Resume</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
              </div>
            </div>
        </div>
    </div>

    <!-- job detail modal -->
    <div class="modal fade account-entry" id="job-details-modal">
        <div class="modal-dialog modal-dialog-slideout modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><?php echo $job['title']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="about-details details-section">
                      <h4><i data-feather="align-left"></i>Job Summary</h4>
                      <p><?php echo $job['description']; ?></p>

                      <div class="information">
                            <ul>
                              <li><span>Industry:</span> <?php echo $job['company_category']; ?></li>
                              <li><span>Job Category:</span> <?php echo $job['job_category']; ?></li>
                              <li><span>Gender:</span> <?php echo $job['gender']; ?></li>
                              <li><span>Location:</span> <?php echo $job['location']; ?></li>
                              <li><span>Job Type:</span> <?php echo $job['job_type'] ? implode(', ', $job['job_type']) : ''; ?></li>
                              <li><span>Experience:</span> <?php echo $job['experience']; ?></li>
                              <li><span>Salary Package:</span> <?php echo $job['salary_package'] ? $job['salary_package']['name'] : ''; ?></li>
                              <li><span>Notice Period:</span> <?php echo $job['notice_period']; ?></li>
                              <li><span>Expiry Date:</span> <?php echo $job['expiry_date']; ?></li>
                            </ul>
                      </div>
                    </div>

                <div class="qualification details-section">
                  <h4><i data-feather="grid"></i>Education</h4>
                  <div class="information">
                      <?php if($job['job_qualifications']) { ?>
                        <ul>
                          <?php foreach($job['job_qualifications'] as $qualification){ ?>
                                <li><span><?php echo $qualification['qualification']; ?>:</span> <?php echo $qualification['specialization']; ?></li>
                          <?php } ?>
                        </ul>
                      <?php } ?>
                  </div>
                </div>

                <div class="skill details-section">
                  <h4 class="d-block"><i data-feather="git-branch"></i>Key Skills</h4>
                  <div class="information d-block">
                      <ul>
                        <?php if($job['job_technology']){ ?><li><span>Technology:</span> <?php echo $job['job_technology']; ?></li><?php } ?>
                        <?php if($job['job_skills']){ ?><li><span>Skills:</span> <?php echo $job['job_skills'] ? implode(', ', $job['job_skills']) : ''; ?></li><?php } ?>
                        <?php if($job['job_certification']){ ?><li><span>Certification:</span> <?php echo $job['job_certification']; ?></li><?php } ?>
                      </ul>
                  </div>
                </div>

                <div class="open-job details-section">
                  <h4><i data-feather="check-circle"></i>Benefits</h4>
                  <p><?php echo $job['benefits']; ?></p>
                </div>
              </div>
          </div>
        </div>
    </div>

    <!-- Call to Action -->
    <?php include APPPATH. 'views/include/module_actions.php'; ?>
    <!-- Call to Action End -->

    <script>
        var job_id = '<?php echo $job_id; ?>';
        var load_jobs_url = '<?php echo $loadappliedJobs; ?>';
        var candidates_card_body = $('#candidates-card-body');
        var candidates_content_area = $('#candidates-content-area');
    </script>

    <?php $this->document->addScript(base_url() . 'application/assets/js/include/candidate/jobpost_view.js', 'footer'); ?>
