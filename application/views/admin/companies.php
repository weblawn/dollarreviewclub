</div> <!-- landingbg -->
<?php //print_r($user); 
$getUsermata_category = getUsermata($user->id, 'category');
$get_category= unserialize($getUsermata_category->mval);
//print_r($get_category);
if(is_array($get_category)){$get_category=$get_category[0];}
$get_category_details = get_category($get_category);
//echo $_GET['tab'];
                
    $show_tablist_2 = 'class="active"';    
    $show_tabpanel_2 = 'class="tab-pane fade in active"';

?>
<!-- [45] -->

<div class="innerpage review_page">
<div class="contentbox page">
	
	<div class="container">
		<div class="content page-shadow page">
		
		
			<div class="my_account">
		
			

  <!-- Nav tabs -->
  <ul class="nav nav-tabs my_account_tabs" role="tablist">
    <li role="presentation" ><a href="<?php echo site_url('backend/shopper') ?>"  >Back to list</a></li>
    <li role="presentation" <?php echo $show_tablist_2; ?>><a href="#my_product_review" aria-controls="profile" role="tab" data-toggle="tab" onclick="disable_notification();">My Product Review Status</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">	
	
		<div role="tabpanel" <?php echo $show_tabpanel_2; ?> id="my_product_review">
			<h1 class="page-title">My Product Review Status</h1>
			<p class="text-right b-btm"></p>
		
		<?php 
      if($online_product !='false'){$online_product_count = count($online_product);}
      else{$online_product_count = 0;} ?>
		<h5 class="tab-heading">Product Online Now: <span><?php echo $online_product_count; ?></span></h5>
		<div class="panel-group" id="accordion">

	  
	  
	  <?php 
      foreach($online_product as $single)
      { 
        $formatted_starting_date = date('Y/m/d',strtotime($single->start_date)).'<br>'.date('h:i:s',strtotime($single->start_date));
        $review_list = get_finished_review_for_product($single->pid);
        $count_review = 0;$formatted_date = '';
        $onclick = '';
        if($review_list !='false')
        {
            $count_review = count($review_list);
        }
        if($single->code_access_condition_type == 'product_code_access_condition_none')
        {
            $text = 'Everyone Can Access';
            $button_url = ' data-toggle="modal" data-dismiss="modal" data-target="#myModal57"';
            $onclick = "auto_none_function('".$single->pid."')";
        }
        else if($single->code_access_condition_type == 'product_code_access_condition_custom')
        {
            $text = 'Auto ( >'.$single->code_access_condition. ' reviews )';
            $button_url = ' data-toggle="modal" data-dismiss="modal" data-target="#myModal57"';
            $onclick = "auto_none_function('".$single->pid."')";
        }
        else if($single->code_access_condition_type == 'product_code_access_condition_manual')
        {
            $get_manual_pending_by_id = get_manual_pending_by_id($single->pid);
            if($get_manual_pending_by_id!='0'){$count_get_manual_pending_by_id = count($get_manual_pending_by_id);}else{$count_get_manual_pending_by_id = 0;}
            $text = 'Manual ( '.$count_get_manual_pending_by_id.' waiting )';
            $button_url = ' data-toggle="modal" data-dismiss="modal" data-target="#myModal58"';
            $onclick = "manual_function('".$single->pid."')";
        }
        $onclick_review_chart_function = "review_chart_function('".$single->pid."')";
        
        
        if($single->end_date_type == 'product_end_time_until')
        {
            $remain = $single->product_end_time_until_count - $single->total_count;
            $formatted_date = 'Codes Given (Remaining: '.$remain.' Codes)';
            $formatted_ending_date = 'Remaining: '.$remain.' Codes';
        }
        else
        {
            $date = strtotime("now");
            $end_date = strtotime($single->end_date);
            $diff_date = $end_date-$date;
            $get_formatted_date = secondsToTime($diff_date);
            $formatted_date = 'Time (Remaining: '.$get_formatted_date['d'].' d : '.$get_formatted_date['h'].' h : '.$get_formatted_date['m'].' min )';
            $get_formatted_ending_date = secondsToTime($diff_date);
            $formatted_ending_date =  date('Y/m/d',strtotime($single->end_date)).'<br>'.date('h:i:s',strtotime($single->end_date));
        }
        
        if($single->pid == $_GET['tab_list'])
        {
            $parent_class = '';
            $child_class = 'collapse in';
        }
        else
        {
            $parent_class = 'collapsed';
            $child_class = 'collapse';
        }
        ?>
        
	   <div class="panel panel-default" id="<?php echo 'tab_list_'.$single->pid; ?>">
	 
		  <div class="panel-title accordion-toggle clearfix" >
	   
			   <table class="col-md-12 table-bordered table-condensed text-center ">
			<tr>
					<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'tab_id_'.$single->pid; ?>" class="indicator plus  <?php echo $parent_class;?>"><a class="plus_minus"></a></span></td>
				<td colspan="4">
				<div class="top-heading"><?php echo the_excerpt($single->name,'0','75'); ?></div> 
						<a class="btn btn-org pull-right">Online now</a>
				</td>
				
			</tr>
			<tr>
				<td><a data-toggle="modal" data-dismiss="modal" data-target="#myModal59" style="cursor: pointer;" onclick="<?php echo $onclick_review_chart_function; ?>">Reviews Increases: + <?php echo $count_review; ?></a></td>
				<td>Stop Condition: <?php echo $formatted_date; ?></td>
				<td><a <?php echo  $button_url; ?> onclick="<?php echo $onclick; ?>" style="cursor: pointer;">Approved: <?php echo $text; ?></a></td>
				<td>
					<span class="account_icon"><a data-toggle="modal" data-dismiss="modal" data-target="#myModal59" style="cursor: pointer;" onclick="<?php echo $onclick_review_chart_function; ?>"><img src="<?php echo new_assets_url('img/chart.png') ?>"></a></span>
					<span class="account_icon"><a  style="cursor: pointer;" data-toggle="modal" data-dismiss="modal" data-target="#myModal42" onclick="set_to_stop_product(<?php echo $single->pid; ?>)"><img src="<?php echo new_assets_url('img/stop.png') ?>"></a></span>
				</td>
				
			</tr>
				
				
			  
			</table> 
			
			
		
		 
		  </div>
	  
		<div id="<?php echo 'tab_id_'.$single->pid; ?>" class="panel-collapse  <?php echo $child_class;?>">
		  <div class="panel-body">
		   <div id="no-more-tables">
			<table class="table-bordered w100 table-condensed table-striped-column text-center  cf">
			<thead class="cf text-center">	
				<tr>
					<th class="numeric w37per">Product Title</th>
					<th class="numeric">Price</th>
					<th class="numeric">Launch Time</th>
					<th class="numeric">End Time</th>
					<th class="numeric">Code Taken</th>
					<th class="numeric">View Product</th>
					
					
				</tr>
			</thead>	
				
				
				<tbody>
				<tr>
				<td data-title="Product Title"> <p class="w400"	><?php echo $single->name; ?></p></td>
					
					<td data-title="Price" class="numeric" >$<?php echo $single->discount_price; ?></td>
					<td data-title="Launch Time" class="numeric"><?php echo $formatted_starting_date; ?></td>
					<td data-title="End Time" class="numeric"><?php echo $formatted_ending_date; ?></td>
					<td data-title="Code Taken" class="numeric">-<?php echo $single->total_count; ?></td>
					<td data-title="View Product" class="numeric"><a onclick="get_product_details('<?php echo $single->pid; ?>')" data-toggle="modal" data-target="#myModal" style="cursor: pointer;">on DRC</a><br><a href="<?php echo $single->aws_url; ?>" target="_blank">on Amazon</a></td>
				</tr>
				</tbody>
		
			</table>
		  </div> <!-- no-more-tables -->
		  </div>
		  
		</div>
	  </div>  
	  <?php
      }
      if($offline_product !='false'){$offline_product_count = count($offline_product);}
      else{$offline_product_count = 0;}
      ?>
	  
	
	  <hr>
	  <h5 class="tab-heading mb56">Product Expired:<span><?php echo $offline_product_count; ?></span></h5>
      
      
      <?php 
      foreach($offline_product as $single)
      { 
        $formatted_starting_date = date('Y/m/d',strtotime($single->start_date)).'<br>'.date('h:i:s',strtotime($single->start_date));
        $review_list = get_finished_review_for_product($single->pid);
        $count_review = 0;$formatted_date = '';
        if($review_list !='false')
        {
            $count_review = count($review_list);
        }
                
        if($single->end_date_type == 'product_end_time_until')
        {
            $remain = $single->product_end_time_until_count - $single->total_count;
            $formatted_date = 'Codes Given (Remaining: '.$remain.' Codes)';
            $formatted_ending_date = 'Remaining: '.$remain.' Codes';
        }
        else
        {
            $date = strtotime("now");
            $end_date = strtotime($single->end_date);
            $diff_date = $end_date-$date;
            $get_formatted_date = secondsToTime($diff_date);
            $formatted_date = 'Time Remaining: '.$get_formatted_date['d'].' d : '.$get_formatted_date['h'].' h : '.$get_formatted_date['m'].' min';
            $get_formatted_ending_date = secondsToTime($diff_date);
            $formatted_ending_date =  date('Y/m/d',strtotime($single->end_date)).'<br>'.date('h:i:s',strtotime($single->end_date));
        }
        $onclick_review_chart_function = "review_chart_function('".$single->pid."')";
        if($single->pid == $_GET['tab_list'])
        {
            $parent_class = '';
            $child_class = 'collapse in';
        }
        else
        {
            $parent_class = 'collapsed';
            $child_class = 'collapse';
        }
        ?>
	    <div class="panel panel-default expired_deals" id="<?php echo 'tab_list_'.$single->pid; ?>">
	 
		  <div class="panel-title accordion-toggle clearfix" >
			   <table class="col-md-12 table-bordered table-condensed text-center">
			<tr>
				<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'tab_id_'.$single->pid; ?>" class="indicator plus  <?php echo $parent_class;?>"><a class="plus_minus"></a></span></td>
				<td colspan="4"><div class="top-heading"><?php echo the_excerpt($single->name,'0','75'); ?></div> <a class="btn btn-org pull-right expired">Expired</a></td>
				
			</tr>
			<tr>
				<td colspan="2"><a data-toggle="modal" data-dismiss="modal" data-target="#myModal59" style="cursor: pointer;" onclick="<?php echo $onclick_review_chart_function; ?>">Reviews Increases: + <?php echo $count_review; ?></a></td>
				
				<td><?php echo $formatted_date; ?></td>
				<td>
				<div class="icons_set">
					<span class="account_icon"><a data-toggle="modal" data-dismiss="modal" data-target="#myModal59" style="cursor: pointer;" onclick="<?php echo $onclick_review_chart_function; ?>"><img src="<?php echo new_assets_url('img/chart.png') ?>"></a></span>
					<span class="account_icon"><a  style="cursor: pointer;" data-toggle="modal" data-dismiss="modal" data-target="#myModal41" onclick="set_to_start_product(<?php echo $single->pid; ?>)"><img src="<?php echo new_assets_url('img/refresh.png') ?>"></a></span>
				</div>	
				</td>
				
			</tr>
			</table> 
		  </div>
	  
		<div id="<?php echo 'tab_id_'.$single->pid; ?>" class="panel-collapse  <?php echo $child_class;?>">
		  <div class="panel-body">
		   <div id="no-more-tables">
			<table class="table-bordered w100 table-condensed table-striped-column text-center  cf">
			<thead class="cf text-center">	
				<tr>
					<th class="numeric w37per">Product Title</th>
					<th class="numeric">Price</th>
					<th class="numeric">Launch Time</th>
					<th class="numeric">End Time</th>
					<th class="numeric">Code Taken</th>
					<th class="numeric">View Product</th>
				</tr>
			</thead>	
			<tbody>
			<tr>
			<td data-title="Product Title"> <p class="w400"	><?php echo $single->name; ?></p></td>
					<td data-title="Price" class="numeric" >$<?php echo $single->discount_price; ?></td>
					<td data-title="Launch Time" class="numeric"><?php echo $formatted_starting_date; ?></td>
					<td data-title="End Time" class="numeric"><?php echo $formatted_ending_date; ?></td>
					<td data-title="Code Taken" class="numeric">-<?php echo $single->total_count; ?></td>
					<td data-title="View Product" class="numeric"><a onclick="get_product_details('<?php echo $single->pid; ?>')" data-toggle="modal" data-target="#myModal" style="cursor: pointer;">on DRC</a><br><a href="<?php echo $single->aws_url; ?>" target="_blank">on Amazon</a></td>
				</tr>
				</tbody>
			</table>
		  </div> <!-- no-more-tables -->
		  </div>
		</div>
	  </div> <!-- panel panel-default -->
	  <?php
      }
      ?>
	   
	  
	  <a class="load-more" id="loadMore" style="cursor: pointer;"><span>+</span> Show more</a>
	  
	</div> <!-- #accordion -->
		
		
		
		
		
		
		
		</div>
  </div>

</div>
			
			
		
		</div> <!-- my_account -->

		</div> <!-- content -->	
	<div class="clearfix"></div>
	</div>

</div> <!-- innerpage close -->

<!--[55] Relaunch product warning*/ -->
  
  
  <!-- Modal -->
<div class="modal fade thank_you not_log_in launch_product_popup" id="myModal41" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>Are you sure you want to relaunch this product?</h3>
			<p>You will be redirected to the launching page for further detail.</p>
			<button type="button" class="btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" data-target="#myModal2" id="start_product">Yes</button>
			<button type="button" class="btn gray-btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" data-target="#myModal2" >No</button>
			
      </div>

    </div>
  </div>

</div>
<!-- [54] Stop product launch warning */ -->

  
  <!-- Modal -->
<div class="modal fade thank_you not_log_in launch_product_popup" id="myModal42" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>Are you sure you want to stop this product from launching?</h3>
			<p>You can relaunch it in the "Product Expired" below.</p>
			<button type="button" class="btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" data-target="#myModal2" id="stop_product">Yes</button>
			<button type="button" class="btn gray-btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" data-target="#myModal2" >No</button>
			
      </div>

    </div>
  </div>

</div> 
<!-- [53] Review Increasing Charts -->
  
  
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

<!-- [51] Approve (double confirm)  -->
  
  
  <!-- Modal -->
<div class="modal fade thank_you not_log_in launch_product_popup" id="myModal44" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>Are you sure you want to approve the selected customers?</h3>
			<p>Once you click "Yes", they will receive your discount code.</br>
			Note: You cannot withdraw the given discount code.</p>
			<button type="button" class="btn btn185_73"  onclick="set_approve();" id="set_approve_butn" >Yes</button>
			<button type="button" class="btn gray-btn btn185_73" data-toggle="modal" data-dismiss="modal" data-target="#myModal58" id="set_approve_no_butn" onclick="manual_function();" >No</button>
			
      </div>

    </div>
  </div>

</div>
<!-- [52] Disapprove (double confirm)  -->
  
  
  <!-- Modal -->
<div class="modal fade thank_you not_log_in launch_product_popup" id="myModal43" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>Are you sure you want to disapprove the selected customers?</h3>
			<p>Once you click "Yes", their requests to access your product discount code will be rejected.</p>
			<button type="button" class="btn btn185_73"  onclick="set_disapprove();" id="set_disapprove_butn">Yes</button>
			<button type="button" class="btn gray-btn btn185_73" data-toggle="modal" data-dismiss="modal" data-target="#myModal58" id="set_disapprove_no_butn" onclick="manual_function();" >No</button>
			
      </div>

    </div>
  </div>

</div>
<script>
  function set_to_start_product(id)
  {
    $('#start_product').attr('onclick',"start_product('"+id+"')");
  }
  function set_to_stop_product(id)
  {
    $('#stop_product').attr('onclick',"stop_product('"+id+"')");
  }
function start_product(id)
{
    console.log('start '+id);
    var url = "<?php echo site_url('admin/companies_launch_edit/'.$user->id); ?>/"+id;
 window.open(url, '_blank');
   
}
function stop_product(id)
{
    //console.log('stop '+id);
   var ajaxReqData = {pid: id};
    
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/expire_product'); ?>", 
			dataType		: 'json',
			data			: ajaxReqData,
           
                success: function(r) {
                    window.location.reload();
                    
                }
		});

}
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

    function approve_disapprove_select() {  //on click 
        //console.log(val);
    
        if($('#approve_disapprove_all').prop("checked")) { // check select status
        //console.log('yes');
            $('.approve_disapprove').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
        console.log('no');
            $('.approve_disapprove').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    }
    
    function set_approve(pid)
    {
        var approve_value = $('input[name=approve_disapprove]:checked').map(function()
            {
                return $(this).val();
            }).get();
            //console.log(approve_value);
            var ajaxReqData = {approve_value: approve_value};
    
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/set_approve'); ?>", 
			dataType		: 'json',
			data			: ajaxReqData,
           
                success: function(r) {
                    key = 'key';
                    val = 'val';
                    $('#myModal44').modal('toggle');
                    $('#myModal58').modal('toggle');
                    manual_function(pid, key, val);
                    
                }
		});
    }
    
    function set_disapprove(pid)
    {
        var approve_value = $('input[name=approve_disapprove]:checked').map(function()
            {
                return $(this).val();
            }).get();
            //console.log(approve_value);
            var ajaxReqData = {approve_value: approve_value};
    
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/set_disapprove'); ?>", 
			dataType		: 'json',
			data			: ajaxReqData,
           
                success: function(r) {
                    key = 'key';
                    val = 'val';
                    $('#myModal43').modal('toggle');
                    $('#myModal58').modal('toggle');
                    manual_function(pid, key, val);
                }
		});
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

jQuery('.expired_deals').hide();
    expired_deals = jQuery(".expired_deals").size();
    x=10;
    jQuery('.expired_deals:lt('+x+')').show();
    jQuery('#loadMore').click(function () {
        x= (x+10 <= expired_deals) ? x+10 : expired_deals;
        jQuery('.expired_deals:lt('+x+')').show();
        if(x == expired_deals)
        {
            jQuery('#loadMore').text('No more to show');
        }
        
    });

$(function() {
	$(document).on("submit", "form#my_account_edit_form", function(e) {
       var data = new FormData($('#my_account_edit_form')[0]);
       var _alert = $("#my_account_edit_form_Alert");
		e.preventDefault();
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('companies/update_my_account'); ?>", 
			dataType		: 'json',
			data			: data,
            contentType: false,
            cache: false,
            processData: false,
                beforeSend: function() {
                    _alert.html('<div class="alert alert-success">Please wait...</div>').show();
                },
                error: function() {
                    _alert.html('<div class="alert alert-danger">Error in server scripting</div>').show();
                },
                success: function(r) {
                    if (r.res) {
                        
                                _alert.html(r.msg).show();
                                //alert(r.msg);
                       if (r.haserror != 1) {
                        _alert.html('<div class="alert alert-success">Update successful.</div>').show();
                        setTimeout(function() { 
                            location.reload();
                          },1000); // insert after 1 seconds
                         
                       }       
                        
                    } 
                }
		});
		return false;
	});
});


    



</script>
<?php
if($_GET['tab']=="review_status")
{ 
    ?><script> disable_notification(); </script> <?php
}
if(isset($_GET['tab_list']))
{ 
    ?><script> 
    $('html, body').animate({
        scrollTop: $('#tab_list_'+<?php echo $_GET['tab_list']; ?>).offset().top
    }, 'slow'); 
    
    </script> <?php
}
?>