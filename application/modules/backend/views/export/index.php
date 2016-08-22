<div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->

    <div class="row-fluid">
        <div class="span12">
            <a class="btn green" onclick="create_excel()"> <i class="icon-edit"></i> Export</a><br/><br/>
        </div>
    </div>

    <div class="row-fluid">
        
    </div>
    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>
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
         * create excel
         */
        function create_excel() {
            
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo site_url("backend/export/create") ?>",
                beforeSend: function() {
                    $("#pleaseWait").modal("show");
                },
                success: function(r) {
                    $('#downloadit').attr('href',r.msg);
                    $("#pleaseWait").modal("hide");
                    $("#download").modal("show");
                }
            });

        }
</script>
