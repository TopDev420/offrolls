<!-- Menubar Top Start -->
<?php include APPPATH . 'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->
<style>
  .company-logo {
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
                          <th>Amount</th>
                          <th>Payment</th>
                          <th>Message</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php if ($payments) { ?>
                          <?php foreach ($payments as $payment) { ?>
                            <tr>
                              <td class="text-left">
                                <?php echo $payment['job_title']; ?> <br />
                                <small><?php echo $payment['milestone']['name']; ?></small>
                              </td>
                              <td class="text-left">
                                <div class="media">
                                  <div class="media-body"><?php echo $payment['company_name']; ?></div>
                                </div>
                              </td>
                              <td style="width:20%">
                                <small><span>Amount: <?php echo format_currency($payment['amount']); ?></span> <br />
                                  <span>Fees: <?php echo format_currency($payment['service_amount']) . '(' . $payment['service_fees'] . ')'; ?></span> <br />
                                  <span>Total:<?php Print_r(format_currency($payment['total'])); ?></span></small>
                              </td>
                              <td style="width:20%">
                                <small>
                                  <?php if ($payment['payment_id']) { ?><span><?php echo $payment['payment_id']; ?></span> <br />
                                    <span><?php echo $payment['instrument_type']; ?></span> <br /><?php } ?>
                                  <span><?php echo date('d M Y', strtotime($payment['date'])); ?></span>
                                </small>
                              </td>
                              <td><?php echo $payment['message']; ?></td>
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