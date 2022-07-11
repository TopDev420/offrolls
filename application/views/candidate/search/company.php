    <!-- Menubar -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>"> 
    <?php include APPPATH. 'views/include/menubar.php'; ?>
    <!-- Menubar End -->

    <style type="text/css">
    	.alice-bg {
	        background-color: white !important;
	      }
	    .employer:hover {
            border-radius: 5px;
          }
    </style>

    <div class="section-default-header"></div>

    <!-- Breadcrumb -->
    <?php include APPPATH. 'views/candidate/include/breadcrumb.php'; ?>
    <!-- Breadcrumb End -->

    <!-- Job Listing -->
    <div class="alice-bg section-padding-bottom shadow">
      <div class="container">
        <div class="row no-gutters">
          <div class="col">
            <div class="employer-container">
              <div class="filtered-employer-wrapper w-100">
                <div class="employer-view-controller-wrapper">
                  <div class="employer-view-controller">
                    <div class="controller list active">
                      <i data-feather="menu"></i>
                    </div>
                    <div class="controller grid">
                      <i data-feather="grid"></i>
                    </div>
                    <!--<div class="employer-view-filter">
                      <select class="selectpicker">
                        <option value="" selected>Most Recent</option>
                        <option value="california">Top Rated</option>
                        <option value="las-vegas">Most Popular</option>
                      </select>
                    </div>-->
                  </div>
                  <div class="showing-number">
                    <!--<span>Showing 1–12 of 28 Jobs</span>-->
                  </div>
                </div>
                <div class="employer-filter-result">
                    <?php if($companies) { ?>
                      <?php foreach($companies as $company) { ?>
                        <div class="employer shadow" style="border-radius: 16px;">
                          <div class="thumb">
                            <a href="javascript:void(0)">
                              <img src="<?php echo $company['thumb']; ?>" class="img-fluid" alt="">
                            </a>
                          </div>
                          <div class="body">
                            <div class="content">
                              <h4><a href="<?php echo $company['view']; ?>"><?php echo $company['company_name']; ?></a></h4>
                              <div class="info">
                                <?php if($company['company_category']){ ?><span class="company-category"><i data-feather="briefcase"></i><?php echo $company['company_category']; ?></span><?php } ?>
                                <span class="location"><i data-feather="map-pin"></i><?php echo $company['city']; ?></span>
                              </div>
                            </div>
                            <div class="button-area">
                              <a class="ps-btn ps-btn--sm" href="<?php echo $company['view']; ?>"><?php echo $company['total_jobs']; ?> Open Positions</a>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    <?php } else { ?>
                      <p>No Details</p>
                    <?php } ?>
                </div>

                <?php if($pagination) { ?>
                  <div class="pagination-list text-center">
                    <nav class="navigation pagination">
                      <div class="nav-links">
                        <?php echo $pagination; ?>
                      </div>
                    </nav>
                  </div>
                <?php } ?>
              </div>

              <!-- Filter wrapper -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Job Listing End -->

    <!-- Call to Action -->
    <?php include APPPATH. 'views/include/module_actions.php'; ?>
    <!-- Call to Action End -->

