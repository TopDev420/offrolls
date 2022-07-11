    <!-- Menubar -->
  <style type="text/css">
    .jy-card .nav-tabs .nav-item.show .nav-link, .jy-card .nav-tabs .nav-link.active {
    background-color: #2C8A7E !important;
    border-color: #2C8A7E !important;
    color: white !important;
    }
    .jy-card .nav-tabs .nav-link {
      background-color: #EAEAEA;
    }
  </style>
    <?php include APPPATH. 'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->

    <div class="section-default-header"></div>

    <!-- Breadcrumb -->
    <div class="alice-bg pt-5">
        <div class="container">
            <div class="row">
              <!-- <div class="col-md-6">
                <div class="breadcrumb-area">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <?php if($breadcrumb){ ?>
                        <?php foreach ($breadcrumb as $key => $value) { ?>
                          <li class="breadcrumb-item"><a href="<?php echo $value['href']; ?>"><?php echo $value['name']; ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    </ol>
                  </nav>
                </div>
              </div> -->
             <!--  <div class="col-md-6 text-right">
                <a href="<?php echo base_url().'company/jobs/candidate/post/add'; ?>" class="button-default small primary-bg white-text" title="Post a Job"><i class="fas fa-plus"></i> Post Job</a>
              </div> -->
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="alice-bg py-5">
        <div class="container no-gliters">
            <div class="row no-gliters">
                <div class="col-12">
                    <!-- Company Details -->
                    <div class="section-padding-bottom">
                        <div class="">
                            <div class="row">
                                <div class="col-md-3 order-md-1">
                                    <?php $user = isset($user) ? $user : ''; ?>
                                    <?php if($user){ ?>
                                    <div class="jy-card text-center card card-body py-5 card-shadow mb-4" style="background-color: #EAEAEA;">
                                       <div class="box">
                                          <div class="img">
                                             <img src="<?php echo $user['thumb']; ?>" class="img-fluid">
                                          </div>
                                          <h2 style="font-weight: bold; color: #727D90;"><?php echo $user['name']; ?><br><br/><span>Director</span></h2>
                                          <p style="color: #727D90;"><?php echo $user['email']; ?></p>
                                          <span>
                                          <a class="button-deault small" href="<?php echo $profile_link; ?>">View Profile</a>
                                          </span>
                                       </div>
                                    </div>
                                    <?php } ?>
                               </div>
                                <div class="col-md-9 order-md-2">
                                    <div class="jy-card card mb-5 card-shadow">
                                        <div class="card-header p-0" style="background-color: white;">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                  <a class="nav-link active" data-toggle="tab" href="#published-jobs">Jobs</a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" data-toggle="tab" href="#drafted-jobs">Draft</a>
                                                </li>
                                                <li class="text-right">
                                                  <a href="<?php echo base_url().'company/jobs/candidate/post/add'; ?>" class="button-default small white-text" title="Post a Job" style="margin-top: 10px; background-color: #2E57A1; margin-left: 430px;">POST A JOB</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="published-jobs">
                                                <div class="card-body" style="background-image: linear-gradient(to right, #328D81 , #3460A0); padding: 5px !important;">
                                                </div>
                                                <div class="card-body p-5" style="background-color: #EAEAEA;">
                                                    <div class="manage-job-container table-responsive">
                                                       <table class="table">
                                                          <thead>
                                                             <tr>
                                                                <th class="text-left" style="width:55%">Job Title</th>
                                                                <th style="width:15%">Applications</th>
                                                                <th style="width:15%">Posted on</th>
                                                                <th class="text-right" style="width:15%">Action</th>
                                                             </tr>
                                                          </thead>
                                                          <tbody id="candidates-tbody">
                                                             <tr class="job-items">
                                                                <td class="title text-left" data-timeline-loader="true"></td>
                                                                <td class="application" data-timeline-loader="true"></td>
                                                                <td class="deadline" data-timeline-loader="true"></td>
                                                                <td class="action" data-timeline-loader="true"></td>
                                                             </tr>
                                                          </tbody>
                                                       </table>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="drafted-jobs">
                                                <div class="card-body" style="background-image: linear-gradient(to right, #328D81 , #3460A0); padding: 5px !important;">
                                                </div>
                                                <div class="card-body p-5" style="background-color: #EAEAEA;">
                                                    <div class="manage-job-container table-responsive">
                                                       <table class="table">
                                                          <thead>
                                                             <tr>
                                                                <th class="text-left" style="width:55%">Job Title</th>
                                                                <th style="width:15%">Applications</th>
                                                                <th style="width:15%">Posted on</th>
                                                                <th class="text-right" style="width:15%">Action</th>
                                                             </tr>
                                                          </thead>
                                                          <tbody id="candidates-tbody1">
                                                             <tr class="job-items">
                                                                <td class="title text-left" data-timeline-loader="true"></td>
                                                                <td class="application" data-timeline-loader="true"></td>
                                                                <td class="deadline" data-timeline-loader="true"></td>
                                                                <td class="action" data-timeline-loader="true"></td>
                                                             </tr>
                                                          </tbody>
                                                       </table>
                                                    </div>
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
            $(function(){
                $('#btn-job-details').click(function(e){
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
        $(function(){
            //Job Actions
            function loadJobAction(href, current){
              $.ajax({
                url: href ,
                type: 'post',
                dataType: 'json',
                beforeSend: function(){
                  $.FEED.showLoader();
                },
                success: function(res) {
                  if(res.success){
                    $.ALERT.show('success', res.message);
                    setTimeout(function(){
                        location.reload();
                    }, 1000);

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

            $(document).on('click', '#candidates-tbody .btn-remove, #candidates-tbody1 .btn-remove', function(e){
                e.preventDefault();
                var current = $(this);
                var remove_href = $(this).attr('href');
                //Remove Confirm Modal
                $.ALERT.confirm({
                      icon: '<i class="fas fa-times-circle"></i>',
                      className: 'danger-alert',
                      message: 'Are you sure to remove?',
                      buttons: ['Remove', 'Cancel'],
                      confirm: {
                        remove_callback: function(){
                          loadJobAction(remove_href, current);
                        },
                        cancel_callback: function(){

                        }
                      }
                });
            });

        });
    </script>

    <script>
        $(function(){
            var href_loadActiveJobs = '<?php echo $loadActiveJobs; ?>';
            var href_loadInactiveJobs = '<?php echo $loadInactiveJobs; ?>';
            var candidates_tbody = $('#candidates-tbody');
            var candidates_tbody1 = $('#candidates-tbody1');

            //LoadJobs
            function loadJobsView(elementBlock, jobs, type){
                elementBlock.html('');
                var jobsList = jobs.list;
                if($.isArray(jobsList) && jobsList.length > 0){
                    $.each(jobsList, function(jkey,job){
                        var job_actions = '';
                        if(type == 'drafted'){
                            job_actions += '<a data-toggle="tooltip" title="Edit Job" href="'+ job.edit +'" class="edit"><i data-feather="edit"></i></a>';
                        }
                        job_actions += '<a data-toggle="tooltip" title="Remove Job" href="'+ job.remove +'" class="remove btn-remove"><i data-feather="x-circle"></i></a>';

                        elementBlock.append('<tr class="job-items">' +
                                '<td class="title text-left">' +
                                   '<p>'+job.title +'</p>' +
                                '</td>' +
                                '<td class="application">' +
                                    '<a href="'+ job.view +'" title="preview" class="primary-color"> '+ job.total_applied_jobs +'</a>' +
                                '<td class="deadline">'+ job.date_posted +'</td>' +
                                '<td class="action">'+
                                    job_actions +
                                '</td>' +
                            '</tr>');
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

            function loadJobs(element, href, type){
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
                        loadJobsView(element, res.jobs, type);
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


            //Ontab click load Jobs
            $("a[href='\#published-jobs\']").click(function(e){
                if($(this).hasClass('active')){
                    e.preventDefault();
                } else {
                    loadJobs(candidates_tbody, href_loadActiveJobs, 'published');
                }
            });

            $("a[href='\#drafted-jobs\']").click(function(e){
                if($(this).hasClass('active')){
                    e.preventDefault();
                } else {
                    loadJobs(candidates_tbody1, href_loadInactiveJobs, 'drafted');
                }
            });


            //Load Active Jobs
            loadJobs(candidates_tbody, href_loadActiveJobs, 'published');


        });
    </script>
