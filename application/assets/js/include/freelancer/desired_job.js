(function($) {
    // Autocomplete
    $('input[name=\'languages\']').autocomplete({
      'source': function(request, response) {
        if(request == ''){
          ithis.val('');
          ithis.parent().find('input[name=\'languages\']').val('');
      }
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
      },
      'select': function(item) {
        $('input[name=\'languages\']').val('');

        $('#language-category' + item['value']).remove();

        $('#language-category').append('<div class="language-category" id="language-category' + item['value'] + '"><i class="remove-language fas fa-times-circle"></i> ' + item['label'] + '<input type="hidden" name="job_languages[]" value="' + item['value'] + '" /></div>');
        $('#language-category .remove-language').click(function(e){
          e.preventDefault();
          $(this).parent().remove();
        });
      }
    });

  })(window.jQuery);


  $(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';


    $('#formDesiredJob').submit(function(e){
      e.preventDefault();
      saveDesiredJob($(this));
    });

    //Reset Form
    function resetDesiredJobForm(){
      $('#formDesiredJob')[0].reset();
      $('#formDesiredJob #language-category').html('');
      // formProfileSummary.resetForm();
    }

    //Load Certifications View
    function loadDesiredJob() {
      $.ajax({
        url: base_url + 'freelancer/profile/desired_job',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(res) {
          if(res.success) {
           viewDesiredJobSection(res.data);
          } else if(res.error){
           if(res.show){
            //$.ALERT.show('info', res.message);
            Toast.fire({
              icon: 'info',
              title: res.message,
              timer: false
          });
           }
          } else {
            //$.ALERT.show('info', 'No Data');
            Toast.fire({
              icon: 'info',
              title: 'No Data',
              timer: false
          });
          }
        },
        error: function(xhr, ajaxOptions, errorThown) {
          console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
        },
        complete: function() {

        }
      });
    }

    function viewDesiredJobSection(data){
      $('#desired-job-detail-block').html(
        // '<div class="row">' +
        // '<label class="col-sm-3">Experience</label> <span class="col-sm-9 select-experience">'+data.experience.name+'</span>'+
        // '</div>' +
        '<div class="row">' +
            '<label class="mx-3">Language:</label>'+
            '<div class="text-justify" id="languages-block"></div>'+
        '</div>');
      $('#languages-block').html('');
      if(data.languages.length > 0){
        $.each(data.languages, function(ci, language){
          $('#languages-block').append('<span class="button--gprimary">'+ language.name +'</span>');
        });
      } else {
        $('#languages-block').html('No');
      }
    }

    function saveDesiredJob(form) {
      var mparent = form.parents('.modal');
      var mfooter = mparent.find('.modal-footer');
      var button_txt = form.find('button[type=submit]').html();
      $.ajax({
        url: base_url + 'freelancer/profile/desired_job/edit',
        type: 'post',
        data: form.serialize(),
        dataType: 'json',
        beforeSend: function() {
          form.find('button[type=submit]').html(loading_txt).attr('disabled', true);
        },
        success: function(res) {
          if(res.success) {
            $('#modal-language').modal('hide'); //Hide modal
            //$.ALERT.show('success', res.message); // Show alert message
            Toast.fire({
              icon: 'success',
              title: res.message,
              timer: false
          });
            loadDesiredJob(); // Load view
          } else if(res.error){
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
        error: function(xhr, ajaxOptions, errorThown) {
          console.log('Ajax error' + ' - ' + xhr.statusText + ' - ' + xhr.responseText);
        },
        complete: function() {
          form.find('button[type=submit]').html(button_txt).attr('disabled', false);
        }
      });
    }


    //Edit profilesummary
    $(document).on('click', '#edit-languages', function(e){
      e.preventDefault();
      var btn = $(this);
      var button_txt = btn.html();

      //Reset Form
      resetDesiredJobForm();

      $.ajax({
        url: base_url + 'freelancer/profile/desired_job',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          btn.html(spinner_icon).attr('disabled', false);
        },
        success: function(res) {
          if(res.success) {
            var response = res.data;

            $('#modal-language').modal({
              backdrop: 'static',
              keyboard: false,
              show: true
            });

            // $('#job-experience').val(response.experience.category_id);
            $('#language-category').html('');
            $.each(response.languages, function(s, language){
              $('#language-category').append('<div class="language-category" id="language-category' + language.language_id + '"><i class="remove-language fas fa-times-circle"></i> ' + language.name + '<input type="hidden" name="language_category[]" value="' + language.language_id + '" /></div>');
            });

            // $('#job-experience').selectpicker('refresh');

            $('#language-category .remove-language').click(function(e){
              e.preventDefault();
              $(this).parent().remove();
            });
          } else if(res.error) {
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
        error: function(xhr, ajaxOptions, errorThown) {
            console.log(xhr.statusText + ' - ' + xhr.responseText);
        },
        complete: function() {
          btn.html(button_txt).attr('disabled', false);
        }
      });

    });



    //Load languages after page load
    setTimeout(function(){
      loadDesiredJob();
    }, 2000);
  });
