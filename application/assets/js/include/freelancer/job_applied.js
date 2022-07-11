$(function(){
    var href_loadAppliedJobs = $base_url + 'freelancer/job/getAppliedJobs';
    var jobsBlock = $('#myjobs-proposals .jobs-block');

    //LoadJobs
    function loadJobsView(elementBlock,jobs){
        elementBlock.html('');
        elementBlock.find('.pagination-list').remove();
        var jobsList = jobs.list;
        if($.isArray(jobsList) && jobsList.length > 0){
            $.each(jobsList, function(jkey,job){
                let jSkills = '';
                $.each(job.skills, function(skey, skill){
                    jSkills += '<span class="ps-tag">'+ skill+'</span>';
                });

                let job_location = '';
                if(job.location){
                    job_location = '<span class="mr-4">' +
                        '<i class="fa fa-map-marker" aria-hidden="true"></i> ' +
                        '<strong class="theme-default">'+ job.location +'<strong>'+
                    '</span>';
                }

                let job_actions = '';
                if(job.is_applied == 1 && job.is_accepted == 0 ){
                    job_actions = '<a href="'+ job.remove_applied +'" class="ps-btn ps-btn--sm ps-btn--outline white-text btn-remove-applied"><i data-feather="x-circle"></i> Remove</a>';
                }

                let job_description = '<div class="d-block short--view" id="pj'+ jkey +'">' +
                    '<p class="mb-2 text-justify" style="line-height: 1.85em">'+ job.bid_proposal +' </p>' +
                '</div>';

                elementBlock.append('<div class="job-items mb-4 ps--shadow p-5">' +
                    '<div class="row">' +
                        '<div class="col-12">' +
                            '<div class="d-flex">' +
                                '<div class="user-info d-block w-100">' +
                                    '<div class="row mb-4">' +
                                        '<div class="col-md-8">' +
                                            '<h5 class="font-500"><a href="'+ job.view_job +'" class="title-h5 job--title--text">'+ job.title +' </a></h5>' +
                                            '<p class="mb-0"><strong class="theme-default">Bid Amount: '+ job.bid_amount +' Job posted '+ job.post_date +'.</strong></p>' +
                                        '</div>' +
                                        '<div class="col-md-4 text-right" id="remove-btn">' +
                                            job_actions +
                                        '</div>' +
                                    '</div>' +

                                    '<div class="info info-content mb-4">' +
                                        '<div class="row">' +
                                            '<div class="col-12">' +
                                          job_description +
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
                        '<div class="col-12">' +
                            '<div class="bottom-info">' +
                                '<span class="mr-4">' +
                                    '<i class="fas fa-check-circle "></i> '+
                                    '<strong class="theme-default" class="">Payment verified</strong>'+
                                '</span>' +
                                job_location +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>');
            });

            if(jobs.pagination){
                elementBlock.append('<div class="pagination-list text-center">' +
                        '<nav class="navigation pagination">' +
                            '<div class="nav-links">'+
                                jobs.pagination +
                            '</div>' +
                    	'</nav>' +
					'</div>');
                elementBlock.find('.pagination a').click(function(e){
                    e.preventDefault();
                    let page_link = $(this).attr('href');
                    loadJobs(jobBlocks, page_link);
                });
            }

        } else {
            elementBlock.append('<div class="job-items ps--shadow p-5">' +
              '<div class="text-center" colspan="4">'+
                '<h5 >No Jobs Found</h5>'+
              '</div>'+
            '</div>');
        }

        feather.replace();
        elementBlock.find('.short--view').showMore({
            minheight: 80,
            buttontxtmore: '...more',
            buttontxtless: '...less',
            animationspeed: 250
        });

    }

    function loadJobs(element, href){
      $.ajax({
        url: href ,
        type: 'post',
        dataType: 'json',
        beforeSend: function(){
          element.find('.job-items').attr('data-timeline-loader', 'true');
          // Load Timeline Loader
          $.TIMELINE.loader(element);
        },
        success: function(res) {
          if(res.success){
                loadJobsView(element, res.jobs);
          } else if(res.error){
             //$.ALERT.show('danger', res.message);
             Toast.fire({
                icon: 'danger',
                title: res.message,
                timer: false
            });
          } else {
            //$.ALERT.show('danger', 'No Data');
            Toast.fire({
                icon: 'danger',
                title: 'No Data',
                timer: false
            });
          }
        },
        error:function(xhr, ajaxOptions, errorThrown) {
          console.log(xhr.responseText + ' ' + xhr.statusText);
        },
        complete: function() {
          element.find('.job-items').attr('data-timeline-loader', 'false');
        }
      });
    }

    loadJobs(jobsBlock, href_loadAppliedJobs);


    $(document).on('click', '#remove-btn .btn-remove-applied', function(e) {
        e.preventDefault();
        var current = $(this);
        var remove_project = $(this).attr('href');


        Swal.fire({
          title: 'Are you sure to remove?',
          showConfirmButton: true,
          confirmButtonText: 'Remove',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
        }).then(function(result) {
          if (result.isConfirmed) {
            loadJobAction(remove_project);
          }
        });
      });

      function loadJobAction(href, reload = 1) {
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
              if (reload == 1) {
                setTimeout(function() {
                  location.reload();
                }, 1500);
              }
              if (res.redirect) {
                setTimeout(function() {
                  window.location.href = res.redirect;
                }, 1500);
              }
            } else if (res.error) {
              //$.ALERT.show('danger', res.message);
              Toast.fire({
                icon: 'error',
                title: res.message
              });
            } else {
              //$.ALERT.show('danger', 'No Data');
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

});
