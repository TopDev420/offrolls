<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/assets/css/style.css'); ?>">
<!-- Menubar Top Start -->
<?php include APPPATH . 'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->

<!--include search-sidebar-->
<?php if ($blog_details) { ?>
    <div class="ps-page--blog">
        <div class="ps-page__header"></div>
        <div class="ps-page__content">
            <div class="ps-blog--detail">
                <div class="ps-post--header bg--cover" data-background="<?php echo base_url() ?>application/assets/images/blog/Cover-page-design.jpg">
                    <div class="container">
                        <div class="ps-post__meta"><span class="highlight">
                                <?php $validFrom = $blog_details['blog_data']->created_datetime;
                                $validFromOg = date('d-M-Y', strtotime($validFrom));
                                echo $validFromOg ?>
                            </span>
                            <!-- <span>By<a href="#"> John kook</a></span> -->
                        </div>
                        <h1 class=""><?php echo $blog_details['blog_data']->blog_name ?></h1>
                        <?php if ($job_categories) { ?>
                            <?php foreach ($job_categories as $category) { ?>
                                <?php if ($category->category_id == $blog_details['blog_data']->category_id) { ?>
                                    <p class="ps-post__meta text-white"><?php echo $category->name; ?></p>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="container">
                    <div class="ps-blog__content">
                        <div class="ps-post--detail">
                            <div class="ps-block__content ps-document">
                                <p><?php echo $blog_details['blog_data']->blog_desc; ?></p>

                            </div>
                            <div class="ps-post__footer">
                                <div class="ps-post__left">
                                    <p><span>Tag:</span>
                                        <?php foreach ($blog_details['tags_data'] as $tags) {  ?>
                                            <?php $tagRes = [];
                                            $tagRes = (explode(",", $tags->tags)); ?>
                                            <?php foreach ($tagRes as $tag_res) {  ?>
                                                <a class="ps-tag" href="#"> <?php echo $tag_res ?></a>
                                            <?php  } ?>
                                        <?php  } ?>
                                </div>
                                <div class="ps-post__right">
                                    <!-- <ul class="ps-list--social simple">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul> -->
                                    <div class="ps-post__meta"><span><?php echo $blog_details['comment_count'];  ?> Comments</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-blog-related">
                            <h3>You May Also Like</h3>
                            <div class="row">
                                <?php foreach ($blog_details['recent_post'] as $list) {  ?>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                        <div class="ps-post">
                                            <div class="ps-post__thumbnail">
                                                <?php if ($list->blog_image != '') {  ?>
                                                    <a class="ps-post__overlay" href="<?php echo base_url() ?>admin/blog/view/<?php echo $list->blog_id ?>"></a>
                                                    <img src="<?php echo base_url() ?>application/assets/images/blog/blog_image/<?php echo $list->blog_image ?>" width="370" height="232" alt="">
                                                <?php  } else {  ?>
                                                    <a class="ps-post__overlay" href="<?php echo base_url() ?>admin/blog/view/<?php echo $list->blog_id ?>"></a>
                                                    <img class="" src="<?php echo base_url() ?>application/assets/images/blog/blog-1.jpg" width="370" height="232" alt="">
                                                <?php  } ?>
                                            </div>
                                            <div class="ps-post__content">
                                                <div class="ps-post__meta"><span class="highlight"><?php $validFrom = $list->created_datetime;
                                                                                                    $validFromOg = date('d-M-Y', strtotime($validFrom));
                                                                                                    echo $validFromOg ?></span></div>
                                                <a class="ps-post__title" href="<?php echo base_url() ?>admin/blog/view/<?php echo $list->blog_id ?>"><?php echo $list->blog_name ?></a>
                                                <!-- <p>In eros a justo facilisis rutrum. Aenean id ullamcorper libero. Vestibulum imperdiet</p> -->
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <form class="ps-form--post-comment mb-5" id="addComment" method="post">
                            <h3>Leave your comment</h3>
                            <div class="form-group">
                                <textarea class="form-control" name="txtCmt" rows="6" placeholder="Your message here"></textarea>
                            </div>
                            <div class="submit">
                                <button type="submit" class="ps-btn ps-btn--gradient">Post<i class="fa fa-arrow-right"></i></button>
                            </div>
                        </form>
                        <div class="ps-blog-comment">
                            <h3>Comments <span>(<?php echo $blog_details['comment_count'];  ?>)</span></h3>
                            <?php foreach ($blog_details['blog_comment'] as $comment) { ?>
                                <div class="ps-block--comment">
                                    <div class="ps-block__thumbnail">
                                        <img src="img/users/comment/1.jpg" alt="">
                                    </div>
                                    <div class="ps-block__content">
                                        <!-- checking user details avilable -->
                                        <?php if ($user) { ?>
                                            <?php foreach ($user as $user_details) { ?>
                                                <!-- checking both are equal or not -->
                                                <?php if ($comment->user_id == $user_details->user_id) { ?>
                                                    <h5><?php echo $user_details->first_name . ' ' . $user_details->last_name;  ?></h5>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <p><?php echo $comment->comment; ?></p>
                                        <div class="ps-block__footer">
                                            <p class="ps-block__meta"><span>
                                                    <?php $validFrom = $comment->created_datetime;
                                                    $validFromOg = date('d-M-Y', strtotime($validFrom));
                                                    echo $validFromOg ?>
                                                </span>
                                            </p>
                                            <a class="ps-btn ps-btn--gradient ps-btn--sm text-white btn-delete-comment" href="<?php echo base_url() . 'admin/blog/delete_comment/' . $comment->cmt_id; ?>">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<script type="text/javascript">
    $(function() {


        // $(".item_rply").click(function() {
        //     var parent_id = $(this).data('comment_id');
        //     var txtId = $('#txtId').val();
        //     var txtCmt = $('#txtRplyCmt').val();


        //     $.ajax({
        //         type: "POST",
        //         url: base_url + 'admin/blog/addRplyComment',
        //         dataType: "JSON",
        //         data: {
        //             txtId: txtId,
        //             txtCmt: txtCmt,
        //             parent_id: parent_id
        //         },

        //         success: function(data) {
        //             location.reload();
        //         },
        //         error: function(data) {
        //             //Your Error Message
        //             console.log(data)
        //             alert('Something went wrong: Contact Support');
        //             enableButton('submitBtn', 'Add')
        //         }
        //     });

        //     return false;


        // });

        $("#addComment").validate({
            onkeyup: function(element) {
                $(element).valid();
            },
            onkeydown: function(element) {
                $(element).valid();
            },
            onpaste: function(element) {
                $(element).valid();
            },
            oncontextmenu: function(element) {
                $(element).valid();
            },
            oninput: function(element) {
                $(element).valid();
            },
            rules: {
                txtCmt: {
                    required: true,
                },

            },
            messages: {
                txtCmt: {
                    required: "comment cannot be empty"
                },
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.next("label"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
        });

        $("#addComment").submit(function(e) {
            e.preventDefault();
            alert("hello");
            var form = $(this);
            if ($("#addComment").valid()) {
                var blog_id = <?php echo $blog_details['blog_data']->blog_id;  ?>;
                $.ajax({
                    type: "POST",
                    url: $base_url + 'admin/blog/add_comment/' + blog_id,
                    dataType: "JSON",
                    data: form.serialize(),
                    beforeSend: function() {
                        $.FEED.showLoader();
                    },
                    success: function(res) {
                        location.reload();
                    },
                    error: function(xhr, ajaxOptions, errorThrown) {
                        console.log(xhr.responseText + ' ' + xhr.statusText);
                    },
                    complete: function() {
                        $.FEED.hideLoader();
                    }
                });
            }
        });

        //Action api call
        function loadJobAction(href, reload = 1) {
            $.ajax({
                url: href,
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $.FEED.showLoader();
                },
                success: function(res) {
                    if (res.success) {
                        //$.ALERT.show('success', res.message);
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        });
                        if (reload == 1) {
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                        if (res.redirect) {
                            setTimeout(function() {
                                window.location.href = res.redirect;
                            }, 1500);
                        }
                    } else if (res.error) {
                        //$.ALERT.show('danger', res.message);
                        Toast.fire({
                            icon: 'error',
                            title: res.message
                        });
                    } else {
                        //$.ALERT.show('danger', 'No Data');
                        Toast.fire({
                            icon: 'error',
                            title: 'No Data'
                        });
                    }
                },
                error: function(xhr, ajaxOptions, errorThrown) {
                    console.log(xhr.responseText + ' ' + xhr.statusText);
                },
                complete: function() {
                    $.FEED.hideLoader();
                }
            });
        }

        //Delete
        $(document).on('click', '.btn-delete-comment', function(e) {
            e.preventDefault();
            var current = $(this);
            var delete_href = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure to delete?',
                showConfirmButton: true,
                confirmButtonText: 'Delete',
                showCancelButton: true,
                cancelButtonText: 'Cancel',
            }).then(function(result) {
                if (result.isConfirmed) {
                    loadJobAction(delete_href);
                }
            });
        });


    });
</script>
<script src="<?php echo base_url() ?>application/assets/js/include/validation.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>