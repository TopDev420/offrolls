<!-- Menubar -->
<?php include APPPATH . 'views/freelancer/include/menubar.php'; ?>
<!-- Menubar End -->

<?php
$searchQuery = isset($searchQuery) ? $searchQuery : '';
?>

<div class="ps-page">
  <div class="ps-section--top bg--cover" data-background="<?php echo base_url('application/assets/images/img/bg/Employers.jpg'); ?>">
    <div class="container">
      <!--<div class="ps-section__header">
        <p>BROWSE <br/> EMPLOYERS</p>
      </div>-->
      <div class="ps-section__content">
        <form class="ps-form--home-find-job ps-form--top" action="#" id="jobSearchIn" method="get">
          <h1 style="color:#285C7F">Find freelance projects</h1>
          <h5>Get hired by the leading startups and companies. <br />
            Start your work and grow your business now.</h5>
          <div class="form-group"><i class="fa fa fa-search"></i>
            <input class="form-control" type="text" name="search" value="<?php echo $searchQuery; ?>" placeholder="Enter job title">
            <button type="submit" class="ps-btn">Find jobs</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div class="ps-section--sidebar ps-listing">
    <div class="container">
      <div class="ps-section__container">
        <div class="ps-section__content order-md-1 order-2">
          <div class="ps-section__items">
            <!-- <h4 class="ps-heading--2 mb-40"><span id="totalJobs">0 Results</span> -->
            <h4 class="ps-heading--2 mb-40"><span id="totalJobs"></span>
            </h4>
            <div id="searched--jobs">
              <div class="p-4 job-blocks"></div>
            </div>
          </div>
          <div class="ps-section__footer text-center" id="searched--jobs--pagination">

          </div>
        </div>
        <div class="ps-section__sidebar order-md-2 order-1">
          <div class="widget widget_profile widget_find-employers">
            <h3 class="widget-title">Find a Projects</h3>
            <!-- Filter -->
            <?php include APPPATH . 'views/freelancer/include/job_filter.php'; ?>
          </div>
          <!-- <div class="widget widget_profile widget_feature-members">
            <h3 class="widget-title">Featured Members</h3>
            <figure>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/1.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Zebra</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/2.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Moontheme Studio</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/3.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> La Carolina</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/4.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Mberak Designs</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/5.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Logo text</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/6.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Invectra</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/7.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Open Suse</a></div>
            </figure>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>application/assets/js/jquery.show-more.js"></script>
<script>
  $(function() {
    var searchQuery = '<?php echo $searchQuery; ?>';
    var href_loadSearchJobs = '<?php echo $loadSearchJobs; ?>';
    var jobBlocks = $('#searched--jobs .job-blocks');
    var searchedJobs = $('#searched--jobs');
    var searchedJobsPagination = $('#searched--jobs--pagination');

    //LoadJobs
    function loadJobsView(elementBlock, jobs) {
      <?php if ($searchQuery) { ?>
        if (jobs.total) {
          $('#totalJobs').html('<span>' + jobs.total + ' Results On ' + searchQuery + '</span>');
        } else {
          $('#totalJobs').html('<span id="totalJobs">0 Results</span>');
        }
      <?php } else { ?>
        $('#totalJobs').html('<span>' + jobs.total + ' Recommended</span>');
      <?php } ?>
      searchedJobsPagination.html('');
      var jobsList = jobs.list;
      if ($.isArray(jobsList) && jobsList.length > 0) {

        $.each(jobsList, function(jkey, job) {
          let jSkills = '';
          $.each(job.skills, function(skey, skill) {
            jSkills += '<span class="ps-tag">' + skill + '</span>';
          });

          let job_location = '';
          if (job.location) {
            job_location = '<span class="mr-4">' +
              '<i class="fa fa-map-marker" aria-hidden="true"></i> ' +
              '<strong class="theme-default">' + job.location + '<strong>' +
              '</span>';
          }
          elementBlock.append('<div class="jobs-list">' +
            '<div class="col-12">' +
            '<div class="row">' +
            '<div class="col-12 pt-5">' +
            '<div class="d-flex">' +
            '<div class="user-info">' +
            '<div class="row mb-4">' +
            '<div class="col-md-8">' +
            '<h5 class="font-500"><a href="' + job.view_job + '" class="title-h5 job--title--text">' + job.title + ' </a></h5>' +
            '</div>' +
            '</div>' +

            '<div class="info info-content">' +
            '<div class="row">' +
            '<div class="col-12">' +
            '<p class="">' +
            '<strong class="theme-default"><span>' + job.pay_type + ': ' + job.pay_amount + '</span></strong>-' + job.experience_level + '. Time: ' + job.job_duration + ', 10-30 hrs/week posted 2 hours ago.</p>' +
            '<div class="d-block short--view"><p class="m-0">' + job.description + ' </p></div>' +
            '<br>' +
            '</div>' +
            '<br>' +
            '<div class="col-12">' +
            jSkills +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            // '<div class="col-12 mt-4">' +
            //     '<p>Proposals : <strong class="theme-default">'+ job.applied_freelancers +'</strong></p>' +
            //     '<div class="bottom-info">' +
            //         '<span class="mr-4">' +
            //             '<i class="fas fa-check-circle "></i> '+
            //             '<strong class="theme-default" class="">Payment verified</strong>'+
            //         '</span>' +
            //         '<span class="mr-4"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></span>'+
            //         job_location +
            //     '</div>' +
            // '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<hr>');

          //Load more button
          elementBlock.parent().find('.card-footer').html('<button type="button" class="button-default small-sm alice-bg primary-color border-primary">Load More Jobs</button>').show();
        });

        if (jobs.view_more) {
          let viewMore = jobs.view_more;
          if (parseInt(viewMore.page) > 1) {
            searchedJobsPagination.html('<a class="ps-link--viewmore" href="' + viewMore.href + '"><span class="ps-icon--dots"><i></i></span> View more</a>');

            searchedJobsPagination.find('a.ps-link--viewmore').click(function(e) {
              e.preventDefault();
              let page_link = $(this).attr('href');
              loadSearchJobs(jobBlocks, page_link);
            });
          }
        }

      } else {
        elementBlock.append('<div class="card-body">' +
          '<div class="text-center" colspan="4">' +
          '<h5 >No Jobs Found</h5>' +
          '</div>' +
          '</div>');
      }

      feather.replace();
      elementBlock.find('.short--view').showMore({
        minheight: 80,
        buttontxtmore: '...more',
        buttontxtless: '...less',
        animationspeed: 250
      });

      // $('html,body').animate({
      //     scrollTop: $('#contentBlock').offset().top - 140
      // }, 1000);
    }

    function loadSearchJobs(element, href) {
      $.ajax({
        url: href,
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          searchedJobsPagination.html('<div class="ps-link--viewmore"><span class="ps-icon--dots"><i></i></span> Loading <span class="ps-icon--dots"><i></i></span></div>');
        },
        success: function(res) {
          if (res.success) {
            loadJobsView(element, res.jobs);
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

    loadSearchJobs(jobBlocks, href_loadSearchJobs);

    //Search Submit
    $('#jobSearchIn').submit(function(e) {
      e.preventDefault();
      var $cur = $(this);
      var csq = '';
      var searchQuery = $cur.find('input[name=\'search\']').val();
      if (searchQuery) {
        csq = '?csq=' + encodeURIComponent(searchQuery);
      }

      window.location.href = $base_url + 'freelancer/search/jobs' + csq;
    });
  });
</script>