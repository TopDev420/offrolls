$(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';

    
    //Validation Certification
    var formCertification = $('#formCertification').validate({
        rules: {
          certification_name: {
            required: true,
          },
          certification_description: {
            required: true,
          },
          certification_completion_year: {
            required: true,
          },
        },
        messages: {
          certification_name: "Please enter certification name",
          certification_description: "Please enter description",
          certification_completion_year: "Please select year",
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
          saveCertification(form, surl);
        }
    });


    //Reset Form
    function resetCertificationForm(){
      $('#formCertification')[0].reset();
      $('#formCertification').attr('action', '#');
      $('#formDeleteCertification').attr('action', '#');
      formCertification.resetForm();
      $('.selectpicker').selectpicker('refresh');
    }

    //Load Certifications View
    function loadCertifications() {
      $.ajax({
        url: base_url + 'candidate/certification',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          
        },
        success: function(res) {
          if(res.success) {
           viewCertificationSection(res.success);
          } else if(res.error){
           $('#experience-block').html('');
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

    function viewCertificationSection(certifications){
      $('#experience-block').html('');
      if(certifications){
        $.each(certifications, function(ci, certification){
          $('#experience-block').append('<div class="experience-section">' +
              '<div class="btn-action-block">' +
                '<button type="button" data-cid="'+ certification.certification_id +'" class="btn btn-primary alert-primary edit-certification">' +
                  '<i data-feather="edit-2"></i>' +
                '</button>' +
                '<button type="button" data-cid="'+ certification.certification_id +'" class="btn btn-danger alert-danger delete-certification">' +
                  '<i data-feather="trash-2"></i>' +
                '</button>' +
              '</div>' +
              
              '<h5>'+ certification.cc_name +'</h5>' +
              '<p>'+ certification.cc_description +'</p>' +
              '<span class="service-year">'+ certification.cc_completion_year +'</span>' +
            '</div>');
        });

        feather.replace();
      }  
    }

    //Save Certification Form
    function saveCertification(form, surl) {
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
            $('#modal-certification').modal('hide'); //Hide modal
            $.ALERT.show('success', res.message); // Show alert message
            loadCertifications(); // Load view
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


    //Add Certification
    $('#add-certification').click(function(e){
      e.preventDefault();
      
      //Reset Form
      resetCertificationForm(); 

      $('#formCertification').attr('action', base_url + 'candidate/certification/add');

      $('#modal-certification').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
    });


    //Edit Certification
    $(document).on('click', '.edit-certification', function(e){
      e.preventDefault();
      var btn = $(this);
      var cid = btn.attr('data-cid');
      var button_txt = btn.html();

      //Reset Form
      resetCertificationForm(); 

      if(cid != '' && typeof(cid) != 'undefined'){
        $.ajax({
          url: base_url + 'candidate/certification/detail/' + cid,
          type: 'post',
          data: {view: 1},
          dataType: 'json',
          beforeSend: function() {
            btn.html(spinner_icon).attr('disabled', false);
          },
          success: function(res) {
            if(res.success) {
              var category = res.success;
              
              $('#modal-certification').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
              });
              $('#formCertification').attr('action', base_url + 'candidate/certification/edit/' + cid);
              $('#formCertification').find('.certification-name').val(category.cc_name);
              $('#formCertification').find('.certification-description').val(category.cc_description);
              $('#formCertification').find('.certification-completion-year').val(category.cc_completion_year);
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


    //Delete Certification
    $(document).on('click', '.delete-certification', function(e){
      e.preventDefault();
      $('#modal-delete-certification').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });

      var cid = $(this).attr('data-cid');
      //Reset Form
      resetCertificationForm(); 

      $('#formDeleteCertification').submit(function(e){
        e.preventDefault();
        $form = $(this);
        var mparent = $form.parents('.modal');
        var mfooter = mparent.find('.modal-footer');
        var button_txt = $form.find('button[type=submit]').html();
        $.ajax({
          url: base_url + 'candidate/certification/delete/' + cid,
          type: 'post',
          dataType: 'json',
          beforeSend: function() {
            $form.find('button[type=submit]').html(loading_txt).attr('disabled', true);
          },
          success: function(res) {
            if(res.success) {
              $('#modal-delete-certification').modal('hide'); //Hide modal
              $.ALERT.show('success', res.message); // Show alert message
              loadCertifications(); // Load view
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

      $('#modal-delete-certification .btn-no').click(function(e){
        e.preventDefault();
        $('#modal-delete-certification').modal('hide');
      });
    });


    //Get Certification Data after page load
    setTimeout(function(){
      loadCertifications();
    }, 2000);
    
  });