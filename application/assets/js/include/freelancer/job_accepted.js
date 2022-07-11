$(function(){
    var href_loadAcceptedJobs = $base_url + 'freelancer/job/getAcceptedJobs';
    var jobsAcceptedBlock = $('#myjobs-accepted .jobs-block');

    //LoadJobs
    function loadAcceptedJobsView(elementBlock,jobs){
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
                if(job.is_applied == 1 && job.is_accepted == 0){
                    job_actions = '<a href="'+ job.remove_applied +'" class="ps-btn ps-btn--sm ps-btn--outline white-text btn-remove-applied"><i data-feather="x-circle"></i> Remove</a>';
                }

                if(job.is_accepted == 1){
                    job_actions = '<button class="ps-btn ps-btn--sm white-text" style="cursor: default;"><i data-feather="user-check"></i> Accepted</button>';
                }

                let job_description = '<div class="d-block short--view" id="aj'+ jkey +'">' +
                    '<p class="mb-2 text-justify" style="line-height: 1.85em">'+ job.description +' </p>' +
                '</div>';

                elementBlock.append('<div class="job-items mb-4 ps--shadow p-5">' +
                    '<div class="row">' +
                        '<div class="col-12">' +
                            '<div class="d-flex">' +
                                '<div class="user-info d-block w-100">' +
                                    '<div class="row mb-4">' +
                                        '<div class="col-md-8">' +
                                            '<h5 class="font-500"><a href="'+ job.accepted_job +'" class="title-h5 job--title--text">'+ job.title +' </a></h5>' +
                                            '<p class="mb-0"><strong class="theme-default">'+ job.pay_type +': '+ job.pay_amount + job.experience_level+' - Time: '+ job.job_duration +' - Posted '+ job.post_date +'.</strong></p>' +
                                        '</div>' +
                                        '<div class="col-md-4 text-right">' +
                                            job_actions +
                                        '</div>' +
                                    '</div>' +

                                    '<div class="info info-content mb-4">' +
                                        '<div class="row">' +
                                            '<div class="col-12 mb-2">' +
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

    function loadAcceptedJobs(element, href){
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
                loadAcceptedJobsView(element, res.jobs);
          } else if(res.error){
             //$.ALERT.show('danger', res.message);
             Toast.fire({
                icon: 'danger',
                title: res.message,
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

    loadAcceptedJobs(jobsAcceptedBlock, href_loadAcceptedJobs);

});
