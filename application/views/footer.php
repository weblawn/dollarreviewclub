<script>
 function close_popup()
 {
    jQuery('#popup_content').hide();
    jQuery('.modal').hide();
    jQuery('.modal-backdrop').remove();
    jQuery('.modal').removeClass("in");
    jQuery('body').removeAttr( "class" );
    jQuery('body').removeAttr( "style" );
 }
 
  function add_class_to_body()
 {
    setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 1000);
 }
 
 </script>
 <!-- login or signup Modal -->
<div class="modal fade loginArea " id="login_signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
	 <?php /* <button type="button" class="close" data-dismiss="modal" aria-label="Close" style=" z-index: 999999; ">Close</button> */ ?>
      <div class="modal-body clearfix">
      <div class="col-md-6 login">
		<h3 id="form_title">Login</h3>
		<form class="contact_us" method="post" action="#" id="login_form">
        
    <div id="login_form_Alert" style="display: none;"><?php if( $verify[0] == true){echo $verify[1];}else { echo '<div class="alert alert-danger" style="">Please check login details are invalid!</div>';} ?></div>
			  <div class="form-group forget_pwd">
				<input type="text" class="form-control" id="email" name="email" placeholder="Your email address">
				<?php /* <a class=""  data-dismiss="modal" data-toggle="modal" data-target="#myModal800" style="cursor: pointer;" ><?php echo 'Miss Verifying Email?'; ?></a> */ ?>
			  </div>
	
<div class="form-group forget_pwd">
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				<a class=""  data-dismiss="modal" data-toggle="modal" data-target="#myModal80" style="cursor: pointer;" ><?php echo lang('forget') ?></a>
			  </div>
			  	<div class="formbox">
		<div class="checkbox"><input type="checkbox" id="rememberme" name="rememberme">
				<label for="rememberme"><span></span>Remember me next time</label>
                <a class=""  data-dismiss="modal" data-toggle="modal" data-target="#myModal800" style="cursor: pointer; float: right; color: #787885;"><?php echo 'Miss Verifying Email?'; ?></a>
          </div>
	</div>
	
			  <button type="submit" class="btn btn-default smt-btn">Login</button>
			</form>
            
            <!--------------------------------Customer/Shopper from start here------------------------------------------->
		<form class="contact_us" method="post" action="#" id="signup_Customer_form" style="display: none;">
        
    <div id="signup_Customer_form_Alert" style="display: none;"><div class="alert alert-danger" style="">Please check login details are invalid!</div></div>
			  <div class="form-group">
				<input type="text" placeholder="<?php echo lang('first') ?>" class="form-control required" name="firstname" required="" id="FBfirst_name" autocomplete="off">
			  </div>

              <div class="form-group">
				<input type="text" placeholder="<?php echo lang('last') ?>" class="form-control required" name="lastname" required="" id="FBlast_name" autocomplete="off">
			  </div>
              
              <div class="form-group">
				<input type="text" placeholder="<?php echo lang('email_placeholder') ?>" class="form-control required" name="email" required="" id="FBemail" autocomplete="off">
			  </div>
              
              <div class="form-group">
				<input type="password" title="<?php echo lang('password_title') ?>" pattern=".{8,}" placeholder="<?php echo lang('password_placeholder') ?>" name="password" id="password" class="form-control required" required="" autocomplete="off">
			  </div>
                

			  	<div class="formbox">
		<div class="checkbox">
        
                <div class="form-group" id="signup_Customer_form_recaptcha">
                
                    <?php echo $recaptcha; ?>
                </div>
          </div>
	</div>
                
	
			  <button type="submit" class="btn btn-default smt-btn">Submit</button>
			</form>
            
            
            
            <!--------------------------------Seller/Company from start here------------------------------------------->
		<form class="contact_us" method="post" action="#" id="signup_Seller_form" style="display: none;">
        
    <div id="signup_Seller_form_Alert" style="display: none;"><div class="alert alert-danger" style="">Please check login details are invalid!</div></div>
			   <div class="form-group">
				<input type="text"  placeholder="<?php echo lang('business_name_placeholder') ?>" class="form-control required" name="business_name" required="" id="business_name" autocomplete="off">
			  </div>

              <div class="form-group">
				<input type="text"  placeholder="<?php echo lang('first') . " " . lang('name') ?>" class="form-control required" name="first_name" required="" id="first_name" autocomplete="off">
			  </div>
              
              <div class="form-group">
				<input type="text"  placeholder="<?php echo lang('last') . " " . lang('name') ?>" class="form-control required" name="last_name" required="" id="last_name" autocomplete="off">
			  </div>
              
              <div class="form-group">
				<input type="text"  placeholder="(242) 424-2424" class="form-control required" name="phone_number" required="" id="phone_number" autocomplete="off">
			  </div>
              
              <div class="form-group">
				<input type="text"  placeholder="<?php echo lang('email_placeholder') ?>" class="form-control required" name="email" required="" id="email" autocomplete="off">
			  </div>
              
              <div class="form-group">
				<input type="password" title="<?php echo lang('password_title') ?>" pattern=".{8,}" placeholder="<?php echo lang('password_placeholder') ?>" class="form-control required" name="password" required="" id="password" autocomplete="off">
			  </div>
                

			  	<div class="formbox">
		<div class="checkbox">
        
                <div class="form-group" id="signup_Seller_form_recaptcha">
                
                    <?php echo $recaptcha2; ?>
                </div>
          </div>
	</div>
                
	
			  <button type="submit" class="btn btn-default smt-btn">Submit</button>
			</form>
            
            
	  </div>
	  
	  
      <div class="col-md-6 signup">
		<div class="light-blue">
		<h3>Sign up Now!</h3>
			<p>Sign up now to begin your discount and review journey on Dollar Review Club!</p>
		</div>
	  
	  <div class="sign-up-btns">
	  <p>If you're looking for great discounts and give decent reviews:</p>
	  <a href="<?php echo base_url('user/signup/shopper'); ?>" class="btn gray-btn" id="call_Customer">Sign up as Customer</a>
	 <p> If you're willing to provide product discount to receive more reviews on Amazon:</p>
	  <a href="<?php echo base_url('user/signup/company'); ?>" class="btn gray-btn" id="call_Seller">Sign up as Seller</a>
	 <?php /* <p> If you're member:</p>
	  <a class="btn gray-btn" id="call_login">Login Here</a> */ ?>
	  </div>
	  </div>
      </div>
      
    </div>
  </div>
</div>

  
<!-- Enter email for forgot password -->
<div class="modal fade sm-popup text-center fgp-popup" id="myModal80" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body clearfix">
      <div class="login">
		<h3>Please Enter your Email below</h3>
		<form class="contact_us" id="forgot_password_email_form">
			  <div class="form-group">
				<input type="email" class="form-control" name="forgot_password_email" id="forgot_password_email" placeholder="Your email">
			  </div>
	
			  <div class="form-group forget_pwd">
				<input type="email" class="form-control" name="forgot_password_cnf_email" id="forgot_password_cnf_email" placeholder="Re-Enter your Email">
			  </div>
			  	
			  <button type="submit" class="btn btn-default smt-btn" >Submit</button>
			</form>
	  </div>
	  
	  
     
      </div>
      
    </div>
  </div>
</div>
  
<!-- Enter email for resend verifying email -->
<div class="modal fade sm-popup text-center fgp-popup" id="myModal800" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body clearfix">
      <div class="login">
		<h3>Please Enter your Email below</h3>
		<form class="contact_us" id="resend_verifying_email_form">
			  <div class="form-group">
				<input type="email" class="form-control" name="resend_verifying_email" id="resend_verifying_email" placeholder="Your email">
			  </div>
			  	
			  <button type="submit" class="btn btn-default smt-btn" >Submit</button>
			</form>
	  </div>
	  
	  
     
      </div>
      
    </div>
  </div>
</div>


<!-- Wrong email for forgot password -->
	
		<div class="modal fade sm-popup text-center" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-body">
    <h3>Wrong Email</h3>
    <p>The Email is incorrect or not existed.</p>

  <button type="submit" class="btn btn-default smt-btn" data-toggle="modal" data-dismiss="modal" data-target="#myModal80" >OK</button>
   </div> <!-- model body -->
  </div>
  </div>
</div>

<!-- Wrong email for forgot password -->
	
		<div class="modal fade sm-popup text-center" id="myModal60" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-body">
    <h3>Wrong Email</h3>
    <p>This Email has not been used for signing up.<br />Please check again.</p>

  <button type="submit" class="btn btn-default smt-btn" data-toggle="modal" data-dismiss="modal" data-target="#myModal800" >OK</button>
   </div> <!-- model body -->
  </div>
  </div>
</div>

		<div class="modal fade sm-popup text-center" id="myModal222" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-body">
    <h3>Your Password link has been sent!</h3>
    <p>Dollar Review Club has sent you the Reset password link to your
	Email address. Please find your mail in your mail box. </p>

  <button type="submit" class="btn btn-default smt-btn" data-toggle="modal" data-dismiss="modal">OK</button>
  


   </div> <!-- model body -->
  </div>
  </div>
</div>


		<div class="modal fade sm-popup text-center" id="myModal2220" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-body">
    <h3>Verifying Email Sent!</h3>
    <p>Please check your mail box. </p>

  <button type="submit" class="btn btn-default smt-btn" data-toggle="modal" data-dismiss="modal">OK</button>
  


   </div> <!-- model body -->
  </div>
  </div>
</div>

  
<!-- Reset password -->
<div class="modal fade sm-popup text-center fgp-popup" id="resetpasswordpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body clearfix">
      <div class="login">
		<h3>Please Enter your New Password below</h3>
		<form class="contact_us" id="reset_password_form">
			  <div class="form-group forget_pwd">
				<input type="password" class="form-control" name="reset_password" id="reset_password" placeholder="********">
			  </div>
	
			  <div class="form-group forget_pwd">
				<input type="password" class="form-control" name="reset_cnf_password" id="reset_cnf_password" placeholder="********">
			  </div>
			  	
				<input type="hidden" class="form-control" name="reset_userid" id="reset_userid" >
				<input type="hidden" class="form-control" name="reset_hash" id="reset_hash" >
			  <button type="submit" class="btn btn-default smt-btn" >Submit</button>
			</form>
	  </div>
	  
	  
     
      </div>
      
    </div>
  </div>
</div>
<script>
   //resetpasswordpopup
       
    
$(function() {
    var $validator = $("#reset_password_form").validate({
		  rules: {
		    reset_password: {
		      required: true,
		      minlength: 8,
			  maxlength: 20,
		      
		    },
			reset_cnf_password: {
				required: true,
				minlength: 8,
				maxlength: 20,
				equalTo: "#reset_password"
		    },
		  },
		   highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
		});
	$(document).on("submit", "form#reset_password_form", function(e) {
		e.preventDefault();
	   
       if ($('#reset_password').val() != $('#reset_cnf_password').val())
	{
		
		return false;
	} else {
	
       var data = new FormData($('#reset_password_form')[0]);
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/reset_password'); ?>", 
			dataType		: 'json',
			data			: data,
            contentType: false,
            cache: false,
            processData: false,
                success: function(r) {
                   $("#login_form_Alert").hide();
                    if(r.msg == 'Fail')
                    {
                        $('#resetpasswordpopup').modal('toggle');                        
                        $('#login_signup').modal('toggle');
                        $("#login_form_Alert").html(r.data);
                        $("#login_form_Alert").show();
                        setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 1000);
                    }
                    else if(r.msg == 'Success')
                    {
                        $('#resetpasswordpopup').modal('toggle');                      
                        $('#login_signup').modal('toggle');
                        $("#login_form_Alert").html(r.data);
                        $("#login_form_Alert").show();
                        setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 1000);
                    }
                }
		});
		return false;
        	
	}
    setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 2000);
	});
}); 
    
$(function() {
    var $validator = $("#forgot_password_email_form").validate({
		  rules: {
		    forgot_password_email: {
		      required: true,
		      email: true,
		    }, 
			forgot_password_cnf_email: {
		      required: true,
		      email: true,
			  equalTo: "#forgot_password_email",
		    }
		  },
		   highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
		});
	$(document).on("submit", "form#forgot_password_email_form", function(e) {
		e.preventDefault();
	   
       if ($('#forgot_password_cnf_email').val() != $('#forgot_password_email').val())
	{
		
		return false;
	} else {
	
       var data = new FormData($('#forgot_password_email_form')[0]);
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/forgot_password_email'); ?>", 
			dataType		: 'json',
			data			: data,
            contentType: false,
            cache: false,
            processData: false,
                success: function(r) {
                    if(r.msg == 'Fail')
                    {
                        $('#myModal80').modal('toggle');
                        $('#myModal6').modal('toggle');
                    }
                    else if(r.msg == 'Success')
                    {
                        $('#myModal80').modal('toggle');
                        $('#myModal222').modal('toggle');
                    }
                    else
                    {
                        $('#myModal80').modal('toggle');
                        $('#myModal6').modal('toggle');
                    }
                }
		});
		return false;
        	
	}
    setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 2000);
	});
}); 

    
$(function() {
    var $validator = $("#resend_verifying_email_form").validate({
		  rules: {
		    resend_verifying_email: {
		      required: true,
		      email: true,
		    }
		  },
		   highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
		});
	$(document).on("submit", "form#resend_verifying_email_form", function(e) {
		e.preventDefault();
	   
       if ($('#resend_verifying_email').val() =='')
	{
		
		return false;
	} else {
	
       var data = new FormData($('#resend_verifying_email_form')[0]);
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/resend_verifying_email_form'); ?>", 
			dataType		: 'json',
			data			: data,
            contentType: false,
            cache: false,
            processData: false,
                success: function(r) {
                    if(r.msg == 'Fail')
                    {
                        $('#myModal800').modal('toggle');
                        $('#myModal60').modal('toggle');
                    }
                    else if(r.msg == 'Success')
                    {
                        $('#myModal800').modal('toggle');
                        $('#myModal2220').modal('toggle');
                    }
                    else
                    {
                        $('#myModal800').modal('toggle');
                        $('#myModal60').modal('toggle');
                    }
                }
		});
		return false;
        	
	}
    setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 2000);
	});
}); 
</script>
<!-- Logout Modal -->

<div class="modal fade sm-popup text-center" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
   <div class="modal-body">
    <h3>Log out of Dollar Review Club? </h3>
    <p>Are you sure you want to log out?</p>

  <a href="<?php echo base_url('/user/logout'); ?>"><button type="submit" class="btn btn-default btn185_73">Yes</button></a>
  <button type="submit" class="btn btn-default btn185_73 light-gray"  data-dismiss="modal">No</button>
  


   </div> <!-- model body -->
  </div>
  </div>
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
	   <div class="clearfix social-sec">
           <div class="author_info">From <span id="belong_company"></span></div>
           
           
           <?php /* <div class="addthis_sharing_toolbox"></div>*/?>
	   </div>
	   
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
        
		<div class="btn-groups clearfix">
		<div class='shareaholic-canvas' data-app='share_buttons' data-app-id='7fe74797d03cbccba58d8e88d69ca41d'></div>
		</div>
        
		<div class="details">Review Suggestion:<br>
		<p id="product_review_suggestion" class="product_review_suggestion extra_list"></p>
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



  <!-- Not logged in popup Modal -->
<div class="modal fade thank_you not_log_in " id="myModal40" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>You're not logged in!</h3>
			<p>Find the product discount very attractive?</p>
			<button type="button" class="btn btn185_73" data-dismiss="modal"  data-toggle="modal" data-target="#login_signup" onclick="add_class_to_body()">Sign Up</button>
			<button type="button" class="btn gray-btn btn185_73" data-dismiss="modal"  data-toggle="modal" data-target="#login_signup" onclick="add_class_to_body()">Login</button>
			
      </div>

    </div>
  </div>
</div>

<!-- [33] GET APPROVED (log in pop-up)  -->
  
  
  <!-- Modal -->
<div class="modal fade thank_you not_log_in adc " id="myModal56" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>Approval by seller is needed!</h3>
			<div class="approved_product_need">
			<p>To obtain this product discount code, the seller will ask for your approval to check your Amazon member profile link. Are you sure you want to continue?</p>

	<p>Note: Your discount quota will still be -1 unless your request has been disapproved by the seller. After the approval by the seller and you receive the discount code, your discount quota will return +1 back to you once your review passes the check.</p>
			
			
			<div class="checkbox">
					<input type="checkbox" id="c1" name="c1" checked="checked">
					<label for="c1"><span></span>I have read and accepted the above conditions; please send my request to the seller.
</label>
				</div>
				
			

			<button type="button" class="btn btn185_73" id="sent_approve_request">Yes</button>
			<button type="button" class="btn gray-btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" data-target="#myModal2" >No</button>
			
			</div>
			</div>
			
      </div>

    </div>
  </div><!-- Modal close -->

<!-- [35] GET NOW (log in pop-up) (quota not enough)  -->
    
  <!-- Modal -->
<div class="modal fade thank_you not_log_in launch_product_popup " id="myModal54" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal"  data-toggle="modal" aria-label="Close" >Close</button>
      <div class="modal-body text-center">
			<h3>Your discount quote is insufficient!</h3>
			<div class="product_discount">
			<p>It looks like you didn't write the reviews of products 
on Amazon, or you did not pass the check on Dollar 
Review Club. Please finish them before getting 
another discount product!</p>

<p>Click here to manage your review status on <br>
<a href="<?php echo base_url('/shopper/my_account?tab=review_status'); ?>">"My Review Status"</a> </p>
	
			
			
				
			</div>

			<button type="button" class="btn btn185_73" data-dismiss="modal"  data-toggle="modal" >Ok</button>
		
			
      </div>

    </div>
  </div>

</div><!-- Modal close -->	


<!-- [36] GET NOW (log in pop-up) (checked reviews not enough)  -->
   
  
  <!-- Modal -->
<div class="modal fade thank_you not_log_in launch_product_popup " id="myModal53" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>Your approved reviews are insufficient!</h3>
			<div class="product_discount">
			<p>It looks like your approved reviews on Dollar Review Club do not meet the seller's requirement:</p>
<p>Only customers who have <span id="need_review">0</span> or more approved reviews can access the discount code.</p>

<p>Click here to manage your review status on <br>
<a href="<?php echo base_url('/shopper/my_account?tab=review_status'); ?>">"My Review Status"</a> </p>
			
			
			
				
			</div>

			<button type="button" class="btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" data-target="#myModal2">Ok</button>
		
			
      </div>

    </div>
  </div>

</div> <!-- Modal close -->


<!-- [37] GET NOW (log in pop-up) sure to get the code  -->
   
  <!-- Modal -->
<div class="modal fade thank_you not_log_in launch_product_popup " id="myModal52" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>Are you sure you want to get this product discount?</h3>
			<div class="product_discount">
			<p>Your quota will -1 after you claim this discount product.
Once your review of this product passed the check on Dollar Review Club, it will return +1 back to you.
Are you sure you want to get this product discount?</p>
			
			
			
				
			</div>

			<button type="button" class="btn btn185_73" data-toggle="modal" data-dismiss="modal" data-target="#myModal51" onclick="add_class_to_body()">Yes</button>
			<button type="button" class="btn gray-btn btn185_73" data-toggle="modal" data-dismiss="modal"  >No</button>
			
      </div>

    </div>
  </div>

</div>


<!-- [48] Review-quality-notify  -->
   
  <!-- Modal -->
<div class="modal fade thank_you not_log_in adc " id="myModal51" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
      <form name="final_step_for_code" id="final_step_for_code">
        <span id="final_step_for_code_Alert"></span>
			<h3>You are almost there!</h3>
			<div class="adc_text">
			<p>Please read the items below carefully before you receive your discount code:</p>
			<ul>
			<li>1. Write the product review on Amazon after you 
receive the product.</li>
			<li>2. The seller suggests the review criteria below:<br>
	<div class="extra_list" id="review_suggest_list"></div></li>
			<li>3. Remember to go to "My Review Status" to check after you leave a review on Amazon.</li>
			<li>4. Resale of the discount code or related products is prohibited. This violates regulations and resellers will be permanently banned of using Dollar Review Club.</li>

			</ul>
			
			<div class="checkbox">
					<input type="checkbox" id="check1" name="check1" value="yes">
					<label for="check1"><span></span>I've read and accepted the above rules. Please give me my discount code!</label>
				</div>
				
			</div>

			<input type="hidden" name="product_id_for_code" id="product_id_for_code" value="yes">
			<input type="hidden" name="update_approve_request_id" id="update_approve_request_id" value="0">
			<input type="hidden" name="code_access_type" id="code_access_type" value="auto">
			<button type="button" class="btn btn185_73" onclick="final_step_to_get_code();">Yes</button>
			<button type="button" class="btn gray-btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" >No</button>
			</form>
      </div>

    </div>
  </div>

</div>


<!-- [48] Give discount code  -->


  <!-- Modal -->
<div class="modal fade thank_you not_log_in launch_product_popup discount_code_popup" id="myModal50" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>Thank You!</h3>
			<p>
			Please find the discount code below: <br>
			<span class="discount_code" id="discount_code"></span><br>
			<a href="<?php echo base_url('/shopper/my_account?tab=review_status'); ?>">Click here</a> to manage your review on<br> 
"My Review Status".
			
			
			</p>
			
			
			<button type="button" class="btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" >OK</button>
			
			
      </div>

    </div>
  </div>

</div>




<!-- [34] GET APPROVED (log in pop-up) (request sent)  -->

  <!-- Modal -->
<div class="modal fade thank_you not_log_in launch_product_popup " id="myModal55" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<div class="slant270"></div>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      <div class="modal-body text-center">
			<h3>Your request has been sent to the seller!</h3>
			<div class="product_discount">
			<p>Please wait for the product seller to approve your request. You can check the status in "My Review Status." <a href="<?php echo base_url('/shopper/my_account?tab=review_status'); ?>">Click here.</a></p>
            <p>Note: Your discount quota will return 1 if product owner does not response within 48 hours.</p>
			
			
				
			</div>

			<button type="button" class="btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" data-target="#myModal2">OK</button>
		
			
      </div>

    </div>
  </div>

</div><!-- Modal close -->	
<script>


function get_product_details(id)
{
    //console.log(id);
    //itemdetails $("p:first").addClass("active");
    
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
var logged_in = '<?php echo $additional; ?>';
var ajaxReqData = {pid: id,action: "itemdetails"};
//ajaxReqData.action = "itemdetails";
    $.ajax({

            type: "POST",

            url: site_url + "ajax",

            dataType: "json",

            data: ajaxReqData,

            success: function(r) {
                $('#product_amazonLink').attr('href',r.data['amazonLink']);
                //$('#product_reviewLink').attr('href',r.data['reviewLink']);
                if(r.data['pro']['end_date_type'] != 'product_end_time_until')
                {
                    $('#time_left').html('Discount expires in <time>'+r.data['time_left']+'</time>');
                    //5d : 6h : 52min
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
                            if(logged_in =='')
                            {$('#product_reviewLink').attr('onclick','get_now_condition1('+id+')');}
                        }
                        else if(r.data['pro']['code_access_condition_type'] == 'product_code_access_condition_custom')
                        {
                            $('#product_reviewLink').text('Get it now');
                            if(logged_in =='')
                            {$('#product_reviewLink').attr('onclick','get_now_condition2('+id+')');}
                        }
                        else if(r.data['pro']['code_access_condition_type'] == 'product_code_access_condition_manual')
                        {
                            $('#product_reviewLink').text('Get Approved');
                            if(logged_in =='')
                            {$('#product_reviewLink').attr('onclick','get_now_condition3('+id+')');}
                        }
                    }
                    
                
                /*$('.addthis_sharing_toolbox').attr('data-url', r.data['custom_url']);
                $('.addthis_sharing_toolbox').attr('data-title', r.data['pro']['name']);
                $("meta[name='title']").attr("content", r.data['pro']['name']);
                $("meta[name='description']").attr("content", r.data['pro']['description']);*/
                $('#product_id_for_code').val(r.data['pro']['pid']);
                $('#product_img0').attr('src',site_url+'uploads/product_image/'+r.data['pro']['pid']+'/cover_pic/'+r.data['pro']['img_url']);
                $('#product_thumb_img0').attr('src',site_url+'uploads/product_image/'+r.data['pro']['pid']+'/cover_pic/'+r.data['pro']['img_url']);
                //$('#product_img0').attr('src',r.data['pro']['img_url']);
                //$('#product_thumb_img0').attr('src',r.data['pro']['img_url']);
                $('#product_title').html(r.data['pro']['name']);
                $('#belong_company').html(r.data['pro']['belong_company']);
                $('#product_details').html(r.data['pro']['description']);
                $('#product_review_suggestion').html(r.data['review_suggestion']);
                $('#product_new_price').html('<span>$</span>'+r.data['pro']['discount_price']);
                $('#product_original_price').html('<strike>$'+r.data['pro']['price']+'</strike>');
                var subtract_off = r.data['pro']['price'] - r.data['pro']['discount_price'];
                var calculate_off = subtract_off/r.data['pro']['price'];
                var off = calculate_off*100;
                //console.log(subtract_off+' '+calculate_off+' '+off)
                
                $('#product_off').html(parseFloat(off).toFixed(2)+'% OFF');
                
                
                //product_off
                $.each(r.data['other_img_url'], function( index, value ) {
                  //console.log( index + ": " + value );
                  var new_index = index+1;
                  $(".carousel-inner").append('<div class="item"><img id="product_img'+new_index+'" src="'+site_url+'uploads/product_image/'+r.data['pro']['pid']+'/other_pic/'+value+'" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;" /></div>');
                  $(".carousel-indicators").append('<li data-target="#carousel-custom" data-slide-to="'+new_index+'"><img id="product_thumb_img'+new_index+'" src="'+site_url+'uploads/product_image/'+r.data['pro']['pid']+'/other_pic/'+value+'" alt="" height="65" width="65" /></li>');
                  
                  //$(".carousel-inner").append('<div class="item"><img id="product_img'+new_index+'" src="'+value+'" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;" /></div>');
                  //$(".carousel-indicators").append('<li data-target="#carousel-custom" data-slide-to="'+new_index+'"><img id="product_thumb_img'+new_index+'" src="'+value+'" alt="" height="65" width="65" /></li>');
                });
                //var i = r.data['other_img_count'];
                //var j = 0;
                //console.log(r);product_thumb_img1product_title

    

            }

        });
}

function get_now_condition1(id)
{
var site_url = "<?php echo site_url() ?>";
    
var ajaxReqData = {pid: id,action: "get_now_condition1"};
    $.ajax({

            type: "POST",

            url: site_url + "ajax",

            dataType: "json",

            data: ajaxReqData,

            success: function(r) {
                $('#myModal').modal('hide');
                if(r.data['can_get'] == 'true')
                {
                    $('#myModal52').modal('toggle');
                    $('#review_suggest_list').html(r.data['review_suggestion']);
                    $('#code_access_type').val('auto');
                    $('#update_approve_request_id').val('0');
                }
                else
                {
                    if(r.data['can_get_error'] == 'no quota')
                    {
                        $('#myModal54').modal('toggle');
                        
                    }
                }
                
            }

        });
         setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 2000);
        
    
}

function get_now_condition2(id)
{
var site_url = "<?php echo site_url() ?>";
    
var ajaxReqData = {pid: id,action: "get_now_condition2"};
    $.ajax({

            type: "POST",

            url: site_url + "ajax",

            dataType: "json",

            data: ajaxReqData,

            success: function(r) {
                $('#myModal').modal('hide');
                if(r.data['can_get'] == 'true')
                {
                    $('#myModal52').modal('toggle');
                    $('#review_suggest_list').html(r.data['review_suggestion']);
                    $('#code_access_type').val('auto');
                    $('#update_approve_request_id').val('0');
                }
                else
                {
                    if(r.data['can_get_error'] == 'no quota')
                    {
                        $('#myModal54').modal('toggle');
                        
                    }
                    else if(r.data['can_get_error'] == 'no review')
                    { $('#need_review').html(r.data['need_review']);
                        $('#myModal53').modal('toggle');
                        
                    }
                }
                
            }

        });
         setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 2000);
        
    
}
function get_now_condition3(id)
{
    var site_url = "<?php echo site_url() ?>";
    
var ajaxReqData = {pid: id,action: "get_now_condition3"};
    $.ajax({

            type: "POST",

            url: site_url + "ajax",

            dataType: "json",

            data: ajaxReqData,

            success: function(r) {
                $('#myModal').modal('hide');
                if(r.data['can_get'] == 'true')
                {//id="sent_approve_request"onclick="send_approve_request();"
                    $('#sent_approve_request').attr('onclick','send_approve_request('+id+','+r.data['seller_id']+')');
                    $('#myModal56').modal('toggle');
                }
                else
                {
                    if(r.data['can_get_error'] == 'no quota')
                    {
                        $('#myModal54').modal('toggle');
                        
                    }
                }
                
            }

        });
         setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 2000);
}


function send_approve_request(pid,seller_id)
{       
var ajaxReqData = {pid: pid,seller_id: seller_id,action: "send_approve_request"};
	
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/send_approve_request'); ?>", 
			dataType		: 'json',
			data			: ajaxReqData,
           
                success: function(r) {
                    //_alert.html('').hide();
                    $('#myModal56').modal('toggle');
                    $('#myModal55').modal('toggle');
                }
		});
        
         setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 2000);
	}

function final_step_to_get_code()
{
       var data = new FormData($('#final_step_for_code')[0]);
       var _alert = $("#final_step_for_code_Alert");
	if($('#check1').prop('checked') != true)
    {
        _alert.html('<div class="alert alert-danger">Please accept these rules below...</div>').show();
    }
    else
    { _alert.html('').hide();
	
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/get_the_discount_code'); ?>", 
			dataType		: 'json',
			data			: data,
            contentType: false,
            cache: false,
            processData: false,
                beforeSend: function() {
                    _alert.html('<div class="alert alert-success">Please wait...</div>').show();
                },
                success: function(r) {
                    _alert.html('').hide();
                    if($('#update_approve_request_id').val() != 0 && $('#code_access_type').val() == 'manual')
                    {
                        $('#promocode_area_id_'+$('#update_approve_request_id').val()).html(r.data['code']);
                        $('#button_id_'+$('#update_approve_request_id').val()).html('Discount code received');
                        $('#button_id_'+$('#update_approve_request_id').val()).attr('onclick','');
                    }
                    
                    
                    $('#discount_code').html(r.data['code']);
                    $('#myModal51').modal('toggle');
                    $('#myModal50').modal('toggle');
                }
		});
    }    
		return false;
	}
    
    
    
function disable_notification()
{$('.notification').html('');
    //alert('disable_notification');
var ajaxReqData = {action: "disable_notification"};
	
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('ajax/disable_notification'); ?>", 
			dataType		: 'json',
			data			: ajaxReqData,
                success: function(r) {
                    
                    //$('.notification_list').remove();
                }
		});
}

	$(document).on("submit", "form#login_form", function(e) {
       var data = new FormData($('#login_form')[0]);
       var _alert = $("#login_form_Alert");
		e.preventDefault();
		$.ajax({
		  
            type:"POST",
			url 			:"<?php echo site_url('user/login'); ?>", 
			dataType		: 'json',
			data			: data,
            contentType: false,
            cache: false,
            processData: false,
                beforeSend: function() {
                    _alert.html('<div class="alert alert-success">Please wait...</div>').show();
                },
                success: function(r) {
                    //console.log(r);
                    if (r.res) {
                        if (r.login_error) {
                        _alert.html(r.msg).show();
                        } else {
                            //r.redirect;
                        _alert.html(r.msg).show();
                        //console.log(r.redirect);
                        window.location.href = r.redirect;
                            //location.reload(r.redirect);
                        }
                    }
                }
		});
		return false;
	});
    
    $(function() {
    var user_role = '<?php echo $user->role; ?>';
    //console.log(user_role);
    if(user_role == 'companies')
    {
        $('.My_product_review_status').attr('href','<?php echo site_url('companies/my_account?tab=review_status') ?>');
        $('.My_review_status').attr('href','javascript:void(0)');
    }
    else if(user_role == 'shopper')
    {
        $('.My_review_status').attr('href','<?php echo site_url('shopper/my_account?tab=review_status') ?>');
        $('.My_product_review_status').attr('href','javascript:void(0)');
    }
});  
</script>

<?php if( $verify[0] == true){
    if($verify[1] == 'resetpasswordpopup')
    {
        ?>
    <script>
    $('#resetpasswordpopup').modal('toggle');
    $('#reset_userid').val('<?php echo $userid; ?>');
    $('#reset_hash').val('<?php echo $hash; ?>');
    //$("#login_form_Alert").show();
    //setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 1000);
    </script>
    <?php
    }
    else
    {
        ?>
    <script>
    $('#login_signup').modal('toggle');
    $("#login_form_Alert").show();
    setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 1000);
    </script>
    <?php
    }
    
}
if($login_page == 'on')
{
    ?>
    <script>
    $('#login_signup').modal('toggle');
    //$("#login_form_Alert").show();
    setTimeout(function(){ jQuery('body').addClass("modal-open"); }, 1000);
    </script>
    <?php
    
}
?>

 
<footer>
<div class="container">
<div class="col-md-6">
<h6>Follow us on:</h6>
<ul class="social">
	<li class="fb"><a href="https://www.facebook.com/dollarreviewclubofficial" target="_blank"><span class="sr-only">Facebook</span></a></li>
	<li class="tw"><a href="https://twitter.com/DRCAmazon" target="_blank"><span class="sr-only">Twitter</span></a></li>
	<li class="insta"><a href="https://www.instagram.com/dollarreviewclub/" target="_blank"><span class="sr-only">Twitter</span></a></li>
	<?php /* <li class="fb"><a href=""><span class="sr-only">Facebook</span></a></li>
	<li class="tw"><a href=""><span class="sr-only">Twitter</span></a></li>
	<li class="gp"><a href=""><span class="sr-only">google plus</span></a></li>
	<li class="pt"><a href=""><span class="sr-only">pintrest</span></a></li> */?>
</ul>
</div>
<div class="col-md-6">
<p class="text-right pull-right clearfix">&copy; 2016 <?php echo lang('copyright') ?></p>

<div class="footer-links"><?php echo get_menu('footer'); ?></div>
</div>

</div>
</footer>
<?php /* <div class="gray-slant"></div> */ ?>
</div><!-- page-cover -->
<!-- Go to www.addthis.com/dashboard to customize your tools 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-578d86b1e2433d7d"></script>-->
<script type='text/javascript' data-cfasync='false' src='//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js' data-shr-siteid='7fe74797d03cbccba58d8e88d69ca41d' async='async'></script>

</body>
</html>
