<!-- Menubar -->
<?php include APPPATH . 'views/include/menubar.php'; ?>
<!-- Menubar End -->
<style>
    .wrapper {
        width: 100%;
        margin: 50px auto;
        padding: 20px;
    }

    .wrapper .card {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        height: calc(100% - 0px);
        border: 1px solid #ddd;
    }

    .wrapper .card img {
        width: 100%;
        object-fit: cover;
        object-position: 0 center;
    }

    .wrapper .card h3 {
        padding: 10px 0;
        font-size: 25px;
        font-weight: 500;
        text-transform: uppercase;
    }

    .wrapper .card p {
        color: #555;
        font-size: 14px;
    }
</style>
<!--include search-sidebar-->
<div class="ps-page--blog">
    <div class="ps-page__header"></div>
    <div class="ps-page__content">
        <!--include modules/blog-slider-grid-->
        <div class="ps-blog ps-blog--grid" id="searched--blog">
            <!-- <h2 class="text-center mb-5">Offrolls Blog</h2> -->
            <div class="ps-blog__content row card-blocks">
            </div>
            <div class="ps-blog__footer">
                <div class="container" id="searched--blog--pagination">
                    <a class="ps-link--viewmore" href="#"><span class="ps-icon--dots"><i></i></span> View More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var href_loadBlogDetails = '<?php echo $loadBlogDetails; ?>';
        var blogBlocks = $('#searched--blog .card-blocks');
        var searchedblog = $('#searched--blog');
        var searchedblogPagination = $('#searched--blog--pagination');

        //Loadfreelancers
        function loadBlogView(elementBlock, blog) {

            // elementBlock.html('');
            searchedblogPagination.html('');
            var blogList = blog.list;
            if ($.isArray(blogList) && blogList.length > 0) {

                $.each(blogList, function(jkey, blog) {
                    elementBlock.append('<div class="ps-post col-md-3">' +
                        '<div class="ps-post__thumbnail"><a class="ps-post__overlay" href="' + blog.blog_view + '">' +
                        '</a><img src="' + blog.thumb + '" style="width: 327px; height:242px;"/></div>' +
                        '<div class="card-body">' +
                        '<div class="ps-post__content">' +
                        '<div class="ps-post__meta"><span class="highlight">' + blog.post_date + '</span></div>' +
                        '<a class="ps-post__title" href="' + blog.blog_view + '">' + blog.blog_name + '</a>' +
                        '<a class="ps-post__morelink" href="' + blog.blog_view + '">Continue Reading</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>');

                });

                if (blog.view_more) {
                    let viewMore = blog.view_more;
                    if (parseInt(viewMore.page) > 1) {
                        searchedblogPagination.html('<a class="ps-link--viewmore" href="' + viewMore.href + '"><span class="ps-icon--dots"><i></i></span> View more</a>');

                        searchedblogPagination.find('a.ps-link--viewmore').click(function(e) {
                            e.preventDefault();
                            let page_link = $(this).attr('href');
                            loadBlogDetails(blogBlocks, page_link);
                        });
                    }
                }

            } else {
                elementBlock.append('<div class="card-body">' +
                    '<div class="text-center" colspan="4">' +
                    '<h5 >No freelancers Found</h5>' +
                    '</div>' +
                    '</div>');
            }

            feather.replace();
            // elementBlock.find('.short--view').showMore({
            //     minheight: 80,
            //     buttontxtmore: '...more',
            //     buttontxtless: '...less',
            //     animationspeed: 250
            // });

            // $('html,body').animate({
            //     scrollTop: $('#contentBlock').offset().top - 140
            // }, 1000);
        }

        function loadBlogDetails(element, href) {
            $.ajax({
                url: href,
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    searchedblogPagination.html('<div class="ps-link--viewmore"><span class="ps-icon--dots"><i></i></span> Loading <span class="ps-icon--dots"><i></i></span></div>');
                },
                success: function(res) {
                    if (res.success) {
                        loadBlogView(element, res.blog);
                    } else if (res.error) {
                        //$.ALERT.show('danger', res.message);
                        Toast.fire({
                            icon: 'danger',
                            title: res.message,
                            timer: false
                        });
                    } else {
                        //$.ALERT.show('danger', 'No Data');
                        Toast.fire({
                            icon: 'danger',
                            title: 'No Data',
                            timer: false
                        });
                    }
                },
                error: function(xhr, ajaxOptions, errorThrown) {
                    console.log(xhr.responseText + ' ' + xhr.statusText);
                },
                complete: function() {
                    element.find('tr.freelancer-items td').attr('data-timeline-loader', 'false');
                }
            });
        }

        loadBlogDetails(blogBlocks, href_loadBlogDetails);

    });
</script>