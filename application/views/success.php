<?php include APPPATH . 'views/include/menubar.php'; ?>

    <div class="p-5">
      <div class="container" style="height: 40rem;">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-md-6">
            <div class="access-form">
              <div class="form-header">
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success text-center py-5">
                      <h5><i data-feather="user"></i><?php echo $success; ?></h5>
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