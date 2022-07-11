<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
     <!-- Menubar -->
    <?php include APPPATH. 'views/include/menubar.php'; ?>
    
    <div class="section-default-header"></div>

    <?php $salary_periods = get_salary_periods(); ?>

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
    .alice-bg {
        background-color: white !important;
    }

  </style>
  <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('application/assets/js/alert.js'); ?>"></script>

    <div class="alice-bg section-padding">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-container" id="dashboard-container">

              <div class="dashboard-sidebar shadow">
                <div class="dashboard-menu" >
                <h5><i data-feather="arrow-down-circle"></i> Navigation</h5>
                <ul class="sidebar-menu">
                  <li><a href="#nav-attach-document">Attach Document</a></li>
                  <li><a href="#nav-skills">Skills</a></li>
                  <li><a href="#nav-profile-summary">Profile Summary</a></li>
                  <li><a href="#nav-educations">Education</a></li>
                  <li><a href="#nav-experiences">Work Experience</a></li>
                  <li><a href="#nav-projects">Projects</a></li>
                  <li><a href="#nav-certifications">Certification</a></li>
                  <li><a href="#nav-career-details">Desired Career Details</a></li>
                  <li><a href="#nav-personal-details">Personal Details</a></li>
                  <li><a href="javascript:void(0)" id="btn-publish-resume">Publish</a></li>
                </ul>
              </div>
              </div>

              <div class="dashboard-content-wrapper shadow" style="padding:0;">
                <div style="padding:30px;">

                <!-- Attach Document -->
                <?php include 'include/resume/document.php'; ?>

                <!-- Skills -->
                <?php include 'include/resume/skills.php'; ?>

                <!-- Project Summary -->
                <?php include 'include/resume/profile_summary.php'; ?>

                <!-- Education -->
                <?php include 'include/resume/education.php'; ?>

                <!-- Experience -->
                <?php include 'include/resume/experience.php'; ?>

                <!-- Projects Section -->
                <?php include 'include/resume/project.php'; ?>

                <!-- Certification Section -->
                <?php include 'include/resume/certification.php'; ?>

                <!-- Career Detail -->
                <?php include 'include/resume/career.php'; ?>

                <!-- Personal Detail -->
                <?php include 'include/resume/personal.php'; ?>

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Call to Action -->
    <?php include APPPATH. 'views/include/module_actions.php'; ?>
    <!-- Call to Action End -->

    <script>
      $(function(){

        $('#btn-publish-resume').click(function(e){
            e.preventDefault();
            $.ajax({
                url: $base_url + 'candidate/resume/publish',
                type: 'post',
                dataType: 'json',
                beforeSend: function(){
                    $.FEED.showLoader();
                },
                success: function(res){
                    if(res.success){
                        $.ALERT.show('success', res.message);
                    } else if(res.error){
                        $.ALERT.show('danger', res.message);
                    } else {
                        $.ALERT.show('danger', 'No Data');
                    }
                },
                error: function(xhr, ajaxOptions, errorThrown){
                    console.log(xhr.responseText + ' ' + xhr.statusText);
                },
                complete: function(){
                    $.FEED.hideLoader();
                }
            });
        });

        //Fixed Sidebar
        function fixedSidebar(){
            // if($(window).width() >= 768){
                var dtop = $('#dashboard-container').offset().top;
                var wtop = $(this).scrollTop();
                var wheight = wtop + $(this).height();
                var mtop = $('.call-to-action-bg').offset().top;

                if(wtop >= dtop && wheight <= mtop){
                    $('#dashboard-container .dashboard-sidebar').addClass('fixbar--top');
                    $('#dashboard-container .dashboard-content-wrapper').addClass('ml-auto');
                } else {
                    $('#dashboard-container .dashboard-sidebar').removeClass('fixbar--top');
                    $('#dashboard-container .dashboard-content-wrapper').removeClass('ml-auto');
                }
            // }
        }

        $(window).scroll(function(){
            if($(window).width() >= 768){
                fixedSidebar();
            }
        });

      });
    </script>
