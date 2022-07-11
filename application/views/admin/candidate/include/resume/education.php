<div class="card border-0 mb-4 alice-bg2">
  <div class="card-body p-5">
      <div class="edication-background details-section dashboard-section" id="nav-educations">
        
        <div class="d-block mb-3">
          <h4><i data-feather="book"></i>Education</h4>
        </div>
        <p>Add details of your educational qualification</p>
        <div id="education-block" data-timeline-loader="true">
        </div>
        
        <!-- Modal -->
        <div class="modal fade modal-education" id="modal-education" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #EAEAEA;">
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
                      <div class="form-group row">
                          <label class="col-md-4">Course Type</label>
                          <div class="col-md-8">
                            <div class="form-control">
                              <label>
                                <input type="radio" name="education_course_type" value="part_time" class="edu_part_time" checked> Part Time
                              </label>
                              <label>
                                <input type="radio" name="education_course_type" value="full_time" class="edu_full_time" > Full Time
                              </label>
                              <label>
                                <input type="radio" name="education_course_type" value="correspondence" class="edu_correspondance" > Correspondence
                              </label>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-md-4">Description</label>
                          <div class="col-md-8">
                            <textarea name="education_description" class="education-description form-control"></textarea>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
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

<?php $this->document->addScript(base_url('application/assets/js/include/admin/candidate/education.js'), 'footer'); ?>