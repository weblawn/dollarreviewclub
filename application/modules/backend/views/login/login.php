<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />        
        <?php echo get_assets_files('backend_header') ?>
    </head>
    <!-- END HEAD -->

    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <img src="<?php echo assets_url('img/logo.png'); ?>" alt="" /> 
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <?php echo form_open('', array('class' => 'form-vertical login-form')); ?>
                <h3 class="form-title"><?php echo lang('login_title') ?></h3>
                
                <?php
                    echo validation_errors();
                    if(isset($login_error)){
                        echo "<div class='alert alert-danger'>{$login_error}</div>";
                    }
                ?>
                
                <div class="control-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9"><?php echo lang('username'); ?></label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-user"></i>
                            <input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo lang('username'); ?>" name="username"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9"><?php echo lang('password'); ?></label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-lock"></i>
                            <input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" placeholder="<?php echo lang('password'); ?>" name="password"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn green pull-right">
                        <?php echo lang('login') ?> <i class="m-icon-swapright m-icon-white"></i>
                    </button>            
                </div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <!-- END LOGIN -->

        <!-- BEGIN COPYRIGHT -->
        <div class="copyright"><?php echo date('Y') ?> &copy; <?php echo lang('website_name') ?></div>
        <?php echo get_assets_files('backend_footer'); ?>        
    </body>
</html>
