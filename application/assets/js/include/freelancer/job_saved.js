$(function(){
    var href_loadSavedJobs = $base_url + 'freelancer/job/getSavedJobs';
    var jobsSavedBlock = $('#myjobs-saved .jobs-block');

    //LoadJobs
    function loadSavedJobsView(elementBlock,jobs){
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


                elementBlock.append('<div class="job-items mb-4 ps--shadow p-5">' +
                    '<div class="row">' +
                        '<div class="col-12">' +
                            '<div class="d-flex">' +
                                '<div class="user-info d-block w-100">' +
                                    '<div class="row mb-4">' +
                                        '<div class="col-md-8">' +
                                            '<h5 class="font-500"><a href="'+ job.view_job +'" class="title-h5">'+ job.title +' </a></h5>' +
                                            '<p class=""><strong class="theme-default"><span>'+ job.pay_type +': '+ job.pay_amount +'</span></strong>-'+ job.experience_level+'. Time: '+ job.job_duration +', '+ job.post_date +'.</p>' +
                                        '</div>' +
                                        '<div class="col-md-4 text-right" id="remove-btn">' +
                                        '<a href="'+ job.remove_bookmarked +'" class="ps-btn ps-btn--sm ps-btn--outline white-text btn-remove-bookmarked"><i data-feather="x-circle"></i> Remove</a>' +
                                        '</div>' +
                                    '</div>' +

                                    '<div class="info info-content">' +
                                        '<div class="row">' +
                                            '<div class="col-12 mb-2">' +
                                              '<div class="d-block short--view">' +
                                                 '<p class="mb-2 text-justify" style="line-height: 1.85em">'+ job.description +' </p>' +
                                              '</div>' +
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

            $('.short--view').showMore({
                minheight: 80,
                buttontxtmore: '...more',
                buttontxtless: '...less',
                animationspeed: 250
            });

        } else {
            elementBlock.append('<div class="job-items ps--shadow p-5">' +
              '<div class="text-center" colspan="4">'+
                '<h5 >No Jobs Found</h5>'+
              '</div>'+
            '</div>');
        }

        feather.replace();
    }

    function loadSavedJobs(element, href){
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
                loadSavedJobsView(element, res.jobs);
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

    loadSavedJobs(jobsSavedBlock, href_loadSavedJobs);

    $(document).on('click', '#remove-btn .btn-remove-bookmarked', function(e) {
        e.preventDefault();
        var current = $(this);
        var remove_bookmarked = $(this).attr('href');


        Swal.fire({
          title: 'Are you sure to remove?',
          showConfirmButton: true,
          confirmButtonText: 'Remove',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
        }).then(function(result) {
          if (result.isConfirmed) {
            loadJobAction(remove_bookmarked);
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
