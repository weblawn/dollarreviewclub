<div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row-fluid">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
                <tr>
                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                    <th class="hidden-480">Name</th>
                    <th class="hidden-480">Email</th>
                    <th class="hidden-480">Registered</th>
                    <th class="hidden-480">Status</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($shopper)) {
                    $tr = '';
                    $i = 0;
                    foreach ($shopper as $user) {

                        if ($user->isDel == 1) {
                            $alertLabel = "You want enable {$user->fname} shopper for now.";
                            $labelIcon = "<i class='icon-unlock'></i>";
                            $indicator = "green";
                        } else {
                            $indicator = "red";
                            $alertLabel = "You want disable {$user->fname} shopper for now.";
                            $labelIcon = "<i class='icon-unlock-alt'></i>";
                        }
//<td>' . $user->lname . '</td>
                        $tr .='<tr class="odd gradeX ind' . $i . '">
                                <td><div class="checker hover"><span><input type="checkbox" class="checkboxes" value="' . $user->id . '" /></span></div></td>                                
                                <td>' . $user->fname . '</td>
                                
                                <td>' . $user->email . '</td>                                
                                <td class="center hidden-480">' . date("d M Y h:i:s", strtotime($user->registered)) . '</td>
                                <td class="hidden-480">' . (($user->isDel) ? "<p class='label label-danger'>Disabled</p>" : "<p class='label label-success'>Enabled</p>") . '</td>
                                <td>
                                    <a href="' . site_url('admin/shopper/' . $user->id . '/' . get_hash($user->id)) . '" class="btn blue"><i class="icon-eye-open"></i></a>
                                    <a href="' . site_url('backend/shopper/edit/' . $user->id . '?hash=' . get_hash($user->id)) . '" class="btn blue"><i class="icon-edit"></i></a>
                                    <a data-label="' . $alertLabel . '" data-id="' . $user->id . '" data-hash="' . get_hash($user->id) . '" data-index="' . $i . '" data-type="' . $user->isDel . '" href="javascript:void(0);" class="btn ' . $indicator . ' deletePage">' . $labelIcon . '</a>
                                </td>
                            </tr>';
                        $i++;
                    }
                    echo $tr;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>
</div>
</div>
<!-- END PAGE CONTAINER-->

<!-- MODAL -->
<div id="deletePage" class="modal hide fade" tabindex="-1" data-focus-on="input:first">    
    <div class="modal-body">
        <h3><i class="fa fa-warning"></i> Are you sure?</h3><b id="delPage"></b>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn">No</button>
        <button type="button" class="btn btn-primary green" id="deleYes">Yes</button>
    </div>
</div>

<div id="pleaseWait" class="modal hide fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static">
    <div class="modal-body">
        <h3><i class="fa fa-warning"></i> Please wait...</h3>
    </div>
</div>
<!-- MODAL -->

<link rel="stylesheet" href="<?php echo assets_url('backend/plugins/data-tables/DT_bootstrap.css') ?>" />
<script type="text/javascript" src="<?php echo assets_url('backend/plugins/data-tables/jquery.dataTables.js') ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('backend/plugins/data-tables/DT_bootstrap.js') ?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        // begin first table
        $('#sample_1').dataTable({
            "aoColumns": [
                {"bSortable": false},
                null,
                null,
                null,
                null,
                {"bSortable": false}
            ],
            "aLengthMenu": [
                [5, 15, 20, 50, -1],
                [5, 15, 20, 50, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 5,
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page",
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0]
                }
            ]
        });

        /*
         * Open Delete dilaog box
         */
        var inputArray;
        $(document).on("click", "a.deletePage", function(e) {
            e.preventDefault();
            var _this = $(this);

            inputArray = [];
            inputArray.push({name: "pid", value: _this.attr("data-id")});
            inputArray.push({name: "hash", value: _this.attr("data-hash")});
            inputArray.push({name: "index", value: _this.attr("data-index")});
            inputArray.push({name: "type", value: _this.attr("data-type")});

            $("#delPage").text(_this.attr("data-label"));
            $("#deletePage").modal("show");
        });

        /*
         * DELETE request on Yes click
         */
        $(document).on("click", "#deleYes", function() {

            var index = inputArray[2].value;
            var _type = inputArray[3].value;

            $.ajax({
                type: "POST",
                dataType: "json",
                data: inputArray,
                url: "<?php echo site_url("backend/shopper/visibility") ?>",
                beforeSend: function() {
                    $("#deletePage").modal("hide");
                    $("#pleaseWait").modal("show");
                },
                success: function(r) {

                    window.location.reload();

                    /*
                     // Change Icon
                     $(".ind" + index + " .deletePage i").attr("class", ((_type == "0") ? "icon-unlock-alt" : "icon-unlock") );
                     
                     var table = $('#sample_1').dataTable();
                     table.fnDeleteRow( table.fnGetPosition( $("a[data-index=\"" + index + "\"]").closest("tr").get(0) ) );
                     
                     $("#pleaseWait").modal("hide");
                     */
                }
            });

        });

        jQuery('.group-checkable').change(function() {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function() {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });

    });
</script>
