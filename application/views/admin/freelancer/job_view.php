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
          <div class="dashboard-content-wrapper">
            <!-- Breadcrumb -->
            <?php include APPPATH.'views/admin/include/breadcrumb.php'; ?>

            <div class="dashboard-applied mb-5">
              <div class="dashboard-section">
                    <div class="card card-shadow mb-5">
                        <div class="card-body p-3">
                            <div class="dashboard-applied">
                                <div class="dashboard-apply-area">
                                    <div class="title-and-info">
                                        <div class="title col-md-10">
                                          <div class="thumb">
                                            <img src="<?php echo $job['thumb']; ?>" class="img-fluid" alt="">
                                          </div>
                                          <div class="title-body">
                                            <h5><?php echo $job['title']; ?></h5>
                                            <div class="info">
                                                <span class="company"><a href="#" class="cursor-default"><i data-feather="briefcase"></i><?php echo $job['company_name']; ?></a></span>
                                                <?php if($job['location']){ ?><span class="office-location"><a href="#" class="cursor-default"><i data-feather="map-pin"></i><?php echo $job['location']; ?></a></span><?php } ?>
                                            </div>
                                            <p>Posted <?php echo $job['post_date']; ?></p>
                                          </div>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <span class="button-default small-sm bg-success text-white cursor-default mb-2 d-block"><i data-feather="award"></i> Awarded</span>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="jy-card card card-shadow mb-5">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" data-toggle="tab" href="#tab-general">Detail</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" data-toggle="tab" href="#tab-freelancer">Freelancer</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tab-general">
                                <div class="card-body p-5">
                                    <div class="manage-job-container table-responsive" style="overflow-x: hidden;">

                                        <p> <?php echo $job['description']; ?></p>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;<strong class="theme-default">More than 30 hrs/week</strong>
                                                <p><?php echo html_escape($job['pay_type']); ?></p>
                                            </div>
                                            <div class="col-4"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<strong class="theme-default"><?php echo $job['job_duration']; ?></strong>
                                                <p>Project Length</p>
                                            </div>
                                            <div class="col-4"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<strong class="theme-default">Intermediate</strong>
                                                <p>I am looking for a mix of experience and value</p>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-12"><strong class="theme-default">Skills</strong>
                                                <br>
                                                <div class="skill-and-profile details-section dashboard-section p-0">
                                                    <div class="skill">
                                                        <div class="skills-section" style=" padding-bottom: 20px;border-bottom: 20px;">
                                                            <?php if($job['job_skills']) { ?>
                                                                <?php foreach($job['job_skills'] as $job_skill) { ?>
                                                                    <a href="javascript:void(0)" class="mb-2 cursor-default light-gray-color"><?php echo html_escape($job_skill); ?></a>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <span> No skills</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6"><strong class="theme-default">Preferred qualifications</strong>
                                                <br>
                                                <ul class="list-unstyled">
                                                    <li class="light-gray-color">Language:
                                                        <ul>
                                                            <?php if($job['languages']) { ?>
                                                                <?php foreach($job['languages'] as $job_language) { ?>
                                                                    <li><?php echo $job_language; ?></li>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <li> No </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                                    <li class="light-gray-color">Location: <?php echo $job['location'] ? html_escape($job['location']) : ' No '; ?></li>
                                                </ul>
                                            </div>
                                            <div class="col-5"><strong class="theme-default">Activity on this job</strong>
                                                <br>
                                                <ul class="list-unstyled">
                                                    <li class="light-gray-color">Project Post Date: <?php echo $job['post_date']; ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-freelancer">
                                <div class="card-body p-5">
                                    <div id="candidates-tbody">
                                        <div class="candidates-list" data-timeline-loader="true"></div>
                                        <div class="candidates-list" data-timeline-loader="true"></div>
                                        <div class="candidates-list" data-timeline-loader="true"></div>
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
        var href_loadAwardedFreelancers = $base_url + 'admin/freelancer/job/accepted/' + job_id;
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
                                            '<img src="'+job.freelancer_image +'" class="img-fluid" />' +
                                        '</div>' +
                                        '<div class="p-4">' +
                                            '<h5><a class="primary-color" href="'+ job.view +'" title="'+job.freelancer_name +'">'+job.freelancer_name +'</a></h5>' +
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
                    loadJobsView(element, res.freelancers);
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
        loadJobs(candidates_tbody, href_loadAwardedFreelancers);
    });
</script>
