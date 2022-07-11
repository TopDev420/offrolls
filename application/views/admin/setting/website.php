<!-- Menubar Top Start -->
<?php include APPPATH.'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->

<div class="container-fluid">
    <div class="row alice-bg">
      <div class="col-12 no-gliters p-0">
        <div class="dashboard-container">
          <!-- Dashboard Menubar-->
          <?php include APPPATH.'views/admin/include/menubar.php'; ?>

          <!-- Dashboard Content-->
          <div class="dashboard-content-wrapper">
            <!-- Breadcrumb -->
            <?php include APPPATH.'views/admin/include/breadcrumb.php'; ?>

            <div class="dashboard-applied">
                <div class="card card-body">
                    <form method="post" id="websiteSettingForm" class="access-form">

                        <div class="jy-card card card-shadow">
                            <div class="card-header p-0">
                                <ul class="nav nav-tabs border-0">
                                    <li class="nav-item">
                                        <a class="nav-link active show" data-toggle="tab" href="#tab-general">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab-address">Address & Social</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab-misc">Misc</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade in active show" id="tab-general">
                                    <div class="card-body p-5">
                                        <div class="form-group row">
                                            <label class="col-md-4">First Name</label>
                                            <div class="col-md-8">
                                                <input type="text" name="first_name" value="<?php echo $first_name; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Last Name</label>
                                            <div class="col-md-8">
                                                <input type="text" name="last_name" value="<?php echo $last_name; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Company Name</label>
                                            <div class="col-md-8">
                                                <input type="text" name="company_name" value="<?php echo $company_name; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Email</label>
                                            <div class="col-md-8">
                                                <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Mobile</label>
                                            <div class="col-md-8">
                                                <input type="text" name="mobile" value="<?php echo $mobile; ?>" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4">About</label>
                                            <div class="col-md-8">
                                                <textarea name="description" id="description--editor" class="form-control"><?php echo $about; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab-address">
                                    <div class="card-body p-5">
                                        <div class="d-block">
                                            <h6 class="mb-5">Address</h6>
                                            <div class="form-group row">
                                                <label class="col-md-4">Country</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="country" id="country" ></select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">State</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="state" id="state" ></select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">City</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="city" value="<?php echo $city; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Street Name</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="street_name" value="<?php echo $street_name; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Pincode</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="pincode" value="<?php echo $pincode; ?>" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block">
                                            <h6 class="mb-5">Social</h6>
                                            <div class="form-group row">
                                                <label class="col-md-4">Facebook</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="facebook_page" value="<?php echo $facebook_page; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Twitter</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="twitter_page" value="<?php echo $twitter_page; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Instagram</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="instagram_page" value="<?php echo $instagram_page; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Linkedin</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="linkedin_page" value="<?php echo $linkedin_page; ?>" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="tab-pane fade" id="tab-misc">
                                    <div class="card-body p-5">
                                        <?php include APPPATH.'views/coming_soon.php'; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script src="<?php echo base_url('application/assets/js/countries.js'); ?>"></script>

<script>
    $(function() {
        var websiteSettingForm = $('#websiteSettingForm');

        initSummerNote(['#description--editor']);   //Initialize summernote
        //Dynamic country select
        populateCountries('country', 'state', '<?php echo $country; ?>', '<?php echo $state; ?>');


        function save_website(form, $cur, href) {
            let btn_txt = $cur.html();
            $.ajax({
                url: href,
                type: 'post',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function(){
                    $cur.attr('disabled', true).html($updating_txt);
                    $.FEED.setLoaderStatus($updating_txt);
                    $.FEED.showLoader();
                },
                success: function(res){
                    if(res.success){
                        $.ALERT.show('success', res.message);
                        setTimeout(function(){
                            location.reload();
                        }, 1500);
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
                    $cur.attr('disabled', false).html(btn_txt);
                    $.FEED.setLoaderStatus('');
                    $.FEED.hideLoader();
                }
            });
        }


        // Profile Form Validation
        var validWSForm = websiteSettingForm.validate({
          rules: {
            service_fee: {
              digits: true
            },
          },
          messages: {
            service_fee: {
                digits: "Please enter digits"
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
          }
        });


        $('#btn-save').click(function(e){
            e.preventDefault();
            $cur = $(this);
            if(validWSForm.valid()){
                save_website(websiteSettingForm, $cur, $base_url + 'admin/setting/website/save');
            }
        });

    });
</script>
