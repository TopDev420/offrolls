<?php
    $moduleAction = isset($moduleAction) ? $moduleAction : '';
    $user = isset($user) ? $user : array();
    $logged = isset($logged) ? $logged : false;
    $profile_progress = isset($logged) ? $profile_progress : 0;
?>


<?php if($logged){ ?>
<div class="dashboard-sidebar card card-body shadow">
  <?php if($user){ ?>
    <div class="thumb text-center">
        <img src="<?php echo $user['thumb']; ?>" class="img-fluid" alt="" style="height: 100px !important; width: 100px !important; border-radius: 50% !important;">
    </div>
    <div class="user-info">
      <div class="company-body">
        <h5 class="text-center" style="font-weight: normal; margin-left: 17px; margin-top: 10px;"><?php echo $user['name']; ?></h5>
        <span class="text-center" style="color: #4CB9BD; font-weight: bold; margin-left: 40px;"><?php echo $user['email']; ?></span>
      </div>
    </div>
  <?php } ?>
    <!-- <h5  style="background-image: linear-gradient(to right, #285C7F , #4CB9BD); padding: 5px;"></h5> -->
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
      <ul style="font-weight: bold;">
        <li><a href="<?php echo base_url() . 'candidate/dashboard'; ?>">Dashboard</a></li>
        <li><a href="<?php echo base_url() . 'candidate/profile'; ?>">Edit Profile</a></li>
        <li><a href="<?php echo base_url() . 'candidate/resume'; ?>">Resume</a></li>
        <li><a href="<?php echo base_url() . 'candidate/job/bookmarked'; ?>">Bookmarked Jobs</a></li>
        <li><a href="<?php echo base_url() . 'candidate/job/applied'; ?>">Applied Jobs</a></li>
      </ul>
      <!-- <ul class="delete">
        <li><i class="fas fa-power-off"></i><a href="<?php echo base_url() . 'logout'; ?>">Logout</a></li>
      </ul> -->

    </div>
</div>
<?php } ?>

