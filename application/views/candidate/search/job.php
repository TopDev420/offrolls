<style>
  .button-success{
    color: #fff !important;
    background-color: #28a745 !important;
  }
  .alice-bg {
        background-color: white !important;
      }
</style>

    <!-- Menubar -->
    <?php include APPPATH. 'views/include/menubar.php'; ?>
    <!-- Menubar End -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
    <div class="section-default-header"></div>

    <!-- Breadcrumb -->
    <?php include APPPATH. 'views/candidate/include/breadcrumb.php'; ?>
    <!-- Breadcrumb End -->

    <!-- Job Listing -->
    <div class="alice-bg section-padding-bottom">
      <div class="container">
        <div class="row no-gutters">
          <div class="col">
            <div class="job-listing-container">

              <div class="filtered-job-listing-wrapper">
                <div class="job-view-controller-wrapper">
                  <div class="job-view-controller">
                    <div class="controller list active">
                      <i data-feather="menu"></i>
                    </div>
                  </div>
                  <?php if($logged){ ?>
                      <div class="job-view-filter">
                          <label class="button-default small">
                            <input type="checkbox" id="input-relevant-jobs" <?php echo ($filter_type == 'relevant_jobs') ? 'checked' : '';?> /> Relevent Jobs
                          </label>
                      </div>
                  <?php } ?>
                </div>
                <div class="job-view-controller-wrapper" style="background-image: linear-gradient(to right,  #285C7F , #4CB9BD); padding: 3px;"></div><br/>
                <div class="job-filter-result">
                  <?php if($jobs) { ?>
                    <?php foreach($jobs as $job) { ?>
                      <div class="job-list">
                        <div class="thumb">
                          <a href="#">
                            <img src="<?php echo $job['thumb']; ?>" class="img-fluid" alt="">
                          </a>
                        </div>
                        <div class="body">
                          <div class="content">
                            <h4><a href="<?php echo $job['view_job']; ?>"><?php echo $job['title']; ?></a></h4>
                            <div class="info">
                              <?php if($job['company_name']){ ?><span class="company" style="padding: 5px;"><i data-feather="briefcase" style="color: #36A15D;"></i><?php echo $job['company_name']; ?></span><?php } ?>
                              <?php if($job['location']){ ?><span class="office-location" style="padding: 5px;"><i data-feather="map-pin" style="color: #36A15D;"></i><?php echo $job['location']; ?></span><?php } ?>
                              <?php if($job['job_type']){ ?><span class="job-type temporary" style="padding: 5px;"><i data-feather="clock" style="color: #36A15D;"></i><?php echo $job['job_type']; ?></span><?php } ?>
                            </div>
                          </div>
                          <div class="more">
                            <div class="buttons">
                                <?php if($job['is_applied']){ ?>
                                    <a href="<?php echo $job['view_job']; ?>" class="ps-btn ps-btn--sm">View</a>
                                <?php } else { ?>
                                    <a href="<?php echo $job['view_job']; ?>" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow ml-2">View</a>
                                <?php } ?>

                            </div>
                            <p class="deadline"><?php echo $job['expiry_date']; ?></p>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  <?php } else { ?>
                    <div class="job-list">
                        <h5 class="text-center d-inline-block w-100">No Jobs Found</h5>
                    </div>
                  <?php } ?>

                  <div class="apply-popup">
                    <div class="modal fade" id="modal-apply-job" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                            <div class="m-5">
                              <h5 class="text-center">Loading...</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <?php if($pagination) { ?>
                  <div class="pagination-list text-center">
                    <nav class="navigation pagination" style="background-color: white;">
                      <div class="nav-links">
                        <?php echo $pagination; ?>
                      </div>
                    </nav>
                  </div>
                <?php } ?>

              </div>

              <!-- Job Filter Start -->
              <?php include APPPATH. 'views/candidate/include/job_filter.php'; ?>
              <!-- Job Filter End -->

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Job Listing End -->

    <!-- Call to Action -->
    <?php include APPPATH. 'views/include/module_actions.php'; ?>
    <!-- Call to Action End -->

    <script>
      $(function(){
        var logged = '<?php echo $logged ? 1 : 0; ?>';

        if(logged == 1){
            $('#input-relevant-jobs').not(':checked').click(function(){
                $.FEED.showLoader(); //Show Loader
                window.location.href = $base_url + 'candidate/search/jobs?filter_type=relevant_jobs';
            });
    
            $('#input-relevant-jobs:checked').click(function(){
                $.FEED.showLoader(); //Show Loader
                window.location.href = $base_url + 'candidate/search/jobs';
            });
        }
      });
    </script>
