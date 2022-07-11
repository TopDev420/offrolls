<!-- Menubar -->
<?php include APPPATH . 'views/company/include/menubar.php'; ?>
<!-- Menubar End -->
<div class="section-default-header"></div>
<?php include APPPATH . 'views/company/include/navbar.php'; ?>
<!--include search-sidebar-->
<div class="ps-page" id="dashboard">
  <div class="ps-section--sidebar ps-layout">
    <div class="container">
      <div class="ps-section__container">
        <div class="ps-section__content">
          <form class="ps-form--settings" action="index.html" method="get">
            <figure>
              <h4 class="ps-heading--2 text-center">Coming Soon</h4>
            </figure>
            <div class="ps-form__submit">
              <a href="<?php echo base_url() . 'company/dashboard'; ?>" class="ps-btn ps-btn--white ps-btn--shadow ps-btn--sm ps-btn--outline">Back to Dashboard</a>
            </div>
          </form>
        </div>
        <div class="ps-section__sidebar">
          <aside class="widget widget_profile widget_list">
            <h3 class="widget-title">Settings</h3>
            <ul class="ps-list">
              <li><a href="#">General infomation</a></li>
              <li><a href="#">Billing & Payments</a></li>
              <li><a href="<?php echo base_url() . 'company/profile'; ?>">Edit Profile</a></li>
              <li><a href="#">Password & Security</a></li>
              <li><a href="#">Notification Settings</a></li>
              <li><a href="#">Tax Informations</a></li>
            </ul>
          </aside>
        </div>
      </div>
    </div>
  </div>
</div>