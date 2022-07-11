  <?php
  $no_fw = isset($no_fw) ?  $no_fw : false;
  $about_foot = isset($about_foot) ?  $about_foot : false;
  $description = getSetting('website', 'description');
  $mobile = getSetting('website', 'mobile');
  $email = getSetting('website', 'email');
  $logged = isset($logged) ?  $logged : false;
  ?>

  <footer class="ps-footer">
    <div class="container">
      <div class="ps-footer__top"><a class="ps-logo" href="index.html"><img src="img/logo-dark.png" alt=""></a>
      </div>
      <div class="ps-footer__center">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
            <aside class="widget widget_footer">
              <h3 class="widget-title">Meet OFFROLLS</h3>
              <ul>
                <li><a href="<?php echo base_url() . 'about'; ?>">About us</a></li>
                <li><a href="<?php echo base_url() . 'hirefreelancer'; ?>">FREELANCERS</a></li>
                <li><a href="<?php echo base_url() . 'freelancerproject'; ?>">PROJECTS</a></li>
              </ul>
            </aside>
          </div>

          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
            <form class="ps-form--newsletters" id="job-newsletter" method="get">
              <h3>Email Newsletters</h3>
              <p>Keep me up to date with content, updates, and offers from OFFROLLS</p>

              <div class="ele-jqValid">
                <div class="form-group--nest">
                  <input class="form-control" name="user_email" type="email" placeholder="Email address">
                  <button type="submit">Subscribe</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="ps-footer__bottom">
        <figure>
          <ul class="ps-footer__nav">
            <li><a href="<?php echo base_url() . 'about/privacy'; ?>"> Privacy Policy</a></li>
            <li><a href="<?php echo base_url() . 'about/terms'; ?>"> Terms and Conditions</a></li>
            <!-- <li><a href="#"> Support</a></li> -->

          </ul>
          <p>&copy; 2021 <a style="color:#285C7F">OFFROLLS</a> - All Rights Reserved.</p>
        </figure>
        <figure>

          <ul class="ps-list--social">
            <li><a href="https://www.facebook.com/offrollsin/?view_public_for=104010895002196"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="https://twitter.com/offrollsin"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/offrollsin/"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.linkedin.com/company/offrolls/?viewAsMember=true"><i class="fab fa-linkedin-in"></i></a></li>
          </ul>
        </figure>
      </div>
    </div>
    </div>
  </footer>

  <div id="back2top"><i class="pe-7s-angle-up"></i></div>
  <div class="ps-site-overlay"></div>
  <div id="loader-wrapper">
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>
  <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
    <div class="ps-search__content">
      <form class="ps-form--primary-search" action="do_action" method="post">
        <input class="form-control" type="text" placeholder="Search for...">
        <button><i class="fa fa-search"></i></button>
      </form>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade modal-delete" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4><i data-feather="trash-2"></i>Remove</h4>
          <p>Are you sure! You want to remove.</p>
          <form id="formDelete">
            <div class="buttons">
              <button type="button" class="btn-yes delete-button"><?php echo $this->lang->line('yes'); ?></button>
              <button type="button" class="btn-no"><?php echo $this->lang->line('no'); ?></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Newsletter Js -->
  <?php $this->document->addScript(base_url('application/assets/js/include/newsletter.js'), 'footer'); ?>

  <script>
    // Load Timeline Loader
    $.TIMELINE.loader();
  </script>

  <!-- Optional JavaScript -->
  <!-- include summernote css/js -->
  <link href="<?php echo base_url(); ?>application/assets/vendor/summernote/summernote-bs4.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>application/assets/vendor/summernote/summernote-bs4.min.js"></script>

  <script src="<?php echo base_url('application/assets/js/feather.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/bootstrap-select.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/jquery.nstSlider.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/owl.carousel.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/plugins/jquery-bar-rating/dist/jquery.barrating.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/imagesloaded.pkgd.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/plugins/select2/dist/js/select2.full.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/vendor/sweet-alert2/sweetalert2.all.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/vendor/rating/bootstrap-rating.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/vendor/rating/rating-init.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/plugins/wow.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/plugins/masonry.pkgd.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/visible.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/jquery.countTo.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/chart.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/plyr.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/slick.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/plugins/anime.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/bootstrap-select.min.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/datetimepicker/jquery.datetimepicker.full.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/additional-methods.js'); ?>"></script>


  <script src="<?php echo base_url('application/assets/js/main.js'); ?>"></script>
  <script src="<?php echo base_url('application/assets/js/custom.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('application/assets/js/alert.js'); ?>"></script>

  <?php $scripts = $this->document->getScripts('footer'); ?>
  <?php if ($scripts) { ?>
    <?php foreach ($scripts as $script) { ?>
      <script type="text/javascript" src="<?php echo $script; ?>"></script>
    <?php } ?>
  <?php } ?>

  <?php if ($logged) { ?>
    <script src="<?php echo base_url('application/assets/js/notification.js'); ?>"></script>
  <?php } ?>

  <script>
    $(function() {
      // Response Messages (from controller)
      var success_msg = '<?php echo isset($success) ? $success : ''; ?>';
      var error_msg = '<?php echo isset($error) ? $error : ''; ?>';
      if (success_msg) {
        Toast.fire({
          icon: 'success',
          title: success_msg
        });
      }

      if (error_msg) {
        Toast.fire({
          icon: 'error',
          title: error_msg
        });
      }
    });
  </script>

  <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-messaging.js"></script>
  <!-- TODO: Add SDKs for Firebase products that you want to use
   https://firebase.google.com/docs/web/setup#available-libraries -->

  <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
      apiKey: "AIzaSyAUY9lMDKtBaA9la7Z1k2hIpGuV6kFT4OM",
      authDomain: "offrolls-web.firebaseapp.com",
      projectId: "offrolls-web",
      storageBucket: "offrolls-web.appspot.com",
      messagingSenderId: "96187196757",
      appId: "1:96187196757:web:4f756e71b9fc68e009bbdc"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();
    // Get registration token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    messaging.getToken({
      vapidKey: 'BKKgA2TECOrltBjYz4nktwChQ5Qj4ekRzRLYgf5a6BUaZXSuximGOkBnyja_BXh-8rNwYSdcg2osoq8BwB_9XhA'
    }).then((currentToken) => {
      if (currentToken) {
        // Send the token to your server and update the UI if necessary
        var token = currentToken;
        <?php if ($logged) { ?>
          saveToken(token);
        <?php } ?>
        console.log('getToken: ', currentToken)
      } else {
        // Show permission request UI
        console.log('No registration token available. Request permission to generate one.');
        // ...
      }
    }).catch((err) => {
      console.log('An error occurred while retrieving token. ', err);
      // ...
    });

    function saveToken(currentToken) {
      $.ajax({
        url: $base_url + 'Notification/addDeviceDetails',
        method: 'post',
        data: {
          'token': currentToken
        },
        beforeSend: function() {
          $.FEED.showLoader();
        },
        success: function(res) {
          if (res.success) {
            console.log(res.message);
          } else if (res.error) {
            // $.ALERT.show('danger', res.message);
            // Toast.fire({
            //   icon: 'error',
            //   title: res.message
            // });
            console.log(res.message);
          } else {
            //$.ALERT.show('danger', 'No Data');
            // Toast.fire({
            //   icon: 'error',
            //   title: 'No Data'
            // });
            console.log('No Data');
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

    //recive a data from firebase
    messaging.onMessage((payload) => {
      console.log('onMessage', payload);

      Notification.requestPermission((status) => {
        console.log('requestPermission', status);
        if (status == 'granted') {
          let title = payload['data']['title'];
          let body = payload['data']['body'];
          new Notification(title, {
            body: body
          });
        }
      });
    });
  </script>

  </body>

  </html>