<!-- Menubar -->
<?php include APPPATH. 'views/include/menubar.php'; ?>
<!-- Menubar End -->

<div class="ps-page">
  <div class="ps-section--top bg--cover" data-background="<?php echo base_url('application/assets/images/img/bg/Employers.jpg'); ?>">
    <div class="container" >
      <!--<div class="ps-section__header">
        <p>BROWSE <br/> EMPLOYERS</p>
      </div>-->
      <div class="ps-section__content">
        <form class="ps-form--home-find-job ps-form--top" action="index.php" method="get">
          <h1 style="color:#285C7F">Find employers on Offrolls</h1>
          <h5 style="">Where the world meets startups.</h5>
          <div class="form-group"><i class="fa fa fa-search"></i>
            <input class="form-control" type="text" placeholder="Enter job title, position, skills...">
            <button class="ps-btn ps-btn--gradient">Find jobs</button>
          </div>        

        </form>
      </div>
    </div>
  </div>
  <div class="ps-section--sidebar ps-listing">
    <div class="container">
      <div class="ps-section__container">
        <div class="ps-section__content">
          <div class="ps-section__items">
            <h4 class="ps-heading--2 mb-40">13, 327 results</h4>
            <?php if($companies) { ?>
              <?php foreach($companies as $company) { ?>
                <div class="ps-employer">
                  <div class="ps-employer__thumbnail"><img src="<?php echo $company['thumb']; ?>" alt=""></div>
                  <div class="ps-employer__content">
                    <figure>
                      <figcaption>
                        <a href="<?php echo $company['view']; ?>"><?php echo $company['company_name']; ?></a>
                      </figcaption>
                      <p><?php echo ($company['city'] ? $company['city'] . ', ' : '') . $company['state']; ?></p>
                    </figure>
                    <p><?php echo $company['about']; ?></p>
                    <h5><i class="fa fa-briefcase"></i> <strong><?php echo $company['total_jobs']; ?> Open Positions</strong></h5>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
          <div class="ps-section__footer text-center"><a class="ps-link--viewmore" href="brower-employers.php"><span class="ps-icon--dots"><i></i></span> View more</a></div>
        </div>
        <div class="ps-section__sidebar">
          <div class="widget widget_profile widget_find-employers">
            <h3 class="widget-title">Find a Employers</h3>
            <ul class="ps-list">
              <li><a href="#">Browse all</a></li>
              <li><a href="#">Browse with My skills</a></li>
              <li><a href="#">Browse with top</a></li>
              <li><a href="#">Browse Local jobs</a></li>
              <li><a href="#">Browse Categories</a></li>
            </ul>
          </div>
          <div class="widget widget_profile widget_feature-members">
            <h3 class="widget-title">Featured Members</h3>
            <figure>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/1.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Zebra</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/2.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Moontheme Studio</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/3.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> La Carolina</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/4.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Mberak Designs</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/5.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Logo text</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/6.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Invectra</a></div>
              <div class="ps-block--company-tiny"><a class="ps-block__thumbnail" href="#"><img src="<?php echo base_url('application/assets/images/img/homepage/home-2/brand/7.jpg'); ?>" alt=""></a><a class="ps-block__title" href="#"> Open Suse</a></div>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>