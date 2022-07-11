<?php
    $moduleAction = isset($moduleAction) ? $moduleAction : '';
    $user = isset($user) ? $user : array();
    $logged = isset($logged) ? $logged : false;
    $profile_progress = isset($logged) ? $profile_progress : 0;
    $menu_section = isset($menu_section) ? $menu_section : '';
?>
<?php if($logged){ ?>
<div class="dashboard-sidebar">
    <?php if($user){ ?>
    <div class="company-info">
      <div class="thumb">
        <img src="<?php echo $user['thumb']; ?>" class="img-fluid" alt="">
      </div>
      <div class="company-body">
        <h5><?php echo $user['name']; ?></h5>
        <span><?php echo $user['email']; ?></span>
      </div>
    </div>
    <?php } ?>

    <div class="profile-progress">
      <div class="progress-item">
        <div class="progress-head">
          <p class="progress-on">Profile</p>
        </div>
        <div class="progress-body">
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $profile_progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
          </div>
          <p class="progress-to"><?php echo $profile_progress; ?>%</p>
        </div>
      </div>
    </div>
    <div class="dashboard-menu">
      <ul>
        <li><i class="fas fa-home"></i><a href="<?php echo base_url() . 'company/dashboard'; ?>">Dashboard</a></li>
        <li><i class="fas fa-user"></i><a href="<?php echo base_url(). 'company/profile'; ?>">Edit Profile</a></li>

        <?php if($menu_section == 'job_seeker'){ ?>
          <li><i class="fas fa-briefcase"></i><a href="javascript:void(0)">JobSeeker</a></li>
          <li><a href="<?php echo base_url() . 'company/jobs/candidate/post'; ?>">Manage Jobs</a></li>
          <li><a href="<?php echo base_url() . 'company/activity/candidate/pipelined'; ?>">Pipelined</a></li>
          <li><a href="<?php echo base_url() . 'company/activity/candidate/archived'; ?>">Archived</a></li>
        <?php } elseif($menu_section == 'freelancer'){ ?>
          <li><i class="fas fa-briefcase"></i><a href="javascript:void(0)">Freelancer</a></li>
          <li><a href="<?php echo base_url() . 'company/jobs/freelancer/post'; ?>">Manage Jobs</a></li>
          <!--<li><a href="<?php echo base_url() . 'company/activity/freelancer/accepted'; ?>">Manage Freelancers</a></li>
          <li><a href="<?php echo base_url() . 'company/activity/freelancer/shortlisted'; ?>">Shortlisted Resumes</a></li>
          <li><a href="<?php echo base_url() . 'company/activity/freelancer/scheduled'; ?>">Scheduled Interview</a></li>-->
        <?php } else { ?>
          <li><i class="fas fa-briefcase"></i><a href="<?php echo base_url('company/jobs/candidate/post'); ?>">Job Seeker</a></li>
          <li><i class="fas fa-briefcase"></i><a href="<?php echo base_url('company/jobs/freelancer/post'); ?>">Freelancer</a></li>
        <?php } ?>

      </ul>
      <ul class="delete">
        <li><i class="fas fa-power-off"></i><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
      </ul>

    </div>
  </div>
<?php } ?>
