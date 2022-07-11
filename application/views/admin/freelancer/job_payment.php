<!-- Menubar Top Start -->
<?php include APPPATH . 'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->
<style>
  .company-logo,
  .freelancer-logo {
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
</style>

<div class="container-fluid">
  <div class="row alice-bg">
    <div class="col-12 no-gliters p-0">
      <div class="dashboard-container">
        <!-- Dashboard Menubar-->
        <?php include APPPATH . 'views/admin/include/menubar.php'; ?>

        <!-- Dashboard Content-->
        <div class="dashboard-content-wrapper">
          <!-- Breadcrumb -->
          <?php include APPPATH . 'views/admin/include/breadcrumb.php'; ?>

          <!-- <form id="search-form m-3">
            <div class="row mb-4">
              <h5 style="margin-left: 25px; margin-bottom: 5px; color: #285C7F;">Filter</h5>
              <div class="col-12">
                <div class="row no-gutters  align-items-center justify-content-center">
                  <div class="col-lg-3 col-md-3 col-sm-12 pr-1">
                    <select class="form-control" id="exampleFormControlSelect1">
                      <option>Location</option>
                      <option>London</option>
                      <option>Boston</option>
                      <option>Mumbai</option>
                      <option>New York</option>
                      <option>Toronto</option>
                      <option>Paris</option>
                    </select>
                  </div>
                  <div class="col-lg-8 col-md-6 col-sm-12 pr-1"> <input type="text" placeholder="Search..." class="form-control" id="search" name="search"></div>
                  <div class="col-lg-1 col-md-3 col-sm-12">
                    <button type="submit" class="ps-btn ps-btn--sm">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form> -->

          <div class="dashboard-applied mb-5">
            <div class="dashboard-section">

              <div class="card bg-light text-secondary">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="company_table" class="table table-striped table-hover">
                      <thead>
                        <tr class="">
                          <th class="text-left">Project</th>
                          <th class="text-left">Payer</th>
                          <th>Freelancer</th>
                          <th>Amount</th>
                          <th>Payment</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id='freelancer-pay'>

                        <?php if ($payments) { ?>
                          <?php foreach ($payments as $payment) { ?>
                            <tr>
                              <td class="text-left">
                                <?php echo $payment['job_title']; ?> <br />
                                <!-- <small><?php echo $payment['milestone']['name']; ?></small> -->
                              </td>
                              <td class="text-left">
                                <div class="media">
                                  <div class="media-body"><?php echo $payment['company_name']; ?></div>
                                </div>
                              </td>
                              <td class="text-left">
                                <div class="media">
                                  <div class="media-body">
                                    <?php echo $payment['freelancer']->first_name . ' ' . $payment['freelancer']->last_name; ?>
                                  </div>

                                </div>
                              </td>
                              <td style="width:20%">
                                <?php $freelancer_payment = $payment['freelancer_pay']; ?>
                                <small><span>Price: <?php echo format_currency($freelancer_payment['amount']); ?></span></small><br>
                                <small><span>Commission (%): <?php echo format_currency($freelancer_payment['service_amount']); ?></span></small><br>
                                <small><span>Final Price: <?php echo format_currency($freelancer_payment['total']); ?></span></small>
                              </td>
                              <td style="width:20%">
                                <?php if ($payment['pay_release'] == 0) { ?>
                                  <small>Pending...</small>
                                <?php } else { ?>
                                  <small>Completed</small>
                                <?php } ?>
                              </td>
                              <td>
                                <?php if ($payment['pay_release'] == 0) { ?>
                                  <button data-href="<?php echo $payment['freelancer_pay_link']; ?>" data-freelancer="<?php echo $payment['payment_details']; ?>" class="ps-btn ps-btn--sm btn--pay">Pay</button>
                                <?php } else { ?>
                                  <button data-href="<?php echo $payment['freelancer_pay_view']; ?>" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow btn--view">View</button>
                                <?php } ?>
                              </td>
                            </tr>
                          <?php } ?>
                        <?php } else { ?>
                          <tr>
                            <td colspan="5" class="text-center">No Data</td>
                          </tr>
                        <?php } ?>

                      </tbody>
                    </table>
                  </div>
                  <?php if ($pagination) { ?>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <?php echo $pagination; ?>
                      </ul>
                    </nav>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pay modal -->
<div class="modal" id="paymentModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Payment</h4>
        <button class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="" payment-info>
          <div class="row">
            <div class="col-md-12 my-2">
              <div class="card">
                <div class="card-body table-responsive">
                  <table class="table table-striped" id="freelancer-account-detail">
                    <thead>
                      <tr>
                        <th><strong class="theme-default">Name</strong></th>
                        <th><strong class="theme-default">Details</strong></th>
                      </tr>
                    </thead>
                    <tbody class="detail-bp-tbody">
                      <tr>
                        <td><strong class="theme-default">Account Number</strong></td>
                        <td class="account_number"></td>
                      </tr>
                      <tr>
                        <td><strong class="theme-default">IFSC Code</strong></td>
                        <td class="ifsc_code"></td>
                      </tr>
                      <tr>
                        <td><strong class="theme-default">Bank Name</strong></td>
                        <td class="bank_name"></td>
                      </tr>
                      <tr>
                        <td><strong class="theme-default">Branch Name</strong></td>
                        <td class="branch_name"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-12 my-2">
              <form id="formFreelancerPay" method="post">
                <div class="form-group">
                  <label>Payment Type</label>
                  <input type="text" name="payment_type" class="form-control" placeholder="NEFT/IMPS/RTGS" />
                </div>
                <div class="form-group">
                  <label>Transacton ID</label>
                  <input type="text" name="transaction_id" class="form-control" placeholder="Transaction Id" />
                </div>
                <!-- <div class="form-group">
                  <textarea type="text" name="payment_description" class="form-control" placeholder=""></textarea>
                </div>
                <div class="form-group">
                  <select class="form-control" name="payment_status">
                    <option></option>
                    <option>Completed</option>
                  </select>
                </div> -->
                <div class="form-group">
                  <center>
                    <button type="submit" class="ps-btn ps-btn--sm">Pay</button>
                  </center>
                </div>
              </form>
            </div>
            <!-- <div class="col-md-5">
              <div class="card">
                <div class="card-body table-responsive">

                  <table class="table table-striped">
                    <?php if ($payments) { ?>
                      <?php foreach ($payments as $payment) { ?>
                    <tr>
                      <th>Price</th>
                      <td><?php echo format_currency($payment['amount']); ?></td>
                    </tr>
                    <tr>
                      <th>Commission (%)</th>
                      <td><?php echo format_currency($payment['service_amount']); ?></td>
                    </tr>
                    <tr>
                      <th>Final Price</th>
                      <td><?php echo format_currency($payment['freelancer_total']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- viw payment details -->
<div class="modal" id="viewpaymentModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Freelancer Payment Details</h4>
        <button class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="" payment-info>
          <div class="row">
            <div class="col-md-12" id="freelancer-payment-details">
              <div class="payment_details">
                <p class="amount"></p>
                <p class="service_amount"></p>
                <p class="total"></p>
                <p class="freelancer_transaction_type"></p>
                <p class="freelancer_transaction_id"></p>
                <p class="date_added"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    var elementBlock = $('#freelancer-pay');
    var formFreelancerPay = $('#formFreelancerPay');


    function job_action(form) {

      $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        dataType: 'json',
        beforeSend: function() {
          $.FEED.showLoader();
        },
        success: function(res) {
          if (res.success) {
            $('.modal').modal('hide');
            form[0].reset();
            //$.ALERT.show('success', res.message);
            Toast.fire({
              icon: 'success',
              title: res.message
            });
            setTimeout(function() {
              location.reload();
            }, 1500);
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
        error: function(xhr, ajaxOptions, errorThrown) {
          console.log(xhr.responseText + ' ' + xhr.statusText);
        },
        complete: function() {
          $.FEED.hideLoader();
        }
      });
    };

    $('.btn--pay').click(function(e) {
      e.preventDefault();
      formFreelancerPay.attr('action', $(this).attr('data-href'));
      var freelancer_details = $(this).attr('data-freelancer');
      var element_block = $('#freelancer-account-detail');
      $('#paymentModal').modal({
        keyboard: false,
        backdrop: 'static',
        show: true
      });
      $.ajax({
        url: freelancer_details,
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          $.FEED.showLoader();
        },
        success: function(res) {
          if (res.success) {
            element_block.find('.detail-bp-tbody .account_number').html(res.freelancer.account_number);
            element_block.find('.detail-bp-tbody .ifsc_code').html(res.freelancer.ifsc_code);
            element_block.find('.detail-bp-tbody .bank_name').html(res.freelancer.bank_name);
            element_block.find('.detail-bp-tbody .branch_name').html(res.freelancer.branch_name);
            // Toast.fire({
            //   icon: 'success',
            //   title: res.message
            // });
          } else if (res.error) {
            // $.ALERT.show('danger', res.message);
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
        error: function(xhr, ajaxOptions, errorThrown) {
          console.log(xhr.responseText + ' ' + xhr.statusText);
        },
        complete: function() {
          $.FEED.hideLoader();
        }
      });
    });

    var formFreelancer = formFreelancerPay.validate({
      onkeyup: function(element) {
        $(element).valid();
      },
      onclick: function(element) {
        $(element).valid();
      },
      rules: {
        payment_type: {
          required: true,
        },
        transaction_id: {
          required: true,
        },
      },
      messages: {
        payment_type: {
          required: "Please enter Description",
        },
        transaction_id: {
          required: "Please enter amount",
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
      }
    });

    formFreelancerPay.submit(function(e) {
      e.preventDefault();
      var form = formFreelancerPay;
      if (formFreelancer.valid()) {
        job_action(form);
      }
    });

    //Freelancer Payment Details
    $('.btn--view').click(function(e) {
      e.preventDefault();
      $('#viewpaymentModal').modal({
        keyboard: false,
        backdrop: 'static',
        show: true
      });
      var href = $(this).attr('data-href');
      var element_block = $('#freelancer-payment-details');
      $.ajax({
        url: href,
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          $.FEED.showLoader();
        },
        success: function(res) {
          if (res.success) {
            element_block.find('.payment_details .amount').html('<strong> Amount: ' + res.payment.amount + '</strong>');
            element_block.find('.payment_details .service_amount').html('<strong> Service Amount: ' + res.payment.service_amount + '</strong>');
            element_block.find('.payment_details .total').html('<strong> Total: ' + res.payment.total + '</strong>');
            element_block.find('.payment_details .freelancer_transaction_type').html('<strong> Transaction Type: ' + res.payment.freelancer_transaction_type + '</strong>');
            element_block.find('.payment_details .freelancer_transaction_id').html('<strong> Transaction ID: ' + res.payment.freelancer_transaction_id + '</strong>');
            element_block.find('.payment_details .date_added').html('<strong> Date: ' + res.payment.date_added + '</strong>');
            // Toast.fire({
            //   icon: 'success',
            //   title: res.message
            // });
          } else if (res.error) {
            // $.ALERT.show('danger', res.message);
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
        error: function(xhr, ajaxOptions, errorThrown) {
          console.log(xhr.responseText + ' ' + xhr.statusText);
        },
        complete: function() {
          $.FEED.hideLoader();
        }
      });
    });


  });
</script>