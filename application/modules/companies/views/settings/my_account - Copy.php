</div> <!-- landingbg -->
 <!-- [26]-My-Account.jpg -->
<?php //print_r($user); 
$getUsermata_category = getUsermata($user->id, 'category');
$get_category= unserialize($getUsermata_category->mval);
$get_category_details = get_category($get_category);

?>
<div class="innerpage">
<div class="contentbox page">
	
	<div class="container">
		<div class="content page-shadow page">
		
			<div class="w900">
			<div class="my_account edit_account">
			<h1 class="page-title">My Account</h1>
			
			<div >

  <!-- Nav tabs -->
  <ul class="nav nav-tabs my_account_tabs" role="tablist">
    <li role="presentation" class="active"><a href="#my_account" aria-controls="home" role="tab" data-toggle="tab">My Account</a></li>
    <li role="presentation"><a href="#my_product_review" aria-controls="profile" role="tab" data-toggle="tab">My Product Review Status</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="my_account">
	
	<div class="w900">
		<h1 class="page-title">My Account</h1>
	<form class="form-horizontal other_forms ">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label">Your Email address:</label>
    <div class="col-sm-7">
       <div class="existing_value"> <?php echo $user->email; ?></div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Password:</label>
    <div class="col-sm-7">
      <div class="existing_value"> ***********************</div>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputPassword4" class="col-sm-5 control-label">Your Corporation Name on Amazon:   </label>
    <div class="col-sm-7">
     <div class="existing_value"><?php echo $user->fname; ?></div>
    </div>
  </div>
	
  <div class="form-group select_one">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Main Product Category:       </label>
		<div class="col-sm-7">
		<div class="existing_value"> 
			<div class="selected_cat"><?php echo $get_category_details->name; ?> </div>
	
	</div>			
	</div>
  </div>
 

  <div class="form-group">
    <div class="col-sm-12 text-right">
      <button type="button" class="btn btn185_73" id="prepare_edit">Edit Account</button>
    </div>
  </div>
</form>
	</div>
    </div>
    
    <!-----------------------------------------------edit section---------------------------------->
    <div role="tabpanel" class="tab-pane fade" id="my_account_edit">
	
	<div class="w900">
		<h1 class="page-title">My Account</h1>
	<form class="form-horizontal other_forms " id="my_account_edit_form">
    <div id="my_account_edit_form_Alert"></div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label">Your Email address:</label>
    <div class="col-sm-7">
      <input type="email" disabled="disabled" class="form-control" id="inputEmail3" placeholder="<?php echo $user->email; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Password:</label>
    <div class="col-sm-7">
      <input type="password" name="pass" class="form-control" id=" " placeholder="***********************">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputPassword4" class="col-sm-5 control-label">Re-Enter Your Password:</label>
    <div class="col-sm-7">
      <input type="password" name="cpass" class="form-control" id=" " placeholder="***********************">
    </div>
  </div>
	
	<div class="form-group">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Corporation Name on Amazon:    </label>
    <div class="col-sm-7">
      <div class="existing_value">  <?php echo $user->fname; ?></div>
    </div>
  </div>

  <div class="form-group select_one">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Main Product Category:    </label>
      <div class="col-sm-7">
	<div class="selectoption">
					<select class="form-control cat_control" name ="fav_cat" id ="fav_cat" placeholder="Choose Category">
						<option value="0">Choose category</option>
                                    <?php
                                         foreach (get_categories_list() as $cat) {
                                            if($get_category == $cat->cid){$selected = 'selected="selected"';}else{$selected = '';}
                                    ?>
                                        <option value="<?php echo $cat->cid; ?>" <?php echo $selected; ?> ><?php echo $cat->name; ?></option>
                                    <?php
                                         }
                                    ?>
					</select>
			</div>
			</div>
  </div>
 
 
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-org">Done</button>
    </div>
  </div>
</form>
	</div>
	</div>
    
    
    
    
<div role="tabpanel" class="tab-pane fade" id="my_product_review">
			<h1 class="page-title">My Product Review Status</h1>
			<p class="text-right b-btm"><a class="btn btn-org">+ Launch New Product</a></p>
		
		
		<h5 class="tab-heading">Product Online Now: <span>4</span></h5>
		<div class="panel-group" id="accordion">

	  <div class="panel panel-default">
	 
		  <div class="panel-title accordion-toggle clearfix" >
	   
			   <table class="col-md-12 table-bordered table-condensed text-center ">
			<tr>
					<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#one" class="indicator plus"><a class="plus_minus"></a></span></td>
				<td colspan="4">
				<div class="top-heading">Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel  ...</div> 
						<a class="btn btn-org pull-right">Online now</a>
				</td>
				
			</tr>
			<tr>
				<td><a href="#">Reviews Increases: + 22</a></td>
				<td>Stop Condition: Time (Remaining: 5 d : 6 h : 52 min)</td>
				<td><a href="#">Approved: Everyone Can Access</a></td>
				<td>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/chart.png') ?>"></a></span>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/stop.png') ?>"></a></span>
				</td>
				
			</tr>
				
				
			  
			</table> 
			
			
		
		 
		  </div>
	  
		<div id="one" class="panel-collapse collapse in">
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
				<td data-title="Product Title"> <p class="w400"	>Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel Weekend Overnight Bags - Large Duffle Sports/Gym Bag with Shoulder Straps. </p></td>
					
					<td data-title="Price" class="numeric" >$9.99</td>
					<td data-title="Launch Time" class="numeric">2015/12/12<br>18:00:00</td>
					<td data-title="End Time" class="numeric">2015/12/16 <br>18:00:00</td>
					<td data-title="Code Taken" class="numeric">-32</td>
					<td data-title="View Product" class="numeric">on DRC <br>on Amazon</td>
				</tr>
				</tbody>
		
			</table>
		  </div> <!-- no-more-tables -->
		  </div>
		  
		</div>
	  </div>  
	  
	  <div class="panel panel-default">
	 
		  <div class="panel-title accordion-toggle clearfix" >
			   <table class="col-md-12 table-bordered table-condensed text-center">
			<tr>
				<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#two" class="indicator plus"><a class="plus_minus"></a></span></td>
				<td colspan="4"><div class="top-heading">Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel  ...</div> <a class="btn btn-org pull-right">Online now</a></td>
				
			</tr>
			<tr>
				<td><a href="#">Reviews Increases: + 22</a></td>
				<td>Stop Condition: Time (Remaining: 5 d : 6 h : 52 min)</td>
				<td>Approved: Everyone Can Access</td>
				<td>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/chart.png') ?>"></a></span>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/stop.png') ?>"></a></span>
				</td>
				
			</tr>
			</table> 
		  </div>
	  
		<div id="two" class="panel-collapse collapse">
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
			<td data-title="Product Title"> <p class="w400"	>Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel Weekend Overnight Bags - Large Duffle Sports/Gym Bag with Shoulder Straps. </p></td>
					<td data-title="Price" class="numeric" >$9.99</td>
					<td data-title="Launch Time" class="numeric">2015/12/12<br>18:00:00</td>
					<td data-title="End Time" class="numeric">2015/12/16 <br>18:00:00</td>
					<td data-title="Code Taken" class="numeric">-32</td>
					<td data-title="View Product" class="numeric">on DRC <br>on Amazon</td>
				</tr>
				</tbody>
			</table>
		  </div> <!-- no-more-tables -->
		  </div>
		</div>
	  </div>
	   <div class="panel panel-default">
	 
		  <div class="panel-title accordion-toggle clearfix" >
	   
			   <table class="col-md-12 table-bordered table-condensed text-center ">
			<tr>
					<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#three" class="indicator plus"><a class="plus_minus"></a></span></td>
				<td colspan="4">
				<div class="top-heading">Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel  ...</div> 
						<a class="btn btn-org pull-right">Online now</a>
				</td>
				
			</tr>
			<tr>
				<td><a href="#">Reviews Increases: + 22</a></td>
				<td>Stop Condition: Time (Remaining: 5 d : 6 h : 52 min)</td>
				<td><a href="#">Approved: Everyone Can Access</a></td>
				<td>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/chart.png') ?>"></a></span>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/stop.png') ?>"></a></span>
				</td>
				
			</tr>
				
				
			  
			</table> 
			
			
		
		 
		  </div>
	  
		<div id="three" class="panel-collapse collapse in">
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
				<td data-title="Product Title"> <p class="w400"	>Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel Weekend Overnight Bags - Large Duffle Sports/Gym Bag with Shoulder Straps. </p></td>
					
					<td data-title="Price" class="numeric" >$9.99</td>
					<td data-title="Launch Time" class="numeric">2015/12/12<br>18:00:00</td>
					<td data-title="End Time" class="numeric">2015/12/16 <br>18:00:00</td>
					<td data-title="Code Taken" class="numeric">-32</td>
					<td data-title="View Product" class="numeric">on DRC <br>on Amazon</td>
				</tr>
				</tbody>
		
			</table>
		  </div> <!-- no-more-tables -->
		  </div>
		  
		</div>
	  </div>  
	  
	  <div class="panel panel-default">
	 
		  <div class="panel-title accordion-toggle clearfix" >
			   <table class="col-md-12 table-bordered table-condensed text-center">
			<tr>
				<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#four" class="indicator plus"><a class="plus_minus"></a></span></td>
				<td colspan="4"><div class="top-heading">Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel  ...</div> <a class="btn btn-org pull-right">Online now</a></td>
				
			</tr>
			<tr>
				<td><a href="#">Reviews Increases: + 22</a></td>
				<td>Stop Condition: Time (Remaining: 5 d : 6 h : 52 min)</td>
				<td>Approved: Everyone Can Access</td>
				<td>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/chart.png') ?>"></a></span>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/stop.png') ?>"></a></span>
				</td>
				
			</tr>
			</table> 
		  </div>
	  
		<div id="four" class="panel-collapse collapse">
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
			<td data-title="Product Title"> <p class="w400"	>Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel Weekend Overnight Bags - Large Duffle Sports/Gym Bag with Shoulder Straps. </p></td>
					<td data-title="Price" class="numeric" >$9.99</td>
					<td data-title="Launch Time" class="numeric">2015/12/12<br>18:00:00</td>
					<td data-title="End Time" class="numeric">2015/12/16 <br>18:00:00</td>
					<td data-title="Code Taken" class="numeric">-32</td>
					<td data-title="View Product" class="numeric">on DRC <br>on Amazon</td>
				</tr>
				</tbody>
			</table>
		  </div> <!-- no-more-tables -->
		  </div>
		</div>
	  </div> <!-- panel panel-default -->
	
	  <hr>
	  <h5 class="tab-heading mb56">Product Expired:<span>7</span></h5>
	    <div class="panel panel-default expired_deals">
	 
		  <div class="panel-title accordion-toggle clearfix" >
			   <table class="col-md-12 table-bordered table-condensed text-center">
			<tr>
				<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#five" class="indicator plus"><a class="plus_minus"></a></span></td>
				<td colspan="4"><div class="top-heading">Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel  ...</div> <a class="btn btn-org pull-right expired">Expired</a></td>
				
			</tr>
			<tr>
				<td colspan="2"><a href="#">Reviews Increases: + 22</a></td>
				
				<td>Time Remaining: 0 d : 0 h : 0 min</td>
				<td>
				<div class="icons_set">
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/chart.png') ?>"></a></span>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/refresh.png') ?>"></a></span>
				</div>	
				</td>
				
			</tr>
			</table> 
		  </div>
	  
		<div id="five" class="panel-collapse collapse">
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
			<td data-title="Product Title"> <p class="w400"	>Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel Weekend Overnight Bags - Large Duffle Sports/Gym Bag with Shoulder Straps. </p></td>
					<td data-title="Price" class="numeric" >$9.99</td>
					<td data-title="Launch Time" class="numeric">2015/12/12<br>18:00:00</td>
					<td data-title="End Time" class="numeric">2015/12/16 <br>18:00:00</td>
					<td data-title="Code Taken" class="numeric">-32</td>
					<td data-title="View Product" class="numeric">on DRC <br>on Amazon</td>
				</tr>
				</tbody>
			</table>
		  </div> <!-- no-more-tables -->
		  </div>
		</div>
	  </div> <!-- panel panel-default -->
	  
	   <div class="panel panel-default expired_deals">
	 
		  <div class="panel-title accordion-toggle clearfix" >
			   <table class="col-md-12 table-bordered table-condensed text-center">
			<tr>
				<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#six" class="indicator plus"><a class="plus_minus"></a></span></td>
				<td colspan="4"><div class="top-heading">Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel  ...</div> <a class="btn btn-org pull-right expired">Expired</a></td>
				
			</tr>
			<tr>
				<td colspan="2"><a href="#">Reviews Increases: + 22</a></td>
				
				<td>Time Remaining: 0 d : 0 h : 0 min</td>
				<td>
					<div class="icons_set">
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/chart.png') ?>"></a></span>
					<span class="account_icon"><a href="#"><img src="<?php echo new_assets_url('img/refresh.png') ?>"></a></span>
					</div>
				</td>
				
			</tr>
			</table> 
		  </div>
	  
		<div id="six" class="panel-collapse collapse">
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
			<td data-title="Product Title"> <p class="w400"	>Carry On Lightweight Small Hand Luggage Cabin on Flight & Holdalls/Duffel Weekend Overnight Bags - Large Duffle Sports/Gym Bag with Shoulder Straps. </p></td>
					<td data-title="Price" class="numeric" >$9.99</td>
					<td data-title="Launch Time" class="numeric">2015/12/12<br>18:00:00</td>
					<td data-title="End Time" class="numeric">2015/12/16 <br>18:00:00</td>
					<td data-title="Code Taken" class="numeric">-32</td>
					<td data-title="View Product" class="numeric">on DRC <br>on Amazon</td>
				</tr>
				</tbody>
			</table>
		  </div> <!-- no-more-tables -->
		  </div>
		</div>
	  </div> <!-- panel panel-default -->
	  
	  <a href="#" class="load-more"><span>+</span> Show more</a>
	  
	</div> <!-- #accordion -->
		
		
		
		
		
		
		
		</div>
  </div>

</div>
			
			
		
		</div> <!-- my_account -->
		
		</div> <!-- content -->	
	<div class="clearfix"></div>
	</div>
</div> <!-- innerpage close -->

<script>

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