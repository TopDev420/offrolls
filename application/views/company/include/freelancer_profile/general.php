<style>
    .jy-card .card-body svg {
        width: 15px;
        height: 15px;
    }

    #upload-profile-image .file-upload {
        background-color: #fff;
    }

    #upload-profile-image .file-upload svg{
        color: #246df8;
    }
</style>

<div class="jy-card card mb-5 dashboard-section p-0 card-shadow">
    <div class="card-body p-4">
       <div class="manage-job-container table-responsive" style="overflow-x: hidden;">
          <div class="row">
             <div class="col-md-2">
                <div class="dashboard-section upload-profile-photo box" id="upload-profile-image">
                    <div class="update-photo img">
                      <img class="image thumb" src="<?php echo $freelancer['thumb']; ?>" data-picture="<?php echo $freelancer['image'] ? $freelancer['image'] : 'thumb'; ?>" alt="">
                    </div>
      
                </div>
                <br>
             </div>
             <div class="col-md-8">
                <h4 class="primary-color mb-2" style="color: #A7A4A2 !important;"><b><?php echo $freelancer['first_name'] . ' ' . $freelancer['last_name']; ?></b></h4>
                <div class="mb-2">
                    <span class="d-block">Web Developer</span>
                    <div class="rate-content">
                       <i data-feather="star"></i>
                       <i data-feather="star"></i>
                       <i data-feather="star"></i>
                       <i data-feather="star"></i>
                       <i data-feather="star"></i>
                    </div>
                </div>
             </div>
             
             <hr class="col-12" />
             <div class="col-12 clearfix">
               <p class="d-inline mr-4 mb-2" style="margin-left: 190px;padding: 4px;">
                  <i style="color: green !important;" data-feather="phone"></i> <?php echo $freelancer['mobile']; ?>
               </p>

               <p class="d-inline mr-4 mb-2" style="padding: 4px;">
                  <i style="color: green !important;" data-feather="mail"></i> <?php echo $freelancer['email']; ?>
               </p>

               <p class="d-inline mr-4 mb-2" style="padding: 4px;">
                  <i style="color: green !important;" data-feather="map-pin"></i> <?php echo $freelancer['city']; ?>
               </p>
               
            </div>
          </div>
       </div>
    </div>

    <div class="card-body p-4" style="background-image: linear-gradient(to right, #328D81 , #3460A0); padding: 5px !important;">
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
                <div class="title">
                    <h4><i data-feather="user"></i> Profile</h4>
                </div>
                <div class="content">
                    <form action="#" id="candidateProfileForm" method="post">
                      <div class="input-block-wrap">
                        <div class="dashboard-section basic-info-input">
                            <div class="form-group row">
                              <label class="col-sm-3 control-label mandatory">First Name :</label>
                              <div class="col-sm-8">
                                  <input type="text" name="first_name" class="form-control first-name" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-3 control-label">Last Name :</label>
                              <div class="col-sm-8">
                                  <input type="text" name="last_name" class="form-control last-name" />
                              </div>
                            </div>

                            <div class="form-group row fieldz">
                              <label class="col-sm-3 col-form-label mandatory">Mobile</label>
                              <div class="col-sm-9">
                                  <input type="text" name="mobile" class="form-control mobile" />
                              </div>
                            </div>
                        </div>

                        <div class="dashboard-section media-inputs">

                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Address</label>
                              <div class="col-sm-9">
                                <input type="text" name="address" class="form-control address">
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
                              <label class="col-sm-3 col-form-label mandatory">City</label>
                              <div class="col-sm-9">
                                <input type="text" name="city" class="form-control city" />
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label mandatory">Pin Code</label>
                              <div class="col-sm-9">
                                <input type="text" name="pin_code" class="form-control pincode" />
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-9">
                          <div class="button-group">
                            <button type="submit" class="button-default small-sm primary-bg white-text">Save</button>
                            <button type="button" class="button-default small-sm alice-bg border-secondary" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div>

</div>



<script src="<?php echo base_url('application/assets/js/countries.js'); ?>"></script>

<?php $this->document->addScript(base_url('application/assets/js/include/company/freelancer/profile.js'), 'footer'); ?>

