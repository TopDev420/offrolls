<?php
$moduleAction = isset($moduleAction) ? $moduleAction : '';
$user = isset($user) ? $user : array();
$logged = isset($logged) ? $logged : false;
$static = isset($static) ?  $static : true;
?>

<header class="header header--2 dark <?php echo $static ? 'page' : 'two-line'; ?> " data-sticky="false">
  <div class="header__left"><a class="ps-logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('application/assets/images/img/Offrolls-logo.png'); ?>" alt=""></a></div>
  <div class="header__right">

    <div class="header__actions d-flex align-items-center justify-content-center">
      <ul class="menu">
        <?php if($moduleAction == 'candidate'){ ?>
          <?php if($logged){ ?>
            <li class="menu-item dropdown">
              <a href="<?php echo base_url() . 'candidate/dashboard'; ?>" title="Dashboard">Dashboard</a>
            </li>
          <?php } ?>

          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'candidate/search/jobs'; ?>" title="Jobs">Jobseekers</a>
          </li>

          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'candidate/search/companies'; ?>" title="Jobs">Companies/Employers</a>
          </li>
        <?php } ?>
      </ul>

      <div>
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
    <ul class="menu--mobile">
      <?php if($moduleAction == 'candidate'){ ?>
          <?php if($logged){ ?>
            <li class="menu-item dropdown">
              <a href="<?php echo base_url() . 'candidate/dashboard'; ?>" title="Dashboard">Dashboard</a>
            </li>
          <?php } ?>

          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'candidate/search/jobs'; ?>" title="Jobs">Jobseekers</a>
          </li>

          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'candidate/search/companies'; ?>" title="Jobs">Companies/Employers</a>
          </li>
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