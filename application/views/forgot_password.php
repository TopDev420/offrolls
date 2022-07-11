<!-- Menubar -->
<?php include APPPATH . 'views/include/menubar.php'; ?>
<!-- Menubar End -->

<div class="section-default-header"></div>
<div class="ps-page">
  <div class="ps-section--sidebar ps-listing dashboard">
    <div class="container">
      <div class="ps-section__container" style="margin:10rem 0">
        <div class="row align-items-center justify-content-center">
          <div class="col-xl-5 col-md-6">
            <div class="alert-wrap mb-4"></div>
            <div class="card card-body access-form p-4">
              <div class="form-header">
                <h5><i data-feather="user"></i>Forgot Password</h5>
              </div>
              <form id="forgotPasswordForm" action="<?php echo base_url() . 'forgotpassword/sendEmailOTP'; ?>" method="post">
                <div class="form-group">
                  <input type="email" name="user_email" placeholder="Email Address" class="form-control" required>
                </div>

                <button type="submit" class="ps-btn ps-btn--sm btn-block">Send OTP</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Reset Password Form-->
<div id="user-reset-card" style="display:none;">
  <form id="resetPasswordForm" action="<?php echo base_url() . 'forgotpassword/reset'; ?>" method="post">
    <div class="form-group password-actionz">
      <input type="password" name="new_password" data-epa="true" id="new_password" placeholder="New Password" class="form-control" required>
      <span data-password-eyeaction="true" class="btn-password-actionz input-group-append"><i data-feather="eye-off"></i></span>
    </div>

    <div class="form-group password-actionz">
      <input type="password" name="confirm_password" data-epa="true" placeholder="Confirm Password" class="form-control" required>
      <span data-password-eyeaction="true" class="btn-password-actionz input-group-append"><i data-feather="eye-off"></i></span>
    </div>

    <button type="submit" class="ps-btn ps-btn--sm btn-block">Reset</button>
  </form>
</div>

<script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('application/assets/js/alert.js'); ?>"></script>

<script type="text/javascript">
  $(function() {
    // Forgot Password Form Validation
    $('#forgotPasswordForm').validate({
      rules: {
        user_email: {
          required: true,
          email: true
        },
      },
      messages: {
        user_email: "Please enter a valid email address",
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
      submitHandler: function(form) {
        sendEmailOTP(form);
      }
    });

    //Forgot password - check email and send OTP to mail
    function sendEmailOTP(form) {
      var semail = $(form).find('input[name=user_email]').val();
      var fparent = $(form).parent();

      $.ajax({
        url: $(form).attr('action'),
        type: 'post',
        dataType: 'json',
        data: $(form).serialize(),
        beforeSend: function() {
          $.FEED.showLoader();
          $(form).find('button[type=submit]').attr('disabled', true);
        },
        success: function(res) {
          if (res.success) {
            $.ALERT.show('success', res.success);
            $(form).fadeOut(200).remove();
            load_otp_view(fparent, semail); //Load OTP View
          } else if (res.error) {
            $.ALERT.show('danger', res.error);
          } else {
            console.log('No Values');
          }
        },
        error: function(xhr, ajaxOptions, errorThown) {
          console.log('Ajax error' + ' - ' + xhr.statusText);
        },
        complete: function() {
          $.FEED.hideLoader();
          $(form).find('button[type=submit]').attr('disabled', false);
        }
      });
    }





    // OTP VIEW
    function load_otp_view(fparent, email) {
      otp_view = '<form id="verifyOTPForm" action="<?php echo base_url() . 'forgotpassword/verifyEmailOTP'; ?>" method="post">' +
        '<div class="form-group">' +
        '<label class="form-control" diasbled>' + email + '</label>' +
        '<input type="hidden" name="user_email" />' +
        '</div>' +
        '<div class="form-group">' +
        '<input type="text" name="user_otp" placeholder="OTP" class="form-control" required>' +
        '</div>' +
        '<button type="submit" class="ps-btn ps-btn--sm btn-block">Verify OTP</button>';

      fparent.append(otp_view);

      load_otp_view_functions();
    }

    //OTP VIEW FUNCTION
    function load_otp_view_functions() {
      //VerifyOTP form validation
      $('#verifyOTPForm').validate({
        rules: {
          user_otp: {
            required: true,
            maxlength: 6
          },
        },
        messages: {
          user_otp: "Please enter a valid OTP",
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
        submitHandler: function(form) {
          verifyEmailOTP(form);
        }
      });
    }

    //Verify OTP - check email and verify otp
    function verifyEmailOTP(form) {
      var fparent = $(form).parent();

      $.ajax({
        url: $(form).attr('action'),
        type: 'post',
        dataType: 'json',
        data: $(form).serialize(),
        beforeSend: function() {
          $.FEED.showLoader();
          $(form).find('button[type=submit]').attr('disabled', true);
        },
        success: function(res) {
          if (res.success) {
            $.ALERT.show('success', res.success);
            $(form).fadeOut(200).remove();
            load_reset_password_form(fparent);
          } else if (res.error) {
            $.ALERT.show('danger', res.error);
          } else {
            $.ALERT.show('danger', 'No Data');
          }
        },
        error: function(xhr, ajaxOptions, errorThown) {
          console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
        },
        complete: function() {
          $.FEED.hideLoader();
          $(form).find('button[type=submit]').attr('disabled', false);
        }
      });
    }



    //Load reset password form
    function load_reset_password_form(fparent) {
      fparent.append($('#user-reset-card').html());

      //Form Validation
      $('#resetPasswordForm').validate({
        rules: {
          new_password: {
            required: true,
            minlength: 4
          },
          confirm_password: {
            required: true,
            minlength: 4,
            equalTo: "#new_password"
          },
        },
        messages: {
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 4 characters long"
          },
          confirm_password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 4 characters long",
            equalTo: "Please enter the same password as above"
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
        submitHandler: function(form) {
          resetPassword(form);
        }
      });
    }

    function resetPassword(form) {
      var fparent = $(form).parent();

      $.ajax({
        url: $(form).attr('action'),
        type: 'post',
        dataType: 'json',
        data: $(form).serialize(),
        beforeSend: function() {
          $.FEED.showLoader();
          $(form).find('button[type=submit]').attr('disabled', true);
        },
        success: function(res) {
          if (res.success) {
            //$.ALERT.show('success', res.success);
            Toast.fire({
              icon: 'success',
              title: res.success,
            });
            fparent.fadeOut().remove();

            setTimeout(function() {
              window.location.href = "<?php echo $login_link; ?>";
            }, 3000);
          } else if (res.error) {
            //$.ALERT.show('danger', res.error);
            Toast.fire({
              icon: 'error',
              title: res.error,
            });
          } else {
            //$.ALERT.show('danger', 'No Data');
            Toast.fire({
              icon: 'error',
              title: 'No Data',
            });
          }
        },
        error: function(xhr, ajaxOptions, errorThown) {
          console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
        },
        complete: function() {
          $.FEED.hideLoader();
          $(form).find('button[type=submit]').attr('disabled', false);
        }
      });
    }


    $('[data-password-eyeaction=true]').click(function(e) {
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

  });
</script>