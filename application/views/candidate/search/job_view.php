    <style>
        .similar-jobs-section {
            padding: 30px;
            -webkit-box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.03);
            box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.03);
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

    <!-- Company Details -->
    <div class="alice-bg section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="company-details">
              <div class="title-and-info">
                <div class="title">
                  <div class="thumb">
                    <img src="<?php echo $job['thumb']; ?>" class="img-fluid" alt="">
                  </div>
                  <div class="title-body">
                    <h4><?php echo $job['title']; ?></h4>
                    <div class="info">
                        <span class="company" style="padding: 5px;"><a href="#"><i data-feather="briefcase" style="color: #36A15D;"></i><?php echo $job['company_name']; ?></a></span>
                      <span class="office-location" style="padding: 5px;"><a href="#"><i data-feather="map-pin" style="color: #36A15D;"></i><?php echo $job['location']; ?></a></span>
                      <span class="job-type temporary" style="padding: 5px;"><a href="#"><i data-feather="clock" style="color: #36A15D !important;"></i><?php echo $job['job_type']; ?></a></span>
                    </div>
                  </div>
                </div>
                <div class="btn-actions">
                    <?php if($job['is_saved'] == 1) { ?>
                        <button class="ps-btn ps-btn--outline ml-2" style="color:#fff"><i data-feather="heart"></i> Saved</button>
                    <?php } else { ?>
                        <?php if($job['is_applied'] == 0){ ?>
                          <a href="<?php echo $job['bookmark']; ?>" class="btn-save-job favourite save-btn ps-btn ps-btn--outline ml-2" style="color:white" ><i data-feather="heart"></i> Save</a>
                        <?php } ?>
                    <?php } ?>

                    <?php if($job['is_applied'] == 1){ ?>
                        <button class="ps-btn ml-2" >Applied</button>
                    <?php } else { ?>
                        <a href="<?php echo $job['apply_job']; ?>" class="ps-btn btn-apply-job ml-2">Apply Now</a>
                    <?php } ?>
                </div>
              </div>
              <div class="title-and-info" style="background-image: linear-gradient(to right,  #285C7F , #4CB9BD); padding: 3px;"></div>

              <div class="details-information padding-top-60">
                <div class="row">
                  <div class="col-xl-7 col-lg-8">
                    <div class="about-details details-section">
                      <h4><i data-feather="align-left"></i>Job Summary</h4>
                      <p><?php echo $job['description']; ?></p>

                      <div class="information">
                            <ul>
                              <?php if($job['company_category']){ ?><li><span>Industry:</span> <?php echo $job['company_category']; ?></li><?php } ?>
                              <?php if($job['job_category']){ ?><li><span>Job Category:</span> <?php echo $job['job_category']; ?></li><?php } ?>
                              <?php if($job['gender']){ ?><li><span>Gender:</span> <?php echo $job['gender']; ?></li><?php } ?>
                              <?php if($job['job_type']){ ?><li><span>Job Type:</span> <?php echo $job['job_type']; ?></li><?php } ?>
                              <?php if($job['experience']){ ?><li><span>Experience:</span> <?php echo $job['experience']; ?></li><?php } ?>
                              <?php if($job['salary_package']){ ?><li><span>Salary Package:</span> <?php echo $job['salary_package']; ?></li><?php } ?>
                              <?php if($job['notice_period']){ ?><li><span>Notice Period:</span> <?php echo $job['notice_period']; ?></li><?php } ?>
                            </ul>
                      </div>
                    </div>

                    <?php if($job['job_qualifications']) { ?>
                    <div class="qualification details-section">
                      <h4><i data-feather="grid"></i>Education</h4>
                      <div class="information">
                            <ul>
                              <?php foreach($job['job_qualifications'] as $qualification){ ?>
                                    <li><span><?php echo $qualification['qualification']; ?>:</span> <?php echo $qualification['specialization']; ?></li>
                              <?php } ?>
                            </ul>
                      </div>
                    </div>
                    <?php } ?>

                    <?php if($job['job_technology'] || $job['job_skills'] || $job['job_certification']) { ?>
                    <div class="skill details-section">
                      <h4 class="d-block"><i data-feather="git-branch"></i>Key Skills</h4>
                      <div class="information d-block">
                          <ul>
                            <?php if($job['job_technology']){ ?><li><span>Technology:</span> <?php echo $job['job_technology']; ?></li><?php } ?>
                            <?php if($job['job_skills']){ ?><li><span>Skills:</span> <?php echo $job['job_skills']; ?></li><?php } ?>
                            <?php if($job['job_certification']){ ?><li><span>Certification:</span> <?php echo $job['job_certification']; ?></li><?php } ?>
                          </ul>
                      </div>
                    </div>
                    <?php } ?>

                    <?php if($job['benefits']){ ?>
                    <div class="open-job details-section">
                      <h4><i data-feather="check-circle"></i>Benefits</h4>
                      <p><?php echo $job['benefits']; ?></p>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-xl-4 offset-xl-1 col-lg-4">
                    <div class="information-and-contact">
                      <div class="information">
                        <h4>Information</h4>
                        <ul>
                          <!--<li><span>Category:</span> <?php echo $company['company_category']; ?></li>-->
                          <li><span>Location:</span> <?php echo $company['city']; ?></li>
                          <li><span>Email:</span> <?php echo $company['email']; ?></li>
                          <li><span>Website:</span> <a target="_blank" href="<?php echo $company['web_link']; ?>"><?php echo $company['web_link']; ?></a></li>
                        </ul>
                      </div>

                    </div>
                    <!--<div class="job-location">-->
                    <!--  <h4>Our Location</h4>-->
                    <!--  <div id="map-area">-->
                    <!--    <div class="cp-map" id="location" data-lat="40.713355" data-lng="-74.005535" data-zoom="10"></div>-->
                    <!--  </div>-->
                    <!--</div>-->
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
    var similar_jobs_details = $('#similar-jobs-details');
    $('#contactCompanyForm').submit(function(e){
      e.preventDefault();

    });

    var job_id = '<?php echo $job_id; ?>';

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
            $.ALERT.show('success', res.message);
            $current.hide();
            if(type == 'apply'){
              $current.after('<a href="javascript:void(0)" class="button button-success" style="cursor:default;">Applied</a>');
              $current.parent().find('.btn-save-job').fadeOut(300).remove();
            } else if(type == 'save'){
                $current.after('<a href="javascript:void(0)" class="favourite button-success" style="cursor:default;"><i data-feather="heart"></i> Saved</a>');
            }
            $current.remove();
            feather.replace();
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

    function viewSimilarJobs(data=[]){
        if(data && data.length > 0 && $.isArray(data)){
            similar_jobs_details.html('');
            $.each(data, function(i, val){
                var html = '<div class="job-list">' +
                        '<div class="body">' +
                          '<div class="content">' +
                            '<h4><a href="javascript:void(0)">'+ val.job_title +'</a></h4>' +
                            '<div class="info">' +
                              '<span class="office-location"><a href="#"><i data-feather="map-pin"></i>'+ val.location +'</a></span>' +
                              '<span class="job-type temporary"><a href="#"><i data-feather="clock"></i>'+ val.job_type +'</a></span>' +
                            '</div>' +
                          '</div>' +
                          '<div class="more">' +
                            '<div class="buttons">' +
                                '<a href="javascript:void(0)" class="button">Apply Now</a>' +
                                '<a href="javascript:void(0)" class="button-success favourite"><i data-feather="heart"></i></a>' +
                            '</div>' +
                            '<p class="deadline">'+ val.expiry_date +'</p>' +
                          '</div>' +
                        '</div>' +
                    '</div>';

                    similar_jobs_details.append(html);
            });

        } else {
            var html = '<div class="job-list">' +
                        '<div class="body">' +
                          '<div class="content">' +
                            '<h4><a href="javascript:void(0)">No similar jobs</a></h4>' +
                          '</div>' +
                        '</div>' +
                    '</div>';

            similar_jobs_details.html(html);
        }
    }


    function load_similarjobs(){

      $.ajax({
        url: $base_url + 'candidate/job/similarjobs/' + job_id,
        type: 'post',
        dataType: 'json',
        beforeSend: function(){
          $.FEED.showLoader();
        },
        success: function(res) {
          if(res.success){
            if(res.data){
                viewSimilarJobs(res.data);
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
