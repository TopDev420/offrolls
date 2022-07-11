$(function(){

    //Validation
    $('#jobPostForm').validate({
      rules: {
        job_title : {
          required: true,
          minlength: 1
        },
        job_category: {
          required: true
        },
        job_specialization: {
          required: true
        },
        job_description: {
          required: true
        },
        job_type: {
          required: true
        },
        job_duration: {
            required: true
        },
        job_time_period: {
            required: true
        },
        'job_skills[]': {
            required: true
        },
        experience_level: {
            required: true
        },
        experience: {
            required: true
        },
        pay_type: {
            required: true
        },
        pay_amount: {
            required: true
        },
      },
      messages: {
        job_title : {
          required: "Please specify job title",
          minlength: "Please specify more than one character",
        },
        job_category: {
          required: "Please select job category",
        },
        job_specialization: {
          required: "Please select job specialization",
        },
        description: {
          required: "Please select gender",
        },
        job_type: {
          required: "Please choose project type",
        },
        job_duration: {
            required: 'Please select project duration'
        },
        job_time_period: {
            required: 'Please select project time period'
        },
        'job_skills[]': {
            required: 'Please specify job skills',
            minlength: 1
        },
        experience_level: {
            required: 'Please choose experience level'
        },
        experience: {
            required: 'Please select experience'
        },
        pay_type: {
            required: 'Please select pay type'
        },
        pay_amount: {
            required: 'Please enter amount'
        },
      },
      errorElement: "em",
      errorPlacement: function ( error, element ) {
        // Add the `invalid-feedback` class to the error element
        error.addClass( "invalid-feedback" );

        if ( element.prop( "type" ) === "checkbox" || element.prop( "type" ) === "radio" || element.attr( "data-type" ) === "selectpicker" ) {
          element.parents('.ele--jqvalid').append(error);
        } else {
          error.insertAfter( element );
        }
      },
      highlight: function ( element, errorClass, validClass ) {
        $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
      },
      unhighlight: function (element, errorClass, validClass) {
        $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
      },
    });

    //Job Post back/continue button click
    var section_pane = $('.section-pane');
    var post_sidebar = $('#post-sidebar');

    function loadSection(ns_id){
        post_sidebar.find('li').removeClass('active');
        post_sidebar.find('li a').addClass('disabled');
        section_pane.attr('data-show', 'false');

        if(ns_id && typeof(ns_id) != 'undefined'){
            post_sidebar.find('a[href="' + ns_id + '"]').removeClass('disabled').parent().addClass('active');
            $(ns_id).attr('data-show', 'true');
        }

        $('html,body').animate({scrollTop: $('#post-container').offset().top - 120}, 1000);
    }

    $('[data-next-click=true]').click(function(e){
        e.preventDefault();
        var vform = $('#jobPostForm');
        vform.validate();

        var par = $(this);
        var ns_id = par.data('next-section');
        if(vform.valid()){
            loadSection(ns_id);
        }

    });

    $('[data-prev-click=true]').click(function(e){
        e.preventDefault();
        var par = $(this);
        var ps_id = par.data('prev-section');
        loadSection(ps_id);
    });

    $('[data-nav-click=true]').click(function(e){
        e.preventDefault();
        var par = $(this);
        var ps_id = par.href;
        loadSection(ps_id);


    });


    function postJob(vform, visibility){
        var formData = vform.serialize() + '&visibility=' + visibility;

        $.ajax({
            url: vform.attr('action'),
            type: 'post',
            data: vform.serialize(),
            dataType: 'json',
            beforeSend: function() {
                $.FEED.showLoader();
            },
            success: function(res){
                if(res.success){
                    Toast.fire({
                      icon: 'success',
                      title: res.message
                    }).then(function(){
                      if(res.redirect){
                          window.location.href = res.redirect;
                          // window.location.href=base_url+'company/dashboard';
                      }
                    });
                } else if(res.error){
                    Toast.fire({
                      icon: 'error',
                      title: res.message
                    });
                } else {
                    Toast.fire({
                      icon: 'error',
                      title: 'No Data'
                    });
                }
            },
            error:function(xhr,ajaxOptions,errorThrown){
              Toast.fire({
                icon: 'error',
                title: xhr.statusText
              });
            },
            complete: function() {
                $.FEED.hideLoader();
            }
        });
    }

    $('#btn-confirm-post-draft').click(function(e){
        e.preventDefault();
        var vform = $('#jobPostForm');
        vform.validate();

        if(vform.valid()){
            postJob(vform, 0);
        }
    });

    $('#btn-confirm-post-publish').click(function(e){
        e.preventDefault();
        var vform = $('#jobPostForm');
        vform.validate();

        if(vform.valid()){
            postJob(vform, 1);
        }
    });

    //Experience Level
    $('select.experience-level').on('change', function(){
        var val= $(this).val();
        if( val == 'experienced'){
            $('#applicant-experienced').show();
        } else {
            $('#applicant-experienced').hide();
            $('input[name=\'experience\']').val('');
        }
    });

    // Job title/Designation Autocomplete
    /*$('input[name=\'job_title\']').autocomplete({
      'source': function(request, response) {
          if(request == ''){
              $('input[name=\'job_title\']').val('');
          }
          var $this = $(this);
          $this.parent().find('.ac-error').remove();
          if(request.length > 1){
            $.ajax({
              url: $base_url +'category/jobdesignation/autocomplete/' + request,
              type: 'post',
              dataType: 'json',
              success: function(json) {

                  if(json.length == 0){
                      $this.after('<p class="ac-error error invalid-feedback" style="display:block">Please specify valid job title</p>');
                  }
                response($.map(json, function(item) {
                  return {
                    label: item['name'],
                    value: item['category_id']
                  }
                }));
              },
            });
          } else {
              $(this).after('<p class="ac-error error invalid-feedback" style="display:block">Please Enter more than one character</p>');
          }
      },
      'select': function(item) {
        $('input[name=\'job_title\']').val(item['label']);
      }
    });*/

    // Industry Autocomplete
    $('input[name=\'industry\']').autocomplete({
      'source': function(request, response) {
          if(request == ''){
              $('input[name=\'company_category\']').val('');
          }
        // if(request.length > 1){
            $.ajax({
              url: $base_url +'category/industrytype/autocomplete/' + request,
              type: 'post',
              dataType: 'json',
              success: function(json) {
                response($.map(json, function(item) {
                  return {
                    label: item['label'],
                    value: item['value']
                  }
                }));
              },
            });
        // }
      },
      'select': function(item) {
        $('input[name=\'industry\']').val(item['label']);
        $('input[name=\'company_category\']').val(item['value']);
      }
    });

    // Job skills Autocomplete
    $('#input-skills').autocomplete({
      'source': function(request, response) {
          if(request == ''){
              $('#input-skills').val('');
          }
          // if(request.length > 1){
              $.ajax({
                url: $base_url +'category/skills/autocomplete/' + request,
                type: 'post',
                dataType: 'json',
                success: function(json) {
                  response($.map(json, function(item) {
                    return {
                      label: item['label'],
                      value: item['value']
                    }
                  }));
                },
              });
          // }
      },
      'select': function(item) {
        $('#input-skills').val('');

        $('#skill-inner-category' + item['value']).remove();

        $('#skill-category').append('<div class="skill-category" id="skill-inner-category' + item['value'] + '"><i class="remove-skill fas fa-times-circle"></i> ' + item['label'] + '<input type="hidden" name="job_skills[]" value="' + item['value'] + '" /></div>');
        $('#skill-category .remove-skill').click(function(e){
          e.preventDefault();
          $(this).parent().remove();
        });
      }
    });

    // Job Location Autocomplete
    $('#input-search-location').autocomplete({
      'source': function(request, response) {
          if(request == ''){
              $('input[name=\'location\']').val('');
          }
        // if(request.length > 1){
            $.ajax({
              url: $base_url +'category/location/autocomplete/' + request,
              type: 'post',
              dataType: 'json',
              success: function(json) {
                response($.map(json, function(item) {
                  return {
                    label: item['label'],
                    value: item['value']
                  }
                }));
              },
            });
        // }
      },
      'select': function(item) {
        $('#input-search-location').val(item['label']);
        $('input[name=\'location\']').val(item['label']);
      }
    });


    // Languages Autocomplete
    $(document).on('keyup', '.input-search-language',  function(e){
        e.preventDefault();
        var ithis = $(this);
        ithis.autocomplete({
          'source': function(request, response) {
              if(request == ''){
                  ithis.val('');
                  ithis.parent().find('.input-language').val('');
              }
                // if(request.length > 1){
                    $.ajax({
                      url: $base_url +'category/language/autocomplete/' + request,
                      type: 'post',
                      dataType: 'json',
                      success: function(json) {
                        response($.map(json, function(item) {
                          return {
                            label: item['label'],
                            value: item['value']
                          }
                        }));
                      },
                    });
                // }
          },
          'select': function(item) {
            ithis.val(item['label']);
            ithis.parent().find('.input-language').val(item['value']);
          }
        });
    });

    //Remove category item
    $('#skill-category .remove-skill').click(function(e){
      e.preventDefault();
      $(this).parent().remove();
    });

    $('#technologies-category .remove-technology').click(function(e){
      e.preventDefault();
      $(this).parent().remove();
    });

    $('#certifications-category .remove-certification').click(function(e){
      e.preventDefault();
      $(this).parent().remove();
    });

});
