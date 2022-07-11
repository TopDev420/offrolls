<!-- Menubar Top Start -->
<?php include APPPATH.'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->



<div class="container-fluid">
    <div class="row alice-bg">
      <div class="col-12 no-gliters p-0">
        <div class="dashboard-container">
          <!-- Dashboard Menubar-->
          <?php include APPPATH.'views/admin/include/menubar.php'; ?>

          <!-- Dashboard Content-->
          <div class="dashboard-content-wrapper">
            <!-- Breadcrumb -->
            <?php include APPPATH.'views/admin/include/breadcrumb.php'; ?>

            <div class="dashboard-applied mb-5">
              <div class="dashboard-section">

                <table id="company_table" class="table">
                  <thead>
                    <tr class="alice-bg">
                      <th class="text-left">Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php if($informations){ ?>
                        <?php foreach($informations as $information) { ?>
                          <tr>
                            <td class="text-left"><?php echo $information['title']; ?></td>
                            <td><?php echo ($information['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                            <td>
                              <a href="<?php echo $information['edit']; ?>" class="button btn btn-primary edit-information"><span class="ti-eye"></span></a>
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

              <?php if($pagination) { ?>
              <div class="pagination-list text-center">
                <nav class="navigation pagination">
                  <div class="nav-links">
                    <?php echo $pagination; ?>
                  </div>
                </nav>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Modals -->
<!-- Add company -->
<div class="modal fade account-entry" id="modalAddcompany" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i data-feather="user"></i>Add <?php echo $heading_title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAddcompany" method="post" action="<?php echo base_url() . 'admin/certification/add'; ?>">
          <div class="form-group">
            <input type="text" name="company_name" placeholder="Name" class="form-control">
          </div>
          <div class="form-group">
            <select class="form-control" name="status" placeholder="Status">
              <option value="0"><?php echo $this->lang->line('inactive'); ?></option>
              <option value="1"><?php echo $this->lang->line('active'); ?></option>
            </select>
          </div>
          <button type="submit" class="button primary-bg"><i class="fas fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<!-- Edit company -->
<div class="modal fade account-entry" id="modalEditcompany" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i data-feather="user"></i>Edit <?php echo $heading_title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditcompany" method="post" action="#">
          <div class="form-group">
            <input type="text" name="company_name" class="company-name form-control" placeholder="Name" >
          </div>
          <div class="form-group">
            <select class="form-control status" name="status" placeholder="Status">
              <option value="0"><?php echo $this->lang->line('inactive'); ?></option>
              <option value="1"><?php echo $this->lang->line('active'); ?></option>
            </select>
          </div>
          <button type="submit" class="button primary-bg"><i class="fas fa-pencil-alt"></i> <?php echo $this->lang->line('edit'); ?></button>
        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade modal-delete" id="modalDeletecompany" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4><i data-feather="trash-2"></i>Delete Account</h4>
        <p>Are you sure! You want to delete. This can't be undone!</p>
        <form id="formDeletecompany" action="#" method="post">
          <div class="buttons">
            <button type="button" class="btn-yes delete-button"><?php echo $this->lang->line('yes'); ?></button>
            <button type="button" class="btn-no"><?php echo $this->lang->line('no'); ?></button>
          </div>
        </form>
        <div class="alerts"></div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="<?php echo base_url('application/assets/js/validation/jquery.validate.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('application/assets/js/include/admin/company.js'); ?>"></script>
