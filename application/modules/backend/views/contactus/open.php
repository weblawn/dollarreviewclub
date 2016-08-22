
  
  
  <div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <form action="#" method="post" id="stContentForm">
<?php $data = $open[0]; $rply_msg = $rply[0]->message; //print_r($rply); ?>
        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $data->name; ?>" readonly="readonly" />
                    <input type="hidden" name="id" class="form-control" value="<?php echo $data->id; ?>" readonly="readonly" />
                    <input type="hidden" name="hash" class="form-control" value="<?php echo $hash; ?>" readonly="readonly" />
                </div>
            </div>        
        </div>

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $data->email; ?>" readonly="readonly" />
                </div>
            </div>        
        </div>

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Subject</label>
                    <input type="text" name="subject" class="form-control" value="<?php echo $data->subject; ?>" readonly="readonly" />
                </div>
            </div>        
        </div>

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Message</label>
                    <textarea name="message" rows="10" cols="80" style="width: 100%;" readonly="readonly"><?php echo $data->message; ?></textarea>
                </div>
            </div>        
        </div>

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Reply</label>
                    <textarea name="rply" rows="10" cols="80" style="width: 100%;"<?php if($rply_msg != ''){echo 'readonly="readonly"';} ?>><?php echo $rply_msg; ?></textarea>
                </div>
            </div>        
        </div>

        <div class="row-fluid" style="display: none;">
            <div class="span11">
                <div class="control-group">
                    <label class="control-label">After submit redirect</label>
                    <div class="controls">
                        <label class="radio"><div class="radio"><span><input type="radio" value="false" name="redirect"></span></div>All Pages</label>
                        <label class="radio"><div class="radio"><span><input type="radio" checked="" value="true" name="redirect"></span></div>Stay Here</label>
                    </div>
                </div>
            </div>
        </div>
<?php if($rply_msg == ''){ ?>
        <div class="row-fluid">
            <div class="span11">
                <br/><input type="submit" value="Reply" class="btn green" /><br/><br/>
            </div>
        </div>
<?php }else{
    ?>
        <div class="row-fluid">
            <div class="span11">
                <br/><a href="<?php echo site_url('backend/contactus'); ?>"><input type="button" value="Back" class="btn green" /></a><br/><br/>
            </div>
        </div>
<?php    
} ?>        
        
    </form>
    <div class="stAlert alert alert-danger" style="display: none;"></div>
</div>
<!-- END PAGE CONTAINER-->

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
            //_formData.push({name: "content", value: $("#editor").val()});
            //_formData.push({name: "content", value: $(".fr-code").val()});

            $.ajax({
                type: "POST",
                dataType: "json",
                data: _formData,
                url: "<?php echo site_url('backend/contactus/reply'); ?>",
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


window.prettyPrint && prettyPrint();
    });
</script>