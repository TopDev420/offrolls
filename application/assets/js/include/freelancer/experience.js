$(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';
    const workExperienceBlock = $('#work-experience-block');


    //Validation experience
    jQuery.validator.addMethod('checkDateRangeTo', function(value, element, param){
        var param1 = param[0], param2 = param[1], psdate_value='';
        if(param1 == 'year'){
            pedate_value = '01/'+ value + '/' + $(param2).val();
        } else {
            pedate_value = '01/'+ $(param2).val() + '/' + value;
        }

        var asyear = param[2], asmonth = param[3];
        psdate_value = '01/'+ $(asmonth).val() + '/' + $(asyear).val();
        //console.log(psdate_value);

        var psdate = new Date(date_formatRWS(psdate_value));

        var pedate = new Date(date_formatRWS(pedate_value));

        if(psdate.getTime() <= pedate.getTime()){
            return true;
        } else {
            return false;
        }

    }, "Given date should be greater than or equal to actual date");

    jQuery.validator.addMethod('checkDateRange', function(value, element, param){
        var param1 = param[0], param2 = param[1], pddate='';
        if(param1 == 'year'){
            pdate = '01/'+ value + '/' + $(param2).val();
        } else {
            pdate = '01/'+ $(param2).val() + '/' + value;
        }

        var cdate = new Date();

        var edate = new Date(date_formatRWS(pdate));
        //console.log(edate.getTime() +' - '+ cdate.getTime());
        if(edate.getTime() <= cdate.getTime()){
            return true;
        } else {
            return false;
        }
    }, "Given date should be less than or equal to current date");

    var formExperience = $('#formExperience').validate({
        rules: {
          experience_job_title: {
            required: true,
          },
          experience_company_name: {
            required: true,
          },
          'experience_start_date[year]': {
            required: true,
            checkDateRange : ['month', '#experienceStartMonth']
          },
          'experience_start_date[month]': {
            required: true
          },
          'experience_end_date[year]': {
            required: true,
            checkDateRange : ['month', '#experienceEndMonth'],
            checkDateRangeTo : ['month', '#experienceEndMonth', '#experienceStartYear', '#experienceStartMonth']
          },
          'experience_end_date[month]': {
            required: true,
          }
        },
        messages: {
          experience_job_title: "Please specify your job title",
          experience_company_name: "Please specify your organization",
          'experience_start_date[year]': {
            required: "Please select start date",
            checkDateRange: "Start date must not be greater than current date"
          },
          'experience_start_date[month]': {
            required: "Please select start date",
          },
          'experience_end_date[year]': {
            required: "Please select end date",
            checkDateRange: "End date must not be greater than current date",
            checkDateRangeTo: "End date must be greater than start date",
          },
          'experience_end_date[month]': {
            required: "Please select end date",
          }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `invalid-feedback` class to the error element
          error.addClass( "invalid-feedback" );

          if(element.data( "datepicker" ) === "select"){
              element.parents('.ele--jqvalid').find('.custom-errorMsg').html(error);
          } else if ( element.prop( "type" ) === "radio" || element.prop( "type" ) === "checkbox" || element.hasClass( "selectpicker" ) ) {
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
          saveExperience(form, surl);
        }
    });


    //Reset Form
    function resetExperienceForm(){
      $('#formExperience')[0].reset();
      $('#formExperience').attr('action', '#');
      $('#formDeleteexperience').attr('action', '#');
      formExperience.resetForm();
      $('.selectpicker').selectpicker('refresh');
    }

    //Load experiences View
    function loadExperiences() {
      $.ajax({
        url: base_url + 'freelancer/experience',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(res) {
          if(res.success) {
           viewExperienceSection(res.experiences);
          } else if(res.error){
            viewExperienceSection({});
           if(res.show){
            //$.ALERT.show('info', res.message);
            Toast.fire({
              icon: 'info',
              title: res.message,
              timer: false
          });
           }
          } else {
            viewExperienceSection({});
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

    function defaultExperienceSection(){
      workExperienceBlock.html('<p>Add details of your work experience</p>');
    }

    function viewExperienceSection(experiences){
      if(Object.keys(experiences).length > 0){
        workExperienceBlock.html('');
        if(experiences.data.length > 0){
          $('#nav-experiences .total--experience').html('[' + experiences.total + ']').css({'font-size':'1rem', 'font-weight':'400'});
          $.each(experiences.data, function(ci, experience){
            var serviceDate = '';
            var startDate = experience.cwe_start_date;
            var endDate = experience.cwe_end_date;
            if(startDate){
              serviceDate += startDate.month + ' - ' + startDate.year;
            }
            if(experience.cwe_current_company == 1){
              serviceDate += ' to Present';
            } else {
              if(endDate){
                serviceDate += ' to ' + endDate.month + ' - ' + endDate.year;
              }
            }

            workExperienceBlock.append('<div class="experience-section">' +
              '<div class="btn-action-block">' +
                '<button type="button" data-cweid="'+ experience.freelancer_experience_id +'" class="btn btn-primary alert-primary edit-experience">' +
                  '<i data-feather="edit-2"></i>' +
                '</button>' +
                '<button type="button" data-cweid="'+ experience.freelancer_experience_id +'" class="btn btn-danger alert-danger delete-experience">' +
                  '<i data-feather="trash-2"></i>' +
                '</button>' +
              '</div>' +
              '<h5>'+ experience.cwe_job_title +' <span>@ '+ experience.cwe_company_name +'</span></h5>' +
              '<span class="service-year">'+ serviceDate +' ('+ experience.cwe_total +')</span>' +
            '</div>');
          });

          feather.replace();
        } else {
          defaultExperienceSection();
        }
      } else {
        defaultExperienceSection();
      }
    }

    //Save experience Form
    function saveExperience(form, surl) {
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
            $('#modal-experience').modal('hide'); //Hide modal
            //$.ALERT.show('success', res.message); // Show alert message
            Toast.fire({
              icon: 'success',
              title: res.message,
              timer: false
          });
            loadExperiences(); // Load view
          } else if(res.error){
            //$.ALERT.show('danger', res.message);
            Toast.fire({
              icon: 'danger',
              title: res.message,
              timer: false
          });
          } else {
           // $.ALERT.show('danger', 'No Data');
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
          $(form).find('button[type=submit]').html(button_txt).attr('disabled', false);
        }
      });
    }


    //Add experience
    $('#add-experience').click(function(e){
      e.preventDefault();

      //Reset Form
      resetExperienceForm();

      $('#formExperience').attr('action', base_url + 'freelancer/experience/add');

      $('#modal-experience').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
    });


    //Edit experience
    $(document).on('click', '.edit-experience', function(e){
      e.preventDefault();
      var btn = $(this);
      var cweid = btn.attr('data-cweid');
      var button_txt = btn.html();

      //Reset Form
      resetExperienceForm();

      if(cweid != '' && typeof(cweid) != 'undefined'){
        $.ajax({
          url: base_url + 'freelancer/experience/detail/' + cweid,
          type: 'post',
          data: {view: 1},
          dataType: 'json',
          beforeSend: function() {
            btn.html(spinner_icon).attr('disabled', false);
          },
          success: function(res) {
            if(res.success) {
              var category = res.success;
              var startDate = category.cwe_start_date ? JSON.parse(category.cwe_start_date) : '';
              var endDate = category.cwe_end_date ? JSON.parse(category.cwe_end_date) : '';

              $('#modal-experience').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
              });
              $('#formExperience').attr('action', base_url + 'freelancer/experience/edit/' + cweid);
              $('#formExperience').find('.experience-job-title').val(category.cwe_job_title);
              $('#formExperience').find('.experience-company-name').val(category.cwe_company_name);
              $('#formExperience').find('.experience-current-company[value="'+ category.cwe_current_company+'"]').attr('checked', true);
              $('#formExperience').find('.experience-start-year').val(startDate.year).trigger('change');
              $('#formExperience').find('.experience-start-month').val(startDate.month).trigger('change');
              if(category.cwe_current_company == 1){
                $('#experience-enddate-row').hide();
              } else {
                $('#experience-enddate-row').show();
                if(endDate){
                  $('#formExperience').find('.experience-end-year').val(endDate.year).trigger('change');
                  $('#formExperience').find('.experience-end-month').val(endDate.month).trigger('change');
                }
              }
              
              $('.selectpicker').selectpicker('refresh');
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
      }

    });


    //Delete experience
    $(document).on('click', '.delete-experience', function(e){
      e.preventDefault();
      $('#modal-delete-experience').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });

      var cweid = $(this).attr('data-cweid');
      //Reset Form
      resetExperienceForm();

      $('#formDeleteExperience').submit(function(e){
        e.preventDefault();
        $form = $(this);
        var mparent = $form.parents('.modal');
        var mfooter = mparent.find('.modal-footer');
        var button_txt = $form.find('button[type=submit]').html();
        $.ajax({
          url: base_url + 'freelancer/experience/delete/' + cweid,
          type: 'post',
          dataType: 'json',
          beforeSend: function() {
            $form.find('button[type=submit]').html(loading_txt).attr('disabled', true);
          },
          success: function(res) {
            if(res.success) {
              $('#modal-delete-experience').modal('hide'); //Hide modal
              //$.ALERT.show('success', res.message); // Show alert message
              Toast.fire({
                icon: 'success',
                title: res.message,
                timer: false
            });
              loadExperiences(); // Load view
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
            $form.find('button[type=submit]').html(button_txt).attr('disabled', false);
          }
        });
      });

      $('#modal-delete-experience .btn-no').click(function(e){
        e.preventDefault();
        $('#modal-delete-experience').modal('hide');
      });
    });


    //Get experience Data after page load
    setTimeout(function(){
      loadExperiences();
    }, 2000);

  });
