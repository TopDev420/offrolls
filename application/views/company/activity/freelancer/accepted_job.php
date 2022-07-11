     <!-- Menubar -->
     <?php include APPPATH . 'views/company/include/menubar.php'; ?>
     <!-- Menubar End -->

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

       .alice-bg {
         background-color: white !important;
       }
     </style>

     <div class="section-default-header"></div>

     <div class="ps-page" id="dashboard">
       <?php include APPPATH . 'views/company/include/navbar.php'; ?>

       <div class="ps-dashboard ps-section--sidebar">
         <div class="ps-section__container">
           <div class="ps-section__content mx-5" style="margin-top:2rem;">
             <div class="row mb-5 ps-padrt-md-100">
               <div class="col-md-8">
                 <h4><a id="btn-job-details" href="javascript:void(0)" class="ps-section--heading darkblue--color" style="font-size:32px;"><?php echo $job['title']; ?></a></h4>
                 <p><?php if ($job['location']) { ?><span><?php echo $job['location']; ?></span><?php } ?> | <span><?php echo $job['job_duration']; ?></span></p>
               </div>
               <div class="col-md-4">
                 <div class="float-right mx-2">
                   <button type="button" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow" data-toggle="modal" data-target="#feedbackModal"><i class="mdi mdi-star"></i>&nbsp;&nbsp;Rate&nbsp;&nbsp;<i class="mdi mdi-star"></i></button>
                 </div>
                 <div class="float-right mx-2" id="project-completed">
                   <?php if ($job['isCompleted'] == 0) { ?>
                     <button type="button" data-href="<?php echo $job['completed']; ?>" class="ps-btn ps-btn--sm ps-btn--outline btn--project-completed">Complete Project</button>
                   <?php } else { ?>
                     <button type="button" class="ps-btn ps-btn--sm ps-btn--outline" style="cursor: default;">Project Completed</button>
                   <?php } ?>
                 </div>
               </div>
             </div>
             <div class="my-3 ps-padrt-md-100">
               <h4 class="d-md-inline-block p-2">Milestone</h4>
               <button class="ps-btn ps-btn--sm primary-bg white-text float-right" id="btn-add-milestone">
                 <!-- <i data-feather="plus"></i> --> SET A MILESTONE
               </button>
             </div>
             <div class="table-responsive ps-padrt-md-100">
               <table class="table">
                 <thead class="border thead-light">
                   <tr class="text-center">
                     <th style="width:10%">Date</th>
                     <th style="width:30%">Description</th>
                     <th style="width:10%">Start Date</th>
                     <th style="width:10%">ETA</th>
                     <th style="width:15%">Status</th>
                     <th style="width:10%">Amount</th>
                     <th style="width:15%">Action</th>
                   </tr>
                 </thead>
                 <tbody id="milestones-tbody">
                   <?php if ($milestones) { ?>
                     <?php foreach ($milestones as $milestone) { ?>
                       <tr class="ms--row border mb-2 py-4">
                         <td class="text-center py-3">
                           <?php echo $milestone['date_added']; ?>
                         </td>
                         <td class="py-3">
                           <span class="d-block view--block text-justify"><?php echo html_entity_decode($milestone['description']); ?></span>
                         </td>
                         <td class="text-center py-3"> <?php if ($milestone['is_approved'] == 1) { ?>
                             <span><?php echo date('d M Y', strtotime($milestone['start_date'])); ?></small><br />
                               <!-- <span>Duration: <?php echo $milestone['duration'] . 'Day'; ?></span> -->
                             <?php } ?>
                         </td>
                         <td class="text-center py-3">
                           <?php if ($milestone['is_approved'] == 1) { ?>
                             <?php echo $milestone['end_date']; ?>
                           <?php } ?>
                         </td>
                         <td class="text-center py-3"><?php echo $milestone['status']; ?></td>
                         <td class="text-center py-3"><?php echo $milestone['amount']; ?></td>
                         <td class="text-center py-3">
                           <?php if ($milestone['is_completed'] == 0) { ?>
                             <?php if ($milestone['initiator'] == false) {  ?>
                               <?php if ($milestone['is_accepted'] == 0 && $milestone['is_rejected'] == 0) { ?>
                                 <a href="<?php echo $milestone['accept']; ?>" class="btn btn-outline-primary white-text btn-accept-milestone mb-2" title="Accept Milestone"><i data-feather="check-circle"></i></a>
                                 <a href="<?php echo $milestone['reject']; ?>" title="Reject Milestone" class="btn btn-outline-danger white-text  btn-reject-milestone mb-2"><i data-feather="x-circle"></i></a>
                               <?php } ?>
                               <?php if ($milestone['is_approved'] == 1) { ?>
                                 <!-- <a href="<?php echo $milestone['change_status']; ?>" class="ps-btn ps-btn--sm edit btn-change-milestone-status mb-2" title="Edit"><i class="fas fa-edit"></i> Edit</a> -->
                                 <a href="<?php echo $milestone['complete']; ?>" class="btn-complete-milestone ps-btn ps-btn--sm ps-btn--white ps-btn--shadow mb-2" title="Complete"><i class="fas fa-tasks"></i> Complete</a>
                               <?php } else { ?>
                                 <?php if ($milestone['is_accepted'] == 1 || $milestone['is_rejected'] == 1) { ?>
                                   <?php if ($milestone['is_accepted'] == 1 && $milestone['is_rejected'] == 0) { ?>
                                     <a href="<?php echo $milestone['pay']; ?>" title="Pay Milestone Amount" class="btn-milestone-pay ps-btn ps-btn--sm ps-btn--white ps-btn--shadow mb-2"><i class="fas fa-credit-card"></i> Pay</a>
                                   <?php } ?>

                                   <?php if ($milestone['is_rejected'] == 1) { ?>
                                     <button class="ps-btn ps-btn--sm mb-2" style="cursor: default"><i class="fas fa-times-circle"></i> Rejected</button>
                                   <?php } ?>

                                   <?php if ($milestone['initiator'] == false) {  ?>
                                     <a href="<?php echo $milestone['delete']; ?>" class="btn-delete-milestone ps-btn ps-btn--outline ps-btn--sm mb-2" title="Delete"><i class="fas fa-trash-alt"></i> Delete</a>
                                   <?php } ?>
                                 <?php } ?>
                               <?php } ?>
                             <?php } else { ?>
                               <?php if ($milestone['is_approved'] == 1) { ?>
                                 <!-- <a href="<?php echo $milestone['change_status']; ?>" class="ps-btn ps-btn--sm edit btn-change-milestone-status mb-2" title="Edit"><i class="fas fa-edit"></i> Edit</a> -->
                                 <a href="<?php echo $milestone['complete']; ?>" class="btn-complete-milestone ps-btn ps-btn--sm ps-btn--white ps-btn--shadow mb-2" title="Complete"><i class="fas fa-tasks"></i> Complete</a>
                               <?php } else { ?>
                                 <?php if ($milestone['is_accepted'] == 1 || $milestone['is_rejected'] == 1) { ?>
                                   <?php if ($milestone['is_accepted'] == 1 && $milestone['is_rejected'] == 0) { ?>
                                     <a href="<?php echo $milestone['pay']; ?>" title="Pay Milestone Amount" class="btn-milestone-pay ps-btn ps-btn--sm ps-btn--white ps-btn--shadow mb-2"><i class="fas fa-credit-card"></i> Pay</a>
                                   <?php } ?>

                                   <?php if ($milestone['is_rejected'] == 1) { ?>
                                     <button class="ps-btn ps-btn--sm mb-2" style="cursor: default"><i class="fas fa-times-circle"></i> Rejected</button>
                                   <?php } ?>
                                 <?php } else { ?>
                                   <span class="mr-2 text-warning">Waiting For Acknowledgement</span>
                                   <a href="<?php echo $milestone['edit']; ?>" class="ps-btn ps-btn--sm edit btn-edit-milestone mb-2" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                 <?php } ?>

                                 <?php if ($milestone['initiator'] == true) {  ?>
                                   <a href="<?php echo $milestone['delete']; ?>" class="btn-delete-milestone ps-btn ps-btn--outline ps-btn--sm mb-2" title="Delete"><i class="fas fa-trash-alt"></i> Delete</a>
                                 <?php } ?>
                               <?php } ?>
                             <?php } ?>
                           <?php } else { ?>
                             <?php if ($milestone['is_closed']) { ?>
                               <p class="text-center info-text">Milestone Closed</p>
                             <?php } else { ?>
                               <a href="<?php echo $milestone['close']; ?>" title="Close Milestone" class="btn-close-milestone ps-btn ps-btn--outline ps-btn--sm mb-2"><i class="fas fa-stop-circle"></i> Close</a>
                             <?php } ?>
                           <?php } ?>
                         </td>
                       </tr>
                     <?php } ?>
                   <?php } else { ?>
                     <tr>
                       <td colspan="5" class="text-center py-5">No milestones available!</td>
                     </tr>
                   <?php } ?>
                 </tbody>
               </table>
             </div>
           </div>
           <div class="ps-section__sidebar">
             <aside class="widget widget_profile widget_progress">
               <div class="ps-block--user mb-4">
                 <div class="ps-block__thumbnail"><img class="img-fluid rounded-circle" src="<?php echo $job['thumb']; ?>" alt=""></div>
                 <div class="ps-block__content mb-0">
                   <h4 class="mb-1"><?php echo $job['freelancer_name']; ?></h4>
                   <div class="mb-4">
                     <input type="hidden" class="rating" data-filled="mdi mdi-star font-3 text-primary" data-empty="mdi mdi-star-outline font-2 text-primary" data-fractions="2" data-readonly />
                   </div>
                   <a href="<?php echo base_url() . 'company/activity/freelancer/profile/' . $job['freelancer_id']; ?>">View your profile<i class="fa fa-caret-right"></i></a>
                 </div>
               </div>

               <!-- <h5>Setup your account</h5>
                <div class="ps-progress"><span>65%</span>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width:65%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><a href="#">Add your address ( +5% )</a> -->
             </aside>
             <aside class="widget widget_profile widget_connections">
               <h3 class="widget-title text-center">Bid Amount</h3>
               <div class="widget__content">
                 <div class="text-center">
                   <h4><?php echo $job['bid_amount']; ?></h4>
                 </div>
               </div>
             </aside>
             <aside class="widget widget_profile widget_connections">
               <h3 class="widget-title">Connect with</h3>
               <div class="widget__content">
                 <a href="<?php echo base_url() . 'company/activity/freelancer_chat/start/' . $job['freelancer_job_id'] . '?js=accepted'; ?>" class="ps-btn ps-btn--sm btn-secondary" data-chatbox="true"><i data-feather="message-square"></i> Chat</a>
               </div>
             </aside>
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
                     <label class="control-label mandatory">Duration&nbsp;<small>(in days)</small></label>
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
                 <a href="javascript:void(0)" class="ps-btn ps-btn--sm mr-2 bg-danger close_ secondary-border" data-dismiss="modal">Close</a>
                 <button type="submit" class="ps-btn ps-btn--sm primary-bg white-text">Save</button>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>

     <!-- Change Status Milestone Modal -->
     <div class="modal" id="change-milestone-status-modal">
       <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="py-4">Change Status Milestone</h5>
           </div>
           <div class="modal-body access-form">
             <form method="post" id="formChangeMilestoneStatus">
               <div class="form-group">
                 <label class="control-label">Status</label>
                 <?php if ($statuses) { ?>
                   <select class="selectpicker edit-status" name="ms_status">
                     <?php foreach ($statuses as $status) { ?>
                       <option value="<?php echo $status['id']; ?>"><?php echo $status['name']; ?></option>
                     <?php } ?>
                   </select>
                 <?php } ?>
               </div>
               <div class="form-group text-right">
                 <a href="javascript:void(0)" class="ps-btn ps-btn--sm mr-2 bg-danger close_ secondary-border" data-dismiss="modal">Close</a>
                 <button type="submit" class="ps-btn ps-btn--sm primary-bg white-text">Save</button>
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
                     <a href="javascript:void(0)" class="ps-btn ps-btn--sm mr-2 bg-danger close_" data-dismiss="modal">Close</a>
                     <button type="submit" class="ps-btn ps-btn--sm primary-bg white-text">Pay</button>
                   </div>
                 </div>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>

     <!-- The Modal -->
     <div class="modal" id="feedbackModal">
       <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">

           <!-- Modal Header -->
           <div class="modal-header">
             <h4 class="modal-title">Rating and Feedback</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>

           <!-- Modal body -->
           <div class="modal-body">
             <form id="rating_form">
               <input type="hidden" name="rating_points" value="0" />
               <div class="form-group">
                 <label class="">Rate your experience</label>
                 <div>
                   <input type="hidden" class="rating" data-filled="mdi mdi-star font-3 text-primary" data-empty="mdi mdi-star-outline font-3 text-primary" data-fractions="2" />
                 </div>
               </div>
               <div class="form-group">
                 <label>Share your feedback</label>
                 <textarea class="form-control" name="feedback_content" id="message-text" placeholder="Feedback"></textarea>
               </div>
             </form>
           </div>

           <!-- Modal footer -->
           <div class="modal-footer">
             <button type="button" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow" data-dismiss="modal">Close</button>
             <button type="submit" form="rating_form" class="ps-btn small">Save</button>
           </div>

         </div>
       </div>
     </div>

     <script type="text/javascript" src="<?php echo base_url(); ?>application/assets/js/jquery.show-more.js"></script>
     <script>
       var job_id = '<?php echo $job["job_id"]; ?>';
       var freelancer_job_id = '<?php echo $job["freelancer_job_id"]; ?>';

       $(document).ready(function() {
         const ratingForm = $("#rating_form");
         const feedbackModal = $('#feedbackModal');
         $(".rating").each(function() {
           $('<span class="badge badge-info"></span>').text($(this).val() || "").insertAfter(this)
         });

         $(".rating").on("change", function() {
           $(this).next(".badge").text($(this).val())
           $("#rating_form").find('[name="rating_points"]').val($(this).val());
         });

         function resetModalForm() {
           ratingForm[0].reset();
           feedbackModal.find('.rating').rating('rate', 0).change();
         }

         feedbackModal.find('.close, [data-dismiss="modal"]').click(function() {
           resetModalForm();
         });

         $("#rating_form").submit(function(e) {
           e.preventDefault();
           var formObj = $(this);
           var formData = new FormData(formObj[0]);
           $.executeCall({
               url: formUrl('company/freelancer/rating/add'),
               formParams: {
                 freelancer_job_id: freelancer_job_id,
                 rating_points: formData.get('rating_points'),
                 feedback_content: formData.get('feedback_content')
               }
             })
             .then((res) => {
               if (res.success == true) {
                 Swal.fire({
                   position: 'top-end',
                   html: '<div class="text-success h4">' + res.message + '</div>',
                   allowOutsideClick: false,
                   allowEscapeKey: false,
                   showConfirmButton: false,
                   timer: 4000,
                   timerProgressBar: true
                 }).then(() => {
                   resetModalForm();
                   feedbackModal.modal('hide'); // Hide modal
                 });
               } else if (res.error == true) {
                 Swal.fire({
                   position: 'top-end',
                   html: '<div class="text-danger h4">' + res.message + '</div>',
                   allowOutsideClick: false,
                   allowEscapeKey: false,
                   showConfirmButton: false,
                   timer: 4000,
                   timerProgressBar: true
                 });
               } else {
                 Swal.fire({
                   position: 'top-end',
                   html: '<div class="text-success h4"></div>',
                   allowOutsideClick: false,
                   allowEscapeKey: false,
                   showConfirmButton: false,
                   timer: 4000,
                   timerProgressBar: true
                 });
               }
             })
             .catch((error) => {
               Swal.fire({
                 position: 'top-end',
                 html: '<div class="text-danger h4">' + error.statusText + '</div>',
                 allowOutsideClick: false,
                 allowEscapeKey: false,
                 showConfirmButton: false,
                 timer: 4000,
                 timerProgressBar: true
               });
             });
         });
       });

       $(function() {
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

         function job_action(form, href) {
           $.ajax({
             url: href,
             type: 'post',
             data: form.serialize(),
             dataType: 'json',
             beforeSend: function() {
               $.FEED.showLoader();
             },
             success: function(res) {
               if (res.success) {
                 $('.modal').modal('hide');
                 form[0].reset();
                 //$.ALERT.show('success', res.message);
                 Toast.fire({
                   icon: 'success',
                   title: res.message
                 });
                 setTimeout(function() {
                   location.reload();
                 }, 1500);
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

         $('#btn-add-milestone').click(function(e) {
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
           onkeyup: function(element) {
             $(element).valid();
           },
           onclick: function(element) {
             $(element).valid();
           },
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
               required: true,
               digits: true
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
               digits: "Amount must be numeric"
             },
             ms_requirements: {
               required: "Please enter Description"
             },
             ms_duration: {
               minlength: "Enter atleast 10 characters",
               digits: "Duration must be numeric"
             }
           },
           errorElement: "em",
           errorPlacement: function(error, element) {
             // Add the `invalid-feedback` class to the error element
             error.addClass("invalid-feedback");

             if (element.prop("type") === "checkbox") {
               error.insertAfter(element.next("label"));
             } else {
               error.insertAfter(element);
             }
           },
           highlight: function(element, errorClass, validClass) {
             $(element).addClass("is-invalid").removeClass("is-valid");
           },
           unhighlight: function(element, errorClass, validClass) {
             $(element).addClass("is-valid").removeClass("is-invalid");
           }
         });

         formAddMilestone.submit(function(e) {
           e.preventDefault();
           var form = formAddMilestone;
           if (formMilestone.valid()) {
             var surl = formAddMilestone.attr('action');
             job_action(form, surl);
           }
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

         $('#formAddMilestone .close_').click(function() {
           formAddMilestone[0].reset();
           formMilestone.resetForm();
           formAddMilestone.find('.selectpicker').selectpicker('refresh');
           formAddMilestone.attr('action', '');
         });

         //Edit Milestone
         $('.btn-edit-milestone').click(function(e) {
           e.preventDefault();
           var href = $(this).attr('href');
           var hrefSplits = href.split('/');
           var job_milestone_id = hrefSplits[hrefSplits.length - 1];

           $.ajax({
             url: $base_url + 'company/activity/freelancer_jobmilestone/detail/' + job_milestone_id,
             type: 'post',
             dataType: 'json',
             beforeSend: function() {
               $.FEED.showLoader();
             },
             success: function(res) {
               if (res.success) {

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
               } else if (res.error) {
                 // $.ALERT.show('danger', res.message);
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

         });

         //Change Milestone Status
         var formChangeMilestone = $('#formChangeMilestoneStatus');
         $('.btn-change-milestone-status').click(function(e) {
           e.preventDefault();
           var href = $(this).attr('href');
           var hrefSplits = href.split('/');
           var job_milestone_id = hrefSplits[hrefSplits.length - 1];

           $.ajax({
             url: $base_url + 'company/activity/freelancer_jobmilestone/detail/' + job_milestone_id,
             type: 'post',
             dataType: 'json',
             beforeSend: function() {
               $.FEED.showLoader();
             },
             success: function(res) {
               if (res.success) {
                 formChangeMilestone.attr('action', href);
                 formChangeMilestone.find('.edit-status').val(res.data.status);
                 formChangeMilestone.find('.selectpicker').selectpicker('refresh');

                 $('#change-milestone-status-modal').modal({
                   backdrop: 'static',
                   keyboard: false,
                   show: true
                 });
               } else if (res.error) {
                 // $.ALERT.show('danger', res.message);
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
         });

         formChangeMilestone.submit(function(e) {
           e.preventDefault();
           var form = formChangeMilestone;
           var surl = formChangeMilestone.attr('action');
           job_action(form, surl);

         });

         //Accept Milestone
         $(document).on('click', '#milestones-tbody .btn-accept-milestone', function(e) {
           e.preventDefault();
           let href = $(this).attr('href');
           loadJobAction(href);
         });

         //Reject Milestone
         $(document).on('click', '#milestones-tbody .btn-reject-milestone', function(e) {
           e.preventDefault();
           var current = $(this);
           var reject_href = $(this).attr('href');


           Swal.fire({
             title: 'Are you sure to reject?',
             showConfirmButton: true,
             confirmButtonText: 'Reject',
             showCancelButton: true,
             cancelButtonText: 'Cancel',
           }).then(function(result) {
             if (result.isConfirmed) {
               loadJobAction(reject_href);
             }
           });
         });

         //pay milestone
         $(document).on('click', '#milestones-tbody .btn-milestone-pay', function(e) {
           e.preventDefault();
           var formMilestonePay = $('#formMilestonePay');
           formMilestonePay.attr('action', '');
           var action_href = $(this).attr('href');
           $.ajax({
             url: action_href,
             type: 'post',
             dataType: 'json',
             beforeSend: function() {
               $.FEED.showLoader();
             },
             success: function(res) {
               if (res.success) {
                 $('#milestone-pay-modal').modal({
                   backdrop: 'static',
                   keyboard: false,
                   show: true
                 });
                 if (res.data) {
                   formMilestonePay.attr('action', res.data.pay);
                   formMilestonePay.find('.milestone-price').html(res.data.price);
                   formMilestonePay.find('.price-bp-tbody .price').html(res.data.price);
                   formMilestonePay.find('.price-bp-tbody .service-fee').html(res.data.service_price);
                   formMilestonePay.find('.price-bp-tbody .total').html(res.data.total_price);
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

         });

         //Complete
         $(document).on('click', '#milestones-tbody .btn-complete-milestone', function(e) {
           e.preventDefault();
           var current = $(this);
           var complete_href = $(this).attr('href');

           Swal.fire({
             title: 'Are you sure to complete?',
             text: 'After completion, payment will be initiated to freelancer',
             showConfirmButton: true,
             confirmButtonText: 'Complete',
             showCancelButton: true,
             cancelButtonText: 'Cancel',
           }).then(function(result) {
             if (result.isConfirmed) {
               loadJobAction(complete_href);
             }
           });
         });

         //Project Completed
         $(document).on('click', '#project-completed .btn--project-completed', function(e) {
           e.preventDefault();
           var current = $(this);
           var completed_href = $(this).attr('data-href');

           Swal.fire({
             title: 'By clicking this button you agree to complete the project',
             showConfirmButton: true,
             confirmButtonText: 'Complete',
             showCancelButton: true,
             cancelButtonText: 'Cancel',
           }).then(function(result) {
             if (result.isConfirmed) {
               loadJobAction(completed_href);
             }
           });
         });

         //Close
         $(document).on('click', '#milestones-tbody .btn-close-milestone', function(e) {
           e.preventDefault();
           var current = $(this);
           var close_href = $(this).attr('href');

           Swal.fire({
             title: 'Are you sure to close?',
             showConfirmButton: true,
             confirmButtonText: 'Close',
             showCancelButton: true,
             cancelButtonText: 'Cancel',
           }).then(function(result) {
             if (result.isConfirmed) {
               loadJobAction(close_href);
             }
           });

           //Confirm Modal
           //  $.ALERT.confirm({
           //    icon: '<i class="fas fa-trash-alt"></i>',
           //    className: 'danger-alert',
           //    message: 'Are you sure to close?',
           //    buttons: ['Close', 'Cancel'],
           //    confirm: {
           //      close_callback: function() {
           //        loadJobAction(close_href);
           //      },
           //      cancel_callback: function() {

           //      }
           //    }
           //  });
         });

         //Delete
         $(document).on('click', '#milestones-tbody .btn-delete-milestone', function(e) {
           e.preventDefault();
           var current = $(this);
           var delete_href = $(this).attr('href');

           Swal.fire({
             title: 'Are you sure to delete?',
             showConfirmButton: true,
             confirmButtonText: 'Delete',
             showCancelButton: true,
             cancelButtonText: 'Cancel',
           }).then(function(result) {
             if (result.isConfirmed) {
               loadJobAction(delete_href);
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

         $('a[data-chatbox=true]').click(function(e) {
           e.preventDefault();
           let chat_url = $(this).attr('href');
           loadChatbox(chat_url, {
             name: '<?php echo $job['freelancer_name']; ?>',
             thumb: '<?php echo $job['thumb']; ?>',
             shortCode: 'rtc-cmp' + freelancer_job_id,
             list: $base_url + 'company/activity/freelancer_chat/listMessages/' + freelancer_job_id + '?js=accepted',
             action: $base_url + 'company/activity/freelancer_chat/addMessage/' + freelancer_job_id + '?js=accepted',
             upload: $base_url + 'company/activity/freelancer_chat/uploadMessage/' + freelancer_job_id + '?js=accepted'
           });
         });
       });
     </script>