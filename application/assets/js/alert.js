$(function () {
  var jyAlertWrap = $('#jy-alert-wrap');
  var jyAlert = jyAlertWrap.find('.jy-alert');
  var jyAlertClose = $('#jy-alert-wrap .jy-alert .close_ a');

  $('[data-commission-agreement]').click(function (e) {
    e.preventDefault();
    $('#commission-agreement-modal').modal({
      backdrop: 'static',
      show: true,
      keyboard: false
    });
  });

  $('#btn-commission-agree').click(function (e) {
    e.preventDefault();
    const btnObj = $(this);
    var button_txt = btnObj.html();
    $.executeCall({
      url: formUrl('company/pricing/agreeCommissionPolicy'),
    }).then(function (res) {
      if (res.success) {
        Toast.fire({
          icon: 'success',
          title: res.message
        }).then(function () {
          btnObj.parents('.commission-alertbox').fadeOut().remove();
        });
      } else if (res.error) {
        Toast.fire({
          icon: 'error',
          title: res.message
        });
      } else {
        Toast.fire({
          icon: 'error',
          title: 'Something went wrong!'
        });
      }
    }).catch(function (xhr, statusText, errorThrown) {
      Toast.fire({
        icon: 'error',
        title: xhr.statusText
      });
    });
  });


  $('[data-payment-detail]').click(function (e) {
    e.preventDefault();
    $('#payment-info-agreement-modal').modal({
      backdrop: 'static',
      show: true,
      keyboard: false
    });
  });



  var banck_details = $("#bank_acc_details").validate({
    // Specify validation rules
    rules: {
      account_number: {
        required: true,
      },
      ifsc_code: {
        required: true,
      },
      bank_name: {
        required: true,
      },
      branch_name: {
        required: true,
      },
      // upi_id: {
      //   required: true,
      // },
    },
    messages: {
      account_number: {
        required: "Please enter account number",
      },
      ifsc_code: {
        required: "Please enter IFSC Code",
      },
      bank_name: {
        required: "Please enter Bank Name",
      },
      branch_name: {
        required: "Please enter Branch Name",
      },
      // upi_id: {
      //   required: "Please enter UPI ID",
      // },
    },
    errorElement: "em",
    errorPlacement: function (error, element) {
      // Add the `invalid-feedback` class to the error element
      error.addClass("invalid-feedback");
      element.parents('.ele--jqvalid').append(error);
    },
  });

  $('#bank_acc_details').submit(function (e) {
    e.preventDefault();
    const formObj = $(this);
    var btnObj = formObj.find('[type="submit"]');
    var button_txt = btnObj.html();
    var formData = new FormData(formObj[0]);
    if ($("#bank_acc_details").valid()) {
      $.executeCall({
        url: formUrl('freelancer/pricing/savePaymentInfo'),
        formParams: {
          account_number: formData.get('account_number'),
          ifsc_code: formData.get('ifsc_code'),
          bank_name: formData.get('bank_name'),
          branch_name: formData.get('branch_name'),
          // upi_id: formData.get('upi_id'),
        }
      }).then(function (res) {
        if (res.success) {
          Toast.fire({
            icon: 'success',
            title: res.message
          }).then(function () {
            $('.alert.payment-info-alertbox').alert('close');
            $('#payment-info-agreement-modal').modal('hide');
          });
        } else if (res.error) {
          Toast.fire({
            icon: 'error',
            title: res.message
        });
        } else {
          Toast.fire({
            icon: 'error',
            title: 'Something went wrong!'
        });
        }
      }).catch(function (xhr, statusText, errorThrown) {
        Toast.fire({
          icon: 'error',
          title: xhr.statusText
      });
      });
    }
  });


  $.extend({
    ALERT: {
      show: function (status, message, redirect = false) {
        var sclass = sicon = '';
        switch (status) {
          case 'success':
            sclass = 'success-alert';
            sicon = '<i class="fas fa-check-circle"></i>';
            break;
          case 'warning':
            sclass = 'warning-alert';
            sicon = '<i class="fas fa-exclamation-circle"></i>';
          case 'danger':
            sclass = 'danger-alert';
            sicon = '<i class="fas fa-exclamation-circle"></i>';
            break;
          default:
            sclass = 'info-alert';
            sicon = '<i class="fas fa-info-circle"></i>';
        }

        var options = { icon: sicon, className: sclass, message: message };
        if (redirect === true) {
          options.close = false;
          options.redirect = true;
        }
        this.layout(options);
      },
      confirm: function (options) {
        options.close = false;
        this.layout(options);
      },
      layout: function (optionz) {
        var defaults = {
          icon: '',
          className: '',
          message: 'jQuery Alert',
          close: true,
          redirect: false,
          buttons: [],
          confirm: [],

        }

        var jy_buttons = '';
        var options = $.extend({}, defaults, optionz);

        if (options.buttons.length > 0) {
          jy_buttons = '<div class="buttons-container">';

          $.each(options.buttons, function (bkey, bval) {
            jy_buttons += '<button type="button" class="button" id="jy-btn-' + bval.toLowerCase() + '">' + bval + '</button>';
          });

          jy_buttons += '</div>';
        }

        var redirectMsg = '';
        if (options.redirect === true) {
          redirectMsg = '<p class="text-center">Redirecting...</p>';
        }
        var alert_html = '<div class="jy-alert-box"><div class="jy-alert ' + options.className + ' fade-scale">' +
          '<div class="jy-alert-inner">' +
          '<div class="icon">' + options.icon + '</div>' +
          '<h6 class="msg_">' + options.message + '</h6>' +
          redirectMsg +
          //   '<div class="close_">' +
          //     '<a href="#" class="button"><i class="fas fa-times"></i></a>' +
          //   '</div>' +
          jy_buttons +
          '</div>' +
          '</div>' +
          '</div>';

        jyAlertWrap.html(alert_html).fadeIn();

        setTimeout(function () {
          jyAlertWrap.find('.jy-alert').addClass('show');
        }, 200);

        if (options.close === true) {
          setTimeout(function () {
            $.ALERT.hide();
          }, 5000);
        }


        jyAlertClose.click(function (e) {
          e.preventDefault();
          $.ALERT.hide();
        });

        if (options.buttons.length > 0) {
          $.each(options.buttons, function (bkey, bval) {
            $('#jy-btn-' + bval.toLowerCase()).click(function (e) {
              e.preventDefault();
              $.ALERT.hide();
              if ($.isEmptyObject(options.confirm) === false) {
                var callName = bval.toLowerCase();
                if (callName) {
                  let fnName = callName + '_callback';
                  options.confirm[fnName]();
                } else {
                  options.confirm.cancel_callback();
                }
              }

            });
          });
        }
      },

      hide: function () {
        jyAlertWrap.find('.jy-alert').removeClass('show');
        setTimeout(function () {
          jyAlertWrap.fadeOut().html('');
        }, 500);
      }
    }
  });

});
