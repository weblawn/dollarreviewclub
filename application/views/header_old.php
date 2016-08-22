<?php error_reporting(0); ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        
        <title><?php echo $title ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta name="title" content="<?php echo $title ?>"/>
        <meta name="keywords" content="<?php echo $keywords ?>"/>
        <meta name="description" content="<?php echo $description ?>" />
        <meta name="image" content="<?php echo $image ?>" />
        <?php echo get_assets_files('frontend_header') ?>

        <script type="text/javascript">
            var stGoToTop = '<img src="<?php echo assets_url('img/up.png'); ?>" style="width:40px; height:40px" />';
            var site_url = "<?php echo site_url() ?>", 
                priceRange = {min: 0, max: 10000, values: [<?php echo (isset($_GET['rangeMin']) && !empty($_GET['rangeMin'])) ? $_GET['rangeMin'] : 0 ?>, <?php echo (isset($_GET['rangeMax']) && !empty($_GET['rangeMax'])) ? $_GET['rangeMax'] : 2000 ?>]},
                ajaxReqData = {type: "<?php echo get_current_object('class') ?>", slug: "<?php echo (isset($slug)) ? $slug : '' ?>", search: "<?php echo (isset($_GET['q'])) ? $_GET['q'] : '' ?>"};
        </script>
    </head>

    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body>
        <style>
.recaptchatable {
    line-height: 0!important;
}
</style>
        <?php
        $user = get_active_user();
        $avatar = $this->session->userdata('avatar');
        ?>
        <div id="fb-root"></div>
        <!-- BEGIN HEADER -->
        <div class="front-header">
            <div class="container">
                <div class="navbar">
                    <div class="navbar-inner">

                        <!-- BEGIN LOGO (you can use logo image instead of text)-->
                        <a class="brand logo-v1" href="<?php echo site_url() ?>" style="color:#007ea6;">
                            <img src="<?php echo assets_url('img/logo.png') ?>" />
                        </a>
                        <!-- END LOGO -->

                        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <!-- END RESPONSIVE MENU TOGGLER -->

                        <!-- BEGIN TOP NAVIGATION MENU -->
                        <div class="nav-collapse collapse pull-left">
                            <ul class="nav">
                                <?php
                                echo get_menu(( ($user) ? $user->role : 'header'))
                                ?>
                            </ul>
                        </div>
                        <!-- BEGIN TOP NAVIGATION MENU -->
<style>
.img-circle {
    border-radius: 50%!important;
}
</style>
                        <div class="pull-right login-info">
                            <?php if ($user) { 
                                
        
                                ?>
                                <ul class="nav">
                                    <li class="dropdown user">
                                        <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="<?php echo site_url($user->role) ?>">
                                            <?php /* <img src="<?php echo assets_url('img/avatar1_small.jpg') ?>" alt=""> */ ?>
                                            <?php
                                            if(isset($avatar))
                                            {
                                                ?>
                                                <img src="<?php echo $avatar ?>" alt="Avatar for <?php echo $user->fname ?>" class="settings-avatar img-circle" width="25" style="border:2px solid;" height="25" data-reactid=".1.1.1.0.0.0">
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <img src="<?php echo assets_url('img/avatar1_small.jpg') ?>" alt="">
                                                <?php
                                            }
                                            
                                            ?>
                                            <span class="username"><?php echo $user->fname . " " . $user->lname ?></span>
                                            <i class="icon-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo site_url($user->role . '/settings'); ?>"><i class="icon-cog"></i> <?php echo lang('settings') ?></a></li>
                                            <!--<li><a href="<?php echo site_url('pages/contact'); ?>"><i class="icon-question"></i> <?php echo lang('help') ?></a></li>-->
                                            <li><a href="<?php echo site_url('user/logout'); ?>"><i class="icon-key"></i> <?php echo lang('logout') ?></a></li>
                                        </ul>
                                    </li>
                                </ul>                                
                            <?php } else { ?>
                                <a href="<?php echo site_url('user/signup'); ?>" class="btn btn-primary"><?php echo lang('signup') ?></a>
                                <a href="<?php echo site_url('user/login'); ?>" class="btn btn-default"><?php echo lang('login') ?></a>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>                   
        </div>
        <!-- END HEADER -->