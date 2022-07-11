<?php
$moduleAction = isset($moduleAction) ? $moduleAction : '';
$admin = isset($admin) ? $admin : array();
$logged = isset($logged) ? $logged : false;
$static = isset($static) ?  $static : true;
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/dashboard/css/dashboard.css'); ?>">

<header class="header header--signin <?php echo $static ? 'page' : 'two-line'; ?> " data-sticky="false">
  <div class="header__left">
    <a class="ps-logo" href="<?php echo base_url(); ?>">
      <img src="<?php echo base_url('application/assets/images/img/Offrolls-logo.png'); ?>" alt="">
    </a>
  </div>
  <div class="header__right">
    <ul class="menu menu--signin">
      <?php if (!$logged) { ?>
        <li class="menu-item dropdown">
          <a href="<?php echo base_url() . 'hirefreelancer'; ?>" title="freelancers">Hire Freelancer</a>
        </li>
        <li class="menu-item dropdown">
          <a href="<?php echo base_url() . 'freelancerproject'; ?>" title="Jobs">Find Projects</a>
        </li>
        <li class="menu-item dropdown">
          <a href="<?php echo base_url() . 'blog'; ?>" title="blog">Blog</a>
        </li>
        <li class="menu-item dropdown">
          <a href="<?php echo base_url() . 'about'; ?>" title="about-us">About Us</a>
        </li>
      <?php } ?>
    </ul>
    <div class="header__actions">
      <?php if ($logged) { ?>
        <div class="header__search">
          <?php if ($admin) { ?>
            <p class="mr-3"><?php echo $admin['email']; ?></p>
          <?php } ?>
        </div>
        <div class="header__toggles">
          <!-- Notifiction -->
          <div class="header__notification header__drodown-parent" id="header-notification">
            <a href="#" class="notification-bell"><i class="fa fa-bell"></i></a>
            <div class="header__dropdown ps-block--notifications">
              <div class="ps-block__header">
                <p>Notitication</p><i class="fa fa-sliders"></i>
              </div>
              <div class="ps-block__content">
              </div>
              <div class="ps-block__footer text-center"><a href="#"><span class="ps-icon--dots"><i></i></span></a></div>
            </div>
          </div>
          <a class="ps-btn ps-btn--sm" href="<?php echo base_url() . 'logout'; ?>">Logout</a>

        </div>
      <?php } else { ?>
        <div><a class="ps-btn ps-btn--outline ps-btn--sm" href="<?php echo base_url() . 'login'; ?>" style="color:white">Login</a></div>
      <?php } ?>
    </div>
  </div>
</header>
<header class="header header--mobile" data-sticky="false">
  <div class="header__content">
    <div class="header__left"><a class="ps-toggle--sidebar" href="#navigation-mobile"><i class="fa fa-bars"></i></a></div>
    <div class="header__center"><a class="ps-logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('application/assets/images/img/logo-dark.png'); ?>" alt=""></a></div>
    <div class="header__right">
      <!-- <div class="header__actions"><a class="ps-search-btn" href=""><i class="fa fa-search"></i></a></div> -->
    </div>
  </div>
</header>
<div class="ps-panel--sidebar" id="navigation-mobile">
  <div class="ps-panel__header">
    <h3>Menu</h3>
  </div>
  <div class="ps-panel__content">
    <?php if ($logged) { ?>
      <ul class="menu--mobile">
        <?php if ($admin) { ?>
          <li class="mr-3"><?php echo $admin['email']; ?></li>
        <?php } ?>
      </ul>
      <div class="mt-3">
        <a class="ps-btn" href="<?php echo base_url() . 'logout'; ?>">Logout</a>
      <?php } else { ?>
        <a class="ps-btn ps-btn--outline" href="<?php echo base_url() . 'login'; ?>" style="color:white">Login</a>
        <a class="ps-btn" href="<?php echo base_url() . 'register'; ?>">Sign Up</a>
      <?php } ?>
      </div>
  </div>
</div>