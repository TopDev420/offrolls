<div class="personal-information dashboard-section last-child details-section" id="nav-career-details">
  <div class="d-block">
    <h4><i data-feather="user-plus"></i>Desired Career Details</h4>
  </div>
  
  <div id="desired-career-detail-block" data-timeline-loader="true">
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="modal-desired-career-detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="title">
            <h4><i data-feather="user-plus"></i>Desired Career Details</h4>
          </div>
          <div class="content">
            <form action="#" method="post" id="formDesiredCareerDetail" >
              <h4><i data-feather="align-left"></i>Information</h4>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Industry</label>
                <div class="col-sm-9">
                  <select class="selectpicker industry-type" name="industry_type">
                    <option value="">None</option>
                    <?php foreach($industry_types as $industry_type) { ?>
                      <option value="<?php echo $industry_type->category_id; ?>"><?php echo $industry_type->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Job Location</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control job-location"  name="job_location">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Job Type</label>
                <div class="col-sm-9">
                  <?php foreach($job_types as $jtkey => $job_type) { ?>
                    <label>
                      <input type="radio" name="job_type" class="job-type" value="<?php echo $jtkey; ?>" /><?php echo $job_type; ?>
                    </label>
                  <?php } ?>
                  
                </div>
              </div>
                            
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Salary Range</label>
                <div class="col-md-9">
                  <div class="form-group salary-package-block">
                    <div class="row">
                      <div class="col-md-4 mb-2 salary-range">
                        <input type="text" class="form-control salary-range-from" name="job_salary_range[from]" />
                      </div>
                      <div class="col-md-4 mb-2 one-salary">
                        <input type="text" class="form-control salary-range-to" name="job_salary_range[to]" />
                      </div>
                      <div class="col-md-4 mb-2">
                        <select class="selectpicker salary-period" name="job_salary_range[period]" title="Period">
                          <option value="">None</option>
                          <?php foreach($salary_periods as $spkey => $salary_period) { ?>
                            <option value="<?php echo $spkey; ?>"><?php echo $salary_period; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="my-2 col-12">
                        <a class="add_btn add-new-field btn-link text-primary" id="change-salary-package">Change to one salary</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9">
                  <div class="buttons">
                    <button type="submit" class="primary-bg">Save</button>
                    <button type="button"  class="" data-dismiss="modal">Cancel</button>
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

<?php $this->document->addScript(base_url('application/assets/js/include/company/freelancer/desired_career_detail.js'), 'footer'); ?>
<script>
  $(function(){
    //Salary Package

    $('input[name=job_type]').first().attr('checked', true);
    $('#change-salary-package').click(function(e){
      e.preventDefault();
      var par = $(this).parents('.salary-package-block');
      if($(this).hasClass('cos')) {
        $(this).removeClass('cos').text('change to one salary');
        par.find('.salary-range').show();
      } else {
        $(this).addClass('cos').text('Back to salary range');
        par.find('.salary-range').hide();
      }
    });
  });
</script>