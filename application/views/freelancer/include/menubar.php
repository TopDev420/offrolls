<?php
$moduleAction = isset($moduleAction) ? $moduleAction : '';
$user = isset($user) ? $user : array();
$logged = isset($logged) ? $logged : false;
$static = isset($static) ?  $static : true;
?>

<header class="header header--signin dark <?php echo $static ? 'page' : 'two-line'; ?> " data-sticky="false">
  <div class="header__left"><a class="ps-logo" href="<?php echo base_url(); ?>" style="position: relative;">
      <img src="<?php echo base_url('application/assets/images/img/Offrolls-logo.png'); ?>" alt="">
      <span style="position: absolute; bottom: -0.3rem; right: 0.5rem; color: #285C7F; font-size:1.2rem">Beta</span>
    </a>
  </div>
  <div class="header__right">
    <ul class="menu menu--signin">
      <?php if ($moduleAction == 'freelancer') { ?>
        <?php if ($logged) { ?>
          <!-- <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'freelancer/dashboard'; ?>" title="Dashboard">Dashboard</a>
          </li> -->
          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'freelancerproject'; ?>" title="Jobs">Find Projects</a>
          </li>
          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'blog'; ?>" title="blog">Blog</a>
          </li>
        <?php } ?>
        <?php if (!$logged) { ?>
          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'hirefreelancer'; ?>" title="freelancers">Hire Freelancer</a>
          </li>
          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'freelancerproject'; ?>" title="Jobs">Find Projects</a>
          </li>
        <?php } ?>
        <?php if (!$logged) { ?>
          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'blog'; ?>" title="blog">Blog</a>
          </li>
          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'about'; ?>" title="about-us">About Us</a>
          </li>
        <?php } ?>
      <?php } else { ?>
        <?php if ($logged) { ?>
          <!-- <li class="menu-item">
          <a href="<?php echo base_url() . 'company/dashboard'; ?>" title="Dashboard">Dashboard</a>
        </li> -->

          <li class="menu-item">
            <a href="<?php echo base_url() . 'hirefreelancer'; ?>" title="Dashboard">Hire Freelancer</a>
          </li>
          <li class="menu-item">
            <a href="<?php echo base_url() . 'blog'; ?>" title="Blog">Blog</a>
          </li>

          <!-- <li class="menu-item">
            <a href="<?php echo base_url() . 'company/search/jobseeker'; ?>" title="Dashboard">Jobseekers</a>
          </li> -->
        <?php } ?>
      <?php } ?>
    </ul>

    <div class="header__actions">
      <?php if ($moduleAction == 'freelancer') { ?>
      <?php } else { ?>
        <div class="header__search">
          <a href="<?php echo base_url() . 'company/jobs/freelancer/post/add'; ?>" class="ps-btn ps-btn--sm ps-btn--shadow mx-2" title="Post a Job">Post a Project</a>
        </div>
      <?php } ?>
      <div class="header__toggles">
        <?php if ($logged) { ?>
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

          <?php if ($user) { ?>
            <?php if ($moduleAction == 'freelancer') { ?>
              <div class="header__account header__drodown-parent" id="header-account">
                <a href="#" class="account-image"><img src="<?php echo $user['thumb']; ?>" alt=""><span class="online"></span></a>
                <div class="header__dropdown">
                  <div class="ps-block--user-header">
                    <div class="ps-block__thumbnail">
                      <img src="img/pages/user-header-banner.jpg" alt="">
                    </div>
                    <div class="ps-block__header">
                      <img src="<?php echo $user['thumb']; ?>" alt="">
                      <a href="#"><?php echo $user['email']; ?></a>
                      <!-- <p>Member Mattock</p> -->
                    </div>
                    <div class="ps-block__content">
                      <ul>
                        <li><a href="<?php echo base_url() . 'freelancer/setting'; ?>"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="<?php echo base_url() . 'logout'; ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            <?php } else { ?>
              <div class="header__account header__drodown-parent" id="header-account">
                <a href="#" class="account-image"><img src="<?php echo $user['thumb']; ?>" alt=""><span class="online"></span></a>
                <div class="header__dropdown">
                  <div class="ps-block--user-header">
                    <div class="ps-block__thumbnail">
                      <img src="img/pages/user-header-banner.jpg" alt="">
                    </div>
                    <div class="ps-block__header">
                      <img src="<?php echo $user['thumb']; ?>" alt="">
                      <a href="#"><?php echo $user['email']; ?></a>
                      <!-- <p>Member Mattock</p> -->
                    </div>
                    <div class="ps-block__content">
                      <ul>
                        <li><a href="<?php echo base_url() . 'company/settings'; ?>"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="<?php echo base_url() . 'logout'; ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          <?php } ?>
        <?php } else { ?>
          <a class="ps-btn ps-btn--outline ps-btn--sm mx-2" href="<?php echo base_url() . 'login'; ?>" style="color:white">Login</a>
          <a class="ps-btn ps-btn--sm mx-2" href="<?php echo base_url() . 'register'; ?>">Sign Up</a>
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
      <?php if (!$logged) { ?>
        <li><a href="<?php echo base_url() . 'hirefreelancer'; ?>">Hire Freelancer</a></li>
        <li><a href="<?php echo base_url() . 'freelancerproject'; ?>">Find Projects</a></li>
        <li><a href="<?php echo base_url() . 'about'; ?>">About Us</a></li>
        <li><a href="<?php echo base_url() . 'blog'; ?>">Blog</a></li>
      <?php } ?>

      <?php if ($moduleAction == 'freelancer') { ?>
        <?php if ($logged) { ?>
          <!-- <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'freelancer/dashboard'; ?>" title="Dashboard">Dashboard</a>
          </li> -->
          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'freelancerproject'; ?>" title="Jobs">Find Projects</a>
          </li>
          <li class="menu-item dropdown">
            <a href="<?php echo base_url() . 'blog'; ?>" title="blog">Blog</a>
          </li>
        <?php } ?>
      <?php } else { ?>
        <?php if ($logged) { ?>
          <!-- <li class="menu-item">
          <a href="<?php echo base_url() . 'company/dashboard'; ?>" title="Dashboard">Dashboard</a>
        </li> -->

          <li class="menu-item">
            <a href="<?php echo base_url() . 'hirefreelancer'; ?>" title="Dashboard">Hire Freelancer</a>
          </li>
          <li class="menu-item">
            <a href="<?php echo base_url() . 'blog'; ?>" title="Blog">Blog</a>
          </li>
          <!-- 
        <li class="menu-item">
          <a href="<?php echo base_url() . 'company/search/jobseeker'; ?>" title="Dashboard">Jobseekers</a>
        </li> -->
        <?php } ?>
      <?php } ?>
    </ul>
    <div class="mt-3">
      <?php if ($logged) { ?>
        <?php if ($user) { ?>
          <a class="ps-btn ps-btn--outline ps-btn--sm m-2" href="javascript:void(0)"><?php echo $user['email']; ?></a>
          <?php if ($moduleAction !== 'freelancer') { ?>
            <a href="<?php echo base_url() . 'company/jobs/freelancer/post/add'; ?>" class="ps-btn ps-btn--sm ps-btn--shadow m-2" title="Post a Job"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;Post a Project</a>
          <?php } ?>
        <?php } ?>
        <a class="ps-btn ps-btn--sm m-2" href="<?php echo base_url() . 'logout'; ?>">Logout</a>
      <?php } else { ?>
        <a class="ps-btn ps-btn--outline ps-btn--sm mb-2" href="<?php echo base_url() . 'login'; ?>" style="color:white">Login</a>
        <a class="ps-btn ps-btn--sm mb-2" href="<?php echo base_url() . 'register'; ?>">Sign Up</a>
      <?php } ?>
    </div>
  </div>
</div>


<?php include 'alert_block.php'; ?>

<script>
  $(function() {
    var header_account = $("#header-account");
    var account_header = header_account.find(".account-image");

    account_header.click(function(e) {
      e.preventDefault();
      header_account
        .find(".header__dropdown")
        .css({
          visibility: "visible",
          opacity: "1"
        });
    });

    header_account.focusout(function() {
      header_account
        .find(".header__dropdown")
        .css({
          visibility: "hidden",
          opacity: "0"
        });
    });

  });
</script>