<div class="card border-0 mb-4 alice-bg2">
  <div class="card-body p-5">
    <div class="experience dashboard-section details-section" id="nav-experiences">
      
      <div class="d-block">
        <h4><i data-feather="briefcase"></i>Work Experience <span class="total--experience"></span></h4>
      </div>
      <p>Add details of your work experience</p>

      <div id="work-experience-block" data-timeline-loader="true">

      </div>
        
      <!-- Modal -->
      <div class="modal fade modal-experience" id="modal-experience" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="background-color: #EAEAEA;">
            <div class="modal-body">
              <div class="title">
                <h4><i data-feather="briefcase"></i>Experience</h4>
              </div>
              <div class="content">
                <form action="#" id="formExperience" method="post">
                  <div class="input-block-wrap">
                    <div class="form-group row">
                      <label class="col-sm-4 control-label mandatory">Job Title</label>
                      <div class="col-sm-8">
                          <input type="text" name="experience_job_title" class="experience-job-title form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 control-label mandatory">Company Name</label>
                      <div class="col-sm-8">
                          <input type="text" name="experience_company_name" class="experience-company-name form-control" />
                      </div>
                    </div>


                  <div class="form-group row">
                    <label class="col-sm-4">Is Your current company</label>
                    <div class="col-sm-8">
                        <div class="">
                          <label class="mr-2">
                            <input type="radio" name="experience_current_company" value="0" class="experience-current-company" checked /> No
                          </label>

                          <label class="mr-2">
                            <input type="radio" name="experience_current_company" value="1" class="experience-current-company" /> Yes
                          </label>

                        </div>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-4 control-label mandatory">Start Date :</label>
                      <div class="col-md-8 ele--jqvalid">
                        <div class="row">
                          <div class="col-6">
                              <select class="selectpicker experience-start-year" id="experienceStartYear" data-datepicker="select" name="experience_start_date[year]" title="Year">
                                  <?php if($years){ ?>
                                      <?php foreach($years as $year){ ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                      <?php } ?>
                                  <?php } ?>
                              </select>
                          </div>
                          <div class="col-6">
                              <select class="selectpicker experience-start-month" id="experienceStartMonth" data-datepicker="select" name="experience_start_date[month]" title="Month">
                                  <?php if($months){ ?>
                                      <?php foreach($months as $mkey => $month){ ?>
                                        <option value="<?php echo $mkey; ?>"><?php echo $month; ?></option>
                                      <?php } ?>
                                  <?php } ?>
                              </select>
                          </div>
                        </div>
                        <div class="custom-errorMsg"></div>
                      </div>
                    </div>
                    <div class="form-group row ele--jqvalid" id="experience-enddate-row">
                      <label class="col-md-4 control-label mandatory">End Date :</label>
                      <div class="col-md-8 ele--jqvalid">
                        <div class="row">
                          <div class="col-6">
                              <select class="selectpicker experience-end-year" id="experienceEndYear" data-datepicker="select" name="experience_end_date[year]" title="Year">
                                  <?php if($years){ ?>
                                      <?php foreach($years as $year){ ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                      <?php } ?>
                                  <?php } ?>
                              </select>
                          </div>
                          <div class="col-6">
                              <select class="selectpicker experience-end-month" id="experienceEndMonth" data-datepicker="select" name="experience_end_date[month]" title="Month">
                                  <?php if($months){ ?>
                                      <?php foreach($months as $mkey => $month){ ?>
                                        <option value="<?php echo $mkey; ?>"><?php echo $month; ?></option>
                                      <?php } ?>
                                  <?php } ?>
                              </select>
                          </div>
                        </div>
                        <div class="custom-errorMsg"></div>
                      </div>
                    </div>

                  <div class="form-group row">
                      <label class="col-sm-4">Description</label>
                      <div class="col-sm-8">
                          <textarea name="experience_description" class="experience-description form-control"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-9">
                      <div class="buttons">
                        <button type="submit" class="primary-bg">Save</button>
                        <button type="button" class="" data-dismiss="modal">Cancel</button>
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
<!-- Delete Modal -->
  <div class="modal fade modal-delete" id="modal-delete-experience" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4><i data-feather="trash-2"></i>Delete Experience</h4>
          <p>Are you sure! You want to delete. This can't be undone!</p>
          <form id="formDeleteExperience" action="#" method="post">
            <div class="buttons">
              <button type="submit" class="btn-yes delete-button"><?php echo $this->lang->line('yes'); ?></button>
              <button type="button" class="btn-no"><?php echo $this->lang->line('no'); ?></button>
            </div>
          </form>
          <div class="alerts"></div>
        </div>
      </div>
    </div>
  </div>

<?php $this->document->addScript(base_url('application/assets/js/include/admin/candidate/experience.js'), 'footer'); ?>

<script>
    $(function(){
        $('#formExperience .experience-current-company').click(function(){
            var val = $(this).val();
            if(val == 1){
                $('#experience-enddate-row').hide();
            } else {
                $('#experience-enddate-row').show();
            }
        });
    });
</script>
