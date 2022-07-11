

<!-- Menubar -->
<?php include APPPATH . 'views/include/menubar.php'; ?>
<!-- Menubar End -->

<div class="ps-page--signin">
  <div class="container">
    <form class="ps-form--signin" id="userLoginForm" action="" method="post">
      <div class="ps-form__header">
        <h3>Login</h3>
        <p>Sign in now to Access Your Dashboard</p>
      </div>
      <div class="ps-form__content">
        <div class="form-group ele--jqvalid">
          <input name="user_email" type="email" placeholder="Email Address" class="form-control">
        </div>
        <div class="form-group password-actionz ele--jqvalid">
          <input name="user_password" id="user_password" data-epa="true" type="password" placeholder="Password" class="form-control">
          <span data-password-eyeaction="true" class="btn-password-actionz input-group-append"><i data-feather="eye-off"></i></span>
        </div>
      </div>
      <div class="ps-form__actions">
        <div class="ps-checkbox ps-checkbox--circle">
          <input class="form-control" type="checkbox" id="newsletter" name="newsletters" />
          <label for="newsletter">Remember me</label>
        </div>
        <a href="<?php echo base_url() . 'forgotpassword'; ?>" style="color:#4CB9BD">Forgot password</a>
      </div>
      <div class="ps-form__footer">
        <button type="submit" class="ps-btn ps-btn--fullwidth ps-btn--gradient">Login</button>
        <div class="signup-card">
          <div class="">
            <div class="registration-body">
              <div class="access-form">
                <div class="my-4">
                  <div class="register-section-details">
                    <div class="shortcut-login mb-4">
                      <div class="orbar">
                        <div class="linebar"></div>
                        <p>OR</p>
                      </div>
                      <p class="text-center text-white mb-4" style="font-weight: 300;">connect with</p>
                      <div class="buttonsz mb-2">
                        <div class="row">
                          <!-- <div class="col-md-6"><a href="javascript:void(0)" id="btn-sso-linkedinRegister" class="linkedin"><i class="fab fa-linkedin-in"></i>Linkedin</a></div> -->
                          <div class="col-md-12"><a href="<?php echo base_url() . 'login/sso/google'; ?>" id="btn-sso-googleLogin" style="background-color:#4285f4;" class="google"><i class="fab fa-google"></i>Google</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          <p>Don't have an account?<a href="<?php echo base_url(); ?>register"> Sign up now!</a></p>
        </div>
    </form>
  </div>
</div>