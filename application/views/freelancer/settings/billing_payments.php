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
                    <form class="ps-form--settings" id="freelancer_payment_info" method="post">
                        <figure>
                            <h3 class="ps-heading--2">Settings /<span class="ps-highlight"> Payment Details</span></h3>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input class="form-control" name="account_number" value="<?php echo $freelancer['account_number']; ?>" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                    <div class="form-group">
                                        <label>IFSC Code</label>
                                        <input class="form-control" name="ifsc_code" value="<?php echo $freelancer['ifsc_code']; ?>" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input class="form-control" name="bank_name" value="<?php echo $freelancer['bank_name']; ?>" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                    <div class="form-group">
                                        <label>Branch Name</label>
                                        <input class="form-control" name="branch_name" value="<?php echo $freelancer['branch_name']; ?>" type="text" placeholder="">
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
        // Payment Details Form Validation
        var formProfile = $('#freelancer_payment_info').validate({
            rules: {
                account_number: {
                    required: true
                },
                ifsc_code: {
                    required: true
                },
                bank_name: {
                    required: true,
                },
                branch_name: {
                    required: true
                },
            },
            messages: {
                account_number: "Please enter Account Number",
                ifsc_code: "Please enter IFSC Code",
                bank_name: "Please enter Bank Name",
                branch_name: "Please enter Branch Name",
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

        // Validation ends


        $('#freelancer_payment_info').submit(function(e) {
            e.preventDefault();
            if ($('#freelancer_payment_info').valid()) {
                $.ajax({
                    url: $base_url + 'freelancer/setting/editFreelancerPayment',
                    type: 'post',
                    data: $('#freelancer_payment_info').serialize(),
                    dataType: 'json',
                    beforeSend: function() {},
                    success: function(res) {
                        if (res.success) {
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            });
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
                    error: function(xhr, ajaxOptions, errorThown) {
                        console.log(xhr.statusText + ' - ' + xhr.responseText);
                    },
                    complete: function() {}
                });
            }
        });
    });
</script>