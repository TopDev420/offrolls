<!-- Menubar -->
<?php include APPPATH . 'views/company/include/menubar.php'; ?>
<!-- Menubar End -->

<?php $searchQuery = isset($searchQuery) ? $searchQuery : ''; ?>

<div class="ps-page">
  <div class="ps-section--top bg--cover" data-background="<?php echo base_url('application/assets/images/img/bg/Freelancers1.jpg'); ?>" style="">
    <div class="container">
      <!--<div class="ps-section__header">
        <p>BROWSE <br/> FREELANCER</p>
      </div>-->
      <div class="ps-section__content">
        <form class="ps-form--home-find-freelancer ps-form--top" id="freelancerSearchIn" action="#" method="get">
          <h1 style="color:white">Hire top freelance talent</h1>
          <h5 style="color:white">Find skilled & specialized talent for your business.<br /> Get access to the finest freelance talent sourcing.</h5>
          <div class="form-group"><i class="fa fa fa-search"></i>
            <input class="form-control" type="text" name="search" value="<?php echo $searchQuery; ?>" placeholder="Enter freelancer skills">
            <button type="submit" class="ps-btn ps-btn--gradient"><b>Find a freelancer</b></button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="ps-section--sidebar ps-listing">
    <div class="container">
      <div class="ps-section__container">
        <div class="ps-section__content  order-md-1 order-2">
          <div class="ps-section__items">
            <!-- <h4 class="ps-heading--2 mb-40"><span id="totalFreelancers">0 Results</span> -->
            <h4 class="ps-heading--2 mb-40"><span id="totalFreelancers"></span>
            </h4>
            <div id="searched--freelancers">
              <div class="p-4 freelancer-blocks"></div>
            </div>
          </div>
          <div class="ps-section__footer text-center" id="searched--freelancers--pagination"></div>
        </div>
        <div class="ps-section__sidebar order-md-2 order-1">
          <div class="widget widget_profile widget_find-employers">
            <h3 class="widget-title">Find a Freelancers</h3>
            <?php include APPPATH . 'views/company/include/freelancer_filter.php'; ?>
            <!-- <ul class="ps-list">
              <li><a href="#">Browse all</a></li>
              <li><a href="#">Browse with My skills</a></li>
              <li><a href="#">Browse with top</a></li>
              <li><a href="#">Browse Local freelancers</a></li>
              <li><a href="#">Browse Categories</a></li>
            </ul> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>application/assets/js/jquery.show-more.js"></script>
<script>
  $(function() {
    var searchQuery = '<?php echo $searchQuery; ?>';
    var href_loadSearchFreelancers = '<?php echo $loadSearchFreelancers; ?>';
    var freelancerBlocks = $('#searched--freelancers .freelancer-blocks');
    var searchedfreelancers = $('#searched--freelancers');
    var searchedfreelancersPagination = $('#searched--freelancers--pagination');

    //Loadfreelancers
    function loadFreelancersView(elementBlock, freelancers) {
      <?php if ($searchQuery) { ?>
        if (freelancers.total) {
          $('#totalFreelancers').html('<span>' + freelancers.total + ' Results On ' + searchQuery + '</span>');
        } else {
          $('#totalFreelancers').html('');
        }
      <?php } else { ?>
        $('#totalFreelancers').html('<span>' + freelancers.total + ' Recommended</span>');
      <?php } ?>

      // elementBlock.html('');
      searchedfreelancersPagination.html('');
      var freelancersList = freelancers.list;
      if ($.isArray(freelancersList) && freelancersList.length > 0) {

        $.each(freelancersList, function(jkey, freelancer) {
          let jSkills = '';
          $.each(freelancer.skills, function(skey, skill) {
            jSkills += '<a class="mr-2 p-2 badge badge-secondary font-500 text-white"> <span class="">' + skill + '</span> </a>';
          });

          let freelancer_location = '';
          if (freelancer.location) {
            freelancer_location = '<span class="mr-4">' +
              '<i class="fa fa-map-marker" aria-hidden="true"></i> ' +
              '<strong class="theme-default">' + freelancer.location + '<strong>' +
              '</span>';
          }
          let feedback = freelancer.feedback;
          if (freelancer.is_published == 1) {
            elementBlock.append('<div class="freelancers-list">' +
              '<div class="col-12">' +
              '<div class="row">' +
              '<div class="col-12 pt-5">' +
              '<div class="ps-freelancer">' +
              '<div class="ps-freelancer__thumbnail"><img src="' + freelancer.thumb + '" alt=""></div>' +
              '<div class="ps-freelancer__content">' +
              '<figure>' +
              '<figcaption>' + '<a href="' + $base_url + 'company/activity/freelancer/profile/' + freelancer.slug + '">' + freelancer.name + '</a>' + '</figcaption>' +
              '<div class="mb-2 ps-rating">' +
              '<input type="hidden" class="rating" data-readonly data-filled="mdi mdi-star font-2 text-primary" data-empty="mdi mdi-star-outline font-2 text-primary" data-fractions="2" value="' + feedback.ratings + '" />' +
              '</div>' +
              '<p>' + parseValue(freelancer.city) + ', ' + parseValue(freelancer.state) + ' ·</p>' +
              // '<a class="ps-btn ps-btn--outline" href="#">Request a quote</a>'+
              '</figure>' +
              '<p>' + parseValue(freelancer.about) + '</p>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '<hr>');
          }

          //Load more button
          // elementBlock.parent().find('.card-footer').html('<button type="button" class="button-default small-sm alice-bg primary-color border-primary">Load More freelancers</button>').show();
        });

        $("input.rating").rating(); // Load rating

        if (freelancers.view_more) {
          let viewMore = freelancers.view_more;
          if (parseInt(viewMore.page) > 1) {
            searchedfreelancersPagination.html('<a class="ps-link--viewmore" href="' + viewMore.href + '"><span class="ps-icon--dots"><i></i></span> View more</a>');

            searchedfreelancersPagination.find('a.ps-link--viewmore').click(function(e) {
              e.preventDefault();
              let page_link = $(this).attr('href');
              loadSearchFreelancers(freelancerBlocks, page_link);
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
      elementBlock.find('.short--view').showMore({
        minheight: 80,
        buttontxtmore: '...more',
        buttontxtless: '...less',
        animationspeed: 250
      });

      // $('html,body').animate({
      //     scrollTop: $('#contentBlock').offset().top - 140
      // }, 1000);
    }

    function loadSearchFreelancers(element, href) {
      $.ajax({
        url: href,
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          searchedfreelancersPagination.html('<div class="ps-link--viewmore"><span class="ps-icon--dots"><i></i></span> Loading <span class="ps-icon--dots"><i></i></span></div>');
        },
        success: function(res) {
          if (res.success) {
            loadFreelancersView(element, res.freelancers);
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

    loadSearchFreelancers(freelancerBlocks, href_loadSearchFreelancers);

    //Search Submit
    $('#freelancerSearchIn').submit(function(e) {
      e.preventDefault();
      var $cur = $(this);
      var csq = '';
      var searchQuery = $cur.find('input[name=\'search\']').val();
      if (searchQuery) {
        csq = '?csq=' + encodeURIComponent(searchQuery);
      }

      window.location.href = $base_url + 'company/search/freelancer' + csq;
    });
  });
</script>