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
                <form method="post" id="paymentSettingForm" class="access-form">
                    <div class="card card-body">
                        <legend class="mb-2">Commission Fees:</legend>
                        <div class="form-group row">
                            <label class="col-md-4">Company Service Fee (in %)</label>
                            <div class="col-md-8">
                                <input type="text" name="company_service_fee" value="<?php echo html_escape($company_service_fee); ?>" class="form-control" placeholder="Eg. 10" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Freelancer Service Fee (in %)</label>
                            <div class="col-md-8">
                                <input type="text" name="freelancer_service_fee" value="<?php echo html_escape($freelancer_service_fee); ?>" class="form-control" placeholder="Eg. 10" />
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <legend class="mb-2">Gateway:</legend>
                        <div class="form-group row">
                            <label class="col-md-4">Name</label>
                            <div class="col-md-8">
                                <input type="text" name="gateway_name" value="<?php echo html_escape($gateway_name); ?>" class="form-control" placeholder="Eg. Instamojo" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">API Key</label>
                            <div class="col-md-8">
                                <input type="text" name="gateway_key" value="<?php echo html_escape($gateway_key); ?>" class="form-control" placeholder="Eg. 0xcvb56xxxxx25" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">API Secret</label>
                            <div class="col-md-8">
                                <input type="text" name="gateway_secret" value="<?php echo html_escape($gateway_secret); ?>" class="form-control" placeholder="Eg. f14reGRTewexxxxxxx4557" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">API Url</label>
                            <div class="col-md-8">
                                <input type="text" name="gateway_url" value="<?php echo html_escape($gateway_url); ?>" class="form-control" placeholder="Eg. https://gateway/api/xxxx" />
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

<script>
    $(function() {
        var paymentSettingForm = $('#paymentSettingForm');

        function save_payment(form, $cur, href) {
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
        var validPSForm = paymentSettingForm.validate({
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
            if(validPSForm.valid()){
                save_payment(paymentSettingForm, $cur, $base_url + 'admin/setting/payment/save');
            }
        });

    });
</script>
