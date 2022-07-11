$(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';


    //Validation PersonalDetail
    jQuery.validator.addMethod('ageLimit', function(value, element){
        var cdate = new Date();
        var evalue = value.split('/');
        evalue.reverse();
        var envalue = evalue.join('-');
        var edate = new Date(envalue);
        var diff = cdate - edate;

        var years = Math.floor(diff/31536000000);
        if(years >= $minAge){
            return true;
        } else {
            return false;
        }

    }, "Age must be above or equal to 35 years");

    var formPersonalDetail = $('#formPersonalDetail').validate({
        rules: {
          personal_father_name: {
            required: true,
          },
          personal_mother_name: {
            required: true,
          },
          personal_dob: {
            required: true,
            ageLimit: true
          },
          personal_nationality: {
            required: true,
          },
          personal_gender: {
            required: true,
          }
        },
        messages: {
          personal_father_name: {
            required: "Please specify your Father Name",
          },
          personal_mother_name: {
            required: "Please specify your Mother Name",
          },
          personal_dob: {
            required: "Please choose your Date of Birth",
          },
          personal_nationality: {
            required: "Please specify nationality",
          },
          personal_gender: {
            required: "Please select Gender",
          }
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
          savePersonalDetail(form, surl);
        }
    });


    //Reset Form
    function resetPersonalDetailForm(){
      $('#formPersonalDetail')[0].reset();
      $('#formPersonalDetail').attr('action', '#');
      $('#formDeletePersonalDetail').attr('action', '#');
      formPersonalDetail.resetForm();
    }

    //Load PersonalDetails View
    function loadPersonalDetail() {
      $.ajax({
        url: formUrl('admin/candidate/profile/personal', {candidate_id:candidate_id}),
        type: 'post',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(res) {
          if(res.success) {
           viewPersonalDetailSection(res.success);
          } else if(res.error){
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

    function viewPersonalDetailSection(response){
      $('#personal-detail-block').html('<ul>'+
          '<li><span>Fathers Name:</span> '+ response.father_name +'</li>'+
          '<li><span>Mothers Name:</span> '+ response.mother_name +'</li>'+
          '<li><span>Date of Birth:</span> '+ response.dob +'</li>'+
          '<li><span>Nationality:</span> '+ response.nationality +'</li>'+
          '<li><span>Sex:</span> '+ response.gender +'</li>'+
        //   '<li><span>Age:</span> '+ response.age +'</li>'+
        '</ul>');
    }

    //Save PersonalDetail Form
    function savePersonalDetail(form, surl) {
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
            $('#modal-personal-detail').modal('hide'); //Hide modal
            $.ALERT.show('success', res.message); // Show alert message
            loadPersonalDetail(); // Load view
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


    //Edit PersonalDetail
    $(document).on('click', '#edit-personal-details', function(e){
      e.preventDefault();
      var btn = $(this);
      var button_txt = btn.html();

      //Reset Form
      resetPersonalDetailForm();


      $.ajax({
        url: formUrl('admin/candidate/profile/personal', {candidate_id:candidate_id}),
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          btn.html(spinner_icon).attr('disabled', false);
        },
        success: function(res) {
          if(res.success) {
            var response = res.success;

            $('#modal-personal-detail').modal({
              backdrop: 'static',
              keyboard: false,
              show: true
            });
            $('#formPersonalDetail').attr('action', formUrl('admin/candidate/profile/personal/edit', {candidate_id:candidate_id}));
            $('#formPersonalDetail').find('[name=personal_father_name]').val(response.father_name);
            $('#formPersonalDetail').find('[name=personal_mother_name]').val(response.mother_name);
            $('#formPersonalDetail').find('[name=personal_dob]').val((response.dob) ? date_format(response.dob) : '');
            $('#formPersonalDetail').find('[name=personal_nationality]').val(response.nationality);
            $('#formPersonalDetail').find('[name=personal_gender]').val(response.gender);
            // $('#formPersonalDetail').find('[name=personal_age]').val(response.age);
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

    //Get PersonalDetail Data after page load
    setTimeout(function(){
      loadPersonalDetail();
    }, 2000);

  });
