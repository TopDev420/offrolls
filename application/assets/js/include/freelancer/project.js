$(function(){
    var base_url = $base_url;
    var loading_txt = $loading_txt;
    var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';
    const projectBlock = $('#project-block');

    //Validation project
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

    var formProject = $('#formProject').validate({
        rules: {
          project_name: {
            required: true,
          },
          project_company_name: {
            required: true,
          },
          project_description: {
            required: true,
          },
          'project_start_date[year]': {
            required: true,
            checkDateRange : ['month', '#projectStartMonth']
          },
          'project_start_date[month]': {
            required: true
          },
          'project_end_date[year]': {
            required: true,
            checkDateRange : ['month', '#projectEndMonth'],
            checkDateRangeTo : ['month', '#projectEndMonth', '#projectStartYear', '#projectStartMonth']
          },
          'project_end_date[month]': {
            required: true,
          }
        },
        messages: {
          project_name: "Please enter project name",
          project_company_name: "Please enter project description",
          project_description: "Please enter description",
          'project_start_date[year]': {
            required: "Please select start date",
            checkDateRange: "Start date must not be greater than current date"
          },
          'project_start_date[month]': {
            required: "Please select start date",
          },
          'project_end_date[year]': {
            required: "Please select end date",
            checkDateRange: "End date must not be greater than current date",
            checkDateRangeTo: "End date must be greater than start date",
          },
          'project_end_date[month]': {
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
          saveProject(form, surl);
        }
    });


    //Reset Form
    function resetProjectForm(){
      $('#formProject')[0].reset();
      $('#formProject').attr('action', '#');
      $('#formDeleteProject').attr('action', '#');
      formProject.resetForm();
      $('.selectpicker').selectpicker('refresh');
    }

    //Load projects View
    function loadProjects() {
      $.ajax({
        url: base_url + 'freelancer/project',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(res) {
          if(res.success) {
           viewProjectSection(res.success);
          } else if(res.error){
            viewProjectSection([]);
           if(res.show){
            //$.ALERT.show('info', res.message);
            Toast.fire({
              icon: 'info',
              title: res.message,
              timer: false
          });
           }
          } else {
            viewProjectSection([]);
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

    function defaultProjectSection(){
      projectBlock.html('<p>Add details about projects you have done in college, internship or at work.</p>');
    }

    function viewProjectSection(projects){
      projectBlock.html('');
      if(projects.length > 0){
        $.each(projects, function(ci, project){

          var status_txt = '';
          if(project.cp_status == 1){
            status_txt = 'In Progress';
          } else {
            status_txt = 'Finished';
          }
          projectBlock.append('<div class="experience-section">' +
              '<div class="btn-action-block">' +
                '<button type="button" data-cpid="'+ project.freelancer_project_id +'" class="btn btn-primary alert-primary edit-project">' +
                  '<i data-feather="edit-2"></i>' +
                '</button>' +
                '<button type="button" data-cpid="'+ project.freelancer_project_id +'" class="btn btn-danger alert-danger delete-project">' +
                  '<i data-feather="trash-2"></i>' +
                '</button>' +
              '</div>' +

              '<h5>'+ project.cp_name +'</h5>' +
              '<p>'+ project.cp_company_name +'</p>' +
              '<span class="service-year">'+ status_txt +'</span>' +
            '</div>');
        });

        feather.replace();
      } else {
        defaultProjectSection();
      }
    }

    //Save project Form
    function saveProject(form, surl) {
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
            $('#modal-project').modal('hide'); //Hide modal
            //$.ALERT.show('success', res.message); // Show alert message
            Toast.fire({
              icon: 'success',
              title: res.message,
              timer: false
          });
            loadProjects(); // Load view
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


    //Add project
    $('#add-project').click(function(e){
      e.preventDefault();

      //Reset Form
      resetProjectForm();

      $('#formProject').attr('action', base_url + 'freelancer/project/add');

      $('#modal-project').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
    });


    //Edit project
    $(document).on('click', '.edit-project', function(e){
      e.preventDefault();
      var btn = $(this);
      var cpid = btn.attr('data-cpid');
      var button_txt = btn.html();

      //Reset Form
      resetProjectForm();

      if(cpid != '' && typeof(cpid) != 'undefined'){
        $.ajax({
          url: base_url + 'freelancer/project/detail/' + cpid,
          type: 'post',
          data: {view: 1},
          dataType: 'json',
          beforeSend: function() {
            btn.html(spinner_icon).attr('disabled', false);
          },
          success: function(res) {
            if(res.success) {
              var category = res.success;

              $('#modal-project').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
              });
              var start_date = JSON.parse(category.cp_start_date);
              var end_date = JSON.parse(category.cp_end_date);
              $('#formProject').attr('action', base_url + 'freelancer/project/edit/' + cpid);
              $('#formProject').find('.project-name').val(category.cp_name);
              $('#formProject').find('.project-company-name').val(category.cp_company_name);
              $('#formProject').find('.project-url').val(category.cp_url);
              $('#formProject').find('.project-description').val(category.cp_description);
              $('#formProject').find('.project-status[value='+category.cp_status+']').trigger('click');
              $('#formProject').find('.project-start-year').val(start_date.year).trigger('change');
              $('#formProject').find('.project-start-month').val(start_date.month).trigger('change');
              $('#formProject').find('.project-end-year').val(end_date.year).trigger('change');
              $('#formProject').find('.project-end-month').val(end_date.month).trigger('change');
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


    //Delete project
    $(document).on('click', '.delete-project', function(e){
      e.preventDefault();
      $('#modal-delete-project').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });

      var cpid = $(this).attr('data-cpid');
      //Reset Form
      resetProjectForm();

      $('#formDeleteProject').submit(function(e){
        e.preventDefault();
        $form = $(this);
        var mparent = $form.parents('.modal');
        var mfooter = mparent.find('.modal-footer');
        var button_txt = $form.find('button[type=submit]').html();
        $.ajax({
          url: base_url + 'freelancer/project/delete/' + cpid,
          type: 'post',
          dataType: 'json',
          beforeSend: function() {
            $form.find('button[type=submit]').html(loading_txt).attr('disabled', true);
          },
          success: function(res) {
            if(res.success) {
              $('#modal-delete-project').modal('hide'); //Hide modal
              //$.ALERT.show('success', res.message); // Show alert message
              Toast.fire({
                icon: 'success',
                title: res.message,
                timer: false
            });
              loadProjects(); // Load view
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

      $('#modal-delete-project .btn-no').click(function(e){
        e.preventDefault();
        $('#modal-delete-project').modal('hide');
      });
    });


    //Get project Data after page load
    loadProjects();

    $('#portfolio-image-upload input[name=\'portfolio_files\']').change(function(e){
      var reader = new FileReader();
      var fileInput = $(this);
      let file = fileInput.get(0).files[0];

    
      reader.onload = function(e){
          // fileInput.parent().find('.preview-block').html('<img src="'+ e.target.result +'" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />');

          imageModal = '<div id="image-cropperjs">'+
              '<div class="cropper-body">'+
                  '<img src="'+ e.target.result +'" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />' +
              '</div>' +
          '</div>';

          Swal.fire({
              html: imageModal,
              customClass: {
                popup: 'col-md-6 col-g-6'
              },
              allowOutsideClick: false,
              allowEscapeKey: false,
              showConfirmButton: true,
              confirmButtonText:'<i class="mdi mdi-crop"></i> Crop',
              showCloseButton: true,
              didOpen: function(element){
                  // Cropper
                  var previewBlock = $('#image-cropperjs .cropper-body img');
                  previewBlock.cropper({
                    // aspectRatio: 16 / 9,
                    minCropBoxWidth: 150,
                    minCropBoxHeight: 150,
                    minCanvasWidth: 150,
                    minCanvasHeight: 150,
                    cropBoxResizable: false,
                    data: {
                      width:150,
                      height:150
                    }
                  });

                  
              }
          }).then(function(result){
              if(result.isConfirmed){
                  // Get the Cropper.js instance after initialized
                  var cropperz = $('#image-cropperjs .cropper-body img').data('cropper');
                  cropperz.crop();
                  var croppedCanvas = cropperz.getCroppedCanvas();
                  var croppedimage = croppedCanvas.toDataURL("image/png");
                  fileInput.parents('.upload-profile-photo').find('.update-photo').html('<img src="'+ croppedimage +'" class="animate__animated animate__zoomIn img-fluid d-block mx-auto" alt="Preview" />');
                          
                  // File Upload
                  var file_array = new FormData();
                  file_array.append('portfolio_files', croppedimage);

                  var url = $base_url + 'freelancer/project/save_picture';
                  uploadFiles(url, file_array);
              }
          });

      }
      reader.readAsDataURL(file);
  });

  });
