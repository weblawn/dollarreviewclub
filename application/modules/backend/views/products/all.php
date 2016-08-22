<div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row-fluid">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
                <tr>
                    <th style="width:8px;"><div class="checker hover"><span><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></span></div></th>
                    <th>Name</th>
                    <th class="hidden-480">Category</th>
                    <th class="hidden-480">Price</th>
                    <th class="hidden-480">Discount Price</th>
                    <th class="hidden-480">Start Date</th>
                    <th class="hidden-480">End Date / Stop condition</th>
                    <th class="hidden-480">Code Access Condition</th>
                    <th class="hidden-480">Reviews increase</th>
                    <th class="hidden-480">Recommended</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($products)) {
                    $tr = '';
                    for ($i = 0; $i < count($products); $i++) {
                        
                        
        $formatted_starting_date = date('Y/m/d',strtotime($products[$i]['product']->start_date)).'<br>'.date('h:i:s',strtotime($products[$i]['product']->start_date));
        $review_list = get_finished_review_for_product($products[$i]['product']->pid);
        $count_review = 0;$formatted_date = '';
        $onclick = '';
        if($products[$i]['product']->code_access_condition_type == 'product_code_access_condition_none')
        {
            $text = 'Everyone Can Access';
            $button_url = ' data-toggle="modal" data-dismiss="modal" data-target="#myModal57"';
            $onclick = "auto_none_function('".$products[$i]['product']->pid."')";
        }
        else if($products[$i]['product']->code_access_condition_type == 'product_code_access_condition_custom')
        {
            $text = 'Auto ( >'.$products[$i]['product']->code_access_condition. ' reviews )';
            $button_url = ' data-toggle="modal" data-dismiss="modal" data-target="#myModal57"';
            $onclick = "auto_none_function('".$products[$i]['product']->pid."')";
        }
        else if($products[$i]['product']->code_access_condition_type == 'product_code_access_condition_manual')
        {
            $get_manual_pending_by_id = get_manual_pending_by_id($products[$i]['product']->pid);
            if($get_manual_pending_by_id!='0'){$count_get_manual_pending_by_id = count($get_manual_pending_by_id);}else{$count_get_manual_pending_by_id = 0;} 
            $text = 'Manual ( '.$count_get_manual_pending_by_id.' waiting )';
            $button_url = ' data-toggle="modal" data-dismiss="modal" data-target="#myModal58"';
            $onclick = "manual_function('".$products[$i]['product']->pid."')";
        }
        $onclick_review_chart_function = "review_chart_function('".$products[$i]['product']->pid."')";
        
        
        if($products[$i]['product']->end_date_type == 'product_end_time_until')
        {
            $remain = $products[$i]['product']->product_end_time_until_count - $products[$i]['product']->total_count;
            $formatted_date = 'Codes Given (Remaining: '.$remain.' Codes)';
            $formatted_ending_date = 'Remaining: '.$remain.' Codes';
        }
        else
        {
            $date = strtotime("now");
            $end_date = strtotime($products[$i]['product']->end_date);
            $diff_date = $end_date-$date;
            $get_formatted_date = secondsToTime($diff_date);
            $formatted_date = 'Time (Remaining: '.$get_formatted_date['d'].' d : '.$get_formatted_date['h'].' h : '.$get_formatted_date['m'].' min )';
            $get_formatted_ending_date = secondsToTime($diff_date);
            $formatted_ending_date =  date('Y/m/d',strtotime($products[$i]['product']->end_date)).'<br>'.date('h:i:s',strtotime($products[$i]['product']->end_date));
        }
        
        if ($products[$i]['product']->disabled != 1) {
                            $alertLabel1 = "You want to disable {$products[$i]['product']->name} product for now.";
                            $labelIcon = "<i class='icon-unlock'></i>";
                            $indicator1 = "red";
                        } else {
                            $indicator1= "green";
                            $alertLabel1 = "You want to enable {$products[$i]['product']->name} product for now.";
                            $labelIcon = "<i class='icon-unlock-alt'></i>";
                        }
                        

                        if ($products[$i]['product']->recomended == 1) {
                            $alertLabel2 = "You want to remove recommendation {$products[$i]['product']->name} product for now.";
                            $recomendedIcon = "<i class='icon-thumbs-up'></i>";
                            $indicator2 = "red";
                        } else {
                            $indicator2 = "green";
                            $alertLabel2 = "You want to recommend {$products[$i]['product']->name} product for now.";
                            $recomendedIcon = "<i class='icon-thumbs-down'></i>";
                        }
                        
                        $chart_img_url = new_assets_url('img/chart.png');
                        $cat = get_category($products[$i]['product']->category);
                        $tr .='<tr class="odd gradeX ind' . $i . '">
                                <td><div class="checker hover"><span><input type="checkbox" class="checkboxes" value="' . $products[$i]['product']->pid . '" /></span></div></td>
                                <td>' . the_excerpt($products[$i]['product']->name) . '</td>
                                <td class="hidden-480">' . $cat->name . '</td>
                                <td>' . $products[$i]['product']->price . '</td>
                                <td>' . $products[$i]['product']->discount_price . '</td>
                                <td>' . $formatted_starting_date . '</td>
                                <td class="hidden-480">' . $formatted_ending_date . '</td>
                                <td class="hidden-480"><a ' . $button_url . ' onclick="' . $onclick . '" style="cursor: pointer;">' . $text . '</a></td>
                                <td class="center hidden-480"><a data-toggle="modal" data-dismiss="modal" data-target="#myModal59" style="cursor: pointer;" onclick="'.$onclick_review_chart_function.'"><img src="'.$chart_img_url.'"></a></td>
                                
                                <td class="hidden-480"><a data-label="' . $alertLabel2 . '" data-id="' . $products[$i]['product']->pid . '"  data-action="recomended" data-hash="' . get_hash($products[$i]['product']->pid) . '" data-index="' . $i . '" data-type="' . $products[$i]['product']->recomended . '" href="javascript:void(0);" class="btn ' . $indicator2 . ' deletePage">' . $recomendedIcon . '</a><span style="color: white;">'.$indicator2.'<span/></td>
                                <td>
                                <a onclick="get_product_details('.$products[$i]['product']->pid.')" data-toggle="modal" data-target="#myModal" style="cursor: pointer;">DRC</a>
                                <br>
                                <a href="'.$products[$i]['product']->aws_url.'" target="_blank">Amazon</a>
                                <br>
                                    
                                    <a data-label="' . $alertLabel1 . '" data-id="' . $products[$i]['product']->pid . '" data-action="disabled" data-hash="' . get_hash($products[$i]['product']->pid) . '" data-index="' . $i . '" data-type="' . $products[$i]['product']->disabled . '" href="javascript:void(0);" class="btn ' . $indicator1 . ' deletePage">' . $labelIcon . '</a>
                                </td>
                            </tr>';
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

  <!-- [53] Review Increasing Charts -->
<div class="modal fade popup_table review_chart" id="myModal59" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body" id="modal_body_for_review_chart">
			
			
      </div>

    </div>
  </div>

</div><!-- Modal close -->	



<!-- [50]-Approved-(Manual) -->
  
  
  <!-- Modal -->
<div class="modal fade popup_table customer_discount_code " id="myModal58" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body" id="modal_body_for_manual">
			
			
      </div>

    </div>
  </div>

</div><!-- Modal close -->	

<!-- [49] Approved (Everyone can access, auto)  -->
  
  
  <!-- Modal -->
<div class="modal fade popup_table customer_discount_code" id="myModal57" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body" id="modal_body_for_auto_none">
			
			
      </div>

    </div>
  </div><!-- Modal close -->	

</div>



<!-- product details Modal -->
<div class="modal fade product_details_popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
       

      <div class="modal-body clearfix">
	  <div class="product_info_popup">
       <div class="col-md-5"> 
	   
	   
<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
    <div class='carousel-outer'>
        <!-- Wrapper for slides -->
        <div class='carousel-inner'>
            <div class='item active'>
                <img id="product_img0" src='' alt='' height="300" width="299" class="img-responsive center-block" style="height: 299px;" />
            </div>
           
        </div>

    </div>
    
    <!-- Indicators -->
    <ol class='carousel-indicators mCustomScrollbar list-inline center-block text-center'>
        <li data-target='#carousel-custom' data-slide-to='0' class='active'><img id="product_thumb_img0" src='' alt='' height="65" width="65" /></li>
      </ol>
</div>
	   
	   
	   
	   
	   </div><!--col-md-5 -->
       <div class="col-md-7">
       <div id="customdata"></div>
		<div class="time_left" id="time_left"></div>
	   <h3 id="product_title" class="product_titles">Ring Sling Baby Carrier - One Size Fits All - Easy On Your Back - Comfort For Your Baby - Can Be Used For</h3>
	   <div class="author_info">From <span id="belong_company"></span></div>
	   
	   <div class="pricearea clearfix">
			<div class="price"><span class="new-price" id="product_new_price"></span>
			<span class="original-price" id="product_original_price"></span>
			<span><a class="btn btn-off"  id="product_off">98% OFF</a></span>
			</div> 
		</div>
		
		<div class="btn-groups clearfix">
		<?php $user = get_active_user(); if(isset($user->role)){$additional = '';} else{$additional = ' data-toggle="modal" data-dismiss="modal" data-target="#myModal40"';} ?>
		<a id="product_reviewLink" class="btn btn-getnow" <?php echo $additional; ?>>Get it now</a>
		<a id="product_amazonLink" target="_blank" class="btn btn-amazon">View on Amazon</a>
		</div>
		<div class="details"><strong>Details:</strong><br>
		<p id="product_details" class="product_details"></p>

<p class="disclaimer"><em>Please leave a disclaimer that you received this discounted product in exchange
for your honest review. </em></p>
		
		</div>
		
		
	   </div> <!-- col-md-7-->
      </div> <!--product_info_popup-->
      </div> <!-- model body -->
    </div>
  </div>
</div>


<link rel="stylesheet" href="<?php echo assets_url('backend/plugins/data-tables/DT_bootstrap.css') ?>" />
<?php /* <link rel="stylesheet" href="<?php echo assets_url('backend/css/popup.css?v=1.1') ?>" /> */ ?> 

<link rel="stylesheet" href="<?php echo assets_url('backend/css/popup.css?v='.date("Y-m-d,H:i:s")) ?>" />

<script src="<?php echo new_assets_url('js/canvasjs.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('backend/plugins/data-tables/jquery.dataTables.js') ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('backend/plugins/data-tables/DT_bootstrap.js') ?>"></script>
<script type="text/javascript">


function get_product_details(id)
{
    $('#product_thumb_img0').attr('src','');
    $('#product_img0').attr('src','');
    $('#product_thumb_img0').closest('li').addClass("active");
    $('#product_img0').closest('div').addClass("active");
    for(index = 1; index<=8; index++)
    {
        $('#product_thumb_img'+index).closest('li').remove();
        $('#product_img'+index).closest('div').remove();
    }
    $('#time_left').html('');
var site_url = "<?php echo site_url() ?>";
//var logged_in = '<?php //echo $additional; ?>';
var ajaxReqData = {pid: id,action: "itemdetails"};
    $.ajax({

            type: "POST",

            url: site_url + "ajax/itemdetails",

            dataType: "json",

            data: ajaxReqData,

            success: function(r) {
                $('#product_amazonLink').attr('href',r.data['amazonLink']);
                if(r.data['pro']['end_date_type'] != 'product_end_time_until')
                {
                    $('#time_left').html('Discount expires in <time>'+r.data['time_left']+'</time>');
                }
                
                if(r.data['can_get_msg'] == 'expire')
                    {
                        $('#product_reviewLink').text('Expire');
                    }
                else if(r.data['can_get_msg'] == 'daily_limit_out')
                    {
                        $('#product_reviewLink').text('Daily limit out');
                    }
                else
                    {
                        if(r.data['pro']['code_access_condition_type'] == 'product_code_access_condition_none')
                        {
                            $('#product_reviewLink').text('Get it now');
                            /*if(logged_in =='')
                            {$('#product_reviewLink').attr('onclick','get_now_condition1('+id+')');}*/
                        }
                        else if(r.data['pro']['code_access_condition_type'] == 'product_code_access_condition_custom')
                        {
                            $('#product_reviewLink').text('Get it now');
                            /*if(logged_in =='')
                            {$('#product_reviewLink').attr('onclick','get_now_condition2('+id+')');}*/
                        }
                        else if(r.data['pro']['code_access_condition_type'] == 'product_code_access_condition_manual')
                        {
                            $('#product_reviewLink').text('Get Approved');
                            /*if(logged_in =='')
                            {$('#product_reviewLink').attr('onclick','get_now_condition3('+id+')');}*/
                        }
                    }
                $('#product_id_for_code').val(r.data['pro']['pid']);
                $('#product_img0').attr('src',site_url+'uploads/product_image/'+r.data['pro']['pid']+'/cover_pic/'+r.data['pro']['img_url']);
                $('#product_thumb_img0').attr('src',site_url+'uploads/product_image/'+r.data['pro']['pid']+'/cover_pic/'+r.data['pro']['img_url']);
                $('#product_title').html(r.data['pro']['name']);
                $('#belong_company').html(r.data['pro']['belong_company']);
                $('#product_details').html(r.data['pro']['description']);
                $('#product_new_price').html('<span>$</span>'+r.data['pro']['discount_price']);
                $('#product_original_price').html('<strike>$'+r.data['pro']['price']+'</strike>');
                var subtract_off = r.data['pro']['price'] - r.data['pro']['discount_price'];
                var calculate_off = subtract_off/r.data['pro']['price'];
                var off = calculate_off*100;
                $('#product_off').html(parseFloat(off).toFixed(2)+'% OFF');
                $.each(r.data['other_img_url'], function( index, value ) {
                  var new_index = index+1;
                  $(".carousel-inner").append('<div class="item"><img id="product_img'+new_index+'" src="'+site_url+'uploads/product_image/'+r.data['pro']['pid']+'/other_pic/'+value+'" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;" /></div>');
                  $(".carousel-indicators").append('<li data-target="#carousel-custom" data-slide-to="'+new_index+'"><img id="product_thumb_img'+new_index+'" src="'+site_url+'uploads/product_image/'+r.data['pro']['pid']+'/other_pic/'+value+'" alt="" height="65" width="65" /></li>');
                  
                });
            }

        });
}





    jQuery(document).ready(function($) {
        
            $("#myModal").hide();
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
            inputArray.push({name: "action", value: _this.attr("data-action")});

            $("#delPage").text(_this.attr("data-label"));
            //$(".modal-body").hide();
            $("#deletePage").modal("show");
        });

        /*
         * DELETE request on Yes click
         */
        $(document).on("click", "#deleYes", function() {

            var index = inputArray[2].value;
            var _type = inputArray[3].value;
            var _action = inputArray[4].value;

            $.ajax({
                type: "POST",
                dataType: "json",
                data: inputArray,
                url: "<?php echo site_url("backend/products/visibility") ?>",
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
    
    
function create_grap(graph_data)
{graph_data = JSON.parse("[" + graph_data + "]");
graph_data = graph_data[0];
//console.log(graph_data);
    
dataPointss = [];

$(graph_data ).each(function(index, obj){
    var d = new Date(obj.date);
    //console.log(d.getFullYear()+' '+d.getMonth()+' '+d.getDate());
    dataPointss.push({ x: new Date(d.getFullYear(), d.getMonth(), d.getDate()), y: obj.unit});
    //console.log
    
});

    var chart = new CanvasJS.Chart("review_chart_area",
    {
      title:{
    },
    axisX:{
    },
    data: [
    {        
        type: "line",
				showInLegend: true,
				lineThickness: 2,
				markerType: "circle",
				color: "#79ADDC",
      
        dataPoints: dataPointss,
    }
    ]
});

    chart.render();
}
    
function review_chart_function(pid, key, val)
{
    limit = '7';
    page = '1';
    if(key == 'no_request')
    {
        limit = val;
    }
    if(parseInt($( "#review_chart_no_of_request option:selected" ).val()) >0)
    {
        limit = $('#review_chart_no_of_request').val();
    }
    
    if(key == 'request_page')
    {
        page = val;
    }
    var ajaxReqData = {pid: pid,key: key,val: val,limit: limit,page: page};
    $('#modal_body_for_review_chart').html('');
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/modal_body_for_review_chart'); ?>", 
			dataType		: 'json',
			data			: ajaxReqData,
           
                success: function(r) {
                    $('#modal_body_for_review_chart').html(r.msg);
                    create_grap(r.data);
                    //alert('hi');
                }
		});
        
         setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 1000);
}

function auto_none_function(pid, key, val)
{
    limit = '10';
    page = '1';
    if(key == 'no_request')
    {
        limit = val;
    }
    if(parseInt($( "#auto_none_no_of_request option:selected" ).val()) >0)
    {
        limit = $('#auto_none_no_of_request').val();
    }
    
    if(key == 'request_page')
    {
        page = val;
    }
    var ajaxReqData = {pid: pid,key: key,val: val,limit: limit,page: page};
    $('#modal_body_for_auto_none').html('');
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/modal_body_for_auto_none'); ?>", 
			dataType		: 'json',
			data			: ajaxReqData,
           
                success: function(r) {
                    $('#modal_body_for_auto_none').html(r.msg);
                }
		});
        
         setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 1000);
}

function manual_function(pid, key, val)
{
    $('#set_approve_butn').attr('onclick','set_approve('+pid+')');
    $('#set_approve_no_butn').attr('onclick','manual_function('+pid+')');
    $('#set_disapprove_butn').attr('onclick','set_disapprove('+pid+')');
    $('#set_disapprove_no_butn').attr('onclick','manual_function('+pid+')');
    var approve_type = $('input[name=approve_type]:checked').map(function()
            {
                return $(this).val();
            }).get();
    limit = '10';
    page = '1';
    if(key == 'manual_no_request')
    {
        limit = val;
    }
    if(parseInt($( "#manual_no_of_request option:selected" ).val()) >0)
    {
        limit = $('#manual_no_of_request').val();
    }
    
    if(key == 'request_page')
    {
        page = val;
    }
    if(approve_type == '')
    {
        approve_type = 'all';
    }
    var ajaxReqData = {pid: pid,key: key,val: val,approve_type: approve_type,limit: limit,page: page};
    $('#modal_body_for_manual').html('');
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/modal_body_for_manual'); ?>", 
			dataType		: 'json',
			data			: ajaxReqData,
           
                success: function(r) {
                    $('#modal_body_for_manual').html(r.msg);
                }
		});
        
         setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 1000);
}
$(document).on("click", ".close", function() {
    
    jQuery('body').removeClass("modal-open");
    });
</script>
