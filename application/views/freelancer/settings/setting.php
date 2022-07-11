<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/vendor/cropperjs/dist/cropper.css'); ?>">
<!-- Menubar -->
<?php include APPPATH . 'views/freelancer/include/menubar.php'; ?>
<!-- Menubar End -->

<!-- Navbar -->
<?php include APPPATH . 'views/freelancer/include/navbar.php'; ?>
<!-- Navbar Ends-->

<!--include search-sidebar-->
<div class="ps-page" id="dashboard">
  <div class="ps-section--sidebar ps-layout">
    <div class="container">
      <div class="ps-section__container">
        <div class="ps-section__content">
          <form class="ps-form--settings" method="post" id="freelancer-genreal-details">
            <figure>
              <h3 class="ps-heading--2">Settings /<span class="ps-highlight"> General</span></h3>
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                  <div class="form-group form-group--photo">
                    <label>Photo</label>
                    <div class="form-group--avatar" id="upload-profile-image">
                      <div class="form-group__left"><img src="<?php echo $freelancer['thumb']; ?>" data-picture="<?php echo $freelancer['image'] ? $freelancer['image'] : 'thumb'; ?>" alt=""></div>
                      <div class="form-group__right">
                        <input type="file" name="profile_image" id="upload" class="file-input" style="display: none">
                        <a class="ps-btn ps-btn--white ps-btn--shadow upload-link" href=""><i class="fa fa-camera-retro"></i> Change Photo</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>First Name</label>
                    <input class="form-control" name="first_name" value="<?php echo $freelancer['first_name']; ?>" type="text" placeholder="">
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input class="form-control" name="last_name" value="<?php echo $freelancer['last_name']; ?>" type="text" placeholder="">
                  </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>Address</label>
                    <input class="form-control" type="text" name="address" value="<?php echo $freelancer['address']; ?>" placeholder="">
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="form-control ps-select" name="country" id="country"></select>
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>State</label>
                    <input class="form-control" name="state_label" id="input-search-state" value="<?php echo $freelancer['state']; ?>" type="text" placeholder="">
                    <input type="hidden" name="state_value" value="<?php echo $freelancer['state']; ?>" class="form-control" />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>City</label>
                    <input class="form-control" name="city_label" id="input-search-city" value="<?php echo $freelancer['city']; ?>" type="text" placeholder="">
                    <input type="hidden" name="city_value" value="<?php echo $freelancer['state']; ?>" class="form-control" />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>Pincode</label>
                    <input class="form-control" name="pin_code" value="<?php echo $freelancer['pin_code']; ?>" type="text" placeholder="" autocomplete="off">
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>Facebook Link</label>
                    <input type="text" name="social_profiles[facebook]" class="form-control" value="<?php echo $freelancer['facebook_profile']; ?>" placeholder="facebook.com/username">
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>Instagram Link</label>
                    <input type="text" name="social_profiles[instagram]" class="form-control" value="<?php echo $freelancer['instagram_profile']; ?>" placeholder="instagram.com/username">
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                  <div class="form-group">
                    <label>Linkedin Link</label>
                    <input type="text" name="social_profiles[linkedin]" class="form-control" value="<?php echo $freelancer['linkedin_profile']; ?>" placeholder="linkedin.com/username">
                  </div>
                </div>
              </div>
            </figure>
            <div class="ps-form__submit">
              <!-- <button class="ps-btn ps-btn--white ps-btn--shadow ps-btn--sm" type="reset">Cancel</button> -->
              <button class="ps-btn ps-btn--gradient ps-btn--sm" type="submit">Save</button>
            </div>
          </form>
        </div>
        <div class="ps-section__sidebar">
          <aside class="widget widget_profile widget_list">
            <h3 class="widget-title">Settings</h3>
            <ul class="ps-list">
              <li><a href="<?php echo base_url() . 'freelancer/setting'; ?>">General infomation</a></li>
              <li><a href="<?php echo base_url() . 'freelancer/setting/freelancerPyamentDetails'; ?>">Billing & Payments</a></li>
              <li><a href="<?php echo base_url() . 'freelancer/setting/passwordChangeInfo'; ?>">Password & Security</a></li>
              <li><a href="#">Notification Settings</a></li>
              <li><a href="<?php echo base_url() . 'freelancer/setting/taxInformations'; ?>">Tax Informations</a></li>
            </ul>
          </aside>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url('application/assets/js/countries.js'); ?>"></script>
<?php $this->document->addScript(base_url('application/assets/vendor/cropperjs/dist/cropper.js'), 'footer'); ?>
<?php $this->document->addScript(base_url('application/assets/vendor/jquery-cropper/dist/jquery-cropper.js'), 'footer'); ?>


<script>
  $(function() {

    //Dynamic country select
    populateCountries('country', '', '<?php echo $freelancer["country"]; ?>', '');

    $(document).on("click", ".upload-link", function(e) {
      e.preventDefault();
      $("#upload:hidden").trigger('click');
    });

    //Upload Files
    function uploadFiles(url, formdata) {
      $.ajax({
        url: url,
        type: "POST",
        data: formdata,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        xhr: function() {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function(e) {
            if (e.lengthComputable) {
              var percent = Math.round((e.loaded / e.total) * 100) + "%";
              $.FEED.setLoaderStatus("uploading " + percent);
            }
          });
          return xhr;
        },
        beforeSend: function() {
          $.FEED.showLoader();
          $.FEED.setLoaderStatus("");
        },
        success: function(res) {
          if (res.success) {
            var msgContent =
              '<div class="text-success h4">' + res.message + "</div>";
            $("#upload-profile-image input[name='profile_image']").val("");
          } else if (res.error) {
            var msgContent =
              '<div class="text-danger h4">' + res.message + "</div>";
          } else {
            var msgVontent = '<div class="text-danger h4">Error</div>';
          }

          Swal.fire({
            html: msgContent,
            position: "top-end",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            showCloseButton: true,
            timer: 3000,
            timerProgressBar: true,
          });
        },
        error: function(xhr, ajaxOptions, errorThrown) {
          var msgcontent =
            '<div class="text-danger h4">' + xhr.statusText + "</div>";
          Swal.fire({
            html: msgContent,
            position: "top-end",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            showCloseButton: true,
            timer: 3000,
            timerProgressBar: true,
          });
          console.log(xhr.statusText + " " + xhr.responseText);
        },
        complete: function() {
          $.FEED.hideLoader();
          $.FEED.setLoaderStatus("");
        },
      });
    }

    $("#upload-profile-image input[name='profile_image']").change(function(e) {
      var reader = new FileReader();
      var fileInput = $(this);
      let file = fileInput.get(0).files[0];

      reader.onload = function(e) {
        // fileInput.parent().find('.preview-block').html('<img src="'+ e.target.result +'" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />');

        imageModal =
          '<div id="image-cropperjs">' +
          '<div class="cropper-body">' +
          '<img src="' +
          e.target.result +
          '" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />' +
          "</div>" +
          "</div>";

        Swal.fire({
          html: imageModal,
          customClass: {
            popup: "col-md-6 col-g-6",
          },
          allowOutsideClick: false,
          allowEscapeKey: false,
          showConfirmButton: true,
          confirmButtonText: '<i class="mdi mdi-crop"></i> Crop',
          showCloseButton: true,
          didOpen: function(element) {
            // Cropper
            var previewBlock = $("#image-cropperjs .cropper-body img");
            previewBlock.cropper({
              // aspectRatio: 16 / 9,
              minCropBoxWidth: 150,
              minCropBoxHeight: 150,
              minCanvasWidth: 150,
              minCanvasHeight: 150,
              cropBoxResizable: false,
              data: {
                width: 150,
                height: 150,
              },
            });
          },
        }).then(function(result) {
          if (result.isConfirmed) {
            // Get the Cropper.js instance after initialized
            var cropperz = $("#image-cropperjs .cropper-body img").data(
              "cropper"
            );
            cropperz.crop();
            var croppedCanvas = cropperz.getCroppedCanvas();
            var croppedimage = croppedCanvas.toDataURL("image/png");
            fileInput
              .parents(".upload-profile-photo")
              .find(".update-photo")
              .html(
                '<img src="' +
                croppedimage +
                '" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />'
              );

            // File Upload
            var file_array = new FormData();
            file_array.append("profile_image", croppedimage);

            var url = $base_url + "freelancer/profile/save_picture";
            uploadFiles(url, file_array);
          }
        });
      };
      reader.readAsDataURL(file);
    });


    //Job Location Autocomplete
    $('input[name=\'state_label\']').autocomplete({
      'source': function(request, response) {
        if (request == '') {
          $('input[name=\'state_value\']').val('');
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
        $('input[name=\'state_label\']').val(item['label']);
        $('input[name=\'state_value\']').val(item['value']);
      }
    });

    $('input[name=\'city_label\']').autocomplete({
      'source': function(request, response) {
        if (request == '') {
          $('input[name=\'city_value\']').val('');
        }
        // if(request.length > 1){
        $.ajax({
          url: $base_url + 'category/location/autocomplete/' + request + '?state=' + $('input[name=\'state_value\']').val(),
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
        $('input[name=\'city_label\']').val(item['label']);
        $('input[name=\'city_value\']').val(item['value']);
      }
    });

    // Profile Form Validation
    var formProfile = $("#freelancer-genreal-details").validate({
      rules: {
        first_name: {
          required: true,
        },
        last_name: {
          required: true,
        },
        address: {
          required: true,
        },
        country: {
          required: true,
        },
        state_label: {
          required: true,
        },
        city_label: {
          required: true,
        },
        pin_code: {
          required: true,
          digits: true,
          minlength: 6,
          maxlength: 6,
        },
      },
      messages: {
        first_name: "Please enter first name",
        last_name: "Please enter last name",
        address: "Please enter address",
        country: "Please enter country",
        state: "please enter state",
        city: "Please enter first name",
        pin_code: {
          required: "Please enter pincode",
          digits: "Please enter a valid pincode",
          minlength: "Please enter 6 digits valid pincode",
          maxlength: "Please enter 6 digits valid pincode",
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

    });

    $('#freelancer-genreal-details').submit(function(e) {
      e.preventDefault();
      if ($('#freelancer-genreal-details').valid()) {
        $.ajax({
          url: $base_url + "freelancer/setting/edit",
          type: "post",
          data: $('#freelancer-genreal-details').serialize(),
          dataType: "json",
          beforeSend: function() {},
          success: function(res) {
            var reload = false;
            if (res.success) {

              var msgContent =
                '<div class="text-success h4">' + res.message + "</div>";
              reload = true;
            } else if (res.error) {
              var msgContent =
                '<div class="text-danger h4">' + res.message + "</div>";
            } else {
              var msgContent = '<div class="text-danger h4">No Data</div>';
            }

            Swal.fire({
              html: msgContent,
              position: "top-end",
              allowOutsideClick: false,
              allowEscapeKey: false,
              showConfirmButton: false,
              showCloseButton: true,
              timer: 3000,
              timerProgressBar: true,
            }).then(function() {
              if (reload == true) {
                location.reload();
              }
            });
          },
          error: function(xhr) {
            console.log(xhr.responseText + " " + xhr.statusText);
            Swal.fire({
              html: '<div class="text-danger h4">' + xhr.statusText + "</div>",
              position: "top-end",
              allowOutsideClick: false,
              allowEscapeKey: false,
              showConfirmButton: false,
              showCloseButton: true,
              timer: 3000,
              timerProgressBar: true,
            });
          },
          complete: function() {},
        });
      }
    });

  });
</script>