<div class="jy-card card certification dashboard-section details-section p-0 card-shadow mt-0 mb-5" id="nav-certifications" style="border-radius: 3px;">
  <div class="d-block card-header p-3 clearfix">
    <h5 class="mb-0 font-500 d-inline-block card-title"><i data-feather="grid"></i> Certification</h5>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-default btn-lg float-right" id="add-certification">
      <i class="fas fa-plus"></i>
    </button>
  </div>

  <div class="card-body p-3">
    <div id="certification-block" data-timeline-loader="true"></div>
  </div>

  <!-- Modal -->
  <div class="modal fade modal-certification" id="modal-certification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="title">
            <h4><i data-feather="briefcase"></i>Certification</h4>
            <!-- <a href="#" class="add-more">+ Add certification</a> -->
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
                      <?php if ($years) { ?>
                        <?php foreach ($years as $year) { ?>
                          <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9">
                  <div class="button-group">
                    <button type="submit" class="ps-btn ps-btn--outline small">Save</button>
                    <button type="button" class="ps-btn small" data-dismiss="modal">Cancel</button>
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
        <h4><i data-feather="trash-2" class="m-3"></i>Delete Certification</h4>
        <p class="my-3 mx-4 text-justify">Are you sure! You want to delete. This can't be undone!</p>
        <form id="formDeleteCertification" action="#" method="post">
          <div class="buttons">
            <button type="submit" class=" ps-btn ps-btn--sm btn-yes mx-3 delete-button"><?php echo $this->lang->line('yes'); ?></button>
            <button type="button" class="ps-btn ps-btn--sm ps-btn--white ps-btn--shadow mx-2 btn-no"><?php echo $this->lang->line('no'); ?></button>
          </div>
        </form>
        <div class="alerts"></div>
      </div>
    </div>
  </div>
</div>

<?php $this->document->addScript(base_url('application/assets/js/include/freelancer/certification.js'), 'footer'); ?>