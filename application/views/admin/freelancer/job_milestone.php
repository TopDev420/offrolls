    <!-- Menubar Top Start -->
    <?php include APPPATH.'views/admin/include/menubar_top.php'; ?>
    <!-- Menubar Top End -->

    <style>
        #milestones-tbody .view--block {
            display: block;
            overflow: hidden;
        }

        #milestones-tbody .view--block.less {
            height: 5rem;
        }

        #milestones-tbody .view--block.more {
            height: 100%;
        }

    </style>

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

                    <div class="row no-gliters">
                      <div class="col-12">
                        <div class="company-details mb-5 border">
                          <div class="title-and-info border-0 p-0">
                            <div class="title">
                              <div class="title-body">
                                <h5><a id="btn-job-details" href="javascript:void(0)"><?php echo $job['title']; ?></a></h5>
                                <div class="info">
                                  <span class="company-type"><i data-feather="briefcase"></i><?php echo $job['job_duration']; ?></span>
                                  <?php if($job['location']){ ?><span class="office-location"><i data-feather="map-pin"></i><?php echo $job['location']; ?></span><?php } ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="dashboard-container" style="box-shadow: none !important;">
                              <div class="w-100">
                                <div class="dashboard-applied">
                                    <!--<h4 class="apply-title"><?php echo $heading_title; ?></h4>-->
                                    <div class="dashboard-apply-area">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="title-and-info bg-white card-shadow border">
                                                    <div class="col p-4">
                                                        <div class="mb-4 py-2 clearfix" style="border-bottom:1px solid #ebebeb;">
                                                            <h5 class="d-inline-block">Freelancer</h5>
                                                        </div>
                                                        <div class="title mb-4">
                                                          <div class="thumb">
                                                            <img src="<?php echo $job['thumb']; ?>" class="img-fluid" alt="">
                                                          </div>
                                                          <div class="title-body">
                                                            <div class="info">
                                                                <span class="company"><i data-feather="briefcase"></i><?php echo $job['freelancer_name']; ?></span><br>
                                                                <span class="office-location"><i data-feather="map-pin"></i><?php echo $job['location']; ?></span>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span class="company"><b>Bid Amount:</b> <?php echo $job['bid_amount']; ?></span><br>
                                                            <span class="company"><b>Job Duration:</b> <?php echo $job['job_duration']; ?></span>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span class="button-default small bg-success white-text mb-4">Accepted</span>
                                                            <a href="javascript:void(0)" class="button-default small primary-color">Profile <i data-feather="external-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="padding-top-60 padding-bottom-60 white-bg card-shadow border">
                                                    <div class="card p-5">
                                                        <div class="card-header clearfix mb-4">
                                                            <h5 class="card-title d-md-inline-block">Milestone</h5>
                                                        </div>
                                                        <div class="card-body table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:20%">Date</th>
                                                                        <th style="width:40%">Description</th>
                                                                        <th style="width:15%">Status</th>
                                                                        <th style="width:15%">Amount</th>
                                                                        <th style="width:10%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="milestones-tbody">
                                                                    <?php foreach($milestones as $milestone){ ?>
                                                                        <tr class="ms--row">
                                                                            <td><?php echo $milestone['date_added']; ?></td>
                                                                            <td>
                                                                                <span class="view--block less"><?php echo html_entity_decode($milestone['description']); ?></span>
                                                                                <a href="javascript:void(0)" class="btn-view-more primary-color"> More</a>
                                                                            </td>
                                                                            <td><?php echo $milestone['status']; ?></td>
                                                                            <td><?php echo $milestone['amount']; ?></td>
                                                                            <td class="text-center">
                                                                            <?php if($milestone['is_completed'] == 0){ ?>
                                                                                <?php if($milestone['initiator'] == false){  ?>
                                                                                    <a href="<?php echo $milestone['accept']; ?>" class="button-default small-sm primary-bg white-text btn-accept-milestone" title="Accept Milestone"><i data-feather="check-circle"></i> Accept</a>
                                                                                    <a href="<?php echo $milestone['reject']; ?>" title="Reject Milestone" class="button-default small-sm danger-bg white-text  btn-reject-milestone"><i data-feather="x-circle"></i> Reject</a>
                                                                                <?php } else { ?>
                                                                                    <?php if($milestone['is_approved'] == 1){ ?>
                                                                                        <a href="<?php echo $milestone['change_status']; ?>" class="edit btn-change-milestone-status btn btn-outline-primary" title="Edit"><i data-feather="edit"></i></a>
                                                                                        <a href="<?php echo $milestone['complete']; ?>" class="btn-complete-milestone btn btn-outline-success" title="Complete"><i data-feather="slack"></i></a>
                                                                                    <?php } else { ?>
                                                                                        <?php if($milestone['is_accepted'] == 1 || $milestone['is_rejected'] == 1){ ?>
                                                                                            <?php if($milestone['is_rejected'] == 1){ ?>
                                                                                                <button class="button-default small-sm danger-bg white-text"><i data-feather="x-square"></i> Rejected</a>
                                                                                            <?php } ?>
                                                                                        <?php } else { ?>
                                                                                            <span class="mr-2 text-warning">Waiting For Acknowledgement</span>
                                                                                            <a href="<?php echo $milestone['edit']; ?>" class="edit btn-edit-milestone btn btn-outline-primary" title="Edit"><i data-feather="edit"></i></a>
                                                                                        <?php } ?>

                                                                                        <?php if($milestone['initiator'] == true){  ?>
                                                                                            <a href="<?php echo $milestone['delete']; ?>" class="btn-delete-milestone btn btn-outline-danger" title="Delete"><i data-feather="trash-2"></i></a>
                                                                                        <?php } ?>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <?php if($milestone['is_closed']){ ?>
                                                                                    <p class="text-center info-text">Milestone Closed</p>
                                                                                <?php } else { ?>
                                                                                    <?php if($milestone['is_payReleased']){ ?>
                                                                                        <p class="text-center info-text">Payment Released</p>
                                                                                    <?php } else { ?>
                                                                                        <a href="<?php echo $milestone['pay']; ?>" title="Pay Milestone Amount" class="btn-milestone-pay btn btn-outline-info"><i data-feather="credit-card"></i></a>
                                                                                    <?php } ?>

                                                                                    <a href="<?php echo $milestone['close']; ?>" title="Close Milestone" class="btn-close-milestone btn btn-outline-info"><i data-feather="stop-circle"></i></a>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
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
    </div>

    <!-- Add Milestone Modal -->
    <div class="modal" id="add-milestone-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="py-4">Add Milestone</h5>
                </div>
                <div class="modal-body access-form">
                    <form method="post" id="formAddMilestone">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mandatory">Duration</label>
                                    <input type="text" name="ms_duration" class="form-control edit-duration" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mandatory">Amount</label>
                                    <input type="text" name="ms_amount" class="form-control edit-amount" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label mandatory">Description</label>
                            <textarea row="5" name="ms_description" id="description--editor" class="form-control edit-description"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Requirements</label>
                            <textarea row="5" name="ms_requirements" id="requirements--editor" class="form-control edit-requirements"></textarea>
                        </div>

                        <div class="form-group text-right">
                            <a href="javascript:void(0)" class="button-default small mr-2 alice-bg close_" data-dismiss="modal">Close</a>
                            <button class="button-default small primary-bg white-text">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Milestone Modal -->
    <div class="modal" id="edit-milestone-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="py-4">Edit Milestone</h5>
                </div>
                <div class="modal-body access-form">
                    <form method="post" id="formEditMilestone">
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea row="5" name="ms_description" id="description--editor1" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Amount</label>
                            <input type="text" name="ms_amount" class="form-control edit-amount" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Duration</label>
                            <input type="text" name="ms_duration" class="form-control edit-duration" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Requirements</label>
                            <textarea row="5" id="requirements--editor1" name="ms_requirements" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <?php if($statuses){ ?>
                                <select class="selectpicker edit-status" name="ms_status">
                                <?php foreach($statuses as $status){ ?>
                                    <option value="<?php echo $status['id']; ?>"><?php echo $status['name']; ?></option>
                                <?php } ?>
                                </select>
                            <?php } ?>
                        </div>
                        <div class="form-group text-right">
                            <a href="javascript:void(0)" class="button-default small mr-2 alice-bg close_" data-dismiss="modal">Close</a>
                            <button class="button-default small primary-bg white-text">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Milestone Price Breakup Modal -->
    <div class="modal" id="milestone-pay-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="py-2">Milestone Payment</h5>
                    <button class="close" data-dismiss="modal"><i data-feather="x"></i></button>
                </div>
                <div class="modal-body access-form">
                    <form method="post" id="formMilestonePay">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="mb-5">Milestone Payments protect both you and the freelancer you work with. We secure your payments, and you only release them to your freelancer once you are 100% satisfied with their work.</p>
                                        <div class="d-block ">
                                            <h6 class="mb-2">Project milestone <span class="milestone-price">---</span></h6>
                                            <p>Milestone Payments are refundable subject to our <a href="javascript:void(0)">Terms and Conditions</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th><strong class="theme-default">Item</strong></th>
                                                    <th><strong class="theme-default">Amount</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody class="price-bp-tbody">
                                                <tr>
                                                    <td><strong class="theme-default">Milestone</strong></td>
                                                    <td class="price">---</td>
                                                </tr>
                                                <tr>
                                                    <td><strong class="theme-default">Service Fees</strong></td>
                                                    <td class="service-fee">---</td>
                                                </tr>
                                                <tr>
                                                    <td><strong class="theme-default">Total</strong></td>
                                                    <td class="total">---</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer border-0 no-bg">
                                <div class="form-group text-right m-0">
                                    <a href="javascript:void(0)" class="button-default small mr-2 alice-bg close_" data-dismiss="modal">Close</a>
                                    <button type="submit" class="button-default small primary-bg white-text">Pay</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var job_id = '<?php echo $job["job_id"]; ?>';
        var freelancer_job_id = '<?php echo $job["freelancer_job_id"]; ?>';

      $(function(){
        var elementBlock = $('#milestones-tbody');
        var formAddMilestone = $('#formAddMilestone');
        //init summernote editor
        initSummerNote(['#requirements--editor', '#description--editor']);

        elementBlock.find('.view--block').showMore({
            minheight: 80,
            buttontxtmore: '...more',
            buttontxtless: '...less',
            animationspeed: 250
        });

        function job_action(form, href){
              $.ajax({
                url: href,
                type: 'post',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function(){
                  $.FEED.showLoader();
                },
                success: function(res) {
                  if(res.success){
                    $('.modal').modal('hide');
                    form[0].reset();
                    $.ALERT.show('success', res.message);
                    setTimeout(function(){location.reload();},1500);
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

        $('#btn-add-milestone').click(function(e){
            e.preventDefault();
            formAddMilestone.attr('action', '<?php echo $add_milestone_action; ?>');
            $('#add-milestone-modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        });

        //Validation Certification
        var formMilestone = formAddMilestone.validate({
            rules: {
              ms_description: {
                required: true,
                minlength: 10
              },
              ms_amount: {
                required: true,
                digits: true
              },
              ms_duration: {
                required: true
              },
              ms_requirements: {
                minlength: 10
              }
            },
            messages: {
              ms_description: {
                  required: "Please enter Description",
                  minlength: "enter atleast 10 characters"
              },
              ms_amount: {
                  required: "Please enter amount",
                  digits: "Amount must be in number"
              },
              ms_requirements: {
                  required: "Please enter Description"
              },
              ms_duration: {
                  minlength: "Enter atleast 10 characters"
              }
            },
            errorElement: "em",
            errorPlacement: function ( error, element ) {
              // Add the `invalid-feedback` class to the error element
              error.addClass( "invalid-feedback" );

              if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.next( "label" ) );
              } else {
                error.insertAfter( element );
              }
            },
            highlight: function ( element, errorClass, validClass ) {
              $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
            },
            unhighlight: function (element, errorClass, validClass) {
              $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
            }
        });

        formAddMilestone.submit(function(e) {
            e.preventDefault();
            var form = formAddMilestone;
            if(formMilestone.valid()) {
                var surl = formAddMilestone.attr('action');
                job_action(form, surl);
            }
        });


        function loadJobAction(href, reload=1){
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
                    if(reload==1){
                        setTimeout(function(){location.reload();},1500);
                    }
                    if(res.redirect){
                        setTimeout(function(){window.location.href = res.redirect;},1500);
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

        $('#formAddMilestone .close_').click(function(){
            formAddMilestone[0].reset();
            formMilestone.resetForm();
            formAddMilestone.find('.selectpicker').selectpicker('refresh');
            formAddMilestone.attr('action', '');
        });

        //Edit Milestone
        $('.btn-edit-milestone').click(function(e){
            e.preventDefault();
            var href= $(this).attr('href');
            var hrefSplits = href.split('/');
            var job_milestone_id = hrefSplits[hrefSplits.length - 1];

            $.ajax({
                url: $base_url + 'company/activity/freelancer_jobmilestone/detail/' + job_milestone_id,
                type: 'post',
                dataType: 'json',
                beforeSend: function(){
                  $.FEED.showLoader();
                },
                success: function(res) {
                  if(res.success){

                    formAddMilestone.find('.edit-amount').val(res.data.amount);
                    formAddMilestone.find('#description--editor').summernote('code', res.data.description);
                    formAddMilestone.find('.edit-duration').val(res.data.duration);
                    formAddMilestone.find('#requirements--editor').summernote('code', res.data.requirements);
                    formAddMilestone.attr('action', href);
                    $('#add-milestone-modal').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
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

        });

        //Change Milestone Status
        var formChangeMilestone = $('#formChangeMilestoneStatus');
        $('.btn-change-milestone-status').click(function(e){
            e.preventDefault();
            var href= $(this).attr('href');
            var hrefSplits = href.split('/');
            var job_milestone_id = hrefSplits[hrefSplits.length - 1];

            $.ajax({
                url: $base_url + 'company/activity/freelancer_jobmilestone/detail/' + job_milestone_id,
                type: 'post',
                dataType: 'json',
                beforeSend: function(){
                  $.FEED.showLoader();
                },
                success: function(res) {
                  if(res.success){
                    formChangeMilestone.attr('action', href);
                    formChangeMilestone.find('.edit-status').val(res.data.status);
                    formChangeMilestone.find('.selectpicker').selectpicker('refresh');

                    $('#change-milestone-status-modal').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
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
        });

        formChangeMilestone.submit(function(e) {
            e.preventDefault();
            var form = formChangeMilestone;
            var surl = formChangeMilestone.attr('action');
            job_action(form, surl);

        });

        $(document).on('click', '#milestones-tbody .btn-milestone-pay', function(e){
            e.preventDefault();
            var formMilestonePay = $('#formMilestonePay');
            formMilestonePay.attr('action', '');
            var action_href = $(this).attr('href');
            $.ajax({
                url: action_href,
                type: 'post',
                dataType: 'json',
                beforeSend: function(){
                  $.FEED.showLoader();
                },
                success: function(res) {
                  if(res.success){
                    $('#milestone-pay-modal').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                    if(res.data){
                        formMilestonePay.attr('action', res.data.pay);
                        formMilestonePay.find('.milestone-price').html(res.data.price);
                        formMilestonePay.find('.price-bp-tbody .price').html(res.data.price);
                        formMilestonePay.find('.price-bp-tbody .service-fee').html(res.data.service_price);
                        formMilestonePay.find('.price-bp-tbody .total').html(res.data.total_price);
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

        });

        //Complete
        $(document).on('click', '#milestones-tbody .btn-complete-milestone', function(e){
            e.preventDefault();
            var current = $(this);
            var complete_href = $(this).attr('href');

            //Delete Confirm Modal
            $.ALERT.confirm({
                icon: '<i class="fas fa-info-circle"></i>',
                className: 'info-alert',
                message: '<span class="d-block mb-2">Are you sure to complete?</span><p>After completion, payment will be initiated to freelancer</p>',
                buttons: ['Complete', 'Cancel'],
                confirm: {
                    complete_callback: function(){
                      loadJobAction(complete_href);
                    },
                    cancel_callback: function(){

                    }
                 }
            });
        });

        //Close
        $(document).on('click', '#milestones-tbody .btn-close-milestone', function(e){
          e.preventDefault();
          var current = $(this);
          var close_href = $(this).attr('href');

          //Delete Confirm Modal
          $.ALERT.confirm({
              icon: '<i class="fas fa-trash-alt"></i>',
              className: 'danger-alert',
              message: 'Are you sure to close?',
              buttons: ['Close', 'Cancel'],
              confirm: {
                close_callback: function(){
                  loadJobAction(close_href);
                },
                cancel_callback: function(){

                }
              }
          });
        });

        //Delete
        $(document).on('click', '#milestones-tbody .btn-delete-milestone', function(e){
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
    </script>

    <!-- Chat Start -->
    <?php include APPPATH . 'views/include/chatbox.php'; ?>
    <!-- Chat End -->

    <script>
        $(function() {

            $('a[data-chatbox=true]').click(function(e){
                e.preventDefault();
                let chat_url = $(this).attr('href');
                loadChatbox(chat_url, {
                    name : '<?php echo $job['freelancer_name']; ?>',
                    thumb : '<?php echo $job['thumb']; ?>',
                    shortCode: 'rtc-cmp' + freelancer_job_id,
                    list: $base_url + 'company/activity/freelancer_chat/listMessages/' + freelancer_job_id + '?js=accepted',
                    action: $base_url + 'company/activity/freelancer_chat/addMessage/' + freelancer_job_id + '?js=accepted',
                    upload: $base_url + 'company/activity/freelancer_chat/uploadMessage/' + freelancer_job_id + '?js=accepted'
                });
            });
        });
    </script>
