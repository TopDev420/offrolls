$(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';

    
    //Validation education
    var formEducation = $('#formEducation').validate({
        rules: {
          education_qualification: {
            required: true,
          },
          education_specialization: {
            required: true,
          },
          education_institute: {
            required: true,
          },
          education_location: {
            required: true,
          },
          education_yop: {
            required: true,
          },
        },
        messages: {
          education_qualification: "Please select educational qualification",
          education_specialization: "Please select specialization",
          education_institute: "Please specify institute",
          education_location: "Please specify institute location",
          education_yop: "Please select passing out year",
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `invalid-feedback` class to the error element
          error.addClass( "invalid-feedback" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.next( "label" ) );
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
        submitHandler: function(form) {
          var surl = $(form).attr('action');
          saveEducation(form, surl);
        }
    });


    //Reset Form
    function resetEducationForm(){
      $('#formEducation')[0].reset();
      $('#formEducation').attr('action', '#');
      $('#formDeleteEducation').attr('action', '#');
      formEducation.resetForm();
      $('.selectpicker').selectpicker('refresh');
    }

    //Load educations View
    function loadEducations() {
      $.ajax({
        url: base_url + 'candidate/education',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          
        },
        success: function(res) {
          if(res.success) {
           viewEducationSection(res.success);
          } else if(res.error){
           $('#education-block').html('');
           if(res.show){
            $.ALERT.show('info', res.message);
           }
          } else {
            $.ALERT.show('info', 'No Data');
          }
        },
        error: function(xhr, ajaxOptions, errorThown) {
          console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
        },
        complete: function() {
          
        }
      });
    }

    function viewEducationSection(educations){
      $('#education-block').html('');
      if(educations){
        $.each(educations, function(ci, education){
          $('#education-block').append('<div class="education-label">' +
            '<div class="btn-action-block">' +
              '<button type="button" data-ceid="'+ education.candidate_education_id +'" class="btn btn-primary alert-primary edit-education">' +
                '<i data-feather="edit-2"></i>' +
              '</button>' +
              '<button type="button" data-ceid="'+ education.candidate_education_id +'" class="btn btn-danger alert-danger delete-education">' +
                '<i data-feather="trash-2"></i>' +
              '</button>' +
            '</div>' +
            '<span class="study-year d-none">2018 - Present</span>' +
            '<h5>'+ education.ce_qualification_name +' in '+ education.ce_specialization +'<span>@ '+ education.ce_institute +'</span></h5>' +
            '<p>'+ education.ce_description+'</p>' +
          '</div>');
        });

        feather.replace();
      }  
    }

    //Save education Form
    function saveEducation(form, surl) {
      var mparent = $(form).parents('.modal');
      var mfooter = mparent.find('.modal-footer');
      var button_txt = $(form).find('button[type=submit]').html();
      $.ajax({
        url: surl,
        type: 'post',
        data: $(form).serialize(),
        dataType: 'json',
        beforeSend: function() {
          $(form).find('button[type=submit]').html(loading_txt).attr('disabled', true);
        },
        success: function(res) {
          if(res.success) {
            $('#modal-education').modal('hide'); //Hide modal
            $.ALERT.show('success', res.message); // Show alert message
            loadEducations(); // Load view
          } else if(res.error){
            $.ALERT.show('danger', res.message);
          } else {
            $.ALERT.show('danger', 'No Data');
          }
        },
        error: function(xhr, ajaxOptions, errorThown) {
          console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
        },
        complete: function() {
          $(form).find('button[type=submit]').html(button_txt).attr('disabled', false);
        }
      });
    }


    //Add education
    $('#add-education').click(function(e){
      e.preventDefault();
      
      //Reset Form
      resetEducationForm(); 

      $('#formEducation').attr('action', base_url + 'candidate/education/add');

      $('#modal-education').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
    });


    //Edit education
    $(document).on('click', '.edit-education', function(e){
      e.preventDefault();
      var btn = $(this);
      var ceid = btn.attr('data-ceid');
      var button_txt = btn.html();

      //Reset Form
      resetEducationForm(); 

      if(ceid != '' && typeof(ceid) != 'undefined'){
        $.ajax({
          url: base_url + 'candidate/education/detail/' + ceid,
          type: 'post',
          data: {view: 1},
          dataType: 'json',
          beforeSend: function() {
            btn.html(spinner_icon).attr('disabled', false);
          },
          success: function(res) {
            if(res.success) {
              var category = res.success;
              
              $('#modal-education').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
              });
              $('#formEducation').attr('action', base_url + 'candidate/education/edit/' + ceid);
              $('#formEducation').find('.education-qualification').val(category.ce_qualification);
              $('#formEducation').find('.education-specialization').val(category.ce_specialization);
              $('#formEducation').find('.education-institute').val(category.ce_institute);
              $('#formEducation').find('.education-location').val(category.ce_location);
              $('#formEducation').find('.edu_'+category.ce_course_type).attr('checked', true);
              $('#formEducation').find('.education-description').val(category.ce_description);
              $('#formEducation').find('.education-yop').val(category.ce_yop);
              $('.selectpicker').selectpicker('refresh');
            } else if(res.error) {
                $.ALERT.show('danger', res.message);
            } else {
              $.ALERT.show('danger', 'No Data');
            }
            
          },
          error: function(xhr, ajaxOptions, errorThown) {
              console.log(xhr.statusText + ' - ' + xhr.responseText);
          },
          complete: function() {
            btn.html(button_txt).attr('disabled', false);
          }
        });
      }

    });


    //Delete education
    $(document).on('click', '.delete-education', function(e){
      e.preventDefault();
      $('#modal-delete-education').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });

      var ceid = $(this).attr('data-ceid');
      //Reset Form
      resetEducationForm(); 

      $('#formDeleteEducation').submit(function(e){
        e.preventDefault();
        $form = $(this);
        var mparent = $form.parents('.modal');
        var mfooter = mparent.find('.modal-footer');
        var button_txt = $form.find('button[type=submit]').html();
        $.ajax({
          url: base_url + 'candidate/education/delete/' + ceid,
          type: 'post',
          dataType: 'json',
          beforeSend: function() {
            $form.find('button[type=submit]').html(loading_txt).attr('disabled', true);
          },
          success: function(res) {
            if(res.success) {
              $('#modal-delete-education').modal('hide'); //Hide modal
              $.ALERT.show('success', res.message); // Show alert message
              loadEducations(); // Load view
            } else if(res.error){
              $.ALERT.show('danger', res.message);
            } else {
              $.ALERT.show('danger', 'No Data');
            }
          },
          error: function(xhr, ajaxOptions, errorThown) {
            console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
          },
          complete: function() {
            $form.find('button[type=submit]').html(button_txt).attr('disabled', false);
          }
        });
      });

      $('#modal-delete-education .btn-no').click(function(e){
        e.preventDefault();
        $('#modal-delete-education').modal('hide');
      });
    });


    //Get education Data after page load
    setTimeout(function(){
      loadEducations();
    }, 2000);
    
  });