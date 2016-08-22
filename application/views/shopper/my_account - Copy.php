<?php //print_r($user); 
$getUsermata_category = getUsermata($user->id, 'category');
$getUsermata_amazon_name = getUsermata($user->id, 'amazon_name');       $getUsermata_amazon_name    = $getUsermata_amazon_name->mval;
$getUsermata_amazon_url = getUsermata($user->id, 'amazon_url');         $getUsermata_amazon_url     = $getUsermata_amazon_url->mval;
$getUsermata_receive_email = getUsermata($user->id, 'receive_email');   $getUsermata_receive_email  = $getUsermata_receive_email->mval;
$get_categories= unserialize($getUsermata_category->mval);

//print_r($get_categories);
//$get_category_details = get_category($get_category);
//echo $_GET['tab'];
if($_GET['tab'] == 'review_status')
{
    $show_tablist_1 = '';                           $show_tablist_2 = 'class="active"';
    $show_tabpanel_1 = 'class="tab-pane fade"';     $show_tabpanel_2 = 'class="tab-pane fade in active"';
}
else
{
    $show_tablist_2 = '';                           $show_tablist_1 = 'class="active"';
    $show_tabpanel_2 = 'class="tab-pane fade"';     $show_tabpanel_1 = 'class="tab-pane fade in active"';
}

?>
</div> <!-- landingbg -->
 <!-- [26]-My-Account.jpg -->

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
    <li role="presentation" <?php echo $show_tablist_1; ?>><a href="#my_account" aria-controls="home" role="tab" data-toggle="tab">My Account</a></li>
    <li role="presentation" <?php echo $show_tablist_2; ?>><a href="#my_product_review" aria-controls="profile" role="tab" data-toggle="tab">My Review Status</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel"  <?php echo $show_tabpanel_1; ?> id="my_account">
	
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
    <label for="inputPassword4" class="col-sm-5 control-label">Your Name on Amazon:</label>
    <div class="col-sm-7">
     <div class="existing_value"><?php echo $getUsermata_amazon_name; ?></div>
    </div>
  </div>
	
	<div class="form-group">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Amazon Public Profile Link:       </label>
    <div class="col-sm-7">
      <div class="existing_value">   <?php echo $getUsermata_amazon_url; ?></div>
    </div>
  </div>

  <div class="form-group select_one">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Corporation Name on Amazon:    </label>
		<div class="col-sm-7">
		<div class="existing_value"> 
			<div class="selected_cat"> 
            <?php
            $i=0;
            foreach ($get_categories as $get_category)
            {
                $get_category_details = get_category($get_category);
                if($i==0){echo  $get_category_details->name;}else{echo  ' <br> '.$get_category_details->name;}
                
                $i++;
            }
            ?>
          
            
            
			</div>
	
	</div>			
	</div>
  </div>
 
 <div class="form-group ">
    <label for="inputPassword3" class="col-sm-5 control-label">Receive Email from Dollar Review Club?             </label>
		<div class="col-sm-7">
		<div class="existing_value">  <?php if($getUsermata_receive_email == 'accepted'){echo 'Yes';} else{echo 'No';} ?></div>			
	</div>
  </div>
 
 
 
  <div class="form-group">
    <div class="col-sm-12 text-right">
      <button type="button" class="btn btn185_73" id="prepare_edit">Edit Account</button>
    </div>
  </div>
</form>	
	</div>
    
    
    
    
        <div role="tabpanel" class="tab-pane fade" id="my_account_edit">
	
	<form class="form-horizontal other_forms edit_account_form"  id="my_account_edit_form">
    <div id="my_account_edit_form_Alert"></div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label">Your Email address:</label>
    <div class="col-sm-7">
      <input type="email" class="form-control" id="inputEmail3" placeholder="testdollarreviewclub@google.com" value="<?php echo $user->email; ?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Password:</label>
    <div class="col-sm-7">
      <input type="password" class="form-control" name="pass" id="pass" placeholder="***********************">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputPassword4" class="col-sm-5 control-label">Re-Enter Your Password:</label>
    <div class="col-sm-7">
      <input type="password" class="form-control" name="cpass" id="cpass" placeholder="***********************">
    </div>
  </div>
	
	<div class="form-group">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Corporation Name on Amazon:    </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="amazon_name" name="amazon_name"  value="<?php echo $getUsermata_amazon_name; ?>" placeholder="***********************">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Amazon Public Profile Link:    </label>
    <div class="col-sm-7">
      <div class="existing_value"><?php echo $getUsermata_amazon_url; ?></div>
    </div>
  </div>

  <div class="form-group select_one edit-account-cat">
    <label for="inputPassword3" class="col-sm-5 control-label">Your Favourite Product Categories:   </label>
      <div class="col-sm-7">
		 <div class="add_cat">
			<div class="form-group selectoption">
            <?php
            $ids = '';
            foreach ($get_categories as $get_category)
            {
                if($ids == ''){$ids = $get_category;}else{$ids .= ','.$get_category;}
            }//disabled="disabled"
            if(count($get_categories)>=3){$disabled='disabled="disabled"';}else{$disabled='';} ?>
<select class="form-control cat_control" name ="fav_cat" id ="fav_cat" placeholder="Choose Category" <?php echo $disabled; ?> >
						<option value="">Choose category</option>
                        <?php
                             foreach (get_categories_list() as $cat) {
                                if(in_array($cat->cid, $get_categories)){$disabled='disabled="disabled"';}else{$disabled='';} 
                        ?>
                             <option value="<?php echo $cat->cid; ?>" <?php echo $disabled; ?>><?php echo $cat->name; ?></option>
                        <?php
                             }
                        ?>
					</select>
                     <input type="hidden" id="selected_val" name="selected_val" value="<?php echo $ids; ?>" />
					<input type="button" class="add" value="ADD">
			</div>
			
				<div class="clearfix"></div>
				<div class="selected_items">
                
                
                <?php
            foreach ($get_categories as $get_category)
            {
                $get_category_details = get_category($get_category);
                echo '<div id="'.$get_category_details->cid.'"><span class="remove_item"></span><span class="sel_val">'.$get_category_details->name.'</span></div>';
                
            }
            ?>
            </div>
				
			</div> <!-- add_cat close -->
		</div>
  </div>
  
 
 
 <div class="form-group ">
    <label for=" " class="col-sm-5 control-label">Receive Email from Dollar Review Club?</label>
    <div class="col-sm-7">
		<div class="checkbox-btm">
			<div class="radio">
					<input type="radio" id="c1" value="accepted" <?php if($getUsermata_receive_email == 'accepted'){echo 'checked="checked"';} ?> name="receive_email">
					<label class="control-label" for="c1"><span></span>Yes</label>
			</div>
			<div class="radio">
					<input type="radio" id="c2" value="notaccepted" <?php if($getUsermata_receive_email != 'accepted'){echo 'checked="checked"';} ?> name="receive_email">
					<label class="control-label" for="c2"><span></span>No</label>
			</div>
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
    <div role="tabpanel"  <?php echo $show_tabpanel_2; ?> id="my_product_review">
			<p>my product review</p>
			<p>my product review</p>
			<p>my product review</p>
			<p>my product review</p>
			<p>my product review</p>
			<p>my product review</p>
			<p>my product review</p>
			<p>my product review</p>
			<p>my product review</p>
			<p>my product review</p>
	
	</div>
  </div>

</div>
			
			
		
		</div> <!-- my_account -->
		
		</div> <!-- w900 -->
		</div> <!-- content -->	
	<div class="clearfix"></div>
	</div>
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

</script>