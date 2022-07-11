    <!-- Menubar Top Start -->
    <?php include APPPATH.'views/admin/include/menubar_top.php'; ?>
    <!-- Menubar Top End -->

    <div class="padding-top-90 padding-bottom-90 access-page-bg">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-md-6">
            <div class="access-form">
              <div class="form-header">
                <h5><i data-feather="user"></i>Admin Login</h5>
              </div>
              <form id="loginForm" action="#" method="post">
                <div class="form-group">
                  <input type="email" name="user_email" placeholder="Email Address" class="form-control" required>
                </div>
                <div class="form-group">
                  <input type="password" name="user_password" placeholder="Password" class="form-control" required>
                </div>
                <div class="more-option">
                </div>
                <button type="submit" class="button primary-bg btn-block">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('application/assets/js/alert.js'); ?>"></script>

    <script type="text/javascript">
      $(function(){
        $('#loginForm').validate({
          rules: {
            user_email: {
              required: true,
              email: true
            },
            user_password: {
              required: true
            }
          },
          messages: {
            user_email: "Please enter a valid email address",
            user_password: "Please enter a password",
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
          submitHandler: function(form) {
            login(form);
          }
        });

        //Login Form
        function login(form) {
          var fparent = $(form).parent();

           $.ajax({
            url: '<?php echo base_url(). 'admin/login'; ?>',
            type: 'post',
            dataType: 'json',
            data: $(form).serialize(),
            beforeSend: function() {
              $(form).find('button[type=submit]').text('<?php echo $this->lang->line('loading'); ?>').attr('disabled', true);
              $.FEED.showLoader();
            },
            success: function(res) {
              if(res.success) {
                window.location.href = '<?php echo base_url(). 'admin/dashboard'; ?>';
              } else if(res.error){
                $.ALERT.show('danger', res.error);
              } else {
                $.ALERT.show('danger', 'No Data');
              }
            },
            error: function(xhr, ajaxOptions, errorThown) {
              console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
            },
            complete: function() {
              $(form).find('button[type=submit]').text('<?php echo $this->lang->line('login'); ?>').attr('disabled', false);
               $.FEED.hideLoader();
            }
          });
        }
      });
    </script>

