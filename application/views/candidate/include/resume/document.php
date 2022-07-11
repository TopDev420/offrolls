
<style>
  .download-resume .attachment-block {
    align-items: center;
    display: flex;
  }

  .attachment-block .buttonz {
    position: relative;
    overflow: hidden;
    border-radius: 3px;
    text-align: center;
    color: #246df8;
    display: inline-block;
    font-size: 1.4rem;
    font-family: "Poppins", sans-serif;
    font-weight: 600;
    border: 0;
    padding: 15px 15px 15px 20px;
    margin-right: 10px;
    background: rgba(36, 109, 248, 0.15);
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
    cursor: pointer;
  }
</style>

<div class="attach-document details-section dashboard-section" id="nav-attach-document">
  <div class="d-block">
    <h4 class="mb-3"><i data-feather="paperclip"></i>Attach Document</h4>
  </div>
  
  <div class="download-resume row" id="download-resume">
    <div class="col-md-6 attachment-block">
      <div class="resume-blockw-100" data-timeline-loader="true">
      
      </div>
    </div>
    <div class="col-md-6 attachment-block2 d-none">
      <div class="update-file">
        <input type="file">Upload CL <i data-feather="edit-2"></i>
      </div>
      <!-- <button class="buttonz"><i data-feather="download"></i></button> -->
    </div>
  </div>
</div>

<script>
  $(function(){
    var attachmentBlock = $('#download-resume .attachment-block');
    function loadDocumentView(res){
        var upload_text = 'Upload CV';
        if(res.resume_name != '' && res.resume_name != 'undefined'){
            upload_text = 'Change CV';
        }
        
        attachmentBlock.html('<div class="w-100 resume-block"><p class="d-inline-block w-100">'+ res.resume_name+'</p>' +
                    '<div style="display:flex;align-items:center;">' + 
                    '<form id="formUploadResume" method="post" action="#" enctype="multipart/form-data">'+
                        '<div class="update-file">'+
                          '<input type="file" name="upload_resume">'+ upload_text +' <i data-feather="edit-2"></i>'+
                          '<input type="hidden" name="resume_name" value="'+res.resume_name+'">'+
                        '</div>'+
                    '</form>'+
                    '<a href="javascript:void(0)" id="btn-download-resume" class="buttonz btn-download-resume"><i data-feather="download"></i></a>' +
                    '</div>' +
        '</div>');
        
        feather.replace();
    }
    
    function loadResume(){
        $.ajax({
            url: "<?php echo base_url() . 'candidate/profile/resume' ; ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function(){
                // attachmentBlock.find('.resume-block').attr('data-timeline-loader', 'true');
                // $.TIMELINE.loader();
                // $.FEED.showLoader();
            },
            success: function(res){
              if(res.success){
                  loadDocumentView(res);
              } else if(res.error) {
                $.ALERT.show('danger', res.message);
              } else {
                $.ALERT.show('danger', 'No Data');
              }
            },
            error: function(){
    
            },
            complete: function(){
                // $.FEED.hideLoader();
            }
        });    
    }
    
    $(document).on('change', 'input[name=upload_resume]', function(){
      $('#formUploadResume').submit();
    });   

    $(document).on('submit', '#formUploadResume', function(e){
      e.preventDefault();
      var $this = $(this);
      $.ajax({
        url: "<?php echo base_url() . 'candidate/profile/resume/upload' ; ?>",
        type: "POST",
        data: new FormData($('#formUploadResume')[0]),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        xhr: function(){
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress',function(e){
                if(e.lengthComputable){
                    var percent = Math.round((e.loaded / e.total) * 100)+'%';
                    $.FEED.setLoaderStatus('uploading ' +percent);
                }
            });
            return xhr;
        },
        beforeSend: function(){
            $.FEED.setLoaderStatus('');
            $.FEED.showLoader();
        },
        success: function(res){
          if(res.success){
            loadDocumentView(res);
            $.ALERT.show('success', res.message);
          } else if(res.error) {
            $.ALERT.show('danger', res.message);
          } else {
            $.ALERT.show('danger', 'No Data');
          }
        },
        error: function(){

        },
        complete: function(){
            $.FEED.setLoaderStatus('');
            $.FEED.hideLoader();
        }
      });
    });
    
    $(document).on('click', '#btn-download-resume', function(e){
        e.preventDefault();
        var $this = $(this);
        
        window.open("<?php echo base_url() . 'candidate/profile/resume/download'; ?>", "_blank");
    });
    
    loadResume();

  });
</script>