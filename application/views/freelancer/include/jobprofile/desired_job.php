<style>
  #formlanguages .dropdown-menu a {
    margin: 0;
    display: block;
  }

  .language-block {
    padding: 1rem;
    display: block;
    background-color: #fff;
  }

  .language-category {
    padding: 3px 15px;
    margin-right: 5px;
    border-radius: 3px;
    display: inline-block;
    background-color: #f9fbfe;
  }

  .card-section {
    display: inline-block;
    width: 100%;
  }

  .button--gprimary {
    padding: 7px 10px;
    color: #246df8;
    background: rgba(36, 109, 248, 0.15);
    border-color: transparent;
    border-radius: 3px;
    margin-right: 0.5rem;
  }
</style>
<div class="language-and-profile details-section dashboard-section p-0 mt-0 mb-5" id="nav-languages">
  <div class="jy-card card language card-section card-shadow" style="border-radius: 3px;">
    <div class="language-heading d-block card-header p-3 clearfix">
      <h5 class="mb-0 font-500 d-inline-block card-title"><i data-feather="git-branch"></i> Language Known:</h5>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-default btn-lg float-right" id="edit-languages">
        <i class="fas fa-edit"></i>
      </button>
    </div>

    <div class="card-body p-3">
      <div id="desired-job-detail-block" data-timeline-loader="true" class="loader-section"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-language" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="title">
              <h4><i data-feather="git-branch"></i>Select Your languages</h4>
            </div>
            <div class="content">
              <form action="#" id="formDesiredJob">
                <div class="form-group row">
                  <label class="col-sm-4">Language</label>
                  <div class="col-sm-8">
                    <input type="text" name="languages" class="form-control" placeholder="Search languages">
                  </div>
                  <div class="col-sm-8">
                    <div id="language-category" class="language-block" style="height: 150px; overflow: auto;">

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
</div>

<?php $this->document->addScript(base_url('application/assets/js/include/freelancer/desired_job.js'), 'footer'); ?>