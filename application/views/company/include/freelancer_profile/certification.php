<div class="jy-card card experience dashboard-section details-section p-0 card-shadow mt-0 mb-5" id="nav-certifications" style="border-radius: 3px;">
  <div class="d-block card-header p-4 clearfix">
    <h5 class="font-500 d-inline-block card-title"><i data-feather="grid"></i> Certification</h5>
  </div>

  <div class="card-body px-5">
      <p>Add details of Certification you have filed.</p>
      <div id="experience-block" data-timeline-loader="true"></div>
  </div>

  <!-- Modal -->
  <div class="modal fade modal-experience" id="modal-certification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="title">
            <h4><i data-feather="briefcase"></i>Certification</h4>
            <!-- <a href="#" class="add-more">+ Add Experience</a> -->
          </div>
          <div class="content">
            <form action="#" id="formCertification" method="post">
              <div class="input-block-wrap">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label mandatory">Name</label>
                  <div class="col-sm-9">
                    <input type="text" name="certification_name" class="form-control certification-name" />
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-3 col-form-label mandatory">Description</div>
                  <div class="col-sm-9">
                    <textarea name="certification_description" class="form-control certification-description"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-3 control-label mandatory">Year</div>
                  <div class="col-sm-9">
                      <select name="certification_completion_year" class="certification-completion-year selectpicker" title="Year">
                        <?php for($y=2001; $y<= 2020; $y++) { ?>
                          <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                        <?php } ?>
                      </select>
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
  <div class="modal fade modal-delete" id="modal-delete-certification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4><i data-feather="trash-2"></i>Delete Certification</h4>
          <p>Are you sure! You want to delete. This can't be undone!</p>
          <form id="formDeleteCertification" action="#" method="post">
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

<?php $this->document->addScript(base_url('application/assets/js/include/company/freelancer/certification.js'), 'footer'); ?>
