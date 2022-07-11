<!-- Menubar -->
<?php include APPPATH . 'views/company/include/menubar.php'; ?>
<!-- Menubar End -->

<div class="section-default-header"></div>

<?php include APPPATH . 'views/company/include/navbar.php'; ?>
<div class="ps-dashboard ps-section--sidebar">
  <div class="container">
    <div class="ps-section__container">
      <div class="ps-section__content">
        <div class="" id="drafted-jobs">
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

<script>
  $(function() {
    //Job Actions
    function loadJobAction(href) {
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
            }, 1000);

          } else if (res.error) {
            // $.ALERT.show('danger', res.message);
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
          loadJobAction(delete_href);
        }
      });
    });

  });
</script>

<script>
  $(function() {
    var href_loadInactiveJobs = '<?php echo $loadInactiveJobs; ?>';
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

          job_actions += '<a data-toggle="tooltip" title="Edit Job" href="' + job.edit + '" class="ml-2 edit ps-btn ps-btn--sm"><i class="fa fa-pencil-square-o"></i> Edit</a>';

          job_actions += '<a data-toggle="tooltip" title="Remove Job" href="' + job.delete + '" class="ml-2 remove btn-remove ps-btn ps-btn--outline ps-btn--sm"><i class="fa fa-times-circle"></i> Remove</a>';

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
            // $.ALERT.show('danger', res.message);
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
          element.find('tr.job-items td').attr('data-timeline-loader', 'false');
        }
      });
    }


    //Load Active Jobs
    loadJobs(candidates_tbody, href_loadInactiveJobs);
  });
</script>

<!-- Chat Start -->
<?php include APPPATH . 'views/include/chatbox.php'; ?>
<!-- Chat End -->