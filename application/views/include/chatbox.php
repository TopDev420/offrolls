<style>
    #chatbox {
        -webkit-box-align: end;
        -ms-flex-align: end;
        align-items: flex-end;
        bottom: 0;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        -ms-flex-direction: row;
        flex-direction: row;
        height: 100%;
        /*pointer-events: none;*/
        position: fixed;
        right: 0;
        z-index: 66666;
    }

    #chatbox .chat-block {
        width: 320px;
        height: 460px;
    }

    #chatbox .message-box.card {
        position: relative;
        border: 1px solid rgba(111, 116, 132, 0.4);
    }

    #chatbox .message-box .message-box-header h5 {
        padding: 0.4rem 0;
    }

    #chatbox .message-box .message-box-header button svg {
        width: 14px;
        height: 14px;
    }

    #chatbox .message-box .dashboard-conversation {
        height: 75%;
        width: 100%;
        overflow-y: scroll;
    }

    #chatbox .message-box .conversation-write form textarea {
        padding: .375rem .75rem !important;
        border: 1px solid rgba(111, 116, 132, 0.4);
        font-size: 1.4rem;
        resize: none;
        height: 40px;
    }

    #chatbox .message-box .conversation-write .attachment input[type=file]{
        position: absolute;
        top: 0;
        left: 0;
        width: 40px;
        margin: 0;
        padding: 0;
        cursor: pointer;
        font-size: 20px;
        opacity: 0;
        filter: alpha(opacity=0);
        height: 100%;
        overflow: hidden;
        display: none;
    }

    #chatbox .message-box-header .avater {
        display: flex;
        align-items: center;
    }

    #chatbox .message-box-header .avater img {
        width: 40px;
        height: 40px;
        background-color: rgba(0,0,0,0.25);
        border-radius: 50%;
    }

    .conversation .message {
        width: 85%;
        padding: 0.4rem 0;
    }
    .conversation .message .sent-time {
        display: block;
        margin-top: 0.4rem;
        font-size: 1.1rem;
    }


    #chatbox .conversation-write form.chatForm,
    #chatbox .conversation-write form.chatAttachForm {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    #chatbox .conversation-write form.chatForm {
        width: 80%;
    }

    #chatbox .conversation-write form.chatAttachForm {
        width: 20%
    }
</style>

<section id="chatbox"></section>

<script>
//Company chatbox js
$(function(){
    const chatBox= $('#chatbox');

    //View Messages
    function viewMessages(elementId, messages=[], error='') {
        let chatConversationId = $(elementId).find('.dashboard-conversation');
        chatConversationId.html('');
        if(messages.length > 0 && Array.isArray(messages)) {
            $.each(messages, function(mkey, message){
                chatConversationId.append('<li class="conversation '+ message.sender +'">' +
                    '<div class="message">' +
                        '<span class="message-text d-block">'+ message.message +'</span>' +
                        '<span class="sent-time d-block">'+ message.date_added +'</span>' +
                    '</div>' +

                  '</li>');
            });

            chatConversationId.animate({ scrollTop: $(document).height() }, 'fast');
        } else {
            chatConversationId.html('<li class="conversation">'+ error +'</li>');
        }

    }

    //Load Messages by AJAX
    function loadMessages(url, ccId) {
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            beforeSend: function(){
            },
            success: function(res) {
                if(res.success) {
                    viewMessages(ccId, res.messages);
                } else if(res.error) {
                    viewMessages(ccId, [], res.message);
                } else {
                    viewMessages(ccId, [], 'No Data');
                }
            },
            error: function(xhr, ajaxOptions, errorThrown) {
                viewMessages(ccId, [], xhr.statusText);
            },
            complete: function() {
            }
        });
    }

    //Load Messages by AJAX
    function addMessage(url, ccId) {
        let dataForm = $(ccId).find('.chatForm');
        $.ajax({
            url: url,
            type: 'post',
            data: dataForm.serialize(),
            dataType: 'json',
            beforeSend: function(){
                dataForm.find('.btn-send-message').attr('disabled', true).html('<i data-feather="loader"></i>');
                feather.replace();
            },
            success: function(res) {
                if(res.success) {
                    dataForm[0].reset();
                    let cl_url = $(ccId).attr('data-chat-list');
                    loadMessages(cl_url, ccId);
                } else if(res.error) {
                    $.ALERT.show('danger', res.message);

                } else {
                    $.ALERT.show('danger', 'No Data');
                }
            },
            error: function(xhr, ajaxOptions, errorThrown) {
                console.log(xhr.statusText);
            },
            complete: function() {
                dataForm.find('.btn-send-message').attr('disabled', false).html('<i data-feather="send"></i>');
                feather.replace();
            }
        });
    }

    //Load Chatbox
    window.loadChatbox = function(url, rtc) {
        let defaults = {
            name : '',
            thumb: '',
            shortCode: 'rtc',
            list: '',
            action: '',
            upload: ''
        };
        let options = Object.assign(defaults, rtc);
        let chatblock = chatBox.find('#chatbox-block'+ options.shortCode);
        if(chatblock.length < 1) {
            chatBox.prepend('<div data-chat-list="'+ options.list+'" id="chatbox-block'+ options.shortCode +'" class="chat-block d-inline-flex text-right py-2">' +
                '<div class="message-box card card-body ml-2 p-0 card-shadow">' +
                    '<div class="message-box-header p-3">' +
                      '<div class="avater">' +
                        '<img src="'+ options.thumb +'" class="img-fluid" alt="">' +
                        '<h5 class="px-4">'+ options.name+'</h5>' +
                      '</div>' +
                      '<button class="btn text-danger close-chatbox" data-close="#chatbox-block'+ options.shortCode +'"><i data-feather="x"></i></button>' +
                    '</div>' +
                    '<ul class="dashboard-conversation p-3">' +
                    '</ul>' +
                    '<div class="conversation-write p-3">' +
                        '<form action="'+ options.upload +'" class="chatAttachForm" data-chatbox-id="#chatbox-block'+ options.shortCode +'">' +
                            '<label class="attachment cursor-pointer">' +
                              '<input type="file"><i data-feather="paperclip"></i>' +
                            '</label>' +
                      '</form>' +
                      '<form action="'+ options.action +'" class="chatForm" data-chatbox-id="#chatbox-block'+ options.shortCode +'">' +
                            '<div class="input-group">' +
                                '<textarea class="form-control" name="message" placeholder="Type a message"></textarea>' +
                                '<span class="input-group-append"><button class="btn-send-message button-default small-sm primary-bg white-text"><i data-feather="send"></i></button></span>' +
                            '</div>' +
                      '</form>' +
                    '</div>' +
                '</div>' +
            '</div>');

            //Load Conversation Messages view
            loadMessages(url, '#chatbox-block'+ options.shortCode);


            $('.close-chatbox').click(function(e) {
                e.preventDefault();
                let boxId = $(this).attr('data-close');
                chatBox.find(boxId).fadeOut(800).remove();
            });

            $('.btn-send-message').click(function(e) {
                e.preventDefault();
                var chatForm = $(this).parents('form.chatForm');
                addMessage(chatForm.attr('action'), chatForm.attr('data-chatbox-id'));
            });

            feather.replace();
        } else {
            //Load Conversation Messages view
            loadMessages(url, '#chatbox-block'+ options.shortCode);
        }

        $('.chat-block .dashboard-conversation').scroll(function(e) {
            e.preventDefault;
            var cst = $(this).scrollTop();

            if(cst == 0) {
                console.log(cst);
            }
        });
    }


});
</script>
