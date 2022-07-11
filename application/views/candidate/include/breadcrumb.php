<!-- Breadcrumb -->
    <div class="alice-bg padding-top-70 padding-bottom-70">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="breadcrumb-area">
              <h1><?php echo $heading_title; ?></h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <?php if($breadcrumb){ ?>
                    <?php foreach ($breadcrumb as $key => $value) { ?>
                      <li class="breadcrumb-item"><a href="<?php echo $value['href']; ?>"><?php echo $value['name']; ?></a></li>
                    <?php } ?>
                  <?php } ?>
                </ol>
              </nav>
            </div>
          </div>
          <div class="col-md-6">
            <div class="breadcrumb-form">
              <form action="#" id="jobSearch">
                <input type="text" name="search" value="<?php echo $searchQuery; ?>" placeholder="Search Jobs">
                <button><i data-feather="search"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb End -->

    <?php $this->document->addScript(base_url() . 'application/assets/js/include/candidate/search.js', 'footer'); ?>