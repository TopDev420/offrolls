<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/vendor/cropperjs/dist/cropper.css'); ?>">
<style>
  .jy-card .card-body svg {
    width: 15px;
    height: 15px;
  }

  #upload-profile-image .file-upload {
    background-color: #fff;
  }

  #upload-profile-image .file-upload svg {
    color: #246df8;
  }

  #custom-tooltip {
    display: none;
    margin-left: 40px;
    padding: 5px 12px;
    background-color: #000000df;
    border-radius: 4px;
    color: #fff;
  }
</style>

<div class="jy-card card mb-5 dashboard-section p-0 card-shadow">
  <div class="card-body p-4">
    <div class="manage-job-container table-responsive" style="overflow-x: hidden;">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <div class="dashboard-section upload-profile-photo box" id="upload-profile-image">
              <div class="update-photo img">
                <img class="image thumb" src="<?php echo $freelancer['thumb']; ?>" data-picture="<?php echo $freelancer['image'] ? $freelancer['image'] : 'thumb'; ?>" alt="">
              </div>
              <div class="file-upload card-shadow">
                <input type="file" name="profile_image" class="file-input"><i data-feather="edit"></i>
              </div>
            </div>
            <br>
            <p class="text-center"><small>(Upload square size image)</small></p>
          </div>

        </div>
        <div class="col-md-8" id="profile-info">
          <h4 class="primary-color mb-2"><b><?php echo $freelancer['first_name'] . ' ' . $freelancer['last_name']; ?></b></h4>
          <div class="mb-2">
            <!-- <span class="d-block">Web Developer</span> -->
            <input type="hidden" name="rating_points" value="0" />
            <div class="form-group">
              <div class="mb-2">
                <input type="hidden" class="rating" data-filled="mdi mdi-star font-3 text-primary" data-empty="mdi mdi-star-outline font-3 text-primary" data-fractions="2" value="<?php echo $freelancer['feedback']['ratings']; ?>" data-readonly />
              </div>
              <div class="button-tooltip-container mb-2">
                <input type="text" value="<?php echo $copy_profile_link; ?>" style="font-size:18px ;border: none; width:50%" id="myInput" readonly>
                <a href="javascript: myFunction()" style="font-size: 18px; padding:10px"><i class="far fa-copy"></i></a>
                <span id="custom-tooltip">copied!</sapn>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="mb-4">
            <p class="mb-4 text-center">Profile Status</p>
            <div class="ps-progress"><span><?php echo $user['progress'] . '%'; ?></span>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $user['progress']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <?php if (!$is_profileCompleted) { ?>
            <div>
              <p class="mandatory">Please fill the details to publish Profile</p>
            </div>
          <?php } else { ?>
            <?php if ($freelancer['is_published'] == 0) { ?>
              <div class="form-group">
                <button class="ps-btn ps-btn--sm" id="btn-publish-profile"><i data-feather="share"></i> Publish</button>
              </div>
            <?php } ?>
          <?php } ?>
          <button type="button" class="ps-btn ps-btn--sm" id="edit-profile"><i class="far fa-edit"></i> Edit</button>
        </div>
        <hr class="col-12" />
        <div class="col-12 clearfix">
          <p class="d-inline mr-4 mb-2" style="padding: 4px;">
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

  <!-- Modal -->
  <div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                    <label class="col-sm-3 control-label mandatory">Last Name :</label>
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
                    <label class="col-sm-3 col-form-label mandatory">Address</label>
                    <div class="col-sm-9">
                      <input type="text" name="address" class="form-control address" autocomplete="off">
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
                      <input type="text" id="input-search-state" name="state_label" class="form-control" value="<?php echo $freelancer['state']; ?>" autocomplete="off" placeholder="State">
                      <input type="hidden" name="state" value="<?php echo $freelancer['state']; ?>" class="form-control" />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label mandatory">City</label>
                    <div class="col-sm-9">
                      <input type="text" id="input-search-city" name="city_label" class="form-control" value="<?php echo $freelancer['city']; ?>" placeholder="City" autocomplete="off">
                      <input type="hidden" name="city" value="<?php echo $freelancer['city']; ?>" class="form-control" />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label mandatory">Pin Code</label>
                    <div class="col-sm-9">
                      <input type="text" name="pin_code" class="form-control pincode" autocomplete="off" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9">
                  <div class="button-group">
                    <button type="submit" class="ps-btn ps-btn--outline small">Save</button>
                    <button type="button" class="ps-btn small" data-dismiss="modal">Cancel</button>
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

<!-- Cropper.js -->
<?php $this->document->addScript(base_url('application/assets/vendor/cropperjs/dist/cropper.js'), 'footer'); ?>
<?php $this->document->addScript(base_url('application/assets/vendor/jquery-cropper/dist/jquery-cropper.js'), 'footer'); ?>
<?php $this->document->addScript(base_url('application/assets/js/include/freelancer/profile.js'), 'footer'); ?>

<script>
  function myFunction() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    //document.execCommand("copy");
    document.getElementById("custom-tooltip").style.display = "inline";
    document.execCommand("copy");
    setTimeout(function() {
      document.getElementById("custom-tooltip").style.display = "none";
    }, 1000);
  }
</script>

<script>
  $(function() {

    //Job Location Autocomplete
    $('#input-search-state').autocomplete({
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
        $('#input-search-state').val(item['label']);
        $('input[name=\'state\']').val(item['value']);
      }
    });

    $('#input-search-city').autocomplete({
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
        $('#input-search-city').val(item['label']);
        $('input[name=\'city\']').val(item['value']);
      }
    });

  })
</script>