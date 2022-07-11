<script>
     var base_url =  '<?php echo base_url();?>' ;
</script>
<style>
  .close_btn, .add_btn {
    cursor: pointer;
  }

  .job-post-form .basic-info-input .form-group i {
    position: relative;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    color: var(--danger);
  }

  .close_btn i {
    position: relative;
    padding: 5px;
    margin: 0;
    font-size: 1.4rem;
    line-height: 1.5;
  }

  #skill-category .skill-category,
  #technologies-category .technology-category,
  #certifications-category .certification-category {
    display: inline-block;
    background-color: rgba(242, 101, 34, 0.15);
    font-size: 1.3rem;
    padding: 0.4rem 0.8rem;
    margin: 0.4rem 0.2rem 0;
    border: 0;
    border-radius: 3px;
  }

  .category-block {
    display: block;
    border-radius: 3px;
    padding: 1.5rem;
    box-shadow: 0 .125rem 0.25rem rgba(0, 0, 0, 0.03);
    -webkit-box-shadow: 0 .125rem 0.25rem rgba(0, 0, 0, 0.03);
  }

  .category-block .category-inner-block {
      min-height: 4rem;
  }

  .category-block, .category-block .form-control {
      background-color: #f9f9f9;
  }

  .hide-block {
    display: none;
   }
   .card .card-header {
        padding: 1.2rem 1.2rem;
        border-bottom: 2px solid rgba(111, 116, 132, 0.4);
        background: rgba(36, 109, 248, 0.03);
    }
   .no-bg {
        background: none !important;
    }
    .no-bg-img {
        background-image: none !important;
    }
    [data-show=true] {
        display: block;
    }
    [data-show=false] {
        display: none;
    }
    .post-sidebar .sidebar-menu li {
        padding: 5px 15px;
        position: relative;
        margin-bottom: 2rem;
        transition: all .3s ease;
    }
    .post-sidebar .sidebar-menu li:hover, .post-sidebar .sidebar-menu li.active {
        background-color: #DCDCDC;
        /*box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.03);*/
        transition: all .3s ease;
    }
    .post-sidebar .sidebar-menu li:hover a, .post-sidebar .sidebar-menu li.active a {
        opacity: 1;
        color: #246df8;
        font-weight: 500;
    }
    .post-sidebar .sidebar-menu li:hover:before, .post-sidebar .sidebar-menu li.active:before {
        top: 0;
        height: 100%;
        width: 2% !important;
        background: #00AFA0;
    }
    .add_btn {
        background-color: #EAEAEA !important;
    }
    .close_btn  {
        background-color: #EAEAEA !important;
    }
</style>

<!-- Menubar -->
<?php include APPPATH. 'views/company/include/menubar.php'; ?>
<!-- Menubar End -->

<div class="section-default-header"></div>

<!-- Breadcrumb -->
<div class="alice-bg pt-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="breadcrumb-area">
              <nav aria-label="breadcrumb">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>company/dashboard">HOME</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="#" style="background-color: #00AFA0; color: white;">JOBS</a>
                  </li>
                </ul>
                <!-- <ol class="breadcrumb">
                  <?php if($breadcrumb){ ?>
                    <?php foreach ($breadcrumb as $key => $value) { ?>
                      <li class="breadcrumb-item"><a href="<?php echo $value['href']; ?>"><?php echo $value['name']; ?></a></li>
                    <?php } ?>
                  <?php } ?>
                </ol> -->
              </nav>
            </div>
          </div>
        </div>
        <div class="col-md-12 breadcrumb-area" style="padding: 5px !important;">
        </div>
<div class="col-md-12 breadcrumb-area" style="padding-top: 15px; padding-bottom: 15px;">
      <div class="container no-gliters" id="post-container" >
        <div class="row no-gliters">
            <div class="col-md-3">
                <div class="post-sidebar no-bg-img p-0" id="post-sidebar">
                    <div class="card-header" style="background-color: #285C7F;">
                        <h4 class="text-center" style="font-size: 15px; font-weight: normal; padding: 6px; color: white;">POST A JOB</h4>
                    </div>
                    <div class="card card-body card-shadow p-4">                
                        <ul class="sidebar-menu">
                            <li class="active"><a href="#job-getstart-section" data-nav-click="true">Title Section</a></li>
                            <li><a href="#job-description-section" data-nav-click="true" class="disabled">Description</a></li>
                            <li><a href="#job-details-section" data-nav-click="true" class="disabled">Details</a></li>
                            <li><a href="#job-expertise-section" data-nav-click="true" class="disabled">Expertise</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="">
                  <div class="post-content-wrapper no-bg p-0">
                    <form id="jobPostForm" action="<?php echo $form_action; ?>" class="job-post-form" method="post">
                      <div class="basic-info-input">

                        <div id="job-getstart-section" class="section-pane" data-show="true">
                            <div class="card  card-shadow">
                                <div class="card-header" style="background-color:  #285C7F; color: white;">
                                    <span class="float-right"> 1 of 4</span>
                                    <h4 class="m-0" style="color: white;"> Title</h4>
                                </div>
                                <div class="card-body p-5">
                                    <div class="details-section">
                                        <div class="form-group row">
                                          <label class="col-md-12 col-form-label mandatory">Job Title</label>
                                          <div class="col-md-12">
                                            <input type="text" name="job_title" class="form-control" value="<?php echo $job['title']; ?>" />
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-12 col-form-label mandatory">Industry</label>
                                            <div class="col-md-12">
                                                <input type="text" name="industry" class="form-control" value="<?php echo $job['company_category']['label']; ?>" />
                                                <input type="hidden" name="company_category" class="form-control" value="<?php echo $job['company_category']['value']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-12 col-form-label mandatory">Functional Area</label>
                                            <div class="col-md-12 ele--jqvalid" style="background-image: linear-gradient(to right, #E9E5DC , white);">
                                                <select class="selectpicker" name="job_category" title="select">
                                                    <?php if($job_categories) { ?>
                                                      <?php foreach($job_categories as $category) { ?>
                                                        <?php if($category->category_id == $job['job_category']) { ?>
                                                          <option value="<?php echo $category->category_id; ?>" selected><?php echo $category->name; ?></option>
                                                        <?php } else { ?>
                                                          <option value="<?php echo $category->category_id; ?>"><?php echo $category->name; ?></option>
                                                        <?php } ?>
                                                      <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right align-self-end">
                                            <button data-next-click="true" data-next-section="#job-description-section" type="button" href="javascript:void(0)" class="button-default small primary-bg white-text ps-btn" style="font-size: 14px;">
                                                Continue
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="job-description-section" class="section-pane" data-show="false">
                            <div class="card  card-shadow">
                                <div class="card-header" style="background-color:  #285C7F; color: white;">
                                    <span class="float-right"> 2 of 4</span>
                                    <h4 class="m-0" style="color: white;"> Description</h4>
                                </div>
                                <div class="card-body p-5">
                                    <div class="details-section">
                                        <div class="form-group row">
                                          <label class="col-md-12 col-form-label  mandatory">Enter Job Summary</label>
                                          <div class="col-md-12">
                                              <textarea rows="5" name="job_description" class="form-control"><?php echo $job['description']; ?></textarea>
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <label class="col-md-12 col-form-label">Other Benefits</label>
                                          <div class="col-md-12">
                                              <textarea name="job_benefits" class="form-control"><?php echo $job['benefits']; ?></textarea>
                                          </div>
                                        </div>

                                        <div class="text-right align-self-end">
                                            <button data-prev-click="true" data-prev-section="#job-getstart-section" type="button" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow">
                                                Back
                                            </button>
                                            <button data-next-click="true" data-next-section="#job-details-section" type="button" class="button-default small primary-bg white-text ps-btn" style="border-radius: 18px;">
                                                Continue
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="job-details-section" class="section-pane" data-show="false">
                            <div class="card  card-shadow">
                                <div class="card-header"style="background-color:  #285C7F; color: white;">
                                    <span class="float-right"> 3 of 4</span>
                                    <h4 class="m-0" style="color: white;"> Job Details</h4>
                                </div>
                                <div class="card-body p-5">
                                    <div class="card-body p-5">
                                        <div class="title-section  details-section dashboard-section p-0">

                                            <div class="form-group row">
                                                <label class="col-md-12 control-label mandatory">Gender</label>
                                                <div class="col-md-12">
                                                    <?php if($genders){ ?>
                                                        <div class="row justify-content-center align-items-center mt-5 ele--jqvalid">
                                                            <?php foreach($genders as $gkey => $gender) { ?>
                                                                <label class="col input-radio">
                                                                    <input class="custom-radio" type="radio" value="<?php echo $gkey; ?>" name="job_gender" <?php ($gkey == $job['gender'])? 'checked' : ''; ?> />
                                                                    <div class="input-wrap ">
                                                                        <div class="body">
                                                                            <span class="radio-label"><?php echo $gender; ?></span>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div id="job-salary-package" class="form-group row">
                                                <label class="col-md-3 col-form-label  mandatory">Salary Offered</label>
                                                <div class="col-md-9">
                                                    <div class="salary-package-block">
                                                      <div class="row">
                                                        <div class="col-md-4 mb-2 salary-range">
                                                          <input type="text" class="form-control" placeholder="From" value="<?php echo $job['salary_package_from']; ?>" name="job_salary_package[from]" />
                                                        </div>
                                                        <div class="col-md-4 mb-2 one-salary">
                                                          <input type="text" class="form-control" placeholder="To" value="<?php echo $job['salary_package_to']; ?>" name="job_salary_package[to]" />
                                                        </div>
                                                        <div class="col-md-4 mb-2  ele--jqvalid">
                                                          <select class="selectpicker" name="job_salary_package[period]" title="Period">
                                                            <?php if($salary_periods){ ?>
                                                                <?php foreach($salary_periods as $skey => $salary_period) { ?>
                                                                    <?php if($skey == $job['salary_package_period']) { ?>
                                                                        <option value="<?php echo $skey; ?>" selected><?php echo $salary_period; ?></option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $skey; ?>"><?php echo $salary_period; ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                          </select>
                                                        </div>
                                                        <div class="my-2 col-12">
                                                          <a class="add_btn add-new-field btn-link text-primary" id="change-salary-package">Change to one salary</a>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-12 control-label">No. of vacancy</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="job_vacancy" id="job_vacancy" class="form-control" value="<?php echo $job['job_vacancy']; ?>" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-12 control-label">Job Location</label>
                                                <div class="col-md-12">
                                                  <input type="text" name="search_location" class="form-control" value="<?php echo $job['location']; ?>" autocomplete="off" />
                                                  <input type="hidden" name="job_location" class="form-control" value="<?php echo $job['location']; ?>" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-12 control-label">Notice Period</label>
                                                <div class="col-md-12">
                                                    <select class="selectpicker" name="job_notice_period" title="select">
                                                        <?php if($notice_periods) { ?>
                                                          <?php foreach($notice_periods as $category) { ?>
                                                            <?php if($category->category_id == $job['notice_period']) { ?>
                                                              <option value="<?php echo $category->category_id; ?>" selected><?php echo $category->name; ?></option>
                                                            <?php } else { ?>
                                                              <option value="<?php echo $category->category_id; ?>"><?php echo $category->name; ?></option>
                                                            <?php } ?>
                                                          <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-12 control-label mandatory">Job Type</label>
                                                <div class="col-md-12">
                                                    <?php if($job_types) { ?>
                                                        <div class="row justify-content-center align-items-center mt-5 ele--jqvalid">
                                                            <?php foreach($job_types as $category) { ?>
                                                                <label class="col input-radio">
                                                                    <input class="custom-radio" type="checkbox" data-target="#<?php echo strtolower($category->name); ?>-jtd-block" value="<?php echo $category->category_id; ?>" name="job_type[]" <?php (in_array($category->category_id, $job['job_type'])) ? 'checked' : ''; ?> />
                                                                    <div class="input-wrap ">
                                                                        <div class="body">
                                                                            <span class="radio-label"><?php echo $category->name; ?></span>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="form-group hide-block" id="flexy-jtd-block">
                                                <div class="row">
                                                    <label class="col-md-4">Flexy -hr/day</label>
                                                    <div class="col-md-8 input-group">
                                                        <input type="text" class="form-control" name="flexy_detail[duration]">
                                                        <span class="input-group-text input-group-append bg-white border-0" style="width:30%;">
                                                            <input type="hidden" name="flexy_detail[period]" value="per_day"> Per Day
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group hide-block" id="ftp-jtd-block">
                                                <div class="row">
                                                    <label class="col-md-4">FTP - in Month</label>
                                                    <div class="col-md-8 input-group">
                                                        <input type="text" class="form-control" name="ftp_detail[duration]">
                                                        <span class="input-group-text input-group-append bg-white border-0" style="width:30%;">
                                                            <input type="hidden" name="ftp_detail[period]" value="month"> Month
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group hide-block" id="contract-jtd-block">
                                                <div class="row">
                                                    <label class="col-md-4">Contract</label>
                                                    <div class="col-md-8 input-group">
                                                        <input type="text" class="form-control" name="contract_detail[duration]">
                                                        <span class="input-group-text input-group-append bg-white border-0" style="width:30%;">
                                                            <select class="selectpicker border-0" name="contract_detail[period]" tabindex="-98">
                                                                <option value="month">Month</option>
                                                                <option value="yar">Year</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-12"></label>
                                                <div class="col-md-12">
                                                    <input name="job_expiry_date" class="form-control datepicker" autocomplete="off" value="<?php echo $job['expiry_date']; ?>" placeholder="Job Expiry Date"/>
                                                </div>
                                            </div>

                                            <div class="text-right align-self-end">
                                                <button data-prev-click="true" data-prev-section="#job-description-section" type="button" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow">
                                                    Back
                                                </button>
                                                <button data-next-click="true" data-next-section="#job-expertise-section" type="button" class="button-default small primary-bg white-text ps-btn" style="border-radius: 18px;">
                                                    Continue
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="job-expertise-section" class="section-pane" data-show="false">
                            <div class="card  card-shadow">
                                <div class="card-header" style="background-color:  #285C7F; color: white;">
                                    <span class="float-right"> 1 of 5</span>
                                    <h4 class="m-0" style="color: white"><i data-feather="edit-3"></i> Applicant Qualification</h4>
                                </div>
                                <div class="card-body p-5">
                                    <div class="expertise-section  details-section">
                                        <div class="form-group row">
                                            <label class="col-md-12 control-label">Work Experience</label>
                                            <div class="col-md-12">
                                                <select class="selectpicker" name="job_experience" title="select">
                                                    <?php if($experiences) { ?>
                                                      <?php foreach($experiences as $category) { ?>
                                                        <?php if($category->category_id == $job['experience']) { ?>
                                                          <option value="<?php echo $category->category_id; ?>" selected><?php echo $category->name; ?></option>
                                                        <?php } else { ?>
                                                          <option value="<?php echo $category->category_id; ?>"><?php echo $category->name; ?></option>
                                                        <?php } ?>
                                                      <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="job-qualification" class="form-group">
                                            <div class="row">
                                              <label class="col-md-12 col-form-label">Qualification</label>
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                <?php if($job['job_qualifications']){ ?>
                                                    <?php foreach($job['job_qualifications'] as $qkey => $qualification){ ?>
                                                        <div class="row qrow">
                                                            <?php if($qualifications) { ?>
                                                              <div class="col-md-4 mb-2">
                                                                <select class="selectpicker" title="Degree" name="job_qualifications["<?php echo $qkey; ?>"][qualification]">
                                                                <?php foreach($qualifications as $category) { ?>
                                                                    <?php if($category->category_id == $qualification->qualification) { ?>
                                                                        <option value="<?php echo $category->category_id; ?>" selected><?php echo $category->name; ?></option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $category->category_id; ?>"><?php echo $category->name; ?></option>
                                                                    <?php } ?>

                                                                <?php } ?>
                                                                </select>
                                                              </div>
                                                              <div class="col-md-6 mb-2">
                                                                  <input type="text" class="form-control" placeholder="Specialization" value="<?php echo $qualification->specialization; ?>" name="job_qualifications["<?php echo $qkey; ?>"][specialization]" />
                                                              </div>
                                                              <div class="col-md-2 mb-2">
                                                                  <span class="close_btn add-new-field"><i class="fas fa-minus"></i></span>
                                                              </div>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>

                                                  <div id="qualification-block">
                                                    <select id="qualifications-list" style="display:none;">
                                                      <?php if($qualifications) { ?>
                                                        <?php foreach($qualifications as $category) { ?>
                                                            <option value="<?php echo $category->category_id; ?>"><?php echo $category->name; ?></option>
                                                        <?php } ?>
                                                      <?php } ?>
                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="my-2">
                                                        <a class="add_btn add-new-field btn-link text-primary" id="add-qualification">&plus; Add</a>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-12 control-label mandatory">Skills</label>
                                            <div class="col-md-12">
                                                <div class="category-block">
                                                    <div id="skill-category" class="category-inner-block mb-4">
                                                        <p>Add skills</p>
                                                        <?php if($job['job_skills']){ ?>
                                                            <?php foreach($job['job_skills'] as $category){ ?>
                                                                <div class="skill-category" id="skill-inner-category<?php echo $category->category_id; ?>">
                                                                    <i class="remove-skill fas fa-times-circle"></i> <?php echo $category->name; ?>
                                                                    <input type="hidden" name="job_skills[]" value="<?php echo $category->category_id; ?>" />
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                    <input type="text" id="input-skills" class="form-control" placeholder="Skills" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-12 control-label">Certification</label>
                                            <div class="col-md-12">
                                                <div class="category-block">
                                                    <div id="certifications-category" class="category-inner-block mb-4">
                                                        <p>Add certifications</p>
                                                        <?php if($job['job_certification']){ ?>
                                                            <?php foreach($job['job_certification'] as $category){ ?>
                                                                <div class="certification-category" id="certification-inner-category<?php echo $category->category_id; ?>">
                                                                    <i class="certification-skill fas fa-times-circle"></i> <?php echo $category->name; ?>
                                                                    <input type="hidden" name="job_certification[]" value="<?php echo $category->category_id; ?>" />
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                    <input type="text" id="input-certifications" class="form-control" placeholder="Certifications" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-right align-self-end">
                                            <button data-prev-click="true" data-prev-section="#job-details-section" type="button" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow">
                                                Back
                                            </button>
                                            <button id="btn-confirm-post-draft" type="button" class="button-default small primary-bg white-text ps-btn" style="border-radius: 18px;">
                                                Save as Draft
                                            </button>
                                            <button id="btn-confirm-post-publish" type="button" class="button-default small primary-bg white-text ps-btn" style="border-radius: 18px;">
                                                save & Publish
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
</div>

    <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>
    <?php $this->document->addScript(base_url('application/assets/js/include/company/jobseeker_jobpost.js'), 'footer'); ?>

    <script>
        $(function(){

            var salary_package_from = '<?php echo $job["salary_package_from"]; ?>';
            var salary_package_to = '<?php echo $job["salary_package_to"]; ?>';
            var job_qualifications_count = '<?php echo count($job["job_qualifications"]); ?>';

            if(salary_package_from < 0 && salary_package_to){
                $('#change-salary-package').trigger('click');
            }

            //Add Qualification
            var qc = (job_qualifications_count + 1);
            $('#add-qualification').click(function(e){
              e.preventDefault();
              var qactions = '';
              //Minus Button
              if(qc > 1){
                qactions = '<div class="col-md-2 mb-2">' +
                              '<span class="close_btn add-new-field"><i class="fas fa-minus"></i></span>' +
                            '</div>' ;
              }

              //Qualification content field
              var html = '<div class="row qrow">' +
                            '<div class="col-md-4 mb-2">' +
                              '<select class="selectpicker" title="Degree" name="job_qualifications['+ qc +'][qualification]">' +
                              $('#qualifications-list').html() +
                              '</select>' +
                            '</div>' +
                            '<div class="col-md-6 mb-2">' +
                              '<input type="text" class="form-control" placeholder="Specialization" name="job_qualifications['+ qc +'][specialization]" />' +
                            '</div>' +
                            qactions +
                          '</div>';

              $('#qualification-block').append(html);
              // Bootstrap selectpicker
              $('.selectpicker').selectpicker();

              $('.qrow .close_btn').click(function(e){
                e.preventDefault();
                $(this).parent().parent().fadeOut(400).remove();
              });
              qc++;
            });

            //add qualification
            if(job_qualifications_count < 1){
                 $('#add-qualification').trigger('click');
            }

        });
    </script>

    <script>

        $(function(){

            /*Job Types */
            $('input[name=\'job_type[]\']').click(function(){
                var cthis = $(this);
                var jtd_block = cthis.data('target');
                if(jtd_block && typeof(jtd_block) != 'undefined'){
                    console.log(cthis.prop(':checked'));
                    if(cthis.hasClass('checked')){
                        $(jtd_block).fadeOut();
                        cthis.removeClass('checked');
                    } else {
                        $(jtd_block).fadeIn();
                        cthis.addClass('checked');
                    }
                }
            });
        })
    </script>
