<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <!--BEGIN TABS-->
            <div class="tabbable tabbable-custom tabs-left">
                <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#tabGeneral" data-toggle="tab"><i class="icon-cog"></i> General</a></li>                    
                    <li><a href="#tabPreference" data-toggle="tab"><i class="icon-star"></i> Preferences</a></li>
                    <li><a href="#tabBilling" data-toggle="tab"><i class="icon-credit-card"></i> Billing</a></li>
                    <li><a href="<?php echo site_url('user/logout') ?>"><i class="icon-key"></i> <?php echo lang('logout') ?></a></li>
                </ul>
				
                <div class="tab-content">
                    <div class="tab-pane active" id="tabGeneral">
                        <div class="tab-pane active" id="general">
                            <h2>General Settings</h2>
                            <div class="description">Your Dollar Review Club account overview</div>
                            <h5 class="section-title">Profile</h5>
                            <div class="card-alias account-overview">
                                <div class="row-fluid">
                                    <div class="span3 avatar-col">
                                        <img src="<?php echo $avatar ?>" alt="avatar" class="settings-avatar img-circle">
                                        <i class="img-circle settings-avatar avatar avatar-lg avatar-color-46
                                           avatar-letter-s"></i>
                                    </div>

                                    <div class="span3 who-am-i">
                                        <h3><?php echo $user->fname . " " . $user->lname; ?></h3>
                                        <h4><?php echo $user->email ?></h4>
                                    </div>

                                    <div class="span4 action-buttons">
                                        <a type="button" class="btn btn-primary btn-block btn-blue" data-toggle="modal" data-target="#changePass"><i class="icon-key"></i> Update Password</a>
                                        <br>

                                        <div id="changePass" class="modal hide fade" tabindex="-1" aria-hidden="true" style="display: none;">
                                            <form action="" method="post" style="margin-bottom: 0;" id="stChangePassForm">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title"> &nbsp;&nbsp;<i class="icon-key"></i> Update Password</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div class="alert alert-danger" style="display: none;"></div>
                                                            <p>
                                                                <label>Old Password</label>
                                                                <input type="password" name="_old" class="span12 m-wrap" required="">
                                                            </p>
                                                            <p>
                                                                <label>New Password</label>
                                                                <input type="password" name="_new" class="span12 m-wrap" required="">
                                                            </p>
                                                            <p>
                                                                <label>Confirm Password</label>
                                                                <input type="password" name="_con" class="span12 m-wrap" required="">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn red" id="stChangePassCnl" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn blue">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                        <a type="button" href="https://secure.gravatar.com" target="_blank" class="btn btn-default btn-block"><i class="icon-camera"></i> Change avatar</a>

                                    </div>
                                </div>
                            </div>
                            <h5 class="section-title">Connected services</h5>
                            <div class="card-alias">
                                <h6 class="upper">Amazon Account</h6>
                                <div class="row-fluid">
                                    <div class="span8">
                                        <p>Connect the Amazon account that will be used for product reviews</p>
                                    </div>
                                    <div class="span4 text-right">
                                        <!--a class="btn btn-primary btn-blue" style="margin-bottom:10px" href="#"><i class="icon-link"></i> &nbsp; Link Amazon</a-->
                                    </div>

                                    <div class="clearfix"></div>									

                                    <hr>

                                    <h6 class="upper">Facebook Account</h6>
                                    <div class="row-fluid">
                                        <div class="span8">
                                            <p>Once connected, you can login to Dollar Review Club using your Facebook profile</p>
                                        </div>
                                        <div class="span4 text-right">
											<?php if($facebook !== false){ ?>
												<a class="btn btn-primary fb-btn" style="margin-bottom:10px" data-toggle="modal" href="#unlinkFacebook"><i class="icon-facebook"></i> &nbsp; Unlink Facebook</a>
												<div id="unlinkFacebook" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<!-- Modal content-->
														<div class="modal-content">
															<div class="modal-header">															
																<h4 class="modal-title">&nbsp;</h4>
															</div>
															<div class="modal-body">
																<h2>Are you sure that you want unlink Facebook account?</h2><br/>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
																<button type="button" class="btn btn-primary btn-blue" id="btnUnlinkFacebook">Yes</button>
															</div>
														</div>
													</div>
												</div>
												
											<?php }else{ ?>
												<a class="btn btn-primary fb-btn" style="margin-bottom:10px" href="<?php echo site_url('facebook/link') . "?redirect=" . site_url('companies/settings') ?>"><i class="icon-facebook"></i> &nbsp; Link Facebook</a>
											<?php } ?>
										</div>
                                    </div>	 
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- general tab close -->

                    <!-- Preferences tab open -->
                    <div class="tab-pane" id="tabPreference">
                        <h2>Preferences</h2>
                        <div class="description"> Edit your name, or categories of interest</div>
                        <h5 class="section-title">Preferences</h5>

                        <div class="card-alias user-info">
                            <div class="row-fluid form-horizontal" id="stPreferenceShow">
                                <div class="control-group">
                                    <label class="control-label">Name</label>
                                    <div class="controls">
                                        <p class="unID"> <?php echo $user->fname . " " . $user->lname; ?></p>
                                    </div>			
                                </div>			
                                <div class="row-fluid">
                                    <div class="text-right">
                                        <a class="btn btn-primary btn-blue" id="stPreferenceEdit"><i class="icon-pencil"></i> Edit</a>
                                    </div>
                                </div>
                            </div>

                            <form class="row-fluid form-horizontal" id="stPreferenceForm" action="#" method="POST" role="form" style="display: none;">
                                <div class="control-group">
                                    <label class="control-label">Name</label>
                                    <div class="controls">
                                        <input type="text" name="fname" value="<?php echo $user->fname ?>" placeholder="First Name" class="span3">
                                        <input type="text" name="lname" value="<?php echo $user->lname ?>" placeholder="Last Name" class="span3">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">&nbsp;</label>
                                    <div class="controls">                                        
                                        <button type="submit" class="btn green" id="stPreferenceUpdate"><i class="icon-save"></i> Update</button>
                                        <button type="button" class="btn red" id="stPreferenceCancel"><i class="icon-remove"></i> Cancel</button>
                                    </div>
                                </div>
                                <div class="span6 offset1 alert alert-danger" style="display: none;">fsdf</div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- Preferences tab close -->


                    <!-- Billing tab Open -->
                    <div class="tab-pane billing" id="tabBilling">
                        <h2>Billing</h2>
                        <p class="description">Edit your card information and view your bill</p>
						
						<div class="stShowCardDetails">
                            <div class="row-fluid">
                                <div class="span6">
                                    <h5 class="section-title">Your Card Information</h5>
                                </div>
                                <div class="span6 text-right">
                                    <button class="btn btn-primary marginBottom10" id="stCEdit"><i class="fa fa-pencil"></i> Edit</button>
                                </div>
                            </div>
                            <div class="panel panel-default user-info">
                                <div class="panel-body">
                                    <div class="row-fluid">
                                        <div class="span3">Card Type</div>
                                        <div class="span4 text-capitalize"><?php echo (isset($cc_type->mval)) ? strtoupper($cc_type->mval) : "N/A" ?></div>
                                    </div>

                                    <div class="row-fluid">
                                        <div class="span3">Last 4 Digits of Card</div>
                                        <div class="span4 text-capitalize">
											<?php
												if (isset($cc_number->mval)) {
													$len = strlen($cc_number->mval);
													echo str_repeat("*", ($len - 4));
													echo substr($cc_number->mval, ($len - 4), 4);
												}else{
													echo "N/A";													
												}
											?>
										</div>
                                    </div>

                                    <div class="row-fluid">
                                        <div class="span3">Expiration Date</div>
                                        <div class="span4 text-capitalize"><?php echo (isset($cc_expiry->mval)) ? strtoupper($cc_expiry->mval) : "N/A" ?></div>
                                    </div>

                                    <div class="row-fluid">
                                        <div class="span3">Review Used</div>
                                        <div class="span4 text-capitalize">N/A</div>
                                    </div>

                                    <div class="row-fluid">
                                        <div class="span3">Current Bill</div>
                                        <div class="span4 text-capitalize">N/A</div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="card-container stShowCardForm">
							<form class="form-horizontal ng-valid ng-dirty ng-valid-parse" id="stripeForm">
								<div class="card-wrapper">
									<div class="card-container">
										<div class="card unknown">
											<div class="front">
												<div class="card-logo visa">visa</div>
												<div class="card-logo mastercard">MasterCard</div>
												<div class="card-logo amex"></div>
												<div class="card-logo discover">discover</div>
												<div class="lower">
													<div class="shiny"></div>
													<div class="cvc display">•••</div>
													<div class="number display card-invalid">•••• •••• •••• ••••</div>
													<div class="name display">Full Name</div>
													<div data-after="valid thru" data-before="month/year" class="expiry display">••/••</div>
												</div>
											</div>
											<div class="back">
												<div class="bar"></div>
												<div class="cvc display">•••</div>
												<div class="shiny"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="span12 card-info" style="margin-top: 20%;">
									<div class="row-fluid">
										<div class="form-group">
											<div class="span12 marginBottom10">
												<input type="text" id="stCCard" class="form-control card-invalid unknown placeholder" placeholder="Card Number" name="number" value="<?php echo (isset($cc_number->mval)) ? strtoupper($cc_number->mval) : "" ?>" autocomplete="off">
											</div>
										</div>
										<div class="form-group">
											<div class="span12 marginBottom10">
												<input type="text" id="stCName" class="form-control" placeholder="Full name" name="name" value="<?php echo (isset($cc_name->mval)) ? strtoupper($cc_name->mval) : "" ?>" autocomplete="off">
											</div>
										</div>
										<div class="form-group">
											<div class="span6">
												<input type="text" id="stCExpiry" class="form-control" placeholder="MM/YY" name="expiry" value="<?php echo (isset($cc_expiry->mval)) ? strtoupper($cc_expiry->mval) : "" ?>" maxlength="5" autocomplete="off">
											</div>
											<div class="span6 marginBottom10">
												<input type="text" id="stCCvc" class="form-control" placeholder="CVC" name="cvc" value="<?php echo (isset($cc_cvc->mval)) ? strtoupper($cc_cvc->mval) : "" ?>" maxlength="3" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="form-group">
											<div class="span12">
												<button type="button" class="btn btn-default" id="stCCancel"><i class="fa fa-times"></i> Cancel</button>
												<button class="btn btn-primary pull-right disabled" id="stCSave"><i class="fa fa-floppy-o"></i> Save</button>
											</div>
										</div>
									</div>
								</div>								
								<input type="hidden" value="<?php echo get_hash('vfQ1e0WBnkrVUqbqiOh') ?>" name="_token">
								<input type="hidden" value="" name="_ctype" />
							</form>
							
							<div class="clearfix"></div><br/>
							<div class="alert alert-danger stCAlert"></div>
							
						</div>
						
						<div class="clearfix"></div>
						
						
						<div class="container-fluid" style="margin-top: 7%;">
							<div class="row-fluid">
								<h5>PRICING INFORMATION</h5><hr/>
								<div class="span11">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="row-fluid">
												<div class="span4">
													<div class="panel panel-pricing">
														<div class="panel-heading text-center">
															<div class="circle small">S</div>
															<h2>Small</h2>
															<span class="price">
																$5 / snag
															</span>
														</div>
														<div class="panel-body">
															<b>1-100 snags</b>
															Your first 100 snags per month are billed at $5 each.
															<br>
														</div>
													</div>
												</div>

												<div class="span4">
													<div class="panel panel-pricing">
														<div class="panel-heading text-center">
															<div class="circle medium">M</div>
															<h2>Medium</h2>
															<span class="price">
																$3 / snag
															</span>
														</div>
														<div class="panel-body">
															<b>101-500 snags</b>
															Your next 400 snags per month are billed at $3 each.
														</div>
													</div>
												</div>

												<div class="span4">
													<div class="panel panel-pricing">
														<div class="panel-heading text-center">
															<div class="circle large">L</div>
															<h2>Large</h2>
															<span class="price">
																$2 / snag
															</span>
														</div>
														<div class="panel-body">
															<b>501 and Up</b>Any snags over 500 per month are billed at $2 each.
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<h5 class="section-title">Invoices</h5>

									<div class="panel panel-default">
										<div class="panel-body">
											You have not been billed yet.
										</div>
									</div>
								</div>
							</div> <!-- row-fluid close -->
						</div>
                    </div>
                    <!-- Billing tab close -->
                </div>
            </div>
            <!--END TABS-->
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
		
		<?php if( isset($cc_number) && !empty($cc_number) ){ ?>
			$(".stShowCardDetails").addClass("display");
		<?php }else{ ?>
			$(".stShowCardForm").addClass("display");
		<?php } ?>
		
		/* Card Detail Cancel */
		$(document).on("click", "button#stCCancel", function(e){
			e.preventDefault();
			$(".stShowCardForm").removeClass("display");
			$(".stShowCardDetails").addClass("display");
		});
		
		/* Card Edit Detail */
		$(document).on("click", "button#stCEdit", function(e){
			e.preventDefault();
			$(".stShowCardDetails").removeClass("display");
			$(".stShowCardForm").addClass("display");
		});
		
		/*Save Card Details*/
		$(document).on("click", "button#stCSave", function(e){
			e.preventDefault();
			
			var _form = $("form#stripeForm"),
				_formData = _form.serializeArray(),
				_alert = $(".stCAlert");
			
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('companies/saveCard') ?>",
				dataType: "json",
				data: _formData,
				beforeSend: function(){
					_alert.removeClass("alert-danger").addClass("alert-success").text("Please wait...").show();
				},
				error: function(){
					_alert.removeClass("alert-success").addClass("alert-danger").text("Problem with validation").show();
				},
				success: function(r){
					if(r.res){
						_alert.removeClass("alert-danger").addClass("alert-success").text("Credit card details saved successfully.").show();
						window.location.reload();
					}else{
						_alert.removeClass("alert-success").addClass("alert-danger").text(r.msg).show();
					}
				}
			});
		});
		
        /* Edit Button click listener */
        $(document).on("click", "a#stPreferenceEdit", function() {
            $("div#stPreferenceShow").hide();
            $("form#stPreferenceForm").show();
        });

        /* Cancel button click listener */
        $(document).on("click", "button#stPreferenceCancel", function() {
            $("form#stPreferenceForm").hide();
            $("div#stPreferenceShow").show();
        });
		
		var loader = $("#stLoader");
		
		/*
		 * Unlink Facebook Account
		 */
		$(document).on("click", "button#btnUnlinkFacebook", function(e){
			e.preventDefault();
			
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('companies/unlinkFacebook') ?>",
				dataType: "json",
				data: {"unlink": 1},
				beforeSend: function(){
					loader.show();
				},
				error: function(){
					loader.hide();
				},
				success: function(r){
					if(r.res){
						window.location.reload();
					}
				}
			})
		});
		
		/*
		 * Cards
		 */
		var defaultFormat = /(\d{1,4})/g;
        var cards = [{
                type: 'visaelectron',
                pattern: /^4(026|17500|405|508|844|91[37])/,
                format: defaultFormat,
                length: [16],
                cvcLength: [3],
                luhn: true
            }, {
                type: 'maestro',
                pattern: /^(5(018|0[23]|[68])|6(39|7))/,
                format: defaultFormat,
                length: [12, 13, 14, 15, 16, 17, 18, 19],
                cvcLength: [3],
                luhn: true
            }, {
                type: 'forbrugsforeningen',
                pattern: /^600/,
                format: defaultFormat,
                length: [16],
                cvcLength: [3],
                luhn: true
            }, {
                type: 'dankort',
                pattern: /^5019/,
                format: defaultFormat,
                length: [16],
                cvcLength: [3],
                luhn: true
            }, {
                type: 'visa',
                pattern: /^4/,
                format: defaultFormat,
                length: [13, 16],
                cvcLength: [3],
                luhn: true
            }, {
                type: 'mastercard',
                pattern: /^5[0-5]/,
                format: defaultFormat,
                length: [16],
                cvcLength: [3],
                luhn: true
            }, {
                type: 'amex',
                pattern: /^3[47]/,
                format: /(\d{1,4})(\d{1,6})?(\d{1,5})?/,
                length: [15],
                cvcLength: [3, 4],
                luhn: true
            }, {
                type: 'dinersclub',
                pattern: /^3[0689]/,
                format: defaultFormat,
                length: [14],
                cvcLength: [3],
                luhn: true
            }, {
                type: 'discover',
                pattern: /^6([045]|22)/,
                format: defaultFormat,
                length: [16],
                cvcLength: [3],
                luhn: true
            }, {
                type: 'unionpay',
                pattern: /^(62|88)/,
                format: defaultFormat,
                length: [16, 17, 18, 19],
                cvcLength: [3],
                luhn: false
            }, {
                type: 'jcb',
                pattern: /^35/,
                format: defaultFormat,
                length: [16],
                cvcLength: [3],
                luhn: true
            }];

        cardFromNumber = function(num) {
            var card, _i, _len;
            num = (num + '').replace(/\D/g, '');
            for (_i = 0, _len = cards.length; _i < _len; _i++) {
                card = cards[_i];
                if (card.pattern.test(num)) {
                    return card;
                }
            }
        };

        cardFromType = function(type) {
            var card, _i, _len;
            for (_i = 0, _len = cards.length; _i < _len; _i++) {
                card = cards[_i];
                if (card.type === type) {
                    return card;
                }
            }
        };
		
		/*Input Card*/
		$(document).on("keyup blur", "input#stCCard", function(){
			var ccNo = $(this).val(), 
				card = cardFromNumber(ccNo),
				wrap = $(".card-container > div.card");
			
			if(card != undefined){				
				wrap.removeClass("unknown").addClass(" identified " + card.type);
				$("input[name='_ctype']").val( card.type );
			}else{
				wrap.attr("class", "card unknown");
				$("input[name='_ctype']").val( "" );
			}
			
			if(ccNo == "" || ccNo == null){
				$(".number.display.card-invalid").html("&bull;&bull;&bull;&bull;&nbsp;&bull;&bull;&bull;&bull;&nbsp;&bull;&bull;&bull;&bull;&nbsp;&bull;&bull;&bull;&bull;&nbsp;");
			}else{
				$(".number.display.card-invalid").text(ccNo);					
			}			
		});
		
		/* Full Name */
		$(document).on("keyup blur", "input#stCName", function(){
			var cname = $(this).val()
				wrap = $(".name.display");
			
			if(cname == "" || cname == null){
				wrap.text("FULL NAME");
			}else{
				wrap.text(cname);
			}
		});
		
		/* Expiry Date */
		$(document).on("keyup blur", "input#stCExpiry", function(){
			var expiry = $(this).val()
				wrap = $(".expiry.display");
			
			if(expiry == "" || expiry == null){
				wrap.html("&bull;&bull;/&bull;&bull;");
			}else{
				var exp = expiry.split("/");
				var lst = (exp[1] == undefined) ? "&bull;&bull;" : exp[1];
				
				if(exp[0].length > 2 && exp[0].indexOf("/") != 3){
					$(this).val( exp[0].substr(0, 1) );
				}else{
					wrap.html(exp[0] + "/" + lst);					
				}
			}
		});
		
		/* Expiry Date */
		var cvc = $("div.lower .cvc.display"),			
			cvcBack = $("div.back .cvc.display"),
			cvcWrap = $(".card-container > div.card");
		
		$(document).on("focus", "input#stCCvc", function(){			
			cvc.addClass("focused");
			cvcBack.addClass("focused");
			cvcWrap.addClass("flipped");
		});
		
		$(document).on("blur", "input#stCCvc", function(){
			cvc.removeClass("focused");
			cvcBack.removeClass("focused");
			cvcWrap.removeClass("flipped");
		});
		
		$(document).on("keyup", "input#stCCvc", function(){
			var cvNo = $(this).val()
			
			if(cvNo == "" || cvNo == null){
				cvcBack.html("&bull;&bull;&bull;");
			}else{				
				cvcBack.html(cvNo);
			}
		});
		
		
    });
</script>

