<?php include APPPATH . 'views/include/menubar.php'; ?>

    <div class="padding-top-90 padding-bottom-90 access-page-bg">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-md-6">
            <div class="access-form">
              <div class="form-header">
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success text-center py-5">
                      <h5><i data-feather="user"></i><?php echo $success; ?></h5>
                      <?php if(isset($login)) { ?>
                        <a href="<?php echo base_url(). 'login'; ?>" title="Login" class="button">Login</a>
                      <?php } ?>
                    </div>
                <?php } ?>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger text-center py-5">
                      <h5><i data-feather="user"></i><?php echo $error; ?></h5>
                    </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


