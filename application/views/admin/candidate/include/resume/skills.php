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
<div class="card border-0 mb-4 alice-bg2">
  <div class="card-body p-5">
    <div class="skill-and-profile details-section dashboard-section" id="nav-skills">
      <div class="skill card-section">
        <div class="skill-heading mb-3">
          <h4 class=""><i data-feather="git-branch"></i> Skills:</h4>
        </div>
        
        <p>Add skills.</p>
        <div id="skills-block" class="skill-list loader-section" data-timeline-loader="true">
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal-skill" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #EAEAEA;">
              <div class="modal-body">
                <div class="title">
                  <h4><i data-feather="git-branch"></i>MY SKILL</h4>
                </div>
                <div class="content">
                  <form action="#" id="formSkills">
                    <div class="form-group row">
                      <div class="col-sm-9">
                        <input type="text" name="skills" class="form-control" placeholder="Skills">
                      </div>
                      <div class="col-sm-9">
                        <div id="skill-category" class="skill-block" style="height: 150px; overflow: auto;"> 
                          
                        </div>

                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-9">
                        <div class="buttons">
                          <button type="submit" class="primary-bg">Save</button>
                          <button type="button" data-dismiss="modal">Cancel</button>
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
</div>

<?php $this->document->addScript(base_url('application/assets/js/include/admin/candidate/skills.js'), 'footer'); ?>