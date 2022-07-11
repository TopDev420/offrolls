        
     <!-- Menubar -->
    <?php include APPPATH. 'views/freelancer/include/menubar.php'; ?>
    <?php $job_types = get_job_types(); ?>
    <?php 
        $salary_periods = get_salary_periods(); 
        $years = getYears();
        $months = getMonths();
        $is_profileCompleted = isset($freelancer['is_profileCompleted']) ? $freelancer['is_profileCompleted'] : 0;
        $is_published = isset($freelancer['is_published']) ? $freelancer['is_published'] : 0;
    ?>

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
  </style>

  <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">

    <div class="padding-top-60 padding-bottom-60">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-containerz" id="dashboard-container">

              <div class="dashboard-content-wrapperz">

                <?php if(!$is_profileCompleted){ ?>
                    <div class="card mb-4 card-shadow">
                        <div class="card-body p-4">
                            <h6 class="text-info text-center">Please complete profile</h6>
                        </div>
                    </div>
                <?php } ?>

                <?php if(!$is_published){ ?>
                    <div class="card mb-4 card-shadow">
                        <div class="card-body p-4">
                            <h6 class="text-info text-center">Please publish profile</h6>
                        </div>
                    </div>
                <?php } ?>

                <!-- Project Summary -->
                <?php include APPPATH.'views/company/include/freelancer_profile/general.php'; ?>

                <!-- Project Summary -->
                <?php include APPPATH.'views/company/include/freelancer_profile/profile_summary.php'; ?>

                <!-- Education -->
                <?php include APPPATH.'views/company/include/freelancer_profile/education.php'; ?>

                <!-- Skills -->
                <?php include APPPATH.'views/company/include/freelancer_profile/skills.php'; ?>

                <!-- Experience -->
                <?php include APPPATH.'views/company/include/freelancer_profile/experience.php'; ?>

                <!-- Projects Section -->
                <?php include APPPATH.'views/company/include/freelancer_profile/project.php'; ?>

                <!-- Certification Section -->
                <?php include APPPATH.'views/company/include/freelancer_profile/certification.php'; ?>

                <!-- Desired Job Detail -->
                <?php include APPPATH.'views/company/include/freelancer_profile/desired_job.php'; ?>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>


    
