<!-- Menubar Top Start -->
<?php include APPPATH.'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->
<style>
  #companyDetailsArea input,
  #companyDetailsArea select,
  #companyDetailsArea textarea {
    pointer-events: none;
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

            <div class="dashboard-form mb-5" id="companyDetailsArea">
              <div class="row">

                <div class="col-md-3 order-md-2">
                  <div class="mb-4 media-inputs">
                      <div class="jy-card card mb-5 border card-shadow">
                          <div class="card-body p-5">
                              <div class="dashboard-section upload-profile-photo" id="upload-profile-image">
                                  <div class="info-header"><h4><i data-feather="user_check"></i> Basic Info</h4></div>
                                  <div class="form-group position-relative">
                                      <div class="update-photo">
                                        <img class="image thumb" src="<?php echo $company['thumb']; ?>"  data-picture="<?php echo $company['image'] ? $company['image'] : 'thumb'; ?>" alt="">
                                      </div>
                                  </div>

                                  
                                      <div class="form-group row">
                                        <label class="col-12 control-form-label mandatory">First Name</label>
                                        <div class="col-12">
                                          <input type="text" name="first_name" class="form-control" value="<?php echo $company['first_name']; ?>" placeholder="First Name">
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="col-12 control-form-label">Last Name</label>
                                        <div class="col-12">
                                          <input type="text" name="last_name" class="form-control" value="<?php echo $company['last_name']; ?>" placeholder="Last Name" >
                                        </div>
                                      </div>
                                      
                                  
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                

                <div class="col-md-9 order-md-1" >

                    <?php if(!$company['is_profileCompleted']) { ?>
                    <div class="jy-card card mb-5 alice-bg border card-shadow">
                        <div class="card-body p-4">
                          <div class="text-info">
                            <h5 class="text-center">*** Profile not yet completed ***</h5>
                          </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="jy-card card mb-5 border card-shadow" style="border-radius: 16px; ">
                    <!-- background-color: #EFEFEF; border: 1px solid green !important; -->
                        <div class="card-body p-5">
                            
                                <div class="dashboard-section basic-info-input">
                                <div class="info-header clearfix form-group">
                                    <h4 class="d-inline-block"><i data-feather="briefcase"></i> Company Detail</h4>
                                    
                                </div>

                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label mandatory">Company Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="company_name" class="form-control" value="<?php echo $company['name']; ?>" placeholder="Company Name">
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Landline</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="landline" class="form-control" value="<?php echo $company['landline']; ?>">
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Industry</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="industry" placeholder="Industry" value="<?php echo $company['company_category'] ? $company['company_category']['label'] : ''; ?>" class="form-control" />
                                    <input type="hidden" name="company_category" class="form-control" value="<?php echo $company['company_category'] ? $company['company_category']['value'] : ''; ?>" />
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">About Us</label>
                                  <div class="col-sm-9">
                                    <textarea class="form-control" name="about"  placeholder="About Us"><?php echo $company['about']; ?></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">GST/PAN Number</label>

                                  <div class="col-sm-9" id="gp-numblockz">
                                    <div>
                                      <label class="mr-2">
                                        <input type="radio" class="nogpnumber" value="no_gst" name="gpnumber" checked="" >
                                        <span>No GST Number</span>
                                      </label>
                                      <label class="mr-2">
                                        <input type="radio" class="gstnumber" value="gst" name="gpnumber" >
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
                                  <label class="col-sm-3 col-form-label">Web Link</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="web_link" class="form-control" value="<?php echo $company['web_link']; ?>" placeholder="Web Link">
                                  </div>
                                </div>
                              </div>
                            
                        </div>
                    </div>

                    <div class="jy-card card mb-5 border card-shadow" style="border-radius: 16px;">
                        <div class="card-body p-5">
                            
                                <div class="dashboard-section media-inputs">
                                <div class="info-header clearfix form-group">
                                    <h4 class="d-inline-block"><i data-feather="map"></i> Location</h4>
                                    
                                </div>

                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Address</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control" value="<?php echo $company['address']; ?>" placeholder="Address" >
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">City</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="city" class="form-control" value="<?php echo $company['city']; ?>" placeholder="City" >
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
                                    <input type="text" name="pincode" class="form-control" value="<?php echo $company['pin_code']; ?>" placeholder="Pin Code" >
                                  </div>
                                </div>
                              </div>
                            
                        </div>
                    </div>

                    <div class="jy-card card mb-5 border card-shadow" style="border-radius: 16px;">
                        <div class="card-body p-5">
                            <form id="socialLinksProfileForm" class="dashboard-form" method="post" novalidate="novalidate">
                                <div class="dashboard-section social-inputs">
                                <div class="info-header clearfix form-group">
                                    <h4 class="d-inline-block"><i data-feather="link"></i> Social Networks</h4>
                                    
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

                </div>

                <div class="col-12 order-3">
                  <div class="dashboard-section posts-section">
                    <h5>Posts</h5>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-left">Title</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php if($company['posts']){ ?>
                            <?php foreach($company['posts'] as $post) { ?>
                              <tr>
                                <td class="text-left"><?php echo $post['title']; ?></td>
                                <td><?php echo ($post['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                <td>
                                  <a href="javascript:void(0)" class="button btn btn-primary edit-company"><span class="ti-pencil"></span></a>
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

<script src="<?php echo base_url('application/assets/js/countries.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('application/assets/js/include/admin/company.js'); ?>"></script>
 -->

<script>
        $(function(){
            
            //Dynamic country select
            populateCountries('country', 'state', '<?php echo $company["country"]; ?>', '<?php echo $company["state"]; ?>');

            var gst_number = '<?php echo $company["gst_no"]; ?>';
            var pan_number = '<?php echo $company["pan_no"]; ?>';

            //GP Block
            $('#gp-numblockz input[name=gpnumber]').click(function(){
              var numval = $(this).val();
              if(numval == 'gst'){
                $('#gp-numblockz .gst-numblock').show(400);
                $('#gp-numblockz .pan-numblock').hide();
              } else if(numval == 'pan'){
                $('#gp-numblockz .pan-numblock').show(400);
                $('#gp-numblockz .gst-numblock').hide();
              } else {
                $('#gp-numblockz .gst-numblock').hide();
                $('#gp-numblockz .pan-numblock').hide();
              }
            });

            if(pan_number && pan_number != ''){
              $('#gp-numblockz input[name=gpnumber].pannumber').trigger('click');
            } else if(gst_number && gst_number != ''){
              $('#gp-numblockz input[name=gpnumber].gstnumber').trigger('click');
            } else {
              $('#gp-numblockz input[name=gpnumber].nogpnumber').trigger('click');
            }
        })
    </script>