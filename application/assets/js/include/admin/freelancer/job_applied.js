$(function(){
    var href_loadAppliedJobs = formUrl('admin/freelancer/job/getAppliedJobs', {freelancer_id:freelancer_id});
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
                    jSkills += '<a class="mr-2 p-2 badge badge-secondary font-500 text-white"> <span class="">'+ skill+'</span> </a>';
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
                    job_actions = '<a href="'+ job.remove_applied +'" class="button-default small-sm danger-bg white-text btn-remove-applied"><i data-feather="x-circle"></i> Remove</a>';
                }

                if(job.is_accepted == 1){
                    job_actions = '<button class="button-default small-sm success-bg white-text cursor-default"><i data-feather="user-check"></i> Accepted</button>';
                }

                let job_description = '<div class="d-block short--view" id="pj'+ jkey +'">' +
                    '<p class="m-0 ">'+ job.bid_proposal +' </p>' +
                '</div>';

                elementBlock.append('<div class="job-items">' +
                    '<div class="col-12">' +
                        '<div class="row">' +
                            '<div class="col-12 pt-5">' +
                                '<div class="d-flex">' +
                                    '<div class="user-info d-block w-100">' +
                                        '<div class="row mb-4">' +
                                            '<div class="col-md-8">' +
                                                '<h5 class="font-500"><a href="'+ job.view_job +'" class="title-h5">'+ job.title +' </a></h5>' +
                                            '</div>' +
                                            '<div class="col-md-4 text-right">' +
                                                job_actions +
                                            '</div>' +
                                        '</div>' +

                                        '<div class="info info-content">' +
                                            '<div class="row">' +
                                                '<div class="col-12">' +
                                                    '<p class=""><strong class="theme-default"><span>Bid Amount: '+ job.bid_amount +'</span></strong> Job posted '+ job.post_date +'.</p>' +
                                                    job_description +
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
                            '<div class="col-12 mt-4">' +
                                '<div class="bottom-info">' +
                                    '<span class="mr-4">' +
                                        '<i class="fas fa-check-circle "></i> '+
                                        '<strong class="theme-default" class="">Payment verified</strong>'+
                                    '</span>' +
                                    job_location +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<hr>');
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
            elementBlock.append('<div class="job-items">' +
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
             $.ALERT.show('danger', res.message);
          } else {
            $.ALERT.show('danger', 'No Data');
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

});
