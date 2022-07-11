$(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';

    // Autocomplete
    $('input[name=\'job_location\']').autocomplete({
      'source': function(request, response) {
        $.ajax({
          url: $base_url +'category/location/autocomplete/' + request,
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
      },
      'select': function(item) {
        $('input[name=\'job_location\']').val(item['label']);
      }
    });

    //Validation DesiredCareerDetail
    var formDesiredCareerDetail = $('#formDesiredCareerDetail').validate({
        rules: {
          industry_type: {
            required: true
          },
          job_location: {
            required: true
          },
          job_type: {
            required: true
          },
          'job_salary_range[from]': {
            required: true,
            digits: true
          },
          'job_salary_range[to]': {
            required: true,
            digits: true
          },
          'job_salary_range[period]': {
            required: true
          }
        },
        messages: {
          industry_type: {
              required: "Please select industry"
          },
          job_type: {
              required: "Please choose job type"
          },
          job_location: {
              required: "Please enter job location"
          },
          'job_salary_range[from]': {
            required: "Please enter job salary minimum amount",
            digits: "Amount must be numeric"
          },
          'job_salary_range[to]': {
            required: "Please enter job salary maximum amount",
            digits: "Amount must be numeric"
          },
          'job_salary_range[period]': {
            required: "Please select job salary period"
          }
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
        submitHandler: function(form) {
          var surl = $(form).attr('action');
          saveDesiredCareerDetail(form, surl);
        }
    });


    //Reset Form
    function resetDesiredCareerDetailForm(){
      $('#formDesiredCareerDetail')[0].reset();
      $('#formDesiredCareerDetail').attr('action', '#');
      $('#formDeleteDesiredCareerDetail').attr('action', '#');
      formDesiredCareerDetail.resetForm();
    }

    //Load DesiredCareerDetails View
    function loadDesiredCareerDetail() {
      $.ajax({
        url: base_url + 'candidate/profile/career',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(res) {
          if(res.success) {
           viewDesiredCareerDetailSection(res.success);
          } else if(res.error){
           // $('#desired-career-detail-block').html('');
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

    function viewDesiredCareerDetailSection(response){
      var salary_range = '';
      if(response.salary_range_from){
        salary_range += response.salary_range_from + ' - ';
      }

      if(response.salary_range_to){
        salary_range += response.salary_range_to + ' ';
      }

      if(response.salary_range_to){
        salary_range += ' ' + response.salary_period;
      }

      $('#desired-career-detail-block').html('<ul>' +
        '<li><span>Industry:</span> '+ response.industry +'</li>' +
        '<li><span>Job Type:</span> '+ response.job_type +'</li>' +
        '<li><span>Job Location:</span> '+ response.job_location +'</li>' +
        '<li><span>Salary:</span> '+ salary_range +'</li>' +
      '</ul>');
    }

    //Save DesiredCareerDetail Form
    function saveDesiredCareerDetail(form, surl) {
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
            $('#modal-desired-career-detail').modal('hide'); //Hide modal
            $.ALERT.show('success', res.message); // Show alert message
            loadDesiredCareerDetail(); // Load view
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


    //Edit DesiredCareerDetail
    $(document).on('click', '#edit-desired-career-details', function(e){
      e.preventDefault();
      var btn = $(this);
      var button_txt = btn.html();

      //Reset Form
      resetDesiredCareerDetailForm();


      $.ajax({
        url: base_url + 'candidate/profile/career',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          btn.html(spinner_icon).attr('disabled', false);
        },
        success: function(res) {
          if(res.success) {
            var response = res.success;

            $('#modal-desired-career-detail').modal({
              backdrop: 'static',
              keyboard: false,
              show: true
            });

            if(response.salary_range_from && response.salary_range_from != 0){
                 salary_range_from = response.salary_range_from;
            } else {
                salary_range_from = '';
            }

            if(response.salary_range_to && response.salary_range_to != 0){
                 salary_range_to = response.salary_range_to;
            } else {
                salary_range_to = '';
            }

            $('#formDesiredCareerDetail').attr('action', base_url + 'candidate/profile/career/edit');
            $('#formDesiredCareerDetail').find('.industry-type').val(response.industry_type_id);
            $('#formDesiredCareerDetail').find('.job-type[value='+ response.job_type_id+']').attr('checked', true);
            $('#formDesiredCareerDetail').find('.job-location').val(response.job_location);
            $('#formDesiredCareerDetail').find('.salary-range-from').val(salary_range_from);
            $('#formDesiredCareerDetail').find('.salary-range-to').val(salary_range_to);
            $('#formDesiredCareerDetail').find('.salary-period').val(response.salary_period_id);
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


    });

    //Get DesiredCareerDetail Data after page load
    setTimeout(function(){
      loadDesiredCareerDetail();
    }, 2000);

  });
