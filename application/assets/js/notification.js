$(function () {
  var header_notification = $("#header-notification");
  var notification_header = header_notification.find(".notification-bell");
  var notification_body = header_notification.find(
    ".ps-block--notifications .ps-block__content"
  );

  /*if(!("Notification" in window)){
        console.log("This browser does not support desktop notification");
    } else if(Notification.permission == 'granted'){
        var notification = new Notification('Permission Granted');
    } else if(Notification.permission == 'denied' || Notification.permission == 'default'){
        Notification.requestPermission(function(permission){
            if(permission == 'granted'){
                var notification = new Notification('Permission Granted');
            }
        });
    }*/

  // Long Polling
  (function poll() {
    $.ajax({
      url: $base_url + "notification/alert",
      type: "post",
      dataType: "json",
      success: function (res) {
        if (res.success) {
          if (res.data.total > 0) {
            notification_header.find(".notification-badge").remove();
            notification_header.append(
              '<span class="notification-badge"><i>' +
                res.data.total +
                "</i></span>"
            );
          }

          if (res.chat.length > 0 && $.isArray(res.chat)) {
            $.each(res.chat, function (ckey, chat) {
              let chat_url = (list_url = action_url = upload_url = "");
              if (chat.receiver == "cmp") {
                chat_url =
                  $base_url +
                  "company/activity/freelancer_chat/start/" +
                  chat.job_id;
                list_url =
                  $base_url +
                  "company/activity/freelancer_chat/listMessages/" +
                  chat.job_id;
                action_url =
                  $base_url +
                  "company/activity/freelancer_chat/addMessage/" +
                  chat.job_id;
                upload_url =
                  $base_url +
                  "company/activity/freelancer_chat/uploadMessage/" +
                  chat.job_id;

                loadChatbox(chat_url, {
                  name: chat.name,
                  thumb: chat.thumb,
                  shortCode: "rtc-" + chat.receiver + chat.job_id,
                  list: list_url,
                  action: action_url,
                  upload: upload_url,
                });
              } else if (chat.receiver == "fr") {
                chat_url = $base_url + "freelancer/chat/start/" + chat.job_id;
                list_url =
                  $base_url + "freelancer/chat/listMessages/" + chat.job_id;
                action_url =
                  $base_url + "freelancer/chat/addMessage/" + chat.job_id;
                upload_url =
                  $base_url + "freelancer/chat/uploadMessage/" + chat.job_id;

                loadChatbox(chat_url, {
                  name: chat.name,
                  thumb: chat.thumb,
                  shortCode: "rtc-" + chat.receiver + chat.job_id,
                  list: list_url,
                  action: action_url,
                  upload: upload_url,
                });
              }
            });
          }
        }
      },
      complete: function () {
        setTimeout(function () {
          poll();
        }, 30000);
      },
    });
  })();

  notification_header.click(function (e) {
    e.preventDefault();
    header_notification
      .find(".header__dropdown")
      .css({ visibility: "visible", opacity: "1" });
    $.ajax({
      url: $base_url + "notification/get_informations",
      type: "post",
      dataType: "json",
      beforeSend: function () {
        notification_body
          .find(".ps-block--notification")
          .attr("data-timeline-loader", "true");
        // Load Timeline Loader
        //$.TIMELINE.loader();
      },
      success: function (res) {
        if (res.success) {
          if (res.success) {
            notification_header.find(".notification-badge").remove();
            notification_body.html("");
            if (res.data && res.data.length > 0) {
              $.each(res.data, function (key, notification) {
                // console.log(res.user_name);
                notification_body.append(
                  '<div class="ps-block--notification">' +
                    // '<div class="ps-block__thumbnail"><img src="img/users/2.jpg" alt=""></div>' +
                    '<div class="ps-block__content"><a href="#">'+ res.user_name +'</a>' +
                    "<p>" +
                    notification.message +
                    "</p><small>" +
                    notification.timespan +
                    '</small>'+
                    // '<a class="ps-btn ps-btn--close" href="#"></a>' +
                    " </div>" +
                    " </div>"
                );
              });
            } else {
              notification_body.append(
                '<div class="notification-list">' +
                  '<i class="fas fa-envelope"></i>' +
                  "<p>No Message!</p>" +
                  "</div>"
              );
            }
          }
        }
      },
      complete: function () {
        notification_body
          .find(".ps-block--notification")
          .attr("data-timeline-loader", "false");
      },
    });
  });

  header_notification.focusout(function () {
    header_notification
      .find(".header__dropdown")
      .css({ visibility: "hidden", opacity: "0" });
  });

  //   header_notification.focusin(function () {
  //     header_notification.css({ visibility: "visible", opacity: "1" });
  //   });
});
