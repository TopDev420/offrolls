    <!-- Menubar -->
    <?php include APPPATH. 'views/candidate/include/menubar.php'; ?>
    <!-- Menubar End -->
    <div class="section-default-header"></div>
    
    <!-- Job Listing -->
    <div class="alice-bg section-padding">
      <div class="container">
        <div class="row no-gutters">
          <div class="col">
            <div class="employer-container">
              <div class="filtered-employer-wrapper">
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
                    <div class="employer">
                      <div class="thumb">
                        <a href="#">
                          <img src="<?php echo base_url('application/assets/images/company/'. $company->image); ?>" class="img-fluid" alt="">
                        </a>
                      </div>
                      <div class="body">
                        <div class="content">
                          <h4><a href="employer-details.html"><?php echo $company->company_name; ?></a></h4>
                          <div class="info">
                            <span class="company-category"><a href="#"><i data-feather="briefcase"></i>Design &amp; Creative</a></span>
                            <span class="location"><a href="#"><i data-feather="map-pin"></i><?php echo $company->address; ?></a></span>
                          </div>
                        </div>
                        <div class="button-area">
                          <a href="#">12 Open Positions</a>
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
              <div class="employer-filter-wrapper">
                <div class="selected-options same-pad">
                  <div class="selection-title">
                    <h4>You Selected</h4>
                    <a href="#">Clear All</a>
                  </div>
                  <ul class="filtered-options">
                  </ul>
                </div>
                <div class="employer-filter-dropdown same-pad category">
                  <select class="selectpicker">
                    <option value="" selected>Category</option>
                    <option value="california">Accounting / Finance</option>
                    <option value="california">Education</option>
                    <option value="california">Design &amp; Creative</option>
                    <option value="california">Health Care</option>
                    <option value="california">Engineer &amp; Architects</option>
                    <option value="california">Marketing &amp; Sales</option>
                    <option value="california">Garments / Textile</option>
                    <option value="california">Customer Support</option>
                    <option value="california">Digital Media</option>
                    <option value="california">Telecommunication</option>
                  </select>
                </div>
                <div class="employer-filter-dropdown same-pad location">
                  <select class="selectpicker">
                    <option value="" selected>Location</option>
                    <option value="hyderabad">Hyderabad /  Secunderabad</option>
                    <option value="bangaluru">Bengaluru/ Bangalore </option>
                    <option value="chennai">Chennai</option>
                    <option value="delhi">Delhi/ NCR</option>
                    <option value="mumbai">Mumbai</option>
                    <option value="pune">Pune</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Job Listing End -->

    <!-- Call to Action -->
    <div class="call-to-action-bg padding-top-90 padding-bottom-90">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="call-to-action-2">
              <div class="call-to-action-content">
                <h2>For Find Your Dream Job or Candidate</h2>
                <p>Add resume or post a job. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec.</p>
              </div>
              <div class="call-to-action-button">
                <a href="add-resume.html" class="button">Add Resume</a>
                <span>Or</span>
                <a href="post-job.html" class="button">Post A Job</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Call to Action End -->

