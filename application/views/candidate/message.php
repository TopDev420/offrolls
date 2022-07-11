    <!-- Menubar -->
    <?php include APPPATH. 'views/include/menubar.php'; ?>
    <!-- Menubar End -->
    <div class="section-default-header"></div>

    <div class="alice-bg section-padding">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-container">

              <!-- Dashboard Sidebar Start -->
              <?php include 'include/sidebar.php'; ?>
              <!-- Dashboard Sidebar End -->

              <div class="dashboard-content-wrapper no-padding">
                <div class="dashboard-message-wrapper">
                  <div class="message-lists">
                    <form action="#" class="message-search">
                      <input type="text" placeholder="Search Friend...">
                      <button><i data-feather="search"></i></button>
                    </form>
                    <a href="#" class="message-single">
                      <div class="thumb">
                        <img src="<?php echo base_url('application/assets/dashboard/images/user-1.jpg'); ?>" class="img-fluid" alt="">
                      </div>
                      <div class="body">
                        <h6 class="username">Laura Cormier</h6>
                        <span class="text-number">2</span>
                      </div>
                    </a>
                    <a href="#" class="message-single">
                      <div class="thumb">
                        <img src="<?php echo base_url('application/assets/dashboard/images/user-2.jpg'); ?>" class="img-fluid" alt="">
                      </div>
                      <div class="body">
                        <h6 class="username">Paul Cox</h6>
                        <span class="send-time">2 min</span>
                      </div>
                    </a>
                    <a href="#" class="message-single active">
                      <div class="thumb">
                        <img src="<?php echo base_url('application/assets/dashboard/images/user-3.jpg'); ?>" class="img-fluid" alt="">
                      </div>
                      <div class="body">
                        <h6 class="username">Carlos Dobson</h6>
                        <span class="send-time">6 min</span>
                      </div>
                    </a>
                    <a href="#" class="message-single">
                      <div class="thumb">
                        <img src="<?php echo base_url('application/assets/dashboard/images/user-4.jpg'); ?>" class="img-fluid" alt="">
                      </div>
                      <div class="body">
                        <h6 class="username">Dahlia Divers</h6>
                        <span class="send-time">45 min</span>
                      </div>
                    </a>
                  </div>
                  <div class="message-box">
                    <div class="message-box-header">
                      <a href="#"><i class="fas fa-ellipsis-h"></i></a>
                      <h5>Carlos Dobson</h5>
                    </div>
                    <ul class="dashboard-conversation">
                      <li class="conversation in">
                        <div class="avater">
                          <img src="<?php echo base_url('application/assets/dashboard/images/avater-1.jpg'); ?>" class="img-fluid" alt="">
                        </div>
                        <div class="message"><span>Can we go inside? I feel like my toes are starting to go numb.</span></div>
                        <span class="send-time">2.32 am</span>
                      </li>
                      <li class="conversation out">
                        <div class="avater">
                          <img src="<?php echo base_url('application/assets/dashboard/images/avater-2.jpg'); ?>" class="img-fluid" alt="">
                        </div>
                        <div class="message"><span>Can we go inside? I feel like my toes are starting to go numb.</span></div>
                        <span class="send-time">2.32 am</span>
                      </li>
                      <li class="conversation in">
                        <div class="avater">
                          <img src="<?php echo base_url('application/assets/dashboard/images/avater-1.jpg'); ?>" class="img-fluid" alt="">
                        </div>
                        <div class="message"><span>Hi, Luke! How are you? Can you please stop</span></div>
                        <span class="send-time">2.34 am</span>
                      </li>
                      <li class="conversation out">
                        <div class="avater">
                          <img src="<?php echo base_url('application/assets/dashboard/images/avater-2.jpg'); ?>" class="img-fluid" alt="">
                        </div>
                        <div class="message"><span>Hi, Luke! How are you? Can you please stop and pick up extra paper for the computer ?</span></div>
                        <span class="send-time">2.34 am</span>
                      </li>
                      <li class="conversation in">
                        <div class="avater">
                          <img src="<?php echo base_url('application/assets/dashboard/images/avater-1.jpg'); ?>" class="img-fluid" alt="">
                        </div>
                        <div class="message file-send">
                          <div class="images">
                            <img src="<?php echo base_url('application/assets/dashboard/images/avater-1.jpg'); ?>" class="img-fluid" alt="">
                            <img src="<?php echo base_url('application/assets/dashboard/images/avater-1.jpg'); ?>" class="img-fluid" alt="">
                            <img src="<?php echo base_url('application/assets/dashboard/images/avater-1.jpg'); ?>" class="img-fluid" alt="">
                            <span class="more">+12</span>
                          </div>
                        </div>
                        <span class="send-time">2.34 am</span>
                      </li>
                    </ul>
                    <div class="conversation-write-wrap">
                      <form action="#">
                        <label class="send-file">
                          <input type="file"><i data-feather="paperclip"></i>
                        </label>
                        <label class="send-image">
                          <input type="file"><i data-feather="image"></i>
                        </label>
                        <textarea placeholder="Type a message"></textarea>
                        <a href="#" class="emoji"><i data-feather="thumbs-up"></i></a>
                        <button class="send-message"><i data-feather="send"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Call to Action -->
    <?php include APPPATH. 'views/include/module_actions.php'; ?>
    <!-- Call to Action End -->



    <script src="<?php echo base_url('application/assets/dashboard/js/dashboard.js'); ?>"></script>
    <script src="<?php echo base_url('application/assets/dashboard/js/datePicker.js'); ?>"></script>
    <script src="<?php echo base_url('application/assets/dashboard/js/upload-input.js'); ?>"></script>
