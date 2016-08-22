
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/froala_editor.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/froala_style.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/code_view.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/colors.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/emoticons.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/image_manager.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/image.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/line_breaker.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/table.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/char_counter.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/video.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/fullscreen.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/file.css'); ?>">
  <link rel="stylesheet" href="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/css/plugins/codemirror.min.css'); ?>">
  
  <div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <form action="#" method="post" id="stContentForm">

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Page Title</label>
                    <input type="text" name="title" class="form-control" />
                </div>
            </div>        
        </div>

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Page Slug</label>
                    <input type="text" name="slug" class="form-control" />
                </div>
            </div>        
        </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="hero-unit" style="background: #f7f7f7; padding: 15px; ">
                    <div id="alerts"></div>
                    
                    <div id="editor"></div>
                </div>
            </div>

            <!-- END DASHBOARD STATS -->
            <div class="clearfix"></div>
        </div>

        <div class="row-fluid">
            <div class="span11">
                <div class="input">
                    <label for="title">Meta Keywords</label>
                    <input type="text" name="keywords" value="" class="form-control" />
                </div>
            </div>        
        </div>

        <div class="row-fluid">
            <div class="span11">
                <div class="input">
                    <label for="title">Meta Description</label>
                    <textarea name="metadesc" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span11">
                <div class="control-group">
                    <label class="control-label">After submit redirect</label>
                    <div class="controls">
                        <label class="radio"><div class="radio"><span><input type="radio" checked="" value="true" name="redirect"></span></div>All Pages</label>
                        <label class="radio"><div class="radio"><span><input type="radio" value="false" name="redirect"></span></div>Stay Here</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span11">
                <br/><input type="submit" value="Publish" class="btn green" /><br/><br/>
            </div>
        </div>
    </form>
    <div class="stAlert alert alert-danger" style="display: none;"></div>
</div>
<!-- END PAGE CONTAINER-->
   
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/froala_editor.min.js'); ?>" ></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/align.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/code_beautifier.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/code_view.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/colors.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/codemirror.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/xml.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/emoticons.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/font_size.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/font_family.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/image.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/file.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/image_manager.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/line_breaker.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/link.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/lists.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/paragraph_format.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/paragraph_style.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/video.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/table.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/url.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/entities.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/char_counter.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/inline_style.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/save.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo assets_url('backend/plugins/bootstrap-wysiwyg-new/js/plugins/fullscreen.min.js'); ?>"></script>

  <script>
    $(function(){
      $('#editor').froalaEditor({
        enter: $.FroalaEditor.ENTER_DIV
      })
    });
  
    $(document).ready(function(){
    $("#editor div:last").remove();
});
  </script>
<script>
    $(function() {

        /*
         * Submit form
         */
        $(document).on("submit", "form#stContentForm", function(e) {
            e.preventDefault();

            
            var _this = $(this), _formData = _this.serializeArray();

            var _alert = $(".stAlert");

            _alert.attr("class", _alert.attr("class").replace(/(^|\s)alert-\S+/g, ""));

            // Get content editor text
            //_formData.push({name: "content", value: $("#editor").cleanHtml()});
            _formData.push({name: "content", value: $(".fr-code").val()});

            $.ajax({
                type: "POST",
                dataType: "json",
                data: _formData,
                url: "<?php echo site_url('backend/content/save'); ?>",
                beforeSend: function() {
                    _alert.addClass("alert-success").text("Please wait...").show();
                },
                error: function() {
                    _alert.addClass("alert-danger").text("Error in server scripting").show();
                },
                success: function(r) {
                    if (r.res) {
                        _alert.addClass("alert-success").text(r.msg).show();
                        _this[0].reset();
                        //$("#editor").html("");

                        if (r.redirect) {
                            window.location.href = r.redirect;
                        }
                        
                    } else {
                        _alert.addClass("alert-danger").text(r.msg).show();
                    }
                }
            });
        });

        $(document).on("blur", "input[name='title']", function() {
            var title = $(this).val(), _slug = $("input[name='slug']");

            $.ajax({
                type: "POST",
                dataType: "json",
                data: "title=" + title,
                url: "<?php echo site_url('backend/content/slug') ?>",
                beforeSend: function() {
                    _slug.val("Please wait...").prop("disabled", true);
                },
                success: function(r) {
                    _slug.val(r.slug).prop("disabled", false);
                }
            });
        });

        /*function initToolbarBootstrapBindings() {
            var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                'Times New Roman', 'Verdana'],
                    fontTarget = $('[title=Font]').siblings('.dropdown-menu');
            $.each(fonts, function(idx, fontName) {
                fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
            });
            $('a[title]').tooltip({container: 'body'});
            $('.dropdown-menu input').click(function() {
                return false;
            })
                    .change(function() {
                        $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                    })
                    .keydown('esc', function() {
                        this.value = '';
                        $(this).change();
                    });

            $('[data-role=magic-overlay]').each(function() {
                var overlay = $(this), target = $(overlay.data('target'));
                overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
            });
            if ("onwebkitspeechchange"  in document.createElement("input")) {
                var editorOffset = $('#editor').offset();
                $('#voiceBtn').css('position', 'absolute').offset({top: editorOffset.top, left: editorOffset.left + $('#editor').innerWidth() - 35});
            } else {
                $('#voiceBtn').hide();
            }
        }
        ;*/

        function showErrorAlert(reason, detail) {
            var msg = '';
            if (reason === 'unsupported-file-type') {
                msg = "Unsupported format " + detail;
            }
            else {
                console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }
        ;
        //initToolbarBootstrapBindings();
        //$('#editor').wysiwyg({fileUploadError: showErrorAlert});
        window.prettyPrint && prettyPrint();
    });
</script>