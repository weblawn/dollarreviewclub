<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <!--BEGIN TABS-->
            <div class="tabbable tabbable-custom tabs-left">
                <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#tabGeneral" data-toggle="tab"><i class="icon-cog"></i> <?php echo lang('general') ?></a></li>
                    <li><a href="#tabPreference" data-toggle="tab"><i class="icon-star"></i> <?php echo lang('preferences') ?></a></li>                    
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
                                        <i class="img-circle settings-avatar avatar avatar-lg avatar-color-46 avatar-letter-s"></i>
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
									<?php if(isset($amazon->mval) && $amazon->mval !== null){ ?>
										<div class="span4 text-right">
											<a class="btn btn-primary btn-blue disabled" style="margin-bottom:10px" href="javascript:void(0);"><i class="icon-link"></i> &nbsp; Connected</a>
										</div><div class="clearfix"></div>
									<?php } else { ?>
										<div class="span4 text-right">
											<a class="btn btn-primary btn-blue" style="margin-bottom:10px" data-toggle="modal" href="#linkAmazon"><i class="icon-link"></i> &nbsp; Link Amazon</a>
										</div><div class="clearfix"></div>

										<!--Bootstrap model-->
										<div id="linkAmazon" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title"><b>Link Amazon Account</b></h4>
													</div>
													<div class="modal-body">
														<p>Click <a href="https://www.amazon.com/gp/profile" target="_blank">this link</a> and if prompted login to Amazon. Once you arrive on your profile page, copy the url and paste it in the input below.</p><br/>
														<p>
															Amazon Profile URL
															<input type="text" id="inpLinkAmazon" class="form-control" placeholder="https://www.amazon.com/gp/profile/A4BXSFGWDAXDLA" style="width: 96%;" />
														</p>
														<p class="alert alert-danger isAlert" style="display:none;"></p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary btn-blue" id="btnLinkAmazon">Save Changes</button>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
                                    <hr>

                                    <h6 class="upper">Facebook Account</h6>
                                    <div class="row-fluid">
                                        <div class="span8">
                                            <p>
                                                Once connected, you can login to Dollar Review Club using your Facebook profile
                                            </p>
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
                                            <a class="btn btn-primary fb-btn" style="margin-bottom:10px" href="<?php echo site_url('facebook/link') . "?redirect=" . site_url('shopper/settings') ?>"><i class="icon-facebook"></i> &nbsp; Link Facebook</a>
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
                            <div class="row-fluid form-horizontal stPreference">
                                <div class="control-group">
                                    <label class="control-label">Name</label>
                                    <div class="controls">
                                        <p class="unID"> <?php echo $user->fname . " " . $user->lname ?></p>
                                    </div>			
                                </div>

                                <?php
                                $meta = getUsermata($user->id, "category");
								
                                $cats = ($meta) ? unserialize($meta->mval) : array();
                                for ($i = 0; $i <= 3; $i++) {
                                    ?>
                                    <div class="control-group">
                                        <label class="control-label">Category <?php echo ($i + 1) ?></label>
                                        <div class="controls">
                                            <p class="unID">
                                                <?php
                                                if (isset($cats[$i])) {
                                                    $cat = get_category($cats[$i]);
                                                    echo $cat->name;
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row-fluid">
                                    <div class="text-right">
                                        <a class="btn btn-primary btn-blue" href="#changePreference" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="changePreference" class="modal hide fade" tabindex="-1" aria-hidden="true" style="display: none;">
                            <form action="" method="post" style="margin-bottom: 0;" id="stPreferenceForm">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title"> &nbsp;&nbsp;<i class="icon-key"></i> Update Password</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row-fluid form-horizontal stPreference">
                                        <div class="span12">
                                            <div class="alert alert-danger" style="display: none;"></div>
                                            <div class="control-group">
                                                <div class="control-label">Name</div>
                                                <div class="controls">
                                                    <input type="text" name="fname" value="<?php echo $user->fname ?>" class="m-wrap small" required="">
                                                    <input type="text" name="lname" value="<?php echo $user->lname ?>" class="m-wrap small" required="">                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $meta = getUsermata($user->id, "category");
                                        $cats = unserialize($meta->mval);
                                        for ($i = 0; $i <= 3; $i++) {
                                            ?>
                                            <div class="control-group">
                                                <label class="control-label">Category <?php echo ($i + 1) ?></label>
                                                <div class="controls">
                                                    <select class="span12" name="category[]">
                                                        <?php
                                                        $opt = "<option value=''></option>";
                                                        foreach (get_categories_list() as $cat) {
                                                            $selc = (isset($cats[$i]) && $cats[$i] == $cat->cid) ? "selected" : "";
                                                            $opt .= "<option value='{$cat->cid}' {$selc}>{$cat->name}</option>";
                                                        }
                                                        echo $opt;
                                                        ?>
                                                    </select>
                                                </div>			
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn red" id="stPreferenceCnl" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn blue">Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- Preferences tab close -->
                </div>
            </div>
            <!--END TABS-->
        </div>
    </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		var loader = $("#stLoader");
		
		/*
		 * Link Amazon URL
		 */
		$(document).on("click", "button#btnLinkAmazon", function(e){
			e.preventDefault();
			
			var _alert = $(".isAlert"),
				amazonUrl = $("#inpLinkAmazon").val();
			
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('shopper/linkAmazon') ?>",
				dataType: "json",
				data: {"amazonUrl": amazonUrl},
				beforeSend: function(){
					loader.show();
				},
				error: function(){
					loader.hide();
				},
				success: function(r){
					if(r.res){
						_alert.removeClass("alert-danger").addClass("alert-success").text(r.msg).show();
						window.location.reload();
					}else{
						_alert.text(r.msg).show();
					}
					loader.hide();
				}
			});
		});
		
		/*
		 * Unlink Facebook Account
		 */
		$(document).on("click", "button#btnUnlinkFacebook", function(e){
			e.preventDefault();
			
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('shopper/unlinkFacebook') ?>",
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
	});
</script>