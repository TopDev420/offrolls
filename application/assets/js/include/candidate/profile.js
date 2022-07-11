$(function(){
    
  function save_profile(form){
      var redirectParam = '';
      if($redirect != '' && $redirect){
          redirectParam = '?redirect=' + $redirect;
      }
      
      $.ajax({
          url: $base_url + 'candidate/profile/edit' + redirectParam,
          type: 'post',
          data: $(form).serialize(),
          dataType: 'json',
          beforeSend: function(){
              $(form).find('button[type=\'submit\']').attr('disabled', true).val($updating_txt);
              $.FEED.setLoaderStatus($updating_txt);
              $.FEED.showLoader();
          },
          success: function(res){
              var reload = false; var redirect = false;
              if(res.success){
                  $.ALERT.show('success', res.message);
                  if(res.redirect){
                      setTimeout(function(){
                          window.location.href = res.redirect;
                      }, 1000);
                  } else {
                      location.reload();
                  }
                  var msgContent = '<div class="text-success h4">'+ res.message +'</div>';
                  if(res.redirect){
                      redirect = res.redirect;
                  } else {
                      reload = true;
                  }
                  
              } else if(res.error){
                  var msgContent = '<div class="text-danger h4">'+ res.message +'</div>';
              } else {
                  var msgContent = '<div class="text-danger h4">No Data</div>';
              }

              Swal.fire({
                html: msgContent,
                position: 'top-end',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true
              }).then(function(){
                  // if(redirect != ''){
                  //     window.location.href = redirect;
                  // }
                  if(reload == true){
                      location.reload();
                  }
              });
          },
          error: function(xhr){
              console.log(xhr.responseText + ' ' + xhr.statusText);
              Swal.fire({
                html: '<div class="text-danger h4">'+ xhr.statusText +'</div>',
                position: 'top-end',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true
              });
          },
          complete: function(){
              $(form).find('button[type=\'submit\']').attr('disabled', false).val('Save');
              $.FEED.setLoaderStatus('');
              $.FEED.hideLoader();
          }
      });
  }
  
  // Forgot Password Form Validation
      $('#candidateProfileForm').validate({
        rules: {
          first_name: {
            required: true,
            alphanumeric: true,
          },
          last_name:{
            required: true,
            alphanumeric: true,
          },
          mobile_number: {
            required: true,
            digits: true,
            minlength: 10,
            maxlength: 10
          },
          pincode: {
            required: true,
            digits: true,
            minlength: 6,
            maxlength: 6
          }
        },
        messages: {
          first_name:{ 
           required: "Please enter first name",
           alphanumeric: "please enter only alphanumeric"
          },
          last_name: {
            required: "Please enter last name",
            alphanumeric: "please enter only alphanumeric"
          }, 
          mobile_number: {
            required: "Please enter mobile number",
            digits: 'Please enter a valid mobile number',
            minlength: "Please enter 10 digits valid mobile number",
            maxlength: "Please enter 10 digits valid mobile number"
          },
          pincode: {
            required: "Please enter pincode",
            digits: 'Please enter a valid pincode',
            minlength: "Please enter 6 digits valid pincode",
            maxlength: "Please enter 6 digits valid pincode"
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
        submitHandler: function(form) { save_profile(form); }
      });
  
  
  //Upload Profile Image
  // Show Upload image
  function showFiles(element, files){
      if(files && files[0]){
          var reader = new FileReader();
          
          reader.onload = function(e){
              element.attr('src', e.target.result);
          }
          
          reader.readAsDataURL(files[0]);
      }
  }
  
  //Upload Files
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
                var msgContent = '<div class="text-success h4">'+ res.message +'</div>';
                $('#upload-profile-image input[name=\'profile_image\']').val('');
              }else if(res.error){
                  var msgContent = '<div class="text-danger h4">'+ res.message +'</div>';
              }else{
                var msgVontent = '<div class="text-danger h4">Error</div>';
              }

              Swal.fire({
                html: msgContent,
                position: 'top-end',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true
              });
          },
          error:function(xhr,ajaxOptions,errorThrown){
            var msgcontent = '<div class="text-danger h4">'+ xhr.statusText +'</div>';
            Swal.fire({
                html: msgContent,
                position: 'top-end',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true
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
                    }
                  });

                  
              }
          }).then(function(result){
              if(result.isConfirmed){
                  // Get the Cropper.js instance after initialized
                  var cropperz = $('#image-cropperjs .cropper-body img').data('cropper');
                  cropperz.crop();
                  var croppedCanvas = cropperz.getCroppedCanvas();
                  var croppedimage = croppedCanvas.toDataURL("image/png");
                  fileInput.parents('.upload-profile-photo').find('.update-photo').html('<img src="'+ croppedimage +'" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />');
                          
                  // File Upload
                  var file_array = new FormData();
                  file_array.append('profile_image', croppedimage);

                  var url = $base_url + 'candidate/profile/save_picture';
                  uploadFiles(url, file_array);
              }
          });

      }
      reader.readAsDataURL(file);
  });
  
});