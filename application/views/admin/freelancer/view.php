<!-- Menubar Top Start -->
<?php include APPPATH.'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->


<div class="container-fluid">
    <div class="row alice-bg">
      <div class="col-12 no-gliters p-0">
        <div class="dashboard-container">
          <!-- Dashboard Menubar-->
          <?php include APPPATH.'views/admin/include/menubar.php'; ?>

          <!-- Dashboard Content-->
          <div class="card dashboard-content-wrapper">
            <!-- Breadcrumb -->
            <?php include APPPATH.'views/admin/include/breadcrumb.php'; ?>

            <div class="dashboard-form mb-5">
              <div class="row">
                
                <div class="col-12">
                  <div class="dashboard-containerz" id="dashboard-container">

                    <div class="dashboard-content-wrapperz">
                      <!-- Project Summary -->
                      <?php include 'include/jobprofile/general.php'; ?>

                      <!-- Project Summary -->
                      <?php include 'include/jobprofile/profile_summary.php'; ?>

                      <!-- Education -->
                      <?php include 'include/jobprofile/education.php'; ?>

                      <!-- Skills -->
                      <?php include 'include/jobprofile/skills.php'; ?>

                      <!-- Experience -->
                      <?php include 'include/jobprofile/experience.php'; ?>

                      <!-- Projects Section -->
                      <?php include 'include/jobprofile/project.php'; ?>

                      <!-- Certification Section -->
                      <?php include 'include/jobprofile/certification.php'; ?>

                      <!-- Desired Job Detail -->
                      <?php include 'include/jobprofile/desired_job.php'; ?>

                    </div>

                  </div>
                </div>

                <div class="col-12">
                  <div class="dashboard-section posts-section">
                    <h5>Posts</h5>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="text-left">Title</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php if($freelancer['posts']){ ?>
                            <?php foreach($freelancer['posts'] as $post) { ?>
                              <tr>
                                <td class="text-left"><?php echo $post['title']; ?></td>
                                <td><?php echo ($post['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                <td>
                                  <a href="javascript:void(0)" class="button-default small-xs primary-bg white-text edit-company"><span class="ti-pencil"></span></a>
                                </td>
                              </tr>
                            <?php } ?>
                          <?php } else { ?>
                          <tr>
                            <td colspan="3" class="text-center">No Data</td>
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

<script>
  const freelancer_id = '<?php echo $freelancer_id; ?>';
</script>
<!-- <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('application/assets/js/include/admin/company.js'); ?>"></script>
 -->
