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
</style>
<div class="skill-and-profile details-section dashboard-section p-0 mt-0 mb-5" id="nav-skills">
  <div class="jy-card card skill card-section card-shadow" style="border-radius: 3px;">
    <div class="skill-heading d-block card-header p-4 clearfix">
      <h5 class="font-500 d-inline-block card-title"><i data-feather="git-branch"></i> Skills:</h5>
    </div>

    <div class="card-body px-5">
        <p>Add skills.</p>
        <div id="skills-block" class="skill-list loader-section" data-timeline-loader="true">
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-skill" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="title">
              <h4><i data-feather="git-branch"></i>Select Your Skills and Expertise</h4>
            </div>
            <div class="content">
              <form action="#" id="formSkills">
                <div class="form-group row">
                  <div class="col-sm-9">
                    <input type="text" name="skills" class="form-control" placeholder="Search Skills">
                  </div>
                  <div class="col-sm-9">
                    <div id="skill-category" class="skill-block" style="height: 150px; overflow: auto;">

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
</div>

<?php $this->document->addScript(base_url('application/assets/js/include/company/freelancer/skills.js'), 'footer'); ?>
