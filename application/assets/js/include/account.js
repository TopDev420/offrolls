//Account Login
$(document).ready(function () {
    var userlogin = $('#userLoginForm');

    function doLogin() {
        var button_txt = userlogin.find('button[type=submit]').html();
        $.ajax({
            type: "POST",
            url: $base_url + 'login',
            dataType: "JSON",
            data: userlogin.serialize(),
            beforeSend: function () {
                userlogin.find('button[type=submit]').html($loading_txt).attr('disabled', true);
                $.FEED.showLoader();
            },
            success: function (res) {
                if (res.success) {
                    //$.ALERT.show('success', res.message, redirect=true);
                    Toast.fire({
                        icon: 'success',
                        title: res.message,
                        text: 'Redirecting...',
                        timer: false
                    });
                    if (res.redirect) {
                        setTimeout(function () { window.location.href = res.redirect; }, 1000);
                    }
                } else if (res.error) {
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
            error: function (xhr, statusText, errorThrown) {
                //$.ALERT.show('danger', xhr.statusText);
                Toast.fire({
                    icon: 'error',
                    title: xhr.statusText
                });
            },
            complete: function () {
                userlogin.find('button[type=submit]').html(button_txt).attr('disabled', false);
                $.FEED.hideLoader();
            }
        });
    }

    var uloginValidator = $("#userLoginForm").validate({
        // Specify validation rules
        rules: {
            user_email: {
                required: true,
            },
            user_password: {
                required: true,
            },
        },
        messages: {
            user_email: {
                required: "Please enter valid Email",
            },
            user_password: {
                required: "Please enter Password",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.parents('.ele--jqvalid').append(error);
        },
        submitHandler: function (form) {
            if (navigator.onLine) {
                doLogin();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'No internet connection'
                });
            }
        }
    });


    $('#btn-sso-googleLogin').click(function (e) {
        e.preventDefault();
        var rurl = $(this).attr('href');

        if (navigator.onLine) {
            $.ajax({
                url: $base_url + 'login/sso/google?sform=login',
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    $.FEED.showLoader();
                },
                success: function (res) {
                    if (res.success) {
                        //$.ALERT.show('success', 'Signin with Google <br> <p>redirecting...</p>');
                        Toast.fire({
                            icon: 'success',
                            title: 'Signin with Google <br> <p>redirecting...</p>',
                        });
                        if (res.data) {
                            setTimeout(function () {
                                window.location.href = res.data.link;
                            }, 1000);
                        }
                    } else if (res.error) {
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
                error: function (xhr, statusText, errorThrown) {
                    //$.ALERT.show('danger', xhr.statusText);
                    Toast.fire({
                        icon: 'success',
                        title: xhr.statusText,
                    });
                },
                complete: function () {
                    $.FEED.hideLoader();
                }
            });
        } else {
            //$.ALERT.show('danger', 'No internet connection');
            Toast.fire({
                icon: 'error',
                title: 'No internet connection'
            });
        }

    });

});

//Account Register
$(function () {
    // Ordinary Register
    function doRegister(form, url) {
        $.ajax({
            url: url,
            type: "POST",
            data: $(form).serialize(),
            dataType: 'json',
            beforeSend: function () {
                $.FEED.showLoader();
            },
            success: function (res) {
                if (res.success) {
                    $(form).trigger('reset');
                    Toast.fire({
                        icon: 'success',
                        title: res.message,
                        text: 'Redirecting...',
                        timer: false
                    });
                    setTimeout(function () {
                        if(res.redirect){
                        window.location.href = res.redirect;
                        } else {
                            window.location.href = $base_url + 'register/success';
                        }
                    }, 1500);
                } else if (res.error) {
                    Toast.fire({
                        icon: 'error',
                        title: res.message
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'No Data'
                    });
                }
            },
            error: function (xhr, statusText, errorThrown) {
                Toast.fire({
                    icon: 'error',
                    title: xhr.statusText
                });
            },
            complete: function () {
                $.FEED.hideLoader();
            }
        });
    }

    //Company Register button click
    $('#btn-homeregister-company').click(function (e) {
        e.preventDefault();
        $('.modal').modal('hide');
        $('#userregister').find('input[name=\'user_type\']').attr({ 'checked': true, 'disabled': false });
        reset_registerform();

        $('#registerModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        $('#registerModal .close').click(function () {
            reset_registerform();
        });
    });


    jQuery.validator.addMethod('ageLimit', function (value, element) {
        var cdate = new Date();
        var evalue = value.split('/');
        evalue.reverse();
        var envalue = evalue.join('-');
        var edate = new Date(envalue);
        var diff = cdate - edate;

        var years = Math.floor(diff / 31536000000);
        if (years >= $minAge) {
            return true;
        } else {
            return false;
        }

    }, "Age must be above or equal to 35 years");

   
    $("#userRegisterForm").validate({
        // Specify validation rules
        rules: {
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: $base_url + 'register/check_email',
                    type: "POST",
                },
            },
            user_mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            user_terms: {
                required: true
            },
            user_type: {
                required: true
            }
        },
        messages: {
            user_email: {
                required: "Please enter valid Email",
                email: "Please enter valid email",
                remote: "Email already used, Please enter another Email",
            },
            user_mobile: {
                required: "Please enter mobile number",
                digits: 'Please enter a valid mobile number',
                minlength: "Please enter 10 digits valid mobile number",
                maxlength: "Please enter 10 digits valid mobile number"
            },
            user_terms: {
                required: "Please accept the terms and conditions"
            },
            user_type: {
                required: "Please choose your account type"
            }
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.parents('.ele--jqvalid').append(error);
        },
        submitHandler: function (form) {
            if (navigator.onLine) {
                if ($sso_register) {
                    doRegister(form, $base_url + 'register/sso_account');
                } else {
                    doRegister(form, $base_url + 'register');
                }
            } else {
                //$.ALERT.show('danger', 'No internet connection');
                Toast.fire({
                    icon: 'error',
                    title: 'No internet connection'
                });
            }
        }
    });

    if($sso_register){
        $( "#userRegisterForm" ).find('[name="user_password"]').rules("remove");
        $( "#userRegisterForm" ).find('[name="user_repassword"]').rules("remove");
    } else {
    $( "#userRegisterForm" ).find('[name="user_password"]').rules( "add", {
        required: true,
        messages: {
          required:  "Please enter Password",
        }
      });

      $( "#userRegisterForm" ).find('[name="user_repassword"]').rules( "add", {
        required: true,
        equalTo: user_password,
        messages: {
           required: "Please Re-enter Password"
        }
      });
    }


    //Password field eye open/close function
    $('[data-password-eyeaction=true]').click(function (e) {
        e.preventDefault();
        var current = $(this);
        var par = current.parents('.password-actionz');
        var epa = par.find('input[data-epa=true]');
        if (epa.attr('type') == 'password') {
            epa.attr('type', 'text');
            current.html('<i data-feather="eye"></i>');
        } else {
            epa.attr('type', 'password');
            current.html('<i data-feather="eye-off"></i>');
        }

        feather.replace(); // Load Feather icons
    });



    //SSO Register
    function loadSSORegister(rurl, sso_type) {
        if (navigator.onLine) {
            $.ajax({
                url: rurl,
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    $.FEED.showLoader();
                },
                success: function (res) {
                    if (res.success) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Signup with ' + sso_type.toUpperCase(),
                            text: 'Redirecting...',
                            timer: 1000
                        }).then(function () {
                            if (res.data) {
                                window.location.href = res.data.link;
                            }
                        });
                    } else if (res.error) {
                        Toast.fire({
                            icon: 'error',
                            title: res.message
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'No Data'
                        });
                    }
                },
                error: function (xhr, statusText, errorThrown) {
                    Toast.fire({
                        icon: 'error',
                        title: xhr.statusText
                    });
                },
                complete: function () {
                    $.FEED.hideLoader();
                }
            });
        } else {
            Toast.fire({
                icon: 'error',
                title: 'No internet connection'
            });
        }
    }

    $('#btn-sso-googleRegister').click(function (e) {
        e.preventDefault();
        var rurl = $base_url + 'register/sso/google?sform=register';
        loadSSORegister(rurl, 'google');
    });

    $('#btn-sso-linkedinRegister').click(function (e) {
        e.preventDefault();
        var rurl = $base_url + 'register/sso/linkedin?sform=register'
        loadSSORegister(rurl, 'linkedin');
    });



});
