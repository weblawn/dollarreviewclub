
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
    <form action="#" method="post" id="stdcsForm" enctype="multipart/form-data">

        <?php /* <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Product Title</label>
                    <input type="text" name="product_title" id="product_title" class="form-control" />
                </div>
            </div>        
        </div> */?>
        
        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Product image</label>
                    <input type="file" name="userfile" id="userfile" class="form-control" />
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
  <script type="text/javascript" src="<?php //echo assets_url('backend/scripts/ajaxfileupload.js'); ?>"></script>

<script>
$(function() {
	$(document).on("submit", "form#stdcsForm", function(e) {
	   //var title = $('#product_title').val();
       //var _this = $(this), _formData = _this.serializeArray();
       var data = new FormData($('#stdcsForm')[0]);
       var _alert = $(".stAlert");
            //_formData.push({name: "content", value: $("#file").val()});
            //console.log(_formData);
		e.preventDefault();
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('backend/dcs/save'); ?>", 
			fileElementId	:'userfile',
			dataType		: 'json',
			data			: data,
            contentType: false,
            cache: false,
            processData: false,
            mimeType: "multipart/form-data",
                beforeSend: function() {
                    _alert.addClass("alert-success").text("Please wait...").show();
                },
                error: function() {
                    _alert.addClass("alert-danger").text("Error in server scripting").show();
                },
                success: function(r) {
                    if (r.res) {
                        _alert.removeClass("alert-danger");
                        _alert.addClass("alert-success").text(r.msg).show();
                        _this[0].reset();
                        $(".stAlert").html("");

                        /*if (r.redirect) {
                            window.location.href = r.redirect;
                        }*/
                        
                    } else {
                        _alert.addClass("alert-danger").text(r.msg).show();
                    }
                }
		});
		return false;
	});
});
    $(function() {

        /*
         * Submit form
         */
        $(document).on("submit", "form#stdcsssForm", function(e) {
            e.preventDefault();

            
            var _this = $(this), _formData = _this.serializeArray();

            var _alert = $(".stAlert");

            _alert.attr("class", _alert.attr("class").replace(/(^|\s)alert-\S+/g, ""));

            // Get content editor text
            //_formData.push({name: "content", value: $("#editor").cleanHtml()});
            _formData.push({name: "content", value: $("#file").val()});

            $.ajax({
                type: "POST",
                dataType: "json",
                data: _formData,
                url: "<?php echo site_url('backend/dcs/save'); ?>",
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
                        $(".stAlert").html("");

                        if (r.redirect) {
                            window.location.href = r.redirect;
                        }
                        
                    } else {
                        _alert.addClass("alert-danger").text(r.msg).show();
                    }
                }
            });
        });

        window.prettyPrint && prettyPrint();
    });
</script>