<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <!--BEGIN TABS-->
            <div class="tabbable tabbable-custom tabs-left">
                <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#tabGeneral" data-toggle="tab"><i class="icon-cog"></i> <?php echo lang('general') ?></a></li>
                    <li><a href="#tabPreference" data-toggle="tab"><i class="icon-star"></i> <?php echo lang('preferences') ?></a></li>
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
                                        <h3><?php echo $user->fname ; ?></h3>
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
                        </div>
                    </div> <!-- general tab close -->

                    <!-- Preferences tab open -->
                    <div class="tab-pane" id="tabPreference">
                        <h2>Preferences</h2>
                        <div class="description"> Edit your name and Email</div>

                        <h5 class="section-title">Preferences</h5>
                        <div class="card-alias user-info">
                            <div class="row-fluid form-horizontal stPreference">
                                <div class="control-group">
                                    <label class="control-label">Name</label>
                                    <div class="controls">
                                        <p class="unID"> <?php echo $user->fname ; ?></p>
                                    </div>			
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <p class="unID"> <?php echo $user->email ; ?></p>
                                    </div>			
                                </div>

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
                                    <h4 class="modal-title"> &nbsp;&nbsp;<i class="icon-key"></i> Change Name and Email</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row-fluid form-horizontal stPreference">
                                        <div class="span12">
                                            <div class="alert alert-danger" style="display: none;"></div>
                                            <div class="control-group">
                                                <div class="control-label">Name</div>
                                                <div class="controls">
                                                    <input type="text" name="fname" value="<?php echo $user->fname ?>" class="m-wrap " required="">
                                                    <?php /* <input type="text" name="lname" value="<?php echo $user->lname ?>" class="m-wrap small" required="">*/ ?>                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <div class="control-label">Email</div>
                                                <div class="controls">
                                                    <input type="text" name="email" value="<?php echo $user->email ?>" class="m-wrap " required="">
                                                    <?php /* <input type="text" name="lname" value="<?php echo $user->lname ?>" class="m-wrap small" required="">*/ ?>                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <div class="control-label">Confirm Email</div>
                                                <div class="controls">
                                                    <input type="text" name="con_email" value="<?php echo $user->email ?>" class="m-wrap " required="">
                                                    <?php /* <input type="text" name="lname" value="<?php echo $user->lname ?>" class="m-wrap small" required="">*/ ?>                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
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