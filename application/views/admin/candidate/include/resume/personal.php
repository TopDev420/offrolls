<div class="card border-0 mb-4 alice-bg2">
  <div class="card-body p-5">
    <div class="mt-0 personal-information dashboard-section details-section" id="nav-personal-details">
      
      <div class="d-block">
        <h4><i data-feather="user-plus"></i>Personal Details</h4>
      </div>

      <div id="personal-detail-block" data-timeline-loader="true">
      </div>
        
      <!-- Modal -->
      <div class="modal fade" id="modal-personal-detail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="background-color: #EAEAEA;">
            <div class="modal-body">
              <div class="title">
                <h4><i data-feather="user-plus"></i>Personal Details</h4>
              </div>
              <div class="content">
                <form action="#" method="post" id="formPersonalDetail">

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label mandatory">Father’s Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="personal_father_name" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label mandatory">Mother’s Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="personal_mother_name" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label mandatory">Date Of Birth</label>
                    <div class="col-sm-9">
                      <input type="text" name="personal_dob" class="form-control datepicker" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label mandatory">Nationality</label>
                    <div class="col-sm-9">
                      <input type="text" name="personal_nationality" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label mandatory">Gender</label>
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

<?php $this->document->addScript(base_url('application/assets/js/include/admin/candidate/personal.js'), 'footer'); ?>
