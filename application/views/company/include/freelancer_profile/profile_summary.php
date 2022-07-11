  <div class="jy-card card about-details details-section dashboard-section p-0 card-shadow mt-0 mb-5" id="nav-profile-summary" style=" border-radius: 3px;">
  <div class="d-block card-header p-4 clearfix" >
    <h5 class="font-500 d-inline-block card-title"><i data-feather="align-left"></i> Profile Summary</h5>
  </div>

  <div class="card-body px-5">
      <p>Describe your strength, skills, accomblishment and education etc. </p>
      <div id="profile-summary-block" data-timeline-loader="true"></div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modal-profile-summary" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="title">
            <h4><i data-feather="align-left"></i> Profile Summary</h4>
          </div>
          <div class="content">
            <form action="#" id="formProfileSummary" method="post">
              <div class="form-group row">
                <label class="col-sm-12 col-form-label mandatory">About</label>
                <div class="col-sm-12">
                  <textarea class="form-control ps_description" name="ps_description" ></textarea>
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


<?php $this->document->addScript(base_url('application/assets/js/include/company/freelancer/profile_summary.js'), 'footer'); ?>
