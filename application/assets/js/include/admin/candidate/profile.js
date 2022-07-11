$(function(){
    
    function save_profile(form){
        var redirectParam = '';
        if($redirect != '' && $redirect){
            redirectParam = '?redirect=' + $redirect;
        }
        
        $.ajax({
            url: $base_url + 'admin/candidate/profile/edit' + redirectParam,
            type: 'post',
            data: $(form).serialize(),
            dataType: 'json',
            beforeSend: function(){
                $(form).find('button[type=\'submit\']').attr('disabled', true).val($updating_txt);
                $.FEED.setLoaderStatus($updating_txt);
                $.FEED.showLoader();
            },
            success: function(res){
                if(res.success){
                    $.ALERT.show('success', res.message);
                    if(res.redirect){
                        setTimeout(function(){
                            window.location.href = res.redirect;
                        }, 1000);
                    } else {
                        location.reload();
                    }
                } else if(res.error){
                    $.ALERT.show('danger', res.message);
                } else {
                    $.ALERT.show('danger', 'No Data');
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
    
    // Forgot Password Form Validation
        $('#candidateProfileForm').validate({
          rules: {
            first_name: {
              required: true
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
            first_name: "Please enter first name",
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
    function uploadFiles(thumb, url, formdata){
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
                    $.ALERT.show('success', res.message);
                    if(res.picture){
                        thumb.attr('src', res.picture_path);
                        thumb.attr('data-picture', res.picture);
                        setTimeout(function(){location.reload();},1000);
                    }
                }else if(res.error){
                    $.ALERT.show('danger', res.message);
                }else{
                    $.ALERT.show('danger', 'Error');
                }
            },
            error:function(xhr,ajaxOptions,errorThrown){
                $.ALERT.show('danger', 'Error');
                console.log(xhr.statusText + ' ' + xhr.responseText);
            },
            complete: function() {
                $.FEED.hideLoader();
                $.FEED.setLoaderStatus('');
            }
            
        });
    }
    
    $('#upload-profile-image input[name=\'profile_image\']').change(function(e){
        e.preventDefault();
        showFiles($(this), e.target.files);
        var file_array = new FormData();
        file_array.append('profile_image', e.target.files[0]);
        
        var url = formUrl('admin/candidate/profile/save_picture', {candidate_id:candidate_id});
        var thumb = $(this).parent().parent().find('.update-photo .thumb');
        file_array.append('thumb', thumb.attr('data-picture'));
        
        uploadFiles(thumb, url, file_array);
    });
    
    
    
});