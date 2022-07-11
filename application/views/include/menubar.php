<?php
$moduleAction = isset($moduleAction) ? $moduleAction : '';
$user = isset($user) ? $user : array();
$logged = isset($logged) ? $logged : false;
$static = isset($static) ?  $static : true;
?>

<header class="header header--2 dark <?php echo $static ? 'page' : 'two-line'; ?> " data-sticky="false">
  <div class="header__left"><a class="ps-logo" href="<?php echo base_url(); ?>" style="position: relative;">
      <img src="<?php echo base_url('application/assets/images/img/Offrolls-logo.png'); ?>" alt="">
      <span style="position: absolute; bottom: 0.85rem; right: 0.5rem; color: #285C7F; font-size:1.2rem">Beta</span>
    </a>
  </div>
  <div class="header__right">

    <div class="header__actions d-flex align-items-center justify-content-center">
      <ul class="menu">
        <?php if (!$logged) { ?>
          <li><a href="<?php echo base_url() . 'hirefreelancer'; ?>">Hire Freelancer</a></li>
          <li><a href="<?php echo base_url() . 'freelancerproject'; ?>">Find Projects</a></li>
          <li><a href="<?php echo base_url() . 'blog'; ?>">Blog</a></li>
          <li><a href="<?php echo base_url() . 'about'; ?>">About Us</a></li>
          <li><a href="<?php echo base_url() . 'login'; ?>" style="color:#f15a24">Login</a></li>
          </li>
        <?php } ?>

        <?php if ($moduleAction == 'candidate') { ?>
          <?php if ($logged) { ?>
            <li class="menu-item dropdown">
              <a href="<?php echo base_url() . 'candidate/dashboard'; ?>" title="Dashboard">Dashboard</a>
            </li>

            <li class="menu-item dropdown">
              <a href="<?php echo base_url() . 'candidate/search/jobs'; ?>" title="Jobs">Jobseekers</a>
            </li>

            <li class="menu-item dropdown">
              <a href="<?php echo base_url() . 'candidate/search/companies'; ?>" title="Jobs">Companies/Employers</a>
            </li>
          <?php } ?>
        <?php } ?>

        <?php if ($moduleAction == 'freelancer') { ?>
          <?php if ($logged) { ?>
            <!-- <li class="menu-item dropdown">
              <a href="<?php echo base_url() . 'freelancer/dashboard'; ?>" title="Dashboard">Dashboard</a>
            </li> -->

            <li class="menu-item dropdown">
              <a href="<?php echo base_url() . 'freelancer/search/jobs'; ?>" title="Jobs">Hire Freelancer</a>
            </li>

            <li class="menu-item dropdown">
              <a href="<?php echo base_url() . 'blog'; ?>" title="Blog">Blog</a>
            </li>
          <?php } ?>
        <?php } ?>

      </ul>
      <div>
        <?php if ($logged) { ?>
          <?php if ($user) { ?>
            <a class="ps-btn ps-btn--outline mb-2" href="javascript:void(0)"><?php echo $user['email']; ?></a>
          <?php } ?>
          <a class="ps-btn mb-2" href="<?php echo base_url() . 'logout'; ?>">Logout</a>
        <?php } else { ?>
          <a class="ps-btn ps-btn--outline mb-2" href="<?php echo base_url() . 'register'; ?>">Sign Up</a>
        <?php } ?>
      </div>
    </div>
  </div>
</header>
<header class="header header--mobile" data-sticky="false">
  <div class="header__content">
    <div class="header__left"><a class="ps-toggle--sidebar" href="#navigation-mobile"><i class="fas fa-bars"></i></a></div>
    <div class="header__center"><a class="ps-logo position-relative" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('application/assets/images/img/logo-dark.png'); ?>" alt="">
        <span style="position: absolute;bottom: -1.2rem;right: 0;color: #285C7F;font-size:1rem;">Beta</span>
      </a></div>
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
    <ul class="menu--mobile">
      <!-- Before Login -->
      <?php if (!$logged) { ?>
        <li><a href="<?php echo base_url() . 'hirefreelancer'; ?>">Hire Freelancer</a></li>
        <li><a href="<?php echo base_url() . 'freelancerproject'; ?>">Find Projects</a></li>
        <li><a href="<?php echo base_url() . 'blog'; ?>">Blog</a></li>
        <li><a href="<?php echo base_url() . 'about'; ?>">About Us</a></li>
      <?php } ?>
      <!-- After login -->
      <?php if ($moduleAction == 'candidate') { ?>
        <?php if ($logged) { ?>
          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'candidate/dashboard'; ?>" title="Dashboard">Dashboard</a>
          </li>

          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'candidate/search/jobs'; ?>" title="Jobs">Jobseekers</a>
          </li>

          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'candidate/search/companies'; ?>" title="Jobs">Companies/Employers</a>
          </li>
        <?php } ?>
      <?php } ?>

      <?php if ($moduleAction == 'freelancer') { ?>
        <?php if ($logged) { ?>
          <!-- <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'freelancer/dashboard'; ?>" title="Dashboard">Dashboard</a>
          </li> -->

          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'freelancer/search/jobs'; ?>" title="Jobs">Hire Freelancers</a>
          </li>

          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'blog'; ?>" title="Blog">Blog</a>
          </li>
        <?php } ?>
      <?php } ?>

    </ul>



    <div class="mt-3">
      <?php if ($logged) { ?>
        <?php if ($user) { ?>
          <a class="ps-btn ps-btn--outline mb-2" href="javascript:void(0)"><?php echo $user['email']; ?></a>
        <?php } ?>
        <a class="ps-btn mb-2" href="<?php echo base_url() . 'logout'; ?>">Logout</a>
      <?php } else { ?>
        <a class="ps-btn ps-btn--outline mb-2" href="<?php echo base_url() . 'login'; ?>" style="color:white">Login</a>
        <a class="ps-btn mb-2" href="<?php echo base_url() . 'register'; ?>">Sign Up</a>
      <?php } ?>
    </div>
  </div>
</div>