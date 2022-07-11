$(function(){

    $('#btn-job-details').click(function(e){
        e.preventDefault();
        $('#job-details-modal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    });


    //Load Jobs Section
    var page = 1;

    $.extend({
        loadJobs: function(href){
            $.ajax({
                url: href ,
                type: 'post',
                dataType: 'json',
                beforeSend: function(){
                  candidates_content_area.append('<div class="jy-content-loader"></div>');
                  candidates_card_body.find('.candidates-list').attr('data-timeline-loader', 'true');
                  // Load Timeline Loader
                  $.TIMELINE.loader();
                },
                success: function(res) {
                  if(res.success){
                      page = res.page;
                      $.loadJobsView(res.candidate_jobs, res.pagination);
                  } else if(res.error){
                      $.loadJobsView(res.candidate_jobs, res.pagination);
                  } else {
                    $.ALERT.show('danger', 'No Data');
                  }
                },
                error:function(xhr, ajaxOptions, errorThrown) {
                  console.log(xhr.responseText + ' ' + xhr.statusText);
                },
                complete: function() {
                  $('#candidate-content').find('.jy-content-loader').remove();
                }
            });
        },
        loadJobsView: function(jobs, pagination){
            candidates_card_body.html('');
            if($.isArray(jobs) && jobs.length > 0){
                $.each(jobs, function(jkey,job){
                    var job_status = '';
                    var job_actions = '';
                    var candidate = job.candidate;
                    let status = 0;
                    job_status = job.job_status;

                    //Candidate Interview Completed
                    let complete_status = '';
                    let process_complete = 'complete';
                    let complete_action = '';
                    if(job.isCompleted == 1) {
                        status = 1;
                        complete_status = status ? 'selected' : '';
                        process_complete = 'completed';
                    } else {
                        let complete_url = "<?php echo $job['complete']; ?>";
                        complete_action = '<a class="button button-default d-none" href="'+ complete_url +'" data-srow-id="<?php echo $jkey; ?>"  type="button">Complete</a>';
                    }


                    //Candidate Schedule
                    let schedule_status = '';
                    let process_schedule = 'schedule';
                    let schedule_action = '';
                    if(job.isApplied == 1 && job.isShortlisted == 1){
                        let cstatus;
                        cstatus = (status == 0) ? 1 : 0;
                        schedule_status = cstatus ? 'selected' : '';
                        process_schedule = 'scheduled';
                    } else {
                        let schedule_url = "<?php echo $job['schedule']; ?>";
                        schedule_action = '<a class="button button-default d-none" href="'+ schedule_url +'" data-srow-id="<?php echo $jkey; ?>"  type="button">Schedule</a>';
                    }

                    //Candidate Shortlist
                    let shortlist_status = '';
                    let process_shortlist = 'shortlist';
                    let shortlist_action = '';
                    if(job.isShortlisted == 1){
                        let cstatus;
                        cstatus = (status == 0) ? 1 : 0;
                        shortlist_status = cstatus ? 'selected' : '';
                        process_shortlist = 'shortlisted';
                    } else {
                        let shortlist_url = "<?php echo $job['shortlist']; ?>";
                        shortlist_action = '<a class="button button-default d-none" href="'+ shorlist_url +'" data-srow-id="<?php echo $jkey; ?>"  type="button">Shortlist</a>';
                    }

                    //Candidate Applied
                    let apply_status = '';
                    let process_apply = 'apply';
                    if(job.isApplied== 1){
                        apply_status = status ? 'disabled' : 'selected';
                        process_apply = 'applied';
                    }

                    //Candidate Schedule
                    let schedule_html = '';
                    if(job.isScheduled == 0){
                        if(job.isApplied == 1 && job.isShortlisted == 1){
                            schedule_html = '<div class="modal fade account-entry" id="schedule-box'+ jkey +'">'+
                              '<div class="modal-dialog modal-dialog-centered">'+
                                  '<div class="modal-content">'+
                                      '<div class="modal-header text-left">'+
                                        '<h5 class="modal-title">Schedule Interview -<br>'+
                                        '<p>'+ candidate.name +'</p></h5>'+
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                          '<span aria-hidden="true">×</span>'+
                                        '</button>'+
                                      '</div>'+
                                      '<div class="modal-body text-left">'+
                                        '<form id="scheduleForm'+ jkey +'">'+
                                            '<div class="form-group">'+
                                                  '<label class="control-label mandatory">Schedule Date</label>'+
                                                  '<input type="text" name="schedule_date" class="datepicker form-control" autocomplete="off"/>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                  '<label class="control-label mandatory">Schedule Time</label>'+
                                                  '<input type="text" name="schedule_time" class="timepicker form-control" autocomplete="off" />'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                  '<label class="control-label">Venue Detail:</label>'+
                                                  '<textarea name="schedule_venue" row="5" class="form-control" ></textarea>'+
                                            '</div>'+

                                            '<div class="form-group clearfix">'+
                                                '<button data-dismiss="modal" class="float-md-left button-default small bg-secondary white-text"  type="button">Cancel</button>'+
                                                '<button class="float-md-right button-default small primary-bg white-text candidateScheduleBtn" data-schedule-url="'+ job.schedule +'" data-srow-id="'+ jkey +'"  type="button">Schedule</button>'+
                                            '</div>'+
                                        '</form>'+
                                      '</div>'+
                                  '</div>'+
                              '</div>'+
                            '</div>';
                        }
                    }

                    //Candidate Scheduled Details
                    let complete_html = '';
                    if(job.isScheduled == 1){
                        var job_action_complete = '';

                        //Check job Complete for scheduled details
                        if(job.isCompleted == 1) {
                            job_action_complete = '<div class="form-group">'+
                                '<label class="control-label">Comments: '+ job.schedule_details.schedule_comments +'</label>'+
                            '</div>';
                        } else {
                            job_action_complete = '<form id="scheduledForm'+ jkey +'">'+
                                '<div class="form-group">'+
                                    '<label class="control-label mandatory">Comments:</label>'+
                                    '<textarea class="form-control" name="schedule_comments"></textarea>'+
                                '</div>'+

                                '<div class="form-group clearfix">'+
                                    '<button data-dismiss="modal" class="float-md-left button-default small bg-secondary white-text"  type="button">Cancel</button>'+
                                    '<button class="float-md-right button-default small primary-bg white-text candidateCompleteBtn" data-scheduled-url="'+ job.complete +'" data-csrow-id="'+ jkey +'"  type="button">Complete</button>'+
                                '</div>'+
                            '</form>';
                        }

                        complete_html = '<div class="modal fade account-entry" id="scheduled-box'+ jkey +'">'+
                          '<div class="modal-dialog modal-dialog-centered">'+
                              '<div class="modal-content">'+
                                  '<div class="modal-header text-left">'+
                                    '<h5 class="modal-title">Scheduled Interview Details -<br>'+
                                    '<p>'+ candidate.name +'</p></h5>'+
                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                      '<span aria-hidden="true">×</span>'+
                                    '</button>'+
                                  '</div>'+

                                  '<div class="modal-body text-left">'+
                                    '<div class="form-group">'+
                                          '<label class="control-label">Scheduled Date: '+ job.schedule_details.schedule_date +'</label>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                          '<label class="control-label">Scheduled Time: '+ job.schedule_details.schedule_time +'</label>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                          '<label class="control-label">Venue Detail: '+ job.schedule_details.schedule_venue +'</label>'+
                                    '</div>'+
                                    job_action_complete +
                                  '</div>'+
                              '</div>'+
                          '</div>'+
                      '</div>';
                    }


                    var current_company = current_designation = '';
                    if(candidate.experiences){
                        current_company = candidate.experiences.cwe_company_name;
                        current_designation = candidate.experiences.cwe_job_title;
                    }

                    var education = '';
                    if(candidate.education){
                        education = candidate.education.ce_qualification_name + '-' + candidate.education.ce_specialization + ' - ' + candidate.education.ce_yop;
                        education += '<br>' +candidate.education.ce_institute + ', '+ candidate.education.ce_location;
                    }
                    candidates_card_body.append('<div class="card candidates-list p-0 border mb-5">' +
                            '<div class="card-body py-0">' +
                                '<div class="col-12">' +
                                    '<div class="row">' +
                                        '<div class="col-12 pt-5">' +
                                            '<div class="d-flex">' +
                                                '<div class="select-optionz">' +
                                                    '<input type="checkbox" name="candidate_action[]">' +
                                                '</div>' +
                                                '<div class="user-info">' +
                                                    '<div class="title">' +
                                                        '<div class="thumb d-none">' +
                                                            '<img src="'+ candidate.thumb +'" class="img-fluid rounded-circle" alt="">' +
                                                        '</div>' +
                                                        '<div class="body">' +
                                                            '<h5><a href="'+ candidate.view_resume +'" target="_blank">'+ candidate.name +'</a></h5>' +
                                                        '</div>' +
                                                    '</div>' +
                                                    '<div class="info info-content">' +
                                                        '<p class="desription">'+ candidate.description +'</p>' +
                                                        '<div class="col-12">' +
                                                            '<div class="row">' +
                                                                '<div class="col-md-6 info-inner">' +
                                                                    '<p class="txt-view"><span>Exp.</span> '+ candidate.experience +'</p>' +
                                                                    '<p class="txt-view"><span>Functional Area:</span> '+ candidate.functional_area +'</p>' +
                                                                    '<p class="txt-view"><span>Industry:</span> '+ candidate.industry +'</p>' +
                                                                    '<p class="txt-view"><i data-feather="phone" class="primary-color"></i> '+ candidate.mobile +'</p>' +
                                                                    '<p class="txt-view"><i data-feather="mail" class="primary-color"></i> '+ candidate.email +'</p>' +
                                                                '</div>' +
                                                                '<div class="col-md-6 info-inner">' +
                                                                    '<p class="txt-view"><span>Current Designation:</span> '+ current_designation +'</p>' +
                                                                    '<p class="txt-view"><span>Current Company:</span> '+ current_company +'</p>' +
                                                                    '<p class="txt-view"><span>Current Location:</span>'+ candidate.location +'</p>' +
                                                                    '<p class="txt-view"><span>Pref. Location:</span> '+ job.location +'</p>' +
                                                                    '<p class="txt-view"><span>Education:</span> '+ education +'</p>' +

                                                                '</div>' +
                                                                '<div class="col-12 info-inner">' +
                                                                    '<p class="txt-view"><span>Key Skills:</span> '+ candidate.skills +'</p>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="col-12 mt-4"><p class="txt-view">Applied On: 14 Apr 20 | Active On: 14 Apr 20 | Modified On: 14 Apr 20</p></div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="card-footer alice-bg">' +
                                '<div class="col-12">' +
                                    '<div class="row align-items-center">' +
                                        '<div class="col-md-4">' +
                                            '<div class="rate-content">' +
                                                '<span data-feather="star" class="checked"></span>' +
                                                '<span data-feather="star" class="checked"></span>' +
                                                '<span data-feather="star" class="checked"></span>' +
                                                '<span data-feather="star"></span>' +
                                                '<span data-feather="star"></span>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="col-md-8 text-right">' +
                                            '<div class="row align-items-end">' +
                                                '<label class="col-4">Mark As: </label>' +
                                                '<div class="col-7 p-0">' +
                                                    '<select class="selectpicker select-process">' +
                                                        '<option value="" '+ apply_status +'>Applied</option>' +
                                                        '<option value="'+ process_shortlist +'" '+ shortlist_status +'>Shortlist '+ shortlist_action +'</option>' +
                                                        '<option value="'+ process_schedule +'" '+ schedule_status +'>Schedule Interview '+ schedule_action +'</option>' +
                                                        '<option value="'+ process_complete +'" '+ complete_status +'>Join & Offer '+ complete_action +'</option>' +
                                                    '</select>' +
                                                '</div>' +
                                                '<div class="col-1 p-0">' +
                                                    '<a href="'+ job.remove +'" title="Remove" class="button-default small danger-bg-gradient text-center remove btn-remove"><i data-feather="x-circle"></i></a>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                schedule_html +
                                complete_html +
                            '</div>' +
                        '</div>');
                    candidates_card_body.find('.selectpicker').selectpicker('refresh');
                });

                if(pagination){
                    $('#pagination-block').remove();
                    $('#candidate-content .manage-candidate-container').append('<div id="pagination-block">' +
                        '<div class="pagination-list text-center">' +
                          '<nav class="navigation pagination">' +
                            '<div class="nav-links">' +
                              pagination +
                            '</div>' +
                          '</nav>' +
                      '</div>' +
                    '</div>');
                }
            } else {
                candidates_card_body.append('<div class="card candidates-list p-0 border mb-5">' +
                      '<div class="text-center card-body p-o">' +
                        '<h5 class="my-5">No Candidates Found</h5>' +
                      '</div>' +
                    '</div>');
            }

            feather.replace();
        }
    });


    $.loadJobs(load_jobs_url);    //Load job view


    //Job Action Function
    //Load Job Action Function
    function loadJobAction(href){
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
            $.loadJobs(load_jobs_url + '/' + page);    //Load job view
            /*setTimeout(function(){
                location.reload();
            }, 1500);*/

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


    //selection process change function
    //shortlist
    function loadShortlistAction(current){
      var curl = current.find('a');
      var shortlist_href = curl.attr('href');
      loadJobAction(shortlist_href);
    }

    //Schedule
    function loadScheduleAction(current){
        var curl = current.find('a');
        var surl = curl.attr('href');
        var srow = curl.data('srow-id');
        var scheduleForm = $('#scheduleForm' + srow);

        //Open Modal
        $('#schedule-box-' + srow).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        //Validation
        scheduleForm.validate({
          rules: {
            schedule_date : {
              required: true
            },
            schedule_time: {
              required: true
            },
          },
          messages: {
            schedule_date : {
              required: "Please specify schedule date",
            },
            schedule_time : {
              required: "Please specify schedule time",
            },
          },
          errorElement: "em",
          errorPlacement: function ( error, element ) {
            // Add the `invalid-feedback` class to the error element
            error.addClass( "invalid-feedback" );

            if ( element.prop( "type" ) === "checkbox" || element.prop( "type" ) === "radio" ) {
              element.parents('.ele--jqvalid').append(error);
            } else {
              error.insertAfter( element );
            }
          },
          highlight: function ( element, errorClass, validClass ) {
            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
          },
        });

        if(scheduleForm.valid()){
            $.ajax({
            url: surl ,
            type: 'post',
            data: scheduleForm.serialize(),
            dataType: 'json',
            beforeSend: function(){
              $.FEED.showLoader();
            },
            success: function(res) {
              if(res.success){
                $.ALERT.show('success', res.message);
                $.loadJobs(load_jobs_url + '/' + page);    //Load job view
                /*setTimeout(function(){
                    location.reload();
                }, 1500);*/
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
    }

    //Complete
    function loadCompleteAction(current){
        var curl = current.find('a');
        var surl = curl.attr('href');
        var srow = curl.data('csrow-id');
        var scheduledForm = $('#scheduledForm' + srow);

        //Open Modal
        $('#scheduled-box-' + srow).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        //Validation
        scheduledForm.validate({
          rules: {
            schedule_comments: {
              required: true
            },
          },
          messages: {
            schedule_comments : {
              required: "Please specify comments",
            },
          },
          errorElement: "em",
          errorPlacement: function ( error, element ) {
            // Add the `invalid-feedback` class to the error element
            error.addClass( "invalid-feedback" );

            if ( element.prop( "type" ) === "checkbox" || element.prop( "type" ) === "radio" ) {
              element.parents('.ele--jqvalid').append(error);
            } else {
              error.insertAfter( element );
            }
          },
          highlight: function ( element, errorClass, validClass ) {
            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
          },
        });

        if(scheduledForm.valid()){
            $.ajax({
                url: surl ,
                type: 'post',
                data: scheduledForm.serialize(),
                dataType: 'json',
                beforeSend: function(){
                  $.FEED.showLoader();
                },
                success: function(res) {
                  if(res.success){
                    $.ALERT.show('success', res.message);
                    $.loadJobs(load_jobs_url + '/' + page);    //Load job view
                    /*setTimeout(function(){
                        location.reload();
                    }, 1500);*/
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
    }

    $(document).on('change', '#candidates-card-body .select-process', function(e){
      e.preventDefault();
      var current = $(this);
      var process = current.val();
      switch(process){
        case 'shortlist':
            loadShortlistAction(current);
            break;
        case 'schedule':
            loadScheduleAction(current);
            break;
        case 'complete':
            loadCompleteAction(current);
            break;
        default:
      }
    });



    //Pipeline
    $(document).on('click', '#candidates-card-body .btn-pipeline', function(e){
      e.preventDefault();
      var current = $(this);
      var pipeline_href = $(this).attr('href');
      loadJobAction(pipeline_href);
    });

    //Archive
    $(document).on('click', '#candidates-card-body .btn-archive', function(e){
      e.preventDefault();
      var current = $(this);
      var archive_href = $(this).attr('href');
      loadJobAction(archive_href);
    });

    //Remove
    $(document).on('click', '#candidates-card-body .btn-remove', function(e){
      e.preventDefault();
      var current = $(this);
      var delete_href = $(this).attr('href');

      //Delete Confirm Modal
      $.ALERT.confirm({
          icon: '<i class="fas fa-trash-alt"></i>',
          className: 'danger-alert',
          message: 'Are you sure to delete?',
          buttons: ['Delete', 'Cancel'],
          confirm: {
            delete_callback: function(){
              loadJobAction(delete_href);
            },
            cancel_callback: function(){

            }
          }
      });
    });

});


$(function(){

    //Load Job Filter Section
    var jf_wrapper = $('#job-filter-wrapper');
    var jf_candidate_filter = $('#candidate-filter');
    var jf_skills = $('#job-filter-skills');
    var jf_location = $('#job-filter-location');
    var jf_jobtypes = $('#job-filter-jobtypes');
    var jf_qualifications = $('#job-filter-qualifications');
    var jf_experiences = $('#job-filter-experiences');
    var jf_gender = $('#job-filter-gender');
    var jf_url = '';

    function filter_action(){
         jf_url = '';

         var gender_value = jf_gender.find('input[type=\'checkbox\']:checked').val();
         if(gender_value){
             jf_url += '&filter_gender=' + gender_value;
         }

         var location_value = jf_location.find('input[type=\'checkbox\']:checked').val();
         if(location_value){
             jf_url += '&filter_location=' + location_value;
         }

         var skill_values = jf_skills.find('input[type=\'checkbox\']:checked').map(function(){return $(this).val(); }).get();
         if($.isArray(skill_values) && skill_values.length > 0){
             jf_url += '&filter_skills=' + skill_values.join(',');
         }

         var experience_values = jf_experiences.find('input[type=\'checkbox\']:checked').val();
         if(experience_values){
             jf_url += '&filter_experiences=' + experience_values;
         }

         var jobtype_values = jf_jobtypes.find('input[type=\'checkbox\']:checked').map(function(){return $(this).val(); }).get();
         if($.isArray(jobtype_values) && jobtype_values.length > 0){
             jf_url += '&filter_jobtypes=' + jobtype_values.join(',');
         }

         var qualification_values = jf_qualifications.find('input[type=\'checkbox\']:checked').map(function(){return $(this).val(); }).get();
         if($.isArray(qualification_values) && qualification_values.length > 0){
             jf_url += '&filter_qualifications=' + qualification_values.join(',');
         }

         var cj_status_values = jf_candidate_filter.val();
         if(cj_status_values){
             jf_url += '&filter_cj_status=' + cj_status_values;
         }

         $.loadJobs(load_jobs_url + '?filter=jobs' + jf_url);
    }


    jf_wrapper.find('input[type=\'checkbox\'].clickable, input[type=\'radio\'].clickable').click(function(){
         filter_action();
    });

    //Job Status Filter
    jf_candidate_filter.change(function(e){
        e.preventDefault();
        filter_action();
    });
});

