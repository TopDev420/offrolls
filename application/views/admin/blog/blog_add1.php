<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Topic</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form id="addForm">
                            <div class="form-group">
                                <label>Topic <span class="text-danger">*</span></label>
                                <input class="form-control" id="topic_name" name="topic_name" required="required" type="text">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea  name="descr" id="descr"  cols="30" rows="4" class="form-control"></textarea>
                                <!--  <div id="example"></div> -->
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
                                <button id="submitBtn" type="submit" class="btn btn-primary submit-btn">Create Topic</button>
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
    $('#descr').summernote();
    });
</script>
