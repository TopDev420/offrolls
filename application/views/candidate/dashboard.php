    <!-- Menubar -->
    <?php include APPPATH. 'views/include/menubar.php'; ?>
    <!-- Menubar End -->
    <style type="text/css">
      .alice-bg {
        background-color: white !important;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
    <div class="section-default-header"></div>

    <div class="alice-bg section-padding">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-container">

              <!-- Dashboard Sidebar Start -->
              <?php include 'include/sidebar.php'; ?>
              <!-- Dashboard Sidebar End -->

              <div class="dashboard-content-wrapper shadow">
                <div class="dashboard-section user-statistic-block">
                  <div class="user-statistic" style="width:48.5%;">
                    <i data-feather="briefcase"></i>
                    <h3><?php echo $total_applied_jobs; ?></h3>
                    <span>Applied Jobs</span>
                  </div>
                  <div class="user-statistic" style="width:48.5%;">
                    <i data-feather="heart"></i>
                    <h3><?php echo $total_saved_jobs; ?></h3>
                    <span>Favourite Jobs</span>
                  </div>
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
        var json = JSON.parse('<?php echo $chart; ?>');
        console.log(json);
        var chart_labels = json.labels;
        var jobsapplied_data = json.jobsapplied;

        if ($("#view-chart").length > 0) {
            var ctx = document.getElementById("view-chart").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: chart_labels,
                datasets: [{
                  label: '# of Applied Jobs',
                  data: jobsapplied_data,
                  backgroundColor: [
                    'rgba(36, 109, 248, .2)'
                  ],
                  borderColor: [
                    'rgba(36, 109, 248, 0.1 )'
                  ],
                  borderWidth: 1
                }]
              },
              options: {
                responsive: true,
        		title: {
					display: true,
					text: 'Activity Chart'
				},
              }
            });
          }
    });
</script>
