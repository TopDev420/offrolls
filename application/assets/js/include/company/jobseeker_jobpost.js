$(function(){
    // Job title/Designation Autocomplete
    $('input[name=\'job_title\']').autocomplete({
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
                      //$this.after('<p class="ac-error error invalid-feedback" style="display:block">Please specify valid job title</p>');
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
              //$(this).after('<p class="ac-error error invalid-feedback" style="display:block">Please Enter more than one character</p>');
          }
      },
      'select': function(item) {
        $('input[name=\'job_title\']').val(item['label']);
      }
    });

    // Industry Autocomplete
    $('input[name=\'industry\']').autocomplete({
      'source': function(request, response) {
          if(request == ''){
              $('input[name=\'company_category\']').val('');
          }
        if(request.length > 1){
            $.ajax({
              url: $base_url +'category/industrytype/autocomplete/' + request,
              type: 'post',
              dataType: 'json',
              success: function(json) {
                response($.map(json, function(item) {
                  return {
                    label: item['name'],
                    value: item['id']
                  }
                }));
              },
            });
        }
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
            if(request.length > 1){
                $.ajax({
                  url: $base_url +'category/skills/autocomplete/' + request,
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
            }
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

    // Job Technology Autocomplete
    $('#input-technology').autocomplete({
      'source': function(request, response) {
            if(request == ''){
                $('#input-technology').val('');
            }

            if(request.length > 1){
                $.ajax({
                  url: $base_url +'category/technology/autocomplete/' + request,
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
            }
      },
      'select': function(item) {
        $('#input-technology').val('');

        $('#technology-inner-category' + item['value']).remove();

        $('#technologies-category').append('<div class="technology-category" id="technology-inner-category' + item['value'] + '"><i class="remove-technology fas fa-times-circle"></i> ' + item['label'] + '<input type="hidden" name="job_technology[]" value="' + item['value'] + '" /></div>');
        $('#technologies-category .remove-technology').click(function(e){
          e.preventDefault();
          $(this).parent().remove();
        });
      }
    });

    // Job Location Autocomplete
    $('input[name=\'search_location\']').autocomplete({
      'source': function(request, response) {
          if(request == ''){
              $('input[name=\'job_location\']').val('');
          }
        if(request.length > 1){
            $.ajax({
              url: $base_url +'category/city/autocomplete/' + request,
              type: 'post',
              dataType: 'json',
              success: function(json) {
                response($.map(json, function(item) {
                  return {
                    label: item['name'],
                    value: item['id']
                  }
                }));
              },
            });
        }
      },
      'select': function(item) {
        $('input[name=\'search_location\']').val(item['label']);
        $('input[name=\'job_location\']').val(item['label']);
      }
    });

    // Certification Autocomplete
    $('#input-certifications').autocomplete({
      'source': function(request, response) {
          if(request == ''){
              $('#input-certifications').val('');
          }
            if(request.length > 1){
                $.ajax({
                  url: $base_url +'category/certification/autocomplete/' + request,
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
            }
      },
      'select': function(item) {
        $('#input-certifications').val('');

        $('#certification-inner-category' + item['value']).remove();

        $('#certifications-category').append('<div class="certification-category" id="certification-inner-category' + item['value'] + '"><i class="remove-certification fas fa-times-circle"></i> ' + item['label'] + '<input type="hidden" name="job_certification[]" value="' + item['value'] + '" /></div>');
        $('#certifications-category .remove-certification').click(function(e){
          e.preventDefault();
          $(this).parent().remove();
        });
      }
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


    //Salary Package
    $('#change-salary-package').click(function(e){
      e.preventDefault();
      var par = $(this).parents('.salary-package-block');
      if($(this).hasClass('cos')) {
        $(this).removeClass('cos').text('change to one salary');
        par.find('.salary-range').show();
      } else {
        $(this).addClass('cos').text('Back to salary range');
        par.find('.salary-range').hide();
      }
    });

    function postJob(vform, visibility){
        var formData = vform.serialize() + '&visibility=' + visibility;
        $.ajax({
            url: vform.attr('action'),
            type: 'post',
            data: formData,
            dataType: 'json',
            beforeSend: function(){
                vform.find('button[type=\'submit\']').attr('disabled', true);
                $.FEED.setLoaderStatus('Posting job...');
                $.FEED.showLoader();
            },
            success: function(res){
                if(res.success){
                    //$.ALERT.show('success', res.message);
                    Toast.fire({
                      icon: 'success',
                      title: res.message
                  });
                    if(res.redirect){
                        setTimeout(function(){
                            window.location.href=base_url+'company/dashboard' ;
                            // window.location.href = res.redirect;
                        },1000);
                    }
                } else if(res.error){
                    //$.ALERT.show('danger', res.message);
                    Toast.fire({
                      icon: 'error',
                      title: res.message
                  });
                } else {
                    //$.ALERT.show('danger', 'No Service');
                    Toast.fire({
                      icon: 'error',
                      title: 'No Service'
                  });
                }
            },
            error: function(xhr, ajaxOptions, errorThrown){
                console.log(xhr.responseText + ' ' + xhr.statusText);
            },
            complete: function(){
                $.FEED.hideLoader();
                vform.find('button[type=\'submit\']').attr('disabled', false);
                $.FEED.setLoaderStatus('');
            }
        });
    }

    jQuery.validator.addMethod('min', function(value, element,param){
      if(value >= param){
        return true;
      } else {
        return false;
      }
    }, 'Specify digit above 0');

    $('#jobPostForm').validate({
      onkeyup: function(element){
          $(element).valid();
      },
      onclick: function(element){
          $(element).valid();
      },
      rules: {
        job_title: {
          required: true,
          minlength: 1
        },
        industry: {
          required: true,
          minlength: 3
        },
        job_category: {
          required: true
        },
        job_experience: {
          required: true
        },
        job_gender: {
          required: true
        },
        job_location: {
          required: true,
          minlength: 3
        },
        'job_qualifications[]': {
            required: true
        },
        'job_type[]': {
            required: true
        },
        'job_salary_package[from]': {
            required: true
        },
        'job_salary_package[to]': {
            required: true
        },
        'job_salary_package[period]': {
            required: true
        },
        job_expiry_date: {
          required: true
        },
        job_vacancy: {
          required: true,
          digits: true,
          min: 1
        },
        job_description: {
          required: true,
          minlength: 10
        }
      },
      messages: {
        job_title : {
          required: "Please specify job title",
          minlength: "Please specify more than one character",
        },
        industry : {
          required: "Please specify industry",
          minlength: "Please specify atleast three character",
        },
        job_category: {
          required: "Please select job title/category",
        },
        job_experience: {
          required: "Please select experience",
        },
        job_gender: {
          required: "Please select gender",
        },
        job_location: {
          required: "Please specify job location",
          minlength: "Please specify more than one character",
        },
        'job_qualifications[]': {
            required: 'Please select qualifications'
        },
        'job_type[]': {
            required: 'Please specify/choose job type',
            minlength: 'Please choose atleast one job type'
        },
        'job_salary_package[from]': {
            required: 'Please specify salary package'
        },
        'job_salary_package[to]': {
            required: 'Please specify salary package'
        },
        'job_salary_package[period]': {
            required: 'Please specify salary period'
        },
        job_expiry_date: {
          required: 'Please specify job expiry date',
        },
        job_vacancy: {
          required: 'Please specify job vacancy',
          digits: 'Please enter in digits',
          min: 'Please enter digits above 0'
        },
        job_description: {
          required: 'Please specify job description',
          minlength: 'Description must be above 10 characters'
        }
      },
      errorElement: "em",
      errorPlacement: function ( error, element ) {
        // Add the `invalid-feedback` class to the error element
        error.addClass( "invalid-feedback" );

        if ( element.prop( "type" ) === "checkbox" || element.prop( "type" ) === "radio" || element.hasClass( 'selectpicker' )) {
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
      }
    });


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

    //JobPost
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

        var vform = $('#jobPostForm');
        vform.validate();

        var ps_id = par.href;
        if(vform.valid()){
            //loadSection(ps_id);
        }
    });
});
