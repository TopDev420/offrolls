<style>
  .search-form {
    width: 80%;
    margin: 0 auto;
    margin-top: 1rem;
  }

  .search-form input {
    height: 100%;
    background: transparent;
    border: 0;
    display: block;
    width: 100%;
    padding: 1rem;
    height: 100%;
    font-size: 1rem;
  }

  .search-form select {
    background: transparent;
    border: 0;
    padding: 1rem;
    height: 100%;
    font-size: 1rem;
  }

  .search-form select:focus {
    border: 0;
  }

  .search-form button {
    height: 100%;
    width: 100%;
    font-size: 1rem;
  }

  .search-form button svg {
    width: 24px;
    height: 24px;
  }

  .search-body {
    margin-bottom: 1.5rem;
  }

  .search-body .search-filters .filter-list {
    margin-bottom: 1.3rem;
  }

  .search-body .search-filters .filter-list .title {
    color: #3c4142;
    margin-bottom: 1rem;
  }

  .search-body .search-filters .filter-list .filter-text {
    color: #727686;
  }

  .search-body .search-result .result-header {
    margin-bottom: 2rem;
  }

  .search-body .search-result .result-header .records {
    color: #3c4142;
  }

  .search-body .search-result .result-header .result-actions {
    text-align: right;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .search-body .search-result .result-header .result-actions .result-sorting {
    display: flex;
    align-items: center;
  }

  .search-body .search-result .result-header .result-actions .result-sorting span {
    flex-shrink: 0;
    font-size: 0.8125rem;
  }

  .search-body .search-result .result-header .result-actions .result-sorting select {
    color: #68CBD7;
  }

  .search-body .search-result .result-header .result-actions .result-sorting select option {
    color: #3c4142;
  }

  @media (min-width: 768px) and (max-width: 991.98px) {
    .search-body .search-filters {
      display: flex;
    }

    .search-body .search-filters .filter-list {
      margin-right: 1rem;
    }
  }
</style>


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

              <table id="company_table" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-left">Name</th>
                    <th class="text-left">Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php if ($companies) { ?>
                    <?php foreach ($companies as $company) { ?>
                      <tr>
                        <td class="text-left"><?php echo $company['name']; ?></td>
                        <td class="text-left"><?php echo $company['email']; ?></td>
                        <td><?php echo ($company['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                        <td>
                          <a href="<?php echo $company['edit']; ?>" class="btn-default"><span class="ti-eye"></span></a>
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
            <div class="row">
              <div class="col-md-6">
                <?php if ($pagination) { ?>
                  <!-- <div class="pagination-list text-center">
                <nav class="navigation pagination">
                  <div class="nav-links">
                  </div>
                </nav>
              </div> -->
                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <?php echo $pagination; ?>
                    </ul>
                  </nav>
                <?php } ?>
              </div>
              <div class="col-md-6 ">
                <select class="form-control float-right w-25" id="RangePerPage">
                  <option>Location</option>
                  <option>London</option>
                  <option>Boston</option>
                  <option>Mumbai</option>
                  <option>New York</option>
                  <option>Toronto</option>
                  <option>Paris</option>
                </select>
              </div>
            </div>
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
            <input type="text" name="company_name" class="company-name form-control" placeholder="Name">
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