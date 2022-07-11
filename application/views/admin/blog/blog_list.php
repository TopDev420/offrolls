 <!-- Menubar Top Start -->
 <?php include APPPATH . 'views/admin/include/menubar_top.php'; ?>
 <!-- Menubar Top End -->


 <div class="container-fluid">
     <div class="row alice-bg">
         <div class="col-12 no-gliters p-0">
             <div class="dashboard-container">
                 <!-- Dashboard Menubar-->
                 <?php include APPPATH . 'views/admin/include/menubar.php'; ?>

                 <!-- Dashboard Content-->
                 <div class="dashboard-content-wrapper">
                     <!-- Breadcrumb -->
                     <?php include APPPATH . 'views/admin/include/breadcrumb.php'; ?>

                     <form id="search-form">
                         <div class="row mb-4">
                             <h5 style="margin-left: 25px; margin-bottom: 5px; color: #285C7F;">Filter</h5>
                             <div class="col-12">
                                 <div class="row no-gutters  align-items-center ">
                                     <div class="col-lg-10 col-md-6 col-sm-12 pr-1">
                                         <input type="text" placeholder="Search blog name..." class="form-control" id="search" name="search">
                                     </div>
                                     <div class="col-lg-1 col-md-3 col-sm-12">
                                         <button type="submit" class="ps-btn ps-btn--sm">
                                             <i class="fas fa-search"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </form>

                     <div class="dashboard-applied mb-5">
                         <div class="dashboard-section">
                             <div class="card bg-light text-secondary">
                                 <div class="card-body">
                                     <div class="table-responsive">
                                         <table id="company_table" class="table table-striped table-hover">
                                             <thead>
                                                 <tr class="">
                                                     <th class="text-left">Blog Title</th>
                                                     <th class="text-left">Status</th>
                                                     <th class="text-left">Created Date</th>
                                                     <th class="text-left">Action</th>
                                                 </tr>
                                             </thead>
                                             <tbody>

                                                 <?php if ($blog['blog_list']) { ?>
                                                     <?php foreach ($blog['blog_list'] as $list) { ?>
                                                         <tr>
                                                             <td class="text-left">
                                                                 <?php echo $list->blog_name; ?>
                                                             </td>
                                                             <td class="text-justify">
                                                                 <?php $status = $list->blog_status; ?>
                                                                 <?php if ($status == 1) { ?>
                                                                     <p>Active</p>
                                                                 <?php } else { ?>
                                                                     <p>Inactive</p>
                                                                 <?php } ?>
                                                             </td>
                                                             <td class="text-left">
                                                                 <?php $validFrom = $list->created_datetime;
                                                                    $validFromOg = date('d-M-Y', strtotime($validFrom));
                                                                    echo $validFromOg ?>
                                                             </td>
                                                             <td class="text-left">
                                                                 <a href="<?php echo base_url() . 'admin/blog/view/' . $list->slug .'/' . $list->blog_id; ?>" class="btn-default"><span class="ti-eye"></span></a>
                                                                 <a href="<?php echo base_url() . 'admin/blog/edit/' . $list->blog_id; ?>" class="btn-default pl-2"><i class=" fas fa-edit"></i></a>
                                                                 <a href="<?php echo base_url() . 'admin/blog/delete_blog/' . $list->blog_id; ?>" class="btn-delete-blog btn-default pl-2"><i class="fas fa-trash-alt"></i></a>
                                                             </td>
                                                         </tr>
                                                     <?php } ?>
                                                 <?php } else { ?>
                                                     <tr>
                                                         <td colspan="5" class="text-center">No Data</td>
                                                     </tr>
                                                 <?php } ?>

                                             </tbody>
                                         </table>
                                     </div>
                                     <?php if ($pagination) { ?>
                                         <nav aria-label="Page navigation example">
                                             <ul class="pagination">
                                                 <?php echo $pagination; ?>
                                             </ul>
                                         </nav>
                                     <?php } ?>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <script>
     $(function() {

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

         //Delete
         $(document).on('click', '.btn-delete-blog', function(e) {
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

         /* Search */
         $('#search-form input[name=\'search\']').submit(function() {
             var url = $base_url + '/admin/blog';

             var value = $('header #search input[name=\'search\']').val();

             if (value) {

                 window.location.href = url + '?search=' + encodeURIComponent(value);

             }

         });


     });
 </script>