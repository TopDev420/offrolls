<!-- Menubar Top Start -->
<?php include APPPATH . 'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->
<style type="text/css">
    .card-style {
        /* background-color: #F5F5F7; */
    }

    .count__style {
        background-color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        color: #2C9972;
    }

    .block__style:hover {
        border-top: 10px solid #4CB9BD;
    }

    .text-center {
        color: #A9A9A9 !important;
    }

    .text-center:hover {
        color: #328C82 !important;
    }
</style>

<div class="container-fluid">
    <div class="row alice-bg">
        <div class="col-12 no-gliters p-0">
            <div class="dashboard-container">
                <!-- Dashboard Menubar-->
                <?php include APPPATH . 'views/admin/include/menubar.php'; ?>

                <!-- Dashboard Content-->
                <div class="dashboard-content-wrapper">
                    <div class="card-body dashboard-applied">
                        <!-- Breadcrumb -->
                        <?php include APPPATH . 'views/admin/include/breadcrumb.php'; ?>

                        <div class="list-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="jy-card card mb-5 border card-style">
                                        <div class="card-body p-5 block__style">
                                            <!-- <div class="d-flex align-items-center justify-content-between"> -->
                                            <h6 class="text-center">Jobs</h6>
                                            <h6 class="text-center count__style"><?php echo $total_jobs; ?></h6>
                                            <!--  </div> -->
                                        </div>
                                        <div class="card-footer py-2 px-5">
                                            <a class="button primary-color" href="<?php echo base_url() . 'admin/candidate/job'; ?>">View <i data-feather="chevrons-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="jy-card card mb-5 border card-style">
                                        <div class="card-body p-5 block__style">
                                            <!-- <div class="d-flex align-items-center justify-content-between"> -->
                                            <h6 class="text-center">Projects</h6>
                                            <h6 class="text-center count__style"><?php echo $total_projects; ?></h6>
                                            <!--  </div> -->
                                        </div>
                                        <div class="card-footer py-2 px-5">
                                            <a class="button primary-color" href="<?php echo base_url() . 'admin/freelancer/job'; ?>">View <i data-feather="chevrons-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="jy-card card mb-5 border card-style">
                                        <div class="card-body p-5 block__style">
                                            <!-- <div class="d-flex align-items-center justify-content-between"> -->
                                            <h6 class="text-center">Company</h6>
                                            <h6 class="text-center count__style"><?php echo $total_companies; ?></h6>
                                            <!-- </div> -->
                                        </div>
                                        <div class="card-footer py-2 px-5">
                                            <a class="button primary-color" href="<?php echo base_url() . 'admin/company'; ?>">View <i data-feather="chevrons-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="jy-card card mb-5 border card-style">
                                        <div class="card-body p-5 block__style">
                                            <!-- <div class="d-flex align-items-center justify-content-between"> -->
                                            <h6 class="text-center">Freelancer</h6>
                                            <h6 class="text-center count__style"><?php echo $total_freelancers; ?></h6>
                                            <!-- </div> -->
                                        </div>
                                        <div class="card-footer py-2 px-5">
                                            <a class="button primary-color" href="<?php echo base_url() . 'admin/freelancer'; ?>">View <i data-feather="chevrons-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="jy-card card mb-5 border card-style">
                                        <div class="card-body p-5 block__style">
                                            <!-- <div class="d-flex align-items-center justify-content-between"> -->
                                            <h6 class="text-center">Job Seeker</h6>
                                            <h6 class="text-center count__style"><?php echo $total_candidates; ?></h6>
                                            <!-- </div> -->
                                        </div>
                                        <div class="card-footer py-2 px-5">
                                            <a class="button primary-color" href="<?php echo base_url() . 'admin/candidate'; ?>">View <i data-feather="chevrons-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>