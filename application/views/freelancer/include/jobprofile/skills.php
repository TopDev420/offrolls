<style>
  #formSkills .dropdown-menu a {
    margin: 0;
    display: block;
  }

  .skill-block {
    padding: 1rem;
    display: block;
    background-color: #fff;
  }

  .skill-category {
    border-radius: 6px;
    display: inline-block;
    margin-bottom: 0.5rem;
  }

  .skill-category .bg {
    background-color: #f9fbfe;
  }

  .card-section {
    display: inline-block;
    width: 100%;
  }
</style>
<div class="skill-and-profile details-section dashboard-section p-0 mt-0 mb-5" id="nav-skills">
  <div class="jy-card card skill card-section card-shadow" style="border-radius: 3px;">
    <div class="skill-heading d-block card-header p-3 clearfix">
      <h5 class="mb-0 font-500 d-inline-block card-title"><i data-feather="git-branch"></i> Skills:</h5>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-default btn-lg float-right" id="edit-skills">
        <i class="far fa-edit"></i>
      </button>
    </div>

    <div class="card-body p-3">
      <div id="skills-block" class="skill-list loader-section" data-timeline-loader="true">
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-skill" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="title">
              <h4><i data-feather="git-branch"></i>Select Your Skills and Expertise</h4>
            </div>
            <div class="content">
              <form action="#" id="formSkills">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="text" name="skills" class="form-control" placeholder="Search Skills">
                  </div>
                  <div class="col-sm-12">
                    <div id="skill-category" class="skill-block row" style="min-height: 150px; overflow: auto;">
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

<?php $this->document->addScript(base_url('application/assets/js/include/freelancer/skills.js'), 'footer'); ?>