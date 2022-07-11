<?php $moduleAction = isset($moduleAction) ? $moduleAction : ''; ?>
<?php $logged = isset($logged) ? $logged : ''; ?>

<div class="call-to-action-bg padding-top-90 padding-bottom-90">
  <div class="container">
    <div class="row">
      <div class="col">
          <?php if($moduleAction == 'candidate'){ ?>
              <div class="call-to-action-2">
              <div class="call-to-action-content">
                <h2>To Find Your Dream Job Add Resume</h2>
              </div>
              <div class="call-to-action-button">
                  <?php if($logged) { ?>
                    <a href="<?php echo base_url() . 'candidate/resume'; ?>" class="button">Add Resume</a>
                <?php } else { ?>
                    <a data-show-login="true" href="<?php echo base_url() . 'candidate/resume'; ?>" class="button" title="Add Resume">Add Resume</a>
                <?php } ?>

              </div>
            </div>
          <?php } ?>

          <?php if($moduleAction == 'company'){ ?>
              <div class="call-to-action-2">
              <div class="call-to-action-content">
                <h2>To Find Your Dream Candidate Add Post</h2>
              </div>
              <div class="call-to-action-button">
                <?php if($logged) { ?>
                    <a href="<?php echo base_url() . 'company/jobs/candidate/post/add'; ?>" class="button">Add Post</a>
                <?php } else { ?>
                    <a data-show-login="true" href="<?php echo base_url() . 'company/jobs/candidate/post/add'; ?>" class="button" title="Add Post">Add Post</a>
                <?php } ?>
              </div>
            </div>
          <?php } ?>

      </div>
    </div>
  </div>
</div>

<script>
    $(function(){
        $('a[data-show-login=true]').click(function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            var params = '';
            if(href && typeof(href) != 'undefined'){
                params = '?redirect_url='+ href;
            }
            $.ALERT.show('danger', 'Please login your account to proceed');
            setTimeout(function(){
                window.location.href= $base_url + 'login' + params;
            },1500);
        });
    });
</script>
