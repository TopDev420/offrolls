<!-- Menubar Top Start -->
<?php include APPPATH . 'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->

<div class="container-fluid">
  <div class="row alice-bg">
    <div class="col-12 no-gliters p-0">
      <div class="dashboard-container">
        <!-- Dashboard Menubar-->
        <?php include APPPATH . 'views/admin/include/menubar.php'; ?>

        <!-- Dashboard Content-->
        <div class="dashboard-content-wrapper">
          <!-- Breadcrumb -->
          <?php include APPPATH . 'views/admin/include/breadcrumb.php'; ?>

          <!-- <form id="search-form m-3">
            <div class="row mb-4">
              <h5 style="margin-left: 25px; margin-bottom: 5px; color: #285C7F;">Filter</h5>
              <div class="col-12">
                <div class="row no-gutters  align-items-center justify-content-center">
                  <div class="col-lg-3 col-md-3 col-sm-12 pr-1">
                    <select class="form-control" id="exampleFormControlSelect1">
                      <option>Location</option>
                      <option>London</option>
                      <option>Boston</option>
                      <option>Mumbai</option>
                      <option>New York</option>
                      <option>Toronto</option>
                      <option>Paris</option>
                    </select>
                  </div>
                  <div class="col-lg-8 col-md-6 col-sm-12 pr-1"> <input type="text" placeholder="Search..." class="form-control" id="search" name="search"></div>
                  <div class="col-lg-1 col-md-3 col-sm-12">
                    <button type="submit" class="ps-btn ps-btn--sm">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form> -->

          <div class="dashboard-applied mb-5">
            <div class="dashboard-section">

              <table id="newsletter_table" class="table table-striped table-hover">
                <thead>
                  <tr class="">
                    <th class="text-left">Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php if ($newsletters) { ?>
                    <?php foreach ($newsletters as $newsletter) { ?>
                      <tr>
                        <td class="text-left"><?php echo $newsletter->user_email; ?></td>
                        <td><?php echo ($newsletter->status == 1) ? 'Active' : 'Inactive'; ?></td>
                        <td>
                          <a href="<?php echo base_url() . 'admin/newsletter/delete/' . $newsletter->newsletter_id; ?>" class="ps-btn ps-btn--sm danger-bg white-text delete-newsletter"><i class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="3" class="text-center">No Data</td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>

            <?php if ($pagination) { ?>
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <?php echo $pagination; ?>
                </ul>
              </nav>
            <?php } ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modals -->
<!-- Add newsletter -->
<div class="modal fade account-entry" id="modalAddNewsletter" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i data-feather="user"></i>Add <?php echo $heading_title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAddNewsletter" method="post" action="<?php echo base_url() . 'admin/newsletter/add'; ?>">
          <div class="form-group ele--jqvalid">
            <input type="email" name="subscriber_email" placeholder="Email" class="form-control">
          </div>
          <div class="form-group ele--jqvalid">
            <select class="selectpicker" name="status" title="Select">
              <option value="0"><?php echo $this->lang->line('inactive'); ?></option>
              <option value="1"><?php echo $this->lang->line('active'); ?></option>
            </select>
          </div>
          <button type="submit" class="ps-btn ps-btn--sm"><i class="fas fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<!-- Edit newsletter -->
<div class="modal fade account-entry" id="modalEditNewsletter" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i data-feather="user"></i>Edit <?php echo $heading_title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditNewsletter" method="post" action="#">
          <div class="form-group ele--jqvalid">
            <input type="text" name="subscriber_email" class="subscriber-email form-control" placeholder="Name">
          </div>
          <div class="form-group ele--jqvalid">
            <select class="selectpicker status" name="status" title="Select">
              <option value="0"><?php echo $this->lang->line('inactive'); ?></option>
              <option value="1"><?php echo $this->lang->line('active'); ?></option>
            </select>
          </div>
          <button type="submit" class="ps-btn ps-btn--sm"><i class="fas fa-save"></i> <?php echo $this->lang->line('save'); ?></button>
        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade modal-delete" id="modalDeleteNewsletter" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4><i data-feather="trash-2"></i>Delete Account</h4>
        <p>Are you sure! You want to delete. This can't be undone!</p>
        <form id="formDeleteNewsletter" action="#" method="post">
          <div class="buttons">
            <button type="button" class="ps-btn ps-btn--sm btn-yes delete-button"><?php echo $this->lang->line('yes'); ?></button>
            <button type="button" class="ps-btn ps-btn--sm btn-no"><?php echo $this->lang->line('no'); ?></button>
          </div>
        </form>
        <div class="alerts"></div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('application/assets/js/include/admin/newsletter.js'); ?>"></script>