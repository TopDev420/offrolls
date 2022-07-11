<div class="card border-0 mb-4 alice-bg2">
  <div class="card-body p-5">
    <div class="about-details details-section dashboard-section" id="nav-profile-summary">
      
      <div class="d-block mb-3">
        <h4 class="mb-3"><i data-feather="align-left"></i>Profile Summary</h4>
      </div>
      
      <p>Add profile summary with your career and education, what your professional interests are, and what kind of a career you are looking for.</p>
      <div id="profile-summary-block" data-timeline-loader="true">
        
      </div>
        

      <!-- Modal -->
      <div class="modal fade" id="modal-profile-summary" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" style="background-color: #EAEAEA;">
            <div class="modal-body">
              <div class="title">
                <h4><i data-feather="align-left"></i>Profile Summary</h4>
              </div>
              <div class="content">
                <form action="#" id="formProfileSummary" method="post">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label mandatory">About</label>
                    <div class="col-sm-9">
                      <textarea class="form-control ps_description" name="ps_description" ></textarea>
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

<?php $this->document->addScript(base_url('application/assets/js/include/admin/candidate/profile_summary.js'), 'footer'); ?>
