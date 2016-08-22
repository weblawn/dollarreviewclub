</div>

<link rel="stylesheet" href="<?php echo new_assets_url('css/jquery.multiselect.css') ?>" type="text/css"/>

<script src="<?php echo new_assets_url('js/jquery.multiselect.js') ?>"></script>


<div class="contentbox page">
	<div class="container">
		<h1 class="page-title">Sign Up as Customer</h1>
		
	<div class="content">
       
		<div class="stepwizard_setup"> 

  <!--first step start here-->
<form role="form" id="sellerForm" class="other_forms">
	<div id="rootwizard-customer">
		<ul class="">	  	
			<li class=""><a href="#tab1" data-toggle="tab" >1</a>
			
			<span>Account Information</span></li>
			<li><a href="#tab2" data-toggle="tab">2</a>
				<span>Your Amazon Account<br>authorization</span>
			</li>
			<li><a href="#tab3" data-toggle="tab" >3</a>
			
			<span>Receive Email Confirmation</span>
					</li>
		</ul>
	<div class="tab-content">
    
    <div id="signup_shopper_form_Alert"></div>
			<!--start first step-->
<div class="tab-pane" id="tab1">

		<div class="first_step">  
          <div class="form-group">
            <label class="control-label">Your Email</label>
            <input  maxlength="100" type="email" class="form-control" placeholder="" name="email" />
          </div>
          <div class="form-group">
            <label class="control-label">Password (must be between 8 to 20 character)</label>
            <input maxlength="100" type="password" class="form-control" placeholder="" id ="pwd" name="pass"/>
          </div>
		  <div class="form-group">
            <label class="control-label">Re-Enter Password</label>
            <input maxlength="100" type="password" class="form-control" placeholder="" name="con_pass"/>
          </div>

			<?php /*<div class="add_cat">
			<div class="form-group selectoption w88">
				<label for="pro_cat">Choose your favourite product categories (3 at the most)</label>
					<select class="form-control cat_control" name ="fav_cat" id ="fav_cat" placeholder="Choose Category">
						<option value="">Choose category</option>
                        <?php
                             foreach (get_categories_list() as $cat) {
                        ?>
                             <option value="<?php echo $cat->cid; ?>"><?php echo $cat->name; ?></option>
                        <?php
                             }
                        ?>
					</select>
                                <input type="hidden" id="selected_val" name="selected_val" />
			</div>
			
			<div class="form-group selectoption w22">
				<label for="" >&nbsp;</label>
				<div class="clearfix"></div>
				<input type="button" class="add" value="ADD">
			</div>	
				<div class="clearfix"></div>
				<div class="selected_items"></div>
				
			</div> <!-- add_cat close -->*/?>

			<div class="add_cat">
			<div class="form-group selectoption">
				<label for="pro_cat">Choose your favourite product categories (3 at the most)</label>
					<select class="form-control cat_control" name ="fav_cat" id ="fav_cat" multiple="multiple" placeholder="Choose Category">
                        <?php
                             foreach (get_categories_list() as $cat) {
                        ?>
                             <option value="<?php echo $cat->cid; ?>"><?php echo $cat->name; ?></option>
                        <?php
                             }
                        ?>
					</select>
                                <input type="hidden" id="selected_val" name="selected_val" />
			</div>
			
			<?php /* <div class="form-group selectoption w22">
				<label for="" >&nbsp;</label>
				<div class="clearfix"></div>
				<input type="button" class="add" value="ADD">
			</div>	*/ ?>
				<div class="clearfix"></div>
				<div class="selected_items"></div>
				
			</div> <!-- add_cat close -->
            <script>
$('#fav_cat').multiselect({
    columns: 1,
    placeholder: 'Choose category',
    maxSelect: 3
});

</script>
		
			<div class="checkbox">
				<input type="checkbox" name="receive_email" id="receive_email" value="accepted">
				<label for="receive_email">
					<span></span>
				<p class="tnc">I want to receive discount deals information from Dollar Review Club via Email.</p>
				</label>
			</div>
			
			<div class="checkbox">
				<input type="checkbox" name="terms" id="terms" value="accepted">
				<label for="terms">
					<span></span>
				<p class="tnc">Signing up means that you have read and agreed to Dollar Review
						Club <a href="<?php echo base_url('pages/terms'); ?>" target="_blank">Terms</a> and <a href="<?php echo base_url('pages/privacy'); ?>" target="_blank">Privacy Policy.</a></p>
				</label>
			</div>
			
			
        
          
		</div> 
		 <div class="clearfix"></div>
  </div>
	<!--first step close here-->
	<!--second step start here-->
			<div class="tab-pane step2" id="tab2">
					<div class="form-group">
					<label class="control-label">Your Name on Amazon</label>
					<input maxlength="200" type="text" required="required" class="form-control" placeholder="" name="amazon_name" id="amazon_name"/>
				  </div>
                  <div class="form-group ">
					<label class="control-label">Your Amazon Public Profile Link <a data-toggle="modal" data-target="#myModal_amazon"> What's this?</a></label>
					<div >
                        <div class="form-group">
                        <label class="control-label col-sm-5 amazon-link" for="email"> https://www.amazon.com/gp/profile/ </label>
                        <div class="col-sm-7">
                        <input maxlength="200" type="text" class="form-control verify_control amazon-link-number" placeholder="ABRCGPL3IJMLS" id="amazon_link" name="amazon_link"/>
                        </div>
                        </div>
                        <span></span>
    					
    					<input maxlength="200" type="hidden" class="form-control verify_control"  id="amazon_link_marge" name="amazon_link_marge" />
                        
                        
                        <input type="hidden" id="amazon_profile_status" name="amazon_profile_status" value="true"/>
                        <input type="hidden" id="amazon_profile_vote" name="amazon_profile_vote" value="0"/>
                        <input type="hidden" id="amazon_profile_rank" name="amazon_profile_rank" value="0"/>
                        <input type="hidden" id="amazon_profile_ajax_url" name="amazon_profile_ajax_url" value="<?php echo base_url('user/amazon_profile_verify'); ?>"/>
					</div>
					</div>
                  
                  <!-- Modal -->
<div class="modal fade amazon_pro_link" id="myModal_amazon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
   <div class="modal-body">
    <h1>Your Amazon Public Profile Link</h1>
    <p>Your Amazon Public Profile Link is required for you to be eligible to review the products for great 
     discounts on Dollar Review Club.</p>
    <h3><span>1.</span> Log into<a href="http://www.amazon.com/" target="_blank"> www.amazon.com</a>, and click "Your Account" at the top menu.</h3> 
    <img src="<?php echo new_assets_url('img/account_img.jpg') ?>" alt="" class="img-responsive">
    <h3><span>2.</span> Now you're in "Your Account" page. Scroll down to the section "Personalization" and click "Your 
     Public Profile" below "Community".<h3>
     <img src="<?php echo new_assets_url('img/person.jpg') ?>" alt="" class="img-responsive">
    <h3><span> 3. </span>Go to the URL link on the top of browser page. Be sure to contain ID only.</h3>
    <img src="<?php echo new_assets_url('img/preview-full-sss.JPG') ?>" alt="" class="img-responsive">
   </div> <!-- model body -->
  </div>
  </div>
</div>

<!-- Modal -->
				  <?php /*<div class="form-group ">
					<label class="control-label">Your Amazon Public Profile Link <a data-toggle="modal" data-target="#myModal_amazon"> What's this?</a></label>
					<div class=""><?php /*w80s
					<input maxlength="200" type="text" class="form-control verify_control" placeholder="https://www.amazon.com/gp/profile/ABRCGPL3IJMLS" id="amazon_link" name="amazon_link" />
                    <input type="hidden" id="amazon_profile_status" name="amazon_profile_status" value="true"/>
                    <input type="hidden" id="amazon_profile_vote" name="amazon_profile_vote" value="0"/>
                    <input type="hidden" id="amazon_profile_rank" name="amazon_profile_rank" value="0"/>
                    <input type="hidden" id="amazon_profile_ajax_url" name="amazon_profile_ajax_url" value="<?php echo base_url('user/amazon_profile_verify'); ?>"/>
					</div>
					<div class="verify w22">
					  <button class="btn btn-org" type="button" style="display: none;" onclick="amazon_profile_verify();" >Verify</button>
					 
					  
					  <!-- Modal -->
<div class="modal fade amazon_pro_link" id="myModal_amazon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
   <div class="modal-body">
    <h1>Your Amazon Public Profile Link</h1>
    <p>Your Amazon Public Profile Link is required for you to be eligible to review the products for great 
     discounts on Dollar Review Club.</p>
    <h3><span>1.</span> Log into<a href="http://www.amazon.com/" target="_blank"> www.amazon.com</a>, and click "Your Account" at the top menu.</h3> 
    <img src="<?php echo new_assets_url('img/account_img.jpg') ?>" alt="" class="img-responsive">
    <h3><span>2.</span> Now you're in "Your Account" page. Scroll down to the section "Personalization" and click "Your 
     Public Profile" below "Community".<h3>
     <img src="<?php echo new_assets_url('img/person.jpg') ?>" alt="" class="img-responsive">
    <h3><span> 3. </span>Copy the URL link on the top of browser page. Be sure to contain www.amazon.com & ID at the end.</h3>
    <img src="<?php echo new_assets_url('img/link_img.jpg') ?>" alt="" class="img-responsive">
   </div> <!-- model body -->
  </div>
  </div>
</div>

<!-- Modal -->
					</div>
				  </div>*/?>
				<div class="clearfix"></div>
				
				  <p class="dark" data-toggle="modal" data-target="#myModal2">Q: Why should I provide my Amazon Account to Dollar Review Club?</p>
				  <p>Note: You cannot change your Amazon Public Profile Link after signing up.</p>
				     
			</div>
			
								  <!-- Modal -->
<div class="modal fade amazon_pro_link" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
   <div class="modal-body">
    <h1>Provide My Amazon Account to Dollar Review Club</h1>
    <p>Proving your Amazon Account to Dollar Review Club is necessary to prevent fake accounts from signing up. We strive to maintain the highest quality and great interaction between you, the seller and us.</p>

    <p>Note: You COULDN'T change the Amazon Account information after signing up.</p>


   </div> <!-- model body -->
  </div>
  </div>
</div>
    
	<!--second step close  here-->
	<!--third step start here-->
		<div class="tab-pane step3" id="tab3">
					
			<div class="col-md-12">
				<h2>Thank You for Registering!</h2>
				<p>Please check your email for a confirmation request with a link that will 
					confirm your account. Once you click the link, your registration as 
					customer on Dollar Review Club will be completed.</p>
			<a href="<?php echo base_url('home'); ?>">  <button class="btn btn-success btn-lg pull-right" type="button" style="background-color: #ff813d!important; border-color: #ff813d!important; border-radius: 0px!important;">Back to Homepage</button></a>
			</div>
		</div>
 <!--third stap close here-->
 
 <div class="clearfix"></div>
		<ul class="nav-btn pager wizard clearfix">
			<li class="next"><a class="btn btn-org">Next</a></li>
		</ul>
	</div>	
</form>
<input type="hidden" name="ajax_url" class="form-control" id="ajax_url" value="<?php echo site_url('user/signup_valid/shopper'); ?>"/>
<input type="hidden" name="1st_step_ajax_url" class="form-control" id="1st_step_ajax_url" value="<?php echo site_url('user/signup_valid/shopper_1st_step'); ?>"/>
            <input type="hidden" name="current_step" class="form-control" id="current_step" value="1"/>
	</div>
	</div>
</div>
</div>
</div>
<div class="clearfix"></div>