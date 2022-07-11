<!-- Menubar -->
<?php include APPPATH . 'views/freelancer/include/menubar.php'; ?>
<!-- Menubar End -->

<style>
  .ps-section--top {
    position: relative;
  }

  .ps-section--top .company__info {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .ps-list--social i {
    font-size: 2rem;
  }
</style>

<!--include search-sidebar-->
<div class="ps-page">
  <div class="ps-section--top bg--cover" data-background="<?php echo base_url('application/assets/images/img/bg/pages/job-detail.jpg'); ?>">
    <div class="container">
      <div class="ps-section__content">
        <div class="ps-block--job-detail-top">
          <h1><?php echo $company['company_name']; ?></h1>
          <h5><?php echo ($company['city'] ? $company['city'] . ', ' : '') . $company['state']; ?> </h5>
        </div>
      </div>
    </div>
    <div class="company__info">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col ps-job__rating">
            <div class="mb-2 ps-rating">
              <input type="hidden" name="rating_points" value="0" />
              <div class="form-group">
                <div>
                  <input type="hidden" class="rating" data-filled="mdi mdi-star font-3 text-primary" readonly data-empty="mdi mdi-star-outline font-3 text-primary" data-fractions="2" />
                </div>
              </div>
            </div>
          </div>

          <?php if ($company['web_link']) { ?>
            <div class="col text-white text-left"><span class="fas fa-globe"></span>&nbsp;<a href="$company['web_link']"><?php echo $company['web_link']; ?></a></div>
          <?php } ?>
          <?php if ($company['facebook_profile'] || $company['linkedin_profile'] || $company['instagram_profile']) { ?>
            <div class="col text-white text-right">
              <div class="ps-job__desc">
                <ul class="ps-list--social simple">
                  <?php if ($company['facebook_profile']) { ?>
                    <li><a href="<?php echo $company['facebook_profile']; ?>"><i class="fab fa-facebook-square"></i></a></li>
                  <?php } ?>
                  <?php if ($company['linkedin_profile']) { ?>
                    <li><a href="<?php echo $company['linkedin_profile']; ?>"><i class="fab fa-linkedin-square"></i></a></li>
                  <?php } ?>
                  <?php if ($company['instagram_profile']) { ?>
                    <li><a href="<?php echo $company['instagram_profile']; ?>"><i class="fab fa-instagram"></i></a></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <div class="ps-section--sidebar ps-listing">
    <div class="container">
      <div class="ps-section__container">
        <div class="ps-section__content">
          <div class="ps-job--detail">
            <div class="ps-job--detail">
              <div class="ps-job__header">
                <h2><?php echo $job['title']; ?></h2>
                <p>
                  <strong><?php if ($job['location']) { ?><i class="fas fa-map-marker-alt"></i> <span>Location: <?php echo $job['location']; ?></span> . <?php } ?><?php echo html_escape($job['job_duration']) . '   . '; ?><?php echo ucfirst($job['pay_type']); ?>: <span class="ps-highlight"><?php echo $job['pay_amount']; ?></span></strong>
                  <?php if (!$job['is_applied']) { ?>
                <div class="float-right mx-2">
                  <button class="ps-btn ps-btn--sm" data-toggle="modal" data-target="#proposal-modal">Send a quote</button>
                </div>
                <?php if (!$job['is_saved']) { ?>
                  <div class="float-right mx-2">
                    <button class="ps-btn ps-btn--outline ps-btn--sm" id="btn-save-job"><i class="fas fa-heart"></i> Save</button>
                  </div>
                <?php } else { ?>
                  <div class="float-right mx-2">
                    <button class="ps-btn ps-btn--white ps-btn--shadow ps-btn--sm ps-btn--outline" style="cursor: default;"><i class="fas fa-heart"></i> Saved</button>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="float-right mx-2">
                  <button class="ps-btn ps-btn--white ps-btn--shadow ps-btn--sm" style="cursor: default;" data-toggle="modal" data-target="#proposal-modal">Job Applied</button>
                </div>
              <?php } ?>
              </p>
              <figure>
                <figcaption>Category<span class="ps-highlight"> <?php echo html_escape($job['job_category']); ?></span></figcaption>
                <div class="ps-job__rating d-none">
                  <div class="mb-2 ps-rating">
                    <input type="hidden" name="rating_points" value="0" />
                    <div class="form-group">
                      <div>
                        <input type="hidden" class="rating" data-filled="mdi mdi-star font-3 text-primary" data-empty="mdi mdi-star-outline font-3 text-primary" data-fractions="2" />
                      </div>
                    </div>
                  </div>
                </div>
              </figure>
              </div>
              <div class="ps-job__content ps-document">
                <figure>
                  <figcaption class="ps-heading--2">Job Description</figcaption>
                  <p class="text-justify"><?php echo $job['description']; ?></p>
                </figure>
                <figure>
                  <figcaption class="ps-heading--2">Skills required</figcaption>
                  <p>
                    <?php if ($job['skills']) { ?>
                      <?php foreach ($job['skills'] as $job_skill) { ?>
                        <span class="ps-highlight"><?php echo html_escape($job_skill); ?></span>
                      <?php } ?>
                    <?php } ?>
                  </p>
                </figure>
                <figure>
                  <!-- <figcaption class="ps-heading--2">Company introduction</figcaption> -->
                  <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                      <div class="ps-job__desc">
                        <h6>Project Duration</h6>
                        <p><span class="ps-highlight"><?php echo $job['job_duration']; ?></span></p>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                      <div class="ps-job__desc">
                        <h6>Language</h6>
                        <p>
                          <?php if ($job['languages']) { ?>
                            <?php foreach ($job['languages'] as $job_language) { ?>
                              <span class="ps-tag"><?php echo $job_language; ?></span>
                            <?php } ?>
                          <?php } else { ?>
                            <span class="ps-tag"></span>
                          <?php } ?>
                        </p>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                      <div class="ps-job__desc">
                        <h6>Project Type</h6>
                        <p><span class="ps-highlight"><?php echo $job['pay_type']; ?></span></p>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                      <div class="ps-job__desc">
                        <h6>Experience Level</h6>
                        <p>
                          <span class="ps-highlight">
                            <?php if ($job['experience_level'] == 'experienced') { ?>
                              <?php echo $job['experience'] ?>
                            <?php } else { ?>
                              <?php echo $job['experience_level']; ?>
                            <?php } ?>
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                      <div class="ps-job__desc">
                        <h6>specialization</h6>
                        <p><span class="ps-highlight"><?php echo $job['job_specialization']; ?></span></p>
                      </div>
                    </div>
                    <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 ">
                                                <div class="ps-job__desc">
                                                    <h6>specialization</h6>
                                                    <p>
                                                        <span class="ps-highlight">
                                                            <?php if ($job['job_time_period']) { ?>
                                                                <?php foreach ($project_time_periods as $tpkey => $time_period) { ?>
                                                                    <?php echo $time_period; ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div> -->
                  </div>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if (!$job['is_applied']) { ?>
  <!-- Modal -->
  <div class="modal" id="proposal-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Send your Quote</h5>
          <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form class="dashboard-form" id="formJobApply">
            <div class="form-group">
              <input type="text" class="form-control" name="aj_amount" placeholder="Bid Amount" />
            </div>
            <div class="form-group">
              <textarea rows="" 5 class="form-control" name="aj_proposal" placeholder="Your Proposal"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="ps-btn ps-btn--sm">Place Bid</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<script>
  $(function() {

    var applied = '<?php echo $job["is_applied"]; ?>';
    var saved = '<?php echo $job["is_saved"]; ?>';

    var job_id = '<?php echo $job_id; ?>';

    function job_apply(form) {
      $.ajax({
        url: $base_url + 'freelancer/job/apply/' + job_id,
        type: 'post',
        data: $(form).serialize(),
        dataType: 'json',
        beforeSend: function() {
          $.FEED.showLoader();
        },
        success: function(res) {
          if (res.success) {
            //$.ALERT.show('success', res.message);
            Toast.fire({
              icon: 'success',
              title: res.message,
              timer: false
            });
            $(form)[0].reset();
            setTimeout(function() {
              location.reload();
            }, 2000);
          } else if (res.error) {
            //$.ALERT.show('danger', res.message);
            Toast.fire({
              icon: 'danger',
              title: res.message,
              timer: false
            });
          } else {
            //$.ALERT.show('danger', 'No Data');
            Toast.fire({
              icon: 'danger',
              title: 'No Data',
              timer: false
            });
          }
        },
        error: function(xhr, ajaxOptions, errorThrown) {
          console.log(xhr.responseText + ' ' + xhr.statusText);
        },
        complete: function() {
          $.FEED.hideLoader();
        }
      });
    }

    function job_bookmark() {
      $.ajax({
        url: $base_url + 'freelancer/job/bookmark/' + job_id,
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          $.FEED.showLoader();
        },
        success: function(res) {
          if (res.success) {
            //$.ALERT.show('success', res.message);
            Toast.fire({
              icon: 'success',
              title: res.message,
              timer: false
            });
            setTimeout(function() {
              location.reload();
            }, 2000);
          } else if (res.error) {
            //$.ALERT.show('danger', res.message);
            Toast.fire({
              icon: 'danger',
              title: res.message,
              timer: false
            });
          } else {
            //$.ALERT.show('danger', 'No Data');
            Toast.fire({
              icon: 'danger',
              title: 'No Data',
              timer: false
            });
          }
        },
        error: function(xhr, ajaxOptions, errorThrown) {
          console.log(xhr.responseText + ' ' + xhr.statusText);
        },
        complete: function() {
          $.FEED.hideLoader();
        }
      });
    }

    if (applied == 0) {
      $('#btn-apply-job').click(function(e) {
        e.preventDefault();
        $('#proposal-modal').modal({
          backdrop: 'static',
          keyboard: false,
          show: true
        });
      });
    }

    if (saved == 0) {
      $('#btn-save-job').click(function(e) {
        e.preventDefault();
        job_bookmark();
      });
    }

    //Validation PersonalDetail
    var formJobApply = $('#formJobApply').validate({
      rules: {
        aj_amount: {
          required: true,
          digits: true
        },
        aj_proposal: {
          required: true,
        }
      },
      messages: {
        aj_amount: {
          required: "Please enter amount",
          digits: "Amount must be in digits"
        },
        aj_proposal: {
          required: "Please enter proposal",
        }
      },
      errorElement: "em",
      errorPlacement: function(error, element) {
        // Add the `invalid-feedback` class to the error element
        error.addClass("invalid-feedback");

        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.next("label"));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
      },
      submitHandler: function(form) {
        job_apply(form);
      }
    });

  });
</script>