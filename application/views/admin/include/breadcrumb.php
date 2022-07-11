<?php $breadcrumb_actions = isset($breadcrumb_actions) ? $breadcrumb_actions : array(); ?>

<div class="line-area-bar"></div>
<div class="breadcrumb-area mb-5" style="background-color: #FFFFFF; padding: 8px; color: #696969;">
  <div class="container-fluid">
    <div class="row">
      <div class="<?php echo $breadcrumb_actions ? 'col-md-8' : 'col-12'; ?> p-0">
        <div class="breadcrumb-area">
          <h1 style="color: #285C7F;"><?php echo $heading_title; ?></h1>
        </div>
      </div>
      <?php if ($breadcrumb_actions) { ?>
        <div class="col-md-4 align-items-center d-flex justify-content-end p-0">
          <?php foreach ($breadcrumb_actions as $akey => $button) { ?>
            <?php $button_type = isset($button['type']) ? $button['type'] : ''; ?>
            <?php if ($button_type == 'ajax') { ?>
              <button class="ps-btn ps-btn--sm" id="<?php echo $button['id']; ?>">
                <?php if ($button['icon']) { ?>
                  <i class="<?php echo $button['icon']; ?>"></i>
                <?php } ?>
                <?php echo $button['name']; ?></button>
            <?php } else { ?>
              <a class="ps-btn ps-btn--outline ps-btn--sm text-white" id="<?php echo $button['id']; ?>" href="<?php echo $button['href']; ?>">
                <?php if ($button['icon']) { ?>
                  <i class="<?php echo $button['icon']; ?>"></i>
                <?php } ?>
                <?php echo $button['name']; ?></a>
            <?php } ?>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>
</div>