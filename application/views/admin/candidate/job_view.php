<!-- Menubar Top Start -->
<?php include APPPATH.'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->

<div class="container-fluid">
    <div class="row alice-bg">
      <div class="col-12 no-gliters p-0">
        <div class="dashboard-container">
          <!-- Dashboard Menubar-->
          <?php include APPPATH.'views/admin/include/menubar.php'; ?>

          <!-- Dashboard Content-->
          <div class="card dashboard-content-wrapper">
            <!-- Breadcrumb -->
            <?php include APPPATH.'views/admin/include/breadcrumb.php'; ?>

            <div class="dashboard-applied mb-5">
              <div class="dashboard-section">
                    <div class="card card-shadow mb-5">
                        <div class="card-body p-3">
                            <div class="dashboard-applied">
                                <div class="dashboard-apply-area">
                                    <div class="row">
                                      <div class="col-12">
                                        <div class="company-details">
                                          <div class="title-and-info">
                                            <div class="title">
                                              <div class="thumb">
                                                <img src="<?php echo $job['thumb']; ?>" class="img-fluid" alt="">
                                              </div>
                                              <div class="title-body" >
                                                <h4 style="top:10px"><?php echo $job['title']; ?></h4>
                                                <div class="info" style="margin-top: 30px; margin-bottom: 20px;">
                                                    <span class="company" style="padding: 5px;"><a href="#"><i data-feather="briefcase" style="color: #36A15D;"></i><?php echo $job['company_name']; ?></a></span>
                                                  <span class="office-location" style="padding: 5px;"><a href="#"><i data-feather="map-pin" style="color: #36A15D;"></i><?php echo $job['location']; ?></a></span>
                                                  <span class="job-type temporary" style="padding: 5px;"><a href="#"><i data-feather="clock" style="color: #36A15D !important;"></i><?php echo $job['job_type']; ?></a></span>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="download-resume">
                                                <?php if($job['is_saved'] == 1) { ?>
                                                    <a href="javascript:void(0)" class="button-success favourite" style="cursor:default; background-color: #2C8F60 !important;"><i data-feather="heart"></i> Saved</a>
                                                <?php } ?>

                                                <?php if($job['is_applied'] == 1){ ?>
                                                    <a href="javascript:void(0)" class="button button-success" style="cursor:default; background-color: #2C8F60 !important;">Applied</a>
                                                <?php } ?>
                                            </div>
                                          </div>
                                          <div class="title-and-info" style="background-image: linear-gradient(to right, #36A15D , #003F6D); padding: 3px;"></div>

                                          <div class="details-information padding-top-60">
                                            <div class="row">
                                              <div class="col-xl-7 col-lg-8">
                                                <div class="about-details details-section mt-3">
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
                        </div>
                    </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<script>
    $(function(){
        var job_id = '<?php echo $job["job_id"]; ?>';
        var href_loadAwardedcandidates = $base_url + 'admin/candidate/job/accepted/' + job_id;
        var candidates_tbody = $('#candidates-tbody');

        //LoadJobs
        function loadJobsView(elementBlock, jobs){
            elementBlock.html('');
            var jobsList = jobs.list;
            if($.isArray(jobsList) && jobsList.length > 0){
                $.each(jobsList, function(jkey,job){
                    var job_actions = '';
                    job_actions += '<a href="'+ job.milestone +'" class="button-default small-sm primary-bg-gradient ml-2"><i data-feather="airplay"></i></a>';


                    elementBlock.append('<div class="job-items col-12 mb-5">' +
                           '<div class="row">' +
                                '<div class="col-md-8">' +
                                    '<div class="title-block d-flex box align-items-center">' +
                                        '<div class="img m-0">' +
                                            '<img src="'+job.candidate_image +'" class="img-fluid" />' +
                                        '</div>' +
                                        '<div class="p-4">' +
                                            '<h5><a class="primary-color" href="'+ job.view +'" title="'+job.candidate_name +'">'+job.candidate_name +'</a></h5>' +
                                            '<p>Bid Amount: '+ job.bid_amount +'</p>'+
                                        '</div>' +
                                    '</div>' +
                                '</div>' +

                                '<div class="action col-md-4 text-right">'+
                                    job_actions +
                                '</div>' +
                                '<div class="col-12">'+
                                    '<div class="d-block"><p>'+ job.bid_proposal +'</p></div>'+
                                '</div>' +
                            '</div>' +
                        '</div>');
                });
                if(jobs.pagination){
                    elementBlock.parents('.card-body').find('.pagination-list').remove();
                    elementBlock.parents('.card-body').append('<div class="pagination-list text-center">' +
                          '<nav class="navigation pagination">' +
                            '<div class="nav-links">' +
                              jobs.pagination +
                            '</div>' +
                          '</nav>' +
                        '</div>');
                    elementBlock.parents('.card-body').find('.pagination .nav-links a').click(function(e){
                        e.preventDefault();
                        let href = $(this).attr('href');
                        loadJobs(elementBlock, href, type);
                    });
                }
            } else {
                elementBlock.append('<tr class="job-items">'+
                  '<td class="text-center" colspan="4">'+
                    '<h5 >No Jobs Found</h5>'+
                  '</td>'+
                '</tr>');
            }

            feather.replace();  // Load feater icons
        }

        function loadJobs(element, href){
          $.ajax({
            url: href ,
            type: 'post',
            dataType: 'json',
            beforeSend: function(){
              element.find('tr.job-items td').attr('data-timeline-loader', 'true');
              // Load Timeline Loader
              $.TIMELINE.loader(element);
            },
            success: function(res) {
              if(res.success){
                    loadJobsView(element, res.candidates);
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
              element.find('tr.job-items td').attr('data-timeline-loader', 'false');
            }
          });
        }



        //Load Active Jobs
        loadJobs(candidates_tbody, href_loadAwardedcandidates);
    });
</script>
