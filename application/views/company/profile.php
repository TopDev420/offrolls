    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/vendor/cropperjs/dist/cropper.css'); ?>">

    <!-- Menubar -->
    <?php include APPPATH . 'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->
    <style type="text/css">
      .alice-bg {
        background-color: white !important;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
    <div class="section-default-header"></div>
    <?php include APPPATH . 'views/company/include/navbar.php'; ?>
    <!-- <div class="alice-bg pt-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="breadcrumb-area">
              <nav aria-label="breadcrumb">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>company/dashboard">HOME</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="#" style="background-color: #4CB9BD; color: white;">PROFILE</a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="breadcrumb-area" style="background-image: linear-gradient(to right,#285C7F , #4CB9BD); padding: 5px !important;">
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <div class="ps-page" id="dashboard">
      <div class="ps-section--sidebar ps-layout">
        <div class="container">
          <div class="ps-section__container">
            <div class="ps-section__content">
              <figure>
                <?php if (!$company['is_profileCompleted']) { ?>
                  <div class="jy-card card mb-5 alice-bg border">
                    <div class="card-body p-5">
                      <div class="mb-4 text-info">
                        <h5 class="text-center">*** Please complete your profile ***</h5>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <div class="jy-card card mb-5">
                  <div class="card-body p-5">
                    <div class="dashboard-section upload-profile-photo" id="upload-profile-image">
                      <div class="info-header">
                        <h4 class="mb-2"> Basic Info</h4>
                      </div>
                      <div class="form-group">
                        <label>Company Logo</label>
                        <div class=" position-relative profile-upload">
                          <div class="update-photo">
                            <img class="image thumb" src="<?php echo $company['thumb']; ?>" data-picture="<?php echo $company['image'] ? $company['image'] : 'thumb'; ?>" alt="">
                          </div>
                          <div class="file-upload">
                            <input type="file" name="profile_image" class="file-input"><i class="fas fa-pencil-alt"></i>
                          </div>
                        </div>
                        <small>(Upload square size image without background)</small>
                      </div>

                      <form id="profileForm" class="dashboard-form" method="post" novalidate="novalidate">
                        <div class="form-group row">
                          <label class="col-12 control-form-label mandatory">First Name</label>
                          <div class="col-12">
                            <input type="text" name="first_name" class="form-control" value="<?php echo $company['first_name']; ?>" placeholder="First Name">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-12 control-form-label mandatory">Last Name</label>
                          <div class="col-12">
                            <input type="text" name="last_name" class="form-control" value="<?php echo $company['last_name']; ?>" placeholder="Last Name">
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="ps-btn ps-btn--sm">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="jy-card card mb-5" style="border-radius: 16px;">
                  <div class="card-body p-5">
                    <form id="companyProfileForm" class="dashboard-form" method="post" novalidate="novalidate">
                      <div class="dashboard-section basic-info-input">
                        <div class="info-header clearfix form-group">
                          <h4 class="d-inline-block" style="font-weight: 700;">Company Detail</h4>
                          <button type="submit" class="ps-btn ps-btn--sm float-right">Save</button>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">Company Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="company_name" class="form-control" value="<?php echo $company['name']; ?>" placeholder="Company Name">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">Phone Number</label>
                          <div class="col-sm-9">
                            <input type="text" name="landline" class="form-control" value="<?php echo $company['landline']; ?>">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">Industry</label>
                          <div class="col-sm-9">
                            <input type="text" name="industry" placeholder="Industry" value="<?php echo $company['company_category'] ? $company['company_category']['label'] : ''; ?>" class="form-control" />
                            <input type="hidden" name="company_category" class="form-control" value="<?php echo $company['company_category'] ? $company['company_category']['value'] : ''; ?>" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">About Us</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="about" placeholder="About Us"><?php echo $company['about']; ?></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">GST/PAN Number</label>

                          <div class="col-sm-9" id="gp-numblockz">
                            <div>
                              <label class="mr-2">
                                <input type="radio" class="nogpnumber" value="no_gst" name="gpnumber" checked="">
                                <span>No GST Number</span>
                              </label>
                              <label class="mr-2">
                                <input type="radio" class="gstnumber" value="gst" name="gpnumber">
                                <span>GST Number</span>
                              </label>
                              <label class="mr-2">
                                <input type="radio" class="pannumber" value="pan" name="gpnumber">
                                <span>PAN Number</span>
                              </label>
                            </div>
                            <div class="gst-numblock" style="display:none;">
                              <input type="text" name="gst_number" class="form-control" value="<?php echo $company['gst_no']; ?>" placeholder="GST Number">
                            </div>
                            <div class="pan-numblock" style="display:none;">
                              <input type="text" name="pan_number" class="form-control" value="<?php echo $company['pan_no']; ?>" placeholder="PAN Number">
                            </div>
                          </div>

                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">Web Link</label>
                          <div class="col-sm-9">
                            <input type="url" name="web_link" class="form-control" value="<?php echo $company['web_link']; ?>" placeholder="Web Link">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="jy-card card mb-5" style="border-radius: 16px;">
                  <div class="card-body p-5">
                    <form id="locationProfileForm" class="dashboard-form" method="post" novalidate="novalidate">
                      <div class="dashboard-section media-inputs">
                        <div class="info-header clearfix form-group">
                          <h4 class="d-inline-block">Location</h4>
                          <button type="submit" class="ps-btn ps-btn--sm float-right">Save</button>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">Address</label>
                          <div class="col-sm-9">
                            <input type="text" name="address" class="form-control" value="<?php echo $company['address']; ?>" placeholder="Address">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">Country</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="country" id="country" required></select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">State</label>
                          <div class="col-sm-9">
                            <input type="text" id="company-state" name="company_state" class="form-control" value="<?php echo $company['state']; ?>" placeholder="State" autocomplete="off">
                            <input type="hidden" name="state" value="<?php echo $company['state']; ?>" class="form-control" />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">City</label>
                          <div class="col-sm-9">
                            <input type="text" id="company-city" name="company_city" class="form-control" value="<?php echo $company['city']; ?>" placeholder="City" autocomplete="off">
                            <input type="hidden" name="city" value="<?php echo $company['city']; ?>" class="form-control" />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label mandatory">Pin Code</label>
                          <div class="col-sm-9">
                            <input type="text" name="pincode" class="form-control" value="<?php echo $company['pin_code']; ?>" placeholder="Pin Code">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="jy-card card mb-5" style="border-radius: 16px;">
                  <div class="card-body p-5">
                    <form id="socialLinksProfileForm" class="dashboard-form" method="post" novalidate="novalidate">
                      <div class="dashboard-section social-inputs">
                        <div class="info-header clearfix form-group">
                          <h4 class="d-inline-block">Social Networks</h4>
                          <button type="submit" class="ps-btn ps-btn--sm float-right">Save</button>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Social Links</label>
                          <div class="col-sm-9">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fab fa-facebook-f"></i></div>
                              </div>
                              <input type="text" name="social_profiles[facebook]" class="form-control" value="<?php echo $company['facebook_profile']; ?>" placeholder="facebook.com/username">
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-9">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fab fa-linkedin"></i></div>
                              </div>
                              <input type="text" name="social_profiles[linkedin]" class="form-control" value="<?php echo $company['linkedin_profile']; ?>" placeholder="linkedin.com/username">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-9">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fab fa-instagram"></i></div>
                              </div>
                              <input type="text" name="social_profiles[instagram]" class="form-control" value="<?php echo $company['instagram_profile']; ?>" placeholder="instagram.com/username">
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </figure>
            </div>
            <div class="ps-section__sidebar">
              <aside class="widget widget_profile widget_list">
                <h3 class="widget-title">Settings</h3>
                <ul class="ps-list">
                  <li><a href="<?php echo base_url() . 'company/settings'; ?>">General infomation</a></li>
                  <!-- <li><a href="#">Password</a></li>
                  <li><a href="#">Messaging</a></li>
                  <li><a href="#">Notifications</a></li>
                  <li><a href="<?php echo base_url() . 'company/profile'; ?>">Edit Profile</a></li>
                  <li><a href="#">Social Networks</a></li>
                  <li><a href="#">Account Type</a></li>
                  <li><a href="#">Privacy</a></li> -->
                </ul>
              </aside>
            </div>
          </div>
        </div>
      </div>

      <script src="<?php echo base_url('application/assets/js/countries.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>

      <!-- Cropper.js -->
      <?php $this->document->addScript(base_url('application/assets/vendor/cropperjs/dist/cropper.js'), 'footer'); ?>
      <?php $this->document->addScript(base_url('application/assets/vendor/jquery-cropper/dist/jquery-cropper.js'), 'footer'); ?>
      <?php $this->document->addScript(base_url('application/assets/js/include/company/profile.js'), 'footer'); ?>

      <script>
        $(function() {
          $redirect = '<?php echo $redirect; ?>';

          //Dynamic country select
          populateCountries('country', '', '<?php echo $company["country"]; ?>', '');

          var gst_number = '<?php echo $company["gst_no"]; ?>';
          var pan_number = '<?php echo $company["pan_no"]; ?>';

          //GP Block
          $('#gp-numblockz input[name=gpnumber]').click(function() {
            var numval = $(this).val();
            if (numval == 'gst') {
              $('#gp-numblockz .gst-numblock').show(400);
              $('#gp-numblockz .pan-numblock').hide();
            } else if (numval == 'pan') {
              $('#gp-numblockz .pan-numblock').show(400);
              $('#gp-numblockz .gst-numblock').hide();
            } else {
              $('#gp-numblockz .gst-numblock').hide();
              $('#gp-numblockz .pan-numblock').hide();
            }
          });

          if (pan_number && pan_number != '') {
            $('#gp-numblockz input[name=gpnumber].pannumber').trigger('click');
          } else if (gst_number && gst_number != '') {
            $('#gp-numblockz input[name=gpnumber].gstnumber').trigger('click');
          } else {
            $('#gp-numblockz input[name=gpnumber].nogpnumber').trigger('click');
          }


          // Job Location Autocomplete

          $('input[name=\'company_state\']').autocomplete({
            'source': function(request, response) {
              if (request == '') {
                $('input[name=\'state\']').val('');
              }
              // if(request.length > 1){
              $.ajax({
                url: $base_url + 'category/location/stateAutocomplete/' + request,
                type: 'post',
                dataType: 'json',
                success: function(json) {
                  response($.map(json, function(item) {
                    return {
                      label: item['label'],
                      value: item['value']
                    }
                  }));
                },
              });
              // }
            },
            'select': function(item) {
              $('input[name=\'company_state\']').val(item['label']);
              $('input[name=\'state\']').val(item['value']);
            }
          });

          $('input[name=\'company_city\']').autocomplete({
            'source': function(request, response) {
              if (request == '') {
                $('input[name=\'city\']').val('');
              }
              // if(request.length > 1){
              $.ajax({
                url: $base_url + 'category/location/autocomplete/' + request + '?state=' + $('input[name=\'state\']').val(),
                type: 'post',
                dataType: 'json',
                success: function(json) {
                  response($.map(json, function(item) {
                    return {
                      label: item['label'],
                      value: item['value']
                    }
                  }));
                },
              });
              // }
            },
            'select': function(item) {
              $('input[name=\'company_city\']').val(item['label']);
              $('input[name=\'city\']').val(item['value']);
            }
          });

        })
      </script>