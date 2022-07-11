<!-- Header -->
    <header>
      <nav class="navbar navbar-expand-xl absolute-nav transparent-nav cp-nav navbar-light bg-light fluid-nav">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
          <img src="<?php echo base_url('application/assets/images/logo.png'); ?>" class="img-fluid" alt="">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav ml-auto main-nav">
            <li class="menu-item dropdown">
              <a title="" href="<?php echo base_url(). 'jobs'; ?>">Jobs</a>
            </li>
            <li class="menu-item dropdown">
              <a title="Company" href="<?php echo base_url(). 'companies'; ?>">Companies</a>
            </li>
           <li class="menu-item dropdown">
             <a title="Login" href="<?php echo base_url(). 'login'; ?>">Login</a>
            </li>
            <li class="menu-item dropdown">
              <a title="Register" href="<?php echo base_url(). 'register'; ?>">Register</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
  <!-- Header End -->

