<style>
  .nav-item .nav-link {
    border-radius: 3px;
    display: block;
    font-family: "Poppins", sans-serif;
    font-weight: 600;
    font-size: 1.4rem;
    text-transform: uppercase;
    padding: 10px 25px;
    color: #515666;
  }

  .nav-item .nav-link:hover {
    background-color: #F26522;
    color: #ffffff;
  }
</style>

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

                <table id="category_table" class="table table-striped table-hover">
                  <thead>
                    <tr class="">
                      <th class="text-left">Name</th>
                      <th class="text-left">Category</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php if($categories){ ?>
                        <?php foreach($categories as $category) { ?>
                          <tr>
                            <td class="text-left"><?php echo $category->name; ?></td>
                            <td class="text-left"><?php echo $category->parent_name; ?></td>
                            <td><?php echo ($category->status == 1) ? 'Active' : 'Inactive'; ?></td>
                            <td>
                              <a href="<?php echo base_url() . 'admin/category/jobdesignation/edit/' . $category->category_id; ?>" class="button-default small-xs primary-bg white-text edit-category"><i class="fas fa-pencil-alt"></i></a>
                              <a href="<?php echo base_url() . 'admin/category/jobdesignation/delete/' . $category->category_id; ?>" class="button-default small-xs danger-bg white-text delete-category"><i class="fas fa-trash-alt"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
                      <?php } else { ?>
                      <tr>
                        <td colspan="4" class="text-center">No Data</td>
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
<!-- Add Category -->
<div class="modal fade account-entry" id="modalAddCategory" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i data-feather="user"></i>Add <?php echo $heading_title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAddCategory" method="post" action="<?php echo base_url() . 'admin/category/jobdesignation/add'; ?>">
          <div class="form-group ele--jqvalid">
            <input type="text" name="category_name" placeholder="Name" class="form-control">
          </div>
          <div class="form-group ele--jqvalid">
            <input type="text" name="path" placeholder="Category" class="form-control">
            <input type="hidden" name="parent_id" class="form-control">
          </div>
          <div class="form-group ele--jqvalid">
            <select class="selectpicker" name="status" title="Select">
              <option value="0"><?php echo $this->lang->line('inactive'); ?></option>
              <option value="1"><?php echo $this->lang->line('active'); ?></option>
            </select>
          </div>
          <button type="submit" class="button-default small-sm primary-bg white-text"><i class="fas fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<!-- Edit Category -->
<div class="modal fade account-entry" id="modalEditCategory" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i data-feather="user"></i>Edit <?php echo $heading_title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditCategory" method="post" action="#">
          <div class="form-group ele--jqvalid">
            <input type="text" name="category_name" class="category-name form-control" placeholder="Name" >
          </div>
          <div class="form-group ele--jqvalid">
            <input type="text" name="path" placeholder="Category" class="form-control">
            <input type="hidden" name="parent_id" class="form-control">
          </div>
          <div class="form-group ele--jqvalid">
            <select class="selectpicker status" name="status" title="Select">
              <option value="0"><?php echo $this->lang->line('inactive'); ?></option>
              <option value="1"><?php echo $this->lang->line('active'); ?></option>
            </select>
          </div>
          <button type="submit" class="button-default small-sm primary-bg white-text"><i class="fas fa-save"></i> <?php echo $this->lang->line('save'); ?></button>
        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade modal-delete" id="modalDeleteCategory" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4><i data-feather="trash-2"></i>Delete Account</h4>
        <p>Are you sure! You want to delete. This can't be undone!</p>
        <form id="formDeleteCategory" action="#" method="post">
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

<script type="text/javascript" src="<?php echo base_url('application/assets/js/include/admin/category.js'); ?>"></script>

<script>
  $(function(){
    $('input[name=\'path\']').autocomplete({
      'source': function(request, response) {
        $.ajax({
          url: '<?php echo base_url() . 'admin/category/jobcategory/autocomplete/'; ?>' + request,
          type: 'post',
          dataType: 'json',
          success: function(json) {
            response($.map(json, function(item) {
              return {
                label: item['name'],
                value: item['category_id']
              }
            }));
          },
        });
      },
      'select': function(item) {
        $('input[name=\'path\']').val(item['label']);

        $('input[name=\'parent_id\']').val(item['value']);

      }
    });
  });
</script>
