    <!-- Menubar -->
    <?php include APPPATH . 'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->

    <div class="section-default-header"></div>

    <?php include APPPATH . 'views/company/include/navbar.php'; ?>

    <div class="ps-dashboard ps-section--sidebar">
      <div class="container">
        <div class="ps-section__container">
          <div class="ps-section__content">
            <div class="" id="published-jobs">
              <div class="card-body p-4 jobs--area">
                <div class="manage-job-container table-responsive" id="candidates-tbody">

                </div>
                <div class="ps-section__footer text-center jobs--pagination"></div>
              </div>
            </div>
          </div>
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
            <aside class="widget widget_profile widget_connections">
              <a class="ps-btn" href=""><span data-total-project><?php echo $total_projects; ?></span> - Projects</a>
              <div class="widget__content">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                  </div>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </div>
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
                // $.ALERT.show('danger', res.message);
                Toast.fire({
                  icon: 'error',
                  title: res.message,
                });
              } else {
                // $.ALERT.show('danger', 'No Data');
                Toast.fire({
                  icon: 'error',
                  title: 'NO Data',
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
        }

        $(document).on('click', '#candidates-tbody .btn-remove, #candidates-tbody1 .btn-remove', function(e) {
          e.preventDefault();
          var current = $(this);
          var delete_href = $(this).attr('href');
          //Remove Confirm Modal

          Swal.fire({
            title: 'Are you sure to remove?',
            showConfirmButton: true,
            confirmButtonText: 'Remove',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
          }).then(function(result) {
            if (result.isConfirmed) {
              loadJobAction(remove_href, current);
            }
          });

          // $.ALERT.confirm({
          //   icon: '<i class="fas fa-times-circle"></i>',
          //   className: 'danger-alert',
          //   message: 'Are you sure to remove?',
          //   buttons: ['Remove', 'Cancel'],
          //   confirm: {
          //     remove_callback: function() {
          //       loadJobAction(remove_href, current);
          //     },
          //     cancel_callback: function() {

          //     }
          //   }
          // });
        });

      });
    </script>

    <script>
      $(function() {
        var href_loadActiveJobs = '<?php echo $loadActiveJobs; ?>';
        var candidates_tbody = $('#candidates-tbody');

        //LoadJobs
        function loadJobsView(elementBlock, jobs) {

          let jobsPagination = elementBlock.parents('.jobs--area').find('.jobs--pagination');
          // elementBlock.html('');
          elementBlock.find('.job-items.empty').remove();
          jobsPagination.html('').remove();

          var jobsList = jobs.list;
          if ($.isArray(jobsList) && jobsList.length > 0) {
            $.each(jobsList, function(jkey, job) {
              var job_actions = '';

              job_actions += '<a data-toggle="tooltip" title="View" href="' + job.view + '" class="ml-2 ps-btn ps-btn--white ps-btn--shadow ps-btn--sm">Applied ' + job.total_applied_jobs + '</a>';
              job_actions += '<a data-toggle="tooltip" title="Remove Project" href="' + job.remove + '" class="ml-2 remove btn-remove ps-btn ps-btn--outline ps-btn--sm"><i class="fa fa-times-circle"></i> Remove</a>';
              if (job.completed == 0) {
                if (job.total_applied_jobs >= 1) {
                  elementBlock.append('<div class="ps-job ps-job--editable p-4">' +
                    '<div class="ps-job__content pl-0">' +
                    '<h4 class="mb-1"><a href="' + job.review + '" class="ps-job__title">' + job.title + '</a></h4>' +
                    '<p class="mb-1">' + job.pay_amount + ' | ' + job.pay_type + ' | ' + job.job_duration + '</p>' +

                    '<div class="ps-job__action">' +
                    job_actions +
                    '</div>' +
                    '<p class=""mb-1><small> Posted on ' + job.date_posted + '</small></p>' +
                    '</div>' +
                    '</div><hr/>');
                }
              }
            });

            $('[data-total-project]').html(jobs.total);
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

        function loadJobs(element, href) {
          $.ajax({
            url: href,
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
              element.parents('.jobs--area').find('.jobs--pagination').html('<div class="ps-link--viewmore"><span class="ps-icon--dots"><i></i></span> Loading <span class="ps-icon--dots"><i></i></span></div>');
            },
            success: function(res) {
              if (res.success) {
                loadJobsView(element, res.jobs);
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
                  title: 'NO Data'
                });
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


        //Load Active Jobs
        loadJobs(candidates_tbody, href_loadActiveJobs);
      });
    </script>

    <!-- Chat Start -->
    <?php include APPPATH . 'views/include/chatbox.php'; ?>
    <!-- Chat End -->