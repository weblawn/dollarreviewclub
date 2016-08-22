<?php error_reporting(0); ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title; ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <?php echo get_assets_files('backend_header'); ?>
        <script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
        <script type="text/javascript">
            var site_url = "<?php echo site_url() ?>";
        </script>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="page-header-fixed">
        <!-- BEGIN HEADER -->   
        <div class="header navbar navbar-inverse navbar-fixed-top">
            <!-- BEGIN TOP NAVIGATION BAR -->
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN LOGO -->
                    <a class="brand" href="<?php echo site_url('backend') ?>">
                        <img src="<?php echo assets_url('img/logo.png'); ?>" alt="logo" />
                    </a>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <img src="<?php echo assets_url('backend/img/menu-toggler.png') ?>" alt="" />
                    </a>
                    <?php
                    $user = get_active_user();
                    ?>
                    <!-- END RESPONSIVE MENU TOGGLER -->            
                    <!-- BEGIN TOP NAVIGATION MENU -->              
                    <ul class="nav pull-right">
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class="dropdown user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" src="<?php echo assets_url('backend/img/avatar1_small.jpg') ?>" />
                                <span class="username"><?php echo $user->fname ; ?></span>
                                <i class="icon-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('backend/settings') ?>"><i class="icon-cog"></i> Settings</a></li>
                                <li><a href="<?php echo site_url('user/logout') ?>"><i class="icon-key"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                    <!-- END TOP NAVIGATION MENU --> 
                </div>
            </div>
            <!-- END TOP NAVIGATION BAR -->
        </div>
        <!-- END HEADER -->

        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar nav-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->        
                <ul class="page-sidebar-menu">
                    <li style="margin-bottom: 10px;">                        
                        <div class="sidebar-toggler hidden-phone"></div>
                    </li>
                    <?php
                    $navs = array(
                        array(
                            "link" => "backend/dashboard",
                            "icon" => "icon-home",
                            "name" => lang("dashboard"),
                            "sub" => array()
                        ),
                        array(
                            "link" => "javascript:void(0);",
                            "icon" => "icon-book",
                            "name" => lang("products"),
                            "sub" => array(
                                array(
                                    "link" => "backend/products",
                                    "name" => lang("all_products")
                                )
                            )
                        ),
                        array(
                            "link" => "javascript:void(0);",
                            "icon" => "icon-th-large",
                            "name" => lang("companies"),
                            "sub" => array(
                                array(
                                    "link" => "backend/companies",
                                    "name" => lang("all_companies")
                                ),
                                array(
                                    "link" => "backend/companies/export_company",
                                    "name" => "Export"
                                )
                            )
                        ),
                        array(
                            "link" => "javascript:void(0);",
                            "icon" => "icon-th",
                            "name" => lang("shopper"),
                            "sub" => array(
                                array(
                                    "link" => "backend/shopper",
                                    "name" => lang("all_shopper")
                                ),
                                array(
                                    "link" => "backend/shopper/export_shopper",
                                    "name" => "Export"
                                )
                            )
                        ),
                        array(
                            "link" => "javascript:void(0);",
                            "icon" => "icon-file",
                            "name" => lang("contents"),
                            "sub" => array(
                                array(
                                    "link" => "backend/content/add",
                                    "name" => lang("add_new")
                                ),
                                array(
                                    "link" => "backend/content",
                                    "name" => lang("all_pages")
                                )
                            ),
                        ),
                        array(
                            "link" => "javascript:void(0);",
                            "icon" => "icon-book",
                            "name" => lang("dcs"),
                            "sub" => array(
                                array(
                                    "link" => "backend/dcs/add",
                                    "name" => lang("add_new")
                                ),
                                array(
                                    "link" => "backend/dcs",
                                    "name" => lang("all_dcs")
                                )
                            ),
                        ),
                        array(
                            "link" => "backend/export",
                            "icon" => "icon-book",
                            "name" => 'Leads',
                            "sub" => array()
                        ),
                        array(
                            "link" => "backend/contactus",
                            "icon" => "icon-book",
                            "name" => 'Contact Us',
                            "sub" => array()
                        ),
                        array(
                            "link" => "javascript:void(0);",
                            "icon" => "icon-book",
                            "name" => 'Admin',
                            "sub" => array(
                                array(
                                    "link" => "backend/admin/add",
                                    "name" => lang("add_new")
                                ),
                                array(
                                    "link" => "backend/admin",
                                    "name" => 'All Admins'
                                )
                            ),
                        ),
                    );
                    
                    
                    /*
                     * Start loop to generate links
                     */
                    $li = "";
                    $i = 0;
                    foreach ($navs as $nav) {
                        
                        $active = '';
                        $navigator = "arrow";
                        $subMenu = "";

                        /*
                         * IF Dropdown options
                         */
                        if (is_array($nav['sub']) && !empty($nav['sub'])) {

                            $subMenu .= "<ul class='sub-menu'>";

                            foreach ($nav['sub'] as $sub) {

                                // Check current PPage
                                if (strpos($sub['link'], "/")) {
                                    $segment = explode("/", $sub['link']);
                                    $current = end($segment);
                                    if ($current == get_segment(2)) {
                                        $active = "active";
                                    }
                                }
                                $link = (strpos($sub['link'], "void")) ? $sub['link'] : site_url($sub['link']);
                                $subMenu .= "<li><a href='" . $link . "'>{$sub['name']}</a></li>";
                            }

                            $subMenu .= "</ul>";
                        }

                        $fSegment = explode("/", $nav['link']);
                        $fCurrent = end($fSegment);
                        if (get_segment(2) == $fCurrent) {
                            $active = " active";
                        }
                        
                        $start = ($i == 0) ? "start" : "";
                        $href = (strpos($nav['link'], "void")) ? $nav['link'] : site_url($nav['link']);
                        
                        $navigator = (!empty($active)) ? "selected" : "arrow";
                        $li .= "<li class='{$start}{$active}'>";                                                
                            $li .= "<a href='{$href}'>";
                                $li .= "<i class='{$nav['icon']}'></i>";
                                $li .= "<span class='title'>{$nav['name']}</span>";
                                $li .= "<span class='{$navigator}'></span>";
                            $li .= "</a>";
                            $li .= $subMenu;
                        $li .= "</li>";

                        $i++;
                    }
                    echo $li;
                    ?>                    
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN PAGE -->
            <div class="page-content">

                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div id="portlet-config" class="modal hide">
                    <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button"></button>
                        <h3>Widget Settings</h3>
                    </div>
                    <div class="modal-body">
                        Widget settings form goes here
                    </div>
                </div>
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

                <!-- BEGIN PAGE CONTAINER-->
                <div class="container-fluid">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="row-fluid">
                        <div class="span12">                            
                            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                            <h3 class="page-title"><?php echo $label ?></h3>
                            <ul class="breadcrumb">
                                <li>
                                    <i class="icon-home"></i>
                                    <a href="<?php echo site_url('backend') ?>">Home</a> 
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li><a href="javascript:{}"><?php echo $label ?></a></li>
                            </ul>
                            <!-- END PAGE TITLE & BREADCRUMB-->
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->