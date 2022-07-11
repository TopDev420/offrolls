    <!-- Menubar -->
    <?php include APPPATH . 'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->

    <div class="section-default-header"></div>

    <nav class="ps-navigation--dashboard">
      <ul>
        <li><a href="<?php echo base_url() . 'company/dashboard'; ?>">Dashboard</a></li>
        <li class="active"><a href="<?php echo base_url() . 'company/jobs/freelancer/post'; ?> " data-toggle="tab" title="All Projects">
            <!-- <i class="fa fa-bars" aria-hidden="true"></i> -->&nbsp;Projects
          </a></li>
        <li><a href="#">Bookmark</a></li>
      </ul>
    </nav>
    <div class="alice-bg py-5">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col-12">
            <!-- Company Details -->
            <div class="section-padding-bottom">
              <div class="">
                <div class="row">
                  <div class="col-md-3 order-md-2">
                    <div class="ps-section__sidebar">
                      <aside class="widget widget_profile widget_progress">
                        <?php $user = isset($user) ? $user : ''; ?>
                        <?php if ($user) { ?>
                          <div class="ps-block--user">
                            <div class="ps-block__thumbnail"><img src="<?php echo $user['thumb']; ?>" alt=""></div>
                            <div class="ps-block__content">
                              <h4><?php echo $user['company_name']; ?></h4>
                              <a href="<?php echo $profile_link; ?>">View your profile<i class="fa fa-caret-right"></i></a>
                            </div>
                          </div>
                        <?php } ?>
                      </aside>
                    </div>
                  </div>

                  <div class="col-md-9 order-md-1">
                    <div class="ps-section__content jy-card card mb-5 border-0">
                      <div class="card-header p-0">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#published-jobs">Published</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#drafted-jobs">Draft</a>
                          </li>
                        </ul>
                      </div>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="published-jobs">
                          <div class="card-body p-4 jobs--area">
                            <div class="manage-job-container table-responsive" id="candidates-tbody">

                            </div>
                            <div class="ps-section__footer text-center jobs--pagination"></div>
                          </div>
                        </div>

                        <div class="tab-pane fade" id="drafted-jobs">
                          <div class="card-body p-4 jobs--area">
                            <div class="manage-job-container table-responsive" id="candidates-tbody1">

                            </div>
                            <div class="ps-section__footer text-center jobs--pagination"></div>
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
      </div>


      <script>
        $(function() {
          $('#btn-job-details').click(function(e) {
            e.preventDefault();
            $('#job-details-modal').modal({
              backdrop: 'static',
              keyboard: false,
              show: true
            });
          });
        });
      </script>
    </div>



    <script>
      $(function() {
        //Job Actions
        function loadJobAction(href, current) {
          $.ajax({
            url: href,
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
              $.FEED.showLoader();
            },
            success: function(res) {
              if (res.success) {
                $.ALERT.show('success', res.message);
                setTimeout(function() {
                  location.reload();
                }, 1000);

              } else if (res.error) {
                $.ALERT.show('danger', res.message);
              } else {
                $.ALERT.show('danger', 'No Data');
              }
            },
            error: function(xhr, ajaxOptions, errorThrown) {
              console.log(xhr.responseText + ' ' + xhr.statusText);
            },
            complete: function() {
              $.FEED.hideLoader();
            }
          });
        }

        $(document).on('click', '#candidates-tbody .btn-remove, #candidates-tbody1 .btn-remove', function(e) {
          e.preventDefault();
          var current = $(this);
          var delete_href = $(this).attr('href');
          //Remove Confirm Modal
          $.ALERT.confirm({
            icon: '<i class="fas fa-times-circle"></i>',
            className: 'danger-alert',
            message: 'Are you sure to remove?',
            buttons: ['Remove', 'Cancel'],
            confirm: {
              remove_callback: function() {
                loadJobAction(remove_href, current);
              },
              cancel_callback: function() {

              }
            }
          });
        });

      });
    </script>

    <script>
      $(function() {
        var href_loadActiveJobs = '<?php echo $loadActiveJobs; ?>';
        var href_loadInactiveJobs = '<?php echo $loadInactiveJobs; ?>';
        var candidates_tbody = $('#candidates-tbody');
        var candidates_tbody1 = $('#candidates-tbody1');

        //LoadJobs
        function loadJobsView(elementBlock, jobs, type) {

          let jobsPagination = elementBlock.parents('.jobs--area').find('.jobs--pagination');
          // elementBlock.html('');
          elementBlock.find('.job-items.empty').remove();
          jobsPagination.html('').remove();

          var jobsList = jobs.list;
          if ($.isArray(jobsList) && jobsList.length > 0) {
            $.each(jobsList, function(jkey, job) {
              var job_actions = '';
              if (type == 'drafted') {
                job_actions += '<a data-toggle="tooltip" title="Edit Job" href="' + job.edit + '" class="ml-2 edit ps-btn ps-btn--sm"><i class="fa fa-pencil-square-o"></i></a>';
              }
              job_actions += '<a data-toggle="tooltip" title="Remove Job" href="' + job.remove + '" class="ml-2 remove btn-remove ps-btn ps-btn--outline ps-btn--sm"><i class="fa fa-times-circle"></i></a>';

              elementBlock.append('<div class="ps-job ps-job--editable p-4">' +
                '<div class="ps-job__content pl-0">' +
                '<h4 class="mb-1"><a href="' + job.review + '" class="ps-job__title">' + job.title + '</a></h4>' +
                '<p class="mb-1">' + job.pay_amount + ' | ' + job.pay_type + ' | ' + job.job_duration + '</p>' +

                '<div class="ps-job__action">' +
                job_actions +
                '</div>' +
                '<p class=""mb-1><small><a href="' + job.view + '"><small>Applied ' + job.total_applied_jobs + '</small></a> | Posted on ' + job.date_posted + '</small></p>' +
                '</div>' +
                '</div><hr/>');

              // elementBlock.append('<tr class="job-items">' +
              //         '<td class="title text-left">' +
              //            '<p>'+job.title +'</p>' +
              //         '</td>' +
              //         '<td class="application">' +
              //             '<a href="'+ job.view +'" title="preview" class="primary-color"> '+ job.total_applied_jobs +'</a>' +
              //         '<td class="deadline">'+ job.date_posted +'</td>' +
              //         '<td class="action">'+
              //             job_actions +
              //         '</td>' +
              //     '</tr>');
            });

            if (jobs.pagination) {
              let viewMore = jobs.pagination;
              if (parseInt(viewMore.page) > 1) {
                elementBlock.append('<div class="ps-section__footer text-center jobs--pagination">' +
                  '<a class="ps-link--viewmore" href="' + viewMore.href + '"><span class="ps-icon--dots"><i></i></span> View more</a>' +
                  '</div>');

                elementBlock.parents('.jobs--area').find('.jobs--pagination').find('a.ps-link--viewmore').click(function(e) {
                  e.preventDefault();
                  let page_link = $(this).attr('href');
                  // loadJobsView(jobs, page_link);
                  loadJobs(elementBlock, page_link, 'projects');
                });
              }
            }

          } else {
            elementBlock.append('<div class="card-body job-items empty">' +
              '<div class="text-center" colspan="4">' +
              '<h5 >No Jobs Found</h5>' +
              '</div>' +
              '</div>');
          }

          feather.replace(); // Load feater icons
        }

        function loadJobs(element, href, type) {
          $.ajax({
            url: href,
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
              element.parents('.jobs--area').find('.jobs--pagination').html('<div class="ps-link--viewmore"><span class="ps-icon--dots"><i></i></span> Loading <span class="ps-icon--dots"><i></i></span></div>');
            },
            success: function(res) {
              if (res.success) {
                loadJobsView(element, res.jobs, type);
              } else if (res.error) {
                $.ALERT.show('danger', res.message);
              } else {
                $.ALERT.show('danger', 'No Data');
              }
            },
            error: function(xhr, ajaxOptions, errorThrown) {
              console.log(xhr.responseText + ' ' + xhr.statusText);
            },
            complete: function() {
              element.find('tr.job-items td').attr('data-timeline-loader', 'false');
            }
          });
        }


        //Ontab click load Jobs
        $("a[href='\#published-jobs\']").click(function(e) {
          if ($(this).hasClass('active')) {
            e.preventDefault();
          } else {
            loadJobs(candidates_tbody, href_loadActiveJobs, 'published');
          }
        });

        $("a[href='\#drafted-jobs\']").click(function(e) {
          if ($(this).hasClass('active')) {
            e.preventDefault();
          } else {
            loadJobs(candidates_tbody1, href_loadInactiveJobs, 'drafted');
          }
        });


        //Load Active Jobs
        loadJobs(candidates_tbody, href_loadActiveJobs, 'published');
      });
    </script>

    <!-- Chat Start -->
    <?php include APPPATH . 'views/include/chatbox.php'; ?>
    <!-- Chat End -->