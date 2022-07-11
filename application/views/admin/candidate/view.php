<!-- Menubar Top Start -->
<?php include APPPATH.'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->

<style>
  #profile--details input, #profile--details select, #profile--details textarea{
    pointer-events: none;
  }
</style>

<script>
  window.candidate_id = '<?php echo $candidate_id; ?>';
</script>

<div class="container-fluid" id="profile--details">
    <div class="row alice-bg">
      <div class="col-12 no-gliters p-0">
        <div class="dashboard-container">
          <!-- Dashboard Menubar-->
          <?php include APPPATH.'views/admin/include/menubar.php'; ?>

          <!-- Dashboard Content-->
          <div class="dashboard-content-wrapper">
            <!-- Breadcrumb -->
            <?php include APPPATH.'views/admin/include/breadcrumb.php'; ?>

            <div class="dashboard-form mb-5">
              <div class="row">

                <?php if(!$candidate['is_profileCompleted']) { ?>
                <div class="col-12">
                  <div class="card card-body alice-bg-2 border-0 mb-4 p-4">
                    <div class="mb-4 text-info" id="profile-status">
                      <h5 class="text-center">*** Please complete your profile ***</h5>
                    </div>
                  </div>
                </div>
                <?php } ?>

                <div class="col-md-3 order-md-2">
                  <div class="card card-body alice-bg2 border-0 mb-4 p-5">
                    <div class="dashboard-form mb-4 media-inputs">
                      <h4 class="my-4"><i data-feather="user-check"></i>Basic Info</h4>
                      <div class="dashboard-section upload-profile-photo" id="upload-profile-image">
                          <div class="update-photo">
                            <img class="image thumb" src="<?php echo $candidate['thumb']; ?>" data-picture="<?php echo $candidate['image'] ? $candidate['image'] : 'thumb'; ?>" alt="">
                          </div>
                      </div>
                    </div>
                    
                    <div class="dashboard-section basic-info-input">

                      <div class="form-group">
                        <label class="col-form-label">First Name</label>
                        <div class="">
                          <input type="text" name="first_name" value="<?php echo $candidate['first_name']; ?>" class="form-control" placeholder="First Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Last Name</label>
                        <div class="">
                          <input type="text" name="last_name" value="<?php echo $candidate['last_name']; ?>" class="form-control" placeholder="Last Name">
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <div class="">
                          <label class="form-control"><?php echo $candidate['email']; ?></label>
                        </div>
                      </div> -->
                      <?php if(!$candidate['mobile']){ ?>
                      <div class="form-group">
                        <label class="col-form-label">Mobile</label>
                        <div class="">
                            <input type="text" name="mobile" value="<?php echo $candidate['mobile']; ?>" class="form-control">
                        </div>
                      </div>
                      <?php }?>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-9 order-md-1">

                    <!-- Project Summary -->
                    <?php include 'include/resume/profile_summary.php'; ?>

                    <!-- Skills -->
                    <?php include 'include/resume/skills.php'; ?>

                    <!-- Education -->
                    <?php include 'include/resume/education.php'; ?>

                    <!-- Experience -->
                    <?php include 'include/resume/experience.php'; ?>

                    <!-- Projects Section -->
                    <?php include 'include/resume/project.php'; ?>

                    <!-- Certification Section -->
                    <?php include 'include/resume/certification.php'; ?>

                    <!-- Career Detail -->
                    <?php include 'include/resume/career.php'; ?>

                    <!-- Personal Detail -->
                    <?php include 'include/resume/personal.php'; ?>

                    <!-- Attach Document -->
                    <?php include 'include/resume/document.php'; ?>

                </div>
                <div class="col-md-9 order-3">
                  
                  <div class="card card-body alice-bg2 border-0 mb-4 p-5">              
                    <div class="dashboard-section media-inputs">

                      <h4 class="mb-4"><i data-feather="image"></i>Location</h4>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                          <input type="text" name="address" class="form-control" value="<?php echo $candidate['address']; ?>" placeholder="Address">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">City</label>
                        <div class="col-sm-9">
                          <input type="text" name="city" class="form-control" value="<?php echo $candidate['city']; ?>" placeholder="City">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Country</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="country" id="country" required ></select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">State</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="state" id="state" required ></select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pin Code</label>
                        <div class="col-sm-9">
                          <input type="text" name="pin_code" class="form-control" value="<?php echo $candidate['pin_code']; ?>" placeholder="Pin Code">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card card-body alice-bg2 border-0 mb-4 p-5">
                    <div class="dashboard-section social-inputs">
                      <h4 class="mb-4"><i data-feather="cast"></i>Social Networks</h4>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Social Links</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fab fa-facebook-f"></i></div>
                            </div>
                            <input type="text"  name="social_profiles[facebook]" class="form-control" value="<?php echo $candidate['facebook_profile']; ?>" placeholder="facebook.com/username">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fab fa-twitter"></i></div>
                            </div>
                            <input type="text"  name="social_profiles[twitter]" class="form-control" value="<?php echo $candidate['twitter_profile']; ?>" placeholder="twitter.com/username">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fab fa-linkedin"></i></div>
                            </div>
                            <input type="text" name="social_profiles[linkedin]" class="form-control" value="<?php echo $candidate['linkedin_profile']; ?>" placeholder="linkedin.com/username">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fab fa-instagram"></i></div>
                            </div>
                            <input type="text" name="social_profiles[instagram]" class="form-control" value="<?php echo $candidate['instagram_profile']; ?>" placeholder="instagram.com/username">
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

<script src="<?php echo base_url('application/assets/js/countries.js'); ?>"></script>
<script>
  $(function(){
    
    //Dynamic country select
    populateCountries('country', 'state', '<?php echo $candidate["country"]; ?>', '<?php echo $candidate["state"]; ?>');

  });
</script>