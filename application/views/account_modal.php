
<style>
    .form-controls-block .error {
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: rgb(220, 53, 69);
    }
    
    .form-controls-block .append-to-input {
        position: absolute;
        top: 0;
        height: 5.3rem;
        left: 0;
        z-index: 9;
    }
    
    .form-controls-block .form-control {
        margin-left: 3rem;    
    }
    
    .form-controls-block .input-group-text {
        border: 0;
        /*border-bottom: 1px solid rgba(0,0,0,0.08);*/
        background-color: #fff;
        border-radius: 0;
    }
    
    .shortcut-login .google {
        background-color: #fff;
        border: 1px solid rgb(220, 74, 61) !important;
        color: rgb(220, 74, 61) !important;
        transition: all 0.5s ease;
    }
    
    .shortcut-login .linkedin {
        background-color: #0073b1;
        border: 1px solid transparent;
        color: #fff !important;
        transition: all 0.5s ease;
    }
    
    .shortcut-login .google:hover, .shortcut-login .linkedin:hover, #userlogin .button:hover, #userregister .button:hover {
        transform: translateY(-5px);
        transition: all 0.5s ease;
    }
    
    .form-controls-block .have-account {
        color: #6f7484;
    }
    
    .form-controls-block .have-account a {
        color: #212529;
        margin-top: 10px;
    }
    
    .account-entry .modal {
        padding: 0 !important;
    }
    
    .account-entry .linebar{
        position: relative;
        display: flex;
        width: 100%;
        text-align: center;
        align-items: center;
        height: 4rem;
        margin: 2rem 0;
    }
    
    .account-entry .linebar:before {
        content: '';
        position: absolute;
        width: 100%;
        left: 0;
        right: 0;
        margin: auto;
        top: 46%;
        border: 1px solid #333e48;
    }
    
    .account-entry .linebar p {
        position: absolute;
        left: 45%;
        background-color: #f26522;
        color: #fff;
        padding: 0.8rem;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }
    
    .password-actionz {
        position: relative;
    }
    .password-actionz .btn-password-actionz {
        position: absolute;
        top: 20%;
        right: 4%;
        margin: auto;
        font-size: 12px;
        width: 1.6rem;
        color: #495057;
        z-index: 9;
    }
</style>

<div class="account-entry">
    
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-slideout modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="userlogin" class="form-controls-block" method="post">
              <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend append-to-input">
                            <span class="input-group-text">
                                <span class="fas fa-user fa-lg fa-fw required"></span>
                            </span>
                        </div>
                        <input name="user_email" type="email" placeholder="Email Address" class="form-control">
                  </div>
              </div>
              <div class="form-group password-actionz">
                  <div class="input-group">
                      <div class="input-group-prepend append-to-input">
                            <span class="input-group-text">
                                <span class="fas fa-lock fa-lg fa-fw required"></span>
                            </span>
                        </div>
                        <input name="user_password" type="password" data-epa="true" placeholder="Password" class="form-control">
                        <span data-password-eyeaction="true" class="btn-password-actionz input-group-append"><i  data-feather="eye-off"></i></span>
                  </div>
                
              </div>
              <div class="form-group">
                <div class="more-option">
                    <a href="<?php echo base_url() . 'forgotpassword'; ?>">Forget Password?</a>
                </div>
              </div>
              <!--<div class="more-option">-->
              <!--  <a href="javascript:void(0)">Forget Password?</a>-->
              <!--</div>-->
              <div class="form-group text-center">
                <button type="submit" class="button primary-bg btn-block">Login</button>
                <p class="have-account">Don&apos;t have an account? <a href="javascript:void(0);" id="registerButton1">Signup</a></p>
              </div>
            </form>
            <div class="linebar"><p>OR</p></div>
            <div class="shortcut-login text-center">
                <div class="buttons d-block">
                    <p>connect with</p>
                  <!--<a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i>Linkedin</a>-->
                  <a href="javascript:void(0)" class="google" id="btn-sso-googleLogin"><i class="fab fa-google"></i>Google</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-slideout modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">SignUp to get started</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="userregister" class="form-controls-block" method="post">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="js-form-message js-focus-state">
                        
                        <div class="input-group">
                            <div class="input-group-prepend append-to-input">
                                <span class="input-group-text">
                                    <span class="fas fa-user fa-lg fa-fw required"></span>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" aria-label="First Name">
                        </div>
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="js-form-message js-focus-state">
                       
                        <div class="input-group">
                            <div class="input-group-prepend append-to-input">
                                <span class="input-group-text">
                                    <span class="fas fa-user fa-lg fa-fw"></span>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" aria-label="Last Name">
                        </div>
                          
                    </div>
                </div>
                    
                <div class="form-group">
                    <div class="js-form-message js-focus-state">
                        
                        <div class="input-group">
                            <div class="input-group-prepend append-to-input">
                                <span class="input-group-text" id="signupEmailLabel">
                                    <span class="fas fa-envelope fa-lg fa-fw required"></span>
                                </span>
                            </div>
                            <input type="email" class="form-control" name="sign_in_email" id="sign_in_email" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel">
                        </div>
                        
                    </div>
                </div>
                <!-- End Input -->

                <!-- Form Group -->
                <div class="form-group password-actionz">
                    <div class="js-form-message js-focus-state">
                        
                        <div class="input-group">
                            <div class="input-group-prepend append-to-input">
                                <span class="input-group-text" id="signupPasswordLabel">
                                    <span class="fas fa-lock fa-lg fa-fw required"></span>
                                </span>
                            </div>
                            <input type="password" data-epa="true" class="form-control" name="sign_in_password" id="sign_in_password" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel" >
                            <span data-password-eyeaction="true" class="btn-password-actionz input-group-append"><i  data-feather="eye-off"></i></span>
                        </div>
                        
                    </div>
                </div>
                <!-- End Input -->

                <!-- Form Group -->
                <div class="form-group password-actionz">
                    <div class="js-form-message js-focus-state">
                        
                        <div class="input-group">
                            <div class="input-group-prepend append-to-input">
                                <span class="input-group-text" id="signupConfirmPasswordLabel">
                                    <span class="fas fa-key fa-lg fa-fw required"></span>
                                </span>
                            </div>
                            <input type="password" data-epa="true" class="form-control" name="confirmPassword" id="ConfirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" >
                            <span data-password-eyeaction="true" class="btn-password-actionz input-group-append"><i  data-feather="eye-off"></i></span>
                        </div>
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="js-form-message js-focus-state">
                        <label><input type="checkbox" name="user_type" value="2"><b>&nbsp; Business Account ?&nbsp; &nbsp;&nbsp;</b>  </label>
                    </div>
                </div>
                <!-- End Input -->

                <div class="form-group text-center">
                    <button type="submit" class="button primary-bg btn-block" >Register</button>
                    <p class="have-account">Already have an account? <a href="javascript:void(0);" data-show-login="true">Signin</a></p>
                </div>
            </form>
            <div class="linebar"><p>OR</p></div>
            <div class="shortcut-login text-center">
                <p>connect with</p>
                <div class="buttons d-block">
                  <!--<a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i>Linkedin</a>-->
                  <a href="javascript:void(0)" class="google" id="btn-sso-googleRegister"><i class="fab fa-google"></i>Google</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- SSO Register Modal -->
    <div class="modal fade" id="registerSSOModal" tabindex="-1" role="dialog" aria-labelledby="registerSSOModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-slideout modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">SignUp to get started</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="userregisterSSO" class="form-controls-block" method="post">
                
                <h5 class="mb-4">Social Login: <span class="sso--name"></span></h5>
                <div class="form-group">
                    <div class="js-form-message js-focus-state">
                        
                        <div class="input-group">
                            <div class="input-group-prepend append-to-input">
                                <span class="input-group-text">
                                    <span class="fas fa-envelope fa-lg fa-fw required"></span>
                                </span>
                            </div>
                            <input type="email" class="form-control" name="signin_email" placeholder="Email">
                        </div>
                        
                    </div>
                </div>
                <!-- End Input -->

                <div class="form-group">
                    <div class="js-form-message js-focus-state">
                        <label><input type="checkbox" name="user_type" value="2"><b>&nbsp; Business Account ?&nbsp; &nbsp;&nbsp;</b>  </label>
                    </div>
                </div>
                <!-- End Input -->

                <div class="mb-2">
                    <button type="submit" class="button primary-bg btn-block" >Register</button>
                </div>
                
            </form>
            
          </div>
        </div>
      </div>
    </div>
</div>

<?php $this->document->addScript(base_url('application/assets/js/include/account.js'), 'footer'); ?>
<script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>
