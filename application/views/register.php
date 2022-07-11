<?php
$sso_register = isset($sso_register) ? $sso_register : '';
$signin_email = isset($signin_email) ? $signin_email : '';
if ($sso_register && $signin_email) {
  $sso_register = true;
} else {
  $sso_register = false;
}
?>
<style>
  .form-control::-webkit-input-placeholder {
    opacity: 1;
    font-size: 14px;
    color: #fff;
  }

  .form-control::-moz-placeholder {
    opacity: 1;
    font-size: 14px;
    color: #fff;
  }

  .form-control:-moz-placeholder {
    opacity: 1;
    font-size: 14px;
    color: #fff;
  }

  .form-control:-ms-input-placeholder {
    opacity: 1;
    font-size: 14px;
    color: #fff;
  }
</style>

<!-- Menubar -->
<?php include APPPATH . 'views/include/menubar.php'; ?>
<!-- Menubar End -->


<div class="ps-page ps-page--account bg--cover" id="signup-selection" data-background="img/bg/account-selection.jpg">
  <div class="ps-page__content" style="margin-bottom: 60px;">
    <form class="ps-form--signup-selection bg--gradient" action="" method="post" id="userRegisterForm">
      <div class="ps-form__header">
        <h3><b>Sign up for free.</b></h3>
        <h5>Join the vibrant community of <br> OFFROLLS.</h5>
        <p>Choose any one below.</p>
      </div>
      <div class="ps-form__content">
        <div id="ps-contentbox1">
          <div class="ps-radio ps-radio--circle">
            <input class="form-control" type="radio" name="user_type" id="signup-selection-1" value="company" name="signup-selection">
            <label for="signup-selection-1"><span class="title">Company Account</span><small>Find experts for your special business needs and scale your business</small></label>
          </div>
          <div class="ps-radio ps-radio--circle">
            <input class="form-control" type="radio" name="user_type" id="signup-selection-2" value="freelancer" name="signup-selection">
            <label for="signup-selection-2"><span class="title">Freelancer Account</span><small>Find freelance projects to elevate your career</small></label>
          </div>
          <!-- <div class="ps-radio ps-radio--circle">
            <input class="form-control" type="radio" name="user_type" id="signup-selection-3" value="candidate" name="signup-selection">
            <label for="signup-selection-3"><span class="title">Job Seekers Account</span><small>Find jobs that match your aspirations</small></label>
          </div> -->
          <div class="ps-form__footer">
            <button data-contentbox="#ps-contentbox1" data-next="#ps-contentbox2" type="button" class="ps-btn ps-btn--black">Next</button>
          </div>
          <?php if (!$sso_register) { ?>
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
                              <!-- <div class="col-6"><a href="javascript:void(0)" id="btn-sso-linkedinRegister" class="linkedin"><i class="fab fa-linkedin-in"></i>Linkedin</a></div> -->
                              <div class="col-12"><a href="javascript:void(0)" id="btn-sso-googleRegister" style="color:#4285f4;" class="google"><i class="fab fa-google"></i>Google</a></div>
                            </div>
                          </div>
                          <p class="text-center text-white " style="font-weight: 300;">Already have an account? <a href="<?php echo base_url(); ?>login">Login</a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div id="ps-contentbox2" style="display:none;">
          <?php if ($sso_register) { ?>
            <div class="form-group ele--jqvalid">
              <label class="form-control"><?php echo $signin_email; ?></label>
              <input type="hidden" name="user_email" value="<?php echo $signin_email; ?>" placeholder="Email Address" class="form-control">
            </div>
            <div class="form-group ele--jqvalid">
              <input type="text" name="user_mobile" placeholder="Mobile Number" class="form-control">
            </div>
          <?php } else { ?>
            <div class="form-group ele--jqvalid">
              <input type="email" name="user_email" placeholder="Email Address" class="form-control">
            </div>
            <div class="form-group ele--jqvalid">
              <input type="text" name="user_mobile" placeholder="Mobile Number" class="form-control">
            </div>
            <div class="form-group ele--jqvalid password-actionz">
              <input type="password" name="user_password" data-epa="true" id="user_password" placeholder="Password" class="form-control" />
              <span data-password-eyeaction="true" class="btn-password-actionz input-group-append"><i data-feather="eye-off"></i></span>
            </div>
            <div class="form-group ele--jqvalid password-actionz">
              <input type="password" name="user_repassword" data-epa="true" placeholder="Re-Enter Password" class="form-control" />
              <span data-password-eyeaction="true" class="btn-password-actionz input-group-append"><i data-feather="eye-off"></i></span>
            </div>

          <?php } ?>
          <div class="form-group  ele--jqvalid">
            <div class="more-option terms mb-0">
              <div class="mt-0 terms">
                <input class="custom-radio" type="checkbox" id="user_terms" name="user_terms">
                <label for="user_terms" class="p-2">
                  <span class="dot"></span> I accept the <a href="<?php echo base_url() . 'about/terms'; ?>"><u>terms &amp; conditions</u></a>
                </label>
              </div>
            </div>
          </div>
          <div class="ps-form__footer clearfix">
            <button data-contentbox="#ps-contentbox2" data-previous="#ps-contentbox1" type="button" class="ps-btn ps-btn--black">Back</button>
            <button type="submit" class="ps-btn ps-btn--black mt-2">Register</button>
          </div>
        </div>
      </div>
    </form>
  </div>


  <script>
    $(function() {
      $sso_register = '<?php echo $sso_register; ?>';

      var utype = getURLVar('utype');
      if (utype) {
        $('input[value=\'' + utype + '\']').attr('checked', true);
        if (utype != 'company') {
          $('#user-AEcond').show();
        }
      }

    });

    $(function() {
      $('[data-next]').click(function(e) {
        e.preventDefault();
        $cur = $(this);
        let contentbox = $cur.data('contentbox');
        let nextbox = $cur.data('next');
        $(contentbox).hide();
        $(nextbox).show();
      });

      $('[data-previous]').click(function(e) {
        e.preventDefault();
        $cur = $(this);
        let contentbox = $cur.data('contentbox');
        let prevbox = $cur.data('previous');
        $(contentbox).hide();
        $(prevbox).show();
      });

    });
  </script>