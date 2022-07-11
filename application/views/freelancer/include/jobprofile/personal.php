<div class="personal-information dashboard-section last-child details-section" id="nav-personal-details">
  <div class="d-block">
    <h4><i data-feather="user-plus"></i>Personal Details</h4>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary edit-resume" id="edit-personal-details">
      <i data-feather="edit-2"></i>
    </button>
  </div>

  <div id="personal-detail-block" data-timeline-loader="true">

  </div>

  <!-- Modal -->
  <div class="modal fade" id="modal-personal-detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="title">
            <h4><i data-feather="user-plus"></i>Personal Details</h4>
          </div>
          <div class="content">
            <form action="#" method="post" id="formPersonalDetail">

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Father’s Name</label>
                <div class="col-sm-9">
                  <input type="text" name="personal_father_name" class="form-control" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Mother’s Name</label>
                <div class="col-sm-9">
                  <input type="text" name="personal_mother_name" class="form-control" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Date Of Birth</label>
                <div class="col-sm-9">
                  <input type="text" name="personal_dob" class="form-control datepicker" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nationality</label>
                <div class="col-sm-9">
                  <input type="text" name="personal_nationality" class="form-control" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Gender</label>
                <div class="col-sm-9">
                  <select name="personal_gender" class="form-control" >
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-9">
                  <div class="button-group">
                  <button type="submit" class="ps-btn ps-btn--outline small">Save</button>
                        <button type="button" class="ps-btn small"  data-dismiss="modal">Cancel</button>
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

<?php $this->document->addScript(base_url('application/assets/js/include/candidate/personal.js'), 'footer'); ?>
