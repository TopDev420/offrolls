  <!-- Menubar -->
  <?php include APPPATH .'views/company/include/menubar.php'; ?>
  <!-- Menubar End -->

  <div class="section-default-header"></div>

    <div class="alice-bg section-padding">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-container">
              <!-- Dashboard Sidebar Start -->
              <?php include APPPATH. 'views/company/include/sidebar.php'; ?>
              <!-- Dashboard Sidebar End -->

              <div class="dashboard-content-wrapper" id="candidate-content">
                <div class="manage-candidate-container">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-left" style="width:80%;">Candidate</th>
                        <th class="action" style="width:20%;">Action</th>
                      </tr>
                    </thead>
                    <tbody id="candidates-tbody">
                        <tr class="candidates-list">
                          <td class="text-center" data-timeline-loader="true" colspan="4"></td>
                          <td class="text-center" data-timeline-loader="true" colspan="4"></td>
                        </tr>
                    </tbody>
                  </table>
                  <div id="pagination-block"></div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Call to Action -->
    <?php include APPPATH. 'views/include/module_actions.php'; ?>
    <!-- Call to Action End -->

   <script>
      $(function(){
         var page = 1;
         var load_jobs_url = '<?php echo $loadjobs; ?>';

        function loadJobsView(jobs, pagination){
            $('#candidates-tbody').html('');
            if($.isArray(jobs) && jobs.length > 0){
                $.each(jobs, function(jkey,job){
                    var job_actions = '';

                    /*if(job.isShortlisted == 0){
                        job_actions += '<a class="btn-shortlist" title="Shortlist Candidate" href="'+ job.shortlist +'"><i data-feather="plus-circle"></i></a>';
                    }*/

                    if(job.resume != ''){
                        job_actions += '<a href="'+ job.resume +'" title="Download Resume" class="download"><i data-feather="download" download ></i></a>';
                    }

                    if(job.isRemoved == 0){
                        job_actions += '<a href="'+ job.remove +'" title="Remove" class="remove btn-remove"><i data-feather="trash-2"></i></a>';
                    }

                    $('#candidates-tbody').append('<tr class="candidates-list">' +
                    '<td class="title text-left">' +
                      '<div class="thumb">' +
                        '<img src="'+ job.thumb +'" class="img-fluid" alt="">' +
                      '</div>' +
                      '<div class="body">' +
                        '<h5><a href="#">'+ job.candidate_name +'</a></h5>' +
                        '<div class="info">' +
                          '<span class="designation"><i data-feather="check-square"></i>'+ job.title +'</span>' +
                          '<span class="location"><i data-feather="map-pin"></i>'+ job.location +'</span>' +
                        '</div>' +
                      '</div>' +
                    '</td>' +
                    '<td class="action text-center">' +
                        job_actions +
                    '</td>' +
                  '</tr>');

                });

                if(pagination){
                    $('#pagination-block').html('<div class="pagination-list text-center">' +
                      '<nav class="navigation pagination">' +
                        '<div class="nav-links">' +
                          pagination +
                        '</div>' +
                      '</nav>' +
                    '</div>');
                }
            } else {
                $('#candidates-tbody').append('<tr class="candidates-list">'+
                  '<td class="text-center" colspan="4">'+
                    '<h5 >No Candidates Found</h5>'+
                  '</td>'+
                '</tr>');
            }

            feather.replace();
        }

        function loadJobs(href){
          $.ajax({
            url: href ,
            type: 'post',
            dataType: 'json',
            beforeSend: function(){
              $('#candidate-content').append('<div class="jy-content-loader"></div>');
              $('#candidates-tbody tr.candidates-list td').attr('data-timeline-loader', 'true');
              // Load Timeline Loader
              $.TIMELINE.loader();
            },
            success: function(res) {
              if(res.success){
                  page = res.page;
                  loadJobsView(res.jobs, res.pagination);
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
              $('#candidate-content').find('.jy-content-loader').remove();
            }
          });
        }

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
                loadJobs(load_jobs_url + '/' + page);

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

        $(document).on('click', '#candidates-tbody .btn-remove', function(e){
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


        //Get applied jobs
        loadJobs(load_jobs_url);
      });
    </script>
