     <!-- Menubar -->
     <?php include APPPATH . 'views/freelancer/include/menubar.php'; ?>
     <!-- Menubar End -->
     <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">

     <!-- Navbar -->
     <?php include APPPATH . 'views/freelancer/include/navbar.php'; ?>

     <div class=" section-default-header"></div>

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

       .jy-card .nav-tabs .nav-item.show .nav-link,
       .jy-card .nav-tabs .nav-link.active {
         background-color: #4CB9BD !important;
         border-color: #4CB9BD !important;
         color: white !important;
       }
     </style>

     <div class="ps-page">
       <div class="ps-section--sidebar ps-listing dashboard">
         <div class="ps-section__container" id="card-body-blocks">
           <div class="ps-section__content mx-5">
             <div class="row mb-5 ps-padrt-md-100">
               <div class="col-md-12">
                 <h4><a id="btn-job-details" href="javascript:void(0)" class="ps-section--heading darkblue--color" style="font-size:32px;"><?php echo $job['title']; ?></a></h4>
                 <p><?php if ($job['location']) { ?><span><?php echo $job['location']; ?></span><?php } ?> <?php if ($job['job_type']) { ?><span><?php echo $job['job_type']; ?></span> <?php } ?></p>
               </div>
               <div class="col-md-12 d-none">
                 <div class="float-right">
                   <a href="<?php echo base_url() . 'freelancer/chat/start/' . $job['job_id']; ?>" class="mb-2 ps-btn ps-btn--sm" data-chatbox="true"><i data-feather="message-square"></i> Chat</a>
                 </div>
               </div>
             </div>
             <!-- <div class="card-header p-0">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                       <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#projectMilestones">Milestones </a> </li>
                       <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#projectFiles">Files </a> </li>
                     </ul>
                   </div> -->
             <div class="my-3 ps-padrt-md-100">
               <h5 class="d-md-inline-block p-2">Milestone</h5>
               <button class="ps-btn ps-btn--sm float-right" id="btn-add-milestone"><i class="fas fa-plus-circle"></i> Add</button>
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
                   <?php foreach ($milestones as $milestone) { ?>
                     <tr class="ms--row border mb-2 py-4">
                       <td class="text-center py-3"><?php echo $milestone['date_added']; ?>
                       </td>
                       <td>
                         <span class="d-block vm--block less text-justify"><?php echo html_entity_decode($milestone['description']); ?></span>
                         <!-- <a href="javascript:void(0)" class="btn-view-more primary-color"> More</a> -->
                       </td>
                       <td class="text-center py-3"><?php if ($milestone['is_approved'] == 1) { ?>
                           <span> <?php echo date('d M Y', strtotime($milestone['start_date'])); ?></span><br />
                           <!-- <span><small>Duration: <?php echo $milestone['duration'] . 'Day'; ?></small></span> -->
                         <?php } ?>
                       </td>
                       <td class="text-center py-3"><?php if ($milestone['is_approved'] == 1) { ?>
                           <?php echo $milestone['end_date']; ?>
                         <?php } ?>
                       </td>
                       <td class="text-center py-3"><?php echo $milestone['status']; ?></td>
                       <td class="text-center py-3"><?php echo $milestone['amount']; ?></td>
                       <td class="text-center py-3">
                         <?php if ($milestone['is_completed'] == 0) { ?>
                           <?php if ($milestone['is_approved'] == 1) { ?>
                             <a href="<?php echo $milestone['edit']; ?>" class="ps-btn ps-btn--sm edit btn-edit-milestone" title="Edit"><i class="fas fa-edit"></i></a>
                           <?php } else { ?>
                             <?php if ($milestone['is_accepted'] == 1 || $milestone['is_rejected'] == 1) { ?>
                               <?php if ($milestone['is_accepted'] == 1 && $milestone['is_rejected'] == 0) { ?>
                                 <span class="mr-2 text-info">Waiting For Approval</span>
                               <?php } ?>

                               <?php if ($milestone['is_rejected'] == 1) { ?>
                                 <button class="ps-btn ps-btn--sm ps-btn--outline white-text" style="cursor: default;"><i class="fas fa-times-circle"></i> Rejected</button>
                                 <?php } ?>
                               <?php } else { ?>
                                 <?php if ($milestone['initiator'] == false) {  ?>
                                   <a href="<?php echo $milestone['accept']; ?>" class="ps-btn ps-btn--sm white-text btn-accept-milestone mb-2" title="Accept Milestone"><i class="fas fa-check-circle"></i> Accept</a>
                                   <a href="<?php echo $milestone['reject']; ?>" title="Reject Milestone" class="ps-btn ps-btn--sm ps-btn--outline white-text  btn-reject-milestone mb-2"><i class="fas fa-times-circle"></i> Reject</a>
                                 <?php } else { ?>
                                   <span class="mr-2 text-warning">Waiting For Acknowledgement</span>
                                 <?php } ?>

                               <?php } ?>

                               <?php if ($milestone['initiator'] == true) {  ?>
                                 <a href="<?php echo $milestone['delete']; ?>" class="ps-btn ps-btn--sm edit btn-delete-milestone" title="Delete"><i class="fas fa-trash"></i> Delete</a>
                               <?php } ?>
                             <?php } ?>
                           <?php } else { ?>
                             <?php if ($milestone['is_closed']) { ?>
                               <p class="text-center info-text">Milestone Closed</p>
                             <?php } else { ?>
                               <a href="<?php echo $milestone['close']; ?>" title="Close Milestone" class="ps-btn ps-btn--sm ps-btn--outline btn-close-milestone"><i class="fas fa-times-circle"></i></a>
                             <?php } ?>
                           <?php } ?>
                       </td>
                     </tr>
                   <?php } ?>
                 </tbody>
               </table>
             </div>
           </div>
           <div class="ps-section__sidebar ps-section__filter">
             <?php $user = isset($user) ? $user : ''; ?>
             <?php if ($user) { ?>
               <div class="widget widget_profile widget_edit-profile">
                 <a href="<?php echo $profile_link; ?>"><i class="fa fa-sliders"></i><span>Edit Profile</span><img src="<?php echo $user['thumb']; ?>" alt=""></a>
                 <div class="mt-4 p-4">
                   <p class="mb-4">Setup your account</p>
                   <div class="ps-progress"><span><?php echo $user['progress'] . '%'; ?></span>
                     <div class="progress">
                       <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $user['progress']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                   </div>
                 </div>
                 <!-- <div class="col-md-6">
                                    <a class="ps-btn ps-btn--outline ps-btn--sm pl-5" href="<?php echo base_url() . 'freelancer/job'; ?>">My Projects</a>
                                </div> -->
               </div>
               <div class="widget widget_profile">
                 <div class="mt-4 p-4">
                   <div class="">
                     <a href="<?php echo base_url() . 'freelancer/chat/start/' . $job['job_id']; ?>" class="mb-2 ps-btn ps-btn--sm" data-chatbox="true"><i data-feather="message-square"></i> Chat</a>
                   </div>
                 </div>
               </div>
             <?php } ?>
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
                     <label class="control-label">Amount</label>
                     <input type="text" name="ms_amount" class="form-control" />
                   </div>

                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label class="control-label">Duration</label>
                     <input type="text" name="ms_duration" class="form-control" />
                   </div>
                 </div>
               </div>

               <div class="form-group">
                 <label class="control-label">Description</label>
                 <textarea row="5" name="ms_description" id="description--editor" class="form-control"></textarea>
               </div>

               <div class="form-group">
                 <label class="control-label">Requirements</label>
                 <textarea row="5" name="ms_requirements" id="requirements--editor" class="form-control"></textarea>
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
               <!-- <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <label class="control-label">Amount</label>
                     <input type="text" name="ms_amount" value="" class="form-control" />
                   </div>

                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label class="control-label">Duration</label>
                     <input type="text" name="ms_duration" class="form-control" />
                   </div>
                 </div>
               </div>

               <div class="form-group">
                 <label class="control-label">Description</label>
                 <textarea row="5" name="ms_description" id="description--editor1" class="form-control edit-description"></textarea>
               </div>
               <div class="form-group">
                 <label class="control-label">Requirements</label>
                 <textarea row="5" name="ms_requirements" id="requirements--editor1" class="form-control edit-requirements"></textarea>
               </div> -->
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
                 <a href="javascript:void(0)" class="ps-btn ps-btn--white ps-btn--sm ps-btn--shadow close_" data-dismiss="modal">Close</a>
                 <button class="ps-btn ps-btn--outline ps-btn--sm">Save</button>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>

     <!-- Show More JS -->
     <script type="text/javascript" src="<?php echo base_url() . 'application/assets/js/jquery.show-more.js'; ?>"></script>
     <script>
       var job_id = '<?php echo $job["job_id"]; ?>';

       $(function() {
         var elementBlock = $('#milestones-tbody');
         // init summernote editor
         initSummerNote(['#description--editor', '#requirements--editor', '#description--editor1', '#requirements--editor1']);

         elementBlock.find('.vm--block').showMore({
           minheight: 80,
           buttontxtmore: '...more',
           buttontxtless: '...less',
           buttoncss: 'font-500 primary-color',
           animationspeed: 250
         });

         function job_action(form, href) {
           $.ajax({
             url: href,
             type: 'post',
             data: $(form).serialize(),
             dataType: 'json',
             beforeSend: function() {
               $.FEED.showLoader();
             },
             success: function(res) {
               if (res.success) {
                 $('.modal').modal('hide');
                 $(form)[0].reset();
                 //$.ALERT.show('success', res.message);
                 Toast.fire({
                   icon: 'success',
                   title: res.message,
                 });
                 setTimeout(function() {
                   location.reload();
                 }, 1500);
               } else if (res.error) {
                 // $.ALERT.show('danger', res.message);
                 Toast.fire({
                   icon: 'danger',
                   title: res.message,
                 });
               } else {
                 // $.ALERT.show('danger', 'No Data');
                 Toast.fire({
                   icon: 'danger',
                   title: 'No Data',
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
           $('#add-milestone-modal').modal({
             backdrop: 'static',
             keyboard: false,
             show: true
           });
         });

         //Validation Certification
         var formAddMilestone = $('#formAddMilestone').validate({
           rules: {
             ms_description: {
               required: true,
               minlength: 10
             },
             ms_amount: {
               required: true,
               digits: true
             },
             ms_requirements: {
               minlength: 10
             },
             ms_duration: {
               required: true
             }
           },
           messages: {
             ms_description: {
               required: "Please enter Description",
               minlength: "Please enter atleast 10 characters!"
             },
             ms_amount: {
               required: "Please enter amount",
               digits: "Amount must be in number"
             },
             ms_requirements: {
               minlength: "Please enter atleast 10 characters!"
             },
             ms_duration: {
               required: "Please enter Duration"
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
           },
           submitHandler: function(form) {
             var surl = '<?php echo $add_milestone_action; ?>';
             job_action(form, surl);
           }
         });

         function loadJobAction(href) {
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
                   title: res.message,
                 });
                 setTimeout(function() {
                   location.reload();
                 }, 1500);
               } else if (res.error) {
                 //$.ALERT.show('danger', res.message);
                 Toast.fire({
                   icon: 'danger',
                   title: res.message,
                 });
               } else {
                 // $.ALERT.show('danger', 'No Data');
                 Toast.fire({
                   icon: 'danger',
                   title: 'No Data',
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

         $(document).on('click', '#milestones-tbody .btn-delete', function(e) {
           e.preventDefault();
           var current = $(this);
           var delete_href = $(this).attr('href');

           Swal.fire({
             title: 'Are you sure to delete?',
             showConfirmButton: true,
             showCancelButton: true,
           }).then(function(result) {
             if (result.isConfirmed) {
               loadJobAction(delete_href);
             }
           });

           //Delete Confirm Modal
           //  $.ALERT.confirm({
           //    icon: '<i class="fas fa-trash-alt"></i>',
           //    className: 'danger-alert',
           //    message: 'Are you sure to delete?',
           //    buttons: ['Delete', 'Cancel'],
           //    confirm: {
           //      delete_callback: function() {
           //        loadJobAction(delete_href);
           //      },
           //      cancel_callback: function() {

           //      }
           //    }
           //  });
         });

         $('#formAddMilestone .close_').click(function() {
           $('#formAddMilestone')[0].reset();
           formAddMilestone.resetForm();
           $('#formAddMilestone').find('.selectpicker').selectpicker('refresh');
         });


         //Edit Milestone
         $('.btn-edit-milestone').click(function(e) {
           e.preventDefault();
           var href = $(this).attr('href');
           var hrefSplits = href.split('/');
           var job_milestone_id = hrefSplits[hrefSplits.length - 1];

           $.ajax({
             url: $base_url + 'freelancer/jobmilestone/detail/' + job_milestone_id,
             type: 'post',
             dataType: 'json',
             beforeSend: function() {
               $.FEED.showLoader();
             },
             success: function(res) {
               if (res.success) {

                 $('#formEditMilestone').find('.edit-amount').val(res.data.amount);
                 $('#formEditMilestone').find('.edit-description').val(res.data.description);
                 $('#formEditMilestone').find('.edit-status').val(res.data.status);
                 $('#formEditMilestone').find('.selectpicker').selectpicker('refresh');

                 $('#edit-milestone-modal').modal({
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
                 // $.ALERT.show('danger', 'No Data');
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

           var formEditMilestone = $('#formEditMilestone').validate({
             rules: {
               //  ms_description: {
               //    required: true,
               //    minlength: 10
               //  },
               //  ms_amount: {
               //    required: true,
               //    digits: true
               //  },
               //  ms_requirements: {
               //    minlength: 10
               //  },
               //  ms_duration: {
               //    required: true
               //  },
               ms_status: {
                 required: true
               }
             },
             messages: {
               //  ms_description: {
               //    required: "Please enter Description",
               //    minlength: "Please enter atleast 10 characters!"
               //  },
               //  ms_amount: {
               //    required: "Please enter amount",
               //    digits: "Amount must be in number"
               //  },
               //  ms_requirements: {
               //    minlength: "Please enter atleast 10 characters!"
               //  },
               //  ms_duration: {
               //    required: "Please enter Duration"
               //  },
               ms_status: {
                 required: "Please select status"
               },
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
             },
             submitHandler: function(form) {
               var surl = $base_url + 'freelancer/jobmilestone/edit/' + job_milestone_id;
               job_action(form, surl);
             }
           });

           $('#formEditMilestone .close_').click(function() {
             $('#formEditMilestone')[0].reset();
             formEditMilestone.resetForm();
             $('#formEditMilestone').find('.selectpicker').selectpicker('refresh');
           });
         });

         //Accept Milestone
         $(document).on('click', '#milestones-tbody .btn-accept-milestone', function(e) {
           e.preventDefault();
           let href = $(this).attr('href');
           loadJobAction(href);
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

           //Reject Confirm Modal
           //  $.ALERT.confirm({
           //    icon: '<i class="fas fa-trash-alt"></i>',
           //    className: 'danger-alert',
           //    message: 'Are you sure to reject?',
           //    buttons: ['Reject', 'Cancel'],
           //    confirm: {
           //      delete_callback: function() {
           //        loadJobAction(reject_href);
           //      },
           //      cancel_callback: function() {

           //      }
           //    }
           //  });
         });

       });
     </script>


     <!-- Chat Start -->
     <?php include APPPATH . 'views/include/chatbox.php'; ?>

     <script>
       $(function() {
         $('a[data-chatbox=true]').click(function(e) {
           e.preventDefault();
           let chat_url = $(this).attr('href');
           loadChatbox(chat_url, {
             name: '<?php echo $job["company_name"]; ?>',
             thumb: '<?php echo $job["thumb"]; ?>',
             shortCode: 'rtc-fr' + job_id,
             list: $base_url + 'freelancer/chat/listMessages/' + job_id,
             action: $base_url + 'freelancer/chat/addMessage/' + job_id,
             upload: $base_url + 'freelancer/chat/uploadMessage/' + job_id
           });
         });
       });
     </script>
     <!-- Chat End -->