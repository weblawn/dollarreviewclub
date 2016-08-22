<div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->


    <div class="row-fluid">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
                <tr>
                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                    <th >Name</th>
                    <th >email</th>
                    <th >subject</th>
                    <th >message</th>
                    <th>Read</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo $id;
                //print_r($content);
                if (!empty($content)) {
                    $tr = '';
                    $i = 0;
                    foreach ($content as $p) {
                        //print_r($p);
                        if($p->parent_id == '0')
                        {
                            $color = 'red';
                        foreach ($content as $x) {
                                if($x->parent_id ==$p->id )
                                {
                                    $color = 'green';
                                }
                            }
                        
                        $tr .='<tr class="odd gradeX ind'. $i .'">
                                <td><div class="checker hover"><span><input type="checkbox" class="checkboxes" value="' . $p->id . '" /></span></div></td>
                                <td>'.$p->name . '</td>
                                <td>'.$p->email . '</td>
                                <td>'.$p->subject . '</td>
                                <td>'.the_excerpt($p->message,'0','100') . '</td>
                                <td>
                                    <a  href="'.site_url('backend/contactus/open/'.$p->id.'/'.get_hash($p->id)).'" data-index="'. $i .'" href="javascript:void(0);" class="btn '.$color.' openPage"><i class="icon-reply"></i></a>
                                </td>
                                <td>
                                    <a  data-id="' . $p->id . '" data-hash="' . get_hash($p->id) . '" data-index="'. $i .'" href="javascript:void(0);" class="btn red deletePage"><i class="icon-trash"></i></a>
                                </td>
                            </tr>';
                        
                        $i++;
                        }
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
    <div class="modal-header">
        <button type="button" class="close clsModal" data-dismiss="modal" aria-hidden="true"></button>        
    </div>
    <div class="modal-body">
        <h3><i class="fa fa-warning"></i> Are you sure?</h3>You want delete this product permanently.
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
                {"bSortable": false},
                {"bSortable": false},
            ],
            "aLengthMenu": [
                [5, 15, 20, 50, 100, -1],
                [5, 15, 20, 50, 100, "All"] // change per page values here
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
            inputArray.push({name: "title", value: _this.attr("data-name")});
            inputArray.push({name: "index", value: _this.attr("data-index")});
            
            $("#delPage").text(_this.attr("data-name"));
            
            $("#deletePage").modal("show");
        });

        /*
         * DELETE request on Yes click
         */
        $(document).on("click", "#deleYes", function() {
            
            var index = inputArray[3].value;
            
            $.ajax({
                type: "POST",
                dataType: "json",
                data: inputArray,
                url: "<?php echo site_url("backend/dcs/delete") ?>",
                beforeSend: function() {
                    $("#deletePage").modal("hide");
                    $("#pleaseWait").modal("show");
                },
                success: function(r) {
                    //$(".ind" + index).remove();
                    var table = $('#sample_1').dataTable();
                    table.fnDeleteRow( table.fnGetPosition( $("a[data-index=\"" + index + "\"]").closest("tr").get(0) ) );
                    
                    $("#pleaseWait").modal("hide");
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
