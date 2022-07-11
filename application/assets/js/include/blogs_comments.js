

$(document).ready(function(){ 
    jQuery.validator.addMethod("noSpace", function(value, element) {   
       return value == '' || value.trim().length != 0;
    }, " Blank spaces at beginning is invalid");

 $('#button').on('click',function(){
    $("#commentFrom").validate({
        // Specify validation rules
        rules: {
             
             text:{
                required: true,
                noSpace : true,
               
            },
 
        },
        messages: {
            
             text: {
                required: "Enter something to submit",
                
            },

                
        },   
    });  
    }); 
    
    $('#button_reply').on('click',function(){
    $("#replyForm").validate({
        // Specify validation rules
        rules: {
             
             text:{
                required: true,
               noSpace : true,
            },
 
        },
        messages: {
            
             text: {
                required: "Enter something to submit",
                 
            },

                
        },   
    });  
    });  
    

    function addComment(){
                $('#loader').css('display', 'block');  
        var addData = new FormData(document.getElementById("commentFrom"));

        $.ajax({
            type : "POST",
            url  : $base_url+'blogs/saveComment',
            dataType : "JSON",
            data : addData,
            async: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $.FEED.showLoader();
            },
            success: function(data){
                        $('#loader').css('display', 'none');  
   document.getElementById("display-success").style.display="block";
          location.reload();
            },
            error: function(data) {
                //Your Error Message
                document.getElementById("display-error").style.display="block";
                console.log(data)
                alert('Internal Error2: Contact Administrator');
            },
            complete: function(){
                $.FEED.hideLoader();
            },
        });

        return false;
    }  
     function addReply(){
                $('#loader').css('display', 'block');  
        var addData = new FormData(document.getElementById("replyForm"));

        $.ajax({
            type : "POST",
            url  : $base_url+'blogs/saveComment',
            dataType : "JSON",
            data : addData,
            async: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $.FEED.showLoader();
            },
            success: function(data){
                        $('#loader').css('display', 'none');  
   document.getElementById("display-success").style.display="block";
          location.reload();
            },
            error: function(data) {
                //Your Error Message
                document.getElementById("display-error").style.display="block";
                console.log(data)
                alert('Internal Error2: Contact Administrator');
            },
            complete: function(){
                $.FEED.hideLoader();
            },
        });

        return false;
    } 

 $('#button').on('click',function(){
var user_id_comment =  $('[name="user_id_comment"]').val().trim();  
var tradeshow_id =  $('[name="tradeshow_id"]').val();  
/*alert(user_id_comment.length)*/
    if(user_id_comment.length == 0 ){
     $('#loginButton').trigger('click');

      }
 else
 {
    if($("#commentFrom").valid()){
            addComment();
        }
        }
        });
        
 $('#button_reply').on('click',function(){
var user_id_reply =  $('[name="user_id_reply"]').val().trim();  

    if(user_id_reply.length == 0 ){
     $('#loginButton').trigger('click');

      }
 else
 {
    if($("#replyForm").valid()){
            addReply();
        }
        }
        });
        

  
 
});
 