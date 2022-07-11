 $(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';


    $('#formAddNewsletter').validate({
        rules: {
          subscriber_email: {
            required: true,
            email: true
          },
          status: {
            required: true
          }
        },
        messages: {
          subscriber_email: "Please enter subscriber name",
          status: "Please select status",
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `invalid-feedback` class to the error element
          error.addClass( "invalid-feedback" );

          element.parents('.ele--jqvalid').append(error);
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        },
        unhighlight: function (element, errorClass, validClass) {
          $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        },
        submitHandler: function(form) {
          saveNewsletter(form);
        }
    });

    $('#formEditNewsletter').validate({
        rules: {
          subscriber_email: {
            required: true
          },
          status: {
            required: true
          }
        },
        messages: {
          subscriber_email: "Please enter subscriber email",
          status: "Please select status",
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `invalid-feedback` class to the error element
          error.addClass( "invalid-feedback" );

          element.parents('.ele--jqvalid').append(error);
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        },
        unhighlight: function (element, errorClass, validClass) {
          $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        },
        submitHandler: function(form) {
          saveNewsletter(form);
        }
    });


/* Add Newsletter*/
    $('#add-newsletter').click(function(e){
      e.preventDefault();
      $('#formAddNewsletter')[0].reset();
      $('#formAddNewsletter').find('.status').val('default').selectpicker('refresh');
      $('#modalAddNewsletter').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
    });

/* Edit Newsletter*/
    $('.edit-newsletter').click(function(e){
      e.preventDefault();
      var btn = $(this);
      var eaction = btn.attr('href');
      var button_txt = btn.html();

      if(eaction != '' && typeof(eaction) != 'undefined'){
        $.ajax({
          url: eaction,
          type: 'post',
          data: {view: 1},
          dataType: 'json',
          beforeSend: function() {
            btn.html(spinner_icon).attr('disabled', false);
            $.FEED.showLoader();
            $('#formEditNewsletter')[0].reset();
            $('#formEditNewsletter').find('.status').val('default').selectpicker('refresh');
          },
          success: function(res) {
            if(res.success) {
              var newsletter = res.success;
              $('#formEditNewsletter').attr('action', eaction);
              $('#modalEditNewsletter').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
              });
              $('#formEditNewsletter').find('.subscriber-email').val(newsletter.name);
              if(newsletter.parent_id != 0){
                $('#formEditNewsletter').find('input[name=path]').val(newsletter.parent_name);
                $('#formEditNewsletter').find('input[name=parent_id]').val(newsletter.parent_id);
              }

              $('#formEditNewsletter').find('.status').val(newsletter.status).selectpicker('refresh');
            } else {
              alert('Newsletter detail not found');
            }
          },
          error: function(xhr, ajaxOptions, errorThown) {
              console.log(xhr.statusText + ' - ' + xhr.responseText);
          },
          complete: function() {
            btn.html(button_txt).attr('disabled', false);
            $.FEED.hideLoader();
          }
        });
      }

    });



    function saveNewsletter(form) {
      var mparent = $(form).parents('.modal');
      var mfooter = mparent.find('.modal-footer');
      var button_txt = $(form).find('button[type=submit]').html();
      $.ajax({
        url: $(form).attr('action'),
        type: 'post',
        data: $(form).serialize(),
        dataType: 'json',
        beforeSend: function() {
          $(form).find('button[type=submit]').html(loading_txt).attr('disabled', true);
          $.FEED.showLoader();
        },
        success: function(res) {
          if(res.success) {
            mfooter.html('<p class="alert text-success">'+ res.success +'</p>');

            setTimeout(function(){
              location.reload();
            }, 2000);
          } else if(res.error){
            mfooter.html('<p class="alert text-danger">'+ res.error +'</p>');
          } else {
            mfooter.html('<p class="alert text-danger">No Data</p>');
          }

          setTimeout(function(){
            mfooter.find('.alert').fadeOut(200).html('');
          }, 2000);
        },
        error: function(xhr, ajaxOptions, errorThown) {
          console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
        },
        complete: function() {
          $.FEED.hideLoader();
          $(form).find('button[type=submit]').html(button_txt).attr('disabled', false);
        }
      });
    }

/* Delete Newsletter*/
    $('.delete-newsletter').click(function(e){
      e.preventDefault();
      $('#modalDeleteNewsletter').modal({
        show: true,
        backdrop: 'static',
        keyboard: false
      });
      var daction = $(this).attr('href');
      if( daction !== '' && typeof(daction) != 'undefined') {
        $('#formDeleteNewsletter').attr('action', daction);
        $('#formDeleteNewsletter').find('.btn-yes').click(function(e){
          e.preventDefault();
          deleteNewsletter('#modalDeleteNewsletter', '#formDeleteNewsletter');
        });

        $('#formDeleteNewsletter').find('.btn-no').click(function(e){
          e.preventDefault();
          $('#modalDeleteNewsletter').modal('hide');
        });
      }

    });

    function deleteNewsletter(modal, form) {
      var mfooter = $(modal).find('.modal-body .alerts');
      var button_txt = $(form).find('.btn-yes').html();
      $.ajax({
        url: $(form).attr('action'),
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          $(modal).find('button[type=button]').attr('disabled', true);
          $(form).find('.btn-yes').html(spinner_icon);
          $.FEED.showLoader();
        },
        success: function(res) {
          if(res.success) {
            mfooter.html('<p class="alert text-success">'+ res.success +'</p>');

            setTimeout(function(){
              location.reload();
            }, 2000);
          } else if(res.error){
            mfooter.html('<p class="alert text-danger">'+ res.error +'</p>');
          } else {
            mfooter.html('<p class="alert text-danger">No Data</p>');
          }

          setTimeout(function(){
            mfooter.fadeOut(200).html('');
            $(modal).modal('hide');
          }, 2000);
        },
        error: function(xhr, ajaxOptions, errorThown) {
          console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
        },
        complete: function() {
          $(modal).find('button[type=button]').attr('disabled', false);
          $(form).find('.btn-yes').html(button_txt);
          $.FEED.hideLoader();
        }
      });
    }

  });
