 
  <div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <form action="#" method="post" id="stdcsForm" enctype="multipart/form-data">

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Name</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>
            </div>        
        </div> 

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Email</label>
                    <input type="text" name="email" id="email" class="form-control" />
                </div>
            </div>        
        </div> 

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Password</label>
                    <input type="password" name="pass" id="pass" class="form-control" />
                </div>
            </div>        
        </div> 

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Confirm Password</label>
                    <input type="password" name="con_pass" id="con_pass" class="form-control" />
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
			url 			:"<?php echo site_url('backend/admin/save'); ?>", 
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
                success: function(r)  {
                    if (r.haserror == '0') {
                        _alert.removeClass("alert-danger");
                        _alert.addClass("alert-success").text(r.msg).show();
                    } else {
                        _alert.removeClass("alert-success");
                        _alert.addClass("alert-danger").text(r.msg).show();
                    }
                }
		});
		return false;
	});
});

</script>