    <!-- Menubar -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
    <?php include APPPATH. 'views/include/menubar.php'; ?>
    <!-- Menubar End -->
    <style type="text/css">
      .alice-bg {
          background-color: white !important;
        }
    </style>

    <div class="section-default-header"></div>

    <!-- Company Details -->
    <div class="alice-bg section-padding">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="company-details">
              <div class="title-and-info">
                <div class="title">
                  <div class="thumb">
                    <img src="<?php echo $company['thumb']; ?>" class="img-fluid" alt="">
                  </div>
                  <div class="title-body">
                    <h4><?php echo $company['company_name']; ?></h4>
                    <div class="info">
                      <?php if($company['company_category']){ ?><span class="company-type" style="padding: 5px;"><i data-feather="briefcase" style="color: #36A15D;"></i><?php echo $company['company_category']; ?></span><?php } ?>
                      <?php if($company['city']){ ?><span class="office-location" style="padding: 5px;"><i data-feather="map-pin" style="color: #36A15D;"></i><?php echo $company['city']; ?></span><?php } ?>
                    </div>
                  </div>
                </div>
                <div class="download-resume">
                  <!--<a href="#" class="save-btn"><i data-feather="heart"></i>Save</a>-->
                  <button class="ps-btn"><?php echo $company['total_jobs']; ?> Open Positions</a>
                </div>
              </div>
              <div class="title-and-info" style="background-image: linear-gradient(to right, #4CB9BD , #246df8); padding: 3px;"></div>
              
              <div class="details-information padding-top-60">
                <div class="row">
                  <div class="col-xl-7 col-lg-8">
                    <div class="about-details details-section">
                      <h4><i data-feather="align-left"></i>About Us</h4>
                      <p><?php echo $company['description']; ?></p>
                    </div>

                    <div class="open-job details-section">
                      <h4><i data-feather="check-circle"></i>Open Job</h4>
                      <?php if($jobs) { ?>
                            <?php foreach($jobs as $job) { ?>
                              <div class="job-list shadow">
                                <div class="body">
                                  <div class="content">
                                    <h4><a href="<?php echo $job['view_job']; ?>"><?php echo $job['title']; ?></a></h4>
                                    <div class="info">
                                      <span class="office-location"><a href="#"><i data-feather="map-pin"></i><?php echo $job['location']; ?></a></span>
                                      <span class="job-type temporary"><a href="#"><i data-feather="clock"></i><?php echo $job['job_type']; ?></a></span>
                                    </div>
                                  </div>
                                  <div class="more">
                                    <div class="buttons">
                                      <?php if($job['is_applied']){ ?>
                                            <a href="<?php echo $job['view_job']; ?>" class="ps-btn ps-btn--sm">View</a>
                                      <?php } else { ?>
                                            <a href="<?php echo $job['view_job']; ?>" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow ml-2 ">View</a>
                                      <?php } ?>
                                    </div>
                                    <p class="deadline"><?php echo $job['expiry_date']; ?></p>
                                  </div>
                                </div>
                              </div>
                            <?php } ?>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-xl-4 offset-xl-1 col-lg-4">
                    <div class="information-and-contact">
                      <div class="information">
                        <h4>Information</h4>
                        <ul>
                          <?php if($company['company_category']){ ?><li><span>Category:</span> <?php echo $company['company_category']; ?></li><?php } ?>
                          <li><span>Location:</span> <?php echo $company['city']; ?></li>
                          <li><span>Email:</span> <?php echo $company['email']; ?></li>
                          <?php if($company['web_link']){ ?><li><span>Website:</span> <a target="_blank" href="<?php echo $company['web_link']; ?>"><?php echo $company['web_link']; ?></a></li><?php } ?>
                        </ul>
                      </div>
                    </div>
                    <!--<div class="job-location">
                      <h4>Our Location</h4>
                      <div id="map-area">
                        <div class="cp-map" id="location" data-lat="40.713355" data-lng="-74.005535" data-zoom="10"></div>
                      </div>
                    </div>-->
                    <?php if($company['facebook_profile'] || $company['instagram_profile'] || $company['linkedin_profile']){ ?>
                    <div class="share-job-post">
                      <span class="share">Social Profile:</span>
                      <?php if($company['facebook_profile']){ ?><a href="<?php echo $company['facebook_profile']; ?>"><i class="fab fa-facebook-f"></i></a><?php } ?>
                      <?php if($company['linkedin_profile']){ ?><a href="<?php echo $company['linkedin_profile']; ?>"><i class="fab fa-linkedin-in"></i></a><?php } ?>
                      <?php if($company['instagram_profile']){ ?><a href="<?php echo $company['instagram_profile']; ?>"><i class="fab fa-instagram"></i></a><?php } ?>
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
    <!-- Company Details End -->

    <!-- Call to Action -->
    <?php include APPPATH. 'views/include/module_actions.php'; ?>
    <!-- Call to Action End -->

<script>
  $(function(){
    $('#contactCompanyForm').submit(function(e){
      e.preventDefault();

    });

    $('.btn-apply-job').click(function(e){
      e.preventDefault();
      var aj_href = $(this).attr('href');
      job_action(aj_href,  $(this), 'apply');
    });

    $('.btn-save-job').click(function(e){
      e.preventDefault();
      var sj_href = $(this).attr('href');
      job_action(sj_href, $(this), 'save');
    });

    function job_action(href, $current, type){
      var btn_txt = $current.html();
      $.ajax({
        url: href,
        type: 'post',
        dataType: 'json',
        beforeSend: function(){
          $.FEED.showLoader();
        },
        success: function(res) {
          if(res.success){
            $current.attr('href', 'javascript:void(0)').css({'color': '#fff','background-color': '#28a745'});
            $.ALERT.show('success', res.message);
            if(type == 'apply'){
              $current.html('Applied');
              $current.parent().find('.btn-save-job').fadeOut(300).remove();
            } else if(type == 'save'){

            }
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
  });
</script>
