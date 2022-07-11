<div class="jy-card card experience dashboard-section details-section p-0 card-shadow mt-0 mb-5" id="nav-experiences" style="border-radius: 3px;">
  <div class="d-block card-header p-4 clearfix">
    <h5 class="font-500 d-inline-block card-title"><i data-feather="briefcase"></i>Work Experience <span class="total--experience"></span></h5>
  </div>

  <div class="card-body px-5">
      <p>Add details of your work experience</p>
      <div id="work-experience-block" data-timeline-loader="true"></div>
  </div>

  <!-- Modal -->
  <div class="modal fade modal-experience" id="modal-experience" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="title">
            <h4><i data-feather="briefcase"></i>Experience</h4>
          </div>
          <div class="content">
            <form action="#" id="formExperience" method="post">
              <div class="input-block-wrap">
                <div class="form-group row">
                  <div class="col-sm-4 mandatory">Job Title</div>
                  <div class="col-sm-8">
                      <input type="text" name="experience_job_title" class="experience-job-title form-control" />
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4 mandatory">Company Name</div>
                  <div class="col-sm-8">
                      <input type="text" name="experience_company_name" class="experience-company-name form-control" />
                  </div>
                </div>


              <div class="form-group row">
                <div class="col-sm-4">Is Your current company</div>
                <div class="col-sm-8">
                    <div class="form-control">
                      <label>
                        <input type="radio" name="experience_current_company" value="0" class="experience-current-company" checked> No
                      </label>
                      <label>
                        <input type="radio" name="experience_current_company" value="1" class="experience-current-company" > Yes
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
                <div class="col-sm-4">Description</div>
                  <div class="col-sm-8">
                      <textarea name="experience_description" class="experience-description form-control"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9">
                    <div class="button-group">
                        <button type="submit" class="button-default small-sm primary-bg white-text">Save</button>
                        <button type="button" class="button-default small-sm alice-bg border-secondary" data-dismiss="modal">Cancel</button>
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

<?php $this->document->addScript(base_url('application/assets/js/include/admin/freelancer/experience.js'), 'footer'); ?>

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
