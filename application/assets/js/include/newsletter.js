$(function(){
    
    //Newsletter
    function doSubscribe(form){
        
        $.ajax({
            url: $base_url + 'newsletter/subscribe',
            type: 'post',
            data: $(form).serialize(),
            dataType: 'json',
            beforeSend: function(){
                $(form).find('button[type=\'submit\']').attr('disabled', true);
                $.FEED.showLoader();
            },
            success: function(res){
                if(res.success){
                    $(form)[0].reset();
                    //$.ALERT.show('success', res.message);
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });
                } else if(res.error){
                    //$.ALERT.show('danger', res.message);
                    Toast.fire({
                        icon: 'error',
                        title: res.message
                    });
                } else {
                    //$.ALERT.show('danger', 'No Data');
                    Toast.fire({
                        icon: 'error',
                        title: 'No Data'
                    });
                }
            },
            error: function(xhr,ajaxOptions, errorThrown){
                console.log(xhr.responseText + ' - ' + xhr.statusText);
            },
            complete: function(){
                $(form).find('button[type=\'submit\']').attr('disabled', false);
                $.FEED.hideLoader();
            }
        });
    }
    
    $("#job-newsletter").validate({
        onkeyup: function(element){$(element).valid();},
        onclick: function(element){$(element).valid();},
        // Specify validation rules
        rules: {
            user_email: {
                required: true,
                email: true,
            }
        },
        messages: {
            user_email: {
                required: "Please enter an Email",
                email: 'Please enter a valid email'
            }
        },
        errorPlacement: (error, element) => {
            error.addClass( "invalid-feedback" );
            error.appendTo(element.parents('.ele-jqValid'));
        },
        submitHandler: function(form) {
            doSubscribe(form);
        }
    });
        
});