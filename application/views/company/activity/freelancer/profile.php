<!-- Menubar -->
<?php include APPPATH . 'views/company/include/menubar.php'; ?>
<!-- Menubar End -->

<style>
	.card .card-header,
	.card .card-footer {
		background-color: #ecf5f6;
	}
</style>
<div class="ps-page" id="dashboard">
	<div class="ps-dashboard ps-section--sidebar">
		<div class="container">
			<div class="ps-section__container">
				<?php if ($freelancer) { ?>
					<div class="ps-section__content mr-5">

						<?php if ($freelancer['about']) { ?>
							<figure>
								<div class="card border-0">
									<div class="card-header">
										<h4>Profile Summary</h4>
									</div>
									<div class="card-body">
										<div class="experience-section mb-4">
											<p><?php echo $freelancer['about']; ?></p>
										</div>
									</div>
								</div>
							</figure>
						<?php } ?>

						<?php if ($freelancer['education']) { ?>
							<figure>
								<div class="card border-0">
									<div class="card-header">
										<h4>Education</h4>
									</div>
									<div class="card-body">
										<?php foreach ($freelancer['education'] as $ekey => $education) { ?>
											<div class="education-label mb-4">
												<span class="study-year"><?php echo $education->ce_yop; ?></span>
												<h5><?php echo $education->ce_specialization; ?><span>@ <?php echo $education->ce_institute; ?></span></h5>
											</div>
										<?php } ?>
									</div>
								</div>
							</figure>
						<?php } ?>

						<?php if ($freelancer['experience']) { ?>
							<figure>
								<div class="card border-0">
									<div class="card-header">
										<h4>Work Experience</h4>
									</div>
									<div class="card-body">
										<?php foreach ($freelancer['experience'] as $experience) {
											$end_date = '';

											$start_date = $experience->cwe_start_date ? json_decode($experience->cwe_start_date) : '';
											if ($experience->cwe_current_company == 0) {
												$end_date = $experience->cwe_start_date ? json_decode($experience->cwe_end_date) : '';
											}
										?>
											<div class="experience-section mb-4">
												<span class="service-year mb-2 d-block">
													<?php echo date('M-Y', strtotime($start_date->year . '/' . $start_date->month . '/01')); ?> - <?php echo $experience->cwe_current_company ? 'Present' : date('M-Y', strtotime($end_date->year . '/' . $end_date->month . '/01')); ?>
												</span>
												<h5><?php echo $experience->cwe_job_title; ?><span>@ <?php echo $experience->cwe_company_name; ?></span></h5>
											</div>
										<?php } ?>
									</div>
								</div>
							</figure>
						<?php } ?>

						<?php if ($freelancer['project']) { ?>
							<figure>
								<div class="card border-0">
									<div class="card-header">
										<h4>Portfolio</h4>
									</div>
									<div class="card-body">
										<?php foreach ($freelancer['project'] as $project) {
											$end_date = '';

											$start_date = $project->cp_start_date ? json_decode($project->cp_start_date) : '';
											if ($project->cp_status !== 0) {
												$end_date = $project->cp_start_date ? json_decode($project->cp_end_date) : '';
											}
										?>
											<div class="experience-section mb-4">
												<span class="service-year mb-2 d-block">
													<?php echo date('M-Y', strtotime($start_date->year . '/' . $start_date->month . '/01')); ?> - <?php echo $project->cp_status ? 'Present' : date('M-Y', strtotime($end_date->year . '/' . $end_date->month . '/01')); ?></span>
												<h5><?php echo $project->cp_name; ?><span>@ <?php echo $project->cp_company_name; ?></span></h5>
												<p class="text-muted font-14px"><?php echo $project->cp_description; ?></p>
											</div>
										<?php } ?>
									</div>
								</div>
							</figure>
						<?php } ?>
					</div>
					<div class="ps-section__sidebar">
						<aside class="widget widget_profile widget_progress pb-0">
							<div class="ps-block--user">
								<div class="ps-block__thumbnail"><img src="<?php echo $freelancer['thumb']; ?>" alt=""></div>
								<div class="ps-block__content">
									<h4 class="mb-0"><?php echo $freelancer['name']; ?></h4>
									<div class="mb-2 ps-rating">
										<input type="hidden" class="rating" data-readonly data-filled="mdi mdi-star font-2 text-primary" value="<?php echo $freelancer['feedback']['ratings']; ?>" data-empty="mdi mdi-star-outline font-2 text-primary" data-fractions="2" />
									</div>
									<p>
										<span style="font-size: 14px;">
											<i class="fa fa-map-marker darkblue--color" aria-hidden="true"></i>&nbsp;<?php echo $freelancer['city']; ?>,<?php echo $freelancer['state']; ?>
										</span>
									</p>
								</div>
							</div>
						</aside>
						<aside class="widget widget_profile widget_connections">
							<h3 class="widget-title">Skills</h3>
							<div class="widget__content">
								<div class="row" id="skills-block">
									<!-- <div class="col-12 mb-4">
										<h5>skill</h5>
										<div class="ps-progress"><span>95%</span>
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width:95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div> -->
								</div>
								<!-- 
									<div class="mb-4">
										<p><small>--- No ---</small></p>
									</div>
								-->
							</div>
						</aside>
						<aside class="widget widget_profile widget_people">
							<h3 class="widget-title">Certifications</h3>
							<div class="widget__content px-4">
								<?php if ($freelancer['certification']) { ?>
									<?php foreach ($freelancer['certification'] as $key => $certification) { ?>
										<div class="mb-4">
											<h5><?php echo $certification->cc_name; ?></h5>
											<span class="study-year"><small><?php echo $certification->cc_completion_year; ?></small></span>
										</div>
									<?php } ?>
								<?php } else { ?>
									<div class="mb-4">
										<p><small>--- No ---</small></p>
									</div>
								<?php } ?>
							</div>
						</aside>
					</div>
				<?php } else { ?>
					<div class="ps-section__content mr-5">
						<figure>
							<div class="card border-0 text-center">
								<h4>Freelancer record not available!</h4>
							</div>
						</figure>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		$("input.rating").rating(); // Load rating
		var base_url = $base_url;
		const skillsBlock = $('#skills-block');
		//Load Certifications View
		function loadSkills() {
			var freelancer_id = '<?php echo $freelancer['freelancer_id']; ?>';
			// console.log(freelancer_id);
			$.ajax({
				url: base_url + 'company/activity/freelancer/skills/' + freelancer_id,
				type: 'post',
				dataType: 'json',
				beforeSend: function() {

				},
				success: function(res) {
					skillsBlock.html('');
					if (res.success) {
						viewSkillsSection(res.success);
					} else if (res.error) {
						viewSkillsSection([]);
						if (res.show) {
							//$.ALERT.show('info', res.message);
							Toast.fire({
								icon: 'info',
								title: res.message
							});
						}
					} else {
						viewSkillsSection([]);
						//$.ALERT.show('info', 'No Data');
						Toast.fire({
							icon: 'info',
							title: 'No Data'
						});
					}
				},
				error: function(xhr, ajaxOptions, errorThown) {
					console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
				},
				complete: function() {

				}
			});
		}

		function viewSkillsSection(skills) {
			skillsBlock.html('');
			if (skills.length > 0) {
				$.each(skills, function(ci, skill) {
					var percent = skill.percentage * 10;
					skillsBlock.append('<div class="col-12 mb-4">' +
						'<h5>' + skill.name + '</h5>' +
						'<div class="ps-progress"><span>' + percent + '%</span>' +
						'<div class="progress">' +
						'<div class="progress-bar" role="progressbar" style="width:' + percent + '%" aria-valuenow="' + percent + '" aria-valuemin="0" aria-valuemax="100"></div>' +
						'</div>' +
						'</div>' +
						'</div>');
				});
			} else {
				skillsBlock.html('<div class="mb-4">' +
					'<p><small>--- No ---</small></p>' +
					'</div>');
			}
		}
		loadSkills();
	});
</script>