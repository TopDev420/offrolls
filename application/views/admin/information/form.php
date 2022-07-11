<!-- Menubar Top Start -->
<?php include APPPATH.'views/admin/include/menubar_top.php'; ?>
<!-- Menubar Top End -->


<div class="container-fluid">
    <div class="row alice-bg">
      <div class="col-12 no-gliters p-0">
        <div class="dashboard-container">
          <!-- Dashboard Menubar-->
          <?php include APPPATH.'views/admin/include/menubar.php'; ?>

          <!-- Dashboard Content-->
          <div class="dashboard-content-wrapper">
            <!-- Breadcrumb -->
            <?php include APPPATH.'views/admin/include/breadcrumb.php'; ?>

            <div class="dashboard-form mb-5">
              <form method="post" id="informationForm" class="access-form">
                    <div class="jy-card card card-shadow">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs border-0">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#tab-general">General</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-seo">Seo</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade in active show" id="tab-general">
                                <div class="card-body p-5">
                                    <div class="form-group">
                                        <label class="control-label">Title</label>
                                        <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea name="description" id="description--editor" class="form-control"><?php echo $description; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <?php $statuses = [0 => 'No', 1 => 'Yes']; ?>
                                        <select class="selectpicker" name="status">
                                            <?php foreach($statuses as $skey => $sname) { ?>
                                                <option value="<?php echo $skey; ?>" <?php echo ($skey == $status) ? 'selected' : ''; ?> ><?php echo $sname; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab-seo">
                                <div class="card-body p-5">
                                    <div class="form-group">
                                        <label class="control-label">Meta Title</label>
                                        <input type="text" name="meta_title" value="<?php echo $meta_title; ?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Meta Description</label>
                                        <textarea name="meta_description" class="form-control"><?php echo $meta_description; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Meta Keyword</label>
                                        <input type="text" name="meta_keyword" value="<?php echo $meta_keyword; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
          </div>

        </div>
      </div>
    </div>
</div>

<script>
    $(function() {
        var informationForm = $('#informationForm');
        var action = '<?php echo $action; ?>';
        initSummerNote(['#description--editor']);   //Initialize summernote

        function save_information(form, $cur, href) {
            let btn_txt = $cur.html();
            $.ajax({
                url: href,
                type: 'post',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function(){
                    $cur.attr('disabled', true).html($updating_txt);
                    $.FEED.setLoaderStatus($updating_txt);
                    $.FEED.showLoader();
                },
                success: function(res){
                    if(res.success){
                        $.ALERT.show('success', res.message);
                        if(res.redirect) {
                            setTimeout(function(){
                                window.location.href=res.redirect;
                            }, 1500);
                        }
                    } else if(res.error){
                        $.ALERT.show('danger', res.message);
                    } else {
                        $.ALERT.show('danger', 'No Data');
                    }
                },
                error: function(xhr){
                    console.log(xhr.responseText + ' ' + xhr.statusText);
                },
                complete: function(){
                    $cur.attr('disabled', false).html(btn_txt);
                    $.FEED.setLoaderStatus('');
                    $.FEED.hideLoader();
                }
            });
        }

        // Profile Form Validation
        var jyInformationForm = informationForm.validate({
          rules: {
            title: {
              required: true
            }
          },
          messages: {
            title: {
                required: "Please enter title"
            }
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
          }
        });


        $('#btn-save-information').click(function(e){
            e.preventDefault();
            $cur = $(this);
            if(jyInformationForm.valid()){
                save_information(informationForm, $cur, action);
            }
        });

    });
</script>
