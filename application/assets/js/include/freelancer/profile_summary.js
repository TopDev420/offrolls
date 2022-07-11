$(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';
    const profileSummaryBlock = $('#profile-summary-block');

    // Init summernote editor
    initSummerNote(['#formProfileSummary .ps_description']);

    //Validation profilesummary
    var formProfileSummary = $('#formProfileSummary').validate({
        rules: {
          ps_description: {
            required: true,
          }
        },
        messages: {
          ps_description: "Please enter profile summary",
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
          saveProfileSummary(form, surl);
        }
    });


    //Reset Form
    function resetProfileSummaryForm(){
      $('#formProfileSummary')[0].reset();
      $('#formProfileSummary').attr('action', '#');
      $('#formDeleteprofileSummary').attr('action', '#');
      formProfileSummary.resetForm();
    }

    //Load profilesummarys View
    function loadProfileSummary() {
      $.ajax({
        url: base_url + 'freelancer/profile/summary',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          
        },
        success: function(res) {
          $('#experience-block').html('');
          if(res.success) {
           viewProfileSummarySection(res.success);
          } else if(res.error){
            defaultProfileSummarySection();
           if(res.show){
            //$.ALERT.show('info', res.message);
            Toast.fire({
              icon: 'info',
              title: res.message,
              timer: false
          });
           }
          } else {
            defaultProfileSummarySection();
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

    function defaultProfileSummarySection(){
      profileSummaryBlock.html('<p>Describe your strength, skills, accomblishment and education etc. </p>');
    }

    function viewProfileSummarySection(response){
      if(response.profile_summary){
        profileSummaryBlock.html('<p>'+ response.profile_summary +'</p>');
        feather.replace();
      } else {
        defaultProfileSummarySection();
      }
        
    }

    //Save profilesummary Form
    function saveProfileSummary(form, surl) {
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
            $('#modal-profile-summary').modal('hide'); //Hide modal
            //$.ALERT.show('success', res.message); // Show alert message
            Toast.fire({
              icon: 'sucess',
              title: res.message,
              timer: false
          });
            loadProfileSummary(); // Load view
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
          $(form).find('button[type=submit]').html(button_txt).attr('disabled', false);
        }
      });
    }


    //Edit profilesummary
    $(document).on('click', '#edit-profile-summary', function(e){
      e.preventDefault();
      var btn = $(this);
      var button_txt = btn.html();

      //Reset Form
      resetProfileSummaryForm(); 

      
      $.ajax({
        url: base_url + 'freelancer/profile/summary',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          btn.html(spinner_icon).attr('disabled', false);
        },
        success: function(res) {
          if(res.success) {
            var response = res.success;
            
            $('#modal-profile-summary').modal({
              backdrop: 'static',
              keyboard: false,
              show: true
            });
            $('#formProfileSummary').attr('action', base_url + 'freelancer/profile/summary/edit');
            $('#formProfileSummary').find('.ps_description').val(response.profile_summary);
            
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

    //Get profilesummary Data after page load
    setTimeout(function(){
      loadProfileSummary();
    }, 2000);
    
  });