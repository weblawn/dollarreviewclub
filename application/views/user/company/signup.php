
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