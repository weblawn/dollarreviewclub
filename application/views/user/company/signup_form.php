</div>
<div class="contentbox page">
	
	<div class="container">
		<h1 class="page-title">Sign Up in Seller</h1>
		<div class="content">
			<div class="content_nub">
		 	
			<form role="form" id="regForm" class="other_forms">
				<div id="rootwizard">
					<ul>	  	
						<li><a href="#tab1" data-toggle="tab">1</a>
							<span>Account Information</span>
						</li>
						<li><a href="#tab2" data-toggle="tab">2</a>
						
						<span>Receive Email Confirmation</span>
						</li>
					</ul>
					<div class="tab-content">
                    
    <div id="signup_company_form_Alert"></div>
						<!--start first step-->
						<div class="tab-pane" id="tab1">
                        
								
							  <div class="form-group">
								<label for="email">Your Email</label>
								<input type="email" name="email" class="form-control" id="email">
							  </div>
							  <div class="form-group">
								<label for="cop_name">Your corporation name on Amazon</label>
								<input type="text" name="cop_name" class="form-control" id="cop_name">
							  </div>
							  <div class="form-group">
								<label for="pass">Password (must be between 8 to 20 character)</label>
								<input type="password" name="pass" class="form-control" id="pwd">
							  </div>
							  <div class="form-group">
								<label for="cnf_pass">
												Re-Enter Password</label>
								<input type="password" name="cnf_pass" class="form-control" id="cmf_pass">
							  </div>
							<div class="form-group">
								<label for="pro_cat">Choose your main product category</label>
								<select class="form-control" name= "pro_cat" id="sel2" placeholder="Choose Category">
									<option value="">Choose category</option>
                                    <?php
                                         foreach (get_categories_list() as $cat) {
                                    ?>
                                        <option value="<?php echo $cat->cid; ?>"><?php echo $cat->name; ?></option>
                                    <?php
                                         }
                                    ?>
									
								</select>
							</div>
						
							  
							  
							  <div class="checkbox form-group">
				<input type="checkbox" name="terms" id="terms" value="accepted">
				<label for="terms">
					<span></span>
				<p class="tnc">Signing up means that you have read and agreed to Dollar Review
										Club <a href="<?php echo base_url('pages/terms'); ?>" target="_blank">Terms</a> and <a href="<?php echo base_url('pages/privacy'); ?>" target="_blank">Privacy Policy.</a></p>
				</label>
			</div>
							 
						</div> 
						<!--end first step-->
						<!--start second step-->
						<div class="tab-pane" id="tab2">
							<div class="content_nub">
								
								<h2>Thank You for Registering!	</h3>
								<p>Please check your email for a confirmation request with a link that will confirm your account. Once you click the link, your registration as seller on Dollar Review Club will be completed.</p>
								
						<a href="<?php echo base_url('home'); ?>"><button type="button" class="btn btn-org btn-home" style="background-color: #ff813d!important; border-color: #ff813d!important; border-radius: 0px!important;">Back to Homepage</button></a>
							
							</div>
						</div>
						<!--end second step-->
						
						<ul class="nav-btn pager wizard">
						  	<li class="next"><a class="btn btn-org ">Next</a></li>
						</ul>
						
					</div>	
				</div> 
			</form>
            <input type="hidden" name="ajax_url" class="form-control" id="ajax_url" value="<?php echo site_url('user/signup_valid/company'); ?>"/>
		</div>	
	</div>
	<div class="clearfix"></div>
	</div>
</div>


<script>
	
	</script>