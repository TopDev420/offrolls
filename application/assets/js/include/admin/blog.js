function resetForm(formId) {
  $("#" + formId).trigger("reset");
  var validator = $("#" + formId).validate();
  validator.resetForm();
  $("div").removeClass("is-filled");
}
$(function () {
  function disableButton(btnID, msg) {
    $("#" + btnID).attr("disabled", "disabled");
    $("#" + btnID).html('<i class="fa fa-circle-o-notch fa-spin"></i> ' + msg);
  }
  function enableButton(btnID, msg) {
    $("#" + btnID).removeAttr("disabled");
    $("#" + btnID).html(msg);
  }

  $("#addForm").validate({
    ignore: ".note-editor *",
    onkeyup: function (element) {
      $(element).valid();
    },
    onkeydown: function (element) {
      $(element).valid();
    },
    onpaste: function (element) {
      $(element).valid();
    },
    oncontextmenu: function (element) {
      $(element).valid();
    },
    oninput: function (element) {
      $(element).valid();
    },
    rules: {
      topic_name: {
        required: true,
      },
      // category_select: {
      //   required: true,
      // }
      //   descr: {
      //     required: true,
      //     minlength: 10,
      //   },
    },
    messages: {
      topic_name: {
        required: "Topic name cannot be empty",
      },
      // category_select: {
      //   required: "category cannot be empty",
      // },
      //   descr: {
      //     required: "Description cannot be empty",
      //     minlength: "enter atleast 10 characters",
      //   },
    },
    errorElement: "em",
    errorPlacement: function (error, element) {
      // Add the `invalid-feedback` class to the error element
      error.addClass("invalid-feedback");

      if (element.prop("type") === "checkbox") {
        error.insertAfter(element.next("label"));
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).addClass("is-valid").removeClass("is-invalid");
    },
  });

  $("#addForm").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    if ($("#addForm").valid()) {
      var file_array = new FormData(form[0]);
      //file_array.append("topic_img", $('#topic_img').val[0]);
      var url = $base_url + "admin/blog/add_blog";
      $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        enctype: "multipart/form-data",
        data: file_array,
        async: false,
        processData: false,
        cache: false,
        contentType: false,
        beforeSend: function() {
          $.FEED.showLoader();
      },
        success: function (res) {
          if (res.success) {
            Toast.fire({
              icon: "success",
              title: res.message,
            });
            location.href = $base_url + "admin/blog";
          } else if (res.error) {
            // $.ALERT.show('danger', res.message);
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
        error: function (xhr, ajaxOptions, errorThrown) {
          console.log(xhr.responseText + " " + xhr.statusText);
          enableButton("submitBtn", "Add");
        },
        complete: function () {
          $.FEED.hideLoader();
        },
      });
    }
  });
});
