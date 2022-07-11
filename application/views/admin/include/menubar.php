<style type="text/css">
  .dashboard-sidebar .dashboard-menu ul li a:hover,
  .dashboard-sidebar .dashboard-menu ul li a.active {
    color: #558E98;
    /* background-color: #DCDCDC; */
    /*background: linear-gradient(-95deg, #558E98, #DCDCDC);*/
    /*background-image: linear-gradient(to right, #558E98 , #558E98); padding: 5px !important;*/
    /*color: #246df8;*/
  }

  .dashboard-sidebar {
    background-image: -webkit-gradient(linear, left top, right top, from(white), to(white));
    background-image: -webkit-linear-gradient(left, white, white) !important;
    background-image: -o-linear-gradient(left, white, white) !important;
    background-image: linear-gradient(to right, white, white) !important;
  }
</style>
<div class="dashboard-sidebar">
  <div class="dashboard-menu p-0" style="font-weight: bold;">
    <ul class="p-0">
      <li class="nav-item"><a href="<?php echo base_url('admin/dashboard'); ?>">
          <!-- <i class="fas fa-home"></i> --><?php echo $this->lang->line('dashboard'); ?>
        </a>
        <!-- <hr class="m-0" style="height:1px;border-width:0;color:white;background-color:white"> -->
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/company'); ?>">
          <!-- <i class="fas fa-home"></i> --><?php echo $this->lang->line('company'); ?>
        </a>
        <!-- <hr class="m-0" style="height:2px;color:white;background-color:white"> -->
      </li>

      <li class="nav-item">
        <a href="<?php echo base_url('admin/freelancer'); ?>">
          <!-- <i class="fas fa-user-circle"></i> --><?php echo $this->lang->line('freelancer'); ?>
        </a>
        <!-- <hr class="m-0" style="height:2px;border-width:0;color:white;background-color:white"> -->
      </li>

      <li class="nav-item">
        <a href="<?php echo base_url('admin/candidate'); ?>">
          <!-- <i class="fas fa-user"></i> --><?php echo $this->lang->line('jobseeker'); ?>
        </a>
        <!-- <hr class="m-0" style="height:2px;border-width:0;color:white;background-color:white"> -->
      </li>

      <li class="nav-item">
        <a href="<?php echo base_url('admin/candidate/job'); ?>">
          <!-- <i class="fas fa-list-alt"></i> --><?php echo $this->lang->line('jobs'); ?>
        </a>
        <!-- <hr class="m-0" style="height:2px;border-width:0;color:white;background-color:white"> -->
      </li>

      <li class="nav-item">
        <a href="<?php echo base_url('admin/freelancer/job'); ?>">
          <!-- <i class="fas fa-list"></i> --><?php echo $this->lang->line('projects'); ?>
        </a>
        <!-- <hr class="m-0" style="height:2px;border-width:0;color:white;background-color:white"> -->
      </li>

      <li class="nav-item collapse-menu">
        <a href="#menu-setting" data-toggle="collapse">
          <!-- <i class="fas fa-cog"></i> --><?php echo $this->lang->line('payment'); ?>
        </a>
        <div class="collapse px-4" id="menu-setting">
          <ul class="submenu">
            <li class="nav-item">
              <a href="<?php echo base_url('admin/company/jobpayment'); ?>"><i class="fas fa-building d-none"></i><?php echo $this->lang->line('company'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/freelancer/jobpayment'); ?>"><i class="fas fa-address-card d-none"></i><?php echo $this->lang->line('freelancer'); ?></a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="<?php echo base_url('admin/blog'); ?>"><?php echo $this->lang->line('blog'); ?></a>
      </li>

      <li class="nav-item">
        <a href="<?php echo base_url('admin/newsletter'); ?>"><?php echo $this->lang->line('newsletter'); ?></a>
      </li>

      <li class="nav-item collapse-menu">
        <a href="#menu-setting" data-toggle="collapse">
          <!-- <i class="fas fa-cog"></i> --><?php echo $this->lang->line('setting'); ?>
        </a>
        <div class="collapse px-4" id="menu-setting">
          <ul class="submenu">
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/industrytype'); ?>"><i class="fas fa-building d-none"></i><?php echo $this->lang->line('industry_type'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/jobcategory'); ?>"><i class="fas fa-address-card d-none"></i><?php echo $this->lang->line('job_category'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/jobspecialization'); ?>"><i class="fas fa-id-badge d-none"></i><?php echo $this->lang->line('job_specialization'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/skills'); ?>"><i class="fas fa-cubes d-none"></i><?php echo $this->lang->line('skills'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/jobtype'); ?>"><i class="fas fa-address-card d-none"></i><?php echo $this->lang->line('job_type'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/keyword'); ?>"><i class="fas fa-address-card d-none"></i><?php echo $this->lang->line('keywords'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/certification'); ?>"><i class="fas fa-certificate d-none"></i><?php echo $this->lang->line('certification'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/experience'); ?>"><i class="fas fa-certificate d-none"></i><?php echo $this->lang->line('experience'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/state'); ?>"><i class="fas fa-building d-none"></i><?php echo $this->lang->line('state'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/city'); ?>"><i class="fas fa-building d-none"></i><?php echo $this->lang->line('city'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/noticeperiod'); ?>"><i class="fas fa-certificate d-none"></i><?php echo $this->lang->line('notice_period'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/category/qualification'); ?>"><i class="fas fa-user d-none"></i><?php echo $this->lang->line('qualification'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/setting/website'); ?>"><?php echo $this->lang->line('website'); ?></a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/setting/payment'); ?>"><?php echo $this->lang->line('payment'); ?></a>
            </li>
          </ul>
        </div>
      </li>

    </ul>
    <!-- <ul class="delete">
      <li><a href="<?php echo base_url('admin/logout'); ?>"><i class="fas fa-power-off"></i><?php echo $this->lang->line('logout'); ?></a></li>
    </ul> -->
  </div>
</div>