    <!-- Menubar -->
    <?php include APPPATH . 'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->

    <style>
      .information .title {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
      }

      .information .button {
        background: #246df8;
        color: #ffffff;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        border-radius: 3px;
        padding: 6px 18px;
        border: 1px solid transparent;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
      }

      .information .button:hover {
        color: #246df8;
        background: #ffffff;
        border: 1px solid #246df8;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
      }

      .information .title .title-body {
        padding-left: 20px;
      }

      .information .title .title-body h4.name {
        border: 0;
        margin-bottom: 1rem;
        padding: 0;
      }

      .information .title .thumb {
        width: 100px;
        height: 100px;
        background: #f9f9f9;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 3px;
        overflow: hidden;
        position: relative;
      }

      .information .title .thumb img {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }

      .information.no-bg-img,
      .job-filter-wrapper.no-bg-img {
        background-image: none;
      }


      #candidates-content-area .candidates-card-body {
        padding: 2.5rem;
      }

      .user-info h5 {
        font-size: 1.4rem;
      }
    </style>

    <div class="section-default-header"></div>
    <?php include APPPATH . 'views/company/include/navbar.php'; ?>
    <div class="py-4">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <!-- Company Details -->
            <div class="section-padding-bottom">
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    <div class="company-details ps--border mb-4">
                      <!-- <div class="title-and-info"> -->
                      <div class="card border-0">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-8">
                              <h5 class="mb-2" style="color: #285C7F;"><a id="btn-job-details" style="font-size: 18px;" href="javascript:void(0)"><?php echo $job['title']; ?></a></h5>
                            </div>
                            <div class="col-md-4 text-right">
                              <div class="info">
                                <span class="company-type p-2"><i data-feather="briefcase" class="p-1"></i><?php echo $job['job_category']; ?></span>
                                <?php if ($job['location']) { ?><span class="office-location"><i data-feather="map-pin" class="p-1"></i><?php echo $job['location']; ?></span><?php } ?>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>

                      <!-- </div> -->
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="row">
                      <div class="col-sm-3" id="job-filter-wrapper">
                        <!-- Freelancer Job Filter -->
                        <?php include APPPATH . 'views/company/include/freelancer_job_filter.php'; ?>
                        <!-- Freelancer Job Filter End -->
                      </div>
                      <div class="col-sm-9" id="candidates-content-area">
                        <div class="candidates-card-body p-0">
                          <div class="information no-bg-img white-bg mb-3 candidate-information border rounded-0" data-timeline-loader="true"></div>
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

    <!-- Candidate detail modal -->
    <div class="modal fade account-entry" id="candidate-details-modal">
      <div class="modal-dialog modal-dialog-slideout modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Freelancer Resume</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          </div>
        </div>
      </div>
    </div>

    <!-- Job Details Modal-->
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
            <div class="">
              <div class="about-details details-section">
                <h4><i data-feather="align-left"></i>Job Summary</h4>
                <p><?php echo $job['description']; ?></p>

                <div class="information">
                  <ul>
                    <li><span>Job Category:</span> <?php echo $job['job_category']; ?></li>
                    <li><span>Job specialization:</span> <?php echo $job['job_specialization']; ?></li>
                    <li><span>Job Duration:</span> <?php echo $job['job_duration']; ?></li>
                    <li><span>Job Type:</span> <?php echo $job['job_type']; ?></li>
                    <li><span>Experience Level:</span> <?php echo $job['experience_level']; ?></li>
                    <li><span>Experience:</span> <?php echo $job['experience']; ?></li>
                    <li><span>Pay Type:</span> <?php echo $job['pay_type']; ?></li>
                    <li><span>Pay Amount:</span> <?php echo $job['pay_amount']; ?></li>
                  </ul>
                </div>
              </div>

              <!--<div class="qualification details-section">
                          <h4><i data-feather="grid"></i>Education</h4>
                          <div class="information">
                              <?php if ($job['job_qualifications']) { ?>
                                <ul>
                                  <?php foreach ($job['job_qualifications'] as $qualification) { ?>
                                        <li><span><?php echo $qualification['qualification']; ?>:</span> <?php echo $qualification['specialization']; ?></li>
                                  <?php } ?>
                                </ul>
                              <?php } ?>
                          </div>
                        </div>-->

              <div class="skill details-section">
                <h4 class="d-block"><i data-feather="git-branch"></i>Key Skills</h4>
                <div class="information d-block">
                  <ul>
                    <?php if ($job['job_skills']) { ?><li><span>Skills:</span> <?php echo implode(', ', $job['job_skills']); ?></li><?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Chat Start -->
    <?php include APPPATH . 'views/include/chatbox.php'; ?>
    <!-- Chat End -->

    <script>
      $(function() {

        var page = 1;
        var load_jobs_url = '<?php echo $loadappliedjobs; ?>';
        var candidate_content_area = $('#candidates-content-area');

        function loadJobsView(jobs, pagination) {
          candidate_content_area.find('.candidates-card-body').html('');
          if ($.isArray(jobs) && jobs.length > 0) {
            $.each(jobs, function(jkey, job) {
              var job_actions = '';

              if (job.isRemoved == 0) {
                job_actions += '<a href="' + job.freelancer.remove + '" class="ps-btn ps-btn--sm bg-danger border-danger ml-2 btn-reject-job"><i data-feather="x-circle"></i> Reject</a>';
                if (job.isAccepted == 0) {
                  job_actions += '<a class="ps-btn ps-btn--sm bg-success border-primary ml-2 btn-accept-job" href="' + job.freelancer.accept + '"><i data-feather="check-circle"></i> Accept</a>';
                }
              } else {
                job_actions += '<button class="ps-btn ps-btn--sm bg-danger white-text ml-2 cursor-default"><i data-feather="x-circle"></i> Rejected</button>';
              }

              if (job.accepted == 1) {
                job_actions = '<button class="ps-btn ps-btn--sm bg-success white-text ml-2 cursor-default"><i data-feather="user-check"></i> Accepted</button>';
                job_actions += '<a href="' + job.milestone_link + '" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow ml-2"><i data-feather="align-justify"></i> Milestone</a>';
                job_actions += '<a href="' + job.cancel_link + '" class="ps-btn ps-btn--sm ps-btn--outline btn-cancel-job ml-2"><i data-feather="x-circle"></i> Cancel</a>';
              }
              if (job.isRemoved == 0) {
                job_actions += '<a data-freelancer-jobid="' + job.freelancer_job_id + '" href="' + $base_url + 'company/activity/freelancer_chat/start/' + job.freelancer_job_id + '" class="ps-btn ps-btn--sm btn-secondary ml-2" data-chatbox="true"><i data-feather="message-square"></i> Chat</a>';
              }
              candidate_content_area.find('.candidates-card-body').append('<div class="card mb-4 ps--border">' +
                '<div class="card-body">' +
                '<div class="col-12">' +
                '<div class="row">' +
                '<div class="col-12 pt-4">' +
                '<div class="user-info p-3">' +
                '<div class="title media mb-4">' +
                '<div class="thumb" style="width: 10%;"><img src="' + job.freelancer.thumb + '" class="img-fluid rounded-circle" alt="" /></div>' +
                '<div class="media-body ml-5">' +
                '<div class="body mb-2 d-flex border-bottom-1">' +
                '<a href="' + $base_url + 'company/activity/freelancer/profile/' + job.freelancer_id + '" class="w-75" target="_blank"><h4 style="font-size:18px;">' + job.freelancer.name + '</h4></a>' +
                '<p class="w-25" style="font-size:18px"><b>Bid Amount:</b> ' + job.bid_amount + '</p>' +
                '</div>' +
                '<div class="text-left">' +
                '<p class="d-inline-block mr-3">Projects Completed</p>' +
                '<div class="d-inline-block mr-3">' +
                '<div class="d-flex cprogress-bar">' +
                '<div class="d-flex align-items-center mr-2">' +
                '<div class="circle-progress"></div>' +
                '<div class="circle-progress"></div>' +
                '<div class="circle-progress"></div>' +
                '<div class="circle-progress"></div>' +
                '<div class="circle-progress"></div>' +
                '<div class="circle-progress"></div>' +
                '<div class="circle-progress"></div>' +
                '<div class="circle-progress"></div>' +
                '<div class="circle-progress"></div>' +
                '<div class="circle-progress"></div>' +
                '</div>' +
                '<span>80%</span>' +
                '</div>' +
                '</div>' +
                '</div>' +

                '<div class="info info-content">' +
                '<div class="info-inner">' +
                '<div class="inner-1 border-bottom-1">' +
                '<div class="d-flex mb-2">' +
                '<div class="col-md-4 alice-bg px-2 py-3 text-center mr-2" style="border-radius:50px;">Applied On: ' + job.post_date + '</div>' +
                '<div class="col-md-4 alice-bg px-2 py-3 text-center mr-2" style="border-radius:50px;">Location: ' + job.freelancer.location + '</div>' +
                '<div class="col-md-4 alice-bg px-2 py-3 text-center" style="border-radius:50px;">Exp. 10 years</div>' +
                '</div>' +
                '<p class="txt-view"><span><b>Key Skills:</b> </span>' + job.freelancer.skills + '</p>' +
                '</div>' +

                '<div class="inner-2">' +
                '<p class="txt-view">' + job.bid_proposal + '</p>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="border-0 p-0 card-footer white-bg text-right">' +
                '<div class="d-inline-block px-3 pb-3 alice-bg2">' +
                '<div class="d-flex align-items-center">' +
                '<div class="d-block py-3">' +
                job_actions +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div>');


            });

            if (pagination) {
              $('#pagination-block').html('<div class="pagination-list text-center">' +
                '<nav class="navigation pagination">' +
                '<div class="nav-links">' +
                pagination +
                '</div>' +
                '</nav>' +
                '</div>');
            }

          } else {
            candidate_content_area.find('.candidates-card-body').append('<div class="card border">' +
              '<div class="card-body mb-2 candidate-information p-4">' +
              '<h5 class="text-center">No Freelancer Available</h5>' +
              '</div>' +
              '</div>');
          }

          feather.replace();
          initProgressBar();
        }

        function loadJobs(href) {
          $.ajax({
            url: href,
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
              candidate_content_area.append('<div class="jy-content-loader"></div>');
              candidate_content_area.find('.candidates-card-body .candidate-information').attr('data-timeline-loader', 'true');
              // Load Timeline Loader
              $.TIMELINE.loader();
            },
            success: function(res) {
              if (res.success) {
                page = res.page;
                loadJobsView(res.jobs, res.pagination);
              } else if (res.error) {
                loadJobsView(res.jobs, res.pagination);
              } else {
                //$.ALERT.show('danger', 'No Data');
                Toast.fire({
                   icon: 'error',
                   title: 'No Data'
                 });
              }
            },
            error: function(xhr, ajaxOptions, errorThrown) {
              console.log(xhr.responseText + ' ' + xhr.statusText);
            },
            complete: function() {
              $('#candidate-content').find('.jy-content-loader').remove();
            }
          });
        }

        //Get applied jobs
        loadJobs(load_jobs_url);

        $(document).on('click', 'a[data-chatbox=true]', function(e) {
          e.preventDefault();
          let chat_url = $(this).attr('href');
          let freelancer_job_id = $(this).attr('data-freelancer-jobid');
          loadChatbox(chat_url, {
            name: 'rtc-cmp' + freelancer_job_id,
            list: $base_url + 'company/activity/freelancer_chat/listMessages/' + freelancer_job_id,
            action: $base_url + 'company/activity/freelancer_chat/addMessage/' + freelancer_job_id,
            upload: $base_url + 'company/activity/freelancer_chat/uploadMessage/' + freelancer_job_id
          });
        });

        //Load Job Filter
        var jf_wrapper = $('#job-filter-wrapper');
        var jf_skills = $('#job-filter-skills');
        var jf_location = $('#job-filter-location');
        var jf_languages = $('#job-filter-languages');
        var jf_experiences = $('#job-filter-experiences');
        var jf_url = '';

        function filter_action() {
          jf_url = '';
          var location_value = jf_location.find('input[type=\'checkbox\']:checked').val();
          if (location_value) {
            jf_url += '&filter_location=' + location_value;
          }

          var skill_values = jf_skills.find('input[type=\'checkbox\']:checked').map(function() {
            return $(this).val();
          }).get();
          if ($.isArray(skill_values) && skill_values.length > 0) {
            jf_url += '&filter_skills=' + skill_values.join(',');
          }

          var experience_values = jf_experiences.find('input[type=\'checkbox\']:checked').val();
          if (experience_values) {
            jf_url += '&filter_experiences=' + experience_values;
          }

          var language_values = jf_languages.find('input[type=\'checkbox\']:checked').map(function() {
            return $(this).val();
          }).get();
          if ($.isArray(language_values) && language_values.length > 0) {
            jf_url += '&filter_languages=' + language_values.join(',');
          }

          loadJobs(load_jobs_url + '?filter=jobs' + jf_url);
        }


        jf_wrapper.find('input[type=\'checkbox\'].clickable, input[type=\'radio\'].clickable').click(function() {
          filter_action();
        });
      });
    </script>

    <script>
      $(function() {
        //show job details modal
        $('#btn-job-details').click(function(e) {
          e.preventDefault();
          $('#job-details-modal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
          });
        });

        //Freelancer job accept
        $(document).on('click', '#candidates-content-area .btn-accept-job', function(e) {
          e.preventDefault();
          var href = $(this).attr('href');
          $.ajax({
            url: href,
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
                setTimeout(function() {
                  location.reload();
                }, 2000);
              } else if (res.error) {
                //$.ALERT.show('danger', res.message);
                Toast.fire({
                   icon: 'error',
                   title: res.message
                 });
              } else {
               // $.ALERT.show('danger', 'No Data');
               Toast.fire({
                   icon: 'error',
                   title: 'No Data'
                 });
              }
            },
            error: function(xhr, ajaxOptions, errorThrown) {
              console.log(xhr.responseText + ' ' + xhr.statusText);
            },
            complete: function() {
              $.FEED.hideLoader();
            }
          });
        });

        //Freelancer job cancel
        $(document).on('click', '#candidates-content-area .btn-cancel-job', function(e) {
          e.preventDefault();
          var href = $(this).attr('href');
          $.ajax({
            url: href,
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
                setTimeout(function() {
                  location.reload();
                }, 2000);
              } else if (res.error) {
                //$.ALERT.show('danger', res.message);
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
              console.log(xhr.responseText + ' ' + xhr.statusText);
            },
            complete: function() {
              $.FEED.hideLoader();
            }
          });
        });

        //Freelancer job reject
        $(document).on('click', '#candidates-content-area .btn-reject-job', function(e) {
          e.preventDefault();
          var href = $(this).attr('href');
          $.ajax({
            url: href,
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
                setTimeout(function() {
                  location.reload();
                }, 2000);
              } else if (res.error) {
                //$.ALERT.show('danger', res.message);
                Toast.fire({
                   icon: 'error',
                   title: res.message
                 });
              } else {
               // $.ALERT.show('danger', 'No Data');
               Toast.fire({
                   icon: 'error',
                   title: 'No Data'
                 });
              }
            },
            error: function(xhr, ajaxOptions, errorThrown) {
              console.log(xhr.responseText + ' ' + xhr.statusText);
            },
            complete: function() {
              $.FEED.hideLoader();
            }
          });
        });

        //show freelancer resume on modal
        $(document).on('click', '#candidates-content-area .btn--candidate-details', function(e) {
          e.preventDefault();
          var href = $(this).attr('href');
          $.ajax({
            url: href,
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
              $.FEED.showLoader();
            },
            success: function(res) {
              if (res.success) {
                $('#candidate-details-modal').find('.modal-body').html(res.html);
                $('#candidate-details-modal').modal({
                  backdrop: 'static',
                  keyboard: false,
                  show: true
                });

              } else if (res.error) {
                //$.ALERT.show('danger', res.message);
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
              console.log(xhr.responseText + ' ' + xhr.statusText);
            },
            complete: function() {
              $.FEED.hideLoader();
            }
          });
        });
      });
    </script>