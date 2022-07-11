(function($) {
    // Autocomplete
    $('input[name=\'skills\']').autocomplete({
      'source': function(request, response) {
        $.ajax({
          url: $base_url +'category/skills/autocomplete/' + request,
          type: 'post',
          dataType: 'json',
          success: function(json) {
            response($.map(json, function(item) {
              return {
                label: item['name'],
                value: item['category_id']
              }
            }));
          },
        });
      },
      'select': function(item) {
        $('input[name=\'skills\']').val('');

        $('#skill-category' + item['value']).remove();

        $('#skill-category').append('<div class="skill-category" id="skill-category' + item['value'] + '"><i class="remove-skill fas fa-times-circle"></i> ' + item['label'] + '<input type="hidden" name="skill_category[]" value="' + item['value'] + '" /></div>');
        $('#skill-category .remove-skill').click(function(e){
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


    $('#formSkills').submit(function(e){
      e.preventDefault();
      saveSkill($(this));
    });

    //Reset Form
    function resetSkillsForm(){
      $('#formSkills')[0].reset();
      $('#formSkills #skill-category').html('');
      // formProfileSummary.resetForm();
    }

    //Load Certifications View
    function loadSkills() {
      $.ajax({
        url: base_url + 'candidate/profile/skills',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(res) {
          if(res.success) {
           viewSkillsSection(res.success);
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

    function viewSkillsSection(skills){
      $('#skills-block').html('');
      if(skills){
        $.each(skills, function(ci, skill){
          $('#skills-block').append('<a href="javascript:void(0)">'+ skill.name +'</a>');
        });
      }
    }

    function saveSkill(form) {
      var mparent = form.parents('.modal');
      var mfooter = mparent.find('.modal-footer');
      var button_txt = form.find('button[type=submit]').html();
      $.ajax({
        url: base_url + 'candidate/profile/skills/edit',
        type: 'post',
        data: form.serialize(),
        dataType: 'json',
        beforeSend: function() {
          form.find('button[type=submit]').html(loading_txt).attr('disabled', true);
        },
        success: function(res) {
          if(res.success) {
            $('#modal-skill').modal('hide'); //Hide modal
            $.ALERT.show('success', res.message); // Show alert message
            loadSkills(); // Load view
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
          form.find('button[type=submit]').html(button_txt).attr('disabled', false);
        }
      });
    }


    //Edit profilesummary
    $(document).on('click', '#edit-skills', function(e){
      e.preventDefault();
      var btn = $(this);
      var button_txt = btn.html();

      //Reset Form
      resetSkillsForm();

      $.ajax({
        url: base_url + 'candidate/profile/skills',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
          btn.html(spinner_icon).attr('disabled', false);
        },
        success: function(res) {
          if(res.success) {
            var response = res.success;

            $('#modal-skill').modal({
              backdrop: 'static',
              keyboard: false,
              show: true
            });

            $('#skill-category').html('');
            $.each(res.success, function(s, skill){
              $('#skill-category').append('<div class="skill-category" id="skill-category' + skill.skill_id + '"><i class="remove-skill fas fa-times-circle"></i> ' + skill.name + '<input type="hidden" name="skill_category[]" value="' + skill.skill_id + '" /></div>');
            });

            $('#skill-category .remove-skill').click(function(e){
              e.preventDefault();
              $(this).parent().remove();
            });
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



    //Load skills after page load
    setTimeout(function(){
      loadSkills();
    }, 2000);
  });
