<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
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

                    <div class="dashboard-applied mb-5">
                        <div class="dashboard-section">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form id="addForm" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Topic Name</label>
                                            <input class="form-control" type="text" id="topic_name" name="topic_name">
                                        </div>
                                        <div class="form-group">
                                            <label>Topic Image</label>
                                            <div>
                                                <input accept="image/*" type="file" id="topic_img" name="topic_img" width="100%" height='100%'>
                                                <!-- <small class="form-text text-muted">Max. file size: 50 MB. Allowed images: jpg, gif, png. Maximum 10 images only.</small> -->
                                            </div>
                                            <!--  <div class="row">
                                    <div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">
                                        <div class="product-thumbnail">
											<img src="assets/img/blog/blog-thumb-01.jpg" class="img-thumbnail img-fluid" alt="">
                                            <span class="product-remove" title="remove"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">
                                        <div class="product-thumbnail">
                                                <img src="assets/img/placeholder-thumb.jpg" class="img-thumbnail img-fluid" alt="">
                                            <span class="product-remove" title="remove"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">
                                        <div class="product-thumbnail">
											<img src="assets/img/placeholder-thumb.jpg" class="img-thumbnail img-fluid" alt="">
                                            <span class="product-remove" title="remove"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">
                                        <div class="product-thumbnail">
											<img src="assets/img/placeholder-thumb.jpg" class="img-thumbnail img-fluid" alt="">
                                            <span class="product-remove" title="remove"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">
                                        <div class="product-thumbnail">
											<img src="assets/img/placeholder-thumb.jpg" class="img-thumbnail img-fluid" alt="">
                                            <span class="product-remove" title="remove"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">
                                        <div class="product-thumbnail">
											<img src="assets/img/placeholder-thumb.jpg" class="img-thumbnail img-fluid" alt="">
                                            <span class="product-remove" title="remove"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                </div> -->
                                        </div>
                                        <div class="form-group">
                                            <label>Choose Category</label>
                                            <select class="form-control col-6" id="category_select" name="category_select">
                                                <option value="0">Select</option>
                                                <?php if ($job_categories) { ?>
                                                    <?php foreach ($job_categories as $category) { ?>
                                                        <?php if ($category->category_id == $job_category) { ?>
                                                            <option value="<?php echo $category->category_id; ?>" selected>
                                                                <?php echo $category->name; ?>
                                                            </option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $category->category_id; ?>">
                                                                <?php echo $category->name; ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="descr" id="descr" cols="30" rows="6" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Tags <small>(separated with a comma)</small></label>
                                            <input type="text" name="tagstxt" id="tagstxt" placeholder="Enter your tags" data-role="tagsinput" class="form-control">
                                        </div>
                                        <!--  <div class="form-group">
                                <label class="display-block">Blog Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="blog_active" value="1" checked>
									<label class="form-check-label" for="blog_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="blog_inactive" value="2">
									<label class="form-check-label" for="blog_inactive">
									Inactive
									</label>
								</div>
                            </div> -->
                                        <div class="m-t-20 text-center">
                                            <button id="submitBtn" type="submit" class="ps-btn ps-btn--sm submit-btn">Publish Post</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //var editor = new FroalaEditor('#example');
    $(document).ready(function() {
        //summer note image uploade
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("efile", file);
            $.ajax({
                data: data,
                type: "POST",
                dataType: 'json',
                url: $base_url + 'admin/blog/uploadEditorImage',
                cache: false,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == 'success') {
                        $('#descr').summernote('insertImage', res.link);
                    } else if (res.status == 'error') {
                        // $.ALERT.show('danger', res.message);
                        Toast.fire({
                            icon: "error",
                            title: res.message,
                        });
                    } else {
                        //$.ALERT.show('danger', 'No Data');
                        Toast.fire({
                            icon: "error",
                            title: "No Data",
                        });
                    }

                }
            });
        }

        $('#descr').summernote({
            height: 300, // set editor height
            focus: true, // set focus to editable area after initializing summernote
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['height', ['height']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
            callbacks: {
                onImageUpload: function(files, editor, welEditable) {
                    // upload image to server and create imgNode...
                    //$summernote.summernote('insertNode', imgNode);
                    sendFile(files[0], editor, welEditable);
                },
                onPaste: function(e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url() ?>application/assets/js/include/admin/blog.js"></script>