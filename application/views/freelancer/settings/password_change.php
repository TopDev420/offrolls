<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/vendor/cropperjs/dist/cropper.css'); ?>">
<!-- Menubar -->
<?php include APPPATH . 'views/freelancer/include/menubar.php'; ?>
<!-- Menubar End -->

<!-- Navbar -->
<?php include APPPATH . 'views/freelancer/include/navbar.php'; ?>
<!-- Navbar Ends-->

<!--include search-sidebar-->
<div class="ps-page" id="dashboard">
    <div class="ps-section--sidebar ps-layout">
        <div class="container">
            <div class="ps-section__container">
                <div class="ps-section__content">
                    <form class="ps-form--settings" method="post" id="password-change">
                        <figure>
                            <h3 class="ps-heading--2">Settings /<span class="ps-highlight"> Password & Security</span></h3>
                            <div class="row">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 ">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input class="form-control" name="current_password" type="password" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 ">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input class="form-control" name="new_password" type="password" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 ">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" type="password" name="confirm_password" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="ps-form__submit">
                            <!-- <button class="ps-btn ps-btn--white ps-btn--shadow ps-btn--sm" type="reset">Cancel</button> -->
                            <button class="ps-btn ps-btn--gradient ps-btn--sm" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <div class="ps-section__sidebar">
                    <aside class="widget widget_profile widget_list">
                        <h3 class="widget-title">Settings</h3>
                        <ul class="ps-list">
                            <li><a href="<?php echo base_url() . 'freelancer/setting'; ?>">General infomation</a></li>
                            <li><a href="<?php echo base_url() . 'freelancer/setting/freelancerPyamentDetails'; ?>">Billing & Payments</a></li>
                            <li><a href="<?php echo base_url() . 'freelancer/setting/passwordChangeInfo'; ?>">Password & Security</a></li>
                            <li><a href="#">Notification Settings</a></li>
                            <li><a href="<?php echo base_url() . 'freelancer/setting/taxInformations'; ?>">Tax Informations</a></li>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        // Password Change
        var formProfile = $("#freelancer-genreal-details").validate({
            rules: {
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                address: {
                    required: true,
                },
                country: {
                    required: true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                pin_code: {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6,
                },
            },
            messages: {
                first_name: "Please enter first name",
                last_name: "Please enter last name",
                address: "Please enter address",
                country: "Please enter country",
                state: "please enter state",
                city: "Please enter first name",
                pin_code: {
                    required: "Please enter pincode",
                    digits: "Please enter a valid pincode",
                    minlength: "Please enter 6 digits valid pincode",
                    maxlength: "Please enter 6 digits valid pincode",
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

        });

        var formProfile = $("#password-change").validate({
            rules: {
                current_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 8,
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                },
            },
            messages: {
                current_password: "Please enter current password",
                new_password: {
                    required: "Please enter new password",
                    minlength: "Please enter minimum of 8 charecter",
                },
                confirm_password: {
                    required: "Please enter confirm password",
                    minlength: "Please enter minimum of 8 charecter",
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
        });

        $('#password-change').submit(function(e) {
            e.preventDefault();
            if ($('#password-change').valid()) {
                $.ajax({
                    url: $base_url + "freelancer/setting/resetPassword",
                    type: 'post',
                    dataType: 'json',
                    data: $('#password-change').serialize(),
                    beforeSend: function() {},
                    success: function(res) {
                        if (res.success) {
                            //$.ALERT.show('success', res.success);
                            Toast.fire({
                                icon: 'success',
                                title: res.success,
                            });

                            setTimeout(function() {
                                location.reload;
                            }, 2000);
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
        });
    });
</script>