    <style>
      .candidate .thumb img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
      }

      .job-filter-wrapper .job-filter .nstSlider,
      .candidate-filter-wrapper .job-filter .nstSlider,
      .employer-filter-wrapper .job-filter .nstSlider,
      .job-filter-wrapper .candidate-filter .nstSlider,
      .candidate-filter-wrapper .candidate-filter .nstSlider,
      .employer-filter-wrapper .candidate-filter .nstSlider,
      .job-filter-wrapper .employer-filter .nstSlider,
      .candidate-filter-wrapper .employer-filter .nstSlider,
      .employer-filter-wrapper .employer-filter .nstSlider {
        width: 100%;
        height: 3px;
        margin: 20px 0 37px;
        background: #e3e3e3;
        cursor: auto;
      }

      .job-filter-wrapper .job-filter .nstSlider .bar,
      .candidate-filter-wrapper .job-filter .nstSlider .bar,
      .employer-filter-wrapper .job-filter .nstSlider .bar,
      .job-filter-wrapper .candidate-filter .nstSlider .bar,
      .candidate-filter-wrapper .candidate-filter .nstSlider .bar,
      .employer-filter-wrapper .candidate-filter .nstSlider .bar,
      .job-filter-wrapper .employer-filter .nstSlider .bar,
      .candidate-filter-wrapper .employer-filter .nstSlider .bar,
      .employer-filter-wrapper .employer-filter .nstSlider .bar {
        height: 3px;
        top: 0;
        min-width: 0;
        background: var(--css-primary-color);
      }

      .job-filter-wrapper .job-filter .nstSlider .leftGrip,
      .candidate-filter-wrapper .job-filter .nstSlider .leftGrip,
      .employer-filter-wrapper .job-filter .nstSlider .leftGrip,
      .job-filter-wrapper .candidate-filter .nstSlider .leftGrip,
      .candidate-filter-wrapper .candidate-filter .nstSlider .leftGrip,
      .employer-filter-wrapper .candidate-filter .nstSlider .leftGrip,
      .job-filter-wrapper .employer-filter .nstSlider .leftGrip,
      .candidate-filter-wrapper .employer-filter .nstSlider .leftGrip,
      .employer-filter-wrapper .employer-filter .nstSlider .leftGrip,
      .job-filter-wrapper .job-filter .nstSlider .rightGrip,
      .candidate-filter-wrapper .job-filter .nstSlider .rightGrip,
      .employer-filter-wrapper .job-filter .nstSlider .rightGrip,
      .job-filter-wrapper .candidate-filter .nstSlider .rightGrip,
      .candidate-filter-wrapper .candidate-filter .nstSlider .rightGrip,
      .employer-filter-wrapper .candidate-filter .nstSlider .rightGrip,
      .job-filter-wrapper .employer-filter .nstSlider .rightGrip,
      .candidate-filter-wrapper .employer-filter .nstSlider .rightGrip,
      .employer-filter-wrapper .employer-filter .nstSlider .rightGrip {
        height: 15px;
        width: 15px;
        background: #ffffff;
        border: 3px solid var(--css-primary-color);
        top: -6px;
        padding-left: 5px;
        cursor: pointer;
      }

      .job-filter-wrapper .job-filter .nstSlider .grip-label,
      .candidate-filter-wrapper .job-filter .nstSlider .grip-label,
      .employer-filter-wrapper .job-filter .nstSlider .grip-label,
      .job-filter-wrapper .candidate-filter .nstSlider .grip-label,
      .candidate-filter-wrapper .candidate-filter .nstSlider .grip-label,
      .employer-filter-wrapper .candidate-filter .nstSlider .grip-label,
      .job-filter-wrapper .employer-filter .nstSlider .grip-label,
      .candidate-filter-wrapper .employer-filter .nstSlider .grip-label,
      .employer-filter-wrapper .employer-filter .nstSlider .grip-label {
        padding-top: 20px;
      }

      .job-filter-wrapper .job-filter .nstSlider .grip-label .leftLabel:before,
      .candidate-filter-wrapper .job-filter .nstSlider .grip-label .leftLabel:before,
      .employer-filter-wrapper .job-filter .nstSlider .grip-label .leftLabel:before,
      .job-filter-wrapper .candidate-filter .nstSlider .grip-label .leftLabel:before,
      .candidate-filter-wrapper .candidate-filter .nstSlider .grip-label .leftLabel:before,
      .employer-filter-wrapper .candidate-filter .nstSlider .grip-label .leftLabel:before,
      .job-filter-wrapper .employer-filter .nstSlider .grip-label .leftLabel:before,
      .candidate-filter-wrapper .employer-filter .nstSlider .grip-label .leftLabel:before,
      .employer-filter-wrapper .employer-filter .nstSlider .grip-label .leftLabel:before,
      .job-filter-wrapper .job-filter .nstSlider .grip-label .rightLabel:before,
      .candidate-filter-wrapper .job-filter .nstSlider .grip-label .rightLabel:before,
      .employer-filter-wrapper .job-filter .nstSlider .grip-label .rightLabel:before,
      .job-filter-wrapper .candidate-filter .nstSlider .grip-label .rightLabel:before,
      .candidate-filter-wrapper .candidate-filter .nstSlider .grip-label .rightLabel:before,
      .employer-filter-wrapper .candidate-filter .nstSlider .grip-label .rightLabel:before,
      .job-filter-wrapper .employer-filter .nstSlider .grip-label .rightLabel:before,
      .candidate-filter-wrapper .employer-filter .nstSlider .grip-label .rightLabel:before,
      .employer-filter-wrapper .employer-filter .nstSlider .grip-label .rightLabel:before {
        content: "₹";
      }

      .job-filter-wrapper .job-filter .nstSlider .grip-label .leftLabel:after,
      .candidate-filter-wrapper .job-filter .nstSlider .grip-label .leftLabel:after,
      .employer-filter-wrapper .job-filter .nstSlider .grip-label .leftLabel:after,
      .job-filter-wrapper .candidate-filter .nstSlider .grip-label .leftLabel:after,
      .candidate-filter-wrapper .candidate-filter .nstSlider .grip-label .leftLabel:after,
      .employer-filter-wrapper .candidate-filter .nstSlider .grip-label .leftLabel:after,
      .job-filter-wrapper .employer-filter .nstSlider .grip-label .leftLabel:after,
      .candidate-filter-wrapper .employer-filter .nstSlider .grip-label .leftLabel:after,
      .employer-filter-wrapper .employer-filter .nstSlider .grip-label .leftLabel:after {
        content: '-';
        padding-left: 8px;
        padding-right: 5px;
      }

    </style>

    <!-- Menubar -->
    <?php include APPPATH . 'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->

    <!-- Breadcrumb -->
    <?php include APPPATH . 'views/company/include/breadcrumb.php'; ?>
    <!-- Breadcrumb End -->

    <!-- Job Listing -->
    <div class="alice-bg section-padding-bottom">
      <div class="container">
        <!-- <div class="row no-gutters">
          <div class="col"> -->
        <div class="row candidate-container">
          <div class="col-md-8 order-md-1 order-2">
            <div class="filtered-candidate-wrapper">
              <!-- <div class="candidate-view-controller-wrapper">
                    <div class="candidate-view-controller">
                      <div class="controller list active">
                        <i data-feather="menu"></i>
                      </div>
                      <div class="controller grid">
                        <i data-feather="grid"></i>
                      </div>
                      <div class="candidate-view-filter">
                        <select class="form-control">
                          <option value="" selected>Most Recent</option>
                          <option value="california">Top Rated</option>
                          <option value="las-vegas">Most Popular</option>
                        </select>
                      </div>
                    </div>
                    <div class="showing-number">
                      <span>Showing 1–12 of 28 Jobs</span>
                    </div>
                  </div> -->
              <div class="candidate-filter-result">
                <?php if ($candidates) { ?>
                  <?php foreach ($candidates as $candidate) { ?>
                    <div class="card card-body mb-4">
                      <div class="candidate">
                        <div class="thumb">
                          <a href="#">
                            <img src="<?php echo $candidate['thumb']; ?>" class="img-fluid" alt="">
                          </a>
                        </div>
                        <div class="body">
                          <div class="content">
                            <h4><a href="javascript:void(0)"><?php echo $candidate['name']; ?></a></h4>
                            <div class="info">
                              <span class="work-post"><a href="#"><i data-feather="check-square"></i>developer</a></span>
                              <span class="location"><a href="#"><i data-feather="map-pin"></i><?php echo $candidate['city']; ?></a></span>
                            </div>
                          </div>
                          <?php if ($candidate['resume_link']) { ?>
                            <div class="button-area">
                              <a href="<?php echo $candidate['resume_link']; ?>">View Resume</a>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                <?php } ?>
              </div>

              <?php if ($pagination) { ?>
                <div class="pagination-list text-center">
                  <nav class="navigation pagination">
                    <div class="nav-links">
                      <?php echo $pagination; ?>
                    </div>
                  </nav>
                </div>
              <?php } ?>

            </div>
          </div>

          <div class="col-md-4 order-md-2 order-1">
            <div class="candidate-filter-wrapper">
              <div class="selected-options same-pad mb-4">
                <div class="selection-title">
                  <h4>You Selected</h4>
                  <a href="#">Clear All</a>
                </div>
                <ul class="filtered-options">
                </ul>
              </div>
              <div class="candidate-filter-dropdown same-pad category mb-4">
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
              <div class="candidate-filter-dropdown same-pad location mb-4">
                <select class="selectpicker">
                  <option value="" selected>Location</option>
                  <option value="california">Chicago</option>
                  <option value="california">New York City</option>
                  <option value="california">San Francisco</option>
                  <option value="california">Washington</option>
                  <option value="california">Boston</option>
                  <option value="california">Los Angeles</option>
                  <option value="california">Seattle</option>
                  <option value="california">Las Vegas</option>
                  <option value="california">San Diego</option>
                </select>
              </div>
              <div data-id="candidate-type" class="candidate-filter same-pad candidate-type mb-4">
                <h4 class="option-title">Job Type</h4>
                <ul>
                  <li class="full-time"><label data-attr="Full Time"><input type="checkbox" name="job_type" value="full-time" />&nbsp;&nbsp;Full Time</label></li>
                  <li class="part-time"><label data-attr="Full Time"><input type="checkbox" name="job_type" value="part-time" />&nbsp;&nbsp;Part Time</label></li>
                  <li class="freelance"><label data-attr="Full Time"><input type="checkbox" name="job_type" value="freelance" />&nbsp;&nbsp;Freelance</label></li>
                  <li class="temporary"><label data-attr="Full Time"><input type="checkbox" name="job_type" value="temporary" />&nbsp;&nbsp;Temporary</label></li>
                </ul>
              </div>
              <div data-id="experience" class="candidate-filter same-pad experience mb-4">
                <h4 class="option-title">Experience</h4>
                <ul>
                  <li><label data-attr="Fresh"><input type="radio" name="experience" value="fresh" />&nbsp;&nbsp;Fresh</label></li>
                  <li><label data-attr="Less than 1 year"><input type="radio" name="experience" value="less-than-1-year" />&nbsp;&nbsp;Less than 1 year</label></li>
                  <li><label data-attr="2 Year"><input type="radio" name="experience" value="2-year" />&nbsp;&nbsp;2 Year</label></li>
                  <li><label data-attr="3 Year"><input type="radio" name="experience" value="3-year" />&nbsp;&nbsp;3 Year</label></li>
                  <li><label data-attr="4 Year"><input type="radio" name="experience" value="4-year" />&nbsp;&nbsp;4 Year</label></li>
                  <li><label data-attr="5 Year"><input type="radio" name="experience" value="5-year" />&nbsp;&nbsp;5 Year</label></li>
                  <li><label data-attr="Avobe 5 Years"><input type="radio" name="experience" value="above-5-years" />&nbsp;&nbsp;Avobe 5 Years</label></li>
                </ul>
              </div>
              <div class="candidate-filter same-pad mb-4">
                <h4 class="option-title">Salary Range</h4>
                <div class="price-range-slider">
                  <div class="nstSlider" data-range_min="0" data-range_max="10000" data-cur_min="0" data-cur_max="6130">
                    <div class="bar"></div>
                    <div class="leftGrip"></div>
                    <div class="rightGrip"></div>
                    <div class="grip-label">
                      <span class="leftLabel"></span>
                      <span class="rightLabel"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div data-id="post" class="candidate-filter same-pad post mb-4">
                <h4 class="option-title">Date Posted</h4>
                <ul>
                  <li><label data-attr="Last hour"><input type="radio" name="post_date" value="above-5-years" />&nbsp;&nbsp;Last hour</label></li>
                  <li><label data-attr="Last 24 hour"><input type="radio" name="post_date" value="above-5-years" />&nbsp;&nbsp;Last 24 hour</label></li>
                  <li><label data-attr="Last 7 days"><input type="radio" name="post_date" value="above-5-years" />&nbsp;&nbsp;Last 7 days</label></li>
                  <li><label data-attr="Last 14 days"><input type="radio" name="post_date" value="above-5-years" />&nbsp;&nbsp;Last 14 days</label></li>
                  <li><label data-attr="Last 30 days"><input type="radio" name="post_date" value="above-5-years" />&nbsp;&nbsp;Last 30 days</label></li>
                </ul>
              </div>
              <div data-id="gender" class="candidate-filter same-pad gender mb-4">
                <h4 class="option-title">Gender</h4>
                <ul>
                  <li><label data-attr="Male"><input type="radio" name="gender" value="male" />&nbsp;&nbsp;Male</label></li>
                  <li><label data-attr="Female"><input type="radio" name="gender" value="female" />&nbsp;&nbsp;Female</label></li>
                </ul>
              </div>
              <div data-id="qualification" class="candidate-filter same-pad qualification mb-4">
                <h4 class="option-title">Qualification</h4>
                <ul>
                  <li><label data-attr="Matriculation"><input type="radio" name="qualification" value="matriculation" />&nbsp;&nbsp;Matriculation</label></li>
                  <li><label data-attr="Intermidiate"><input type="radio" name="qualification" value="intermidiate" />&nbsp;&nbsp;Intermidiate</label></li>
                  <li><label data-attr="Gradute"><input type="radio" name="qualification" value="gradute" />&nbsp;&nbsp;Gradute</label></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- </div>
        </div> -->
      </div>
    </div>
    <!-- Job Listing End -->

    <!-- Call to Action -->
    <!-- <div class="call-to-action-bg padding-top-90 padding-bottom-90">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="call-to-action-2">
              <div class="call-to-action-content">
                <h2>For Find Your Dream Job or Candidate</h2>
                <p>Add resume or post a job. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec.</p>
              </div>
              <div class="call-to-action-button">
                <a href="add-resume.html" class="ps-btn ps-btn--outline ps-btn--white">Add Resume</a>
                <span>Or</span>
                <a href="post-job.html" class="ps-btn">Post A Job</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- Call to Action End -->

    <script src="<?php echo base_url('application/assets/dashboard/js/dashboard.js'); ?>"></script>
    <script src="<?php echo base_url('application/assets/dashboard/js/datePicker.js'); ?>"></script>
    <script src="<?php echo base_url('application/assets/dashboard/js/upload-input.js'); ?>"></script>