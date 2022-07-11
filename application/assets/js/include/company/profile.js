$(function(){

    // Autocomplete
    $('input[name=\'industry\']').autocomplete({
      'source': function(request, response) {
        if(request == ''){
          $('input[name=\'company_category\']').val('');
        }
        $.ajax({
          url: $base_url +'category/industrytype/autocomplete/' + request,
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
      },
      'select': function(item) {
        $('input[name=\'industry\']').val(item['label']);
        $('input[name=\'company_category\']').val(item['value']);
      }
    });


    function save_profile(form, href){

        $.ajax({
            url: href,
            type: 'post',
            data: $(form).serialize(),
            dataType: 'json',
            beforeSend: function(){
                // $(form).find('button[type=\'submit\']').attr('disabled', true).val($updating_txt);
                // $.FEED.setLoaderStatus($updating_txt);
                // $.FEED.showLoader();
            },
            success: function(res){
                if(res.success){
                    //$.ALERT.show('success', res.message);
                    Toast.fire({
                      icon: 'success',
                      title: res.message,
                    });
                    /*if(res.redirect){
                        window.location.href = res.redirect;
                    } else {
                        location.reload();
                    }*/
                } else if(res.error){
                    //$.ALERT.show('danger', res.message);
                    Toast.fire({
                      icon: 'danger',
                      title: res.message,
                    });
                } else {
                    //$.ALERT.show('danger', 'No Data');
                    Toast.fire({
                      icon: 'danger',
                      title: 'No Data',
                    });
                }
            },
            error: function(xhr){
                console.log(xhr.responseText + ' ' + xhr.statusText);
            },
            complete: function(){
                $(form).find('button[type=\'submit\']').attr('disabled', false).val('Save');
                $.FEED.setLoaderStatus('');
                $.FEED.hideLoader();
            }
        });
    }

    // Profile Form Validation
    $('#profileForm').validate({
      rules: {
        first_name: {
          required: true
        },
        last_name: {
          required: true
        },
      },
      messages: {
        first_name: "Please enter first name",
        last_name: "Please enter last name",
      },

      errorElement: "em",
      errorPlacement: function ( error, element ) {
        // Add the `invalid-feedback` class to the error element
        error.addClass( "invalid-feedback" );

        if ( element.prop( "type" ) === "checkbox" ) {
          error.insertAfter( element.next( "label" ) );
        } else {
          error.insertAfter( element );
        }
      },
      highlight: function ( element, errorClass, validClass ) {
        $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
      },
      unhighlight: function (element, errorClass, validClass) {
        $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
      },
      submitHandler: function(form) { save_profile(form, $base_url + 'company/profile/editName'); }
    });

    // profile company Form Validation
    $('#companyProfileForm').validate({
      onkeyup: function(element){
          $(element).valid();
      },
      onclick: function(element){
          $(element).valid();
      },
      rules: {
        company_name: {
          required: true
        },
        mobile_number: {
          required: true,
          digits: true,
          minlength: 10,
          maxlength: 10
        },
        landline: {
          digits: true,
          minlength: 10,
          maxlength: 10,
          required: true
        },
        pan_number: {
          alphanumeric: true,
          minlength: 10,
          maxlength: 10
        },
        gst_number: {
          alphanumeric: true,
          minlength: 15,
          maxlength: 15
        },
        pincode: {
          required: true,
          digits: true,
          minlength: 6,
          maxlength: 6,
          required: true
        },
        web_link: {
          url: true
        }
      },
      messages: {
        company_name: "Please enter company name",
        mobile_number: {
          required: "Please enter mobile number",
          digits: 'Please enter a valid mobile number',
          minlength: "Please enter 10 digits valid mobile number",
          maxlength: "Please enter 10 digits valid mobile number"
        },
        landline: {
          digits: 'Please enter a valid landline number',
          minlength: "Please enter 10 digits valid landline number",
          maxlength: "Please enter 10 digits valid landline number",
          company_name: "Please enter Phone Number name"
        },
        pan_number: {
          alphanumeric: "PAN number must be alpahanumeric",
          minlength: "Please enter 10 digits valid pan number",
          maxlength: "Please enter 10 digits valid pan number"
        },
        gst_number: {
          alphanumeric: "GST number must be alpahanumeric",
          minlength: "Please enter 15 digits valid GST number",
          maxlength: "Please enter 15 digits valid GST number"
        },
        pincode: {
          required: "Please enter pincode",
          digits: 'Please enter a valid pincode',
          minlength: "Please enter 6 digits valid pincode",
          maxlength: "Please enter 6 digits valid pincode",
          company_name: "Please enter Pincode"
        },
        web_link: {
          url: "Please enter valid url"
        }
      },

      errorElement: "em",
      errorPlacement: function ( error, element ) {
        // Add the `invalid-feedback` class to the error element
        error.addClass( "invalid-feedback" );

        if ( element.prop( "type" ) === "checkbox" ) {
          error.insertAfter( element.next( "label" ) );
        } else {
          error.insertAfter( element );
        }
      },
      highlight: function ( element, errorClass, validClass ) {
        $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
      },
      unhighlight: function (element, errorClass, validClass) {
        $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
      },
      submitHandler: function(form) { save_profile(form, $base_url + 'company/profile/editCompany'); }
    });

    $('#locationProfileForm').validate({
      onkeyup: function(element){
          $(element).valid();
      },
      onclick: function(element){
          $(element).valid();
      },
      rules: {
        address: {
          required: true
        },
        company_city: {
          required: true
        },
        country: {
          required: true
        },
        company_state: {
          required: true
        },
        pincode: {
          required: true,
          digits: true,
          minlength: 6,
          maxlength: 6,
          required: true
        }
      },
      messages: {
        address: "Please enter address",
        company_city: {
          required: "Please enter city"
        },
        country: {
          required: "Please enter country"
        },
        company_state: {
          required: "Please enter state"
        },
        pincode: {
          required: "Please enter pincode"
        }
      },

      errorElement: "em",
      errorPlacement: function ( error, element ) {
        // Add the `invalid-feedback` class to the error element
        error.addClass( "invalid-feedback" );

        if ( element.prop( "type" ) === "checkbox" ) {
          error.insertAfter( element.next( "label" ) );
        } else {
          error.insertAfter( element );
        }
      },
      highlight: function ( element, errorClass, validClass ) {
        $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
      },
      unhighlight: function (element, errorClass, validClass) {
        $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
      },
      submitHandler: function(form) { save_profile(form, $base_url + 'company/profile/editCompany'); }
    });

    $('#locationProfileForm').submit(function(e){
        e.preventDefault();
        save_profile('#locationProfileForm', $base_url + 'company/profile/editLocation');
    });

    $('#socialLinksProfileForm').submit(function(e){
        e.preventDefault();
        save_profile('#socialLinksProfileForm', $base_url + 'company/profile/editSocialLinks');
    });

    //Upload Profile Image
    // Show Upload image
    // function showFiles(element, files){
    //     if(files && files[0]){
    //         var reader = new FileReader();

    //         reader.onload = function(e){
    //             element.attr('src', e.target.result);
    //         }

    //         reader.readAsDataURL(files[0]);
    //     }
    // }

    // //Upload Files
    function uploadFiles(url, formdata){
        $.ajax({
            url : url,
            type: "POST",
            data : formdata,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress',function(e){
                    if(e.lengthComputable){
                        var percent = Math.round((e.loaded / e.total) * 100)+'%';
                        $.FEED.setLoaderStatus('uploading ' +percent);
                    }
                });
                return xhr;
            },
            beforeSend: function() {
                $.FEED.showLoader();
                $.FEED.setLoaderStatus('');
            },
            success:function(res){

                if(res.success){
                    //$.ALERT.show('success', res.message);
                    Toast.fire({
                      icon: 'success',
                      title: res.message,
                    });
                    $('#upload-profile-image input[name=\'profile_image\']').val('');
                }else if(res.error){
                    //$.ALERT.show('danger', res.message);
                    Toast.fire({
                      icon: 'danger',
                      title: res.message,
                    });
                }else{
                    //$.ALERT.show('danger', 'Error');
                    Toast.fire({
                      icon: 'danger',
                      title: 'Error',
                    });
                }
            },
            error:function(xhr,ajaxOptions,errorThrown){
                //$.ALERT.show('danger', 'Error');
                Toast.fire({
                  icon: 'danger',
                  title: 'Error',
                });
                console.log(xhr.statusText + ' ' + xhr.responseText);
            },
            complete: function() {
                $.FEED.hideLoader();
                $.FEED.setLoaderStatus('');
            }

        });
    }

    $('#upload-profile-image input[name=\'profile_image\']').change(function(e){
        var reader = new FileReader();
        var fileInput = $(this);
        let file = fileInput.get(0).files[0];

      
        reader.onload = function(e){
            // fileInput.parent().find('.preview-block').html('<img src="'+ e.target.result +'" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />');

            imageModal = '<div id="image-cropperjs">'+
                '<div class="cropper-body">'+
                    '<img src="'+ e.target.result +'" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />' +
                '</div>' +
            '</div>';

            Swal.fire({
                html: imageModal,
                customClass: {
                  popup: 'col-md-6 col-g-6'
                },
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: true,
                confirmButtonText:'<i class="mdi mdi-crop"></i> Crop',
                showCloseButton: true,
                didOpen: function(element){
                    // Cropper
                    var previewBlock = $('#image-cropperjs .cropper-body img');
                    previewBlock.cropper({
                      // aspectRatio: 16 / 9,
                      minCropBoxWidth: 150,
                      minCropBoxHeight: 150,
                      minCanvasWidth: 150,
                      minCanvasHeight: 150,
                      cropBoxResizable: false,
                      data: {
                        width:150,
                        height:150
                      },
                      // crop: function(event){}
                      // preview: fileInput.parent().find('.preview-block'),
                    });

                    
                }
            }).then(function(result){
                if(result.isConfirmed){
                    // Get the Cropper.js instance after initialized
                    var cropperz = $('#image-cropperjs .cropper-body img').data('cropper');
                    cropperz.crop();
                    var croppedCanvas = cropperz.getCroppedCanvas();
                    var croppedimage = croppedCanvas.toDataURL("image/png");
                    fileInput.parents('.profile-upload').find('.update-photo').html('<img src="'+ croppedimage +'" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />');

                    // fileInput.parents('.profile-upload').find('[name="profile_thumb"]').val(croppedimage);   

                    // console.log(new File([croppedimage], 'advt.png'));                             
                    // File Upload
                    var file_array = new FormData();
                    file_array.append('profile_image', croppedimage);

                    var url = $base_url + 'company/profile/save_picture';
                    // var thumb = fileInput.parent().parent().find('.update-photo .thumb');
                    // file_array.append('thumb', thumb.attr('data-picture'));

                    uploadFiles(url, file_array);
                }
            });

        }
        reader.readAsDataURL(file);
  });

});
