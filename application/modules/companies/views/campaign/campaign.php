<div class="front-content">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <h1 class="strUpper"><?php echo lang('campaign') ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container elegant campaign">
    <div class="row-fluid">
        <div class="span2">
            <form action="" id="stCampaignFilterForm" method="get">
                <ul class="side-nav">
                    <li class="section">Sorting:</li>
                    <li>
                        <select class="form-control" name="sortBy">
                            <?php
                                $sortOpts = array(
                                    "end_date_asc" => "Time: Ending First",
                                    "start_date_desc" => "Time: New Offers First",
                                    "price_asc" => "Price: Lowest First",
                                    "price_desc" => "Price: Highest First",
                                    "name_asc" => "Name: A-Z",
                                    "name_desc" => "Name: Z-A"
                                );
                                foreach($sortOpts as $sortKey => $sortVal){
                                    $sel = (isset($_GET['sortBy']) && $_GET['sortBy'] == $sortKey) ? 'selected' : '';
                                    echo "<option value='{$sortKey}' {$sel}>{$sortVal}</option>";
                                }
                            ?>
                        </select>
                    </li>
                    <li class="section">Show Only:</li>
                    <li><label><input name="noExpired" type="checkbox" value="1" <?php echo (isset($_GET['noExpired']) && $_GET['noExpired'] == 1) ? "checked" : "" ?>> Not Expired</label></li>
                    <li><label><input name="showHidden" type="checkbox" value="1" <?php echo (isset($_GET['showHidden']) && $_GET['showHidden'] == 1) ? "checked" : "" ?>> Disabled</label></li>
                    <li class="section">Pricing:</li>
                    <li>
                        <div id="slider-range" class="slider bg-blue"></div>
                        <div class="slider-value"><span id="slider-range-amount"></span></div><br/>
                        <input type="hidden" name="rangeMin" value="" />
                        <input type="hidden" name="rangeMax" value="" />
                    </li>
                    <li class="submit">
                        <button type="button" class="btn btn-primary" id="stCampaignFilter"><i class="fa fa-filter"></i> Filter</button>
                    </li>
                </ul>
            </form>
        </div>
        <div class="span10">
            <div class="span12">
                <a href="<?php echo site_url('companies/campaign/asin') ?>" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Create Campaign</a>
            </div>
            <div class="span12">                
                <table class="table table-striped table-bordered table-hover stCampaignTbl" id="sample_1">
                    <thead>
                        <tr>
                            <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                            <th>Name</th>
                            <th class="hidden-480">ASIN</th>
                            <th class="hidden-480">Price</th>
                            <th class="hidden-480">Shipping</th>
                            <th class="hidden-480">Daily Limit</th>
                            <th class="hidden-480">Start Date</th>
                            <th class="hidden-480">End Date</th>
                            <th class="hidden-480">Category</th>
                            <th class="hidden-480">Added On</th>
                            <th class="hidden-480">Status</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo get_campaign_html($products); ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>        
</div>

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
                null,
                null,
                null,
                null,
                null,
                null,
                {"bSortable": false}
            ],
            "aLengthMenu": [
                [5, 15, 20, 50, -1],
                [5, 15, 20, 50, "All"] // change per page values here
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
                url: "<?php echo site_url("companies/campaign/visibility") ?>",
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
