  <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/vendor/cropperjs/dist/cropper.css'); ?>">

    <!-- Menubar -->
    <?php include APPPATH. 'views/include/menubar.php'; ?>
    <!-- Menubar End -->
    <style type="text/css">
      .alice-bg {
        background-color: white !important;
      }
    </style>
    
    <div class="section-default-header"></div>

   <div class="alice-bg section-padding">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-container">

              <!-- Sidebar -->
              <?php include 'include/sidebar.php'; ?>
              <!-- Sidebar End -->

              <div class="dashboard-content-wrapper shadow">
                <?php if(!$candidate['is_profileCompleted']) { ?>
                  <div class="mb-4 text-info" id="profile-status">
                    <h5 class="text-center">*** Please complete your profile ***</h5>
                  </div>
                <?php } ?>
                <div class="dashboard-form mb-4 media-inputs">
                    <h4 class="my-4"><i data-feather="user-check"></i>Basic Info</h4>
                    <div class="form-group">
                      <label>Profile Image</label>
                      <div class="dashboard-section upload-profile-photo" id="upload-profile-image">
                          <div class="update-photo">
                            <img class="image thumb" src="<?php echo $candidate['thumb']; ?>" data-picture="<?php echo $candidate['image'] ? $candidate['image'] : 'thumb'; ?>" alt="">
                          </div>
                          <div class="file-upload">
                            <input type="file" name="profile_image" class="file-input">Change Photo
                          </div>
                      </div>
                      <p><small>(Upload square size image)</small></p>
                    </div>
                
                    <form action="<?php echo base_url() . 'candidate/profile/edit'; ?>" id="candidateProfileForm" class="dashboard-form" method="post">
                      <div class="dashboard-section basic-info-input">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="first_name" value="<?php echo $candidate['first_name']; ?>" class="form-control" placeholder="First Name" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="last_name" value="<?php echo $candidate['last_name']; ?>" class="form-control" placeholder="Last Name" required>
                          </div>
                        </div>
                        <!-- <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email Address</label>
                          <div class="col-sm-9">
                            <label class="form-control"><?php echo $candidate['email']; ?></label>
                          </div>
                        </div> -->
                        <?php if(!$candidate['mobile']){ ?>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
                          <div class="col-sm-9">
                              <input type="text" name="mobile" value="<?php echo $candidate['mobile']; ?>" class="form-control" required>
                          </div>
                        </div>
                        <?php }?>
                      </div>

                      <div class="dashboard-section media-inputs">
                        <h4><i data-feather="image"></i>Location</h4>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                            <input type="text" name="address" class="form-control" value="<?php echo $candidate['address']; ?>" placeholder="Address" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" name="city" class="form-control" value="<?php echo $candidate['city']; ?>" placeholder="City" required>
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
                            <input type="number" name="pin_code" class="form-control" value="<?php echo $candidate['pin_code']; ?>" placeholder="Pin Code" required>
                          </div>
                        </div>

                      </div>
                      <div class="dashboard-section social-inputs">
                        <h4><i data-feather="cast"></i>Social Networks</h4>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Social Links</label>
                          <div class="col-sm-9">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fab fa-facebook-f"></i></div>
                              </div>
                              <input type="text"  name="social_profiles[facebook]" class="form-control" value="<?php echo $candidate['facebook_profile']; ?>" placeholder="facebook.com/username" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-9">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fab fa-twitter"></i></div>
                              </div>
                              <input type="text"  name="social_profiles[twitter]" class="form-control" value="<?php echo $candidate['twitter_profile']; ?>" placeholder="twitter.com/username" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-9">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fab fa-linkedin"></i></div>
                              </div>
                              <input type="text" name="social_profiles[linkedin]" class="form-control" value="<?php echo $candidate['linkedin_profile']; ?>" placeholder="linkedin.com/username" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-9">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fab fa-instagram"></i></div>
                              </div>
                              <input type="text" name="social_profiles[instagram]" class="form-control" value="<?php echo $candidate['instagram_profile']; ?>" placeholder="instagram.com/username" required>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="dashboard-section">
                        <div class="form-group">
                          <button type="submit" class="ps-btn">Save</button>
                        </div>
                      </div>

                    </form>
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

    <!--<script src="<?php echo base_url('application/assets/dashboard/js/dashboard.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('application/assets/dashboard/js/datePicker.js'); ?>"></script>-->

    <script src="<?php echo base_url('application/assets/js/countries.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>

    <!-- Cropper.js -->
    <?php $this->document->addScript(base_url('application/assets/vendor/cropperjs/dist/cropper.js'), 'footer'); ?>
    <?php $this->document->addScript(base_url('application/assets/vendor/jquery-cropper/dist/jquery-cropper.js'), 'footer'); ?>
    <?php $this->document->addScript(base_url('application/assets/js/include/candidate/profile.js'), 'footer'); ?>

    <script>
      $(function(){
        $redirect = '<?php echo $redirect; ?>';

        //Dynamic country select
        populateCountries('country', 'state', '<?php echo $candidate["country"]; ?>', '<?php echo $candidate["state"]; ?>');

      });
    </script>
