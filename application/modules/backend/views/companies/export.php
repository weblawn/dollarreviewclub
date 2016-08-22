<div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <form action="#" method="post" id="stContentForm">
<div class="row-fluid">        
            <div class="span6">
                <div class="input">
                    <label for="title">From Date</label>
                    <input type="date" name="from_date" class="span6 form-control"   />
                </div>
            </div>        
                
            <div class="span6">
                <div class="input">
                    <label for="title">To Date</label>
                    <input type="date" name="to_date" class="span6 form-control" value="<?php echo $user->email; ?>"  />
                </div>
            </div> 
        </div>
        
        <div class="row-fluid">
            <div class="span11">
                <br/><input type="submit" value="Export" class="btn green" /><br/><br/>
            </div>
        </div>
       

    <div class="row-fluid">
        
    </div>
    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>
    </form>
    <div class="stAlert alert alert-danger" style="display: none;"></div>
</div>
</div>
<!-- END PAGE CONTAINER-->



<div id="pleaseWait" class="modal hide fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static">
    <div class="modal-body">
        <h3><i class="fa fa-warning"></i> Please wait...</h3>
    </div>
</div>
<!-- MODAL -->

<div id="download" class="modal hide fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static">
    <div class="modal-body">
        <a class="btn green" id="downloadit"> <i class="icon-download"></i> download</a>
    </div>
</div>
<!-- MODAL -->

<link rel="stylesheet" href="<?php echo assets_url('backend/plugins/data-tables/DT_bootstrap.css') ?>" />
<script type="text/javascript" src="<?php echo assets_url('backend/plugins/data-tables/jquery.dataTables.js') ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('backend/plugins/data-tables/DT_bootstrap.js') ?>"></script>
<script type="text/javascript">
  $(document).on("click", "#downloadit", function() {
            
            $("#download").modal("hide");
        });
        
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
                url: "<?php echo site_url("backend/companies/create") ?>",
                beforeSend: function() {
                    //$("#pleaseWait").modal("show");
                    _alert.addClass("alert-success").text("Please wait...").show();
                },
                error: function() {
                    _alert.addClass("alert-danger").text("Error in server scripting").show();
                },
                success: function(r) {
                    $("#pleaseWait").modal("hide");
                    if (r.haserror == '0') {
                        _alert.removeClass("alert-danger");
                        _alert.addClass("alert-success").text(r.msg).hide();
                        $('#downloadit').attr('href',r.msg);
                    $("#pleaseWait").modal("hide");
                    $("#download").modal("show");

                        
                        
                    } else {
                        _alert.removeClass("alert-success");
                        _alert.addClass("alert-danger").text(r.msg).show();
                    }
                }
            });
        });
        
        
</script>
