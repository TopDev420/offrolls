<?php
$months = isset($months) ? $months : array();
$yearss = isset($yearss) ? $years : array();
?>

<div class="jy-card card experience dashboard-section details-section p-0 card-shadow mt-0 mb-5" id="nav-projects" style="border-radius: 3px;">
  <div class="d-block card-header p-4 clearfix">
    <h5 class="font-500 d-inline-block card-title"><i data-feather="grid"></i> Projects/Portfolio</h5>
  </div>

  <div class="card-body px-5">
      <p>Add details about projects you have done in college, internship or at work.</p>
      <div id="project-block" data-timeline-loader="true"></div>
  </div>

  <!-- Modal -->
  <div class="modal fade modal-experience" id="modal-project" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="title">
            <h4><i data-feather="briefcase"></i>Project/Portfolio</h4>
          </div>
          <div class="content">
            <form action="#" id="formProject" method="post">
              <div class="input-block-wrap">
                <div class="form-group row">
                  <label class="col-sm-3 control-label mandatory">Name :</label>
                  <div class="col-sm-8">
                      <input type="text" name="project_name" class="form-control project-name" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 control-label mandatory">Company :</label>
                  <div class="col-sm-8">
                      <input type="text" name="project_company_name" class="form-control project-company-name" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 control-label mandatory">Url :</label>
                  <div class="col-sm-8">
                      <input type="text" name="project_url" class="form-control project-url" />
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Status :</label>
                  <div class="col-sm-8">
                      <div class="form-control">
                        <label>
                          <input type="radio" name="project_status" value="1" class="project-status" > In Progress
                        </label>
                        <label>
                          <input type="radio" name="project_status" value="0" class="project-status" checked > Finished
                        </label>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 control-label mandatory">Start Date :</label>
                  <div class="col-md-8 ele--jqvalid">
                    <div class="row">
                      <div class="col-6">
                          <select class="selectpicker project-start-year" id="projectStartYear" data-datepicker="select" name="project_start_date[year]" title="Year">
                              <?php if($years){ ?>
                                  <?php foreach($years as $year){ ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                  <?php } ?>
                              <?php } ?>
                          </select>
                      </div>
                      <div class="col-6">
                          <select class="selectpicker project-start-month" id="projectStartMonth" data-datepicker="select" name="project_start_date[month]" title="Month">
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
                <div class="form-group row ele--jqvalid" id="project-enddate-row">
                  <label class="col-md-3 control-label mandatory">End Date :</label>
                  <div class="col-md-8 ele--jqvalid">
                    <div class="row">
                      <div class="col-6">
                          <select class="selectpicker project-end-year" id="projectEndYear" data-datepicker="select" name="project_end_date[year]" title="Year">
                              <?php if($years){ ?>
                                  <?php foreach($years as $year){ ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                  <?php } ?>
                              <?php } ?>
                          </select>
                      </div>
                      <div class="col-6">
                          <select class="selectpicker project-end-month" id="projectEndMonth" data-datepicker="select" name="project_end_date[month]" title="Month">
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
                  <label class="col-sm-3 control-label mandatory">Description :</label>
                  <div class="col-sm-8">
                      <textarea name="project_description" class="form-control project-description"></textarea>
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
  <div class="modal fade modal-delete" id="modal-delete-project" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4><i data-feather="trash-2"></i>Delete Project</h4>
          <p>Are you sure! You want to delete. This can't be undone!</p>
          <form id="formDeleteProject" action="#" method="post">
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

<?php $this->document->addScript(base_url('application/assets/js/include/admin/freelancer/project.js'), 'footer'); ?>

<script>
    $(function(){
        $('#formProject .project-status').click(function(){
            var val = $(this).val();
            if(val == 1){
                $('#project-enddate-row').hide();
            } else {
                $('#project-enddate-row').show();
            }
        });
    });
</script>
