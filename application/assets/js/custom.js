//Toast Notification
const Toast = Swal.mixin({
  // toast: true,
  position: 'bottom',
  customClass: {
    title: 'h2',
    icon: 'h6'
  },
  backdrop: false,
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  showCloseButton: true,
  allowOutsideClick: false,
  allowEscapeKey: false,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

$(document).ready(function() {

    /*-----------------------------------
    Smooth Scroll
    -----------------------------------*/

    // Select all links with hashes
    /*$('a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .not('[role="tab"]')
        .not('[role="collapse"]')
        .on('click', function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 500, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });*/


    /*-----------------------------------
    Navbar
    -----------------------------------*/
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
      var $el = $(this);
      var $parent = $(this).offsetParent(".dropdown-menu");
      if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
      }
      var $subMenu = $(this).next(".dropdown-menu");
      $subMenu.toggleClass('show');

      $(this).parent("li").toggleClass('show');

      $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
        $('.dropdown-menu .show').removeClass("show");
      });

      if (!$parent.parent().hasClass('navbar-nav')) {
        $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
      }

      return false;
    });

    if($(window).width() < 1200) {
      $(document).on('click', function(event) {
        var clickover = $(event.target);
        var _opened = $('#navbarSupportedContent').hasClass('show');
        if(_opened === true && !(clickover.is('.navbar-nav li, .navbar-nav .dropdown *'))) {
          $('button.navbar-toggler').trigger('click');
        }
      });
    }

    /*-------------------------------------
    Custom Nav
    -------------------------------------*/
    $('.notification-button').on('click', function(e) {
      e.preventDefault();
      $('.notification-card').toggleClass('show');
      $('.notification-card').fadeToggle();
    })

    $(document).on('click', function(event){
      var clickovr = $(event.target);
      var _open =$('.notification-card').hasClass('show');
      if(_open && !clickovr.is('.notification-button')) {
        $('.notification-button').trigger('click');
      }
    });

    $('.account-button').on('click', function(e) {
      e.preventDefault();
      $('.account-card').toggleClass('show');
      $('.account-card').fadeToggle();
    })

    $(document).on('click', function(event){
      var clickovrAcc = $(event.target);
      var _openAcc =$('.account-card').hasClass('show');
      if(_openAcc && !clickovrAcc.is('.account-button')) {
        $('.account-button').trigger('click');
      }
    });

    function topToggler() {
      if ($(window).width() < 992) {

        $('.header-top .top-nav').css({
          'display': 'none'
        })

        $('.header-top-toggler-button').on('click', function() {
          $('.header-top .top-nav').toggleClass('show');
          $('.header-top .top-nav').slideToggle();
        })

        $(document).on('click', function(event){
          var clickovrNot = $(event.target);
          var _openNot =$('.header-top .top-nav').hasClass('show');
          if(_openNot && !clickovrNot.is('.header-top-toggler-button, .top-nav, .top-nav *')) {
            $('.header-top-toggler-button').trigger('click');
          }
        });

      } else {

        $('.header-top .top-nav').css({
          'display': 'flex'
        });

      }
    }

    topToggler();

    /*---------------------------------------------
      Registration Account Type
    ---------------------------------------------*/

    $('.account-type a').on('click', function(e) {
      e.preventDefault();
      $('.account-type a').removeClass();
      $(this).addClass('active');
    })


    /*---------------------------------------------
      Job Favourit
    ---------------------------------------------*/

    $('.job-list .favourite').on('click', function(e) {
      e.preventDefault();
      if($(this).hasClass('active')) {
        $(this).removeClass('active');
      } else {
        $(this).addClass('active');
      }
    })

    /*---------------------------------------------
      Photo Upload
    ---------------------------------------------*/

    $('.upload-portfolio-image .file-input').on('change', function(){
        var curElement = $(this).parent().parent().find('.image');
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            curElement.attr('src', e.target.result);
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });


    /*-------------------------------------
    Bootstrap Select
    -------------------------------------*/

    $('.selectpicker').selectpicker();

    /*-------------------------------------
    Owl Carousel
    -------------------------------------*/

    // $('.company-carousel').owlCarousel({
    //   loop:true,
    //   autoplay: true,
    //   autoplayTimeout: 3000,
    //   margin: 20,
    //   dots: false,
    //   nav:false,
    //   navText: ['<span class="ti-angle-left"></span>','<span class="ti-angle-right"></span>'],
    //   responsive:{
    //     0:{
    //       items:1
    //     },
    //     480:{
    //       items:2
    //     },
    //     768:{
    //       items:3
    //     },
    //     992: {
    //       items:4
    //     },
    //     1200:{
    //       items:5
    //     }
    //   }
    // })

    // $('.freelancer-carousel').owlCarousel({
    //   loop:true,
    //   autoplay: true,
    //   margin: 20,
    //   dots: false,
    //   nav:false,
    //   navText: ['<span class="ti-angle-left"></span>','<span class="ti-angle-right"></span>'],
    //   responsive:{
    //     0:{
    //       items:1
    //     },
    //     480:{
    //       items:2
    //     },
    //     768:{
    //       items:3
    //     },
    //     992: {
    //       items:3
    //     },
    //     1200:{
    //       items:3
    //     }
    //   }
    // })

    // $('.portfolio-slider').owlCarousel({
    //   loop:true,
    //   autoplay: false,
    //   margin: 20,
    //   dots: false,
    //   nav:true,
    //   navText: ['<span class="ti-angle-left"></span>','<span class="ti-angle-right"></span>'],
    //   responsive:{
    //     0:{
    //       items:1
    //     },
    //     480:{
    //       items:2
    //     },
    //     768:{
    //       items:3
    //     },
    //   }
    // })

    /*-----------------------------------
    CountTo
    -----------------------------------*/
    function animateCountTo(ct) {
      if ($.fn.visible && $(ct).visible() && !$(ct).hasClass('animated')) {
        $(ct).countTo({
          speed: 1000,
          refreshInterval: 1
        });
        $(ct).addClass('animated');
      }
    }

    function initCountTo() {
      var counter = $('.count');
      counter.each(function () {
        animateCountTo(this);
      });
    }

    initCountTo();

    /*----------------------------------------------
    Job Filter Result View
    -----------------------------------------------*/

    $('.job-view-controller .controller, .candidate-view-controller .controller, .employer-view-controller .controller').on('click', function() {
      $('.job-view-controller .controller, .candidate-view-controller .controller, .employer-view-controller .controller').removeClass('active');
      $(this).addClass('active');
    })

    $('.job-view-controller .list, .candidate-view-controller .list, .employer-view-controller .list').on('click', function() {
      $('.job-filter-result, .candidate-filter-result, .employer-filter-result').removeClass('grid');
      $('.job-filter-result .job-list, .candidate-filter-result .candidate, .employer-filter-result .employer').removeClass('half-grid');
    })

    $('.job-view-controller .grid, .candidate-view-controller .grid, .employer-view-controller .grid').on('click', function() {
      $('.job-filter-result, .candidate-filter-result, .employer-filter-result').addClass('grid');
      $('.job-filter-result .job-list, .candidate-filter-result .candidate, .employer-filter-result .employer').addClass('half-grid');
    });

    /*----------------------------------------------
    Payment Card
    -----------------------------------------------*/

    $('.payment-method a').on('click', function(e) {
      e.preventDefault();
      $('.payment-method a').removeClass('active');
      $(this).addClass('active');
    });

    /*----------------------------------------------
    Category Filter
    -----------------------------------------------*/

    $('.job-filter .option-title, .candidate-filter .option-title, .employer-filter .option-title').on('click', function (event) {
      var clickover = $(event.target);
      $(this).each(function() {
        $(this).toggleClass('compress');
        $(this).siblings('ul, .price-range-slider').slideToggle();
      })
    });

    $('.job-filter a, .candidate-filter a, .employer-filter a').on('click', function(e) {
      e.preventDefault();
      var cls = $(this).parents(".job-filter, .candidate-filter, .employer-filter").data("id");
      var innerContent = '<a href="#">' + $(this).data("attr") + '</a><span class="ti-close"></span>';
      var filteredList = '<li class="' + cls + '">' + innerContent + '</li>';

      $('.selected-options .filtered-options li.' + cls).remove();
      $('.selected-options .filtered-options').append(filteredList);
    });

    $(document).on('click', ".selected-options .filtered-options li span", function() {
      $(this).parent('li').remove();
    });

    $(document).on('click', ".selected-options .selection-title a", function(e) {
      e.preventDefault();
      $('.selected-options .filtered-options li').remove();
      $('.selected-options').slideUp();
    });

    $(document).on('click', ".job-filter li a, .candidate-filter li a, .employer-filter li a", function() {
      $('.selected-options').slideDown();
    });

    if($('.selected-options .filtered-options li').lenght > 0) {
      $('.selected-options').slideDown();
    }

    /*----------------------------------------
      Price Range
    ----------------------------------------*/

    function priceRange() {
      $('.nstSlider').nstSlider({
        "left_grip_selector": ".leftGrip",
        "right_grip_selector": ".rightGrip",
        "value_bar_selector": ".bar",
        "value_changed_callback": function (cause, leftValue, rightValue) {
          $(this).parent().find('.leftLabel').text(leftValue);
          $(this).parent().find('.rightLabel').text(rightValue);
        }
      });
    }

    // priceRange();

    /*-------------------------------------
      Plyr Js
    -------------------------------------*/
    // plyr.setup();
    const player = new Plyr('#player');

    /*-------------------------------------
      progressBar
      -------------------------------------*/
    function animateProgressBar(pb) {
        if ($.fn.visible && $(pb).visible() && !$(pb).hasClass('animated')) {
            $(pb).css('width', $(pb).attr('aria-valuenow') + '%');
            $(pb).addClass('animated');
        }
    }

    window.initProgressBar = function() {
        var progressBar = $('.progress-bar');
        progressBar.each(function () {
            animateProgressBar(this);
        });
    }

    initProgressBar();

    /*-------------------------------------------
      Listing Sidebar Switch
    -------------------------------------------*/

     var listingContainer = '.listing-with-map .job-listing-container';
     var windowWidth = $(window).innerWidth();

      if(windowWidth > 1199) {
        $(listingContainer).css({
          'width': 1040,
        });

        $('.sidebar-controller .sidebar-switch').on('click', function() {
          if($(this).hasClass('on')) {
            $('.slim-footer').css('width', 760);
            console.log(windowWidth);
          } else {
            $('.slim-footer').css('width', 1040);
            console.log(windowWidth);
          }
        })

      } else {
        $(listingContainer).css({
          'width': windowWidth,
        });
      }

      $(document).on('click','.sidebar-switch', function() {
        $(this).toggleClass('on');
        if($(this).hasClass('on')){
          console.log('on');

          $('.sidebar-controller label span').text('Hide');

          $('.job-filter-wrapper').css({
            'display': 'block',
            'margin-left': 0,
            'width': '280px'
          });

          $('.filtered-job-listing-wrapper').css({
            'width': '760px'
          });

          $('.job-listing-container').css({
            'width': '1040px'
          });

          var listingContainerWidth = $('.listing-with-map .job-listing-container').innerWidth();
          var mapWidth = windowWidth - listingContainerWidth;

          $('.listing-side-map').width(mapWidth);

        } else {
          console.log('not on');
          $('.sidebar-controller label span').text('Show');

          $('.job-filter-wrapper').css({
            'display': 'none',
            'margin-left': '-280px',
            'width': '0'
          });

          $('.filtered-job-listing-wrapper').css({
            'width': '100%'
          });

          $('.filtered-job-listing-wrapper').addClass('change-padding');

          $('.job-listing-container').css({
            'width': '760px'
          })

          var listingContainerWidth = $('.listing-with-map .job-listing-container').innerWidth();
          var mapWidth = windowWidth - listingContainerWidth;
          $('.listing-side-map').width(mapWidth);

        }
     });

    /*-------------------------------------------
    Slick Nav
    -------------------------------------------*/
    $('.testimonial-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      autoplay: false,
      asNavFor: '.testimonial-nav'
    });

    $('.testimonial-nav').slick({
      slidesToShow: 5,
      slidesToScroll: 2,
      asNavFor: '.testimonial-for',
      dots: false,
      autoplay: false,
      arrows: false,
      centerPadding: '10px',
      centerMode: false,
      focusOnSelect: true
    });

    /*-------------------------------------------
    Feather Icon
    -------------------------------------------*/

    feather.replace();

    /*-----------------------------------
    Back to Top
    -----------------------------------*/
    $('.back-to-top a').on('click', function() {
      $("html, body").animate({
        scrollTop: 0
      }, 600);
      return false;
    })

    /*-------------------------------------
      PRICING CONTROL
    -------------------------------------*/

    $('.switch-wrap').on('click', function() {
      $(this).children('.price-switch, .switch').toggleClass('year-active');
      $('.duration-month').toggleClass('active');
      $('.duration-year').toggleClass('active');
      $('.monthly-rate').toggleClass('hidden');
      $('.yearly-rate').toggleClass('hidden');
    })


    /*-----------------------------------
    Contact Form
    -----------------------------------*/
    // Function for email address validation
    function isValidEmail(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

        return pattern.test(emailAddress);

    }
    $("#contactForm").on('submit', function (e) {
        e.preventDefault();
        var data = {
            name: $("#name").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            subject: $("#subject").val(),
            message: $("#message").val()
        };

        if (isValidEmail(data['email']) && (data['message'].length > 1) && (data['name'].length > 1) && (data['phone'].length > 1)) {
          $.ajax({
            type: "POST",
            url: "sendmail.php",
            data: data,
            success: function () {
              $('#contactForm .input-success').delay(100).fadeIn(1000);
              $('#contactForm .input-error').fadeOut(100);
            }
          });
        } else {
          $('#contactForm .input-error').delay(100).fadeIn(1000);
          $('#contactForm .input-success').fadeOut(100);

        }
        return false;
    });

    /*-------------------------------------
    Window Scroll
    -------------------------------------*/
    $(window).on('scroll', function () {
      initProgressBar();
      initCountTo();
    });

    /*-------------------------------------
    Window Resize
    -------------------------------------*/

    $(window).on('resize orientationchange', function () {
        // listingSidebarSwitch();
        priceRange();
        topToggler();
    });


});

(function($){

    //Autocomplete Function
    $.fn.autocomplete = function(option) {
      return this.each(function() {
        var $this = $(this);
        $this.parent().find('ul.autocomplete').remove();
        var $dropdown = $('<ul class="dropdown-menu autocomplete" />');

        this.timer = null;
        this.items = [];

        $.extend(this, option);

        $this.attr('autocomplete', 'off');

        // Focus
        $this.on('focus', function() {
          this.request();
        });

        // Blur
        $this.on('blur', function() {
          setTimeout(function(object) {
            object.hide();
          }, 200, this);
        });

        // Keydown
        $this.on('keydown', function(event) {
          switch(event.keyCode) {
            case 27: // escape
              this.hide();
              break;
            default:
              this.request();
              break;
          }
        });

        // Click
        this.click = function(event) {
          event.preventDefault();

          var value = $(event.target).parent().attr('data-value');
          if (value && this.items[value]) {
            this.select(this.items[value]);
          }
        }

        // Show
        this.show = function() {
          var pos = $this.position();

          $dropdown.css({
            top: pos.top + $this.outerHeight(),
            left: pos.left
          });

          $dropdown.show();
        }

        // Hide
        this.hide = function() {
          $dropdown.hide();
        }

        // Request
        this.request = function() {
          clearTimeout(this.timer);

          this.timer = setTimeout(function(object) {
            object.source($(object).val(), $.proxy(object.response, object));
          }, 200, this);
        }

        // Response
        this.response = function(json) {
          var html = '';
          var category = {};
          var name;
          var i = 0, j = 0;

          if (json.length) {
            for (i = 0; i < json.length; i++) {
              // update element items
              this.items[json[i]['value']] = json[i];

              if (!json[i]['category']) {
                // ungrouped items
                html += '<li class="nav-item" data-value="' + json[i]['value'] + '"><a class="nav-link" href="#">' + json[i]['label'] + '</a></li>';
              } else {
                // grouped items
                name = json[i]['category'];
                if (!category[name]) {
                  category[name] = [];
                }

                category[name].push(json[i]);
              }
            }

            for (name in category) {
              html += '<li class="dropdown-header">' + name + '</li>';

              for (j = 0; j < category[name].length; j++) {
                html += '<li class="nav-item" data-value="' + category[name][j]['value'] + '"><a class="nav-link" href="#">&nbsp;&nbsp;&nbsp;' + category[name][j]['label'] + '</a></li>';
              }
            }
          }

          if (html) {
            this.show();
          } else {
            this.hide();
          }

          $dropdown.html(html);
        }

        $dropdown.on('click', '> li > a', $.proxy(this.click, this));
        $this.after($dropdown);
      });
    }

    $.extend({
        FEED : {
            setLoaderStatus: function(statusMessage){
                $('#jy-loader-section .jy-inner-loader .jy-loader-status').html(statusMessage);
            },
            showLoader : function() {
                $('#jy-loader-section').fadeIn(200);
            },
            hideLoader : function() {
                $('#jy-loader-section').fadeOut(400);
            }
        }
    });



})(window.jQuery);



