(function ($) {
  // Autocomplete
  $("input[name='skills']").autocomplete({
    source: function (request, response) {
      if (request == "") {
        $("input[name='skills']").val("");
      }
      $.ajax({
        url: $base_url + "category/skills/autocomplete/" + request,
        type: "post",
        dataType: "json",
        success: function (json) {
          response(
            $.map(json, function (item) {
              return {
                label: item["label"],
                value: item["value"],
              };
            })
          );
        },
      });
    },
    select: function (item) {
      $("input[name='skills']").val("");

      $("#skill-category" + item["value"]).remove();
      console.log("hello");
      $("#skill-category").append(
        '<div class="skill-category col-md-10" id="skill-category' +
          item["value"] +
          '">' +
          '<div class="bg row align-items-center justify-content-between">' +
          '<div class="col-md-4">' +
          item["label"] +
          "</div>" +
          '<div class="col-md-4">' +
          '<lable class="pl-4">Skill Level</lable>' +
          '<input type="hidden" name="skill_category[' +
          item["value"] +
          '][skill_id]" value="' +
          item["value"] +
          '" />' +
          '<input type="number" class="form-control" min="0" name="skill_category[' +
          item["value"] +
          '][skill_percentage]" value="0" />' +
          "</div>" +
          '<div class="col-md-2"><i class="remove-skill fas fa-times-circle"></i></div>' +
          "</div>" +
          "</div>"
      );

      $("#skill-category .remove-skill").click(function (e) {
        e.preventDefault();
        $(this).parents(".skill-category").remove();
      });
    },
  });
})(window.jQuery);

$(function () {
  var base_url = $base_url;
  var loading_txt = $loading_txt;
  var spinner_icon = '<i class="fas fa-spinner fa-pulse"></i>';
  const skillsBlock = $("#skills-block");

  $("#formSkills").submit(function (e) {
    e.preventDefault();
    saveSkill($(this));
  });

  //Reset Form
  function resetSkillsForm() {
    $("#formSkills")[0].reset();
    $("#formSkills #skill-category").html("");
    // formProfileSummary.resetForm();
  }

  //Load Certifications View
  function loadSkills() {
    $.ajax({
      url: base_url + "freelancer/profile/skills",
      type: "post",
      dataType: "json",
      beforeSend: function () {},
      success: function (res) {
        skillsBlock.html("");
        if (res.success) {
          viewSkillsSection(res.success);
        } else if (res.error) {
          viewSkillsSection([]);
          if (res.show) {
            //$.ALERT.show('info', res.message);
            Toast.fire({
              icon: "info",
              title: res.message,
            });
          }
        } else {
          viewSkillsSection([]);
          //$.ALERT.show('info', 'No Data');
          Toast.fire({
            icon: "info",
            title: "No Data",
          });
        }
      },
      error: function (xhr, ajaxOptions, errorThown) {
        console.log(
          "Ajax error" + " - " + xhr.statusText + " - " + xhr.responseText
        );
      },
      complete: function () {},
    });
  }

  function defaultSkillsSection() {
    skillsBlock.html("<p>Add Skills</p>");
  }

  function viewSkillsSection(skills) {
    skillsBlock.html("");
    if (skills.length > 0) {
      $.each(skills, function (ci, skill) {
        skillsBlock.append(
          '<a href="javascript:void(0)">' + skill.name + "</a>"
        );
      });
    } else {
      defaultSkillsSection();
    }
  }

  function saveSkill(form) {
    var mparent = form.parents(".modal");
    var mfooter = mparent.find(".modal-footer");
    var button_txt = form.find("button[type=submit]").html();
    $.ajax({
      url: base_url + "freelancer/profile/skills/edit",
      type: "post",
      data: form.serialize(),
      dataType: "json",
      beforeSend: function () {
        form
          .find("button[type=submit]")
          .html(loading_txt)
          .attr("disabled", true);
      },
      success: function (res) {
        if (res.success) {
          $("#modal-skill").modal("hide"); //Hide modal
          //$.ALERT.show('success', res.message); // Show alert message
          Toast.fire({
            icon: "success",
            title: res.message,
          });
          loadSkills(); // Load view
        } else if (res.error) {
          //$.ALERT.show('danger', res.message);
          Toast.fire({
            icon: "error",
            title: res.message,
          });
        } else {
          //$.ALERT.show('danger', 'No Data');
          Toast.fire({
            icon: "error",
            title: "No Data",
          });
        }
      },
      error: function (xhr, ajaxOptions, errorThown) {
        console.log(
          "Ajax error" + " - " + xhr.statusText + " - " + xhr.responseText
        );
      },
      complete: function () {
        form
          .find("button[type=submit]")
          .html(button_txt)
          .attr("disabled", false);
      },
    });
  }

  //Edit profilesummary
  $(document).on("click", "#edit-skills", function (e) {
    e.preventDefault();
    var btn = $(this);
    var button_txt = btn.html();

    //Reset Form
    resetSkillsForm();

    $.ajax({
      url: base_url + "freelancer/profile/skills",
      type: "post",
      dataType: "json",
      beforeSend: function () {
        btn.html(spinner_icon).attr("disabled", false);
      },
      success: function (res) {
        if (res.success) {
          var response = res.success;

          $("#modal-skill").modal({
            backdrop: "static",
            keyboard: false,
            show: true,
          });

          $("#skill-category").html("");
          $.each(res.success, function (s, skill) {
            $("#skill-category").append(
              '<div class="skill-category col-md-10" id="skill-category' +
                skill.skill_id +
                '">' +
                '<div class="bg d-flex align-items-center justify-content-between">' +
                '<div class="col-md-4">' +
                skill.name +
                "</div>" +
                '<div class="col-md-4">' +
                '<lable class="pl-4">Skill Level</lable>' +
                '<input type="hidden" name="skill_category[' +
                skill.skill_id +
                '][skill_id]" value="' +
                skill.skill_id +
                '" />' +
                '<input type="number" min="0" class="form-control" name="skill_category[' +
                skill.skill_id +
                '][skill_percentage]" value="' +
                skill.percentage +
                '" />' +
                "</div>" +
                '<div class="col-md-2"><i class="remove-skill fas fa-times-circle"></i></div>' +
                "</div>" +
                "</div>"
            );
          });

          $("#skill-category .remove-skill").click(function (e) {
            e.preventDefault();
            $(this).parents(".skill-category").remove();
          });
        } else if (res.error) {
          //$.ALERT.show('danger', res.message);
          Toast.fire({
            icon: "danger",
            title: res.message,
            timer: false,
          });
        } else {
          //$.ALERT.show('danger', 'No Data');
          Toast.fire({
            icon: "danger",
            title: "No Data",
            timer: false,
          });
        }
      },
      error: function (xhr, ajaxOptions, errorThown) {
        console.log(xhr.statusText + " - " + xhr.responseText);
      },
      complete: function () {
        btn.html(button_txt).attr("disabled", false);
      },
    });
  });

  //Load skills after page load
  setTimeout(function () {
    loadSkills();
  }, 2000);
});
