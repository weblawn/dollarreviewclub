
<?php //print_r($user); 
$getUsermata_category = getUsermata($user->id, 'category');
$getUsermata_amazon_name = getUsermata($user->id, 'amazon_name');       $getUsermata_amazon_name    = $getUsermata_amazon_name->mval;
$getUsermata_amazon_url = getUsermata($user->id, 'amazon_url');         $getUsermata_amazon_url     = $getUsermata_amazon_url->mval;
$getUsermata_receive_email = getUsermata($user->id, 'receive_email');   $getUsermata_receive_email  = $getUsermata_receive_email->mval;
$get_categories= unserialize($getUsermata_category->mval);

//print_r($get_categories);
//$get_category_details = get_category($get_category);
//echo $_GET['tab'];
                
    $show_tablist_2 = 'class="active"';    
    $show_tabpanel_2 = 'class="tab-pane fade in active"';


?>
</div> <!-- landingbg -->
<style>
.my_account li {
    border-right: none;
}
.my_account li:last-child {
    padding: 0px;
}
</style>
<!-- [28] -->

<div class="innerpage review_page">
<div class="contentbox page">
	
	<div class="container">
		<div class="content page-shadow page">
		
		
			<div class="my_account">
		
			

  <!-- Nav tabs -->
  <ul class="nav nav-tabs my_account_tabs" role="tablist">
    <li role="presentation" ><a href="<?php echo site_url('backend/shopper') ?>"  >Back to list</a></li>
    <li role="presentation" <?php echo $show_tablist_2; ?>><a href="#my_product_review" aria-controls="profile" role="tab" data-toggle="tab" >My Review Status</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  
	
    
	
    
    
    
    
    
    
    
	
	
	
		<div role="tabpanel"   <?php echo $show_tabpanel_2; ?>  id="my_product_review">
			<h1 class="page-title">My Review Status</h1>
            <p class="b-btm-title">Discount Quota Remains: <span><?php echo $quota; ?></span></p>
		<?php 
        //echo $unfinished_review;
            //print_r($unfinished_review);
            if($unfinished_review == 'false')
            {
                $count_unfinished_review = 0;
            }
            else
            {
                $count_unfinished_review = count($unfinished_review);
            }
            /*echo "</br>";
            print_r($finished_review);*/
        
        ?>
		
		<h5 class="tab-heading tab-heading-medium">Unfinished Product Reviews:<span><?php echo $count_unfinished_review; ?></span></h5>
		<div class="panel-group" id="accordion">




<?php
      foreach($unfinished_review as $single)
      {
        //print_r($single);
        $product_id= 0; $customer_id= 0; $seller_id= 0; $promo_code= 0; $date= 0; $text=''; $color=''; $onclick = '';
        $product_id = $single->product_id; $customer_id = $single->customer_id; $seller_id = $single->seller_id; $sl_id = $single->id;
        $isUsed = true;
        $code_details = get_promo_codes_by_id($single->promo_id,$isUsed);
        $product_details = get_product_details($product_id);
        $promo_code = $code_details->promo_code;$date = date('Y/m/d',strtotime($single->date));
        

        
        //print_r($code_details);
        if($single->seller_approve_status == 'pending')
        {
            $text = 'Waiting for Approval';
            $color = 'gray';
        }
        else if($single->code_taken == 'yes')
        {
        $claim_date = $single->date;
        $getUsermata_amazon_url = getUsermata($customer_id, 'amazon_url');         $getUsermata_amazon_url     = $getUsermata_amazon_url->mval;
        //echo $getUsermata_amazon_url;
        $getUsermata_amazon_id = explode('profile/',$getUsermata_amazon_url);
        //print_r($getUsermata_amazon_id);
        $User_amazon_id = $getUsermata_amazon_id[1];
        $product_asin = $product_details->asin;
        
        
            $text = 'Check My Review';
            //$onclick = "checkmyreview('".$customer_id."','".$sl_id."','".$claim_date."','".$User_amazon_id."','".$product_asin."')";
        }
        else if($single->code_taken == 'no')
        {
            if($product_details->review_suggetion_type == 'review_suggetion_none')
            {
                $review_suggestion_text = '- None';
            }
            else
            {
                $review_suggestion = unserialize($product_details->review_suggetion_type);
                if($review_suggestion['0'] == 'review_suggetion_custom')
                {
                    $review_suggestion_text = '- '.$product_details->review_suggetion.' words or above';
                }
                else if($review_suggestion['0'] == 'review_suggetion_video')
                {
                    $review_suggestion_text = '- At least 1 photo and/or video';
                }
                
                if($review_suggestion['1'] == 'review_suggetion_custom')
                {
                    $review_suggestion_text .= '</br>- '.$product_details->review_suggetion.' words or above';
                }
                else if($review_suggestion['1'] == 'review_suggetion_video')
                {
                    $review_suggestion_text .= '</br>- At least 1 photo and/or video';
                }
                
            }
            $text = 'Get Discount code';
            //$onclick = "get_approved_discount_code('".$review_suggestion_text."','".$product_id."','".$sl_id."')";
        }
        if($single->id == $_GET['tab_list'])
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
            <div class="panel panel-default expired_deals" id="<?php echo 'tab_list_'.$single->id; ?>">
	 
		  <div class="panel-title accordion-toggle clearfix" >
	   
			   <table class="col-md-12 table-bordered table-condensed text-center ">
			<tr>
					<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'list_'.$single->id; ?>" class="indicator plus <?php echo $parent_class;?>"><a class="plus_minus"></a></span></td>
				<td colspan="4">
				<div class="top-heading"><?php echo the_excerpt($product_details->name,'0','75'); ?></div> 
						<a class="btn btn-org pull-right <?php echo $color; ?>" onclick="<?php echo $onclick; ?>" id="<?php echo 'button_id_'.$sl_id; ?>"><?php echo $text; ?></a>
				</td>
			</tr>
              </table> 
		  </div>
	  
		<div id="<?php echo 'list_'.$single->id; ?>" class="panel-collapse <?php echo $child_class;?>">
		  <div class="panel-body">
		   <div id="no-more-tables">
			<table class="table-bordered w100 table-condensed table-striped-column text-center  cf">
			<thead class="cf text-center">	
				<tr>
					<th class="numeric w37per">Product Title</th>
					<th class="numeric">Price</th>
					<th class="numeric">Get Discount Date</th>
					<th class="numeric">Discount code</th>
					<th class="numeric">View Product</th>
				</tr>
			</thead>	
				<tbody>
				<tr>
				<td data-title="Product Title"> <p class="w400"	><?php echo $product_details->name; ?></p></td>					
					<td data-title="Price" class="numeric" >$<?php echo $product_details->discount_price; ?></td>
					<td data-title="Get Discount Date" class="numeric"><?php echo $date; ?></td>
					<td data-title="Discount code" class="numeric"  id="<?php echo 'promocode_area_id_'.$sl_id; ?>"><?php echo $promo_code; ?></td>
                    <td data-title="View Product" class="numeric"><a onclick="get_product_details('<?php echo $product_details->pid; ?>')" data-toggle="modal" data-target="#myModal" style="cursor: pointer;">on DRC</a><br><a href="<?php echo $product_details->aws_url; ?>" target="_blank">on Amazon</a></td>
				</tr>
				</tbody>
			</table>
		  </div> <!-- no-more-tables -->
		  </div>
		  
		</div>
	  </div> 
           
           
           <?php
           }
           if($finished_review == 'false')
            {
                $count_finished_review = 0;
            }
            else
            {
                $count_finished_review = count($finished_review);
            }
           ?> 

	  <hr>
	  <h5 class="tab-heading mb56">Finished Product Reviews:<span><?php echo $count_finished_review; ?></span></h5>
      
      <?php
      foreach($finished_review as $single)
      {
        $product_id= 0; $customer_id= 0; $seller_id= 0; $promo_code= 0; $date= 0;
        $product_id = $single->product_id; $customer_id = $single->customer_id; $seller_id = $single->seller_id; $sl_id = $single->id;
        //echo $single->promo_id;
        $isUsed = true;
        $code_details = get_promo_codes_by_id($single->promo_id,$isUsed);
        $product_details = get_product_details($product_id);
        $promo_code = $code_details->promo_code;$date = date('Y/m/d',strtotime($single->date));
        //print_r($code_details);//print_r($single);
        //var_dump($code_details);
        if($single->seller_approve_status == 'auto_reject'){$text_show = 'No Reply from seller, Quota Returns to You !';}
        else if($single->seller_approve_status != 'disapprove'){$text_show = 'Approved !';}else{$text_show = 'Disapproved !';}
        
        if($single->id == $_GET['tab_list'])
        {
            $parent_class = '';
            $child_class = 'collapse in';
        }
        else
        {
            $parent_class = 'collapsed';
            $child_class = 'collapse';
        }
        $getUsermata_amazon_url = getUsermata($single->customer_id, 'amazon_url');       $getUsermata_amazon_url    = $getUsermata_amazon_url->mval;
                
        //print_r($single);
      ?>
            <div class="panel panel-default expired_deals finished_review" id="<?php echo 'tab_list_'.$single->id; ?>">
	 
		  <div class="panel-title accordion-toggle clearfix" >
	   
			   <table class="col-md-12 table-bordered table-condensed text-center ">
			<tr>
					<td rowspan="2" class="gray-box" ><span data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'list_'.$single->id; ?>" class="indicator plus <?php echo $parent_class; ?>"><a class="plus_minus"></a></span></td>
				<td colspan="4">
				<div class="top-heading"><?php echo the_excerpt($product_details->name,'0','75'); ?></div> 
						<a class="btn btn-org pull-right gray"><?php echo $text_show; ?></a>
				</td>
			</tr>
              </table> 
		  </div>
	  
		<div id="<?php echo 'list_'.$single->id; ?>" class="panel-collapse <?php echo $child_class; ?>">
		  <div class="panel-body">
		   <div id="no-more-tables">
			<table class="table-bordered w100 table-condensed table-striped-column text-center  cf">
			<thead class="cf text-center">	
				<tr>
					<th class="numeric w37per">Product Title</th>
					<th class="numeric">Price</th>
					<th class="numeric">Get Discount Date</th>
					<th class="numeric">Discount code</th>
					<th class="numeric">View Product</th>
				</tr>
			</thead>	
				<tbody>
				<tr>
				<td data-title="Product Title"> <p class="w400"	><?php echo $product_details->name; ?></p></td>					
					<td data-title="Price" class="numeric" >$<?php echo $product_details->discount_price; ?></td>
					<td data-title="Get Discount Date" class="numeric"><?php echo $date; ?></td>
					<td data-title="Discount code" class="numeric"><?php echo $promo_code; ?></td>
                    <td data-title="View Product" class="numeric"><a onclick="get_product_details('<?php echo $product_details->pid; ?>')" data-toggle="modal" data-target="#myModal" style="cursor: pointer;">on DRC</a><br><a href="<?php echo $product_details->aws_url; ?>" target="_blank">on Amazon</a></td>
				</tr>
				</tbody>
			</table>
		  </div> <!-- no-more-tables -->
          
          <?php
          $html = '';
          for($j=1;$j<=$single->review_rating;$j++)
                            {
                               $html .= '<li><img src="'.new_assets_url('img/star.png').'"></li>'; 
                            }
          ?>
		   <div id="no-more-tables">
			<table class="table-bordered w100 table-condensed table-striped-column text-center  cf">
			<thead class="cf text-center">	
				<tr>
					<th class="numeric w37per">Review</th>
					<th class="numeric">Rating</th>
					<th class="numeric">Date</th>
					<th class="numeric">Profile</th>
					<th class="numeric">Review Link</th>
				</tr>
			</thead>	
				<tbody>
				<tr>
				<td data-title="Review"> <p class="w400"	><?php echo $single->review_content; ?></p></td>					
					<td data-title="Rating" ><ul class="stars"><?php echo $html; ?></ul></td>
					<td data-title="Date" ><?php echo date('Y-m-d',$single->review_date); ?></td>
					<td data-title="Profile" ><a href="<?php echo $getUsermata_amazon_url; ?>" target="_blank"><img src=" <?php echo new_assets_url('img/user_icon.png'); ?>" /></a></td>
                    <td data-title="Review Link" ><a href="<?php echo $single->review_url; ?>" target="_blank"><img src=" <?php echo new_assets_url('img/up_arrow.png'); ?>" /></a></td>
				</tr>
				</tbody>
			</table>
		  </div> <!-- no-more-tables -->
          
          
		  </div>
		  
		</div>
	  </div> 
           
           
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

<!--  Review Check Pass -->
<div class="modal fade sm-popup text-center" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-body">
    <h3>Review Approved!</h3>
    <p>Your review of this product has been approved! 
We appreciate you taking the time to write this decent review.
Now you will receive +1 points back to enjoy getting more discount products.</p>

  <button type="submit" class="btn btn-default smt-btn" data-dismiss="modal">OK</button>
  


   </div> <!-- model body -->
  </div>
  </div>
</div>

<!--  Review Check Fail -->
<div class="modal fade sm-popup text-center" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-body">
    <h3>Review Unapproved</h3>
    <p>We are sorry but your review has not passed the check.
Please check again to see if you have left a review on Amazon or you may use other member's Amazon profile link and it is prohibited to use it without owning it. </p>

  <button type="submit" class="btn btn-default smt-btn" data-dismiss="modal">OK</button>
  


   </div> <!-- model body -->
  </div>
  </div>
</div>
<script>
function checkmyreview(cid,sl_id,date,profile,product)
{       
var ajaxReqData = {cid: cid,sl_id: sl_id,date: date,profile: profile,product: product,action: "get_review_list_fn"};
	
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/get_review_list_fn'); ?>", 
			dataType		: 'json',
			data			: ajaxReqData,
                beforeSend: function() {
                    jQuery('#button_id_'+sl_id).html('Please wait...');
                },
           
                success: function(r) {
                    if(r.msg == 'Fail')
                    {
                        $('#myModal5').modal('toggle');
                        jQuery('#button_id_'+sl_id).html('Check my Review');
                    }
                    else if(r.msg == 'Success')
                    {
                        $('#myModal3').modal('toggle');
                        jQuery('#button_id_'+sl_id).html('Review pass');
                        jQuery('#button_id_'+sl_id).attr('onclick','');
                    }
                }
		});
        
         //setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 2000);
	}
    
jQuery('.finished_review').hide();
    finished_review = jQuery(".finished_review").size();
    x=10;
    jQuery('.finished_review:lt('+x+')').show();
    jQuery('#loadMore').click(function () {
        x= (x+10 <= finished_review) ? x+10 : finished_review;
        jQuery('.finished_review:lt('+x+')').show();
        if(x == finished_review)
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
			url 			:"<?php echo site_url('shopper/update_my_account'); ?>", 
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

function get_approved_discount_code(data,pid,arid)
{
   $('#code_access_type').val('manual');
   $('#review_suggest_list').html(data);
   $('#product_id_for_code').val(pid);
   $('#update_approve_request_id').val(arid);
   $('#myModal51').modal('toggle');
   
}


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