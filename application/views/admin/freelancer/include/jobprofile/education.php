<div class="jy-card card edication-background details-section dashboard-section p-0 card-shadow mt-0 mb-5" id="nav-educations" style="border-radius: 3px;">
  <div class="d-block card-header p-4 clearfix">
    <h5 class="font-500 d-inline-block card-title"><i data-feather="book"></i> Education</h5>
  </div>

  <div class="card-body px-5">
      <p>Add details of your educational qualification</p>
      <div id="education-block" data-timeline-loader="true"></div>
  </div>


  <!-- Modal -->
  <div class="modal fade modal-education" id="modal-education" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="title">
            <h4><i data-feather="book"></i>Education</h4>
            <!-- <a href="#" class="add-more">+ Add Education</a> -->
          </div>
          <div class="content">
            <form action="#" method="post" id="formEducation">
              <div class="input-block-wrap">
                <div class="form-group row">
                  <label class="col-md-4 mandatory">Qualification</label>
                  <div class="col-md-8">
                      <select name="education_qualification" class="education-qualification form-control" >
                          <option value="">Select</option>
                          <?php if($qualifications){ ?>
                              <?php foreach($qualifications as $qualification) { ?>
                                  <option value="<?php echo $qualification->category_id; ?>"><?php echo $qualification->name; ?></option>
                              <?php } ?>
                      	<?php } ?>
                      </select>
                  </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 mandatory">Specialization</label>
                    <div class="col-md-8">
                      <input type="text" name="education_specialization" class="education-specialization form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 mandatory">Institute</label>
                    <div class="col-md-8">
                      <input type="text" name="education_institute" class="education-institute form-control" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 mandatory">Location</label>
                    <div class="col-md-8">
                      <input type="text" name="education_location" class="education-location form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 mandatory">Passed out Year</label>
                    <div class="col-md-8">
                      <select name="education_yop" class="form-control education-yop" >
                      	<option vlaue="">Select</option>
                      	<?php for($y=2001;$y<=2020;$y++){ ?>
                      		<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                      	<?php } ?>
                      </select>
                    </div>
                </div>

              </div>
              <div class="row">
                <div class="col-sm-12">
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
  <div class="modal fade modal-delete" id="modal-delete-education" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4><i data-feather="trash-2"></i>Delete Certification</h4>
          <p>Are you sure! You want to delete. This can't be undone!</p>
          <form id="formDeleteEducation" action="#" method="post">
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

<?php $this->document->addScript(base_url('application/assets/js/include/admin/freelancer/education.js'), 'footer'); ?>
