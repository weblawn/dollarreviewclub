<script src="<?php echo assets_url('scripts/jquery.js'); ?>"></script>
<script src="<?php echo assets_url('scripts/scroller.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo assets_url('css/avatars.min.css'); ?>"/>
<link rel="stylesheet" href="<?php echo assets_url('css/app.min.css'); ?>"/>
<style>
.modal.fade {
    top: 0%;
    width: 100%;
    margin-left: 0Px;
    background-color: transparent;
}
.modal.fade.in {
    top: 0%;
}
.alert-danger, .alert-error {
    color: #b94a48;
    background-color: #f2dede;
    border-color: #eed3d7;
}

.alert {
    padding: 8px 35px 8px 14px;
    margin-bottom: 20px;
    text-shadow: 0 1px 0 rgba(255,255,255,0.5);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    text-align: left;
}
</style>

<div class="container-fluid" style="min-height:650px">
        <div class="row-fluid" data-ng-controller="SettingsController">
            <div class="col-md-12 col-lg-12" style="width:100%;">
                <div id="prof-bar" class="col-md-3 profile-side" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(204, 204, 204); position: fixed; height: 461px; bottom: auto; width: 335px;">
                    <div id="profile-container">
                        <div style="padding-bottom:10px;" class="container" data-reactid=".0">
                            <div class="col-lg-12" data-reactid=".0.0">
                                <div style="width:150px;height:150px;margin-left:auto;margin-right:auto;" class="row" data-reactid=".0.0.0">
                                    <div class="avatar-col" data-reactid=".0.0.0.0"><img src="<?php echo $avatar ?>" alt="Avatar for <?php echo $user->fname ?>" class="settings-avatar img-circle" width="150" style="border:4px solid;" height="150" data-reactid=".0.0.0.0.0">
                                    <?php /* <i class="settings-avatar img-circle avatar avatar-color-161 avatar-letter-d" style="width:150px;height:150px;line-height:150px;font-size:75px;" data-reactid=".0.0.0.0.1"></i>*/?>
                                    </div>
                                    </div>
                                    <div style="text-align:center;font-weight:300;" class="row" data-reactid=".0.0.1">
                                        <h2 class="diet text-capitalize" style="margin-bottom:0;font-weight:300;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" data-reactid=".0.0.1.0">
                                            <span data-reactid=".0.0.1.0.0"><?php echo $user->fname ?> </span>
                                            <span data-reactid=".0.0.1.0.1"><?php echo $user->lname ?></span>
                                        </h2>
                                    </div>
                                    <div style="text-align:center;font-weight:300;" class="row" data-reactid=".0.0.2">
                                        <h4 style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" data-reactid=".0.0.2.0"><?php echo $user->email ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <ul class="nav nav-pills nav-stacked settings-menu" id="settings-tabs" style="padding-top:15px;">
                                                    <li class="active">
                                <a class="click-top" href="#tabGeneral" role="tab" data-toggle="tab">
                            <span class="icon">
                                <i class="fa fa-user"></i>
                            </span>
                                    <?php echo lang('general') ?>
                                </a>
                            </li>
                            <li class="">
                                <a class="click-top" href="#tabPreference" role="tab" data-toggle="tab">
                            <span class="icon">
                                <i class="fa fa-cog"></i>
                            </span>
                                    <?php echo lang('preferences') ?>
                                </a>
                            </li>
                                                <li>

                                                </li><li class="">
                            <a class="click-top" href="#tabVersion" role="tab" data-toggle="tab">
                            <span class="icon">
                                <i class="fa fa-info"></i>
                            </span>
                                <?php echo lang('version') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('user/logout') ?>">
                            <span class="icon">
                                <i class="fa fa-power-off"></i>
                            </span>
                                <?php echo lang('logout') ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>

                <h4 class="modal-title" id="updatePasswordModalLabel">
                    <i class="fa fa-key"></i> Update Password
                </h4>
            </div>

            <form action="" method="post" id="stChangePassForm" class="ng-pristine ng-valid">
            <div class="modal-body">
            <div class="alert alert-danger" style="display: none;"></div>

                                    <div class="form-group">
                        <label for="password">Current Password</label>
                        <input type="password" required="" class="form-control required" id="current-password" name="_old" placeholder="provide your current password" autocomplete="off">
                    </div>

                
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" required="" class="form-control required" pattern=".{8,}" title="new password must be at least 8 characters" id="password" name="_new" placeholder="at least 8 characters" autocomplete="off">
                </div>
                
                
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" required="" class="form-control required" pattern=".{8,}" title="new password must be at least 8 characters" id="confirm_password" name="_con" placeholder="at least 8 characters" autocomplete="off">
                </div>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn red" id="stChangePassCnl" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

                        <!-- Tab panes -->
                <div class="col-md-9 col-md-offset-3">
                    <div id="prof-content" class="tab-content" style="padding-left:10px">

                        <!--Overview Tab-->
                      <div class="tab-pane active" id="tabGeneral" style="border:none;">
                         <div id="profile-page-container">
                            <div data-reactid=".2">
                                <div data-reactid=".2.1">
                                    <div class="card-alias" style="padding-bottom:0;" data-reactid=".2.1.0">
                                        <div style="margin-bottom:20px;" class="row" data-reactid=".2.1.0.0">
                                            <div style="text-align:center;border-right:1px solid #ccc;" class="col-md-4" data-reactid=".2.1.0.0.0">
                                                <h5 data-reactid=".2.1.0.0.0.0">You have</h5>
                                                    <h3 data-reactid=".2.1.0.0.0.1">
                                                        <span style="font-size:45px;font-weight:200;" data-reactid=".2.1.0.0.0.1.0">
                                                            <span data-reactid=".2.1.0.0.0.1.0.0">1</span>
                                                            <span data-reactid=".2.1.0.0.0.1.0.1">&nbsp;</span>
                                                        </span>
                                                        <span style="font-weight:200;" data-reactid=".2.1.0.0.0.1.1">snags remaining</span>
                                                    </h3>
                                                    <hr style="margin:0;border-top:1px solid #ccc;" data-reactid=".2.1.0.0.0.2">
                                                    <h3 style="margin-top:10px;margin-bottom:20px;" data-reactid=".2.1.0.0.0.3">
                                                    <span style="font-size:45px;font-weight:200;" data-reactid=".2.1.0.0.0.3.0">
                                                        <span data-reactid=".2.1.0.0.0.3.0.0">1</span>
                                                        <span data-reactid=".2.1.0.0.0.3.0.1">&nbsp;</span>
                                                    </span>
                                                    <span style="font-weight:200;font-size:33px;" data-reactid=".2.1.0.0.0.3.1">
                                                        <sup data-reactid=".2.1.0.0.0.3.1.0">snags available</sup>
                                                    </span>
                                                </h3>
                                            </div>
                                            <div style="text-align:center;border-right:1px solid #ccc;height:184px;" class="col-md-4" data-reactid=".2.1.0.0.1">
                                            <h5 data-reactid=".2.1.0.0.1.0">Your Score</h5>
                                            <h3 style="font-weight:200;font-size:45px;margin-top:50px;" data-reactid=".2.1.0.0.1.1">20</h3>
                                        </div>
                                        <div style="text-align:center;height:184px;" class="col-md-4" data-reactid=".2.1.0.0.2">
                                        <h5 data-reactid=".2.1.0.0.2.0">Your Rank</h5>
                                        <h3 style="margin-top:45px;" data-reactid=".2.1.0.0.2.1">
                                            <p style="font-weight:200;" data-reactid=".2.1.0.0.2.1.0">Not Ranked Yet.</p>
                                            <a href="<?php echo site_url('') ?>" style="font-weight:200;" data-reactid=".2.1.0.0.2.1.1">Snag More Deals!</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div style="padding-left:0;" class="col-md-6" data-reactid=".2.1.1">
                                <h5 class="section-title" data-reactid=".2.1.1.0">Verify Your Mobile Phone Number</h5>
                                <div id="phone-verify" class="card-alias container" data-reactid=".2.1.1.1">
                                    <noscript data-reactid=".2.1.1.1.0"></noscript>
                                    <div class="row" data-reactid=".2.1.1.1.1">
                                        <div style="text-align:center;" class="col-xs-12" data-reactid=".2.1.1.1.1.0">
                                        <img style="height:75px;padding-bottom:15px;" src="<?php echo assets_url('img/phone.png'); ?>" data-reactid=".2.1.1.1.1.0.0">   
                                    </div>
                                    <div class="col-xs-12" data-reactid=".2.1.1.1.1.1">
                                        <div class="form-group" data-reactid=".2.1.1.1.1.1.0">
                                            <input id="confirm-input" type="text" value="9143402694" style="margin-bottom:0;text-align:center;" class="form-control" data-reactid=".2.1.1.1.1.1.0.1:$input">
                                        </div>
                                    </div>
                                    <div style="text-align:center;" class="col-xs-12" data-reactid=".2.1.1.1.1.2">
                                        <button id="confirm-button" style="height:38px;min-width:100%;" type="button" class="btn btn-primary" data-reactid=".2.1.1.1.1.2.0">
                                            <i class="fa fa-mobile" data-reactid=".2.1.1.1.1.2.0.0"></i>
                                            <span data-reactid=".2.1.1.1.1.2.0.1">&nbsp;</span>
                                            <span data-reactid=".2.1.1.1.1.2.0.2">Send Confirmation </span>
                                        </button>
                                    </div>
                                </div>
                                <div style="text-align:center;" class="row" data-reactid=".2.1.1.1.2">
                                    <h5 style="color:#777;margin-top:15px;margin-bottom:1px;" data-reactid=".2.1.1.1.2.0">
                                        <i class="fa fa-lock" data-reactid=".2.1.1.1.2.0.0"></i>
                                        <span data-reactid=".2.1.1.1.2.0.1">&nbsp;This is for verification purposes only.</span></h5></div></div></div><div style="padding-right:0;" class="col-md-6" data-reactid=".2.1.2">
                                        <h5 class="section-title" data-reactid=".2.1.2.0">Connected Services</h5>
                                        <div class="card-alias container" data-reactid=".2.1.2.1">
                                            <div style="padding:0;" class="col-xs-12" data-reactid=".2.1.2.1.0">
                                                <button disabled="" style="width:100%;background-color:#FF9900;color:white;margin-bottom:15px;height:38px;" type="button" class="btn btn-default" data-reactid=".2.1.2.1.0.0">
                                                <i class="fa fa-check" data-reactid=".2.1.2.1.0.0.0"></i>
                                                <span data-reactid=".2.1.2.1.0.0.1">&nbsp;</span>
                                                <span data-reactid=".2.1.2.1.0.0.2">Connected Amazon Account</span>
                                            </button>
                                        </div>
                                        <div style="padding:0;" class="col-xs-12" data-reactid=".2.1.2.1.1">
                                            <a href="https://www.snagshout.com/api/v1/users/link/fb" style="width:100%;background-color:#3B5998;color:white;margin-bottom:15px;height:38px;" type="button" class="btn btn-default" role="button" data-reactid=".2.1.2.1.1.0">
                                                <i class="fa fa-facebook" data-reactid=".2.1.2.1.1.0.0"></i>
                                                <span data-reactid=".2.1.2.1.1.0.1">&nbsp;</span>
                                                <span data-reactid=".2.1.2.1.1.0.2">Link Facebook</span>
                                            </a>
                                        </div>
                                        <div style="padding:0;" class="col-xs-12" data-reactid=".2.1.2.1.2">
                                            <a href="https://www.snagshout.com/social/link/pinterest" style="width:100%;background-color:#BD081C;color:white;margin-bottom:15px;height:38px;" type="button" class="btn btn-default" role="button" data-reactid=".2.1.2.1.2.0">
                                                <i class="fa fa-pinterest" data-reactid=".2.1.2.1.2.0.0"></i>
                                                <span data-reactid=".2.1.2.1.2.0.1">&nbsp;</span>
                                                <span data-reactid=".2.1.2.1.2.0.2">Link Pinterest</span>
                                            </a>
                                        </div>
                                        <div style="padding:0;" class="col-xs-12" data-reactid=".2.1.2.1.3">
                                            <a href="https://www.snagshout.com/social/link/twitter" style="width:100%;background-color:#4099FF;color:white;height:38px;" type="button" class="btn btn-default" role="button" data-reactid=".2.1.2.1.3.0">
                                                <i class="fa fa-twitter" data-reactid=".2.1.2.1.3.0.0"></i>
                                                <span data-reactid=".2.1.2.1.3.0.1">&nbsp;</span>
                                                <span data-reactid=".2.1.2.1.3.0.2">Link Twitter</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div data-reactid=".2.1.3">
                                    <h5 class="section-title" data-reactid=".2.1.3.0">Badge Showcase</h5>
                                    <div class="row card-alias" data-reactid=".2.1.3.1">
                                        <div class="badges" data-reactid=".2.1.3.1.0">
                                            <span data-reactid=".2.1.3.1.0.1">
                                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center" style="display:inline-block;" data-reactid=".2.1.3.1.0.1.$=1$0"><img src="<?php echo assets_url('img/badge.png'); ?>" style="max-height:120px;" class="img-responsive" data-reactid=".2.1.3.1.0.1.$=1$0.0"></div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                      </div>
                </div>

                                    

                                    <!--Preferences Tab-->
              <div class="tab-pane" id="tabPreference" style="border:none;">
                   <div id="pref-container">
                       <div data-reactid=".1">
                            <h5 class="section-title" data-reactid=".1.0">Settings</h5>
                            <div class="card-alias container" data-reactid=".1.1">
                            <div class="alert alert-danger" style="display: none;"></div>
                                <noscript data-reactid=".1.1.0"></noscript>
                                <div style="margin-bottom:15px;" class="row" data-reactid=".1.1.1">
                                    <div class="col-sm-2 col-xs-4" data-reactid=".1.1.1.0">
                                        <div class="avatar-col" data-reactid=".1.1.1.0.0">
                                            <img src="<?php echo $avatar ?>" alt="Avatar for <?php echo $user->fname ?>" class="settings-avatar img-circle" width="75" style="border:4px solid;" height="75" data-reactid=".1.1.1.0.0.0">
                                            
                                        </div>
                                    </div>
                                    <div style="margin-top:25px;padding-left:0;" class="col-md-2 col-md-offset-0 col-sm-offset-0 col-xs-offset-5" data-reactid=".1.1.1.1">
                                    <a href="https://secure.gravatar.com/" target="_blank" type="button" class="btn btn-link" role="button" data-reactid=".1.1.1.1.0">
                                        <i class="fa fa-camera" style="margin-right:5px;" data-reactid=".1.1.1.1.0.0"></i>
                                        <span data-reactid=".1.1.1.1.0.1">Change Avatar</span>
                                    </a>
                                </div>
                            </div>
                            <?php if($receive_email=='no'){$no='checked="checked"'; $yes='';}else{$yes='checked="checked"'; $no='';}?>
                            <div class="row" data-reactid=".1.1.2">
                                <div class="col-md-4" data-reactid=".1.1.2.0">
                                    <div class="form-group" data-reactid=".1.1.2.0.0">
                                        <label class="control-label" data-reactid=".1.1.2.0.0.$label">
                                            <span data-reactid=".1.1.2.0.0.$label.1"> First Name</span>
                                        </label>
                                        <input type="text" label=" First Name" id="user_fname" value="<?php echo $user->fname ?>" class="form-control" data-reactid=".1.1.2.0.0.1:$input">
                                    </div>
                                </div>
                                <div class="col-md-4" data-reactid=".1.1.2.1">
                                    <div class="form-group" data-reactid=".1.1.2.1.0">
                                        <label class="control-label" data-reactid=".1.1.2.1.0.$label">
                                            <span data-reactid=".1.1.2.1.0.$label.1">Last Name</span>
                                        </label>
                                    <input type="text" label="Last Name" id="user_lname" value="<?php echo $user->lname ?>" class="form-control" data-reactid=".1.1.2.1.0.1:$input"></div>
                                </div>
                            </div>
                            <div style="margin-bottom:5px;" class="row" data-reactid=".1.1.3">
                                <div class="col-md-8" data-reactid=".1.1.3.0">
                                    <div class="form-group" data-reactid=".1.1.3.0.0">
                                        <label class="control-label" data-reactid=".1.1.3.0.0.$label">
                                            <span data-reactid=".1.1.3.0.0.$label.1">Email Address</span>
                                        </label>
                                        <input type="text" disabled="" label="Email Address" value="<?php echo $user->email ?>" class="form-control" data-reactid=".1.1.3.0.0.1:$input">
                                    </div>
                                </div>
                            </div>
                            <div class="row" data-reactid=".1.1.4">
                                <div class="col-md-5" data-reactid=".1.1.4.0">I want to receive emails from Dollar Review Club.</div>
                                <div style="margin-top:-10px;" class="col-md-1" data-reactid=".1.1.4.1">
                                    <div class="form-group" data-reactid=".1.1.4.1.0">
                                        <div class="radio" data-reactid=".1.1.4.1.0.$checkboxRadioWrapper">
                                            <label for="yes-radio" class="" data-reactid=".1.1.4.1.0.$checkboxRadioWrapper.$label">
                                                <input id="yes-radio" name="receive_email" <?php echo $yes; ?> value="yes" type="radio" label="Yes" class="receive_email" >
                                                <span data-reactid=".1.1.4.1.0.$checkboxRadioWrapper.$label.1">Yes</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top:-10px;" class="col-md-1" data-reactid=".1.1.4.2">
                                    <div class="form-group" data-reactid=".1.1.4.2.0">
                                        <div class="radio" data-reactid=".1.1.4.2.0.$checkboxRadioWrapper">
                                            <label for="no-radio" class="" data-reactid=".1.1.4.2.0.$checkboxRadioWrapper.$label">
                                                <input id="no-radio" name="receive_email" <?php echo $no; ?> value="no" type="radio" label="No" class="receive_email" >
                                                <span data-reactid=".1.1.4.2.0.$checkboxRadioWrapper.$label.1">No</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button data-toggle="modal" data-target="#updatePasswordModal" type="button" class="btn btn-default" data-reactid=".1.1.5">
                                <i class="fa fa-key" style="margin-right:5px;" data-reactid=".1.1.5.0"></i>
                                <span data-reactid=".1.1.5.1">Update Password</span>
                            </button>
                            <div style="text-align:right;padding-right:15px;margin-top:20px;" class="row" data-reactid=".1.1.6">
                                <button type="button" class="btn btn-primary" data-reactid=".1.1.6.0" id="updatesettings">
                                    <i class="fa fa-floppy-o" style="padding-right:5px;" data-reactid=".1.1.6.0.0"></i>
                                    <span data-reactid=".1.1.6.0.1">Save</span>
                                </button>
                            </div>
                       </div>
                       <div data-reactid=".1.2">
                        <h5 class="section-title" data-reactid=".1.2.0">Your Interests</h5>
                        <div class="card-alias" data-reactid=".1.2.1">
                            <div class="alert alert_preference alert-danger" style="display: none;"></div>
                            <div data-reactid=".1.2.1.0">
                            <?php
                                $meta = getUsermata($user->id, "category");
                                        $cats = unserialize($meta->mval);
                            foreach (get_categories_list() as $cat) {
                                if (in_array($cat->cid, $cats)) {
                                        $class = "btn-success";
                                    }
                                    else
                                    {
                                        $class = "btn-default";                                        
                                    }
                                                            ?>
                                                            
                                            <button id="<?php echo $cat->cid; ?>-choice" style="margin:5px;" type="button" onclick="reset_preference(<?php echo $cat->cid; ?>)" class="btn <?php echo $class; ?>" ><?php echo $cat->name; ?></button>
                                        
                                                            
                                                            <?php
                                                        }
                                                        $old_cat = '';
                                                        $i=1;
                                                        foreach($cats as $cat)
                                                        {
                                                            if($old_cat == '')
                                                            {$old_cat = $cat;}
                                                            else{$old_cat = $old_cat.','.$cat;}
                                                            
                                                        }
                            ?>
                            <input type="hidden" readonly="readonly" id="old_cat" value="<?php echo $old_cat; ?>" />
                            
                              </div>
                            <div style="text-align:right;" class="row" data-reactid=".1.2.1.1">
                                <div class="col-md-10" data-reactid=".1.2.1.1.0">
                                    <p id="chooser-alert" style="color:#d43f3a;display: none;text-align:left;" data-reactid=".1.2.1.1.0.0">
                                        <span data-reactid=".1.2.1.1.0.0.0">You've already chosen 4 categories! &nbsp;</span>
                                        <i class="fa fa-times" data-reactid=".1.2.1.1.0.0.1" onclick="hide();" style="cursor: pointer;"></i>
                                    </p>
                                </div>
                                <div class="col-md-2" data-reactid=".1.2.1.1.1">
                                    <button style="margin-top:15px;" type="button" class="btn btn-primary" data-reactid=".1.2.1.1.1.0" id="reset_preference">
                                        <i class="fa fa-floppy-o" style="padding-right:5px;" data-reactid=".1.2.1.1.1.0.0"></i>
                                        <span data-reactid=".1.2.1.1.1.0.1">Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                       </div>
                   </div>
              </div>
</div>

                                                <!--Billing Tab-->
                                                                                                        <!--About Tab-->
                                                <div class="tab-pane" id="tabVersion" style="border:none;">

                                                    <div class="description">
                                                        Snagshout is a
                                                        product of <a href="http://www.sellerlabs.com/">SellerLabs</a>
                                                    </div>
                                                    <div class="card-alias">
                                                        <div class="content text-center">
                                                            <img src="./Snagshout _ Account Settings_files/about_logo.png" class="img-responsive">

                                                            <h4>
                                                                Application
                                                                Version 1.1.7<br>
                                                                <small>
                                                                    Copyright ©
                                                                    SellerLabs
                                                                    2014-2015
                                                                </small>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                            </div>
                    </div>

                    <div class="modal fade" id="linkAz" tabindex="-2" role="dialog" aria-labelledby="linkAz" aria-hidden="true">
                        <div class="modal-dialog">
                            <form data-ng-submit="updateAmazonUrl(user.azUrl)" class="ng-pristine ng-valid">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">X</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            Link Amazon Account
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        Click <a href="https://www.amazon.com/gp/profile" target="_blank">this link</a>
                                        and if prompted login to Amazon. Once
                                        you arrive on your profile page, copy
                                        the url and
                                        paste it in the input below.

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Amazon
                                                Profile URL</label>
                                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid" id="azUrl" name="amazonAccountUrl" placeholder="https://www.amazon.com/gp/profile/A4BXSFGWDAXDLA" data-ng-model="user.azUrl" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <button class="btn btn-primary">Save
                                            changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">

function reset_preference(id)
                                {
                                    $( "#chooser-alert" ).hide();
                                    var old_cat_raw = $('#old_cat').val();
                                    var old_cat = old_cat_raw.split(",");
                                    var new_cat = '';
                                    var length_cat = old_cat.length;
                                    //console.log(id);
                                    //console.log(old_cat);
                                    if(jQuery.inArray( id.toString(), old_cat )>=0)
                                    {   // background-color: #1FA270;
                                        $( "#"+id+"-choice" ).removeClass( "btn-success" ).addClass( "btn-default" );
                                        for (i = 0; i < length_cat; i++) { 
                                            if(old_cat[i].toString()!=id)
                                            {
                                                if(new_cat == '')
                                                {
                                                    new_cat = old_cat[i];
                                                }
                                                else
                                                {
                                                    new_cat += "," + old_cat[i];
                                                }
                                            }
                                            
                                        }
                                        //console.log('remove');
                                    }
                                    else if(length_cat == 4)
                                    {
                                        $( "#chooser-alert" ).show();
                                        new_cat = old_cat_raw ;
                                    }
                                    else
                                    {
                                        $( "#"+id+"-choice" ).removeClass( "btn-default" ).addClass( "btn-success" );
                                        //$( "#"+id+"-choice" ).css('background-color','#1FA270!important');
                                        if(old_cat_raw != '')
                                                {
                                                    new_cat = old_cat_raw + ',' + id;
                                                }
                                                else
                                                {
                                                    new_cat = id;
                                                }
                                    }
                                    $('#old_cat').val(new_cat);
                                }
                                function hide()
                                {
                                    $('#chooser-alert').hide();
                                }
                                
                                
                                

	jQuery(document).ready(function($){
		
		var loader = $("#stLoader");
        
        
        
        /*
        *save settings
        *
        /
		/*Save Card Details*/
		$(document).on("click", "button#reset_preference", function(e){
			e.preventDefault();
			
			var _alert = $(".alert_preference"),
				old_cat = $("#old_cat").val();
			
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('shopper/reset_preference') ?>",
				dataType: "json",
				data: {"old_cat": old_cat},
				beforeSend: function(){
					loader.show();
				},
				error: function(){
					loader.hide();
				},
				success: function(r){
					if(r.res){
						_alert.removeClass("alert-danger").addClass("alert-success").text("Updated details successfully.").show();
						window.location.reload();
					}else{
						_alert.removeClass("alert-success").addClass("alert-danger").text(r.msg).show();
					}
				}
			});
		});
        
        
        
        /*
        *save settings
        *
        /
		/*Save Card Details*/
		$(document).on("click", "button#updatesettings", function(e){
			e.preventDefault();
			
			var _alert = $(".alert"),
				fname = $("#user_fname").val(),
				lname = $("#user_lname").val(),
				receive_email = $("input[type='radio'].receive_email:checked").val();
			
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('shopper/updatesettings') ?>",
				dataType: "json",
				data: {"fname": fname,"lname": lname,"receive_email": receive_email},
				beforeSend: function(){
					loader.show();
				},
				error: function(){
					loader.hide();
				},
				success: function(r){
					if(r.res){
						_alert.removeClass("alert-danger").addClass("alert-success").text("Updated details successfully.").show();
						window.location.reload();
					}else{
						_alert.removeClass("alert-success").addClass("alert-danger").text(r.msg).show();
					}
				}
			});
		});
        
        
        
        
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