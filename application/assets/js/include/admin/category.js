 $(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';


    $('#formAddCategory').validate({
        rules: {
          category_name: {
            required: true
          },
          path: {
            required: true
          },
          status: {
            required: true
          }
        },
        messages: {
          category_name: "Please enter category name",
          path: "Please select category",
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
          saveCategory(form);
        }
    });

    $('#formEditCategory').validate({
        rules: {
          category_name: {
            required: true
          },
          path: {
            required: true
          },
          status: {
            required: true
          }
        },
        messages: {
          category_name: "Please enter category name",
          path: "Please select category",
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
          saveCategory(form);
        }
    });


/* Add Category*/
    $('#add-category').click(function(e){
      e.preventDefault();
      $('#formAddCategory')[0].reset();
      $('#formAddCategory').find('.status').val('default').selectpicker('refresh');
      $('#modalAddCategory').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
    });

/* Edit Category*/
    $('.edit-category').click(function(e){
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
            $('#formEditCategory')[0].reset();
            $('#formEditCategory').find('.status').val('default').selectpicker('refresh');
          },
          success: function(res) {
            if(res.success) {
              var category = res.success;
              $('#formEditCategory').attr('action', eaction);
              $('#modalEditCategory').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
              });
              $('#formEditCategory').find('.category-name').val(category.name);
              if(typeof category.sort_order != 'undefined' && category.sort_order != ''){
              $('#formEditCategory').find('.sort-order').val(category.sort_order);
            }
              if(category.parent_id != 0){
                $('#formEditCategory').find('input[name=path]').val(category.parent_name);
                $('#formEditCategory').find('input[name=parent_id]').val(category.parent_id);
              }

              $('#formEditCategory').find('.status').val(category.status).selectpicker('refresh');
            } else {
              alert('Category detail not found');
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



    function saveCategory(form) {
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

/* Delete Category*/
    $('.delete-category').click(function(e){
      e.preventDefault();
      $('#modalDeleteCategory').modal({
        show: true,
        backdrop: 'static',
        keyboard: false
      });
      var daction = $(this).attr('href');
      if( daction !== '' && typeof(daction) != 'undefined') {
        $('#formDeleteCategory').attr('action', daction);
        $('#formDeleteCategory').find('.btn-yes').click(function(e){
          e.preventDefault();
          deleteCategory('#modalDeleteCategory', '#formDeleteCategory');
        });

        $('#formDeleteCategory').find('.btn-no').click(function(e){
          e.preventDefault();
          $('#modalDeleteCategory').modal('hide');
        });
      }

    });

    function deleteCategory(modal, form) {
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
