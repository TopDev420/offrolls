<!-- Menubar -->
    <?php include APPPATH. 'views/company/include/menubar.php'; ?>
    <!-- Menubar End -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/main.css'); ?>">
    <style type="text/css">
        .alice-bg {
            background: white !important;
        }
    </style>

    <style type="text/css">
    	/* .card, .card-body {
		    background-color: #EAEAEA;
		} */
		.checked {
			color: #00AFA0 !important;
		}
        /* .candidates-card-header {
            background-color: #EAEAEA !important;
        } */
        .filter-option {
            background-color: white;
        }
        .skill-and-profile .skill a {
            background: #F5F5F7 !important;
        }
        .skill-and-profile .skill a:hover {
           color: green !important;
        }
    </style>

   <!--  <style type="text/css">
    	.vertical__line {
		    border-left: 10px solid white;
		}  
    </style> -->
    

    <div class="section-default-header"></div>

    <!-- Breadcrumb -->
    <div class="alice-bg pt-5">
        <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="breadcrumb-area">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>company/dashboard">HOME</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="#" style="background-color: #4CB9BD; color: white;">SEARCH CANDIDATE</a>
                  </li>
                </ul>
                  <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <?php if($breadcrumb){ ?>
                        <?php foreach ($breadcrumb as $key => $value) { ?>
                          <li class="breadcrumb-item"><a href="<?php echo $value['href']; ?>"><?php echo $value['name']; ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    </ol>
                  </nav> -->
                </div>
                <div class="breadcrumb-area" style="background-image: linear-gradient(to right, #285C7F , #4CB9BD); padding: 5px !important;">
                </div>
              </div>
              <div class="col-md-6 text-right">
                <a href="<?php echo base_url().'company/jobs/candidate/post/add'; ?>" class="ps-btn"  title="Post a Job"><!-- <i class="fas fa-plus"></i> --> POST A JOB</a>
              </div>
            </div>
           
        </div>
    </div>
    <!-- Breadcrumb End -->
    

    <div class="alice-bg py-5">
        <div class="container no-gliters">
            <div class="row no-gliters">
                <div class="col-12">
                    <div class="card card-body alice-bg card-shadow candidates-card-header">
                        <div class="row align-items-center">
                            <div class="col overlay-actionsz" style="color: #7F8388 !important;">
                                <a href="javascript:void(0)" class="button-default small mr-2 btn-email light-gray-color" style="margin-left: 45px;"><!-- <i data-feather="mail"></i> --> Email</a>
                                <a href="javascript:void(0)" class="button-default small mr-2 btn-download light-gray-color"><!-- <i data-feather="download"></i>  -->Download</a>
                                <a href="javascript:void(0)" class="button-default small mr-2 btn-pipeline light-gray-color"><!-- <i data-feather="pocket"></i> --> Pipeline</a>
                                <a href="javascript:void(0)" class="button-default small mr-2 btn-archive light-gray-color"><!-- <i data-feather="archive"></i> --> Archive</a>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="col-12" style="background-color: white; padding: 5px !important;">
                </div>
                <div class="col-12">
                    <div class="candidate-container mb-4 card card-body">
                       
                              <div class="col-md-12">
                                    <div class="row">
                                    <div class="col-md-3 order-md-1">
                                    <div class="jy-card text-center card card-body py-5 card-shadow mb-4">
                                        <div class="box">
                                        <img src="<?php echo $candidate['thumb']; ?>" class="img-fluid" alt="" style="border-radius: 45%;">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-9 order-md-1">
                                    <div class="jy-card text-center card card-body py-5 card-shadow mb-4">
                                        <div class="box">
                                        <div class="row">
                                            <!-- <div class="col-md-6"> -->
                                            <!--  <div class="row"> -->
                                             	<div class="col-md-4">
                                            	<h5 style="color: #7F8388;"><?php echo $candidate['name']; ?></h5>
                                            	</div>
                                            	<div class="col-md-2">                                      	
                                                <a href="javascript:void(0)" class="ub-action mr-2 btn-email light-gray-color" style="color: #00AFA0;"><!-- <i data-feather="mail"></i> --> <?php echo $candidate['email']; ?></a>
                                                </div>
                                                <div class="col-md-6">
                                                    <span data-feather="star" class="checked"></span>
                                                    <span data-feather="star" class="checked"></span>
                                                    <span data-feather="star" class="checked"></span>
                                                    <span data-feather="star" class="checked"></span>
                                                    <span data-feather="star" class="checked"></span>
                                                </div>
                                             <!-- </div>   -->
                                           <!--  </div> -->
                                           
                                        </div><br/>
                                        <div class="row">
                                          
                                             	<div class="col-md-12">
                                            	<p class="mb-3 light-gray-color"><?php echo $candidate['about']; ?></p>
                                            	</div>
                                            	               
                                        </div><br/>
                                        <div class="row">
                                            <!-- <div class="col-md-6"> -->
                                            <!--  <div class="row"> -->
                                             	<!-- <div class="col-md-4" style="background-color: #EAEAEA; margin-left: 20px;">
                                            	 <a href="javascript:void(0)" class="ub-action mr-2 btn-email light-gray-color"><i style="color: #00AFA0;" data-feather="mail"></i> <?php echo $candidate['email']; ?></a>
                                            	</div> -->
                                            	<div class="col-md-4" style="margin-left: 20px;">                                      	
                                                <a href="javascript:void(0)" class="ub-action mr-2 btn-download light-gray-color"><i style="color: #00AFA0;" data-feather="phone"></i> <?php echo $candidate['mobile']; ?></a>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="row" style="background-color: #F5F5F7 !important; padding: 5px;">
                                                    <label style="color: #00AFA0; font-weight: bold; padding-top: 5px;">Action: </label>
                                                    <div class="col-md-6" style="margin-left: 20px; background-color: white !important;">
                                                        <select class="selectpicker">
                                                            <option>Applied</option>
                                                            <option>Shortlist</option>
                                                            <option>Schedule Interview</option>
                                                            <option>Join & Offer</option>
                                                        </select>
                                                    </div>
                                                    <div style="padding-top: 3px; margin-left: 10px;">
                                                        <a href="javascript:void(0)" title="Remove" class="button-default small danger-bg-gradient text-center remove btn-remove"><i data-feather="x-circle"></i></a>
                                                    </div>
                                                </div>
                                               
                                                </div>
                                             <!-- </div>   -->
                                           <!--  </div> -->
                                           
                                        </div>
                                       </div>
                                    </div>
                                    </div>
                                   
                              </div>

                            </div>
                             <div class="candidate-container mb-4 card card-body" style="background-image: linear-gradient(to right, #285C7F , #4CB9BD); padding: 5px !important;">
                            </div>
                        </div>
                    </div>

             
                <div class="col-12">
                    <div class="row">

                      <div class="col-12 mb-4 d-none">
                        <div class="dashboard-content-wrapper card-shadow">
                            <div class="personal-information m-0 dashboard-section details-section">
                                <h4><i data-feather="user"></i>Candidate Details</h4>
                                <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6 info-inner">
                                        <p class="txt-view"><span>Exp.</span> 10 Years</p>
                                        <p class="txt-view"><span>Current Designation:</span> Assistant Manager Administration</p>
                                        <p class="txt-view"><span>Current Company:</span> Alpha G Corp</p>
                                        <p class="txt-view"><span>Functional Area:</span> HR/Administration/IR</p>
                                        <p class="txt-view"><span>Industry:</span> Facility Management</p>
                                    </div>
                                    <div class="col-md-6 info-inner">
                                        <p class="txt-view"><span>Current Location:</span> Guragon</p>
                                        <p class="txt-view"><span>Pref. Location:</span> Delhi, Goa, Hyderabad</p>
                                        <p class="txt-view"><span>Education:</span> Alpha G Corp</p>
                                        <p class="txt-view"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone primary-color"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> 9874563258</p>
                                        <p class="txt-view"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail primary-color"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> chaitra.siva@gmail.com</p>
                                    </div>
                                    <div class="col-12 info-inner">
                                        <p class="txt-view"><span>Key Skills:</span> Assistant Manager Operation, Vendor Management, Housekeeping Management, Administration Manager, Facility Management, Office Administration</p>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-12 mb-4">
                        <div class="dashboard-content-wrapper shadow" style="border-radius: 16px;">
                            <div class="about-details details-section dashboard-section">
                                <h4><i data-feather="align-left"></i>Profile Summary</h4>
                                <p><?php echo $candidate['about']; ?></p>
                            </div>
                        </div>
                      </div>

                      <div class="col-12 mb-4">
                        <div class="dashboard-content-wrapper shadow" style="border-radius: 16px;">
                            <div class="experience dashboard-section details-section">
                                <h4><i data-feather="briefcase"></i>Work Experiance</h4>
                                <?php if($candidate['experience']) { ?>
                                    <?php foreach($candidate['experience'] as $experience){ ?>
                                      <div class="experience-section">
                                        <span class="service-year"><?php echo view_date_format($experience->cwe_start_date); ?> - <?php echo view_date_format($experience->cwe_end_date); ?></span>
                                        <h5><?php echo $experience->cwe_job_title; ?><span>@ <?php echo $experience->cwe_company_name; ?></span></h5>
                                        <p>Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>
                                      </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <h5 class="text-center">Not Available</h5>
                                <?php } ?>
                            </div>
                        </div>
                      </div>

                      <div class="col-12 mb-4">
                        <div class="dashboard-content-wrapper shadow" style="border-radius: 16px;">
                            <div class="edication-background details-section dashboard-section">
                                <h4><i data-feather="book"></i>Education</h4>
                                <?php if($candidate['education']) { ?>
                                    <?php foreach($candidate['education'] as $education){ ?>
                                      <div class="education-label">
                                        <span class="study-year"><?php echo $education->ce_yop; ?></span>
                                        <h5><?php echo $education->ce_specialization; ?><span>@ <?php echo $education->ce_institute; ?></span></h5>
                                        <p>Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>
                                      </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <h5 class="text-center">Not Available</h5>
                                <?php } ?>
                            </div>
                        </div>
                      </div>


                      <div class="col-12 mb-4">
                        <div class="dashboard-content-wrapper shadow" style="border-radius: 16px;">
                            <div class="skill-and-profile details-section dashboard-section">
                                <div class="skill">
                                  <h4><i data-feather="briefcase"></i>Skills</h4>
                                  <div class="skills-section">
                                    <?php if($candidate['skills']) { ?>
                                      <?php foreach($candidate['skills'] as $skill) { ?>
                                        <a href="#"><?php echo $skill['name']; ?></a>
                                      <?php } ?>
                                    <?php } else { ?>
                                        <h5 class="text-center">Not Available</h5>
                                    <?php } ?>
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-12 mb-4">
                        <div class="dashboard-content-wrapper shadow" style="border-radius: 16px;">
                            <div class="experience dashboard-section details-section">
                                <h4><i data-feather="globe"></i>Languages Known</h4>
                                <div class="languages-section table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Language</th>
                                                <th>Proficiency</th>
                                                <th class="text-center">Read</th>
                                                <th class="text-center">Write</th>
                                                <th class="text-center">Speak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>English</td>
                                                <td>Expert</td>
                                                <td class="text-center"><i class="fas fa-check-circle"></i></td>
                                                <td class="text-center"><i class="fas fa-check-circle"></i></td>
                                                <td class="text-center"><i class="fas fa-check-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Hindi</td>
                                                <td>Expert</td>
                                                <td class="text-center"><i class="fas fa-check-circle"></i></td>
                                                <td class="text-center"><i class="fas fa-check-circle"></i></td>
                                                <td class="text-center"><i class="fas fa-check-circle"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Bengali</td>
                                                <td>Expert</td>
                                                <td class="text-center"><i class="fas fa-times-circle"></i></td>
                                                <td class="text-center"><i class="fas fa-times-circle"></i></td>
                                                <td class="text-center"><i class="fas fa-check-circle"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-12 mb-4">
                        <div class="dashboard-content-wrapper shadow" style="border-radius: 16px;">
                            <div class="experience dashboard-section details-section">
                                <h4><i data-feather="book"></i>Projects</h4>
                                <?php if($candidate['project']) { ?>
                                    <?php foreach($candidate['project'] as $project){ ?>
                                      <div class="experience-section">
                                        <h5><?php echo $project->cp_name; ?><span>@ <?php echo $project->cp_company_name; ?></span></h5>
                                        <?php $start_date = json_decode($project->cp_start_date); ?>
                                        <?php $end_date = json_decode($project->cp_end_date); ?>
                                        <span class="service-year"><?php echo getMonthByKey($start_date->month) . ' ' . $start_date->year ?> - <?php echo getMonthByKey($end_date->month) . ' ' . $end_date->year ?></span>
                                        <p><?php echo $project->cp_description; ?></p>
                                      </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <h5 class="text-center">Not Available</h5>
                                <?php } ?>
                            </div>
                        </div>
                      </div>

                      <div class="col-12 mb-4">
                        <div class="dashboard-content-wrapper shadow" style="border-radius: 16px;">
                            <div class="personal-information m-0 dashboard-section details-section">
                                <h4><i data-feather="user-plus"></i>Personal Deatils</h4>
                                <?php $personal_details = $candidate['personal_details']; ?>
                                <ul>
                                  <li><span>Father&aposs Name:</span> <?php echo $personal_details['father_name']; ?></li>
                                  <li><span>Mother&aposs Name:</span> <?php echo $personal_details['mother_name']; ?></li>
                                  <li><span>Date of Birth:</span> <?php echo view_date_format($personal_details['dob']); ?></li>
                                  <li><span>Nationality:</span> <?php echo $personal_details['nationality']; ?></li>
                                  <li><span>Sex:</span> <?php echo ucfirst($personal_details['gender']); ?></li>
                                  <li><span>Address:</span> <?php echo $personal_details['address']; ?></li>
                                </ul>
                            </div>
                        </div>
                      </div>

                      <div class="col-12 mb-4">
                        <div class="dashboard-content-wrapper shadow" style="border-radius: 16px;">
                            <div class="download-resume dashboard-section details-section">
                                <h4 class="d-block w-100"><i data-feather="paperclip"></i>Attached Document</h4>
                                <?php $resume = $candidate['resume']; ?>
                                <div class="resume-section clearfix w-100">
                                    <?php if($resume){ ?>
                                        <span class=""><?php echo $resume['name']; ?></span>
                                        <div class="float-md-right">
                                            <a href="<?php echo $resume['download']; ?>" class="button-default small alice-bg" download style="background-color: #F5F5F7 !important;"> <i data-feather="download"></i> Download</a>
                                            <a href="<?php echo $resume['download']; ?>" class="button-default small alice-bg" target="_blank" style="background-color: #F5F5F7 !important; "> <i data-feather="eye" ></i> View</a>
                                        </div>
                                    <?php } else { ?>
                                        <h5 class="text-center">Not Available</h5>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

