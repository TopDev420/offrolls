    <!-- Menubar -->
    <?php include APPPATH. 'views/freelancer/include/menubar.php'; ?>
    <!-- Menubar End -->
    <div class="section-default-header"></div>

    <div class="alice-bg section-padding-top section-padding-bottom">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-container">

              <!-- Dashboard Sidebar Start -->
              <?php include 'include/sidebar.php'; ?>
              <!-- Dashboard Sidebar End -->

              <div class="dashboard-content-wrapper">
                <div class="row">
                  <div class="col">
                    <div class="pricing-controller">
                      <span class="duration duration-month active">Monthly</span>
                      <div class="switch-wrap"><span class="switch"></span></div>
                      <span class="duration duration-year">Annually <span>Save 10%</span></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="pricing starter">
                      <span class="package-title">Starter</span>
                      <p class="description">Entry you need get started without <span>compromising</span></p>
                      <div class="package-info">
                        <h3 class="monthly-rate"><span>₹ 22 </span>/mo</h3>
                        <h3 class="yearly-rate hidden"><span>₹ 240</span>/year</h3>
                        <p class="user-number">Maximum 01 user<i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="When you buy Markesia you get all you see in the demo but the images"></i></p>
                      </div>
                      <div class="features">
                        <h6>Features</h6>
                        <ul>
                          <li>Unlimited Reservations</li>
                          <li>2 Clients and Products</li>
                          <li>5Gb of Storage</li>
                          <li>Housekeeping Status</li>
                          <li>Data Security and Backups</li>
                          <li>Unlimited Staff Accounts</li>
                          <li>Web Booking Widget</li>
                          <li>Monthly Reports and Analytics</li>
                        </ul>
                      </div>
                      <div class="buy-button">
                        <a href="checkout.html" class="button primary-bg">Get Started</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="pricing advance">
                      <span class="package-title">Advanced</span>
                      <p class="description">Our most popular plan for your startup <span>100+ apps integrations</span></p>
                      <div class="package-info">
                        <h3 class="monthly-rate"><span>₹ 55</span>/mo</h3>
                        <h3 class="yearly-rate hidden"><span>₹ 540</span>/year</h3>
                        <p class="user-number">Maximum 02 user<i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="When you buy Markesia you get all you see in the demo but the images"></i></p>
                      </div>
                      <div class="features">
                        <h6>Features</h6>
                        <span>* Includes Everything in Starter</span>
                        <ul>
                          <li>SSL Certificate</li>
                          <li>Unlimited users</li>
                          <li>Free analytic tools</li>
                          <li>Unlimited Reservations</li>
                          <li>2 Clients and Products</li>
                          <li>5Gb of Storage</li>
                          <li>Housekeeping Status</li>
                          <li>Data Security and Backups</li>
                          <li>Unlimited Staff Accounts</li>
                          <li>Web Booking Widget</li>
                          <li>Monthly Reports and Analytics</li>
                        </ul>
                      </div>
                      <div class="buy-button">
                        <a href="checkout.html" class="button primary-bg">Get Started</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Call to Action -->
    <?php include APPPATH. 'views/include/module_actions.php'; ?>
    <!-- Call to Action End -->



    <script src="<?php echo base_url('application/assets/dashboard/js/dashboard.js'); ?>"></script>
    <script src="<?php echo base_url('application/assets/dashboard/js/datePicker.js'); ?>"></script>
    <script src="<?php echo base_url('application/assets/dashboard/js/upload-input.js'); ?>"></script>
