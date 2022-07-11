<?php
    $moduleAction = isset($moduleAction) ? $moduleAction : '';
    $user = isset($user) ? $user : array();
    $logged = isset($logged) ? $logged : false;
    $profile_progress = isset($logged) ? $profile_progress : 0;
?>

<?php if($logged){ ?>
  <div class="dashboard-sidebar">
    <?php if($user){ ?>
    <div class="user-info">
      <div class="thumb">
        <img src="<?php echo $user['thumb']; ?>" class="img-fluid" alt="">
      </div>
      <div class="user-body">
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
        <li><i class="fas fa-home"></i><a href="<?php echo base_url() . 'freelancer/dashboard'; ?>">Dashboard</a></li>
        <li><i class="fas fa-user"></i><a href="<?php echo base_url() . 'freelancer/profile'; ?>">Edit Profile</a></li>
        <li><i class="fas fa-file-alt"></i><a href="<?php echo base_url() . 'freelancer/jobprofile'; ?>">Job Profile</a></li>
        <li><i class="fas fa-check-square"></i><a href="<?php echo base_url() . 'freelancer/job'; ?>">My Works</a></li>
      </ul>
      <ul class="delete">
        <li><i class="fas fa-power-off"></i><a href="<?php echo base_url() . 'freelancer/logout'; ?>">Logout</a></li>
      </ul>

    </div>
  </div>
<?php } ?>
