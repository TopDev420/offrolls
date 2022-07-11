    <!-- Menubar -->
    <?php include APPPATH. 'views/include/menubar.php'; ?>
    <!-- Menubar End -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">

    <style>
      .dashboard-apply-area .job-list .body .more .deadline {
        display: block;
        visibility: visible;
      }
      .job-list:hover {
        border-radius: 5px;
      }
      .alice-bg {
        background-color: white !important;
      }
    </style>
    <div class="section-default-header"></div>
    
    <div class="alice-bg section-padding-top section-padding-bottom">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-container">

            	<!-- Dashboard Sidebar Start -->
              	<?php include 'include/sidebar.php'; ?>
              	<!-- Dashboard Sidebar End -->

              	<div class="dashboard-content-wrapper shadow">
                	<div class="dashboard-applied">
                        <h5  style="background-image: linear-gradient(to right, #285C7F , #4CB9BD); padding: 7px;"></h5>
                        <h5 class="apply-title" style="color: #2F4F4F;">Bookmarked Jobs</h5><br/>
                        <div class="dashboard-apply-area">
                            <?php if($jobs) { ?>
                              <?php foreach($jobs as $job){ ?>
                                <div class="job-list" style="border-radius: 16px;">
                                  <div class="thumb">
                                    <a href="#">
                                      <img src="<?php echo $job['thumb']; ?>" class="img-fluid" alt="">
                                    </a>
                                  </div>
                                  <div class="body">
                                    <div class="content">
                                      <h4><a href="<?php echo $job['view_job']; ?>"><?php echo $job['title']; ?></a></h4>
                                      <div class="info">
                                        <span class="company" style="padding: 5px;"><a href="#"><i data-feather="briefcase" style="color: #36A15D;"></i><?php echo $job['company_name']; ?></a></span>
                                        <span class="office-location" style="padding: 5px;"><a href="#"><i data-feather="map-pin" style="color: #36A15D;"></i><?php echo $job['location']; ?></a></span>
                                        <span class="job-type full-time" style="padding: 5px;"><a href="#"><i data-feather="clock" style="color: #36A15D !important;"></i><?php echo $job['job_type']; ?></a></span>
                                      </div>
                                    </div>
                                    <div class="more">
                                      <a href="<?php echo $job['remove_bookmarked']; ?>" class="bookmark-remove btn-remove-bookmarked-job" style="display: inline-block;"><i class="fas fa-times"></i></a>
                                      <p class="deadline">Deadline: <?php echo $job['expiry_date']; ?></a></p>
                                    </div>
                                  </div>
                                </div>
                              <?php } ?>
                            <?php } else { ?>
                                <div class="job-list">
                                    <h5 class="text-center w-100">No Jobs Found</h5>
                                </div>
                            <?php } ?>

                            <?php if($pagination) { ?>
                              <div class="pagination-list text-center">
                                <nav class="navigation pagination">
                                  <div class="nav-links">
                                    <?php echo $pagination; ?>
                                  </div>
                                </nav>
                              </div>
                            <?php } ?>

                          </div>
                	</div>
              	</div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Call to Action -->
    <?php include APPPATH. 'views/include/module_actions.php'; ?>
    <!-- Call to Action End -->

    <script>
        $(function(){
            function job_action(href, current){

              $.ajax({
                url: href,
                type: 'post',
                dataType: 'json',
                beforeSend: function(){
                  $.FEED.showLoader();
                },
                success: function(res) {
                  if(res.success){
                    current.parents('.job-list').fadeOut(400).remove();
                    $.ALERT.show('success', res.message);
                    setTimeout(function(){location.reload();},1500);
                  } else if(res.error){
                     $.ALERT.show('danger', res.message);
                  } else {
                    $.ALERT.show('danger', 'No Data');
                  }
                },
                error:function(xhr, ajaxOptions, errorThrown) {
                  console.log(xhr.responseText + ' ' + xhr.statusText);
                },
                complete: function() {
                  $.FEED.hideLoader();
                }
              });
            }

            $('.btn-remove-bookmarked-job').click(function(e){
              e.preventDefault();
              var current = $(this);
              var rm_bjob_href = $(this).attr('href');

              //Delete Confirm Modal
              $.ALERT.confirm({
                  icon: '<i class="fas fa-trash-alt"></i>',
                  className: 'danger-alert',
                  message: 'Are you sure to remove?',
                  buttons: ['Delete', 'Cancel'],
                  confirm: {
                    delete_callback: function(){
                      job_action(rm_bjob_href, current);
                    },
                    cancel_callback: function(){

                    }
                  }
              });
            });


        });
    </script>
