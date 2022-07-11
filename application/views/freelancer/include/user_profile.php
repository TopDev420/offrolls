<?php $user = isset($user) ? $user : ''; ?>
<?php if($user){ ?>
<div class="jy-card text-center card card-body py-5 card-shadow mb-4" style="background-color: #EAEAEA;">
   <div class="box">
      <div class="img">
         <img src="<?php echo $user['thumb']; ?>" class="img-fluid">
      </div>
      <h2 style="font-weight: bold; color: #727D90;"><?php echo $user['name']; ?></h2>
      <p style="color: #727D90;"><?php echo $user['email']; ?></p>
      <span>
      <a class="button-default small-sm primary-color alice-bg" href="<?php echo $profile_link; ?>">View Profile</a>
      </span>
   </div>
</div>
<?php } ?>
