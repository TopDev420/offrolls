<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Course</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form id="editForm">
                            <div class="form-group">
                                <label>Topic <span class="text-danger">*</span></label>
                                <input type="hidden" id="library_id_edit" name="library_id_edit" required="required" value="<?php echo $library_data->library_id;?>"> 
                                <input class="form-control" id="library_name_edit" name="library_name_edit" required="required" value="<?php echo $library_data->library_name;?>" type="text">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="library_desc_edit" name="library_desc_edit" cols="30" rows="4" class="form-control"><?php echo $library_data->library_desc;?></textarea>
                                <!--  <div id="example"> <?php echo $course_data->course_desc;?></div> -->
                                <!--  <div class="fr-view">
                                 
                                </div> -->
                                </div>
                            </div>

                               
                                <!-- <textarea cols="40" rows="6" class="form-control"></textarea> -->
                            </div>
                           <!--  <div class="form-group">
                                <label class="display-block">Department Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="product_active" value="option1" checked>
                                    <label class="form-check-label" for="product_active">
                                    Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="product_inactive" value="option2">
                                    <label class="form-check-label" for="product_inactive">
                                    Inactive
                                    </label>
                                </div>
                            </div> -->
                            <div class="m-t-20 text-center">
                                <button id="editBtn" type="submit" class="btn btn-primary submit-btn">Edit Course</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

<script type= "text/javascript" src = "<?php echo base_url()?>application/assets/js/include/admin/library.js"></script>
 <script src="<?php echo base_url()?>application/assets/js/include/validation.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
  <script type="text/javascript">
    // var editor = new FroalaEditor('#example');
     $(document).ready(function() {
    $('#library_desc_edit').summernote();
    });
</script>

