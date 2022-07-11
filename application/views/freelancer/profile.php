<!-- Menubar -->
<?php include APPPATH . 'views/freelancer/include/menubar.php'; ?>
<?php $job_types = get_job_types(); ?>
<?php
$salary_periods = get_salary_periods();
$years = getYears();
$months = getMonths();
$is_profileCompleted = isset($freelancer['is_profileCompleted']) ? $freelancer['is_profileCompleted'] : 0;
$is_published = isset($freelancer['is_published']) ? $freelancer['is_published'] : 0;
?>

<?php include APPPATH . 'views/freelancer/include/navbar.php'; ?>

<div class="section-default-header"></div>

<!-- Menubar End -->
<style>
  .btn-action-block {
    position: absolute;
    top: 0;
    right: 0;
    padding: 7px 10px;
    color: #246df8;
  }

  .btn-action-block .btn {
    border-radius: 3px;
    border-color: transparent;
    border-radius: 3px;
    outline: none;
    -webkit-box-shadow: none;
    box-shadow: none;
  }

  .alert-danger {
    background-color: rgba(255, 51, 102, 0.15);
  }

  .alert-primary {
    background-color: rgba(36, 109, 248, 0.15);
  }

  .dashboard-section .btn-action-block svg {
    height: 15px;
    width: 15px;
  }

  #dashboard-container .dashboard-sidebar {
    transition: all 0.6s ease;
  }

  #dashboard-container .dashboard-sidebar.fixbar--top {
    position: fixed;
    top: 0;
    transition: all 0.6s ease;
  }

  .dashboard-content-wrapper .dashboard-section {
    margin-top: 60px;
  }

  .jy-card.card .card-header .button-default svg {
    color: #246df8;
    margin: 0;
  }

  .form-group {
    margin: 15px 0px;
  }
</style>

<script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">

<div class="padding-top-60 padding-bottom-60">
  <div class="container no-gliters">
    <div class="row no-gliters">
      <div class="col">
        <div class="dashboard-containerz" id="dashboard-container">

          <div class="dashboard-content-wrapperz">

            <?php if (!$is_profileCompleted) { ?>
              <div class="card mb-4 card-shadow">
                <div class="card-body p-4">
                  <h6 class="text-info text-center">Please complete profile</h6>
                </div>
              </div>
            <?php } ?>

            <?php if (!$is_published) { ?>
              <div class="card mb-4 card-shadow">
                <div class="card-body p-4">
                  <h6 class="text-info text-center">Please publish profile before going to next section</h6>
                </div>
              </div>
            <?php } ?>

            <!-- Project Summary -->
            <?php include 'include/jobprofile/general.php'; ?>

            <!-- Project Summary -->
            <?php include 'include/jobprofile/profile_summary.php'; ?>

            <!-- Education -->
            <?php include 'include/jobprofile/education.php'; ?>

            <!-- Skills -->
            <?php include 'include/jobprofile/skills.php'; ?>

            <!-- Experience -->
            <?php include 'include/jobprofile/experience.php'; ?>

            <!-- Projects Section -->
            <?php include 'include/jobprofile/project.php'; ?>

            <!-- Certification Section -->
            <?php include 'include/jobprofile/certification.php'; ?>

            <!-- Desired Job Detail -->
            <?php include 'include/jobprofile/desired_job.php'; ?>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>


<script>
  $(function() {
    var slug = '<?php echo $slug; ?>';
    $('#btn-publish-profile').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: $base_url + 'freelancer/profile/publish',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          $.FEED.showLoader();
        },
        success: function(res) {
          if (res.success) {

            $.ALERT.show('success', res.message);
            setTimeout(function() {
              window.location.href = $base_url + 'freelancer/profile/' + slug;
            }, 1500);
          } else if (res.error) {
            $.ALERT.show('danger', res.message);
          } else {
            $.ALERT.show('danger', 'No Data');
          }
        },
        error: function(xhr, ajaxOptions, errorThrown) {
          console.log(xhr.responseText + ' ' + xhr.statusText);
        },
        complete: function() {
          $.FEED.hideLoader();
        }
      });
    });

  });
</script>